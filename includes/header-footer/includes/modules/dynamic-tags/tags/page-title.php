<?php
namespace ThePackKitThemeBuilder\Modules\DynamicTags\Tags;

use Elementor\Controls_Manager;
use ThePackKitThemeBuilder\Modules\DynamicTags\Tags\Base\Tag;
use ThePackKitThemeBuilder\Modules\DynamicTags\Module;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Page_Title extends Tag {
	public function get_name() {
		return 'page-title';
	}

	public function get_title() {
		return esc_html__( 'Page Title', 'the-pack-addon'  );
	}

	public function get_group() {
		return Module::SITE_GROUP;
	}

	public function get_categories() {
		return [ Module::TEXT_CATEGORY ];
	}

	public function render() {
		if ( is_home() && 'yes' !== $this->get_settings( 'show_home_title' ) ) {
			return; 
		}

		if ( thepack_kit()->elementor()->common ) {
			$current_action_data = thepack_kit()->elementor()->common->get_component( 'ajax' )->get_current_action_data();

			if ( $current_action_data && 'render_tags' === $current_action_data['action'] ) {
				//phpcs:disable WordPress.WP.DiscouragedFunctions.query_posts_query_posts
				query_posts(
					[ 
						'p' => get_the_ID(),
						'post_type' => 'any',
					]
				);
			}
		}

		$include_context = 'yes' === $this->get_settings( 'include_context' );

		$title = thepack_addon_kit_helper()->get_page_title( $include_context );

		echo wp_kses_post( $title );
	}

	protected function register_controls() {
		$this->add_control(
			'include_context',
			[
				'label' => esc_html__( 'Include Context', 'the-pack-addon'  ),
				'type' => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'show_home_title',
			[
				'label' => esc_html__( 'Show Home Title', 'the-pack-addon'  ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
	}
}
