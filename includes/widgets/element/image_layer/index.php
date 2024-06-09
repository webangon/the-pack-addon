<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Utils;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class thepack_image_layer extends Widget_Base
{
    public function get_name()
    {
        return 'tb_imglayer';
    }

    public function get_title()
    {
        return esc_html__('Image layer', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-video-alt';
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
                'label' => esc_html__('Images', 'the-pack-addon'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'animation',
            [
                'label' => esc_html__('Reveal animation', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT,
                'options' => thepack_animations(),
                'multiple' => false,
                'label_block' => true
            ]
        );

        $repeater->add_control(
            'amin',
            [
                'label' => esc_html__('Animation', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT,
                'options' => jl_elementor_animation(),
                'multiple' => false,
                'label_block' => true,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'animation-name: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'anim_du',
            [
                'label' => esc_html__('Animation duration', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => .25,
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'animation-duration: {{SIZE}}s;',
                ],

            ]
        );

        $repeater->add_control(
            'type',
            [
                'label' => esc_html__('Type ', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'icon' => [
                        'title' => esc_html__('Icon', 'the-pack-addon'),
                        'icon' => ' eicon-document-file',
                    ],
                    'image' => [
                        'title' => esc_html__('Image', 'the-pack-addon'),
                        'icon' => 'eicon-image-rollover',
                    ]
                ],
                'default' => 'image',
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
                'condition' => [
                    'type' => 'image',
                ],
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'the-pack-addon'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
                'condition' => [
                    'type' => 'icon',
                ],
            ]
        );

        $repeater->add_control(
            'bggen',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'label_block' => true,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'ifsz',
            [
                'label' => esc_html__('Font size', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ]
                ],
                'condition' => [
                    'type' => 'icon',
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_control(
            'bgclr',
            [
                'label' => esc_html__('Icon color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'label_block' => true,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_control(
            'size',
            [
                'label' => esc_html__('Image size', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => thepack_image_size_choose(),
                'multiple' => false,
                'condition' => [
                    'type' => 'image',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'tpos',
            [
                'label' => esc_html__('Top position', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -300,
                        'max' => 300,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'btmpos',
            [
                'label' => esc_html__('Bottom position', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -300,
                        'max' => 300,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'zinx',
            [
                'label' => esc_html__('Z index', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'z-index: {{SIZE}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'lftpos',
            [
                'label' => esc_html__('Left position', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -300,
                        'max' => 300,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'rtpos',
            [
                'label' => esc_html__('Right position', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -300,
                        'max' => 300,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'width',
            [
                'label' => esc_html__('Width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'height',
            [
                'label' => esc_html__('Height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'image_layers',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'prevent_empty' => false,
                'default' => [
                    [
                        'type' => esc_html__('Image', 'the-pack-addon'),
                    ]
                ],
                'title_field' => '{{{ type }}}',
            ]
        );

        $this->add_control(
            'img',
            [
                'label' => esc_html__('Main', 'the-pack-addon'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'main_size',
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
            'section_ming',
            [
                'label' => esc_html__('Main image', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'malign',
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
                    '{{WRAPPER}} .main-img' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'mwid',
            [
                'label' => esc_html__('Width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 800,
                        'min' => 1,
                        'step' => 1,
                    ]
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .main-img img' => 'width: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'mimght',
            [
                'label' => esc_html__('Height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 800,
                        'min' => 1,
                        'step' => 1,
                    ]
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .main-img img' => 'height: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'mibrd',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 800,
                        'min' => 1,
                        'step' => 1,
                    ]
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .main-img img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'mbdr',
                'label' => esc_html__('Border', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .main-img img',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'mbshd',
                'label' => esc_html__('Shadow', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .main-img img',
            ]
        );

        $this->add_responsive_control(
            'mipad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .main-img img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_lyrs',
            [
                'label' => esc_html__('Layers', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bradi',
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
                    '{{WRAPPER}} .layeritem' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'bdr',
                'selector' => '{{WRAPPER}} .layeritem',
                'label' => esc_html__('Border', 'the-pack-addon'),
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'bdr',
                'selector' => '{{WRAPPER}} .layeritem',
                'label' => esc_html__('Shadow', 'the-pack-addon'),
            ]
        );

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
            if ($item['type'] == 'image') {
                $img = thepack_ft_images($item['img']['id'], $item['size']);
            } else {
                $img = $item['icon']['value'] ? '<i class="' . $item['icon']['value'] . '"></i>' : '';
            }
            $out1 .= '<div class="elementor-repeater-item-' . $item['_id'] . ' layeritem ' . $item['animation'] . '">' . $img . '</div>';
        }

        return thepack_build_html($out1);
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_image_layer());
