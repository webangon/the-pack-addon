<?php
namespace Elementor;

if (!function_exists('thepack_insert_elementor')) {
    
    function thepack_insert_elementor($atts)
    {
        if (!class_exists('Elementor\Plugin')) {
            return '';
        }
        if (!isset($atts['id']) || empty($atts['id'])) {
            return '';
        }      

        $post_id = $atts['id'];

        $response = Plugin::instance()->frontend->get_builder_content_for_display($post_id);

        return $response; 
    }
}

add_shortcode('THEPACK_INSERT_TPL', 'Elementor\thepack_insert_elementor');
