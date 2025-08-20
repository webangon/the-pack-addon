<?php
use Elementor\Controls_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Controls_Stack;
use Elementor\Element_Base;
use Elementor\Repeater;
use Elementor\Utils;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class The_Pack_Elementor_Parallax_Layer
{
    public function __construct()
    {
        add_action('elementor/element/section/section_background/after_section_end', [
            $this,
            'register_controls'
        ], 10);
        add_action('elementor/frontend/section/before_render', [$this, '_before_render'], 10, 1);
        add_action('elementor/section/print_template', [$this, '_print_template'], 10, 2);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
    }

    public function register_controls($element)
    {
        $element->start_controls_section(
            'wpr_section_parallax',
            [
                'tab' => Controls_Manager::TAB_STYLE,
                'label' => esc_html__('Parallax - The Pack Addons', 'the-pack-addon'),
            ]
        );

        $element->add_control(
            'tp_enable_parallax_hover',
            [
                'type' => Controls_Manager::SWITCHER,
                'label' => esc_html__('Enable Multi Layer Parallax', 'the-pack-addon'),
                'default' => 'no',
                'label_on' => esc_html__('Yes', 'the-pack-addon'),
                'label_off' => esc_html__('No', 'the-pack-addon'),
                'return_value' => 'yes',
                'render_type' => 'template',
                'separator' => 'before',
                'prefix_class' => 'tp-parallax-'
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'repeater_bg_image',
            [
                'label' => esc_html__('Choose Image', 'the-pack-addon'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'render_type' => 'template',
            ]
        );

        $repeater->add_responsive_control(
            'layer_rotate',
            [
                'label' => esc_html__('Rotate', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 360,
                    ]  
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'transform: rotate({{SIZE}}deg);',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'layer_width',
            [
                'label' => esc_html__('Width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 900,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'layer_height',
            [
                'label' => esc_html__('Height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 900,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'layer_brad',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px','%'],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'layer_left_pos',
            [
                'type' => Controls_Manager::SLIDER,
                'label' => esc_html__('Left position', 'the-pack-addon'),
                'size_units' => ['px', '%'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.tp-section-child-layer' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'layer_right_pos',
            [
                'type' => Controls_Manager::SLIDER,
                'label' => esc_html__('Right position', 'the-pack-addon'),
                'size_units' => ['px', '%'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.tp-section-child-layer' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'layer_top_pos',
            [
                'type' => Controls_Manager::SLIDER,
                'label' => esc_html__('Top position', 'the-pack-addon'),
                'size_units' => ['px', '%'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.tp-section-child-layer' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'layer_btm_pos',
            [
                'type' => Controls_Manager::SLIDER,
                'label' => esc_html__('Bottom position', 'the-pack-addon'),
                'size_units' => ['px', '%'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.tp-section-child-layer' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_control(
            'layer_anim',
            [
                'label' => esc_html__('Animation', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => false,
                'options' => jl_elementor_animation(),
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.tp-section-child-layer' => 'animation-name: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'layer_anim_dr',
            [
                'label' => esc_html__('Animation duration', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => .25,
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.tp-section-child-layer' => 'animation-duration: {{SIZE}}s;animation-iteration-count:infinite;',
                ],

            ]
        );

        $repeater->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'fbbxp',
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} img',
                'label' => esc_html__('Box shadow', 'the-pack-addon'),
            ]
        );

        $repeater->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tp_lyr_bg',
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
                'label' => esc_html__('Background', 'the-pack-addon'),
            ]
        );

        $element->add_control(
            'tp_parallax_layer',
            [
                'label' => esc_html__('Repeater List', 'the-pack-addon'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'prevent_empty' => false,
                'condition' => [
                    'tp_enable_parallax_hover' => 'yes'
                ]
            ]
        );

        $element->end_controls_section();
    }

    public function _before_render($element)
    {
        // bail if any other element but section
        if ($element->get_name() !== 'section') {
            return;
        }

        $settings = $element->get_settings_for_display();

        // Parallax Multi Layer

        if ($settings['tp_enable_parallax_hover'] == 'yes') {
            if ($settings['tp_parallax_layer']) {
                echo '<div class="tp-parallax-section">';

                foreach ($settings['tp_parallax_layer'] as $key => $item) {
                    echo '<div class="elementor-repeater-item-' . esc_attr($item['_id']) . ' tp-section-child-layer">';
                    echo wp_get_attachment_image($item['repeater_bg_image']['id'], 'full');
                    echo '</div>';
                }

                echo '</div>';
            }
        }
    }

    public function _print_template($template, $widget)
    {
        ob_start(); ?>
        <# if ( settings.tp_parallax_layer.length && settings.tp_enable_parallax_hover == 'yes') { #>
        <div class="tp-parallax-section">
            <# _.each( settings.tp_parallax_layer, function( item, index ) { #>

            <div data-depth="0.2" class="elementor-repeater-item-{{ item._id }} tp-section-child-layer">
                <?php //phpcs:disable PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage ?>
                <img src="{{item.repeater_bg_image.url}}">
            </div>
            <# }); #>
        </div>
        <# } #>
		<?php

        $parallax_content = ob_get_contents();

        ob_end_clean();

        return $template . $parallax_content;
    }

    public static function enqueue_scripts()
    {

    }
}

new The_Pack_Elementor_Parallax_Layer();
