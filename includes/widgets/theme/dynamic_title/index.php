<?php
namespace ThePackAddon\Widgets;

use Elementor\Plugin;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class thepack_arc_title extends Widget_Base
{
    public function get_name()
    {
        return 'tpdynamic_title';
    }

    public function get_title()
    {
        return esc_html__('Dynamic title', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-slides';
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
                'label' => esc_html__('Content', 'the-pack-addon')
            ]
        );

        $this->add_control(
            'cat',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Category', 'the-pack-addon'),
                'label_block' => true,
                'default' => esc_html__('Category archive', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'tag',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Tag', 'the-pack-addon'),
                'label_block' => true,
                'default' => esc_html__('Tag archive', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'author',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Author', 'the-pack-addon'),
                'label_block' => true,
                'default' => esc_html__('Author archive', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'year',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Year', 'the-pack-addon'),
                'label_block' => true,
                'default' => esc_html__('Year archive', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'notfound',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('404', 'the-pack-addon'),
                'label_block' => true,
                'default' => esc_html__('Not found', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'search',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Search', 'the-pack-addon'),
                'label_block' => true,
                'default' => esc_html__('Search for', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'march',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Month archive', 'the-pack-addon'),
                'label_block' => true,
                'default' => esc_html__('Month archive', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'yarch',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Year archive', 'the-pack-addon'),
                'label_block' => true,
                'default' => esc_html__('Year archive', 'the-pack-addon'),
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
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .arctitle' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs('tctb');

        $this->start_controls_tab(
            'e1',
            [
                'label' => esc_html__('Title', 'the-pack-addon'),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ttypo',
                'selector' => '{{WRAPPER}} .arctitle h3',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'tclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .arctitle h3' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'tmrg',
            [
                'label' => esc_html__('Margin', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .arctitle h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'e2',
            [
                'label' => esc_html__('Highlight', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'htls',
            [
                'label' => esc_html__('Spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .archive-highlight' => 'padding-left: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tstypo',
                'selector' => '{{WRAPPER}} .archive-highlight',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'tsclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .archive-highlight' => 'color: {{VALUE}};'
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
        $arg = [
            'cat' => $settings['cat'],
            'tag' => $settings['tag'],
            'author' => $settings['author'],
            'year' => $settings['year'],
            'notfound' => $settings['notfound'],
            'search' => $settings['search'],
            'marchive' => $settings['march'],
            'yarchive' => $settings['yarch'],
        ];

        if (Plugin::instance()->editor->is_edit_mode()) {
            echo '<div class="arctitle"><h3>' . esc_html__('Dynamic title', 'the-pack-addon') . '</h3></div>';
        } else {
            echo '<div class="arctitle"><h3>' . thepack_pro_single_title($arg) . '</h3></div>';//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
        }
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_arc_title());
