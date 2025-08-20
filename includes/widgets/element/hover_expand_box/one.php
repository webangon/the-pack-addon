<?php
	$out = '';
	$i = 0;
	foreach ($settings['items'] as $item) {
		$i++;
		$cls = $i == 1 && $settings['actv'] ? 'active' : '';
		$link = thepack_get_that_link($item['url']);
		$icon = the_pack_render_icon($item['ico'],'tpicon micon');
		$btnicon = the_pack_render_icon($settings['btnicon'],'bticon tbtr');
		$btn = $link ? '<a ' . $link . ' class="fullink"></a>' : '';
		$label = $item['label'] ? '<h3 class="title">' . $item['label'] . '</h3>' : '';
		$desc = $item['desc'] ? '<p class="desc tbtr">' . $item['desc'] . '</p>' : '';
		$out .= '
			<div class="tp-mousenter elementor-repeater-item-' . $item['_id'] . ' item tbtr '.$cls.'">
				'.$btn.$icon.$label.$desc.$btnicon.'
			</div>
		'; 
	}
		
?>
<div class="tb-imgbgrid2 tp-d-flex">
	<?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php echo thepack_build_html($out); ?>
</div>


