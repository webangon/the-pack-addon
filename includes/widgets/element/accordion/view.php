<?php
$id = substr($this->get_id_int(), 0, 3);
$options = [
    'id' => $id, 
    'collpased' => ('yes' === $settings['collpased']),
];
$icon = $settings['actikn'] ? the_pack_render_icon($settings['actikn'], 'actikn') : '';
$inacon = $settings['iactikn'] ? the_pack_render_icon($settings['iactikn'], 'inactikn') : '';
$indicator = '<span class="tbxicon">' . $icon . $inacon . '</span>';
$cls = $tabti = '';
switch ($settings['tmpl']) {
    case 'one':
        $cls = 'xld-acdn1 ';
        break;

    case 'two':
        $cls = 'xld-acdn2 ';
        break;

    case 'three':
        $cls = 'xld-acdn3 ';
        break;

    default:
}

foreach ($settings['tabs'] as $a) {
    $title = $a['title'] ? '<div class="accortitle">' . wp_kses_post($a['title']) . $indicator . '</div>' : '';
    $content = '<p class="accorbody">' . wp_kses_post($a['content']) . '</p>';
    $tabti .= '<li>' . $title . $content . '</li>';
}
?>

<?php echo '<div class="xldacdn ' . esc_attr($cls . $settings['lfticn']) . '" data-xld =\'' . wp_kses_post(wp_json_encode($options)) . '\'>'; ?>
<ul class="accordion <?php echo esc_attr($id); ?>">
    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php echo $tabti; ?>
</ul>
</div>

