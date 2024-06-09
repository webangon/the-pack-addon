<?php

$data = [
    'date' => esc_attr($settings['date']),
    'day' => esc_attr($settings['dayl']),
    'hour' => esc_attr($settings['hourl']),
    'min' => esc_attr($settings['minl']),
    'sec' => esc_attr($settings['secl'])
];
echo '<div class="countdown ' . esc_attr($settings['tmpl']) . '" data-xld =\'' . wp_json_encode($data) . '\'></div>';
