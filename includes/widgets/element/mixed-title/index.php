<?php
namespace ThePackAddon\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\utils;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
 
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

 
class Tp_Mixed_Tilte extends Widget_Base {
 
    public function get_name() {
        return 'tp-mtitle';
    }

    public function get_title() {
        return __('Mixed title', 'educat');
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

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'type',
            [
                'label' => esc_html__('Population', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text' => [
                        'title' => esc_html__('Text', 'the-pack-addon'),
                        'icon' => ' eicon-document-file',
                    ],
                    'img' => [
                        'title' => esc_html__('Image', 'the-pack-addon'),
                        'icon' => 'eicon-image-rollover',
                    ],
                    'icon' => [
                        'title' => esc_html__('Icon', 'the-pack-addon'),
                        'icon' => 'eicon-image-rollover',
                    ],
                    'br' => [
                        'title' => esc_html__('Line break', 'the-pack-addon'),
                        'icon' => 'eicon-image-rollover',
                    ]                    
                ],
                'default' => 'text',
            ]
        );
        
        $repeater->add_control(
            'txt',
            [
                'label' => esc_html__('Text', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'condition' => [
                    'type' => 'text',
                ],
            ]
        );

        $repeater->add_control(
            'msk',
            [
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'type' => 'text',
                ],
                'label_block' => true,
                'label' => esc_html__('Mask image', 'the-pack-addon'),
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}.txt::before' => '-webkit-mask: url({{URL}}) no-repeat center / contain;',
                )
            ]
        );

        $repeater->add_responsive_control(
            'tpd',
            [
                'label' => esc_html__('Padding', 'educat'),
                'type' => Controls_Manager::DIMENSIONS,
                'condition' => [
                    'type' => ['text'],
                ],                  
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.txt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_control(
            'bg', [
                'label' =>   esc_html__( 'Mask color', 'educat' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.txt::before' => 'background-color: {{VALUE}};',
                ],   
                'condition' => [
                    'type' => ['text'],
                ],             
            ] 
        );

        $repeater->add_control(
            'color', [
                'label' =>   esc_html__( 'Color', 'educat' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.txt' => 'color: {{VALUE}};',
                ],   
                'condition' => [
                    'type' => ['text','icon'],
                ],             
            ] 
        ); 

        $repeater->add_control(
            'bkl', [
                'label' =>   esc_html__( 'Border color', 'educat' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.txt' => 'border:1px solid {{VALUE}};',
                ],   
                'condition' => [
                    'type' => ['text','icon'],
                ],             
            ] 
        ); 

        $repeater->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typ',
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}.txt',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $repeater->add_control(
            'img',
            [ 
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'type' => 'img',
                ],
                'label_block' => true,
                'label' => esc_html__('Image', 'the-pack-addon'),
            ]
        );

        $repeater->add_responsive_control(
            'wid',
            [
                'label' => esc_html__('Image width/ icon size', 'educat'),
                'type' => Controls_Manager::SLIDER,
                'condition' => [
                    'type' => ['img','icon'],
                ],                 
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.img' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} {{CURRENT_ITEM}}.icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'ht',
            [
                'label' => esc_html__('Image height', 'educat'),
                'type' => Controls_Manager::SLIDER,
                'condition' => [
                    'type' => ['img'],
                ],                 
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.img' => 'height: {{SIZE}}{{UNIT}};object-fit:cover;',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'brd',
            [
                'label' => esc_html__('Border radius', 'educat'),
                'type' => Controls_Manager::SLIDER,                
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.txt,{{WRAPPER}} {{CURRENT_ITEM}}.img,{{WRAPPER}} {{CURRENT_ITEM}}.icon' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'vps',
            [
                'label' => esc_html__('Vertical position', 'educat'),
                'type' => Controls_Manager::SLIDER,
                'condition' => [
                    'type' => ['img','icon','text'],
                ],        
                'range' => [
                    'px' => [
                        'min' => -300,
                        'max' => 300,
                    ],
                ],         
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{SIZE}}{{UNIT}};position:relative;',
                ],
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'type' => Controls_Manager::ICONS,
                'label' => esc_html__('Icon', 'the-pack-addon'),
                'condition' => [
                    'type' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'tabs',
            [
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section();
 
        $this->start_controls_section(
            'section_general',
            [
                'label' => __('General', 'educat'),
                'tab' => Controls_Manager::TAB_STYLE,               
            ]
        );

        $this->add_control(
            'dal',
            [
                'label' => esc_html__('Alignment', 'educat'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'educat'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'educat'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'educat'),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container' => 'text-align: {{VALUE}};',
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

$widgets_manager->register(new \ThePackAddon\Widgets\Tp_Mixed_Tilte());