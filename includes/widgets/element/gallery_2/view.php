<?php

$icon = $settings['icon']['value'] ? '<span class="tbicon ' . $settings['icon']['value'] . '"></span></span>' : '';
$overlay = '<div class="overlay"><div class="content-center text-center"><div class="wrap"><h4 class="inline">' . $icon . '</h4></div></div></div>';
$class = 'gallery-item ' . ' ' . $settings['animation'];

$html = $flex = $justcls = '';
foreach ($settings['galleries'] as $image) {
    
    if ($settings['tmpl'] == 'masonry') {
        $avatar = wp_get_attachment_image($image['id'], $settings['img_size']);
    } else {
        $avatar = thepack_ft_images($image['id'], $settings['img_size']);
    }

    $image_full = wp_get_attachment_image_src($image['id'], 'full');
    $attachment_data = wp_prepare_attachment_for_js($image['id']);
    $link_gal = '<a href="' . $image_full[0] . '">' . $avatar . $overlay . '</a>';
    $html .= '<div class="' . $class . '">' . $link_gal . '</div>';
    $flex .= '<div data-w="' . $attachment_data['width'] . '" data-h="' . $attachment_data['height'] . '" class="gallery-item item">' . $link_gal . '</div>';
}

if ($settings['tmpl'] == 'justified') {
    $t = $settings['strip'] ? 'true' : 'false';
    $data_h = 'data-height="' . esc_attr($settings['jght']['size']) . '"';
    $truncate = 'data-truncate="' . $t . '"';

    $justcls = $data_h . ' ' . $truncate;
    $out = $flex;
} else {
    $out = $html;
}
//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
echo '<div ' . $justcls . ' class="tp-no-overflow aegrid-gallery gallery ' . esc_attr($settings['tmpl']) . '">';
//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
echo thepack_build_html($out);
echo '</div>';
?>

