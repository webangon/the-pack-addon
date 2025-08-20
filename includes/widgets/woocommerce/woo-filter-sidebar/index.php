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

class The_Pack_Filter_Sidebar extends Widget_Base
{
    public function get_name()
    {
        return 'tp_woofilter_sidebar';
    }

    public function get_title()
    {
        return esc_html__('Filter sidebar', 'the-pack-addon');
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
            'type',
            [
                'label' => esc_html__('Widget type', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
				'options' => [
					'cat' => esc_html__( 'Category filter', 'the-pack-addon'  ),
					'stock' => esc_html__( 'Stock filter', 'the-pack-addon'  ),
                    'price' => esc_html__( 'Price filter', 'the-pack-addon'  ),
					'search' => esc_html__( 'Search filter', 'the-pack-addon'  ),
				],				
            ]
        );

        $repeater->add_control(
            'ex_cat',
            [
                'label' => esc_html__('Exclude category', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT2,
                'options' => thepack_drop_cat('category'),
                'multiple' => true,
                'label_block' => true,
                'condition' => [
                    'type' => 'cat',
                ],
            ]
        );

        $repeater->add_control(
            'spl',
            [
                'label' => esc_html__('Placeholder', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'=> 'Type & hit enter',
                'condition' => [
                    'type' => 'search',
                ],                
            ]
        );

		$repeater->add_control(
            'icn',
            [
                'label' => esc_html__('Button icon', 'the-pack-addon'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
                'condition' => [
                    'type' => 'search',
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
            'section_gnrl',
            [
                'label' => esc_html__('General', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'gpad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .filter-sidebar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'gbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .filter-sidebar' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'gbrad',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .filter-sidebar' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );        
        $this->add_responsive_control(
            'vsp',
            [
                'label' => esc_html__('Widget vertical spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .filter-item:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_hdg',
            [
                'label' => esc_html__('Heading', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'tmrg',
            [
                'label' => esc_html__('Margin', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px'],
                'selectors' => [
                    '{{WRAPPER}} h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'tbg',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ttypo',
                'selector' => '{{WRAPPER}} h3',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_cbx',
            [
                'label' => esc_html__('Checkbox', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'cxbg',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .filter-item li label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'cxtypo',
                'selector' => '{{WRAPPER}} .filter-item li label',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_responsive_control(
            'cxbsp',
            [
                'label' => esc_html__('Bottom spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .filter-item li+li' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_srh',
            [
                'label' => esc_html__('Search', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );     

        $this->add_control(
            'srbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .search-field' => 'background:{{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'srclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .search-field,{{WRAPPER}} .search-field::placeholder' => 'color:{{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'srbcl',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .search-field' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'srbrd',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .search-field' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'sepd',
            [
                'label' => esc_html__('Pading', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .search-field' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'iknwid',
            [
                'label' => esc_html__('Button width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .search-submit' => 'width: {{SIZE}}px;',
                ],

            ]
        );

        $this->add_control(
            'btm_color',
            [
                'label' => esc_html__('Button color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .search-submit' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btm_bgcolor',
            [
                'label' => esc_html__('Button background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .search-submit' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'srhbgclr',
            [
                'label' => esc_html__('Button hover background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .search-submit:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'sborder_color',
            [
                'label' => esc_html__('Button border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .search-submit' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'iknbdr',
            [
                'label' => esc_html__('Button border radius', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .search-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_pfiltr',
            [
                'label' => esc_html__('Price filter', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        ); 

        $this->add_control(
            'pfpclr',
            [
                'label' => esc_html__('Primary color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'default' => '#e7e7e7',
                'selectors' => [
                    '{{WRAPPER}} .ui-slider-range,{{WRAPPER}} .ui-slider-handle' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pfsclr',
            [
                'label' => esc_html__('Secondary color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ff6b6b',
                'selectors' => [
                    '{{WRAPPER}} .ui-widget-content' => 'background: {{VALUE}};',
                ],
            ]
        );  

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pfbtyp',
                'selector' => '{{WRAPPER}} .price_slider_amount .button',
                'label' => esc_html__('Button typography', 'the-pack-addon'),
            ]
        );

        $this->add_responsive_control(
            'pfbpd',
            [
                'label' => esc_html__('Button padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .price_slider_amount .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pfbbg',
            [
                'label' => esc_html__('Button background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_slider_amount .button' => 'background: {{VALUE}};',
                ],
            ]
        ); 

        $this->add_control(
            'pfbrade',
            [
                'label' => esc_html__('Button border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .price_slider_amount .button' => 'border-radius: {{SIZE}}px;',
                ],

            ]
        );

        $this->add_control(
            'pfbclr',
            [
                'label' => esc_html__('Button color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_slider_amount .button' => 'color: {{VALUE}};',
                ],
            ]
        ); 

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pfptyp',
                'selector' => '{{WRAPPER}} .price_slider_amount .price_label',
                'label' => esc_html__('Price typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'pfptclr',
            [
                'label' => esc_html__('Price color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_slider_amount .price_label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }


    protected function render()
    {
        $settings = $this->get_settings();
        if (Plugin::instance()->editor->is_edit_mode()) {
           
        }        
        require dirname(__FILE__) . '/view.php';
    } 
}

$widgets_manager->register(new \ThePackAddon\Widgets\The_Pack_Filter_Sidebar());
