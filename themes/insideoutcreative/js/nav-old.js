let menuHeight = document.querySelector('ul#menu-main-menu');
let navMenu = document.querySelector('#navItems');
let navOpen = document.querySelector('#navToggle');
let navClose = document.querySelector('#navClose');
let overlay = document.querySelector('#body-overlay');
let menuCol1 = document.querySelector('#menuCol1');
let menuCol2 = document.querySelector('#menuCol2');
let nav = document.querySelector('.nav');

// window.onscroll = function (e) {
//   console.log(window.scrollY); // Value of scroll Y in px

//   nav.setAttribute('style','position:fixed!important;');
// };

let body = document.querySelector('body');

// START OF NEW MENU

let openSubMenuLink = document.querySelectorAll('.open-submenu');

for (i = 0; i < openSubMenuLink.length; i++){
  openSubMenuLink[i].addEventListener('click',openSubMenu);
}


let closeSubMenuLink = document.querySelectorAll('.close-submenu');

for (i = 0; i < closeSubMenuLink.length; i++){
  closeSubMenuLink[i].addEventListener('click',closeSubMenu);
}

// Arrow function that opens next element sibling
let openNextSibling = (elem) =>{

  elem.nextElementSibling.classList.add('activate-sub');
  elemChildRow=elem.nextElementSibling.querySelector('.row');
  console.log(elemChildRow);
  console.log(elem.parentNode);
  elem.parentNode.classList.add('parent-activate');

  setTimeout(function(){
    elem.nextElementSibling.setAttribute('style','height:' + elemChildRow.offsetHeight + 'px;');
  }, 500);

}

// Arrow function that closes next element sibling
let closeNextSibling = (elem) =>{

  elem.parentNode.querySelector('.sub-menu').classList.remove('activate-sub');
  elemChildRow=elem.nextElementSibling.querySelector('.row');
  console.log(elemChildRow);
  console.log(elem.parentNode);
  // if(elem.parentNode.classList.contains('parent-activate')){
    elem.parentNode.classList.remove('parent-activate');
  // }

  setTimeout(function(){
    elem.parentNode.querySelector('.sub-menu').setAttribute('style','height:0px;');
  }, 500);

}

function openSubMenu(){

  let subMenu = document.querySelectorAll('.sub-menu');
    for (i = 0; i < subMenu.length; i++){
      subMenu[i].classList.remove('activate-sub');
      subMenu[i].parentNode.classList.remove('parent-activate');
    }
    openNextSibling(this);
    
    // body.classList.add('active-body');

}

function closeSubMenu(){
    closeNextSibling(this);

    // body.classList.remove('active-body');
}

// END OF NEW MENU

// opens dropdown
navOpen.addEventListener('click',function(){

navMenu.classList.add('open');
overlay.classList.add('activate');

setTimeout(function(){
  navOpen.classList.add('close-nav');
}, 100);

body.classList.add('active-body');

if(navOpen.classList.contains('close-nav')){

  activeSubMenu = document.querySelector('.activate-sub');
  if( activeSubMenu != null ){
    activeSubMenu.classList.remove('activate-sub');
  }

  setTimeout(function(){
    navOpen.classList.remove('close-nav');
  }, 100);

  setTimeout(function(){
  activeMenuRow = document.querySelector('.parent-activate');
  activeMenuRow.classList.remove('parent-activate');
  }, 200);

  setTimeout(function(){
    closeMenuCol1();
  }, 400);
  setTimeout(function(){
    navMenu.classList.remove('open');
  }, 600);


}

if(!navOpen.classList.contains('close-nav')){
openMenuCol1();

// openMenuCol2();

for (i = 0; i < openSubMenuLink.length; i++){

  setTimeout(function(){
  openSubMenuLink[0].nextElementSibling.classList.add('activate-sub');
  openSubMenuLink[0].parentNode.classList.add('parent-activate');
  firstOpenMenu = openSubMenuLink[0].nextElementSibling.querySelector('.row');
  }, 750);

  setTimeout(function(){
    openSubMenuLink[0].nextElementSibling.setAttribute('style','height:' + firstOpenMenu.offsetHeight + 'px;');
  }, 1000);
  
}

}

});


// closes dropdown with Escape Key
document.onkeydown = function(evt) {
    evt = evt || window.event;
    if (evt.keyCode == 27) {
        navMenu.classList.remove('activate');
        navMenu.classList.add('closed');
        
        body.classList.remove('nav-open');
        closeMenuCol1();
        closeMenuCol2();
    }
};

function openMenuCol1() {
    setTimeout(function(){ 
        menuCol1.classList.add('activate');
    }, 200);
  }
function closeMenuCol1() {
    setTimeout(function(){ 
        menuCol1.classList.remove('activate');
    }, 400);
  }

function openMenuCol2() {
    setTimeout(function(){ 
        // activateSub.classList.remove('activate-sub');
        // menuCol2.classList.add('activate');
    }, 400);
  }
function closeMenuCol2() {
    setTimeout(function(){ 
      let activateSub = document.querySelectorAll('.activate-sub');
      let parentActive = document.querySelectorAll('.parent-activate');
      for (i = 0; i < activateSub.length; i++) {
        activateSub[i].classList.remove('activate-sub');
        activateSub[i].style.height='0px';
      }
      for (i = 0; i < parentActive.length; i++) {
        parentActive[i].classList.remove('parent-activate');
      }

    }, 200);
  }
function removeOverlay() {
    setTimeout(function(){ 
        overlay.classList.remove('activate');
    }, 700);
  }

// for inner menus
// let title = document.querySelectorAll('ul.menu > li.menu-item-has-children > ul.sub-menu > li.menu-item-has-children');
// let arrow = document.createElement("i");
// arrow.className = "fa fa-chevron-right open-sub-menu";

// $(title).append(arrow);

// let dropdownArrows = document.querySelectorAll('ul.menu > li.menu-item-has-children > ul.sub-menu > li.menu-item-has-children .open-sub-menu');

// $(dropdownArrows).on( "click", function() {
//     $(this).parent().toggleClass('activate');
//     $(this).parent().siblings().removeClass('activate');
//   });

//   $(document).ready(function() {
//     $('ul.menu > li.menu-item-has-children > ul.sub-menu > li.current_page_item').addClass('activate');
//     $('ul.menu > li.menu-item-has-children > ul.sub-menu > li.current-page-ancestor').addClass('activate');
//     });

