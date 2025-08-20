<?php
$html = '';
$i=0;
foreach ($settings['lists'] as $a) {
    $i++;
    $url = thepack_get_that_link($a['url']);
    $ttl = $url ? '<h4><a ' . $url . '>'.$a['title'].'</a><h4>' : thepack_build_html($a['title'], 'h4', '');
    $html .= '
    <div class="elementor-repeater-item-' . $a['_id'].' service-items tbtr">
        <div class="service-inner tbtr">
            <div class="service-img tbtr">
                '.thepack_ft_images($a['img']['id'],'full').'
            </div>
            <div class="service-content">
                <div class="content-text">
                    <h4 class="text-line">
                        <span>'.$a['title'].'</span>
                        <span>'.$a['title'].'</span>
                        <span>'.$a['title'].'</span>
                    </h4>
                    '.$ttl.'
                </div>
            </div>
        </div>
    </div>    
    ';
}
?>
<div class="thepack-marquee-service">
    <?php echo thepack_build_html($html); ?>
</div>