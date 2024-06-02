<?php
$tabti = '';
foreach ($settings['tabs'] as $a) {
    $inct = $a['inct'] ? 'class="inactive"' : '';
    $icon = $a['icon'] ? '<i class="'.$a['icon']['value'].'"></i>' : '';
    $tabti .= '<li '.$inct.'>' . $icon . '</li>';
}
?>

<div class="tp-star-rating tpoverflow">
    <ul>
        <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        <?php echo the_pack_html_escaped($tabti);?>
    </ul>
</div>