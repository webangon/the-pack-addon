<?php
$carticon = isset($settings['carticon']) ? $settings['carticon'] : '';
?>
<div class="menubarwrp <?php echo esc_attr($settings['nbarbox']); ?>">
    <div class="tp-header-flex-wrap">
        <div class="khbnavleft">
            <div class="leftwrpr">
                <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?> 
				<?php echo thepack_get_builder_logo($settings['logo']['id'], 'logomain', $settings['logo_link']); ?>
                <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?> 
				<?php echo thepack_get_builder_logo($settings['stlogo']['id'], 'logosticky', $settings['logo_link']); ?>
            </div>
        </div>
        <div class="khbnavcenter">
            <div class="listinr">
				<?php if ($settings['native'] ) {
                    //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
                    echo render_nav_menu($settings['menu']);
                } else {
                    //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
                    rendor_custom_nav_menu($settings['menus']);
                } ?>
            </div>
        </div>
        <div class="khbnavright"> 
            <div class="inrwrpr">
                <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?> 
				<?php echo the_pack_html_escaped($this->out_subs_btn($settings['sub-btn'], $settings['sub-link'])); ?>
                <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?> 
				<?php echo $this->out_woo_icon( $carticon, 'cart'); ?>
                <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?> 
                <?php echo the_pack_html_escaped($this->out_icon($settings['tapicon'], $settings['taphide'])); ?>
            </div>
        </div>
    </div>
</div>