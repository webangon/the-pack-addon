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

class The_Pack_Woo_Archive_Product extends Widget_Base
{
    public function get_name()
    {
        return 'tp_wooarch';
    }

    public function get_title()
    {
        return esc_html__('Product archive', 'the-pack-addon');
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

        $this->add_control(
            'picon',
            [
                'type' => Controls_Manager::ICONS,
                'label' => esc_html__('Pagination prev arrow', 'the-pack-addon'),
                'default' => [
                    'value' => 'fas fa-chevron-left',
                    'library' => 'solid',
                ],
            ]
        );

        $this->add_control(
            'nicon',
            [
                'type' => Controls_Manager::ICONS,
                'label' => esc_html__('Pagination next arrow', 'the-pack-addon'),
                'default' => [
                    'value' => 'fas fa-chevron-right',
                    'library' => 'solid',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_cfiltr',
            [
                'label' => esc_html__('Clear filter', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'cfltr',
            [
                'type' => Controls_Manager::ICONS,
                'label' => esc_html__('Icon', 'the-pack-addon'),
                'default' => [
                    'value' => 'tivo ti-close',
                    'library' => 'themify-icons',
                ],
            ]
        );

        $this->add_control(
            'clrtxt',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Clear filter text', 'the-pack-addon'),
                'default' =>'Clear filters',
            ]
        );

        $this->add_control(
            'clristk',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('In stock text', 'the-pack-addon'),
                'default' =>'In stock',
            ]
        );

        $this->add_control(
            'clrosl',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('On sale text', 'the-pack-addon'),
                'default' =>'On sale',
            ]
        );

        $this->add_control(
            'clrmn',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Min price text', 'the-pack-addon'),
                'default' =>'Min',
            ]
        );

        $this->add_control(
            'clrmx',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Max price text', 'the-pack-addon'),
                'default' =>'Max',
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

        $this->end_controls_section();

        $this->start_controls_section(
            'section_topnotif',
            [
                'label' => esc_html__('Top navigation', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tfltyp',
                'selector' => '{{WRAPPER}} .tp-before-shop',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'tflbsp',
            [
                'label' => esc_html__('Bottom spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tp-before-shop' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],

            ]
        );

        $this->add_control(
            'tflclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-before-shop,{{WRAPPER}} .tp-before-shop a' => 'color:{{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_removeflter',
            [
                'label' => esc_html__('Remove filter', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'rflsp',
            [
                'label' => esc_html__('Spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .remove-filter li' => 'padding: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .remove-filter' => 'margin-left: -{{SIZE}}{{UNIT}};margin-right: -{{SIZE}}{{UNIT}}',
                ],

            ]
        );

        $this->add_control(
            'rflclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .remove-filter a' => 'color:{{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'rflbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .remove-filter a' => 'background:{{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'rflbclr',
            [
                'label' => esc_html__('Border', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .remove-filter a' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'rflbrds',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .remove-filter a' => 'border-radius: {{SIZE}}{{UNIT}}',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'rfltyp',
                'selector' => '{{WRAPPER}} .remove-filter a',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'rflpd',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .remove-filter a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'rflifs',
            [
                'label' => esc_html__('Icon size', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .remove-filter i' => 'font-size: {{SIZE}}{{UNIT}}',
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
                    '{{WRAPPER}} .add_to_cart_button,{{WRAPPER}} .added_to_cart' => 'height: {{SIZE}}{{UNIT}};',
                ],               
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btyp',
                'selector' => '{{WRAPPER}} .add_to_cart_button,{{WRAPPER}} .added_to_cart',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'btclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .add_to_cart_button,{{WRAPPER}} .added_to_cart' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .add_to_cart_button,{{WRAPPER}} .added_to_cart' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btbdr',
            [
                'label' => esc_html__('Border', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .add_to_cart_button,{{WRAPPER}} .added_to_cart' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'btrad',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .add_to_cart_button,{{WRAPPER}} .added_to_cart' => 'border-radius: {{SIZE}}{{UNIT}};',
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
                'label' => esc_html__('Background', 'the-pack-addon'),
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
                    '{{WRAPPER}} .price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .price del bdi' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'styp',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .price del bdi',
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
                    '{{WRAPPER}} .price bdi' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'rtyp',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .price bdi',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_cat',
            [
                'label' => esc_html__('Category', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'catmrg',
            [
                'label' => esc_html__('Margin', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,            
                'selectors' => [
                    '{{WRAPPER}} .tp-product-cat' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'catypo',
                'selector' => '{{WRAPPER}} .tp-product-cat a',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'ca_col',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-product-cat a' => 'color: {{VALUE}};',
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

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'rttypo',
                'selector' => '{{WRAPPER}} .count',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'rt_col',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .count' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_pgin',
            [
                'label' => esc_html__('Pagination', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pgtypo',
                'selector' => '{{WRAPPER}} .woocommerce-pagination li',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_responsive_control(
            'pgln',
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
                    '{{WRAPPER}} .woocommerce-pagination' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pg_sp',
            [
                'label' => esc_html__('Spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,                                                        
               'selectors' => [
                    '{{WRAPPER}} .woocommerce-pagination ul' => 'gap:{{SIZE}}{{UNIT}};margin-left:-{{SIZE}}{{UNIT}};margin-right:-{{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'pg_wh',
            [
                'label' => esc_html__('Width & height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,                                                        
               'selectors' => [
                    '{{WRAPPER}} .woocommerce-pagination span,{{WRAPPER}} .woocommerce-pagination a' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pg_brd',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,                                                        
               'selectors' => [
                    '{{WRAPPER}} .woocommerce-pagination span,{{WRAPPER}} .woocommerce-pagination a' => 'border-radius:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pg_bg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,            
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-pagination span,{{WRAPPER}} .woocommerce-pagination a' => 'background:{{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pg_clr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,            
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-pagination span,{{WRAPPER}} .woocommerce-pagination a' => 'color:{{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pg_bdclr',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,            
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-pagination span,{{WRAPPER}} .woocommerce-pagination a' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pg_bgh',
            [
                'label' => esc_html__('Hover background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,            
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-pagination .current,{{WRAPPER}} .woocommerce-pagination a:hover' => 'background:{{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pg_clrh',
            [
                'label' => esc_html__('Hover color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,            
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-pagination .current,{{WRAPPER}} .woocommerce-pagination a:hover' => 'color:{{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    public function loop_start(){
        echo '<div class="tp-product-catalog masonwrp masonon">';
    } 

    public function loop_end(){
        echo '</div>';
    } 

    public function before_shop_loop(){
        $settings = $this->get_settings();
        call_user_func('The_Pack_Woo_Helper::bf_shop_filter',$settings);
    }
    
    public function thumbnail_size() {
        $settings = $this->get_settings();
        return $settings['img_size'];
    }

    public function flash_sale(){
        global $product;
        $option = [
            'type'=> 'percen',
            'label'=> 'sale',
        ];        
        call_user_func('The_Pack_Woo_Helper::on_sale', $product,$option);
    }
 
    public function category(){
        global $product;
        $id = $product->get_id();  
        call_user_func('The_Pack_Woo_Helper::product_cat',$id);
    }

    public function product_title(){ 
        call_user_func('The_Pack_Woo_Helper::product_title');        
    }

    public function rating(){
        global $product;  
        $settings = $this->get_settings();
        call_user_func('The_Pack_Woo_Helper::product_rating',$product,$settings);
    }

    public function rename_btn_txt(){  
        $settings = $this->get_settings();
		global $product;
		$product_type = $product->get_type(); 
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
                return esc_html__( 'Read More', 'wctext' );
		}
    }

    public function product_wrapper_start(){
        echo '<div class="inner">';
    }

    public function product_wrapper_end(){
        echo '</div>';
    }

    public function pagi_arrow($args){
        $settings = $this->get_settings();
        $args['prev_text'] = the_pack_render_icon($settings['picon']);
        $args['next_text'] = the_pack_render_icon($settings['nicon']);
        return $args;        
    }

    public function cart_icon($args){
        $settings = $this->get_settings();
        $args['attributes']['data-icon'] = the_pack_render_icon($settings['crticon']); 
        return $args;        
    }  
    
    protected function render()
    {
        $settings = $this->get_settings();

        if ( $settings['cart_txt'] || $settings['cart_txt_ex'] ) {
             add_filter( 'woocommerce_product_add_to_cart_text', [$this, 'rename_btn_txt'],9);
        }

        add_filter( 'woocommerce_product_loop_start', [ $this, 'loop_start' ]);

        add_filter( 'woocommerce_pagination_args', [ $this, 'pagi_arrow' ],9);

        add_filter( 'woocommerce_loop_add_to_cart_args', [ $this, 'cart_icon' ],9);

        add_filter( 'woocommerce_product_loop_end', [ $this, 'loop_end' ]);

        add_action( 'woocommerce_before_shop_loop', [ $this, 'before_shop_loop' ]);

        add_action( 'woocommerce_before_shop_loop_item_title', [ $this, 'flash_sale' ]);

        add_action( 'woocommerce_before_shop_loop_item', [ $this, 'product_wrapper_start'],9);

        add_action( 'woocommerce_after_shop_loop_item', [ $this, 'product_wrapper_end'],99);

        add_action( 'woocommerce_before_shop_loop_item_title', [ $this, 'category' ]);

        add_action( 'woocommerce_after_shop_loop_item_title', [ $this, 'rating'],9);

        add_action( 'woocommerce_shop_loop_item_title', [ $this, 'product_title'],10);

        add_filter( 'single_product_archive_thumbnail_size', [$this, 'thumbnail_size'] );

        remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );

        remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

        remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

        remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

        if (Plugin::instance()->editor->is_edit_mode()) {

            remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );

			global $wp_query, $post;
			$main_query = clone $wp_query;
			$main_post  = clone $post;

            $wp_query_args = [
                'post_type'      => 'product',
                'post_status'    => 'publish',
                'posts_per_page' => 6,
            ];

			$wp_query = new \WP_Query( $wp_query_args );
			wc_set_loop_prop( 'total', $wp_query->found_posts );
			wc_set_loop_prop( 'total_pages', $wp_query->max_num_pages );
        }

		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );        
        require dirname(__FILE__) . '/view.php';

        if (Plugin::instance()->editor->is_edit_mode()) {
			$wp_query = $main_query;
			$post     = $main_post;
			wp_reset_query();
			wp_reset_postdata();            
        }

    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\The_Pack_Woo_Archive_Product());
