<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class thepack_progressbar2 extends Widget_Base
{
    public function get_name()
    {
        return 'tpskillbar2';
    }

    public function get_title()
    {
        return esc_html__('Skillbar', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-editor-kitchensink';
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
                'label' => esc_html__('Content', 'the-pack-addon'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Label', 'the-pack-addon'),
                'label_block' => true,
                'default' => esc_html__('Webdesign', 'the-pack-addon'),
            ]
        );

        $repeater->add_control(
            'clr',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__('Theme color', 'the-pack-addon'),
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .skillbar' => 'background: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_control(
            'percent',
            [
                'label' => esc_html__('Percentage', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 16,
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .skillbar' => 'width: {{SIZE}}%;',
                    '{{WRAPPER}} {{CURRENT_ITEM}} .dots' => 'left: {{SIZE}}%;',
                ],
            ]
        );
        $this->add_control(
            'items',
            [
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => esc_html__('Webdesign', 'the-pack-addon'),
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
            'bar_margin',
            [
                'label' => esc_html__('Bottom margin', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .items:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_cstyl',
            [
                'label' => esc_html__('Content', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tctb');

        $this->start_controls_tab(
            'e1',
            [
                'label' => esc_html__('Title', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            't_c',
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
                'name' => 't_typ',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .title',
            ]
        );

        $this->add_control(
            'tmr',
            [
                'label' => esc_html__('Margin', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'e2',
            [
                'label' => esc_html__('Number', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'nvp',
            [
                'label' => esc_html__('Vertical position', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .parcent' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'nvvp',
            [
                'label' => esc_html__('Horizontal position', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -400,
                        'max' => 400,
                        'step' => 1,
                    ]
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .parcent' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'nt_c',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .parcent' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'nt_typ',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .parcent',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'e3',
            [
                'label' => esc_html__('Dot', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'dtvp',
            [
                'label' => esc_html__('Vertical position', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .dots' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'dtwh',
            [
                'label' => esc_html__('Width & height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .dots' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'dtbrt',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .dots' => 'border-radius:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'dtbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dots' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dtbrd',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dots' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'dtsd',
                'label' => esc_html__('Box shadow', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .dots',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'e4',
            [
                'label' => esc_html__('Bar', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'brbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .items:after' => 'background:{{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'brht',
            [
                'label' => esc_html__('Height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .skillbar' => 'height:{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .items:after' => 'height:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'brbrd',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .skillbar' => 'border-radius:{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .items:after' => 'border-radius:{{SIZE}}{{UNIT}};',
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

    private function content($content)
    {
        $out1 = '';
        foreach ($content as $item) {
            $out1 .= '
            <div class="items elementor-repeater-item-' . $item['_id'] . '">
                ' . thepack_build_html($item['title'], 'h3', 'title') . '
                <div class="skillbar"></div>
                <div class="dots"></div>
                <div class="parcent">' . $item['percent']['size'] . '%</div>
            </div>
            ';
        }

        return thepack_build_html($out1);
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_progressbar2());
