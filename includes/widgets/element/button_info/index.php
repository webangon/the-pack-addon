<?php
namespace ThePackAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class thepack_button_app extends Widget_Base
{
    public function get_name()
    {
        return 'buttn_app';
    }

    public function get_title()
    {
        return esc_html__('Info button', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-admin-media';
    }

    public function get_categories()
    {
        return ['ashelement-addons'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_heading',
            [
                'label' => esc_html__('Button', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'tmpl',
            [
                'label' => esc_html__('Extra style', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'one' => [
                        'title' => esc_html__('One', 'the-pack-addon'),
                        'icon' => 'eicon-tabs',
                    ],

                    'two' => [
                        'title' => esc_html__('Two', 'the-pack-addon'),
                        'icon' => 'eicon-text-field',
                    ],

                ],
                'default' => 'one',
            ]
        );

        $this->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Label', 'the-pack-addon'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'ikn',
            [
                'type' => Controls_Manager::ICONS,
                'label' => esc_html__('Icon', 'the-pack-addon'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'flink',
            [
                'label' => esc_html__('Link', 'the-pack-addon'),
                'type' => Controls_Manager::URL,
                'placeholder' => 'http://your-link.com',
                'default' => [
                    'url' => 'https://codecanyon.net/user/xldevelopment/portfolio',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_gnrl',
            [
                'label' => esc_html__('General', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'n_color',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-btn-2' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tp-btn-1' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'bg',
                'selector' => '{{WRAPPER}} .com-bg',
				'fields_options' => [
					'background' => [
						'label' => esc_html__( 'Background','the-pack-addon' ),
					]
				]  
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'gbrd',
                'label' => esc_html__('Border', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .com-bg',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ypo',
                'selector' => '{{WRAPPER}} .tp-btn-2,{{WRAPPER}} .tp-btn-1',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        ); 
        $this->add_responsive_control(
            'brd',   
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'), 
                'type' => Controls_Manager::SLIDER,  
                'selectors' => [
                    '{{WRAPPER}} .tp-btn-2' => '--tpbrd: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tp-btn-1' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'brdx',   
            [
                'label' => esc_html__('Left right padding', 'the-pack-addon'), 
                'type' => Controls_Manager::SLIDER,  
                'selectors' => [
                    '{{WRAPPER}} .tp-btn-1' => 'padding:0 {{SIZE}}{{UNIT}};',
                ],
            ]
        );          
        $this->add_responsive_control(
            'bwdt',
            [
                'label' => esc_html__('Width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ]
                ],
                'size_units' => ['px','%'],
                'selectors' => [
                    '{{WRAPPER}} a' => 'width: {{SIZE}}{{UNIT}};',
                ],

            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_1',
            [
                'label' => esc_html__('Button One', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tmpl' => 'one',
                ],                 
            ]
        );

        $this->add_responsive_control(
            'brgx',   
            [
                'label' => esc_html__('Width', 'the-pack-addon'), 
                'type' => Controls_Manager::SLIDER,  
                'selectors' => [
                    '{{WRAPPER}} .tp-btn-2' => '--tpbu: {{SIZE}}{{UNIT}};',
                ],
            ]
        ); 
        $this->add_responsive_control(
            'inpd',   
            [
                'label' => esc_html__('Inline padding', 'the-pack-addon'), 
                'type' => Controls_Manager::SLIDER,  
                'selectors' => [
                    '{{WRAPPER}} .tp-text' => 'padding-inline: {{SIZE}}{{UNIT}};',
                ],
            ]
        ); 
        $this->end_controls_section();        

    }

    protected function render()
    {
        $settings = $this->get_settings();
        if (!preg_match("/[^[:alnum:]_\/-]/",$settings['tmpl'])) {
            include plugin_dir_path(__FILE__) . $settings['tmpl'] . '.php';
        }
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_button_app());
