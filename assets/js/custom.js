(function ($) {
    "use strict";
    var CirclCntr = function ($scope, $) {
        $scope.find('.counter_content').each(function () {
            var settings = $(this).find('.client_counterup').data('options');
            var num = settings['size'];
            var prefix = settings['pre'];
            var dotpercent = '.' + num + '';
            var ourtarget = $(this).find('.circle');
            if (ourtarget.length) {
                (function () {
                    var proto = $.circleProgress.defaults,
                        originalDrawEmptyArc = proto.drawEmptyArc;
                    proto.emptyThickness = 5;
                    proto.drawEmptyArc = function (v) {
                        var oldGetThickness = this.getThickness,
                            oldThickness = this.getThickness(),
                            emptyThickness = this.emptyThickness || _oldThickness.call(this),
                            oldRadius = this.radius,
                            delta = (oldThickness - emptyThickness) / 2;
                        this.getThickness = function () {
                            return emptyThickness;
                        };
                        this.radius = oldRadius - delta;
                        this.ctx.save();
                        this.ctx.translate(delta, delta);
                        originalDrawEmptyArc.call(this, v);
                        this.ctx.restore();
                        this.getThickness = oldGetThickness;
                        this.radius = oldRadius;
                    };
                })();
                ourtarget.circleProgress({
                    emptyThickness: settings['ethk'],
                    size: 210,
                    thickness: settings['thk'],
                    lineCap: 'round',
                    emptyFill: settings['sclr'],
                    fill: {
                        //gradient: ['#fff', ['#000', 0.7]],
                        color: settings['pclr'],
                        gradientAngle: Math.PI * -0.3
                    }
                });
                ourtarget.circleProgress({
                    value: dotpercent
                }).on('circle-animation-progress', function (event, progress) {
                    $(this).find('strong').html(Math.round(num * progress) + '<span class="prefix">' + prefix + '</span>');
                });
            }
            ;
        });
    };

    var TbgalSlkThm = function ($scope, $) {
        $scope.find('.tpsingle-slide').each(function () {
            var nxt = $(this).find('.next-img');
            var prv = $(this).find('.prev-img');
            var pagi = $(this).find('.tp-pagination');
            var settings = $(this).data('xld');
            var slider = $(this).find('.gallery-top');
            var options = {
                navigation: {
                    nextEl: nxt,
                    prevEl: prv,
                },
                pagination: {
                    el: pagi,
                    clickable: true,
                    type: 'bullets',
                },

                autoplay: {
                    delay: settings['speed'],
                    enabled: settings['auto'],
                },

                loop: true,
                effect: settings['fade'],
            };

            if ('undefined' === typeof Swiper) {
                const asyncSwiper = elementorFrontend.utils.swiper;
                new asyncSwiper(slider, options).then((newSwiperInstance) => {
                    var swiper = newSwiperInstance;
                });

            } else {
                var swiper = new Swiper(slider, options);
            }

        });
    };

    var ClientSlider = function ($scope, $) {

        $scope.find('.tpswiper').each(function () {
            var settings = $(this).data('xld');
            var nxt = $(this).find('.khbprev');
            var prv = $(this).find('.khbnxt');
            var pagi = $(this).find('.swiper-pagination');
            var options = {
                loop: true,
                paginationClickable: true,
                spaceBetween: settings['space'],
                mousewheel: settings['mouse'],
                navigation: {
                    nextEl: nxt,
                    prevEl: prv
                },

                autoplay: {
                    delay: settings['speed'],
                    enabled: settings['auto'],
                },

                pagination: {
                    el: pagi,
                    clickable: true,
                    type: 'bullets',
                },
                breakpoints: {
                    1140: {
                        slidesPerView: settings['item'],
                    },
                    768: {
                        slidesPerView: settings['item_tab'],
                    },
                    1: {
                        slidesPerView: 1,
                    },
                },
            };
            if ('undefined' === typeof Swiper) {
                const asyncSwiper = elementorFrontend.utils.swiper;
                new asyncSwiper($(this), options).then((newSwiperInstance) => {
                    var swiper = newSwiperInstance;
                });

            } else {
                var swiper = new Swiper($(this), options);
            }

        });
    };

    var CardSlider = function ($scope, $) {
        $scope.find('.blog-slider').each(function () {
            var slider_elem = $(this).find('.blog-slider__wrp');
            var settings = slider_elem.data('xld');
            var options = {
                spaceBetween: 30,
                effect: 'fade',
                loop: true,
                pagination: {
                    el: '.blog-slider__pagination',
                    clickable: true,
                },
                autoplay: {
                    delay: settings['speed'],
                    enabled: settings['auto'],
                },
            };
            if ('undefined' === typeof Swiper) {
                const asyncSwiper = elementorFrontend.utils.swiper;
                new asyncSwiper($(this), options).then((newSwiperInstance) => {
                    var swiper = newSwiperInstance;
                });

            } else {
                var swiper = new Swiper($(this), options);
            }

        });
    };
    var SlickImgCar = function ($scope, $) {
        $scope.find('.xldslickcarousel').each(function () {
            var slider_elem = $(this).find('.single-item');
            var settings = $(this).data('xld');
            slider_elem.slick({
                dots: settings['dot'],
                arrows: settings['arrow'],
                prevArrow: $(this).find('.prev'),
                nextArrow: $(this).find('.next'),
                slidesToShow: settings['item'],
                autoplaySpeed: settings['speed'],
                centerMode: true,
                centerPadding: '0px',
                autoplay: settings['auto'],
            });
            if (settings['mouse']) {
                slider_elem.on('wheel', (function (e) {
                    e.preventDefault();
                    if (e.originalEvent.deltaY < 0) {
                        $(this).slick('slickNext');
                    } else {
                        $(this).slick('slickPrev');
                    }
                }));
            }
        });
    };

    var Testi5 = function ($scope, $) {
        $scope.find('.testi5-container').each(function () {
            var slider_elem = $(this);
            var settings = slider_elem.data('xld');
            var tp_prev = slider_elem.find('.khbnxt');
            var tp_next = slider_elem.find('.khbprev');
            const sliderThumbnails = slider_elem.find('.testi5wrap');
            const sliderConfiguration = {
                arrows: true,
                autoplay: settings['auto'],
                speed: 500,
                autoplaySpeed: settings['speed'],
                slidesToShow: settings['item'],
                focusOnSelect: true,
                arrows: true,
                dots: true,
                prevArrow: tp_prev,
                nextArrow: tp_next,
                responsive: [{
                    breakpoint: 1025,
                    settings: {
                        slidesToShow: settings['itemtab'],
                    }
                }, {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                    }
                }]
            }
            sliderThumbnails.slick(sliderConfiguration);
        });
    };
 
    var Tpaccordion1 = function ($scope, $) {
        $scope.find('.xldacdn').each(function () {
            var settings = $(this).data('xld');
            var faction = $('.accordion.' + settings['id'] + ' ' + 'li:eq(0) .accortitle');
            var saction = $('.accordion.' + settings['id'] + ' ' + '.accortitle');

            if (settings['collpased']) {

            } else {
                faction.addClass('active').next().slideDown();
            }

            saction.click(function (j) {
                var dropDown = $(this).closest('li').find('p');
                $(this).closest('.accordion').find('p').not(dropDown).slideUp();
                if ($(this).hasClass('active')) {
                    $(this).removeClass('active');
                } else {
                    $(this).closest('.accordion').find('.accortitle.active').removeClass('active');
                    $(this).addClass('active');
                }
                dropDown.stop(false, true).slideToggle();
                j.preventDefault();
            });
        });
    };

    var CaroPrlx = function ($scope, $) {
        $scope.find('.parallax-carousel').each(function () {
            var slider_elem = $(this);
            var settings = slider_elem.data('xld');
            var options = {
                spaceBetween: settings['space'],
                loop: true,
                centeredSlides: settings['center'],
                roundLengths: true,
                autoplay: {
                    delay: 1000,
                },
                mousewheel: settings['mouse'],
                breakpoints: {
                    1025: {
                        slidesPerView: settings['item'],
                    },
                    768: {
                        slidesPerView: settings['item_tab'],
                    },
                    480: {
                        slidesPerView: 1,
                    },
                },
            };
            if ('undefined' === typeof Swiper) {
                const asyncSwiper = elementorFrontend.utils.swiper;
                new asyncSwiper(slider_elem, options).then((newSwiperInstance) => {
                    var swiper = newSwiperInstance;
                });

            } else {
                var swiper = new Swiper(slider_elem, options);
            }

        });
    };
    var Team1 = function ($scope, $) {
        $scope.find('.team1carou').each(function () {
            var slider_elem = $(this);
            var settings = slider_elem.data('xld');
            var options = {
                paginationClickable: true,
                spaceBetween: settings['space'],
                navigation: {
                    nextEl: '.khbprev',
                    prevEl: '.khbnxt',
                },
                breakpoints: {     
                    1025: {
                        slidesPerView: settings['item'],
                    },
                    768: {
                        slidesPerView: settings['item_tab'],
                    },
                    480: {
                        slidesPerView: 1,
                    },
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                    type: 'bullets',
                },
                loop: true,
                autoplay: {
                    delay: settings['speed'],
                },
                mousewheel: settings['mouse'],
                on: {
                    init: function () {
                        if (settings['center']) {
                            slider_elem.find('.swiper-slide').addClass("centermode");
                        }
                    },
                },
            };

            if ('undefined' === typeof Swiper) {
                const asyncSwiper = elementorFrontend.utils.swiper;
                new asyncSwiper(slider_elem, options).then((newSwiperInstance) => {
                    var swiper = newSwiperInstance;
                });

            } else {
                var swiper = new Swiper(slider_elem, options);
            }
        });
    };
    var Team2 = function ($scope, $) {
        $scope.find('.tbteam2.hascarou').each(function () {
            var slider_elem = $(this);
            var settings = slider_elem.data('xld');
            var options = {
                slidesPerView: settings['item'],
                paginationClickable: true,
                spaceBetween: settings['space'],
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    1025: {
                        slidesPerView: settings['item'],
                    },
                    768: {
                        slidesPerView: settings['item_tab'],
                    },
                    0: {
                        slidesPerView: 1,
                    },
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                    type: 'bullets',
                },
                loop: true,
                autoplay: {
                    delay: settings['speed'],
                    disableOnInteraction: false,
                },
                fadeEffect: {
                    crossFade: true
                },
                mousewheel: settings['mouse'],
            };

            if ('undefined' === typeof Swiper) {
                const asyncSwiper = elementorFrontend.utils.swiper;
                new asyncSwiper(slider_elem, options).then((newSwiperInstance) => {
                    var swiper = newSwiperInstance;
                });

            } else {
                var swiper = new Swiper(slider_elem, options);
            }

        });
    };

    var HvrFolio = function ($scope, $) {
        $scope.find('.bari_assex_slider').each(function () {
            var settings = $(this).data('xld');
            var $XFeatPost = $(this);
            var $XFeatPostItems = $('.assex-wrap').children('.post-item');
            var $auto = settings['auto'];
            var $time = 0;
            var $timeInt = settings['speed'];
            var $timeMax = 1500;
            $XFeatPostItems.each(function () {
                var $XFeatPostItem = $(this);
                $XFeatPostItem.on({
                    mouseenter: function () {
                        $XFeatPostItem.addClass('active').siblings('.post-item').removeClass('active');
                        $auto = false;
                    },
                    mouseleave: function () {
                        $time = 0;
                        $auto = true;
                    }
                });
            });
            if ($XFeatPostItems.length > 1) {
                setInterval(function () {
                    if ($auto && $time > $timeMax) {
                        $time = 0;
                        var $activeItem = $('.assex-wrap').children('.post-item.active');
                        var $nextItem = $activeItem.next('.post-item').hasClass('post-item') ? $activeItem.next('.post-item') : $XFeatPostItems.eq(0);
                        $nextItem.addClass('active');
                        $activeItem.removeClass('active');
                    } else {
                        $time += $timeInt;
                    }
                }, $timeInt);
            }
        });
    };

    var Gallery2 = function ($scope, $) {
        $scope.find('.aegrid-gallery').each(function () {
            var slider_elem = $(this);
            if (slider_elem.hasClass('justified')) {
                var height = slider_elem.data('height');
                var truncate = slider_elem.data('truncate');
                $('.justified').flexImages({
                    rowHeight: height,
                    truncate: truncate,
                });
            }
            if (slider_elem.hasClass('masonry')) {
                var container = $('.aegrid-gallery');
                container.imagesLoaded(function () {
                    container.masonry({
                        itemSelector: '.gallery-item',
                        isAnimated: true
                    });
                });
            }
        });
    };
    var Typing1 = function ($scope, $) {
        $scope.find('.type-text').each(function () {
            var slider_elem = $(this);
            var settings = slider_elem.data('xld');
            if (settings) {
                slider_elem.each(function () {
                    var items = settings['typing'];
                    slider_elem.teletype({
                        text: $.map(items.split(';'), $.trim),
                        typeDelay: 10,
                        backDelay: 20,
                        cursor: settings['cursor'],
                        delay: 3000,
                        preserve: false,
                        prefix: settings['pre'],
                        loop: 0
                    });
                });
            }
        });
    };

    var TbDateCter = function ($scope, $) {
        $scope.find('.countdown').each(function () {
            var settings = $(this).data('xld');
            if ($.fn.countdown) {
                $('.countdown').countdown({
                    date: settings['date'],
                    render: function (date) {
                        return $(this.el).html("<span class='days'>" + date.days + "<span>" + settings['day'] + "</span></span><span class='hour'>" + (this.leadingZeros(date.hours)) + "<span>" + settings['hour'] + "</span></span><span class='min'>" + (this.leadingZeros(date.min)) + "<span>" + settings['min'] + "</span></span><span class='sec'>" + (this.leadingZeros(date.sec)) + "<span>" + settings['sec'] + "</span></span>");
                    }
                });
            }
        });
    };

    var FolioCarousel = function ($scope, $) {
        $scope.find('.tpswiper').each(function () {
            var slider_elem = $(this);
            var settings = slider_elem.data('xld');

            var options = {
                slidesPerView: settings['item'],
                centeredSlides: settings['center'],
                paginationClickable: true,
                spaceBetween: settings['space'],
                navigation: {
                    nextEl: '.khbprev',
                    prevEl: '.khbnxt'
                },
                autoplay: {
                    delay: settings['speed'],
                    enabled: settings['auto'],
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                    type: 'bullets',
                },
                breakpoints: {
                    1140: {
                        slidesPerView: settings['item'],
                    },
                    768: {
                        slidesPerView: settings['item_tab'],
                    },
                    1: {
                        slidesPerView: 1,
                    },
                },
                loop: true,
                mousewheel: settings['mouse'],
            };

            if ('undefined' === typeof Swiper) {
                const asyncSwiper = elementorFrontend.utils.swiper;
                new asyncSwiper(slider_elem, options).then((newSwiperInstance) => {
                    var swiper = newSwiperInstance;
                });

            } else {
                var swiper = new Swiper(slider_elem, options);
            }
        });
    };

    var Testimonial = function ($scope, $) {
        $scope.find('.testimonial-1').each(function () {
            var settings = $(this).data('xld');

            var options = {
                slidesPerView: 1,
                pagination: {
                    el: $(this).find('.swiper-pagination')[0],
                    clickable: true,
                },
                autoplay: {
                    delay: settings['speed'],
                    enabled: settings['auto'],
                },
                spaceBetween: settings['space'],

                breakpoints: {
                    1140: {
                        slidesPerView: settings['item'],
                    },
                    768: {
                        slidesPerView: settings['itemtab'],
                    },
                    1: {
                        slidesPerView: 1,
                    },
                },
                loop: true,
                navigation: {
                    nextEl: $(this).find('.khbprev'),
                    prevEl: $(this).find('.khbnxt'),
                }
            };

            if ('undefined' === typeof Swiper) {
                const asyncSwiper = elementorFrontend.utils.swiper;
                new asyncSwiper($(this), options).then((newSwiperInstance) => {
                    var swiper = newSwiperInstance;
                });

            } else {
                var swiper = new Swiper($(this), options);
            }
        });
    };

    var Tp_Click_Column = function ($scope, $) {

        $scope.find('.tp-clickable-column').each(function () {
            var _this = $(this)
            _this.on('click', function () {
                var url = $(this).data('column-clickable');

                var win = window.open(url, $(this).data('column-clickable-blank'));
                if (win) {
                    //Browser has allowed it to be opened
                    win.focus();
                } else {
                    //Browser has blocked it
                    alert('Please allow popups for this website');
                }
            });
        });
    }

    var ParaLLaxBg = function ($scope, $) {

        var $target = $scope,
            $window = $(window),
            columnId = $target.data('id');

        if ($scope.hasClass('tb-fixedfooter')) {
            if ($(window).width() < 1025) {
                return;
            }
            var selector = $('.tb-fixedfooter');
            $('body').css({
                'margin-bottom': selector.outerHeight()
            });
        }
        if ($target.hasClass('tb-parallaxbg')) {
            var settings = $target.data('jlparallax');
            var speed = settings['speed'];

            if (speed >= 0.2) {
                $('.elementor-element-' + columnId).jarallax({
                    speed: speed
                });
            }
        }

        var newScene = [];
        document.querySelectorAll('.tp-parallax-section').forEach((element, index) => {
            newScene.push(element);
        });

        $('.tp-parallax-yes').each(function (index) {
            $(this).append(newScene[index]);
        });
    };

    var ImgCarousel = function ($scope, $) {
        $scope.find('.tpswiper').each(function () {
            var slider_elem = $(this);
            var settings = slider_elem.data('thop');
            var options = {
                slidesPerView: settings['item'],
                spaceBetween: settings['space'],
                centeredSlides: settings['center'],
                mousewheel: settings['mouse'],
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                loop: true,
                coverflowEffect: {
                    rotate: 10,
                    stretch: 80,
                    depth: 200,
                    modifier: 1,
                    slideShadows: false,
                },
                autoplay: {
                    delay: settings['speed'],
                    enabled: settings['auto'],
                },
                breakpoints: {
                    1140: {
                        slidesPerView: settings['item'],
                    },
                    768: {
                        slidesPerView: settings['item_tab'],
                    },
                    1: {
                        slidesPerView: 1,
                    },
                },
                navigation: {
                    nextEl: '.khbprev',
                    prevEl: '.khbnxt',
                },
            };

            if (settings['cover']) {
                options['effect'] = 'coverflow';
            }

            if ('undefined' === typeof Swiper) {
                const asyncSwiper = elementorFrontend.utils.swiper;
                new asyncSwiper(slider_elem, options).then((newSwiperInstance) => {
                    var swiper = newSwiperInstance;
                });

            } else {
                var swiper = new Swiper(slider_elem, options);
            }

        });
    };

    var HvrEveal = function ($scope, $) {
        $scope.find('.hoverevel-scene').each(function () {
            var slider_elem = $(this);
            var $magic = slider_elem.find('.magic'),
                magicWHalf = $magic.width() / 2;
            $(document).on("mousemove", function (e) {
                $magic.css({
                    "left": e.pageX - magicWHalf,
                    "top": e.pageY - magicWHalf
                });
            });
        });
    };
    var TbHvr3 = function ($scope, $) {
        $scope.find('.tb_lhvr3').each(function () {
            $('.tb_lhvr3-name').on('mouseenter', function () {
                var main = $(this).data('id');
                $('.tb_lhvr3-name.active').removeClass('active');
                $('.tb_lhvr3imgs li.show').removeClass("show");
                $('.tb_lhvr3imgs li:nth-child(' + main + ')').addClass("show");
                $('.tb_lhvr3-name:nth-child(' + main + ')').addClass('active');
            })
            $('.tb_lhvr3-name:nth-child(1)').trigger('mouseenter');
        });
    };
    var PlyrVideo = function ($scope, $) {
        $scope.find('.plyr__video-embed').each(function () {
            if (typeof Plyr == 'function') {
                const player = new Plyr($(this), {});
            }
        });
    };

    var TpOffSidebar = function ($scope, $) {
        $scope.find('.tp-off-sidebar').each(function () {

            var slider_elem = $(this);

            slider_elem.find('.tp-tap').on('click', function () {
                slider_elem.removeClass('menu-is-closed').addClass('menu-is-opened');
            });

            $('.close-menu, .click-capture').on('click', function () {
                slider_elem.removeClass('menu-is-opened search-is-opened').addClass('menu-is-closed search-is-closed');
                slider_elem.find('.momenu-list ul').slideUp(300);
            });

            var a = slider_elem.find(".momenu-list");
            a.length && (a.children("li").addClass("menu-item-parent"), a.find(".menu-item-has-children > a").on("click", function (e) {
                e.preventDefault();
                $(this).toggleClass("opened");
                var n = $(this).next(".sub-menu"),
                    s = $(this).closest(".menu-item-parent").find(".sub-menu");
                a.find(".sub-menu").not(s).slideUp(250), n.slideToggle(250)
            }));

        });
    };

    var TpHeader = function ($scope, $) {
        $scope.find('.xlmega-header').each(function () {

            var slider_elem = $(this);

            var hclass = slider_elem;
            var hclassanim = $scope.find('.xlmega-sticky-wrapper');
            var inject_plus = $scope.find('.menu-item-has-children>a');
            $scope.find('.menu-item-has-children>a').addClass('hasub');
            inject_plus.append('<span class="tpexpand">+</span>');
            if (hclassanim) {

                var c, currentScrollTop = 0;

                $(window).scroll(function () {
                    var a = $(window).scrollTop();
                    var b = hclassanim.height();

                    currentScrollTop = a;

                    if (c < currentScrollTop && a > b + b) {
                        hclassanim.addClass("scrollUp");
                        var trnsht = 'translateY(' + '-' + b + 'px' + ')';
                        hclassanim.css("transform", trnsht);
                    } else if (c > currentScrollTop && !(a <= b)) {
                        hclassanim.removeClass("scrollUp");
                        hclassanim.css("transform", "none");
                    }
                    c = currentScrollTop;

                    if (a > (b + 150)) {
                        hclassanim.addClass("fixed");
                        $('body').css("padding-top", b + 'px');
                    } else {
                        hclassanim.removeClass("fixed");
                        $('body').css("padding-top", '0');
                    }

                });
            }

            $('.tp-navbar-toggle').on('click', function () {
                var target = $(this);
                if (target.is(".tp-navbar-toggle")) {
                    slider_elem.removeClass('menu-is-closed').addClass('menu-is-opened');
                } else {
                    slider_elem.removeClass('search-is-closed').addClass('search-is-opened');
                }

            });

            $('.close-menu, .click-capture, .momenu-list a,.tpclosetivo').on('click', function () {
                if ($(this).hasClass('hasub')) {
                    return;
                }
                slider_elem.removeClass('menu-is-opened search-is-opened').addClass('menu-is-closed search-is-closed');
                $('.momenu-list ul').slideUp(300);
            });

            var a = $(".momenu-list");
            a.length && (a.children("li").addClass("menu-item-parent"), a.find(".menu-item-has-children > a").on("click", function (e) {
                e.preventDefault();
                $(this).toggleClass("opened");
                var n = $(this).next(".sub-menu"),
                    s = $(this).closest(".menu-item-parent").find(".sub-menu");
                a.find(".sub-menu").not(s).slideUp(250), n.slideToggle(250)
            }));
        });
    };


    var TpHoverFullscreen = function ($scope, $) {
        $scope.find('.tphoverfullscreen').each(function () {
            var item = $(this).find('.item');
            var img = $(this).find('.tpimg');
            item.on('mouseenter', function () {
                var tab_id = $(this).attr('data-tab');
                item.removeClass('current');
                $(this).addClass('current');
                img.removeClass('current');
                $("#" + tab_id).addClass('current');
                if ($(this).hasClass('current')) {
                    return false;
                }
            });
        });
    };
    var TpTab = function ($scope, $) {
        $scope.find('.tp-tab').each(function () {
            var tabArea = "ul.tab-area li",
                tabContent = '.tab-content';
            $(tabArea).add(tabContent).each(function () {
                $(this).siblings(':first-child').addClass('active');
            });
            $(tabArea).on('click', function () {
                $(this).each(function () {
                    var tabIndex = $(this).index();
                    $(this).siblings().removeClass('active');
                    $(this).parent('ul').next(".tab-wrap").find(tabContent).removeClass('active');
                    $(this).addClass('active');
                    $(this).parent('ul').next(".tab-wrap").find(tabContent).eq(tabIndex).addClass('active');
                })
            });
        });
    };

    var TbBfeAft = function ($scope, $) {
        $scope.find('.beer-slider').each(function () {
            if (typeof BeerSlider !== 'undefined' && $.isFunction(BeerSlider)) {
                $.fn.BeerSlider = function (options) {
                    options = options || {};
                    return this.each(function () {
                        new BeerSlider(this, options);
                    });
                };
                $(".beer-slider").each(function (index, el) {
                    $(el).BeerSlider({
                        start: $(el).data("start")
                    })
                });
            }
        });
    };

    var TpScrollTo = function ($scope, $) {
        $scope.find('.scrollto-wrap').each(function () {
            var _target = $(this).parents('.elementor-section').next();
            $(this).find(".scroll-to").click(function () {
                $('html, body').animate({
                    scrollTop: _target.offset().top
                }, 500);
            });
        });
    };

    var Tp_Global_Event = function ($scope, $) {

        $scope.find('.tp-close-popup').each(function () {
            $(this).on('click', function (e) {
                $(this).parents('.elementor-popup-modal').hide();
            });
        });
    };

    var TpFullBlogSlider = function ($scope, $) {
        $scope.find('.thepack-swiper').each(function () {

            var settings = $(this).find('.swiper-wrapper').data('slick');
            var prev = $(this).find('.khbprev');
            var nxt = $(this).find('.khbnxt');
            var pagination = $(this).find('.swiper-pagination');

            var options = {

                loop: true,
                navigation: {
                    nextEl: prev,
                    prevEl: nxt,
                },
                pagination: {
                    el: pagination,
                    clickable: true,
                    type: 'bullets',
                },

                breakpoints: {
                    480: {
                        slidesPerView: 1,
                    }
                },
                //mousewheel: true,
            };

            if (settings['item_tab']) {
                var dataOptions = {
                    breakpoints: {
                        768: {
                            slidesPerView: settings['item_tab'],
                        }
                    }
                }
                options = $.extend({}, options, dataOptions)
            }

            if (settings['items']) {
                var dataOptions = {
                    breakpoints: {
                        1025: {
                            slidesPerView: settings['items'],
                        }
                    }
                }
                options = $.extend({}, options, dataOptions)
            }

            if (settings['space']) {
                var dataOptions = {
                    spaceBetween: settings['space'],
                }
                options = $.extend({}, options, dataOptions)
            }

            if (settings['center']) {
                var dataOptions = {
                    centeredSlides: settings['center'],
                }
                options = $.extend({}, options, dataOptions)
            }

            if (settings['transition']) {
                var dataOptions = {
                    effect: settings['transition'],
                }
                options = $.extend({}, options, dataOptions)
            }

            if (settings['auto']) {
                var dataOptions = {
                    autoplay: {
                        delay: settings['speed'],
                        enabled: true,
                    }
                }
                options = $.extend({}, options, dataOptions)
            }

            if ('undefined' === typeof Swiper) {
                const asyncSwiper = elementorFrontend.utils.swiper;
                new asyncSwiper($(this), options).then((newSwiperInstance) => {
                    var swiper = newSwiperInstance;
                });

            } else {
                var swiper = new Swiper($(this), options);
            }


        });
    };


    var TpContact = function ($scope, $) {
        $scope.find('.tp-contact-wrap').each(function () {
            var slider_elem = $(this);
            slider_elem.submit(function (e) {
                e.preventDefault();
                var this_form = $(this);
                var settings = this_form.data('xld');


                this_form.find('.tp-form-btn button').addClass('working');
                var mf = [];
                this_form.find('.item').each(function () {

                    $(this).find('.tp-input').removeClass("error");
                    var options = $(this).data("xld");
                    var form_value = $(this).find(":input").val();
                    var placeholder = $(this).find(":input").attr('placeholder');
                    mf.push({
                        'id': options['id'],
                        'type': options['type'],
                        'value': form_value,
                        'placeholder': placeholder,
                        'required': options['required'],
                    });
                });

                mf.push({ 
                    'to': settings['email'],
                    'success_msg': settings['success'],
                    'fail_msg': settings['fail'],
                    'error_msg': settings['error'],
                    'subject': settings['subject'],
                });

                var data = {
                    'action': 'tp_process_form',
                    'data': mf,
                    'nonce': tp_loadmore_params.nonce,
                };

                $.ajax({
                    url: tp_loadmore_params.ajaxurl,
                    data: data,
                    dataType: 'json', 
                    type: 'POST',
                    success: function (result) {

                        $.each(result, function (k, v) {

                            if (v['required']) {
                                $('.elementor-repeater-item-' + v['id']).find('.tp-input').addClass('error');
                            }
                        });

                        if (result['error']) {
                            this_form.find('.response').empty().show().html('<p class="error">' + result['error'] + '</p>').delay(3000).fadeOut(600);
                        } else if (result['fail']) {
                            this_form.find('.response').empty().show().html('<p class="fail">' + result['fail'] + '</p>').delay(3000).fadeOut(300);
                        } else {

                            this_form.find('.response').empty().show().html('<p class="success">' + result['success'] + '</p>').delay(3000).fadeOut(300);
                        }

                        this_form.find('.tp-form-btn button').removeClass('working');

                        //this_form.find('.response').html(result);

                    },

                }).responseJSON;

            });

        });
    };


    var TpFsSlider = function ($scope, $) {

        $scope.find('.tp-main-slider').each(function () {
            var settings = $(this).data('xld');
            var main_wrap = $(this).find('.swiper-container');
            var interleaveOffset = 0.5;
            var options = {
                loop: true,
                speed: 1000,
                parallax: true,
                watchSlidesProgress: true,
                spaceBetween: 0,
                pagination: {
                    el: main_wrap.find('.swiper-pagination')[0],
                    clickable: true,
                },
                autoplay: {
                    delay: settings['speed'],
                    enabled: settings['auto'],
                },
                navigation: {
                    nextEl: main_wrap.find('.swiper-button-next')[0],
                    prevEl: main_wrap.find('.swiper-button-prev')[0],
                }
            };
            if ('undefined' === typeof Swiper) {
                const asyncSwiper = elementorFrontend.utils.swiper;
                new asyncSwiper(main_wrap, options).then((newSwiperInstance) => {
                    var swiper = newSwiperInstance;
                });

            } else {
                var swiper = new Swiper(main_wrap, options);
            }
            if (jQuery().jarallax && settings['parallax']) {
                $('.slide-bg-image').jarallax({ imgPosition: '0% ' + settings['bgpos'] + '%' });
            }
        });
    };

    var TpGmap = function ($scope, $) {
        $scope.find('.ae-gmap').each(function () {
            if (typeof google !== 'undefined' && $(this).hasClass("no-tpmap")) {
                var settings = $(this).data('xld');
                /*var icon = settings['icon'] ? '<i class="xldmp ' + settings['icon']+ '"></i>' : '';*/
                //set google map options map_style
                var map_options = {
                    center: new google.maps.LatLng(settings['lat'], settings['long']),
                    zoom: settings['zoom'],
                    panControl: false,
                    zoomControl: false,
                    mapTypeControl: false,
                    fullscreenControl: settings['fullscrn'],
                    streetViewControl: false,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    scrollwheel: false,
                    styles: JSON.parse(settings['style']),
                }
                //inizialize the map
                var map = new google.maps.Map(document.getElementById('google-container-' + settings['id'] + ''), map_options);
                //add a custom marker to the map
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(settings['lat'], settings['long']),
                    map: map,
                    visible: true,
                    clickable: true,
                });
                if (settings['desc']) {
                    marker.info = new google.maps.InfoWindow({
                        content: settings['desc'],
                    });
                    google.maps.event.addListener(marker, 'click', function () {
                        marker.info.open(map, marker);
                    });
                }

                //add custom buttons for the zoom-in/zoom-out on the map
                function CustomZoomControl(controlDiv, map) {
                    //grap the zoom elements from the DOM and insert them in the map
                    var controlUIzoomIn = document.getElementById('wa-zoom-in'),
                        controlUIzoomOut = document.getElementById('wa-zoom-out');
                    controlDiv.appendChild(controlUIzoomIn);
                    controlDiv.appendChild(controlUIzoomOut);
                    // Setup the click event listeners and zoom-in or out according to the clicked element
                    google.maps.event.addDomListener(controlUIzoomIn, 'click', function () {
                        map.setZoom(map.getZoom() + 1)
                    });
                    google.maps.event.addDomListener(controlUIzoomOut, 'click', function () {
                        map.setZoom(map.getZoom() - 1)
                    });
                }

                var zoomControlDiv = document.createElement('div');
                var zoomControl = new CustomZoomControl(zoomControlDiv, map);
                var controlUIzoomIn = document.getElementById('wa-zoom-in');
                map.controls[google.maps.ControlPosition.LEFT_TOP].push(zoomControlDiv);
            }
        });
    };

    var TpProVideoPop = function ($scope, $) {

        $scope.find('.tp-video-pop').each(function () {
            var slider_elem = $(this);
            var settings = slider_elem.data('xld');

            slider_elem.find('.tpvideopop').on('click', function (e) {

                e.preventDefault();
                $('body').addClass('poupactive');
                var this_form = $(this);
                var vidurl = this_form.data('vurl');
                var data = {
                    'action': 'tp_pro_show_video',
                    'vurl': vidurl,
                    'nonce': tp_loadmore_params.nonce,
                };
                $.ajax({
                    url: tp_loadmore_params.ajaxurl,
                    data: data,
                    type: 'POST',
                    success: function (result) {

                        this_form.find('.tp-form-btn button').removeClass('working');
                        $('.close').on('click', function () {
                            $('body').removeClass('poupactive');
                            slider_elem.parents('html').find('.popwrap').empty();
                        });
                        slider_elem.parents('html').find('.popwrap').html(result);
                        $('.loader').hide();
                        $('iframe').mediaWrapper({
                            intrinsic: false,
                            baseWidth: 16,
                            baseHeight: 9
                        });

                    },

                });

            });
        });
    };

    function tp_global_function() {

        $(document).on("scroll", function () {
            var pixels = $(document).scrollTop();
            var pageHeight = $(document).height() - $(window).height();
            var progress = 100 * pixels / pageHeight;
            $(".tp-reading-progress .progress").css("width", progress + "%");
        })

        if ($('.tp-circular-mouse').length) {

        }
        var rellax = new Rellax('.rellax', {
            horizontal: true,
        });
    }

    var Tpwoo_tabs = function ($scope, $) {
        $scope.find('.tp-tab').each(function () {
            var tabArea = "ul.tab-area li",
                tabContent = '.tab-content';
            $(tabArea).add(tabContent).each(function () {
                $(this).siblings(':first-child').addClass('active');
            });
            $(tabArea).on('click', function () {
                $(this).each(function () {
                    var tabIndex = $(this).index();
                    $(this).siblings().removeClass('active');
                    $(this).parent('ul').next(".tab-wrap").find(tabContent).removeClass('active');
                    $(this).addClass('active');
                    $(this).parent('ul').next(".tab-wrap").find(tabContent).eq(tabIndex).addClass('active');
                })
            });
        });
    };

    var Tpwoo_Gallery = function ($scope, $) {
        $scope.find('.thepack-product-images').each(function () {
            var settings = $(this).data('xld');
            if (settings['zoom']) {
                $(this).find('.woocommerce-product-gallery__trigger').html(settings['zoom']);
            }
            if (settings['prev']) { 
                $(this).find('.flex-prev').html(settings['prev']);
            }
            if (settings['next']) {
                $(this).find('.flex-next').html(settings['next']);
            }
        });
    };

    var Tpwoo_Archive = function ($scope, $) {
        $scope.find('.tp-product-catalog-wrap').each(function () {
            var icon = $(this).find('.add_to_cart_button').data('icon');
            if (icon) {
                $(this).find('.add_to_cart_button').append(icon);
            }
        });
    };

    var TpFullscreenSearch = function ($scope, $) {
        $scope.find('.elementor-widget-container').each(function () {
            var icon = $(this).find('.seachicon');
            var fs_wrap = $(this).find('.tp-fs-search-wrap');
            var fs_close = $(this).find('.closepop');
            if (icon) {
                $(icon).on('click', function () {
                    fs_wrap.addClass('active');
                    $('html').addClass('no-ovrflow');
                });
            }
            if (fs_close) {
                $(fs_close).on('click', function () {
                    fs_wrap.removeClass('active');
                    $('html').removeClass('no-ovrflow');
                });
            }
        });
    };

    var TpAccordionMenu = function ($scope, $) {
        $scope.find('.tp-accordionmenu').each(function () {
            var icon = $(this).data('xld');
            var a = $(this).find(".momenu-list");
            $(this).find('.menu-item-has-children').children('a').append('<i aria-hidden="true" class="tpexpand ' + icon + '"></i>');
            a.length && (a.children("li").addClass("menu-item-parent"), a.find(".tpexpand").on("click", function (e) {
                e.preventDefault();
                $(this).parent().toggleClass("opened");
                var n = $(this).parent().next(".sub-menu"),
                    s = $(this).parent().closest(".menu-item-parent").find(".sub-menu");
                a.find(".sub-menu").not(s).slideUp(250), n.slideToggle(250)
            }));

        });
    };

    var TpSynHighlighter = function ($scope, $) {
        $scope.find('.tp-syntax-highlight').each(function () {
            var settings = $(this).data('xld');
            $(this).find('pre.code').highlight({
                source: settings['source'],
            });
        });
    };

    var TpFloatingNav = function ($scope, $) {
        $scope.find('.tp-floating-nav').each(function () {
            var settings = $(this).data('xld');
            $('.tp-float-nav').onePageNav({
                filter: ':not(.external)'
            });
        });
    };

    var TpImgGallery = function ($scope, $) {
        $scope.find('.elementor-widget-container').each(function () {
            var settings = $(this).parent().data('tpimgallery');
            if (settings) {
                var icon = '<i class="purecntr tbtr ' + settings['icon'] + '"></i>';
                $(this).find('.gallery-icon a').append(icon);

            }
        });
    };

    var TpAutoTab = function ($scope, $) {
        $scope.find('.auto-tab').each(function () {
            var settings = $(this).data('xld');
            var sliderContainer = $(this).find('.swiper-default')[0];
            var nxt = $(this).find('.khbprev');
            var prv = $(this).find('.khbnxt');

            var sliderSettings = {
                'loop': true,
                'centeredSlides': settings['center'],
                'spaceBetween': 0,
                'effect': 'fade',
                'navigation': {
                    nextEl: nxt[0],
                    prevEl: prv[0],
                },
                'autoplay': {
                    delay: settings['speed'],
                    enabled: settings['auto'],
                },
                breakpoints: {
                    1140: {
                        slidesPerView: 1,
                    },
                    768: {
                        slidesPerView: 1,
                    },
                    1: {
                        slidesPerView: 1,
                    },
                },
            };

            var thumbsContainer = $(this).find('.swiper-sync')[0];
            var thumbsSettings = {
                'loop': true,
                'spaceBetween': settings['space'],
                'centeredSlides': settings['center'],
                breakpoints: {
                    1140: {
                        slidesPerView: settings['item'],
                    },
                    768: {
                        slidesPerView: settings['item_tab'],
                    },
                    1: {
                        slidesPerView: 1,
                    },
                },
            };

            if ('undefined' === typeof Swiper) {
                const asyncSwiper = elementorFrontend.utils.swiper;

                new asyncSwiper(thumbsContainer, thumbsSettings).then((newSwiperThumbsInstance) => {
                    var swiperThumbs = newSwiperThumbsInstance;
                    sliderSettings["thumbs"] = { swiper: swiperThumbs };

                    new asyncSwiper(sliderContainer, sliderSettings).then((newSwiperSliderInstance) => {
                        var swiperSlider = newSwiperSliderInstance;
                    });
                });

            }
            else {

                var swiperThumbs = new Swiper(thumbsContainer, thumbsSettings);

                sliderSettings["thumbs"] = { swiper: swiperThumbs };

                var swiper = new Swiper(sliderContainer, sliderSettings);

            }

        });
    };

    var Tpwoo_ProDesign = function ($scope, $) {
        $scope.find('.tpswiper').each(function () {

            var settings = $(this).data('xld');
            var nxt = $(this).find('.khbprev');
            var prv = $(this).find('.khbnxt');
            var pagi = $(this).find('.swiper-pagination');
            var options = {
                paginationClickable: true,
                spaceBetween: settings['space'],
                navigation: {
                    nextEl: nxt[0],
                    prevEl: prv[0],
                },
                breakpoints: {
                    1025: {
                        slidesPerView: settings['item'],
                    },
                    768: {
                        slidesPerView: settings['item_tab'],
                    },
                    480: {
                        slidesPerView: 1,
                    },
                },
                pagination: {
                    el: pagi,
                    clickable: true,
                    type: 'bullets',
                },
                loop: true,
                autoplay: {
                    delay: settings['speed'],
                    enabled: settings['auto'],
                }
            };
            if ('undefined' === typeof Swiper) {
                const asyncSwiper = elementorFrontend.utils.swiper;
                new asyncSwiper($(this), options).then((newSwiperInstance) => {
                    var swiper = newSwiperInstance;
                });

            } else {
                var swiper = new Swiper($(this), options);
            }

        });

        $scope.find('.tp-woo-loop-1').each(function () {
            var icon = $(this).find('.add_to_cart_button').data('icon');
            if (icon) {
                $(this).find('.add_to_cart_button').append(icon);
            }
        });
    };

    var Tpwoo_AddTo_Cart = function ($scope, $) {
        $scope.find('.tpsinglecart').each(function () {
            var settings = $(this).data('xld');
            if (settings['cart']) {
                $(this).find('.single_add_to_cart_button').append(settings['cart']);
            }
            $(this).find('.single_add_to_cart_button').on('click', function (e) {
                if ($(this).hasClass('disabled')) {
                    return;
                }
                e.preventDefault();
                let $form = $(this).closest('form');

                if (!$form[0].checkValidity()) {
                    $form[0].reportValidity();

                    return false;
                }

                let $thisBtn = $(this),
                    product_id = $thisBtn.val() || '',
                    cartFormData = $form.serialize();

                $.ajax({
                    type: 'POST', 
                    url: tp_loadmore_params.ajaxurl,
                    data: 'action=tp_add_cart_single_product&add-to-cart=' + product_id + '&' + cartFormData,
                    beforeSend: function () {
                        $thisBtn.removeClass('added').addClass('loading');
                    },
                    complete: function () {
                        $thisBtn.addClass('added').removeClass('loading');
                    },
                    success: function (response) {
                        if (response.error && response.product_url) {
                            window.location = response.product_url;

                            return;
                        }

                        setTimeout(function () {
                            $thisBtn.removeClass('added');
                        }, 1000);

                        $(document.body).trigger('wc_fragment_refresh');
                        $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisBtn]);

                        if (typeof wc_add_to_cart_params === 'undefined') {
                            return false;
                        }

                        var currentCartCount = parseInt($('.wpr-mini-cart-icon-count').text());
                        var updatedCartCount = parseInt($scope.find('.wpr-quantity-wrapper .qty').val());
                        $('.wpr-mini-cart-icon-count').text(currentCartCount + updatedCartCount);
                    },
                });
            });

        });
    };
 


    $(window).on('elementor/frontend/init', function () {

        var widgets = {

            'ae-accor1': Tpaccordion1,

            'tb_testim_1': Testimonial,
            'tb_gallery1': ImgCarousel,
            'tb_imgbx4': ImgCarousel,
            'tb_imgbox1': ImgCarousel,

            'tp-carousel1': FolioCarousel,
            'tp-slidershop': FolioCarousel,
            'tp-typing1': Typing1,
            'tp-slkcrsl': SlickImgCar,
            'wa-gallery': Gallery2,
            'tb_foliohvr': HvrFolio,
            'tb_team1': Team1,
            'tb_team2': Team2,
            'tb_team3': Team1,
            'tb_caroparlx': CaroPrlx,


            'tb_testim_5': Testi5,
            'tb_cardslider': CardSlider,
            'gng-timer': TbDateCter,
            'tp_imgslide': TbgalSlkThm,
            'tp-beforeafter': TbBfeAft,
            'tb_lhvr3': TbHvr3,
            'hrevbg': HvrEveal,
            'ae-gmap': TpGmap,
            'tp_plyr_video': PlyrVideo,
            'tp-circounter': CirclCntr,
            'tp-hvrbg': TpHoverFullscreen,
            'tb_client1': ClientSlider,
            'tp_tab': TpTab,
            'tp-fsslider': TpFsSlider,
            'tpmegamenu': TpHeader,
            'tpbgheader-1': TpHeader,
            'tp-contact': TpContact,
            'tbbgvid': TpProVideoPop,  
            'tp-scrollto': TpScrollTo,
            'tp-syn-hightlighter': TpSynHighlighter,
            'tp-offmenu': TpOffSidebar,
            'tpmenuacc': TpAccordionMenu,
            'tpfullscrnsearch': TpFullscreenSearch,
            'tpfullslide': TpFullBlogSlider,
            'tp-auto-tab': TpAutoTab,
            'tp-floating-nav': TpFloatingNav,
            'image-gallery': TpImgGallery,

            'tp-woo-tabs': Tpwoo_tabs,
            'tp_woothumb': Tpwoo_Gallery,
            'tp_wooaddtocart': Tpwoo_AddTo_Cart,
            'tp_wooarch': Tpwoo_Archive,
            'tp_wooprode': Tpwoo_ProDesign, 
            'tp_woocat': Tpwoo_ProDesign,
            'tp_woorelated': Tpwoo_ProDesign,

        };

        if (elementorFrontend.isEditMode()) {

            $.each(widgets, function (widget, callback) {
                elementorFrontend.hooks.addAction('frontend/element_ready/' + widget + '.default', callback);
            });
            elementorFrontend.hooks.addAction('frontend/element_ready/section', ParaLLaxBg);
            tp_global_function();

        } else {

            $.each(widgets, function (widget, callback) {
                elementorFrontend.hooks.addAction('frontend/element_ready/' + widget + '.default', callback);
            });
            elementorFrontend.hooks.addAction('frontend/element_ready/section', ParaLLaxBg);
            elementorFrontend.hooks.addAction('frontend/element_ready/column', Tp_Click_Column);
            //TODO : Button click close popup
            elementorFrontend.hooks.addAction('frontend/element_ready/global', Tp_Global_Event);
            tp_global_function();
        }

    });

    AOS.init({
        easing: 'ease-in-out-sine'
    });

    var tbtops = document.querySelector(".tp-progress-wrap");
    if (tbtops) {
        var progressPath = document.querySelector('.tp-progress-wrap path');
        var pathLength = progressPath.getTotalLength();
        progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
        progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
        progressPath.style.strokeDashoffset = pathLength;
        progressPath.getBoundingClientRect();
        progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';
        var updateProgress = function () {
            var scroll = $(window).scrollTop();
            var height = $(document).height() - $(window).height();
            var progress = pathLength - (scroll * pathLength / height);
            progressPath.style.strokeDashoffset = progress;
        }
        updateProgress();
        $(window).scroll(updateProgress);
        var offset = 50;
        var duration = 550;
        jQuery(window).on('scroll', function () {
            if (jQuery(this).scrollTop() > offset) {
                jQuery('.tp-progress-wrap').addClass('active-progress');
            } else {
                jQuery('.tp-progress-wrap').removeClass('active-progress');
            }
        });
        jQuery('.tp-progress-wrap').on('click', function (event) {
            event.preventDefault();
            jQuery('html, body').animate({ scrollTop: 0 }, duration);
            return false;
        })
    }

    if ($('.masonwrp').hasClass('masonon')) {
        var container = $('.masonon');
        container.imagesLoaded(function () {
            container.masonry({
                isAnimated: true
            });
        });
    }

    // Page loader
    $(".tp-page-loader-wrap").fadeOut("slow");

    $(document).on('click', '.quantity .minus', function () {
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        $('button[name="update_cart"]').click();
        $('div.woocommerce > form input[name="update_cart"]').prop('disabled', false);
        return false;
    });



    $(document).on('click', '.quantity .plus', function () {
        var $input = $(this).parent().find('input');
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        $('button[name="update_cart"]').click();
        $('div.woocommerce > form input[name="update_cart"]').prop('disabled', false);
        return false;
    });

    $('.js-tilt').tilt({});

    if ($('.thepack-mega-menu-wrapper').length){
        var left = $('.thepack-mega-menu-wrapper').offset().left;
        $('.thepack-mega-menu-wrapper').css("margin-left", -left);
    }


    $(document).on('click', '.tp-quick-view', function (event) {
        event.preventDefault();
        $('.tp-pop-response').show();
        $('.tp-pop-response .loader').show();
        var $this = $(this);
        var productID = $this.data('id');
        var data = {
            'id': productID,
            'action': "the_pack_quickview",
            'nonce': tp_loadmore_params.nonce,
        };
        $.ajax({
            url: tp_loadmore_params.ajaxurl,
            data: data,
            method: 'POST',
            success: function (response) {
                $('.tp-pop-response .loader').hide();
                $('.tp-pop-response').find('.popwrap').html(response);
            },
            complete: function () {

                var slider_elem = $('.tp-quick-thumb');
                var options = {
                    autoplay: {
                        delay: 1500,
                        enabled: true,
                    },
                    loop: false,
                    effect: 'slide',                    
                };
                const asyncSwiper = elementorFrontend.utils.swiper;
                new asyncSwiper(slider_elem, options).then((newSwiperInstance) => {
                    var swiper = newSwiperInstance;
                });

            },     
            error: function () {
                console.log("Quick View Not Loaded");
            },
        });

    });

    $(document).on('click', '.tp-pop-response .close', function (event) {
        $('.tp-pop-response').hide();
        $('.tp-pop-response').find('.popwrap').html('');
    });

    function tp_add_to_cart($btn){
        console.log($btn);
    }

    ////
})(jQuery);