<?php
namespace ThePackAddon\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Background;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class thepack_vertical_lines extends Widget_Base
{
    public function get_name()
    {
        return 'tpvl';
    }

    public function get_title()
    {
        return esc_html__('Vertical lines', 'the-pack-addon');
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

        $this->add_responsive_control(
            'num',
            [
                'label' => esc_html__('Number of lines', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
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
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'lc',
                'selector' => '{{WRAPPER}} .tp-line-animated>span',
				'fields_options' => [
					'background' => [
						'label' => esc_html__( 'Line color','the-pack-addon' ),
					]
				]                  
            ]
        );  
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'lcr',
                'selector' => '{{WRAPPER}} .tp-line-animated>span:before',
				'fields_options' => [
					'background' => [
						'label' => esc_html__( 'Animated background','the-pack-addon' ),
					]
				]                  
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

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_vertical_lines());
