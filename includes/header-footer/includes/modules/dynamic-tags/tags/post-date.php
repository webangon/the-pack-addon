<?php
namespace ThePackKitThemeBuilder\Modules\DynamicTags\Tags;

use Elementor\Controls_Manager;
use ThePackKitThemeBuilder\Modules\DynamicTags\Tags\Base\Tag;
use ThePackKitThemeBuilder\Modules\DynamicTags\Module;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Post_Date extends Tag {
	public function get_name() {
		return 'post-date';
	}

	public function get_title() {
		return esc_html__( 'Post Date', 'the-pack-addon'  );
	}

	public function get_group() {
		return Module::POST_GROUP;
	}

	public function get_categories() {
		return [ Module::TEXT_CATEGORY ];
	}

	protected function register_controls() {
		$this->add_control(
			'type',
			[
				'label' => esc_html__( 'Type', 'the-pack-addon'  ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'post_date_gmt' => esc_html__( 'Post Published', 'the-pack-addon'  ),
					'post_modified_gmt' => esc_html__( 'Post Modified', 'the-pack-addon'  ),
				],
				'default' => 'post_date_gmt',
			]
		);

		$this->add_control(
			'format',
			[
				'label' => esc_html__( 'Format', 'the-pack-addon'  ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__( 'Default', 'the-pack-addon'  ),
					'F j, Y' => gmdate( 'F j, Y' ),
					'Y-m-d' => gmdate( 'Y-m-d' ),
					'm/d/Y' => gmdate( 'm/d/Y' ),
					'd/m/Y' => gmdate( 'd/m/Y' ),
					'human' => esc_html__( 'Human Readable', 'the-pack-addon'  ),
					'custom' => esc_html__( 'Custom', 'the-pack-addon'  ),
				],
				'default' => 'default',
			]
		);

		$this->add_control(
			'custom_format',
			[
				'label' => esc_html__( 'Custom Format', 'the-pack-addon'  ),
				'default' => '',
				'description' => sprintf( '<a href="https://go.elementor.com/wordpress-date-time/" target="_blank">%s</a>', esc_html__( 'Documentation on date and time formatting', 'the-pack-addon'  ) ),
				'condition' => [
					'format' => 'custom',
				],
			]
		);
	}

	public function render() {
		$date_type = $this->get_settings( 'type' );
		$format = $this->get_settings( 'format' );

		if ( 'human' === $format ) {
			/* translators: %s: Human readable date/time. */
			$value = sprintf( esc_html__( '%s ago', 'the-pack-addon'  ), human_time_diff( strtotime( get_post()->{$date_type} ) ) );
		} else {
			switch ( $format ) {
				case 'default':
					$date_format = '';
					break;
				case 'custom':
					$date_format = $this->get_settings( 'custom_format' );
					break;
				default:
					$date_format = $format;
					break;
			}

			if ( 'post_date_gmt' === $date_type ) {
				$value = get_the_date( $date_format );
			} else {
				$value = get_the_modified_date( $date_format );
			}
		}
		echo wp_kses_post( $value );
	}
}
