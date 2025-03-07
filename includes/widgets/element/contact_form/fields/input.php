<?php

switch ($element['field_type']) {
    case 'number':
        $field_tyle = 'number';
        break;
    case 'tel':
        $field_tyle = 'tel';
        break;
    case 'text':
        $field_tyle = 'text';
        break;
    case 'email':
        $field_tyle = 'email';
        break;
    case 'url':
        $field_tyle = 'url';
        break;
    case 'password':
        $field_tyle = 'password';
        break;
    case 'file':
        $field_tyle = 'password';
        break;
    case 'hidden':
        $field_tyle = 'hidden';
        break;
    case 'date':
        $field_tyle = 'date';
        break;
    case 'time':
        $field_tyle = 'time';
        break;
    case 'upload':
        $field_tyle = 'file';
        break;
    case 'search':
}

$data = [
    'id' => $element['_id'],
    'type' => $field_tyle,
    'required' => $element['required'],
];

$icon = $this->generate_icon($element['icon']);

$output = '
   <div data-xld =\'' . wp_json_encode($data) . '\' class="item elementor-repeater-item-' . $element['_id'] . '">' . $icon . '<span class="tp-label">' . $element['field_label'] . '</span><input class="tp-input" name="' . $element['field_label'] . '" type="' . $field_tyle . '"  placeholder="' . $element['placeholder'] . '" ></div>';

return $output; 
