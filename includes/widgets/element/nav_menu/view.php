    <?php if ($settings['native']) {
        //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
        echo render_nav_menu($settings['menu']);
    } else {
        rendor_custom_nav_menu($settings['menus']);
    } ?>  