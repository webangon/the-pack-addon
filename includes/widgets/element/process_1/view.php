<?php

$anim = $settings['anim'];
?>

<div class="tb-process-1 tpoverflow">
    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php echo the_pack_html_escaped($this->content($settings['items'], $anim)); ?>
</div>

<style type="text/css">

    .tb-process-1 .gridwrap {
        width: 25%;
        padding: 20px;
        text-align: center;
    }

    .tb-process-1 .tb-process {
        position: relative;
    }

    .tb-process-1 .gridwrap:not(:last-child) .tb-process:before {
        display: block;
        width: 64%;
        height: 1px;
        position: absolute;
        content: '';
        border-bottom: 1px solid #eee;
        top: 5px;
        left: 74%;
    }

    .tb-process-1 .number {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        width: 40px;
        height: 40px;
        background: bisque;
    }

    .tb-process-1 .numwrap {
        display: flex;
        justify-content: center;
    }

    .tb-process-1 .tb-process:hover .number {
        transform: translateY(-5px);
    }

    .tb-process-1 .tb-process .number {
        transition-duration: .35s;
        transition-property: transform;
        transition-timing-function: ease-out;
    }

    .tb-process-1 .inner {
        -webkit-transition: all 0.2s;
        -moz-transition: all 0.2s;
        -o-transition: all 0.2s;
        -ms-transition: all 0.2s;
        transition: all 0.2s;
    }

</style>