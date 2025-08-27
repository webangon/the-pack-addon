<?php
$content = $label = '';
foreach ($settings['tabs'] as $a) {
    $icon = the_pack_render_icon($a['icon'], 'actikn');
    $label .= '<li class="tp-flex-equal tbtr">'.$icon.'<span>' . $a['title'] . '</span></li>';
    $content .= '<div class="tab-content">' . $this->icon_image($a) . '</div>';
}
?>
<div class="tp-tab tp-tab-1 tp-flex-equal <?php echo esc_attr($settings['style']); ?>">
    <ul class="tab-area tp-flex-equal">
    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php echo thepack_build_html($label); ?>
    </ul>
    <div class="tab-wrap">
    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>  
		<?php echo thepack_build_html($content); ?>
    </div>
</div>
 
 