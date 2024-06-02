<?php
global $product;
if ( empty( $product ) ) {
	return;
}
$icon = the_pack_render_icon( $tab['icn'] );
echo '<li><span class="label">'.$icon.$tab['lbl'].'</span>'.thepack_social_post_share($settings['tp_fshare'],'product-share').'</li>';//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped

?>
