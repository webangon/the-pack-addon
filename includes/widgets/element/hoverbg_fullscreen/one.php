<div class="tphoverfullscreen">
    <div class="row">
		<?php $this->content($settings['lists'], ''); ?>
    </div>
    <div class="imgholder">
    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php echo the_pack_html_escaped($this->content($settings['lists'], 'xo')); ?>
    </div>
</div>
 