<?php
    $args = [
        'echo' => false,
        'menu' => $settings['menu'],
        'items_wrap' => '<ul class="raw-style momenu-list">%3$s</ul>'
    ];
	if ($settings['menu']) {
        echo '<div data-xld ="'.esc_attr($settings['icon']['value']).'" class="tp-accordionmenu">'.wp_nav_menu($args).'</div>';
    }
?>
