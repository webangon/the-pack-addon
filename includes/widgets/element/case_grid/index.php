<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\utils;

if (!defined('ABSPATH')) {
    exit;
}

class thepack_case_grid extends Widget_Base
{
    public function get_name()
    {
        return 'tp_case_grid';
    }

    public function get_title()
    {
        return esc_html__('Case grid', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-admin-generic';
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

        $repeater1 = new \Elementor\Repeater();

        $repeater1->add_control(
            'name',
            [
                'label' => esc_html__('Title', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Mr Wick',
            ]
        );

        $repeater1->add_control(
            'pos',
            [
                'label' => esc_html__('Description', 'the-pack-addon'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Google,Gamer',
            ]
        );

        $repeater1->add_control(
            'fimgs',
            [
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true,
                'label' => esc_html__('Background image', 'the-pack-addon'),
            ]
        );

        $repeater1->add_control(
            'img_size',
            [
                'label' => esc_html__('Image size', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => thepack_image_size_choose(),
                'multiple' => false,
            ]
        );

        $repeater1->add_control(
            'img_pos',
            [
                'label' => esc_html__('Image position', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => thepack_background_position(),
                'multiple' => false,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .inner' => 'background-position: {{VALUE}};',
                ],
            ]
        );

        $repeater1->add_control(
            'url',
            [
                'label' => esc_html__('Link', 'the-pack-addon'),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('http://your-link.com', 'the-pack-addon'),
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

        $this->end_controls_section();

        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_html__('General', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__('Display', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'one' => [
                        'title' => esc_html__('Style one', 'the-pack-addon'),
                        'icon' => 'eicon-gallery-grid',
                    ],
                    'two' => [
                        'title' => esc_html__('Style two', 'the-pack-addon'),
                        'icon' => 'eicon-slider-album',
                    ]
                ],
                'default' => 'one',
            ]
        );

        $this->add_responsive_control(
            'bht',
            [
                'label' => esc_html__('Big grid height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .case-big .inner' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'sht',
            [
                'label' => esc_html__('Small grid height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .case-mid .inner,{{WRAPPER}} .case-small .inner' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gsp',
            [
                'label' => esc_html__('Grid spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .case-wrap' => 'padding: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tp-case-grid' => 'margin-left: -{{SIZE}}{{UNIT}};margin-right: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'animation',
            [
                'label' => esc_html__('Animation', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT,
                'options' => thepack_animations(),
                'label_block' => true,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'fover',
                'label' => esc_html__('Background overlay', 'elementor'),
                'types' => ['none', 'classic', 'gradient'],
                'selector' => '{{WRAPPER}} .inner::before',
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

        $this->add_control(
            'c_pad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .case-wrap .case-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('mtabu');

        $this->start_controls_tab(
            'm1',
            [
                'label' => esc_html__('Title', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'q_clr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'q_pad',
            [
                'label' => esc_html__('Margin', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'q_typo',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .name',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'm2',
            [
                'label' => esc_html__('Sub', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'p_clr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pos' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'p_typo',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .pos',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();
        include dirname(__FILE__) . '/' . esc_attr($settings['style']) . '.php';
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_case_grid());
