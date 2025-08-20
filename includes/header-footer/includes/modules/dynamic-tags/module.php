<?php
namespace ThePackKitThemeBuilder\Modules\DynamicTags;

use Elementor\Modules\DynamicTags\Module as TagsModule;
use ThePackKitThemeBuilder\Modules\DynamicTags\ACF;
use ThePackKitThemeBuilder\Modules\DynamicTags\Toolset;
use ThePackKitThemeBuilder\Modules\DynamicTags\Pods;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends TagsModule {

	const AUTHOR_GROUP = 'author';

	const POST_GROUP = 'post';

	const COMMENTS_GROUP = 'comments';

	const SITE_GROUP = 'site';

	const ARCHIVE_GROUP = 'archive';

	const MEDIA_GROUP = 'media';

	const ACTION_GROUP = 'action';

	public function __construct() {
		parent::__construct();
	}

	public function get_name() {
		return 'tags';
	}

	public function get_tag_classes_names() {
		return [

		];
	}

	public function get_groups() {
		return [
			self::POST_GROUP => [
				'title' => esc_html__( 'Post', 'the-pack-addon'  ),
			],
			self::ARCHIVE_GROUP => [
				'title' => esc_html__( 'Archive', 'the-pack-addon'  ),
			],
			self::SITE_GROUP => [
				'title' => esc_html__( 'Site', 'the-pack-addon'  ),
			],
			self::MEDIA_GROUP => [
				'title' => esc_html__( 'Media', 'the-pack-addon'  ),
			],
			self::ACTION_GROUP => [
				'title' => esc_html__( 'Actions', 'the-pack-addon'  ),
			],
			self::AUTHOR_GROUP => [
				'title' => esc_html__( 'Author', 'the-pack-addon'  ),
			],
			self::COMMENTS_GROUP => [
				'title' => esc_html__( 'Comments', 'the-pack-addon'  ),
			],
		];
	}
}
