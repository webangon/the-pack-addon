<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class thepack_date_count extends Widget_Base
{
    public function get_name()
    {
        return 'gng-timer';
    }

    public function get_title()
    {
        return esc_html__('Date timer', 'the-pack-addon');
    }

    public function get_categories()
    {
        return ['ashelement-addons'];
    }

    public function get_icon()
    {
        return 'dashicons dashicons-admin-customizer';
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_pricing_table',
            [
                'label' => esc_html__('Date Timer', 'the-pack-addon'),
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
                        'icon' => 'fa fa-folder',
                    ],
                    'two' => [
                        'title' => esc_html__('Two', 'the-pack-addon'),
                        'icon' => 'fa fa-folder-o',
                    ],

                    'three' => [
                        'title' => esc_html__('Three', 'the-pack-addon'),
                        'icon' => 'fa fa-folder-open',
                    ],

                ],
                'default' => 'one',
            ]
        );

        $this->add_control(
            'date',
            [
                'type' => Controls_Manager::DATE_TIME,
                'label' => esc_html__('Date', 'the-pack-addon'),
                'default' => 'YYYY-mm-dd',
            ]
        );

        $this->add_control(
            'show-hour',
            [
                'label' => esc_html__('Hide hour', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'the-pack-addon'),
                'label_off' => esc_html__('Off', 'the-pack-addon'),
                'selectors' => [
                    '{{WRAPPER}} .hour' => 'display: none;'
                ],
            ]
        );

        $this->add_control(
            'show-min',
            [
                'label' => esc_html__('Hide minute', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'the-pack-addon'),
                'label_off' => esc_html__('Off', 'the-pack-addon'),
                'selectors' => [
                    '{{WRAPPER}} .min' => 'display: none;'
                ],
            ]
        );

        $this->add_control(
            'show-sec',
            [
                'label' => esc_html__('Hide second', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'the-pack-addon'),
                'label_off' => esc_html__('Off', 'the-pack-addon'),
                'selectors' => [
                    '{{WRAPPER}} .sec' => 'display: none;'
                ],
            ]
        );

        $this->add_control(
            'dayl',
            [
                'label' => esc_html__('Day label', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('days', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'hourl',
            [
                'label' => esc_html__('Hour label', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('hours', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'minl',
            [
                'label' => esc_html__('Minute label', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('min', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'secl',
            [
                'label' => esc_html__('Second label', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('sec', 'the-pack-addon'),
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
            'width',
            [
                'label' => esc_html__('Column width', 'the-pack-addon'),
                'type' => Controls_Manager::NUMBER,
                'default' => '25',
                'selectors' => [
                    '{{WRAPPER}} .countdown.two>span' => 'width: {{VALUE}}%;',
                ],
                'condition' => [
                    'tmpl' => 'two',
                ],
            ]
        );

        $this->add_responsive_control(
            'itm_vp',
            [
                'label' => esc_html__('Vertical padding', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
                'condition' => [
                    'tmpl' => 'two',
                ],
                'selectors' => [
                    '{{WRAPPER}} .countdown.two>span' => 'padding-top:{{SIZE}}{{UNIT}};padding-bottom:{{SIZE}}{{UNIT}};',

                ],

            ]
        );

        $this->add_control(
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
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .countdown' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'inpad',
            [
                'label' => esc_html__('Item spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .countdown>span' => 'padding:0px {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .countdown' => 'margin-left:-{{SIZE}}{{UNIT}};margin-right:-{{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->start_controls_tabs('tctb');

        $this->start_controls_tab(
            'e1',
            [
                'label' => esc_html__('Days', 'the-pack-addon'),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'numty',
                'selector' => '{{WRAPPER}} .countdown>span',
                'label' => esc_html__('Typographt', 'the-pack-addon'),
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'e2',
            [
                'label' => esc_html__('Label', 'the-pack-addon'),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'utyp',
                'selector' => '{{WRAPPER}} .countdown>span span',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_responsive_control(
            'un_vp',
            [
                'label' => esc_html__('Spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -50,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .countdown span span' => 'top:{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .countdown.three span span' => 'padding-left:{{SIZE}}{{UNIT}};',

                ],

            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_sep',
            [
                'label' => esc_html__('Separator', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tmpl!' => 'two',
                ],
            ]
        );

        $this->add_control(
            'seo_color',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .countdown.one>span::before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'sp_sie',
            [
                'label' => esc_html__('Size', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .countdown.one>span::before' => 'font-size:{{SIZE}}{{UNIT}};',

                ],

            ]
        );

        $this->add_responsive_control(
            'sp_tp',
            [
                'label' => esc_html__('Vertical position', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -50,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .countdown.one>span::before' => 'top:{{SIZE}}{{UNIT}};',

                ],

            ]
        );

        $this->add_responsive_control(
            'sp_lp',
            [
                'label' => esc_html__('Horizontal position', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -50,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .countdown.one>span::before' => 'left:{{SIZE}}{{UNIT}};',

                ],

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_clr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'unt_color',
            [
                'label' => esc_html__('Unit color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .countdown>span span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'd_color',
            [
                'label' => esc_html__('Day number color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .days' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'd_bcolor',
            [
                'label' => esc_html__('Day background color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .days' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'tmpl' => 'two',
                ],
            ]
        );

        $this->add_control(
            'hr_color',
            [
                'label' => esc_html__('Hour number color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hour' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hr_bcolor',
            [
                'label' => esc_html__('Hour background color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hour' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'tmpl' => 'two',
                ],
            ]
        );

        $this->add_control(
            'mn_color',
            [
                'label' => esc_html__('Minute number color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .min' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mn_bcolor',
            [
                'label' => esc_html__('Minute background color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .min' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'tmpl' => 'two',
                ],
            ]
        );

        $this->add_control(
            'se_color',
            [
                'label' => esc_html__('Second number color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sec' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'se_bcolor',
            [
                'label' => esc_html__('Second background color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sec' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'tmpl' => 'two',
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

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_date_count());
