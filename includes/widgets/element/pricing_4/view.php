<?php
$list = '';
$enicon = $settings['enicon']['value'] ? '<i class="tbicon ' . $settings['enicon']['value'] . '"></i>' : '';
$dicon = $settings['dicon']['value'] ? '<i class="tbicon ' . $settings['dicon']['value'] . '"></i>' : '';
foreach ($settings['list'] as $a) {
    $on = $a['on'] ? 'on' : 'off';
    $icon = $a['on'] ? $enicon : $dicon;
    $list .= '<li class="' . $on . '">' . $a['txt'] . $icon . '</li>';
}
$url = thepack_get_that_link($settings['link']);
$link = $settings['btn'] ? '<a class="price-btn" ' . $url . '>' . $settings['btn'] . '</a>' : '';

?>

<div class="tp-pricing-4 tp-no-overflow <?php echo esc_attr($settings['anim']); ?>">
    <div class="tbinr">
		<?php echo thepack_build_html($settings['lbl'], 'span', 'pre');//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        <h3 class="price-wrap"><?php echo thepack_build_html($settings['prc'], 'span', 'price');//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php echo thepack_build_html($settings['dur'], 'span', 'duration');//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?></h3>
		<?php echo thepack_build_html($settings['desc'], 'p', 'desc');//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        <ul><?php echo thepack_build_html($list);//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?></ul>
		<?php echo thepack_build_html($link);//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
    </div>
</div>

