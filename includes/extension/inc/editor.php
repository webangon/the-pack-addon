<?php

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Element_Base;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
    exit;
}
 
class The_Pack_Editor_Extra_Control
{
    public static function init()
    {
        add_action('elementor/element/text-editor/section_style/after_section_end', [
            __CLASS__,
            'tp_callback_function'
        ], 10, 2);
    }

    public static function tp_callback_function($element, $args)
    {
        $element->start_controls_section(
            'tpbtnsx',
            [
                'label' => esc_html__('Extra style', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $element->add_control(
            'l_color',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a' => 'color: {{VALUE}};',
                ],
            ]
        ); 

        $element->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'l_typ',
                'selector' => '{{WRAPPER}} a',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $element->end_controls_section();
    }
}

The_Pack_Editor_Extra_Control::init();
