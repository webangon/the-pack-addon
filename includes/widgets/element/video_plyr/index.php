<?php
namespace ThePackAddon\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Utils;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class thepack_video_popup extends Widget_Base
{
    public function get_name()
    {
        return 'tp_plyr_video';
    }

    public function get_title()
    {
        return esc_html__('Plyr Video', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-tickets';
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
                'label' => esc_html__('Video Popup', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'source',
            [
                'label' => esc_html__('Video source', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT,
                'default' => 'yt',
                'label_block' => true,
                'options' => [
                    'yt' => esc_html__('Youtube', 'the-pack-addon'),
                    'vm' => esc_html__('Vimeo', 'the-pack-addon'),
                    'sht' => esc_html__('Self hosted', 'the-pack-addon'),
                ]
            ]
        );

        $this->add_control(
            'url',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label' => esc_html__('Video link', 'the-pack-addon'),
                'label_block' => true,
                'default' => 'https://www.youtube.com/embed/ABYoaAH6OlI',
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
            'brad',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .plyr--video' => 'border-radius: {{SIZE}}{{UNIT}};',
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

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_video_popup());
