<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class The_Pack_Contact_Form extends Widget_Base
{
    public function get_name()
    {
        return 'tp-contact';
    } 

    public function get_title()
    {
        return esc_html__('Contact Form', 'the-pack-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-admin-users';
    }

    public function get_categories()
    {
        return ['ashelement-addons'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Controlls', 'the-pack-addon'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $field_types = [
            'text' => esc_html__('Text', 'the-pack-addon'),
            'textarea' => esc_html__('Textarea', 'the-pack-addon'),
            'url' => esc_html__('URL', 'the-pack-addon'),
            'tel' => esc_html__('Tel', 'the-pack-addon'),
            'email' => esc_html__('Email', 'the-pack-addon'),
            'select' => esc_html__('Select', 'the-pack-addon'),
        ];

        $repeater->add_control(
            'field_type',
            [
                'label' => esc_html__('Type of Field', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT2,
                'options' => $field_types,
                'label_block' => true,
                'default' => 'text',
            ]
        );

        $repeater->add_control(
            'placeholder',
            [
                'label' => esc_html__('Placeholder', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '',
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'the-pack-addon'),
                'type' => Controls_Manager::ICONS,
                'condition' => [
                    'field_type' => ['tel', 'text', 'email', 'textarea', 'number', 'url']
                ],
            ]
        );

        $repeater->add_control(
            'required',
            [
                'label' => esc_html__('Is Required', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'field_type',
                            'operator' => '!in',
                            'value' => [
                                'radio',
                            ],
                        ],
                    ],
                ],
            ]
        );

        $repeater->add_control(
            'field_options',
            [
                'label' => esc_html__('Options', 'the-pack-addon'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'description' => esc_html__('Enter each option in a separate line. To differentiate between label and value, separate them with a pipe char ("|"). For example: First Name|f_name', 'the-pack-addon'),
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'field_type',
                            'operator' => 'in',
                            'value' => [
                                'select',
                                'radio',
                            ],
                        ],
                    ],
                ],
            ]
        );

        $repeater->add_control(
            'field_label_h',
            [
                'label' => esc_html__('Label', 'the-pack-addon'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'field_label',
            [
                'label' => esc_html__('Field Name(label)', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'show_label',
            [
                'label' => esc_html__('Label', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'the-pack-addon'),
                'label_off' => esc_html__('Hide', 'the-pack-addon'),
                'return_value' => 'true',
                'default' => 'true',
                'dynamic' => [
                    'active' => true,
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'field_type',
                            'operator' => '!in',
                            'value' => [
                                'radio',
                                'checkbox',
                            ],
                        ],
                    ],
                ],
                'selectors' => [ 
                    '{{WRAPPER}} {{CURRENT_ITEM}} .tp-label' => 'display: none;',
                ],                
            ]
        );

        $repeater->add_responsive_control(
            'wid',
            [
                'type' => Controls_Manager::SLIDER,
                'label' => esc_html__('Width', 'the-pack-addon'),
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'flex: 0 0 {{SIZE}}%;-webkit-flex: 0 0 {{SIZE}}%;width:{{SIZE}}%;',
                ],
            ]
        );

        $this->add_control(
            'form_fields',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ field_type }}}',
            ]
        );

        $this->add_control(
            'btn',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Button label', 'the-pack-addon'),
                'label_block' => true,
                'default' => esc_html__('Submit', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'btnik',
            [
                'type' => Controls_Manager::ICONS,
                'label' => esc_html__('Button icon', 'the-pack-addon'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_msg',
            [
                'label' => esc_html__('Message', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'emailto',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label' => esc_html__('Mail recipient', 'the-pack-addon'),
                'description' => esc_html__('For multiple recipient use comma eg a@mail.com,b@mail.com', 'the-pack-addon'),
                'label_block' => true,
                'default' => esc_html__('admin@mail.com', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'emailsub',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label' => esc_html__('Mail subject', 'the-pack-addon'),
                'description' => esc_html__('Email subject header', 'the-pack-addon'),
                'label_block' => true,
                'default' => esc_html__('Contact from my site', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'success',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label' => esc_html__('Success message', 'the-pack-addon'),
                'label_block' => true,
                'default' => esc_html__('Thank you for contacting us, we will get back to you shortly.', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'fail',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label' => esc_html__('Fail message', 'the-pack-addon'),
                'label_block' => true,
                'default' => esc_html__('Something went wrong.Please try again', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'error',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label' => esc_html__('Error message', 'the-pack-addon'),
                'label_block' => true,
                'default' => esc_html__('Please enter correct information.', 'the-pack-addon'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_gnrl',
            [
                'label' => esc_html__('General', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'lfticn',
            [
                'label' => esc_html__('Left icon', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'inlineform',
            [
                'label' => esc_html__('Inline form', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_responsive_control(
            'lrspc',
            [
                'type' => Controls_Manager::SLIDER,
                'label' => esc_html__('Left-right spacing', 'the-pack-addon'),
                'selectors' => [
                    '{{WRAPPER}} .item,{{WRAPPER}} .tp-form-btn' => 'padding-left:{{SIZE}}{{UNIT}};padding-right:{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tp-contact-wrap' => 'margin-left:-{{SIZE}}{{UNIT}};margin-right:-{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'btspc',
            [
                'type' => Controls_Manager::SLIDER,
                'label' => esc_html__('Bottom spacing', 'the-pack-addon'),
                'selectors' => [
                    '{{WRAPPER}} .item' => 'margin-bottom:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_label',
            [
                'label' => esc_html__('Label', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'lbl_typ',
                'selector' => '{{WRAPPER}} .tp-label',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_responsive_control(
            'lblclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'lbvsp',
            [
                'label' => esc_html__('Vertical spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-label' => 'top: {{SIZE}}{{UNIT}};position:relative;',
                ],

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_input',
            [
                'label' => esc_html__('Input', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'inpbdr',
            [
                'label' => esc_html__('Border', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .item select,{{WRAPPER}} .item input,{{WRAPPER}} .item textarea' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};border-style:solid;',
                ],
            ]
        );

        $this->add_responsive_control(
            'inrbdr',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .item select,{{WRAPPER}} .item input,{{WRAPPER}} .item textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'inpkrl',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item select,{{WRAPPER}} .item input,{{WRAPPER}} .item textarea' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .item ::placeholder' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'inpad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .item input,{{WRAPPER}} .item textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'intxht',
            [
                'label' => esc_html__('Textarea height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ]
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .item textarea' => 'height: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'inpty',
                'selector' => '{{WRAPPER}} .item input,{{WRAPPER}} .item textarea,{{WRAPPER}} .item select',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->start_controls_tabs('intb');

        $this->start_controls_tab(
            'intb1',
            [
                'label' => esc_html__('Normal', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'inbdckr',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item select,{{WRAPPER}} .item input,{{WRAPPER}} .item textarea' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'inbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item input,{{WRAPPER}} .item textarea,{{WRAPPER}} .item select' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'intb2',
            [
                'label' => esc_html__('Error', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'einbdckr',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item select.error,{{WRAPPER}} .item input.error,{{WRAPPER}} .item textarea.error' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'einbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item input.error,{{WRAPPER}} .item textarea.error,{{WRAPPER}} .item select.error' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_slect',
            [
                'label' => esc_html__('Select', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'selpad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .item select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_icon',
            [
                'label' => esc_html__('Icon', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'ikvsp',
            [
                'label' => esc_html__('Vertical spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .item i' => 'top: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'ikhsp',
            [
                'label' => esc_html__('Horizontal spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .left-icon .item i' => 'left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .right-icon .item i' => 'right: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'ikfs',
            [
                'label' => esc_html__('Font size', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .item i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'ikclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_emsg',
            [
                'label' => esc_html__('Message', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'mtsp',
            [
                'label' => esc_html__('Top spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .response' => 'top: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'mrsp',
            [
                'label' => esc_html__('Right spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .response' => 'right: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'msclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .response' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'msbdclr',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .response p' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'mspad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .response p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'msty',
                'selector' => '{{WRAPPER}} .response p',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'mserbg',
            [
                'label' => esc_html__('Error background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .response .error' => 'background:{{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mssukbg',
            [
                'label' => esc_html__('Success background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .response .success' => 'background:{{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'msflbg',
            [
                'label' => esc_html__('Fail background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .response .fail' => 'background:{{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'msbxd',
                'selector' => '{{WRAPPER}} .response p',
                'label' => esc_html__('Box shadow', 'the-pack-addon'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_btn',
            [
                'label' => esc_html__('Button', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'btal',
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
                    '{{WRAPPER}} .tp-form-btn' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'btwid',
            [
                'label' => esc_html__('Width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 800,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tp-form-btn button' => 'max-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tp-inline-form + .tp-form-btn' => 'flex: 0 0 {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'btbrd',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .tp-form-btn button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'btbwd',
            [
                'label' => esc_html__('Border width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tp-form-btn button' => 'border-width: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'btpad',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .tp-form-btn button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'bttyp',
                'selector' => '{{WRAPPER}} .tp-form-btn button',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_responsive_control(
            'btispe',
            [
                'label' => esc_html__('Icon spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-form-btn span i' => 'padding-left: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->start_controls_tabs('btnl');

        $this->start_controls_tab(
            'btn1',
            [
                'label' => esc_html__('Normal', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'btnnbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-form-btn button' => 'background:{{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btnnclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-form-btn button' => 'color:{{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btnnbdclr',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-form-btn button' => 'border-color:{{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'btn2',
            [
                'label' => esc_html__('Hover', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'hbtnnbg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-form-btn button:hover' => 'background:{{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hbtnnclr',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-form-btn button:hover' => 'color:{{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hbtnnbdclr',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-form-btn button:hover' => 'border-color:{{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'btn3',
            [
                'label' => esc_html__('Loader', 'the-pack-addon'),
            ]
        );

        $this->add_responsive_control(
            'ldwd',
            [
                'label' => esc_html__('Width & height', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .loader' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'ldtsp',
            [
                'label' => esc_html__('Top position', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 800,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .loader' => 'top: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'ldlp',
            [
                'label' => esc_html__('Left position', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 800,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .loader' => 'left: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'ldthmcl',
            [
                'label' => esc_html__('Theme color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .loader' => 'border-right-color:{{VALUE}};border-top-color:{{VALUE}};border-bottom-color:{{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();
        require dirname(__FILE__) . '/view.php';
    }

    protected function generate_textarea_field($element)
    {
        if (empty($element)) {
            return '';
        }
        $output = include 'fields/textarea.php';

        return $output;
    }

    protected function generate_icon($element)
    {
        if (empty($element)) {
            return '';
        }

        return thepack_icon_svg($element);
    }

    protected function generate_select_field($element)
    {
        if (empty($element)) {
            return '';
        }
        $output = include 'fields/select.php';

        return $output;
    }

    protected function generate_input_field($element)
    {
        if (empty($element)) {
            return '';
        }
        $output = include 'fields/input.php';

        return $output;
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\The_Pack_Contact_Form());
