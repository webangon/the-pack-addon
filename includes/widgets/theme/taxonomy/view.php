<?php
$terms = get_terms($settings['taxonomy']);
$output = '';
foreach ($terms as $term) {
    $term_link = get_term_link($term);
    $tax_id = get_term($term->term_id);
    $count = $tax_id->count;
    $output .= '<li class="' . esc_attr($settings['taxonomy']) . '"><a class="tag-cat" href="' . esc_url($term_link) . '"><span class="label">' . $term->name . '</span><span class="count">(' . esc_attr($count) . ')</span>' . '</a></li>';
}
//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
echo '<ul class="tp-taxomony ' . esc_attr($settings['style']) . '">' .thepack_build_html( $output ). '</ul>';
