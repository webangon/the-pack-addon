<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class thepack_minibox extends Widget_Base
{
    public function get_name()
    {
        return 'tb-cntbx';
    }

    public function get_title()
    {
        return esc_html__('Mini Box', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-image-rotate-right';
    }

    public function get_categories()
    {
        return ['ashelement-addons'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_services',
            [
                'label' => esc_html__('Services', 'the-pack-addon'),
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
                        'icon' => 'fa fa-folder',
                    ],
                    'two' => [
                        'title' => esc_html__('Two', 'the-pack-addon'),
                        'icon' => 'fa fa-folder-o',
                    ]

                ],
                'default' => 'one',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Heading', 'the-pack-addon'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'type',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Icon/Image', 'the-pack-addon'),
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
                'default' => 'icon',
            ]
        );

        $repeater->add_control(
            'ico',
            [
                'label' => esc_html__('Icon', 'the-pack-addon'),
                'type' => Controls_Manager::ICONS,
                'condition' => [
                    'type' => 'icon',
                ],
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'img',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Image', 'the-pack-addon'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'type' => 'image',
                ],
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'the-pack-addon'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => 'http://your-link.com',
                'default' => [
                    'url' => 'https://themeforest.net/user/xldevelopment',
                ],
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
                        'title' => esc_html__('Year', 'the-pack-addon'),
                    ]
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->add_control(
            'btn',
            [
                'label' => esc_html__('Link icon', 'the-pack-addon'),
                'type' => Controls_Manager::ICONS,
                'condition' => [
                    'tmpl!' => 'two',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_html__('General', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'align',
            [
                'label' => esc_html__('Align', 'the-pack-addon'),
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
                    '{{WRAPPER}} .items' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'anim',
            [
                'label' => esc_html__('Animation', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT,
                'options' => thepack_animations(),
                'multiple' => false,
            ]
        );

        $this->add_responsive_control(
            'width',
            [
                'label' => esc_html__('Column width', 'the-pack-addon'),
                'type' => Controls_Manager::NUMBER,
                'default' => '33.33',
                'selectors' => [
                    '{{WRAPPER}} .items' => 'width: {{VALUE}}%;float:left;',
                ],
            ]
        );

        $this->add_responsive_control(
            'mnhgt',
            [
                'label' => esc_html__('Minimum height', 'the-pack-addon'),
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
                    '{{WRAPPER}} .items' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'mbspc',
            [
                'label' => esc_html__('Item spacing', 'the-pack-addon'),
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
                    '{{WRAPPER}} .items' => 'padding: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .minibox-1' => 'margin:0px -{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gpad',
            [
                'label' => esc_html__('Padding', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .btn-wrap' => 'padding-left: {{LEFT}}{{UNIT}};padding-right: {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gtbrd',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .inner' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'gbxdw',
                'label' => esc_html__('Box shadow', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .inner',
            ]
        );

        $this->start_controls_tabs('tctb');

        $this->start_controls_tab(
            'e1',
            [
                'label' => esc_html__('Normal', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'box_bg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .inner' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'gbrd',
            [
                'label' => esc_html__('Border', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .inner' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'e2',
            [
                'label' => esc_html__('Hover', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'gbrdh',
            [
                'label' => esc_html__('Border', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .inner:hover' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btbdcr',
            [
                'label' => esc_html__('Border bottom color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'tmpl' => 'two',
                ],
                'selectors' => [
                    '{{WRAPPER}} .style-2 .inner:before' => 'border-bottom-color:{{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_box',
            [
                'label' => esc_html__('Box', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            ]
        );

        $this->start_controls_tabs('gt');

        $this->start_controls_tab(
            'gt1',
            [
                'label' => esc_html__('Icon/Image', 'the-pack-addon'),
            ]
        );

        $this->add_responsive_control(
            'itwh',
            [
                'label' => esc_html__('Width & height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .img-wrap' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};display:inline-block;text-align:center;',
                ],
            ]
        );

        $this->add_responsive_control(
            'itbrd',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .img-wrap' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'itlh',
            [
                'label' => esc_html__('Line height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .img-wrap' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'itfs',
            [
                'label' => esc_html__('Font size', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .img-wrap i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .img-wrap img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'itbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .img-wrap' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'itbkl',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .img-wrap' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'itclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .img-wrap i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'gt2',
            [
                'label' => esc_html__('Title', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'tmrg',
            [
                'label' => esc_html__('Margin', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'tklr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title,{{WRAPPER}} .title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typt',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .title',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'gt3',
            [
                'label' => esc_html__('Button', 'the-pack-addon'),
                'condition' => [
                    'tmpl!' => 'two',
                ],
            ]
        );

        $this->add_responsive_control(
            'btwh',
            [
                'label' => esc_html__('Width & height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .more-btn' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'btbrd',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .more-btn' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'btfs',
            [
                'label' => esc_html__('Font size', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .more-btn' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'bal',
            [
                'label' => esc_html__('Align', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'the-pack-addon'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Right', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .btn-wrap' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .more-btn' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btbkl',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .more-btn' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .more-btn' => 'color: {{VALUE}};',
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
        require dirname(__FILE__) . '/' .esc_attr($settings['tmpl']).'.php';
    }

    private function icon_image($icon)
    {
        $type = $icon['type'];
        if ($type == 'image') {
            $id = $icon['img'];

            return '<span class="img-wrap">' . wp_get_attachment_image($id['id'], 'full') . '</span>';
        } else {
            return '<span class="img-wrap">' . thepack_icon_svg($icon['ico']) . '</span>';
        }
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_minibox());
