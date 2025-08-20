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

 
class Tp_Swiper_Arrow extends Widget_Base {
 
    public function get_name() {
        return 'tp-swiper-arrow';
    }

    public function get_title() {
        return __('Swiper arrow', 'educat');
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

        $this->add_control(
            'cls',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Slider class', 'the-pack-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tmpl',
            [
                'label' => esc_html__('Type', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'icon' => [
                        'title' => esc_html__('Icon', 'the-pack-addon'),
                        'icon' => 'eicon-text-area',
                    ],
                    'text' => [
                        'title' => esc_html__('Text', 'the-pack-addon'),
                        'icon' => 'eicon-image',
                    ],
                ],
                'default' => 'icon',
            ]
        );

        $this->add_control(
            'previ',
            [
                'type' => Controls_Manager::ICONS,
                'label' => esc_html__('Previous Icon', 'the-pack-addon'),
                'label_block' => true,
                'condition' => [
                    'tmpl' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'nexti',
            [
                'type' => Controls_Manager::ICONS,
                'label' => esc_html__('Next Icon', 'the-pack-addon'),
                'label_block' => true,
                'condition' => [
                    'tmpl' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'prevt',
            [
                'type' => Controls_Manager::ICONS,
                'label' => esc_html__('Previous Text', 'the-pack-addon'),
                'label_block' => true,
                'condition' => [
                    'tmpl' => 'text',
                ],
            ]
        );

        $this->add_control(
            'nextt',
            [
                'type' => Controls_Manager::ICONS,
                'label' => esc_html__('Next Text', 'the-pack-addon'),
                'label_block' => true,
                'condition' => [
                    'tmpl' => 'text',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_html__('General', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'jst',
            [
                'label' => esc_html__('Justify content', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Start', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'the-pack-addon'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('End', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-right',
                    ],
                    'space-between' => [
                        'title' => esc_html__('Space between', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-right',
                    ],
                    'space-evenly' => [
                        'title' => esc_html__('Space evenly', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-right',
                    ]                    
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-swiper-arrow' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gp',
            [
                'label' => esc_html__('Gap', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tp-swiper-arrow' => 'gap: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'luty',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .tp-swiper-arrow',
            ]
        );

        $this->add_control(
            'bg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-swiper-arrow span' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'clr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-swiper-arrow span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bhg',
            [
                'label' => esc_html__('Hover Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-swiper-arrow span:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'chlr',
            [
                'label' => esc_html__('Hover Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-swiper-arrow span:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bclr',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-swiper-arrow span' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'brad',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tp-swiper-arrow span' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'g-pad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .tp-swiper-arrow span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

$widgets_manager->register(new \ThePackAddon\Widgets\Tp_Swiper_Arrow());