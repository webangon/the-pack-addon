<?php
if (!defined('ABSPATH')) {
    exit;
}
 
class The_Pack_Activation_Class
{
    public function __construct()
    {
        register_activation_hook(THE_PACK_ADDON_ROOT, [__CLASS__, 'init']);
        add_action('elementor/tracker/send_event', [__CLASS__, 'init']); 
        add_action( 'elementor/core/files/clear_cache', array( __CLASS__, 'init' ), 10, 2 );
    }
 
    public static function init() 
    {
        $remote_widget = \The_Pack_Cloud_Library::$plugin_data['remote_widget'];
        $remote_sites = \The_Pack_Cloud_Library::$plugin_data['remote_sites'];
        $site_category = \The_Pack_Cloud_Library::$plugin_data['thepack_site_cat'];

        $library_data = json_decode(wp_remote_retrieve_body(wp_remote_get($remote_widget . '/wp-json/wp/v2/thepack_widgets/')), true);
        $sites = json_decode(wp_remote_retrieve_body(wp_remote_get($remote_sites . '/wp-json/wp/v2/thepack_sites/?cat='.$site_category )), true);

        if ( $library_data && $sites ){

            $library_data['sites'] = $sites;
            update_option('the_pack_library', $library_data); 
            
        }

        The_Pack_Script::generate_css();
    }
}

new The_Pack_Activation_Class();
