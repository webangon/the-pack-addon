<?php

$options = [
    'size' => $settings['num']['size'] ? esc_attr($settings['num']['size']) : '30',
    'pre' => $settings['pre'] ? esc_attr($settings['pre']) : '%',
    'pclr' => $settings['mclr'] ? esc_attr($settings['mclr']) : '#fff',
    'sclr' => $settings['sclr'] ? esc_attr($settings['sclr']) : '#fff',
    'thk' => $settings['thk']['size'] ? esc_attr($settings['thk']['size']) : '10',
    'ethk' => $settings['ethk']['size'] ? esc_attr($settings['ethk']['size']) : '5',
];

$pre = $settings['pre'] ? '<div class="circle"><strong class="num"><span>' . $settings['pre'] . '</span></strong></div>' : '';
$title = $settings['title'] ? '<h3 class="title">' . $settings['title'] . '</h3>' : '';
$desc = $settings['desc'] ? '<p class="desc">' . $settings['desc'] . '</p>' : '';
$out = '
		<div data-options=\'' . wp_kses_post(wp_json_encode($options)) . '\' data-size="' . esc_attr($settings['num']['size']) . '" data-prefix="' . esc_attr($settings['pre']) . '" class="client_counterup ' . esc_attr($settings['tmpl']) . '">
			<div class="counter_up">
				' . $pre . '
			</div>
			<div class="client_countertext">
				' . $title . $desc . '
			</div>
		</div>
    ';

?>

<div class="tp-circle-counter">
    <div class="counter_content"> 
        <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped?>
		<?php echo thepack_build_html($out); ?>
    </div>
</div>

<style type="text/css">
    .tp-circle-counter .circle canvas {
        width: 100%;
    }

    .tp-circle-counter .circle {
        position: relative;
        display: inline-block;
    }

    .tp-circle-counter .num {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        -webkit-transform: translate(-50%, -50%);
        -moz-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
    }

    .tp-circle-counter .two {
        display: flex;
    }

    .tp-circle-counter .prefix {
        position: relative;
    }

    .tp-circle-counter .two .client_countertext {
        align-items: center;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: center;
        align-self: center;
    }

    .tp-circle-counter .desc {
        margin: 0px;
    }
</style>