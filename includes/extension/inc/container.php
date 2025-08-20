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
        add_action('elementor/frontend/container/before_render', [
            __CLASS__,
            'before_render_options'
        ], 10, 2);
    }

    public static function before_render_options($element)
    {
        $settings = $element->get_settings();

        if (isset($settings['cont_url']['url']) && !empty($settings['cont_url']['url'])) {
            $element->add_render_attribute('_wrapper', 'class', 'tp-clickable-column');
            $element->add_render_attribute('_wrapper', 'style', 'cursor: pointer;');
            $element->add_render_attribute('_wrapper', 'data-column-clickable', $settings['cont_url']['url']);
            $element->add_render_attribute('_wrapper', 'data-column-clickable-blank', $settings['cont_url']['is_external'] ? '_blank' : '_self');
        }
        if (isset($settings['con_anim']) && !empty($settings['con_anim'])) {
            $element->add_render_attribute('_wrapper', 'class', $settings['con_anim']);
        }
    }

    public static function tp_element_translate($element, $args)
    {   
        //$settings = $element->get_id_int();
        //var_dump( $settings );
        $element->start_controls_section(
            'container_colextra',
            [
                'label' => esc_html__('Container Extra', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $element->add_control(
            'con_anim',
            [
                'label' => esc_html__('Scroll animation', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'reveal-top' => [
                        'title' => esc_html__('Top', 'the-pack-addon'),
                        'icon' => 'eicon-arrow-up',
                    ],

                    'reveal-bottom' => [
                        'title' => esc_html__('Bottom', 'the-pack-addon'),
                        'icon' => 'eicon-arrow-down',
                    ],

                    'reveal-left' => [
                        'title' => esc_html__('Left', 'the-pack-addon'),
                        'icon' => 'eicon-arrow-left',
                    ],

                    'reveal-right' => [
                        'title' => esc_html__('Right', 'the-pack-addon'),
                        'icon' => 'eicon-arrow-right',
                    ],

                ],
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
                'label' => esc_html__('Left position', 'the-pack-addon'),
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
            'conrpos',
            [
                'label' => esc_html__('Right position', 'the-pack-addon'),
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
                    '{{WRAPPER}}' => 'right:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'conthctras',
            [
                'label' => esc_html__('Top position', 'the-pack-addon'),
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
            'conbpd',
            [
                'label' => esc_html__('Bottom position', 'the-pack-addon'),
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
                    '{{WRAPPER}}' => 'bottom:{{SIZE}}{{UNIT}};',
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

        $element->add_responsive_control(
            'tp_con_x_wid',
            [
                'label' => esc_html__('Extra width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}}' => 'width: calc(100% + {{SIZE}}{{UNIT}});',
                ],

            ]
        );

        $element->add_control(
            'full_pad',
            [
                'label' => esc_html__('Full padding', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'condition' => [
                    'content_width' => 'full',
                ],
                'options' => [
                    'padding-left' => [
                        'title' => esc_html__('Left', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'padding-right' => [
                        'title' => esc_html__('Right', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'prefix_class' => 'tp-full-',
            ]
        );

        $element->add_responsive_control(
            'pad_max_width',
            [
                'label' => esc_html__('Max width', 'the-pack-addon'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'condition' => [
                    'full_pad!' => '',
                ],
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}.tp-full-padding-left >.e-con-full' => 'padding-left: calc((100% - {{SIZE}}{{UNIT}}) / 2)',
                    '{{WRAPPER}}.tp-full-padding-right >.e-con-full' => 'padding-right: calc((100% - {{SIZE}}{{UNIT}}) / 2)',
                ],
            ]
        );

        $element->add_control(
            'abs_pos',
            [
                'label' => esc_html__('Absolute position', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}}' => 'position:absolute;',
                ],
            ]
        );

        $element->add_control(
            'no_b_spy',
            [
                'label' => esc_html__('Absolute center', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}}' => 'transform: translate(-50%,-50%);',
                ],
            ]
        );   

        $element->add_control(
            'tp_stik_sidebar',
            [
                'label' => esc_html__('Sticky sidebar', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}}.e-con.e-child' => 'position:sticky;top:0px;',
                ],                    
            ]
        );

        $element->add_control(
            'tp_hurt',
            [
                'label' => esc_html__('Hue rotate animation', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}}.e-con' => 'animation: tp-hueRotate 10s linear infinite; ',
                ],                    
            ]
        );

        $element->add_responsive_control(
            'tpbdf',
            [
                'label' => esc_html__('Backdrop blur', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}}' => 'backdrop-filter:blur({{SIZE}}{{UNIT}});-webkit-backdrop-filter:blur({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $element->end_controls_section();
        
    }
}

TP_Container_Extra::init();
