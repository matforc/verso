// JavaScript Document
(function($){
 "use strict";

 var each_bar_width , mainNavMenu , logo;
 var $row_id,$nav_items,$nav_item,$vc_row_count;

 var $window = jQuery(window);
 var $width = $(window).width(); 

$(document).ready(function () {
    


    //jQuery for page scrolling feature
	
	$("#navbar-menu ul.navbar-nav li a[href*=\\#]").parent().addClass("scroll");
	
	if ($("footer .footer_top .widget").length > 0 || $("footer .footer_top .footerLinks").length > 0 ){ 
	   $('footer').addClass('notempty');
	}
	
	// - requires jQuery Easing plugin
	
	    $('ul.navbar-nav li.scroll > a').on('click', function (event) {
        var $anchor = $(this);
		var href = $(this).attr("href");
		
	
		
		if( $anchor.hasClass('scroll_to_comments') ){
			 
		$('html, body').stop().animate({
		    scrollTop: $($anchor.attr('href').substr(href.indexOf("#"))).offset().top - 40
        }, 1500, 'easeInOutCubic');
		
		
		 }else{
			 
		if(this.hash){
			
			$('html, body').stop().animate({
				scrollTop: $($anchor.attr('href').substr(href.indexOf("#"))).offset().top
			}, 1500, 'easeInOutCubic');
		
		} 
			 
		 }
		 
	
		 

        event.preventDefault();
		$anchor.parent().parent().find("li").removeClass('active');
		$anchor.parent().addClass('active');
    });
	
	

		
		
    //  isotope
	
	
		var $portfolio_width;
		function masonryResize($container){
			
		
			var $window = jQuery(window);
			var $portfolio_width = $(window).width();
			
			var $container_width = $container.width();

			var $cols = 3;
		
			

				if($portfolio_width > 992){
					
					
					$container.removeClass('one_column');
					
					if($container.hasClass('masonry')){
						
						$container.isotope({
						layoutMode: 'packery',
						  itemSelector: '.portfolio_item_holder',
						  gutter:0,
						  transitionDuration: "0.5s"
						});
						
						
			
					
					var postWidth = Math.floor($container_width / 4 )			
					$container.find('.portfolio_item_holder ').each(function () { 

						$('.portfolio_item_holder ').css( {
							height : postWidth * 0.65 + 'px'
						});
						
						
						$('.portfolio_item_holder.col-md-6').css( { 
							height : postWidth * 1.3  + 'px'
						});
					});
					
					
	
						
					}else{	

						$cols = $container.attr('data-cols');			
						$container.isotope({
						masonry: { columnWidth: $container.width() / parseInt($cols)}
						}).isotope( 'layout' );
					}	
					
				}else if($portfolio_width > 767){
					
					$container.removeClass('one_column');
					
					if($container.hasClass('masonry')){
					
						$container.isotope({
						layoutMode: 'packery',
						  itemSelector: '.portfolio_item_holder',
						  gutter:0,
						  transitionDuration: "0.5s"
						});

					

					var postWidth = Math.floor($container_width / 2 )			
					$container.find('.portfolio_item_holder ').each(function () { 

						$('.portfolio_item_holder ').css( {
							height : postWidth * 0.65 + 'px'
						});
						
					});
					
						
					}else{	
					
						$cols = 2;
						
						$container.isotope({
						masonry: { columnWidth: $container.width() / parseInt($cols)}
						}).isotope( 'layout' );
					}
					
				}	else{
					
					$cols = 1;
					$container.addClass('one_column');
					
					if($container.hasClass('masonry')){
					
					var postWidth = Math.floor($container_width  )			
					$container.find('.portfolio_item_holder ').each(function () { 

						$('.portfolio_item_holder ').css( {
							height : postWidth * 0.65 + 'px'
						});
						
						/*	
						$('.portfolio_item_holder.col-md-6').css( { 
							height : postWidth * 1.3  + 'px'
						});
						*/
					});
					
					}
					
					
					$container.isotope({
					masonry: { columnWidth: $container.width() / parseInt($cols)}
					}).isotope( 'layout' );
					
				}

				

				

		}	
		



			
	
	
	//portfolio sort
	$('#sort-portfolio').click(function () {
		
		 var $this = $(this);
		if($this.hasClass('active')){
			
			$(this).removeClass('active');
			$(this).parent().find('ul.portfolio_filter').stop(true,true).slideUp(500,'easeOutExpo');
			
		}else{
			$(this).addClass('active');
			$(this).parent().find('ul.portfolio_filter').stop(true,true).slideDown(500,'easeOutExpo');
			
		}
		
	});


	function sort_portfolio_filter($container){
		
		
	$portfolio_width = $container.width();
		
	if( $portfolio_width < 769 ){	
	$('ul.portfolio_filter').parent().find('#sort-portfolio').removeClass('active');
	$('ul.portfolio_filter').stop(true,true).slideDown(500,'easeOutExpo');	
	$('ul.portfolio_filter').css('display', 'none');
	
	}else{
	$('ul.portfolio_filter').css('display', 'table');
	}
		
	}
		


		
    $('.santos_projects').waitForImages(function () {
        var $container = $('.portfolio_container');
		
			
			var $this = $(this);



			masonryResize($container);
				
		
					
                    // initialize isotope
                    $container.isotope({
					resizable: false,
                    itemSelector: '.portfolio_item_holder',
					layoutMode: 'masonry',
                   }).isotope( 'layout' );
		 
		 
		 $window.resize(function() {
			masonryResize($container); 
			sort_portfolio_filter($container)
			});
			

        $('.portfolio_filter a').click(function () {
            $('.portfolio_filter .active').removeClass('active');
            $(this).addClass('active');

            var selector = $(this).attr('data-filter');
            $container.isotope({
                filter: selector,
                animationOptions: {
                    duration: 500,
                    animationEngine: "jquery"
                }
            });
            return false;
        });
		
		
		
		
	if($container.hasClass('load_more')){
	
	
	
				var i = 1;
         
			
		$('.port_load_more_button a').on('click', function(e)  {
				e.preventDefault();
                
        $('.portfolio_filter .active').removeClass('active');          
        $('.portfolio_filter .all').addClass('active');
		$(this).parent().addClass('load-more--loading');
                

				var load_more_holder = $('.port_load_more_button');
				var load_more_loading = $('.port_load_more_button_loading');

				var link = $(this).attr('href');
				var $content = '.portfolio_container.load_more';
				var $anchor = '.port_load_more_button a';
				var $next_href = $($anchor).attr('href');
				$.get(link+'', function(data){
					var $new_content = $($content, data).wrapInner('').html();
					$next_href = $($anchor, data).attr('href');
					
				var $animate_pos = $('.port_load_more_button_holder').offset().top;
                    
				$($content, data).waitForImages(function() {

                $('.portfolio_item_holder:last').after($new_content); // Append the new content

           
				$('.port_load_more_button .load-more').removeClass('load-more--loading');
                
				 
				  $container.isotope('reloadItems').isotope();
				
				
					
					

					if($('.port_load_more_button span').data('rel') > i) {
						$('.port_load_more_button a').attr('href', $next_href); // Change the next URL
					} else {
						$('.port_load_more_button').remove();
					}
					
					
					 }); //waitforimage
					
				});
				i++;
			});
			
	
	
	}	

    });
	
	
	   $('.santos_gallery').waitForImages(function () {
        var $container = $('.gallery_container');
		
			
			var $this = $(this);
		
                    // initialize isotope
                    $container.isotope({
					resizable: false,
                    itemSelector: '.gallery_item_holder',
					layoutMode: 'masonry',
                   }).isotope( 'layout' );
		 
		

    });
	


    $('#blogs').waitForImages(function () {
		

        var $container = $('.blog_container');
        $container.isotope({
            filter: '*',
        });

        $('.blog_filter a').click(function () {
            $('.blog_filter .active').removeClass('active');
            $(this).addClass('active');

            var selector = $(this).attr('data-filter');
            $container.isotope({
                filter: selector,
                animationOptions: {
                    duration: 500,
                    animationEngine: "jquery"
                }
            });
            return false;
        });

    });


    //  lightcase
	$("a[data-rel^=lightcase]").each(function(){
		$(this).lightcase();
	});
	
   


    //  aos
    AOS.init({
        disable: 'mobile'
    });

    //  Feedback Carousel
    var owl = $('.owl-feedback');
    owl.owlCarousel({
        items: 1,
        loop: true,
        margin: 1,
        autoplay: true,
    });

    //  team Carousel
    var owl = $('.teamSlider');
    owl.owlCarousel({
        animateOut: 'fadeOutDown',
        animateIn: 'fadeInUp',
        items: 1,
        loop: true,
        margin: 1,
        autoplay: true,
        smartSpeed: 450,
        dots: false
    });
	
	 //  single portfolio Carousel
    var owl = $('.single-portfolio');
    owl.owlCarousel({
        animateOut: 'fadeOutDown',
        animateIn: 'fadeInUp',
        items: 1,
        loop: true,
        margin: 1,
        autoplay: true,
        smartSpeed: 450,
        dots: true
    });

    //  Portfolio Center Carousel
    $('.recent').owlCarousel({
        center: false,
        items: 1,
        autoplay: true,
        loop: false,
        margin: 30,
        responsive: {
            1200: {
                items: 3
            },
            991: {
                items: 2
            },
            786: {
                items: 2
            },
            600: {
                items: 1
            }
        }
    });
	
	
//  Showcase Carousel
if ($('.santos_showcase_carousel').length>0 ) {

var $slideItems = $('.santos_showcase_carousel').attr('data-slide-items') ? $('.santos_showcase_carousel').attr('data-slide-items') : 3 ;

if( $slideItems > 1){  

    $('.santos_showcase_carousel').owlCarousel({
        center: false,
        items: 1,
        autoplay: true,
        loop: false,
        margin: 30,
        responsive: {
            1200: {
                items: $slideItems
            },
            991: {
                items: $slideItems
            },
            786: {
                items: 2
            },
            600: {
                items: 1
            }
        }
    });
}else{
	
	$('.santos_showcase_carousel').owlCarousel({
        center: false,
        items: 1,
        autoplay: true,
        loop: false,
        margin: 1,
        smartSpeed: 450,
        dots: true
    });
	
	
	
	
	
}	

}

	
// mailchimp start
if ($('.santos_mail_chimp').length>0) {

var $chimpURL = $('.santos_mail_chimp').attr('data-mailchimp-url');
var $chimpSubmit = $('.santos_mail_chimp').attr('data-submit-msg') ? $('.santos_mail_chimp').attr('data-submit-msg') : 'Submitting...' ;
var $chimpSuccess = $('.santos_mail_chimp').attr('data-success') ? $('.santos_mail_chimp').attr('data-success') : 'We have sent you a confirmation email' ;
var $chimpErrorValue = $('.santos_mail_chimp').attr('data-error-value') ? $('.santos_mail_chimp').attr('data-error-value') : 'Please enter a value' ;
var $chimpErrorSign = $('.santos_mail_chimp').attr('data-error-sign') ? $('.santos_mail_chimp').attr('data-error-sign') : 'An email address must contain a single @' ;
var $chimpErrorDomain = $('.santos_mail_chimp').attr('data-error-domain') ? $('.santos_mail_chimp').attr('data-error-domain') : 'The domain portion of the email address is invalid' ;
var $chimpErrorUsername = $('.santos_mail_chimp').attr('data-error-username') ? $('.santos_mail_chimp').attr('data-error-username') : 'The username portion of the email address is invalid' ;
var $chimpErrorEmail = $('.santos_mail_chimp').attr('data-error-email') ? $('.santos_mail_chimp').attr('data-error-email') : 'This email address looks fake or invalid. Please enter a real email address' ;

		
	
    /*  MAILCHIMP  */
    $('.santos_mail_chimp').ajaxChimp({
		language: 'es',
        callback: mailchimpCallback,
        url: $chimpURL //Replace this with your own mailchimp post URL. Don't remove the "". Just paste the url inside "".
    });


    
function mailchimpCallback(resp) {

	
    if (resp.result === 'success') {
        $('.subscription-success').html(resp.msg).fadeIn(1000);
        $('.subscription-error').fadeOut(500);

    } else if(resp.result === 'error') {

		while(resp.msg.charAt(0) === '0')
		{
		 resp.msg = resp.msg.substr(3);
		}

        $('.subscription-error').html(resp.msg).fadeIn(1000);
    }
}


$.ajaxChimp.translations.es = {
    'submit': $chimpSubmit,
    0: $chimpSuccess,
    1: $chimpErrorValue,
    2: $chimpErrorSign,
    3: $chimpErrorDomain,
    4: $chimpErrorUsername,
    5: $chimpErrorEmail
};

}



//Social share
var completed = 0;
var windowLocation = window.location.href.replace(window.location.hash, '');

////facebook share
function facebookSingleShare(){
window.open( 'https://www.facebook.com/sharer/sharer.php?u='+windowLocation, "facebookWindow", "height=380,width=660,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" ) 
return false;
}
$('.single-facebook-share').click(facebookSingleShare);	

////twitter
function twitterSingleShare(){
if($(".titlebar h1").length > 0) {
var $pageTitle = encodeURIComponent($(".titlebar h1").text());
} else {
var $pageTitle = encodeURIComponent($(document).find("title").text());
}
window.open( 'http://twitter.com/intent/tweet?text='+$pageTitle +' '+windowLocation, "twitterWindow", "height=380,width=660,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" ) 
return false;
}
$('.single-twitter-share').click(twitterSingleShare);


////Google share
function googleplusSingleShare(){
window.open("https://plus.google.com/share?url="+windowLocation,"","height=550,width=525,left=100,top=100,menubar=0");
return false;
}
$('.single-googleplus-share').click(googleplusSingleShare);	






    //  back to top
    if ($('#back-to-top').length) {
        var scrollTrigger = 100, // px
            backToTop = function () {
                var scrollTop = $(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    $('#back-to-top').addClass('show');
                } else {
                    $('#back-to-top').removeClass('show');
                }
            };
        backToTop();
        $(window).on('scroll', function () {
            backToTop();
        });
        $('#back-to-top').on('click', function (e) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 700);
        });
    }
	
	
	
/* WooCommerce */
//Add To Cart Button
//check if cart has products

if($('.widget_shopping_cart .widget_shopping_cart_content .cart_list').length > 0 ) {
	$('.attr-nav .head_shop_icon').addClass('has_products');
}else{
	$('.attr-nav .head_shop_icon').removeClass('has_products');
}


var timeout;  
$('body').on('added_to_cart', shopping_cart_dropdown_show);
$('body').on('added_to_cart', shopping_cart_dropdown);


function shopping_cart_dropdown() {

	$('.attr-nav .head_shop_icon').addClass('has_products');

}



function shopping_cart_dropdown_show(e) {
	
	
	
	clearTimeout(timeout);

	

	//before cart has slide in

	if(!$('.attr-nav .head_shop_icon').hasClass('has_products')) {

	setTimeout(function(){ $('.attr-nav .shopping-cart-header').fadeIn(400); },400);

	}

	else if(!$('.attr-nav .shopping-cart-header').is(':visible')) {

	$('.attr-nav .shopping-cart-header').fadeIn(400);

	} else {

	$('.attr-nav .shopping-cart-header').show();

	}

	timeout = setTimeout(hideCart,3000);



}

function hideCart() {
	$('.attr-nav .shopping-cart-header').stop(true,true).fadeOut();
}

 

	
	
    // main slider 
	
	$(".santos_hero_slider").each(function () {
		
		if($(this).hasClass('parallax')){
			
		$(this).find('ul.slides > li').addClass('background parallax');
		}
		
	});
	
	
	 if ($('.santos_hero_slider').length) {
		 
	
    $('.santos_hero_slider .flexslider').flexslider({
        animation: "fade",
        slideshowSpeed: 6000,
        animationSpeed: 500,
        directionNav: true,
        start: function () {
            setTimeout(function () {
                $('.interTextDiv h1,.interTextDiv p,.interTextDiv .btnsDiv').removeClass('animated fadeInUp');
                $('.flex-active-slide').find('.interTextDiv h1,.interTextDiv p,.interTextDiv .btnsDiv').addClass('animated fadeInUp');
            }, 500);
        },
        before: function () {
            setTimeout(function () {
                $('.interTextDiv h1,.interTextDiv p,.interTextDiv .btnsDiv').removeClass('animated fadeInUp');
                $('.flex-active-slide').find('.interTextDiv  h1,.interTextDiv p,.interTextDiv .btnsDiv').addClass('animated fadeInUp');
            }, 500);
        }
    });
	
	}
	
	 // product slider 
	 $('.productSlider').each(function(){
				
		$(this).flexslider({
        animation: "slide",
        slideshowSpeed: 6000,
        animationSpeed: 500,
        directionNav: true,
		});
			
	});
		
		


    // start a timer when on appear
    var count = $('.count');
    count.appear();
    count.each(function () {
        $(this).on('appear', function () {
            var $this = $(this);
            if (!$this.hasClass('counter-loaded')) {
                $('.count').countTo({
                    speed: 2000,
                    formatter: function (value, options) {
                        return value.toFixed(options.decimals);
                    },
                });
                $this.addClass('counter-loaded');
            }
        });
    });
	
	
	
	
	
	// Down Count
	 $(".countdown").each(function () {
		 var day = $(this).attr('data-day') ? $(this).attr('data-day') : '01';
		 var month = $(this).attr('data-month') ? $(this).attr('data-month') : '10' ;
		 var year = $(this).attr('data-year') ? $(this).attr('data-year') : '2017' ;
		

		$('.countdown').downCount({
			     
			  //date: ''+day+'/'+month+'/'+year+' 12:00:00',
			  date: ''+month+'/'+day+'/'+year+' 12:00:00',
			  offset: +10
			}, function () {
				alert('WOOT WOOT, done!');
			});
		
	});
	
	
	
	


	
	// progress-bar
	var progress = $('.progress-bar');
	progress.appear();


	$(function () {
		$('[data-toggle="tooltip"]').tooltip({
			trigger: 'manual'
		}).tooltip('show');
	});

	$(this).on('appear', function () {


		$(".progress-bar").each(function () {
			each_bar_width = $(this).attr('aria-valuenow');
			$(this).width(each_bar_width + '%');
		});

	});



    // input
    $(".input-contact input, .textarea-contact textarea").focus(function () {
        $(this).next("span").addClass("active");
    });
    $(".input-contact input, .textarea-contact textarea").blur(function () {
        if ($(this).val() === "") {
            $(this).next("span").removeClass("active");
        }
    });
	
	
	
	
	
/* multiscroll slider
================================================== */
$('#multiscroll').each(function(){
		
	$('body').addClass('multiscroll-slider');
	
	$('#multiscroll').multiscroll({
        navigation: true,
        navigationPosition: 'right',
        loopTop: true,
        loopBottom: true,
		afterLoad: function(anchorLink, index){
			
    // start a timer
		var count = $('.count');
		count.each(function () {
				var $this = $(this);
				if (!$this.hasClass('counter-loaded')) {
					$('.count').countTo({
						speed: 2000,
						formatter: function (value, options) {
							return value.toFixed(options.decimals);
						},
					});
					$this.addClass('counter-loaded');
				}

		});
				
		},
    });
});
	
	

 //fullpage

	
		var $anchors = [];
		$nav_items = '';
		$vc_row_count = 1;
		
		
		$('.vc_section').each(function(){
		 
		 $(this).find('.vc_row.section').removeClass('section'); 

		});
		
		
		$('.section').each(function(){
			
			var $elem = $(this);

			
			$nav_item = '<a data-menuanchor="section-'+ $vc_row_count +'" class="nav__item" aria-label="Item '+ $vc_row_count +'" href="#section-'+ $vc_row_count +'"><svg class="nav__icon"><use xlink:href="#icon-circle"></use></svg></a>';
			$nav_items += $nav_item ;
			$anchors.push('section-'+ $vc_row_count);
			$vc_row_count++;




			
			
		});
		
		
		var ListContents = '';
        $('.onepage_navigator').each(function(index, element) {
            var t = $(this);	
			ListContents = '<nav id="menu" class="dotNav nav--ayana ayanaRose ">' + $nav_items  + '</nav></div>';
            t.remove();
        });
        if(ListContents!='') {
			$('body').addClass('fullpage');
            $('body').append(ListContents);
        }
		
		

if($('body').hasClass('fullpage') ){  

	  // anchors: ['section-intro', 'section-contact'],
	
    $('#fullpage').fullpage({
		anchors: $anchors,
        menu: '#menu',
        navigationTooltips: ['home', 'about us', 'our works', 'contact us'],
        css3: true,
        verticalCentered: false,
        autoScrolling: false,
        fitToSection: false,
        responsiveWidth: 991,
        responsiveHeight: 0,
        responsiveSlides: false,
		
		onLeave: function(index, nextIndex, direction){}
		 
		 
    });
}	

    $('.menuDiv').click(function () {
        $(this).toggleClass('closeBtn');
    });
	
	
	santos_love_post();

});


/* Love post */
/* -------------------------------------------------------------------- */

function santos_love_post() {

  "use strict";

  $('body').on('click', '.santos-love-this', function () {
    var $this = $(this),
      $id = $this.attr('id');

    if ($this.hasClass('item-loved')) return false;

    if ($this.hasClass('item-inactive')) return false;

    var $sentdata = {
      action: 'santos_love_post',
      post_id: $id
    }

    $.post(ajaxurl, $sentdata, function (data) {
      $this.find('.santos-love-count').html(data);
      $this.addClass('item-loved');
    });

    $this.addClass('item-inactive');


    return false;
  });

}



$(window).load(function () {
	
     $(".loading_screen .showbox").fadeOut(900);
     $(".loading_screen").fadeOut(1200);
	 
	 
	 
	 
/* WooCommerce */
//Add To Cart Button
//check if cart has products
if($('.widget_shopping_cart .widget_shopping_cart_content .cart_list').length > 0 ) {
	$('.attr-nav .head_shop_icon').addClass('has_products');
}else{
	$('.attr-nav .head_shop_icon').removeClass('has_products');
}


	  		
});




})(jQuery);