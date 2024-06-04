<?php

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

if (!class_exists('The_Pack_Cloud_Library')) {
    
    class The_Pack_Cloud_Library
    {
        private static $_instance = null;
        public static $plugin_data = null;

        public static function init()
        {
            if (is_null(self::$_instance)) {
                self::$_instance = new self();
                self::$_instance->include_files();
            }
            return self::$_instance;
        }

        private function __construct()
        {
            self::$plugin_data = [ 

                'pro-link' => 'https://webangon.com/the-pack-elementor-addon/',
                //'remote_widget' => 'http://thepack.test/main/',
                'remote_widget' => 'https://webangon.com/plugins/thepack/main/', // all widgets
                'remote_sites' => 'https://webangon.com/sites/thepack/', // all section & demo sites
                //'remote_sites' => 'http://thepack.test/business/', // all demo sites
                'thepack_import_data' => 'thepack_single_lib', // elementor import endpoint
                'thepack_site_cat' => 'wordpress', // site category

            ];      

            add_action('elementor/editor/before_enqueue_scripts', [$this, 'editor_script']);
            add_action('wp_ajax_process_ajax', [$this, 'ajax_data']);
            add_action('wp_ajax_tp_reload_template', [$this, 'reload_library']);
            
        }

        public function __clone()
        {
            _doing_it_wrong(__FUNCTION__, esc_html__('Cheatin&#8217; huh?', 'the-pack-addon'), '1.0.0');
        }

        public function __wakeup()
        {
            _doing_it_wrong(__FUNCTION__, esc_html__('Cheatin&#8217; huh?', 'the-pack-addon'), '1.0.0');
        }

        public function include_files() 
        {
            require __DIR__ . '/inc/import.php'; 
 
        }
 
        public function count_elements( $option ){
            $data = get_option('the_pack_library');
            return isset($data[$option]) ? count( $data[$option] ) : 0;
        }

        public function editor_script() 
        {   
            wp_enqueue_script('thepack-library', plugins_url('/assets/js/elementor-manage-library.js', __FILE__), [], THE_PACK_PLUGIN_VERSION, true);  
            wp_localize_script('thepack-library', 'thepack_lib_params', [
                'site' => site_url(),
                'elements' => $this->count_elements('widget'),
                'sections' => $this->count_elements('section'),
                'header_footer' => $this->count_elements('header_footer'),
                'theme' => $this->count_elements('themebuilder'),
                'woocommerce' => $this->count_elements('woocommerce'),
                'extra' => $this->count_elements('extra'),
                'page' => $this->count_elements('pages'), 
                'nonce' => wp_create_nonce('ajax-nonce')
            ]);                         
            wp_enqueue_script('masonry');
            wp_enqueue_style('thepack_lib', plugins_url('/assets/css/style.css', __FILE__),'', THE_PACK_PLUGIN_VERSION, 'all');
        }

        public function reload_library()
        {   
			if (!current_user_can('manage_options') || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])), 'ajax-nonce')) {
				exit;
			}            
            The_Pack_Activation_Class::init();
            die();
        }

        public function choose_option_table($table_name)
        {
            if ($table_name == 'element') {
                $out = 'widget';
            } elseif ($table_name == 'section') {
                $out = 'section';
            } elseif ($table_name == 'header-footer') {
                $out = 'header_footer';
            } elseif ($table_name == 'theme-builder') {
                $out = 'themebuilder';
            } elseif( $table_name == 'woocommerce' ) {
                $out = 'woocommerce';
            } elseif( $table_name == 'extra' ){
                $out = 'extra';
            } else {
                $out = 'pages';
            }
            return $out;
        }

        public function filter_sidebar($products,$key,$filter){
            $values = $out = '';
            foreach ($products as $nav) { 
                $filter_nav = isset($nav[$key]) ? $nav[$key] : '';
                $values != "" && $values .= ",";
                $values .= $filter_nav; 
            }
            $nav_array = array_unique(explode(',', $values));
     
            foreach ($nav_array as $a) {
                $active = $a == $filter ? 'class="active"' : '';
                $out .= '<li '.$active.' data-key="'.$key.'" data-filter="'.$a.'">' .$a. '</li>';
            }		
            return '<ul class="filter-cat raw-style"><li>All</li>'.$out.'</ul>';
        }

        public function ajax_data()
        {
            if (!current_user_can('manage_options') || !wp_verify_nonce(sanitize_text_field(sanitize_text_field(wp_unslash($_POST['nonce']))), 'ajax-nonce')) {
				exit;
			}
            
            $option_type = $this->choose_option_table(sanitize_text_field($_POST['data']['type']));
            $nav = '';
            $data = get_option('the_pack_library');

            $products = isset($data[$option_type]) ? $data[$option_type] : '';
            if (is_array($products)) {
                $Sidebar_products = isset($data[$option_type]) ? $data[$option_type] : '';
                $filter = isset($_POST['data']['filter']) ? sanitize_text_field($_POST['data']['filter']) : '' ; 
                $page_number = sanitize_text_field($_POST['data']['page']);
                $limit = 30;
                $offset = 0;

                $current_page = 1;
                if (isset($page_number)) {
                    $current_page = (int)$page_number;
                    $offset = ($current_page * $limit) - $limit;
                }

                if (!empty($filter)) {
                    $filtered_products = [];
                    foreach ($products as $product) { 
                        if (!empty($filter)) {
                            if (preg_match("/{$filter}/", strtolower($product['keywords']))) {
                                $filtered_products[] = $product;
                            }
                        }
                    }
        
                    $products = $filtered_products;
                }
                
                $paged_products = array_slice($products, $offset, $limit);
                $total_products = count($products);
                $total_pages = is_float($total_products / $limit) ? intval($total_products / $limit) + 1 : $total_products / $limit;
                //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
                echo '<div class="sidebar">'.$this->filter_sidebar($Sidebar_products,'keywords',$filter).'</div>';
                echo '<div class="item-inner">';
                echo '<div class="item-wrap">';
                if (count($paged_products)) {
                    foreach ($paged_products as $product) {
                        $pro = $product['pro'] ? '<span class="pro">pro</span>' : '';
                        $parent_site = substr($product['thumb'], 0, strpos($product['thumb'], 'wp-content'));
                        if ($product['pro'] && !class_exists('The_Pack_Pro')) {
                            $btn = '<a target="_blank" href="' . self::$plugin_data['pro-link'] . '" class="buy-tmpl ' . $option_type . '"><i class="eicon-external-link-square"></i> Buy pro</a>';
                        } else {
                            $btn = '<a href="#" data-parentsite="' . $parent_site . '" data-id="' . $product['id'] . '" class="insert-tmpl ' . $option_type . '"><i class="eicon-file-download"></i> Insert</a>';
                        } ?>
					<div class="item">
						<div class="product">
							<div data-preview='<?php echo esc_attr($product['preview']).'?preview=true'; ?>' class='lib-img-wrap'>
                                <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								<?php echo $pro; ?>
								<img src="<?php echo esc_attr($product['thumb']); ?>">
								<i class="eicon-zoom-in-bold"></i>
							</div>
							<div class='lib-footer'>
									<p class="lib-name"><?php echo esc_attr($product['name']); ?></p>
                                <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>    
								<?php echo the_pack_html_escaped($btn); ?>
							</div>

						</div>
					</div>

					<?php
                    }
                    if ($total_pages > 1) {
                        $ends_count = 2;
                        $middle_count = 1;
                        $dots = false;
                        $cur_page = sanitize_text_field($_POST['data']['page']);

                        echo '</div><div class="pagination-wrap"><ul>';
                        for ($page_number = 1; $page_number <= $total_pages; $page_number++) {
                            if ($page_number == $cur_page) {?>
									<li class="page-item active"><a class="page-link" href="#" data-page-number="<?php echo esc_attr($page_number); ?>"><?php echo esc_attr($page_number); ?></a></li>
								<?php } else {
                                if ($page_number <= $ends_count || ($cur_page && $page_number >= $cur_page - $middle_count && $page_number <= $cur_page + $middle_count) || $page_number > $total_pages - $ends_count) { ?>
										<li class="page-item"><a class="page-link" href="#" data-page-number="<?php echo esc_attr($page_number); ?>"><?php echo esc_attr($page_number); ?></a></li>
									<?php $dots = true;
                                    } elseif ($dots) {
                                        echo '<li><a>&hellip;</a></li>';
                                        $dots = false;
                                    }
                            }
                        }
                        echo '</ul></div></div>';
                    }
                } else {
                    echo '<h3 class="no-found">No template found</h3>';
                }
                die();
            } else {
                echo sprintf('%s Something went wrong ,Please <a class="eicon-sync" href="#">reload</a> library %s','<p class="no-result">','</p>');
                die();
            }
        }
    }
 
    The_Pack_Cloud_Library::init();
}
