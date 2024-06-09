<ul class="tb_tlinealt">
    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php echo $this->content($settings['items'], $settings['anim']); ?>
</ul>

<style type="text/css">
    .tb_tlinealt {
        list-style: none;
        padding: 0px 0 0px;
        position: relative;
    }

    .tb_tlinealt:before {
        top: 0;
        bottom: 0;
        position: absolute;
        content: " ";
        width: 2px;
        background-color: #eee;
        left: 50%;
        margin-left: -1px;
    }

    .tb_tlinealt li {
        position: relative;
    }

    .tb_tlinealt li:before, .tb_tlinealt li:after {
        content: " ";
        display: table;
    }

    .tb_tlinealt li:after {
        clear: both;
    }

    .tb_tlinealt li:before, .tb_tlinealt li:after {
        content: " ";
        display: table;
    }

    /** timeline panels **/
    .tb_tlinealt li .timeline-panel {
        width: 46%;
        float: left;
        position: relative;
    }

    /** panel arrows **/

    .tb_tlinealt li.timeline-inverted .timeline-panel {
        float: right;
    }

    .tb_tlinealt li.timeline-inverted .timeline-panel:before {
        border-left-width: 0;
        border-right-width: 15px;
        left: -15px;
        right: auto;
    }

    .tb_tlinealt li.timeline-inverted .timeline-panel:after {
        border-left-width: 0;
        border-right-width: 14px;
        left: -14px;
        right: auto;
    }

    .tb_tlinealt li:not(.timeline-inverted) {
        text-align: right;
    }

    /** timeline circle icons **/
    .tb_tlinealt li .tl-circ {
        position: absolute;
        top: 0px;
        left: 50%;
        text-align: center;
        width: 60px;
        height: 60px;
        transform: translateX(-50%);
    }


    /** media queries **/
    @media (max-width: 991px) {
        .tb_tlinealt li .timeline-panel {
            width: 44%;
        }
    }

    @media (max-width: 700px) {

        .tb_tlinealt li:not(.timeline-inverted) {
            text-align: left;
        }

        .tb_tlinealt:before {
            left: 30px;
        }

        .tb_tlinealt li .timeline-panel {
            width: calc(100% - 90px);
            width: -moz-calc(100% - 90px);
            width: -webkit-calc(100% - 90px);
        }

        .tb_tlinealt li .tl-circ {
            top: 0px;
            left: 0px;
            transform: translateX(0);

        }

        .tb_tlinealt > li > .timeline-panel {
            float: right;
        }

        .tb_tlinealt > li > .timeline-panel:before {
            border-left-width: 0;
            border-right-width: 15px;
            left: -15px;
            right: auto;
        }

        .tb_tlinealt > li > .timeline-panel:after {
            border-left-width: 0;
            border-right-width: 14px;
            left: -14px;
            right: auto;
        }
    }
</style>