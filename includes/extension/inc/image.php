<?php

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Element_Base;

if (!defined('ABSPATH')) {
    exit;
}

class The_Pack_Image_Extra_Control
{
    public static function init()
    {
        add_action('elementor/element/image/section_style_image/after_section_end', [
            __CLASS__,
            'tp_icon_box_extra'
        ], 10, 2); 
    }

    public static function tp_icon_box_extra($element, $args)
    {
        $element->start_controls_section(
            'tpbtnsx',
            [
                'label' => esc_html__('Extra style', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $element->add_responsive_control(
            'intpad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} img' => 'padding: {{SIZE}}{{UNIT}};',
                ]

            ]
        );

        $element->add_control(
            'ovfhd',
            [
                'label' => esc_html__('Overflow hidden', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}}' => 'overflow:hidden;',
                ],
            ]
        );

        $element->add_control(
            '_anim',
            [
                'label' => esc_html__('Animation', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => false,
                'options' => jl_elementor_animation(),
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container img' => 'animation-name: {{VALUE}};',
                ],
            ]
        );

        $element->add_responsive_control(
            '_anim_dr',
            [
                'label' => esc_html__('Animation duration', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => .25,
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container img' => 'animation-duration: {{SIZE}}s;animation-iteration-count:infinite;',
                ],

            ]
        );

        $element->add_responsive_control(
            'tp-rotate',
            [
                'label' => esc_html__('Rotate', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -360,
                        'max' => 360,
                    ],
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container img' => 'transform: rotate({{SIZE}}deg);',
                ],

            ]
        );

        $element->add_responsive_control(
            'abspos',
            [
                'label' => esc_html__('Absolute position', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}}' => 'position: absolute;',
                ],
            ]
        );

        $element->add_responsive_control(
            'ig_width',
            [
                'label' => esc_html__('Width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],

                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}' => 'width: {{SIZE}}{{UNIT}};',
                ]

            ]
        );

        $element->add_responsive_control(
            'ig_lp',
            [
                'label' => esc_html__('Left position', 'the-pack-addon'),
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
                    '{{WRAPPER}}' => 'left: {{SIZE}}{{UNIT}};',
                ]

            ]
        );

        $element->add_responsive_control(
            'ig_rp',
            [
                'label' => esc_html__('Right position', 'the-pack-addon'),
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
                    '{{WRAPPER}}' => 'right: {{SIZE}}{{UNIT}};',
                ]

            ]
        );

        $element->add_responsive_control(
            'ig_tp',
            [
                'label' => esc_html__('Top position', 'the-pack-addon'),
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
                    '{{WRAPPER}}' => 'top: {{SIZE}}{{UNIT}};',
                ]

            ]
        );
        //TODO: enable mask 
        // $element->add_control(
        //     'enable_mask',
        //     [
        //         'type' => Controls_Manager::SWITCHER,
        //         'label' => esc_html__('Enable mask', 'the-pack-addon'),
        //         'prefix_class' => 'tp-img-mask'
        //     ]
        // );

        // $element->add_control(
        //     'mask_image',
        //     [
        //         'label' => esc_html__('Mask Image', 'the-pack-addon'),
        //         'type' => Controls_Manager::MEDIA,
        //         'selectors' => [
        //             '{{WRAPPER}} .elementor-widget-container' => '-webkit-mask-image: url({{URL}});mask-image: url({{URL}});-webkit-mask-size: cover;',
        //         ],
        //         'condition' => [
        //             'enable_mask' => 'yes'
        //         ]
        //     ]
        // );

        // $element->add_control(
        //     'cover_mask',
        //     [
        //         'type' => Controls_Manager::SWITCHER,
        //         'label' => esc_html__('Cover mask', 'the-pack-addon'),
        //         'condition' => [
        //             'enable_mask' => 'yes'
        //         ],
        //         'selectors' => [
        //             '{{WRAPPER}} .elementor-widget-container' => '-webkit-mask-size: cover;',
        //         ],
        //     ]
        // ); 

        $element->end_controls_section();
    }
}

The_Pack_Image_Extra_Control::init();
