<?php
namespace ThePackAddon\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\utils;

if (!defined('ABSPATH')) {
    exit;
}

class thepack_img_acrdn extends Widget_Base
{
    public function get_name()
    {
        return 'tp_tab';
    }

    public function get_title()
    {
        return esc_html__('Tab', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-video-alt3';
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

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'type',
            [
                'label' => esc_html__('Population', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text' => [
                        'title' => esc_html__('Content', 'the-pack-addon'),
                        'icon' => ' eicon-document-file',
                    ],
                    'template' => [
                        'title' => esc_html__('Template', 'the-pack-addon'),
                        'icon' => 'eicon-image-rollover',
                    ]
                ],
                'default' => 'text',
            ]
        );

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Label', 'the-pack-addon'),
                'label_block' => true,
                'default' => 'Car Insurance',
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'type' => Controls_Manager::ICONS,
                'label' => esc_html__('Icon', 'the-pack-addon'),
            ]
        );

        $repeater->add_control(
            'content',
            [
                'label' => esc_html__('Content', 'the-pack-addon'),
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
                'condition' => [
                    'type' => 'text',
                ],
            ]
        );

        $repeater->add_control(
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
            'tabs',
            [
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => esc_html__('Finance', 'the-pack-addon'),
                    ]
                ],
                'title_field' => '{{{ title }}}',
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
                'label' => esc_html__('Style', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'one' => [
                        'title' => esc_html__('One', 'the-pack-addon'),
                        'icon' => ' eicon-document-file',
                    ],
                    'two' => [
                        'title' => esc_html__('Two', 'the-pack-addon'),
                        'icon' => 'eicon-image-rollover',
                    ]
                ],
                'default' => 'one',
            ]
        );

        do_action('the_pack_flex', $this,'gf_','.tp-tab',['']);

        $this->add_responsive_control(
            'nvx',
            [
                'label' => esc_html__('Nav width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 800,
                        'step' => 1,
                    ]
                ],
                'size_units' => ['px','%'],
                'selectors' => [
                    '{{WRAPPER}} .tab-area' => 'flex:0 0 {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_hdig',
            [
                'label' => esc_html__('Heading', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'fwhd',
            [
                'label' => esc_html__('Full width', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} li' => 'width: 100%;',
                ],
            ]
        );
        do_action('the_pack_flex', $this,'tt_','.tab-area',['']);

        $this->end_controls_section();

        $this->start_controls_section(
            'section_ttl',
            [
                'label' => esc_html__('Title', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            't-pad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px'],
                'selectors' => [
                    '{{WRAPPER}} li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        do_action('the_pack_flex', $this,'hdf_','li',['']);

        $this->start_controls_tabs('tctb');

        $this->start_controls_tab(
            'e1',
            [
                'label' => esc_html__('Normal', 'the-pack-addon'),
            ]
        );
        $this->add_control(
            'ntbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} li' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'nabdr',
                'label' => esc_html__('Border', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} li',
            ]
        );        
        $this->end_controls_tab();

        $this->start_controls_tab(
            'e2',
            [
                'label' => esc_html__('Active', 'the-pack-addon'),
            ]
        );
        $this->add_control(
            'nthbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} li.active' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ntr',
                'label' => esc_html__('Border', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} li.active',
            ]
        );        
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();


        $this->start_controls_section(
            'section_desc',
            [
                'label' => esc_html__('Description', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'd-algn',
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
                    '{{WRAPPER}} .tab-wrap' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'desc_bg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-content' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_ty',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .tab-content',
            ]
        );

        $this->add_responsive_control(
            'desc_pd',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'dsc_bclr',
                'label' => esc_html__('Border', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .tab-content',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_styl2',
            [
                'label' => esc_html__('Style 2', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['two'],
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

    private function icon_image($icon)
    {
        $type = $icon['type'];
        if ($type == 'template') {
            return do_shortcode('[THEPACK_INSERT_TPL id="' . $icon['template'] . '"]');
            ;
        } else {
            return $icon['content'];
        }
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_img_acrdn());
