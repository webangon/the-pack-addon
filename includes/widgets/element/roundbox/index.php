<?php
namespace ThePackAddon\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Utils;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class tp_roundbox extends Widget_Base
{
    public function get_name()
    {
        return 'tprbox';
    }

    public function get_title()
    {
        return esc_html__('Round box', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-filter';
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

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'type',
            [
                'label' => esc_html__('Population', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'icon' => [
                        'title' => esc_html__('Icon', 'the-pack-addon'),
                        'icon' => ' eicon-document-file',
                    ],
                    'img' => [
                        'title' => esc_html__('Image', 'the-pack-addon'),
                        'icon' => 'eicon-image-rollover',
                    ]
                ],
                'default' => 'icon',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'ikn',
            [
                'type' => Controls_Manager::ICONS,
                'label' => esc_html__('Icon', 'the-pack-addon'),
                'label_block' => true,
                'condition' => [
                    'type' => 'icon',
                ],
            ]
        );

        $repeater->add_control(
            'imgs',
            [
                'label' => esc_html__('Image', 'the-pack-addon'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true,
                'condition' => [
                    'type' => 'img',
                ],
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
            ]
        );

        $repeater->add_responsive_control(
            'dur',
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
            ]
        );

        $repeater->add_control(
            'bgcolor',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__('Background color', 'the-pack-addon'),
                'label_block' => true,
                'condition' => [
                    'type' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'prevent_empty' => false,
                'title_field' => '{{type}}',
            ]
        );

        $this->add_control(
            'cimg',
            [
                'label' => esc_html__('Center image', 'the-pack-addon'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true,
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
            'galg',
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
                    '{{WRAPPER}} .tp-circlebox-inner' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gwh',
            [
                'label' => esc_html__('Width & height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['%', 'px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tp-circlebox' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'cwh',
            [
                'label' => esc_html__('Center Width & height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['%', 'px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tp-circleboximg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'itrns',
            [
                'label' => esc_html__('Items position', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['%', 'px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} li:nth-of-type(1)' => '-webkit-transform: rotate(0deg) translate({{SIZE}}{{UNIT}}) rotate(0deg); transform: rotate(0deg) translate({{SIZE}}{{UNIT}}) rotate(0deg)',
                    '{{WRAPPER}} li:nth-of-type(2)' => '-webkit-transform: rotate(60deg) translate({{SIZE}}{{UNIT}}) rotate(-60deg); transform: rotate(60deg) translate({{SIZE}}{{UNIT}}) rotate(-60deg)',
                    '{{WRAPPER}} li:nth-of-type(3)' => '-webkit-transform: rotate(120deg) translate({{SIZE}}{{UNIT}}) rotate(-120deg); transform: rotate(120deg) translate({{SIZE}}{{UNIT}}) rotate(-120deg)',
                    '{{WRAPPER}} li:nth-of-type(4)' => '-webkit-transform: rotate(180deg) translate({{SIZE}}{{UNIT}}) rotate(-180deg); transform: rotate(180deg) translate({{SIZE}}{{UNIT}}) rotate(-180deg)',
                    '{{WRAPPER}} li:nth-of-type(5)' => '-webkit-transform: rotate(240deg) translate({{SIZE}}{{UNIT}}) rotate(-240deg); transform: rotate(240deg) translate({{SIZE}}{{UNIT}}) rotate(-240deg)',
                    '{{WRAPPER}} li:nth-of-type(6)' => '-webkit-transform: rotate(300deg) translate({{SIZE}}{{UNIT}}) rotate(-300deg); transform: rotate(300deg) translate({{SIZE}}{{UNIT}}) rotate(-300deg)',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ggbd',
                'selector' => '{{WRAPPER}} .tp-circlebox',
                'label' => esc_html__('Border', 'the-pack-addon'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_cimg',
            [
                'label' => esc_html__('Center image', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'cgbd',
                'selector' => '{{WRAPPER}} .tp-circleboximg',
                'label' => esc_html__('Border', 'the-pack-addon'),
            ]
        );

        $this->add_responsive_control(
            'cawh',
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
                'size_units' => ['%', 'px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tp-circleboximg' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'thwid',
            [
                'label' => esc_html__('Thumb width', 'the-pack-addon'),
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
                    '{{WRAPPER}} .tp-circleboximg img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'thwidbr',
            [
                'label' => esc_html__('Thumb border radius', 'the-pack-addon'),
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
                    '{{WRAPPER}} .tp-circleboximg img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_itms',
            [
                'label' => esc_html__('Items', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'ivps',
            [
                'label' => esc_html__('Width & height', 'the-pack-addon'),
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
                    '{{WRAPPER}} li' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};margin: calc(-{{SIZE}}{{UNIT}} / 2);',
                ],
            ]
        );

        $this->add_responsive_control(
            'ivpsr',
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
                    '{{WRAPPER}} .inner' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'iclr',
            [
                'label' => esc_html__('Icon color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .inner' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'isz',
            [
                'label' => esc_html__('Icon size', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .inner' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'icbf',
                'selector' => '{{WRAPPER}} .inner',
                'label' => esc_html__('Box shadow', 'the-pack-addon'),
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ibdq',
                'selector' => '{{WRAPPER}} .inner',
                'label' => esc_html__('Border', 'the-pack-addon'),
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
        $out = '';
        foreach ($content as $item) {
            if ($item['type'] == 'img') {
                $cont = thepack_ft_images($item['imgs']['id'], 'full');
            } else {
                $cont = '<i class="' . $item['ikn']['value'] . '"></i>';
            }
            $anim = $item['amin'] ? 'class="' . $item['amin'] . '"' : '';
            $dura = $item['dur']['size'] ? 'style="animation-duration:' . $item['dur']['size'] . 's;background:' . $item['bgcolor'] . '"' : '';

            $out .= '<li><div ' . $dura . ' class="inner ' . $item['amin'] . '">' . $cont . '</div></li>';
        }

        return $out;
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\tp_roundbox());
