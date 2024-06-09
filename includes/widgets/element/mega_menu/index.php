<?php
namespace ThePackAddon\Widgets;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\utils;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class thepack_cleaning extends Widget_Base
{
    public function get_name()
    {
        return 'tpmegamenu';
    }

    public function get_title()
    {
        return esc_html__('Mega Menu', 'the-pack-addon');
    } 

    public function get_icon()
    {
        return 'dashicons dashicons-editor-paragraph';
    }

    public function get_categories()
    {
        return ['ashelement-addons'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_contrt',
            [
                'label' => esc_html__('Content', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'native',
            [
                'label' => esc_html__('WordPress nav menu', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'menu',
            [
                'label' => esc_html__('Menu', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT2,
                'options' => thepack_drop_menu_select(),
                'label_block' => true,
                'condition' => [
                    'native' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'mobile',
            [
                'label' => esc_html__('Mobile menu', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT2,
                'options' => thepack_drop_menu_select(),
                'label_block' => true
            ]
        );

        $r3 = new \Elementor\Repeater();

        $r3->add_control(
            'lbl',
            [
                'label' => esc_html__('Parts', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT2,
                'default' => '',
                'options' => [

                    'logo_menu_search' => esc_html__('Logo + Menu + Search', 'the-pack-addon'),
                    'logo_menu' => esc_html__('Logo + Menu', 'the-pack-addon'),
                    'topbar' => esc_html__('Top bar', 'the-pack-addon'),

                ], 
                'multiple' => false,
                'label_block' => true
            ]
        );

        $r3->add_control(
            'sticky',
            [
                'label' => esc_html__('Sticky', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'parts',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $r3->get_controls(),
                'label' => esc_html__('Header component', 'the-pack-addon'),
                'prevent_empty' => false,
                'default' => [
                    [
                        'lbl' => esc_html__('Top bar', 'the-pack-addon'),
                    ]
                ],
                'title_field' => '{{lbl}}',
            ]
        );

        $cust_links = new \Elementor\Repeater();

        $cust_links->add_control(
            'item_text',
            [
                'label' => esc_html__('Title', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Menu Item', 'the-pack-addon'),
                'label_block' => true,
            ]
        );

        $cust_links->add_control(
            'icon',
            [
                'label' => esc_html__('Icons', 'the-pack-addon'),
                'type' => Controls_Manager::ICONS,
            ]
        );

        $cust_links->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'the-pack-addon'),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'the-pack-addon'),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $cust_links->add_control(
            'has_sub',
            [
                'label' => esc_html__('Have Sub Menu', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'the-pack-addon'),
                'label_off' => esc_html__('No', 'the-pack-addon'),
                'return_value' => 'yes',
            ]
        );

        $cust_links->add_control(
            'sub_type',
            [
                'label' => esc_html__('Sub Menu Type', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT,
                'default' => 'mega',
                'options' => [
                    'mega' => 'Mega',
                    'default' => 'Default',
                ],
                'condition' => [
                    'has_sub' => 'yes',
                ],
            ]
        );

        $cust_links->add_control(
            'sub_menu',
            [
                'label' => esc_html__('Sub Mega Menu', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT2,
                'default' => 'no',
                'options' => thepack_footer_select(),
                'condition' => [
                    'has_sub' => 'yes',
                    'sub_type' => 'mega',
                ],
                'label_block' => true
            ]
        );

        $cust_links->add_control(
            'box_mega_menu',
            [
                'label' => esc_html__('Boxed mega menu', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'condition' => [
                    'has_sub' => 'yes',
                    'sub_type' => 'mega',
                ],
            ]
        );

        $cust_links->add_control(
            'menu_register',
            [
                'label' => esc_html__('Menu', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT2,
                'options' => thepack_drop_menu_select(),
                'condition' => [
                    'has_sub' => 'yes',
                    'sub_type' => 'default',
                ],
                'label_block' => true
            ]
        );

        $this->add_control(
            'menus',
            [
                'label' => esc_html__('Menu', 'the-pack-addon'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $cust_links->get_controls(),
                'prevent_empty' => false,
                'title_field' => '{{{ item_text }}}',
                'default' => [
                    [
                        'item_text' => esc_html__('Home', 'the-pack-addon'),
                    ],
                    [
                        'item_text' => esc_html__('Portfolio', 'the-pack-addon'),
                    ],
                ],
                'condition' => [
                    'native!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'logo',
            [
                'label' => esc_html__('Logo', 'the-pack-addon'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'stlogo',
            [
                'label' => esc_html__('Sticky Logo', 'the-pack-addon'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'logo_link',
            [
                'label' => esc_html__('Logo link', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->start_controls_tabs('hgr');

        $this->start_controls_tab(
            'a1',
            [
                'label' => esc_html__('Iconbox', 'the-pack-addon'),
            ]
        );

        $add_ib = new \Elementor\Repeater();

        $add_ib->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'the-pack-addon'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
            ]
        );

        $add_ib->add_control(
            'text',
            [
                'label' => esc_html__('Social link url', 'the-pack-addon'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'iconbox',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $add_ib->get_controls(),
                'prevent_empty' => false,
                'title_field' => '{{{ elementor.helpers.renderIcon( this, icon, {}, "i", "panel" ) || \'<i class="{{ icon }}" aria-hidden="true"></i>\' }}}',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'a2',
            [
                'label' => esc_html__('Social', 'the-pack-addon'),
            ]
        );

        $repeater1 = new \Elementor\Repeater();

        $repeater1->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'the-pack-addon'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
            ]
        );

        $repeater1->add_control(
            'url',
            [
                'label' => esc_html__('Social link url', 'the-pack-addon'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => esc_html__('http://your-link.com', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'socials',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater1->get_controls(),
                'prevent_empty' => false,
                'title_field' => '{{{ elementor.helpers.renderIcon( this, icon, {}, "i", "panel" ) || \'<i class="{{ icon }}" aria-hidden="true"></i>\' }}}',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->start_controls_tabs('tmnubar');

        $this->start_controls_tab(
            'er1',
            [
                'label' => esc_html__('Button', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'sub-btn',
            [
                'label' => esc_html__('Label', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'sub-link',
            [
                'label' => esc_html__('Link', 'the-pack-addon'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => esc_html__('http://your-link.com', 'the-pack-addon'),
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'er2',
            [
                'label' => esc_html__('Icons', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'tapicon',
            [
                'label' => esc_html__('Tap Icon', 'the-pack-addon'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
            ]
        ); 

        $this->add_control(
            'tpoffclose',
            [
                'label' => esc_html__('Sidebar close icon', 'the-pack-addon'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true, 
                'default' => [
                    'value' => 'tivo ti-close',
                    'library' => 'themify-icons',
                ],                                      
            ]
        );

        if ( class_exists( 'WooCommerce' ) ) {
            $this->add_control(
                'carticon',
                [
                    'label' => esc_html__('Woo cart icon', 'the-pack-addon'),
                    'type' => Controls_Manager::ICONS,
                    'label_block' => true,
                ]
            );
        }
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_lbl',
            [
                'label' => esc_html__('General', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'gmwd',
            [
                'label' => esc_html__('Max wrapper width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1500,
                        'step' => 1,
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-header-flex-wrap' => 'max-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .menubarwrp.boxed_navbar' => 'max-width: {{SIZE}}{{UNIT}};margin:0px auto;',
                ],
            ]
        );

        $this->add_responsive_control(
            'gmpr',
            [
                'label' => esc_html__('Wrapper padding', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tp-header-flex-wrap' => 'padding:0px {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'abspos',
            [
                'label' => esc_html__('Absolute position', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_ltr',
            [
                'label' => esc_html__('Top bar', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'tbht',
            [
                'label' => esc_html__('Height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .xlm-topbar' => 'height:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'tbbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xlm-topbar' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tbbtm',
            [
                'label' => esc_html__('Border bottom', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xlm-topbar' => 'border-bottom:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs('tbtb');

        $this->start_controls_tab(
            'tbtb1',
            [
                'label' => esc_html__('Info', 'the-pack-addon'),
            ]
        );

        $this->add_responsive_control(
            'inigsp',
            [
                'label' => esc_html__('Spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .headerinfo li' => 'padding:0px {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .headerinfo' => 'margin-left:-{{SIZE}}{{UNIT}};margin-right:-{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'tinclr',
            [
                'label' => esc_html__('Icon color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .headerinfo i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tilsp',
            [
                'label' => esc_html__('Icon spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .headerinfo i' => 'padding-right:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tifs',
            [
                'label' => esc_html__('Icon size', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .headerinfo i' => 'font-size:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ttznclr',
            [
                'label' => esc_html__('Text color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .headerinfo .info' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tinfty',
                'selector' => '{{WRAPPER}} .headerinfo .info',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tbtb2',
            [
                'label' => esc_html__('Social', 'the-pack-addon'),
            ]
        );

        $this->add_responsive_control(
            'tbswh',
            [
                'label' => esc_html__('Width & height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .xlm-topbar .linksocial' => 'height:{{SIZE}}{{UNIT}};width:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tbsgsp',
            [
                'label' => esc_html__('Spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .headersocial li' => 'padding:0px {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .headersocial' => 'margin-left:-{{SIZE}}{{UNIT}};margin-right:-{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tbsfs',
            [
                'label' => esc_html__('Font size', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .xlm-topbar .linksocial' => 'font-size:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tbsbrd',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .xlm-topbar .linksocial' => 'border-radius:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'tbsbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xlm-topbar .linksocial' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tbsclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xlm-topbar .linksocial' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tbsbgh',
            [
                'label' => esc_html__('Hover background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xlm-topbar .linksocial:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tbsclrh',
            [
                'label' => esc_html__('Hover color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xlm-topbar .linksocial:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_mubr',
            [
                'label' => esc_html__('Navbar', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'nbarbox',
            [
                'label' => esc_html__('Boxed', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'boxed_navbar',
            ]
        );

        $this->add_responsive_control(
            'nbarboxr',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .menubarwrp.boxed_navbar' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'nbarbox' => 'boxed_navbar',
                ],
            ]
        );

        $this->add_responsive_control(
            'nvht',
            [
                'label' => esc_html__('Height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .menubarwrp' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'nvbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xlmega-sticky-wrapper' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'nvbdclr',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menubarwrp' => 'border-bottom:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'nvbgst',
            [
                'label' => esc_html__('Sticky background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xlmega-sticky-wrapper.fixed' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs('nvtb');

        $this->start_controls_tab(
            'nvtb1',
            [
                'label' => esc_html__('Logo', 'the-pack-addon'),
            ]
        );

        $this->add_responsive_control(
            'lgwd',
            [
                'label' => esc_html__('Width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .tpsite-logo img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'nvtb2',
            [
                'label' => esc_html__('Menu', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'xcv',
            [
                'label' => esc_html__('Main menu', 'the-pack-addon'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'mmtyp',
                'selector' => '{{WRAPPER}} .tp-menu-wrap>li>a',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'mmpd',
            [
                'label' => esc_html__('Item padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .tp-menu-wrap>li>a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'mmclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-menu-wrap>li>a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mmclrst',
            [
                'label' => esc_html__('Sticky color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fixed .tp-menu-wrap>li>a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mmhclr',
            [
                'label' => esc_html__('Hover color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-menu-wrap>li>a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tp-menu-wrap>li.current-menu-item>a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'xcv2',
            [
                'label' => esc_html__('Sub menu', 'the-pack-addon'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'sbbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-menu-wrap .sub-menu' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'sbpdy',
            [
                'label' => esc_html__('Wrapper adding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .tp-menu-wrap .sub-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .tp-menu-wrap .sub-menu li .sub-menu' => 'margin-left: {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'sbwd',
            [
                'label' => esc_html__('Width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-menu-wrap .sub-menu' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sbtyp',
                'selector' => '{{WRAPPER}} .tp-menu-wrap .sub-menu a',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'sbitclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-menu-wrap .sub-menu a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'sbitpad',
            [
                'label' => esc_html__('Item padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .tp-menu-wrap .sub-menu a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'sbithclr',
            [
                'label' => esc_html__('Item hover color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-menu-wrap .sub-menu a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'sbithbg',
            [
                'label' => esc_html__('Item hover background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-menu-wrap .sub-menu a:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'nvtb3',
            [
                'label' => esc_html__('Button', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'ctabtbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menubarwrp .header-cta' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ctabtclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menubarwrp .header-cta' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ctabtbgh',
            [
                'label' => esc_html__('Hover Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menubarwrp .header-cta:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ctabtclrh',
            [
                'label' => esc_html__('Hover Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menubarwrp .header-cta:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ctapd',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .menubarwrp .header-cta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ctabrde',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .menubarwrp .header-cta' => 'border-radius:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ctatp',
                'selector' => '{{WRAPPER}} .menubarwrp .header-cta',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'nvtb4',
            [
                'label' => esc_html__('Tap', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'taphide',
            [
                'label' => esc_html__('Hide on desktop', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'hideondesktop',
            ]
        );

        $this->add_control(
            'tapsiz',
            [
                'label' => esc_html__('Font size', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tp-navbar-toggle' => 'font-size:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'tapspc',
            [
                'label' => esc_html__('Icon spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .khbnavright .inrwrpr' => 'gap:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'tapclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .khbnavright .action-link' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tapstclr',
            [
                'label' => esc_html__('Sticky color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fixed .khbnavright .action-link' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_megam',
            [
                'label' => esc_html__('Mega menu', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'megbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .thepack-mega-menu-wrapper>div>section' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'megpd',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .thepack-mega-menu-wrapper>div>section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'mega-wd',
            [
                'label' => esc_html__('Width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                        'step' => 1,
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .thepack-mega-menu-wrapper>div>section' => 'max-width: {{SIZE}}{{UNIT}};margin: 0px auto;',
                ],
            ]
        );

        $this->add_responsive_control(
            'megbrad',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .thepack-mega-menu-wrapper>div>section' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'mgbxd',
                'selector' => '{{WRAPPER}} .thepack-mega-menu-wrapper>div>section',
                'label' => esc_html__('Box shadow', 'the-pack-addon'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_ofscrn',
            [
                'label' => esc_html__('Offsidebar', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'ofmwid',
            [
                'label' => esc_html__('Max width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1500,
                        'step' => 1,
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .xlmega-header .offsidebar' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ofpd',
            [
                'label' => esc_html__('Wrapper padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .xlmega-header .offsidebar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ofbge',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xlmega-header .offsidebar' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs('oftb');

        $this->start_controls_tab(
            'oftb1',
            [
                'label' => esc_html__('Menu', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'ofcv',
            [
                'label' => esc_html__('Main menu', 'the-pack-addon'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_responsive_control(
            'ofmtps',
            [
                'label' => esc_html__('Bottom spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .momenu-list>li' => 'padding-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ofmtyp',
                'selector' => '{{WRAPPER}} .momenu-list>li>a',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'ofmclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .momenu-list>li>a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ofscv',
            [
                'label' => esc_html__('Sub menu', 'the-pack-addon'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_responsive_control(
            'ofspd',
            [
                'label' => esc_html__('Wrapper padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .momenu-list .sub-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ofsmtyp',
                'selector' => '{{WRAPPER}} .momenu-list .sub-menu a',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'ofsmclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .momenu-list .sub-menu a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'oftb2',
            [
                'label' => esc_html__('Social', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'ofsclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .offsidebar .linksocial' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'oftb3',
            [
                'label' => esc_html__('Close', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'ofclpos',
            [
                'label' => esc_html__('Position', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 20,
                ],
                'range' => [
                    'px' => [
                        'max' => 500,
                    ],
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .offmenuwraps .tpclosetivo' => 'top: {{SIZE}}{{UNIT}};right: {{SIZE}}{{UNIT}};',
                ],                
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();
        include plugin_dir_path(__FILE__) . 'view.php';
    }

    private function out_social_link($content)
    {
        $out1 = '';
        foreach ($content as $item) {
            $link = thepack_get_that_link($item['url']);
            $out1 .= '
                <li><a class="linksocial" ' . $link . '>
                    <span class="khbicon ' . $item['icon']['value'] . '"></span>
                </a></li>
            ';
        }

        return '<ul class="headersocial raw-style">' . thepack_build_html($out1) . '</ul>';
    }

    private function out_iconbox($content)
    {
        $out = '';
        foreach ($content as $item) {
            $icon = $item['icon']['value'] ? '<i class="' . $item['icon']['value'] . '"></i>' : '';
            $txt = $item['text'] ? '<span class="info">' . $item['text'] . '</span>' : '';
            $out .= ' <li>' . $icon . $txt . '</li>';
        }

        return '<ul class="headerinfo raw-style">' . thepack_build_html($out) . '</ul>';
    }

    private function out_subs_btn($label, $link)
    {
        $link = thepack_get_that_link($link);
        ;
        $out = $label ? '<a ' . $link . ' class="header-cta tbtr">' . $label . '</a>' : '';

        return thepack_build_html($out);
    }

    private function out_icon($icon, $hide)
    {
        $out = $icon['value'] ? '<span class="action-link tp-navbar-toggle ' . $hide . '"><i class="' . $icon['value'] . '"></i></span>' : '';

        return thepack_build_html($out); 
    }

    private function out_woo_icon($icon, $type){
        if ( !class_exists( 'WooCommerce' ) ) {
            return;
        }
        global $woocommerce;
        if (Plugin::instance()->editor->is_edit_mode()) {
            $cart_count = '<span class="tp-woo-count">03</span>';
        } else {
            $cart_count = '<span class="tp-woo-count">'.sprintf("%02d", $woocommerce->cart->cart_contents_count).'</span>';
        }     
        
        $out = $icon['value'] ? '<a class="action-link" href="'.wc_get_cart_url().'"><span class="cart-'.$type.'"><i class="' . $icon['value'] . '"></i>'.$cart_count.'</span></a>' : '';

        return thepack_build_html($out);
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_cleaning());
