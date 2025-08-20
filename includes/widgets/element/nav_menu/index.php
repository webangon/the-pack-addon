<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Utils;

if (!defined('ABSPATH')) {
    exit;
}

class thepack_nav_menu extends Widget_Base
{
    public function get_name()
    {
        return 'tp-navmenu';
    }

    public function get_title()
    {
        return esc_html__('Nav menu', 'the-pack-addon');
    }

    public function get_categories()
    {
        return ['ashelement-addons'];
    }

    public function get_icon()
    {
        return 'dashicons dashicons-menu';
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_heading',
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
                'description' => 'Get the  <a href="'.get_admin_url().'nav-menus.php" target="_blank">Menu location</a> from here.',
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

        $this->end_controls_section();

        $this->start_controls_section(
            'section_gnrl',
            [
                'label' => esc_html__('General', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'fwitm',
            [
                'label' => esc_html__('Full width', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .tp-menu-wrap li'=>'flex: 1;',
                ],
            ]
        );

        $this->add_control(
            'mjst',
            [
                'label' => esc_html__('Justify item', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'center' => [
                        'title' => esc_html__('Center', 'the-pack-addon'),
                        'icon' => 'eicon-tabs',
                    ],

                    'flex-start' => [
                        'title' => esc_html__('Start', 'the-pack-addon'),
                        'icon' => 'eicon-text-field',
                    ],

                    'flex-end' => [
                        'title' => esc_html__('End', 'the-pack-addon'),
                        'icon' => 'eicon-folder-o',
                    ],

                    'space-between' => [
                        'title' => esc_html__('Space between', 'the-pack-addon'),
                        'icon' => 'eicon-folder',
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-menu-wrap' => 'justify-content: {{VALUE}};',
                ],   
                'condition' => [
                    'fwitm!' => 'yes',
                ],                             
                'default' => 'center',
            ]
        );

        $this->add_control(
            'itgp',
            [
                'label' => esc_html__('Gap', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tp-menu-wrap' => 'gap:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_tlm',
            [
                'label' => esc_html__('Top level', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ttypo',
                'selector' => '{{WRAPPER}} .tp-menu-wrap>li>a',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->start_controls_tabs('psty');

        $this->start_controls_tab(
            'a1',
            [
                'label' => esc_html__('Normal', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'tpnclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-menu-wrap>li>a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .drop-icon path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'a2',
            [
                'label' => esc_html__('Hover', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'tphclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-menu-wrap>li>a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_slm',
            [
                'label' => esc_html__('Child level', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'chwpt',
            [
                'label' => esc_html__('Wrapper padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .sub-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'chbrd',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .sub-menu' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'chwid',
            [
                'label' => esc_html__('Width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 500,
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .sub-menu' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ctypo',
                'selector' => '{{WRAPPER}} .sub-menu a',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'chbdk',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sub-menu li+li' => 'border-top:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'chpd',
            [
                'label' => esc_html__('Item padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .sub-menu a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'sbxd',
                'selector' => '{{WRAPPER}} .sub-menu',
                'label' => esc_html__('Box shadow', 'the-pack-addon'),
            ]
        );

        $this->start_controls_tabs('csty');

        $this->start_controls_tab(
            'c1',
            [
                'label' => esc_html__('Normal', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'chbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sub-menu' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'cnclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sub-menu a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'c2',
            [
                'label' => esc_html__('Hover', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'chclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sub-menu a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'chbgh',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sub-menu a:hover' => 'background: {{VALUE}};',
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
        require dirname(__FILE__) . '/view.php';
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_nav_menu());
