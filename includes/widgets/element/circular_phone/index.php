<?php
namespace ThePackAddon\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Utils;

if (!defined('ABSPATH')) {
    exit;
}

class thepack_cphone extends Widget_Base
{
    public function get_name()
    {
        return 'ae_cphn';
    }

    public function get_title()
    {
        return esc_html__('Circular Phone', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-admin-settings';
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
                'label' => esc_html__('Content', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'label',
            [
                'label' => esc_html__('Label', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '(+123) 456 789 012',
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'the-pack-addon'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_circle',
            [
                'label' => esc_html__('Circle', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'gpos',
            [
                'label' => esc_html__('Position - vertical positioning', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .inner-content' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gpsos',
            [
                'label' => esc_html__('Height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .tb-circlewrap' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'fcbc',
            [
                'label' => esc_html__('First circle border', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tb-circlewrap .c1' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'scbc',
            [
                'label' => esc_html__('Second circle border', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tb-circlewrap .c2' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tcbc',
            [
                'label' => esc_html__('Third circle border', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tb-circlewrap .c3' => 'border-color: {{VALUE}};',
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

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'overlay_color',
                'label' => esc_html__('Text background', 'elementor'),
                'types' => ['none', 'classic', 'gradient'],
                'selector' => '{{WRAPPER}} .info',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'num_ty',
                'label' => esc_html__('Text typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .info',
            ]
        );

        $this->add_control(
            'tpad',
            [
                'label' => esc_html__('Text padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_icn',
            [
                'label' => esc_html__('Icon', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icol',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tbicon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ibg',
            [
                'label' => esc_html__('Background color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tbicon' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ibcol',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tbicon' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'iwh',
            [
                'label' => esc_html__('Icon width height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .tbicon' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ibdr',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .tbicon' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ifs',
            [
                'label' => esc_html__('Icon font-size', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .tbicon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ilh',
            [
                'label' => esc_html__('Icon line height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .tbicon' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();
        $icon = $settings['icon']['value'] ? '<i class="tbicon ' . esc_attr($settings['icon']['value']) . '"></i>' : '';
        $label = $settings['label'] ? '<div class="info">' . $settings['label'] . '</div>' : ''; ?>

        <div class="tb-circlewrap">

            <div class="c1 tb-cpulse"></div>
            <div class="c2 tb-cpulse"></div>
            <div class="c3 tb-cpulse"></div>

            <div class="inner-content">
                 <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<?php echo thepack_build_html($label . $icon); ?>
            </div>

        </div>

        <style type="text/css">
            .tb-circlewrap {
                height: 450px;
                position: relative;
            }

            .inner-content {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translateX(-50%);
                text-align: center;
            }

            .tb-circlewrap .c1 {
                width: 400px;
                height: 400px;
                position: absolute;
                -webkit-border-radius: 100%;
                -moz-border-radius: 100%;
                border-radius: 100%;
                top: 50%;
                left: 50%;
                margin-top: -200px;
                margin-left: -200px;
                border: 1px solid #f7f7f7;
            }

            .tb-circlewrap .c2 {
                width: 300px;
                height: 300px;
                -webkit-border-radius: 100%;
                -moz-border-radius: 100%;
                border-radius: 100%;
                border: 1px solid #eee;
                top: 50%;
                left: 50%;
                margin-top: -150px;
                margin-left: -150px;
                position: absolute;
            }

            .tb-circlewrap .c3 {
                width: 200px;
                height: 200px;
                -webkit-border-radius: 100%;
                -moz-border-radius: 100%;
                border-radius: 100%;
                border: 1px solid #e5e5e5;
                top: 50%;
                left: 50%;
                margin-top: -100px;
                margin-left: -100px;
                position: absolute;
            }

            .tbicon {
                width: 40px;
                height: 40px;
                border: 1px solid #eee;
                border-radius: 50%;
                line-height: 39px;
                display: inline-block;
            }

            .info {
                font-size: 13px;
                background: #2c3459;
                color: #fff;
                padding: 5px 10px;
                margin-bottom: 8px;
            }

            .tb-cpulse {
                -webkit-animation: tb-pulse 3s infinite;
                -moz-animation: tb-pulse 3s infinite;
                -o-animation: tb-pulse 3s infinite;
                animation: tb-pulse 3s infinite;
                opacity: 1;
                -webkit-animation-fill-mode: both;
                -moz-animation-fill-mode: both;
                -o-animation-fill-mode: both;
                animation-fill-mode: both;
            }

            @-webkit-keyframes tb-pulse {
                0% {
                    -webkit-transform: scale(1);
                    opacity: 0.5;
                }
                50% {
                    -webkit-transform: scale(1.1);
                    opacity: 1;
                }
                100% {
                    -webkit-transform: scale(1);
                    opacity: 0.5;
                }
            }

            @-moz-keyframes tb-pulse {
                0% {
                    -moz-transform: scale(1);
                    opacity: 0.5;
                }
                50% {
                    -moz-transform: scale(1.1);
                    opacity: 1;
                }
                100% {
                    -moz-transform: scale(1);
                    opacity: 0.5;
                }
            }

            @-o-keyframes tb-pulse {
                0% {
                    -o-transform: scale(1);
                    opacity: 0.5;
                }
                50% {
                    -o-transform: scale(1.1);
                    opacity: 1;
                }
                100% {
                    -o-transform: scale(1);
                    opacity: 0.5;
                }
            }

            @keyframes tb-pulse {
                0% {
                    transform: scale(1);
                    opacity: 0.5;
                }
                50% {
                    transform: scale(1.1);
                    opacity: 1;
                }
                100% {
                    transform: scale(1);
                    opacity: 0.5;
                }
            }

        </style>

	<?php
    }

    protected function content_template()
    {
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_cphone());
