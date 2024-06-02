'use strict';

(function ($, w) {

    var $window = $(w);

    $window.on('elementor/frontend/init', function () {

        var PoopArt = elementorModules.frontend.handlers.Base.extend({

            onInit: function () {

                elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);
                this.initPoopArt();

            },

            initPoopArt: function () {

                if (this.isEdit) {
                    this.$element.addClass('tp-has-beaf');
                }

            },

        });

        var handlersList = {

            'widget': PoopArt,
        };

        $.each(handlersList, function (widgetName, handlerClass) {

            elementorFrontend.hooks.addAction('frontend/element_ready/' + widgetName, function ($scope) {

                elementorFrontend.elementsHandler.addHandler(handlerClass, {$element: $scope});

            });

        });

    });

}(jQuery, window));