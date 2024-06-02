<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Utils;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class thepack_cta_2 extends Widget_Base
{
    public function get_name()
    {
        return 'tpcta2';
    }

    public function get_title()
    {
        return esc_html__('CTA 2', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-filter';
    }

    public function get_categories()
    {
        return ['ashelement-addons'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_heading',
            [
                'label' => esc_html__('Content', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'tmpl',
            [
                'label' => esc_html__('Template', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'one' => [
                        'title' => esc_html__('One', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'two' => [
                        'title' => esc_html__('Two', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-right',
                    ],
                    'three' => [
                        'title' => esc_html__('Three', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-right',
                    ],
                    'four' => [
                        'title' => esc_html__('Four', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-right',
                    ],
                    'five' => [
                        'title' => esc_html__('Five', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-right',
                    ],
                    'six' => [
                        'title' => esc_html__('Six', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'one',
            ]
        );

        $r = new \Elementor\Repeater();

        $r->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'the-pack-addon'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );

        $r->add_control(
            'url',
            [
                'label' => esc_html__('Social link url', 'the-pack-addon'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => esc_html__('http://your-link.com', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'items',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $r->get_controls(),
                'prevent_empty' => false,
                'condition' => [
                    'tmpl' => ['one'],
                ],
                'title_field' => '{{{ elementor.helpers.renderIcon( this, icon, {}, "i", "panel" ) || \'<i class="{{ icon }}" aria-hidden="true"></i>\' }}}',
            ]
        );

        $this->add_control(
            'imgs',
            [
                'label' => esc_html__('Thumbnails', 'the-pack-addon'),
                'type' => Controls_Manager::GALLERY,
                'condition' => [
                    'tmpl' => ['three'],
                ],
            ] 
        );

        $this->add_control(
            'avatr',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => esc_html__('Avatar', 'the-pack-addon'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tmpl' => ['four', 'five'],
                ],
            ]
        );

        $this->add_control(
            'name',
            [
                'label' => esc_html__('Name', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'condition' => [
                    'tmpl' => ['four', 'five'],
                ],
            ]
        );

        $this->add_control(
            'pos',
            [
                'label' => esc_html__('Position', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'condition' => [
                    'tmpl' => ['four', 'five'],
                ],
            ]
        );

        $this->add_control(
            'icon',
            [
                'type' => Controls_Manager::ICONS,
                'label' => esc_html__('Icon', 'the-pack-addon'),
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
                'condition' => [
                    'tmpl' => ['five'],
                ],
            ]
        );

        $this->add_control(
            'pre',
            [
                'label' => esc_html__('Pre title', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'condition' => [
                    'tmpl' => ['five'],
                ],
            ]
        );

        $this->add_control(
            'ttl',
            [
                'label' => esc_html__('Title', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'condition' => [
                    'tmpl' => ['five'],
                ],
            ]
        );

        $this->add_control(
            'txt',
            [
                'label' => esc_html__('Text', 'the-pack-addon'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'condition' => [
                    'tmpl' => ['one', 'two', 'three'],
                ],
            ]
        );

        $this->add_control(
            'btn',
            [
                'label' => esc_html__('Button label', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'condition' => [
                    'tmpl' => ['two', 'four'],
                ],
            ]
        );

        $this->add_control(
            'url',
            [
                'label' => esc_html__('Link', 'the-pack-addon'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => esc_html__('http://your-link.com', 'the-pack-addon'),
                'condition' => [
                    'tmpl' => ['two', 'four'],
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_html__('General', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__('Alignment', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'the-pack-addon'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tpcta2' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gsp',
            [
                'label' => esc_html__('Inner spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tpsecond' => 'padding-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tpfirst' => 'padding-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gtcsp',
            [
                'label' => esc_html__('Mobile top spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tpsecond' => 'padding-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_btn',
            [
                'label' => esc_html__('Button', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tmpl' => ['two', 'four'],
                ],
            ]
        );

        $this->add_control(
            'btpad',
            [
                'label' => esc_html__('Padding', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tpbtn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btyp',
                'selector' => '{{WRAPPER}} .tpbtn',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'btbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tpbtn' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tpbtn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bthbg',
            [
                'label' => esc_html__('Hover background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tpbtn:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bthclr',
            [
                'label' => esc_html__('Hover color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tpbtn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btbdr',
                'selector' => '{{WRAPPER}} .tpbtn',
                'label' => esc_html__('Border', 'the-pack-addon'),
            ]
        );

        $this->add_responsive_control(
            'btrd',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['%', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .tpbtn' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_gallry',
            [
                'label' => esc_html__('Gallery', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tmpl' => ['three'],
                ],
            ]
        );

        $this->add_responsive_control(
            'glwd',
            [
                'label' => esc_html__('Width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tpimages img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'glbrad',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tpimages img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'glmspc',
            [
                'label' => esc_html__('Item spacing(negative)', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tpimages li' => 'margin:0px -{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_iconbx',
            [
                'label' => esc_html__('Iconbox', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tmpl' => ['five'],
                ],
            ]
        );

        $this->add_control(
            'ibxbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .iconbox .avatar' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ibxclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .iconbox .avatar' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ibhxbg',
            [
                'label' => esc_html__('Hover background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .iconbox .avatar:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ibhxclr',
            [
                'label' => esc_html__('Hover color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .iconbox .avatar:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_singimg',
            [
                'label' => esc_html__('Image', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tmpl' => ['four', 'five'],
                ],
            ]
        );

        $this->add_responsive_control(
            'gmxbckl',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .imagebox .info' => 'border-left:1px solid {{VALUE}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'simrp',
            [
                'label' => esc_html__('Right spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .avatarwrap .info' => 'padding-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .imagebox .info' => 'padding-left: {{SIZE}}{{UNIT}};margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .iconbox .info' => 'padding-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'simgwd',
            [
                'label' => esc_html__('Width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 300,
                        'min' => 1,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .avatar img' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .iconbox .avatar' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',

                ],
            ]
        );

        $this->add_responsive_control(
            'simgbrd',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .avatar img,{{WRAPPER}} .iconbox .avatar' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sittyp',
                'selector' => '{{WRAPPER}} .info .name',
                'label' => esc_html__('Title typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'sittclr',
            [
                'label' => esc_html__('Title color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .info .name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'sitmrg',
            [
                'label' => esc_html__('Title margin', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .info .name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sisbtyp',
                'selector' => '{{WRAPPER}} .info .pos',
                'label' => esc_html__('Position typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'sisbtclr',
            [
                'label' => esc_html__('Position color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .info .pos' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_txt',
            [
                'label' => esc_html__('Text', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tmpl' => ['one', 'two', 'three'],
                ],
            ]
        );

        $this->add_responsive_control(
            'talg',
            [
                'label' => esc_html__('Alignment', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'the-pack-addon'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'the-pack-addon'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tbtxt' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ttyp',
                'selector' => '{{WRAPPER}} .tbtxt',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'sbtitle_color',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tbtxt' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_soci',
            [
                'label' => esc_html__('Social Icon', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tmpl' => ['one'],
                ],
            ]
        );

        $this->add_responsive_control(
            'sowh',
            [
                'label' => esc_html__('Width & height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .socials .equalheightwidth' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'soispv',
            [
                'label' => esc_html__('Item spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .socials li' => 'padding:0px {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .socials' => 'margin-left:-{{SIZE}}{{UNIT}};margin-right:-{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'sobard',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .socials .equalheightwidth' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'sofs',
            [
                'label' => esc_html__('Font size', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .socials .equalheightwidth' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'sobdk',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .socials .equalheightwidth' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'soclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .socials .equalheightwidth' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'sobg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .socials .equalheightwidth' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'sohclr',
            [
                'label' => esc_html__('Hover color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .socials .equalheightwidth:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'sohbg',
            [
                'label' => esc_html__('Hover background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .socials .equalheightwidth:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();
        require dirname(__FILE__) . '/view.php';
    }

    private function soicial($content)
    {
        $out = '';
        foreach ($content as $item) {
            $url = thepack_get_that_link($item['url']);
            $icon = $item['icon']['value'] ? '<i class="' . $item['icon']['value'] . '"></i>' : '';
            $out .= '<li><a class="equalheightwidth" ' . $url . '>' . $icon . '</a></li>';
        }

        return $out;
    }

    private function button($link, $label)
    {
        $url = thepack_get_that_link($link);
        $btn = $label ? '<a class="tpbtn" ' . $url . '>' . $label . '</a>' : '';

        return $btn;
    }

    private function imgs($img)
    {
        $out = '';
        foreach ($img as $item) {
            $out .= '<li>' . thepack_ft_images($item['id'], 'full') . '</li>';
        }

        return $out;
    }

    private function avatar_info($img, $name, $pos)
    {
        $namef = $name ? '<h2 class="name">' . $name . '</h2>' : '';
        $posf = $pos ? '<span class="pos">' . $pos . '</span>' : '';

        $out = '
            <div class="avatar">
                ' . thepack_ft_images($img['id'], 'full') . '
            </div>
            <div class="info">
                ' . $namef . $posf . '
            </div>
        ';

        return $out;
    }

    private function icon_info($icon, $name, $pos)
    {
        $namef = $name ? '<h2 class="name">' . $name . '</h2>' : '';
        $posf = $pos ? '<span class="pos">' . $pos . '</span>' : '';
        $icon = $icon['value'] ? '<i class="' . $icon['value'] . '"></i>' : '';

        $out = '
            <div class="info">
                ' . $namef . $posf . '
            </div>
            <div class="avatar">
                ' . $icon . '
            </div>
        ';

        return $out;
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_cta_2());
