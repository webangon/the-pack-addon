<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\utils;

if (!defined('ABSPATH')) {
    exit;
}

class thepack_evlyst extends Widget_Base
{
    public function get_name()
    {
        return 'tb_evlyst';
    }

    public function get_title()
    {
        return esc_html__('Event Listing', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-welcome-write-blog';
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
            'thumb',
            [
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true,
                'label' => esc_html__('Thumbnail', 'the-pack-addon'),
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Rock in wonderland',
            ]
        );

        $repeater->add_control(
            'date',
            [
                'label' => esc_html__('Date', 'the-pack-addon'),
                'type' => Controls_Manager::TEXTAREA,
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

        $repeater->add_control(
            'btn',
            [
                'label' => esc_html__('Button Label', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Apply',
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
                        'title' => esc_html__('Rock in wonderland', 'the-pack-addon'),
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
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tour_listing' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'gbr_c',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tour_listing:not(:last-child)' => 'border-bottom:1px solid {{VALUE}};',
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
            'gbgt',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tour_listing' => 'background:{{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'c_wid',
            [
                'label' => esc_html__('Description width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tbtourtt' => 'width: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_img',
            [
                'label' => esc_html__('Thumbnail', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
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

        $this->add_responsive_control(
            'd_wid',
            [
                'label' => esc_html__('Width', 'the-pack-addon'),
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
                    '{{WRAPPER}} .tbtourdt' => 'width: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'tbr',
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
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tbtourdt img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'd_sp',
            [
                'label' => esc_html__('Right spacing', 'the-pack-addon'),
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
                    '{{WRAPPER}} .tbtourdt' => 'padding-right: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_td',
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

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 't_ty',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .title',
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

        $this->end_controls_section();

        $this->start_controls_section(
            'section_ty',
            [
                'label' => esc_html__('Time', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ty_c',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .date' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ty_m',
            [
                'label' => esc_html__('Margin', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],

                'selectors' => [
                    '{{WRAPPER}} .date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ty_t',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .date',
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
            'd_c',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'd_m',
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
                'name' => 'd_t',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .desc',
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

        $this->add_responsive_control(
            'btn_mw',
            [
                'label' => esc_html__('Maximum width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .tour-btn' => 'width: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'btn_pad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],

                'selectors' => [
                    '{{WRAPPER}} .tour-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typo',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .tour-btn',
            ]
        );

        $this->add_control(
            'btn_bgl',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tour-btn' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_bgh',
            [
                'label' => esc_html__('Hover Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tour-btn:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_clr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tour-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_clrh',
            [
                'label' => esc_html__('Hover Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tour-btn:hover' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .tour-btn' => 'border-width: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'btn_br',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .tour-btn' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'btn_bclr',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tour-btn' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_bclrh',
            [
                'label' => esc_html__('Hover Border Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tour-btn:hover' => 'border-color: {{VALUE}};',
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

    private function content($content, $column, $img_size)
    {
        $out = '';
        foreach ($content as $item) {
            $img = $item['thumb']['id'] ? '<div class="tbtourdt">' . thepack_ft_images($item['thumb']['id'], $img_size) . '</div>' : '';
            $title = $item['title'] ? '<h3 class="title">' . $item['title'] . '</h3>' : '';
            $date = $item['date'] ? '<p class="date">' . $item['date'] . '</p>' : '';
            $desc = $item['desc'] ? '<p class="desc">' . $item['desc'] . '</p>' : '';
            $link = thepack_get_that_link($item['url']);
            $btn = $item['btn'] ? '<div class="tbtourbtn"><a ' . $link . ' class="tour-btn">' . $item['btn'] . '</a></div>' : '';

            $out .= '
                <div class="tour_listing ' . $column . '">
                    ' . $img . '
                    <div class="tbtourtt">
                    ' . $title . $date . $desc . '
                    </div>
                    ' . $btn . '
                </div>
            ';
        }

        return thepack_build_html($out);
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_evlyst());
