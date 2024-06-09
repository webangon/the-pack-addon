<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class thepack_progressbars extends Widget_Base
{
    public function get_name()
    {
        return 'ae-stats-bars';
    }

    public function get_title()
    {
        return esc_html__('Progressbar 1', 'the-pack-addon');
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

        $this->add_control(
            'tmpl',
            [
                'label' => esc_html__('Template', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'one' => [
                        'title' => esc_html__('One', 'the-pack-addon'),
                        'icon' => 'eicon-folder',
                    ],
                    'two' => [
                        'title' => esc_html__('Two', 'the-pack-addon'),
                        'icon' => 'eicon-folder-o',
                    ],

                    'three' => [
                        'title' => esc_html__('Three', 'the-pack-addon'),
                        'icon' => 'eicon-document-file',
                    ],

                ],
                'default' => 'one',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Label', 'the-pack-addon'),
                'label_block' => true,
                'default' => 'Webdesign',
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
            'animation',
            [
                'label' => esc_html__('Animation', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT,
                'options' => thepack_animations(),
                'multiple' => false,
                'label_block' => true
            ]
        );

        $this->add_control(
            'bar_margin',
            [
                'label' => esc_html__('Bottom margin', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .bar-container' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_stats_bar_styling',
            [
                'label' => esc_html__('Bar Styles', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pri_color',
                'label' => esc_html__('Background', 'elementor'),
                'types' => ['none', 'classic', 'gradient'],
                'selector' => '{{WRAPPER}} .bar',
            ]
        );

        $this->add_control(
            'sec_color',
            [
                'label' => esc_html__('Secondary color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bar-container' => 'background-color: {{VALUE}};',

                ],
            ]
        );

        $this->add_control(
            'bar_height',
            [
                'label' => esc_html__('Bar height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .bar' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_lbl',
            [
                'label' => esc_html__('Label', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'lbl_b',
            [
                'label' => esc_html__('Bottom padding', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bar-label' => 'padding-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'lbl_c',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bar-label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .bar-label',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_pcent',
            [
                'label' => esc_html__('Percentage', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pcen_bg',
                'label' => esc_html__('Background', 'elementor'),
                'types' => ['none', 'classic', 'gradient'],
                'selector' => '{{WRAPPER}} .bar-percentage',
            ]
        );

        $this->add_control(
            'pcen_c',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bar-percentage' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pcen_typ',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .bar-percentage',
            ]
        );

        $this->add_control(
            'pcen-pad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .bar-percentage' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pcen_p',
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
                    '{{WRAPPER}} .bar-percentage' => 'top: {{SIZE}}{{UNIT}};',
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

    private function content($content, $template, $column)
    {
        $out1 = $out2 = $out3 = '';

        foreach ($content as $item) {
            $out1 .= '

                <div class="bar-progress ' . $column . '">
                    <div class="bar-label">' . $item['title'] . '</div>
                        <div class="bar-percentage" data-percentage="' . $item['percent']['size'] . '">' . $item['percent']['size'] . '%</div>
                        <div class="bar-container">
                            <div class="bar" style="width:' . $item['percent']['size'] . '%;"></div>
                        </div>
                </div>

            ';

            $out2 .= '

                <div class="bar-progress ' . $column . '">
                    <div class="bar-label">' . $item['title'] . '</div>
                        <div class="bar-percentage tri" data-percentage="' . $item['percent']['size'] . '">' . $item['percent']['size'] . '%</div>
                        <div class="bar-container">
                            <div class="bar" style="width:' . $item['percent']['size'] . '%;"></div>
                        </div>
                </div>

            ';

            $out3 .= '

                <div class="bar-progress ' . $column . '">
                    <div class="bar-label">' . $item['title'] . '</div>
                        <div class="bar-container">
                            <div class="bar" style="width:' . $item['percent']['size'] . '%;">

                            </div>
                        </div>
                </div>

            ';
        }
        if ($template == 'one') {
            return thepack_build_html($out1);
        } elseif ($template == 'two') {
            return thepack_build_html($out2);
        } elseif ($template == 'three') {
            return thepack_build_html($out3);
        } else {
        }
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_progressbars());
