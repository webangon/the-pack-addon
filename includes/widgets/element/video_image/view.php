<?php

$i = 0;
$out1 = $out2 = $out3 = $out4 = '';
foreach ($settings['lists'] as $a) {
    $img = thepack_ft_images($a['img']['id'], $settings['img_size']);

    if ($i == 0) {
        $out1 .= '<div class="first-image imgwrap">' . $img . '</div>';
    }

    if ($i == 1) {
        $out2 .= '<div class="second-image imgwrap">' . $img . '</div>';
    }

    if ($i == 2) {
        $out3 .= '<div class="third-image imgwrap">' . $img . '</div>';
    }

    if ($i == 3) {
        $out4 .= '<div class="fourth-image imgwrap">' . $img . '</div>';
    }

    $i++;
}

$btn = '<div class="video-play"><div class="inner">' . thepack_build_html($settings['pre'], 'span', 'pre') . thepack_build_html($settings['ttl'], 'p', 'desc') . '</div></div>';

?>

<div class="tb-videoimg">
    <div class="top-image">
        <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php echo thepack_build_html($btn . $out1 . $out2); ?>
    </div>

    <div class="bottom-image">
        <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php echo thepack_build_html($out3 . $out4); ?>
    </div>
</div>
