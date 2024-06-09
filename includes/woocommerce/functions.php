<?php
use Elementor\Plugin;
function tp_woo_comments_template($settings){
    require dirname(__FILE__) . '/comments.php';  
}

class The_Pack_Woo_Helper {

	public function __construct(){

		add_action('woocommerce_loop_add_to_cart_link', [__CLASS__, 'before_after_btn_wrap']);
		add_filter('wc_get_template_part', [__CLASS__, 'override_woocommerce_template_part'], 10, 3);
		add_filter( 'woocommerce_checkout_order_review', [__CLASS__,'checkout_heading'] );

		add_action('wp_ajax_tp_add_cart_single_product',[__CLASS__,'add_cart_single_product_ajax']);
		add_action('wp_ajax_nopriv_tp_add_cart_single_product',[__CLASS__,'add_cart_single_product_ajax']);
		add_filter( 'woocommerce_product_query_tax_query', [__CLASS__,'filter_tax_query'], 10, 2 );

		add_action( 'woocommerce_product_query', [__CLASS__,'tp_product_query'], 10, 2 );
		add_filter( 'loop_shop_per_page', [__CLASS__,'product_per_page'], 10);

		add_action('wp_ajax_the_pack_quickview',[__CLASS__,'the_pack_quickview']);
		add_action('wp_ajax_nopriv_the_pack_quickview',[__CLASS__,'the_pack_quickview']);

	}

	static function get_cookie_name() {
        $name = 'thepack_compare_woo';
        if ( is_multisite() ){
            $name .= '_' . get_current_blog_id();
        }
        return $name;
    }

	static function get_compared_products() {
        $cookie_name = self::get_cookie_name();
        return isset( $_COOKIE[ $cookie_name ] ) ? json_decode( wp_unslash( $_COOKIE[ $cookie_name ] ), true ) : array();
    }

	static function is_product_in_compare( $id ) {
        $list = self::get_compared_products();
        return in_array( $id, $list, true );
    }

	static function add_to_compare( $id ) {

        $cookie_name = self::get_cookie_name();

        if ( self::is_product_in_compare( $id ) ) {
            //$this->compare_json_response();
        }

        $products = self::get_compared_products();

        $products[] = $id;

        setcookie( $cookie_name, wp_json_encode( array_unique($products) ), 0, COOKIEPATH, COOKIE_DOMAIN, false, false );

        $_COOKIE[$cookie_name] = wp_json_encode( $products );

		return array_unique($products);

    }

	static function the_pack_quickview(){

		if ( ! wp_verify_nonce( sanitize_text_field(wp_unslash($_POST['nonce'])), 'ajax-nonce' ) ) {
            wp_die();
        } 

		if ( isset( $_POST['id'] ) && (int) sanitize_text_field($_POST['id']) ) {
            global $post, $product, $woocommerce;
            $id      = ( int ) sanitize_text_field($_POST['id']);
            $post    = get_post( $id );
            $product = wc_get_product( $id );
			$popcontent = '2082';
			echo do_shortcode('[THEPACK_INSERT_TPL id="' . $popcontent . '"]');
			//$out= self::add_to_compare( $id );		
			//var_dump($out); 
		}
		
		wp_die();
	}
	static function product_per_page(){

		$getopt  = isset( $_GET['perpage'] ) ? sanitize_text_field($_GET['perpage']) : '';//phpcs:disable WordPress.Security.NonceVerification.Recommended
		if($getopt){
			return $getopt;
		}

	}

	static function tp_on_sale(){
		$on_sale  = isset( $_GET['on_sale'] ) ? sanitize_text_field($_GET['on_sale']) : '';//phpcs:disable WordPress.Security.NonceVerification.Recommended
	
		if($on_sale == 'onsale'){
			return $on_sale;
		}
	}
	
	static function tp_stock_status(){
		$stock_status  = isset( $_GET['stock_status'] ) ? sanitize_text_field($_GET['stock_status']) : '';//phpcs:disable WordPress.Security.NonceVerification.Recommended
	
		if($stock_status == 'instock'){
			return $stock_status;
		}
	}
	
	static function tp_product_query( $q ){//phpcs:disable WordPress.DB.SlowDBQuery.slow_db_query_meta_key
		if(self::tp_stock_status() == 'instock'){
			$q->set( 'meta_query', array (
				array(
					'meta_key' 	=> '_stock_status',
					'value' 	=> 'instock',
				)
			));
		}
		
		if(self::tp_on_sale() == 'onsale'){
			$q->set ( 'post__in', wc_get_product_ids_on_sale() );
		}
	
	}

	static function filter_tax_query( $tax_query, $instance ) {
	
		if(isset($_GET['filter_cat'])){//phpcs:disable WordPress.Security.NonceVerification.Recommended
			if(!empty($_GET['filter_cat'])){//phpcs:disable WordPress.Security.NonceVerification.Recommended
				$tax_query[] = array(
					'taxonomy' => 'product_cat',
					'field' 	=> 'id',
					'terms' 	=> explode(',',sanitize_text_field($_GET['filter_cat'])),//phpcs:disable WordPress.Security.NonceVerification.Recommended
				);
			}
		}
		
		return $tax_query; 
	}

	static function add_cart_single_product_ajax(){

		if ( ! wp_verify_nonce( sanitize_text_field(wp_unslash($_POST['nonce'])), 'ajax-nonce' ) ) {
            wp_die();
        } 
		
		add_action( 'wp_loaded', [ 'WC_Form_Handler', 'add_to_cart_action' ], 20 );
		
		if ( is_callable( [ 'WC_AJAX', 'get_refreshed_fragments' ] ) ) {
			WC_AJAX::get_refreshed_fragments();
		}
	
		wp_die();	
	}

	static function checkout_heading(){
		echo '<h3>Your order</h3>';
	}

	static function override_woocommerce_template_part( $template, $slug, $name ) {
		$template_directory = THE_PACK_PLUGIN_DIR . 'includes/woocommerce/';
		if ( $name ) {
			$path = $template_directory . "{$slug}-{$name}.php";
		} else {
			$path = $template_directory . "{$slug}.php";
		}
		return file_exists( $path ) ? $path : $template;
	}

	static function before_after_btn_wrap( $add_to_cart_html){

		$before = '<div class="tp-add-to-cart">'; 
		$after = '</div>';  
	
		return $before . $add_to_cart_html . $after;
	}

	static function on_sale($product,$option){
		if ( !$product->is_on_sale() ){
			return;
		}
		if( $product->is_type('variable')){
			$percentages = [];
		
			$prices = $product->get_variation_prices();
		
			foreach( $prices['price'] as $key => $price ){
			  if( $prices['regular_price'][$key] !== $price ){
				$percentages[] = round(100 - ($prices['sale_price'][$key] / $prices['regular_price'][$key] * 100));
				$amount_off[] = $prices['regular_price'][$key] - $prices['sale_price'][$key];
			  }
			}
			$percentage = round(max($percentages)) . '%';
			$amount_off_s = '-'.get_woocommerce_currency_symbol().'' . round(max($amount_off));
		  } else {
			$regular_price = (float) $product->get_regular_price();
			$sale_price    = (float) $product->get_sale_price();
		
			$percentage    = round(100 - ($sale_price / $regular_price * 100)) . '%';

			$amount_off_s = '-'.get_woocommerce_currency_symbol().'' . ($regular_price - $sale_price);
		  }
		  if($option['type']=='percen'){
			$out = $percentage;
		  } elseif($option['type']=='price'){
			$out = $amount_off_s;
		  } else{
			$out = $option['label'];
		  }
		  //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
		  echo '<span class="tp-onsale tp-dinflex">'.thepack_build_html($out).'</span>';
	}

	static function product_cat($id){
		//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
		echo '<div class="tp-product-cat">'.wc_get_product_category_list( $id ).'</div>';
	}

	static function product_thumbnail($size=''){
		//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
		echo '<a href="'.esc_attr(get_permalink()).'">'.woocommerce_get_product_thumbnail($size).'</a>';
	}
	static function product_title(){
		the_title( sprintf( '<h2 class="tp-title"><a href="%s" rel="bookmark">', esc_attr( esc_url( get_permalink() ) ) ),'</a></h2>');
	}
 
	static function product_rating($product,$hide=''){
		if ( empty( $product ) || ! wc_review_ratings_enabled() ) {
			return;
		}	
		$average = $product->get_average_rating();
		$rating_count = $product->get_rating_count();
		$width = $average*20 .'%';

		if (Elementor\Plugin::instance()->editor->is_edit_mode()){
			echo '<div class="tp-avarage-rating tp-dinflex"><span class="tscore"><span style="width: 80%"></span></span><span class="count">(5)</span></div>';
		 } elseif ( $hide  ){
			//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '<div class="tp-avarage-rating tp-dinflex"><span class="tscore"><span style="width: '.$width.'"></span></span><span class="count">('.esc_attr($rating_count).')</span></div>';
		} elseif($rating_count > 0) {
			//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '<div class="tp-avarage-rating tp-dinflex"><span class="tscore"><span style="width: '.$width.'"></span></span><span class="count">('.esc_attr($rating_count).')</span></div>';
		}

	}

	static function tp_get_cat_url($termid){
		global $wp;
		if ( '' === get_option( 'permalink_structure' ) ) {
			$link = remove_query_arg( array( 'page', 'paged' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
		} else {
			$link = preg_replace( '%\/page/[0-9]+%', '', add_query_arg( null, null ) );
		}
		 
		if(isset($_GET['filter_cat'])){//phpcs:disable WordPress.Security.NonceVerification.Recommended
			$explode_old = explode(',',sanitize_text_field($_GET['filter_cat']));//phpcs:disable WordPress.Security.NonceVerification.Recommended
			$explode_termid = explode(',',$termid);
			
			if(in_array($termid, $explode_old)){
				$data = array_diff( $explode_old, $explode_termid);
				$checkbox = 'checked';
			} else {
				$data = array_merge($explode_termid , $explode_old);
			}
		} else {
			$data = array($termid);
		}
		
		$dataimplode = implode(',',$data);
		
		if(empty($dataimplode)){
			$link = remove_query_arg('filter_cat',$link);
		} else {
			$link = add_query_arg('filter_cat',implode(',',$data),$link);
		}
		
		return $link;
	}
	
	static function get_filtered_price() {
		global $wpdb;
	
		$args       = WC()->query->get_main_query()->query_vars;
		$tax_query  = isset( $args['tax_query'] ) ? $args['tax_query'] : array();
		$meta_query = isset( $args['meta_query'] ) ? $args['meta_query'] : array();
	
		if ( ! is_post_type_archive( 'product' ) && ! empty( $args['taxonomy'] ) && ! empty( $args['term'] ) ) {
			$tax_query[] = WC()->query->get_main_tax_query();
		}
	
		foreach ( $meta_query + $tax_query as $key => $query ) {
			if ( ! empty( $query['price_filter'] ) || ! empty( $query['rating_filter'] ) ) {
				unset( $meta_query[ $key ] );
			}
		}
	
		$meta_query = new WP_Meta_Query( $meta_query );
		$tax_query  = new WP_Tax_Query( $tax_query );
		$search     = WC_Query::get_main_search_query_sql();
	
		$meta_query_sql   = $meta_query->get_sql( 'post', $wpdb->posts, 'ID' );
		$tax_query_sql    = $tax_query->get_sql( $wpdb->posts, 'ID' );
		$search_query_sql = $search ? ' AND ' . $search : '';
	
		$sql = "
			SELECT min( min_price ) as min_price, MAX( max_price ) as max_price
			FROM {$wpdb->wc_product_meta_lookup}
			WHERE product_id IN (
				SELECT ID FROM {$wpdb->posts}
				" . $tax_query_sql['join'] . $meta_query_sql['join'] . "
				WHERE {$wpdb->posts}.post_type IN ('" . implode( "','", array_map( 'esc_sql', apply_filters( 'woocommerce_price_filter_post_type', array( 'product' ) ) ) ) . "')
				AND {$wpdb->posts}.post_status = 'publish'
				" . $tax_query_sql['where'] . $meta_query_sql['where'] . $search_query_sql . '
			)';
	
		$sql = apply_filters( 'woocommerce_price_filter_sql', $sql, $meta_query_sql, $tax_query_sql );
		// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
		return $wpdb->get_row( $sql );//phpcs:disable WordPress.DB.DirectDatabaseQuery.NoCaching
	} 
	
	static function show_per_page_opt(){?>
		<?php $perpage = isset($_GET['perpage']) ? sanitize_text_field($_GET['perpage']) : '';//phpcs:disable WordPress.Security.NonceVerification.Recommended ?>
		<?php $defaultperpage = wc_get_default_products_per_row() * wc_get_default_product_rows_per_page(); ?>
		<?php $options = array($defaultperpage,$defaultperpage*2,$defaultperpage*3,$defaultperpage*4); ?>
		<div class="per-page-products">
			<span><?php esc_html_e('Show:','the-pack-addon'); ?></span>
			<?php for( $i=0; $i<count($options); $i++ ) {
				//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
				echo '<a rel="nofollow noopener" href="'.esc_url( add_query_arg( 'perpage', esc_attr($options[$i]) ) ).'">'.$options[$i].'</a><span>/</span>';
			} ?>		 
		</div>
	<?php }

	static function bf_shop_filter($opt){

        echo '<div class="tp-before-shop">';
        woocommerce_result_count();
        self::show_per_page_opt();
        woocommerce_catalog_ordering();
        echo '</div>';
        self::tp_remove_shop_filter($opt);
	}

	static function tp_remove_shop_filter($opt){
	
		$output = ''; 
		$icon = the_pack_render_icon( $opt['cfltr'] );
	
		$_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes();
		$min_price = isset( $_GET['min_price'] ) ? wc_clean( sanitize_text_field($_GET['min_price'] )) : 0;//phpcs:disable WordPress.Security.NonceVerification.Recommended 
		$max_price = isset( $_GET['max_price'] ) ? wc_clean( sanitize_text_field($_GET['max_price'] )) : 0;//phpcs:disable WordPress.Security.NonceVerification.Recommended 
	
		if(! empty( $_chosen_attributes ) || isset($_GET['filter_cat']) || 0 < $min_price || 0 < $max_price || self::tp_stock_status() == 'instock' || self::tp_on_sale() == 'onsale'){//phpcs:disable WordPress.Security.NonceVerification.Recommended
	
			global $wp;
		
			if ( '' === get_option( 'permalink_structure' ) ) {
				$baselink = remove_query_arg( array( 'page', 'paged' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
			} else {
				$baselink = preg_replace( '%\/page/[0-9]+%', '',  add_query_arg( null, null )  );
			}
	
			$output .= '<ul class="remove-filter raw-style">';
			//phpcs:disable WordPress.Security.NonceVerification.Recommended
			$output .= '<li><a href="'.esc_url(remove_query_arg(array_keys($_GET))).'" class="remove-filter-element clear-all">'.$icon.$opt['clrtxt'].'</a></li>';//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
	
			if ( ! empty( $_chosen_attributes ) ) {
				foreach ( $_chosen_attributes as $taxonomy => $data ) {
					foreach ( $data['terms'] as $term_slug ) {
						$term = get_term_by( 'slug', $term_slug, $taxonomy );
						
						$filter_name    = 'filter_' . wc_attribute_taxonomy_slug( $taxonomy );
						$explode_old = explode(',',sanitize_text_field($_GET[$filter_name]));
						$explode_termid = explode(',',$term->slug);
						$klbdata = array_diff( $explode_old, $explode_termid);
						$klbdataimplode = implode(',',$klbdata);
						
						if(empty($klbdataimplode)){
							$link = remove_query_arg($filter_name);
						} else {
							$link = add_query_arg($filter_name,implode(',',$klbdata),$baselink );
						}
	 
						$output .= '<li><a href="'.esc_url($link).'" class="remove-filter-element attributes">'.$icon.esc_html($term->name).'</a></li>';//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
	
					}
				}
			}
	
			if(self::tp_stock_status() == 'instock'){
			$output .= '<li><a href="'.esc_url(remove_query_arg('stock_status')).'" class="remove-filter-element stock_status">'.$icon.$opt['clristk'].'</a></li>';
			}
			
			if(self::tp_on_sale() == 'onsale'){
			$output .= '<li><a href="'.esc_url(remove_query_arg('on_sale')).'" class="remove-filter-element on_sale">'.$icon.$opt['clrosl'].'</a></li>';
			}
	
			if($min_price){
			$output .= '<li><a href="'.esc_url(remove_query_arg('min_price')).'" class="remove-filter-element min_price">'.$icon.$opt['clrmn'].' '.wc_price( $min_price ). '</a></li>';
			}
			
			if($max_price){
			$output .= '<li><a href="'.esc_url(remove_query_arg('max_price')).'" class="remove-filter-element max_price">'.$icon.$opt['clrmx'].' '.wc_price( $max_price ). '</a></li>';
			}
			
			if(isset($_GET['filter_cat'])){
				$terms = get_terms( array(
					'taxonomy' => 'product_cat',
					'hide_empty' => false,
					'parent'    => 0,
					'include' 	=> explode(',',sanitize_text_field($_GET['filter_cat'])),
				) );
				
				foreach ( $terms as $term ) {
					$term_children = get_term_children( $term->term_id, 'product_cat' );
					$output .= '<li><a href="'.esc_url( self::tp_get_cat_url($term->term_id) ).'" class="remove-filter-element product_cat" id="'.esc_attr($term->term_id).'">'.$icon.$term->name.'</a></li>';
					if($term_children){
						foreach($term_children as $child){
							$childterm = get_term_by( 'id', $child, 'product_cat' );
							if(in_array($childterm->term_id, explode(',',sanitize_text_field($_GET['filter_cat'])))){ 
								$output .= '<li><a href="'.esc_url( self::tp_get_cat_url($childterm->term_id) ).'" class="remove-filter-element product_cat" id="'.esc_attr($childterm->term_id).'">'.$icon.$childterm->name.'</a></li>';
							}
						}
					}
				}
			
			}
			
			$output .= '</ul>';
		}
		
		echo thepack_build_html($output);
		if (Plugin::instance()->editor->is_edit_mode()) {
			echo '<ul class="remove-filter raw-style"><li><a href="#" class="remove-filter-element clear-all">'.$icon.'Clear filters</a></li><li><a href="#" class="remove-filter-element product_cat" id="28">'.$icon.'Belt</a></li>
			</ul>';
		}
	}

}

new The_Pack_Woo_Helper();
