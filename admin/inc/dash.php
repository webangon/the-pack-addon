<?php

class The_Pack_Demo_Sites_Dash {

	private $importer_page = 'the-pack-demo';

	public function admin_pages() {

		$temp = 'Starter Sites';
		add_submenu_page( 
			'the-pack',
			$temp, 
			$temp,
			'manage_options',
			$this->importer_page,
			[ $this, 'display_import_page' ]
		);
	}
 
	public function create_nav($products){
		$values = $out = '';

		foreach ((array)$products as $nav) {
			$values != "" && $values .= ",";
			$nav_cat = isset($nav['keywords']) ? $nav['keywords'] : '';
			$values .= $nav_cat;
		}
		$nav_array = array_unique(explode(',', $values));

		foreach ((array)$nav_array as $a) {
			$out .= '<li data-filter="'.$a.'">' .$a. '</li>';
		}		
		return '<ul class="filter-cat"><li class="active">All</li>'.$out.'</ul>';
	}
	
	public function display_import_page() {

		if ( wp_doing_ajax() ){
			if (!current_user_can('manage_options') || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])), 'wp_rest')) {
				exit;
			}
		} 
		
		$data = get_option('the_pack_library');
		//$data_key = 'sites';
		$out = '';
		$page_number = isset($_POST['data']['page']) ? esc_attr($_POST['data']['page']) : '1' ;
		$data_key = isset($_POST['data']['table']) ? esc_attr($_POST['data']['table']) : 'sites' ;
		$limit = 8;
		$offset = 0;
		$current_page = 1;
		if (isset($page_number)) {
			$current_page = (int)$page_number;
			$offset = ($current_page * $limit) - $limit;
		} 

		$products = isset($data[$data_key]) && $data[$data_key] ? $data[$data_key] : [];
		$search_filter = isset($_POST['data']['filter']) ? esc_attr($_POST['data']['filter']) : '' ;
		if (!empty($search_filter)) {
			$filtered_products = [];
			foreach ($products as $product) {
				if (!empty($search_filter)) {
					if (preg_match("/{$search_filter}/", strtolower($product['keywords']))) {
						$filtered_products[] = $product;
					}
				}
			}

			$products = $filtered_products;
		}

		$paged_products = array_slice($products, $offset, $limit);
		$total_products = count($products);
		$total_pages = is_float($total_products / $limit) ? intval($total_products / $limit) + 1 : $total_products / $limit;
		
		
		foreach($paged_products as $demo) { 
			//var_dump($demo); News24_Cloud_Library::$plugin_data["remote_site"]
			$pro = $demo['pro'] ? '<span class="pro">pro</span>' : '';
			$btn = $demo['pro'] && !class_exists('The_Pack_Pro') ? esc_html__('Purchase','the-pack') : esc_html__('Import','the-pack');
			$url = $demo['pro'] && !class_exists('The_Pack_Pro') ? The_Pack_Cloud_Library::$plugin_data["pro-link"] : '#';

			$out.=' 
				<div class="demo">
				    <div class ="inner">
						<img class="xlspinner" src="'.admin_url().'/images/spinner.gif">
						<div class="theme-screenshot">
							<img src="'.$demo['thumb'].'">
							'.$pro.'
						</div>
						<a class="more-details" target="_blank" href="'.$demo['preview'].'">Preview</a>
						<a target="_blank" data-xml="'.$demo['xml_attachment'].'" data-front="'.$demo['homepage'].'" class="btn-import-xml more-details '.$btn.'" href="'.$url.'">'.$btn.'</a>
						<h3 class="theme-name">'.$demo['name'].'</h3>
					</div>
				</div>
			';
		}

		?>
		<?php if ( !wp_doing_ajax() ) { echo '<div class="xlimwrap">'; } ?>
			<div class="notice-wrp">
				<div class="inner">
					<h3>Reset WordPress</h3>
					<p>For the best outcome, clean WordPress install is required.This will delete posts and clear all media uploads.If you face any issue, contact support and we will solve it.</p>
					<a class="button button-primary clean-db" href="#">Reset WordPress</a>
					<a class="button" target="_blank" href="https://webangon.com/contact/">Support</a>
				</div>
			</div>
			<div class="header">
				<div class="lhead">
					<h2 class="lib-logo"><?php echo esc_html__('Sites','the-pack').'<span>'.esc_attr($total_products).'</span>';?></h2>
				</div>
				<div class="centerhead">
					<?php if ($data){
						//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
						echo the_pack_html_escaped($this->create_nav($data['sites']));
						}?>
				</div> 
				<div class="rhead"></div>
			</div> 			
			<div class="tp-container">
			<div class="tp-loader"></div>
			<?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	    	<div data-table="<?php echo the_pack_html_escaped($data_key);?>" class="demo-inner">
	    		<?php 
					if (!$data){
						echo '<div class="no-data">Something went wrong ! Please <a class="reload-lib" href="#">Reload</a> library</div>';
						return;
					}
					//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
	    			echo the_pack_html_escaped($out);
	    		?> 
	    	</div>

			<?php
				if ($total_pages > 1) {
					$ends_count = 2;
					$middle_count = 1;
					$dots = false;
					$cur_page = $page_number;

					echo '<div class="pagination-wrap"><ul>';
					for ($page_number = 1; $page_number <= $total_pages; $page_number++) {
						if ($page_number == $cur_page) {?>
								<?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								<li class="page-item active"><a class="page-link" href="#" data-page-number="<?php echo the_pack_html_escaped($page_number); ?>"><?php echo the_pack_html_escaped($page_number); ?></a></li>
							<?php } else {
							if ($page_number <= $ends_count || ($cur_page && $page_number >= $cur_page - $middle_count && $page_number <= $cur_page + $middle_count) || $page_number > $total_pages - $ends_count) { ?>
									<?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									<li class="page-item"><a class="page-link" href="#" data-page-number="<?php echo the_pack_html_escaped($page_number); ?>"><?php echo the_pack_html_escaped($page_number); ?></a></li>
								<?php $dots = true;
								} elseif ($dots) {
									echo '<li><a>&hellip;</a></li>';
									$dots = false;
								}
						}
					}
					echo '</ul></div>';
				}
			?>
	      </div>
		  <?php if ( !wp_doing_ajax() ) { echo '</div>'; } ?>	

		<?php
		if ( wp_doing_ajax() ) {
			die();
		}
	}

	public function admin_scripts() {
		//phpcs:disable WordPress.Security.NonceVerification.Recommended
		if (isset($_GET['page']) && sanitize_text_field($_GET['page']) == 'the-pack-demo'){

			 $data = array( 
			   'ajax_url' => admin_url( 'admin-ajax.php' ),
			   'site_url' => home_url(),
			); 
			 wp_enqueue_script('thepack-sites', THE_PACK_PLUGIN_URL.'admin/inc/assets/admin.js',array('jquery','masonry'), THE_PACK_PLUGIN_VERSION, true);
			 wp_enqueue_style('thepack-sites', THE_PACK_PLUGIN_URL.'admin/inc/assets/admin.css', [], THE_PACK_PLUGIN_VERSION);
			 wp_localize_script('thepack-sites', 'thepack_site_data', $data );
		 }
	}

	public function the_pack_import_xml(){

		if (!current_user_can('manage_options') || !wp_verify_nonce( sanitize_text_field(wp_unslash($_POST['nonce'])), 'wp_rest')) {
			exit;
		}
		$remote = \The_Pack_Cloud_Library::$plugin_data['remote_sites'];
		set_time_limit(0);
		// If the function it's not available, require it.

		if ( ! function_exists( 'download_url' ) ) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
		}

		// Now you can use it!
		$file_url = json_decode(wp_remote_retrieve_body(wp_remote_get($remote . 'wp-json/wp/v2/thepack_site_xml/?id=' . sanitize_text_field($_POST['xml']) )), true);

		$tmp_file = download_url( $file_url );

		// Sets file final destination.
		$filepath = ABSPATH . 'wp-content/data.xml';
		copy( $tmp_file, $filepath );
		wp_delete_file( $tmp_file ); 

		if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);

		require_once 'vendor/wordpress-importer/wordpress-importer.php';

		$wp_import = new WP_Import();
		$wp_import->fetch_attachments = true;
		ob_start();
		$wp_import->import($filepath);
		ob_end_clean(); 
		wp_delete_file( $filepath );
		\Elementor\Plugin::instance()->files_manager->clear_cache();
	
		$created_default_kit = \Elementor\Plugin::$instance->kits_manager->create_default();
		update_option(\Elementor\Core\Kits\Manager::OPTION_ACTIVE, $created_default_kit);

		$var = new \ThePackKitThemeBuilder\Modules\ThemeBuilder\Classes\Conditions_Cache();
		$var->regenerate();
		update_option('page_on_front',sanitize_text_field(['frontpage']));
		update_option('show_on_front','page');
		die();
	}

	function tmx_delete_upload_folder($path) {

		if(!empty($path) && is_dir($path) ){
			$dir  = new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS);
			$files = new RecursiveIteratorIterator($dir, RecursiveIteratorIterator::CHILD_FIRST);
			//phpcs:disable WordPress.WP.AlternativeFunctions.file_system_operations_rmdir
			foreach ($files as $f) {if (is_file($f)) {wp_delete_file($f);} else {$empty_dirs[] = $f;} } if (!empty($empty_dirs)) {foreach ($empty_dirs as $eachDir) {rmdir($eachDir);}} rmdir($path);
		}
	} 

	public function the_pack_clean_data(){

		global $wpdb;
		$tables = ['commentmeta','comments','postmeta','posts','termmeta','terms','term_relationships','term_taxonomy'];

		foreach ( $tables as $table ) {
			//phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
			$table  = $wpdb->prefix . $table;
			$wpdb->query( "TRUNCATE TABLE $table" );
		}

		$upload_dir = wp_upload_dir(gmdate('Y/m'), true);
		$upload_dir['basedir'] = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $upload_dir['basedir']);
		$this->tmx_delete_upload_folder($upload_dir['basedir']);
	}

	public function clean_site(){
		if (!current_user_can('manage_options') || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])), 'wp_rest')) {
			exit;
		}	
		$this->the_pack_clean_data();
		wp_die();
	}

	public function __construct() {
		add_action( 'admin_menu', [ $this, 'admin_pages' ], 600 );
		add_action( 'admin_print_scripts', array( $this, 'admin_scripts' ), 10 );
		add_action( 'wp_ajax_the_pack_import_xml', array( $this, 'the_pack_import_xml' ), 10 );
		add_action( 'wp_ajax_display_import_page', array($this,'display_import_page')); 
		add_action( 'wp_ajax_thepack_clean_site', [$this, 'clean_site' ], 10 );

	}
}
new The_Pack_Demo_Sites_Dash();



