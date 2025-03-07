<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class thepack_lazy_content extends Widget_Base
{
    public function get_name()
    {
        return 'tblazycontent';
    }

    public function get_title()
    {
        return esc_html__('Lazy content', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-image-crop';
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

        $this->add_control(
            'type',
            [
                'label' => esc_html__( 'Source type', 'the-pack-addon' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => 'true',
                'default' => [ 'img'],
                'options' => [
                    'img' => esc_html__( 'Image', 'the-pack-addon' ),
                    'iframe' => esc_html__( 'Iframe', 'the-pack-addon' ),
                ],
            ]
        );

        $this->add_control(
            'img',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => esc_html__('Image', 'the-pack-addon'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'type' => 'img',
                ],                
            ]
        );

        $this->add_control(
            'iframe',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label' => esc_html__('Iframe', 'the-pack-addon'),
                'condition' => [
                    'type' => 'iframe',
                ],                
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

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings();
        require dirname(__FILE__) . '/view.php';
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_lazy_content());
