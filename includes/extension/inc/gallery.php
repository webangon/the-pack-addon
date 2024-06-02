<?php
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Element_Base;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;

//TODO:Show icon on hover
if (!defined('ABSPATH')) {
    exit;
}

class he_Pack_The_Pack_Gallery_Extra_ControlHeading_Extra_Control
{
    public static function init()
    {
        add_action('elementor/element/image-gallery/section_caption/after_section_end', [
            __CLASS__,
            'extra_controll'
        ], 10, 2);
        add_action('elementor/element/image-gallery/after_add_attributes', [__CLASS__, 'add_attributes']);
        add_action('elementor/frontend/widget/before_render', [
            __CLASS__,
            'before_render_options'
        ], 10, 2);
    }
    
    //TODO: icon not visible on backend 
    public static function add_attributes(Element_Base $element){
        //$element->add_render_attribute('_wrapper', 'class', 'tp-gal-plus');
    }

    public static function before_render_options($element)
    {   
        if ( 'image-gallery' !== $element->get_name() ) return;

        $settings = $element->get_settings_for_display();

        $column_settings = [
            'icon' => $settings['icon']['value'],
        ];

        $element->add_render_attribute('_wrapper', [
            //'class' => 'tb-parallaxbg',
            'data-tpimgallery' => wp_json_encode($column_settings),
        ]);

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
            'icon',
            [
                'label' => esc_html__('Hover icon', 'the-pack-addon'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
            ]
        );

        $element->add_control(
            'igfw',
            [
                'label' => esc_html__('Full width', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} figure img' => 'width: 100%;',
                ],
            ]
        );

        $element->add_control(
            'ignovrf',
            [
                'label' => esc_html__('No overflow', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .gallery-icon' => 'overflow:hidden;',
                ],
            ]
        );

        $element->add_responsive_control(
            'ignomrg',
            [
                'label' => esc_html__('Margin', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .gallery' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $element->add_control(
            'igzhv',
            [
                'label' => esc_html__('Zoom on hover', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .gallery-icon:hover img' => 'transform: scale(1.1);',
                    '{{WRAPPER}} .gallery-icon img' => 'transition: 0.5s all ease-in-out;',
                ],
            ]
        );

        $element->add_responsive_control(
            'ight',
            [
                'label' => esc_html__('Height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1000,
                    ],
                ],               
                'selectors' => [
                    '{{WRAPPER}} figure img' => 'height: {{SIZE}}{{UNIT}};object-fit:cover;',
                ]

            ]
        );

        $element->add_responsive_control(
            'iplwh',
            [
                'label' => esc_html__('Plus Width Height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,             
                'selectors' => [
                    '{{WRAPPER}} .purecntr' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};',
                ]

            ]
        );

        $element->add_control(
            'igbrd',
            [
                'label' => esc_html__('Plus Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .purecntr' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'igbradi',
            [
                'label' => esc_html__('Plus Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .purecntr' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $element->add_control(
            'igplclr',
            [
                'label' => esc_html__('Plus Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .purecntr' => 'color: {{VALUE}};',
                ],
            ]
        );

        $element->add_control(
            'igplbg',
            [
                'label' => esc_html__('Plus Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .purecntr' => 'background: {{VALUE}};',
                ],
            ]
        );

        $element->end_controls_section();
    }
}

he_Pack_The_Pack_Gallery_Extra_ControlHeading_Extra_Control::init();
