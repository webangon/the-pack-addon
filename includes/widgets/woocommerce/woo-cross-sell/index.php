<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\utils;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class The_Pack_Woo_Cross_Sell extends Widget_Base
{

    public function get_name()
    {
        return 'tp_crossell';
    }

    public function get_title()
    {
        return esc_html__('Cross sell', 'the-pack-addon');
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

    public function return_to_shop_text() {
		remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals');
	}

    protected function render()
    {
        $settings = $this->get_settings();
        if (Plugin::instance()->editor->is_edit_mode()) {
            wc_load_cart();
        }        

        //add_action( 'woocommerce_cart_collaterals', [ $this, 'return_to_shop_text' ] ,9);

        require dirname(__FILE__) . '/view.php';
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\The_Pack_Woo_Cross_Sell());
