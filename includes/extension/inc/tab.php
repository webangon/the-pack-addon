<?php

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Element_Base;
use Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) {
    exit;
}
 
class The_Pack_Tab_Extra_Control
{
    public static function init()
    {
        add_action('elementor/element/nested-tabs/section_box_style/after_section_end', [
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
            'tp_ishx',
            [
                'label' => esc_html__('Fade effect', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .e-active' => 'animation-name: fadeInOpacity;animation-timing-function: ease-in;animation-duration: .5s;',
                ],
            ]
        );

        $element->add_control(
            'tp_ht',
            [
                'label' => esc_html__('Hover title', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .e-n-tab-title' => 'cursor: pointer;',
                ],
            ]
        );

        $element->add_responsive_control(
            'tp_rk',
            [
                'label' => esc_html__('Right icon', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .e-n-tab-title' => 'justify-content: space-between;',
                ],
            ]
        );

        $element->add_responsive_control(
            'tpbwhx',
            [
                'label' => esc_html__('Width and height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .e-n-tab-icon' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};justify-content: center;',
                ],

            ]
        );
        $element->add_responsive_control(
            'tpbbrd',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .e-n-tab-icon' => 'border-radius:{{SIZE}}{{UNIT}};',
                ],

            ]
        );
        $element->add_control(
            'tpbng',
            [
                'label' => esc_html__('Background color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .e-n-tab-icon' => 'background: {{VALUE}};',
                ],
            ]
        );
        $element->add_control(
            'tpzbng',
            [
                'label' => esc_html__('Active background color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .e-n-tab-title[aria-selected=true] .e-n-tab-icon,{{WRAPPER}} .e-n-tab-title:hover .e-n-tab-icon' => 'background: {{VALUE}};',
                ],
            ]
        );
        $element->add_responsive_control(
            'tpttbg',
            [
                'label' => esc_html__('Title wrapper background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .e-n-tabs-heading' => 'background: {{VALUE}};',
                ],
            ]
        );
        $element->add_responsive_control(
            'tpttpd',
            [
                'label' => esc_html__('Title wrapper padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px','%'],
                'selectors' => [
                    '{{WRAPPER}} .e-n-tabs-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $element->end_controls_section();
    }
}

The_Pack_Tab_Extra_Control::init();
