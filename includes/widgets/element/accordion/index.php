<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Utils;

if (!defined('ABSPATH')) {
    exit;
}

class thepack_accordion_1 extends Widget_Base
{
    public function get_name()
    {
        return 'ae-accor1';
    }

    public function get_title()
    {
        return esc_html__('Accordion', 'the-pack-addon');
    }

    public function get_categories()
    {
        return ['ashelement-addons'];
    }

    public function get_icon()
    {
        return 'dashicons dashicons-menu';
    }
 
    protected function register_controls()
    {
        $this->start_controls_section(
            'section_heading',
            [
                'label' => esc_html__('Content', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'actikn',
            [
                'label' => esc_html__('Active icon', 'the-pack-addon'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'iactikn',
            [
                'label' => esc_html__('Inactive icon', 'the-pack-addon'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Label', 'the-pack-addon'),
                'label_block' => true,
                'default' => 'Car Insurance',
            ]
        );

        $repeater->add_control(
            'content',
            [
                'type' => Controls_Manager::WYSIWYG,
                'label' => esc_html__('Content', 'the-pack-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tabs',
            [
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => esc_html__('Finance', 'the-pack-addon'),
                    ]
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_gnrl',
            [
                'label' => esc_html__('General', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'collpased',
            [
                'type' => Controls_Manager::SWITCHER,
                'label' => esc_html__('Collapsed all', 'the-pack-addon'),
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

                    'three' => [
                        'title' => esc_html__('Three', 'the-pack-addon'),
                        'icon' => 'eicon-folder-o',
                    ],

                    'four' => [
                        'title' => esc_html__('Four', 'the-pack-addon'),
                        'icon' => 'eicon-folder',
                    ],

                ],
                'default' => 'one',
            ]
        );

        $this->add_responsive_control(
            'bspe',
            [
                'label' => esc_html__('Items bottom spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .xldacdn li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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

        $this->add_responsive_control(
            't-pad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .accortitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'selector' => '{{WRAPPER}} .accortitle',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->start_controls_tabs('gt');

        $this->start_controls_tab(
            't1',
            [
                'label' => esc_html__('Normal', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'n_color',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accortitle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'n_bgf',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accortitle' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ntbdr',
                'label' => esc_html__('Border', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .accortitle',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            't2',
            [
                'label' => esc_html__('Active', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'hacbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accortitle.active' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'h_color',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accortitle.active' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'nabdr',
                'label' => esc_html__('Border', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .accortitle.active',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_dsc',
            [
                'label' => esc_html__('Description', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'dtsp',
            [
                'label' => esc_html__('Top spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ]
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .accorbody' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'd-pad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .accorbody' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accorbody' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'cntbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accorbody' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typo',
                'selector' => '{{WRAPPER}} .accorbody',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'dxnbdr',
                'label' => esc_html__('Border', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .accorbody',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_ikn',
            [
                'label' => esc_html__('Icon', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'lfticn',
            [
                'label' => esc_html__('Left icon', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'left_icon',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'iposd',
            [
                'label' => esc_html__('Icon position', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ]
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .tbxicon' => 'right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .left_icon .tbxicon' => 'left: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'ik_wh',
            [
                'label' => esc_html__('Width and height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ]
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .tbxicon' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'ik_fs',
            [
                'label' => esc_html__('Font size', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ]
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .tbxicon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'ik_br',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ]
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .tbxicon' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->start_controls_tabs('itb');

        $this->start_controls_tab(
            'itb1',
            [
                'label' => esc_html__('Normal', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'ik_bg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tbxicon' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ik_clr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tbxicon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ik_bclr',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tbxicon' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'itb2',
            [
                'label' => esc_html__('Active', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'ik_bga',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .active .tbxicon' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ik_clra',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .active .tbxicon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ikx_bclr',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .active .tbxicon' => 'border:1px solid {{VALUE}};',
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
        require dirname(__FILE__) . '/view.php';
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_accordion_1());
