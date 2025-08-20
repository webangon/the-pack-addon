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
} // Exit if accessed directly

class thepack_folio_hover extends Widget_Base
{
    public function get_name()
    {
        return 'tb_foliohvr';
    }

    public function get_title()
    {
        return esc_html__('Hover background', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-undo';
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
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Label', 'the-pack-addon'),
                'label_block' => true,
                'default' => 'Leader in Business',
            ]
        );

        $repeater->add_control(
            'cat',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Category', 'the-pack-addon'),
                'label_block' => true,
                'default' => 'Interior',
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

        $repeater->add_control(
            'bg',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => esc_html__('Background', 'the-pack-addon'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
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
                        'title' => esc_html__('Leader in Business', 'the-pack-addon'),
                    ]
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_gnrl',
            [
                'label' => esc_html__('General', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
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
            'speed',
            [
                'label' => esc_html__('Autoplay speed', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 4500,
                        'step' => 1,
                    ]
                ],
                'condition' => [
                    'auto' => 'yes',
                ],
                'default' => [
                    'size' => 1800,
                ],
            ]
        );

        $this->add_responsive_control(
            'max-width',
            [
                'label' => esc_html__('Max wrapper', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 900,
                        'max' => 1500,
                        'step' => 1,
                    ]
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .assex-wrap' => 'max-width: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'wrppdft',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1500,
                        'step' => 1,
                    ]
                ],
                'size_units' => ['px', '%', 'vh'],
                'selectors' => [
                    '{{WRAPPER}} .bari_assex_slider' => 'padding: {{SIZE}}{{UNIT}} 0px;',
                ],

            ]
        );

        $this->add_responsive_control(
            'wrpwidt',
            [
                'label' => esc_html__('Height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1500,
                        'step' => 1,
                    ]
                ],
                'size_units' => ['px', '%', 'vh'],
                'selectors' => [
                    '{{WRAPPER}} .bari_assex_slider' => 'height: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'itwidth',
            [
                'label' => esc_html__('Item width in %', 'the-pack-addon'),
                'type' => Controls_Manager::NUMBER,
                'default' => '33.33',
                'selectors' => [
                    '{{WRAPPER}} .post-item' => 'width: {{VALUE}}%;',
                ],
            ]
        );

        $this->add_responsive_control(
            'box-spacing',
            [
                'label' => esc_html__('Box spacing', 'the-pack-addon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .post-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .assex-wrap' => 'margin-left: -{{LEFT}}{{UNIT}};margin-right: -{{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ovbg',
            [
                'label' => esc_html__('Overlay color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-bg::before' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'pclr',
            [
                'label' => esc_html__('Primary color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-content' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .title,{{WRAPPER}} .cat' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'sndclr',
            [
                'label' => esc_html__('Second color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-content:hover,{{WRAPPER}} .post-item.active .post-content' => 'border-color: {{VALUE}};background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'itmmxh',
            [
                'label' => esc_html__('Height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ]
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .post-content' => 'height: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'itmpads',
            [
                'label' => esc_html__('Padding', 'the-pack-addon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                /*'allowed_dimensions'=>['left','right'],*/
                'selectors' => [
                    '{{WRAPPER}} .post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            't_mar',
            [
                'label' => esc_html__('Margin', 'the-pack-addon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        $this->end_controls_section();

        $this->start_controls_section(
            'section_cat',
            [
                'label' => esc_html__('Category', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'c_typo',
                'selector' => '{{WRAPPER}} .cat',
                'label' => esc_html__('Typography', 'the-pack-addon'),
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

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_folio_hover());
