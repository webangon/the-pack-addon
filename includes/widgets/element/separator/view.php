<?php
$pre = '<span class="xld-sep-hldr"><span class="xld-sep-lne"></span></span>';
$post = '<span class="xld-sep-hldr"><span class="xld-sep-lne"></span></span>';
$icon = $settings['icn']['value'] ? '<i class="tbicon ' . $settings['icn']['value'] . '"></i>' : '';
$img = $settings['img']['id'] ? wp_get_attachment_image($settings['img']['id'], 'full') : '';
$heading = '<span class="heading">' . $settings['txt'] . $icon . $img . '</span>';

switch ($settings['tmpl']) {
    case 'one':
        $out = $pre . $heading . $post;
        break;

    case 'two':
        $out = $heading . $post;
        break;

    case 'three':
        $out = $pre . $heading;
        break;

    default:
}
?>

<div class="xld-separator">
    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php echo thepack_build_html($out); ?>
</div>
  
 
