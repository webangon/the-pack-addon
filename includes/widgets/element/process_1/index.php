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

class thepack_process_1 extends Widget_Base
{
    public function get_name()
    {
        return 'tb_process_1';
    }

    public function get_title()
    {
        return esc_html__('Process 1', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-editor-insertmore';
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
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'the-pack-addon'),
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
            'anim',
            [
                'label' => esc_html__('Animation', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT,
                'options' => thepack_animations(),
                'label_block' => true
            ]
        );

        $this->add_responsive_control(
            'gwd',
            [
                'label' => esc_html__('Column width', 'the-pack-addon'),
                'type' => Controls_Manager::NUMBER,
                'default' => '25',
                'selectors' => [
                    '{{WRAPPER}} .gridwrap' => 'width: {{VALUE}}%;',
                ],
            ]
        );

        $this->add_control(
            'gpd',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .gridwrap' => 'padding:{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tb-process-1' => 'margin:0px -{{SIZE}}{{UNIT}};'
                ],

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_ cnt',
            [
                'label' => esc_html__('Content', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'cntspd',
            [
                'label' => esc_html__('Top spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .inner' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'cntbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .inner' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'cnhbg',
            [
                'label' => esc_html__('Hover background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .inner:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'cnhck',
            [
                'label' => esc_html__('Hover color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .inner:hover .title,{{WRAPPER}} .inner:hover .desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'cnbrd',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .inner' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'cngpd',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tctb');

        $this->start_controls_tab(
            'e1',
            [
                'label' => esc_html__('Num', 'the-pack-addon'),
            ]
        );

        $this->add_responsive_control(
            'nwh',
            [
                'label' => esc_html__('Width & height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .number' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'nbrd',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .number' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'nmty',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .number',
            ]
        );

        $this->add_control(
            'nmclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .number' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'nmbct',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .number' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'nmbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .number' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'hbxdw',
                'label' => esc_html__('Hover box shadow', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .tb-process:hover .number',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'e2',
            [
                'label' => esc_html__('Title', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'tclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ttyp',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .title',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'e3',
            [
                'label' => esc_html__('Desc', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'dclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dmrg',
            [
                'label' => esc_html__('Margin', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],

                'selectors' => [
                    '{{WRAPPER}} .desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'dtyp',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .desc',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'e4',
            [
                'label' => esc_html__('Sep', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'sepbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tb-process-1 .tb-process:before' => 'border-bottom-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'spwid',
            [
                'label' => esc_html__('Width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tb-process-1 .tb-process:before' => 'width: {{SIZE}}%;',
                ],
            ]
        );

        $this->add_responsive_control(
            'sptp',
            [
                'label' => esc_html__('Top spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tb-process-1 .tb-process:before' => 'top: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'splsp',
            [
                'label' => esc_html__('Left spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tb-process-1 .tb-process:before' => 'left: {{SIZE}}%;',
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

    private function content($content, $anim)
    {
        $out = '';
        foreach ($content as $item) {
            $num = $item['num'] ? '<div class="numwrap"><span class="number">' . $item['num'] . '</span></div>' : '';
            $title = $item['title'] ? '<h3 class="title">' . $item['title'] . '</h3>' : '';
            $desc = $item['desc'] ? '<p class="desc">' . $item['desc'] . '</p>' : '';

            $out .= '
                <div class="gridwrap ' . $anim . '">
                    <div class="tb-process">
                        ' . $num . '
                        <div class="inner">' . $title . $desc . '</div>
                    </div>
                </div>
            ';
        }

        return thepack_build_html($out);
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_process_1());
