/**
 * Flexslider
 *
*/

jQuery(document).ready(function($){
	jQuery('.flexslider').flexslider({
		animation: "fade",
		touch:true,
		animationDuration: 6000,
		directionNav: true,
		controlNav: false
	});	
	
	jQuery('#postgalleryslider').flexslider({
		animation: "fade",
		touch:true,
		animationDuration: 6000,
		directionNav: true,
		controlNav: false
	});
});

	
/**
 * Toggle
 *
*/

jQuery(document).ready(function($){


		jQuery(".npt-toggle_container:not('.active')").hide();
		jQuery("#npt-toggleMenu").click(function(){
		jQuery(this).toggleClass("active").next().slideToggle("normal");
		
        return false;
     });	
});


/**
 * Pretty Photo Script
 *
*/

jQuery(document).ready(function(){
	runprettyPhoto();
});

function runprettyPhoto(){
	//=================================== PRETTYPHOTO ===================================//
	jQuery('a[data-gal]').each(function() {jQuery(this).attr('data-gal', jQuery(this).data('data-gal'));});
	jQuery("a[data-gal^='prettyPhoto']").prettyPhoto({
		animationSpeed:'slow',
		theme:'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
		gallery_markup:'',
		social_tools: false,
		slideshow:2000
	});
}


/**
 * BUTTON HOVER
 *
 */
 
jQuery( document ).ready(function( $ ){
$(window).load(function() {
	
	// Plugin default options
    $.fn.directionalHover.defaults = {
        overlay: "npt-btn-overlay",
        easing: "swing",
        speed: 300
    };
	
	$('.npt-btn').directionalHover();
});
});

/**
 * HEADER Scripts
 *
 */
jQuery(function( $ ){
	$(document).ready(stickywidthfunction);
	$(window).on('resize',stickywidthfunction);
	
	function stickywidthfunction() {
		var mediaWidth = $('#npt-page-holder').width();
		$('#npt-outerheader').css({ 'width': mediaWidth+'px' });
		$('#npt-header-navigation .mega-menu').css({ 'display': 'none' });
	}
});

jQuery(function( $ ){
	var $npt_top_menu = $('#npt-header-navigation');
	$npt_top_menu.find('ul ul').each(function() {
		var $this = $(this);

		$this.css('left', $this.width() * -.5);
	});
	
	var $npt_top_menu2 = $('.npt-header-menu2 #npt-header-navigation');
	$npt_top_menu2.find('ul ul').each(function() {
		var $this = $(this);

		$this.css('left', $this.width() * -.5);
	});
});

jQuery(function($){
	jQuery("#npt-hb-search:not('.active')").hide();
	
	jQuery("#npt-header-search").click(function(){
		jQuery(this).toggleClass("active").next().slideToggle("normal");
	return false;
	});	
});

jQuery(function($){
	jQuery("#npt-hb-cart:not('.active')").hide();
	
	jQuery("#npt-header-cart").click(function(){
		jQuery(this).toggleClass("active").next().slideToggle("normal");
	return false;
	});	
});

/**
 * Featured Posts Scripts
 *
 */

jQuery(function( $ ){
	$(document).ready(nptfwfunction);
	$(window).on('resize',nptfwfunction);
	
	function nptfwfunction() {
		var mediaWidth = $('#npt-page-holder').width();
		
		$('.npt-fullwidth').css({ 'width': mediaWidth+'px' });
	}
});

jQuery(document).ready(function($){
	$(document).ready(function() {
	  var owl = $(".npt-cta-fp");
	
	  owl.owlCarousel({
		  
	  navigation : true, // Show next and prev buttons
	  navigationText : ['<i class="fa fa-chevron-left"></i>','<i class="fa fa-chevron-right"></i>'],
	  pagination : true,
	
	  items : 3, 
	  itemsDesktop : [5000,3], 
	  itemsDesktop : [1170,3],
	  itemsDesktopSmall : [900,3], 
	  itemsTablet: [767,1], 
	  itemsMobile : [400,1],
	  autoPlay : false,	
	  });
	});
});