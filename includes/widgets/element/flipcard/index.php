<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\utils;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class thepack_flipcard extends Widget_Base
{
    public function get_name()
    {
        return 'tb_flipcard';
    }

    public function get_title()
    {
        return esc_html__('Flip Card', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-welcome-add-page';
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
            'fhead',
            [
                'label' => esc_html__('Front Heading', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Super fast service',
            ]
        );

        $repeater1->add_control(
            'fdesc',
            [
                'label' => esc_html__('Front Description', 'the-pack-addon'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $repeater1->add_control(
            'ftype',
            [
                'label' => esc_html__('Front background type', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'fimg' => [
                        'title' => esc_html__('Image', 'the-pack-addon'),
                        'icon' => ' eicon-document-file',
                    ],
                    'fclr' => [
                        'title' => esc_html__('Color', 'the-pack-addon'),
                        'icon' => 'eicon-image-rollover',
                    ]
                ],
                'default' => 'fimg',
                'label_block' => true,
            ]
        );

        $repeater1->add_control(
            'fimgs',
            [
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true,
                'label' => esc_html__('Background image', 'the-pack-addon'),
                'condition' => [
                    'ftype' => 'fimg',
                ],
            ]
        );

        $repeater1->add_control(
            'fclrs',
            [
                'label' => esc_html__('Background color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'ftype' => 'fclr',
                ],
            ]
        );

        $repeater1->add_control(
            'btn',
            [
                'label' => esc_html__('Back button title', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Read More',
            ]
        );

        $repeater1->add_control(
            'url',
            [
                'label' => esc_html__('Back button url', 'the-pack-addon'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => esc_html__('http://your-link.com', 'the-pack-addon'),
            ]
        );

        $repeater1->add_control(
            'btype',
            [
                'label' => esc_html__('Back background type', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'bimg' => [
                        'title' => esc_html__('Image', 'the-pack-addon'),
                        'icon' => ' eicon-document-file',
                    ],
                    'bclr' => [
                        'title' => esc_html__('Color', 'the-pack-addon'),
                        'icon' => 'eicon-image-rollover',
                    ]
                ],
                'default' => 'bimg',
                'label_block' => true,
            ]
        );

        $repeater1->add_control(
            'bimgs',
            [
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true,
                'label' => esc_html__('Background image', 'the-pack-addon'),
                'condition' => [
                    'btype' => 'bimg',
                ],
            ]
        );

        $repeater1->add_control(
            'bclrs',
            [
                'label' => esc_html__('Background color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'btype' => 'bclr',
                ],
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
                        'fhead' => esc_html__('Mr Wick', 'the-pack-addon'),
                    ]
                ],
                'title_field' => '{{{fhead}}}',
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
            'animation',
            [
                'label' => esc_html__('Animation', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT,
                'options' => thepack_animations(),
                'label_block' => true
            ]
        );

        $this->add_responsive_control(
            'avtr_lpad',
            [
                'label' => esc_html__('Minimum height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 800,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['%', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .tb-flip-outer' => 'height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .tb-flip-outer' => 'width: {{VALUE}}%;',
                ],
            ]
        );

        $this->add_responsive_control(
            'itse',
            [
                'label' => esc_html__('Item spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tb-flip-outer' => 'padding: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .flip-wraper1' => 'margin-left: -{{SIZE}}{{UNIT}};margin-right: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'r1',
            [
                'type' => Controls_Manager::RAW_HTML,
                'raw' => esc_html__('Front overlay', 'the-pack-addon'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'fover',
                'label' => esc_html__('Background', 'elementor'),
                'types' => ['none', 'classic', 'gradient'],
                'selector' => '{{WRAPPER}} .tb-card-front::before',
            ]
        );

        $this->add_control(
            'b1',
            [
                'type' => Controls_Manager::RAW_HTML,
                'raw' => esc_html__('Back overlay', 'the-pack-addon'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'bover',
                'label' => esc_html__('Background', 'elementor'),
                'types' => ['none', 'classic', 'gradient'],
                'selector' => '{{WRAPPER}} .tb-card-back::before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_head',
            [
                'label' => esc_html__('Heading', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'h_clr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .heading' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'h_mr',
            [
                'label' => esc_html__('Margin', 'elementor'),
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

        $this->end_controls_section();

        $this->start_controls_section(
            'section_quote',
            [
                'label' => esc_html__('Description', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'q_clr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'q_pad',
            [
                'label' => esc_html__('Margin', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'q_typo',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .desc',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_btns',
            [
                'label' => esc_html__('Button Link', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'b_clr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tb-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'b_bg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tb-button' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'bt_typo',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .tb-button',
            ]
        );

        $this->add_control(
            'bt_pad',
            [
                'label' => esc_html__('Padding', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tb-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

    private function content($content, $column)
    {
        $out1 = '';
        foreach ($content as $item) {
            $heading = $item['fhead'] ? '<h3 class="heading">' . $item['fhead'] . '</h3>' : '';
            $desc = $item['fdesc'] ? '<p class="desc">' . $item['fdesc'] . '</p>' : '';
            $bg = $item['ftype'] == 'fimg' ? 'style="background-image:url(' . $item['fimgs']['url'] . ')"' : 'style="background:' . $item['fclrs'] . '"';

            $bbg = $item['btype'] == 'bimg' ? 'style="background-image:url(' . $item['bimgs']['url'] . ')"' : 'style="background:' . $item['bclrs'] . '"';

            $url = thepack_get_that_link($item['url']);
            $btn = $item['btn'] ? '<a ' . $url . ' class="tb-button">' . $item['btn'] . '</a>' : '';

            $out1 .= '
                <div class="tb-flip-outer ' . $column . '">
                    <div class="tb-card-flipwr">
                        <div class="tb-card-front" ' . $bg . '>
                            <div class="tb-card-front-inner">
                                ' . $heading . '
                                ' . $desc . '
                            </div>
                            <div class="tb-flipovrly"></div>
                        </div>
                        <div class="tb-card-back" ' . $bbg . '>
                            <div class="tb-card-back-inner">' . $btn . '</div>
                            <div class="tb-flipovrly"></div>
                        </div>
                    </div>
                </div>
            ';
        }

        return $out1;
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_flipcard());
