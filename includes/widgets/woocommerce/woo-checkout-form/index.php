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

class The_Pack_Woo_Billing_Form extends Widget_Base
{

    public function get_name()
    {
        return 'tp_woocheckout';
    }

    public function get_title()
    {
        return esc_html__('Checkout form', 'the-pack-addon');
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

        $this->add_responsive_control(
            'cnwid',
            [
                'label' => esc_html__('Content width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 67,
                ],                
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .woocommerce-cart-form,{{WRAPPER}} .woocommerce-checkout #customer_details' => 'width: {{SIZE}}%;',
                ],

            ]
        );

        $this->add_responsive_control(
            'cnrpad',
            [
                'label' => esc_html__('Content right spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 30,
                ],                
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .woocommerce-cart-form,{{WRAPPER}} .woocommerce-checkout #customer_details' => 'padding-right: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'sbwid',
            [
                'label' => esc_html__('Sidebar width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 33,
                ],                
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-checkout #order_review' => 'width: {{SIZE}}%;',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 't_typo',
                'selector' => '{{WRAPPER}} h3,{{WRAPPER}} .create-account label',
                'label' => esc_html__('Heading typography', 'the-pack-addon'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_inp',
            [
                'label' => esc_html__('Input Fields', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'inbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} input.input-text,{{WRAPPER}} .select2-selection--single,{{WRAPPER}} #order_comments' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'inclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} input.input-text,{{WRAPPER}} .select2-selection__rendered' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'inplh',
            [
                'label' => esc_html__('Place holder', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .input-text::-webkit-input-placeholder' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'inpd',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px'],
                'selectors' => [
                    '{{WRAPPER}} input.input-text,{{WRAPPER}} .select2-selection--single' => 'height:inherit;padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .select2-selection__arrow' => 'right: {{RIGHT}}{{UNIT}};',
                    
                ],
            ]
        );

        $this->add_control(
            'inbr',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .input-text,{{WRAPPER}} .select2-selection--single' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'inbclr',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .input-text,{{WRAPPER}} .select2-selection--single' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hide_lbl',
            [
                'type' => Controls_Manager::SWITCHER,
                'label' => esc_html__('Hide label', 'the-pack-addon'),
                'selectors' => [
                    '{{WRAPPER}} label:not(.checkbox)' => 'display: none;',
                ],                
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'lb_typo',
                'selector' => '{{WRAPPER}} .woocommerce-billing-fields label:not(.checkbox),{{WRAPPER}} .woocommerce-form-login label',
                'label' => esc_html__('Label typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'lbclr',
            [
                'label' => esc_html__('Label Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-billing-fields label:not(.checkbox),{{WRAPPER}} .woocommerce-form-login label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_login',
            [
                'label' => esc_html__('Login/Coupon/Error Message', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'fmbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-NoticeGroup,{{WRAPPER}} .woocommerce-form-coupon,{{WRAPPER}} .woocommerce-form' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'fmad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-NoticeGroup,{{WRAPPER}} .woocommerce-form-coupon,{{WRAPPER}} .woocommerce-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'fmdr',
                'label' => esc_html__('Border', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .woocommerce-NoticeGroup,{{WRAPPER}} .woocommerce-form-coupon,{{WRAPPER}} .woocommerce-form',
            ]
        );

        $this->add_control(
            'fmbr',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-NoticeGroup,{{WRAPPER}} .woocommerce-form-coupon,{{WRAPPER}} .woocommerce-form' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->start_controls_tabs('ixt');

        $this->start_controls_tab(
            'ixt1',
            [
                'label' => esc_html__('Label', 'the-pack-addon'),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'hlb_typ',
                'selector' => '{{WRAPPER}} .woocommerce-info',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'hlb_clr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-info' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hlbl_clr',
            [
                'label' => esc_html__('Link color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-info a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ixt2',
            [
                'label' => esc_html__('Form', 'the-pack-addon'),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fi_typ',
                'selector' => '{{WRAPPER}} .woocommerce-form p',
                'label' => esc_html__('Text typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'fi_clr',
            [
                'label' => esc_html__('Text color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-form p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_msg',
            [
                'label' => esc_html__('Form message', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fm_typo',
                'selector' => '{{WRAPPER}} .woocommerce-NoticeGroup',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_sbr',
            [
                'label' => esc_html__('Sidebar', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sbbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #order_review' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'spad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px'],
                'selectors' => [
                    '{{WRAPPER}} #order_review' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'sbdr',
                'label' => esc_html__('Border', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} #order_review',
            ]
        );

        $this->add_control(
            'sdbr',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} #order_review' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->start_controls_tabs('itb');

        $this->start_controls_tab(
            'itb1',
            [
                'label' => esc_html__('Table', 'the-pack-addon'),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'th_typo',
                'selector' => '{{WRAPPER}} .shop_table thead tr,{{WRAPPER}} .cart-subtotal,{{WRAPPER}} .shipping th,{{WRAPPER}} .order-total',
                'label' => esc_html__('Label typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'th_clr',
            [
                'label' => esc_html__('Label color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .shop_table thead tr,{{WRAPPER}} .cart-subtotal,{{WRAPPER}} .shipping th,{{WRAPPER}} .order-total' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tc_typo',
                'selector' => '{{WRAPPER}} .cart_item,{{WRAPPER}} .woocommerce-shipping-methods label',
                'label' => esc_html__('Content typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'tc_clr',
            [
                'label' => esc_html__('Content color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart_item,{{WRAPPER}} .woocommerce-shipping-methods label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'itb2',
            [
                'label' => esc_html__('Payment', 'the-pack-addon'),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'py_typo',
                'selector' => '{{WRAPPER}} .wc_payment_method label',
                'label' => esc_html__('Label typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'pyclr',
            [
                'label' => esc_html__('Label Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wc_payment_method label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pyc_typo',
                'selector' => '{{WRAPPER}} .wc_payment_method .payment_box p',
                'label' => esc_html__('Content typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'pyrclr',
            [
                'label' => esc_html__('Content Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wc_payment_method .payment_box p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'itb3',
            [
                'label' => esc_html__('Button', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'btbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .button.wp-element-button' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .button.wp-element-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btyp',
                'selector' => '{{WRAPPER}} .button.wp-element-button',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'btht',
            [
                'label' => esc_html__('Height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .button.wp-element-button' => 'height: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    public function override_billing_checkout_fields( $fields ) {
        $fields['billing']['billing_phone']['placeholder'] = 'Phone*';
        $fields['billing']['billing_email']['placeholder'] = 'Email*';
        return $fields;
	}

    public function override_default_address_checkout_fields( $address_fields ) {
        $address_fields['first_name']['placeholder'] = 'First name*';
        $address_fields['last_name']['placeholder'] = 'Last name*';
        $address_fields['company']['placeholder'] = 'Company';
        $address_fields['address_1']['placeholder'] = 'Adresse';
        $address_fields['state']['placeholder'] = 'Stat';
        $address_fields['postcode']['placeholder'] = 'ZIP Code*';
        $address_fields['city']['placeholder'] = 'By';
        return $address_fields;
    }

    public function product_page_script() {
		?>
		<script type="text/javascript">
			jQuery(function($) {
				jQuery('#customer_details').before('<div class="woocommerce-NoticeGroup woocommerce-NoticeGroup-checkout"><ul class="woocommerce-error" role="alert"><li data-id="billing_first_name"><strong>Billing First name</strong> is a required field. </li></ul></div>');
			});
		</script>
		<?php 
	} 

    protected function render()
    {
        $settings = $this->get_settings();
        if (Plugin::instance()->editor->is_edit_mode()) {
            wc_load_cart();
        }
        add_action( 'woocommerce_checkout_fields', [ $this, 'override_billing_checkout_fields' ] ,20,1);
        add_filter( 'woocommerce_default_address_fields', [ $this, 'override_default_address_checkout_fields' ] ,20,1);

        require dirname(__FILE__) . '/view.php';
        if (Plugin::instance()->editor->is_edit_mode()) {
            $this->product_page_script();
        }
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\The_Pack_Woo_Billing_Form());
