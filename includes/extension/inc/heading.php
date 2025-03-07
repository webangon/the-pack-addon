<?php

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Element_Base;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;

if (!defined('ABSPATH')) {
    exit;
}
 
class The_Pack_Heading_Extra_Control
{
    public static function init()
    {
        add_action('elementor/element/heading/section_title_style/after_section_end', [
            __CLASS__,
            'extra_controll'
        ], 10, 2);
    }

    public static function extra_controll($element, $args)
    {
        $element->start_controls_section(
            'tpbtnsx',
            [
                'label' => esc_html__('Extra style', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $element->add_control(
            'dispinly',
            [
                'label' => esc_html__('Display inline', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title' => 'display: inline-block;',
                ],
            ]
        );

        $element->add_control(
            'vert',
            [
                'label' => esc_html__('Vertical text', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title' => 'writing-mode: vertical-lr;text-orientation: upright;',
                ],
            ]
        );

        $element->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tbxdw',
                'selector' => '{{WRAPPER}} .elementor-heading-title',
                'label' => esc_html__('Box shadow', 'the-pack-addon'),
            ]
        );

        $element->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tbdrkl',
                'selector' => '{{WRAPPER}} .elementor-heading-title',
                'label' => esc_html__('Border', 'the-pack-addon'),
            ]
        );

        $element->add_responsive_control(
            'tbradr',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', '%'],                
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title' => 'border-radius: {{SIZE}}{{UNIT}};',
                ]

            ]
        );

        $element->add_responsive_control(
            'tpagd',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'tpamrg',
            [
                'label' => esc_html__('Margin', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $element->add_responsive_control(
            'twid',
            [
                'label' => esc_html__('Width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', '%'],                
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title' => 'max-width: {{SIZE}}{{UNIT}};',
                ]

            ]
        );

        $element->add_responsive_control(
            'thit',
            [
                'label' => esc_html__('Height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', '%'],                
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title' => 'min-height: {{SIZE}}{{UNIT}};',
                ]

            ] 
        );

        $element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'clipbg',
                'selector' => '{{WRAPPER}} .elementor-heading-title',
                'label' => esc_html__('Background', 'the-pack-addon'),
            ]
        );

        $element->add_control(
            'clips',
            [
                'label' => esc_html__('Background clip', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title' => '-webkit-background-clip: text;-webkit-text-fill-color: transparent;',
                ],
            ]
        );

        $element->add_control(
            'tvpos',
            [
                'label' => esc_html__('Vertical align', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'center' => [
                        'title' => esc_html__('Center', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Right', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title' => 'align-items: {{VALUE}};display:flex;',
                ]                
            ]
        );

        $element->end_controls_section();
    }
}

The_Pack_Heading_Extra_Control::init();
