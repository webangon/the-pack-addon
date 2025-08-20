<?php
use Elementor\Icons_Manager;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
} 

function the_pack_html_escaped($html) {
    return wp_kses_post($html);
}
function currentYear( $atts ){
    return date('Y');
}
add_shortcode( 'currentyear', 'currentYear' );

function tp_only_alpha_num($string){
    if (!preg_match("/[^[:alnum:]_\/-]/",$string)) {
        return $string;
    }
}

function tp_allow_html_tag($string){
    $allowed = ['h1','h2','h3','h4','h5','h6','p','span'];
    if (in_array($string, $allowed)){
        return $string;
    }
}

function the_render_attribute($data,$value,$element){

    $value =  isset($value) && $value ? $value : '';
    if ($value){
      return  $element->add_render_attribute('_wrapper', $data, $value);
    }

}

function the_pack_render_icon($icon, $class = '')
{
    if ($icon['library'] == 'svg') {
        $out = wp_get_attachment_image($icon['value']['id'], 'full', '', ['class' => $class]);
    } else {
        ob_start();
        Icons_Manager::render_icon($icon, ['class' => $class, 'aria-hidden' => 'true']);
        $out = ob_get_clean();
    }
    return $out;
}

function render_nav_menu($menu)
{
    $args = [
        'echo' => false,
        'menu' => $menu,
        //TODO:fix this later on
        //'walker' => new \The_Pack_Nav_Walker(),
        'items_wrap' => '<ul class="tp-menu-wrap">%3$s</ul>'
    ];

    if ($menu) {
        return wp_nav_menu($args);
    }
}

function menu_item_class($menu)
{
    $icon = $menu['icon'];
    $menu_location = $menu['menu_register'];
    $sub_type = $menu['sub_type'];
    $menu_item_class = [
        'menu-item',
        'menu-item-type-custom',
    ];

    if ('yes' === $menu['has_sub']) {
        if ('no' !== $menu['sub_menu'] && 'mega' === $sub_type) {
            $item_class = ' menu-item-has-children current-menu-parent menu-item-has-mega';
            array_push($menu_item_class, 'menu-item-has-children', 'tp_mega_menu');
        }
        if ($menu_location && 'default' === $sub_type) {
            array_push($menu_item_class, 'menu-item-has-children', 'nocls');
        }
        if (!empty($icon['value'])) {
            array_push($menu_item_class, 'menu-item-has-icon');
        }
    }

    $classes = implode(' ', $menu_item_class);

    return $classes;
}

function sub_menu_default($menu_id)
{
    $args = [
        'menu' => $menu_id,
        'menu_id' => '',
        'menu_class' => 'sub-menu',
        'container' => '',
    ];

    wp_nav_menu($args);
}

function rendor_custom_nav_menu($setting_menu)
{
    ?>
    <ul class="tp-menu-wrap">

		<?php foreach ($setting_menu as $menu) {
        $icon = $menu['icon'];
        $sub_id = (int) $menu['sub_menu'];
        $sub_type = $menu['sub_type'];
        $menu_location = $menu['menu_register'];
        $arrow = $menu['has_sub'] ? '<svg class="drop-icon" width="10" height="10" viewBox="0 0 10 10" fill="#575757" xmlns="http://www.w3.org/2000/svg"><path d="M9.78571 2.21429C9.5 1.92857 9.07143 1.92857 8.78571 2.21429L5 6L1.21429 2.21429C0.928571 1.92857 0.5 1.92857 0.214286 2.21429C-0.0714286 2.5 -0.0714286 2.92857 0.214286 3.21429L4.5 7.5C4.64286 7.64286 4.85714 7.71429 5 7.71429C5.14286 7.71429 5.35714 7.64286 5.5 7.5L9.78571 3.21429C10.0714 2.92857 10.0714 2.5 9.78571 2.21429Z"></path></svg>' : '';
        $item_class = '';
        $classes = menu_item_class($menu); ?>
            <li class="<?php echo esc_attr($classes); ?>">

                <a href="<?php echo esc_url($menu['link']['url']); ?>">
                <span class="menu-item-main-info">
                    <?php
                    if (!empty($icon['value'])) :
                        if (is_string($icon['value'])) :
                            ?>
                            <span class="menu-item-icon <?php echo esc_attr($icon['value']); ?>"></span>
	                    <?php else : ?>

	                    <?php
                        endif;
        endif; ?>

                    <span class="menu-item-text">
                        <?php echo esc_html($menu['item_text']); ?>
                    </span>
                    <?php echo $arrow;?>
                </span>
                </a>
				<?php
                if ($menu['has_sub'] && 'mega' === $sub_type && 'no' !== $menu['sub_menu']) :
                    echo '<div class="xlmegamenu-content-wrapper">' . do_shortcode('[THEPACK_INSERT_TPL id="' . $sub_id . '"]') . '</div>'; elseif ($menu['has_sub'] && $menu_location) :
                    sub_menu_default($menu_location);

        endif; ?>
            </li>
			<?php
    } ?>
    </ul>
	<?php
}

function thepack_get_that_link($link)
{
    $url = isset($link['url']) ? 'href="' . esc_url($link['url']) . '"' : '';
    $ext = isset($link['is_external']) && $link['is_external'] ? ' target= "_blank" ' : '';
    $nofollow = isset($link['nofollow']) && $link['nofollow'] ? ' rel= "nofollow" ' : '';
    $link = $url . $ext . $nofollow;
    return $link;
}

function thepack_builder_btn($link, $text)
{
    $url = $link['url'];
    $ext = $link['is_external'];
    $nofollow = $link['nofollow'];
    $url = (isset($url) && $url) ? ' href=' . esc_url($url) . '' : '';
    $ext = (isset($ext) && $ext) ? ' target= "_blank"' : '';
    $nofollow = (isset($url) && $url) ? ' rel= "nofollow"' : '';
    $link = $url . ' ' . $ext . ' ' . $nofollow;

    $btn = $text ? '<a ' . $link . ' class="tour-btn">' . $text . '</a>' : '';

    return $btn; 
}

function thepack_build_html($option, $tag = '', $cls = '')
{
    if ($option) {
        $class = $cls ? 'class="' . $cls . '"' : '';
        if ($tag) {
            return '<' . $tag . ' ' . $class . '>' . wp_kses_post($option) . '</' . $tag . '>';
        } else {
            return wp_kses_post($option);
        }
    }
}

function thepack_icon_svg($option, $class = '')
{ 
    if ($option['library'] == 'svg') {
        return wp_get_attachment_image(esc_attr($option['value']['id']), 'full');
    } else {
        return '<i class="' . $class . ' ' . esc_attr($option['value']) . '"></i>';
    }
}

function thepack_get_builder_logo($id, $class, $link)
{
    if ($id) {
        $link = $link ? $link : home_url('/');

        return '<a class="tpsite-logo ' . $class . '" href="' . esc_url($link) . '">' . wp_get_attachment_image($id, 'full') . '</a>';
    }
}

function thepack_buildermeta_to_string($items)
{
    if (!is_array($items) || empty($items)) {
        return;
    }
    foreach ($items as $item) {
        $metaf[] = $item['meta'];
    }

    return implode(',', $metaf);
}

function thepack_drop_menu_select()
{
    $menus = wp_get_nav_menus();
    $items = [];
    $i = 0;
    foreach ($menus as $menu) {
        if ($i == 0) {
            $default = $menu->slug;
            $i++;
        }
        $items[$menu->slug] = $menu->name;
    }

    $addsizes = [
        '' => esc_html__('No menu', 'the-pack-addon'),
    ];
    $newsizes = array_merge($items, $addsizes);

    //return array_combine($newsizes, $newsizes);
    return $items;
}

function thepack_image_size_choose()
{
    $image_sizes = get_intermediate_image_sizes();
    $addsizes = [
        'full' => esc_html__('full', 'the-pack-addon'),
    ];
    $newsizes = array_merge($image_sizes, $addsizes);

    return array_combine($newsizes, $newsizes);
}

/*Meta Fields*/

function thepack_background_position()
{
    return [
        'center' => esc_html__('Default', 'the-pack-addon'),
        'left top' => esc_html__('Left top', 'the-pack-addon'),
        'left center' => esc_html__('Left center', 'the-pack-addon'),
        'left bottom' => esc_html__('Left bottom', 'the-pack-addon'),
        'right top' => esc_html__('Right top', 'the-pack-addon'),
        'right center' => esc_html__('Right center', 'the-pack-addon'),
        'right bottom' => esc_html__('Left top', 'the-pack-addon'),
        'center bottom' => esc_html__('Center bottom', 'the-pack-addon'),
        'center top' => esc_html__('Center top', 'the-pack-addon'),
        'center center' => esc_html__('Center center', 'the-pack-addon'),
    ];
}

function thepack_animations()
{
    return [
        '' => esc_html__('No animation', 'the-pack-addon'),
        'fade' => esc_html__('Fade', 'the-pack-addon'),
        'fade-up' => esc_html__('Fade up', 'the-pack-addon'),
        'fade-down' => esc_html__('Fade down', 'the-pack-addon'),
        'fade-left' => esc_html__('Fade left', 'the-pack-addon'),
        'fade-right' => esc_html__('Fade right', 'the-pack-addon'),
        'fade-up-right' => esc_html__('Fade up right', 'the-pack-addon'),
        'fade-up-left' => esc_html__('Fade up left', 'the-pack-addon'),
        'fade-down-right' => esc_html__('Fade down right', 'the-pack-addon'),
        'fade-down-left' => esc_html__('Fade down left', 'the-pack-addon'),
        'flip-up' => esc_html__('Flip up', 'the-pack-addon'),
        'flip-down' => esc_html__('Flip down', 'the-pack-addon'),
        'flip-left' => esc_html__('Flip left', 'the-pack-addon'),
        'flip-right' => esc_html__('Flip right', 'the-pack-addon'), 
        'slide-up' => esc_html__('Slide up', 'the-pack-addon'),
        'slide-down' => esc_html__('Slide down', 'the-pack-addon'),
        'slide-left' => esc_html__('Slide left', 'the-pack-addon'),
        'slide-right' => esc_html__('Slide right', 'the-pack-addon'),
        'zoom-in' => esc_html__('Zoom in', 'the-pack-addon'),
        'zoom-in-up' => esc_html__('Zoom in up', 'the-pack-addon'),
        'zoom-in-down' => esc_html__('Zoom in down', 'the-pack-addon'),
        'zoom-in-left' => esc_html__('Zoom in left', 'the-pack-addon'),
        'zoom-in-right' => esc_html__('Zoom in right', 'the-pack-addon'),
        'zoom-out' => esc_html__('Zoom out', 'the-pack-addon'),
        'zoom-out-up' => esc_html__('Zoom out up', 'the-pack-addon'),
        'zoom-out-down' => esc_html__('Zoom out down', 'the-pack-addon'),
        'zoom-out-left' => esc_html__('Zoom out left', 'the-pack-addon'),
        'zoom-out-right' => esc_html__('Zoom out right', 'the-pack-addon'),
    ];
}

function jl_elementor_animation()
{
    return [
        '' => esc_html__('No animation', 'the-pack-addon'),
        'bounce' => esc_html__('Bounce', 'the-pack-addon'),
        'flash' => esc_html__('Flash', 'the-pack-addon'),
        'pulse' => esc_html__('Pulse', 'the-pack-addon'),
        'rubberBand' => esc_html__('Rubber band', 'the-pack-addon'),
        'shake' => esc_html__('Shake', 'the-pack-addon'),
        'headShake' => esc_html__('Headshake', 'the-pack-addon'),
        'swing' => esc_html__('Swing', 'the-pack-addon'),
        'tada' => esc_html__('Tada', 'the-pack-addon'),
        'wobble' => esc_html__('Wobble', 'the-pack-addon'),
        'jello' => esc_html__('Jello', 'the-pack-addon'),
        'bounceIn' => esc_html__('Bounce In', 'the-pack-addon'),
        'fadeIn' => esc_html__('Fade In', 'the-pack-addon'),
        'rotateIn' => esc_html__('Rotate In', 'the-pack-addon'),
        'rollIn' => esc_html__('Roll In', 'the-pack-addon'),
        'zoomIn' => esc_html__('Zoom In', 'the-pack-addon'),
        'elementor-animation-buzz-out' => esc_html__('Buzz out', 'the-pack-addon'),
        'jlspin' => esc_html__('Spin', 'the-pack-addon'),
        'tp-float-y' => esc_html__('Float Y', 'the-pack-addon'),
        'tp-rotate' => esc_html__('Rotate', 'the-pack-addon'),
        'tp-float-y-and-rotate' => esc_html__('Float Y & rotate', 'the-pack-addon'),
        'tp-rotate-z' => esc_html__('Rotate Z', 'the-pack-addon'),

        'ThePack-animOne' => esc_html__('Floating 1', 'the-pack-addon'),
        'ThePack-animTwo' => esc_html__('Floating 2', 'the-pack-addon'),
        'ThePack-animThree' => esc_html__('Floating 3', 'the-pack-addon'),
        'ThePack-animFour' => esc_html__('Floating 4', 'the-pack-addon'),
        'ThePack-animFive' => esc_html__('Floating 5', 'the-pack-addon'),
        'heartbeat-right-to-left' => esc_html__('Heartbeat right to left', 'the-pack-addon'),
        'tpsliderShape' => esc_html__('Slideshape', 'the-pack-addon'),

    ];
}

function thepack_bg_images($id = '', $thumb = '')
{
    if ($id) {
        $id = $id;
    } else {
        global $post;
        $id = get_post_thumbnail_id($post->ID);
    }

    $featured_image = wp_get_attachment_image_src($id, $thumb);
    if (!$featured_image) {
        return;
    };
    $image_url = $featured_image[0];
    $lazy = 'data-bg=' . $image_url . '';

    $bg_image = 'background-image:url(' . $image_url . ');';
    $out = ($bg_image) ? 'style=' . $bg_image . '' : '';

    return $lazy;
}

function thepack_overlay_link($url)
{
    $url = [];
    $url = isset($url['url']) ? esc_url($url['url']) : '';
    $target = isset($url['is_external']) ? 'target="_blank"' : '';
    $link = $url ? '<a ' . $target . ' class="tp-overlaylink" href="' . $url . '"></a>' : '';

    return $link; 
}

function thepack_ft_images($id = '', $thumb = '',$class='')
{
    //return wp_get_attachment_image($id, $thumb);
    $img_src = wp_get_attachment_image_url( $id, $thumb ); 
    $alt_text = get_post_meta( $id, '_wp_attachment_image_alt', true );
    $image_attributes = wp_get_attachment_image_src( $id,$thumb );
    if($image_attributes){
        $width = $image_attributes[1];
        $height = $image_attributes[2];
    } else {
        $width = '';
        $height = '';
    }
    //phpcs:disable PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage
    return '<img height="'.$height.'" width="'.$width.'" class="lazyload '.$class.'" data-src="'.$img_src.'" alt="'.$alt_text.'" />';
}
 
function thepack_human_size_byte($bytes, $base = '1024')
{
    if ($bytes == '0') {
        return 0;
    } else {
        $i = floor(log($bytes) / log($base));
        if ($base == '1024') {
            $sizes = ['B', 'KB', 'MB', 'GB', 'TB'];
        } else {
            $sizes = ['', 'K', 'M', 'G', 'T'];
        }

        return sprintf('%.02F', $bytes / pow($base, $i)) * 1 . ' ' . $sizes[$i];
    }
}

function extract_plyr_video($url, $type)
{
    if ($type == 'yt') {
        preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $url, $matches);
        $out = '<div class="plyr__video-embed" data-plyr-provider="youtube" data-plyr-embed-id="' . esc_attr($matches[1]) . '"></div>';
    } elseif ($type == 'vm') {
        preg_match("/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/", $url, $output_array);
        $out = '<div class="plyr__video-embed" data-plyr-provider="vimeo" data-plyr-embed-id="' . esc_attr($output_array[5]) . '"></div>';
    } else {
        //self hosted
    }

    return $out;
}

function thepack_breadcum($args)
{
    // Set variables for later use

    $home_text = isset($args['home']) ? $args['home'] : '';
    $author_archive = isset($args['author_archive']) ? $args['author_archive'] : '';
    $search = isset($args['search']) ? $args['search'] : '';
    $error = isset($args['error']) ? $args['error'] : '';
    $delimiter_text = isset($args['delimiter']) ? $args['delimiter'] : '';

    $here_text = '';
    $home_link = home_url('/');
    $link_before = '<span typeof="v:Breadcrumb">';
    $link_after = '</span>';
    $link_attr = ' rel="v:url" property="v:title"';
    $link = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
    $delimiter = '<span class="delimiter">' . $delimiter_text . '</span>';              // Delimiter between crumbs
    $before = '<span class="current">'; // Tag before the current crumb
    $after = '</span>';                // Tag after the current crumb
    $page_addon = '';                       // Adds the page number if the query is paged
    $breadcrumb_trail = '';
    $category_links = '';

    /**
     * Set our own $wp_the_query variable. Do not use the global variable version due to
     * reliability
     */
    $wp_the_query = $GLOBALS['wp_the_query'];
    $queried_object = $wp_the_query->get_queried_object();

    // Handle single post requests which includes single pages, posts and attatchments
    if (is_singular()) {
        /**
         * Set our own $post variable. Do not use the global variable version due to
         * reliability. We will set $post_object variable to $GLOBALS['wp_the_query']
         */
        $post_object = sanitize_post($queried_object);

        // Set variables
        global $wp_query;
        $id = $wp_query->post->ID;
        $title = apply_filters('the_title', $post_object->post_title,$id);
        $parent = $post_object->post_parent;
        $post_type = $post_object->post_type;
        $post_id = $post_object->ID;
        $post_link = $before . $title . $after;
        $parent_string = '';
        $post_type_link = '';

        if ('post' === $post_type) {
            // Get the post categories
            $categories = get_the_category($post_id);
            if ($categories) {
                // Lets grab the first category
                $category = $categories[0];

                $category_links = get_category_parents($category, true, $delimiter);
                $category_links = str_replace('<a', $link_before . '<a' . $link_attr, $category_links);
                $category_links = str_replace('</a>', '</a>' . $link_after, $category_links);
            }
        }

        if (!in_array($post_type, ['post', 'page', 'attachment'])) {
            $post_type_object = get_post_type_object($post_type);
            $archive_link = esc_url(get_post_type_archive_link($post_type));

            $post_type_link = sprintf($link, $archive_link, $post_type_object->labels->singular_name);
        }

        // Get post parents if $parent !== 0
        if (0 !== $parent) {
            $parent_links = [];
            while ($parent) {
                $post_parent = get_post($parent);

                $parent_links[] = sprintf($link, esc_url(get_permalink($post_parent->ID)), get_the_title($post_parent->ID));

                $parent = $post_parent->post_parent;
            }

            $parent_links = array_reverse($parent_links);

            $parent_string = implode($delimiter, $parent_links);
        }

        // Lets build the breadcrumb trail
        if ($parent_string) {
            $breadcrumb_trail = $parent_string . $delimiter . $post_link;
        } else {
            $breadcrumb_trail = $post_link;
        }

        if ($post_type_link) {
            $breadcrumb_trail = $post_type_link . $delimiter . $breadcrumb_trail;
        }

        if ($category_links) {
            $breadcrumb_trail = $category_links . $breadcrumb_trail;
        }
    }

    // Handle archives which includes category-, tag-, taxonomy-, date-, custom post type archives and author archives
    if (is_archive()) {
        if (is_category()
             || is_tag()
             || is_tax()
        ) {
            // Set the variables for this section
            $term_object = get_term($queried_object);
            $taxonomy = $term_object->taxonomy;
            $term_id = $term_object->term_id;
            $term_name = $term_object->name;
            $term_parent = $term_object->parent;
            $taxonomy_object = get_taxonomy($taxonomy);
            $current_term_link = $before . $taxonomy_object->labels->singular_name . ': ' . $term_name . $after;
            $parent_term_string = '';

            if (0 !== $term_parent) {
                // Get all the current term ancestors
                $parent_term_links = [];
                while ($term_parent) {
                    $term = get_term($term_parent, $taxonomy);

                    $parent_term_links[] = sprintf($link, esc_url(get_term_link($term)), $term->name);

                    $term_parent = $term->parent;
                }

                $parent_term_links = array_reverse($parent_term_links);
                $parent_term_string = implode($delimiter, $parent_term_links);
            }

            if ($parent_term_string) {
                $breadcrumb_trail = $parent_term_string . $delimiter . $current_term_link;
            } else {
                $breadcrumb_trail = $current_term_link;
            }
        } elseif (is_author()) {
            $breadcrumb_trail = $author_archive . $before . $queried_object->data->display_name . $after;
        } elseif (is_date()) {
            // Set default variables
            $year = $wp_the_query->query_vars['year'];
            $monthnum = $wp_the_query->query_vars['monthnum'];
            $day = $wp_the_query->query_vars['day'];

            // Get the month name if $monthnum has a value
            if ($monthnum) {
                $date_time = DateTime::createFromFormat('!m', $monthnum);
                $month_name = $date_time->format('F');
            }

            if (is_year()) {
                $breadcrumb_trail = $before . $year . $after;
            } elseif (is_month()) {
                $year_link = sprintf($link, esc_url(get_year_link($year)), $year);

                $breadcrumb_trail = $year_link . $delimiter . $before . $month_name . $after;
            } elseif (is_day()) {
                $year_link = sprintf($link, esc_url(get_year_link($year)), $year);
                $month_link = sprintf($link, esc_url(get_month_link($year, $monthnum)), $month_name);

                $breadcrumb_trail = $year_link . $delimiter . $month_link . $delimiter . $before . $day . $after;
            }
        } elseif (is_post_type_archive()) {
            $post_type = get_post_type();
            $post_type_object = get_post_type_object($post_type);

            $breadcrumb_trail = $before . $post_type_object->labels->singular_name . $after;
        }
    }

    // Handle the search page
    if (is_search()) {
        $breadcrumb_trail = $search . $before . get_search_query() . $after;
    }

    // Handle 404's
    if (is_404()) {
        $breadcrumb_trail = $before . $error . $after;
    }

    // Handle paged pages
    if (is_paged()) {
        $current_page = get_query_var('paged') ? get_query_var('paged') : get_query_var('page');
        /* Translators: %s page. */
        $page_addon = $before . sprintf(esc_html__(' ( Page %s )', 'the-pack-addon'), number_format_i18n($current_page)) . $after;
    }

    $breadcrumb_output_link = '';
    $breadcrumb_output_link .= '<div class="xlbreadcrumb"><div class="inner">';
    if (is_home()
         || is_front_page()
    ) {
        // Do not show breadcrumbs on page one of home and frontpage
        if (is_paged()) {
            $breadcrumb_output_link .= $here_text . $delimiter;
            $breadcrumb_output_link .= '<a href="' . $home_link . '">' . $home_text . '</a>';
            $breadcrumb_output_link .= $page_addon;
        }
    } else {
        $breadcrumb_output_link .= '<a href="' . $home_link . '" rel="v:url" property="v:title">' . $home_text . '</a>';
        $breadcrumb_output_link .= $delimiter;
        $breadcrumb_output_link .= $breadcrumb_trail;
        $breadcrumb_output_link .= $page_addon;
    }
    $breadcrumb_output_link .= '</div></div><!-- .breadcrumbs -->';

    return thepack_build_html($breadcrumb_output_link);
}

add_action('wp_ajax_tp_pro_show_video', 'tp_show_video');
add_action('wp_ajax_nopriv_tp_pro_show_video', 'tp_show_video');

function tp_show_video()
{   
    //phpcs:disable WordPress.Security.ValidatedSanitizedInput.InputNotValidated
    if ( ! wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])), 'ajax-nonce' ) ) { 
        wp_die();
    }      
    //phpcs:disable WordPress.Security.ValidatedSanitizedInput.InputNotValidated
    $vid_url = sanitize_text_field(wp_unslash($_POST['vurl']));
    //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
    echo wp_oembed_get($vid_url);
    exit();
}

add_filter( 'post_thumbnail_html', 'wpdd_modify_post_thumbnail_html', 10, 5 );

function wpdd_modify_post_thumbnail_html( $html, $post_id, $post_thumbnail_id, $size, $attr )
{
    return str_replace( '<img', '<img loading="lazy"', $html );
}

function the_pack_swiper_markup($settings){

    $slider_options = [
        'delay' => $settings['delay']['size'] ? esc_attr($settings['delay']['size']) : 5000, 
        'speed' => $settings['speed']['size']? esc_attr($settings['speed']['size']) : 400, 
        'effect' => $settings['effect']? esc_attr($settings['effect']) : 'slide', 
        'item' => $settings['item']['size']? esc_attr($settings['item']['size']) : 3,
        'space' => isset($settings['space']['size'])? esc_attr($settings['space']['size']) : 15,
        'itemtab' => $settings['itemtab']['size']? esc_attr($settings['itemtab']['size']) : 2,
        'auto' => ('yes' === $settings['auto']),
        'reverse' => ('yes' === $settings['reverse']),
        'direction' => isset($settings['vertical']) && $settings['vertical'] ? 'vertical' : 'horizontal',
    ];  
    
    $previkn = $settings['previkn'] ? '<div class="khbprnx khbnxt">'.the_pack_render_icon( $settings['previkn']).'</div>' : '';
    $nextikn = $settings['nextikn'] ? '<div class="khbprnx khbprev">'.the_pack_render_icon( $settings['nextikn']).'</div>' : '';

    $out = [
        'nav'=> '<div class="swiper-pagination"></div>'.'<div class="tp-arrow">'.$previkn.$nextikn.'</div>',
        'settings' => $slider_options,
    ];
    return $out;

}
 

add_action( 'the_pack_typo', 'tp_typo_control',10,4);

function tp_typo_control($wb,$prefix,$selector,$support=[]){

    $wb->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => $prefix.'fnt',
            'selector' => '{{WRAPPER}} '.$selector,
            'label' => esc_html__('Typography', 'the-pack-addon'),
        ]
    );
    $wb->add_control(
        $prefix.'tclr',
        [
            'label' => esc_html__('Color', 'the-pack-addon'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} '.$selector => 'color: {{VALUE}};',
            ],
        ]
    );
    if (in_array("bg", $support)){
        $wb->add_control(
            $prefix.'bg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} '.$selector => 'background: {{VALUE}};',
                ],
            ]
        );
    }

    if (in_array("margin", $support)){
        $wb->add_responsive_control(
            $prefix.'mrgn',
            [
                'label' => esc_html__('Margin', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} '.$selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    }
    if (in_array("padding", $support)){
        $wb->add_responsive_control(
            $prefix.'pd',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} '.$selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    }

    if (in_array("width", $support)){
        $wb->add_responsive_control(
            $prefix.'wid',
            [
                'label' => esc_html__('Width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} '.$selector => 'width:{{SIZE}}px;height:{{SIZE}}{{UNIT}};',
                ],

            ]
        );
    }
    if (in_array("height", $support)){
        $wb->add_responsive_control(
            $prefix.'ht',
            [
                'label' => esc_html__('Height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} '.$selector => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
                ],

            ]
        );
    }
    if (in_array("radius", $support)){
        $wb->add_responsive_control(
            $prefix.'brd',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} '.$selector => 'border-radius:{{SIZE}}{{UNIT}};',
                ],

            ]
        );
    }
    if (in_array("border", $support)){
        $wb->add_control(
            $prefix.'brk',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} '.$selector => 'border:1px solid {{VALUE}};',
                ],
            ]
        );
    }
    if (in_array("hover", $support)){

        $wb->add_control(
            $prefix.'hclr',
            [
                'label' => esc_html__('Hover Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} '.$selector.':hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $wb->add_control(
            $prefix.'hbg',
            [
                'label' => esc_html__('Hover Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} '.$selector.':hover' => 'background: {{VALUE}};',
                ],
            ]
        );
        $wb->add_control(
            $prefix.'hbdk',
            [
                'label' => esc_html__('Hover Border', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} '.$selector.':hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );
    }
}

add_action( 'the_pack_gradient_typo', 'tp_typo_gradient',10,3);

function tp_typo_gradient($wb,$prefix,$selector){

    $wb->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => $prefix.'fnt',
            'selector' => '{{WRAPPER}} '.$selector,
            'label' => esc_html__('Typography', 'the-pack-addon'),
        ]
    );
    $wb->add_control(
        $prefix.'tclr',
        [
            'label' => esc_html__('Color', 'the-pack-addon'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} '.$selector => 'color: {{VALUE}};',
            ],
        ]
    );
    $wb->add_control(
        $prefix.'tklp',
        [
            'label' => esc_html__('Text clip', 'the-pack-addon'),
            'type' => Controls_Manager::SWITCHER,
            'selectors' => [
                '{{WRAPPER}} '.$selector => 'background-clip: text;',
            ],
        ]
    );    
    $wb->add_group_control(
        Group_Control_Background::get_type(),
        [
            'name' => $prefix.'clr',
            'selector' => '{{WRAPPER}} '.$selector,
            'fields_options' => [
                'background' => [
                    'label' => esc_html__('Gradient text', 'the-pack-addon'),
                ]
            ]            
        ]
    );

}

add_action( 'the_pack_swiper_control', 'swiper_control',10,2);

function swiper_control($wb,$condition){

    if ($condition) {
        $wb->start_controls_section(
        'section_carou',
        [
            'label' => esc_html__('Carousel', 'thepackpro'),
            'tab' => Controls_Manager::TAB_STYLE,
            'condition' => [
                'disp' => 'slider',
            ],                
        ]
        );
    } else {
        $wb->start_controls_section(
        'section_carou',
        [
            'label' => esc_html__('Carousel', 'thepackpro'),
            'tab' => Controls_Manager::TAB_STYLE,             
        ]
        );
    }

    $wb->add_responsive_control(
        'swbpd',
        [
            'label' => esc_html__('Wrapper padding', 'thepackpro'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em'],
            'selectors' => [
                '{{WRAPPER}} .swiper-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],

        ]
    );

    $wb->add_control(
        'fcwe',
        [
            'label' => esc_html__('Full width carousel', 'thepackpro'),
            'type' => Controls_Manager::SWITCHER,
            'selectors' => [
                '{{WRAPPER}} .tpswiper' => 'overflow:inherit;',
            ],
        ]
    );

    $wb->add_control(
        'arrow',
        [
            'label' => esc_html__('Hide arrow', 'thepackpro'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'thepackpro'),
            'label_off' => esc_html__('No', 'thepackpro'),
            'default' => 'yes',
            'selectors' => [
                '{{WRAPPER}} .tp-arrow' => 'display:none;',
            ],
        ]
    );

    $wb->add_control(
        'dot',
        [
            'label' => esc_html__('Hide dot', 'thepackpro'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'thepackpro'),
            'label_off' => esc_html__('No', 'thepackpro'),
            'default' => 'yes',
            'selectors' => [
                '{{WRAPPER}} .swiper-pagination' => 'display:none !important;',
            ],
        ]
    );

    $wb->add_control(
        'vertical',
        [
            'label' => esc_html__('Vertical', 'thepackpro'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'thepackpro'),
            'label_off' => esc_html__('No', 'thepackpro'),
            'return_value' => 'yes',
            'default' => 'no',
        ]
    );

    $wb->add_control(
        'reverse',
        [
            'label' => esc_html__('Reverse direction', 'thepackpro'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'thepackpro'),
            'label_off' => esc_html__('No', 'thepackpro'),
            'return_value' => 'yes',
            'default' => 'no',
        ]
    );

    $wb->add_responsive_control(
        'htvrt',
        [
            'label' => esc_html__('Vertical height', 'thepackpro'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'max' => 1500,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .swiper-vertical' => 'height:{{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'vertical' => 'yes',
            ],
        ]
    );

    $wb->add_control(
        'auto',
        [
            'label' => esc_html__('Autoplay', 'thepackpro'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'thepackpro'),
            'label_off' => esc_html__('No', 'thepackpro'),
            'return_value' => 'yes',
            'default' => 'no',
        ]
    );

    $wb->add_control(
        'speed',
        [
            'label' => esc_html__('Slide speed', 'thepackpro'),
            'type' => Controls_Manager::SLIDER,
            'condition' => [
                'auto' => 'yes',
            ],
            'default' => [
                'size' => 2000,
            ],
            'range' => [
                'px' => [
                    'max' => 8000,
                ],
            ],
        ]
    );

    $wb->add_control(
        'delay',
        [
            'label' => esc_html__('Slide delay', 'thepackpro'),
            'type' => Controls_Manager::SLIDER,
            'condition' => [
                'auto' => 'yes',
            ],
            'default' => [
                'size' => 2000,
            ],
            'range' => [
                'px' => [
                    'max' => 8000,
                ],
            ],
        ]
    );

    $wb->add_control(
        'space',
        [
            'label' => esc_html__('Spacing', 'thepackpro'),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'size' => 10,
            ],
            'range' => [
                'px' => [
                    'max' => 500,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .swiper-vertical>.swiper-wrapper' => 'gap:{{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $wb->add_control(
        'item',
        [
            'label' => esc_html__('Items', 'thepackpro'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 10,
                    'step' => 1,
                ],
            ],
            'default' => [
                'size' => 3,
            ],
        ]
    );

    $wb->add_control(
        'itemtab',
        [
            'label' => esc_html__('Items tablet', 'thepackpro'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 10,
                    'step' => 1,
                ],
            ],
            'default' => [
                'size' => 2,
            ],
        ]
    );

    $wb->add_control(
        'effect',
        [
            'label' => esc_html__('Effect', 'thepackpro'),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'slide' => __( 'Slide', 'the-pack-addon'  ),
                'fade' => __( 'Fade', 'the-pack-addon'  ),
                'cube'=>__( 'Cube', 'the-pack-addon'  ),
                'coverflow'=>__( 'Coverflow', 'the-pack-addon'  ),
                'flip'=>__( 'Flip', 'the-pack-addon'  ),
                'cards'=>__( 'cards', 'the-pack-addon'  ),
            ],                
        ]
    );

    $wb->end_controls_section();

    $wb->start_controls_section(
        'section_arow',
        [
            'label' => esc_html__('Arrow', 'thepackpro'),
            'tab' => Controls_Manager::TAB_STYLE,
            'condition' => [
                'arrow!' => 'yes',
            ],
        ]
    );
    $wb->add_control(
        'previkn',
        [
            'label' => esc_html__('Previous icon', 'thepackpro'),
            'type' => Controls_Manager::ICONS,
            'label_block' => true,
        ]
    );

    $wb->add_control(
        'nextikn',
        [
            'label' => esc_html__('Next icon', 'thepackpro'),
            'type' => Controls_Manager::ICONS,
            'label_block' => true,
        ]
    );
    $wb->add_responsive_control(
        'ar_wh',
        [
            'label' => esc_html__('Width & height', 'thepackpro'),
            'type' => Controls_Manager::SLIDER,
            'selectors' => [
                '{{WRAPPER}} .khbprnx' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $wb->add_control(
        'arbg',
        [
            'label' => esc_html__('Background', 'thepackpro'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .khbprnx' => 'background: {{VALUE}};',
            ],
        ]
    );

    $wb->add_control(
        'arclr',
        [
            'label' => esc_html__('Color', 'thepackpro'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .khbprnx' => 'color: {{VALUE}};',
            ],
        ]
    );

    $wb->add_control(
        'arhbg',
        [
            'label' => esc_html__('Hover background', 'thepackpro'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .khbprnx:hover' => 'background: {{VALUE}};',
            ],
        ]
    );

    $wb->add_control(
        'arhclr',
        [
            'label' => esc_html__('Hover color', 'thepackpro'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .khbprnx:hover' => 'color: {{VALUE}};',
            ],
        ]
    );

    $wb->add_control(
        'dbclr',
        [
            'label' => esc_html__('Border color', 'thepackpro'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .khbprnx' => 'border:1px solid {{VALUE}};',
            ],
        ]
    );

    $wb->add_responsive_control(
        'arrad',
        [
            'label' => esc_html__('Border radius', 'thepackpro'),
            'type' => Controls_Manager::SLIDER,
            'selectors' => [
                '{{WRAPPER}} .khbprnx' => 'border-radius: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $wb->add_responsive_control(
        'arfx',
        [
            'label' => esc_html__('Font size', 'thepackpro'),
            'type' => Controls_Manager::SLIDER,
            'selectors' => [
                '{{WRAPPER}} .khbprnx' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $wb->end_controls_section();

    $wb->start_controls_section(
        'section_caroucs',
        [
            'label' => esc_html__('Dot', 'thepackpro'),
            'tab' => Controls_Manager::TAB_STYLE,
            'condition' => [
                'dot!' => 'yes',
            ],
        ]
    );

    $wb->add_control(
        'dal',
        [
            'label' => esc_html__('Alignment', 'thepackpro'),
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'left' => [
                    'title' => esc_html__('Left', 'thepackpro'),
                    'icon' => 'eicon-h-align-left',
                ],
                'center' => [
                    'title' => esc_html__('Center', 'thepackpro'),
                    'icon' => 'eicon-v-align-top',
                ],
                'right' => [
                    'title' => esc_html__('Right', 'thepackpro'),
                    'icon' => 'eicon-h-align-right',
                ]
            ],
            'default' => 'center',
            'selectors' => [
                '{{WRAPPER}} .swiper-pagination' => 'text-align: {{VALUE}};',
            ],
        ]
    );

    $wb->add_responsive_control(
        'dot_sp',
        [
            'label' => esc_html__('Spacing', 'thepackpro'),
            'type' => Controls_Manager::SLIDER,
            'selectors' => [
                '{{WRAPPER}} .swiper-pagination-bullets .swiper-pagination-bullet' => 'margin:0px {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $wb->add_responsive_control(
        'spwd',
        [
            'label' => esc_html__('Width', 'thepackpro'),
            'type' => Controls_Manager::SLIDER,
            'selectors' => [
                '{{WRAPPER}} .swiper-pagination span' => 'width:{{SIZE}}{{UNIT}};',
            ],

        ]
    );

    $wb->add_responsive_control(
        'spbrd',
        [
            'label' => esc_html__('Border radius', 'thepackpro'),
            'type' => Controls_Manager::SLIDER,
            'selectors' => [
                '{{WRAPPER}} .swiper-pagination span' => 'border-radius:{{SIZE}}{{UNIT}};',
            ],

        ]
    );

    $wb->add_responsive_control(
        'spawd',
        [
            'label' => esc_html__('Active width', 'thepackpro'),
            'type' => Controls_Manager::SLIDER,
            'selectors' => [
                '{{WRAPPER}} .swiper-pagination span.swiper-pagination-bullet-active' => 'width:{{SIZE}}{{UNIT}};',
            ],

        ]
    );

    $wb->add_responsive_control(
        'spht',
        [
            'label' => esc_html__('Height', 'thepackpro'),
            'type' => Controls_Manager::SLIDER,
            'selectors' => [
                '{{WRAPPER}} .swiper-pagination span' => 'height:{{SIZE}}{{UNIT}};',
            ],

        ]
    );

    $wb->add_responsive_control(
        'dvp',
        [
            'label' => esc_html__('Vertical position', 'thepackpro'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => -500,
                    'max' => 500,
                    'step' => 1,
                ],

            ],
            'size_units' => ['px', '%'],
            'selectors' => [
                '{{WRAPPER}} .swiper-pagination' => 'bottom:{{SIZE}}{{UNIT}};',
            ],

        ]
    );

    $wb->add_control(
        'dt-m',
        [
            'label' => esc_html__('Main color', 'thepackpro'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swiper-pagination span' => 'background: {{VALUE}};',
            ],
        ]
    );

    $wb->add_control(
        'dt-s',
        [
            'label' => esc_html__('Active color', 'thepackpro'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swiper-pagination span.swiper-pagination-bullet-active' => 'background: {{VALUE}};',
            ],
        ]
    );

    $wb->end_controls_section();
    
}