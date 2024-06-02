<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class thepack_syntax_highlight extends Widget_Base
{
    public function get_name()
    {
        return 'tp-syn-hightlighter';
    }

    public function get_title()
    {
        return esc_html__('Syntax highlight', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-universal-access-alt';
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
                'label' => esc_html__('Content', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'code',
            [
                'type' => Controls_Manager::CODE,
                'label' => esc_html__('Code', 'the-pack-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'lang',
            [
                'label' => esc_html__('Language', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT,
                'default' => 'css',
                'options' => [
                    'html' => esc_html__('Html', 'the-pack-addon'),
                    'php' => esc_html__('Php', 'the-pack-addon'),
                    'js' => esc_html__('Js', 'the-pack-addon'),
                    'sql' => esc_html__('Sql', 'the-pack-addon'),
                    'css' => esc_html__('Css', 'the-pack-addon'),
                ],
            ]
        );

        $this->add_control(
            'source',
            [
                'label' => esc_html__('Show source', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
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

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_syntax_highlight());
