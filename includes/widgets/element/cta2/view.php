<?php

$anim = $settings['anim'];
switch ($settings['tmpl']) {
    case 'one':
        $btn = '<ul class="tpfirst socials ' . $anim . '">' . $this->soicial($settings['items']) . '</ul><div class="tpsecond ' . $anim . '">' . thepack_build_html($settings['txt'], 'span', 'tbtxt') . '</div>';
        break;

    case 'two':
        $btn = '<div class="tpfirst ' . $anim . '">' . thepack_build_html($settings['txt'], 'span', 'tbtxt') . '</div><div class="tpsecond tpflexvertical ' . $anim . '">' . $this->button($settings['url'], $settings['btn']) . '</div>';
        break;

    case 'three':
        $btn = '<div class="tpfirst tpflexvertical ' . $anim . '">' . thepack_build_html($settings['txt'], 'span', 'tbtxt') . '</div><ul class="tpsecond tpimages ' . $anim . '">' . $this->imgs($settings['imgs']) . '</ul>';
        break;

    case 'four':
        $btn = '<div class="tpfirst tpflexvertical imagebox ' . $anim . '">' . $this->avatar_info($settings['avatr'], $settings['name'], $settings['pos']) . '</div><div class="tpsecond ' . $anim . '">' . $this->button($settings['url'], $settings['btn']) . '</div>';
        break;

    case 'five':
        $btn = '<div class="tpfirst tpflexvertical iconbox ' . $anim . '">' . $this->icon_info($settings['icon'], $settings['pre'], $settings['ttl']) . '</div><div class="tpsecond tpflexvertical avatarwrap ' . $anim . '">' . $this->avatar_info($settings['avatr'], $settings['name'], $settings['pos']) . '</div>';
        break;

    case 'six':
        $btn = '<div class="tpfirst tpflexvertical iconbox ' . $anim . '">' . $this->icon_info($settings['icon'], $settings['pre'], $settings['ttl']) . '</div><div class="tpsecond tpflexvertical avatarwrap ' . $anim . '">' . $this->avatar_info($settings['avatr'], $settings['name'], $settings['pos']) . '</div>';
        break;
}

?>
<div class="tpcta2">
    <div class="inner">
        <div class="tbcta2wrap">
            <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php echo thepack_build_html($btn); ?>
        </div>
    </div>
</div>
