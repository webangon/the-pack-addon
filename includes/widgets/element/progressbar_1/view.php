<?php

$animation = $settings['animation'];

switch ($settings['tmpl']) {
    case 'one':
        $cls = 'bar-progress-wrap';
        break;

    case 'two':
        $cls = 'bar-progress-wrap1';
        break;

    case 'three':
        $cls = 'bar-progress-wrap2';
        break;

    default:
}

?>
<div class="bar-progress-wrap">
    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php echo the_pack_html_escaped($this->content($settings['items'], $settings['tmpl'], $animation)); ?>
</div>


<style type="text/css">

    .bar-progress {
        position: relative;
        font-size: 0.8em;
        color: #000;
        margin-bottom: 20px;
    }

    .bar-progress:last-child {
        margin-bottom: 0;
    }

    .bar-label {
        font-size: 1.6rem;
        color: #000;
        text-transform: none;
        text-align: left;
    }

    .bar-percentage {
        margin: 0 auto;
        position: absolute;
        top: 0.4rem;
        right: 0;
    }

    .bar-container {
        width: 100%;
        overflow: hidden;
        background: #EFEFEF;
    }

    .bar {
        float: left;
        background: #000;
        height: 1px;
    }

    .bar-percentage.tri:after {
        content: '';
        background: inherit;
        width: 8px;
        height: 8px;
        position: absolute;
        bottom: -4px;
        right: 50%;
        -webkit-transform: translateX(50%) rotate(45deg);
        -ms-transform: translateX(50%) rotate(45deg);
        transform: translateX(50%) rotate(45deg);
    }

</style>
  
 
