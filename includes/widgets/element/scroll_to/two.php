<?php
$icon = $settings['icon']['value'] ? '<i class="tbicon ' . esc_attr($settings['icon']['value']) . '"></i>' : '';
?>  
<div class="scrollto-wrap two">
    <div class="scroll-to">
        <div class="scroll-downs">
            <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            <?php echo $icon; ?>
        </div>
    </div>
</div> 