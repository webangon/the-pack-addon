<?php   
 $terms = $settings['taxterm'];
 $out = '';
 if ( $settings['disp']=='slide' ){
	$parent_cls = 'tpswiper tp-category-loop swiper tp-no-overflow';
	$main_cls = 'swiper-wrapper';
	$inclass = 'swiper-slide tp-category';
	$slider_options = [
		'item' => $settings['item']['size'],
		'item_tab' => $settings['item_tab']['size'],
		'speed' => $settings['speed']['size'],
		'space' => $settings['space']['size'],
		'auto' => ('yes' === $settings['auto']),
		'center' => ('yes' === $settings['center']),
	];	

	$previkn = $settings['picon']['value'] ? '<div class="khbprnx khbnxt">'.the_pack_render_icon($settings['picon']).'</div>' : '';
	$nextikn = $settings['nicon']['value'] ? '<div class="khbprnx khbprev">'.the_pack_render_icon($settings['nicon']).'</div>' : '';
	$nav = $settings['arrow'] ? '<div class="tp-arrow">' . $previkn . $nextikn . '</div>' : '';
	$dot = $settings['dot'] ? '<div class="swiper-pagination"></div>' : '';

} else { 
	//
	$parent_cls = 'tp-category-loop';
	$main_cls = 'tp-no-overflow tp-category-wrap';
	$inclass = 'tp-category';
	$slider_options = [];
	$nav = $dot = '';
}

echo '<div data-xld =\'' . wp_json_encode($slider_options) . '\' class="'.esc_attr($parent_cls).'">';
echo '<div class="'.esc_attr($main_cls).'">';

?> 
	<?php 
	if (ctype_alnum($settings['style']) ){
		require plugin_dir_path(__FILE__) . 'style_'.esc_attr($settings['style']) . '.php';
	}
	?>
  </div>
</div>	
<style>
.tp-category-loop .inner:hover .tp-img {
    transform: scale3d(1.1, 1.1, 1);
}
.tp-category-loop .fullink{
	z-index: 1;
}	
</style>