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

        $this->start_controls_tabs('tctb');

        $this->start_controls_tab(
            'e1',
            [
                'label' => esc_html__('Left', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'flbl',
            [
                'type' => 'text',
                'label' => esc_html__('Label', 'the-pack-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'flink',
            [
                'label' => esc_html__('Link', 'elementor'),
                'type' => Controls_Manager::URL,
                'placeholder' => 'http://your-link.com',
                'default' => [
                    'url' => 'https://codecanyon.net/user/xldevelopment/portfolio',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'e2',
            [
                'label' => esc_html__('Right', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'slbl',
            [
                'type' => 'text',
                'label' => esc_html__('Pre title', 'the-pack-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'slsbl',
            [
                'type' => 'text',
                'label' => esc_html__('Title', 'the-pack-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'slink',
            [
                'label' => esc_html__('Second button link', 'elementor'),
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
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .xldappbtn' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_icon',
            [
                'label' => esc_html__('Left button', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'lbty',
                'selector' => '{{WRAPPER}} .xldappbtn .tp-btn a',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_responsive_control(
            'lbrds',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .xldappbtn .tp-btn a' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'btn_pad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .xldappbtn .tp-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->start_controls_tabs('rx');

        $this->start_controls_tab(
            'rx1',
            [
                'label' => esc_html__('Normal', 'the-pack-addon'),
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'xcd',
                'label' => esc_html__('Border', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .xldappbtn .tp-btn a',
            ]
        );

        $this->add_control(
            'b1tclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xldappbtn .tp-btn a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'b1tbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xldappbtn .tp-btn a' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'rx2',
            [
                'label' => esc_html__('Hover', 'the-pack-addon'),
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'label' => esc_html__('Box shadow', 'the-pack-addon'),
                'name' => 'b1abxdw',
                'selector' => '{{WRAPPER}} .xldappbtn .tp-btn a:hover',
            ]
        );

        $this->add_control(
            'b1gtbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xldappbtn .tp-btn a:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'b1teclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xldappbtn .tp-btn a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_2con',
            [
                'label' => esc_html__('Right button', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'rbsp',
            [
                'label' => esc_html__('Left spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tp-info' => 'padding-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('na2ctive');

        $this->start_controls_tab(
            'fb2nct',
            [
                'label' => esc_html__('Link', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'b2tclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pre a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'prtyp',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .pre a',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ac2nrml',
            [
                'label' => esc_html__('Title', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'b2aiclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tltyp',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .title',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();
        require dirname(__FILE__) . '/view.php';
    }

    private function get_link($link)
    {
        $url = $link['url'];
        $ext = $link['is_external'];
        $nofollow = $link['nofollow'];
        $url = (isset($url) && $url) ? 'href=' . esc_url($url) . '' : '';
        $ext = (isset($ext) && $ext) ? 'target= _blank' : '';
        $nofollow = (isset($url) && $url) ? 'rel=nofollow' : '';
        $link = $url . ' ' . $ext . ' ' . $nofollow;

        $btn = $link ? '<a ' . $link . ' ></a>' : '';

        return $btn;
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_button_app());
