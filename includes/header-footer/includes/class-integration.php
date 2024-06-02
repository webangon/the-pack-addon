<?php
/**
 * Class description
 *
 * @package   package_name
 * @author    Cherry Team
 * @license   GPL-2.0+
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'ThePack_Kit_Integration' ) ) {

	/**
	 * Define ThePack_Kit_Integration class
	 */
	class ThePack_Kit_Integration {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private static $instance = null;

        public $sys_messages = [];

		/**
		 * Initalize integration hooks
		 *
		 * @return void
		 */
		public function init() {

            // WPML compatibility
            if ( defined( 'WPML_ST_VERSION' ) ) {
                add_filter( 'thepack-kit/themecore/get_location_templates/template_id', array( $this, 'set_wpml_translated_location_id' ) );
            }

            // Polylang compatibility
            if ( class_exists( 'Polylang' ) ) {
                add_filter( 'thepack-kit/themecore/get_location_templates/template_id', array( $this, 'set_pll_translated_location_id' ) );
            }

            add_action( 'wp_enqueue_scripts', array( $this, 'frontend_enqueue' ) );

            add_action('thepack-kit/ajax/register_actions', [ $this, 'register_ajax_actions' ] );


		}

		/**
		 * Check if we currently in Elementor mode
		 *
		 * @return boolean
		 */
		public function in_elementor() {

            $result = false;

            if ( wp_doing_ajax() ) {
                $result = ( isset( $_REQUEST['action'] ) && 'elementor_ajax' === $_REQUEST['action'] );
            } elseif ( Elementor\Plugin::instance()->editor->is_edit_mode()
                && 'wp_enqueue_scripts' === current_filter() ) {
                $result = true;
            } elseif ( Elementor\Plugin::instance()->preview->is_preview_mode() && 'wp_enqueue_scripts' === current_filter() ) {
                $result = true;
            }

			/**
			 * Allow to filter result before return
			 *
			 * @var bool $result
			 */
			return apply_filters( 'thepack-kit/in-elementor', $result );
		}


        public function frontend_enqueue(){

		        wp_register_script(  'thepack-kit-base' , thepack_kit()->plugin_url('assets/js/thepack-kit-base.js') , [ 'elementor-frontend' ],  thepack_kit()->get_version() , true );

            $ThePackKitSettings = [
	            'homeURL'        => esc_url(home_url('/')),
	            'ajaxUrl'        => esc_url( admin_url( 'admin-ajax.php' ) ),
	            'ajaxNonce'      => thepack_kit()->ajax_manager->create_nonce(),
	            'useFrontAjax'   => 'true',
            ];

            wp_localize_script('thepack-kit-base', 'ThePackKitSettings', $ThePackKitSettings );

        }

        /**
         * Set WPML translated location.
         *
         * @param $post_id
         *
         * @return mixed|void
         */
        public function set_wpml_translated_location_id( $post_id ) {
            $location_type = get_post_type( $post_id );

            return apply_filters( 'wpml_object_id', $post_id, $location_type, true );
        }

        /**
         * set_pll_translated_location_id
         *
         * @param $post_id
         *
         * @return false|int|null
         */
        public function set_pll_translated_location_id( $post_id ) {

            if ( function_exists( 'pll_get_post' ) ) {

                $translation_post_id = pll_get_post( $post_id );

                if ( null === $translation_post_id ) {
                    // the current language is not defined yet
                    return $post_id;
                } elseif ( false === $translation_post_id ) {
                    //no translation yet
                    return $post_id;
                } elseif ( $translation_post_id > 0 ) {
                    // return translated post id
                    return $translation_post_id;
                }
            }

            return $post_id;
        }


		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @return object
		 */
		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self();
			}
			return self::$instance;
		}


		/**
		 * @param Thepack_Kit_Ajax_Manager $ajax_manager
		 */
		public function register_ajax_actions( $ajax_manager ){
			$ajax_manager->register_ajax_action( 'elementor_template', [ $this, 'ajax_get_elementor_template' ] );
		}

	}

}

/**
 * Returns instance of ThePack_Kit_Integration
 *
 * @return object
 */
function thepack_kit_integration() {
	return ThePack_Kit_Integration::get_instance();
}
