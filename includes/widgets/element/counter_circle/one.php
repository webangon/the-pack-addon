<?php

$options = [
    'size' => $settings['num']['size'] ? $settings['num']['size'] : '30',
    'pre' => $settings['pre'] ? $settings['pre'] : '%',
    'pclr' => $settings['mclr'] ? $settings['mclr'] : '#fff',
    'sclr' => $settings['sclr'] ? $settings['sclr'] : '#fff',
    'thk' => $settings['thk']['size'] ? $settings['thk']['size'] : '10',
    'ethk' => $settings['ethk']['size'] ? $settings['ethk']['size'] : '5',
];

$pre = $settings['pre'] ? '<div class="circle"><strong class="num"><span>' . $settings['pre'] . '</span></strong></div>' : '';
$title = $settings['title'] ? '<h3 class="title">' . $settings['title'] . '</h3>' : '';
$desc = $settings['desc'] ? '<p class="desc">' . $settings['desc'] . '</p>' : '';
$out = '
		<div data-options=\'' . wp_json_encode($options) . '\' data-size="' . $settings['num']['size'] . '" data-prefix="' . $settings['pre'] . '" class="client_counterup ' . $settings['tmpl'] . '">
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