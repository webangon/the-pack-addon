<?php
namespace ThePackAddon\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Plugin;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\utils;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class The_Pack_Woo_Quick_Thumbnail extends Widget_Base
{

    public function get_name()
    {
        return 'tp_wooquickthumb';
    }

    public function get_title()
    {
        return esc_html__('Woo quick thumbnail', 'the-pack-addon');
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
                'label' => esc_html__('Settings', 'the-pack-addon'),
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
            'zoom',
            [
                'label' => esc_html__('Disable image zoom', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'lightbox',
            [
                'label' => esc_html__('Disable lightbox', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'controlnav',
            [
                'label' => esc_html__('Control Nav', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'false' => [
                        'title' => esc_html__('False', 'the-pack-addon'),
                        'icon' => 'eicon-editor-close',
                    ],

                    'true' => [
                        'title' => esc_html__('Dot', 'the-pack-addon'),
                        'icon' => 'eicon-circle-o',
                    ],

                    'thumbnails' => [
                        'title' => esc_html__('Thumbnail', 'the-pack-addon'),
                        'icon' => 'eicon-image-bold',
                    ],

                ],
            ]
        );

        $this->add_control(
            'direction',
            [
                'label' => esc_html__('Direction Nav', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'zoomicn',
            [
                'type' => Controls_Manager::ICONS,
                'label' => esc_html__('Zoom icon', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'picon',
            [
                'type' => Controls_Manager::ICONS,
                'label' => esc_html__('Prev arrow', 'the-pack-addon'),
                'condition' => [
                    'direction' => 'yes',
                ],
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
                'label' => esc_html__('Next arrow', 'the-pack-addon'),
                'condition' => [
                    'direction' => 'yes',
                ],
                'default' => [
                    'value' => 'fas fa-chevron-right',
                    'library' => 'solid',
                ],
            ]
        );

        $this->add_control(
            'on_sale',
            [
                'label' => esc_html__('On sale type', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'percen' => [
                        'title' => esc_html__('Percentage', 'the-pack-addon'),
                        'icon' => 'eicon-editor-close',
                    ],

                    'price' => [
                        'title' => esc_html__('Price', 'the-pack-addon'),
                        'icon' => 'eicon-circle-o',
                    ],

                    'txt' => [
                        'title' => esc_html__('Text', 'the-pack-addon'),
                        'icon' => 'eicon-image-bold',
                    ],

                ],
                'default' => 'percen',
            ]
        );

        $this->add_control(
            'sale_txt',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('On sale label', 'the-pack-addon'),
                'condition' => [
                    'on_sale' => 'txt',
                ],                
                'default' => 'Sale',
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
            'gbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .flex-viewport' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gbrad',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .flex-viewport' => 'border-radius: {{SIZE}}{{UNIT}};',
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
                'label' => esc_html__('Top & right position', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tp-onsale' => 'top: {{SIZE}}{{UNIT}};left: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_zoom',
            [
                'label' => esc_html__('Zoom', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'zoom!' => 'yes',
                ],                
            ]
        );

        $this->add_control(
            'zbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .images .woocommerce-product-gallery__trigger' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'zclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-product-gallery__trigger' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'zfs',
            [
                'label' => esc_html__('Font size', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .images .woocommerce-product-gallery__trigger' => 'font-size: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'zwh',
            [
                'label' => esc_html__('Width & height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .images .woocommerce-product-gallery__trigger' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'zbr',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .images .woocommerce-product-gallery__trigger' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'zpos',
            [
                'label' => esc_html__('Top & right position', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .images .woocommerce-product-gallery__trigger' => 'top: {{SIZE}}{{UNIT}};right: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_arrow',
            [
                'label' => esc_html__('Arrow', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'direction' => 'yes',
                ],                
            ]
        );

        $this->add_control(
            'abg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .flex-direction-nav a' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'aclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .flex-direction-nav a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'awh',
            [
                'label' => esc_html__('Width & height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .flex-direction-nav a' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'afs',
            [
                'label' => esc_html__('Font size', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .flex-direction-nav a' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'abr',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .flex-direction-nav a' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_thmb',
            [
                'label' => esc_html__('Thumbnail', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'controlnav' => 'thumbnails',
                ],                
            ]
        );

        $this->add_responsive_control(
            'tvp',
            [
                'label' => esc_html__('Vertical position', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 1,
                    ],
                ],                
                'selectors' => [
                    '{{WRAPPER}} .flex-control-thumbs' => 'bottom: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'thpad',
            [
                'label' => esc_html__('Wrapper left-right padding', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .images .flex-control-thumbs' => 'padding:0px {{SIZE}}%;',
                ],
            ]
        );

        $this->add_responsive_control(
            'thgp',
            [
                'label' => esc_html__('Spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .flex-control-nav' => 'gap:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'tbdc',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .flex-control-thumbs li img' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'thbrad',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .flex-control-thumbs li img' => 'border-radius:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'tbdca',
            [
                'label' => esc_html__('Active border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .flex-control-thumbs li img.flex-active,{{WRAPPER}} .flex-control-thumbs li img:hover' => 'border-color:{{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_dot',
            [
                'label' => esc_html__('Dot', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'controlnav' => 'true',
                ],                
            ]
        );

        $this->add_control(
            'dpclr',
            [
                'label' => esc_html__('Primary color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .flex-control-paging li a' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dsclr',
            [
                'label' => esc_html__('Active color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .flex-control-paging li a.flex-active' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dvp',
            [
                'label' => esc_html__('Vertical position', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 1,
                    ],
                ],                
                'selectors' => [
                    '{{WRAPPER}} .flex-control-nav' => 'bottom: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'dspc',
            [
                'label' => esc_html__('Gap', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .flex-control-nav' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }
 
    public function flash_sale($html, $post, $product){
        $settings = $this->get_settings();
        $option = [
            'type'=> $settings['on_sale'],
            'label'=> $settings['sale_txt'],
        ];
        call_user_func('The_Pack_Woo_Helper::on_sale', $product,$option);
    }
    protected function render()
    {   
        $settings = $this->get_settings();  
        add_filter( 'woocommerce_sale_flash', [ $this, 'flash_sale' ] ,9,3);  
        $preview  = isset( $_GET['preview'] ) ? sanitize_text_field(wp_unslash($_GET['preview'])) : '';//phpcs:disable WordPress.Security.NonceVerification.Recommended 
        if (Plugin::instance()->editor->is_edit_mode() || $preview == 'true') {
            $product = wc_get_product($settings['preview']);        
        } else { 
            global $product;
            $product = wc_get_product();            
        }        
        if ( empty( $product ) ) { return; }
        require dirname(__FILE__) . '/view.php'; 
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\The_Pack_Woo_Quick_Thumbnail());
