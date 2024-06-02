<?php
	if(The_Pack_Woo_Helper::tp_stock_status() == 'instock'){
		$checkbox = 'checked';
		$stocklink = remove_query_arg('stock_status');
	} else {
		$checkbox = '';
		$stocklink = add_query_arg('stock_status','instock');
	}

	if(The_Pack_Woo_Helper::tp_on_sale() == 'onsale'){
		$onsalecheckbox = 'checked';
		$salelink = remove_query_arg('on_sale');
	} else {
		$onsalecheckbox = '';
		$salelink = add_query_arg('on_sale','onsale');
	}
	$title = $value['lbl'] ? '<h3>'.$value['lbl'].'</h3>' : '';
	$out = '
		<div class="filter-item">
			'.$title.'
			<ul class="raw-style">
				<li>
					<a href="'.esc_url($stocklink).'">
					<input name="stockonsale" value="instock" id="instock" type="checkbox" '.esc_attr($checkbox).'>
					<label><span></span>'.esc_html__('In Stock','the-pack-addon').'</label>
					</a>
				</li>
				<li>	
					<a href="'.esc_url($salelink).'">
					<input name="stockonsale" value="onsale" id="onsale" type="checkbox" '.esc_attr($onsalecheckbox).'>
					<label><span></span>'.esc_html__('On Sale','the-pack-addon').'</label>
					</a>
				</li>	
			</ul>
		</div>			
	';
	//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
	echo the_pack_html_escaped($out);
?>