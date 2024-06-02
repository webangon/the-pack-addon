<?php
$anim = $settings['ianim'];
$html = '';
foreach ($settings['lists'] as $a) {
    $clr = $a['clr'] ? 'style=color:' . $a['clr'] . '' : '';
    $icon = $a['icon']['value'] ? '<i ' . $clr . ' class="tbicon ' . $a['icon']['value'] . '"></i>' : '';
    $title = $a['title'] ? '<span ' . $clr . ' class="title">' . $icon . $a['title'] . '</span>' : '';
    $desc = $a['desc'] ? '<span ' . $clr . ' class="desc">' . $a['desc'] . '</span>' : '';
    $html .= '<li class="' . $anim . '">' . $title . $desc . '</li>';
}
?>
<ul class="list-1 raw-style">
    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php echo thepack_build_html($html); ?>
</ul>
