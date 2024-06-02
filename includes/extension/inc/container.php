<?php
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Element_Base;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Utils;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TP_Container_Extra
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
        add_action('elementor/frontend/column/before_render', [
            __CLASS__,
            'before_render_options'
        ], 10, 2);
    }

    public static function before_render_options($element)
    {
        $settings = $element->get_settings_for_display();

        if (isset($settings['cont_url'], $settings['cont_url']['url']) && !empty($settings['cont_url']['url'])) {
            $element->add_render_attribute('_wrapper', 'class', 'tp-clickable-column');
            $element->add_render_attribute('_wrapper', 'style', 'cursor: pointer;');
            $element->add_render_attribute('_wrapper', 'data-column-clickable', $settings['url']['url']);
            $element->add_render_attribute('_wrapper', 'data-column-clickable-blank', $settings['url']['is_external'] ? '_blank' : '_self');
        }
    }

    public static function tp_element_translate($element, $args)
    {   
        //$settings = $element->get_id_int();
        //var_dump( $settings );
        $element->start_controls_section(
            'container_colextra',
            [
                'label' => esc_html__('Column Extra', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $element->add_control(
            'con_anim',
            [
                'label' => esc_html__('Animation', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT,
                'options' => thepack_animations(),
                'prefix_class' => '',
                'label_block' => true
            ]
        );

        $element->add_responsive_control(
            'contmxwid',
            [
                'label' => esc_html__('Max width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}' => 'max-width:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'contvctras',
            [
                'label' => esc_html__('Vertical translate', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}' => 'left:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'conthctras',
            [
                'label' => esc_html__('Horizontal translate', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}' => 'top:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'contcolheight',
            [
                'label' => esc_html__('Height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', 'vh', '%'],
                'selectors' => [
                    '{{WRAPPER}}' => 'height:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $element->add_control(
            'cont_url',
            [
                'label' => esc_html__('Wrapper link', 'the-pack-addon'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
            ]
        );

        $element->end_controls_section();

        $element->start_controls_section(
            'container_coltxtov',
            [
                'label' => esc_html__('Text Overlay', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $element->add_control(
            'contxt',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Text', 'the-pack-addon'),
                'label_block' => true,
                'selectors' => [
                    '{{WRAPPER}}:before' => 'content:"{{VALUE}}";',
                ],
            ]
        );

        $element->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'conttxtyp',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}}:before',
            ]
        );

        $element->add_control(
            'conttxtklr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $element->add_control(
            'conttxtstk',
            [
                'label' => esc_html__('Text stroke color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}:before' => '-webkit-text-stroke:1px {{VALUE}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'conttxtop',
            [
                'label' => esc_html__('Top position', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -1500,
                        'max' => 1500,
                        'step' => 1,
                    ],

                    '%' => [
                        'min' => -200,
                        'max' => 200,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}:before' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'conttxlps',
            [
                'label' => esc_html__('Left position', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -1500,
                        'max' => 1500,
                        'step' => 1,
                    ],

                    '%' => [
                        'min' => -200,
                        'max' => 200,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}:before' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $element->add_control(
            'conttxabs',
            [
                'label' => esc_html__('Center position', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}}:before' => 'transform: translate(-50%, -50%);',
                ],
            ]
        );

        $element->add_responsive_control(
            'conttxrt',
            [
                'label' => esc_html__('Rotate', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -360,
                        'max' => 360,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}}:before' => 'transform: rotate({{SIZE}}deg);',
                ],
            ]
        );

        $element->add_responsive_control(
            'contexzind',
            [
                'label' => esc_html__('Z index', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}}:before' => 'z-index: {{SIZE}};',
                ],
            ]
        );

        $element->end_controls_section();
    }
}

TP_Container_Extra::init();
