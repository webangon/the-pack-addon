<?php

$out = '';
foreach ($settings['items'] as $item) {
    $desc = thepack_build_html($item['desc'], 'p', 'desc');
    $img = wp_get_attachment_image($item['avatar']['id'], 'full', false, ['class' => 'xlteam']);
    $name = thepack_build_html($item['name'], 'p', 'name');
    $pos = thepack_build_html($item['pos'], 'p', 'pos');

    $out .= '
          <div class="items-wrap">
          ' . $desc . '
            <div class="inr">
              <div class="tbl-wrap">
                <div class="table-display">
                    <div class="thumb col">
                    ' . $img . '
                    </div>

                    <div class="info col">
                        ' . $name . $pos . '
                    </div>
                </div>
              </div>
            </div>
          </div>

      ';
}

?>

<?php echo '<div class="testi5-container" data-xld =\'' . wp_json_encode($slider_options) . '\'>'; ?>
<div style="display:none" class="testi5wrap style-one">
  <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php echo thepack_build_html($out); ?>
</div>
<!-- Add Pagination -->
<?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
<?php echo thepack_build_html($dots); ?>
</div>



