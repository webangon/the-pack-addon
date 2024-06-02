<?php
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Element_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Tp_Pro_Widget_Notice
{
    /**
     * Initialize
     *
     * @since 1.0.0
     *
     * @access public
     */
    public static function init()
    {
        add_action('elementor/element/common/_section_style/after_section_end', [
            __CLASS__,
            'tp_element_translate'
        ], 99, 2);
    }

    public static function tp_element_translate($element, $args)
    {  

        if (class_exists('The_Pack_Pro')) {
            return;
        }

        $element->start_controls_section(
            'section_pro_widget',
            [
                'label' => esc_html__('The Pack Pro | Start Only $19!!', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        ); 

        $element->add_control(
            'mgpl__pro',
            [
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' =>'
        <div class="elementor-nerd-box">
            <img class="elementor-nerd-box-icon" src="'.esc_url(ELEMENTOR_ASSETS_URL . 'images/go-pro.svg').'" />
            <div class="elementor-nerd-box-title">'.esc_html__('Get All Pro Features','the-pack-addon').'</div>
            <div class="elementor-nerd-box-message">'.esc_html__('Unlock all pro templates, Pages, blocks and widgets. Upgrade pro to fully recharge your Elementor page builder','the-pack-addon').'</div>
                <a class="elementor-nerd-box-link elementor-button elementor-button-default elementor-button-go-pro" href="https://webangon.com/#pro" target="_blank">
                    '.esc_html__('UPGRADE NOW','the-pack-addon').'
                </a>
        </div>
                ',
            ]
        );

        $element->end_controls_section();
    }
}

Tp_Pro_Widget_Notice::init();