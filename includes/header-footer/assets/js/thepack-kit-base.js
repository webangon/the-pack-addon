// jQuery( window ).on( 'elementor/frontend/init', () => {
//
//     window.elementorFrontend.hooks.addAction('frontend/element_ready/lakit-posts.default', function ($scope) {
//         console.log('aa');
//     });
// } );

(function ($) {
    "use strict";

    function getHeaderHeight(){
        var _height = 0;
        var $stickySection = $('.elementor-location-header .elementor-top-section[data-settings*="sticky_on"]');
        if($stickySection.length){
            _height = $stickySection.innerHeight();
        }
        return _height;
    }

    function checkHeaderHeight(){
        document.documentElement.style.setProperty('--lakit-header-height', getHeaderHeight() + 'px');
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.body.classList.add('lakit--js-ready');
        checkHeaderHeight();
        if(!LaStudioKits.isPageSpeed()){
            LaStudioKits.localCache.validCache(false);
            LaStudioKits.ajaxTemplateHelper.init();
            $('.col-row').each(function (){
                if($(this).closest('[data-lakit_ajax_loadtemplate]').length == 0){
                    $(this).trigger('thepack-kit/LazyloadSequenceEffects');
                }
            })
        }
    });

    $(window).on('load', function (){
        $('.template-loaded[data-lakit_ajax_loadtemplate="true"] .col-row').trigger('thepack-kit/LazyloadSequenceEffects');
    });

    $(document).on('thepack-kit/LazyloadSequenceEffects', '.col-row, .swiper-container', function (e){
        var $this = $(this);
        if( $this.hasClass('swiper-container') ){
            LaStudioKits.LazyLoad( $this, {rootMargin: '0px'} ).observe();
        }
        else{
            LaStudioKits.LazyLoad( $('>*', $this), {rootMargin: '0px'} ).observe();
        }
    });

    $(window).on('load resize', checkHeaderHeight);

    $(window).on('resize', function (){
        setTimeout(function (){
            $('.lakit--enabled .woocommerce-product-gallery').each(function (){
                var _height = $('.woocommerce-product-gallery__wrapper', $(this)).height() + 'px';
                $(this).css('--singleproduct-thumbs-height', _height);
                $('.flex-viewport', $(this)).css('height', _height);
            });
        }, 50);
    });

    $(document).on('thepackkit/woocommerce/single/init_product_slider', function (e, slider) {
        slider.controlNav.eq(slider.animatingTo).closest('li').get(0).scrollIntoView({
            inline: "center",
            block: "nearest",
            behavior: "smooth"
        });
        slider.viewport.closest('.woocommerce-product-gallery').css('--singleproduct-thumbs-height', $(slider.slides[slider.animatingTo]).height() + 'px');
    });

    var LaStudioKits = {
        log: function (...data){
            console.log(...data);
        },
        addedScripts: {},
        addedStyles: {},
        addedAssetsPromises: [],
        carouselAsFor: [],
        localCache: {
            cache_key: typeof ThePackKitSettings.themeName !== "undefined" ? ThePackKitSettings.themeName : 'lakit',
            /**
             * timeout for cache in seconds, default 30 mins
             * @type {number}
             */
            timeout: typeof ThePackKitSettings.cache_ttl !== "undefined" && parseInt(ThePackKitSettings.cache_ttl) > 0 ? parseInt(ThePackKitSettings.cache_ttl) : (60 * 30),
            timeout2: 60 * 10,
            /**
             * @type {{_: number, data: {}}}
             **/
            data:{},
            remove: function (url) {
                delete LaStudioKits.localCache.data[url];
            },
            exist: function (url) {
                return !!LaStudioKits.localCache.data[url] && ((Date.now() - LaStudioKits.localCache.data[url]._) / 1000 < LaStudioKits.localCache.timeout2);
            },
            get: function (url) {
                LaStudioKits.log('Get cache for ' + url);
                return LaStudioKits.localCache.data[url].data;
            },
            set: function (url, cachedData, callback) {
                LaStudioKits.localCache.remove(url);
                LaStudioKits.localCache.data[url] = {
                    _: Date.now(),
                    data: cachedData
                };
                if ("function" == typeof callback && "number" != typeof callback.nodeType) {
                    callback(cachedData)
                }
            },
            hashCode: function (s){
                var hash = 0;
                s = s.toString();
                if (s.length == 0) return hash;

                for (var i = 0; i < s.length; i++) {
                    var char = s.charCodeAt(i);
                    hash = (hash << 5) - hash + char;
                    hash = hash & hash; // Convert to 32bit integer
                }

                return Math.abs(hash);
            },
            validCache: function ( force ){
                var expiry = typeof ThePackKitSettings.local_ttl !== "undefined" && parseInt(ThePackKitSettings.local_ttl) > 0 ? parseInt(ThePackKitSettings.local_ttl) : 60 * 30; // 30 mins
                var cacheKey = LaStudioKits.localCache.cache_key + '_cache_timeout' + LaStudioKits.localCache.hashCode(ThePackKitSettings.homeURL);
                try{
                    var whenCached = localStorage.getItem(cacheKey);
                    if (whenCached !== null || force) {
                        var age = (Date.now() - whenCached) / 1000;
                        if (age > expiry || force) {
                            Object.keys(localStorage).forEach(function (key) {
                                if (key.indexOf(LaStudioKits.localCache.cache_key) === 0) {
                                    localStorage.removeItem(key);
                                }
                            });
                            localStorage.setItem(cacheKey, Date.now());
                        }
                    } else {
                        localStorage.setItem(cacheKey, Date.now());
                    }
                }
                catch (ex) {
                    LaStudioKits.log(ex);
                }
            }
        },
        getCoords: function (elem){
            var box = elem.getBoundingClientRect();
            var body = document.body;
            var docEl = document.documentElement;
            var scrollTop = window.pageYOffset || docEl.scrollTop || body.scrollTop;
            var scrollLeft = window.pageXOffset || docEl.scrollLeft || body.scrollLeft;
            var clientTop = docEl.clientTop || body.clientTop || 0;
            var clientLeft = docEl.clientLeft || body.clientLeft || 0;
            var top  = box.top +  scrollTop - clientTop;
            var left = box.left + scrollLeft - clientLeft;
            return { top: Math.round(top), left: Math.round(left) };
        },
        isRTL: function (){
            return document.body.classList ? document.body.classList.contains('rtl') : /\brtl\b/g.test(document.body.className);
        },
        isPageSpeed: function () {
            return (typeof navigator !== "undefined" && (/(lighthouse|gtmetrix)/i.test(navigator.userAgent.toLocaleLowerCase()) || /mozilla\/5\.0 \(x11; linux x86_64\)/i.test(navigator.userAgent.toLocaleLowerCase())));
        },
        addQueryArg: function (url, key, value) {
            var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
            var separator = url.indexOf('?') !== -1 ? "&" : "?";

            if (url.match(re)) {
                return url.replace(re, '$1' + key + "=" + value + '$2');
            } else {
                return url + separator + key + "=" + value;
            }
        },
        getUrlParameter: function (name, url) {
            if (!url) url = window.location.href;
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        },
        parseQueryString: function (query) {
            var urlparts = query.split("?");
            var query_string = {};

            if (urlparts.length >= 2) {
                var vars = urlparts[1].split("&");

                for (var i = 0; i < vars.length; i++) {
                    var pair = vars[i].split("=");
                    var key = decodeURIComponent(pair[0]);
                    var value = decodeURIComponent(pair[1]); // If first entry with this name

                    if (typeof query_string[key] === "undefined") {
                        query_string[key] = decodeURIComponent(value); // If second entry with this name
                    } else if (typeof query_string[key] === "string") {
                        var arr = [query_string[key], decodeURIComponent(value)];
                        query_string[key] = arr; // If third or later entry with this name
                    } else {
                        query_string[key].push(decodeURIComponent(value));
                    }
                }
            }

            return query_string;
        },
        removeURLParameter: function (url, parameter) {
            var urlparts = url.split('?');

            if (urlparts.length >= 2) {
                var prefix = encodeURIComponent(parameter) + '=';
                var pars = urlparts[1].split(/[&;]/g); //reverse iteration as may be destructive

                for (var i = pars.length; i-- > 0;) {
                    //idiom for string.startsWith
                    if (pars[i].lastIndexOf(prefix, 0) !== -1) {
                        pars.splice(i, 1);
                    }
                }

                url = urlparts[0] + (pars.length > 0 ? '?' + pars.join('&') : "");
                return url;
            } else {
                return url;
            }
        },
        initCarousel: function ($scope) {

            var $carousel = $scope.find('.lakit-carousel').first();

            if ($carousel.length == 0) {
                return;
            }

            if ($carousel.hasClass('inited')) {
                return;
            }

            $carousel.addClass('inited');

            var elementSettings = $carousel.data('slider_options'),
                slidesToShow = parseInt(elementSettings.slidesToShow.desktop) || 1,
                elementorBreakpoints = elementorFrontend.config.responsive.activeBreakpoints,
                carousel_id = elementSettings.uniqueID;

            var swiperOptions = {
                slidesPerView: slidesToShow,
                loop: elementSettings.infinite,
                speed: elementSettings.speed,
                handleElementorBreakpoints: true,
                slidesPerColumn: elementSettings.rows.desktop,
                slidesPerGroup: elementSettings.slidesToScroll.desktop || 1,
                loopAdditionalSlides: 1
            }

            swiperOptions.breakpoints = {};

            var lastBreakpointSlidesToShowValue = 1;
            var defaultLGDevicesSlidesCount = 1;
            Object.keys(elementorBreakpoints).reverse().forEach(function (breakpointName) {
                // Tablet has a specific default `slides_to_show`.
                var defaultSlidesToShow = 'tablet' === breakpointName ? defaultLGDevicesSlidesCount : lastBreakpointSlidesToShowValue;
                swiperOptions.breakpoints[elementorBreakpoints[breakpointName].value] = {
                    slidesPerView: +elementSettings.slidesToShow[breakpointName] || defaultSlidesToShow,
                    slidesPerGroup: +elementSettings.slidesToScroll[breakpointName] || 1,
                    slidesPerColumn: +elementSettings.rows[breakpointName] || 1,
                };
                lastBreakpointSlidesToShowValue = +elementSettings.slidesToShow[breakpointName] || defaultSlidesToShow;
            });

            if (elementSettings.autoplay) {
                swiperOptions.autoplay = {
                    delay: (elementSettings.effect == 'slide' && elementSettings.infiniteEffect ? 10 : elementSettings.autoplaySpeed),
                    disableOnInteraction: elementSettings.pauseOnInteraction,
                    pauseOnMouseEnter: elementSettings.pauseOnHover,
                    reverseDirection: elementSettings.reverseDirection || false,
                };
                if(elementSettings.effect == 'slide' && elementSettings.infiniteEffect){
                    $carousel.addClass('lakit--linear-effect');
                    if(swiperOptions.slidesPerView == 1){
                        swiperOptions.slidesPerView = 'auto';
                        swiperOptions.breakpoints = {};
                        $carousel.addClass('lakit--linear-effect-auto');
                    }
                }
            }
            if (elementSettings.centerMode) {
                swiperOptions.centerInsufficientSlides = true;
                swiperOptions.centeredSlides = true;
                swiperOptions.centeredSlidesBounds = false;
            }

            switch (elementSettings.effect) {
                case 'fade':
                    if (slidesToShow == 1) {
                        swiperOptions.effect = elementSettings.effect;
                        swiperOptions.fadeEffect = {
                            crossFade: true
                        };
                    }
                    break;

                case 'coverflow':
                    swiperOptions.effect = 'coverflow';
                    swiperOptions.grabCursor = true;
                    swiperOptions.centeredSlides = true;
                    swiperOptions.slidesPerView = 'auto';
                    swiperOptions.coverflowEffect = {
                        rotate: 50,
                        stretch: 0,
                        depth: 100,
                        modifier: 1,
                        slideShadows: true
                    };
                    swiperOptions.coverflowEffect = $.extend( {}, {
                        rotate: 0,
                        stretch: 100,
                        depth: 100,
                        modifier: 2.6,
                        slideShadows : true
                    }, elementSettings.coverflowEffect )
                    break;

                case 'cube':
                    swiperOptions.effect = 'cube';
                    swiperOptions.grabCursor = true;
                    swiperOptions.cubeEffect = {
                        shadow: true,
                        slideShadows: true,
                        shadowOffset: 20,
                        shadowScale: 0.94,
                    }
                    swiperOptions.slidesPerView = 1;
                    swiperOptions.slidesPerGroup = 1;
                    break;

                case 'flip':
                    swiperOptions.effect = 'flip';
                    swiperOptions.grabCursor = true;
                    swiperOptions.slidesPerView = 1;
                    swiperOptions.slidesPerGroup = 1;
                    break;

                case 'slide':
                    swiperOptions.effect = 'slide';
                    swiperOptions.grabCursor = true;
                    break;
            }

            if (elementSettings.arrows) {
                swiperOptions.navigation = {
                    prevEl: elementSettings.prevArrow,
                    nextEl: elementSettings.nextArrow
                };
            }
            if (elementSettings.dots) {

                var  _dotType = elementSettings.dotType || 'bullets';
                swiperOptions.pagination = {
                    el: elementSettings.dotsElm || '.lakit-carousel__dots',
                    clickable: true
                };
                if(_dotType != 'custom'){
                    swiperOptions.pagination.type = _dotType
                }
                if (_dotType == 'bullets') {
                    swiperOptions.pagination.dynamicBullets = true;
                    swiperOptions.pagination.renderBullet = function (index, className) {
                        return '<span class="' + className + '">' + (index + 1) + "</span>";
                    }
                }
                if (_dotType == 'custom') {
                    swiperOptions.pagination.modifierClass = 'lakit-swiper-pagination-'
                    swiperOptions.pagination.renderBullet = function (t, e) {
                        return '<span class="' + e + '"><svg width="65px" height="65px" viewBox="0 0 72 72" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"><circle class="time" stroke-width="5" fill="none" stroke-linecap="round" cx="33" cy="33" r="28"></circle></svg></span>'
                    }
                }
            }

            var enableScrollbar = elementSettings.scrollbar || false;

            if (!enableScrollbar) {
                swiperOptions.scrollbar = false;
            }
            else {
                swiperOptions.scrollbar = {
                    el: '.lakit-carousel__scrollbar',
                    draggable: true
                }
            }

            var _has_slidechange_effect = false,
                _slide_change_effect_in = elementSettings.content_effect_in || 'fadeInUp',
                _slide_change_effect_out = elementSettings.content_effect_out || 'fadeOutDown';

            if (elementSettings.content_selector !== undefined && $carousel.find(elementSettings.content_selector).length > 0) {
                _has_slidechange_effect = true;
            }

            if ($carousel.closest('.no-slide-animation').length || $carousel.closest('.slide-no-animation').length) {
                _has_slidechange_effect = false;
            }

            if (elementSettings.direction) {
                swiperOptions.direction = elementSettings.direction;
            }
            if (elementSettings.autoHeight) {
                swiperOptions.autoHeight = elementSettings.autoHeight
            }
            swiperOptions.watchSlidesProgress = true;
            swiperOptions.watchSlidesVisibility = true;
            swiperOptions.parallax = true;

            function findAsForObj(value, key) {
                var _found = [];
                for (var i = 0; i < LaStudioKits.carouselAsFor.length; i++) {
                    if (LaStudioKits.carouselAsFor[i][key] == value) {
                        LaStudioKits.carouselAsFor[i]['index'] = i;
                        _found.push(LaStudioKits.carouselAsFor[i]);
                        break;
                    }
                }
                return _found;
            }

            function makeLoadedAsFor(value, key) {
                var obj = findAsForObj(value, key);
                if (obj.length) {
                    obj[0][key + '_init'] = true;
                }
                return obj;
            }

            if (typeof elementSettings.asFor !== "undefined" && elementSettings.asFor != '' && elementSettings.asFor != '#' && $('#' + elementSettings.asFor).length) {
                var _thumb_swiper = $('#' + elementSettings.asFor).data('swiper');
                if (null === _thumb_swiper || "undefined" === _thumb_swiper) {
                    swiperOptions.thumbs = {
                        swiper: _thumb_swiper,
                    }
                }
                else {
                    LaStudioKits.carouselAsFor.push({
                        main: carousel_id,
                        thumb: elementSettings.asFor,
                        main_init: false,
                        thumb_init: false
                    });
                }
                swiperOptions.slideToClickedSlide = true;
            }

            var $swiperContainer = $scope.find('.swiper-container');

            var Swiper = elementorFrontend.utils.swiper;

            function initSlideContentAnimation( needwaiting ){
                var $sliderContents = $carousel.find('.swiper-slide-active .lakit-template-wrapper .elementor-invisible.lakit-has-entrance-animation');
                $sliderContents.each(function () {
                    var _settings = $(this).data('settings'),
                        animation = elementorFrontend.getCurrentDeviceSetting(_settings, '_animation') || elementorFrontend.getCurrentDeviceSetting(_settings, 'animation'),
                        animationDelay = elementorFrontend.getCurrentDeviceSetting(_settings, '_animation_delay') || elementorFrontend.getCurrentDeviceSetting(_settings, 'animation_delay'),
                        $element = $(this);

                    if(!LaStudioKits.isInViewport(this)){
                        return;
                    }

                    if ('none' === animation) {
                        $element.removeClass('elementor-invisible');
                    }
                    else {
                        setTimeout(function () {
                            $element.removeClass('elementor-invisible').addClass('animated ' + animation);
                        }, animationDelay);
                    }
                });
                if (_has_slidechange_effect) {
                    $carousel.find('.swiper-slide:not(.swiper-slide-visible) ' + elementSettings.content_selector).addClass('no-effect-class').removeClass(_slide_change_effect_in).addClass(_slide_change_effect_out);
                    $carousel.find('.swiper-slide-visible ' + elementSettings.content_selector).removeClass('no-effect-class').removeClass(_slide_change_effect_out).addClass(_slide_change_effect_in);
                }
                const _w_callback = () => {
                    var $InActiveSliderContents = $carousel.find('.swiper-slide:not(.swiper-slide-visible) .lakit-template-wrapper .lakit-has-entrance-animation');
                    $InActiveSliderContents.each(function () {
                        var _settings = $(this).data('settings'),
                            animation = elementorFrontend.getCurrentDeviceSetting(_settings, '_animation') || elementorFrontend.getCurrentDeviceSetting(_settings, 'animation');
                        if ('none' === animation) {
                            $(this).removeClass('animated').addClass('elementor-invisible');
                        }
                        else {
                            $(this).removeClass('animated ' + animation).addClass('elementor-invisible');
                        }
                    });
                }
                if(needwaiting){
                    setTimeout(_w_callback, 1000);
                }
                else{
                    _w_callback();
                }
            }

            const totalSlides = $carousel.find('.swiper-wrapper').first().find('.swiper-slide').length;

            $swiperContainer.trigger('thepack-kit/LazyloadSequenceEffects');

            new Swiper($swiperContainer, swiperOptions).then(function (SwiperInstance) {

                if(totalSlides < 5 && SwiperInstance.pagination.$el){
                    SwiperInstance.pagination.$el.addClass('no-bullets-dynamic');
                }

                if(elementSettings.autoplay && elementSettings.pauseOnHover && typeof SwiperInstance.autoplay !== "undefined" && typeof SwiperInstance.autoplay.onMouseEnter === "undefined"){
                    $swiperContainer.on('mouseenter', function (){
                        SwiperInstance.autoplay.stop();
                    }).on('mouseleave', function (){
                        SwiperInstance.autoplay.start();
                    });
                }

                if(elementSettings.autoHeight){
                    SwiperInstance.wrapperEl.style.height = 'auto';
                }

                $carousel.css('--data-autoplay-speed', SwiperInstance.params.autoplay.delay + 'ms');

                $swiperContainer.data('swiper', SwiperInstance);

                $swiperContainer.find('.elementor-top-section').trigger('thepack-kit/section/calculate-container-width');

                initSlideContentAnimation(true);

                var ob1 = makeLoadedAsFor(carousel_id, 'thumb');
                var ob2 = makeLoadedAsFor(carousel_id, 'main');

                if (ob1.length && ob1[0].main_init && ob1[0].thumb_init) {
                    var _main_swiper = $('#' + ob1[0].main).data('swiper');
                    _main_swiper.thumbs.swiper = $('#' + ob1[0].thumb).data('swiper');
                    _main_swiper.thumbs.init();
                }
                if (ob2.length && ob2[0].main_init && ob2[0].thumb_init) {
                    var _main_swiper = $('#' + ob2[0].main).data('swiper');
                    _main_swiper.thumbs.swiper = $('#' + ob2[0].thumb).data('swiper');
                    _main_swiper.thumbs.init();
                }

                if (_has_slidechange_effect) {
                    $carousel.find(elementSettings.content_selector).addClass('animated no-effect-class');
                    $carousel.find('.swiper-slide-visible ' + elementSettings.content_selector).removeClass('no-effect-class').addClass(_slide_change_effect_in);
                }

                SwiperInstance.on('slideChange', function () {
                    if ($swiperContainer.hasClass(this.params.thumbs.thumbsContainerClass)) {
                        this.clickedIndex = this.activeIndex;
                        this.clickedSlide = this.slides[this.clickedIndex];
                        this.emit('tap');
                    }
                });

                SwiperInstance.on('slideChangeTransitionEnd', function (){
                    initSlideContentAnimation(false);
                });

                SwiperInstance.on('beforeResize', function (){
                    SwiperInstance.slides.each( (_i,_sl) => {
                        _sl.style.width = '';
                    } )
                })

                $('.elementor-motion-effects-element', $scope).trigger('resize');

                $(document).trigger('thepack-kit/carousel/init_success', { swiperContainer: $swiperContainer, SwiperInstance: SwiperInstance, parentContainer: $scope });
            });

        },
        initMasonry: function ($scope) {
            var $container = $scope.find('.lakit-masonry-wrapper').first();

            if ($container.length == 0) {
                return;
            }

            var $list_wrap = $scope.find($container.data('lakitmasonry_wrap')),
                itemSelector = $container.data('lakitmasonry_itemselector'),
                $advanceSettings = $container.data('lakitmasonry_layouts') || false,
                $itemsList = $scope.find(itemSelector),
                $masonryInstance,
                _configs;

            if ($list_wrap.length) {

                if(typeof imagesLoaded !== 'function' && !LaStudioKits.addedScripts.hasOwnProperty('imagesloaded')){
                    LaStudioKits.addedAssetsPromises.push(LaStudioKits.loadScriptAsync('imagesloaded', ThePackKitSettings.resources['imagesloaded'], '', true));
                }
                if(typeof jQuery.fn.isotope === "undefined" && !LaStudioKits.addedScripts.hasOwnProperty('jquery-isotope')){
                    LaStudioKits.addedAssetsPromises.push(LaStudioKits.loadScriptAsync('jquery-isotope', ThePackKitSettings.resources['jquery-isotope'], '', true));
                }

                Promise.all(LaStudioKits.addedAssetsPromises).then( () => {
                    if ($advanceSettings !== false) {
                        $(document).trigger('thepack-kit/masonry/calculate-item-sizes', [$container, false]);
                        $(window).on('resize', function () {
                            $(document).trigger('thepack-kit/masonry/calculate-item-sizes', [$container, true]);
                        });
                        _configs = {
                            itemSelector: itemSelector,
                            percentPosition: false,
                            masonry: {
                                columnWidth: 1,
                                gutter: 0,
                            },
                        }
                    }
                    else {
                        _configs = {
                            itemSelector: itemSelector,
                            percentPosition: false,
                        }
                    }

                    $masonryInstance = $list_wrap.isotope(_configs);

                    $('img', $itemsList).imagesLoaded().progress(function (instance, image) {
                        var $image = $(image.img),
                            $parentItem = $image.closest(itemSelector);
                        $parentItem.addClass('item-loaded');
                        if ($masonryInstance) {
                            $masonryInstance.isotope('layout');
                        }
                    });

                }, ( reason ) => {
                    LaStudioKits.log('initMasonry error', reason)
                } )

            }
        },
        initCustomHandlers: function () {
            $(document)
                .on('click', '.thepack-kit .lakit-pagination_ajax_loadmore a', function (e){
                    e.preventDefault();
                    if ($('body').hasClass('elementor-editor-active')) {
                        return false;
                    }

                    var $kitWrap, $parentContainer, $container, ajaxType, $parentNav, widgetId, itemSelector, templateId, pagedKey;
                    $parentNav = $(this).closest('.lakit-pagination');
                    $kitWrap = $(this).closest('.thepack-kit');
                    widgetId = $kitWrap.data('id');

                    if ($parentNav.hasClass('doing-ajax')) {
                        return false;
                    }

                    templateId = $kitWrap.closest('.elementor[data-elementor-id]').data('elementor-id');

                    if($kitWrap.hasClass('elementor-lakit-wooproducts')){
                        $container = $kitWrap.find('.lakit-products__list');
                        $parentContainer = $kitWrap.find('.lakit-products');
                        itemSelector = '.lakit-product.product_item';
                        var tmpClass = $parentContainer.closest('.woocommerce').attr('class').match(/\blakit_wc_widget_([^\s]*)/);
                        if (tmpClass !== null && tmpClass[1]) {
                            pagedKey = 'product-page-' + tmpClass[1];
                        }
                        else{
                            pagedKey = 'paged';
                        }
                    }
                    else{
                        $container = $($parentNav.data('container'));
                        $parentContainer = $($parentNav.data('parent-container'));
                        itemSelector = $parentNav.data('item-selector');
                        pagedKey = $parentNav.data('ajax_request_id');
                    }

                    ajaxType = 'load_widget';
                    if($kitWrap.find('div[data-widget_current_query="yes"]').length > 0){
                        ajaxType = 'load_fullpage';
                        pagedKey = 'paged';
                    }

                    if (!$('a.next', $parentNav).length) {
                        return false
                    }

                    $parentNav.addClass('doing-ajax');
                    $parentContainer.addClass('doing-ajax');

                    const success_func = function (res, israw) {

                        var $response;

                        if(israw){
                            $response = $('<div></div>').html(res);
                        }
                        else{
                            $response = $(res);
                        }

                        var $data = $response.find('.elementor-element-' + widgetId + ' ' + itemSelector);

                        if ($parentContainer.find('.swiper-container').length > 0) {
                            var swiper = $parentContainer.find('.swiper-container').get(0).swiper;
                            swiper.appendSlide($data);
                            swiper.slideTo(swiper.passedParams.slidesPerView + swiper.realIndex);
                        }
                        else if ($container.data('isotope')) {
                            $container.append($data);
                            $container.isotope('insert', $data);
                            $(document).trigger('thepack-kit/masonry/calculate-item-sizes', [$parentContainer, true]);

                            $('img', $data).imagesLoaded().progress(function (instance, image) {
                                var $image = $(image.img),
                                    $parentItem = $image.closest(itemSelector);
                                $parentItem.addClass('item-loaded');
                                $container.isotope('layout');
                            });
                        }
                        else {
                            $data.addClass('fadeIn animated').appendTo($container);
                        }

                        $parentContainer.removeClass('doing-ajax');
                        $parentNav.removeClass('doing-ajax lakit-ajax-load-first');

                        if ($response.find( '.elementor-element-' + widgetId + ' .lakit-ajax-pagination').length) {
                            var $new_pagination = $response.find( '.elementor-element-' + widgetId + ' .lakit-ajax-pagination');
                            $parentNav.replaceWith($new_pagination);
                            $parentNav = $new_pagination;
                        } else {
                            $parentNav.addClass('nothingtoshow');
                        }

                        if ($('a.next', $parentNav).length == 0) {
                            $parentNav.addClass('nothingtoshow');
                        }

                        $(document).trigger('thepack-kit/ajax-loadmore/success', {
                            parentContainer: $parentContainer,
                            contentHolder: $container,
                            pagination: $parentNav,
                            newData: $response
                        });
                    };

                    var url_request = $('a.next', $parentNav).attr('href').replace(/^\//, '');

                    if( ajaxType == 'load_widget' ){
                        var _tmpURL = url_request;
                        url_request = window.ThePackKitSettings.ajaxUrl;
                        var reqData = {
                            'action': 'lakit_ajax',
                            '_nonce': window.ThePackKitSettings.ajaxNonce,
                            'actions': JSON.stringify({
                                'elementor_widget' : {
                                    'action': 'elementor_widget',
                                    'data': {
                                        'template_id': templateId,
                                        'widget_id' : widgetId,
                                        'dev': window.ThePackKitSettings.devMode
                                    }
                                }
                            }),
                        };

                        if(ThePackKitSettings.useFrontAjax == 'true'){
                            reqData['lakit-ajax'] = 'yes';
                            delete reqData['action'];
                            url_request = window.location.href;
                        }

                        reqData[pagedKey] = LaStudioKits.getUrlParameter(pagedKey, _tmpURL);
                        reqData['lakitpagedkey'] = pagedKey;

                        url_request = LaStudioKits.removeURLParameter(url_request, '_');

                        var ajaxOpts = {
                            url: url_request,
                            type: ThePackKitSettings.useFrontAjax == 'true' ? 'GET' : 'POST',
                            cache: true,
                            dataType: 'html',
                            ajax_request_id: templateId + '_' + widgetId + '_' + pagedKey + '_' + LaStudioKits.getUrlParameter(pagedKey, _tmpURL),
                            data: reqData,
                            success: function (resp) {
                                var res = JSON.parse(resp);
                                var response = res.data.responses.elementor_widget.data.template_content;
                                success_func(response, true);
                            }
                        };
                    }
                    else{
                        url_request = LaStudioKits.removeURLParameter(url_request, '_');
                        var ajaxOpts = {
                            url: url_request,
                            type: "GET",
                            cache: true,
                            dataType: 'html',
                            ajax_request_id: LaStudioKits.getUrlParameter(pagedKey, url_request),
                            success: function (resp) {
                                success_func(resp, false);
                            }
                        };
                    }

                    $.ajax(ajaxOpts)
                })
                .on('click', '.thepack-kit .lakit-ajax-pagination .page-numbers a', function (e){
                    e.preventDefault();
                    if ($('body').hasClass('elementor-editor-active')) {
                        return false;
                    }

                    var $kitWrap, $parentContainer, $container, ajaxType, $parentNav, widgetId, itemSelector, templateId, pagedKey;
                    $parentNav = $(this).closest('.lakit-pagination');
                    $kitWrap = $(this).closest('.thepack-kit');
                    widgetId = $kitWrap.data('id');

                    if ($parentNav.hasClass('doing-ajax')) {
                        return false;
                    }

                    templateId = $kitWrap.closest('.elementor[data-elementor-id]').data('elementor-id');

                    if($kitWrap.hasClass('elementor-lakit-wooproducts')){
                        $container = $kitWrap.find('.lakit-products__list');
                        $parentContainer = $kitWrap.find('.lakit-products');
                        itemSelector = '.lakit-product.product_item';
                        var tmpClass = $parentContainer.closest('.woocommerce').attr('class').match(/\blakit_wc_widget_([^\s]*)/);
                        if (tmpClass !== null && tmpClass[1]) {
                            pagedKey = 'product-page-' + tmpClass[1];
                        }
                        else{
                            pagedKey = 'paged';
                        }
                    }
                    else{
                        $container = $($parentNav.data('container'));
                        $parentContainer = $($parentNav.data('parent-container'));
                        itemSelector = $parentNav.data('item-selector');
                        pagedKey = $parentNav.data('ajax_request_id');
                    }

                    ajaxType = 'load_widget';
                    if($kitWrap.find('div[data-widget_current_query="yes"]').length > 0){
                        ajaxType = 'load_fullpage';
                        pagedKey = 'paged';
                    }
                    $parentNav.addClass('doing-ajax');
                    $parentContainer.addClass('doing-ajax');

                    const success_func = function (res, israw) {

                        var $response;

                        if(israw){
                            $response = $('<div></div>').html(res);
                        }
                        else{
                            $response = $(res);
                        }

                        var $data = $response.find('.elementor-element-' + widgetId + ' ' + itemSelector);

                        if ($parentContainer.find('.swiper-container').length > 0) {
                            var swiper = $parentContainer.find('.swiper-container').get(0).swiper;
                            swiper.removeAllSlides();
                            swiper.appendSlide($data);
                        }
                        else if ($container.data('isotope')) {
                            $container.isotope('remove', $container.isotope('getItemElements'));
                            $container.isotope('insert', $data);
                            $(document).trigger('thepack-kit/masonry/calculate-item-sizes', [$parentContainer, true]);

                            $('img', $data).imagesLoaded().progress(function (instance, image) {
                                var $image = $(image.img),
                                    $parentItem = $image.closest(itemSelector);
                                $parentItem.addClass('item-loaded');
                                $container.isotope('layout');
                            });
                        }
                        else {
                            $data.addClass('fadeIn animated').appendTo($container.empty());
                        }

                        $parentContainer.removeClass('doing-ajax');
                        $parentNav.removeClass('doing-ajax lakit-ajax-load-first');

                        if ($response.find( '.elementor-element-' + widgetId + ' .lakit-ajax-pagination').length) {
                            var $new_pagination = $response.find( '.elementor-element-' + widgetId + ' .lakit-ajax-pagination');
                            $parentNav.replaceWith($new_pagination);
                            $parentNav = $new_pagination;
                        }
                        else {
                            $parentNav.addClass('nothingtoshow');
                        }

                        if($response.find( '.elementor-element-' + widgetId + ' .woocommerce-result-count').length && $kitWrap.find('.woocommerce-result-count').length){
                            $kitWrap.find('.woocommerce-result-count').replaceWith($response.find( '.elementor-element-' + widgetId + ' .woocommerce-result-count'));
                        }

                        $('html,body').animate({
                            'scrollTop': $parentContainer.offset().top - getHeaderHeight() - 50
                        }, 400);

                        $(document).trigger('thepack-kit/ajax-pagination/success', {
                            parentContainer: $parentContainer,
                            contentHolder: $container,
                            pagination: $parentNav,
                            newData: $response
                        });
                    };

                    var url_request = e.target.href.replace(/^\//, '');

                    if( ajaxType == 'load_widget' ){
                        var _tmpURL = url_request;
                        url_request = window.ThePackKitSettings.ajaxUrl;
                        var reqData = {
                            'action': 'lakit_ajax',
                            '_nonce': window.ThePackKitSettings.ajaxNonce,
                            'actions': JSON.stringify({
                                'elementor_widget' : {
                                    'action': 'elementor_widget',
                                    'data': {
                                        'template_id': templateId,
                                        'widget_id' : widgetId,
                                        'dev': window.ThePackKitSettings.devMode
                                    }
                                }
                            }),
                        };

                        if(ThePackKitSettings.useFrontAjax == 'true'){
                            reqData['lakit-ajax'] = 'yes';
                            delete reqData['action'];
                            url_request = window.location.href;
                        }

                        reqData[pagedKey] = LaStudioKits.getUrlParameter(pagedKey, _tmpURL);
                        reqData['lakitpagedkey'] = pagedKey;

                        url_request = LaStudioKits.removeURLParameter(url_request, '_');

                        var ajaxOpts = {
                            url: url_request,
                            type: ThePackKitSettings.useFrontAjax == 'true' ? 'GET' : 'POST',
                            cache: true,
                            dataType: 'html',
                            ajax_request_id: templateId + '_' + widgetId + '_' + pagedKey + '_' + LaStudioKits.getUrlParameter(pagedKey, _tmpURL),
                            data: reqData,
                            success: function (resp) {
                                var res = JSON.parse(resp);
                                var response = res.data.responses.elementor_widget.data.template_content;
                                success_func(response, true);
                            }
                        };
                    }
                    else{
                        url_request = LaStudioKits.removeURLParameter(url_request, '_');
                        var ajaxOpts = {
                            url: url_request,
                            type: "GET",
                            cache: true,
                            dataType: 'html',
                            ajax_request_id: LaStudioKits.getUrlParameter(pagedKey, url_request),
                            success: function (resp) {
                                success_func(resp, false);
                            }
                        };
                    }

                    $.ajax(ajaxOpts)

                })
                .on('click', '[data-lakit-element-link]', function (e) {
                    var $wrapper = $(this),
                        data = $wrapper.data('lakit-element-link'),
                        id = $wrapper.data('id'),
                        anchor = document.createElement('a'),
                        anchorReal;

                    anchor.id = 'lastudio-wrapper-link-' + id;
                    anchor.href = data.url;
                    anchor.target = data.is_external ? '_blank' : '_self';
                    anchor.rel = data.nofollow ? 'nofollow noreferer' : '';
                    anchor.style.display = 'none';

                    document.body.appendChild(anchor);

                    anchorReal = document.getElementById(anchor.id);
                    anchorReal.click();
                    anchorReal.remove();
                })
                .on('click', '.lakit-search__popup-trigger,.lakit-search__popup-close', function (e) {
                    e.preventDefault();

                    var $this = $(this),
                        $widget = $this.closest('.lakit-search'),
                        $input = $('.lakit-search__field', $widget),
                        activeClass = 'lakit-search-popup-active',
                        transitionIn = 'lakit-transition-in',
                        transitionOut = 'lakit-transition-out';

                    if (!$widget.hasClass(activeClass)) {
                        $widget.addClass(transitionIn);
                        setTimeout(function () {
                            $widget.removeClass(transitionIn);
                            $widget.addClass(activeClass);
                        }, 300);
                        $input.focus();
                    } else {
                        $widget.addClass(transitionOut);
                        setTimeout(function () {
                            $widget.removeClass(activeClass);
                            $widget.removeClass(transitionOut);
                        },300);
                    }
                })
                .on('click', '.lakit-masonry_filter .lakit-masonry_filter-item', function (e){
                    e.preventDefault();
                    var $wrap = $(this).closest('.lakit-masonry_filter'),
                        $isotopeInstance = $($wrap.data('lakitmasonry_container')),
                        _filter = $(this).data('filter');
                    if (_filter != '*'){
                        _filter = '.' + _filter;
                    }
                    if ($isotopeInstance.data('isotope')) {
                        $(this).addClass('active').siblings('.lakit-masonry_filter-item').removeClass('active');
                        $isotopeInstance.isotope({
                            filter: _filter
                        });
                    }
                })
                .on('thepack-kit/masonry/calculate-item-sizes', function (e, $isotope_container, need_relayout) {
                    var masonrySettings = $isotope_container.data('lakitmasonry_layouts') || false,
                        $isotopeInstance = $isotope_container.find($isotope_container.data('lakitmasonry_wrap'));

                    if (masonrySettings !== false) {
                        var win_w = $(window).width(),
                            selector = $isotope_container.data('lakitmasonry_itemselector'),
                            active_on = masonrySettings.disable_on;

                        var _needParse = false;
                        if(0 > parseInt($isotope_container.css('margin-left'))){
                            _needParse = true;
                        }

                        if (win_w > parseInt(active_on)) {
                            $isotope_container.addClass('lakit-masonry--cover-bg');

                            var _base_w = masonrySettings.item_width,
                                _base_h = masonrySettings.item_height,
                                _container_width_base = masonrySettings.container_width,
                                _container_width = $isotope_container.width(),
                                item_per_page = Math.round(_container_width_base / _base_w),
                                itemwidth = _container_width / item_per_page,
                                margin = parseInt($isotope_container.data('lakitmasonry_itemmargin') || 0),
                                dimension = (_base_h ? parseFloat(_base_w / _base_h) : 1),
                                layout_mapping = masonrySettings.layout || [{w: 1, h: 1}];

                            var _idx = 0,
                                _idx2 = 0;

                            $(selector, $isotope_container).each(function () {
                                var _w2 = Math.floor(itemwidth * (layout_mapping[_idx]['w']) - (margin / 2));
                                $(this)
                                    .css({
                                        'width': _needParse ? Math.floor(_w2) : _w2,
                                        'height': _base_h ? Math.floor(itemwidth / dimension * (layout_mapping[_idx]['h'])) : 'auto',
                                        '--item-height': _base_h ? Math.floor(itemwidth / dimension * (layout_mapping[_idx]['h'])) : 'auto',
                                    })
                                    .addClass('lakit-disable-cols-style');

                                if(ThePackKitSettings.isDebug){
                                    $(this).attr('data-lakitmansory--item_setting', JSON.stringify({
                                        'index': _idx2 + '_' + _idx,
                                        'itemwidth': itemwidth,
                                        'layout': layout_mapping[_idx]
                                    }));
                                }

                                _idx++;
                                if (_idx == layout_mapping.length) {
                                    _idx2++;
                                    _idx = 0;
                                }
                            });
                        } else {
                            $isotope_container.removeClass('lakit-masonry--cover-bg');
                            $(selector, $isotope_container).css({
                                'width': '',
                                'height': ''
                            }).removeClass('lakit-disable-cols-style');
                        }
                    }
                    if (need_relayout) {
                        if ($isotopeInstance.data('isotope')) {
                            $isotopeInstance.isotope('layout');
                        }
                    }
                })
                .on('keyup', function (e) {
                    if(e.keyCode == 27){
                        $('.lakit-search').removeClass('lakit-search-popup-active');
                        $('.lakit-cart').removeClass('lakit-cart-open');
                        $('.lakit-hamburger-panel').removeClass('open-state');
                        $('html').removeClass('lakit-hamburger-panel-visible');
                    }
                })
                .on('thepack-kit/section/calculate-container-width', '.elementor-top-section', function (e){
                    var $scope = $(this);
                    var $child_container = $scope.find('>.elementor-container');
                    if(!$child_container.length){
                        $child_container = $scope;
                    }
                    $child_container.css('--lakit-section-width', $child_container.width() + 'px');
                    $(window).on('resize', function (){
                        $child_container.css('--lakit-section-width', $child_container.width() + 'px');
                    });
                })
                .on('click', function (e){
                    if( $(e.target).closest('.elementor-widget-lakit-addtocart').length == 0
                        && $(e.target).closest('.lakit-cart').length == 0 && $(e.target).closest('.wrap-addto').length == 0
                        && $(e.target).closest('form.cart').length == 0 && $(e.target).closest('div.cart').length == 0
                        && $(e.target).closest('.product-action').length == 0 && $(e.target).closest('.lakitp-zone').length == 0
                        && $(e.target).closest('.featherlight').length == 0 && $(e.target).closest('.select2-container').length == 0

                    ) {
                        $('.lakit-cart').removeClass('lakit-cart-open');
                    }
                    if($(e.target).is('.lakit-cart__overlay')){
                        $('.lakit-cart').removeClass('lakit-cart-open');
                    }
                });

            var scroll_direction = 'none',
                last_scroll = window.scrollY;
            window.addEventListener('scroll', () => {
                let currY = window.scrollY;
                scroll_direction = currY > last_scroll ? 'down' : currY === last_scroll ? 'none' : 'up';
                last_scroll = currY;
            });

            window.addEventListener('scroll', () => {
                const infiniteElements = document.querySelectorAll('.active-loadmore.active-infinite-loading');
                infiniteElements.forEach( targetElement  => {
                    const BoundingClientRect = targetElement.getBoundingClientRect();
                    if(scroll_direction == 'down' && BoundingClientRect.top > 10 && BoundingClientRect.top <= window.innerHeight && !targetElement.classList.contains('doing-ajax') && !targetElement.classList.contains('nothingtoshow') ){
                        $('.lakit-pagination_ajax_loadmore a', $(targetElement)).trigger('click');
                    }
                } )
            })
        },
        isEditMode: function () {
            return Boolean(elementorFrontend.isEditMode());
        },
        mobileAndTabletCheck: function () {
            return ( (('ontouchstart' in window) || (navigator.maxTouchPoints > 0) || (navigator.msMaxTouchPoints > 0)) && (window.innerWidth < 1400) )
        },
        onSearchSectionActivated: function ($scope) {
            if (!window.elementorFrontend) {
                return;
            }
            if (!window.LaStudioKitEditor) {
                return;
            }
            if (!window.LaStudioKitEditor.activeSection) {
                return;
            }
            var section = window.LaStudioKitEditor.activeSection;
            var isPopup = -1 !== ['section_popup_style', 'section_popup_close_style', 'section_form_style'].indexOf(section);
            if (isPopup) {
                $scope.find('.lakit-search').addClass('lakit-search-popup-active');
            }
            else {
                $scope.find('.lakit-search').removeClass('lakit-search-popup-active');
            }
        },
        loadStyle: function (style, uri) {

            if (LaStudioKits.addedStyles.hasOwnProperty(style) && LaStudioKits.addedStyles[style] === uri) {
                return style;
            }

            if (!uri) {
                return;
            }

            LaStudioKits.addedStyles[style] = uri;

            return new Promise(function (resolve, reject) {
                var tag = document.createElement('link');

                tag.id = style + '-css';
                tag.rel = 'stylesheet';
                tag.href = uri;
                tag.type = 'text/css';
                tag.media = 'all';
                tag.onload = function () {
                    resolve(style);
                };
                tag.onerror = function () {
                    reject(`Can not load css file "${uri}"`);
                }

                document.head.appendChild(tag);
            });
        },
        loadScriptAsync: function (script, uri, callback, async) {
            if (LaStudioKits.addedScripts.hasOwnProperty(script)) {
                return script;
            }
            if (!uri) {
                return;
            }
            LaStudioKits.addedScripts[script] = uri;
            return new Promise(function (resolve, reject) {
                var tag = document.createElement('script');

                tag.src = uri;
                tag.id = script + '-js';
                tag.async = async;
                tag.onload = function () {
                    resolve(script);
                    if ("function" == typeof callback && "number" != typeof callback.nodeType) {
                        callback();
                    }
                };

                tag.onerror = function () {
                    reject(`Can not load javascript file "${uri}"`);
                    if ("function" == typeof callback && "number" != typeof callback.nodeType) {
                        callback();
                    }
                }

                document.head.appendChild(tag);
            });
        },
        elementorFrontendInit: function ($container, reinit_global_trigger) {
            if( typeof window.elementorFrontend.hooks === "undefined"){
                return;
            }
            LaStudioKits.detectWidgetsNotInHeader();
            if(reinit_global_trigger){
                $(window).trigger('elementor/frontend/init');
            }
            $container.removeClass('need-reinit-js');
            $container.find('[data-element_type]').each(function () {
                var $this = $(this),
                    elementType = $this.data('element_type');

                if (!elementType) {
                    return;
                }

                try {
                    if ('widget' === elementType) {
                        elementType = $this.data('widget_type');
                        window.elementorFrontend.hooks.doAction('frontend/element_ready/widget', $this, $);
                    }

                    window.elementorFrontend.hooks.doAction('frontend/element_ready/global', $this, $);
                    window.elementorFrontend.hooks.doAction('frontend/element_ready/' + elementType, $this, $);

                } catch (err) {
                    LaStudioKits.log(err);
                    $this.remove();
                    return false;
                }
            });
        },
        initAnimationsHandlers: function ($selector) {
            $selector.find('[data-element_type]').each(function () {
                var $this = $(this),
                    elementType = $this.data('element_type');

                if (!elementType) {
                    return;
                }
                window.elementorFrontend.hooks.doAction('frontend/element_ready/global', $this, $);
            });
            setTimeout(() => {
                $('.elementor-motion-effects-element', $selector).trigger('resize');
            }, 500);
            $(document).trigger('thepack-kit/hamburger/after', {
                parentContainer: $selector
            });
        },
        hamburgerPanel: function ($scope) {

            var wid = $scope.data('id'),
                _wid_tpl_id = $scope.find('.lakit-hamburger-panel__content').attr('data-template-id'),
                _need_add_remove = true,
                $wContent = $scope.find('>.elementor-widget-container').clone();

            if( !!$scope.data('hamburgerTemplateId') && ( _wid_tpl_id == $scope.data('hamburgerTemplateId') ) ){
                _need_add_remove = false;
            }
            else{
                $scope.data('hamburgerTemplateId', _wid_tpl_id);
            }

            if ($('.lakit-site-wrapper > .elementor-location-header >.lakit-burger-wrapall').length == 0) {
                $('<div/>').addClass('lakit-burger-wrapall').appendTo($('.lakit-site-wrapper > .elementor-location-header'));
            }

            var $burger_wrap_all = $('.lakit-burger-wrapall');

            if ( _need_add_remove && $('.elementor-element-' + wid, $burger_wrap_all).length) {
                $('.elementor-element-' + wid, $burger_wrap_all).remove();
            }

            var $new_scope = $scope;

            if($scope.closest('.elementor-location-header').length){
                if(_need_add_remove){
                    $('<div/>').addClass('elementor-element elementor-element-' + wid).append($wContent).appendTo($burger_wrap_all);
                }
                $('.thepack-kit.elementor-element-' + wid + ' .lakit-hamburger-panel__instance').remove();
                $new_scope = $('.elementor-element-' + wid, $burger_wrap_all);
                $('.lakit-hamburger-panel__toggle', $new_scope).remove();
            }

            var $panel = $('.lakit-hamburger-panel', $new_scope),
                $toggleButton = $('.lakit-hamburger-panel__toggle', $scope),
                $instance = $('.lakit-hamburger-panel__instance', $new_scope),
                $cover = $('.lakit-hamburger-panel__cover', $new_scope),
                $inner = $('.lakit-hamburger-panel__inner', $new_scope),
                $closeButton = $('.lakit-hamburger-panel__close-button', $new_scope),
                $html = $('html'),
                settings = $panel.data('settings') || {},
                $panelInstance = $('.elementor-element-' + wid + ' .lakit-hamburger-panel');

            if (!settings['ajaxTemplate']) {
                LaStudioKits.elementorFrontendInit($inner, false);
            }

            $toggleButton.on('click', function (e) {
                e.preventDefault();
                if (!$panel.hasClass('open-state')) {
                    $panelInstance.addClass('open-state');
                    $html.addClass('lakit-hamburger-panel-visible');
                    LaStudioKits.initAnimationsHandlers($inner);
                } else {
                    $panelInstance.removeClass('open-state');
                    $html.removeClass('lakit-hamburger-panel-visible');
                }
            });
            $closeButton.on('click', function (e) {
                e.preventDefault();
                if (!$panel.hasClass('open-state')) {
                    $panelInstance.addClass('open-state');
                    $html.addClass('lakit-hamburger-panel-visible');
                    LaStudioKits.initAnimationsHandlers($inner);
                }
                else {
                    $panelInstance.removeClass('open-state');
                    $html.removeClass('lakit-hamburger-panel-visible');
                }
            });

            $(document).on('click.lakitHamburgerPanel', function (event) {

                if (($(event.target).closest('.lakit-hamburger-panel__toggle').length || $(event.target).closest('.lakit-hamburger-panel__instance').length)
                    && !$(event.target).closest('.lakit-hamburger-panel__cover').length
                ) {
                    return;
                }

                if (!$panel.hasClass('open-state')) {
                    return;
                }

                $('.elementor-element-' + wid + ' .lakit-hamburger-panel').removeClass('open-state');

                if (!$(event.target).closest('.lakit-hamburger-panel__toggle').length) {
                    $html.removeClass('lakit-hamburger-panel-visible');
                }

                event.stopPropagation();
            });
        },
        wooCard: function ($scope) {
            if (window.LaStudioKitEditor && window.LaStudioKitEditor.activeSection) {
                let section = window.LaStudioKitEditor.activeSection,
                    isCart = -1 !== ['cart_list_style', 'cart_list_items_style', 'cart_buttons_style'].indexOf(section);

                $('.widget_shopping_cart_content').empty();
                $(document.body).trigger('wc_fragment_refresh');
            }

            var $target = $('.lakit-cart', $scope),
                $toggle = $('.lakit-cart__heading-link', $target),
                settings = $target.data('settings'),
                firstMouseEvent = true,
                wid = $scope.data('id'),
                $cartList = $('.lakit-cart__list', $scope),
                $wContent;

            $('.lakit-cart__list', $scope).remove();
            $wContent = $scope.find('>.elementor-widget-container').clone();

            switch (settings['triggerType']) {
                case 'hover':
                    hoverType();
                    break;
                case 'click':
                    clickType();
                    break;
                case 'none':
                    noneType();
                    break;
            }

            if ($('.lakit-site-wrapper > .elementor-location-header >.lakit-burger-wrapall').length == 0) {
                $('<div/>').addClass('lakit-burger-wrapall').appendTo($('.lakit-site-wrapper > .elementor-location-header'));
            }
            var $burger_wrap_all = $('.lakit-burger-wrapall');

            if ( $('.elementor-element-' + wid, $burger_wrap_all).length) {
                $('.elementor-element-' + wid, $burger_wrap_all).remove();
            }

            if($scope.closest('.elementor-location-header').length){
                $cartList.insertAfter($('.lakit-cart__heading', $wContent));
                $('.lakit-cart__heading', $wContent).remove();
                $('<div/>').addClass('elementor-element elementor-element-' + wid).append($wContent).appendTo($burger_wrap_all);
            }

            $('.elementor-element-'+wid+' .lakit-cart').on('click', '.lakit-cart__close-button', function (event) {
                if (!$target.hasClass('lakit-cart-open-proccess')) {
                    $('.elementor-element-'+wid+' .lakit-cart').removeClass('lakit-cart-open');
                }
            });
            function hoverType() {

                const $newTarget = $('.elementor-element-'+wid+' .lakit-cart');

                $newTarget.on('mouseenter mouseleave', function (event) {
                    if (firstMouseEvent && 'mouseleave' === event.type) {
                        return;
                    }
                    if (firstMouseEvent && 'mouseenter' === event.type) {
                        firstMouseEvent = false;
                    }
                    if (!$newTarget.hasClass('lakit-cart-open-proccess')) {
                        $newTarget.toggleClass('lakit-cart-open');
                    }
                });

            }

            function clickType() {
                $toggle.on('click', function (event) {
                    event.preventDefault();

                    if (!$target.hasClass('lakit-cart-open-proccess')) {
                        $('.elementor-element-'+wid+' .lakit-cart').toggleClass('lakit-cart-open');
                    }
                });
            }

            function noneType(){
                $toggle.on('click', function (event){
                    if( $('.lakit-burger-wrapall .lakit-cart').length > 0 ){
                        event.preventDefault();
                        $('.lakit-cart').addClass('lakit-cart-open');
                    }
                });
            }
        },
        wooGallery: function ($scope) {
            if (LaStudioKits.isEditMode()) {
                $('.woocommerce-product-gallery', $scope).wc_product_gallery();
            }

            var centerdots_cb = function () {

                $('.woocommerce-product-gallery__image', $scope).each(function (){
                    $(this).trigger('zoom.destroy')
                })

                if ($scope.find('.flex-viewport').length) {
                    $scope.find('.woocommerce-product-gallery').css('--singleproduct-thumbs-height', $scope.find('.flex-viewport').height() + 'px');
                    if ($scope.find('.woocommerce-product-gallery__trigger').length) {
                        $scope.find('.woocommerce-product-gallery__trigger').appendTo($scope.find('.flex-viewport'));
                    }
                    if ($('.la-custom-badge', $scope).length) {
                        $('.la-custom-badge', $scope).prependTo($scope.find('.flex-viewport'));
                    }
                    if ($('.woocommerce-product-gallery__actions', $scope).length) {
                        $('.woocommerce-product-gallery__actions', $scope).prependTo($scope.find('.flex-viewport'));
                    }
                }

                var $nav = $scope.find('.flex-direction-nav');
                if ($nav.length && $scope.find('.flex-viewport').length) {
                    $nav.appendTo($scope.find('.flex-viewport'))
                }

                var $thumbs = $scope.find('.flex-control-thumbs').get(0);
                if (typeof $thumbs === "undefined" || $scope.find('.lakit-product-images').hasClass('layout-type-wc')) {
                    return;
                }

                $scope.find('.flex-control-thumbs li').append('<span/>');

                var pos = {top: 0, left: 0, x: 0, y: 0};
                var mouseDownHandler = function (e) {
                    $thumbs.style.cursor = 'grabbing';
                    $thumbs.style.userSelect = 'none';

                    pos = {
                        left: $thumbs.scrollLeft,
                        top: $thumbs.scrollTop,
                        // Get the current mouse position
                        x: e.clientX,
                        y: e.clientY,
                    };

                    document.addEventListener('mousemove', mouseMoveHandler);
                    document.addEventListener('mouseup', mouseUpHandler);
                };

                var mouseMoveHandler = function (e) {
                    // How far the mouse has been moved
                    const dx = e.clientX - pos.x;
                    const dy = e.clientY - pos.y;

                    // Scroll the element
                    $thumbs.scrollTop = pos.top - dy;
                    $thumbs.scrollLeft = pos.left - dx;
                };

                var mouseUpHandler = function () {
                    $thumbs.style.cursor = 'grab';
                    $thumbs.style.removeProperty('user-select');

                    document.removeEventListener('mousemove', mouseMoveHandler);
                    document.removeEventListener('mouseup', mouseUpHandler);
                };
                // Attach the handler
                $thumbs.addEventListener('mousedown', mouseDownHandler);
            }
            setTimeout(centerdots_cb, 300);

            function flexdestroy($els) {

                $els.each(function () {
                    var $el = jQuery(this);
                    var $elClean = $el.clone();

                    $elClean.find('.flex-viewport').children().unwrap();
                    $elClean.find('img.zoomImg, .woocommerce-product-gallery__trigger').remove();
                    $elClean
                        .removeClass('flexslider')
                        .find('.clone, .flex-direction-nav, .flex-control-nav')
                        .remove()
                        .end()
                        .find('*').removeAttr('style').removeClass(function (index, css) {
                        // If element is SVG css has an Object inside (?)
                        if (typeof css === 'string') {
                            return (css.match(/\bflex\S+/g) || []).join(' ');
                        }
                    });
                    $elClean.insertBefore($el);
                    $el.remove();
                });

            }

            if ($scope.find('.lakit-product-images').hasClass('layout-type-5') || $scope.find('.lakit-product-images').hasClass('layout-type-6')) {
                flexdestroy($scope.find('.lakit-product-images'));
            }

            var $gallery_target = $scope.find('.woocommerce-product-gallery');

            var data_columns = parseInt($gallery_target.data('columns'));
            if($scope.find('.lakit-product-images').hasClass('layout-type-4')){
                data_columns = parseInt($gallery_target.closest('.elementor-lakit-wooproduct-images').css('--singleproduct-image-column'));
            }

            if ($gallery_target.find('.woocommerce-product-gallery__image').length <= data_columns) {
                $gallery_target.addClass('center-thumb');
                if($scope.find('.lakit-product-images').hasClass('layout-type-4')){
                    flexdestroy($scope.find('.lakit-product-images'));
                    $gallery_target = $scope.find('.woocommerce-product-gallery');
                }
            }

            if($scope.find('.lakit-product-images').hasClass('layout-type-5')){
                $scope.find('.woocommerce-product-gallery__image a').attr('data-elementor-open-lightbox', 'yes');
                $scope.find('.woocommerce-product-gallery__image a').attr('data-elementor-lightbox-slideshow', $scope.data('id'));
            }
            else{
                $scope.find('.woocommerce-product-gallery__image a').attr('data-elementor-open-lightbox', 'no');
            }

            $scope.find('.woocommerce-product-gallery__image').each(function (){
                if( $(this).find('.zoominner').length == 0 ){
                    $(this).wrapInner('<div class="zoomouter"><div class="zoominner"></div></div>');
                }
            })
            // $scope.find('.woocommerce-product-gallery__image').wrapInner('<div class="zoomouter"><div class="zoominner"></div></div>');
            var initZoom = function (zoomTarget) {

                var zoom_enabled = $.isFunction($.fn.zoom) && wc_single_product_params.zoom_enabled;
                if (!zoom_enabled) {
                    return;
                }
                var galleryWidth = $gallery_target.width(),
                    zoomEnabled = false,
                    zoom_options;

                if($scope.find('.lakit-product-images').hasClass('layout-type-4')){
                    galleryWidth = $(zoomTarget).width()
                }

                $(zoomTarget).each(function (index, target) {
                    var image = $(target).find('img');

                    if (image.data('large_image_width') > galleryWidth) {
                        zoomEnabled = true;
                        return false;
                    }
                });

                // But only zoom if the img is larger than its container.
                if (zoomEnabled) {

                    try {
                        zoom_options = $.extend({
                            touch: false
                        }, wc_single_product_params.zoom_options);
                    } catch (ex) {
                        zoom_options = {
                            touch: false
                        };
                    }

                    if ('ontouchstart' in document.documentElement) {
                        zoom_options.on = 'click';
                    }

                    zoomTarget.trigger('zoom.destroy');
                    zoomTarget.zoom(zoom_options);

                }
            }

            initZoom($gallery_target.find('.woocommerce-product-gallery__image .zoominner'));
        },
        wooTabs: function ($scope) {
            var $tabs = $scope.find('.wc-tabs-wrapper').first();
            if ($tabs.length) {
                $tabs.wrapInner('<div class="lakit-wc-tabs--content"></div>');
                $tabs.find('.wc-tabs').wrapAll('<div class="lakit-wc-tabs--controls"></div>');
                $tabs.find('.lakit-wc-tabs--controls').prependTo($tabs);
                $tabs.find('.wc-tab').wrapInner('<div class="tab-content"></div>');
                $tabs.find('.wc-tab').each(function () {
                    var _html = $('#' + $(this).attr('aria-labelledby')).html();
                    $(this).prepend('<div class="wc-tab-title">' + _html + '</div>');
                });
                $('.wc-tab-title a', $tabs).wrapInner('<span></span>');
                $('.wc-tab-title a', $tabs).on('click', function (e) {
                    e.preventDefault();
                    $tabs.find('.wc-tabs').find('li[aria-controls="' + $(this).attr('href').replace('#', '') + '"]').toggleClass('active').siblings().removeClass('active');
                    $(this).closest('.wc-tab').toggleClass('active').siblings().removeClass('active');
                });
                $('.wc-tabs li a', $tabs).on('click', function (e) {
                    var $wrapper = $(this).closest('.wc-tabs-wrapper, .woocommerce-tabs');
                    $wrapper.find($(this).attr('href')).addClass('active').siblings().removeClass('active');
                });
                $('.wc-tabs li', $tabs).removeClass('active');
                $('.wc-tab-title a', $tabs).first().trigger('click');
            }
        },
        animatedBoxHandler: function ($scope) {

            var $target = $scope.find('.lakit-animated-box'),
                toogleEvents = 'mouseenter mouseleave',
                scrollOffset = $(window).scrollTop(),
                firstMouseEvent = true;

            if (!$target.length) {
                return;
            }

            if ('ontouchend' in window || 'ontouchstart' in window) {
                $target.on('touchstart', function (event) {
                    scrollOffset = $(window).scrollTop();
                });

                $target.on('touchend', function (event) {

                    if (scrollOffset !== $(window).scrollTop()) {
                        return false;
                    }

                    if (!$(this).hasClass('flipped-stop')) {
                        $(this).toggleClass('flipped');
                    }
                });

            } else {
                $target.on(toogleEvents, function (event) {

                    if (firstMouseEvent && 'mouseleave' === event.type) {
                        return;
                    }

                    if (firstMouseEvent && 'mouseenter' === event.type) {
                        firstMouseEvent = false;
                    }

                    if (!$(this).hasClass('flipped-stop')) {
                        $(this).toggleClass('flipped');
                    }
                });
            }
        },
        ajaxTemplateHelper: {

            need_reinit_js : false,

            template_processed : {},

            template_processed_count : 0,

            template_loaded : [],

            total_template : 0,

            processInsertData: function ($el, templateContent, template_id){


                LaStudioKits.ajaxTemplateHelper.template_processed_count++;

                if (templateContent) {
                    $el.html(templateContent);
                    if($el.find('div[data-lakit_ajax_loadtemplate]:not(.template-loaded,.is-loading)').length){
                        LaStudioKits.log('found template in ajax content');
                        LaStudioKits.ajaxTemplateHelper.init();
                    }
                }

                if(LaStudioKits.ajaxTemplateHelper.template_processed_count >= LaStudioKits.ajaxTemplateHelper.total_template && LaStudioKits.ajaxTemplateHelper.need_reinit_js){
                    LaStudioKits.ajaxTemplateHelper.need_reinit_js = false;
                    Promise.all(LaStudioKits.addedAssetsPromises).then(function (value) {
                        // $(window).trigger('elementor/frontend/init');
                        LaStudioKits.elementorFrontendInit($('.need-reinit-js[data-lakit_ajax_loadtemplate="true"]'), false);
                        $('.elementor-motion-effects-element').trigger('resize');
                        $('body').trigger('jetpack-lazy-images-load');
                        LaStudioKits.log('LaStudioKits.addedAssetsPromises --- FINISHED');

                    }, function (reason){

                        LaStudioKits.log(`An error occurred while insert the asset resources, however we still need to insert content. Reason detail: "${reason}"`);
                        // $(window).trigger('elementor/frontend/init');
                        LaStudioKits.elementorFrontendInit($('.need-reinit-js[data-lakit_ajax_loadtemplate="true"]'), false);
                        $('.elementor-motion-effects-element').trigger('resize');
                        $('body').trigger('jetpack-lazy-images-load');
                        LaStudioKits.log('LaStudioKits.addedAssetsPromises --- ERROR');
                    });
                }

                $(document).trigger('thepack-kit/ajax-load-template/after', {
                    target_id: template_id,
                    contentHolder: $el,
                    parentContainer: $el,
                    response: templateContent
                });
            },
            templateRenderCallback: function ( response, template_id ){
                var templateContent = response['template_content'],
                    templateScripts = response['template_scripts'],
                    templateStyles = response['template_styles'],
                    template_metadata = response['template_metadata'];

                for (var scriptHandler in templateScripts) {
                    if($( '#' + scriptHandler + '-js').length == 0) {
                        LaStudioKits.addedAssetsPromises.push(LaStudioKits.loadScriptAsync(scriptHandler, templateScripts[scriptHandler], '', true));
                    }
                }

                for (var styleHandler in templateStyles) {
                    if($( '#' + styleHandler + '-css').length == 0) {
                        LaStudioKits.addedAssetsPromises.push(LaStudioKits.loadStyle(styleHandler, templateStyles[styleHandler]));
                    }
                }

                document.querySelectorAll('body:not(.elementor-editor-active) div[data-lakit_ajax_loadtemplate][data-cache-id="' + template_id + '"]:not(.template-loaded)').forEach(function (elm) {
                    elm.classList.remove('is-loading');
                    elm.classList.add('template-loaded');
                    elm.classList.add('need-reinit-js');
                    LaStudioKits.ajaxTemplateHelper.processInsertData($(elm), templateContent, template_id);
                });

                var wpbar = document.querySelectorAll('#wp-admin-bar-elementor_edit_page ul');

                if (wpbar && typeof template_metadata['title'] !== "undefined") {
                    setTimeout(function () {
                        var _tid = 'wp-admin-bar-elementor_edit_doc_'+template_metadata['id'];
                        if($('#'+_tid).length == 0){
                            $('<li id="'+_tid+'" class="elementor-general-section"><a class="ab-item" title="'+template_metadata['title']+'" data-title="'+template_metadata['title']+'" href="' + template_metadata['href'] + '"><span class="elementor-edit-link-title">' + template_metadata['title'] + '</span><span class="elementor-edit-link-type">' + template_metadata['sub_title'] + '</span></a></li>').prependTo($(wpbar));
                        }
                    }, 2000);
                }
            },
            init: function (){
                if(ThePackKitSettings.isElementorAdmin){
                    /** do not run if current context is editor **/
                    return;
                }

                LaStudioKits.ajaxTemplateHelper.need_reinit_js = false;
                LaStudioKits.ajaxTemplateHelper.template_loaded = [];
                LaStudioKits.ajaxTemplateHelper.template_processed_count = 0;
                LaStudioKits.ajaxTemplateHelper.total_template = 0;
                LaStudioKits.ajaxTemplateHelper.template_processed = {};

                var templates = document.querySelectorAll('body:not(.elementor-editor-active) div[data-lakit_ajax_loadtemplate]:not(.template-loaded)');
                if (templates.length) {
                    var template_ids = [];
                    var template_exist_ids = [];
                    templates.forEach(function (el) {
                        if (!el.classList.contains('is-loading') && !el.classList.contains('template-loaded')) {
                            el.classList.add('is-loading');
                            var _cache_key = el.getAttribute('data-template-id');
                            if (!template_ids.includes(_cache_key)) {
                                var exits_nodes = document.querySelectorAll('.elementor.elementor-'+_cache_key+'[data-elementor-type]:not([data-elementor-title])');
                                if(exits_nodes.length == 0){
                                    template_ids.push(_cache_key);
                                }
                                else{
                                    template_exist_ids.push(_cache_key);
                                }
                            }
                            el.setAttribute('data-cache-id', _cache_key);
                        }
                    });

                    var arr_ids = [], _idx1 = 0, _idx2 = 0, _bk = 6;

                    var ajaxCalling = function (template_ids){

                        var _ajax_data_sending = {
                            'action': 'lakit_ajax',
                            '_nonce': window.ThePackKitSettings.ajaxNonce,
                            'actions': JSON.stringify({
                                'elementor_template' : {
                                    'action': 'elementor_template',
                                    'data': {
                                        'template_ids': template_ids,
                                        'current_url': window.location.href,
                                        'current_url_no_search': window.location.href.replace(window.location.search, ''),
                                        'dev': window.ThePackKitSettings.devMode
                                    }
                                }
                            })
                        };
                        if(ThePackKitSettings.useFrontAjax == 'true'){
                            _ajax_data_sending['lakit-ajax'] = 'yes';
                            delete _ajax_data_sending['action'];
                        }

                        $.ajax({
                            type: ThePackKitSettings.useFrontAjax == 'true' ? 'GET' : 'POST',
                            url:  ThePackKitSettings.useFrontAjax == 'true' ? window.location.href : window.ThePackKitSettings.ajaxUrl,
                            dataType: 'json',
                            data: _ajax_data_sending,
                            success: function (resp, textStatus, jqXHR) {
                                var responses = resp.data.responses.elementor_template.data;
                                $.each( responses, function( templateId, response ) {
                                    var cached_key = 'lakitTpl_' + templateId;
                                    var browserCacheKey = LaStudioKits.localCache.cache_key + '_' + LaStudioKits.localCache.hashCode(templateId);
                                    LaStudioKits.localCache.set(cached_key, response);
                                    LaStudioKits.ajaxTemplateHelper.templateRenderCallback(response, templateId);
                                    try{
                                        LaStudioKits.log('setup browser cache for ' + browserCacheKey);
                                        localStorage.setItem(browserCacheKey, JSON.stringify(response));
                                        localStorage.setItem(browserCacheKey + ':ts', Date.now());
                                    }
                                    catch (ajax_ex1){
                                        LaStudioKits.log('Cannot setup browser cache', ajax_ex1);
                                    }
                                });
                            }
                        });
                    }

                    template_exist_ids.forEach(function (templateId){
                        var exist_tpl = document.querySelector('.elementor.elementor-'+templateId+'[data-elementor-type]');
                        LaStudioKits.ajaxTemplateHelper.need_reinit_js = true;
                        LaStudioKits.ajaxTemplateHelper.templateRenderCallback({
                            'template_content' : exist_tpl.outerHTML,
                            'template_scripts' : [],
                            'template_styles' : [],
                            'template_metadata' : {},
                        }, templateId);
                    });

                    template_ids.forEach(function (templateId){
                        var cached_key = 'lakitTpl_' + templateId;
                        var cached_key2 = 'lakitTplExist_' + templateId;

                        if(LaStudioKits.localCache.exist(cached_key2)){
                            if(LaStudioKits.localCache.exist(cached_key)){
                                LaStudioKits.ajaxTemplateHelper.need_reinit_js = true;
                                LaStudioKits.ajaxTemplateHelper.templateRenderCallback(LaStudioKits.localCache.get(cached_key), templateId);
                            }
                            return;
                        }
                        LaStudioKits.localCache.set(cached_key2, 'yes');

                        if(LaStudioKits.localCache.exist(cached_key)){
                            LaStudioKits.ajaxTemplateHelper.need_reinit_js = true;
                            LaStudioKits.ajaxTemplateHelper.templateRenderCallback(LaStudioKits.localCache.get(cached_key), templateId);
                        }
                        else{

                            $(document).trigger('thepack-kit/ajax-load-template/before', {
                                target_id: templateId
                            });

                            var browserCacheKey = LaStudioKits.localCache.cache_key + '_' + LaStudioKits.localCache.hashCode(templateId);
                            var expiry = LaStudioKits.localCache.timeout;
                            try{
                                var browserCached = localStorage.getItem(browserCacheKey);
                                var browserWhenCached = localStorage.getItem(browserCacheKey + ':ts');

                                if (browserCached !== null && browserWhenCached !== null) {
                                    var age = (Date.now() - browserWhenCached) / 1000;
                                    if (age < expiry) {
                                        LaStudioKits.log(`render from cache for ID: ${templateId} | Cache Key: ${browserCacheKey}`);
                                        LaStudioKits.ajaxTemplateHelper.need_reinit_js = true;
                                        LaStudioKits.ajaxTemplateHelper.templateRenderCallback(JSON.parse(browserCached), templateId);
                                        return;
                                    }
                                    else {
                                        LaStudioKits.log(`clear browser cache key for ID: ${templateId} | Cache Key: ${browserCacheKey}`);
                                        // We need to clean up this old key
                                        localStorage.removeItem(browserCacheKey);
                                        localStorage.removeItem(browserCacheKey + ':ts');
                                    }
                                }
                                LaStudioKits.log('run ajaxCalling() for ' + templateId);
                                _idx1++;
                                if(_idx1 > _bk){
                                    _idx1 = 0;
                                    _idx2++;
                                }
                                if( "undefined" == typeof arr_ids[_idx2] ) {
                                    arr_ids[_idx2] = [];
                                }
                                arr_ids[_idx2].push(templateId);
                                LaStudioKits.ajaxTemplateHelper.template_loaded.push(templateId);
                            }
                            catch (ajax_ex) {
                                LaStudioKits.log('Cannot setup browser cache ajaxCalling() for ' + templateId);
                                _idx1++;
                                if(_idx1 == _bk){
                                    _idx1 = 0;
                                    _idx2++;
                                }
                                if( "undefined" == typeof arr_ids[_idx2] ) {
                                    arr_ids[_idx2] = [];
                                }
                                arr_ids[_idx2].push(templateId);
                                LaStudioKits.ajaxTemplateHelper.template_loaded.push(templateId);
                            }
                        }

                    });

                    LaStudioKits.ajaxTemplateHelper.total_template = templates.length;

                    if(arr_ids.length){
                        LaStudioKits.ajaxTemplateHelper.need_reinit_js = true;
                        arr_ids.forEach(function (arr_id){
                            ajaxCalling(arr_id);
                        });
                    }
                }
            }
        },
        detectWidgetsNotInHeader: function (){
            var itemDetected = ['.elementor-widget-icon-list', '.main-color', '.elementor-icon', '.elementor-heading-title', '.elementor-widget-text-editor', '.elementor-widget-divider', '.elementor-icon-list-item', '.elementor-social-icon', '.elementor-button', '.lakit-nav-wrap', '.lakit-nav', '.menu-item-link-depth-0'];
            itemDetected.forEach(function ( _item ){
                if($(_item).each(function (){
                    if( $(this).closest('.lakit-nav__sub').length ){
                        $(this).addClass('ignore-docs-style');
                    }
                }));
            });

            $('.elementor-widget-icon-list .elementor-icon-list-item').each(function (){
                var $child_a = $('>a', $(this)),
                    _href = $child_a.attr('href');
                if($(this).closest('.lakit-nav__sub').length && $(this).closest('.menu-item.need-check-active').length){
                    if(window.location.href == _href){
                        $(this).addClass('current-menu-item')
                    }
                }
            })
        },
        isInViewport: function (element) {
            var bounding = element.getBoundingClientRect();
            return (bounding.top >= -element.offsetHeight
                && bounding.left >= -element.offsetWidth
                && bounding.right <= (window.innerWidth || document.documentElement.clientWidth) + element.offsetWidth
                && bounding.bottom <= (window.innerHeight || document.documentElement.clientHeight) + element.offsetHeight
            )
        },
        LazyLoad: function (){
            var selector = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
            var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
            var _defaultConfig$option = $.extend({}, {
                    rootMargin: '50px',
                    threshold: 0,
                    load: function load(element) {
                        var base_src = element.getAttribute('data-src') || element.getAttribute('data-lazy') || element.getAttribute('data-lazy-src') || element.getAttribute('data-lazy-original'),
                            base_srcset = element.getAttribute('data-src') || element.getAttribute('data-lazy-srcset'),
                            base_sizes = element.getAttribute('data-sizes') || element.getAttribute('data-lazy-sizes');
                        if (base_src) {
                            element.src = base_src;
                        }
                        if (base_srcset) {
                            element.srcset = base_srcset;
                        }
                        if (base_sizes) {
                            element.sizes = base_sizes;
                        }
                        if (element.getAttribute('data-background-image')) {
                            element.style.backgroundImage = 'url("' + element.getAttribute('data-background-image') + '")';
                        }
                        element.setAttribute('data-element-loaded', true);
                        if (element.classList.contains('jetpack-lazy-image')) {
                            element.classList.add('jetpack-lazy-image--handled');
                        }
                    },
                    complete: function (elm) {}
                }, options),
                rootMargin = _defaultConfig$option.rootMargin,
                threshold = _defaultConfig$option.threshold,
                load = _defaultConfig$option.load,
                complete = _defaultConfig$option.complete; // // If initialized, then disconnect the observer

            var _target_cache = false,
                _counter = 0;

            function onIntersection(load) {
                return function (entries, observer) {
                    entries.forEach(function (entry) {
                        if(entry.isIntersecting){
                            if(_counter > 7){
                                _counter = 0;
                            }
                            if(_target_cache !== entry.target.offsetTop){
                                _counter = 0;
                                _target_cache = entry.target.offsetTop;
                            }
                            else{
                                _counter++;
                            }
                            observer.unobserve(entry.target);
                            entry.target.style.setProperty('--effect-delay', _counter);
                            load(entry.target);
                        }
                    });
                };
            }

            var observer = void 0;

            if ("IntersectionObserver" in window) {
                observer = new IntersectionObserver(onIntersection(load), {
                    rootMargin: rootMargin,
                    threshold: threshold
                });
            }
            return {
                observe: function observe() {
                    if(!selector){
                        return;
                    }
                    for (var i = 0; i < selector.length; i++) {
                        if(selector[i].getAttribute('data-element-loaded') === 'true'){
                            continue;
                        }
                        if (observer) {
                            observer.observe(selector[i]);
                            continue;
                        }
                        load(selector[i]);
                    }
                    complete(selector);
                }
            };
        }
    }

    function initFrontEndFunction(){

        window.elementorFrontend.hooks.addAction('frontend/element_ready/lakit-advanced-carousel.default', function ($scope) {
            LaStudioKits.initCarousel($scope);
        });
        window.elementorFrontend.hooks.addAction('frontend/element_ready/lakit-postformat-content.default', function ($scope) {
            LaStudioKits.initCarousel($scope);
        });
        window.elementorFrontend.hooks.addAction('frontend/element_ready/lakit-slides.default', function ($scope) {
            LaStudioKits.initCarousel($scope);
        });

        window.elementorFrontend.hooks.addAction('frontend/element_ready/lakit-posts.default', function ($scope) {
            LaStudioKits.initCarousel($scope);
            LaStudioKits.initMasonry($scope);
        });

        window.elementorFrontend.hooks.addAction('frontend/element_ready/lakit-portfolio.default', function ($scope) {
            LaStudioKits.initCarousel($scope);
            LaStudioKits.initMasonry($scope);
        });

        window.elementorFrontend.hooks.addAction('frontend/element_ready/lakit-images-layout.default', function ($scope) {
            LaStudioKits.initCarousel($scope);
            LaStudioKits.initMasonry($scope);
        });

        window.elementorFrontend.hooks.addAction('frontend/element_ready/lakit-banner-list.default', function ($scope) {
            LaStudioKits.initCarousel($scope);
            LaStudioKits.initMasonry($scope);
        });

        window.elementorFrontend.hooks.addAction('frontend/element_ready/lakit-portfolio-gallery.default', function ($scope) {
            LaStudioKits.initCarousel($scope);
            LaStudioKits.initMasonry($scope);
        });

        window.elementorFrontend.hooks.addAction('frontend/element_ready/lakit-team-member.default', function ($scope) {
            LaStudioKits.initCarousel($scope);
            LaStudioKits.initMasonry($scope);
        });

        window.elementorFrontend.hooks.addAction('frontend/element_ready/lakit-testimonials.default', function ($scope) {
            LaStudioKits.initCarousel($scope);
            LaStudioKits.initMasonry($scope);
        });

        window.elementorFrontend.hooks.addAction('frontend/element_ready/lakit-search.default', function ($scope) {
            LaStudioKits.onSearchSectionActivated($scope);

            var $widget = $scope.find('.lakit-search'),
                $popupToggle = $('.lakit-search__popup-trigger', $widget),
                $popupContent = $('.lakit-search__popup-content', $widget),
                activeClass = 'lakit-search-popup-active',
                transitionOut = 'lakit-transition-out';

            if(!$('>.lakit-search__form', $widget).length){
                $('.lakit-search__submit', $widget).removeClass('main-color')
            }

            $(document).on('click', function (event) {
                if ($(event.target).closest($popupToggle).length || $(event.target).closest($popupContent).length) {
                    return;
                }
                if (!$widget.hasClass(activeClass)) {
                    return;
                }
                $widget.removeClass(activeClass);
                $widget.addClass(transitionOut);
                setTimeout(function () {
                    $widget.removeClass(transitionOut);
                }, 300);
                event.stopPropagation();
            });
        });

        window.elementorFrontend.hooks.addAction('frontend/element_ready/lakit-hamburger-panel.default', LaStudioKits.hamburgerPanel);

        window.elementorFrontend.hooks.addAction('frontend/element_ready/lakit-menucart.default', LaStudioKits.wooCard);

        window.elementorFrontend.hooks.addAction('frontend/element_ready/lakit-animated-box.default', function ($scope) {
            LaStudioKits.animatedBoxHandler($scope);
        });

        window.elementorFrontend.hooks.addAction('frontend/element_ready/lakit-wooproducts.default', function ($scope) {
            LaStudioKits.initCarousel($scope);
            LaStudioKits.initMasonry($scope);
            $scope.find('.lakitp-zone').on('mouseenter mouseleave', function (event) {
                if ('mouseenter' === event.type) {
                    $(this).addClass('is-active');
                }
                if ('mouseleave' === event.type) {
                    $(this).removeClass('is-active');
                }
            });
            $('.lakit--hint.only-icon', $scope).trigger('thepack-kit/init-tooltip');
            $(document).on('thepack-kit/carousel/init_success', function (e){
                $('.lakit--hint.only-icon', $scope).trigger('thepack-kit/init-tooltip');
            });
        });

        window.elementorFrontend.hooks.addAction('frontend/element_ready/lakit-wooproduct-images.default', function ($scope) {
            LaStudioKits.wooGallery($scope);
        });

        window.elementorFrontend.hooks.addAction('frontend/element_ready/lakit-wooproduct-datatabs.default', function ($scope) {
            LaStudioKits.wooTabs($scope);
        });

        window.elementorFrontend.hooks.addAction('frontend/element_ready/accordion.default', function ($scope) {
            if($scope.hasClass('accordion-close-all')){
                setTimeout(function (){
                    $scope.find('.elementor-accordion-item:first-child > .elementor-tab-title').trigger('click')
                }, 100)
            }
        });

        window.elementorFrontend.hooks.addAction('frontend/element_ready/section', function ($scope) {
            if( $scope.hasClass('elementor-top-section') ) {
                $scope.trigger('thepack-kit/section/calculate-container-width');
            }
        });
    }

    $(window).on('elementor/frontend/init', initFrontEndFunction);

    LaStudioKits.initCustomHandlers();

    window.LaStudioKits = LaStudioKits;

    $.ajaxPrefilter(function (options, originalOptions, jqXHR) {
        if (options.cache) {
            //Here is our identifier for the cache. Maybe have a better, safer ID (it depends on the object string representation here) ?
            // on $.ajax call we could also set an ID in originalOptions
            var id = LaStudioKits.removeURLParameter(originalOptions.url, '_') + ("undefined" !== typeof originalOptions.ajax_request_id ? JSON.stringify(originalOptions.ajax_request_id) : "undefined" !== typeof originalOptions.data ? JSON.stringify(originalOptions.data) : '');
            id = LaStudioKits.localCache.hashCode(id.replace(/null$/g, ''));
            options.cache = false;

            options.beforeSend = function () {
                if (!LaStudioKits.localCache.exist(id)) {
                    jqXHR.promise().done(function (data, textStatus) {
                        LaStudioKits.localCache.set(id, data);
                    });
                }
                return true;
            };
        }
    });
    $.ajaxTransport("+*", function (options, originalOptions, jqXHR) {
        //same here, careful because options.url has already been through jQuery processing
        var id = LaStudioKits.removeURLParameter(originalOptions.url, '_') + ("undefined" !== typeof originalOptions.ajax_request_id ? JSON.stringify(originalOptions.ajax_request_id) : "undefined" !== typeof originalOptions.data ? JSON.stringify(originalOptions.data) : '');
        options.cache = false;
        id = LaStudioKits.localCache.hashCode(id.replace(/null$/g, ''));
        if (LaStudioKits.localCache.exist(id)) {
            return {
                send: function (headers, completeCallback) {
                    setTimeout(function () {
                        completeCallback(200, "OK", [LaStudioKits.localCache.get(id)]);
                    }, 50);
                },
                abort: function () {
                    /* abort code, nothing needed here I guess... */
                }
            };
        }
    });

}(jQuery));

(function( $ ) {

    "use strict";

    function setMegaMenuPosition( $menu_item, $container, container_width, isVerticalMenu ){
        if ($('.lakit-megamenu-inited', $menu_item).length) {
            return false;
        }
        var $popup = $('> .lakit-nav__sub', $menu_item);
        if ($popup.length == 0) return;
        var megamenu_width = $popup.outerWidth();

        if (megamenu_width > container_width) {
            megamenu_width = container_width;
        }

        if (!isVerticalMenu) {
            var container_padding_left = parseInt($container.css('padding-left')),
                container_padding_right = parseInt($container.css('padding-right')),
                parent_width = $popup.parent().outerWidth(),
                left = 0,
                container_offset = LaStudioKits.getCoords($container.get(0)),
                megamenu_offset = LaStudioKits.getCoords($popup.get(0));
            var megamenu_offset_x = megamenu_offset.left,
                container_offset_x = container_offset.left;

            if (megamenu_width > parent_width) {
                left = -(megamenu_width - parent_width) / 2;
            } else {
                left = 0;
            }

            if (LaStudioKits.isRTL()) {
                var megamenu_offset_x_swap = $(window).width() - (megamenu_width + megamenu_offset_x),
                    container_offset_x_swap = $(window).width() - ($container.outerWidth() + container_offset_x);

                if (megamenu_offset_x_swap - container_offset_x_swap - container_padding_right + left < 0) {
                    left = -(megamenu_offset_x_swap - container_offset_x_swap - container_padding_right);
                }

                if (megamenu_offset_x_swap + megamenu_width + left > container_offset_x + $container.outerWidth() - container_padding_left) {
                    left -= megamenu_offset_x_swap + megamenu_width + left - (container_offset_x + $container.outerWidth() - container_padding_left);
                }

                $popup.css('right', left).css('right');
            }
            else {
                if (megamenu_offset_x - container_offset_x - container_padding_left + left < 0) {
                    left = -1 * (megamenu_offset_x - container_offset_x - container_padding_left);
                }

                if (megamenu_offset_x + megamenu_width + left > container_offset_x + $container.outerWidth() - container_padding_right) {
                    left = 0;
                    left = -1 * (megamenu_offset_x + megamenu_width + left - (container_offset_x + $container.outerWidth() - container_padding_right));
                }

                if ($container.is('body')) {
                    left = -1 * megamenu_offset_x;
                }

                $popup.css('left', left).css('left');
            }
        }

        if (isVerticalMenu) {
            var clientHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight,
                itemOffset = $popup.offset(),
                itemHeight = $popup.outerHeight(),
                scrollTop = $(window).scrollTop();

            if (itemOffset.top - scrollTop + itemHeight > clientHeight) {
                var __top = clientHeight - (itemOffset.top + scrollTop + itemHeight + 50);

                if (itemHeight >= clientHeight) {
                    //__top = 1 - itemOffset.top - scrollTop;
                    $popup.offset({
                        top: document.getElementById('wpadminbar') && window.innerWidth > 600 ? 32 : 0
                    });
                }
                else {
                    $popup.css({
                        top: __top
                    });
                }
            }
        }
        $popup.addClass('lakit-megamenu-inited');
    }

    $(document).on('thepackkit/frontend/megamenu:setposition', function (e, $megamenu){

        const _callback = () => {
            if($megamenu.length){
                $megamenu.each(function () {
                    var _that = $(this),
                        container_width = 0,
                        $container = _that.closest('.elementor-container,.e-container.e-root-container'),
                        isVerticalMenu = false;

                    container_width = $container.width();

                    if( _that.find('.lakit-nav').first().hasClass('lakit-nav--vertical-sub-bottom') ){
                        return;
                    }

                    if( _that.find('.lakit-nav').first().hasClass('lakit-nav--vertical') ){
                        isVerticalMenu = true;
                        if ( $megamenu.closest('.lakit--is-vheader').length ) {
                            container_width = $('.lakit-site-wrapper').outerWidth();
                        }
                        container_width = container_width - _that.outerWidth();
                    }

                    const bk_maxwidth = $('.lakit-nav__item--mega > .lakit-nav__sub', _that).css('--mm-sub-width');

                    $('.lakit-nav__item--mega > .lakit-megamenu-inited', _that).removeClass('lakit-megamenu-inited');
                    $('.lakit-nav__item--mega > .lakit-nav__sub', _that).removeAttr('style');
                    $('.lakit-nav__item--mega > .lakit-nav__sub', _that).css('--mm-sub-width', bk_maxwidth);
                    $('.lakit-nav__item--mega', _that).each(function () {
                        var $menu_item = $(this),
                            $popup = $('> .lakit-nav__sub', $menu_item),
                            item_max_width = parseInt((!!$popup.data('maxWidth') && $popup.data('maxWidth') != 'auto') ? $popup.data('maxWidth') : $popup.css('maxWidth')),
                            $_container = $container;

                        var default_width = 1170;

                        // if (container_width < default_width) {
                        //     default_width = container_width;
                        // }

                        if (isNaN(item_max_width)) {
                            item_max_width = default_width;
                        }

                        if (default_width > item_max_width) {
                            default_width = item_max_width;
                        }

                        if(item_max_width > default_width && item_max_width <= container_width){
                            default_width = container_width
                        }

                        if ($menu_item.hasClass('lakit-nav__item-force-fullwidth') && $menu_item.closest('.lakit--is-vheader').length == 0) {
                            $popup.data('maxWidth', item_max_width).css('maxWidth', 'none');
                            $popup.css('width', item_max_width);
                            if (!isVerticalMenu) {
                                default_width = $(window).width();
                                $_container = $('body');
                            }
                            else {
                                default_width = $('.lakit-site-wrapper').width();
                            }
                        }
                        if(default_width > container_width){
                            default_width = container_width;
                        }
                        $popup.width(default_width);
                        setMegaMenuPosition($menu_item, $_container, container_width, isVerticalMenu);
                    });
                });
            }
        }
        if(LaStudioKits.isEditMode()){
            setTimeout(_callback, 15);
        }
        else{
            _callback();
        }
    });

    $(window).on('elementor/frontend/init', () => {
        window.elementorFrontend.hooks.addAction( 'frontend/element_ready/lakit-nav-menu.default', function ( $scope ){
            if ( $scope.data( 'initialized' ) ) {
                return;
            }

            $scope.data( 'initialized', true );

            var hoverClass        = 'lakit-nav-hover',
                hoverOutClass     = 'lakit-nav-hover-out',
                mobileActiveClass = 'lakit-mobile-menu-active',
                _has_mobile_bkp   = false;

            if($scope.find('.lakit-mobile-menu').length){
                _has_mobile_bkp = $scope.find('.lakit-mobile-menu').data('mobile-breakpoint');
            }

            function checkActiveMobileTrigger(){
                if(_has_mobile_bkp !== false){
                    if(_has_mobile_bkp == 'all'){
                        $scope.find('.lakit-mobile-menu').addClass('lakit-active--mbmenu');
                    }
                    else if($(window).width() <= _has_mobile_bkp){
                        $scope.find('.lakit-mobile-menu').addClass('lakit-active--mbmenu');
                    }
                    else{
                        $scope.find('.lakit-mobile-menu').removeClass('lakit-active--mbmenu');
                    }
                }
            }
            checkActiveMobileTrigger();
            $(window).on('resize', checkActiveMobileTrigger);

            try{
                $scope.find( '.lakit-nav:not(.lakit-nav--vertical-sub-bottom)' ).hoverIntent({
                    over: function() {
                        $( this ).addClass( hoverClass );
                    },
                    out: function() {
                        var $this = $( this );
                        $this.removeClass( hoverClass );
                        $this.addClass( hoverOutClass );
                        setTimeout( function() {
                            $this.removeClass( hoverOutClass );
                        }, 200 );
                    },
                    timeout: 200,
                    selector: '.menu-item-has-children'
                });
            }catch (ex){}

            if ( LaStudioKits.mobileAndTabletCheck() ) {
                $scope.find( '.lakit-nav:not(.lakit-nav--vertical-sub-bottom)' ).on( 'touchstart.lakitNavMenu', '.menu-item > a', touchStartItem );
                $scope.find( '.lakit-nav:not(.lakit-nav--vertical-sub-bottom)' ).on( 'touchend.lakitNavMenu', '.menu-item > a', touchEndItem );

                $( document ).on( 'touchstart.lakitNavMenu', prepareHideSubMenus );
                $( document ).on( 'touchend.lakitNavMenu', hideSubMenus );
            }
            else {
                $scope.find( '.lakit-nav:not(.lakit-nav--vertical-sub-bottom)' ).on( 'click.lakitNavMenu', '.menu-item > a', clickItem );
            }

            if ( ! LaStudioKits.isEditMode() ) {
                initMenuAnchorsHandler();
            }

            function touchStartItem( event ) {
                var $currentTarget = $( event.currentTarget ),
                    $this = $currentTarget.closest( '.menu-item' );

                $this.data( 'offset', $( window ).scrollTop() );
                $this.data( 'elemOffset', $this.offset().top );
            }

            function touchEndItem( event ) {
                var $this,
                    $siblingsItems,
                    $link,
                    $currentTarget,
                    subMenu,
                    offset,
                    elemOffset,
                    $hamburgerPanel;

                event.preventDefault();

                $currentTarget  = $( event.currentTarget );
                $this           = $currentTarget.closest( '.menu-item' );
                $siblingsItems  = $this.siblings( '.menu-item.menu-item-has-children' );
                $link           = $( '> a', $this );
                subMenu         = $( '.lakit-nav__sub:first', $this );
                offset          = $this.data( 'offset' );
                elemOffset      = $this.data( 'elemOffset' );
                $hamburgerPanel = $this.closest( '.lakit-hamburger-panel' );

                if ( offset !== $( window ).scrollTop() || elemOffset !== $this.offset().top ) {
                    return false;
                }

                if ( $siblingsItems[0] ) {
                    $siblingsItems.removeClass( hoverClass );
                    $( '.menu-item-has-children', $siblingsItems ).removeClass( hoverClass );
                }

                if ( ! $( '.lakit-nav__sub', $this )[0] || $this.hasClass( hoverClass ) ) {
                    $link.trigger( 'click' ); // Need for a smooth scroll when clicking on an anchor link

                    var _new_href = $link.attr( 'href' );
                    if(_new_href && _new_href != '#' ){
                        window.location.href = $link.attr( 'href' );
                    }

                    if(_new_href){
                        if ( $scope.find( '.lakit-nav-wrap' ).hasClass( mobileActiveClass ) ) {
                            $scope.find( '.lakit-nav-wrap' ).removeClass( mobileActiveClass );
                        }

                        if ( $hamburgerPanel[0] && $hamburgerPanel.hasClass( 'open-state' ) ) {
                            $hamburgerPanel.removeClass( 'open-state' );
                            $( 'html' ).removeClass( 'lakit-hamburger-panel-visible' );
                        }
                    }
                    else{
                        $this.removeClass( hoverClass )
                    }

                    return false;
                }

                if ( subMenu[0] ) {
                    $this.addClass( hoverClass );
                    $('.lakit-masonry-wrapper', subMenu).trigger('resize');
                }
            }

            function clickItem( event ) {
                var $currentTarget  = $( event.currentTarget ),
                    $menuItem       = $currentTarget.closest( '.menu-item' ),
                    $hamburgerPanel = $menuItem.closest( '.lakit-hamburger-panel' );

                if ( ! $menuItem.hasClass( 'menu-item-has-children' ) || $menuItem.hasClass( hoverClass ) ) {

                    if ( $hamburgerPanel[0] && $hamburgerPanel.hasClass( 'open-state' ) ) {
                        $hamburgerPanel.removeClass( 'open-state' );
                        $( 'html' ).removeClass( 'lakit-hamburger-panel-visible' );
                    }

                }
            }

            var scrollOffset;

            function prepareHideSubMenus( event ) {
                scrollOffset = $( window ).scrollTop();
            }

            function hideSubMenus( event ) {
                var $menu = $scope.find( '.lakit-nav' );

                if ( 'touchend' === event.type && scrollOffset !== $( window ).scrollTop() ) {
                    return;
                }

                if ( $( event.target ).closest( $menu ).length ) {
                    return;
                }

                var $openMenuItems = $( '.menu-item-has-children.' + hoverClass, $menu );

                if ( ! $openMenuItems[0] ) {
                    return;
                }

                $openMenuItems.removeClass( hoverClass );
                $openMenuItems.addClass( hoverOutClass );

                setTimeout( function() {
                    $openMenuItems.removeClass( hoverOutClass );
                }, 200 );

                if ( $menu.hasClass( 'lakit-nav--vertical-sub-bottom' ) ) {
                    $( '.lakit-nav__sub', $openMenuItems ).slideUp( 200 );
                }

                event.stopPropagation();
            }

            // START Vertical Layout: Sub-menu at the bottom
            $scope.find( '.lakit-nav--vertical-sub-bottom' ).on( 'click.lakitNavMenu', '.menu-item > a', verticalSubBottomHandler );

            function verticalSubBottomHandler( event ) {
                var $currentTarget  = $( event.currentTarget ),
                    $menuItem       = $currentTarget.closest( '.menu-item' ),
                    $siblingsItems  = $menuItem.siblings( '.menu-item.menu-item-has-children' ),
                    $subMenu        = $( '.lakit-nav__sub:first', $menuItem ),
                    $hamburgerPanel = $menuItem.closest( '.lakit-hamburger-panel' );

                if ( ! $menuItem.hasClass( 'menu-item-has-children' ) || $menuItem.hasClass( hoverClass ) ) {

                    if ( $scope.find( '.lakit-nav-wrap' ).hasClass( mobileActiveClass ) ) {
                        $scope.find( '.lakit-nav-wrap' ).removeClass( mobileActiveClass );
                    }

                    if ( $hamburgerPanel[0] && $hamburgerPanel.hasClass( 'open-state' ) ) {
                        $hamburgerPanel.removeClass( 'open-state' );
                        $( 'html' ).removeClass( 'lakit-hamburger-panel-visible' );
                    }

                    return;
                }

                event.preventDefault();
                event.stopPropagation();

                if ( $siblingsItems[0] ) {
                    $siblingsItems.removeClass( hoverClass );
                    $( '.menu-item-has-children', $siblingsItems ).removeClass( hoverClass );
                    $( '.lakit-nav__sub', $siblingsItems ).slideUp( 200 );
                }

                if ( $subMenu[0] ) {
                    $menuItem.addClass( hoverClass );
                    $subMenu.slideDown( 200, function (){
                        $('.lakit-masonry-wrapper', $subMenu).trigger('resize');
                    } );
                }
            }

            $( document ).on( 'click.lakitNavMenu', hideVerticalSubBottomMenus );

            function hideVerticalSubBottomMenus( event ) {
                if ( ! $scope.find( '.lakit-nav' ).hasClass( 'lakit-nav--vertical-sub-bottom' ) ) {
                    return;
                }
                hideSubMenus( event );
            }
            // END Vertical Layout: Sub-menu at the bottom

            // Mobile trigger click event
            $( '.lakit-nav__mobile-trigger', $scope ).on( 'click.lakitNavMenu', function( event ) {
                event.preventDefault();
                $( this ).closest( '.lakit-nav-wrap' ).toggleClass( mobileActiveClass );
            } );

            // START Mobile Layout: Left-side, Right-side
            if ( 'ontouchend' in window ) {
                $( document ).on( 'touchend.lakitMobileNavMenu', removeMobileActiveClass );
            }
            else {
                $( document ).on( 'click.lakitMobileNavMenu', removeMobileActiveClass );
            }

            function removeMobileActiveClass( event ) {
                var mobileLayout = $scope.find( '.lakit-nav-wrap' ).data( 'mobile-layout' ),
                    $navWrap     = $scope.find( '.lakit-nav-wrap' ),
                    $trigger     = $scope.find( '.lakit-nav__mobile-trigger' ),
                    $menu        = $scope.find( '.lakit-nav' );

                if ( 'left-side' !== mobileLayout && 'right-side' !== mobileLayout ) {
                    return;
                }

                if ( 'touchend' === event.type && scrollOffset !== $( window ).scrollTop() ) {
                    return;
                }

                if ( $( event.target ).closest( $trigger ).length || $( event.target ).closest( $menu ).length ) {
                    return;
                }

                if ( ! $navWrap.hasClass( mobileActiveClass ) ) {
                    return;
                }

                $navWrap.removeClass( mobileActiveClass );

                event.stopPropagation();
            }

            $( '.lakit-nav__mobile-close-btn', $scope ).on( 'click.lakitMobileNavMenu', function( event ) {
                $( this ).closest( '.lakit-nav-wrap' ).removeClass( mobileActiveClass );
            } );

            // END Mobile Layout: Left-side, Right-side

            // START Mobile Layout: Full-width
            var initMobileFullWidthCss = false;

            setFullWidthMenuPosition();
            $( window ).on( 'resize.lakitMobileNavMenu', setFullWidthMenuPosition );

            function setFullWidthMenuPosition() {
                var mobileLayout = $scope.find( '.lakit-nav-wrap' ).data( 'mobile-layout' );

                if ( 'full-width' !== mobileLayout ) {
                    return;
                }

                var $menu = $scope.find( '.lakit-nav' ),
                    currentDeviceMode = elementorFrontend.getCurrentDeviceMode();

                if ( 'mobile' !== currentDeviceMode ) {
                    if ( initMobileFullWidthCss ) {
                        $menu.css( { 'left': '' } );
                        initMobileFullWidthCss = false;
                    }
                    return;
                }

                if ( initMobileFullWidthCss ) {
                    $menu.css( { 'left': '' } );
                }

                var offset = - $menu.offset().left;

                $menu.css( { 'left': offset } );
                initMobileFullWidthCss = true;
            }
            // END Mobile Layout: Full-width

            // Menu Anchors Handler
            function initMenuAnchorsHandler() {
                var $anchorLinks = $scope.find( '.menu-item-link[href*="#"]' );

                if ( $anchorLinks[0] ) {
                    $anchorLinks.each( function() {
                        if ( '' !== this.hash && location.pathname === this.pathname ) {
                            menuAnchorHandler( $( this ) );
                        }
                    } );
                }
            }

            function menuAnchorHandler( $anchorLink ) {
                var anchorHash = $anchorLink[0].hash,
                    activeClass = 'current-menu-item',
                    rootMargin = '-50% 0% -50%',
                    $anchor;

                try {
                    $anchor = $( decodeURIComponent( anchorHash ) );
                } catch (e) {
                    return;
                }

                if ( !$anchor[0] ) {
                    return;
                }

                if ( $anchor.hasClass( 'elementor-menu-anchor' ) ) {
                    rootMargin = '300px 0% -300px';
                }

                var observer = new IntersectionObserver( function( entries ) {
                        if ( entries[0].isIntersecting ) {
                            $anchorLink.parent( '.menu-item' ).addClass( activeClass );
                        } else {
                            $anchorLink.parent( '.menu-item' ).removeClass( activeClass );
                        }
                    },
                    {
                        rootMargin: rootMargin
                    }
                );

                observer.observe( $anchor[0] );
            }

            // START MegaMenu
            $(document).trigger('thepackkit/frontend/megamenu:setposition', [ $scope.find('.lakit-nav--enable-megamenu').first() ]);
            $(window).on('resize load', function (){
                $(document).trigger('thepackkit/frontend/megamenu:setposition', [ $scope.find('.lakit-nav--enable-megamenu').first() ]);
            });

            document.querySelector('body').addEventListener('LaStudioPageSpeed:Loaded', function (e){
                $(document).trigger('thepackkit/frontend/megamenu:setposition', [ $scope.find('.lakit-nav--enable-megamenu').first() ]);
            })
            // END MegaMenu


            // START Toggle
            $('.lakit-nav--enable-toggle > .lakit-nav__toggle-trigger', $scope).on('click', function (e){
                e.preventDefault();
                var $parent = $(this).closest('.lakit-nav-wrap');
                if( $parent.hasClass('lakit-active--mbmenu') ){
                    $parent.removeClass('toggle--active');
                    $('> .lakit-nav__mobile-trigger', $parent).trigger('click');
                }
                else{
                    $(this).closest('.lakit-nav-wrap').toggleClass('toggle--active');
                }
            });
            // END Toggle

            if ( LaStudioKits.isEditMode() ) {
                $scope.data( 'initialized', false );
            }

            LaStudioKits.detectWidgetsNotInHeader();

            $(window).on('load', function (e){
                $('.lakit-masonry-wrapper', $scope).trigger('resize');
            })
        } );
    })


}( jQuery ) );

(function( $ ) {

    class _eContainerHandler extends elementorModules.frontend.handlers.Base {

        _editorInit(){
            setTimeout( () => {
                if(this.$element.data('nesting-level') > 0){
                    this.$element.removeClass('e-root-container elementor-top-section');
                }
                else{
                    this.$element.addClass('e-root-container elementor-top-section');
                    this._initHeaderVertical();
                }
            }, 50);
        }
        _initHeaderVertical() {
            const $scope = this.$element;
            if( $scope.hasClass('elementor-top-section') ) {
                if($scope.is(':first-child')){
                    if($scope.closest('.elementor-location-header').length > 0
                        && ( $scope.parent().parent().is('.lakit--is-vheader') || $scope.parent().parent().parent().is('.lakit--is-vheader') )
                    ){
                        $('> .elementor-element', $scope).wrapAll('<div class="elementor-container"/>')
                    }
                }
                $scope.trigger('thepack-kit/section/calculate-container-width');
            }
        }
        bindEvents() {
            if(this.isEdit){
                this._editorInit()
            }
            else{
                this._initHeaderVertical()
            }
        }
    }

    $( window ).on( 'elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/container', ( $element ) => {
            elementorFrontend.elementsHandler.addHandler( _eContainerHandler, {
                $element,
            } );
        } );
    } );

    $('.elementor-element[data-settings*="sticky"]').on('sticky:stick', function (e){
        $('.elementor-sticky__spacer .lakit-cart__list').remove();
    })

}( jQuery) );

(function ($) {

    "use strict";

    $(document).on('thepack-kit/init-tooltip', '.lakit--hint',function (){
        var $that = $(this);
        if(typeof $.fn.tooltip === "undefined" && !LaStudioKits.addedScripts.hasOwnProperty('bootstrap-tooltip')){
            LaStudioKits.addedAssetsPromises.push(LaStudioKits.loadScriptAsync('bootstrap-tooltip', ThePackKitSettings.resources['bootstrap-tooltip'], '', true));
        }
        Promise.all(LaStudioKits.addedAssetsPromises).then( () => {
            $that.tooltip({
                container: 'body',
                placement: 'top',
                title: function (){
                    return this.getAttribute('data-hint')
                },
            });
        }, ( reason ) => {
            LaStudioKits.log('Tooltip error', reason)
        } )
    });

    var LakitCountDownTimer = function ($el){
        var $scope = $el;
        var timeInterval,
            $coutdown = $scope.find('[data-due-date]'),
            endTime = new Date($coutdown.data('due-date') * 1000),
            elements = {
                days: $coutdown.find('[data-value="days"]'),
                hours: $coutdown.find('[data-value="hours"]'),
                minutes: $coutdown.find('[data-value="minutes"]'),
                seconds: $coutdown.find('[data-value="seconds"]')
            };

        function splitNum( num ){
            var num = num.toString(),
                arr = [],
                result = '';

            if (1 === num.length) {
                num = 0 + num;
            }

            arr = num.match(/\d{1}/g);
            $.each(arr, function (index, val) {
                result += '<span class="lakit-countdown-timer__digit">' + val + '</span>';
            });
            return result;
        }

        function getTimeRemaining( endTime ){
            var timeRemaining = endTime - new Date(),
                seconds = Math.floor(timeRemaining / 1000 % 60),
                minutes = Math.floor(timeRemaining / 1000 / 60 % 60),
                hours = Math.floor(timeRemaining / (1000 * 60 * 60) % 24),
                days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));

            if (days < 0 || hours < 0 || minutes < 0) {
                seconds = minutes = hours = days = 0;
            }

            return {
                total: timeRemaining,
                parts: {
                    days: splitNum(days),
                    hours: splitNum(hours),
                    minutes: splitNum(minutes),
                    seconds: splitNum(seconds)
                }
            };
        }

        function updateClock(){
            var timeRemaining = getTimeRemaining(endTime);
            $.each(timeRemaining.parts, function (timePart) {
                var $element = elements[timePart];

                if ($element.length) {
                    $element.html(this);
                }
            });

            if (timeRemaining.total <= 0) {
                clearInterval(timeInterval);
            }
        }

        function initClock(){
            updateClock();
            timeInterval = setInterval(updateClock, 1000);
        }

        initClock();
    }

    $(document).on('thepack-kit/products/init-countdown', '.product_item--countdown', function (e){
        var $scope = $(this);
        if(!$scope.hasClass('-initialized')){
            $scope.addClass('-initialized');
            LakitCountDownTimer( $scope );
        }
    });

    $(window).on('elementor/frontend/init', function () {
        window.elementorFrontend.hooks.addAction('frontend/element_ready/lakit-wooproducts.default', function ($scope) {
            $scope.find('.product_item--countdown').trigger('thepack-kit/products/init-countdown');
        });
        window.elementorFrontend.hooks.addAction('frontend/element_ready/lakit-countdown-timer.default', function ($scope) {
            LakitCountDownTimer( $scope );
        });

        $(document).on('click', 'a[data-carousel-prev]', function (e){
            e.preventDefault();
            var swiperInstance = $($(this).data('carousel-prev')).data('swiper');
            try{ swiperInstance.slidePrev() }catch (ex){ console.log(ex) }
        })
        $(document).on('click', 'a[data-carousel-next]', function (e){
            e.preventDefault();
            var swiperInstance = $($(this).data('carousel-next')).data('swiper');
            try{ swiperInstance.slideNext() }catch (ex){ console.log(ex) }
        })

    });

    $( document ).on( 'elementor/popup/show', () => {
        try{
            wpcf7.init($(".wpcf7-form")[0]);
        }catch (e){}
    });

    $(window).on('load', function (){
        $('.elementor-motion-effects-element').trigger('resize');
    })

    /** Fix WC ajax add cart **/
    $(document.body).on('should_send_ajax_request.adding_to_cart', function ( e, $thisbutton ){
        var data = {},
            ignoreKey = ['hint', 'tipClass', 'tooltip', 'originalTitle'];
        $.each( $thisbutton.data(), function( key, value ) {
            if(!ignoreKey.includes(key)){
                data[ key ] = value;
            }
        });
        $.each( $thisbutton[0].dataset, function( key, value ) {
            if(!ignoreKey.includes(key)){
                data[ key ] = value;
            }
        });
        // Trigger event.
        $( document.body ).trigger( 'adding_to_cart', [ $thisbutton, data ] );
        $.ajax({
            type: 'POST',
            url: wc_add_to_cart_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'add_to_cart' ),
            data: data,
            success: function( response ) {
                if ( ! response ) {
                    return;
                }
                if ( response.error && response.product_url ) {
                    window.location = response.product_url;
                    return;
                }
                // Redirect to cart option
                if ( wc_add_to_cart_params.cart_redirect_after_add === 'yes' ) {
                    window.location = wc_add_to_cart_params.cart_url;
                    return;
                }
                // Trigger event so themes can refresh other areas.
                $( document.body ).trigger( 'added_to_cart', [ response.fragments, response.cart_hash, $thisbutton ] );
            },
            dataType: 'json'
        })
        return false;
    })

}(jQuery));

(function ($) {

    "use strict";

    const onThumbClick = (mainCarousel, thumbCarousel, index) => () => {
        if (!thumbCarousel.clickAllowed()) return;
        mainCarousel.scrollTo(index);
    };

    const followMainCarousel = (mainCarousel, thumbCarousel) => () => {
        thumbCarousel.scrollTo(mainCarousel.selectedScrollSnap());
        selectThumbBtn(mainCarousel, thumbCarousel);
    };

    const selectThumbBtn = (mainCarousel, thumbCarousel) => {
        const previous = mainCarousel.previousScrollSnap();
        const selected = mainCarousel.selectedScrollSnap();
        thumbCarousel.slideNodes()[previous].classList.remove("is-selected");
        thumbCarousel.slideNodes()[selected].classList.add("is-selected");
    };

    const setupPrevNextBtns = (prevBtn, nextBtn, embla) => {
        prevBtn.addEventListener('click', embla.scrollPrev, false);
        nextBtn.addEventListener('click', embla.scrollNext, false);
    };

    const disablePrevNextBtns = (prevBtn, nextBtn, embla) => {
        return () => {
            if (embla.canScrollPrev()) prevBtn.removeAttribute('disabled');
            else prevBtn.setAttribute('disabled', 'disabled');

            if (embla.canScrollNext()) nextBtn.removeAttribute('disabled');
            else nextBtn.setAttribute('disabled', 'disabled');
        };
    };

    $(document).on('click', '.lakit-embla_wrap .lakit-embla__arrow, .lakit-embla_wrap .lakit-embla-thumb', function (e){
        e.preventDefault();
        return false;
    })

    $(document).on('thepack-kit/init-product-item-gallery', '.lakit-embla_wrap', function (){
        if( !$(this).hasClass('embla--inited') ){
            $(this).addClass('embla--inited');
            if($('.lakit-embla-thumb .lakit-embla__slide', $(this)).length == 1){
                $(this).addClass('no-embla');
                return;
            }

            if($('.lakit-embla-thumb .lakit-embla__slide', $(this)).length < 4){
                $('.lakit-embla-thumb', $(this)).addClass('embla-c-center');
            }
            const mainCarouselView = $('.lakit-embla .lakit-embla__viewport', $(this)).get(0),
                thumbCarouselView = $('.lakit-embla-thumb .lakit-embla__viewport', $(this)).get(0),
                prevBtn = $('.lakit-embla__arrow-prev', $(this)).get(0),
                nextBtn = $('.lakit-embla__arrow-next', $(this)).get(0);

            if(typeof EmblaCarousel !== 'function' && !LaStudioKits.addedScripts.hasOwnProperty('embla-carousel')){
                LaStudioKits.addedAssetsPromises.push(LaStudioKits.loadScriptAsync('embla-carousel', ThePackKitSettings.resources['embla-carousel'], '', true));
            }

            Promise.all(LaStudioKits.addedAssetsPromises).then( () => {
                const mainCarousel = new EmblaCarousel(mainCarouselView, {
                    loop: true,
                    skipSnaps: false
                });
                const thumbCarousel = EmblaCarousel(thumbCarouselView, {
                    containScroll: "keepSnaps",
                    dragFree: true,
                    loop: false,
                    align: 'start',
                });
                thumbCarousel.slideNodes().forEach((thumbNode, index) => {
                    const onClick = onThumbClick(mainCarousel, thumbCarousel, index);
                    thumbNode.addEventListener("click", onClick, false);
                });
                const syncThumbCarousel = followMainCarousel(mainCarousel, thumbCarousel);
                const disablePrevAndNextBtns = disablePrevNextBtns(prevBtn, nextBtn, thumbCarousel);
                setupPrevNextBtns(prevBtn, nextBtn, mainCarousel);
                mainCarousel.on("select", syncThumbCarousel);
                thumbCarousel.on("init", syncThumbCarousel);
                mainCarousel.on("select", disablePrevAndNextBtns);
                mainCarousel.on("init", disablePrevAndNextBtns);
            }, ( reason ) => {
                LaStudioKits.log('initEmblaCarousel error', reason)
            } )
        }
    });

    $(window).on('elementor/frontend/init', function () {
        window.elementorFrontend.hooks.addAction('frontend/element_ready/lakit-wooproducts.default', function ($scope) {
            $('.lakit-embla_wrap', $scope).trigger('thepack-kit/init-product-item-gallery');
        });
    });

    $(document).on('thepack-kit/active-tabs', function (e, $tabContent){
        $('.col-row', $tabContent).each(function (){
            $(this).trigger('thepack-kit/LazyloadSequenceEffects');
        })
    });

    $(document).on('thepack-kit/ajax-loadmore/success thepack-kit/ajax-pagination/success thepack-kit/ajax-load-template/after thepack-kit/carousel/init_success thepack-kit/hamburger/after', function (e, data){
        $('body').trigger('jetpack-lazy-images-load');
        $('.product_item--countdown', data.parentContainer).trigger('thepack-kit/products/init-countdown');
        $('.lakit-embla_wrap', data.parentContainer).trigger('thepack-kit/init-product-item-gallery');
        $('.col-row', data.parentContainer).each(function (){
            if( $(this).closest('.lakit-tabs__content').length == 0 || $(this).closest('.lakit-tabs__content.active-content').length > 0){
                $(this).trigger('thepack-kit/LazyloadSequenceEffects');
            }
        })
    });

    document.addEventListener('DOMContentLoaded', function () {
        if(typeof la_theme_config !== "undefined"){
            $('.lakit-pagination').removeClass('woocommerce-pagination');
        }
    });

    $(document).on('thepack-kit/ajax-pagination/success thepack-kit/ajax-loadmore/success', function (e, data){
        var $wc_result_count = $('.woocommerce-result-count');
        $('.lakit-pagination').removeClass('woocommerce-pagination');
        if( $('.woocommerce-result-count', data.newData).length ){
            $wc_result_count.replaceWith($('.woocommerce-result-count', data.newData));
        }
    });

}(jQuery));

(function ($) {

    "use strict";

    function init_price_filter() {
        if ( typeof woocommerce_price_slider_params === 'undefined' ) {
            return false;
        }

        $( 'input#min_price, input#max_price' ).hide();
        $( '.price_slider, .price_label' ).show();

        var min_price = $( '.price_slider_amount #min_price' ).data( 'min' ),
            max_price = $( '.price_slider_amount #max_price' ).data( 'max' ),
            current_min_price = $( '.price_slider_amount #min_price' ).val(),
            current_max_price = $( '.price_slider_amount #max_price' ).val();

        $( '.price_slider:not(.ui-slider)' ).slider({
            range: true,
            animate: true,
            min: min_price,
            max: max_price,
            values: [ current_min_price, current_max_price ],
            create: function() {
                $( '.price_slider_amount #min_price' ).val( current_min_price );
                $( '.price_slider_amount #max_price' ).val( current_max_price );
                $( document.body ).trigger( 'price_slider_create', [ current_min_price, current_max_price ] );
            },
            slide: function( event, ui ) {
                $( 'input#min_price' ).val( ui.values[0] );
                $( 'input#max_price' ).val( ui.values[1] );
                $( document.body ).trigger( 'price_slider_slide', [ ui.values[0], ui.values[1] ] );
            },
            change: function( event, ui ) {
                $( document.body ).trigger( 'price_slider_change', [ ui.values[0], ui.values[1] ] );
            }
        });
    }

    $(document)
        .on('mouseover', '.lakit-custom-dropdown', function (){
            $(this).addClass('is-hover');
        })
        .on('mouseleave', '.lakit-custom-dropdown', function (){
            $(this).removeClass('is-hover');
        })

    $(window).on('elementor/frontend/init', function () {
        window.elementorFrontend.hooks.addAction('frontend/element_ready/lakit-woofilters.default', function ($scope) {

            var $rootFilters = $('.lakit-woofilters', $scope);

            if( $rootFilters.hasClass('inited') ){
                return;
            }

            $rootFilters.addClass('inited');

            if($('.lakit-woofilters_area', $rootFilters).text() == ''){
                // $scope.remove();
                return;
            }

            var $category = $('.lakit-wfi-source_cat_list', $scope);
            $('.lakit-woofilters_block_item', $scope).each(function (){
                if( $(this).find('.lakit-woofilters_block_item__filter').text() == '' ){
                    $(this).remove();
                }
            })
            $('.lakit-woofilters-ul li > ul', $category).each(function () {
                var $ul = $(this);
                if($ul.siblings('.narrow').length == 0){
                    $ul.before('<span class="narrow"><i></i></span>');
                }
            });
            $('.lakit-woofilters-ul li > .narrow', $category).on('click', function (e){
                e.preventDefault();
                var $parent = $(this).parent();
                if ($parent.hasClass('open')) {
                    $parent.removeClass('open');
                    $parent.find('>ul').stop().slideUp(200);
                }
                else {
                    $parent.addClass('open');
                    $parent.find('>ul').stop().slideDown(200);
                    $parent.siblings().removeClass('open').find('>ul').stop().slideUp(200);
                }
            });
            $('li.active', $category).each(function(){
                $(this).addClass('open');
                $('>ul', $(this)).css('display','block');
            });

            if( $('.lakit-wfi-source_price_range', $scope).length > 0 ){
                $(document.body).trigger('init_price_filter');
            }

            var is_vertical = $('.lakit-woofilters--type_vertical', $scope).length ? true : false;

            $('.lakit-woofilters--item_dd .lakit-woofilters_block_item__title', $scope).on('click', function (e){
                e.preventDefault();
                var $parent = $(this).closest('.lakit-woofilters_block_item');
                var speed = 200;
                if(is_vertical){
                    if($parent.hasClass('open')){
                        $parent.removeClass('open');
                        $parent.find('>.lakit-woofilters_block_item__filter').stop().fadeOut(speed);
                    }
                    else{
                        $parent.addClass('open');
                        $parent.find('>.lakit-woofilters_block_item__filter').stop().fadeIn(speed);
                        $parent.siblings('.lakit-woofilters_block_item').removeClass('open').find('>.lakit-woofilters_block_item__filter').stop().fadeOut(speed);
                    }
                }
                else{
                    if($parent.hasClass('open')){
                        $parent.removeClass('open');
                        $parent.find('>.lakit-woofilters_block_item__filter').stop().slideUp(speed);
                    }
                    else{
                        $parent.addClass('open');
                        $parent.find('>.lakit-woofilters_block_item__filter').stop().slideDown(speed);
                    }
                }
            });

            $('form select', $scope).on('change', function (e){
                e.preventDefault();
                $(this).closest("form").trigger("submit")
            });

            $('.lakit-woofilters--layout_toggle .lakit-woofilters_block_label', $scope).on('click', function (e){
                e.preventDefault();
                if( $(window).width() < 991) {
                    $('.lakit-woofilters_area', $rootFilters).removeAttr('style')
                }
                if($rootFilters.hasClass('active')){
                    $rootFilters.removeClass('active');
                    $('body').removeClass('active-lakit-woofilter');
                    if( $(window).width() > 991){
                        $('.lakit-woofilters_area', $rootFilters).stop().slideUp('fast');
                    }
                }
                else{
                    $('body').addClass('active-lakit-woofilter');
                    $rootFilters.addClass('active');
                    if( $(window).width() > 991) {
                        $('.lakit-woofilters_area', $rootFilters).stop().slideDown('fast');
                    }
                }
            })
            $('.lakit-woofilters--layout_aside .lakit-woofilters_block_label', $scope).on('click', function (e){
                e.preventDefault();
                if($rootFilters.hasClass('active')){
                    $rootFilters.removeClass('active');
                    $('body').removeClass('active-lakit-woofilter');
                }
                else{
                    $('body').addClass('active-lakit-woofilter');
                    $rootFilters.addClass('active');
                }
            });
            $('.lakit-woofilters_area__overlay', $scope).on('click', function (){
                $rootFilters.removeClass('active');
                $('body').removeClass('active-lakit-woofilter');
                $('.lakit-woofilters_area', $rootFilters).removeAttr('style')
            });

            var $dd = $('.lakit-woofilters--item_dd', $scope);
            if( $dd.length ){
                $(document).on('click', function (e){
                    if( $(e.target).closest($dd).length == 0 ){
                        if($('.lakit-woofilters_block_item.open', $dd).length){
                            $('.lakit-woofilters_block_item.open', $dd).removeClass('open');
                            $('.lakit-woofilters_block_item .lakit-woofilters_block_item__filter', $dd).removeAttr('style');
                        }
                    }
                });
            }
        });
    });

}(jQuery));