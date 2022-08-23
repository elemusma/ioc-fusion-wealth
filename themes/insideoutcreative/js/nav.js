let logoMain = document.querySelector('#logo-main');
let logoFavicon = document.querySelector('#logo-favicon');


let navigation = document.querySelector('.nav');
let navigationHeight = navigation.offsetHeight;
let blankSpace = document.querySelector('.blank-space-before-header');
let opt = true;

window.onscroll = function (e) {
    navigation.setAttribute('style','position:fixed;top:0;z-index:10;')
    blankSpace.style.height = navigationHeight + "px";

    

    if(window.scrollY > 290){
      logoFavicon.classList.remove('inactive');
      logoFavicon.classList.add('active');
      logoMain.classList.add('inactive');
      logoMain.classList.remove('active');
    }


    if(window.scrollY < 300){
      logoFavicon.classList.add('inactive');
      logoFavicon.classList.remove('active');
      logoMain.classList.add('active');
      logoMain.classList.remove('inactive');
    }


};

let menuHeight = document.querySelector('ul#menu-main-menu');
let navMenu = document.querySelector('#navItems');
let navOpen = document.querySelector('#navToggle');
let navClose = document.querySelector('#navClose');
let overlay = document.querySelector('#body-overlay');
let menuCol1 = document.querySelector('#menuCol1');
let menuCol2 = document.querySelector('#menuCol2');
let menuCol1Inner = document.querySelector('#menuCol1Inner');

// make columns the same height, not sure why the second one has padding
// menuCol1Inner.style.height = (menuCol2.offsetHeight - 15) + "px";

let body = document.querySelector('body');

// opens dropdown
navOpen.addEventListener('click',function(){
overlay.classList.add('activate');
navMenu.classList.remove('closed');
navMenu.classList.add('activate');
body.classList.add('nav-open');
openMenuCol1();
openMenuCol2();
});

// closes dropdown with X
navClose.addEventListener('click', function(){
navMenu.classList.remove('activate');
navMenu.classList.add('closed');

body.classList.remove('nav-open');
closeMenuCol1();
closeMenuCol2();
removeOverlay();
});
// closes dropdown with bodyOverlay
overlay.addEventListener('click', function(){
navMenu.classList.remove('activate');
navMenu.classList.add('closed');

body.classList.remove('nav-open');
closeMenuCol1();
closeMenuCol2();
removeOverlay();
});
// closes dropdown with Escape Key
document.onkeydown = function(evt) {
    evt = evt || window.event;
    if (evt.keyCode == 27) {
        // alert('Esc key pressed.');
        navMenu.classList.remove('activate');
        navMenu.classList.add('closed');
        
        body.classList.remove('nav-open');
        closeMenuCol1();
        closeMenuCol2();
        removeOverlay();
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
        menuCol2.classList.add('activate');
    }, 400);
  }
function closeMenuCol2() {
    setTimeout(function(){ 
        menuCol2.classList.remove('activate');
    }, 200);
  }
function removeOverlay() {
    setTimeout(function(){ 
        overlay.classList.remove('activate');
    }, 700);
  }

// for inner menus
let title = document.querySelectorAll('ul.menu > li.menu-item-has-children > ul.sub-menu > li.menu-item-has-children');
let arrow = document.createElement("i");
arrow.className = "fa fa-chevron-right open-sub-menu";

$(title).append(arrow);

let dropdownArrows = document.querySelectorAll('ul.menu > li.menu-item-has-children > ul.sub-menu > li.menu-item-has-children .open-sub-menu');

$(dropdownArrows).on( "click", function() {
    $(this).parent().toggleClass('activate');
    $(this).parent().siblings().removeClass('activate');
  });

  $(document).ready(function() {
    $('ul.menu > li.menu-item-has-children > ul.sub-menu > li.current_page_item').addClass('activate');
    $('ul.menu > li.menu-item-has-children > ul.sub-menu > li.current-page-ancestor').addClass('activate');
    });


colDropdownMenuImages = document.querySelectorAll('.col-dropdown-menu-images');

for ( i = 0; i < colDropdownMenuImages.length; i++ ){
  colDropdownMenuImages[i].addEventListener('mouseover', activeCol);
  colDropdownMenuImages[i].addEventListener('mouseout', deactiveCol);

  function activeCol() {
    activate(this);
  }
  function deactiveCol() {
    deactivate(this);
  }
}
let activate = (elem) => {
  elem.classList.add('activate');
}
let deactivate = (elem) => {
  elem.classList.remove('activate');
}

menuItems = document.querySelectorAll('.menu-main-menu-container .sub-menu .menu-item a');

for ( i = 0; i < menuItems.length; i++ ){
  console.log(menuItems[i]);

  menuItems[i].addEventListener('mouseover',activeCol);
  menuItems[i].addEventListener('mouseout',deactiveCol);

  function activeCol() {
    activateLi(this);
    console.log('mouseover');
  }
  function deactiveCol() {
    deactivateLi(this);
    console.log('mouseout');
  }
}

let activateLi = (elem) => {
  // elem.classList.add('activate');
  elemClass = elem.parentNode.classList[0];
  elemCol = document.querySelector('#section-' + elemClass);
  elemCol.classList.add('activate');
}
let deactivateLi = (elem) => {
  // elem.classList.remove('activate');
  elemClass = elem.parentNode.classList[0];
  elemCol = document.querySelector('#section-' + elemClass);
  elemCol.classList.remove('activate');
}

// if(navMenu.classList.contains('activate')){
// navMenu.style.height = menuHeight.offsetHeight+"px";
// } else {
// navMenu.style.height = "0px";
// }


// let menuItemHasChildren = document.querySelectorAll('.menu-item-has-children');
// for (let i = 0; i < menuItemHasChildren.length; ++i){

// // `element` is the element you want to wrap
// let subMenu = document.querySelectorAll('.sub-menu');
// for (let i = 0; i < subMenu.length; ++i){
// var parent = subMenu[i].parentNode;
// var wrapper = document.createElement('div');
// wrapper.className += "sub-menu-parent";

// // set the wrapper as child (instead of the element)
// parent.replaceChild(wrapper, subMenu[i]);
// // set element as child of wrapper
// wrapper.appendChild(subMenu[i]);

// // submenu is in position absolute on load so it doesnt show when website loads but then changes to position relative for dropdown navigation to function properly
// subMenu[i].style.position="relative";

// menuItemHasChildren[i].addEventListener("mouseover", function(){
// this.classList.add('open');
// // this.querySelector('.sub-menu-parent .sub-menu-parent').style.background = "red";
// let subMenuHeight = this.querySelector('.sub-menu-parent .sub-menu-parent .sub-menu');
// this.querySelector('.sub-menu-parent .sub-menu-parent').style.height = subMenuHeight.offsetHeight+"px";
// });
// menuItemHasChildren[i].addEventListener("mouseout", function(){
// this.classList.remove('open');
// this.querySelector('.sub-menu-parent .sub-menu-parent').style.height = "0px";
// });

// }
// }