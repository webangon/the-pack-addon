<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\utils;

if (!defined('ABSPATH')) {
    exit;
}

class thepack_case_grid extends Widget_Base
{
    public function get_name()
    {
        return 'tp_case_grid';
    } 
    // Enqueue styles
	public function get_style_depends() {
		return ['swiper','e-swiper'];
	}

	// Enqueue scripts
	public function get_script_depends() {
		return ['swiper'];
	}

    public function get_title()
    {
        return esc_html__('Case grid', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-admin-generic';
    }

    public function get_categories()
    {
        return ['ashelement-addons'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_process_1',
            [
                'label' => esc_html__('Content', 'the-pack-addon'),
            ]
        );

        $repeater1 = new \Elementor\Repeater();

        $repeater1->add_control(
            'name',
            [
                'label' => esc_html__('Title', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Mr Wick',
            ]
        );

        $repeater1->add_control(
            'pos',
            [
                'label' => esc_html__('Description', 'the-pack-addon'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Google,Gamer',
            ]
        );

        $repeater1->add_control(
            'img',
            [
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true,
                'label' => esc_html__('Background image', 'the-pack-addon'),
            ]
        );


        $repeater1->add_control(
            'url',
            [
                'label' => esc_html__('Link', 'the-pack-addon'),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('http://your-link.com', 'the-pack-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'items',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater1->get_controls(),
                'prevent_empty' => false,
                'default' => [
                    [
                        'name' => esc_html__('Mr Wick', 'the-pack-addon'),
                    ]
                ],
                'title_field' => '{{{name}}}',
            ]
        );

        $this->add_control(
            'ikn',
            [
                'label' => esc_html__('Button icon', 'the-pack-addon'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
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

        $this->add_control(
            'style',
            [
                'label' => esc_html__('Display', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'one' => [
                        'title' => esc_html__('Style one', 'the-pack-addon'),
                        'icon' => 'eicon-gallery-grid',
                    ],
                    'two' => [
                        'title' => esc_html__('Style two', 'the-pack-addon'),
                        'icon' => 'eicon-slider-album',
                    ]
                ],
                'default' => 'one',
            ]
        );

        $this->add_control(
            'disp',
            [
                'label' => esc_html__('Display', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'grid' => [
                        'title' => esc_html__('Grid', 'the-pack-addon'),
                        'icon' => 'eicon-gallery-grid',
                    ],
                    'slider' => [
                        'title' => esc_html__('Slider', 'the-pack-addon'),
                        'icon' => 'eicon-slider-album',
                    ]
                ],
                'default' => 'grid',
            ]
        );

        $this->add_responsive_control(
            'wdidth',
            [
                'label' => esc_html__('Column width', 'the-pack-addon'),
                'type' => Controls_Manager::NUMBER,
                'default' => '33.33',
                'selectors' => [
                    '{{WRAPPER}} .tp-df-33' => 'width: {{VALUE}}%;flex:0 0 {{VALUE}}%;', 
                ],
                'condition' => [
                    'disp' => 'grid', 
                ],
            ]
        );

        $this->add_responsive_control(
            'gap',
            [
                'label' => esc_html__('Gap', 'thepackpro'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tp-gutter' => 'margin: -{{SIZE}}{{UNIT}} 0 0 -{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tp-gutter>div[class^="tp-df-"]' => 'padding: {{SIZE}}{{UNIT}} 0 0 {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'disp' => 'grid',
                ],                
            ]
        );

        $this->add_responsive_control(
            'bht',
            [
                'label' => esc_html__('Height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .card-image-wrapper img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'fover',
                'label' => esc_html__('Background overlay', 'the-pack-addon'),
                'types' => ['none', 'classic', 'gradient'],
                'selector' => '{{WRAPPER}} .card-image-wrapper::before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_quote',
            [
                'label' => esc_html__('Content', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'inpalign',
            [
                'label' => esc_html__('Text alignment', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'the-pack-addon'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .service-card-content' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'c_pad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .service-card-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'bps',
            [
                'label' => esc_html__('Bottom position', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .service-card-content' => 'bottom: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'bphs',
            [
                'label' => esc_html__('Hover Bottom position', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tp-img-card .item:hover .service-card-content' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'cbgt',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item:hover .service-card-content' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'bdf',
            [
                'label' => esc_html__('Backdrop blur', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .item:hover .service-card-content' => 'backdrop-filter:blur({{SIZE}}{{UNIT}});-webkit-backdrop-filter:blur({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->start_controls_tabs('mtabu');

        $this->start_controls_tab(
            'm1',
            [
                'label' => esc_html__('Title', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'q_clr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title,{{WRAPPER}} .title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'q_pad',
            [
                'label' => esc_html__('Margin', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'q_typo',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .title',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'm2',
            [
                'label' => esc_html__('Sub', 'the-pack-addon'),
            ]
        );

        do_action('the_pack_typo', $this,'dsc_','.desc',['margin']);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'm3',
            [
                'label' => esc_html__('Button', 'the-pack-addon'),
            ]
        );

        do_action('the_pack_typo', $this,'bg_','.link',['bg','width','height','radius','border']);

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        do_action('the_pack_swiper_control', $this,true);

    }

    protected function render()
    {
        $settings = $this->get_settings();
        if (ctype_alnum($settings['style']) ){
            require dirname(__FILE__) . '/' .esc_attr($settings['style']).'.php';
        }
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_case_grid());
