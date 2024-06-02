<?php

$link = thepack_get_that_link($settings['url']);
$img = thepack_ft_images($settings['img']['id'], $settings['img_size']);
$title = $settings['title'] ? '<h3 class="title">' . $settings['title'] . '</h3>' : '';
$desc = $settings['desc'] ? '<p class="desc">' . $settings['desc'] . '</p>' : '';
$icon = $settings['ikn']['value'] ? '<i class="tbicon ' . $settings['ikn']['value'] . '"></i>' : '';

$fnal = '<div class="imgcap ' . $settings['anim'] . '"><div class="inner">' . $icon . $title . $desc . '</div></div>';

$cont = $settings['url'] ? '<a ' . $link . '>' . $fnal . '</a>' : $fnal;

$out1 = '<div class="imgcap1">
        ' . $img . $cont . '
    </div>';
//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped    
echo thepack_build_html($out1);

?>




