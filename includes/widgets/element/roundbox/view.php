<?php
$cimg = $settings['cimg']['id'] ? thepack_ft_images($settings['cimg']['id'], 'full') : '';
?>
<div class="tp-circlebox-inner">
    <div class="tp-circlebox">
        <div class="tp-circleboximg">
            <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php echo thepack_build_html($cimg); ?>
        </div>
        <ul class="tp-circlebox-out">
            <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php echo $this->content($settings['lists']); ; ?>
        </ul>
    </div>
</div>
<style type="text/css">
    .tp-circlebox ul {
        list-style: none;
        padding: 0;
        margin-top: 0;
    }

    .tp-circleboximg img {
        width: 100px;
    }

    .tp-circlebox {
        position: relative;
        width: 400px;
        height: 400px;
        border-radius: 50%;
        padding: 0;
        list-style: none;
        display: inline-block;
    }

    .tp-circleboximg {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border: 2px solid #eee;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .tp-circlebox > ul li {
        display: block;
        position: absolute;
        top: 50%;
        left: 50%;
        margin: -40px;
        width: 80px;
        height: 80px;
    }

    .tp-circlebox > ul li .inner {
        background-color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: .34s;
        overflow: hidden;
        animation-iteration-count: infinite;
        width: inherit;
        height: inherit;
    }

</style>    
