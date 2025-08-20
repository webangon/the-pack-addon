<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\utils;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class thepack_imgbox1 extends Widget_Base
{
    public function get_name()
    {
        return 'tb_imgbox1';
    }
    // Enqueue styles
	public function get_style_depends() {
		return ['swiper','e-swiper'];
	}

	// Enqueue scripts
	public function get_script_depends() {
		return ['swiper'];
	}
    public function get_title()
    {
        return esc_html__('Imagebox 1', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-media-text';
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

        $repeater1 = new \Elementor\Repeater();

        $repeater1->add_control(
            'img',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => esc_html__('Image', 'the-pack-addon'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater1->add_control(
            'label',
            [
                'label' => esc_html__('Heading', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater1->add_control(
            'type',
            [
                'label' => esc_html__('Icon/Image', 'the-pack-addon'),
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
            ]
        );

        $repeater1->add_control(
            'iimg',
            [
                'label' => esc_html__('Image', 'the-pack-addon'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'type' => 'img',
                ],
                'label_block' => true,
            ]
        );

        $repeater1->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'the-pack-addon' ),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
                'condition' => [
                    'type' => 'icon',
                ],
            ]
        );

        $repeater1->add_control(
            'desc',
            [
                'label' => esc_html__('Description', 'the-pack-addon'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $repeater1->add_control(
            'btn',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Button Label', 'the-pack-addon'),
                'label_block' => true,
            ]
        );

        $repeater1->add_control(
            'url',
            [
                'label' => esc_html__('Button url', 'the-pack-addon'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => esc_html__('http://your-link.com', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'items',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater1->get_controls(),
                'prevent_empty' => false,
                'default' => [
                    [
                        'label' => esc_html__('Awards & Accolades', 'the-pack-addon'),
                    ]
                ],
                'title_field' => '{{{label}}}',
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
            'bticon',
            [
                'label' => esc_html__('Button icon', 'the-pack-addon'),
                'type' => Controls_Manager::ICONS,
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

        $this->add_control(
            'display',
            [
                'label' => esc_html__('Display - Carousel or grid', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'grid' => [
                        'title' => esc_html__('Grid', 'the-pack-addon'),
                        'icon' => 'fa fa-th-large',
                    ],
                    'carousel' => [
                        'title' => esc_html__('Carousel', 'the-pack-addon'),
                        'icon' => 'fa fa-window-restore',
                    ],
                ],

                'default' => 'grid',
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
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .items-wrap' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gwd',
            [
                'label' => esc_html__('Width', 'the-pack-addon'),
                'type' => Controls_Manager::NUMBER,
                'default' => '33.33',
                'condition' => [
                    'display' => 'grid',
                ],
                'selectors' => [
                    '{{WRAPPER}} .items' => 'width: {{VALUE}}%;',
                ],
            ]
        );

        $this->add_responsive_control(
            'itpady',
            [
                'label' => esc_html__('Item Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .items' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .tb-imgbox1' => 'margin-left: -{{LEFT}}{{UNIT}};margin-right:-{{RIGHT}}{{UNIT}};',
                ],
                'condition' => [
                    'disp' => 'grid',
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
                'condition' => [
                    'display' => 'grid',
                ],
            ]
        );

        $this->add_control(
            'g_bg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .items-wrap' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'g_pad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .desc-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .btnimgbx1-icon' => 'right: {{RIGHT}}{{UNIT}};',
                    '{{WRAPPER}} .btnimgbx1' => 'padding-left: {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'label' => esc_html__('Box Shadow', 'the-pack-addon'),
                'name' => 'img_box_sha',
                'selector' => '{{WRAPPER}} .items-wrap',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_head',
            [
                'label' => esc_html__('Content', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs('tctb');

        $this->start_controls_tab(
            'e1',
            [
                'label' => esc_html__('Icon', 'the-pack-addon'),
            ]
        );

        $this->add_responsive_control(
            'ikn_wd',
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
                    '{{WRAPPER}} .top-ikon' => 'width: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'ikn_ht',
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
                    '{{WRAPPER}} .top-ikon' => 'height: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'ikn_fs',
            [
                'label' => esc_html__('Font size', 'the-pack-addon'),
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
                    '{{WRAPPER}} .top-ikon' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .top-ikon img' => 'width: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'ikn_vp',
            [
                'label' => esc_html__('Vertical position', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -300,
                        'max' => 300,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .top-ikon' => 'top: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'ikbg_clr',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .top-ikon' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'iktx_clr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .top-ikon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ikn_br',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
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
                    '{{WRAPPER}} .top-ikon' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'label' => esc_html__('Box Shadow', 'the-pack-addon'),
                'name' => 'ibxdr',
                'selector' => '{{WRAPPER}} .top-ikon',
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
            'h_clr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .heading,{{WRAPPER}} .heading a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'h_mr',
            [
                'label' => esc_html__('Margin', 'the-pack-addon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'h_typo',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .heading',
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
            'desc_clr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'desc_pad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typo',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .desc',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'e4',
            [
                'label' => esc_html__('Button', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'btnlbl_clr',
            [
                'label' => esc_html__('Label Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btnlbl_typo',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .btn-text',
            ]
        );

        $this->add_control(
            'btnico_clr',
            [
                'label' => esc_html__('Icon Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btnimgbx1-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'e5',
            [
                'label' => esc_html__('Thumb', 'the-pack-addon'),
            ]
        );

        $this->add_responsive_control(
            'thm_br',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .items-wrap figure' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'thm_ht',
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
                'size_units' => ['px','%','vh'],
                'selectors' => [
                    '{{WRAPPER}} .items-wrap figure img' => 'height: {{SIZE}}{{UNIT}};object-fit:cover;',
                ],

            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_caro',
            [
                'label' => esc_html__('Slider control', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'display' => 'carousel',
                ],
            ]
        );

        $this->add_responsive_control(
            'sbtsp',
            [
                'label' => esc_html__('Bottom spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .tpswiper' => 'padding-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'fw',
            [
                'label' => esc_html__('Full width slide', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'selectors' => [
                    '{{WRAPPER}} .swiper-container' => 'overflow: inherit;',
                ],
            ]
        );

        $this->add_control(
            'dot',
            [
                'label' => esc_html__('Display dot', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'nav',
            [
                'label' => esc_html__('Display navigation', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'mouse',
            [
                'label' => esc_html__('Mouse scroll', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'the-pack-addon'),
                'label_off' => esc_html__('No', 'the-pack-addon'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'auto',
            [
                'label' => esc_html__('Autoplay', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'the-pack-addon'),
                'label_off' => esc_html__('No', 'the-pack-addon'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'center',
            [
                'label' => esc_html__('Centermode', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'the-pack-addon'),
                'label_off' => esc_html__('No', 'the-pack-addon'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'space',
            [
                'label' => esc_html__('Item spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 2,
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
            ]
        );

        $this->add_control(
            'item',
            [
                'label' => esc_html__('Item per slide', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 4,
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 5,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
            ]
        );

        $this->add_control(
            'item_tab',
            [
                'label' => esc_html__('Item per slide tablets', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 2,
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 5,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
            ]
        );

        $this->add_control(
            'speed',
            [
                'label' => esc_html__('Slide speed', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 2500,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 8000,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_pagi',
            [
                'label' => esc_html__('Slider Pagination', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'nav' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'picon',
            [
                'type' => Controls_Manager::ICONS,
                'label' => esc_html__('Prev icon', 'the-pack-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'nicon',
            [
                'type' => Controls_Manager::ICONS,
                'label' => esc_html__('Next icon', 'the-pack-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'pgi_bg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .khbprnx' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pgi_c',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .khbprnx' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pgwd',
            [
                'label' => esc_html__('Width and height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                        'min' => 1,
                        'step' => 1,
                    ]
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .khbprnx' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'pgbrad',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                        'min' => 1,
                        'step' => 1,
                    ]
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .khbprnx' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_nav',
            [
                'label' => esc_html__('Slider Dot', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'dot' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'navpos',
            [
                'label' => esc_html__('Postion', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 300,
                        'min' => -300,
                        'step' => 1,
                    ]
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination' => 'bottom: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'navcol',
            [
                'label' => esc_html__('Dot color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'navacol',
            [
                'label' => esc_html__('Dot active color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet-active' => 'background-color: {{VALUE}};',
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

    private function content($content, $column, $bticon, $size)
    {
        $out = '';
        foreach ($content as $item) {
            $id = $item['img']['id'];
            $link = thepack_get_that_link($item['url']);
            $img = $id ? '<figure>' . wp_get_attachment_image($id, $size) . '</figure>' : '';
            $label = $item['label'] && $item['url']['url'] ? '<h2 class="heading"><a ' . $link . '>' . $item['label'] . '</a></h2>' : '<h2 class="heading">' . $item['label'] . '</h2>';
            $desc = $item['desc'] ? '<p class="desc">' . $item['desc'] . '</p>' : '';

            $icon = $item['icon']['value'] ? '<span class="top-ikon"><i class="tbicon ' . $item['icon']['value'] . '"></i></span>' : '';
            $icimg = $item['iimg'] ? '<span class="top-ikon">' . wp_get_attachment_image($item['img']['id'], 'full') . '</span>' : '';
            $imgicon = $item['type'] == 'icon' ? $icon : $icimg;

            $bicon = $bticon['value'] ? '<i class="btnimgbx1-icon ' . $bticon['value'] . '"></i>' : '';
            $btn = $item['btn'] ? '<a ' . $link . ' class="btnimgbx1"><span class="btn-text">' . $item['btn'] . '</span>' . $bicon . '</a>' : '';

            $out .= '
             <div class="' . $column . '">
                <div class="items-wrap">
                ' . $img . '
                <div class="desc-wrap">
                ' . $imgicon . '
                ' . $label . $desc . '
                </div>
                ' . $btn . '
                </div>
            </div>
            ';
        }

        return thepack_build_html($out);
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_imgbox1());
