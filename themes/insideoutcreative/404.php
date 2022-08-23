<?php get_header(); ?>
<style>
    .error404 section.hero {
    display: none;
}
</style>
<section class="pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
            <h1>Whoops... 404 Page Not Found</h1>
            <p>We couldn't find the page you're looking for. The page may have been moved or deleted. Please double-check the URL or go back to the homepage.</p>
            <a href="<?php echo home_url(); ?>" class="btn btn-primary mt-5 mb-3 bg-accent br-0 b-0">Go back home</a>
<h2 class="mb-3" style="-webkit-text-stroke: 2px rgba(0, 0, 0, .5);">Or</h2>
<?php get_search_form(); ?>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>