<?php
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Element_Base;
use Elementor\Group_Control_Background;
use Elementor\Utils;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Tp_Translate_Element
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
        add_action('elementor/element/common/_section_style/after_section_end', [
            __CLASS__,
            'tp_element_translate'
        ], 20, 2);
        add_action('elementor/frontend/widget/before_render', [ __CLASS__,'before_render_options'], 10, 2);
    }

    public static function before_render_options(Element_Base $element) 
    {
        $settings = $element->get_settings_for_display();

        if (isset($settings['anim']) && $settings['anim']) {
            $element->add_render_attribute('_wrapper', 'class',$settings['anim']);
        }    
        
        if ( $settings['tp_m_prlx'] ) {

            $element->add_render_attribute('_wrapper', 'class','js-tilt');
            if ( isset($settings['tp_m_tm']) ) {
                $element->add_render_attribute('_wrapper', 'data-tilt-max',$settings['tp_m_tm']['size']);
            }

            if ( $settings['tp_m_glare'] ){
                $element->add_render_attribute('_wrapper', 'data-tilt-glare',.5);
            }
            
        }

    } 

    public static function tp_element_translate($element, $args)
    {  
        $element->start_controls_section(
            'section_tsc',
            [
                'label' => esc_html__('The Pack Widget Extra', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
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

        $element->add_responsive_control(
            'tpvtras',
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
            'tpbtras',
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
            'tprps',
            [
                'label' => esc_html__('Right spacing', 'the-pack-addon'),
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
            'tpls',
            [
                'label' => esc_html__('Left spacing', 'the-pack-addon'),
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

        $element->add_responsive_control(
            'tpwids',
            [
                'label' => esc_html__('Width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1000,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container' => 'width:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'tphts',
            [
                'label' => esc_html__('Height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1000,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container' => 'height:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'tpgbrd',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1000,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container' => 'border-radius:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$element->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			[
				'name' => 'tpcsf',
				'selector' => '{{WRAPPER}} .elementor-widget-container',
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
                    '{{WRAPPER}} .elementor-widget-container' => 'animation-name: {{VALUE}};',
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
                    '{{WRAPPER}} .elementor-widget-container' => 'animation-duration: {{SIZE}}s;animation-iteration-count:infinite;animation-timing-function: linear;',
                ],

            ]
        );

        $element->add_responsive_control(
            'tpbdf',
            [
                'label' => esc_html__('Backdrop blur', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} >.elementor-widget-container' => 'backdrop-filter:blur({{SIZE}}{{UNIT}});-webkit-backdrop-filter:blur({{SIZE}}{{UNIT}});',
                ],
            ]
        );
        $element->add_control(
            'tpofh',
            [
                'label' => esc_html__('Overflow hidden', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} >.elementor-widget-container' => 'overflow:hidden;',
                ],
            ]
        );

        $element->add_control(
            'tphovmove',
            [
                'label' => esc_html__('Hover parallax', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'frontend_available' => true,
                'prefix_class' => 'tphovmove',
            ]
        );

        $element->end_controls_section();

        $element->start_controls_section(
            'section_tp_anim_brd',
            [
                'label' => esc_html__('Animated border', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        ); 

        $element->add_control(
            'tp_en_anbd',
            [
                'label' => esc_html__('Enable animated border', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'prefix_class' => 'tp_anim_border_',
            ]
        );

        $element->add_control(
            'tp_en_anbd_cl',
            [
                'label' => esc_html__('Gradient color', 'the-pack-addon'),
                'type' => Controls_Manager::TEXTAREA,
                'selectors' => [
                    '{{WRAPPER}}.tp_anim_border_yes>.elementor-widget-container:after' => 'background-image: linear-gradient(60deg,{{VALUE}});',
                ],
            ]
        );

        $element->add_control(
            'tp_en_anbd_cldr',
            [
                'label' => esc_html__('Border radius' , 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .main-head i' => 'border-radius:{{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $element->end_controls_section();

        $element->start_controls_section(
            'section_tprelax',
            [
                'label' => esc_html__('Scroll Parallax', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );  

        $element->add_control(
            'anim',
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

        $element->add_control(
            'tp_e_prlx',
            [
                'label' => esc_html__('Enable scroll parallax', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $element->add_control(
            'tp_e_sped',
            [
                'label' => esc_html__('Parallax speed', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -20,
                        'max' => 20,
                        'step' => .1,
                    ]
                ],
                'condition' => [
                    'tp_e_prlx' => 'yes',
                ],                
            ]
        );

        $element->end_controls_section();

        $element->start_controls_section(
            'section_tpmousepara',
            [
                'label' => esc_html__('Mouse Parallax', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $element->add_control(
            'tp_m_prlx',
            [
                'label' => esc_html__('Enable mouse parallax', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $element->add_control(
            'tp_m_tm',
            [
                'label' => esc_html__('Parallax speed', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 20,
                        'step' => 1,
                    ]
                ],
                'condition' => [
                    'tp_m_prlx' => 'yes',
                ],                
            ]
        );

        $element->add_control(
            'tp_m_glare',
            [
                'label' => esc_html__('Enable mouse glare', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $element->end_controls_section();
    }
}

Tp_Translate_Element::init();
