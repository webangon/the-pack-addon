<?php
namespace ThePackAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class thepack_prcs2 extends Widget_Base
{
    public function get_name()
    {
        return 'tb_prcs2';
    }

    public function get_title()
    {
        return esc_html__('Process 2', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-editor-spellcheck';
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
                'default' => 'Frontend Web Developer',
            ]
        );

        $repeater->add_control(
            'pre',
            [
                'label' => esc_html__('Prefix', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '01',
            ]
        );

        $repeater->add_control(
            'img',
            [
                'label' => esc_html__('Image', 'the-pack-addon'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'desc',
            [
                'label' => esc_html__('Description', 'the-pack-addon'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Full Time - London, United Kingdom - Published 4 months ago',
            ]
        );

        $repeater->add_control(
            'url',
            [
                'label' => esc_html__('Link', 'the-pack-addon'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => esc_html__('http://your-link.com', 'the-pack-addon'),
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
                        'title' => esc_html__('Frontend Web Developer', 'the-pack-addon'),
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->add_control(
            'ikn',
            [
                'label' => esc_html__('Link icon', 'the-pack-addon'),
                'type' => Controls_Manager::ICONS,
            ]
        );

        $this->add_control(
            'img_size',
            [
                'label' => esc_html__('Image size', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => thepack_image_size_choose(),
                'multiple' => false,
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
            'show-hour',
            [
                'label' => esc_html__('Image shadow', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'the-pack-addon'),
                'label_off' => esc_html__('Off', 'the-pack-addon'),
                'selectors' => [
                    '{{WRAPPER}} .procs2inr img' => 'box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);',
                ],
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
                    '{{WRAPPER}} .procs2inr' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'width',
            [
                'label' => esc_html__('Column width', 'the-pack-addon'),
                'type' => Controls_Manager::NUMBER,
                'default' => '33.33',
                'selectors' => [
                    '{{WRAPPER}} .procs2' => 'width: {{VALUE}}%;',
                ],
            ]
        );

        $this->add_control(
            'pad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 20,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .procs2' => 'padding:{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tb-process2' => 'margin:0px -{{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'animation',
            [
                'label' => esc_html__('Animation', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT,
                'options' => thepack_animations(),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_img',
            [
                'label' => esc_html__('Image', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'img_wid',
            [
                'label' => esc_html__('Width', 'the-pack-addon'),
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
                    '{{WRAPPER}} .procs2inr .img-wrap' => 'width: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'img_pad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .procs2inr .img-wrap' => 'padding: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'img_br',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
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
                    '{{WRAPPER}} .procs2inr .img-wrap img,{{WRAPPER}} .procs2inr .img-wrap' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'img_b_klr',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .img-wrap' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_pre',
            [
                'label' => esc_html__('Label', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'l_clr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pre' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'l_bg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pre' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pr_wid',
            [
                'label' => esc_html__('Width', 'the-pack-addon'),
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
                    '{{WRAPPER}} .pre' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'prty',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .pre',
            ]
        );

        $this->add_control(
            'pr_br',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
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
                    '{{WRAPPER}} .pre' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'prts',
            [
                'label' => esc_html__('Top spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .pre' => 'top: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'prls',
            [
                'label' => esc_html__('Left spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .pre' => 'left: {{SIZE}}{{UNIT}};',
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
            'section_desc',
            [
                'label' => esc_html__('Description', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_ty',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .description',
            ]
        );

        $this->add_control(
            'desc_margin',
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
            'section_btn',
            [
                'label' => esc_html__('Button', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'btn_wid',
            [
                'label' => esc_html__('Width', 'the-pack-addon'),
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
                    '{{WRAPPER}} .tb_prcs2btn' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'btn_br',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
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
                    '{{WRAPPER}} .tb_prcs2btn' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'btn_lh',
            [
                'label' => esc_html__('Vertical spacing', 'the-pack-addon'),
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
                    '{{WRAPPER}} .tb_prcs2btn' => 'line-height: {{SIZE}}{{UNIT}}',
                ],

            ]
        );

        $this->add_control(
            'btn_bgl',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tb_prcs2btn' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_bgh',
            [
                'label' => esc_html__('Hover Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tb_prcs2btn:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_clr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tb_prcs2btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_clrh',
            [
                'label' => esc_html__('Hover Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tb_prcs2btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_bw',
            [
                'label' => esc_html__('Border width', 'the-pack-addon'),
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
                    '{{WRAPPER}} .tb_prcs2btn' => 'border-width: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'btn_bclr',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tb_prcs2btn' => 'border-color: {{VALUE}};border-style: solid;',
                ],
            ]
        );

        $this->add_control(
            'btn_bclrh',
            [
                'label' => esc_html__('Hover Border Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tb_prcs2btn:hover' => 'border-color: {{VALUE}};',
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

    private function content($content, $icon, $column, $image_size)
    {
        $out = '';
        foreach ($content as $item) {
            $id = $item['img']['id'];
            $pre = $item['pre'] ? '<span class="pre">' . $item['pre'] . '</span>' : '';
            $img = $id ? '<div class="img-wrap">' . thepack_ft_images($id, $image_size) . $pre . '</div>' : '';
            $title = $item['title'] ? '<h3 class="title">' . $item['title'] . '</h3>' : '';
            $desc = $item['desc'] ? '<p class="description">' . $item['desc'] . '</p>' : '';
            $link = thepack_get_that_link($item['url']);

            $btn = $icon['value'] ? '<a ' . $link . ' class="tb_prcs2btn"><i class="tbicon ' . $icon['value'] . '"></i></a>' : '';

            $out .= '
                <div class="procs2 ' . $column . '">
                    <div class="procs2inr">
                        ' . $img . '
                        <div class="inr">
                            ' . $title . $desc . $btn . '
                        </div>
                    </div>
                </div>
            ';
        }

        return thepack_build_html($out);
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_prcs2());
