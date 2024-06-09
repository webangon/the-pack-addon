<div class="tphoverfullscreen">
    <div class="row">
		<?php $this->content($settings['lists'], ''); ?>
    </div>
    <div class="imgholder">
    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php echo $this->content($settings['lists'], 'xo'); ?>
    </div>
</div>
 