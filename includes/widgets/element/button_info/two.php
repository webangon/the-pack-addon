<?php
$link = thepack_get_that_link($settings['flink']);
if ($settings['title']){
    $i = 0;
    $out = '';
    foreach (str_split($settings['title']) as $item) {
        $i++;
        $d= .045*$i;
        $txt = $item==' ' ? '&nbsp;' : $item;
        $out .= '<span style="transition-delay: '.$d.'s;">'.$txt.'</span>';
    }
}
?>

<a <?php echo $link;?> class="tp-btn-1 com-bg">
    <span class="tp-btn-txt" data-text="<?php echo esc_attr($settings['title']);?>">
        <?php echo $out;?>
    </span>
</a>
 