<?php

namespace ThePackKitThemeBuilder\Modules\Popup\DisplaySettings;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Timing extends Base {

	/**
	 * Get element name.
	 *
	 * Retrieve the element name.
	 *
	 * @since  2.4.0
	 * @access public
	 *
	 * @return string The name.
	 */
	public function get_name() {
		return 'popup_timing';
	}

	protected function register_controls() {
		$this->start_controls_section( 'timing' );

		$this->start_settings_group( 'page_views', esc_html__( 'Show after X page views', 'the-pack-addon'  ) );

		$this->add_settings_group_control(
			'views',
			[
				'type' => Controls_Manager::NUMBER,
				'label' => esc_html__( 'Page Views', 'the-pack-addon'  ),
				'default' => 3,
				'min' => 1,
			]
		);

		$this->end_settings_group();

		$this->start_settings_group( 'sessions', esc_html__( 'Show after X sessions', 'the-pack-addon'  ) );

		$this->add_settings_group_control(
			'sessions',
			[
				'type' => Controls_Manager::NUMBER,
				'label' => esc_html__( 'Sessions', 'the-pack-addon'  ),
				'default' => 2,
				'min' => 1,
			]
		);

		$this->end_settings_group();

		$this->start_settings_group( 'times', esc_html__( 'Show up to X times', 'the-pack-addon'  ) );

		$this->add_settings_group_control(
			'times',
			[
				'type' => Controls_Manager::NUMBER,
				'label' => esc_html__( 'Times', 'the-pack-addon'  ),
				'default' => 3,
				'min' => 1,
			]
		);

		$this->add_settings_group_control(
			'count',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__( 'Count', 'the-pack-addon'  ),
				'options' => [
					'' => esc_html__( 'On Open', 'the-pack-addon'  ),
					'close' => esc_html__( 'On Close', 'the-pack-addon'  ),
				],
			]
		);

		$this->end_settings_group();

		$this->start_settings_group( 'url', esc_html__( 'When arriving from specific URL', 'the-pack-addon'  ) );

		$this->add_settings_group_control(
			'action',
			[
				'type' => Controls_Manager::SELECT,
				'default' => 'show',
				'options' => [
					'show' => esc_html__( 'Show', 'the-pack-addon'  ),
					'hide' => esc_html__( 'Hide', 'the-pack-addon'  ),
					'regex' => esc_html__( 'Regex', 'the-pack-addon'  ),
				],
			]
		);

		$this->add_settings_group_control(
			'url',
			[
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'URL', 'the-pack-addon'  ),
			]
		);

		$this->end_settings_group();

		$this->start_settings_group( 'sources', esc_html__( 'Show when arriving from', 'the-pack-addon'  ) );

		$this->add_settings_group_control(
			'sources',
			[
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'default' => [ 'search', 'external', 'internal' ],
				'options' => [
					'search' => esc_html__( 'Search Engines', 'the-pack-addon'  ),
					'external' => esc_html__( 'External Links', 'the-pack-addon'  ),
					'internal' => esc_html__( 'Internal Links', 'the-pack-addon'  ),
				],
			]
		);

		$this->end_settings_group();

		$this->start_settings_group( 'logged_in', esc_html__( 'Hide for logged in users', 'the-pack-addon'  ) );

		$this->add_settings_group_control(
			'users',
			[
				'type' => Controls_Manager::SELECT,
				'default' => 'all',
				'options' => [
					'all' => esc_html__( 'All Users', 'the-pack-addon'  ),
					'custom' => esc_html__( 'Custom', 'the-pack-addon'  ),
				],
			]
		);

		global $wp_roles;

		$roles = array_map( function( $role ) {
			return $role['name'];
		}, $wp_roles->roles );

		$this->add_settings_group_control(
			'roles',
			[
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'default' => [],
				'options' => $roles,
				'select2options' => [
					'placeholder' => esc_html__( 'Select Roles', 'the-pack-addon'  ),
				],
				'condition' => [
					'users' => 'custom',
				],
			]
		);

		$this->end_settings_group();

		$this->start_settings_group( 'devices', esc_html__( 'Show on devices', 'the-pack-addon'  ) );

		$this->add_settings_group_control(
			'devices',
			[
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'default' => [ 'desktop', 'tablet', 'mobile' ],
				'options' => [
					'desktop' => esc_html__( 'Desktop', 'the-pack-addon'  ),
					'tablet' => esc_html__( 'Tablet', 'the-pack-addon'  ),
					'mobile' => esc_html__( 'Mobile', 'the-pack-addon'  ),
				],
			]
		);

		$this->end_settings_group();

		$this->start_settings_group( 'browsers', esc_html__( 'Show on browsers', 'the-pack-addon'  ) );

		$this->add_settings_group_control(
			'browsers',
			[
				'type' => Controls_Manager::SELECT,
				'default' => 'all',
				'options' => [
					'all' => esc_html__( 'All Browsers', 'the-pack-addon'  ),
					'custom' => esc_html__( 'Custom', 'the-pack-addon'  ),
				],
			]
		);

		$this->add_settings_group_control(
			'browsers_options',
			[
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'default' => [],
				'options' => [
					'ie' => esc_html__( 'Internet Explorer', 'the-pack-addon'  ),
					'chrome' => esc_html__( 'Chrome', 'the-pack-addon'  ),
					'edge' => esc_html__( 'Edge', 'the-pack-addon'  ),
					'firefox' => esc_html__( 'Firefox', 'the-pack-addon'  ),
					'safari' => esc_html__( 'Safari', 'the-pack-addon'  ),
				],
				'condition' => [
					'browsers' => 'custom',
				],
			]
		);

		$this->end_settings_group();

		$this->end_controls_section();
	}
}
