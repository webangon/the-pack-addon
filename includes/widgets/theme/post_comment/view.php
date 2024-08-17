<?php
namespace the_pack_pro;

use Elementor\Plugin;

if (Plugin::instance()->editor->is_edit_mode() || get_post_type() == 'tp_theme_builder') {
    $postid = $settings['preview'];
} else {
    global $postid;
    $postid = get_the_ID();
}

$commenter = wp_get_current_commenter();
$fields = [

    'fields' => apply_filters(
        'comment_form_default_fields',
        [
            'author' => '<div class="comment-form-author khbcomment-field"><input id="author" class="form-control" name="author" type="text" value="' . $commenter['comment_author'] . '" placeholder="' . $settings['name'] . '"/></div>',
            'email' => '<div class="comment-form-email khbcomment-field"><input id="email" name="email" class="form-control" type="text" value="' . $commenter['comment_author_email'] . '" placeholder="' . $settings['email'] . '"/></div>',
            'url' => '<div class="comment-form-url khbcomment-field"><input id="url" name="url" class="form-control" type="text" value="' . $commenter['comment_author_url'] . '" placeholder="' . esc_attr($settings['website']) . '"/></div>',
        ]
    ),
    'comment_field' => '<div class="comment-form-comment">' .
                              '<textarea id="comment" name="comment" placeholder="' . esc_attr($settings['comment']) . '" cols="45" rows="8" aria-required="true"></textarea>' .
                              '</div>',
    'comment_notes_after' => '',
    'title_reply' => '',
    'label_submit' => $settings['sbmt'],
    'submit_field' => '<div class="form-submit">%1$s %2$s</div>',
    'comment_notes_before' => '',
];

$num_comments = get_comments_number($postid);

if (comments_open($postid)) {
    if ($num_comments == 0) {
        $comments = $settings['nc'];
    } elseif ($num_comments > 1) {
        $comments = $num_comments . ' ' . $settings['com'];
    } else {
        $comments = $settings['onecom'];
    }
    $write_comments = $comments;
} else {
    $write_comments = $settings['ofcom'];
}

?>

<div class="khb-commentwrap comments">
    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
    <h3 class="khbcomhead"><?php echo thepack_build_html($write_comments); ?></h3>
    <ol class="commentlist">
		<?php
        $comments = get_comments([
            'post_id' => $postid,
            'status' => 'approve'
        ]);

        wp_list_comments([
            'reply_text' => $settings['rply'],
            'avatar_size' => 100,
        ], $comments);
        ?>
    </ol>
	<?php comment_form($fields, $postid); ?>
</div>