<?php
$icon = $settings['icon']['value'] ? '<div class="icon"><i class="tbicon ' . $settings['icon']['value'] . '"></i></div>' : '';
?>

<div class="tp-cta-link-wrap tp-no-overflow">
    <div class="tp-cta-link">
        <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php echo thepack_build_html($icon); ?>
        <div class="content">
            <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php echo thepack_build_html($settings['pre'], 'p', 'pre'); ?>
            <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php echo thepack_build_html($settings['title'], 'h3', 'title'); ?>
        </div>
        <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        <a class="fullink" <?php echo thepack_get_that_link($settings['url']); ?>></a>
    </div>
</div>
