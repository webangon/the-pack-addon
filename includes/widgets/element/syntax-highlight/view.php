<?php
$options = [
  'source' => ('yes' === $settings['source']),
];
echo '<div class="tp-syntax-highlight" data-xld =\'' . wp_json_encode($options) . '\'>';
?>
  <pre class="code" data-language="<?php echo esc_attr($settings['lang']);?>">
    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
    <?php echo thepack_build_html($settings['code']);?>
  </pre> 
</div>