<?php
namespace ThePackAddon\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
    exit; 
} // Exit if accessed directly

class The_Pack_Marquee_Service extends Widget_Base
{
    public function get_name()
    {
        return 'tpmqsrv';
    }

    public function get_title()
    {
        return esc_html__('Marquee service', 'thepackpro');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-image-rotate-left';
    }

    public function get_categories()
    {
        return ['thepack_pro'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_pricing_table',
            [
                'label' => esc_html__('Data', 'thepackpro'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Title', 'thepackpro'),
                'label_block' => true,
                'default' => 'Year',
            ]
        ); 

        $repeater->add_control(
            'url',
            [
                'label' => esc_html__('Link', 'thepackpro'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => 'https://profiles.wordpress.org/webangon/',
                ],
            ]
        );

        $repeater->add_control(
            'img',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => esc_html__('Image', 'thepackpro'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'bg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .service-inner' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'prevent_empty' => false,
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_html__('General', 'thepackpro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'gwd',
            [
                'label' => esc_html__('Width', 'the-pack-addon'),
                'type' => Controls_Manager::NUMBER,
                'default' => '25',
                'selectors' => [
                    '{{WRAPPER}} .service-items' => 'width: {{VALUE}}%;',
                ],
            ]
        );
        $this->add_responsive_control(
            'hgp',
            [
                'label' => esc_html__('Hover width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .service-items:hover' => 'width: {{SIZE}}%;',
                ],

            ]
        );

        $this->add_responsive_control(
            'igp',
            [
                'label' => esc_html__('Column gap', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .thepack-marquee-service' => 'gap: {{SIZE}}{{UNIT}};',
                ],

            ]
        );
        $this->add_responsive_control(
            'ikn_vp',
            [
                'label' => esc_html__('Column height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 700,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .service-img' => 'padding-top: {{SIZE}}{{UNIT}};',
                ],

            ]
        );
        $this->add_responsive_control(
            'ikn_br',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .service-inner' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );
        $this->add_control(
            'iktx_clr',
            [
                'label' => esc_html__('Hover overlay', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-img:before' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'cvb',
            [
                'label' => esc_html__('Content padding', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .service-content' => 'padding: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_prefix',
            [
                'label' => esc_html__('Marquee', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'btsx',
            [
                'label' => esc_html__('Bottom spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 500,
                    ],
                ],                
                'selectors' => [
                    '{{WRAPPER}} .text-line' => 'bottom: {{SIZE}}{{UNIT}};',
                ],

            ]
        );
        do_action('the_pack_gradient_typo', $this,'td_','.text-line');

        $this->add_control(
            'acx_clr',
            [
                'label' => esc_html__('Hover color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-items:hover .text-line span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_txt',
            [
                'label' => esc_html__('Text', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        do_action('the_pack_gradient_typo', $this,'txd_','.content-text a ');

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings();
        require dirname(__FILE__) . '/view.php';
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\The_Pack_Marquee_Service());
