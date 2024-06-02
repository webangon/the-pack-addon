<?php
$heading = thepack_build_html($settings['heading'], 'h3', 'main-head');
?>
<div class="tbheading4 style-two">
    <div class="headwrp">
    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php echo the_pack_html_escaped($heading); ?>
    </div>
</div>
