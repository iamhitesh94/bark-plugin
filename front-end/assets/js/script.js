
function LoadReadyResize()
{
	'use strict';

}


/*=============================================================================================*/
/* Load Function START Here*/
jQuery(window).on("load",function() {
	'use strict';
		
});
/* Load Function END Here*/
/*=============================================================================================*/

/*=============================================================================================*/
/* Ready Function START Here*/
jQuery(document).ready(function() {
	'use strict';
	
	/* Loadready Function */
	LoadReadyResize();
	/* Loadready Function */
	
	/* Nice select Function */
	jQuery('.cus_select').niceSelect();
	/* Nice selcet Function */		
	
	/*=====================================*/
	/* Homepage Latest Media Slider : Start */
	jQuery('.strooisel_slider').owlCarousel({
		loop:false,
		margin:0,
		nav:true,
		dots:false,
		smartSpeed: 1200,
		autoplay:false,
		autoplayTimeout: 4000,
		mouseDrag: false,
		//dotsContainer: '.owl-thumbs',
		responsive:{
			0:{
				items:1
			},
			600:{
				items:1
			},
			1000:{
				items:1
			}
		}
	});
	jQuery('.owl-thumbs .owl-dot').on('click', function() {
		//e.preventDefault();
		jQuery('.owl-thumbs .owl-dot').removeClass('active');
		jQuery(this).addClass('active');
		jQuery('.strooisel_slider').trigger('to.owl.carousel', [jQuery(this).index(), 700]);
	});		
	/* Homepage Latest Media Slider : End */
	/*=====================================*/	
	
	/*|| Menu js ST ||*/	
	jQuery(".ham_menubtn a").on("click",function(e) {
		e.preventDefault();
		jQuery(this).toggleClass("active");
		jQuery("body").toggleClass("show_menu");
		jQuery("body").toggleClass("scrolldesable");
	});	
	/*|| Menu js ED ||*/

	/*|| Custom Accordion ST ||*/
	jQuery(".w3naccordion h6").on("click",function(e) {
		e.preventDefault();
		jQuery(this).toggleClass("active");
		jQuery(e.target).next("div").siblings("div").slideUp("fast");
		jQuery(e.target).next("div").slideToggle("fast");
	});	
	/*|| Custom Accordion ED ||*/	
	
});
/* Ready Function END Here*/
/*=============================================================================================*/


/*=============================================================================================*/
/* Resize Function START Here*/
jQuery(window).resize(function() {
	'use strict';
	
	LoadReadyResize();
	
});
/* Resize Function END Here*/
/*=============================================================================================*/
