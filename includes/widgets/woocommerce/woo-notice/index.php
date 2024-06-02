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

class The_Pack_Woo_Notice extends Widget_Base
{
	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );
		$this->the_hooks();
	}

    public function get_name()
    {
        return 'tp_woonotice';
    }

    public function get_title()
    {
        return esc_html__('Woo notice', 'the-pack-addon');
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

$widgets_manager->register(new \ThePackAddon\Widgets\The_Pack_Woo_Notice());
