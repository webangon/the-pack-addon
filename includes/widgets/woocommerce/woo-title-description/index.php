<?php
namespace ThePackAddon\Widgets;
use Elementor\Plugin;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\utils;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class The_Pack_Woo_Title_description extends Widget_Base
{

    public function get_name()
    {
        return 'tp_tdesc';
    }

    public function get_title()
    {
        return esc_html__('Title description', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-admin-network';
    }

    public function get_categories()
    {
        return ['thepack-woo'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'section_gnrl',
            [
                'label' => esc_html__('General', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'preview',
            [
                'label' => esc_html__('Preview product', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => thepack_drop_posts('product',10),
                'multiple' => false,
            ]
        );

        $this->add_control(
            'type',
            [
                'label' => esc_html__('Display type', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => [
                    'title' => esc_html__('Title', 'the-pack-addon'),
                    'desc' => esc_html__('Description', 'the-pack-addon'),
                    'short_desc' => esc_html__('Short description', 'the-pack-addon'),
                ],
                'default' => 'title'
            ]
        );

        $this->add_control(
            'tag',
            [
                'label' => esc_html__('HTML tag', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => [
                    'h1' => esc_html__('H1', 'the-pack-addon'),
                    'h2' => esc_html__('H2', 'the-pack-addon'),
                    'h3' => esc_html__('H3', 'the-pack-addon'),
                    'h4' => esc_html__('H4', 'the-pack-addon'),
                    'h5' => esc_html__('H5', 'the-pack-addon'),
                    'h6' => esc_html__('H6', 'the-pack-addon'),
                    'span' => esc_html__('Span', 'the-pack-addon'),
                    'p' => esc_html__('P', 'the-pack-addon'),
                ],
                'default' => 'p'
            ]
        );

        $this->end_controls_section();
    }


    protected function render()
    {
        $settings = $this->get_settings();
        $preview  = isset( $_GET['preview'] ) ? sanitize_text_field(wp_unslash($_GET['preview'])) : '';//phpcs:disable WordPress.Security.NonceVerification.Recommended 
        if (Plugin::instance()->editor->is_edit_mode() || $preview == 'true') {
            $product = wc_get_product($settings['preview']);        
        } else {
            global $product;
            $product = wc_get_product();            
        }         
        require dirname(__FILE__) . '/view.php';
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\The_Pack_Woo_Title_description());
