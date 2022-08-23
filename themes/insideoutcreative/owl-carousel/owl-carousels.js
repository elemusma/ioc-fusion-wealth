$('.work-gallery').owlCarousel({
    // center: true,
    loop:true,
    margin:0,
    dots:true,
    nav:true,
    items:1,
    navText : ["<img src='/wp-content/uploads/2021/07/Arrow-Left-Blair-ITC.png' />","<img src='/wp-content/uploads/2021/07/Arrow-Right-Blair-ITC.png' />"],
    autoplay:true,
    autoplayTimeout:5000,
    autoplayHoverPause:false
})
$('.design-carousel').owlCarousel({
    // center: true,
    loop:false,
    margin:0,
    dots:true,
    nav:true,
    items:1,
    // navText : ["<img src='/wp-content/uploads/2021/07/Arrow-Left-Blair-ITC.png' />","<img src='/wp-content/uploads/2021/07/Arrow-Right-Blair-ITC.png' />"]
})
$('.build-child-carousel').owlCarousel({
    // center: true,
    loop:false,
    margin:0,
    dots:true,
    nav:true,
    items:4,
})
$('.build-parent-carousel').owlCarousel({
    // center: true,
    loop:false,
    margin:10,
    dots:true,
    nav:true,
    items:1,
});

$('.expertise-carousel').owlCarousel({
    // center: true,
    loop:true,
    margin:10,
    dots:false,
    nav:false,
    items:1,
    autoplay:true,
    autoplayTimeout:1000,
    autoplayHoverPause:false,
});

$('.testimonials-carousel').owlCarousel({
    // center: true,
    loop:false,
    margin:10,
    nav:true,
    dots:false,
    // autoplay:true,
    // autoplayTimeout:2500,
    // autoplayHoverPause:false,
    navText : ["<img src='/wp-content/uploads/2021/10/Arrow-Left.png' />","<img src='/wp-content/uploads/2021/10/Arrow-Right.png' />"],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
});

