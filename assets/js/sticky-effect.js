
"use strict";

const tpStickyEffect = {

    stickySectionEffect: function ( wrapperName, settings ) {

        const stickySection = document.querySelector( `.${wrapperName}` );
        const scrollDistance = settings.tp_sticky_sec_effect_scroll_offset.size;
        const enableOnScrollDown = settings.tp_sticky_sec_effect_hide_on_scroll_down;

        function setScrollStyles() {
            stickySection.classList.add( 'tp-section-sticky' );
            settings.tp_sticky_sec_effect_z_index ? stickySection.style.zIndex = settings.tp_sticky_sec_effect_z_index : stickySection.style.removeProperty( 'z-index' );
            stickySection.style.top = ( settings.tp_sticky_sec_section_effect_offset_top.size ? settings.tp_sticky_sec_section_effect_offset_top.size : 0 ) + 'px';
        }

        function removeScrollStyles() {
            stickySection.classList.remove( 'tp-section-sticky' );
            stickySection.style.removeProperty( 'z-index' );
            stickySection.style.removeProperty( 'top' );
            stickySection.classList.remove( 'tp-section-sticky-hide' );
        }

        let scroll_position = 0;
        let scroll_direction;

        const scrollSectionListener = () => {
            if ( !document.querySelector( `.${wrapperName}` ) ) { window.removeEventListener( 'scroll', scrollSectionListener ) }
            stickySection.classList.add( 'tp-section-sticky' );
            const scrollOffset = window.scrollY;
            if ( scrollOffset >= scrollDistance && document.querySelector( `.${wrapperName}` ) ) {
                setScrollStyles();
                if ( enableOnScrollDown === 'yes' ) {

                    scroll_direction = document.body.getBoundingClientRect().top > scroll_position ? 'up' : 'down';
                    scroll_position = document.body.getBoundingClientRect().top;

                    if ( scroll_direction === 'up' ) {
                        stickySection.classList.remove( 'tp-section-sticky-hide' );
                    } else if ( scroll_direction === 'down' ) {
                        stickySection.classList.add( 'tp-section-sticky-hide' );
                    }

                }

            } else {
                stickySection.classList.remove( 'tp-section-sticky' );
                removeScrollStyles();
            }
        }

        window.addEventListener( 'scroll', scrollSectionListener );

    },

    stickyColumnEffect: function ( wrapperName, settings ) {

        const wrapper = document.querySelector( `.${wrapperName}` );
        if ( !wrapper ) { return; }
        const stickyColumn = document.querySelector( `.${wrapperName} .elementor-widget-wrap` );
        const stickyColumnSection = stickyColumn.parentElement.parentElement;
        const stickyColumnSectionOffsetTop = settings.tp_sticky_col_effect_offset_top ? settings.tp_sticky_col_effect_offset_top : 0;
        const stickyColumnParentElement = stickyColumn.parentElement;
        let stickyColumnSectionInitialHeight;

        stickyColumnSectionInitialHeight = stickyColumnSection.getBoundingClientRect().height;

        const scrollColumnListener = () => {
            if ( !document.querySelector( `.${wrapperName}` ) ) {
                window.removeEventListener( 'scroll', scrollColumnListener );
            }

            if ( stickyColumn.closest( '.tp-section-sticky' ) ) {
                stickyColumnParentElement.style.removeProperty( 'align-items' );
                stickyColumn.style.removeProperty( 'top' );
                stickyColumn.style.removeProperty( 'bottom' );
                stickyColumn.style.removeProperty( 'height' );
                stickyColumnSection.style.removeProperty( 'height' );
                return;
            }

            const stickyColumnSectionTopOffset = stickyColumnSection.getBoundingClientRect().top;
            const startPosition = stickyColumnSectionOffsetTop.size;
            let isNotEqualHeight;

            // set height and width of sticky column
            stickyColumn.style.height = 'fit-content';
            stickyColumn.style.width = stickyColumnParentElement.offsetWidth + 'px';

            if ( stickyColumn.getBoundingClientRect().height !== wrapper.getBoundingClientRect().height ) {
                isNotEqualHeight = true;
            } else isNotEqualHeight = !!settings.tp_sticky_col_effect_enable_on.includes( 'mobile' );

            if ( isNotEqualHeight ) {
                if ( stickyColumnSectionTopOffset <= startPosition && document.querySelector( `.${wrapperName}` )  ) {
                    // set height of column section on mobile
                    if ( window.matchMedia( `(max-width: ${elementorFrontend.config.responsive.activeBreakpoints.mobile.value}px)` ).matches ) {
                        stickyColumnSection.style.height = stickyColumnSectionInitialHeight + 'px';
                    }
                    if ( stickyColumnSection.getBoundingClientRect().bottom >= ( parseInt( window.getComputedStyle( stickyColumn ).getPropertyValue( 'height' ) ) + stickyColumnSectionOffsetTop.size ) ) {
                        stickyColumn.classList.add( 'tp-column-sticky' );
                        stickyColumn.style.top = `${stickyColumnSectionOffsetTop.size}${stickyColumnSectionOffsetTop.unit}`;
                    } else {
                        stickyColumn.classList.remove( 'tp-column-sticky' );
                        stickyColumnParentElement.style.alignItems = 'flex-end';
                        stickyColumn.style.removeProperty( 'top' );
                        stickyColumn.style.removeProperty( 'bottom' );
                        stickyColumn.style.removeProperty( 'height' );
                        stickyColumnSection.style.removeProperty( 'height' );
                        stickyColumn.style.removeProperty( 'width' );
                    }
                } else {
                    stickyColumn.classList.remove( 'tp-column-sticky' );
                    stickyColumnParentElement.style.removeProperty( 'align-items' );
                    stickyColumn.style.removeProperty( 'top' );
                    stickyColumn.style.removeProperty( 'bottom' );
                    stickyColumn.style.removeProperty( 'height' );
                    stickyColumnSection.style.removeProperty( 'height' );
                    stickyColumn.style.removeProperty( 'width' );
                }

            }

        }

        window.addEventListener( 'scroll', scrollColumnListener );

    },

    checkScreenSize: function ( enableOn, callback ) {

        if ( enableOn.includes( 'mobile' ) && window.matchMedia( `(max-width: ${elementorFrontend.config.responsive.activeBreakpoints.mobile.value}px)` ).matches ) {
            callback();
        }

        if ( enableOn.includes( 'tablet' ) && window.matchMedia( `(min-width: ${elementorFrontend.config.responsive.activeBreakpoints.mobile.value + 1}px)` ).matches
            && window.matchMedia( `(max-width: ${elementorFrontend.config.responsive.activeBreakpoints.tablet.value}px)` ).matches ) {
            callback();
        }

        if ( enableOn.includes( 'desktop' ) && window.matchMedia( `(min-width: ${elementorFrontend.config.responsive.activeBreakpoints.tablet.value + 1}px)` ).matches ) {
            callback();
        }
    },

    setStickyEffect: function ( $column, $section ) {

        // sticky columns
        const isEditor = elementorFrontend.isEditMode();
        const elements_editor_data = isEditor ? elementorFrontend.config.elements.data : [];
        let settingsColumns = {};
        let settingsSections = {};

        function setSettings( element ) {
            let settings = {};
            if ( isEditor ) {
                if ( element.dataset.modelCid ) {
                    const elementsDataset = elements_editor_data[element.dataset.modelCid].attributes;
                    for ( let key in elementsDataset ) {
                        if ( key.startsWith( 'tp' ) ) {
                            settings[key] = elementsDataset[key];
                        }
                    }
                } else if ( element.dataset.settings ) {
                    settings = JSON.parse( element.dataset.settings );
                }
            } else if ( !isEditor && element.dataset.settings ) {
                settings = JSON.parse( element.dataset.settings );
            }

            return settings;
        }

        // sticky column
        if ( $column ) {
            settingsColumns = setSettings( $column );
            if ( settingsColumns.tp_sticky_col_effect_enable === 'yes' ) {
                $column.classList.add(`tp-column-sticky-effect-yes-${$column.dataset.id}`);
                this.checkScreenSize( settingsColumns.tp_sticky_col_effect_enable_on, this.stickyColumnEffect.bind( null, `tp-column-sticky-effect-yes-${$column.dataset.id}`, settingsColumns ) );
            } else {
                $column.classList.remove( `tp-column-sticky-effect-yes-${$column.dataset.id}` );
            }
        }

        // sticky section
        if ( $section ) {
            settingsSections = setSettings( $section );
            if ( settingsSections.tp_sticky_sec_effect_enable === 'yes' ) {
                $section.classList.add(`tp-section-sticky-effect-yes-${$section.dataset.id}`);
                this.checkScreenSize( settingsSections.tp_sticky_sec_effect_enable_on, this.stickySectionEffect.bind( null, `tp-section-sticky-effect-yes-${$section.dataset.id}`, settingsSections) );
            } else {
                $section.classList.remove( `tp-section-sticky-effect-yes-${$section.dataset.id}` );
                $section.classList.remove( 'tp-section-sticky' );
            }
        }

    }

};

jQuery( window ).on( 'elementor/frontend/init', function () {

    elementorFrontend.hooks.addAction( 'frontend/element_ready/global', function( $scope ) {

        const element = $scope[0].dataset.element_type;

        if ( element === 'column' ) {
            setTimeout( () => {
                tpStickyEffect.setStickyEffect.call( tpStickyEffect, $scope[0], null );
            }, 0 );
        } else if ( element === 'section' ) {
            setTimeout( () => {
                tpStickyEffect.setStickyEffect.call( tpStickyEffect, null, $scope[0] );
            }, 0 );
        }
    } );

} );