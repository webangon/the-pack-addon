<?php

if ($settings['pointr'] == 'one') {
    $pointer = '<div class="pulse"></div><div class="dot"></div>';
} elseif ($settings['pointr'] == 'two') {
    $pointer = '<span class="hotspot-red"><span></span></span>';
} else {
    $pointer = '<span class="pulsathotspot"></span>';
}

$html = '';
foreach ($settings['lists'] as $a) {
    $icon = $a['icon'] ? '<i class="tbicon ' . $a['icon'] . '"></i>' : '';
    $title = (isset($a['title']) && $a['title']) ? '<h3 class="title">' . $a['title'] . '</h3>' : '';
    $sub = (isset($a['sub']) && $a['sub']) ? '<span class="subtitle">' . $a['sub'] . '</span>' : '';
    $desc = (isset($a['desc']) && $a['desc']) ? '<p class="desc">' . $a['desc'] . '</p>' : '';

    $link = thepack_get_that_link($a['link']);

    $btn = $a['btn'] ? '<a ' . $link . ' class="hpspot-btn">' . $a['btn'] . '</a>' : '';

    $html .= ' 
        <div class="tb_hotspot elementor-repeater-item-' . $a['_id'] . ' ">
          <div class="tb_hpointwrp">
            ' . $pointer . '
          </div>

          <div class="tb_hotspot_content ' . $a['infos'] . ' ' . $a['preci'] . '">
            ' . $title . $sub . $desc . $btn . '
          </div>
        </div>
        ';
}

$id = $settings['img']['id'];
$img = thepack_ft_images($id, 'full');
?>

<div class='xldhotspot1'>
    <div class="tbspotimg">
    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php echo thepack_build_html($img); ?>
    </div>
  <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php echo thepack_build_html($html); ?>
</div>

