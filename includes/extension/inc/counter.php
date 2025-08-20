<?php

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Element_Base;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
    exit;
}
 
class The_Pack_Counter_Extra_Control
{
    public static function init()
    {
        add_action('elementor/element/counter/section_title/after_section_end', [
            __CLASS__,
            'tp_callback_function'
        ], 10, 2);
    }

    public static function tp_callback_function($element, $args)
    {
        $element->start_controls_section(
            'tpcpret',
            [
                'label' => esc_html__('Prefix', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $element->add_control(
            'l_color',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter-number-suffix' => 'color: {{VALUE}};',
                ],
            ]
        ); 

        $element->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'l_typ',
                'selector' => '{{WRAPPER}} .elementor-counter-number-suffix',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $element->end_controls_section();

        $element->start_controls_section(
            'tpcv4',
            [
                'label' => esc_html__('Title extra', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );        
        $element->add_responsive_control(
            'tal03',
            [
                'label' => esc_html__('Alignment', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'the-pack-addon'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-right',
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $element->end_controls_section();
    }
}

The_Pack_Counter_Extra_Control::init();
