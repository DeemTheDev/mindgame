(function($){

	'use strict';
    
	
	//SMOOTH SCROLL
	$("#nav ul li a[href*='#']").click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') 
			|| location.hostname == this.hostname) {
				
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			   if (target.length) {
				 $('html,body').animate({
					 scrollTop: target.offset().top 
				}, 1000);
				return false;
			}
		}
	});
	
	//AUTOCOLLAPSE MOBILE MENU
	$(".navbar-nav li a").click(function(event) {
    $(".navbar-collapse").collapse('hide');
  	})
	
	
	//NAVBAR ANIMATION
    var menu = $('.navbar-custom'),
        pos = menu.offset();
    $(window).scroll(function() {
        if ($(this).scrollTop() > pos.top + menu.height() && menu.hasClass('default') && $(this).scrollTop() > 300) {
            menu.fadeOut('fast', function() {
                $(this).removeClass('default').addClass('navbar-fixed-top').fadeIn('fast');
            });
        } else if ($(this).scrollTop() <= pos.top + 300 && menu.hasClass('navbar-fixed-top')) {
            menu.fadeOut(0, function() {
                $(this).removeClass('navbar-fixed-top').addClass('default').fadeIn(0);
            });
        }
    });
    $('.offset').css('padding-top', $('.navbar-custom').height() + 'px');
    $(window).resize(function() {
	    $('.offset').css('padding-top', $('.navbar-custom').height() + 'px');
	});
   
 
	//MAGNIFIC POPUP IMAGE
	$('.image-popup').magnificPopup({
		type:'image',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		
	});
	
	  
	
	//NEWS CAROUSEL
	var owl = $("#news-carousel");
 
	  owl.owlCarousel({
		  slideSpeed : 300,
		  paginationSpeed : 400,
		  singleItem:false,
		  itemsCustom : [ [0, 1], [450, 1], [600, 2], [700, 3], [1000, 4], [1200, 4], [1600, 4] ],
		  pagination : true,
		  navigation : false,
		 // navigationText : ['<i class="pe pe-4x pe-7s-angle-left pe-border"></i>','<i class="pe pe-5x  pe-7s-angle-right pe-border"></i>'],
		  transitionStyle : "slide"
	  });
	  
	  
	//TESTIMONIALS CAROUSEL
	var owl = $("#testimonial-carousel");
 
	  owl.owlCarousel({
		  navigation : false, // Show next and prev buttons
		  pagination:true,
		  slideSpeed : 300,
		  paginationSpeed : 400,
		  singleItem:true,
		  autoPlay:true,
		 // itemsCustom : [ [0, 1], [450, 1], [600, 3], [700, 3], [1000, 3], [1200, 3], [1600, 3] ],
		 // transitionStyle : "slide"
	  });
	
	
	// FUNFACTS
	 $('.nmbr').counterUp({
		delay: 10,
		time: 3000
	});
	
	
	//FIX HOVER EFFECT ON IOS DEVICES
	document.addEventListener("touchstart", function(){}, true);
	

}( jQuery ));


	(function($){

		'use strict';
	
		$(window).load(function(){
			
		
		//PRELOADER
		$('#preload').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.

	});

}( jQuery ));


