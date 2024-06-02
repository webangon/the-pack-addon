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

echo sprintf( "<%s class='product_title_desc'>%s</%s>", esc_attr($settings['tag']), esc_attr($type), esc_attr($settings['tag'])  );
?>