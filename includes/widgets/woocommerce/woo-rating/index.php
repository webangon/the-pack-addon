<?php
namespace ThePackAddon\Widgets;

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

class The_Pack_Woo_Rating extends Widget_Base
{
	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );
		$this->the_hooks();
	}

    public function get_name()
    {
        return 'tp_woorating';
    }

    public function get_title()
    {
        return esc_html__('Woo rating', 'the-pack-addon');
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
            'section_options',
            [
                'label' => esc_html__('Options', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'hide',
            [
                'label' => esc_html__('Show if no rating', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER
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
            'hide_txt',
            [
                'label' => esc_html__('Hide text', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .count' => 'display: none;',
                ],                
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_stng',
            [
                'label' => esc_html__('Rating', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'rt_fs',
            [
                'label' => esc_html__('Font size', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER, 
                                                                           
               'selectors' => [
                    '{{WRAPPER}} .tscore' => 'font-size:{{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'rt_clr',
            [
                'label' => esc_html__('Main color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,            
                'selectors' => [
                    '{{WRAPPER}} .tscore' => 'color:{{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'rt_aclr',
            [
                'label' => esc_html__('Active color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,            
                'selectors' => [
                    '{{WRAPPER}} .tscore span' => 'color:{{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_rtng',
            [
                'label' => esc_html__('Rating', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'hide_txt!' => 'yes',
                ],                
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ttypo',
                'selector' => '{{WRAPPER}} .count',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            't_col',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .count' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    public function the_hooks( $control = null ) {
		if ( ! $control ) {
			return;
		}
	}

    protected function render()
    {
        $settings = $this->get_settings();
        $controllers = $this->get_settings_for_display();
        require dirname(__FILE__) . '/view.php';
        $this->the_hooks(  $controllers );
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\The_Pack_Woo_Rating());
