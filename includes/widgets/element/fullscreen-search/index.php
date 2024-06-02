<?php
namespace ThePackAddon\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class The_Pack_Full_Screen_Search extends Widget_Base
{
    public function get_name()
    {
        return 'tpfullscrnsearch';
    }

    public function get_title()
    {
        return esc_html__('Full screen search', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'eicon-form-horizontal';
    }

    public function get_categories()
    {
        return ['ashelement-addons'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Settings', 'the-pack-addon'),
            ]
        );
 
        $this->add_control(
            'ikn',
            [
                'label' => esc_html__('Icon', 'the-pack-addon'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'tivo ti-search',
                    'library' => 'themify-icons',
                ],
            ]
        );

        $this->add_control(
            'close',
            [
                'label' => esc_html__('Close icon', 'the-pack-addon'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'tivo ti-close',
                    'library' => 'themify-icons',
                ],
            ]
        );

        $this->add_control(
            'type',
            [
                'label' => esc_html__('Population', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'search' => [
                        'title' => esc_html__('Search', 'the-pack-addon'),
                        'icon' => 'eicon-search',
                    ],
                    'template' => [
                        'title' => esc_html__('Template', 'the-pack-addon'),
                        'icon' => 'eicon-folder-o',
                    ]
                ],
                'default' => 'search',
            ]
        );

        $this->add_control(
            'template',
            [
                'type' => Controls_Manager::SELECT2,
                'options' => thepack_footer_select(),
                'multiple' => false,
                'label' => esc_html__('Template', 'the-pack-addon'),
                'label_block' => true,
                'condition' => [
                    'type' => 'template',
                ],
            ]
        );

        $this->add_control(
            'place',
            [
                'label' => esc_html__('Placeholder text', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Search here...',
                'label_block' => true,
                'condition' => [
                    'type' => 'search',
                ],                
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_taps',
            [
                'label' => esc_html__('Search icon', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'spad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .seachicon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'sfs',
            [
                'label' => esc_html__('Font size', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .seachicon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'sbrad',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .seachicon' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'srclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .seachicon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'srbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .seachicon' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bdgclr',
            [
                'label' => esc_html__('Border', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .seachicon' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_ovly',
            [
                'label' => esc_html__('Overlay', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ovbg',
                'selector' => '{{WRAPPER}} .tp-fs-search-wrap',
                'label' => esc_html__('Background', 'the-pack-addon'),
            ]
        );

        $this->add_responsive_control(
            'frwid',
            [
                'label' => esc_html__('Width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ]
                ],
                'default' => [
                    'size' => 35,
                    'unit' => '%',
                ],                
                'size_units' => ['px','%'],
                'selectors' => [
                    '{{WRAPPER}} .tpinner' => 'width: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'frmht',
            [
                'label' => esc_html__('Minimum height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tpinner' => 'min-height: {{SIZE}}vh;',
                ],

            ]
        );

        $this->start_controls_tabs('gt');

        $this->start_controls_tab(
            't1',
            [
                'label' => esc_html__('Form', 'the-pack-addon'),
            ]
        );

        $this->add_responsive_control(
            'fmpd',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px'],
                'selectors' => [
                    '{{WRAPPER}} form .search-field' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'fmclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .search-field,{{WRAPPER}} .search-field::placeholder' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'fmbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .search-field' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fmtyp',
                'selector' => '{{WRAPPER}} .search-field,{{WRAPPER}} .search-field::placeholder',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'fmbdr',
                'label' => esc_html__('Border', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .search-field',
            ]
        );

        $this->add_control(
            'sbclr',
            [
                'label' => esc_html__('Submit button color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .search-submit' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            't2',
            [
                'label' => esc_html__('Close', 'the-pack-addon'),
            ]
        );

        $this->add_responsive_control(
            'clpos',
            [
                'label' => esc_html__('Position', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 500,
                    ]
                ],
                'default' => [
                    'size' => 50,
                ],                
                'size_units' => ['px','%'],
                'selectors' => [
                    '{{WRAPPER}} .closepop' => 'top: {{SIZE}}{{UNIT}};right: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'cfisx',
            [
                'label' => esc_html__('Font size', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .closepop' => 'font-size: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'cficlr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .closepop' => 'color: {{VALUE}};',
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

$widgets_manager->register(new \ThePackAddon\Widgets\The_Pack_Full_Screen_Search());
