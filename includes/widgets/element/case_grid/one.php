<?php
$out = '';
$btnicon = the_pack_render_icon($settings['ikn'],'bticon tbtr');
$swiper_opt = the_pack_swiper_markup($settings);
$cls = $settings['disp']=='grid' ? 'tp-df-33' : 'swiper-slide';
foreach ($settings['items'] as $item) {
    $link = thepack_get_that_link($item['url']);
    $btn = $link ? '<a ' . $link . ' class="link tp-dinflex">'.$btnicon.'</a>' : '';
    $ttl = $link ? '<h4 class="title"><a ' . $link . '>'.$item['name'].'</a></h4>' : '<h4 class="title">'.$item['name'].'</h4>';
    $out .= '
        <div class="'.$cls.' item"><div class="inner">
            <div class="card-image-wrapper tbtr">
                '.thepack_ft_images($item['img']['id'],'full').'
            </div>
            <div class="service-card-content">
                '.$ttl.'
                '.thepack_build_html($item['pos'],'p','desc').'
                '.$btn.'
            </div></div>
        </div>
    ';
}
if ($settings['disp'] == 'slider') {
    echo '<div data-xld =\'' . wp_json_encode($swiper_opt['settings']) . '\' class="swiper tpswiper tp-img-card">
            <div class="swiper-wrapper">'.$out.'</div>
            '.$swiper_opt['nav'].'
        </div>'; 
} else {
    echo '<div class="tp-d-flex tp-gutter tp-img-card">'.$out.'</div>';;
}

?>