<div class="tp-quick-cart">
    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>    
    <a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>"><?php echo the_pack_render_icon($settings['icon'],'cart-icon').'<span class="cart-count">'.WC()->cart->get_cart_contents_count().'</span>';?></a>
</div>
   