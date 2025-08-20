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

class The_Pack_Woo_Product_Design extends Widget_Base
{

    public function get_name()
    {
        return 'tp_wooprode';
    }
    // Enqueue styles
	public function get_style_depends() {
		return ['swiper','e-swiper'];
	}

	// Enqueue scripts
	public function get_script_depends() {
		return ['swiper'];
	}
    public function get_title()
    {
        return esc_html__('Product design', 'the-pack-addon');
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

        $this->add_control(
            'img_size',
            [
                'label' => esc_html__('Main image size', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => thepack_image_size_choose(),
                'multiple' => false,
            ]
        );

        $this->add_control(
            'taxonomy',
            [
                'label' => esc_html__('Taxonomy', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT2,
                'options' => thepaack_drop_taxolist(),
                'multiple' => false,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'taxterm',
            [
                'label' => esc_html__('Taxonomy terms', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT2,
                'options' => thepack_drop_cat(),
                'multiple' => true,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'posts',
            [
                'label' => esc_html__('Posts Per Page', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'default'=>[
                    'size' => 5,
                ]
            ]
        );

        $this->add_control(
            'crticon',
            [
                'type' => Controls_Manager::ICONS,
                'label' => esc_html__('Cart icon', 'the-pack-addon'),
                'default' => [
                    'value' => 'fas fa-chevron-left',
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
            'disp',
            [
                'label' => esc_html__('Display', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'grid' => [
                        'title' => esc_html__('Grid', 'the-pack-addon'),
                        'icon' => 'eicon-gallery-grid',
                    ],

                    'slide' => [
                        'title' => esc_html__('Slide', 'the-pack-addon'),
                        'icon' => 'eicon-slider-album',
                    ]

                ],
                'default' => 'grid',
            ]
        );

        $this->add_responsive_control(
            'pgaln',
            [
                'label' => esc_html__('Alignment', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'the-pack-addon'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .product' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'gbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .inner' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gpad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,                
                'selectors' => [
                    '{{WRAPPER}} .inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'gbrd',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .inner' => 'border-radius: {{SIZE}}{{UNIT}}',
                ],

            ]
        );

        $this->add_control(
            'bdrclr',
            [
                'label' => esc_html__('Border Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .inner' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'eq_ht',
            [
                'label' =>   esc_html__( 'Equal height', 'the-pack-addon' ),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide.product' => 'display:flex;height:auto;',
                ],                
            ]
        );

        $this->add_responsive_control(
            'min_ht',
            [
                'label' =>   esc_html__( 'Minimum height', 'the-pack-addon' ),
                'type' =>  Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1000,
                    ],
                ],
                'condition' => [
                    'eq_ht' => 'yes',
                ],                  
                'selectors' => [
                    '{{WRAPPER}} .inner' => 'min-height: {{SIZE}}px;',
                ],

            ]
        );

        $this->add_control(
            'bdclrnolb',
            [
                'label' =>   esc_html__( 'No left bottom border', 'the-pack-addon' ),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .inner' => 'border-left-width:0px;border-bottom-width:0px;',
                ],                
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_gid',
            [
                'label' => esc_html__('Grid', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'disp' => 'grid',
                ],                 
            ]
        );

        $this->add_responsive_control(
            'gwid',
            [
                'label' => esc_html__('Column width', 'the-pack-addon'),
                'type' => Controls_Manager::NUMBER,
                'default' => '33.33',
                'selectors' => [
                    '{{WRAPPER}} .product' => 'width: {{VALUE}}%;float:left;',
                ],
            ]
        );

        $this->add_responsive_control(
            'colspg',
            [
                'label' => esc_html__('Column padding', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .product' => 'padding: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tp-product-catalog' => 'margin-left: -{{SIZE}}{{UNIT}};margin-right: -{{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_ttl',
            [
                'label' => esc_html__('Title', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ttypo',
                'selector' => '{{WRAPPER}} .tp-title',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            't_col',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            't_colh',
            [
                'label' => esc_html__('Hover Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-title:hover a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tmrg',
            [
                'label' => esc_html__('Margin', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tp-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_sale',
            [
                'label' => esc_html__('Sale', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'slpad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,            
                'selectors' => [
                    '{{WRAPPER}} .tp-onsale' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'slbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-onsale' => 'background: {{VALUE}};',
                ],
            ]
        );
 
        $this->add_control(
            'slclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-onsale' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sl_typo',
                'selector' => '{{WRAPPER}} .tp-onsale',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_responsive_control(
            'slbr',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tp-onsale' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'slpos',
            [
                'label' => esc_html__('Top & left position', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 30,
                ],                
                'selectors' => [
                    '{{WRAPPER}} .tp-onsale' => 'top: {{SIZE}}{{UNIT}};left: {{SIZE}}{{UNIT}};position:absolute;',
                ],

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_prc',
            [
                'label' => esc_html__('Price', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'prmgd',
            [
                'label' => esc_html__('Margin', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,            
                'selectors' => [
                    '{{WRAPPER}} .price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};display: inline-flex;',
                ],
            ]
        );

        $this->start_controls_tabs('gt');

        $this->start_controls_tab(
            't1',
            [
                'label' => esc_html__('Sale', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'sclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} del bdi' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'styp',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} del bdi',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            't2',
            [
                'label' => esc_html__('Regular', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'rclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} bdi' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'rtyp',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} bdi',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_btn',
            [
                'label' => esc_html__('Button', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'btpad',
            [
                'label' => esc_html__('Height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tp-add-to-cart a' => 'height: {{SIZE}}{{UNIT}};',
                ],               
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btyp',
                'selector' => '{{WRAPPER}} .tp-add-to-cart a',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'btclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-add-to-cart a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-add-to-cart a' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btbdr',
            [
                'label' => esc_html__('Border', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-add-to-cart a' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'btrad',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tp-add-to-cart a' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'btl1',
            [
                'label' => esc_html__('Primary loader color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'default'=>'#fff',
                'selectors' => [
                    '{{WRAPPER}} a.button.loading::after' => 'border-left: 2px solid {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'btl2',
            [
                'label' => esc_html__('Secondary loader color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'default'=>'#000',
                'selectors' => [
                    '{{WRAPPER}} a.button.loading::after' => 'border-right: 2px solid {{VALUE}};border-top: 2px solid {{VALUE}};border-bottom: 2px solid {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
         
        $this->start_controls_section(
            'section_carousel',
            [
                'label' => esc_html__('Carousel', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'disp' => 'slide',
                ],                
            ]
        );

        $this->add_control(
            'crbxd',
            [
                'label' =>   esc_html__( 'Boxed wrapper', 'the-pack-addon' ),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .tpswiper' => 'overflow:hidden;',
                ],                
            ]
        );

        $this->add_control(
            'arrow',
            [
                'label' => esc_html__('Arrow', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
            ]
        ); 

        $this->add_control(
            'dot',
            [
                'label' => esc_html__('Dot', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'auto',
            [
                'label' => esc_html__('Autoplay', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'the-pack-addon'),
                'label_off' => esc_html__('No', 'the-pack-addon'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'center',
            [
                'label' => esc_html__('Centermode', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'the-pack-addon'),
                'label_off' => esc_html__('No', 'the-pack-addon'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        
        $this->add_control(
            'speed',
            [
                'label' => esc_html__( 'Autoplay Speed', 'the-pack-addon' ),
                'type' =>  Controls_Manager::SLIDER,
                'default' => [
                    'size' => 3500,
                ],
                'condition' => [
                    'auto' => 'yes',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 8000,
                        'step' => 1,
                    ],
                ],
                'size_units' => [ 'px'],
            ]
        );

        $this->add_control(
            'space',
            [
                'label' => esc_html__('Item spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 2,
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
            ]
        );

        $this->add_control(
            'item',
            [
                'label' => esc_html__('Item per slide', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 4,
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 5,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
            ]
        );

        $this->add_control(
            'item_tab',
            [
                'label' => esc_html__('Item per slide tablets', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 2,
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 5,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_owl_dot',
            [
                'label' => esc_html__('Dots', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'dot' => 'yes',
                    'disp' => 'slide',
                ],
            ]
        );

        $this->add_responsive_control(
            'dtvp',
            [
                'label' => esc_html__( 'Vertical position', 'the-pack-addon' ),
                'type' =>  Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ],

                ],
                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination' => 'bottom: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'dotbg',
            [
                'label' =>   esc_html__( 'Background', 'the-pack-addon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'background: {{VALUE}};'
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_owl_arw',
            [
                'label' => esc_html__('Arrow', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'arrow' => 'yes',
                    'disp' => 'slide',
                ],
            ]
        );

        $this->add_control(
			'picon', [
				'type'        => Controls_Manager::ICONS,
				'label'       => esc_html__( 'Prev icon', 'the-pack-addon' ),
				'label_block' => true,
				'default'     => [
					'value'   => 'fas fa-chevron-left',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'nicon', [
				'type'        => Controls_Manager::ICONS,
				'label'       => esc_html__( 'Next icon', 'the-pack-addon' ),
				'label_block' => true,
				'default'     => [
					'value'   => 'fas fa-chevron-right',
					'library' => 'solid',
				],
			]
		);

        $this->add_responsive_control(
            'arwh',
            [
                'label' =>   esc_html__( 'Width and height', 'the-pack-addon' ),
                'type' =>  Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .khbprnx' => 'width: {{SIZE}}px;height: {{SIZE}}px;',
                ],

            ]
        );

        $this->add_responsive_control(
            'arbrad',
            [
                'label' =>   esc_html__( 'Border radius', 'the-pack-addon' ),
                'type' =>  Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .khbprnx' => 'border-radius: {{SIZE}}px;',
                ],

            ]
        );

        $this->add_control(
            'arbg',
            [
                'label' =>   esc_html__( 'Background', 'the-pack-addon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .khbprnx' => 'background: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'arclr',
            [
                'label' =>   esc_html__( 'Color', 'the-pack-addon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .khbprnx' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->end_controls_section();
    }

    public function cart_icon($args){
        $settings = $this->get_settings();
        $args['attributes']['data-icon'] = the_pack_render_icon($settings['crticon']); 
        return $args;        
    }

    protected function render()
    {
        $settings = $this->get_settings();

        add_filter( 'woocommerce_loop_add_to_cart_args', [ $this, 'cart_icon' ],9);

        remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );

        remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

        remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );

        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

        remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

        remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
  
        global $wp_query, $post;
        $main_query = clone $wp_query;
        $main_post  = clone $post;

        $wp_query_args = [
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => $settings['posts']['size'],
        ];
        $wp_query_args['tax_query'] = [//phpcs:disable WordPress.DB.SlowDBQuery.slow_db_query_tax_query
            [
                'taxonomy' => $settings['taxonomy'],
                'field' => 'term_id',
                'terms' => $settings['taxterm'],
            ]
        ];
 
        $wp_query = new \WP_Query( $wp_query_args );
        wc_set_loop_prop( 'total', $wp_query->found_posts );
        wc_set_loop_prop( 'total_pages', $wp_query->max_num_pages );

        require dirname(__FILE__) . '/view.php';

        $wp_query = $main_query;
        $post     = $main_post;
        wp_reset_postdata(); 
                
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\The_Pack_Woo_Product_Design());
