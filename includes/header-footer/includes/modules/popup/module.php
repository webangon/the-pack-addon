<?php
namespace ThePackKitThemeBuilder\Modules\Popup;

use Elementor\Core\Admin\Menu\Main as MainMenu;
use Elementor\Core\Common\Modules\Ajax\Module as Ajax;
use Elementor\Core\Documents_Manager;
use Elementor\Core\DynamicTags\Manager as DynamicTagsManager;
use Elementor\TemplateLibrary\Source_Local;
use ThePackKitThemeBuilder\Modules\ThemeBuilder\Classes\Locations_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends \Elementor\Core\Base\Module {
	const DOCUMENT_TYPE = 'popup';

	public function __construct() {
		parent::__construct();

		add_action( 'elementor/documents/register', [ $this, 'register_documents' ] );
		add_action( 'elementor/theme/register_locations', [ $this, 'register_location' ] );
		add_action( 'elementor/dynamic_tags/register', [ $this, 'register_tag' ] );
		add_action( 'elementor/ajax/register_actions', [ $this, 'register_ajax_actions' ] );

		add_action( 'wp_footer', [ $this, 'print_popups' ] );
//		add_action( 'thepack-kit/init', [ $this, 'add_form_action' ] );

        add_action( 'admin_menu', [ $this, 'register_admin_menu' ], 503 );

		add_filter( 'elementor/finder/categories', [ $this, 'add_finder_items' ] );
        add_action('elementor/theme/after_do_popup', function(){
            wp_enqueue_script('thepack-kit-popup');
            wp_enqueue_style('thepack-kit-popup');
        });

        add_action('elementor/frontend/after_register_styles', [
            $this,
            'register_enqueue_scripts'
        ]);
	}

	public function get_name() {
		return 'popup';
	}

	public function add_form_action() {
		$this->add_component( 'form-action', new Form_Action() );
	}

	public static function add_popup_to_location( $popup_id ) {
		/** @var \ThePackKitThemeBuilder\Modules\ThemeBuilder\Module $theme_builder */
        $theme_builder = thepack_kit()->modules_manager->get_modules( 'theme-builder' );

		$theme_builder->get_locations_manager()->add_doc_to_location( Document::get_property( 'location' ), $popup_id );
	}

	public function register_documents( Documents_Manager $documents_manager ) {
		$documents_manager->register_document_type( self::DOCUMENT_TYPE, Document::get_class_full_name() );
	}

	public function register_location( Locations_Manager $location_manager ) {
		$location_manager->register_location(
			'popup',
			[
				'label' => esc_html__( 'Popup', 'the-pack-addon'  ),
				'multiple' => true,
				'public' => false,
				'edit_in_content' => false,
			]
		);
	}

	public function print_popups() {
		elementor_theme_do_location( 'popup' );
	}

	public function register_tag( DynamicTagsManager $dynamic_tags ) {
		$tag = __NAMESPACE__ . '\Tag';

		$dynamic_tags->register( new $tag() );
	}

	public function register_ajax_actions( Ajax $ajax ) {
		$ajax->register_ajax_action( 'lakit_popup_save_display_settings', [ $this, 'save_display_settings' ] );
	}

	public function save_display_settings( $data ) {
		/** @var Document $popup_document */
		$popup_document = thepack_kit()->elementor()->documents->get( $data['editor_post_id'] );

		$popup_document->save_display_settings_data( $data['settings'] );
	}

	/**
	 * Add New item to admin menu.
	 *
	 * Fired by `admin_menu` action.
	 *
	 */
	public function register_admin_menu() {
        add_submenu_page( 
            'edit.php?post_type=elementor_library',
            '',
            esc_html__( 'Popups', 'the-pack-addon'  ),
            'publish_posts',
            $this->get_admin_url( true )
        );
        remove_submenu_page(Source_Local::ADMIN_MENU_SLUG, 'popup_templates');
	}

	public function add_finder_items( array $categories ) {
		$categories['general']['items']['popups'] = [
			'title' => esc_html__( 'Popups', 'the-pack-addon'  ),
			'icon' => 'library-save',
			'url' => $this->get_admin_url(),
			'keywords' => [ 'template', 'popup', 'library' ],
		];

		// Backwards compatibility - Remove after ED-4826 is merged.
		if ( empty( $categories['create']['items']['popup'] ) ) {
			$categories['create']['items']['popups'] = [
				'title' => esc_html__( 'Add New Popup', 'the-pack-addon'  ),
				'icon' => 'plus-circle-o',
				'url' => $this->get_admin_url() . '#add_new',
				'keywords' => [ 'template', 'theme', 'popup', 'new', 'create' ],
			];
		}

		return $categories;

	}

	private function get_admin_url( $relative = false ) {
		$base_url = Source_Local::ADMIN_MENU_SLUG;
		if ( ! $relative ) {
			$base_url = admin_url( $base_url );
		}

		return add_query_arg(
			[
				'tabs_group' => 'popup',
				'elementor_library_type' => 'popup',
			],
			$base_url
		);
	}

    public function register_enqueue_scripts(){
        wp_register_script('thepack-kit-popup', thepack_kit()->plugin_url('includes/modules/popup/assets/js/popup.min.js'), ['thepack-kit-base'], thepack_kit()->get_version(), true);
        wp_register_style('thepack-kit-popup', thepack_kit()->plugin_url('includes/modules/popup/assets/css/popup.min.css'), [], thepack_kit()->get_version());
    }
}
