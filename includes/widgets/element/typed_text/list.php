<?php
$slider_options = [
    'pre' => esc_attr($settings['pre']),
    'typing' => esc_attr($settings['typing']),
    'cursor' => esc_attr($settings['cursor']),
];

echo '<div class="type-text" data-xld =\'' . wp_json_encode($slider_options) . '\'></div>';
?>   