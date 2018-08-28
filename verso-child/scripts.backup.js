(function($){

    let carouselProdottiCustom = ()=> {
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
                    loop: true,
                    margin: 1,
                    smartSpeed: 450,
                    nav: true,
                    navText: [
                        "<i class='fa fa-angle-left'></i>",
                        "<i class='fa fa-angle-right'></i>"
                    ],
                    dots: false
                });

            }
        }
    };

    let buttonHover = () => {
        $('.btn-verso').on('hover', (e) => {
            let _this = e.currentTarget;
            $(_this).toggleClass('hovered');
        })
    };

    let init = () => {
        carouselProdottiCustom();
        //buttonHover();
    };

    init();


})(jQuery);



