<?php
$per_page = $settings['posts']['size'];
$img_size = $settings['img_size'];

$cat = $settings['cat_query'];
$id = $settings['id_query'];
$meta = thepack_buildermeta_to_string($settings['metas']);

if ($settings['query_type'] == 'category') {
    $query_args = [
        'post_type' => 'post',
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
        'posts_per_page' => $per_page,
        'post__in' => $id,
        'orderby' => 'post__in'
    ];
}

$loop = new \WP_Query($query_args);

echo '<div class="tp-recent-post">';

if ($loop->have_posts()) : ?>
	<?php while ($loop->have_posts()) : $loop->the_post(); ?>

        <div class="item">
            <div class="inner">
    			<?php if (has_post_thumbnail() && $settings['show_img']) : ?>
                    <div class="entry-media">
                        <a class="post-featured" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
    						<?php the_post_thumbnail($img_size); ?>
                        </a>

                    </div>
    			<?php endif; ?>
                <div class="grid-content">
    				<?php thepack_build_postmeta($meta, $excerpt = ''); ?>
                </div>
            </div>
        </div>

	<?php endwhile; ?>

	<?php wp_reset_postdata(); ?>

<?php endif; ?>

</div>
 