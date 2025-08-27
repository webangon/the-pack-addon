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

 
class Tp_Circle_Dots extends Widget_Base {
 
    public function get_name() {
        return 'tp-cdot';
    }

    public function get_title() {
        return __('Circle dots', 'educat');
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
            'section_brd',
            [  
                'label' => esc_html__('General', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE, 
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
                    '{{WRAPPER}} .tp-circle-dot' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};',
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

$widgets_manager->register(new \ThePackAddon\Widgets\Tp_Circle_Dots());