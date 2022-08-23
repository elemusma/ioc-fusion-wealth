// console.log('4');
btnWatchVideo=document.querySelector('.btn-watch-video');
btnWatchVideoURL=btnWatchVideo.getAttribute('data-target')
btnWatchVideoModal=document.querySelector('.modal-watch-video');
btnWatchVideoModalContent=document.querySelector('.modal-watch-video-content');
btnWatchVideoModalClose=btnWatchVideoModal.querySelector('#closeModal');
if(btnWatchVideoURL=='#'){
btnWatchVideo.addEventListener('click',showModal);
btnWatchVideoModalClose.addEventListener('click',closeModal);
}

function showModal(){
    btnWatchVideoModal.classList.add('activate');
    setTimeout(function(){ 
        btnWatchVideoModalContent.style.opacity="1";
      }, 500);
}
function closeModal(){
    setTimeout(function(){ 
        btnWatchVideoModal.classList.remove('activate');
    }, 500);
    btnWatchVideoModalContent.style.opacity="0";
}
