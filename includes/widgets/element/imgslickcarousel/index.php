<?php
namespace ThePackAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

// Exit if accessed directly

class thepack_slickcarousl extends Widget_Base
{
    public function get_name()
    {
        return 'tp-slkcrsl';
    }

    public function get_title()
    {
        return esc_html__('Image Box', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-controls-skipback';
    }

    public function get_categories()
    {
        return ['ashelement-addons'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_pricing_table',
            [
                'label' => esc_html__('Data', 'the-pack-addon'),
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
                        'icon' => 'eicon-document-file',
                    ],
                    'two' => [
                        'title' => esc_html__('Two', 'the-pack-addon'),
                        'icon' => 'eicon-folder-o',
                    ],
                    // 'three' => [
                    //     'title' => esc_html__('Three', 'the-pack-addon'),
                    //     'icon' => 'eicon-menu-toggle',
                    // ],
                ],
                'default' => 'one',
            ]
        );

        $this->add_control(
            'ttl',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Title', 'the-pack-addon'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'dsc',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label' => esc_html__('Description', 'the-pack-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'img',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => esc_html__('Image', 'the-pack-addon'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'msk',
            [
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'label' => esc_html__('Mask image', 'the-pack-addon'),
                'selectors' => array(
                    '{{WRAPPER}} .imgwrap' => '-webkit-mask: url({{URL}}) no-repeat center / contain;',
                )
            ]
        );

        $this->add_control(
            'url',
            [
                'label' => esc_html__('Link', 'the-pack-addon'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => esc_html__('http://your-link.com', 'the-pack-addon'),
            ]
        );
        $this->add_control(
            'btni',
            [
                'type' => Controls_Manager::ICONS,
                'label' => esc_html__('Button icon', 'the-pack-addon'),
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
            'hvthm',
            [
                'label' => esc_html__('Theme color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tpigbx' => '--thmcol: {{VALUE}};',
                ],
            ]
        ); 
        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__('Alignment', 'the-pack-addon'),
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
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tpigbx' => 'text-align: {{VALUE}};',
                ],
            ]
        );        
        $this->add_responsive_control(
            'gpd',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,              
                'size_units' => ['em', 'px','%'],
                'selectors' => [
                    '{{WRAPPER}} .tpigbx' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->add_control(
            'gvbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tpigbx' => 'background: {{VALUE}};',
                ],
            ]
        ); 
        $this->add_control(
            'gbdr',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tpigbx' => 'border:1px solid {{VALUE}};',
                ],
            ]
        ); 
        $this->add_control(
            'gvbu',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tpigbx,{{WRAPPER}} .tpigbx.style-two::after' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );        
        $this->add_control(
            'gbrq',
            [
                'label' => esc_html__('Overlay color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tpigbx.style-two::after' => 'background:{{VALUE}};',
                ],
                'condition' => [
                    'tmpl' => 'two',
                ],                 
            ]
        );      
        $this->add_control(
            'gbwrq',
            [
                'label' => esc_html__('Hover text color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tpigbx.style-two:hover .com-text' => 'color:{{VALUE}};',
                ],
                'condition' => [
                    'tmpl' => 'two',
                ],                  
            ]
        );            
        $this->end_controls_section();

        $this->start_controls_section(
            'section_tmp2',
            [
                'label' => esc_html__('Image', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'brg',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,              
                'size_units' => ['em', 'px','%'],
                'selectors' => [
                    '{{WRAPPER}} .imgwrap' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->add_control(
            'cntbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .imgwrap' => 'background: {{VALUE}};',
                ],
            ]
        );    
        $this->add_control(
            'ik_br',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .imgwrap' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'ikg_br',
            [
                'label' => esc_html__('Image radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .imgwrap img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_ttl',
            [
                'label' => esc_html__('Title', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        do_action('the_pack_typo', $this,'ttl_','.title',['margin']);

        $this->end_controls_section();

        $this->start_controls_section(
            'section_dsc',
            [
                'label' => esc_html__('Description', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        do_action('the_pack_typo', $this,'dsc_','.desc',['margin']);

        $this->end_controls_section();

        $this->start_controls_section(
            'section_ibtn',
            [
                'label' => esc_html__('Button', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );      
        $this->add_responsive_control(
            'bwh',
            [
                'label' => esc_html__('Width and height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tpbtn' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'bfs',
            [
                'label' => esc_html__('Font size', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tpbtn' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );   
        $this->add_control(
            'htx',
            [
                'label' => esc_html__('Hover color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tpigbx:hover .tpbtn' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'btsp',
            [
                'label' => esc_html__('Top spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tpbtn' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();
        if (!preg_match("/[^[:alnum:]_\/-]/",$settings['tmpl'])) {
            include plugin_dir_path(__FILE__) . $settings['tmpl'] . '.php';
        }
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_slickcarousl());
