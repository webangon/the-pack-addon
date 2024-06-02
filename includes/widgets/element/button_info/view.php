<div class="xldappbtn">
    <div class="inner">
        <div class="tp-flex-equal">
            <div class="tp-col tp-btn">
                <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                <a <?php echo thepack_get_that_link($settings['flink']); ?> ><?php echo thepack_build_html($settings['flbl']); ?></a>
            </div>
            <div class="tp-col tp-info">
                <span class="pre">
                    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    <a <?php echo thepack_get_that_link($settings['slink']);?> ><?php echo thepack_build_html($settings['slbl']); ?></a>
                </span>
                    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    <?php echo thepack_build_html($settings['slsbl'], 'span', 'title'); ?>
            </div>
        </div>
    </div>
</div>
