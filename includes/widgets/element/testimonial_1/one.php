<?php
$swiper_opt = the_pack_swiper_markup($settings);
$quote_icon = $settings['quote_icon']['value'] ? '<i class="tpquote ' . $settings['quote_icon']['value'] . '"></i>' : '';
$out1 = '';
foreach ($settings['items'] as $item) {  
    $rating = $item['rating'] ? '<span class="tscore"><span style="width: ' . $item['rating']['size'] . '%"></span></span>' : '';
    $heading = $item['heading'] ? '<h3 class="heading">' . $item['heading'] . '</h3>' : '';
    $desc = $item['desc'] ? '<p class="desc">' . $item['desc'] . '</p>' : '';
    $img = wp_get_attachment_image($item['avatar']['id'], 'full');
    $name = $item['name'] ? '<p class="name">' . $item['name'] . '</p>' : '';
    $pos = $item['pos'] ? '<p class="pos">' . $item['pos'] . '</p>' : '';

    $out1 .= '
   <div class="flexs items swiper-slide">
      ' . $quote_icon . '
      <div class="items-wrap">
      ' . $heading . $rating . '
      ' . $desc . '
      <div class="inner">
      <div class="tp-flex-equal">
          <div class="thumb tp-col">
          ' . $img . '
          </div>
          <div class="info tp-col">
          ' . $name . $pos . '
          </div>
      </div></div>
      </div>
  </div>
  ';
}

?> 

<?php echo '<div class="swiper testimonial-1 tpswiper" data-xld =\'' . wp_kses_post(wp_json_encode($swiper_opt['settings'])) . '\'>'; ?>
<div class="swiper-wrapper">
    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php echo thepack_build_html($out1); ?>
</div>
<?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
<?php echo $swiper_opt['nav']; ?>
</div>


