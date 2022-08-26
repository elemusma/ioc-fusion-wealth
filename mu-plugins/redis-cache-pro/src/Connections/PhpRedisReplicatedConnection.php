<?php
/**
 * Copyright © Rhubarb Tech Inc. All Rights Reserved.
 *
 * All information contained herein is, and remains the property of Rhubarb Tech Incorporated.
 * The intellectual and technical concepts contained herein are proprietary to Rhubarb Tech Incorporated and
 * are protected by trade secret or copyright law. Dissemination and modification of this information or
 * reproduction of this material is strictly forbidden unless prior written permission is obtained from
 * Rhubarb Tech Incorporated.
 *
 * You should have received a copy of the `LICENSE` with this file. If not, please visit:
 * https://objectcache.pro/license.txt
 */

declare(strict_types=1);

namespace RedisCachePro\Connections;

use Redis;

use RedisCachePro\Configuration\Configuration;
use RedisCachePro\Connectors\PhpRedisConnector;
use RedisCachePro\Exceptions\ConnectionException;

class PhpRedisReplicatedConnection extends PhpRedisConnection implements ConnectionInterface
{
    const READ_COMMANDS = [
        'EXISTS', 'TYPE', 'TTL', 'GET', 'MGET',
        'KEYS', 'SCAN',
        'SUBSTR', 'STRLEN', 'GETRANGE', 'GETBIT', 'RANDOMKEY',
        'LLEN', 'LRANGE', 'LINDEX',
        'SCARD', 'SISMEMBER', 'SMISMEMBER', 'SINTER', 'SUNION', 'SDIFF', 'SMEMBERS', 'SSCAN', 'SRANDMEMBER',
        'ZRANGE', 'ZREVRANGE', 'ZRANGEBYSCORE', 'ZREVRANGEBYSCORE', 'ZRANGEBYLEX', 'ZREVRANGEBYLEX',
        'ZCARD', 'ZSCORE', 'ZCOUNT', 'ZRANK', 'ZREVRANK', 'ZSCAN', 'ZLEXCOUNT', 'ZMSCORE', 'ZDIFF', 'ZINTER', 'ZUNION',
        'HGET', 'HMGET', 'HEXISTS', 'HLEN', 'HKEYS', 'HVALS', 'HGETALL', 'HSCAN', 'HSTRLEN',
        'PING', 'AUTH', 'SELECT', 'ECHO', 'QUIT',
        'OBJECT', 'TIME', 'PFCOUNT',
        'BITCOUNT', 'BITPOS', 'BITFIELD',
        'GEOHASH', 'GEOPOS', 'GEODIST', 'GEORADIUS', 'GEORADIUSBYMEMBER',
    ];

    /**
     * The master connection.
     *
     * @var \RedisCachePro\Connections\PhpRedisConnection
     */
    protected $master;

    /**
     * An array of replica connections.
     *
     * @var \RedisCachePro\Connections\PhpRedisConnection[]
     */
    protected $replicas;

    /**
     * The pool of connections for read commands.
     *
     * @var \RedisCachePro\Connections\PhpRedisConnection[]
     */
    protected $pool;

    /**
     * Create a new replicated PhpRedis connection.
     *
     * @param  \RedisCachePro\Connections\PhpRedisConnection  $master
     * @param  \RedisCachePro\Connections\PhpRedisConnection[]  $replicas
     * @param  \RedisCachePro\Configuration\Configuration  $config
     */
    public function __construct(PhpRedisConnection $master, array $replicas, Configuration $config)
    {
        $this->master = $master;
        $this->replicas = $replicas;
        $this->config = $config;

        $this->log = $this->config->logger;

        if (empty($this->replicas)) {
            $this->discoverReplicas();
        }

        $this->setPool();
    }

    /**
     * Discovers and connects to the replicas from the master's configuration.
     *
     * @return void
     */
    protected function discoverReplicas()
    {
        $info = $this->master->info('replication');

        if ($info['role'] !== 'master') {
            throw new ConnectionException("Replicated master is a {$info['role']}");
        }

        foreach ($info as $key => $value) {
            if (strpos((string) $key, 'slave') !== 0) {
                continue;
            }

            $replica = null;

            if (preg_match('/ip=(?P<host>.*),port=(?P<port>\d+)/', $value, $replica)) {
                $config = clone $this->config;
                $config->setHost($replica['host']);
                $config->setPort($replica['port']);

                $this->replicas[] = PhpRedisConnector::connectToInstance($config);
            }
        }
    }

    /**
     * Set the pool based on the config's `replication_strategy`.
     *
     * @return void
     */
    protected function setPool()
    {
        $strategy = $this->config->replication_strategy;

        if ($strategy === 'distribute') {
            $this->pool = array_merge([$this->master], $this->replicas);

            return;
        }

        if (empty($this->replicas)) {
            throw new ConnectionException(
                "No replicas configured/discovered for `{$strategy}` replication strategy"
            );
        }

        if ($strategy === 'distribute_replicas') {
            $this->pool = $this->replicas;
        }

        if ($strategy === 'concentrate') {
            $this->pool = [$this->replicas[array_rand($this->replicas)]];
        }
    }

    /**
     * Returns the master's node information.
     *
     * @return \RedisCachePro\Connections\PhpRedisConnection
     */
    public function master()
    {
        return $this->master;
    }

    /**
     * Returns the replica nodes information.
     *
     * @return \RedisCachePro\Connections\PhpRedisConnection[]
     */
    public function replicas()
    {
        return $this->replicas;
    }

    /**
     * Run a command against Redis.
     *
     * @param  string  $command
     * @param  array  $parameters
     * @return mixed
     */
    public function command(string $name, array $parameters = [])
    {
        $isReading = \in_array(\strtoupper($name), self::READ_COMMANDS);

        // send `alloptions` hash read requests to the master
        if ($isReading && $this->config->split_alloptions && \is_string($parameters[0] ?? null)) {
            $isReading = \strpos($parameters[0], 'options:alloptions:') === false;
        }

        return $isReading
            ? $this->pool[\array_rand($this->pool)]->command($name, $parameters)
            : $this->master->command($name, $parameters);
    }

    /**
     * Execute all `pipeline()` calls on master.
     *
     * @return object
     */
    public function pipeline()
    {
        return Transaction::pipeline($this->master);
    }

    /**
     * Hijack `multi()` calls to allow command logging.
     *
     * @param  int  $type
     * @return object
     */
    public function multi(int $type = null)
    {
        return $type === $this->master::PIPELINE
            ? Transaction::multi($this->master)
            : Transaction::pipeline($this->master);
    }

    /**
     * Send `scan()` calls to random node from pool.
     *
     * @param  int|null  $iterator
     * @param  string|null  $pattern
     * @param  int  $count
     * @return array|false
     */
    public function scan(?int &$iterator, ?string $pattern = null, int $count = 0) // phpcs:ignore PHPCompatibility
    {
        return $this->pool[array_rand($this->pool)]->scan($iterator, $pattern, $count);
    }

    /**
     * Flush the selected Redis database.
     *
     * Set the connections client to the master and calls `PhpRedisConnection::flushdb()`.
     *
     * @param  bool|null  $async
     * @return true
     */
    public function flushdb($async = null)
    {
        $this->client = $this->master;

        return parent::flushdb($async);
    }
}
