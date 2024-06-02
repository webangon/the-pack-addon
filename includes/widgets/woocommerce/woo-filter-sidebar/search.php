<?php
$title = $value['lbl'] ? '<h3>'.$value['lbl'].'</h3>' : '';
$btn = $value['icn']['value'] ? '<button class="search-submit" type="submit">'.the_pack_render_icon($value['icn']).'</button>' : '';
$form = '';
$form .= '<form class="buildersearch-form" action="' . esc_url( home_url( '/'  ) ) . '">';
$form .= '<input class="search-field" type="search" value="' . get_search_query() . '" name="s" placeholder="'.$value['spl'].'" autocomplete="off"/>';
$form .= $btn;
$form .= '<input type="hidden" name="post_type" value="product" />';
$form .= '</form>';
//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
echo '<div class="filter-item">'.the_pack_html_escaped($title.$form).'</div>';
?>