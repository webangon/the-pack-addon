<?php
$icon = the_pack_render_icon( $settings['tap'],'open');
$tap = $settings['btn'] || $settings['tap']  ? '<span class="tp-tap">'.$settings['btn'].$icon.'</span>' : '';
?>

<div class="tp-off-sidebar xlmega-header">
    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
    <?php echo thepack_build_html($tap);?>
    <div class="offsidebar <?php echo esc_attr($settings['pos']);?>">
        <div class="offmenuwraps">
            <?php
            if ($settings['source'] == 'menu') {
                wp_nav_menu([
                    'menu' => $settings['menu'],
                    'container' => false,
                    'menu_class' => 'mainmenu',
                    'items_wrap' => '<ul class="momenu-list">%3$s</ul>',
                ]);
            } else {
                echo do_shortcode('[THEPACK_INSERT_TPL id="' . $settings['template'] . '"]');
            }
            ?> 
        </div>
    </div>
    <div class="click-capture"></div>
</div>
