<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class thepack_img_hotspot1 extends Widget_Base
{
    public function get_name()
    {
        return 'tb_hotspot1';
    }

    public function get_title()
    {
        return esc_html__('Hotspot', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-media-archive';
    }

    public function get_categories()
    {
        return ['ashelement-addons'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_pricing_table',
            [
                'label' => esc_html__('Lists', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'img',
            [
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true,
                'label' => esc_html__('Placeholder image', 'the-pack-addon'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Title', 'the-pack-addon'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'sub',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Sub title', 'the-pack-addon'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'desc',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label' => esc_html__('Description', 'the-pack-addon'),
                'label_block' => true,
                'default' => '2020',
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'the-pack-addon' ),
                'type' => Controls_Manager::URL,
                'placeholder' => 'http://your-link.com',
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $repeater->add_control(
            'btn',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Button title', 'the-pack-addon'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'mrw',
            [
                'type' => Controls_Manager::RAW_HTML,
                'raw' => esc_html__('Marker Position', 'the-pack-addon'),
            ]
        );

        $repeater->add_control(
            'thm_c',
            [
                'label' => esc_html__('Theme color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .pulse' => 'border:2px solid {{VALUE}};',
                    '{{WRAPPER}} {{CURRENT_ITEM}} .dot' => 'background:{{VALUE}};border:2px solid {{VALUE}}',
                    '{{WRAPPER}} {{CURRENT_ITEM}} .pulsathotspot,{{WRAPPER}} {{CURRENT_ITEM}} .hotspot-red,{{WRAPPER}} {{CURRENT_ITEM}} .pulsathotspot' => 'background:{{VALUE}};',
                ],
            ]
        );

        $repeater->add_control(
            'mtpos',
            [
                'label' => esc_html__('Top spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => .05,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{SIZE}}%;',
                ],
                'size_units' => ['px'],
            ]
        );

        $repeater->add_control(
            'mlpos',
            [
                'label' => esc_html__('Left spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => .05,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{SIZE}}%;',
                ],
                'size_units' => ['%'],
            ]
        );

        $repeater->add_control(
            'ifrw',
            [
                'type' => Controls_Manager::RAW_HTML,
                'raw' => esc_html__('Info Position', 'the-pack-addon'),
            ]
        );

        $repeater->add_control(
            'infos',
            [
                'label' => esc_html__('Position', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'tb_hotspot_top' => esc_html__('Top', 'the-pack-addon'),
                    'tb_hotspot_right' => esc_html__('Right', 'the-pack-addon'),
                    'tb_hotspot_bottom' => esc_html__('Bottom', 'the-pack-addon'),
                    'tb_hotspot_left' => esc_html__('Left', 'the-pack-addon'),
                ],
            ]
        );

        $repeater->add_control(
            'preci',
            [
                'label' => esc_html__('Precision', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => 'Select',
                    'hotspot_topright' => esc_html__('Top right', 'the-pack-addon'),
                    'hotspot_topleft' => esc_html__('Top left', 'the-pack-addon'),
                    'hotspot_bottomright' => esc_html__('Bottom right', 'the-pack-addon'),
                    'hotspot_bottomleft' => esc_html__('Bottom left', 'the-pack-addon'),
                ],
            ]
        );

        $this->add_control(
            'lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'prevent_empty' => false,
                'default' => [
                    [
                        'title' => esc_html__('Awesome Product', 'the-pack-addon'),
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
            'imgov',
            [
                'label' => esc_html__('Image overlay', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tbspotimg::before' => 'background-color:{{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pointr',
            [
                'label' => esc_html__('Pointer template', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'one' => [
                        'title' => esc_html__('One', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-left', 
                    ],
                    'two' => [
                        'title' => esc_html__('Two', 'the-pack-addon'),
                        'icon' => 'eicon-v-align-top',
                    ],

                    'three' => [
                        'title' => esc_html__('Three', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-right',
                    ],

                ],
                'default' => 'one',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_dot',
            [
                'label' => esc_html__('Dot', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'dtsiz',
            [
                'label' => esc_html__('Width & height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .dot' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pulse' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_hcont',
            [
                'label' => esc_html__('Content', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'cwid',
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
                    '{{WRAPPER}} .tb_hotspot_content' => 'width: {{SIZE}}{{UNIT}};',
                ],

            ]
        );
        $this->add_control(
            'cbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tb_hotspot_content' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'cpad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tb_hotspot_content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tctb');

        $this->start_controls_tab(
            'e1',
            [
                'label' => esc_html__('Title', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'title_color',
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
                'name' => 't_typo',
                'selector' => '{{WRAPPER}} .title',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'tmar',
            [
                'label' => esc_html__('Margin', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'e2',
            [
                'label' => esc_html__('Sub', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'sb_color',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sb_typo',
                'selector' => '{{WRAPPER}} .subtitle',
                'label' => esc_html__('Typography', 'the-pack-addon'),
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
            'd_color',
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
                'name' => 'd_typo',
                'selector' => '{{WRAPPER}} .desc',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'dmar',
            [
                'label' => esc_html__('Margin', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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
            'btn_pad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],

                'selectors' => [
                    '{{WRAPPER}} .hpspot-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typo',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .hpspot-btn',
            ]
        );

        $this->add_control(
            'btn_bgl',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hpspot-btn' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_bgh',
            [
                'label' => esc_html__('Hover Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hpspot-btn:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_clr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hpspot-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_clrh',
            [
                'label' => esc_html__('Hover Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hpspot-btn:hover' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .hpspot-btn' => 'border-width: {{SIZE}}{{UNIT}};border-style:solid;',
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
                    '{{WRAPPER}} .hpspot-btn' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'btn_bclr',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hpspot-btn' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_bclrh',
            [
                'label' => esc_html__('Hover Border Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hpspot-btn:hover' => 'border-color: {{VALUE}};',
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
        require dirname(__FILE__) . '/view.php';
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_img_hotspot1());
