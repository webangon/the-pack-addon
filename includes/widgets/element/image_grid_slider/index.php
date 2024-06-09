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
} // Exit if accessed directly

class The_Pack_Image_Grid_Slider extends Widget_Base
{
    public function get_name()
    {
        return 'tp-img-grid-slider';
    }

    public function get_title()
    {
        return esc_html__('Image Grid', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-media-text';
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
            'img',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => esc_html__('Image', 'the-pack-addon'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater1->add_control(
            'label',
            [
                'label' => esc_html__('Heading', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater1->add_control(
            'desc',
            [
                'label' => esc_html__('Description', 'the-pack-addon'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true, 
            ]
        );

        $repeater1->add_control(
            'color',
            [
                'label' => esc_html__('Background', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'label_block' => true,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .items-wrap' => 'background: {{VALUE}};',
                ],
            ]
        );

        $repeater1->add_control(
            'url',
            [
                'label' => esc_html__('Button url', 'the-pack-addon'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => esc_html__('http://your-link.com', 'the-pack-addon'),
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
                        'label' => esc_html__('Awards & Accolades', 'the-pack-addon'),
                    ]
                ],
                'title_field' => '{{{label}}}',
            ]
        );

        $this->add_control(
            'img_size',
            [
                'label' => esc_html__('Image size', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => thepack_image_size_choose(),
                'multiple' => false,
            ]
        );

        $this->add_control(
            'bticon',
            [
                'label' => esc_html__('Zoom icon', 'the-pack-addon'),
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
            'display',
            [
                'label' => esc_html__('Display - Carousel or grid', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'grid' => [
                        'title' => esc_html__('Grid', 'the-pack-addon'),
                        'icon' => 'eicon-posts-grid',
                    ],
                    'carousel' => [
                        'title' => esc_html__('Carousel', 'the-pack-addon'),
                        'icon' => 'eicon-slider-push',
                    ],
                ],

                'default' => 'grid',
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
                    '{{WRAPPER}} .items-wrap' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gwd',
            [
                'label' => esc_html__('Width', 'the-pack-addon'),
                'type' => Controls_Manager::NUMBER,
                'default' => '33.33',
                'condition' => [
                    'display' => 'grid',
                ],
                'selectors' => [
                    '{{WRAPPER}} .items' => 'width: {{VALUE}}%;',
                ],
            ]
        );

        $this->add_responsive_control(
            'itpady',
            [
                'label' => esc_html__('Item Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .items' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .tp-img-grid-slider' => 'margin-left: -{{LEFT}}{{UNIT}};margin-right:-{{RIGHT}}{{UNIT}};',
                ],
                'condition' => [
                    'display' => 'grid',
                ],
            ]
        );

        $this->add_control(
            'animation',
            [
                'label' => esc_html__('Animation', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT,
                'options' => thepack_animations(),
                'label_block' => true,
                'condition' => [
                    'display' => 'grid',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'label' => esc_html__('Box Shadow', 'the-pack-addon'),
                'name' => 'img_box_sha',
                'selector' => '{{WRAPPER}} .items-wrap',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_head',
            [
                'label' => esc_html__('Content', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'cnt_pad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tctb');

        $this->start_controls_tab(
            'e1',
            [
                'label' => esc_html__('Zoom', 'the-pack-addon'),
            ]
        );

        $this->add_responsive_control(
            'ikn_fs',
            [
                'label' => esc_html__('Font size', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tpzoom' => 'font-size: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'iktx_clr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tpzoom' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'e2',
            [
                'label' => esc_html__('Title', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'h_clr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .heading,{{WRAPPER}} .heading a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'h_mr',
            [
                'label' => esc_html__('Margin', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'h_typo',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .heading',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'e3',
            [
                'label' => esc_html__('Desc', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'desc_clr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'desc_pad',
            [
                'label' => esc_html__('Padding', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typo',
                'label' => esc_html__('Typography', 'the-pack-addon'),
                'selector' => '{{WRAPPER}} .desc',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'e5',
            [
                'label' => esc_html__('Thumb', 'the-pack-addon'),
            ]
        );

        $this->add_responsive_control(
            'imght',
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
                'selectors' => [
                    '{{WRAPPER}} figure img' => 'height: {{SIZE}}{{UNIT}};object-fit:cover;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_caro',
            [
                'label' => esc_html__('Slider control', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'display' => 'carousel',
                ],
            ]
        );

        $this->add_responsive_control(
            'sbtsp',
            [
                'label' => esc_html__('Bottom spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .tpswiper' => 'padding-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'fw',
            [
                'label' => esc_html__('Full width slide', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'selectors' => [
                    '{{WRAPPER}} .swiper-container' => 'overflow: inherit;',
                ],
            ]
        );

        $this->add_control(
            'dot',
            [
                'label' => esc_html__('Display dot', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'nav',
            [
                'label' => esc_html__('Display navigation', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
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
            'auto',
            [
                'label' => esc_html__('Autoplay', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'the-pack-addon'),
                'label_off' => esc_html__('No', 'the-pack-addon'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'center',
            [
                'label' => esc_html__('Centermode', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'the-pack-addon'),
                'label_off' => esc_html__('No', 'the-pack-addon'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'space',
            [
                'label' => esc_html__('Item spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 2,
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
            ]
        );

        $this->add_control(
            'item',
            [
                'label' => esc_html__('Item per slide', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 4,
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 5,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
            ]
        );

        $this->add_control(
            'item_tab',
            [
                'label' => esc_html__('Item per slide tablets', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 2,
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 5,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
            ]
        );

        $this->add_control(
            'speed',
            [
                'label' => esc_html__('Slide speed', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 2500,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 8000,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_pagi',
            [
                'label' => esc_html__('Slider Pagination', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'nav' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'picon',
            [
                'type' => Controls_Manager::ICONS,
                'label' => esc_html__('Prev icon', 'the-pack-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'nicon',
            [
                'type' => Controls_Manager::ICONS,
                'label' => esc_html__('Next icon', 'the-pack-addon'),
                'label_block' => true,
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
                    'dot' => 'yes',
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

    private function content($content, $column, $bticon, $size)
    {
        $out = '';
        foreach ($content as $item) {
            $link = thepack_get_that_link($item['url']);
            $img = $item['img']['id'] ? '<figure>' . wp_get_attachment_image($item['img']['id'], $size) . '</figure>' : '';
            $link = $item['url']['url'] ? '<a class="fullink" ' . $link . '></a>' : '';
            $desc = $item['desc'] ? '<p class="desc">' . $item['desc'] . '</p>' : '';
            $zoom = $bticon['value'] ? '<i class="tpzoom ' . $bticon['value'] . '"></i>' : '';
            $out .= '
             <div class="elementor-repeater-item-' . $item['_id'] . ' ' . $column . '">
                <div class="items-wrap">
                    ' . $link . $zoom . '
                    <div class="inner">
                        ' . $img . '
                        <div class="desc-wrap">
                            
                        </div>
                    </div>
                </div>
            </div>
            ';
        }

        return thepack_build_html($out);
    }
}

//'.$label.$desc.'
$widgets_manager->register(new \ThePackAddon\Widgets\The_Pack_Image_Grid_Slider());
