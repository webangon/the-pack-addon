<?php
//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
echo the_pack_render_icon($settings['ikn'],'seachicon');
?>
<div class="tp-fs-search-wrap">
	<?php if ($settings['type'] == 'search') {?>
		<form role="search" method="get" class="fullscreensearch-form tpinner" action="<?php echo esc_attr(home_url('/')); ?>">
			<input type="search" class="search-field" placeholder="<?php echo esc_attr($settings['place']); ?>" value="" name="s" >
		</form>	
	<?php } else {
		echo '<div class="tpinner">'.do_shortcode('[THEPACK_INSERT_TPL id="' . $settings['template'] . '"]').'</div>';
	 } ?>  
	<?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php echo the_pack_render_icon($settings['close'],'closepop');?>
</div>	

