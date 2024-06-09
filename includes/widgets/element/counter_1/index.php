<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\utils;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class thepack_counter_1 extends Widget_Base
{
    public function get_name()
    {
        return 'tb_counter_1';
    }

    public function get_title()
    {
        return esc_html__('Counter 1', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-superhero-alt';
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
            'num',
            [
                'label' => esc_html__('Number', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '01',
            ]
        );

        $repeater->add_control(
            'pre',
            [
                'label' => esc_html__('Prefix', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '+',
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('Idea & Concept', 'the-pack-addon'),
            ]
        );

        $repeater->add_control(
            'desc',
            [
                'label' => esc_html__('Description', 'the-pack-addon'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => esc_html__('Going that gable-ended Spouter-Inn, you found yourself in a wide, low, struggling entry with wainscots, reminding one of the burden of some condemned new craft.', 'the-pack-addon'),
            ]
        );

        $repeater->add_control(
            'bg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .tb-counter' => 'background: {{VALUE}};',
                ],
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
                'title_field' => '{{{ num }}}',
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
            'animation',
            [
                'label' => esc_html__('Animation', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT,
                'options' => thepack_animations(),
                'label_block' => true
            ]
        );

        $this->add_responsive_control(
            'width',
            [
                'label' => esc_html__('Column width', 'the-pack-addon'),
                'type' => Controls_Manager::NUMBER,
                'default' => '33.33',
                'selectors' => [
                    '{{WRAPPER}} .gridwrap' => 'width: {{VALUE}}%;',
                ],
            ]
        );

        $this->add_responsive_control(
            'gpadr',
            [
                'label' => esc_html__('Column spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ]
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .gridwrap' => 'padding: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tb-process-1' => 'margin:0px -{{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'top_margin',
            [
                'label' => esc_html__('Bottom margin', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .gridwrap:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gipad',
            [
                'label' => esc_html__('Inner padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .tb-counter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gbrd',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tb-counter' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'bdcl',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tb-counter' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hti',
            [
                'label' => esc_html__('Hover state', 'the-pack-addon'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'bxd',
                'label' => esc_html__('Box shadow', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .tb-counter:hover',
            ]
        );

        $this->add_responsive_control(
            'ghrsd',
            [
                'label' => esc_html__('Hover raised', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tb-counter:hover' => 'margin-top:-{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_num',
            [
                'label' => esc_html__('Number', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'num_ty',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .number',
            ]
        );

        $this->add_responsive_control(
            'num_c',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .number' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'numtbr',
            [
                'label' => esc_html__('Top bar', 'the-pack-addon'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes',
            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            'num_tbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .number::after' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'numtbwd',
            [
                'label' => esc_html__('Width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .number::after' => 'width:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'numtbht',
            [
                'label' => esc_html__('Height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .number::after' => 'height:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'numtbvp',
            [
                'label' => esc_html__('Vertical position', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 1,
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .number::after' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'numtbhp',
            [
                'label' => esc_html__('Horizontal position', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 1,
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .number::after' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_popover();

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

        $this->add_responsive_control(
            'des_color',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
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

        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__('Title', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            't_color',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
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
            'section_prefix',
            [
                'label' => esc_html__('Prefix', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ntyp',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .number b',
            ]
        );

        $this->add_responsive_control(
            'nclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .number b' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'nvps',
            [
                'label' => esc_html__('Vertical position', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .number b' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'npad',
            [
                'label' => esc_html__('Left padding', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .number b' => 'padding-left: {{SIZE}}{{UNIT}};',
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

    private function content($content, $column)
    {
        $out = '';
        foreach ($content as $item) {
            $pre = $item['pre'] ? '<b>' . $item['pre'] . '</b>' : '';
            $num = $item['num'] ? '<div class="number">' . $item['num'] . $pre . '</div>' : '';
            $title = $item['title'] ? '<h3 class="title">' . $item['title'] . '</h3>' : '';
            $desc = $item['desc'] ? '<p class="description">' . $item['desc'] . '</p>' : '';

            $out .= '
                <div class="elementor-repeater-item-' . $item['_id'].' gridwrap ' . $column . '">
                    <div class="tb-counter table-display">

                        <div class="col numwrap">' . $num . '</div>
                        <div class="col">' . $title . $desc . '</div>

                    </div>
                </div>
            ';
        }

        return thepack_build_html($out); 
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_counter_1());
