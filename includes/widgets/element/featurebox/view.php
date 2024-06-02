<?php
$html = '';
foreach ($settings['lists'] as $a) {
    $attr = thepack_get_that_link($a['url']);
    $link = $a['url']['url'] ? '<a ' . $attr . ' class="tblink"></a>' : '';
    $icon = $a['icon'] ? '<i class="tbicon ' . $a['icon']['value'] . '"></i>' : '';
    $title = $a['title'] ? '<span class="title">' . $a['title'] . '</span>' : '';
    $html .= '<li class="elementor-repeater-item-' . $a['_id'] . '"><div class="inner">' . $link . '<div class="wrap"><div class="content">' . $icon . $title . '</div></div></div></li>';
}
?>

<ul class="tp-featurebox tpoverflow">
    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php echo thepack_build_html($html); ?>
</ul>
