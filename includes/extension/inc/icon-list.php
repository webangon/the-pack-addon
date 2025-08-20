<?php

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Element_Base;
use Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) {
    exit;
}

class The_Pack_Icon_List_Extra_Control
{
    public static function init()
    {
        add_action('elementor/element/icon-list/section_text_style/after_section_end', [
            __CLASS__,
            'tp_callback_function' 
        ], 10, 2);
    }

    public static function tp_callback_function($element, $args)
    {
        $element->start_controls_section(
            'tpbtnsx',
            [
                'label' => esc_html__('Extra styling', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $element->add_control(
            'rev_clm',
            [
                'label' => esc_html__('Icon on right', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-list-item' => 'flex-direction: row-reverse;',
                ],
            ]
        );

        $element->add_responsive_control(
            'iljst',
            [
                'label' => esc_html__('Justify content', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Start', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'the-pack-addon'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'flex-start' => [
                        'title' => esc_html__('Start', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('End', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-right',
                    ],                    
                    'space-between' => [
                        'title' => esc_html__('Space between', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-list-item' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'i_pad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-list-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $element->add_control(
            'i_bclr',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-list-item' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $element->add_control(
            'ibg',
            [
                'label' => esc_html__('Background color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-list-item' => 'background:{{VALUE}};',
                ],
            ]
        );

        $element->add_control(
            'ibgh',
            [
                'label' => esc_html__('Background color hover', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-list-item:hover' => 'background:{{VALUE}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'ibblr',
            [
                'label' => esc_html__('Backdrop blur', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-list-item' => 'backdrop-filter:blur({{SIZE}}{{UNIT}});-webkit-backdrop-filter:blur({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $element->add_responsive_control(
            'ibrad',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-list-item' => 'border-radius: {{SIZE}}{{UNIT}};',
                ]

            ]
        );

        $element->add_responsive_control(
            'ibcgt',
            [
                'label' => esc_html__('Row gap', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} ul' => 'row-gap: {{SIZE}}{{UNIT}};',
                ]

            ]
        );

        $element->end_controls_section();

        $element->start_controls_section(
            'iconfrx',
            [
                'label' => esc_html__('Icon styling', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $element->add_responsive_control(
            'ikwh',
            [
                'label' => esc_html__('Width and height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-list-icon' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};display:flex;justify-content: center;align-items: center;',
                ]

            ]
        );

        $element->add_responsive_control(
            'ikbrad',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-list-icon' => 'border-radius: {{SIZE}}{{UNIT}};',
                ]

            ]
        );

        $element->add_control(
            'ikbg',
            [
                'label' => esc_html__('Background color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-list-icon' => 'background:{{VALUE}};',
                ],
            ]
        );

        $element->add_control(
            'ikanim',
            [
                'label' => esc_html__('Animate icon', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-list-icon' => 'animation: tpflipInY 1s linear infinite alternate;',
                ],
            ]
        );

        $element->end_controls_section();

    }
}

The_Pack_Icon_List_Extra_Control::init();
