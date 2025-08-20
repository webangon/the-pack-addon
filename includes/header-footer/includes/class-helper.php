<?php
/**
 * helper class
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'LaStudio_Kit_Helper' ) ) {

	/**
	 * Define LaStudio_Kit_Helper class
	 */
	class LaStudio_Kit_Helper {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since 1.0.0
		 * @var   LaStudio_Kit_Helper
		 */
		private static $instance = null;


		/**
		 * Get post types options list
		 *
		 * @return array
		 */
		public static function get_post_types( $args = [] ) {

            $post_type_args = [
                'show_in_nav_menus' => true,
                'public' => true,
            ];

            if ( ! empty( $args['post_type'] ) ) {
                $post_type_args['name'] = $args['post_type'];
            }

            $post_type_args = apply_filters('thepack-kit/post-types-list/args', $post_type_args, $args);

			$post_types = get_post_types( $post_type_args, 'objects' );

			$deprecated = apply_filters(
				'thepack-kit/post-types-list/deprecated',
				array( 'attachment', 'elementor_library' )
			);

			$result = array();

			if ( empty( $post_types ) ) {
				return $result;
			}

			foreach ( $post_types as $slug => $post_type ) {

				if ( in_array( $slug, $deprecated ) ) {
					continue;
				}

				$result[ $slug ] = $post_type->label;

			}

			return $result;

		}

        /**
         * Returns all custom taxonomies
         *
         * @return [type] [description]
         */
        public static function get_taxonomies( $args = [], $output = 'names', $operator = 'and' ) {

            global $wp_taxonomies;

            $field = ( 'names' === $output ) ? 'name' : false;

            // Handle 'object_type' separately.
            if ( isset( $args['object_type'] ) ) {
                $object_type = (array) $args['object_type'];
                unset( $args['object_type'] );
            }

            $taxonomies = wp_filter_object_list( $wp_taxonomies, $args, $operator );

            if ( isset( $object_type ) ) {
                foreach ( $taxonomies as $tax => $tax_data ) {
                    if ( ! array_intersect( $object_type, $tax_data->object_type ) ) {
                        unset( $taxonomies[ $tax ] );
                    }
                }
            }

            if ( $field ) {
                $taxonomies = wp_list_pluck( $taxonomies, $field );
            }

            return $taxonomies;

        }

        /**
         * [search_posts_by_type description]
         * @param  [type] $type  [description]
         * @param  [type] $query [description]
         * @param  array  $ids   [description]
         * @return [type]        [description]
         */
        public static function search_posts_by_type( $type, $query, $ids = array() ) {

            add_filter( 'posts_where', array( __CLASS__, 'force_search_by_title' ), 10, 2 );

            $posts = get_posts( array(
                'post_type'           => $type,
                'ignore_sticky_posts' => true,
                'posts_per_page'      => -1,
                'suppress_filters'    => false,
                's_title'             => $query,
                'include'             => $ids,
            ) );

            remove_filter( 'posts_where', array( __CLASS__, 'force_search_by_title' ), 10 );

            $result = array();

            if ( ! empty( $posts ) ) {
                foreach ( $posts as $post ) {
                    $result[] = array(
                        'id'   => $post->ID,
                        'text' => $post->post_title,
                    );
                }
            }

            return $result;
        }

        /**
         * Force query to look in post title while searching
         * @return [type] [description]
         */
        public static function force_search_by_title( $where, $query ) {

            $args = $query->query;

            if ( ! isset( $args['s_title'] ) ) {
                return $where;
            } else {
                global $wpdb;

                $searh = esc_sql( $wpdb->esc_like( $args['s_title'] ) );
                $where .= " AND {$wpdb->posts}.post_title LIKE '%$searh%'";

            }

            return $where;
        }

        /**
         * [search_terms_by_tax description]
         * @param  [type] $tax   [description]
         * @param  [type] $query [description]
         * @param  array  $ids   [description]
         * @return [type]        [description]
         */
        public static function search_terms_by_tax( $tax, $query, $ids = array() ) {

            $terms = get_terms( array(
                'taxonomy'   => $tax,
                'hide_empty' => false,
                'name__like' => $query,
                'include'    => $ids,
            ) );

            $result = array();


            if ( ! empty( $terms ) && !is_wp_error($terms) ) {
                foreach ( $terms as $term ) {
                    $result[] = array(
                        'id'   => $term->term_id,
                        'text' => $term->name,
                    );
                }
            }

            return $result;

        }

		public function validate_html_tag( $tag ) {
			$allowed_tags = array(
				'article',
				'aside',
				'div',
				'footer',
				'h1',
				'h2',
				'h3',
				'h4',
				'h5',
				'h6',
				'header',
				'main',
				'nav',
				'p',
				'section',
				'span',
			); 

			return in_array( strtolower( $tag ), $allowed_tags ) ? $tag : 'div';
		}


		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @return LaStudio_Kit_Helper
		 */
		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self();
			}
			return self::$instance;
		}


        public static function set_global_authordata() {
            global $authordata;
            if ( ! isset( $authordata->ID ) ) {
                $post = get_post();
                $authordata = get_userdata( $post->post_author ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
            }
        }


        public function get_post_terms($post_id = null, $type = 'slug'){
            $post = get_post( $post_id );
            $classes = [];
            // All public taxonomies.
            $taxonomies = get_taxonomies( array( 'public' => true ) );
            foreach ( (array) $taxonomies as $taxonomy ) {
                if ( is_object_in_taxonomy( $post->post_type, $taxonomy ) ) {
                    foreach ( (array) get_the_terms( $post->ID, $taxonomy ) as $term ) {
                        if ( empty( $term->slug ) ) {
                            continue;
                        }
                        if($type == 'id'){
                            $classes[] = 'term-' . $term->term_id;
                        }
                        else{
                            $term_class = sanitize_html_class( $term->slug, $term->term_id );
                            if ( is_numeric( $term_class ) || ! trim( $term_class, '-' ) ) {
                                $term_class = $term->term_id;
                            }

                            // 'post_tag' uses the 'tag' prefix for backward compatibility.
                            if ( 'post_tag' === $taxonomy ) {
                                $classes[] = 'tag-' . $term_class;
                            } else {
                                $classes[] = sanitize_html_class( $taxonomy . '-' . $term_class, $taxonomy . '-' . $term->term_id );
                            }
                        }
                    }
                }
            }
            return $classes;
        }

        public static function get_the_archive_url() {
            $url = '';
            if ( is_category() || is_tag() || is_tax() ) {
                $url = get_term_link( get_queried_object() );
            } elseif ( is_author() ) {
                $url = get_author_posts_url( get_queried_object_id() );
            } elseif ( is_year() ) {
                $url = get_year_link( get_query_var( 'year' ) );
            } elseif ( is_month() ) {
                $url = get_month_link( get_query_var( 'year' ), get_query_var( 'monthnum' ) );
            } elseif ( is_day() ) {
                $url = get_day_link( get_query_var( 'year' ), get_query_var( 'monthnum' ), get_query_var( 'day' ) );
            } elseif ( is_post_type_archive() ) {
                $url = get_post_type_archive_link( get_post_type() );
            }

            return $url;
        }

        public static function get_page_title( $include_context = true ) {
            $title = '';

            if ( is_singular() ) {
                /* translators: %s: Search term. */
                $title = get_the_title();

                if ( $include_context ) {
                    $post_type_obj = get_post_type_object( get_post_type() );
                    $title = sprintf( '%s: %s', $post_type_obj->labels->singular_name, $title );
                }
            } elseif ( is_search() ) {
                /* translators: %s: Search term. */
                $title = sprintf( esc_html__( 'Search Results for: %s', 'the-pack-addon'  ), get_search_query() );

                if ( get_query_var( 'paged' ) ) {
                    /* translators: %s is the page number. */
                    $title .= sprintf( esc_html__( '&nbsp;&ndash; Page %s', 'the-pack-addon'  ), get_query_var( 'paged' ) );
                }
            } elseif ( is_category() ) {
                $title = single_cat_title( '', false );

                if ( $include_context ) {
                    /* translators: Category archive title. 1: Category name */
                    $title = sprintf( esc_html__( 'Category: %s', 'the-pack-addon'  ), $title );
                }
            } elseif ( is_tag() ) {
                $title = single_tag_title( '', false );
                if ( $include_context ) {
                    /* translators: Tag archive title. 1: Tag name */
                    $title = sprintf( esc_html__( 'Tag: %s', 'the-pack-addon'  ), $title );
                }
            } elseif ( is_author() ) {
                $title = '<span class="vcard">' . get_the_author() . '</span>';

                if ( $include_context ) {
                    /* translators: Author archive title. 1: Author name */
                    $title = sprintf( esc_html__( 'Author: %s', 'the-pack-addon'  ), $title );
                }
            } elseif ( is_year() ) {
                $title = get_the_date( _x( 'Y', 'yearly archives date format', 'the-pack-addon'  ) );

                if ( $include_context ) {
                    /* translators: Yearly archive title. 1: Year */
                    $title = sprintf( esc_html__( 'Year: %s', 'the-pack-addon'  ), $title );
                }
            } elseif ( is_month() ) {
                $title = get_the_date( _x( 'F Y', 'monthly archives date format', 'the-pack-addon'  ) );

                if ( $include_context ) {
                    /* translators: Monthly archive title. 1: Month name and year */
                    $title = sprintf( esc_html__( 'Month: %s', 'the-pack-addon'  ), $title );
                }
            } elseif ( is_day() ) {
                $title = get_the_date( _x( 'F j, Y', 'daily archives date format', 'the-pack-addon'  ) );

                if ( $include_context ) {
                    /* translators: Daily archive title. 1: Date */
                    $title = sprintf( esc_html__( 'Day: %s', 'the-pack-addon'  ), $title );
                }
            } elseif ( is_tax( 'post_format' ) ) {
                if ( is_tax( 'post_format', 'post-format-aside' ) ) {
                    $title = _x( 'Asides', 'post format archive title', 'the-pack-addon'  );
                } elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
                    $title = _x( 'Galleries', 'post format archive title', 'the-pack-addon'  );
                } elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
                    $title = _x( 'Images', 'post format archive title', 'the-pack-addon'  );
                } elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
                    $title = _x( 'Videos', 'post format archive title', 'the-pack-addon'  );
                } elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
                    $title = _x( 'Quotes', 'post format archive title', 'the-pack-addon'  );
                } elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
                    $title = _x( 'Links', 'post format archive title', 'the-pack-addon'  );
                } elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
                    $title = _x( 'Statuses', 'post format archive title', 'the-pack-addon'  );
                } elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
                    $title = _x( 'Audio', 'post format archive title', 'the-pack-addon'  );
                } elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
                    $title = _x( 'Chats', 'post format archive title', 'the-pack-addon'  );
                }
            } elseif ( is_post_type_archive() ) {
                $title = post_type_archive_title( '', false );

                if ( $include_context ) {
                    /* translators: Post type archive title. 1: Post type name */
                    $title = sprintf( esc_html__( 'Archives: %s', 'the-pack-addon'  ), $title );
                }
            } elseif ( is_tax() ) {
                $title = single_term_title( '', false );

                if ( $include_context ) {
                    $tax = get_taxonomy( get_queried_object()->taxonomy );
                    /* translators: Taxonomy term archive title. 1: Taxonomy singular name, 2: Current taxonomy term */
                    $title = sprintf( esc_html__( '%1$s: %2$s', 'the-pack-addon'  ), $tax->labels->singular_name, $title );
                }
            } elseif ( is_archive() ) {
                $title = esc_html__( 'Archives', 'the-pack-addon'  );
            } elseif ( is_404() ) {
                $title = esc_html__( 'Page Not Found', 'the-pack-addon'  );
            } // End if().

            /**
             * The archive title.
             *
             * Filters the archive title.
             *
             * @since 1.0.0
             *
             * @param string $title Archive title to be displayed.
             */
            $title = apply_filters( 'elementor/utils/get_the_archive_title', $title );

            return $title;
        }

        /**
         * Remove words from a sentence.
         *
         * @param string  $text
         * @param integer $length
         *
         * @return string
         */
        public static function trim_words( $text, $length ) {
            if ( $length && str_word_count( $text ) > $length ) {
                $text = explode( ' ', $text, $length + 1 );
                unset( $text[ $length ] );
                $text = implode( ' ', $text );
            }

            return $text;
        }
	}

}

/**
 * Returns instance of LaStudio_Kit_Helper
 *
 * @return LaStudio_Kit_Helper
 */
function thepack_addon_kit_helper() {
	return LaStudio_Kit_Helper::get_instance();
}
