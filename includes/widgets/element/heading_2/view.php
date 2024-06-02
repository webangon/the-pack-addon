<?php

$empha = thepack_build_html($settings['empha'], 'h1', 'sub');
$pre = thepack_build_html($settings['pre'], 'span', 'line');
$head = thepack_build_html($settings['head'], 'h2', 'heading');

?>
<?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
<div class="tb-heading-two <?php echo the_pack_html_escaped($settings['tmpl']); ?>">
    <div class="inner">
    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php echo thepack_build_html($empha . $pre . $head); ?>
    </div>
</div>