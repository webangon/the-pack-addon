<?php

class zxp
{
    private static $instance;

    public static function instance()
    {
        if (!isset(self::$instance) && !(self::$instance instanceof zxp)) {
            self::$instance = new zxp;
            self::$instance->thepack_includes();
            self::$instance->thepack_hooks();
        }

        return self::$instance;
    }

    private function thepack_hooks()
    {
        add_action('elementor/preview/enqueue_scripts', [$this, 'ooohboi_register_scripts_front']);
        add_action('wp_enqueue_scripts', [$this, 'thepack_frontend_styles']);
    }

    private function thepack_includes()
    {
        require_once THE_PACK_PLUGIN_DIR . 'includes/extension/inc/ou.php';
        require_once THE_PACK_PLUGIN_DIR . 'includes/extension/inc/section.php';
        require_once THE_PACK_PLUGIN_DIR . 'includes/extension/inc/translate.php';
        require_once THE_PACK_PLUGIN_DIR . 'includes/extension/inc/column.php';
        require_once THE_PACK_PLUGIN_DIR . 'includes/extension/inc/container.php';
        require_once THE_PACK_PLUGIN_DIR . 'includes/extension/inc/container-hover.php';
        require_once THE_PACK_PLUGIN_DIR . 'includes/extension/inc/icon_box.php';
        require_once THE_PACK_PLUGIN_DIR . 'includes/extension/inc/icon.php';
        require_once THE_PACK_PLUGIN_DIR . 'includes/extension/inc/icon-list.php';
        require_once THE_PACK_PLUGIN_DIR . 'includes/extension/inc/image.php';
        require_once THE_PACK_PLUGIN_DIR . 'includes/extension/inc/gallery.php';
        require_once THE_PACK_PLUGIN_DIR . 'includes/extension/inc/heading.php';
        require_once THE_PACK_PLUGIN_DIR . 'includes/extension/inc/custom_css.php';
        require_once THE_PACK_PLUGIN_DIR . 'includes/extension/inc/tp-parallax.php';
        require_once THE_PACK_PLUGIN_DIR . 'includes/extension/inc/shape-divider.php';
        require_once THE_PACK_PLUGIN_DIR . 'includes/extension/inc/thepack-extension.php';
        require_once THE_PACK_PLUGIN_DIR . 'includes/extension/inc/cursor-scroll.php';
        require_once THE_PACK_PLUGIN_DIR . 'includes/extension/inc/sticky.php';
        require_once THE_PACK_PLUGIN_DIR . 'includes/extension/inc/video.php';
        require_once THE_PACK_PLUGIN_DIR . 'includes/extension/inc/editor.php';
        require_once THE_PACK_PLUGIN_DIR . 'includes/extension/inc/tab.php';
        require_once THE_PACK_PLUGIN_DIR . 'includes/extension/inc/counter.php';
        require_once THE_PACK_PLUGIN_DIR . 'includes/extension/inc/motion.php';
    }

    public function ooohboi_register_scripts_front()
    {
        wp_enqueue_script('thepack-section', plugins_url('js/thepack-section.js', __FILE__), [], THE_PACK_PLUGIN_VERSION, true);
    }

    public function thepack_frontend_styles()
    { 
        wp_enqueue_style('thepack-section', plugins_url('css/style.css', __FILE__), [], THE_PACK_PLUGIN_VERSION, true);
    }
}

if ( did_action('elementor/loaded') ){
    zxp::instance();
}

