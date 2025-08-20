<?php
namespace ThePackKitThemeBuilder\Modules\Woocommerce;

use Elementor\Core\Documents_Manager;
use ThePackKitThemeBuilder\Modules\ThemeBuilder\Classes\Conditions_Manager;
use ThePackKitThemeBuilder\Modules\Woocommerce\Conditions\Woocommerce;
use ThePackKitThemeBuilder\Modules\Woocommerce\Documents\Product;
use ThePackKitThemeBuilder\Modules\Woocommerce\Documents\Product_Post;
use ThePackKitThemeBuilder\Modules\Woocommerce\Documents\Product_Archive;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Module extends \Elementor\Core\Base\Module {

    const WOOCOMMERCE_GROUP = 'woocommerce';

	protected $docs_types = [];

	public static function is_active() {
		return class_exists( 'woocommerce', false);
	}

	public static function is_product_search() {
		return is_search() && 'product' === get_query_var( 'post_type' );
	}

	public function get_name() {
		return 'woocommerce';
	}

    public function register_tags() {
        $tags = [

        ];

        /** @var \Elementor\Core\DynamicTags\Manager $module */
        $module = thepack_kit()->elementor()->dynamic_tags;

        $module->register_group( self::WOOCOMMERCE_GROUP, [
            'title' => esc_html__( 'WooCommerce', 'the-pack-addon'  ),
        ] );

        foreach ( $tags as $tag ) {
            $tag = '\ThePackKitThemeBuilder\\Modules\\Woocommerce\\tags\\' . $tag;

            $module->register( new $tag() );
        }
    }

	public function register_wc_hooks() {
		wc()->frontend_includes();
	}

	public function woocommerce_product_loop_start( $output ){

	    return $output;
    }

    public function woocommerce_product_loop_end( $output ){

        return $output;
    }

	/**
	 * @param Conditions_Manager $conditions_manager
	 */
	public function register_conditions( $conditions_manager ) {
		$woocommerce_condition = new Woocommerce();

		$conditions_manager->get_condition( 'general' )->register_sub_condition( $woocommerce_condition );
	}

	/**
	 * @param Documents_Manager $documents_manager
	 */
	public function register_documents( $documents_manager ) {
		$this->docs_types = [
			'product-post' => Product_Post::get_class_full_name(),
			'product' => Product::get_class_full_name(),
			'product-archive' => Product_Archive::get_class_full_name(),
		];

		foreach ( $this->docs_types as $type => $class_name ) {
			$documents_manager->register_document_type( $type, $class_name );
		}
	}

	public function theme_template_include( $need_override_location, $location ) {
		if ( is_product() && 'single' === $location ) {
			$need_override_location = true;
		}

		return $need_override_location;
	}

	public function __construct() {
		parent::__construct();

        if(!thepack_kit()->has_elementor_pro()){
            add_action( 'elementor/dynamic_tags/register', [ $this, 'register_tags' ] );
            add_action( 'elementor/documents/register', [ $this, 'register_documents' ] );
            add_action( 'elementor/theme/register_conditions', [ $this, 'register_conditions' ] );
            add_filter( 'elementor/theme/need_override_location', [ $this, 'theme_template_include' ], 10, 2 );
			//phpcs:disable WordPress.Security.NonceVerification.Recommended
            if ( ! empty( $_REQUEST['action'] ) && 'elementor' === $_REQUEST['action'] && is_admin() ) {
                add_action( 'init', [ $this, 'register_wc_hooks' ], 5 );
            }			
        }
        add_filter( 'woocommerce_product_loop_start', [ $this, 'woocommerce_product_loop_start' ], -1001 );
        add_filter( 'woocommerce_product_loop_end', [ $this, 'woocommerce_product_loop_end' ], 1001  );

	}
}
