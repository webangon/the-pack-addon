<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Utils;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class thepack_hover_bg_service extends Widget_Base
{
    public function get_name()
    {
        return 'tphvrbgs';
    }

    public function get_title()
    {
        return esc_html__('Hover service', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-filter';
    }

    public function get_categories()
    {
        return ['ashelement-addons'];
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
            'tmpl',
            [
                'label' => esc_html__('Template', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'one' => [
                        'title' => esc_html__('One', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'two' => [
                        'title' => esc_html__('Two', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'default' => 'one',
            ]
        );

        $this->add_control(
            'pre',
            [
                'label' => esc_html__('Pre title', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        $this->add_control(
            'ttl',
            [
                'label' => esc_html__('Title', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        $this->add_control(
            'desc',
            [
                'label' => esc_html__('Description', 'the-pack-addon'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );
        $this->add_control(
            'url',
            [
                'label' => esc_html__('Url', 'the-pack-addon'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => esc_html__('http://your-link.com', 'the-pack-addon'),
            ]
        );
        $this->add_control(
            'icon',
            [
                'label' => esc_html__('Button icon', 'the-pack-addon'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
            ]
        );
        $this->add_control(
            'img',
            [
                'label' => esc_html__('Image', 'the-pack-addon'),
                'type' => Controls_Manager::MEDIA,
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
        $this->add_responsive_control(
            'gpd',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tp-service-hover-bg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ovbg',
                'selector' => '{{WRAPPER}} .bg::before',
				'fields_options' => [
					'background' => [
						'label' => esc_html__( 'Background overlay','the-pack-addon' ),
					]
				]                  
            ]
        );  
        $this->add_responsive_control(
            'cold',
            [
                'label' => esc_html__('Column display', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .tp-content' => 'flex-direction:column;',
                ],
            ]
        );
        $this->add_responsive_control(
            'lal',
            [
                'label' => esc_html__('Left align', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .tp-content' => 'align-items:flex-start;',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__('Title', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );    

        $this->add_responsive_control(
            'twid',
            [
                'label' => esc_html__('Wrapper width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'selectors' => [
                    '{{WRAPPER}} .tp-title' => 'flex:0 0 {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'twgt',
            [
                'label' => esc_html__('Title spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'selectors' => [
                    '{{WRAPPER}} .tp-title' => 'gap:{{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'yld',
            [
                'label' => esc_html__('Column display', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .tp-title' => 'flex-direction:column;',
                ],
            ]
        );       
        $this->add_responsive_control(
            'tal',
            [
                'label' => esc_html__('Left align', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .tp-title' => 'align-items:flex-start;',
                ],
            ]
        );

        $this->start_controls_tabs('tctb');

        $this->start_controls_tab(
            'e1',
            [
                'label' => esc_html__('Pre title', 'the-pack-addon'),
            ]
        );

        do_action('the_pack_typo', $this,'prf_','.pre',['']);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'e2',
            [
                'label' => esc_html__('Title', 'the-pack-addon'),
            ]
        );

        do_action('the_pack_typo', $this,'ttl_','.title',['margin']);

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_dsc',
            [
                'label' => esc_html__('Description', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );        
        $this->add_responsive_control(
            'cld',
            [
                'label' => esc_html__('Column display', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .tp-desc' => 'flex-direction:column;',
                ],
            ]
        );

        do_action('the_pack_typo', $this,'dsc_','.desc',['margin']);

        $this->end_controls_section();

        $this->start_controls_section(
            'section_btn',
            [
                'label' => esc_html__('Button', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );        

        do_action('the_pack_typo', $this,'btn_','.tpbtn',['width','height','radius','border','bg']);

        $this->add_control(
            'hbbg',
            [
                'label' => esc_html__('Hover background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-service-hover-bg:hover .tpbtn' => 'background:{{VALUE}};border-color:{{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hbbkl',
            [
                'label' => esc_html__('Hover color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-service-hover-bg:hover .tpbtn' => 'color:{{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();
        require dirname(__FILE__) . '/view.php';
    }

}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_hover_bg_service());
