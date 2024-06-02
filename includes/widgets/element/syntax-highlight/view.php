<?php
$options = [
  'source' => ('yes' === $settings['source']),
];
echo '<div class="tp-syntax-highlight" data-xld =\'' . wp_json_encode($options) . '\'>';
?>
  <pre class="code" data-language="<?php echo esc_attr($settings['lang']);?>">
    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
    <?php echo the_pack_html_escaped($settings['code']);?>
  </pre> 
</div>