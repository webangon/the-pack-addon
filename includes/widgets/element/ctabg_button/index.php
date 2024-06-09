<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\utils;

if (!defined('ABSPATH')) {
    exit;
}

class thepack_imgrid extends Widget_Base
{
    public function get_name()
    {
        return 'tb_imgrid';
    }

    public function get_title()
    {
        return esc_html__('CTA button', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-controls-skipforward';
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
            'ttl',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Title', 'the-pack-addon'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'sb',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Sub title', 'the-pack-addon'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'ikn',
            [
                'type' => Controls_Manager::ICONS,
                'label' => esc_html__('Icon', 'the-pack-addon'),
            ]
        );

        $repeater->add_control(
            'img',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => esc_html__('Image', 'the-pack-addon'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
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
            'btn',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Button label', 'the-pack-addon'),
                'label_block' => true,
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
                        'ttl' => esc_html__('Finance', 'the-pack-addon'),
                    ]
                ],
                'title_field' => '{{{ ttl }}}',
            ]
        );

        $this->add_control(
            'btni',
            [
                'type' => Controls_Manager::ICONS,
                'label' => esc_html__('Button icon', 'the-pack-addon'),
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
            'width',
            [
                'label' => esc_html__('Column width in %', 'the-pack-addon'),
                'type' => Controls_Manager::NUMBER,
                'default' => '33.33',
                'selectors' => [
                    '{{WRAPPER}} .items' => 'width: {{VALUE}}%;',
                ],
            ]
        );

        $this->add_control(
            'ipdy',
            [
                'label' => esc_html__('Item padding', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .items' => 'padding: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tb-imgrid' => 'margin-left:-{{SIZE}}{{UNIT}};margin-right:-{{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'anim',
            [
                'label' => esc_html__('Animation', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT,
                'options' => thepack_animations(),
                'label_block' => true
            ]
        );

        $this->add_control(
            'brad',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .item-wrap' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ovbg',
                'label' => esc_html__('Background', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .bg-overlay',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_cnt',
            [
                'label' => esc_html__('Content', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'i_pad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tbcontent' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        $this->add_responsive_control(
            'ttlmr',
            [
                'label' => esc_html__('Margin', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ttlclr',
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
                'name' => 'ttlty',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .title',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'ttltdz',
                'label' => esc_html__('Shadow', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .title',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'e2',
            [
                'label' => esc_html__('Sub', 'the-pack-addon'),
            ]
        );

        $this->add_responsive_control(
            'sbmr',
            [
                'label' => esc_html__('Margin', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .sub' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'sbclr',
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
                'name' => 'sbty',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .sub',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'e3',
            [
                'label' => esc_html__('Button', 'the-pack-addon'),
            ]
        );

        $this->add_responsive_control(
            'btnpd',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tour-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'btbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tour-btn' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tour-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bthbg',
            [
                'label' => esc_html__('Hover background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tour-btn:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bthclr',
            [
                'label' => esc_html__('Hover color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tour-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btty',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .tour-btn',
            ]
        );

        $this->add_responsive_control(
            'btrad',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tour-btn' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'btnilp',
            [
                'label' => esc_html__('Icon left spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tour-btn i' => 'padding-left: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'btnitp',
            [
                'label' => esc_html__('Icon top spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tour-btn i' => 'top: {{SIZE}}{{UNIT}};',
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

    private function content($content, $anim, $btnikn)
    {
        $out = '';
        foreach ($content as $item) {
            $link = thepack_get_that_link($item['url']);
            $bg = thepack_bg_images($item['img']['id'], 'full');
            $iconbtn = $btnikn ? '<i class="btnicon ' . $btnikn['value'] . '"></i>' : '';
            $btn = $item['url']['url'] ? '<a ' . $link . ' class="tour-btn">' . $item['btn'] . $iconbtn . '</a>' : '';
            $out .= '
                <div class="items ' . $anim . '"><div class="item-wrap">
                    <div class="inner">
                        <div class="bgwrap lazyload" ' . $bg . '></div>
                        <div class="bg-overlay"></div>
                    </div>
                    <div class="tbcontent">
                        ' . thepack_build_html($item['ttl'], 'h2', 'title') . '
                        ' . thepack_build_html($item['sb'], 'p', 'sub') . '
                        ' . $btn . '
                    </div>
                </div></div>
            ';
        }

        return thepack_build_html($out);
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_imgrid());
