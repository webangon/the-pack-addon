<?php
/*
Plugin Name: The Pack
Plugin URI: https://webangon.com/
Description: The Pack plugin you install after Elementor! Packed with 110+ stunning free elements including Accordion, Testimonial,WooCommerce, and template library.
Author: Webangon
Author URI: https://webangon.com
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html
Version: 2.0.8.4
Text Domain: the-pack-addon
Domain Path: /languages/
*/
 
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('thepack_elementor_addon_widget')) {
    class thepack_elementor_addon_widget
    {
        private static $instance;

        public static function instance()
        {
            if (!isset(self::$instance) && !(self::$instance instanceof thepack_elementor_addon_widget)) {
                self::$instance = new thepack_elementor_addon_widget;

                self::$instance->thepack_setup_constants();

                self::$instance->thepack_hooks();

                self::$instance->thepack_includes();
            }

            return self::$instance;
        }

        public function __clone()
        {
            _doing_it_wrong(__FUNCTION__, esc_html__('Cheatin&#8217; huh?', 'the-pack-addon'), '1.6');
        }

        public function __wakeup()
        {
            _doing_it_wrong(__FUNCTION__, esc_html__('Cheatin&#8217; huh?', 'the-pack-addon'), '1.6');
        }

        private function thepack_setup_constants()
        {   
            if( !function_exists('get_plugin_data') ){
                require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
            }            
            $plugin_data = get_plugin_data( __FILE__ );

            if (!defined('THE_PACK_PLUGIN_VERSION')) {
                define('THE_PACK_PLUGIN_VERSION', $plugin_data['Version']);
            }

            if (!defined('THE_PACK_PLUGIN_DIR')) {
                define('THE_PACK_PLUGIN_DIR', plugin_dir_path(__FILE__));
            }

            if (!defined('THE_PACK_PLUGIN_URL')) {
                define('THE_PACK_PLUGIN_URL', plugin_dir_url(__FILE__));
            }

            if (!defined('THE_PACK_ADDON_ROOT')) {
                define('THE_PACK_ADDON_ROOT', __FILE__);
            }
        }

        /**
         * Include required files
         *
         */
        private function thepack_includes()
        {
            include_once THE_PACK_PLUGIN_DIR . 'includes/helper-functions.php';
            include_once THE_PACK_PLUGIN_DIR . 'includes/template-lib.php';
            include_once THE_PACK_PLUGIN_DIR . 'includes/header-footer/index.php';
            include_once THE_PACK_PLUGIN_DIR . 'includes/query-functions.php';
            include_once THE_PACK_PLUGIN_DIR . 'includes/pro-widget-message.php';

            include_once THE_PACK_PLUGIN_DIR . 'admin/helper/dynamic-styles.php';
            include_once THE_PACK_PLUGIN_DIR . 'admin/helper/activation.php';

            include_once THE_PACK_PLUGIN_DIR . 'admin/inc/dash.php';

            include_once THE_PACK_PLUGIN_DIR . 'admin/helper/index.php';
            include_once THE_PACK_PLUGIN_DIR . 'admin/lib/index.php';
            include_once THE_PACK_PLUGIN_DIR . 'includes/extension/index.php';
            include_once THE_PACK_PLUGIN_DIR . 'includes/contact_helper.php';

            include_once THE_PACK_PLUGIN_DIR . 'includes/woocommerce/functions.php';

        }

        /**
         * Setup the default hooks and actions
         */
        private function thepack_hooks()
        {
            add_action('admin_init', [$this, 'installed_active_elementor'], 10);
            add_action('elementor/widgets/register', [self::$instance, 'thepack_include_widgets']);
            add_action('elementor/frontend/after_register_scripts', [$this, 'thepack_frontend_scripts']);
            add_action('elementor/frontend/after_enqueue_styles', [$this, 'thepack_frontend_styles']);
            add_action('elementor/init', [$this, 'thepack_add_elementor_category']);
            add_action('elementor/editor/after_enqueue_scripts', [$this, 'elementor_editor_scripts']);
            add_action('template_redirect', [self::$instance, 'template_preview'], 9);
            add_action('wp_footer', [$this, 'inject_pop_wrap']);
            add_filter('elementor/icons_manager/additional_tabs', [$this, 'icons_tabs']);
            add_action('init', [$this, 'init']);
            add_action( 'plugin_action_links_'. plugin_basename( __FILE__ ), array( $this, 'my_plugin_action_links' ), 10 );
        }

        public function my_plugin_action_links( $links ) {

			$links = array_merge( array(
				'<a href="' . esc_url( admin_url( 'admin.php?page=the-pack-demo' ) ) . '">' . esc_html__( 'Starter Sites', 'the-pack-addon' ) . '</a>'
			), $links );

			return $links;

		}

        public function init()
        {
            add_theme_support('automatic-feed-links');
            add_theme_support('title-tag');
            add_theme_support( 'woocommerce' );
            add_theme_support( 'wc-product-gallery-slider' );
            add_theme_support('post-thumbnails');
            add_theme_support('wp-block-styles');
            add_theme_support('align-wide');
            add_theme_support('html5', [
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            ]);

            register_nav_menus([
                'primary' => esc_attr__('Primary', 'the-pack-addon'),
            ]);
        }

        public function icons_tabs($tabs = [])
        {
            $tabs['themify-icons'] = [
                'name' => 'themify-icons',
                'label' => esc_html__('Themify', 'icon-element'),
                'labelIcon' => 'ti-wand',
                'prefix' => 'ti-',
                'displayPrefix' => 'tivo',
                'url' => THE_PACK_PLUGIN_URL . 'assets/iconfont/themify-icons/themify-icons.css',
                'fetchJson' => THE_PACK_PLUGIN_URL . 'assets/iconfont/themify-icons/fonts/themify-icons.json',
                'ver' => '3.0.1',
            ];

            $tabs['uicons'] = [
                'name' => 'uicons',
                'label' => esc_html__('Uicons', 'icon-element'),
                'labelIcon' => 'fi-rr-0',
                'prefix' => 'fi-rr-',
                'displayPrefix' => 'uic',
                'url' => THE_PACK_PLUGIN_URL . 'assets/iconfont/uicons/uicons.css',
                'fetchJson' => THE_PACK_PLUGIN_URL . 'assets/iconfont/uicons/fonts/uicons.json',
                'ver' => '3.0.1',
            ];

            return $tabs;
        }
         
        public function inject_pop_wrap() 
        {
            echo '<div style="display:none;" class="tp-pop-response"><div class="loader"></div><span class="close"><i class="ti-close"></i></span><div class="inner"><div class="popwrap"></div></div></div>';
        } 

        public function installed_active_elementor()
        {
            if (is_admin() && current_user_can('activate_plugins') && !did_action('elementor/loaded')) {
                add_action('admin_notices', [$this, 'elementor_inactive_not_present'], 10);

                deactivate_plugins('the-pack-addon/index.php');

                if (isset($_GET['activate'])) {//phpcs:disable WordPress.Security.NonceVerification.Recommended
                    unset($_GET['activate']);
                }
            }
        }

        public function elementor_inactive_not_present()
        {
            $class = 'notice notice-error';
            $plugin = 'elementor/elementor.php';
            /* Translators: %s required plugin. */
            $message = sprintf(esc_html__('The %1$sThe Pack%2$s plugin requires %1$sElementor%2$s plugin installed & activated.', 'the-pack-addon'), '<strong>', '</strong>');

            if (file_exists(WP_PLUGIN_DIR . '/elementor/elementor.php')) {
                $action_url = wp_nonce_url('plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin);
                $button_label = esc_html__('Activate Elementor', 'the-pack-addon');
            } else {
                $action_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=elementor'), 'install-plugin_elementor');
                $button_label = esc_html__('Install Elementor', 'the-pack-addon');
            }

            $button = '<p><a href="' . esc_url($action_url) . '" class="button-primary">' . esc_html($button_label) . '</a></p><p></p>';

            printf('<div class="%1$s"><p>%2$s</p>%3$s</div>', esc_attr($class), wp_kses_post($message), wp_kses_post($button));
        }

        public function template_preview()
        {
            $instance = \Elementor\Plugin::$instance->templates_manager->get_source('local');
            remove_action('template_redirect', [$instance, 'block_template_frontend']);
        }


        public function elementor_editor_scripts() 
        {
            wp_enqueue_script('tp-backend-editor', THE_PACK_PLUGIN_URL . 'assets/js/elementor-editor.min.js', [], THE_PACK_PLUGIN_VERSION, true);
        }

        /**
         * Load Frontend Scripts
         *
         */
        public function thepack_frontend_scripts()
        {
            wp_enqueue_script(['jquery', 'masonry']);
            wp_enqueue_script('lazysizes', THE_PACK_PLUGIN_URL . 'assets/js/lazysizes.min.js', [], THE_PACK_PLUGIN_VERSION, true);
            wp_enqueue_script('jquery-nav', THE_PACK_PLUGIN_URL . 'assets/js/jquery.nav.js', [], THE_PACK_PLUGIN_VERSION, true);
            wp_enqueue_script('rellax', THE_PACK_PLUGIN_URL . 'assets/js/rellax.min.js', [], THE_PACK_PLUGIN_VERSION, true);
            wp_enqueue_script('aos', THE_PACK_PLUGIN_URL . 'assets/js/aos.js', [], THE_PACK_PLUGIN_VERSION, true);
            wp_enqueue_script('tilt', THE_PACK_PLUGIN_URL . 'assets/js/tilt.jquery.min.js', [], THE_PACK_PLUGIN_VERSION, true);
            wp_enqueue_style('e-animations');
            $scripts = [
                'circle-progress',
                'plyr',
                'countdown',
                'slick',
                'beerslider',
                'jarallax',
                'flex-images',
                'fitvideos',
                'highlight'
            ];

            if (is_array($scripts)) {
                foreach ($scripts as $key => $value) {
                    if (!empty($value)) {
                        wp_enqueue_script($value, THE_PACK_PLUGIN_URL . 'assets/js/' . $value . '.js', [], THE_PACK_PLUGIN_VERSION, true);
                    }
                }
            }

            wp_enqueue_script('thepack-js', THE_PACK_PLUGIN_URL . 'assets/js/custom.js', [], THE_PACK_PLUGIN_VERSION, true);
            wp_localize_script('thepack-js', 'tp_loadmore_params', [
                'ajaxurl' => admin_url('admin-ajax.php'),
                'current_page' => get_query_var('paged') ? get_query_var('paged') : 1,
                'nonce' => wp_create_nonce('ajax-nonce'),
            ]);            
        }

        public function thepack_frontend_styles()
        {
            wp_enqueue_style('thepack-shortcode', THE_PACK_PLUGIN_URL . 'assets/css/shortcode.css', [], THE_PACK_PLUGIN_VERSION);
            wp_enqueue_style('aos', THE_PACK_PLUGIN_URL . 'assets/css/aos.css', [], THE_PACK_PLUGIN_VERSION);
            wp_enqueue_style('dashicons');

            $style = [
                'beerslider-styl',
                'plyr-styl',
                'slick-styl',
                'animate-styl',
                'highlight'
            ];

            if (is_array($style)) {
                foreach ($style as $key => $value) {
                    if (!empty($value)) {
                        wp_enqueue_style($value, THE_PACK_PLUGIN_URL . 'assets/css/' . $value . '.css', [], THE_PACK_PLUGIN_VERSION);
                    }
                }
            }

            wp_enqueue_style('thepack-woocommerce', THE_PACK_PLUGIN_URL . 'assets/css/woocommerce.css', [], THE_PACK_PLUGIN_VERSION);
 
        }

        public function thepack_add_elementor_category()
        {
            \Elementor\Plugin::instance()->elements_manager->add_category(
                'ashelement-addons',
                [
                    'title' => esc_html__('The Pack', 'the-pack-addon'),
                    'icon' => 'fa fa-plug',
                ],
                1
            );

            \Elementor\Plugin::instance()->elements_manager->add_category(
                'thepack-woo',
                [
                    'title' => esc_html__('The Pack Woo', 'the-pack-addon'),
                    'icon' => 'fa fa-plug',
                ],
                1
            );

        }

        /**
         * Include required files
         *
         */
        public function glob_widget($path, $widgets_manager)
        {
            $widgets = [];
            foreach (glob($path . '*') as $file) {
                $widgets[] = substr($file, strrpos($file, '/') + 1);
            }

            if (is_array($widgets)) {
                foreach ($widgets as $key => $value) {
                    if (!empty($value)) {
                        require_once $path . $value . '/index.php';
                    }
                }
            }
        }

        public function thepack_include_widgets($widgets_manager)
        {
            $this->glob_widget(THE_PACK_PLUGIN_DIR . '/includes/widgets/theme/', $widgets_manager);
            $this->glob_widget(THE_PACK_PLUGIN_DIR . '/includes/widgets/element/', $widgets_manager);
            $this->glob_widget(THE_PACK_PLUGIN_DIR . '/includes/widgets/woocommerce/', $widgets_manager);
        }
    }
}


function run_the_pack_addon()
{
    return thepack_elementor_addon_widget::instance();
}

add_action( 'plugins_loaded', 'run_the_pack_addon' );


