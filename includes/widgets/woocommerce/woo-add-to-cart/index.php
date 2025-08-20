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

class The_Pack_Woo_Add_To_Cart extends Widget_Base
{
    public function get_name()
    {
        return 'tp_wooaddtocart';
    }

    public function get_title()
    {
        return esc_html__('Woo add to cart', 'the-pack-addon');
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
            'action',
            [
                'label' => esc_html__('Click action', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__('Do nothing', 'the-pack-addon'),
                    'cart' => esc_html__('Redirect to cart', 'the-pack-addon'),
                    'checkout' => esc_html__('Redirect to checkout', 'the-pack-addon'),
                ]
            ]
        );

        $this->add_control(
            'hide_stock',
            [
                'label' => esc_html__('Hide stock message', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
            ] 
        );

        $this->add_control(
            'btnuz',
            [
                'label' => esc_html__('Use as single product', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
            ] 
        );

        $this->add_control(
            'cart_txt',
            [
                'label' => esc_html__('Add to cart label', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ] 
        );

        $this->add_control(
            'cart_txt_ex',
            [
                'label' => esc_html__('External add to cart label', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ] 
        );

        $this->add_control(
            'cicon',
            [
                'type' => Controls_Manager::ICONS,
                'label' => esc_html__('Cart icon', 'the-pack-addon'),
                'default' => [
                    'value' => 'fas fa-cart-plus',
                    'library' => 'solid',
                ],
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
            'gap',
            [
                'label' => esc_html__('Gap', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} form.cart,{{WRAPPER}} .woocommerce-variation-add-to-cart' => 'gap: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} form.cart:not(.variations_form) .quantity' => 'margin-left: -{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} form.cart:not(.variations_form) .tp-add-to-cart' => 'margin-right: -{{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'btht',
            [
                'label' => esc_html__('Height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .single_add_to_cart_button' => 'height: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'hdqt',
            [
                'label' => esc_html__('Hide quantity', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .quantity' => 'display: none;',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_btn',
            [
                'label' => esc_html__('Button', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'btnflw',
            [
                'label' => esc_html__('Full width button', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .tpsinglecart form.cart' => 'flex-wrap:wrap;',
                ],                
            ] 
        );

        $this->add_control(
            'btnips',
            [
                'label' => esc_html__('Left icon', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .single_add_to_cart_button' => 'flex-direction:row-reverse;',
                ],                
            ] 
        );

        $this->add_control(
            'btbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single_add_to_cart_button,{{WRAPPER}} .wc-forward' => 'background: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'btclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single_add_to_cart_button,{{WRAPPER}} .wc-forward' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btbgh',
            [
                'label' => esc_html__('Hover background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single_add_to_cart_button:hover,{{WRAPPER}} .wc-forward:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btclrh',
            [
                'label' => esc_html__('Hover color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single_add_to_cart_button:hover,{{WRAPPER}} .wc-forward:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btyp',
                'selector' => '{{WRAPPER}} .single_add_to_cart_button,{{WRAPPER}} .wc-forward',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'btbr',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .single_add_to_cart_button,{{WRAPPER}} .wc-forward' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_qty',
            [
                'label' => esc_html__('Quantity', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
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

        $this->end_controls_section();        
    }

    public function minus() {
		echo '<button type="button" class="minus qtbtn" >-</button>';
	}

    public function plus() {
		echo '<button type="button" class="plus qtbtn" >+</button>';
	}


    public function single_add_cart(){
        global $product;
        $product_type = $product->get_type();
        $settings = $this->get_settings();

        if (is_product ()) {
            switch ( $product_type ) {
                case 'external':
                    return $settings['cart_txt_ex'];
    
                break;
                case 'grouped':
                    return $settings['cart_txt'];
    
                break;
                case 'simple':
                    return $settings['cart_txt'];
    
                break;
                case 'variable':
                    return $settings['cart_txt'];
    
                break;
                default:
                    return esc_html__( 'Read More', 'the-pack-addon' );
            }
        }
    }

    public function start_btn_wrap(){
        echo '<div class="tp-add-to-cart">'; 
    }

    public function end_btn_wrap(){
        echo '</div>'; 
    }

    protected function render()
    {    
        $settings = $this->get_settings();
        global $product;
        add_action( 'woocommerce_before_quantity_input_field', [ $this, 'minus' ] ,9);
        add_action( 'woocommerce_after_quantity_input_field', [ $this, 'plus' ] ,9);
        add_action( 'woocommerce_after_add_to_cart_quantity', [ $this, 'start_btn_wrap'],9);
        add_action( 'woocommerce_after_add_to_cart_button', [ $this, 'end_btn_wrap'],9);
        if ( $settings['cart_txt'] || $settings['cart_txt_ex'] ){
            add_action( 'woocommerce_product_single_add_to_cart_text', [ $this, 'single_add_cart' ] ,9);
        }

        $preview  = isset( $_GET['preview'] ) ? sanitize_text_field(wp_unslash($_GET['preview'])) : '';//phpcs:disable WordPress.Security.NonceVerification.Recommended 
        if (Plugin::instance()->editor->is_edit_mode() || $preview == 'true' || $settings['btnuz'] ) {
            $product = wc_get_product($settings['preview']);
        }        
        require dirname(__FILE__) . '/view.php';
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\The_Pack_Woo_Add_To_Cart());
