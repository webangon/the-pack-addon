<?php

$data = [
    'date' => $settings['date'],
    'day' => $settings['dayl'],
    'hour' => $settings['hourl'],
    'min' => $settings['minl'],
    'sec' => $settings['secl']
];
echo '<div class="countdown ' . esc_attr($settings['tmpl']) . '" data-xld =\'' . wp_json_encode($data) . '\'></div>';
