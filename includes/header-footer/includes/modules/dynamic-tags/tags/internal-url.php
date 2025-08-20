<?php
namespace ThePackKitThemeBuilder\Modules\DynamicTags\Tags;

use Elementor\Controls_Manager;
use ThePackKitThemeBuilder\Modules\DynamicTags\Tags\Base\Data_Tag;
use ThePackKitThemeBuilder\Modules\DynamicTags\Module;
use ThePackKitExtensions\Elementor\Controls\Control_Query as QueryModule;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Internal_URL extends Data_Tag {

	public function get_name() {
		return 'internal-url';
	}

	public function get_group() {
		return Module::SITE_GROUP;
	}

	public function get_categories() {
		return [ Module::URL_CATEGORY ];
	}

	public function get_title() {
		return esc_html__( 'Internal URL', 'the-pack-addon'  );
	}

	public function get_panel_template() {
		return ' ({{ url }})';
	}

	public function get_value( array $options = [] ) {
		$settings = $this->get_settings();

		$type = $settings['type'];
		$url = '';

		if ( 'post' === $type && ! empty( $settings['post_id'] ) ) {
			$url = get_permalink( (int) $settings['post_id'] );
		} elseif ( 'taxonomy' === $type && ! empty( $settings['taxonomy_id'] ) ) {
			$url = get_term_link( (int) $settings['taxonomy_id'] );
		} elseif ( 'attachment' === $type && ! empty( $settings['attachment_id'] ) ) {
			$url = get_attachment_link( (int) $settings['attachment_id'] );
		} elseif ( 'author' === $type && ! empty( $settings['author_id'] ) ) {
			$url = get_author_posts_url( (int) $settings['author_id'] );
		}

		if ( ! is_wp_error( $url ) ) {
			return $url;
		}

		return '';
	}

	protected function register_controls() {
		$this->add_control( 'type', [
			'label' => esc_html__( 'Type', 'the-pack-addon'  ),
			'type' => Controls_Manager::SELECT,
			'options' => [
				'post' => esc_html__( 'Content', 'the-pack-addon'  ),
				'taxonomy' => esc_html__( 'Taxonomy', 'the-pack-addon'  ),
				'attachment' => esc_html__( 'Media', 'the-pack-addon'  ),
				'author' => esc_html__( 'Author', 'the-pack-addon'  ),
			],
		] );

		$this->add_control( 'post_id', [
			'label' => esc_html__( 'Search & Select', 'the-pack-addon'  ),
			'type' => QueryModule::QUERY_CONTROL_ID,
			'options' => [],
			'label_block' => true,
			'autocomplete' => [
				'object' => QueryModule::QUERY_OBJECT_POST,
				'display' => 'detailed',
				'query' => [
					'post_type' => 'any',
				],
			],
			'condition' => [
				'type' => 'post',
			],
		] );

		$this->add_control( 'taxonomy_id', [
			'label' => esc_html__( 'Search & Select', 'the-pack-addon'  ),
			'type' => QueryModule::QUERY_CONTROL_ID,
			'options' => [],
			'label_block' => true,
			'autocomplete' => [
				'object' => QueryModule::QUERY_OBJECT_TAX,
				'display' => 'detailed',
			],
			'condition' => [
				'type' => 'taxonomy',
			],
		] );

		$this->add_control( 'attachment_id', [
			'label' => esc_html__( 'Search & Select', 'the-pack-addon'  ),
			'type' => QueryModule::QUERY_CONTROL_ID,
			'options' => [],
			'label_block' => true,
			'autocomplete' => [
				'object' => QueryModule::QUERY_OBJECT_ATTACHMENT,
				'display' => 'detailed',
			],
			'condition' => [
				'type' => 'attachment',
			],
		] );

		$this->add_control( 'author_id', [
			'label' => esc_html__( 'Search & Select', 'the-pack-addon'  ),
			'type' => QueryModule::QUERY_CONTROL_ID,
			'options' => [],
			'label_block' => true,
			'autocomplete' => [
				'object' => QueryModule::QUERY_OBJECT_AUTHOR,
				'display' => 'detailed',
			],
			'condition' => [
				'type' => 'author',
			],
		] );
	}
}
