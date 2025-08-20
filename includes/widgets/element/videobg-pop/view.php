<?php
$icon = the_pack_render_icon($settings['icon'],'tbicon');
$heading = $settings['heading'] ? '<h3 class="heading">' . $settings['heading'] . '</h3>' : '';
$sub = $settings['sub'] ? '<span class="sub">' . $settings['sub'] . '</span>' : '';
$vidurl = $settings['url'] ? 'data-vurl="' . esc_url($settings['url']) . '" ' : '';
$close_icon = thepack_icon_svg($settings['close']);
?>

<div class="tp-video-thumbs tb_videobgpopwrp tp-video-pop">
    <div class="tb_videobgpop">
        <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        <div <?php echo thepack_build_html($vidurl); ?> class="vidbg tpvideopop tbtr">
             <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php echo thepack_build_html($icon); ?>
        </div>
        <div class="desc">
            <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php echo thepack_build_html($heading . $sub); ?>
        </div>
    </div>
</div>
    