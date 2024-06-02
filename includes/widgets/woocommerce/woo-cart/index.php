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

class The_Pack_Woo_Cart_Total extends Widget_Base
{

    public function get_name()
    {
        return 'tp_woocart';
    }

    public function get_title()
    {
        return esc_html__('Woo cart', 'the-pack-addon');
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

        $this->start_controls_section(
            'section_gnrl',
            [
                'label' => esc_html__('General', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'l_typo',
                'selector' => '{{WRAPPER}} .shop_table tr th',
                'label' => esc_html__('Label typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'lclr',
            [
                'label' => esc_html__('Label color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .shop_table tr th' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'p_typo',
                'selector' => '{{WRAPPER}} .woocommerce-Price-amount',
                'label' => esc_html__('Price typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'pclr',
            [
                'label' => esc_html__('Price color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-Price-amount' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs('ixt');

        $this->start_controls_tab(
            'ixt2',
            [
                'label' => esc_html__('Cross', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'crclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a.remove' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'crbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a.remove' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'crbclr',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a.remove' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'crwid',
            [
                'label' => esc_html__('Width & height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} a.remove' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'crfs',
            [
                'label' => esc_html__('Font size', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} a.remove' => 'font-size: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ixt3',
            [
                'label' => esc_html__('Image', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'thwid',
            [
                'label' => esc_html__('Width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} table.cart img' => 'width: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ixt4',
            [
                'label' => esc_html__('Title', 'the-pack-addon'),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 't_typo',
                'selector' => '{{WRAPPER}} .product-name a',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'tclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .product-name a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ixt1',
            [
                'label' => esc_html__('Qty', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'qtbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .qty,{{WRAPPER}} .qtbtn' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'qtklr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .qty,{{WRAPPER}} .qtbtn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'qt_typo',
                'selector' => '{{WRAPPER}} .qty,{{WRAPPER}} .qtbtn',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'qtwid',
            [
                'label' => esc_html__('Input width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .quantity .qty' => 'width: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'qtht',
            [
                'label' => esc_html__('Input height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .quantity .qty' => 'height: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'qtbclr',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .qtbtn' => 'border:1px solid {{VALUE}};',
                    '{{WRAPPER}} .qty' => 'border-top-color:{{VALUE}};border-bottom-color:{{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'qitht',
            [
                'label' => esc_html__('Plus/minus width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .qtbtn' => 'width: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_lbl',
            [
                'label' => esc_html__('Button', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'btpd',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .wp-element-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    
                ],
            ]
        );

        $this->add_control(
            'btbrad',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .wp-element-button' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'bt_typo',
                'selector' => '{{WRAPPER}} .wp-element-button',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'btbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wp-element-button' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wp-element-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_cpn',
            [
                'label' => esc_html__('Coupon', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'cpwid',
            [
                'label' => esc_html__('Width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],

                ],                
                'selectors' => [ 
                    '{{WRAPPER}} #coupon_code' => 'width: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'cpbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #coupon_code' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'cpclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #coupon_code' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    public function return_to_shop_text() {
		remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals');
	}

    public function minus() {
		echo '<button type="button" class="minus qtbtn" >-</button>';
	}

    public function plus() {
		echo '<button type="button" class="plus qtbtn" >+</button>';
	}

    protected function render()
    {
        $settings = $this->get_settings();
        if (Plugin::instance()->editor->is_edit_mode()) {
            wc_load_cart();
        }        
  
        remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
 
        add_action( 'woocommerce_cart_collaterals', [ $this, 'return_to_shop_text' ] ,9);

        add_action( 'woocommerce_before_quantity_input_field', [ $this, 'minus' ] ,9);

        add_action( 'woocommerce_after_quantity_input_field', [ $this, 'plus' ] ,9);
 
        require dirname(__FILE__) . '/view.php';
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\The_Pack_Woo_Cart_Total());
