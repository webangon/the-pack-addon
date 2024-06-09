<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\utils;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class thepack_timeline_alt extends Widget_Base
{
    public function get_name()
    {
        return 'tb_timeline_alt';
    }

    public function get_title()
    {
        return esc_html__('Timeline alt', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-share-alt';
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
            'title',
            [
                'label' => esc_html__('Title', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Geek Tech Meetup',
            ]
        );

        $repeater->add_control(
            'year',
            [
                'label' => esc_html__('Year', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '2018',
            ]
        );

        $repeater->add_control(
            'desc',
            [
                'label' => esc_html__('Description', 'the-pack-addon'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Going that gable-ended Spouter-Inn, you found yourself in a wide, low, struggling entry with wainscots, reminding one of the burden of some condemned new craft.',
            ]
        );

        $repeater->add_control(
            'avatar',
            [
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true,
                'label' => esc_html__('Avatar', 'the-pack-addon'),
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
                        'title' => esc_html__('Geek Tech Meetup', 'the-pack-addon'),
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
        $this->add_responsive_control(
            'g_pad',
            [
                'label' => esc_html__('Item padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .timeline-panel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        $this->add_responsive_control(
            'g_wid',
            [
                'label' => esc_html__('Item width %', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .timeline-panel' => 'width: {{SIZE}}%;',
                ],
            ]
        );

        $this->add_responsive_control(
            'dot_wid',
            [
                'label' => esc_html__('Item bottom spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tb_tlinealt li:not(:last-child)' => 'margin-bottom: {{SIZE}}px;',
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
            't_margin',
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

        $this->end_controls_section();

        $this->start_controls_section(
            'section_year',
            [
                'label' => esc_html__('Year', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'num_ty',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .year',
            ]
        );

        $this->add_control(
            'num_c',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .year' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'num_margin',
            [
                'label' => esc_html__('Margin', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .year' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_desc',
            [
                'label' => esc_html__('Description', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'des_typo',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .desc',
            ]
        );

        $this->add_control(
            'des_color',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'des_margin',
            [
                'label' => esc_html__('Margin', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            'imgw',
            [
                'label' => esc_html__('Width & height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tl-circ' => 'width:{{SIZE}}px;height:{{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'imgbdr',
            [
                'label' => esc_html__('Border radisu', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tl-circ img' => 'border-radius:{{SIZE}}px;',
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

    private function content($content, $anim)
    {
        $i = 0;
        $out = '';
        foreach ($content as $item) {
            $i++;
            $title = $item['title'] ? '<h3 class="title">' . $item['title'] . '</h3>' : '';
            $year = $item['year'] ? '<span class="year">' . $item['year'] . '</span>' : '';
            $desc = $item['desc'] ? '<p class="desc">' . $item['desc'] . '</p>' : '';

            $avatar = $item['avatar']['id'] ? thepack_ft_images($item['avatar']['id'], 'full') : '';

            if ($i % 2) {
                $cls = ' class="' . esc_attr($anim) . '"';
            } else {
                $cls = ' class="timeline-inverted ' . esc_attr($anim) . '"';
            }

            $out .= '
                <li' . $cls . '>
                  <div class="tl-circ">' . $avatar . '</div>
                  <div class="timeline-panel">
                    ' . $title . $year . $desc . '
                  </div>
                </li>
            ';
        }

        return thepack_build_html($out);
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_timeline_alt());
