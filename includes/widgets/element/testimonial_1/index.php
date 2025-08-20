<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\utils;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class thepack_testim_1 extends Widget_Base
{ 
    public function get_name()
    {
        return 'tb_testim_1';
    }
    // Enqueue styles
	public function get_style_depends() {
		return ['swiper','e-swiper'];
	}

	// Enqueue scripts
	public function get_script_depends() {
		return ['swiper'];
	}
    public function get_title()
    {
        return esc_html__('Testimonial 1', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-printer';
    }

    public function get_categories()
    {
        return ['ashelement-addons'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_process_1',
            [
                'label' => esc_html__('Content', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'tmpl',
            [
                'label' => esc_html__('Template', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'one' => [
                        'title' => esc_html__('Normal', 'the-pack-addon'),
                        'icon' => 'eicon-text-area',
                    ],
                    'two' => [
                        'title' => esc_html__('Text clip', 'the-pack-addon'),
                        'icon' => 'eicon-image',
                    ],
                    'three' => [
                        'title' => esc_html__('Text clip', 'the-pack-addon'),
                        'icon' => 'eicon-image',
                    ],                    
                ],
                'default' => 'one',
            ]
        );

        $this->add_control(
            'show_quote',
            [
                'label' => esc_html__('Show quote icon', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $repeater1 = new \Elementor\Repeater();

        $repeater1->add_control(
            'heading',
            [
                'label' => esc_html__('Heading', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Super fast service',
            ]
        );

        $repeater1->add_control(
            'rating',
            [
                'label' => esc_html__('Rating', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'label_block' => true,
                'default' => [
                    'size' => 50,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
            ]
        );

        $repeater1->add_control(
            'name',
            [
                'label' => esc_html__('Name', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Mr Wick',
            ]
        );

        $repeater1->add_control(
            'pos',
            [
                'label' => esc_html__('Position', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Google,Gamer',
            ]
        );

        $repeater1->add_control(
            'avatar',
            [
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true,
                'label' => esc_html__('Avatar', 'the-pack-addon'),
            ]
        );

        $repeater1->add_control(
            'desc',
            [
                'label' => esc_html__('Comment', 'the-pack-addon'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'items',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater1->get_controls(),
                'prevent_empty' => false,
                'default' => [
                    [
                        'name' => esc_html__('Mr Wick', 'the-pack-addon'),
                    ]
                ],
                'title_field' => '{{{name}}}',
            ]
        );

        $this->add_control(
            'quote_icon',
            [
                'label' => esc_html__('Quote icon', 'the-pack-addon'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
                'condition' => [
                    'show_quote' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_html__('General', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'disp',
            [
                'label' => esc_html__('Vertical', 'thepackpro'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'thepackpro'),
                'label_off' => esc_html__('No', 'thepackpro'),
                'return_value' => 'slider',
                'default' => 'slider',
                'classes' =>'hidden-control'
            ]
        );

        $this->add_control(
            'align',
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
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .items-wrap' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'g_bg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .items-wrap' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'hbxdw',
                'label' => esc_html__('Box shadow', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .items-wrap',
            ]
        );

        $this->add_control(
            'g_pad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .items-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'gbrd',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .items-wrap' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gbradi',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .items-wrap' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'hide_rating',
            [
                'label' => esc_html__('Hide rating', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .tscore' => 'display: none;',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_quote',
            [
                'label' => esc_html__('Content', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('qtb');

        $this->start_controls_tab(
            'qt1',
            [
                'label' => esc_html__('Title', 'the-pack-addon' ),
            ]
        );

        $this->add_control(
            'h_clr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .heading' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'h_mr',
            [
                'label' => esc_html__('Margin', 'the-pack-addon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'h_typo',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .heading',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'qt2',
            [
                'label' => esc_html__('Rating', 'the-pack-addon' ),
            ]
        );

        $this->add_responsive_control(
            'rfs',
            [
                'label' => esc_html__('Font size', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tscore' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'rpclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tscore' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'rsclr',
            [
                'label' => esc_html__('Active color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tscore span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'qt3',
            [
                'label' => esc_html__('Content', 'the-pack-addon' ),
            ]
        );
        $this->add_control(
            'q_clr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'q_pad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'q_typo',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .desc',
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_quote_icon',
            [
                'label' => esc_html__('Quote icon', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_quote' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'qibg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .items .tpquote' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'qiclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .items .tpquote' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'qibclr',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .items .tpquote' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'qiwid',
            [
                'label' => esc_html__('Width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .items .tpquote' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'qifs',
            [
                'label' => esc_html__('Size', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .items .tpquote' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'qiht',
            [
                'label' => esc_html__('Height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .items .tpquote' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'qitps',
            [
                'label' => esc_html__('Top spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -400,
                        'max' => 400,
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .items .tpquote' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'qibts',
            [
                'label' => esc_html__('Bottom spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -400,
                        'max' => 400,
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .items .tpquote' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'qirss',
            [
                'label' => esc_html__('Right spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -400,
                        'max' => 400,
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .items .tpquote' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_avtr',
            [
                'label' => esc_html__('Avatar', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('avtb');

        $this->start_controls_tab(
            'av1',
            [
                'label' => esc_html__('Thumb', 'the-pack-addon' ),
            ]
        );

        $this->add_responsive_control(
            'avtr_lpad',
            [
                'label' => esc_html__('Left spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['%', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .thumb' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'avtr_wid',
            [
                'label' => esc_html__('Width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['%', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .thumb' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'avtr_pad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .thumb img' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'avtr_br',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['%', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .thumb,{{WRAPPER}} .thumb img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'avbdr',
                'label' => esc_html__('Border', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .thumb',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'av2',
            [
                'label' => esc_html__('Content', 'the-pack-addon' ),
            ]
        );

        $this->add_control(
            'inlinnp',
            [
                'label' => esc_html__('Inline name & position', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .tp-col' => 'flex-direction: inherit;',
                ],
            ]
        );

        $this->add_control(
            'n_color',
            [
                'label' => esc_html__('Name Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pos_color',
            [
                'label' => esc_html__('Position Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pos' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pos_pad',
            [
                'label' => esc_html__('Position Padding', 'the-pack-addon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pos' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'n_typo',
                'label' => esc_html__('Name Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .name',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pos_typo',
                'label' => esc_html__('Position Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .pos',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
 
        $this->end_controls_section();

        do_action('the_pack_swiper_control', $this,true);

    }

    protected function render()
    {
        $settings = $this->get_settings();
        if (ctype_alnum($settings['tmpl']) ){
            require dirname(__FILE__) . '/' .esc_attr($settings['tmpl']).'.php';
        }
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_testim_1());
