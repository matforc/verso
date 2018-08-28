/*!
 * imagesLoaded PACKAGED v4.1.4
 * JavaScript is all like "You images are done yet or what?"
 * MIT License
 */
!function(e,t){"function"==typeof define&&define.amd?define("ev-emitter/ev-emitter",t):"object"==typeof module&&module.exports?module.exports=t():e.EvEmitter=t()}("undefined"!=typeof window?window:this,function(){function e(){}var t=e.prototype;return t.on=function(e,t){if(e&&t){var i=this._events=this._events||{},n=i[e]=i[e]||[];return n.indexOf(t)==-1&&n.push(t),this}},t.once=function(e,t){if(e&&t){this.on(e,t);var i=this._onceEvents=this._onceEvents||{},n=i[e]=i[e]||{};return n[t]=!0,this}},t.off=function(e,t){var i=this._events&&this._events[e];if(i&&i.length){var n=i.indexOf(t);return n!=-1&&i.splice(n,1),this}},t.emitEvent=function(e,t){var i=this._events&&this._events[e];if(i&&i.length){i=i.slice(0),t=t||[];for(var n=this._onceEvents&&this._onceEvents[e],o=0;o<i.length;o++){var r=i[o],s=n&&n[r];s&&(this.off(e,r),delete n[r]),r.apply(this,t)}return this}},t.allOff=function(){delete this._events,delete this._onceEvents},e}),function(e,t){"use strict";"function"==typeof define&&define.amd?define(["ev-emitter/ev-emitter"],function(i){return t(e,i)}):"object"==typeof module&&module.exports?module.exports=t(e,require("ev-emitter")):e.imagesLoaded=t(e,e.EvEmitter)}("undefined"!=typeof window?window:this,function(e,t){function i(e,t){for(var i in t)e[i]=t[i];return e}function n(e){if(Array.isArray(e))return e;var t="object"==typeof e&&"number"==typeof e.length;return t?d.call(e):[e]}function o(e,t,r){if(!(this instanceof o))return new o(e,t,r);var s=e;return"string"==typeof e&&(s=document.querySelectorAll(e)),s?(this.elements=n(s),this.options=i({},this.options),"function"==typeof t?r=t:i(this.options,t),r&&this.on("always",r),this.getImages(),h&&(this.jqDeferred=new h.Deferred),void setTimeout(this.check.bind(this))):void a.error("Bad element for imagesLoaded "+(s||e))}function r(e){this.img=e}function s(e,t){this.url=e,this.element=t,this.img=new Image}var h=e.jQuery,a=e.console,d=Array.prototype.slice;o.prototype=Object.create(t.prototype),o.prototype.options={},o.prototype.getImages=function(){this.images=[],this.elements.forEach(this.addElementImages,this)},o.prototype.addElementImages=function(e){"IMG"==e.nodeName&&this.addImage(e),this.options.background===!0&&this.addElementBackgroundImages(e);var t=e.nodeType;if(t&&u[t]){for(var i=e.querySelectorAll("img"),n=0;n<i.length;n++){var o=i[n];this.addImage(o)}if("string"==typeof this.options.background){var r=e.querySelectorAll(this.options.background);for(n=0;n<r.length;n++){var s=r[n];this.addElementBackgroundImages(s)}}}};var u={1:!0,9:!0,11:!0};return o.prototype.addElementBackgroundImages=function(e){var t=getComputedStyle(e);if(t)for(var i=/url\((['"])?(.*?)\1\)/gi,n=i.exec(t.backgroundImage);null!==n;){var o=n&&n[2];o&&this.addBackground(o,e),n=i.exec(t.backgroundImage)}},o.prototype.addImage=function(e){var t=new r(e);this.images.push(t)},o.prototype.addBackground=function(e,t){var i=new s(e,t);this.images.push(i)},o.prototype.check=function(){function e(e,i,n){setTimeout(function(){t.progress(e,i,n)})}var t=this;return this.progressedCount=0,this.hasAnyBroken=!1,this.images.length?void this.images.forEach(function(t){t.once("progress",e),t.check()}):void this.complete()},o.prototype.progress=function(e,t,i){this.progressedCount++,this.hasAnyBroken=this.hasAnyBroken||!e.isLoaded,this.emitEvent("progress",[this,e,t]),this.jqDeferred&&this.jqDeferred.notify&&this.jqDeferred.notify(this,e),this.progressedCount==this.images.length&&this.complete(),this.options.debug&&a&&a.log("progress: "+i,e,t)},o.prototype.complete=function(){var e=this.hasAnyBroken?"fail":"done";if(this.isComplete=!0,this.emitEvent(e,[this]),this.emitEvent("always",[this]),this.jqDeferred){var t=this.hasAnyBroken?"reject":"resolve";this.jqDeferred[t](this)}},r.prototype=Object.create(t.prototype),r.prototype.check=function(){var e=this.getIsImageComplete();return e?void this.confirm(0!==this.img.naturalWidth,"naturalWidth"):(this.proxyImage=new Image,this.proxyImage.addEventListener("load",this),this.proxyImage.addEventListener("error",this),this.img.addEventListener("load",this),this.img.addEventListener("error",this),void(this.proxyImage.src=this.img.src))},r.prototype.getIsImageComplete=function(){return this.img.complete&&this.img.naturalWidth},r.prototype.confirm=function(e,t){this.isLoaded=e,this.emitEvent("progress",[this,this.img,t])},r.prototype.handleEvent=function(e){var t="on"+e.type;this[t]&&this[t](e)},r.prototype.onload=function(){this.confirm(!0,"onload"),this.unbindEvents()},r.prototype.onerror=function(){this.confirm(!1,"onerror"),this.unbindEvents()},r.prototype.unbindEvents=function(){this.proxyImage.removeEventListener("load",this),this.proxyImage.removeEventListener("error",this),this.img.removeEventListener("load",this),this.img.removeEventListener("error",this)},s.prototype=Object.create(r.prototype),s.prototype.check=function(){this.img.addEventListener("load",this),this.img.addEventListener("error",this),this.img.src=this.url;var e=this.getIsImageComplete();e&&(this.confirm(0!==this.img.naturalWidth,"naturalWidth"),this.unbindEvents())},s.prototype.unbindEvents=function(){this.img.removeEventListener("load",this),this.img.removeEventListener("error",this)},s.prototype.confirm=function(e,t){this.isLoaded=e,this.emitEvent("progress",[this,this.element,t])},o.makeJQueryPlugin=function(t){t=t||e.jQuery,t&&(h=t,h.fn.imagesLoaded=function(e,t){var i=new o(this,e,t);return i.jqDeferred.promise(h(this))})},o.makeJQueryPlugin(),o});

'use strict';

(function ($) {

    var carouselProdottiCustom = function () {
        if ($('.santos_showcase_carousel').length > 0) {
            var $slideItems = $('.santos_showcase_carousel').attr('data-slide-items') ? $('.santos_showcase_carousel').attr('data-slide-items') : 3;
            if ($slideItems > 1) {
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
            } else {
                $('.santos_showcase_carousel').owlCarousel({
                    center: false,
                    items: 1,
                    autoplay: true,
                    loop: true,
                    margin: 1,
                    smartSpeed: 450,
                    nav: true,
                    navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
                    dots: false
                });
            }
        }
    };

    var scrollTo = function(){
        $('a[href*="#"]:not([href="#"]):not([href="#show"]):not([href="#hide"]):not([data-vc-tabs=""])' || '[href*="#"]:not([href="#"]):not([href="#show"]):not([href="#hide"])').click(function() {

            if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                let target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 600);
                    return false;
                }
            }
        });


        //From outside the home page
        var pathname = window.location.hash;

        window.addEventListener("load", function () {

            let target = $(window.location.hash);

            if(target.length >0 ) {
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');

                $('html,body').animate({
                    scrollTop: target.offset().top
                }, 600);
                return false;
            }


        });

        $(window).ready(function(){

            $(this).one('scroll', function(){


                var scrollIcon = $('a.scroll-icon')[0];
                if(scrollIcon) {
                    if (location.pathname.replace(/^\//,'') == scrollIcon.pathname.replace(/^\//,'') && location.hostname == scrollIcon.hostname) {
                        let target = $(scrollIcon.hash);
                        target = target.length ? target : $('[name=' + scrollIcon.hash.slice(1) +']');
                        if (target.length) {
                            $('html,body').animate({
                                scrollTop: target.offset().top
                            }, 600);
                            return false;
                        }
                    }

                }
            });
        });

    };

    var addIcon = function(){
        $( "#contact_form .btn-blue" ).prepend( '<i class="send-icon"></i>' );
    };

    var imageFull = function(){
        var imgFull = $('.image-zoom');

        if(imgFull.length > 0){
                $('<div id="fullWidth-image" class="image-full-width blackBg"><span class="btn btn-default close-btn">Chiudi</span> <div class="img-wrapper"></div></div>').appendTo('body');
        }

        $(imgFull).on('click', function(){
            var currentImg = $(this).parentsUntil('.images-full-wrapper');
            console.log(currentImg);

            var imgWrapper = $('.img-wrapper');
            var currentImgSrc = $(currentImg).find('.mobile-hide .vc_single_image-wrapper img').attr('src');
            console.log(currentImgSrc);

            $('#fullWidth-image').addClass('in');
            $(imgWrapper).append('<img class="img-full" src="'+ currentImgSrc  +'  "/>');
        });

        $('.close-btn').on('click', function(){
            $('#fullWidth-image').removeClass('in');
            $('.image-full-width').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',
                function(e) {
                    $('.img-full').remove();
                });
        });
    };

    var imageArchiveSetup = function(){

        var imgArchive = $('.image-archive-wrapper a img');

        $.each(imgArchive, function(){

            if(this) {
                if ($(this).width() > $(this).height()){
                    //it's a landscape*/
                    var imgWrapperParent = $(this).parent('a').parent('.image-archive-wrapper').addClass('img-landscape');
                } else if ($(this).width() < $(this).height()){
                    //it's a portrait*/
                    var imgWrapperParent = $(this).parent('a').parent('.image-archive-wrapper').addClass('img-portrait');
                } else {
                    //it's square*/
                    var imgWrapperParent = $(this).parent('a').parent('.image-archive-wrapper').addClass('img-square');

                }
            }
        });






    };

    var ajaxRelatedProducts = function () {
        var btnGusti = $('#gusti-modal');

        if(btnGusti.length > 0) {
            // Notes
            // Categories List Request http://verso2.loc/wp-json/wp/v2/categories?per_page=100
            // Breakpoint window 768px
            // imagesLoaded snippet: $('.items-wrapper').imagesLoaded( function() { /*images have loaded*/ });
            // Example filtered request post by category Id
            // /wp/v2/posts?categories=some-category-id

            var rootUrl = WPURLS.siteurl;
            var itemWrapper = $('.items-wrapper');
            var modal = $('.wrapper-modal');
            var postsUrl = rootUrl + '/wp-json/wp/v2/posts?per_page=100';
            var categoriesUrl = rootUrl + '/wp-json/wp/v2/categories?per_page=100';
            var imgUrl = imgUrl || 'https://placeimg.com/400/400/nature" alt="alt-text';
            var postUrl = postUrl || '#';
            var imgAltText = imgAltText || 'alt-text';
            var postTitle = postTitle || 'Gusto Single Title';
            var closeModal = $('.wrapper-modal .close-btn');
            var loader = '<div class="loading-bro"> \n <p>Caricamento<p>\n <svg id="load" x="0px" y="0px" viewBox="0 0 150 150">\n                <circle id="loading-inner" cx="75" cy="75" r="60"/>\n </svg>\n </div>';

            //get category list content
            var catsTypes = [];
            var cats = $('.categories ul > li a');
                $.each(cats, function(i, e){
                     var elmType = $(e).attr('type');
                    catsTypes.push(elmType);
                });
            //add attr to button gusti es: product-type="kverso"
            $(btnGusti).attr('product-type', catsTypes.toString()).addClass('yesModal');

            //on btn click
            $('#gusti-modal').on('click', function(e){
                e.preventDefault();
                $(modal).addClass('open');
                $('.relatedProduct.modal-overlay').addClass('open');
                $(itemWrapper).empty().append(loader);
                var categoryToExclude = ['macchine-vendita', 'macchine-comodato', 'senza-categoria'];

                var btnProductType = $(this).attr('product-type').split(',');

                var filteredProductTypes = btnProductType.filter( function( el ) {

                    return categoryToExclude.indexOf( el );

                } );

                var getCats = $.ajax( {dataType: "json", url: categoriesUrl}).done(function(data) {
                    var catsJson = data;
                    var postsJson = $.ajax( {dataType: "json", url: postsUrl}).done(function(postsArray) {
                        var posts = postsArray;
                        // get category ID by slug
                        var getCatId = function getCatId(catSlug, catsObjArray) {
                            var id = void 0;
                            var idArr = catsObjArray.map(function (obj) {
                                if (obj.slug === catSlug) {
                                    return id = obj.id;
                                }
                            });
                            return id;
                        };
                        var prodottiId = getCatId("prodotti", catsJson); // 24
                        var getProducts = function (prodottiId, relatedProductTypeCatId, postsObjArray) {
                            return postsObjArray.filter(function (post) {
                                return ~post.categories.indexOf(prodottiId);
                            }).filter(function(post){
                                return ~post.categories.indexOf(relatedProductTypeCatId);
                            });
                        };


                        //var relatedProducts = getProducts(prodottiId, relatedProductTypeCatId, posts);
                        var indexWhile = 0;
                        do {

                            var relatedProductTypeCatId = getCatId( filteredProductTypes[indexWhile].toString(), catsJson) || console.log('Product type is not on the category list');
                            var relatedProducts = getProducts(prodottiId, relatedProductTypeCatId, posts);
                            indexWhile++;
                        }
                        while ( !(typeof relatedProducts !== 'undefined' && relatedProducts.length > 0) || indexWhile > 15);


                        /* Display Related Products */
                        var appendItems = function appendItems(products) {
                            $(itemWrapper).empty();
                            for (var index=0; index < products.length || function(){
                                btnProvaciGratis(); return false;
                                }() //end CallBAck
                                ; index++) {
                                var product = products[index];
                                postTitle = product.title.rendered;
                                postUrl = product.link;
                                imgUrl = product.better_featured_image.media_details.sizes.santos_default.source_url;
                                imgAltText = product.better_featured_image.alt_text;
                                var template = ' <div class="gusto-item isLoading"><a href="' + postUrl + '"> <img class="img-responsive" src="' + imgUrl + '" alt="' + imgAltText + '">\n    <h3 class="text-center">' + postTitle + '</h3></a></div>';
                                $(itemWrapper).append(template);
                            }
                            $('body').css('overflow-y', 'hidden');

                            /* ImagesLoaded START*/
                            $('#container').imagesLoaded().always(function (instance) {
                                //console.log('all images loaded');
                            }).done(function (instance) {
                                //console.log('all images successfully loaded');
                                $('.loading-bro').addClass('loaded');

                                $('.gusto-item').each(function (i) {
                                    setTimeout(function () {
                                        $('.gusto-item').eq(i).removeClass('isLoading');
                                    }, 300 * (i + 1));
                                });
                            }).fail(function () {
                                //console.log('all images loaded, at least one is broken');
                            }).progress(function (instance, image) {
                                var result = image.isLoaded ? 'loaded' : 'broken';
                                //console.log( 'image is ' + result + ' for ' + image.img.src );
                                //$(image.img).parents().removeClass('isLoading');
                                //console.log(image);

                            });
                            /* ImagesLoaded END*/
                        };
                            $('.loading-bro').removeClass('loaded');
                            appendItems(relatedProducts);
                    }).fail(function(e) {
                        alert('Errore di carimento'+ e +',si prega di verificare la connessione.')
                    });
                }).fail(function(e) {
                    alert('Errore di carimento'+ e +',sei connesso a Internet?')
                });
            });

            //Close Modal
            $(closeModal).on('click', function () {
                $('.relatedProduct.modal-overlay').removeClass('open');
                $(modal).removeClass('open');
                $('body').css('overflow-y', 'scroll');
            });



            $('.relatedProduct.modal-overlay').on('click', function () {
                $('.relatedProduct.modal-overlay').removeClass('open');
                $(modal).removeClass('open');
                $('body').css('overflow-y', 'scroll');
            });

            $(modal).scroll(function() {
               this.scrollTop > 600 ? $('#back-to-top-related-product').addClass('visible') : $('#back-to-top-related-product').removeClass('visible');
            });

            $('#back-to-top-related-product').on('click', function(){
                $(modal).animate({
                    scrollTop: 0
                }, 300)
            })



        } //if btn gusti end

    };

    var btnMaggioriInfo = function(){

        $('.btn-maggiori-info').on('click', function(){

            window.open('/contatti');
        })
    };

    var btnProvaciGratis = function(){


        var rootUrl = WPURLS.siteurl;
        var pageProvaciGratisUrl = rootUrl + '/wp-json/wp/v2/pages/934';
        var scriptToReloadCF7 = rootUrl + '/wp-content/plugins/contact-form-7/includes/js/scripts.js';
        //POST URL
        var cf7Id = '933';
        var postUrl = rootUrl + '/wp-json/contact-form-7/v1/contact-forms/' + cf7Id +'/feedback ';

        $.ajax( {dataType: "json", url: pageProvaciGratisUrl})
            .done(function (data) {
                var pageContent = data.content.rendered;
                var item = $('.gusto-item');

                $(item).eq(0).after(pageContent);
                $(item).eq(3).after(pageContent);
                $(item).last().append(pageContent);

                $('form').attr('action', postUrl);

                function reload_js(src) {
                    $('script[src="' + src + '"]').remove();
                    $('<script>').attr('src', src).appendTo('head');
                }
                reload_js(scriptToReloadCF7);

            })
            .fail(function(e){
                alert(e);
            });



    };

    var displayItems = function(){

        var items = $('.item-fadeIn');

        if( items.length > 0 ) {
            $.each(items, function(i, e){
                setTimeout(function(){
                    $(e).animate({"top": 0,
                        "opacity": 1
                    }, 1000);
                }, 150 * i);
            });
        }


    };


    var ctaProvaciMobile = function () {
        var ctaElm = $('.mettici-alla-prova');

        function mobileManaging () {

            $(window).scroll(function(){

                var windWidtha = $(window).width();

                if(windWidtha < 500 ) {
                    if ($(window).scrollTop() == $(document).height() - $(window).height()) {
                        var windWidtha = $(window).width();
                        $(ctaElm).addClass('hide');

                    }else {
                        $(ctaElm).removeClass('hide');
                    }
                }


            });
        }
        mobileManaging();


        $(window).on('resize', function() {

            var windWidth = $(window).width();

            windWidth < 500 ?  $(ctaElm).addClass('mobile') : $(ctaElm).removeClass('mobile')

        }).resize();

    };

    var init = function init() {
        carouselProdottiCustom();
        scrollTo();
        addIcon();
        imageFull();
        imageArchiveSetup();
        ajaxRelatedProducts();
        btnMaggioriInfo();
        displayItems();
        ctaProvaciMobile();
    };

    init();
})(jQuery);