<?php
global $wp;
$current = isset( $_SERVER['QUERY_STRING'] ) ? add_query_arg(sanitize_text_field(wp_unslash($_SERVER['QUERY_STRING'])), '', home_url($wp->request)) : '';
$html = '';
$icon = $settings['icon']['value'] ? '<i class="tbtr ' . $settings['icon']['value'] . '"></i>' : '';
foreach ($settings['lists'] as $a) {
    $url = isset($a['link']) ? $a['link']['url'] : '';
    $active = $url == $current ? 'current-link' : '';
    $link = thepack_get_that_link($a['link']);
    $btn = $a['title'] ? '<a ' . $link . ' class="linkbtn ' . $active . '">' . $icon . '<span>' . $a['title'] . '</span></a>' : '';
    $html .= '<li>' . $btn . '</li>';
} 
?>
<div class="sidebar-link">
    <ul class="raw-style <?php echo esc_attr($settings['tmpl']); ?>">
    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php echo thepack_build_html($html); ?>
    </ul>
</div>