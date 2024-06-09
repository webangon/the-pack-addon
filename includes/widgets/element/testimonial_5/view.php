<?php

$slider_options = [
    'speed' => ($settings['auto'] ? $settings['speed']['size'] : ''),
    'auto' => ('yes' === $settings['auto']),
    'item' => ($settings['item'] ? $settings['item']['size'] : ''),
    'itemtab' => ($settings['itemtab'] ? $settings['itemtab']['size'] : ''),
    'fade' => ($settings['fade'] ? 'fade' : 'slide'),
];

$previkn = $settings['previkn'] ? '<div class="khbprnx khbnxt"><i class="' . $settings['previkn']['value'] . '"></i></div>' : '';
$nextikn = $settings['nextikn'] ? '<div class="khbprnx khbprev"><i class="' . $settings['nextikn']['value'] . '"></i></div>' : '';

$dots = $settings['arrow'] ? '' : '<div class="tp-arrow">' . $previkn . $nextikn . '</div>';

require dirname(__FILE__) . '/' . esc_attr($settings['tmpl']) . '.php';

?>

<style type="text/css">

    .testi5-container .name, .testi5-container .pos {
        margin: 0;
    }

    .testi5-container .tp-arrow {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100%;
        max-width: 1140px;
        transform: translate(-50%, -50%);
        margin: auto;
    }

    .testi5-container .khbprnx {
        position: absolute;
        top: 50%;
        width: 35px;
        height: 35px;
        line-height: 35px;
        text-align: center;
        font-size: 10px;
        cursor: pointer;
        opacity: 0;
        z-index: 1;
        -webkit-transition: all .5s;
        -moz-transition: all .5s;
        -o-transition: all .5s;
        transition: all .5s;
        display: flex !important;
        align-items: center;
        justify-content: center;
    }

    .testi5wrap .desc {
        background-color: #fff;
        text-align: center;
        position: relative;
        padding: 30px;
        border-radius: 5px;
        margin-top: 20px;
        -webkit-box-shadow: 0 3px 15px 2px rgba(0, 0, 0, .05);
        box-shadow: 0 3px 15px 2px rgba(0, 0, 0, .05);
    }

    .testi5-container:hover .khbprnx {
        opacity: 1;
    }

    .testi5-container .khbnxt {
        left: 0px;
    }

    .testi5-container .khbprev {
        right: 0px;
    }

    .testi5-container:hover .khbnxt {
        left: 10px;
    }

    .testi5-container:hover .khbprev {
        right: 10px;
    }

    .testi5wrap .slick-dots li button {
        display: block;
        margin: 0 3px;
        width: 8px;
        height: 8px;
        -webkit-border-radius: 8px;
        border-radius: 8px;
        background-color: #000;
        opacity: .5;
        -webkit-transition: all .3s cubic-bezier(.32, .74, .57, 1);
        -moz-transition: all .3s cubic-bezier(.32, .74, .57, 1);
        -ms-transition: all .3s cubic-bezier(.32, .74, .57, 1);
        -o-transition: all .3s cubic-bezier(.32, .74, .57, 1);
        transition: all .3s cubic-bezier(.32, .74, .57, 1);
    }

    .testi5wrap .slick-dots li.slick-active button {
        width: 20px;
        opacity: 1;

        border-radius: 5px;
        background: red;
        box-shadow: none;
    }


    .testi5-container .slick-list {
        margin: 0 -15px;
    }

    .testi5-container .slick-slide > div {
        padding: 0 15px;
    }

</style> 
  
 
