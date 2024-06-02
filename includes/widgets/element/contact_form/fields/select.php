<?php

$data = [
    'id' => $element['_id'],
    'type' => 'select',
    'required' => $element['required'],
];

$output = '<div data-xld =\'' . wp_json_encode($data) . '\' class="item elementor-repeater-item-' . $element['_id'] . '"><select placeholder="' . $element['placeholder'] . '" class="tp-input" name="' . $element['field_label'] . '" type="select">
    %1$s
</select></div>';

$string_options = '';
$options = explode('|', $element['field_options']);
$i = '';
foreach ($options as $option) {
    $i++;
    if ($i == 1) {
        $out = '<option value="" selected>%2$s</option>';
    } else {
        $out = '<option value="%1$s">%2$s</option>';
    }
    $string_options .= sprintf($out, $option, $option);
}
$output = sprintf($output, $string_options);

return $output;
