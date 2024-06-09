<div class="tb-tour_mini">
    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php echo $this->content($settings['items'], $settings['animation']); ?>
</div>

<style type="text/css">

    .tb-tour_mini .event-wrap {
        display: flex;
        align-items: flex-start;
    }

    .tb-tour_mini .date-wrap {
        display: flex;
        flex-flow: column;
        align-items: center;
        line-height: 1;
        padding: 20px;
        margin-right: 20px;
    }

    .tb-tour_mini .event-body {
        flex: 1;
    }

    .tb-tour_mini .title {
        margin: 0px;
    }

</style>

