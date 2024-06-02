<?php

function encrypt_string($input)
{
    $inputlen = strlen($input);
    $randkey = wp_rand(1, 9);
    $i = 0;
    while ($i < $inputlen) {
        $inputchr[$i] = (ord($input[$i]) - $randkey);
        $i++;
    }
    $encrypted = implode('.', $inputchr) . '.' . (ord($randkey) + 50);

    return $encrypted;
}

function decrypt_string($input) 
{
    $input_count = strlen($input);
    $dec = explode('.', $input);
    $x = count($dec);
    $y = $x - 1;
    $calc = $dec[$y] - 50;
    $randkey = chr($calc);
    $i = 0;
    $real = '';
    while ($i < $y) {
        $array[$i] = $dec[$i] + $randkey;
        $real .= chr($array[$i]);
        $i++;
    };

    $input = $real;

    return $input;
}

add_action('wp_ajax_tp_process_form', 'tp_process_contact_form');
add_action('wp_ajax_nopriv_tp_process_form', 'tp_process_contact_form');

function tp_process_contact_form() 
{   
    $data_mess = [];
    $msg_error = $body_msg = '';

    if ( ! wp_verify_nonce( sanitize_text_field(wp_unslash($_POST['nonce'])), 'ajax-nonce' ) ) {
        wp_die();
    } 
    
    foreach ( $_POST['data'] as $item ) {
        $required = isset($item['required']) && empty($item['value']) ? 'yes' : '';

        if (isset($item['type']) == 'email') {
            $msg_error .= filter_var($item['value'], FILTER_VALIDATE_EMAIL) ? '' : 'yes';
        //$required = 'yes';
        } else {
            $msg_error .= isset($item['required']) && empty($item['value']) ? 'yes' : '';
        }

        $placeholder = isset($item['placeholder'])&& empty($item['placeholder']) ? $item['placeholder'] : '';
        $value = isset($item['value'])&& empty($item['value']) ? $item['value'] : '';
        $data_mess[] = [

            'id' => isset($item['id'])&& empty($item['id']) ? $item['id'] : '',
            'required' => $required,
            'type' => isset($item['type'])&& empty($item['type']) ? $item['type'] : '',
            'placeholder' => $placeholder,
            'value' => $value ,

        ];

        $body_msg .= '<p><b>' . $placeholder . '</b>:' . $value . '</p>';

        $to_email = isset($item['to']) ? $item['to'] : '';
        $subject_mail = isset($item['subject']) ? $item['subject'] : '';
        $success_msg = isset($item['success_msg']) ? $item['success_msg'] : '';
        $error_msg = isset($item['error_msg']) ? $item['error_msg'] : '';
        $fail_msg = isset($item['fail_msg']) ? $item['fail_msg'] : '';
    }

    if ($msg_error) {
        $data_mess['error'] = $error_msg;
    } else {
        $toemails = decrypt_string($to_email);
        $to = explode(',', $toemails);
        $subject = $subject_mail;
        $body = $body_msg;
        $headers[] = 'Content-Type: text/html; charset=UTF-8';

        if (wp_mail($to, $subject, $body, $headers)) {
            $data_mess['success'] = $success_msg;
        } else {
            $data_mess['fail'] = $fail_msg;
        }
    }

    //echo '<pre>' . var_export($data_mess, true) . '</pre>';
    header('Content-type: application/json');
    echo wp_json_encode($data_mess);
    exit();
}
