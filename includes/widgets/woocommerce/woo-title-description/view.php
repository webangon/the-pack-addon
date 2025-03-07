<?php
if ( empty( $product ) ) {
	return;
}

switch ($settings['type']) {
	case "title":
	  $type = $product->get_title();
	  break;
	case "desc":
	  $type = $product->get_description();
	  break;
	case "short_desc":
	  $type = $product->get_short_description();
	  break;
}
$tag = tp_allow_html_tag($settings['tag']); 
echo sprintf( "<%s class='product_title_desc'>%s</%s>", $tag, esc_attr($type), $tag  );
?>   