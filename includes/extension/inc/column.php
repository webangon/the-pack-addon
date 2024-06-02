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

class TP_Column_Extra
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
        add_action('elementor/element/column/section_style/after_section_end', [
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

        if (isset($settings['url'], $settings['url']['url']) && !empty($settings['url']['url'])) {
            $element->add_render_attribute('_wrapper', 'class', 'tp-clickable-column');
            $element->add_render_attribute('_wrapper', 'style', 'cursor: pointer;');
            $element->add_render_attribute('_wrapper', 'data-column-clickable', $settings['url']['url']);
            $element->add_render_attribute('_wrapper', 'data-column-clickable-blank', $settings['url']['is_external'] ? '_blank' : '_self');
        }
 
        if (isset($settings['anim'])) {
            $element->add_render_attribute('_wrapper', 'data-aos',$settings['anim']);
            if (isset($settings['aosdu'])) {
                $element->add_render_attribute('_wrapper', 'data-aos-duration',$settings['aosdu']['size']);
            }
            if (isset($settings['aosdl'])) {
                $element->add_render_attribute('_wrapper', 'data-aos-delay',$settings['aosdl']['size']);
            }
        } 

    
    }
    
    public static function tp_element_translate($element, $args)
    {
        $element->start_controls_section(
            'section_colextra',
            [
                'label' => esc_html__('Column Extra', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $element->add_control(
            'anim',
            [
                'label' => esc_html__('Animation', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT2,
                'options' => thepack_animations(),
                'label_block' => true
            ]
        );

        $element->add_responsive_control(
            'aosdu',
            [
                'label' => esc_html__('Animation duration in ms', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 6000,
                        'step' => 250,
                    ],
                ],
                'condition' => [
                    'anim!' => '',
                ],                  
            ]
        );

        $element->add_responsive_control(
            'aosdl',
            [
                'label' => esc_html__('Animation delay in ms', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 6000,
                        'step' => 250,
                    ],
                ],
                'condition' => [
                    'anim!' => '',
                ],                  
            ]
        );

        $element->add_control(
            'colexhiv',
            [
                'label' => esc_html__('Overflow hidden', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-wrap' => 'overflow: hidden;',
                ],
            ]
        );

        $element->add_responsive_control(
            'tpcolmxwid',
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
                    '{{WRAPPER}} .elementor-widget-wrap' => 'max-width:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $element->add_control(
            'collmrg',
            [
                'label' => esc_html__('Left auto margin', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-wrap' => 'margin-left: auto;',
                ],
            ]
        );

        $element->add_control(
            'colrmrg',
            [
                'label' => esc_html__('Right auto margin', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-wrap' => 'margin-right: auto;',
                ],
            ]
        );

        $element->add_responsive_control(
            'tpvctras',
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
                    '{{WRAPPER}} >.elementor-element-populated,{{WRAPPER}} .elementor-column' => 'left:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'tphctras',
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
                    '{{WRAPPER}} >.elementor-element-populated,{{WRAPPER}} .elementor-column' => 'top:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'tpcolheight',
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
                    '{{WRAPPER}} >.elementor-widget-wrap' => 'height:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $element->add_control(
            'url',
            [
                'label' => esc_html__('Wrapper link', 'the-pack-addon'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
            ]
        );

        $element->add_responsive_control(
            'col_algn',
            [
                'label' => esc_html__('Horizontal alignment', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'the-pack-addon'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Right', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} >.elementor-element-populated' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $element->end_controls_section();

        $element->start_controls_section(
            'section_coltxtov',
            [
                'label' => esc_html__('Text Overlay', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $element->add_control(
            'coltxt',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Text', 'the-pack-addon'),
                'label_block' => true,
                'selectors' => [
                    '{{WRAPPER}} >.elementor-widget-wrap:before' => 'content:"{{VALUE}}";',
                ],
            ]
        );

        $element->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'coltxtyp',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} >.elementor-widget-wrap:before',
            ]
        );

        $element->add_control(
            'coltxtklr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} >.elementor-widget-wrap:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $element->add_control(
            'coltxtstk',
            [
                'label' => esc_html__('Text stroke color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} >.elementor-widget-wrap:before' => '-webkit-text-stroke:1px {{VALUE}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'coltxtop',
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
                    '{{WRAPPER}} >.elementor-widget-wrap:before' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'coltxlps',
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
                    '{{WRAPPER}} >.elementor-widget-wrap:before' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $element->add_control(
            'coltxabs',
            [
                'label' => esc_html__('Center position', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} >.elementor-widget-wrap:before' => 'transform: translate(-50%, -50%);',
                ],
            ]
        );

        $element->add_responsive_control(
            'coltxrt',
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
                    '{{WRAPPER}} >.elementor-widget-wrap:before' => 'transform: rotate({{SIZE}}deg);',
                ],
            ]
        );

        $element->add_responsive_control(
            'colexzind',
            [
                'label' => esc_html__('Z index', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} >.elementor-widget-wrap:before' => 'z-index: {{SIZE}};',
                ],
            ]
        );

        $element->end_controls_section();
    }
}

TP_Column_Extra::init();
