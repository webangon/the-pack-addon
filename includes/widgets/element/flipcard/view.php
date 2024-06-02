<?php
$animation = $settings['animation'];
//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped 
echo '<div class="flip-wraper1 tpoverflow">' . the_pack_html_escaped($this->content($settings['items'], $settings['animation'])) . '</div>';
?>


