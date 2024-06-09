<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\utils;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class thepack_timeline_1 extends Widget_Base
{
    public function get_name()
    {
        return 'tb_timeline_1';
    }

    public function get_title()
    {
        return esc_html__('Timeline 1', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-superhero';
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

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'year',
            [
                'label' => esc_html__('Year', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'desig',
            [
                'label' => esc_html__('Designation', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'desc',
            [
                'label' => esc_html__('Description', 'the-pack-addon'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'items',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'prevent_empty' => false,
                'default' => [
                    [
                        'num' => esc_html__('01', 'the-pack-addon'),
                    ]
                ],
                'title_field' => '{{{ title }}}',
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
            'g_margin',
            [
                'label' => esc_html__('Margin', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'animation',
            [
                'label' => esc_html__('Animation', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT,
                'options' => thepack_animations(),
                'label_block' => true
            ]
        );

        $this->add_control(
            'hrotate',
            [
                'label' => esc_html__('Hover rotate', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'hoverotate',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_design',
            [
                'label' => esc_html__('Design', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'br_margin',
            [
                'label' => esc_html__('Bar spacing from left', 'the-pack-addon'),
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
                    '{{WRAPPER}} .content:before' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'br_height',
            [
                'label' => esc_html__('Bar height', 'the-pack-addon'),
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
                    '{{WRAPPER}} .content:before' => 'height: calc(100% + {{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_responsive_control(
            'br_wid',
            [
                'label' => esc_html__('Bar width', 'the-pack-addon'),
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
                    '{{WRAPPER}} .content:before' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'br_tsp',
            [
                'label' => esc_html__('Bar top spacing', 'the-pack-addon'),
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
                    '{{WRAPPER}} .content:before' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'br_c',
            [
                'label' => esc_html__('Bar background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .content:before' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dot_wid',
            [
                'label' => esc_html__('Dot width', 'the-pack-addon'),
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
                    '{{WRAPPER}} .content:after' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dtspr',
            [
                'label' => esc_html__('Dot top spacing', 'the-pack-addon'),
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
                    '{{WRAPPER}} .content:after' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dot_bwid',
            [
                'label' => esc_html__('Dot border width', 'the-pack-addon'),
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
                    '{{WRAPPER}} .content:after' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dot_brad',
            [
                'label' => esc_html__('Dot border radius', 'the-pack-addon'),
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
                    '{{WRAPPER}} .content:after' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'dot_c',
            [
                'label' => esc_html__('Dot background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .content:after' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__('Title', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            't_color',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            't_margin',
            [
                'label' => esc_html__('Margin', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],

                'selectors' => [
                    '{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 't_typo',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .title',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_year',
            [
                'label' => esc_html__('Year', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'num_ty',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .year',
            ]
        );

        $this->add_control(
            'num_c',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .year' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'num_margin',
            [
                'label' => esc_html__('Margin', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],

                'selectors' => [
                    '{{WRAPPER}} .year' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_cat',
            [
                'label' => esc_html__('Category', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ct_ty',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .desig',
            ]
        );

        $this->add_control(
            'ct_c',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .desig' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_desc',
            [
                'label' => esc_html__('Description', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'des_typo',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .description',
            ]
        );

        $this->add_control(
            'des_color',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'des_margin',
            [
                'label' => esc_html__('Margin', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],

                'selectors' => [
                    '{{WRAPPER}} .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

    private function content($content, $anim)
    {
        $out = '';
        foreach ($content as $item) {
            $title = $item['title'] ? '<h3 class="title">' . $item['title'] . '</h3>' : '';
            $year = $item['year'] ? '<span class="year">' . $item['year'] . '</span>' : '';
            $desig = $item['desig'] ? '<span class="desig">' . $item['desig'] . '</span>' : '';
            $desc = $item['desc'] ? '<p class="description">' . $item['desc'] . '</p>' : '';

            $out .= '
                <div class="content ' . $anim . '">
                    <div class="wrap">
                        ' . $title . $year . $desig . $desc . '
                    </div>
                </div>
            ';
        }

        return thepack_build_html($out);
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_timeline_1());
