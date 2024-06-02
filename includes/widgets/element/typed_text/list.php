<?php

$slider_options = [
    'pre' => $settings['pre'],
    'typing' => $settings['typing'],
    'cursor' => $settings['cursor'],
];

echo '<div class="type-text" data-xld =\'' . wp_json_encode($slider_options) . '\'></div>';
?>   