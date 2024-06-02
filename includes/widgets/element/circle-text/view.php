<?php

?>

<div class="tp-circle-text">
	<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" preserveAspectRatio="xMaxYMid meet" viewBox="0 0 300 300" enable-background="new 0 0 300 300" xml:space="preserve">
		<defs>
			<path id="circlePath" d="M 150, 150 m -60, 0 a 60,60 0 0,1 120,0 a 60,60 0 0,1 -120,0 "/>
		</defs>
		<g>
			<use xlink:href="#circlePath" fill="none"/>
			<text>
				<textPath xlink:href="#circlePath"><?php echo esc_attr($settings['text']);?></textPath>
			</text>
		</g>
	</svg>
</div>

<style>

.tp-circle-text svg {

          animation-name: tp-rotate;
          animation-duration: 5s;
          animation-timing-function: linear;
		  animation-iteration-count: infinite;

}

</style>