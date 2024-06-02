<?php
namespace Elementor\TemplateLibrary;

if (!defined('ABSPATH')) {
    exit;
}
if (did_action('elementor/loaded')) {
    class The_Pack_Import_Library extends Source_Base
    {
        public function __construct()
        {
            parent::__construct();
            add_action('wp_ajax_the_pack_import_template', [$this, 'xl_tab_import_data']);
        }

        public function get_id()
        {
        }

        public function get_title()
        {
        }

        public function register_data()
        {
        }

        public function get_items($args = [])
        {
        }

        public function get_item($template_id)
        {
        }

        public function get_data(array $args)
        {
        }

        public function delete_template($template_id)
        {
        }

        public function save_item($template_data)
        {
        }

        public function update_item($new_data)
        {
        }

        public function export_template($template_id)
        { 
        }   

        public function xl_tab_import_data() 
        {
            if (!current_user_can('manage_options') || !wp_verify_nonce(esc_attr(wp_unslash($_POST['nonce'])), 'ajax-nonce')) {
				exit;
			}
                        
            $id = esc_attr($_POST['id']);
            $remote = esc_attr($_POST['parent_site']);
            $end_point = \The_Pack_Cloud_Library::$plugin_data['thepack_import_data'];
            $data = json_decode(wp_remote_retrieve_body(wp_safe_remote_get($remote . 'wp-json/wp/v2/' . $end_point . '/?id=' . $id)), true);
            $content = $data['content'];
            $content = $this->process_export_import_content($content, 'on_import');
            $content = $this->replace_elements_ids($content);
            echo wp_json_encode($content);
            wp_die();
        }
    }

    new The_Pack_Import_Library();
}
