<?php
namespace ThePackAddon\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\utils;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
 
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

 
class Tp_Blog_Gen extends Widget_Base {
 
    public function get_name() {
        return 'tp-blob';
    }

    public function get_title() {
        return __('Blob', 'educat');
    }

    public function get_icon() {
        return 'eicon-insert-image';
    }
    
    public function get_categories() {
        return array('eduquest-addons');
    } 

    protected function _register_controls() {

        $this->start_controls_section(
            'section_heading',
            [
                'label' => __('Data', 'educat'),
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
            'wd',   
            [
                'label' => esc_html__('Width', 'the-pack-addon'), 
                'type' => Controls_Manager::SLIDER,                    
                'range' => [
                    'px' => [
                        'max' => 1000,    
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-blob' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ht',   
            [
                'label' => esc_html__('Height', 'the-pack-addon'), 
                'type' => Controls_Manager::SLIDER,                    
                'range' => [
                    'px' => [
                        'max' => 1000,    
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-blob' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_typo',
                'selector' => '{{WRAPPER}} .tp-blob',
                'label' => esc_html__('Background', 'the-pack-addon'),
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'dxnbdr',
                'label' => esc_html__('Border', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .tp-blob',
            ]
        );

        $this->add_control(
            'obdr',
            [
                'label' => esc_html__('Oval border', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'banim',
            [
                'label' => esc_html__('Border animation', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_brd',
            [  
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE, 
            ]
        );
        $this->add_responsive_control(
            'brg',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,              
                'size_units' => ['em', 'px','%'],
                'selectors' => [
                    '{{WRAPPER}} .tp-blob' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'brg',   
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'), 
                'type' => Controls_Manager::SLIDER,  
                'condition' => [
                    'obdr' => '',
                ],                                   
                'range' => [
                    'px' => [
                        'max' => 1000,    
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-blob' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );        

        $this->add_responsive_control(
            'br1',
            [
                'label' => esc_html__('Border 1', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'condition' => [
                    'obdr' => 'yes',
                ],                
                'size_units' => ['em', 'px','%'],
                'selectors' => [
                    '{{WRAPPER}}.elementor-widget-tp-blob' => '--radius-1: {{TOP}}{{UNIT}};--radius-2: {{RIGHT}}{{UNIT}};--radius-3: {{BOTTOM}}{{UNIT}};--radius-4: {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'br2',
            [
                'label' => esc_html__('Border 2', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'condition' => [
                    'obdr' => 'yes',
                ],                 
                'size_units' => ['em', 'px','%'],
                'selectors' => [
                    '{{WRAPPER}}.elementor-widget-tp-blob' => '--radius-5: {{TOP}}{{UNIT}};--radius-6: {{RIGHT}}{{UNIT}};--radius-7: {{BOTTOM}}{{UNIT}};--radius-8: {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
 
        $settings = $this->get_settings();
        require dirname(__FILE__) .'/view.php';

   }

} 

$widgets_manager->register(new \ThePackAddon\Widgets\Tp_Blog_Gen());