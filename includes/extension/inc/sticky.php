<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;

if (!defined('ABSPATH')) {
    exit;
}

// this class is used in magazine element
class the_pack_sticky_section_column
{
    public static function init()
    {
        add_action('elementor/element/section/section_advanced/after_section_end', [
            __CLASS__,
            'section_control'
        ], 10, 2);
 
        add_action( 'elementor/element/column/section_advanced/after_section_end', [ __CLASS__, 'column_controls' ], 10, 2 );

        add_action( 'elementor/frontend/after_enqueue_scripts', [ __CLASS__, 'enqueue_scripts' ] );

        //add_action('elementor/frontend/column/before_render', [ __CLASS__,'before_render_options'], 10, 2);
    }

    public static function before_render_options($element)
    {
        $settings = $element->get_settings_for_display();

        if (isset($settings['tp_sticky_col_effect_enable']) && !empty($settings['tp_sticky_col_effect_enable']) ) {
            $element->add_render_attribute('_wrapper', 'class', 'tp-clickable-column');
            //$element->add_render_attribute('_wrapper', 'style', 'cursor: pointer;');
            //$element->add_render_attribute('_wrapper', 'data-column-clickable', $settings['url']['url']);
            //$element->add_render_attribute('_wrapper', 'data-column-clickable-blank', $settings['url']['is_external'] ? '_blank' : '_self');
        }
    }
 
    public static function enqueue_scripts() {
        wp_enqueue_script('thepack-sticky', THE_PACK_PLUGIN_URL . 'assets/js/sticky-effect.js', [], THE_PACK_PLUGIN_VERSION, true);
    }

    public static function column_controls ( $element, $args ) {

        $element->start_controls_section(
            'tp_sticky_col_effect',
            [
                'label' => esc_html__( 'Sticky Column Effect', 'the-pack-addon' ),
                'tab' => Controls_Manager::TAB_ADVANCED,
            ]
        );

        $element->add_control(
            'tp_sticky_col_effect_enable',
            [
                'label'        => esc_html__( 'Enable column sticky effect', 'the-pack-addon' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => false,
                'return_value' => 'yes',
                'frontend_available' => true, 
            ]
        );

        $element->add_control(
            'tp_sticky_col_effect_enable_on',
            [
                'label' => esc_html__( 'Enable On', 'the-pack-addon' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'label_block' => 'true',
                'default' => [ 'desktop'],
                'options' => [
                    'desktop' => esc_html__( 'Desktop', 'the-pack-addon' ),
                    'tablet' => esc_html__( 'Tablet', 'the-pack-addon' ),
                    'mobile' => esc_html__( 'Mobile', 'the-pack-addon' ),
                ],
                'frontend_available' => true,
                'condition' => [
                    'tp_sticky_col_effect_enable' => 'yes'
                ],
            ]
        );

        $element->add_control(
            'tp_sticky_col_effect_offset_top',
            [
                'label' => esc_html__( 'Offset top', 'the-pack-addon' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1
                    ],
                ],
                'size_units' => [ 'px' ],
                'frontend_available' => true,
                'condition' => [
                    'tp_sticky_col_effect_enable' => 'yes',
                ],
            ]
        );

        $element->end_controls_section();

    }

    public static function section_control($element, $args)
    {
        $element->start_controls_section(
            'tp_sticky_section',
            [
                'label' => esc_html__('Sticky section', 'the-pack-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_ADVANCED,
            ]
        );

        $element->add_control(
            'tp_sticky_sec_effect_enable',
            [
                'label'        => esc_html__( 'Enable', 'the-pack-addon' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => false,
                'return_value' => 'yes',
                'frontend_available' => true,
            ]
        );

        $element->add_control(
            'tp_sticky_sec_effect_enable_on',
            [
                'label' => esc_html__( 'Enable On', 'the-pack-addon' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'label_block' => 'true',
                'default' => [ 'desktop'],
                'options' => [
                    'desktop' => esc_html__( 'Desktop', 'the-pack-addon' ),
                    'tablet' => esc_html__( 'Tablet', 'the-pack-addon' ),
                    'mobile' => esc_html__( 'Mobile', 'the-pack-addon' ),
                ],
                'frontend_available' => true,
                'condition' => [
                    'tp_sticky_sec_effect_enable' => 'yes'
                ],
            ]
        );

        $element->add_control(
            'tp_sticky_sec_effect_scroll_offset',
            [
                'label' => esc_html__( 'Scroll Offset', 'the-pack-addon' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'size_units' => [ 'px' ],
                'frontend_available' => true,
                'condition' => [
                    'tp_sticky_sec_effect_enable' => 'yes',
                ],
            ]
        );

        $element->add_control(
            'tp_sticky_sec_section_effect_offset_top',
            [
                'label' => esc_html__( 'Offset top', 'the-pack-addon' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1
                    ],
                ],
                'size_units' => [ 'px' ],
                'frontend_available' => true,
                'condition' => [
                    'tp_sticky_sec_effect_enable' => 'yes',
                ],
            ]
        );

        $element->add_control(
            'tp_sticky_sec_effect_z_index',
            [
                'label' => esc_html__( 'Z-Index', 'the-pack-addon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1000,
                'step' => 1,
                'default' => 1,
                'frontend_available' => true,
                'condition' => [
                    'tp_sticky_sec_effect_enable' => 'yes'
                ],
            ]
        );

		$element->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'tp_sticky_sec_effect_background',
				'label' => esc_html__( 'Background', 'the-pack-addon' ),
				'types' => [ 'classic', 'gradient' ],
				'condition' => [
					'tp_sticky_sec_effect_enable' => 'yes'
				],
				'selector' => '.elementor-element.elementor-element-{{ID}}.tp-section-sticky-effect-yes-{{ID}}.tp-section-sticky',
			]
		);

		$element->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tp_sticky_sec_effect_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'the-pack-addon' ),
				'condition' => [
					'tp_sticky_sec_effect_enable' => 'yes'
				],
				'selector' => '.elementor-element.elementor-element-{{ID}}.tp-section-sticky-effect-yes-{{ID}}.tp-section-sticky',
			]
		);

		$element->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'tp_sticky_sec_effect_borders',
				'label' => esc_html__( 'Border', 'the-pack-addon' ),
				'selector' => '.elementor-element.elementor-element-{{ID}}.tp-section-sticky-effect-yes-{{ID}}.tp-section-sticky',
				'condition' => [
					'tp_sticky_sec_effect_enable' => 'yes'
				],
			]
		);


        $element->add_control(
            'tp_sticky_sec_effect_hide_on_scroll_down',
            [
                'label'        => esc_html__( 'Hide on scroll down', 'the-pack-addon' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => false,
                'separator' => 'before',
                'condition' => [
                    'tp_sticky_sec_effect_enable' => 'yes'
                ],
                'return_value' => 'yes',
                'frontend_available' => true,
            ]
        );

        $element->end_controls_section();
    }

}

the_pack_sticky_section_column::init();
