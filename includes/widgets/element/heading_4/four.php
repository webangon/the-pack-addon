<?php
$heading = thepack_build_html($settings['heading'], '', '');
?>
<div class="tbheading4 style-four">
    <div class="headwrp">
        <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        <h3 class="main-head"><?php echo $heading; ?></h3>
    </div>
</div>