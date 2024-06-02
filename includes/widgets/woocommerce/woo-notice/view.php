<?php
global $product;
if ( empty( $product ) ) {
	return;
}
if ( function_exists( 'wc_print_notices' ) ) : ?>
	<?php wc_print_notices(); ?>
<?php endif; ?>  