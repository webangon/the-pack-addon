<?php
    $nav = '';
    $i=0;foreach ($settings['tabs'] as $a) {
        $i++;
        $class= $i==1 ? 'class="current"' : '';
        $link = thepack_get_that_link($a['url']);
        $nav.=$a['url']['url'] ? '<li '.$class.'><a ' . $link . '>' . $a['ttl'].'</a></li>' : '';
    }
?>

<div class="tp-floating-nav">
    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
    <ul class="tp-float-nav"><?php echo thepack_build_html($nav);?></ul>
</div>
