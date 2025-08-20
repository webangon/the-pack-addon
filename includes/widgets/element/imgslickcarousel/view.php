<?php
$speed = esc_attr($settings['speed']['size']);
$item = esc_attr($settings['item']['size']);
$item_tab = esc_attr($settings['item_tab']['size']);

$slider_options = [
    'item' => $item,
    'item_tab' => $item_tab,
    'speed' => $speed,
    'mouse' => ('yes' === $settings['mouse']),
    'auto' => ('yes' === $settings['auto']),
    'dot' => ('yes' === $settings['dot']),
    'arrow' => ('yes' === $settings['nav']),
];

$prev = $settings['picon']['value'] ? '<li class="prev"><i class="tbicon ' . $settings['picon']['value'] . '"></i></li>' : '';
$nxt = $settings['nicon']['value'] ? '<li class="next"><i class="tbicon ' . $settings['nicon']['value'] . '"></i></li>' : '';

foreach ($settings['lists'] as $a) {
    $url = (empty($a['url']['url'])) ? ' ' : esc_url($a['url']['url']);
    $target = $a['url']['is_external'] ? 'target="_blank"' : '';
    $title = $a['title'] ? '<h2 class="title">' . $a['title'] . '</h2>' : '';
    $out .= '

              <div class="imgwrap">' . thepack_ft_images($a['bg']['id'], $settings['img_size']) . '</div>
        ';
}
?>

<?php echo '<div class="xldslickcarousel ' . esc_attr($settings['tmpl']) . '" data-xld =\'' . wp_kses_post(wp_json_encode($slider_options)) . '\'>'; ?>
<div class='single-item'>
    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php echo thepack_build_html($out); ?>
</div>
<?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
<ul class="slknav"><?php echo thepack_build_html($prev . $nxt); ?></ul>
</div>
<style type="text/css">

    .slick-slide {
        text-align: center;
        color: #419be0;
        margin: 65px;
    }

    .slick-list {
        overflow: visible;
    }

    .single-item {
        margin-left: -300px;
        margin-right: -300px;
    }

    .slick-current {
        -webkit-transform: scale(1.45) translateZ(0);
        -moz-transform: scale(1.45) translateZ(0);
        transform: scale(1.55) translateZ(0);
        -webkit-transition: all .4s cubic-bezier(.15, .7, .54, 1);
        -moz-transition: all .4s cubic-bezier(.15, .7, .54, 1);
        transition: all .4s cubic-bezier(.15, .7, .54, 1)
    }

    .slick-slide:not(.slick-current) {
        -webkit-transform: scale(.9) translateZ(0);
        -moz-transform: scale(.9) translateZ(0);
        transform: scale(.9) translateZ(0);
        -webkit-transition: all .4s cubic-bezier(.16, .7, .54, 1);
        -moz-transition: all .4s cubic-bezier(.16, .7, .54, 1);
        transition: all .4s cubic-bezier(.16, .7, .54, 1)
    }

    .slknav {
        margin: 0;
        padding: 0;
        list-style-type: none;
        width: 100%;
        top: 50%;
        transform: translateY(-50%);
        position: absolute;
    }

    .slknav li {
        position: absolute;
        background: black;
        width: 35px;
        height: 35px;
        color: white;
        text-align: center;
        line-height: 36px;
        cursor: pointer;
    }

    .slknav .prev {
        left: 0;
    }

    .slknav .next {
        right: 0;
        left: auto;
    }

    .xldslickcarousel.two .slick-current {
        background-color: #fff;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
        padding: 30px 30px 30px;
    }

    .xldslickcarousel.two .slick-slide {
        margin: -40px;
        padding: 30px 30px 30px;
    }

</style>