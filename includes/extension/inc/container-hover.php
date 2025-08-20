<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TP_Container_Hover
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
        add_action('elementor/element/container/section_layout_container/after_section_end', [
            __CLASS__,
            'tp_element_translate'
        ], 10, 2);
        add_action('elementor/frontend/container/before_render', [
            __CLASS__,
            'before_render_options'
        ], 10, 2);
    }

    public static function before_render_options($element)
    {
        $settings = $element->get_settings();

        // if (isset($settings['cont_url']['url']) && !empty($settings['cont_url']['url'])) {
        //     $element->add_render_attribute('_wrapper', 'class', 'tp-clickable-column');
        //     $element->add_render_attribute('_wrapper', 'style', 'cursor: pointer;');
        //     $element->add_render_attribute('_wrapper', 'data-column-clickable', $settings['cont_url']['url']);
        //     $element->add_render_attribute('_wrapper', 'data-column-clickable-blank', $settings['cont_url']['is_external'] ? '_blank' : '_self');
        // }
    }

    public static function tp_element_translate($element, $args)
    {   
        $element->start_controls_section(
            'container_hov',
            [
                'label' => esc_html__('Hover background', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $element->add_control(
            'tp_hover_en',
            [
                'label' => esc_html__('Enable', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'prefix_class' => 'tp-container-hover'
            ]
        );

        $element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tp_hover_v',
                'selector' => '{{WRAPPER}}.tp-container-hoveryes::after',
                'label' => esc_html__('Background', 'the-pack-addon'),
            ]
        );

        $element->end_controls_section();
        
    }
}

TP_Container_Hover::init();
