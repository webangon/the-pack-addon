<?php
	$out = '';
	$i = 0;
	foreach ($settings['items'] as $item) {
		$i++;
		$cls = $i == 1 ? 'active' : '';
		$link = thepack_get_that_link($item['url']);
		$icon = the_pack_render_icon($item['ico'],'tpicon hover-color');
		$btn = $link ? '<a ' . $link . ' class="bttxt hover-color">'.$settings['btn'].'</a>' : '';
		$label = $item['label'] ? '<h3 class="title hover-color">' . $item['label'] . '</h3>' : '';
		$desc = $item['desc'] ? '<p class="desc tbtr hover-color">' . $item['desc'] . '</p>' : '';
		$out .= '
			<div class="tp-mousenter elementor-repeater-item-' . $item['_id'] . ' item tbtr '.$cls.'">
				<div class="inner">
					'.$icon.$label.$desc.$btn.'
				</div>
				<div class="image tbtr"></div>
			</div>
		'; 
	}
		
?>
<div class="tb-hxpand tp-d-flex">
	<?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php echo thepack_build_html($out); ?>
</div>
<style>
.item{
    flex: 1;
    position: relative;
    overflow: hidden; 
	display: flex;   
	justify-content: space-between;
}
.inner{
    position: relative;
    overflow: hidden;
}    
.image {
    background-size: cover;
    background-position: 50%;
	flex: 0 0 0;
}
.tb-hxpand{
    justify-content: space-between;  
}
.item:hover,.item.active {
    flex: 2 1 0%;
}

</style>


