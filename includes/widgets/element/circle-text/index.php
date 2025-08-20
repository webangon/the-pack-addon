<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class The_Pack_Circle_Text extends Widget_Base
{
    public function get_name()
    {
        return 'tpcircletext';
    }

    public function get_title()
    {
        return esc_html__('Circle text', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'eicon-form-horizontal';
    }

    public function get_categories()
    {
        return ['ashelement-addons'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('General', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'text',
            [
                'label' => esc_html__('Text', 'the-pack-addon'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tmpl',
            [
                'label' => esc_html__('Data type', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'one' => [
                        'title' => esc_html__('Image', 'the-pack-addon'),
                        'icon' => 'eicon-tabs',
                    ],
                    'two' => [
                        'title' => esc_html__('Icon', 'the-pack-addon'),
                        'icon' => 'eicon-text-field',
                    ]
                ],
                'default' => 'one',
            ]
        );
        $this->add_control(
            'img',
            [
                'label' => esc_html__('Image', 'thepackpro'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true,
                'condition' => [
                    'tmpl' => 'one', 
                ],                
            ]
        );

        $this->add_control(
            'ico',
            [
                'label' => esc_html__('Icon', 'thepackpro'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
                'condition' => [
                    'tmpl' => 'two', 
                ],                 
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_gnrlu',
            [
                'label' => esc_html__('General', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'clr',
                'selector' => '{{WRAPPER}} .tp-circle-txt',
                'fields_options' => [
                    'background' => [
                        'label' => esc_html__('Background', 'the-pack-addon'),
                    ]
                ]            
            ]
        );

        $this->add_responsive_control(
            'bdf',
            [
                'label' => esc_html__('Backdrop blur', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tp-circle-txt' => 'backdrop-filter:blur({{SIZE}}{{UNIT}});-webkit-backdrop-filter:blur({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_ic',
            [
                'label' => esc_html__('Image/icon', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'iwh',
            [
                'label' => esc_html__('Wrapper Width & height', 'thepackpro'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 500,
                    ],
                ],
                'default' => [
                    'size' => 150,
                ],                
                'selectors' => [
                    '{{WRAPPER}} .logo' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
                ],               
            ]
        );
        $this->add_responsive_control(
            'icfs',
            [
                'label' => esc_html__('Font size/Image height', 'thepackpro'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 500,
                    ],
                ],               
                'selectors' => [
                    '{{WRAPPER}} .logo img' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};object-fit:cover;',
                    '{{WRAPPER}} .logo i' => 'font-size:{{SIZE}}{{UNIT}};',
                ],               
            ]
        );

        $this->add_responsive_control(
            'ipd',
            [
                'label' => esc_html__('Padding', 'thepackpro'),
                'type' => Controls_Manager::SLIDER,               
                'selectors' => [
                    '{{WRAPPER}} .logo' => 'padding:{{SIZE}}{{UNIT}};',
                ],               
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'igbg',
                'selector' => '{{WRAPPER}} .logo',
                'fields_options' => [
                    'background' => [
                        'label' => esc_html__('Background', 'the-pack-addon'),
                    ]
                ]            
            ]
        );
        $this->add_control(
            'ovtk',
            [
                'label' => esc_html__('Icon color', 'thepackpro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .logo i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_txt',
            [
                'label' => esc_html__('Text', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'wh',
            [
                'label' => esc_html__('Width & height', 'thepackpro'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 500,
                    ],
                ],
                'default' => [
                    'size' => 200,
                ],                
                'selectors' => [
                    '{{WRAPPER}} .tp-circle-txt' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
                ],               
            ]
        );

        do_action('the_pack_gradient_typo', $this,'td_','.text span');

        $this->add_responsive_control(
            'torig',
            [
                'label' => esc_html__('Text position', 'thepackpro'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 500,
                    ],
                ],
                'default' => [
                    'size' => 90,
                ],                
                'selectors' => [
                    '{{WRAPPER}} .text span' => 'transform-origin: 0 {{SIZE}}{{UNIT}};',
                ],               
            ]
        );
        $this->add_responsive_control(
            'tpd',
            [
                'label' => esc_html__('Padding', 'thepackpro'),
                'type' => Controls_Manager::SLIDER,               
                'selectors' => [
                    '{{WRAPPER}} .tp-circle-txt' => 'padding:{{SIZE}}{{UNIT}};',
                ],               
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();
        require dirname(__FILE__) . '/view.php';
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\The_Pack_Circle_Text());
