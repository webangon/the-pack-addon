<?php
$icon = the_pack_render_icon($settings['ico']);
$img = thepack_ft_images($settings['img']['id'], 'full');
$cntr = $settings['tmpl']=='one' ? $img : $icon;
echo '
<div class="tp-circle-txt">
	<div class="logo">'.$cntr.'</div>
	'.thepack_build_html($settings['text'],'div','text').'
</div>
';
?>

