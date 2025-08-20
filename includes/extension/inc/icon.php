<?php

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Element_Base;
use Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) {
    exit;
}
 
class The_Pack_Icon_Extra_Control
{
    public static function init()
    {
        add_action('elementor/element/icon/section_style_icon/after_section_end', [
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
            'tp_islid',
            [
                'label' => esc_html__('Slide on hover', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'prefix_class' => 'tp_icon_slide_',
            ]
        );

        $element->add_control(
            'tp_ishx',
            [
                'label' => esc_html__('Hover translate X', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon:hover i' => 'transform: scaleX(-1);',
                ],
            ]
        );

        $element->end_controls_section();
    }
}

The_Pack_Icon_Extra_Control::init();
