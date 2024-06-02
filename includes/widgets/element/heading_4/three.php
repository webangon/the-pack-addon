<?php
$heading = thepack_build_html($settings['heading'], 'h3', 'main-head');
$sub = thepack_build_html($settings['sub'], 'span', 'sub-head');
?>

<div class="tbheading4 style-three">
    <div class="headwrp">
    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php echo the_pack_html_escaped($sub . $heading); ?>
    </div>
</div>