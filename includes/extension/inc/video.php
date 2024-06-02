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

class The_Pack_Video_Extend_Controls
{
    public static function init()
    {
        add_action('elementor/element/video/section_image_overlay_style/before_section_end', [
            __CLASS__,
            'extra_controll'
        ], 10, 2);
    }

    public static function extra_controll($element, $args)
    {

        $element->add_responsive_control(
            'vcht',
            [
                'label' => esc_html__('Height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1000,
                    ],
                ],               
                'selectors' => [
                    '{{WRAPPER}} .elementor-custom-embed-image-overlay img' => 'height: {{SIZE}}{{UNIT}};',
                ]

            ]
        );

    }
}

The_Pack_Video_Extend_Controls::init();
