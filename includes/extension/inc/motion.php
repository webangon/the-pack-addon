<?php
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Element_Base;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Utils;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TP_Motion_Effect_Extra
{
    /**
     * Initialize
     *
     * @since 1.0.0
     *
     * @access public
     */
    public static function init()
    {
        add_action('elementor/element/common/_section_style/after_section_end', [
            __CLASS__,
            'tp_element_translate'
        ], 10, 2);

        //TODO don't work on container
        // add_action('elementor/element/container/section_layout_container/after_section_end', [
        //     __CLASS__,
        //     'tp_element_translate'
        // ], 10, 2);

        add_action('elementor/frontend/after_register_styles', [
            __CLASS__,
            'register_enqueue_scripts'
        ]);  

        add_action('elementor/frontend/before_render', [
            __CLASS__,
            'enqueue_in_widget'
        ]); 

        add_action('elementor/preview/enqueue_scripts', [
            __CLASS__,
            'enqueue_preview_scripts'
        ]);        
    }

    public static function register_enqueue_scripts() {
        wp_register_script('motion-effects', THE_PACK_PLUGIN_URL . 'assets/js/motion-fx.min.js', ['elementor-frontend-modules','elementor-frontend'], THE_PACK_PLUGIN_VERSION, true);
    }

    public static function enqueue_preview_scripts() {
        wp_enqueue_script('motion-effects');
    }

    public static function enqueue_in_widget($element) {
        $motion_groups = [
            'motion_fx_motion_fx_mouse',
            'motion_fx_motion_fx_scrolling',
            'sticky',
            'background_motion_fx_motion_fx_scrolling',
            'background_motion_fx_motion_fx_mouse',
        ];
        $need_enqueue_motion = false;
        foreach ($motion_groups as $group_key) {
            $group_value = $element->get_settings_for_display($group_key);
            if (!empty($group_value) && ($group_value == 'yes' || $group_value == 'top' || $group_value == 'bottom')) {
                $need_enqueue_motion = true;
            }
        }
        if ($need_enqueue_motion) {
            $element->add_script_depends('motion-effects');
        }
    }

    public static function before_render_options($element)
    {
        $settings = $element->get_settings();
        if (isset($settings['con_anim']) && !empty($settings['con_anim'])) {
            $element->add_render_attribute('_wrapper', 'class', $settings['con_anim']);
        }
    }

    public static function tp_element_translate($element, $args)
    {   
        $element->start_controls_section(
            'container_motion',
            [
                'label' => esc_html__('Motion Effect', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
  
        $exclude = [];
        $selector = '{{WRAPPER}}';

		$elementType = $element->get_type();

        if ( $elementType == 'section' || $elementType == 'container' ) {
            $exclude[] = 'motion_fx_mouse';
        }
        elseif ($elementType == 'column') {
            $selector .= ' > .elementor-widget-wrap';
        }
        else {
            $selector .= ' > .elementor-widget-container';
        }
        $element->add_group_control('motion_fx', [
            'name' => 'motion_fx',
            'selector' => $selector,
            'exclude' => $exclude,
        ]);

        $element->end_controls_section();
        
    }
}

TP_Motion_Effect_Extra::init();
