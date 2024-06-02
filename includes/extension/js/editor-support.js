(function ($) {
	"use strict";

	function addCustomCss(css, context) {
		if (!context) {
			return;
		}
		var model = context.model,
			customCSS = model.get('settings').get('tp_expand_custom_css');
		var selector = '.elementor-element.elementor-element-' + model.get('id');

		if ('document' === model.get('elType')) {
		  selector = elementor.config.document.settings.cssWrapperSelector;
		}

		if (customCSS) {
		  css += customCSS.replace(/selector/g, selector);
		}

		return css;
	  }

	elementor.hooks.addFilter('editor/style/styleText', addCustomCss);

	function addPageCustomCss() {

		var customCSS = elementor.settings.page.model.get('tp_expand_custom_css');
		if (customCSS) {
			customCSS = customCSS.replace(/selector/g, elementor.config.settings.page.cssWrapperSelector);
			elementor.settings.page.getControlsCSS().elements.$stylesheetElement.append(customCSS);
		}
	}
	// elementor.settings.page.model.on('change', addPageCustomCss);
	elementor.on('preview:loaded', addPageCustomCss);

})(jQuery);