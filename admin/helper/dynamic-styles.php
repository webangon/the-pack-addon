<?php

class The_Pack_Script
{
    public function __construct()
    {
        register_activation_hook(THE_PACK_ADDON_ROOT, [__CLASS__, 'generate_css']);
        add_action('elementor/core/files/clear_cache', [__CLASS__, 'generate_css'], 10, 2);
        add_action('wp_enqueue_scripts', [__CLASS__, 'enqueue_css']);
    }

    public static function compress_css($css)
    {
        $out = str_replace('; ', ';', str_replace(' }', '}', str_replace('{ ', '{', str_replace([
            "\r\n",
            "\r",
            "\n",
            "\t",
            '  ',
            '    ',
            '    '
        ], '', preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css)))));

        return $out;
    }

    public static function grab_files($path)
    {
        return glob(realpath($path) . '/**/*.css');
    }

    public static function generate_css()
    {
        global $wp_filesystem;
        require_once ABSPATH . 'wp-admin/includes/file.php';

        $theme = self::grab_files(THE_PACK_PLUGIN_DIR . '/includes/widgets/theme/');
        $element = self::grab_files(THE_PACK_PLUGIN_DIR . '/includes/widgets/element/');
        $woocommerce = self::grab_files(THE_PACK_PLUGIN_DIR . '/includes/widgets/woocommerce/');
        $third_party = self::grab_files(THE_PACK_PLUGIN_DIR . '/includes/widgets/third-party/');

        $all_files = array_merge($theme, $element,$woocommerce,$third_party);
        $csscont = '';
        foreach ($all_files as $filename) {
            //phpcs:disable WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
            $csscont .= file_get_contents($filename);
        }

        $upload_dir = wp_upload_dir();
        $dir = trailingslashit($upload_dir['basedir']);
        WP_Filesystem();
        $wp_filesystem->put_contents($dir . 'thepackwidget.css', self::compress_css($csscont), 0644);
    }

    public static function enqueue_css()
    {
        $uploads = wp_upload_dir();
        wp_enqueue_style('thepackwidget', trailingslashit($uploads['baseurl']) . 'thepackwidget.css',[], THE_PACK_PLUGIN_VERSION);

    }
}

new The_Pack_Script(); 
