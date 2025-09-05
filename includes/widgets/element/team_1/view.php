<?php
$swiper_opt = the_pack_swiper_markup($settings);

if ($settings['disp'] == 'slider') {
    echo '<div class="swiper tpswiper team1carou" data-xld =\'' . wp_kses_post(wp_json_encode($swiper_opt['settings'])) . '\'>
                <div class="swiper-wrapper">';?>
                    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    <?php echo $this->content($settings['items'], $settings['disp']);?>
                </div>
                <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                <?php echo $swiper_opt['nav'];?>
            </div>
<?php } else {
    //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
    echo '<div class="tbteam1 tp-no-overflow">' . $this->content($settings['items'], $settings['disp']) . '</div>';
}
  