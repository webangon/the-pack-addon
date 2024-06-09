<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
    exit;
}

class tp_hoverbg_full extends Widget_Base
{
    public function get_name()
    {
        return 'tp-hvrbg';
    }

    public function get_title()
    {
        return esc_html__('Hover background', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'eicon-form-horizontal';
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
                'label' => esc_html__('Subtitle', 'the-pack-addon'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'btnlbl',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Button label', 'the-pack-addon'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'url',
            [
                'label' => esc_html__('Link', 'the-pack-addon'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => 'https://profiles.wordpress.org/webangon/',
                ],
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
            'section_settings',
            [
                'label' => esc_html__('Style', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'govclr',
            [
                'label' => esc_html__('Overlay', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'gohclr',
            [
                'label' => esc_html__('Hover overlay', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item.current' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gobglr',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tphoverfullscreen .item' => 'border-right-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gmx',
            [
                'label' => esc_html__('Height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 800,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['px', 'vh'],
                'selectors' => [
                    '{{WRAPPER}} .item' => 'height: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_conty',
            [
                'label' => esc_html__('Content', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('gt');

        $this->start_controls_tab(
            'e1',
            [
                'label' => esc_html__('Pre', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'pclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sub' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ptyp',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .sub',
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
            't_mg',
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

        $this->end_controls_tab();

        $this->start_controls_tab(
            'e3',
            [
                'label' => esc_html__('Button', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'btkl',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tpbtn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'by_pd',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tpbtn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'bt_typo',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .tpbtn',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();
        require dirname(__FILE__) . '/one.php';
    }

    private function content($content, $bg = '')
    {
        $info = $background = '';
        $first = 0;
        foreach ($content as $item) {
            $first++;
            $first_element = $first == '1' ? 'current' : '';
            $imagebg = thepack_bg_images($item['bg']['id'], 'full');
            $link = thepack_get_that_link($item['url']);
            $btn = $item['btnlbl'] ? '<a class="tpbtn" ' . $link . '>' . $item['btnlbl'] . '</a>' : '';
            $info .= '
                <div class="item ' . $first_element . '" data-tab="tab-' . $first . '">
                    <div class="info">
                        ' . thepack_build_html($item['sub'], 'span', 'sub') . '
                        ' . thepack_build_html($item['title'], 'h3', 'title') . '
                        ' . $btn . '
                    </div>
                </div>
            ';
            $background .= '
                <div id="tab-' . $first . '" class="lazyload tpimg ' . $first_element . '" ' . $imagebg . '></div>
            ';
        }

        return $bg ? thepack_build_html($background) : thepack_build_html($info);
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\tp_hoverbg_full());
