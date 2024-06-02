<?php
$out = '';
$icon = $settings['icon']['value'] ? '<i class="tbicon ' . $settings['icon']['value'] . '"></i>' : '';
$img = $settings['img']['id'] ? wp_get_attachment_image($settings['img']['id'], 'full') : '';
$img_icon = $settings['type'] == 'img' ? $img : $icon;
$link = thepack_get_that_link($settings['url']);
$btn = $settings['btn'] ? '<a class="tour-btn" ' . $link .' >' . $settings['btn'] . '</a>' : '';
$title = $settings['ttl'] ? '<h3 class="title"><a ' . $link .' >' . $settings['ttl'] . '</a></h3>' : '';
foreach ($settings['items'] as $item) {
    $icn = $item['icn']['value'] ? '<i class=" ' . $item['icn']['value'] . '"></i>' : '';
    $out .= '<span>'.$icn.' '.$item['lbl'].'</span>';
}
?>

<div class="tp-file-download">
    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
    <div class="img-wrap"><?php echo the_pack_html_escaped($img_icon);?></div>
    <div class="media-body">
        <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        <?php echo the_pack_html_escaped($title);?>
        <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        <div class="info"><?php echo the_pack_html_escaped($out);?></div>
    </div>
    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
    <?php echo the_pack_html_escaped($btn);?>
</div>
 
 
