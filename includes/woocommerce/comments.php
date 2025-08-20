<?php
global $product;

if ( ! comments_open() ) {
	return;
}
$count = $product->get_review_count();
$args = array(
	'status' => 'approve' ,
	'post_type' => 'product',
	'post_id' => $product->get_id(), // use post_id, not post_ID
);

$tcomments = get_comments($args);
$out = '';
foreach ( $tcomments as $tcomment ) {

	$comment = '<p>'.get_comment_text($tcomment->comment_ID).'</p>';
	$avatar = '<div class="avatar-wrap">'.get_avatar( $tcomment->comment_author_email, 100 ).'</div>';
	$author = '<span class="author">'.get_comment_author($tcomment).'</span class="author">';
	$time = '<time>'.get_comment_date( wc_date_format(),  $tcomment ).'</time>';
	$width = get_comment_meta( $tcomment->comment_ID, 'rating', true )*20 .'%';
	$rating = '
		<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="tpwoo-star-rating" title="'.get_comment_meta( $tcomment->comment_ID, 'rating', true ).'">
			<span class="tscore"><span style="width: '.$width.'"></span></span>
		</div>	
	';
	$out .= '
		<li>
			'.thepack_build_html($avatar).'
			<div class="comment-text">
				'.$rating.'<div class="author-meta">'.$author.$time.'</div>'.$comment.'//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped 
			</div>
		</li>
	';
}
?>
<div id="reviews" class="woocommerce-Reviews">
	<div id="comments">
		<h2 class="woocommerce-Reviews-title">
			<?php
			$count = $product->get_review_count();
			if ( $count && wc_review_ratings_enabled() ) {
				/* translators: 1: reviews count 2: product name */
				$reviews_title = sprintf( esc_html( _n( '%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'the-pack-addon' ) ), esc_html( $count ), '<span>' . get_the_title() . '</span>' );
				//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
				echo apply_filters( 'woocommerce_reviews_title', $reviews_title, $count, $product );
			} else {
				esc_html_e( 'Reviews', 'the-pack-addon' );
			}
			?>
		</h2>
	</div>
	<div class='tp-woocomment-comment'>
		<ul class='raw-style'>
			<?php echo thepack_build_html($out);//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped?>
		</ul>
	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
		<div id="review_form_wrapper">
			<div id="review_form">
				<?php
				$commenter    = wp_get_current_commenter();
				$comment_form = array(
					/* translators: %s is product title */
					'title_reply'         => $tcomments ? esc_html__( 'Add a review', 'the-pack-addon' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'the-pack-addon' ), get_the_title() ),
					/* translators: %s is product title */
					'title_reply_to'      => esc_html__( 'Leave a Reply to %s', 'the-pack-addon' ),
					'title_reply_before'  => '<span id="reply-title" class="comment-reply-title">',
					'title_reply_after'   => '</span>',
					'comment_notes_after' => '',
					'comment_notes_before' => '',
					'label_submit'        => esc_html__( 'Submit', 'the-pack-addon' ),
					'logged_in_as'        => '',
					'comment_field'       => '',
				);

				$name_email_required = (bool) get_option( 'require_name_email', 1 );
				$fields              = array(
					'author' => array(
						'label'    => esc_html__( 'Name', 'the-pack-addon' ),
						'type'     => 'text',
						'value'    => $commenter['comment_author'],
						'required' => $name_email_required,
					),
					'email'  => array(
						'label'    => esc_html__( 'Email', 'the-pack-addon' ),
						'type'     => 'email',
						'value'    => $commenter['comment_author_email'],
						'required' => $name_email_required,
					),
				);

				$comment_form['fields'] = [];

				foreach ( $fields as $key => $field ) {
					$field_html  = '<p class="comment-form-' . esc_attr( $key ) . '">';

					$field_html .= '<input placeholder="'.$field['label'].( $field['required'] ? ' *' : '' ).'" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" type="' . esc_attr( $field['type'] ) . '" value="' . esc_attr( $field['value'] ) . '" size="30" ' . ( $field['required'] ? 'required' : '' ) . ' /></p>';

					$comment_form['fields'][ $key ] = $field_html;
				}

				$account_page_url = wc_get_page_permalink( 'myaccount' );
				if ( $account_page_url ) {
					/* translators: %s opening and closing link tags respectively */
					$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a review.', 'the-pack-addon' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</p>';
				}

				if ( wc_review_ratings_enabled() ) {
					$comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Your rating', 'the-pack-addon' ) . ( wc_review_ratings_required() ? '&nbsp;<span class="required">*</span>' : '' ) . '</label><select name="rating" id="rating" required>
						<option value="">' . esc_html__( 'Rate&hellip;', 'the-pack-addon' ) . '</option>
						<option value="5">' . esc_html__( 'Perfect', 'the-pack-addon' ) . '</option>
						<option value="4">' . esc_html__( 'Good', 'the-pack-addon' ) . '</option>
						<option value="3">' . esc_html__( 'Average', 'the-pack-addon' ) . '</option>
						<option value="2">' . esc_html__( 'Not that bad', 'the-pack-addon' ) . '</option>
						<option value="1">' . esc_html__( 'Very poor', 'the-pack-addon' ) . '</option>
					</select></div>';
				}

				$comment_form['comment_field'] .= '<p class="comment-form-comment"><textarea placeholder="Your review *" id="comment" name="comment" cols="45" rows="8" required></textarea></p>';

				comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>
	<?php else : ?>
		<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'the-pack-addon' ); ?></p>
	<?php endif; ?>
</div>