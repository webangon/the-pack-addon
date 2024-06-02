<div class="tp-thumb-image-layer-wrap">
    <div class="tp-thumb-image-layer">
		<?php
        //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
        echo thepack_ft_images($settings['thumb']['id'], 'full');
        //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
        echo the_pack_html_escaped($this->content($settings['items'], $settings['anim']));
        ?>
    </div>
</div>