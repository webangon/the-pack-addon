<?php
namespace the_pack_pro;

use Elementor\Plugin;

$meta = thepack_buildermeta_to_string($settings['metas']);

?>
<div class="tp-post-meta">
	<?php thepack_build_postmeta($meta, $excerpt = ''); ?>
</div>
