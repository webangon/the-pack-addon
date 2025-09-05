<?php
use Elementor\Plugin;

$excerpt = $settings['excerpt']['size'];
$per_page = $settings['posts_per_page']['size'];
$meta = thepack_buildermeta_to_string($settings['metas']);

$cat = $settings['cat_query'];
$id = $settings['id_query'];

if (is_front_page()) {
    $paged = (get_query_var('page')) ? get_query_var('page') : 1;
} else {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
}

if ($settings['query_type'] == 'category') {
    $query_args = [
        'post_type' => 'post',
        'paged' => $paged,
        'posts_per_page' => $per_page,
        //phpcs:disable WordPress.DB.SlowDBQuery.slow_db_query_tax_query
        'tax_query' => [
            [
                'taxonomy' => 'category',
                'field' => 'term_id',
                'terms' => $cat,
            ],
        ],
    ];
}

if ($settings['query_type'] == 'individual') {
    $query_args = [
        'post_type' => 'post',
        'paged' => $paged,
        'posts_per_page' => $per_page,
        'post__in' => $id,
        'orderby' => 'post__in'
    ];
}
 
$loop_style = $settings['tmpl'] ? absint($settings['tmpl']) : '1';
   
$hide_thumb = isset($settings['hide_thumb']) ? $settings['hide_thumb'] : '';

$loop = new \WP_Query($query_args); ?>  

<div class="tp-grid-wrap tp-no-overflow">
    <div class="inner tp-no-overflow masonwrp masonon">

		<?php

        if (Plugin::instance()->editor->is_edit_mode()) {
            require dirname(__FILE__) . '/page-mode.php';
        } else {
            if ($settings['arc_query']) {
                require dirname(__FILE__) . '/archive-mode.php';
            } else { 
                require dirname(__FILE__) . '/page-mode.php';
            }
        } ?>
    </div>
	<?php thepack_builder_post_pagination($settings['arc_query'], $loop, $settings['show_pagi']); ?>
</div>

