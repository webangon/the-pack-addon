<?php
namespace ThePackAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

// Exit if accessed directly

class thepack_altimggrid extends Widget_Base
{
    public function get_name()
    {
        return 'tb_altimggrid';
    }

    public function get_title()
    {
        return esc_html__('Imagegrid alt', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-admin-site';
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
                'label' => esc_html__('Label', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'the-pack-addon'),
                'type' => Controls_Manager::ICONS,
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
                        'title' => esc_html__('Addida', 'the-pack-addon'),
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->add_control(
            'url',
            [
                'label' => esc_html__('Link label', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'condition' => [
                    'tmpl!' => ['two'],
                ],
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
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .contenthldr' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'bhght',
            [
                'label' => esc_html__('Height', 'the-pack-addon'),
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
                    '{{WRAPPER}} .imghldr,{{WRAPPER}} .contenthldr' => 'height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .itemstb' => 'width: {{VALUE}}%;',
                ],
            ]
        );

        $this->add_control(
            'animation',
            [
                'label' => esc_html__('Animation', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT,
                'options' => thepack_animations(),
                'multiple' => false,
                'label_block' => true,
            ]
        );

        $this->add_responsive_control(
            'cpad',
            [
                'label' => esc_html__('Content padding', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .contenthldr' => 'padding:0px {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'cvps',
            [
                'label' => esc_html__('Content vertical position', 'the-pack-addon'),
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
                    '{{WRAPPER}} .tbinr' => 'top:{{SIZE}}%;',
                ],

            ]
        );

        $this->add_control(
            'cntbg',
            [
                'label' => esc_html__('Content background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contenthldr' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_img',
            [
                'label' => esc_html__('Background Image', 'the-pack-addon'),
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

        $this->add_control(
            'm1',
            [
                'type' => Controls_Manager::RAW_HTML,
                'raw' => esc_html__('Image overlay', 'the-pack-addon'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'overlay_color',
                'label' => esc_html__('Background', 'elementor'),
                'types' => ['none', 'classic', 'gradient'],
                'selector' => '{{WRAPPER}} .imghldr::before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_icon',
            [
                'label' => esc_html__('Icon', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_c',
            [
                'label' => esc_html__('Icon color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .iconwrp' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ibgc',
            [
                'label' => esc_html__('Icon background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .iconwrp' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ibdr',
            [
                'label' => esc_html__('Icon border-color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .iconwrp' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'iwh',
            [
                'label' => esc_html__('Width and height', 'the-pack-addon'),
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
                    '{{WRAPPER}} .iconwrp' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};text-align:center;display: inline-block;',
                ],
            ]
        );

        $this->add_control(
            'ibdrwd',
            [
                'label' => esc_html__('Icon border width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .iconwrp' => 'border-width: {{SIZE}}{{UNIT}};border-style:solid;',
                ],
            ]
        );

        $this->add_control(
            'ibrud',
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
                    '{{WRAPPER}} .iconwrp' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'if_size',
            [
                'label' => esc_html__('Icon font size', 'the-pack-addon'),
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
                    '{{WRAPPER}} .iconwrp' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ilh',
            [
                'label' => esc_html__('Icon vertical position', 'the-pack-addon'),
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
                    '{{WRAPPER}} .iconwrp' => 'line-height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_ty',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .desc',
            ]
        );

        $this->add_control(
            'desc_margin',
            [
                'label' => esc_html__('Margin', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],

                'selectors' => [
                    '{{WRAPPER}} .desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            'btn_pad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],

                'selectors' => [
                    '{{WRAPPER}} .clink' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typo',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .clink',
            ]
        );

        $this->add_control(
            'btn_bgl',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .clink' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_bgh',
            [
                'label' => esc_html__('Hover Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .clink:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_clr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .clink' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_clrh',
            [
                'label' => esc_html__('Hover Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .clink:hover' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .clink' => 'border-width: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'btn_bclr',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .clink' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_bclrh',
            [
                'label' => esc_html__('Hover Border Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .clink:hover' => 'border-color: {{VALUE}};',
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

    private function content($content, $animation, $size)
    {
        $i = 0;
        $out = '';
        foreach ($content as $item) {
            $i++;
            $id = $item['img']['id'];
            $bg = $id ? thepack_bg_images($id, $size) : '';
            $title = $item['title'] ? '<h3 class="title">' . $item['title'] . '</h3>' : '';
            $desc = $item['desc'] ? '<p class="desc">' . $item['desc'] . '</p>' : '';
            $icon = $item['icon']['value'] ? '<span class="iconwrp"><i class="tbicon ' . $item['icon']['value'] . '"></i></span>' : '';
            $link = thepack_get_that_link($item['url']);

            $btn = $item['btn'] ? '<a ' . $link . ' class="clink"><span>' . $item['btn'] . '</span></a>' : '';

            if ($i % 2 == 0) {
                $out1 = '
                    <div class="hasimg">
                        <div ' . $bg . ' class="lazyload imghldr"></div>
                        <div class="contenthldr">
                            <div class="tbinr">
                                ' . $icon . $title . $desc . $btn . '
                            </div>
                        </div>
                    </div>
                ';
            } else {
                $out1 = '
                    <div class="hasnoimg">
                        <div class="contenthldr">
                            <div class="tbinr">
                                ' . $icon . $title . $desc . $btn . '
                            </div>
                        </div>
                        <div ' . $bg . ' class="lazyload imghldr"></div>
                    </div>
                ';
            }
            $out .= '
             <div class="itemstb ' . $animation . '">
                ' . $out1 . '
            </div>
            ';
        }

        return thepack_build_html($out);
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_altimggrid());
