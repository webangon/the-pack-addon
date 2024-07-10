<?php

if(!class_exists('The_Pack_Kit')){
    class The_Pack_Kit{
        /**
         * A reference to an instance of this class.
         *
         * @since  1.0.0
         * @access private
         * @var    object
         */
        private static $instance = null;

        /**
         * Holder for base plugin URL
         *
         * @since  1.0.0
         * @access private
         * @var    string
         */
        private $plugin_url = null;

        /**
         * Holder for base plugin path
         *
         * @since  1.0.0
         * @access private
         * @var    string
         */
        private $plugin_path = null;

        /**
         * Plugin version
         *
         * @var string
         */
        private $version = '1.1.5';

        /**
         * Framework component
         *
         * @since  1.0.0
         * @access public
         * @var    object
         */
        public $module_loader = null;


        /**
         * @var \ThePackKitThemeBuilder\Modules\Modules_Manager $modules_manager
         */
        public $modules_manager;

        /**
         * @since  2.0.0
         * @access public
         * @var \ThePackKitExtensions\Manager $extensions_manager
         */
        public $extensions_manager;

	    /**
	     * @var Thepack_Kit_Ajax_Manager $ajax_manager;
	     */
        public $ajax_manager;

        /**
         * Holder for current Customizer module instance.
         *
         * @since 1.0.0
         * @var   CX_Customizer
         */
        public $customizer = null;


        /**
         * Sets up needed actions/filters for the plugin to initialize.
         *
         * @since 1.0.0
         * @access public
         * @return void
         */
        public function __construct() {

            spl_autoload_register( [ $this, 'autoload' ] );

            // Load the CX Loader.
            add_action( 'after_setup_theme', array( $this, 'module_loader' ), -20 );


            // Load files.
            add_action( 'init', array( $this, 'init' ), -999 );

            add_action('elementor/init', [ $this, 'on_elementor_init' ] );

            add_action('admin_enqueue_scripts', [ $this, 'admin_enqueue'] );

            // Load handle ajax
	        $this->ajax_manager = new Thepack_Kit_Ajax_Manager();

        }

        /**
         * Load the theme modules.
         *
         * @since  1.0.0
         */
        public function module_loader() {

            // Enable support for Post Formats
            add_theme_support( 'post-formats', array( 'standard', 'video', 'gallery', 'audio', 'quote', 'link' ) );
        }


        /**
         * Returns plugin version
         *
         * @return string
         */
        public function get_version( $basic = false ) {

        	if($basic){
		        return $this->version;
	        }
            return $this->version;
        }

        /**
         * Manually init required modules.
         *
         * @return void
         */
        public function init() {

            $this->load_files();

            thepack_kit_integration()->init();

            $this->extensions_manager = new ThePackKitExtensions\Manager();

            do_action( 'thepack-kit/init', $this );
        }


        /**
         * Check if theme has elementor
         *
         * @return boolean
         */
        public function has_elementor() {
            return defined( 'ELEMENTOR_VERSION' );
        }

        /**
         * Check if theme has elementor
         *
         * @return boolean
         */
        public function has_elementor_pro() {
            return defined( 'ELEMENTOR_PRO_VERSION' );
        }

        /**
         * Returns Elementor instance
         *
         * @return \Elementor\Plugin
         */
        public function elementor() {
            return \Elementor\Plugin::instance();
        }

        public function is_elementor_preview(){
            //phpcs:disable WordPress.Security.NonceVerification.Recommended
            return (!empty( $_GET['elementor_library'] ) && !empty( $_GET['preview_id'] ) && !empty( $_GET['preview'] ));
        }

        /**
         * Load required files.
         *
         * @return void
         */
        public function load_files() {

            require_once $this->plugin_path( 'includes/class-helper.php' );
            require_once $this->plugin_path( 'includes/class-integration.php' );
        }

        /**
         * Returns path to file or dir inside plugin folder
         *
         * @param  string $path Path inside plugin dir.
         * @return string
         */
        public function plugin_path( $path = null ) {

            if ( ! $this->plugin_path ) {
                $this->plugin_path = trailingslashit( plugin_dir_path( __FILE__ ) );
            }

            return $this->plugin_path . $path;
        }
        /**
         * Returns url to file or dir inside plugin folder
         *
         * @param  string $path Path inside plugin dir.
         * @return string
         */
        public function plugin_url( $path = null ) {

            if ( ! $this->plugin_url ) {
                $this->plugin_url = trailingslashit( plugin_dir_url( __FILE__ ) );
            }

            return $this->plugin_url . $path;
        }


        /**
         * Get the template path.
         *
         * @return string
         */
        public function template_path() {
            return apply_filters( 'thepack-kit/template-path', 'thepack-kit/' );
        }

        /**
         * Returns path to template file.
         *
         * @return string|bool
         */
        public function get_template( $name = null ) {

            $template = locate_template( $this->template_path() . $name );

            if ( ! $template ) {
                $template = $this->plugin_path( 'templates/' . $name );
            }

            if ( file_exists( $template ) ) {
                return $template;
            } else {
                return false;
            }
        }

        public function on_elementor_init(){
	        $this->modules_manager = new \ThePackKitThemeBuilder\Modules\Modules_Manager();
        }

        public function admin_enqueue(){
            wp_enqueue_script(
                'thepack-kit-admin',
                $this->plugin_url('assets/js/thepack-kit-admin.js'),
                array( 'jquery' ),
                $this->get_version(),
                true
            );
        }

        public static function get_instance() {
            // If the single instance hasn't been set, set it now.
            if ( null == self::$instance ) {
                self::$instance = new self;
            }
            return self::$instance;
        }

        public function autoload( $class ) {

        	$mappings = [
        		'Thepack_Kit_Ajax_Manager' => 'includes/modules/ajax/manager.php',
	        ];

        	if( array_key_exists( $class, $mappings ) ){
		        if ( ! class_exists( $class ) ) {
			        $filename = $this->plugin_path($mappings[$class]);
			        if ( is_readable( $filename ) ) {
				        include( $filename );
			        }
		        }
		        return;
	        }

            if ( 0 === strpos( $class, 'ThePackKitExtensions' ) ) {
                if ( ! class_exists( $class ) ) {
                    $filename_extends = strtolower(
                        preg_replace(
                            [ '/^' . 'ThePackKitExtensions' . '\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/' ],
                            [ '', '$1-$2', '-', DIRECTORY_SEPARATOR ],
                            $class
                        )
                    );
                    $filename_extends = $this->plugin_path('includes/extensions/' . $filename_extends . '.php');

                    if ( is_readable( $filename_extends ) ) {
                        include( $filename_extends );
                    }
                }
            }


            if ( 0 !== strpos( $class, 'ThePackKitThemeBuilder' ) ) {
                return;
            }

            if ( ! class_exists( $class ) ) {

                $filename = strtolower(
                    preg_replace(
                        [ '/^' . 'ThePackKitThemeBuilder' . '\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/' ],
                        [ '', '$1-$2', '-', DIRECTORY_SEPARATOR ],
                        $class
                    )
                );

                $filename = $this->plugin_path('includes/' . $filename . '.php');

                if ( is_readable( $filename ) ) {
                    include( $filename );
                }
            }

        }

    }
}

if(!function_exists('thepack_kit')){
    /**
     * Returns instance of the plugin class.
     *
     * @since  1.0.0
     * @return object
     */
    function thepack_kit(){
        return The_Pack_Kit::get_instance();
    }

    thepack_kit();
}
