<?php

$options = [
    'email' => encrypt_string($settings['emailto']),
    'success' => esc_attr($settings['success']),
    'fail' => esc_attr($settings['fail']),
    'error' => esc_attr($settings['error']),
    'subject' => esc_attr($settings['emailsub']),
];

$content = '';

foreach ($settings['form_fields'] as $item_index => $item) {
    switch ($item['field_type']) {
        case 'textarea':
            $content .= $this->generate_textarea_field($item);
            break;
        case 'select':
            $content .= $this->generate_select_field($item);
            break;
        case 'tel':
        case 'text':
        case 'email':
        case 'url':
        case 'number':
        case 'date':
        case 'time':
        case 'upload':
            $content .= $this->generate_input_field($item);
            break;
    }
}

$content = $settings['inlineform'] ? '<div class="tp-inline-form">' . $content . '</div>' : $content;
$icon_pos = $settings['lfticn'] ? 'left-icon' : 'right-icon';
$btnlbl = $settings['btn'] ? $settings['btn'] : '';
$bticon = $this->generate_icon($settings['btnik']);

?>

<?php echo '<form class="tp-contact-wrap ' . esc_attr($icon_pos) . '" data-xld =\'' . wp_kses_post(wp_json_encode($options)) . '\' novalidate>'; ?>
<?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
<?php echo $content; ?>
<div class='tp-form-btn'>
    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
    <button class="tbtr" type="submit"><span><?php echo thepack_build_html($btnlbl . $bticon); ?></span>
        <div class="loader"></div>
    </button>
</div> 
<div class="response"></div>
</form>