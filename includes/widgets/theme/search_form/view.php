<?php
$btn = '';
switch ($settings['tmpl']) {
    case 'ikn_button':
        $btn = '<button type="submit" class="search-submit"><i class="' . esc_attr($settings['btn_ikn']['value']) . '"></i></button>';
        break;
    case 'txt_button':
        $btn = '<button type="submit" class="search-submit">' . esc_attr($settings['btn_txt']) . '</button>';
        break;
}
?>
<form role="search" method="get" class="buildersearch-form" action="<?php echo esc_attr(home_url('/')); ?>">
    <input type="search" class="search-field" placeholder="<?php echo esc_attr($settings['placeholder']); ?>" value="" name="s" title="Search for:">
    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php echo thepack_build_html($btn); ?>
</form>