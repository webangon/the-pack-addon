<?php

$html = '';
$icon = $settings['icon']['value'] ? '<i class="tbicon ' . $settings['icon']['value'] . '"></i>' : '';
foreach ($settings['lists'] as $a) {
    $link = thepack_get_that_link($a['link']);
    $btn = $a['title'] ? '<a ' . $link . ' class="linkbtn ulink">' . $icon . $a['title'] . '</a>' : '';
    $html .= '<li>' . $btn . '</li>';
}
?>

<ul class="link1 <?php echo esc_attr($settings['tmpl']); ?>">
    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php echo the_pack_html_escaped($html); ?>
</ul>