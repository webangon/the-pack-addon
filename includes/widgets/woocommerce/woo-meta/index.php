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

class The_Pack_Woo_Meta extends Widget_Base
{
    public function get_name()
    { 
        return 'tp_woometa';
    }

    public function get_title()
    {
        return esc_html__('Woo meta', 'the-pack-addon');
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
                'label' => esc_html__('Meta', 'the-pack-addon'),
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

        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
            'lbl',
            [
                'label' => esc_html__('Label', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

		$repeater->add_control(
            'icn',
            [
                'label' => esc_html__('Icon', 'the-pack-addon'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
            ]
        );   

        $repeater->add_control(
            'metas',
            [
                'label' => esc_html__('Product meta', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
				'options' => [ 
					'cat' => esc_html__( 'Category', 'the-pack-addon'  ),
					'tag' => esc_html__( 'Tag', 'the-pack-addon'  ),
                    'sku' => esc_html__( 'SKU', 'the-pack-addon'  ),
					'stock' => esc_html__( 'Stock', 'the-pack-addon'  ),
                    'review' => esc_html__( 'Review', 'the-pack-addon'  ),
                    'share' => esc_html__( 'Share', 'the-pack-addon'  ),
				],				
            ]
        );

        $this->add_control(
            'items',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'prevent_empty' => false,
                'title_field' => '{{{ lbl }}}',
            ]
        );

        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_shr',
            [
                'label' => esc_html__('Share', 'the-pack-addon'),
            ]
        );

        $r2 = new \Elementor\Repeater();

        $r2->add_control(
            'icon',
            [
                'type' => Controls_Manager::ICONS,
                'label' => esc_html__('Social Icon', 'the-pack-addon'),
                'label_block' => true,
                
            ]
        );

        $r2->add_control(
            'vendor',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Vendor', 'the-pack-addon'),
                'label_block' => true,
                'default'=> 'facebook',
                'options' => [
                    'facebook' => esc_html__('Facebook', 'the-pack-addon'),
                    'twitter' => esc_html__('Twitter', 'the-pack-addon'),
                    'linkedin' => esc_html__('Linkedin', 'the-pack-addon'),
                    'pinterest' => esc_html__('Pinterest', 'the-pack-addon'),
                    'email' => esc_html__('Email', 'the-pack-addon'),
                    'whatsapp' => esc_html__('Whatsapp', 'the-pack-addon'),
                    'telegram' => esc_html__('Telegram', 'the-pack-addon'),
                ],                    
            ]
        );

        $this->add_control( 
            'tp_fshare',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $r2->get_controls(),
                'title_field' => '{{{ elementor.helpers.renderIcon( this, icon, {}, "i", "panel" ) || \'<i class="{{ icon }}" aria-hidden="true"></i>\' }}}',
                'prevent_empty' => false,
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
            'disp',
            [
                'label' => esc_html__('Block display', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .product-single-meta' => 'flex-direction: column;',
                ],                
            ]
        );

        $this->add_responsive_control(
            'gsp',
            [
                'label' => esc_html__('Spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .product-single-meta' => 'gap: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->start_controls_tabs('ixt');

        $this->start_controls_tab(
            'ixt1',
            [
                'label' => esc_html__('Icon', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'iclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .label i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ispc',
            [
                'label' => esc_html__('Right spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .label i' => 'padding-right: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ixt2',
            [
                'label' => esc_html__('Label', 'the-pack-addon'),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'l_typo',
                'selector' => '{{WRAPPER}} .label',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'lclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ixt3',
            [
                'label' => esc_html__('Value', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'vrsp',
            [
                'label' => esc_html__('Right spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .product-single-meta li' => 'gap: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'v_typo',
                'selector' => '{{WRAPPER}} .label-right',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'vclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .label-right,{{WRAPPER}} .label-right a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_shrc',
            [
                'label' => esc_html__('Share', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'swh',
            [
                'label' => esc_html__('Width & height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .product-share a' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'sfs',
            [
                'label' => esc_html__('Icon size', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .product-share a' => 'font-size: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'sbrd',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .product-share a' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'sspc',
            [
                'label' => esc_html__('Spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .product-share' => 'gap: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'sbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .product-share a' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'sclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .product-share a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_rtng',
            [
                'label' => esc_html__('Rating', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings();
        global $product;
        $preview  = isset( $_GET['preview'] ) ? sanitize_text_field(wp_unslash($_GET['preview'])) : '';//phpcs:disable WordPress.Security.NonceVerification.Recommended 
        if (Plugin::instance()->editor->is_edit_mode() | $preview == 'true' ) {
            $product = wc_get_product($settings['preview']);  
        }
        require dirname(__FILE__) . '/view.php';
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\The_Pack_Woo_Meta());
