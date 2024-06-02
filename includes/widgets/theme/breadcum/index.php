<?php
namespace ThePackAddon\Widgets;

use Elementor\Plugin;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class thepack_breadcum extends Widget_Base
{
    public function get_name()
    {
        return 'tp-breadcumb';
    }

    public function get_title()
    {
        return esc_html__('Breadcrumb', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'eicon-chevron-right';
    }

    public function get_categories()
    {
        return ['ashelement-addons'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_cnt',
            [
                'label' => esc_html__('Info', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'hme',
            [
                'label' => esc_html__('Home', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Home', 'the-pack-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'auarc',
            [
                'label' => esc_html__('Author archive', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Author archive for', 'the-pack-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'srch',
            [
                'label' => esc_html__('Search', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Search query for', 'the-pack-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'eror',
            [
                'label' => esc_html__('Error / 404', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Error 404', 'the-pack-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'del_type',
            [
                'label' => esc_html__('Delimiter type', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text' => [
                        'title' => esc_html__('Text', 'the-pack-addon'),
                        'icon' => 'eicon-text',
                    ],

                    'icon' => [
                        'title' => esc_html__('Icon', 'the-pack-addon'),
                        'icon' => 'eicon-parallax',
                    ]

                ],
                'default' => 'text',
            ]
        );

        $this->add_control(
            'del',
            [
                'label' => esc_html__('Delimiter', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('-', 'the-pack-addon'),
                'label_block' => true,
                'condition' => [
                    'del_type' => 'text',
                ],
            ]
        );

        $this->add_control(
            'del_icon',
            [
                'label' => esc_html__('Icon', 'the-pack-addon'),
                'type' => Controls_Manager::ICONS,
                'condition' => [
                    'del_type' => 'icon',
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
            'gbg',
            [
                'label' => esc_html__('Background color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .inner' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'gbdrkl',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .inner' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gbrad',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .inner' => 'border-radius:{{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'gpadr',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->start_controls_tabs('tctb');

        $this->start_controls_tab(
            'e1',
            [
                'label' => esc_html__('Text', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'l_color',
            [
                'label' => esc_html__('Link color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xlbreadcrumb a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'color',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xlbreadcrumb' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
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
                    '{{WRAPPER}} .xlbreadcrumb' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typo',
                'selector' => '{{WRAPPER}} .xlbreadcrumb',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_responsive_control(
            'nav_mar',
            [
                'label' => esc_html__('Margin', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .xlbreadcrumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'e2',
            [
                'label' => esc_html__('Delimiter', 'the-pack-addon'),
            ]
        );

        $this->add_responsive_control(
            'dlsp',
            [
                'label' => esc_html__('Spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .delimiter' => 'padding:0px {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'dlfs',
            [
                'label' => esc_html__('Font size', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .delimiter i.tp-icon' => 'font-size:{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .delimiter img.tp-icon' => 'width:{{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();
        $delimiter = $settings['del_type'] == 'text' ? $settings['del'] : the_pack_render_icon($settings['del_icon'], 'tp-icon');
        $args = [
            'home' => $settings['hme'],
            'author_archive' => $settings['auarc'],
            'search' => $settings['srch'],
            'error' => $settings['eror'],
            'delimiter' => $delimiter,
        ];
        if (Plugin::instance()->editor->is_edit_mode()) {
            //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
            echo '<div class="xlbreadcrumb"><div class="inner"><a href="#" rel="v:url" property="v:title">Home</a><span class="delimiter">' . the_pack_html_escaped($delimiter) . '</span><span class="current">About Us 1</span></div></div>';
        } else {
            //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
            echo thepack_breadcum($args);
        }
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_breadcum());
