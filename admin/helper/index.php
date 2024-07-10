<?php
if (!defined('ABSPATH')) {
    exit;
}

function thepack_footer_select($type = '', $num = '', $tax = '')
{
    $type = $type ? $type : 'elementor_library';
    global $post;
    $num = $num ? $num : '-1';
    $args = [
        'numberposts' => $num,
        'post_type' => $type,
    ];
    if ($tax) { 
        //phpcs:disable WordPress.DB.SlowDBQuery.slow_db_query_tax_query
        $args['tax_query'] = [
            [
                'taxonomy' => 'elementor_library_category',
                'field' => 'slug',
                'terms' => [$tax],
            ],
        ];
    }

    $posts = get_posts($args);
    $categories = [
        '' => esc_html__('Select', 'the-pack-addon'),
    ];
    foreach ($posts as $pn_cat) {
        $categories[$pn_cat->ID] = get_the_title($pn_cat->ID);
    }

    return $categories;
}

