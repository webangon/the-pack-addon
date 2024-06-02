<?php
if ($element['required']) {
    $required = 'required="required"';
    $required_icon = '*';
}
$data = [
    'id' => $element['_id'],
    'type' => 'textarea',
    'required' => $element['required'],
];
$icon = $this->generate_icon($element['icon']);

return '<div data-xld =\'' . wp_json_encode($data) . '\' class="item elementor-repeater-item-' . $element['_id'] . '">' . $icon . '<span class="tp-label">' . $element['field_label'] . '</span><textarea class="tp-input" name="' . $element['field_label'] . '" placeholder="' . $element['placeholder'] . '" ></textarea></div>';
