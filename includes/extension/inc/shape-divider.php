<?php

use Elementor\Controls_Manager;
use Elementor\Element_Base;
use Elementor\Shapes;

defined('ABSPATH') || die();

class Shape_Divider
{
    public static function init()
    {
        add_filter('elementor/shapes/additional_shapes', [__CLASS__, 'the_pack_additional_shape']);
        add_action('elementor/element/section/section_shape_divider/before_section_end', [
            __CLASS__,
            'the_pack_shape_list'
        ]);
    }

    public static function the_pack_shape_list(Element_Base $element)
    {
        $default_shapes = [];
        $thepack_shapes_top = [];
        $thepack_shapes_bottom = [];

        foreach (Shapes::get_shapes() as $shape_name => $shape_props) {
            if (!isset($shape_props['ha_shape'])) {
                $default_shapes[$shape_name] = $shape_props['title'];
            } elseif (!isset($shape_props['ha_shape_bottom'])) {
                $thepack_shapes_top[$shape_name] = $shape_props['title'];
            } else {
                $thepack_shapes_bottom[$shape_name] = $shape_props['title'];
            }
        }

        $element->update_control(
            'shape_divider_top',
            [
                'type' => Controls_Manager::SELECT,
                'groups' => [
                    [
                        'label' => esc_html__('Disable', 'the-pack-addon'),
                        'options' => [
                            '' => esc_html__('None', 'the-pack-addon'),
                        ],
                    ],
                    [
                        'label' => esc_html__('Default Shapes', 'the-pack-addon'),
                        'options' => $default_shapes,
                    ],
                    [
                        'label' => esc_html__('The Pack Shapes', 'the-pack-addon'),
                        'options' => $thepack_shapes_top,
                    ],
                ],
            ]
        );

        $element->update_control(
            'shape_divider_bottom',
            [
                'type' => Controls_Manager::SELECT,
                'groups' => [
                    [
                        'label' => esc_html__('Disable', 'the-pack-addon'),
                        'options' => [
                            '' => esc_html__('None', 'the-pack-addon'),
                        ],
                    ],
                    [
                        'label' => esc_html__('Default Shapes', 'the-pack-addon'),
                        'options' => $default_shapes,
                    ],
                    [
                        'label' => esc_html__('The Pack Shapes', 'the-pack-addon'),
                        'options' => array_merge($thepack_shapes_top, $thepack_shapes_bottom),
                    ],
                ],
            ]
        );
    }

    /**
     * Undocumented function
     *
     * @param array $shape_list
     *
     * @return void
     */
    public static function the_pack_additional_shape($shape_list)
    {
        $custom_shape_list = [];
        foreach (glob(THE_PACK_PLUGIN_DIR . '/includes/extension/img/shape-divider/*') as $file) {
            $custom_shape_list[] = pathinfo($file)['filename'];
            ;
        }

        $thepack_shapes = [];

        foreach ($custom_shape_list as $value) {
            $thepack_shapes[$value] = [
                'title' => ucfirst($value),
                'path' => THE_PACK_PLUGIN_DIR . 'includes/extension/img/shape-divider/' . $value . '.svg',
                'url' => THE_PACK_PLUGIN_URL . 'includes/extension/img/shape-divider/' . $value . '.svg',
                'has_flip' => true,
                'has_negative' => false,
                'ha_shape' => true,
            ];
        }

        /*
         * svg path should contain elementor class to show in editor mode
        */

        return array_merge($thepack_shapes, $shape_list);
    }
}

Shape_Divider::init();
