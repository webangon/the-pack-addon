<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class thepack_gallery_simple extends Widget_Base
{
    public function get_name()
    {
        return 'wa-gallery';
    }

    public function get_title()
    {
        return esc_html__('Gallery 2', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-images-alt2';
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
            'galleries',
            [
                'label' => esc_html__('Gallery', 'the-pack-addon'),
                'type' => Controls_Manager::GALLERY,
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
            'tmpl',
            [
                'label' => esc_html__('Template', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'grid' => [
                        'title' => esc_html__('Grid', 'the-pack-addon'),
                        'icon' => 'eicon-gallery-grid',
                    ],
                    'masonry' => [
                        'title' => esc_html__('Masonry', 'the-pack-addon'),
                        'icon' => 'eicon-gallery-masonry',
                    ],

                    'justified' => [
                        'title' => esc_html__('Justified', 'the-pack-addon'),
                        'icon' => 'fa fa-folder-open',
                    ],

                ],
                'default' => 'grid',
            ]
        );

        $this->add_control(
            'eoverly',
            [
                'label' => esc_html__('Disable overlay', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
                'selectors' => [
                    '{{WRAPPER}} .overlay' => 'display:none;',
                ],
            ]
        );

        $this->add_control(
            'strip',
            [
                'label' => esc_html__('Strip images from last row', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'condition' => [
                    'tmpl' => ['justified'],
                ],
            ]
        );

        $this->add_responsive_control(
            'width',
            [
                'label' => esc_html__('Column width in %', 'the-pack-addon'),
                'type' => Controls_Manager::NUMBER,
                'default' => '33.33',
                'selectors' => [
                    '{{WRAPPER}} .gallery-item' => 'width: {{VALUE}}%;',
                ],
                'condition' => [
                    'tmpl!' => ['justified'],
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
                'label_block' => true
            ]
        );

        $this->add_control(
            'grid_pad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
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
                    '{{WRAPPER}} .gallery-item' => 'padding:{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .aegrid-gallery' => 'margin-left:-{{SIZE}}{{UNIT}};margin-right:-{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'jght',
            [
                'label' => esc_html__('Justified gallery height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 800,
                        'step' => 1,
                    ],
                ],
                'condition' => [
                    'tmpl' => ['justified'],
                ],
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
            'imht',
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
                    '{{WRAPPER}} .gallery-item a' => 'height:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'imrad',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],

                'selectors' => [
                    '{{WRAPPER}} .gallery-item a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_overlay',
            [
                'label' => esc_html__('Overlay', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'eoverly!' => ['yes'],
                ],
            ]
        );

        $this->add_control(
            'g_pad',
            [
                'label' => esc_html__('Overlay padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],

                'selectors' => [
                    '{{WRAPPER}} .overlay' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'overlay_color',
                'label' => esc_html__('Overlay color', 'the-pack-addon' ),
                'types' => ['none', 'classic', 'gradient'],
                'selector' => '{{WRAPPER}} .content-center',
            ]
        );

        $this->add_control(
            'g_bg',
            [
                'label' => esc_html__('Icon color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tbicon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ifntsze',
            [
                'label' => esc_html__('Icon font size', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .tbicon' => 'font-size: {{SIZE}}{{UNIT}};',
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
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_gallery_simple());
