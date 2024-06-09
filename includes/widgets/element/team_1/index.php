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

class thepack_team1 extends Widget_Base
{
    public function get_name()
    {
        return 'tb_team1';
    }

    public function get_title()
    {
        return esc_html__('Team 1', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-post-status';
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
                'label' => esc_html__('Name', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Mr Wick',
            ]
        );

        $repeater1->add_control(
            'pos',
            [
                'label' => esc_html__('Position', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Google,Gamer',
            ]
        );

        $repeater1->add_control(
            'url',
            [
                'label' => esc_html__('Link', 'the-pack-addon'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
            ]
        );

        $repeater1->add_control(
            'avatar',
            [
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true,
                'label' => esc_html__('Avatar', 'the-pack-addon'),
            ]
        );

        $repeater1->add_control(
            'fb',
            [
                'label' => esc_html__('Facebook url', 'the-pack-addon'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => 'https://profiles.wordpress.org/webangon/',
                ],
            ]
        );

        $repeater1->add_control(
            'tw',
            [
                'label' => esc_html__('Twitter url', 'the-pack-addon'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => 'https://profiles.wordpress.org/webangon/',
                ],
            ]
        );

        $repeater1->add_control(
            'lnk',
            [
                'label' => esc_html__('Linkedin url', 'the-pack-addon'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => 'https://profiles.wordpress.org/webangon/',
                ],
            ]
        );

        $repeater1->add_control(
            'ig',
            [
                'label' => esc_html__('Instagram url', 'the-pack-addon'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => 'https://profiles.wordpress.org/webangon/',
                ],
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

        $this->end_controls_section();

        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_html__('General', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
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

        $this->add_control(
            'anim',
            [
                'label' => esc_html__('Animation', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT,
                'options' => thepack_animations(),
                'label_block' => true,
                'condition' => [
                    'disp' => 'grid',
                ],
            ]
        );

        $this->add_responsive_control(
            'width',
            [
                'label' => esc_html__('Column width', 'the-pack-addon'),
                'type' => Controls_Manager::NUMBER,
                'default' => '33.33',
                'selectors' => [
                    '{{WRAPPER}} .team1' => 'width: {{VALUE}}%;',
                ],
                'condition' => [
                    'disp' => 'grid',
                ],
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => esc_html__('Item Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .team1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .tbteam1' => 'margin-left: -{{LEFT}}{{UNIT}};margin-right:-{{RIGHT}}{{UNIT}};',
                ],
                'condition' => [
                    'disp' => 'grid',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'label' => esc_html__('Box shadow', 'the-pack-addon'),
                'name' => 'img_box_sha',
                'selector' => '{{WRAPPER}} .team1 .inner',
            ]
        );

        $this->add_responsive_control(
            'thmwht',
            [
                'label' => esc_html__('Thumbnail wrapper height', 'the-pack-addon'),
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
                    '{{WRAPPER}} .team-container' => 'height: {{SIZE}}{{UNIT}};',
                ],
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

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'overlay_color',
                'label' => esc_html__('Background', 'elementor'),
                'types' => ['none', 'classic', 'gradient'],
                'selector' => '{{WRAPPER}} .team-content',
            ]
        );

        $this->add_responsive_control(
            'cpad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .team-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    'justify' => [
                        'title' => esc_html__('Justified', 'the-pack-addon'),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .team-content' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs('ctb');

        $this->start_controls_tab(
            'ctb1',
            [
                'label' => esc_html__('Name', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'q_clr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'q_pad',
            [
                'label' => esc_html__('Margin', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'q_typo',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .name',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ctb2',
            [
                'label' => esc_html__('Position', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'p_clr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pos' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'p_pad',
            [
                'label' => esc_html__('Margin', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pos' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'p_typo',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .pos',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_social',
            [
                'label' => esc_html__('Social', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'imwds',
            [
                'label' => esc_html__('Max wrapper width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .team-link' => 'width: {{SIZE}}%;',
                ],
            ]
        );

        $this->add_control(
            'sbgc',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-link' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            's_clr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-link a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'isbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-link a' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'iwht',
            [
                'label' => esc_html__('Width & height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .team-link a' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'iwlh',
            [
                'label' => esc_html__('Line height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .team-link a' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'sze',
            [
                'label' => esc_html__('Font size', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .team-link a' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'rm',
            [
                'label' => esc_html__('Item spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .team-link a' => 'margin:0px {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'rmty',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .team-link a' => 'border-radius:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'vpos',
            [
                'label' => esc_html__('Vertical position', 'the-pack-addon'),
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
                    '{{WRAPPER}} .team-link' => 'bottom: -{{SIZE}}%;',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_carousel',
            [
                'label' => esc_html__('Carousel', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'disp' => 'slider',
                ],
            ]
        );

        $this->add_control(
            'sxipd',
            [
                'label' => esc_html__('Padding', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .swiper-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'fw',
            [
                'label' => esc_html__('Boxed container', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'selectors' => [
                    '{{WRAPPER}} .swiper-container' => 'overflow: hidden;',
                ],
            ]
        );

        $this->add_control(
            'arrow',
            [
                'label' => esc_html__('Display arrow', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'the-pack-addon'),
                'label_off' => esc_html__('No', 'the-pack-addon'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'mouse',
            [
                'label' => esc_html__('Mouse scroll', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'the-pack-addon'),
                'label_off' => esc_html__('No', 'the-pack-addon'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'dot',
            [
                'label' => esc_html__('Hide dot', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'the-pack-addon'),
                'label_off' => esc_html__('No', 'the-pack-addon'),
                'return_value' => 'yes',
                'default' => 'no',
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination' => 'display: none;',
                ],
            ]
        );

        $this->add_control(
            'space',
            [
                'label' => esc_html__('Spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
                'default' => [
                    'size' => 30,
                ],
            ]
        );

        $this->add_control(
            'item',
            [
                'label' => esc_html__('Item per slide', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 3,
                ],
                'size_units' => ['px'],
            ]
        );

        $this->add_control(
            'item_tab',
            [
                'label' => esc_html__('Item per slide - Tablet', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 5,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 2,
                ],
                'size_units' => ['px'],
            ]
        );

        $this->add_control(
            'speed',
            [
                'label' => esc_html__('Slide speed', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 8000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 3000,
                ],
                'size_units' => ['px'],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_pagi',
            [
                'label' => esc_html__('Slider Arrow', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'arrow' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'picon',
            [
                'type' => Controls_Manager::ICONS,
                'label' => esc_html__('Prev icon', 'the-pack-addon'),
                'label_block' => true,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );

        $this->add_control(
            'nicon',
            [
                'type' => Controls_Manager::ICONS,
                'label' => esc_html__('Next icon', 'the-pack-addon'),
                'label_block' => true,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );

        $this->add_control(
            'pgi_bg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .khbprnx' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pgi_c',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .khbprnx' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pgwd',
            [
                'label' => esc_html__('Width and height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                        'min' => 1,
                        'step' => 1,
                    ]
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .khbprnx' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],

            ]
        );
 
        $this->add_responsive_control(
            'pgbrad',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                        'min' => 1,
                        'step' => 1,
                    ]
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .khbprnx' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_nav',
            [
                'label' => esc_html__('Slider Dot', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'dot!' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'navpos',
            [
                'label' => esc_html__('Postion', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 300,
                        'min' => -300,
                        'step' => 1,
                    ]
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination' => 'bottom: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'navcol',
            [
                'label' => esc_html__('Dot color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'navacol',
            [
                'label' => esc_html__('Dot active color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet-active' => 'background-color: {{VALUE}};',
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

    private function content($content, $anim, $type)
    {
        $out1 = '';

        foreach ($content as $item) {
            switch ($type) {
                case 'slider':
                    $cls = 'swiper-slide';
                    break;

                case 'grid':
                    $cls = $anim;
                    break;

                default:
            }

            $img = thepack_ft_images($item['avatar']['id'], 'full');
            $name = $item['url']['url'] ? '<a ' . thepack_get_that_link($item['url']) . '><h3 class="name">' . $item['name'] . '</h3></a>' : '<h3 class="name">' . $item['name'] . '</h3>';
            $pos = $item['pos'] ? '<p class="pos">' . $item['pos'] . '</p>' : '';

            $fb = $item['fb']['url'] ? '<a ' . thepack_get_that_link($item['fb']) . '><i class="fab fa-facebook-f"></i></a>' : '';
            $tw = $item['tw']['url'] ? '<a ' . thepack_get_that_link($item['tw']) . '><i class="fab fa-twitter"></i></a>' : '';
            $lnk = $item['lnk']['url'] ? '<a ' . thepack_get_that_link($item['lnk']) . '><i class="fab fa-linkedin-in"></i></a>' : '';
            $ig = $item['ig']['url'] ? '<a ' . thepack_get_that_link($item['ig']) . '><i class="fab fa-instagram"></i></a>' : '';

            $out1 .= '
                <div class="team1 ' . $cls . '">
                    <div class="inner">
                    <div class="team-container">
                        ' . $img . '
                        <div class="team-link">
                        ' . $fb . $tw . $lnk . $ig . '
                        </div>
                    </div>
                    <div class="team-content">
                        ' . $name . $pos . '
                    </div>
                </div></div>
            ';
        }

        return thepack_build_html($out1);
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_team1());
