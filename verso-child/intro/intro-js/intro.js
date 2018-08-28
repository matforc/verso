jQuery(document).ready(function($){

//Cookies.set('introCookie', 'introPlayed', { expires: 0.041 });

var introPlayed = Cookies.get('introCookie');

    var body = $('body'),
        introOverlay = $('.intro-overlay'),
        infographic = $('svg#infographic'),
        overlayIntro = $('.overlay-intro');



//if intro played in one hour don't play it again
    if(introPlayed === undefined && infographic.length > 0 ) {

        $(body).addClass('introPlaying');
    //animation
        //vars
        var svg = $('.intro-wrapper svg'),
            wavingDotRed = $('#red-dot'),
            wavingDotYellow = $('#yellow-dot'),
            wavingDotBlue = $('#blue-dot'),
            dotsWaving = $('.dotsWaving'),
            redDot = $('#dot-red'),
            yellowDot = $('#dot-yellow'),
            blueDot = $('#dot-blue'),
            macchinaLabel = $('#macchina-label'),
            prodottoLabel = $('#prodotto-label'),
            assistenzaLabel = $('#assistenza-label'),
            chicchiIcon = $('#chicchi-icon'),
            ingranaggiIcon = $('#ingranaggi-icon'),
            macchinaIcon = $('#macchina-caffe-icon'),
            numberOne = $('#number-1'),
            numberTwo = $('#number-2'),
            numberThree = $('#number-3'),
            redLine = $('#red-line'),
            blueLine = $('#blue-line'),
            yellowLine = $('#yellow-line'),
            pathRed = [{ x: 77, y: -130 }, { x: 107, y: -100 }, { x: 152, y: -20 }, { x: 77, y: 130 }, { x: -117, y: 145 }, { x: -160, y: 105 }, { x: -168, y: 35 }, { x: -168, y: -30 }],
            pathYellow = [{ x: -18, y: 90 }, { x: -148, y: 110 }, { x: -218, y: 70 }, { x: -241, y: -30 }],
            pathBlue = [{ x: -18, y: 90 }, { x: -168, y: 110 }, { x: -228, y: 70 }, { x: -278, y: 60 }, { x: -314, y: -30 }],
            mainTl = new TimelineMax({ paused: false, onComplete: setIntroCookie });

//init
        var init = function init() {
            //TweenLite.set(infographic, {scale:1})
            //TweenLite.to(introOverlay,.2,{autoAlpha: 1});
            //var svgHeight = $(svg).height();
            //TweenLite.set(svg,{css:{zIndex: 40, position: 'absolute', opacity:1}});
            //TweenLite.set(introWrapper,{css:{height: s}, autoAlpha: 1});

            TweenLite.set([macchinaLabel, prodottoLabel, assistenzaLabel, chicchiIcon, ingranaggiIcon, macchinaIcon, redDot, blueDot, yellowDot, numberOne, numberTwo, numberThree], { autoAlpha: 0 });
            TweenLite.set(infographic, {autoAlpha:1})
            TweenLite.set(redLine, { drawSVG: "0% 0%" });
            TweenLite.set(yellowLine, { drawSVG: "0% 0%", y: 6 });
            TweenLite.set(blueLine, { drawSVG: "0% 0%" });
            TweenLite.set(dotsWaving, { y: -20 });
            TweenLite.set(wavingDotRed, { x: -8 });
            TweenLite.set(wavingDotBlue, { x: 3 });
        };
        init();

//wave dots
        var getDotsWaveTl = function getDotsWaveTl() {

            var dotsWaveTl = new TimelineMax();

            dotsWaving.each(function (index, element) {

                var dotWaveTl = new TimelineMax(),
                    delay = 0.15;
                dotWaveTl.to(element, 0.4, { y: -10, ease: Power1.easeOut }).to(element, 0.8, { y: 10, ease: Power1.easeInOut }).to(element, 0.4, { y: 0, ease: Power1.easeIn }).to(element, 0.4, { y: -10, ease: Power1.easeOut }).to(element, 0.8, { y: 10, ease: Power1.easeInOut }).to(element, 0.4, { y: 0, ease: Power1.easeIn }).timeScale(1.3);

                dotsWaveTl.add(dotWaveTl, delay * index);
            });

            dotsWaveTl.timeScale(1.1);

            return dotsWaveTl;
        };

//rotating dots
        var getDotsRotateTl = function getDotsRotateTl() {
            var dotsRotateTl = new TimelineMax();

            dotsRotateTl.to(wavingDotRed, .45, { bezier: { curviness: 1.5, values: pathRed, ease: Power2.easeInOut } }, 'move').to(wavingDotYellow, .47, { bezier: { curviness: 1, values: pathYellow, ease: Power2.easeInOut } }, 'move').to(wavingDotBlue, .48, { bezier: { curviness: 1, values: pathBlue, ease: Power2.easeInOut } }, 'move').timeScale(0.8);

            return dotsRotateTl;
        };

//draw lines
        var drawLines = function drawLines() {
            var draw = new TimelineMax();
            draw.add('startDrawing').set(numberOne, { autoAlpha: 1, immediateRender: false }).to(redLine, 0.5, { drawSVG: "0% 100%", ease: Power1.easeOut }).to(dotsWaving, .2, { autoAlpha: 0 }, 'startDrawing').to(yellowLine, 0.5, { drawSVG: "100% 0%", ease: Power1.easeOut }, 'startDrawing').to(numberTwo, .2, { autoAlpha: 1 }, 'startDrawing+=.3').to(blueLine, 0.5, { drawSVG: "100% 0%", ease: Power1.easeOut }, '-=.4').to(numberThree, .2, { autoAlpha: 1 }, 'startDrawing');
            return draw;
        };

//show icons
        var showIcons = function showIcons() {
            var showTheFukingIcons = new TimelineMax();
            showTheFukingIcons.to([chicchiIcon, ingranaggiIcon, macchinaIcon], .4, { autoAlpha: 1 });

            return showTheFukingIcons;
        };

//show labels

        var showLabelsRed = function showLabelsRed() {
            var showTheFuckingLabelsRed = new TimelineMax();

            showTheFuckingLabelsRed.to(macchinaLabel, .2, { autoAlpha: 1 }).to(macchinaLabel, .3, { rotation: '-4deg', transformOrigin: '50% 100%' }, 'showRedLabel').to(macchinaLabel, .4, { rotation: '3deg', transformOrigin: '50% 100%' }).to(macchinaLabel, .4, { rotation: '-3deg', transformOrigin: '50% 100%' }).to(macchinaLabel, .4, { rotation: '2deg', transformOrigin: '50% 100%' }).to(macchinaLabel, .4, { rotation: '-1deg', transformOrigin: '50% 100%' }).to(macchinaLabel, .4, { rotation: '0deg', transformOrigin: '50% 100%', ease: Elastic.easeOut.config(1, 0.5) });

            showTheFuckingLabelsRed.timeScale(1.5);

            return showTheFuckingLabelsRed;
        };

        var showLabelsYellow = function showLabelsYellow() {

            var showTheFuckingLabelsYellow = new TimelineMax();

            showTheFuckingLabelsYellow.to(prodottoLabel, .2, { autoAlpha: 1 }).to(prodottoLabel, .3, { rotation: '-4deg', transformOrigin: '50% 0%' }).to(prodottoLabel, .4, { rotation: '3deg', transformOrigin: '50% 0%' }).to(prodottoLabel, .4, { rotation: '-3deg', transformOrigin: '50% 0%' }).to(prodottoLabel, .4, { rotation: '2deg', transformOrigin: '50% 0%' }).to(prodottoLabel, .4, { rotation: '-1deg', transformOrigin: '50% 0%' }).to(prodottoLabel, .4, { rotation: '0deg', transformOrigin: '50% 0%', ease: Elastic.easeOut.config(1, 0.5) });

            showTheFuckingLabelsYellow.timeScale(1.7);

            return showTheFuckingLabelsYellow;
        };

        var showLabelsBlue = function showLabelsBlue() {

            var showTheFuckingLabelsBlue = new TimelineMax();

            showTheFuckingLabelsBlue.to(assistenzaLabel, .2, { autoAlpha: 1 }).to(assistenzaLabel, .25, { rotation: '-3.5deg', transformOrigin: '50% 100%' }, 'showRedLabel').to(assistenzaLabel, .33, { rotation: '2.6deg', transformOrigin: '50% 100%' }).to(assistenzaLabel, .3, { rotation: '-2.9deg', transformOrigin: '50% 100%' }).to(assistenzaLabel, .25, { rotation: '1.6deg', transformOrigin: '50% 100%' }).to(assistenzaLabel, .4, { rotation: '-0.8deg', transformOrigin: '50% 100%' }).to(assistenzaLabel, .4, { rotation: '0deg', transformOrigin: '50% 100%', ease: Elastic.easeOut.config(1, 0.5) });

            showTheFuckingLabelsBlue.timeScale(1.85);

            return showTheFuckingLabelsBlue;
        };

        var showDots = function showDots() {
            var showTheFuckingDots = new TimelineMax();
            showTheFuckingDots.to([redDot, blueDot, yellowDot], .2, { autoAlpha: 1 });
            return showTheFuckingDots;
        };

        var svgFadeOut = function svgFadeOut () {
            var fadeOutSvg = new TimelineMax();
            fadeOutSvg.to(infographic, .2, { autoAlpha: 0 });
            return fadeOutSvg;
        };

//main tl.add(timelines)

        mainTl.add(getDotsWaveTl())
            .add(getDotsRotateTl(), '-=.3').add(drawLines(), '-=0.15').add(showIcons(), '-=0.1').add(showDots(), '-=.5').add('showLabels').add(showLabelsRed(), 'showLabels-=.5').add(showLabelsYellow(), 'showLabels-=.4').add(showLabelsBlue(), 'showLabels-=.3').add(svgFadeOut());

// tl.timeScale()


        //Set intro played cookie
        function setIntroCookie() {
            Cookies.set('introCookie', 'introPlayed', { expires: 0.041 });
            endAnimation();

        }

        function endAnimation () {
         setTimeout(function () {
             $(body).removeClass('introPlaying');
             $(overlayIntro).removeClass('introPlaying');


         }, 100)
        }

    }else {
        TweenLite.to(overlayIntro, .2, { autoAlpha: 0 });
    }//END IF COOKIE





});


