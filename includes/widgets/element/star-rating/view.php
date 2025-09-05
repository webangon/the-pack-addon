<?php
$tabti = '';
foreach ($settings['tabs'] as $a) {
    $inct = $a['inct'] ? 'class="inactive"' : '';
    $icon = $a['icon'] ? '<i class="'.esc_attr($a['icon']['value']).'"></i>' : '';
    $tabti .= '<li '.$inct.'>' . $icon . '</li>';
}
?>

<div class="tp-star-rating tp-no-overflow">
    <ul>
        <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        <?php echo thepack_build_html($tabti);?>
    </ul>
</div>