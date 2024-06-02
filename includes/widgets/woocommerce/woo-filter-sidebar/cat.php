<?php
    $out = '';
    $title = $value['lbl'] ? '<h3>'.$value['lbl'].'</h3>' : '';
	if(is_product_category()){
		$term_children = get_term_children( get_queried_object()->term_id, 'product_cat' );
		if($term_children){
		$exclude = $value['ex_cat'];
		$out .= '<div class="filter-item">';
        $out .= $title; 
		$out .= '<ul class="raw-style">';
		foreach($term_children as $child){
			$childterm = get_term_by( 'id', $child, 'product_cat' );
			
			$out .= '<li>';
			$out .= '<a href="'.esc_url(get_term_link( $childterm->slug, 'product_cat' )).'">';
			$out .= '<input name="product_cat[]" value="'.esc_attr($childterm->term_id).'" id="'.esc_attr($childterm->name).'" type="checkbox" >';
			$out .= '<label>'.esc_html($childterm->name).'</label>';
			$out .= '</a>';
			$out .= '<li>';
		}
		$out .= '</ul>';
		$out .= '</div>';
		}
	}

	if(!is_product_category()){
        $exclude = $value['ex_cat'];
        $terms = get_terms( array(
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
            'parent'    => 0,
            'exclude'   => $exclude,//phpcs:disable WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude
        ) );
		
		$out .= '<div class="filter-item">';
        $out .= $title;
		$out .= '<ul class="raw-style">';
 
		foreach ( $terms as $term ) {
			$term_children = get_term_children( $term->term_id, 'product_cat' );
			
			$checkbox = '';
			//phpcs:disable WordPress.Security.NonceVerification.Recommended
			if(isset($_GET['filter_cat'])){ 
				if(in_array($term->term_id, explode(',',sanitize_text_field($_GET['filter_cat'])))){//phpcs:disable WordPress.Security.NonceVerification.Recommended 
					$checkbox = 'checked';
				}
			} 
			

			$out .= '<li>';
			$out .= '<a href="'.esc_url(The_Pack_Woo_Helper::tp_get_cat_url($term->term_id)).'" class="product_cat">';
			$out .= '<input name="product_cat[]" value="'.sanitize_text_field($term->term_id).'" id="'.sanitize_text_field($term->name).'" type="checkbox" '.sanitize_text_field($checkbox).'>';
			$out .= '<label >'.esc_html($term->name).'</label>';
			$out .= '</a>';
				if($term_children){
					$out .= '<ul class="children">';
					
					foreach($term_children as $child){
						$childterm = get_term_by( 'id', $child, 'product_cat' );
						$ancestor = get_ancestors( $childterm->term_id, 'product_cat' );
						
						$term_third_children = get_term_children( $childterm->term_id, 'product_cat' );

						$childcheckbox = '';
						if(isset($_GET['filter_cat'])){//phpcs:disable WordPress.Security.NonceVerification.Recommended 
							if(in_array($childterm->term_id, explode(',',sanitize_text_field($_GET['filter_cat'])))){//phpcs:disable WordPress.Security.NonceVerification.Recommended  
								$childcheckbox .= 'checked';
							}
						} 
						
						if($childterm->parent && (sizeof($term_third_children)>0)){
							$out .= '<li>';
							$out .= '<a href="'.esc_url( The_Pack_Woo_Helper::tp_get_cat_url($childterm->term_id)).'">';
							$out .= '<input name="product_cat[]" value="'.esc_attr($childterm->term_id).'" id="'.esc_attr($childterm->name).'" type="checkbox" '.esc_attr($childcheckbox).'>';
							$out .= '<label>'.esc_html($childterm->name).'</label>';
							$out .= '</a>';
							if($term_third_children){
								
								$out .= '<ul class="children">';
								foreach($term_third_children as $third_child){
									$thirdchildterm = get_term_by( 'id', $third_child, 'product_cat' );
									$thirdchildthumbnail_id = get_term_meta( $thirdchildterm->term_id, 'thumbnail_id', true );
									$thirdchildimage = wp_get_attachment_url( $thirdchildthumbnail_id );
									
									$thirdchildcheckbox = '';
									if(isset($_GET['filter_cat'])){//phpcs:disable WordPress.Security.NonceVerification.Recommended 
										if(in_array($thirdchildterm->term_id, explode(',',sanitize_text_field($_GET['filter_cat'])))){ //phpcs:disable WordPress.Security.NonceVerification.Recommended 
											$thirdchildcheckbox .= 'checked';
										}
									} 
									
									$out .= '<li>';
									$out .= '<a href="'.esc_url( The_Pack_Woo_Helper::tp_get_cat_url($thirdchildterm->term_id)).'">';
									$out .= '<input name="product_cat[]" value="'.esc_attr($thirdchildterm->term_id).'" id="'.esc_attr($thirdchildterm->name).'" type="checkbox" '.esc_attr($thirdchildcheckbox).'>';
									$out .= '<label>'.esc_html($thirdchildterm->name).'</label>';
									$out .= '</a>';
									$out .= '</li>';
								}
								$out .= '</ul>';
							}
							
							$out .= '</li>';
						} elseif (sizeof($ancestor) == 1) {
							$out .= '<li>';
							$out .= '<a href="'.esc_url( The_Pack_Woo_Helper::tp_get_cat_url($childterm->term_id)).'">';
							$out .= '<input name="product_cat[]" value="'.esc_attr($childterm->term_id).'" id="'.esc_attr($childterm->name).'" type="checkbox" '.esc_attr($childcheckbox).'>';
							$out .= '<label>'.esc_html($childterm->name).'</label>';
							$out .= '</a>';
							$out .= '</li>';
						}
				
					}
					$out .= '</ul>';
				} 
			$out .= '</li>';
		}
		$out .= '</ul>';
		$out .= '</div>';
	}
	//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
	echo the_pack_html_escaped($out);
?>