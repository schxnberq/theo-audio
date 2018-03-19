(function($) { 'use strict';

	// Calculate clients viewport
	function viewport() {
		var e = window, a = 'inner';
		if(!('innerWidth' in window )) {
			a = 'client';
			e = document.documentElement || document.body;
		}
		return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
	}

	// Strech center aligned images

	var centerAlignedImages = function () {

		viewport();
		var w=window,d=document,
		e=d.documentElement,
		g=d.getElementsByTagName('body')[0],
		x=w.innerWidth||e.clientWidth||g.clientWidth, // Viewport Width
		y=w.innerHeight||e.clientHeight||g.clientHeight; // Viewport Height

		var body = $('body');


		if(body.hasClass('single') || body.hasClass('page')){

			var centerAlignImg = $('.content-area img.aligncenter, .content-area figure.aligncenter');

			if(centerAlignImg.length){
				centerAlignImg.each(function(){
					var $this = $(this);

					var entryContentWidth = $('.entry-content').width();
					var centerAlignImgWidth = $this.width();
					if (centerAlignImgWidth >= 900) {
						centerAlignImgWidth = 900;
					}

					if( x > 1020 ){
						if(centerAlignImgWidth >= entryContentWidth){
							if (body.hasClass('rtl')) {
								$this.css({'margin-right': -((centerAlignImgWidth - entryContentWidth) / 2)});
							} else {
								$this.css({'margin-left': -((centerAlignImgWidth - entryContentWidth) / 2)});
							}
						}
					}
					else{
						$this.css({marginLeft: ''});
					}
				});
			}
		};
	};

	var pageHasFeaturedSlider = $('.featured-slider').length;
	if (pageHasFeaturedSlider) {
		var featuredSlider = $('.featured-slider'),
			featuredSliderHeight = featuredSlider.outerHeight(),
			wScrollTop = 0;
	}

	var featuredSliderHide = function () {
		setTimeout(function(){
			wScrollTop = $(window).scrollTop();

			if (!$('body').hasClass('fullwidth-slider')) {

				if(wScrollTop > 0){
					featuredSlider.css({opacity: (featuredSliderHeight - wScrollTop) / featuredSliderHeight});
				} else {
					featuredSlider.css({opacity: 1});
				}
			} else {
				if(wScrollTop > 0){
					$('.featured-slider .entry-text, .slick-dots').css({opacity: (featuredSliderHeight - wScrollTop) / featuredSliderHeight});
				} else {
					$('.featured-slider .entry-text, .slick-dots').css({opacity: 1});
				}
			}
		}, 200);
	};

	$(document).ready(function($){

		// Calculate clients viewport
		function viewport() {
			var e = window, a = 'inner';
			if(!('innerWidth' in window )) {
				a = 'client';
				e = document.documentElement || document.body;
			}
			return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
		}

		var w=window,d=document,
		e=d.documentElement,
		g=d.getElementsByTagName('body')[0],
		x=w.innerWidth||e.clientWidth||g.clientWidth, // Viewport Width
		y=w.innerHeight||e.clientHeight||g.clientHeight; // Viewport Height

		// Global Vars

		var body = $('body'),
			mainContent = $('#content'),
			toTopArrow = $('.back-to-top');

		// disable body scroll

		// use $("html,body").enableScroll(); and $("html,body").disableScroll();

		$.fn.disableScroll = function() {
			window.oldScrollPos = $(window).scrollTop();

			$(window).on('scroll.scrolldisabler',function ( event ) {
			   $(window).scrollTop( window.oldScrollPos );
			   event.preventDefault();
			});
		};

		$.fn.enableScroll = function() {
			$(window).off('scroll.scrolldisabler');
		};

		// Outline none on mousedown for focused elements

		body.on('mousedown', '*', function(e) {
			if(($(this).is(':focus') || $(this).is(e.target)) && $(this).css('outline-style') == 'none') {
				$(this).css('outline', 'none').on('blur', function() {
					$(this).off('blur').css('outline', '');
				});
			}
		});

		// Disable search submit if input empty
		$( '.search-submit' ).prop( 'disabled', true );
		$( '.search-field' ).keyup( function() {
			$('.search-submit').prop( 'disabled', this.value === "" ? true : false );
		});

		// Dropcaps

		if(body.hasClass('single') || body.hasClass('page')){

			var dropcap = $('span.dropcap');
			if(dropcap.length){
				dropcap.each(function(){
					var $this = $(this);
					$this.attr('data-dropcap', $this.text());
					$this.parent().css({
						"position" : "relative",
						"z-index" : 0
					});
				});
			}
		};

		// dropdown button

		var menuDropdownLink = $('.main-navigation .menu-item-has-children>a, .main-navigation .page_item_has_children>a');

		var dropDownArrow = $('<button class="dropdown-toggle"><span class="screen-reader-text">toggle child menu</span><i class="icon-down"></i></button>');

		menuDropdownLink.after(dropDownArrow);


		// dropdown open on click

		var dropDownButton = $('button.dropdown-toggle');

		dropDownButton.on('click', function(e){
			e.preventDefault();
			var $this = $(this);
			$this.parent('li').toggleClass('toggle-on').find('.toggle-on').removeClass('toggle-on');
			$this.parent('li').siblings().removeClass('toggle-on');
		});

		$('.main-navigation .menu').on('mouseleave', function () {
			$(this).find('.toggle-on').removeClass('toggle-on');
		})


		// Slider

		var slider;
		var direction;

		if(body.hasClass('rtl')){
			direction = true;
		}
		else{
			direction = false;
		}

		slider = $('.featured-slider');

		slider.slick({
			slide: 'article',
			infinite: true,
			fade: true,
			dots: true,
			arrows: false,
			speed: 300,
			centerMode: false,
			draggable: true,
			touchThreshold: 20,
			slidesToShow: 1,
			cssEase: 'cubic-bezier(0.28, 0.12, 0.22, 1)',
			rtl: direction,
		});

		// show slider after init
		setTimeout(function(){
			slider.css({opacity: 1});
		}, 1000);

		// put img in background of parent div

		var slides = $('.featured-slider article');

		slides.each(function(){
			var featuredImg = $(this).find('img');
			if(featuredImg.length){
				var slideImgSrc = featuredImg.attr('src');
				featuredImg.css('display','none').wrap('<div class="image"></div>');
				$(this).find('.image').css({backgroundImage: 'url('+slideImgSrc+')'});
			}
		});


		// On Infinite Scroll Load

		var $container = $('.row');


		$(document.body).on('post-load', function(){
			// Reactivate masonry on post load
			var newEl = $container.children().not('article.post-loaded, span.infinite-loader, div.grid-sizer').addClass('post-loaded');

			if ($container.hasClass('masonry')) {
				newEl.imagesLoaded(function () {

					// Reactivate masonry on post load

					$container.masonry('appended', newEl, true).masonry('layout');

					setTimeout(function(){
						newEl.each(function(i){
							var $this = $(this);

							if($this.find('iframe').length){
								var $iframe = $this.find('iframe');
								var $iframeSrc = $iframe.attr('src');

								$iframe.load($iframeSrc, function(){
									$container.masonry('layout');
								});
							}

							setTimeout(function(){
								newEl.eq(i).addClass('animate');
							}, 150 * (i+1));
						});
					}, 100);
				// Checkbox and Radio buttons

				radio_checkbox_animation();

				});
			} else {
				setTimeout(function(){
					newEl.each(function(i){

						setTimeout(function(){
							newEl.eq(i).addClass('animate');
						}, 100 * (i+1));
					});
				}, 150);

				radio_checkbox_animation();
			}
		});


		// Forms

		var smallInput = $('.contact-form input[type="text"], .contact-form input[type="email"], .contact-form input[type="url"], .comment-form input[type="text"], .comment-form input[type="email"], .comment-form input[type="url"]');
		smallInput.parent().addClass('small-input');

		// Checkbox and Radio buttons

		//if buttons are inside label
		function radio_checkbox_animation() {
			var checkBtn = $('label').find('input[type="checkbox"]');
			var checkLabel = checkBtn.parent('label');
			var radioBtn = $('label').find('input[type="radio"]');

			checkLabel.addClass('checkbox');

			checkLabel.click(function(){
				var $this = $(this);
				if($this.find('input').is(':checked')){
					$this.addClass('checked');
				}
				else{
					$this.removeClass('checked');
				}
			});

			var checkBtnAfter = $('label + input[type="checkbox"]');
			var checkLabelBefore = checkBtnAfter.prev('label');

			checkLabelBefore.click(function(){
				var $this = $(this);
				$this.toggleClass('checked');
			});

			radioBtn.change(function(){
				var $this = $(this);
				if($this.is(':checked')){
					$this.parent('label').siblings().removeClass('checked');
					$this.parent('label').addClass('checked');
				}
				else{
					$this.parent('label').removeClass('checked');
				}
			});
		}

		radio_checkbox_animation();

		// Sharedaddy

		function shareDaddy(){
			var shareTitle = $('.sd-sharing .sd-title');

			if(shareTitle.length){
				var shareWrap = shareTitle.closest('.sd-sharing-enabled');
				shareWrap.attr({'tabindex': '0'});
				shareTitle.on('click touchend', function(){
					$(this).closest('.sd-sharing-enabled').toggleClass('sd-open');
				});

				$(document).keyup(function(e) {
					if(shareWrap.find('a').is(':focus') && e.keyCode == 9){
						shareWrap.addClass('sd-open');
					}
					else if(!(shareWrap.find('a').is(':focus')) && e.keyCode == 9){
						shareWrap.removeClass('sd-open');
					}
				});
			}
		}

		shareDaddy();

		// Big search field

		var bigSearchWrap = $('.search-wrap');
		var bigSearchLabel = bigSearchWrap.find('label');
		var bigSearchField = bigSearchWrap.find('.search-field');
		var bigSearchSubmit = bigSearchWrap.find('.search-submit');

		// close sidemenu modal on ESC

		var toggleBigSearch = function() {
			if(bigSearchWrap.hasClass('focus')){
				bigSearchWrap.removeClass('focus');
				body.removeClass('big-search-open');
				setTimeout(function() {bigSearchField.blur();}, 50);
			} else {
				bigSearchWrap.addClass('focus');
				body.addClass('big-search-open');

				setTimeout(function() {bigSearchField.focus();}, 50);
			};
		}

		$('.overlay').on('touchend mouseup', function() {
			if ( body.hasClass('big-search-open')) {
				toggleBigSearch();
			}
			return false;
		});

		if (x > 1200) {
			bigSearchField.on('touchend click', function(e){
				e.stopPropagation();
				if(! bigSearchWrap.hasClass('focus')) {
					toggleBigSearch();
				}
			});

			$(document).on('focusout', bigSearchField , function(){
				bigSearchWrap.removeClass('focus');
				body.removeClass('big-search-open');
			});
		} else {
			bigSearchLabel.on('click', function(e) {
				e.stopPropagation();
				toggleBigSearch();
			});
		}

		// open / close sidebar

		var sidebarToggle = $('.sidebar-toggle');
		var delaySidebar = false;

		var toggleSidebar = function() {
			if(delaySidebar) return;  // check if last action complete

			delaySidebar = true;
			setTimeout(function(){delaySidebar = false},500);


			if(body.hasClass('sidebar-open')){
				body.removeClass('sidebar-open');
				$("html,body").enableScroll();
				$("html,body").css('overflow','auto');
			} else {
				body.addClass('sidebar-open');
				$("html,body").disableScroll();
				$("html,body").css('overflow','hidden');

				if(body.hasClass('menu-open')){
					toggleMenu();
				}
			};
		}

		sidebarToggle.on('touchend click', function(e) {
			e.preventDefault();
			toggleSidebar();
		});

		$('.overlay').on('touchend click', function() {
			if (body.hasClass('sidebar-open')) {
				toggleSidebar();
			}
		});

		// open / close main nav

		var menuToggle = $('.menu-toggle');
		var delayMenu = false;

		var toggleMenu = function() {
			if(delayMenu) return;  // check if last action complete

			delayMenu = true;
			setTimeout(function(){delayMenu = false},500);


			if(body.hasClass('menu-open')){
				body.removeClass('menu-open');
				$('.sidebar-nav-holder').css({
					'top':'0',
					'-webkit-transition': '0s',
					'-moz-transition': '0s',
					'-ms-transition': '0s',
					'-o-transition': '0s',
					'transition': '0s'
				});
			} else {
				body.addClass('menu-open');
				var topOffset = parseInt($(document).scrollTop() , 10) - parseInt( $('.site-header').css('margin-top') , 10);
				$('.sidebar-nav-holder').css('top', topOffset - 80);
				$('.sidebar-nav-holder').css({
					'-webkit-transition': '.3s ease-out',
					'-moz-transition': '.3s ease-out',
					'-ms-transition': '.3s ease-out',
					'-o-transition': '.3s ease-out',
					'transition': '.3s ease-out'
				});
				setTimeout(function() {
					$('.sidebar-nav-holder').css('top', topOffset );
				}, 10);

			};
		}

		menuToggle.on('touchend click', function(e) {
			e.preventDefault();
			toggleMenu();
		});

		$('.overlay').on('touchend click', function() {
			if (body.hasClass('menu-open')) {
				toggleMenu();
			}
		});

		$(window).scroll(function(){

			if(body.hasClass('menu-open') && x > 1200){
				toggleMenu();
			};
		});

		// close sidemenu modal on ESC

		$(document).keyup(function(e) {
			if (e.keyCode == 27) {
				if(bigSearchWrap.hasClass('focus')) {
					toggleBigSearch();
				}
				if(body.hasClass('menu-open')){
					toggleMenu();
				}
			}
		});

		// left: 37, up: 38, right: 39, down: 40,
		// spacebar: 32, pageup: 33, pagedown: 34, end: 35, home: 36
		var keys = {37: 1, 38: 1, 39: 1, 40: 1, 32: 1, 33: 1, 34: 1, 35: 1, 36: 1};

		var preventDefault = function (e) {
			e = e || window.event;
				if (e.preventDefault)
					e.preventDefault();
				e.returnValue = false;
		};

		var preventDefaultForScrollKeys = function (e) {
			if (keys[e.keyCode]) {
				preventDefault(e);
				return false;
			}
		};

		// Back to top activation

		toTopArrow.on('click touchstart', function (e) {
			e.preventDefault();
			$('html, body').animate({scrollTop: 0}, 900);
			return false;
		});

		$(window).on("load resize scroll pageshow", function () {
			viewport();
			var w=window,d=document,
			e=d.documentElement,
			g=d.getElementsByTagName('body')[0],
			x=w.innerWidth||e.clientWidth||g.clientWidth;
			y=w.innerHeight||e.clientHeight||g.clientHeight;

			var $this = $(this);
			if($this.scrollTop() > 600) {
				toTopArrow.removeClass('hide');
			}
			else{
				toTopArrow.addClass('hide');
			}


			var menuToggle = $('.menu-toggle');
			if (!body.hasClass('fullwidth-slider')) {
				var hiddenHeight = 300;
			} else {
				var hiddenHeight = y;
			}
			if (x > 1200 && $this.scrollTop() < hiddenHeight) {
				menuToggle.addClass('hide');
			} else {
				menuToggle.removeClass('hide');
			};
		});

		// move category filter on mobile
		if ( x<1200 && $('.category-filter').length ) {
			$('.row').before($('.category-filter'));
		}

		// Reposition entry footer on single posts to go above related block

		var relatedBlock = $('.jp-relatedposts');

		if(body.hasClass('single') && relatedBlock.length){
			var entryFooter = relatedBlock.siblings('footer.end-meta');
			relatedBlock.before(entryFooter);
		};  // .com only


		// Early Preloader
		var earlyPreload = function() {
			$('body').addClass('early-show');
		};

		earlyPreload();

	}); // End Ready

	$(window).on('load pageshow', function(){

		// Calculate clients viewport
		function viewport() {
			var e = window, a = 'inner';
			if(!('innerWidth' in window )) {
				a = 'client';
				e = document.documentElement || document.body;
			}
			return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
		}

		var w=window,d=document,
		e=d.documentElement,
		g=d.getElementsByTagName('body')[0],
		x=w.innerWidth||e.clientWidth||g.clientWidth, // Viewport Width
		y=w.innerHeight||e.clientHeight||g.clientHeight; // Viewport Height

		// Global Vars

		var body = $('body');

		// Masonry call

		var $container = $('.row');

		if ($container.length) {

			if ($container.hasClass('masonry')) {
				$container.imagesLoaded( function() {
					$container.masonry({
						itemSelector: 'article',
						transitionDuration: 0
					}).masonry('layout');

				});
			}

			var masonryChild = $container.find('article.hentry');


			if (pageHasFeaturedSlider && x > 1200) {

				if ( $(window).scrollTop() > 200 ) {
					masonryChild.each(function(i){
						setTimeout(function(){
							masonryChild.eq(i).addClass('post-loaded animate');
						}, 150 * (i+1));
					});
				} else {
					var first = true;
					$(window).scroll(function(){

						if ($(window).scrollTop() > 200 && first) {
							first = false;
							masonryChild.each(function(i){
								setTimeout(function(){
									masonryChild.eq(i).addClass('post-loaded animate');
								}, 150 * (i+1));
							});

						}
					})
				}

			} else {
				masonryChild.each(function(i){
					setTimeout(function(){
						masonryChild.eq(i).addClass('post-loaded animate');
					}, 150 * (i+1));
				});
			}
		}

		if (body.hasClass('single-jetpack-portfolio')) {

			var $featuredImage = $('.featured-image');
			if ($featuredImage.hasClass('vertical-img')) {
				$featuredImage.addClass(' container container-small');
				$featuredImage.parent().addClass('vertical-img-layout');
			}
		} else if (body.hasClass('single')) {

			var $featuredImage = $('.featured-image');
			if ($featuredImage.hasClass('vertical-img')) {
				$featuredImage.parent().addClass('vertical-img-layout');
			}
		}

		// enable custom scrollbars
		$(".category-filter").mCustomScrollbar({
			scrollbarPosition: "outside",
			theme: "dark"
		});

		$(".sidebar-hide-scroll").mCustomScrollbar({
			theme: "minimal"
		});

		var iframeWrapper = $(".sidebar-hide-scroll").find('iframe').parent();

		iframeWrapper.click(function() {
			$(this).find('iframe').addClass('unblocked');
		});

		iframeWrapper.mouseleave(function() {
			$(this).find('iframe').removeClass('unblocked');
		});

		/* move EU cookie law widget outside #secondary */

		var cookieWidget = $('.widget_eu_cookie_law_widget');
		if ( cookieWidget.length) {
			cookieWidget.appendTo($('#page'));
		};

		// Preloader - show content

		var preload = function() {

			$('body').addClass('show');
			$('body').removeClass('leaving-page');
		};

		centerAlignedImages();

		preload();

		if (pageHasFeaturedSlider && x > 1200) {

			featuredSliderHide();

			$(window).scroll(function(){
				// drop opacity on home hero slider
				if (pageHasFeaturedSlider) {
					featuredSliderHide();
				}
			});
		}


	}); // End Window Load

	$(window).resize(function(){

		// Calculate clients viewport
		function viewport() {
			var e = window, a = 'inner';
			if(!('innerWidth' in window )) {
				a = 'client';
				e = document.documentElement || document.body;
			}
			return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
		}

		var w=window,d=document,
		e=d.documentElement,
		g=d.getElementsByTagName('body')[0],
		x=w.innerWidth||e.clientWidth||g.clientWidth, // Viewport Width
		y=w.innerHeight||e.clientHeight||g.clientHeight; // Viewport Height

		// Global Vars

		var body = $('body');


		centerAlignedImages();

	});

	// window unload

	$(window).on('beforeunload', function () {

		var body = $('body');

		body.addClass('leaving-page');

		setTimeout(function() {
			return true;
		}, 150)

	});

})(jQuery);
