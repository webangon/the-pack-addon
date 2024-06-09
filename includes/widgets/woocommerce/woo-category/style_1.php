<?php
foreach( $terms as $term){
	$term_vals = get_term_meta($term);
	$term_m = get_term($term);
	$thumb = isset($term_vals['thumbnail_id']) ? '<div class="thumb-wrap">'.wp_get_attachment_image($term_vals['thumbnail_id'][0], 'full','',["class" => "tp-img tbtr"]).'</div>' : '';
	$title = $term_m->name ? '<p class="title">'.$term_m->name.'</p>' : '';
	$count = $term_m->count>1 ? '<span class="count">'.$term_m->count.' products</span>': '<span class="count">'.$term_m->count.' product</span>';
	$out .='
		<div class="'.$inclass.'">
			<div class="inner">
				<a class="fullink" href="'.get_term_link( $term_m ).'"></a>
				'.$thumb.'
				'.$title.'
				'.$count.'
			</div>
		</div>
	';
}
//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
echo thepack_build_html($out);
?>    