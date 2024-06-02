<?php
$icon = $settings['icon']['value'] ? '<i class="tbicon ' . $settings['icon']['value'] . '"></i>' : '';
?>  
<div class="scrollto-wrap two">
    <div class="scroll-to">
        <div class="scroll-downs">
            <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            <?php echo the_pack_html_escaped($icon); ?>
        </div>
    </div>
</div> 