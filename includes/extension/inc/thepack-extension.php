<?php
use Elementor\Plugin;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;

    class The_Pack_Settings extends \Elementor\Core\Kits\Documents\Tabs\Tab_Base {

        public function get_id() {
            return 'the-pack-settings';
        }

        public function get_title() {
            return 'The Pack Extra';
        }
 
        public function get_icon() {
            return 'eicon-logo';
        }

        protected function register_tab_controls() {

            $this->start_controls_section(
                'tp_general',
                [
                    'label' => 'General',
                    'tab' => $this->get_id(),
                ]
            );

            $this->add_control(
                'popbg',
                [
                    'label' => esc_html__('Popup overlay background', 'the-pack-addon'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '.tp-pop-response' => 'background:{{VALUE}};',
                    ],                    
                ]
            );

            $this->end_controls_section();

            $this->start_controls_section(
                'the-pack-settings',
                [
                    'label' => esc_html__('Fixed share', 'the-pack-addon'),
                    'tab' => $this->get_id(),
                ]
            );

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'icon',
                [
                    'type' => Controls_Manager::ICONS,
                    'label' => esc_html__('Social Icon', 'the-pack-addon'),
                    'label_block' => true,
                    
                ]
            );

            $repeater->add_control(
                'vendor',
                [
                    'type' => Controls_Manager::SELECT,
                    'label' => esc_html__('Vendor', 'the-pack-addon'),
                    'label_block' => true,
                    'default'=> 'facebook',
                    'options' => [
                        'facebook' => esc_html__('Facebook', 'the-pack-addon'),
                        'twitter' => esc_html__('Twitter', 'the-pack-addon'),
                        'linkedin' => esc_html__('Linkedin', 'the-pack-addon'),
                        'pinterest' => esc_html__('Pinterest', 'the-pack-addon'),
                        'email' => esc_html__('Email', 'the-pack-addon'),
                        'whatsapp' => esc_html__('Whatsapp', 'the-pack-addon'),
                        'telegram' => esc_html__('Telegram', 'the-pack-addon'),
                    ],                    
                ]
            );

            $this->add_control( 
                'tp_fshare',
                [
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'title_field' => '{{{ elementor.helpers.renderIcon( this, icon, {}, "i", "panel" ) || \'<i class="{{ icon }}" aria-hidden="true"></i>\' }}}',
                    'prevent_empty' => false,
                ]
            );

            $this->add_responsive_control(
                'tpfshr_z',
                [
                    'label' => esc_html__('Z index', 'the-pack-addon'),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 30,
                    ],  
                    'range' => [
                        'px' => [
                            'max' => 8000,
                        ],
                    ],                                      
                    'selectors' => [
                        '.tp-site-share' => 'z-index: {{SIZE}};',
                    ],   
                ]
            );

            $this->end_controls_section();

            $this->start_controls_section(
                'tp_cursorprogress_section',
                [
                    'label' => 'Top & Progress',
                    'tab' => $this->get_id(),
                ]
            );

            $this->start_controls_tabs('tpcrtab');

            $this->start_controls_tab(
                'tpcrtab1',
                [
                    'label' => esc_html__('Top', 'the-pack-addon'),
                ]
            );

            $this->add_control(
                'tp_cursor',
                [
                    'type' => Controls_Manager::SWITCHER,
                    'label' => esc_html__('Show back to top', 'the-pack-addon'),
                ]
            );

            $this->add_control(
                'tpbktpos',
                [
                    'label' => esc_html__('Position', 'the-pack-addon'),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'pleft' => [
                            'title' => esc_html__('Left', 'the-pack-addon'),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'pright' => [
                            'title' => esc_html__('Right', 'the-pack-addon'),
                            'icon' => 'eicon-h-align-right',
                        ]
                    ],
                    'default' => 'pright',
                    'condition' => [
                        'tp_cursor' => 'yes',
                    ],                    
                ]
            );

            $this->add_control(
                'tpbtpikn',
                [
                    'label' => esc_html__('Back to top icon', 'the-pack-addon'),
                    'type' => Controls_Manager::ICONS,
                    'label_block' => true, 
                    'default' => [
                        'value' => 'tivo ti-close',
                        'library' => 'themify-icons',
                    ],                    
                    'condition' => [
                        'tp_cursor' => 'yes',
                    ],                    
                ]
            );

            $this->add_control(
                'tpcur_pclr',
                [
                    'label' => esc_html__('Background color', 'the-pack-addon'),
                    'type' => Controls_Manager::COLOR,
                    'default'=>'#fff',
                    'selectors' => [
                        '.tp-progress-wrap' => 'box-shadow:inset  0 0 0 2px {{VALUE}};',
                    ],
                    'condition' => [
                        'tp_cursor' => 'yes',
                    ],                    
                ]
            );

            $this->add_control(
                'tpcur_ikrl',
                [
                    'label' => esc_html__('Icon color', 'the-pack-addon'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '.tp-progress-wrap i' => 'color:{{VALUE}};',
                    ],
                    'condition' => [
                        'tp_cursor' => 'yes',
                    ],                    
                ]
            );

            $this->add_control(
                'tpcur_sclr',
                [
                    'label' => esc_html__('Active color', 'the-pack-addon'),
                    'type' => Controls_Manager::COLOR,
                    'default'=>'#000',
                    'selectors' => [
                        '.tp-progress-wrap svg.progress-circle path' => 'stroke:{{VALUE}};',
                    ],
                    'condition' => [
                        'tp_cursor' => 'yes',
                    ],                    
                ]
            );

            $this->add_responsive_control(
                'tpcur_wh',
                [
                    'label' => esc_html__('Width & height', 'the-pack-addon'),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 40,
                    ],                    
                    'selectors' => [
                        '.tp-progress-wrap' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'tp_cursor' => 'yes',
                    ],    
                ]
            );

            $this->add_responsive_control(
                'tpcur_z',
                [
                    'label' => esc_html__('Z index', 'the-pack-addon'),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 30,
                    ],  
                    'range' => [
                        'px' => [
                            'max' => 8000,
                        ],
                    ],                                      
                    'selectors' => [
                        '.tp-progress-wrap' => 'z-index: {{SIZE}};',
                    ],
                    'condition' => [
                        'tp_cursor' => 'yes',
                    ],    
                ]
            );

            $this->add_responsive_control(
                'tpcur_pos',
                [
                    'label' => esc_html__('Position', 'the-pack-addon'),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 40,
                    ],                    
                    'selectors' => [
                        '.tp-progress-wrap' => 'bottom: {{SIZE}}{{UNIT}};',
                        '.tp-progress-wrap.pright' => 'right: {{SIZE}}{{UNIT}};',
                        '.tp-progress-wrap.pleft' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'tp_cursor' => 'yes',
                    ],    
                ]
            );

            $this->end_controls_tab();

            $this->start_controls_tab(
                'tpcrtab2',
                [
                    'label' => esc_html__('Progress', 'the-pack-addon'),
                ]
            );

            $this->add_control(
                'tp_progress_bar',
                [
                    'type' => Controls_Manager::SWITCHER,
                    'label' => esc_html__('Show progress bar', 'the-pack-addon'),
                ]
            );

            $this->add_responsive_control(
                'tprpro_pos',
                [
                    'label' => esc_html__('Position', 'the-pack-addon'),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'top' => [
                            'title' => esc_html__('Left', 'the-pack-addon'),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'bottom' => [
                            'title' => esc_html__('Center', 'the-pack-addon'),
                            'icon' => 'eicon-v-align-top',
                        ],
                    ],
                    'default' => 'top',
                    'selectors' => [
                        '{{WRAPPER}} .tp-reading-progress' => '{{VALUE}}: 0;',
                    ],
                ]
            );

            $this->add_control(
                'tprpro_sclr',
                [
                    'label' => esc_html__('Background', 'the-pack-addon'),
                    'type' => Controls_Manager::COLOR,
                    'default'=>'#f00',
                    'selectors' => [
                        '.tp-reading-progress .progress' => 'background:{{VALUE}};',
                    ],
                    'condition' => [
                        'tp_progress_bar' => 'yes',
                    ],                    
                ]
            );

            $this->add_responsive_control(
                'tprpro_ht',
                [
                    'label' => esc_html__('Height', 'the-pack-addon'),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 3,
                    ],                    
                    'selectors' => [
                        '.tp-reading-progress .progress' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'tp_progress_bar' => 'yes',
                    ],    
                ]
            );

            $this->add_responsive_control(
                'tprpro_z',
                [
                    'label' => esc_html__('Z index', 'the-pack-addon'),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 30,
                    ],  
                    'range' => [
                        'px' => [
                            'max' => 8000,
                        ],
                    ],                                      
                    'selectors' => [
                        '.tp-reading-progress .progress' => 'z-index: {{SIZE}};',
                    ],
                    'condition' => [
                        'tp_progress_bar' => 'yes',
                    ],    
                ]
            );

            $this->end_controls_tab();

            $this->end_controls_tabs();

            $this->end_controls_section();

            $this->start_controls_section(
                'tp_preloader_sec',
                [
                    'label' => esc_html__('Preloader', 'the-pack-addon'),
                    'tab' => $this->get_id(),
                ]
            ); 

            $this->add_control(
                'tp_preloader',
                [
                    'type' => Controls_Manager::SWITCHER,
                    'label' => esc_html__('Preloader', 'the-pack-addon'),
                ]
            );

            $this->add_control(
                'tp_preloader_type',
                [
                    'label' => esc_html__('Loader type', 'the-pack-addon'),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'plain' => [
                            'title' => esc_html__('Default', 'the-pack-addon'),
                            'icon' => 'eicon-counter-circle',
                        ],
    
                        'image' => [
                            'title' => esc_html__('Image', 'the-pack-addon'),
                            'icon' => 'eicon-image',
                        ],
    
                    ],
                    'default' => 'plain',
                    'condition' => [
                        'tp_preloader' => 'yes',
                    ],                     
                ]
            );

            $this->add_control(
                'tp_preloader_img',
                [
                    'label' => esc_html__('Preloader image', 'the-pack-addon'),
                    'type' => Controls_Manager::MEDIA,
                    'label_block' => true,
                    'condition' => [
                        'tp_preloader_type' => 'image',
                    ],                      
                ]
            );

            $this->add_control(
                'tp_pre_bg',
                [
                    'label' => esc_html__('Background', 'the-pack-addon'),
                    'type' => Controls_Manager::COLOR,
                    'default'=>'#fff',
                    'selectors' => [
                        '.tp-page-loader-wrap' => 'background:{{VALUE}};',
                    ],
                    'condition' => [
                        'tp_preloader' => 'yes',
                    ],                    
                ]
            );

            $this->add_control(
                'tp_pre_thm1',
                [
                    'label' => esc_html__('Primary theme', 'the-pack-addon'),
                    'type' => Controls_Manager::COLOR,
                    'default'=>'#fff',
                    'selectors' => [
                        '.tp-page-loader-wrap .loader' => 'border-left-color:{{VALUE}} !important;',
                    ],
                    'condition' => [
                        'tp_preloader' => 'yes',
                        'tp_preloader_type' => 'plain',
                    ],                    
                ]
            );

            $this->add_control(
                'tp_pre_thm2',
                [
                    'label' => esc_html__('Secondary theme', 'the-pack-addon'),
                    'type' => Controls_Manager::COLOR,
                    'default'=>'#fff',
                    'selectors' => [
                        '.tp-page-loader-wrap .loader' => 'border-color:{{VALUE}};',
                    ],
                    'condition' => [
                        'tp_preloader' => 'yes',
                        'tp_preloader_type' => 'plain',
                    ],                    
                ]
            );

            $this->end_controls_section();

            $this->start_controls_section(
                'tp_quick_pop',
                [
                    'label' => esc_html__('Quick popup', 'the-pack-addon'),
                    'tab' => $this->get_id(),
                ]
            );
     
            $this->add_control(
                'tpqp_icn',
                [
                    'label' => esc_html__('Trigger Icon', 'the-pack-addon'),
                    'type' => Controls_Manager::ICONS,
                    'label_block' => true,
                ]
            );
  
            $this->add_control(
                'tpqp_clos',
                [
                    'label' => esc_html__('Close Icon', 'the-pack-addon'),
                    'type' => Controls_Manager::ICONS,
                    'label_block' => true,
                ]
            );
   
            $this->add_control(
                'tpqp_tmpl',
                [
                    'label' => esc_html__('Template', 'the-pack-addon'),
                    'type' => Controls_Manager::SELECT2,
                    'options' => thepack_footer_select(),
                    'label_block' => true
                ]
            );

            $this->add_control(
                'tpqpst',
                [
                    'label' => esc_html__('Position', 'the-pack-addon'),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'pleft' => [
                            'title' => esc_html__('Left', 'the-pack-addon'),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'pright' => [
                            'title' => esc_html__('Right', 'the-pack-addon'),
                            'icon' => 'eicon-h-align-right',
                        ]
                    ],
                    'default' => 'pleft',
                ]
            );

            $this->add_responsive_control(
                'tpqpz',
                [
                    'label' => esc_html__('Z index', 'the-pack-addon'),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 2,
                    ],  
                    'range' => [
                        'px' => [
                            'max' => 8000,
                        ],
                    ],                                      
                    'selectors' => [
                        '.tp-quick-pop .quick-content' => 'z-index: {{SIZE}};',
                        '.tp-quick-pop .launcher' => 'z-index: {{SIZE}};',
                    ],    
                ]
            );

            $this->start_controls_tabs('tpoptab');

            $this->start_controls_tab(
                'tpoptab1',
                [
                    'label' => esc_html__('Trigger', 'the-pack-addon'),
                ]
            );

            $this->add_responsive_control(
                'tpqpwh',
                [
                    'label' => esc_html__('Width & height', 'the-pack-addon'),
                    'type' => Controls_Manager::SLIDER,
                    'selectors' => [
                        '.tp-quick-pop .launcher' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
                    ],
    
                ]
            );

            $this->add_responsive_control(
                'tpqpos',
                [
                    'label' => esc_html__('Position', 'the-pack-addon'),
                    'type' => Controls_Manager::SLIDER,
                    'selectors' => [
                        '.tp-quick-pop.pleft .launcher' => 'left:{{SIZE}}{{UNIT}};',
                        '.tp-quick-pop.pright .launcher' => 'right:{{SIZE}}{{UNIT}};',
                        '.tp-quick-pop .launcher' => 'bottom:{{SIZE}}{{UNIT}};',
                    ],
    
                ]
            );

            $this->add_responsive_control(
                'tpqpbr',
                [
                    'label' => esc_html__('Border radius', 'the-pack-addon'),
                    'type' => Controls_Manager::SLIDER,
                    'selectors' => [
                        '.tp-quick-pop .launcher' => 'border-radius:{{SIZE}}{{UNIT}};',
                    ],
    
                ]
            );

            $this->add_control(
                'tpqpclr',
                [
                    'label' => esc_html__('Color', 'the-pack-addon'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '.tp-quick-pop .launcher' => 'color: {{VALUE}};',
                    ],
                ]
            );
    
            $this->add_control(
                'tpqpbg',
                [
                    'label' => esc_html__('Background', 'the-pack-addon'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '.tp-quick-pop .launcher' => 'background: {{VALUE}};',
                    ],
                ]
            );

            $this->end_controls_tab();

            $this->start_controls_tab(
                'tpoptab2',
                [
                    'label' => esc_html__('Content', 'the-pack-addon'),
                ]
            );

            $this->add_responsive_control(
                'tpqpcwd',
                [
                    'label' => esc_html__('Width', 'the-pack-addon'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 800,
                            'min' => 1,
                            'step' => 1,
                        ]
                    ],
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '.tp-quick-pop .quick-content' => 'max-width: {{SIZE}}{{UNIT}};',
                    ],
    
                ]
            );

            $this->add_control(
                'tpqpcbg',
                [
                    'label' => esc_html__('Background', 'the-pack-addon'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '.tp-quick-pop .quick-content' => 'background: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'tpqpcpd',
                [
                    'label' => esc_html__('Padding', 'the-pack-addon'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .tp-quick-pop .quick-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'tpqcpos',
                [
                    'label' => esc_html__('Position', 'the-pack-addon'),
                    'type' => Controls_Manager::SLIDER,
                    'selectors' => [
                        '.tp-quick-pop.pleft .quick-content' => 'left:{{SIZE}}{{UNIT}};',
                        '.tp-quick-pop.pright .quick-content' => 'right:{{SIZE}}{{UNIT}};',
                        '.tp-quick-pop .quick-content' => 'bottom:{{SIZE}}{{UNIT}};',
                    ],

                ]
            );

            $this->add_responsive_control(
                'tpqpcbr',
                [
                    'label' => esc_html__('Border radius', 'the-pack-addon'),
                    'type' => Controls_Manager::SLIDER,
                    'selectors' => [
                        '.tp-quick-pop .quick-content' => 'border-radius:{{SIZE}}{{UNIT}};',
                    ],
    
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'tpqpcbxd',
                    'label' => esc_html__('Box shadow', 'the-pack-addon'),
                    'selector' => '{{WRAPPER}} .quick-content',
                ]
            );

            $this->end_controls_tab();

            $this->end_controls_tabs();

            $this->end_controls_section();

        }
    }

        
    class The_Pack_Settings_Init
    {
        public static function init()
        {
            add_action( 'elementor/kit/register_tabs', [__CLASS__, 'register_controls']);
            add_action( 'wp_footer', [__CLASS__, 'render_html']);
            add_action( 'wp_body_open', [__CLASS__, 'render_preloader']);
            add_action( 'wp_enqueue_scripts', [__CLASS__, 'add_script_style']);
        } 

        public static function register_controls( \Elementor\Core\Kits\Documents\Kit $kit ){
            
            $kit->register_tab( 'the-pack-settings', The_Pack_Settings::class );
        }

        public static function add_script_style(){

        
        }

        public static function render_preloader(){

            $show_preloader = self::elementor_get_setting( 'tp_preloader' );
            if ($show_preloader){
                $type = self::elementor_get_setting( 'tp_preloader_type' );
                $gif = self::elementor_get_setting( 'tp_preloader_img' );
                $out = $type == 'plain' ? '<div class="loader"></div>' : wp_get_attachment_image($gif['id'],'full');
                //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
                echo '<div class="tp-page-loader-wrap">'.$out.'</div>';
            }

        }

        public static function render_html(){  

            $items = self::elementor_get_setting( 'tp_fshare' );
            $show_cursor = self::elementor_get_setting( 'tp_cursor' );
            $show_progress = self::elementor_get_setting( 'tp_progress_bar' );
            $popicon = the_pack_render_icon( self::elementor_get_setting( 'tpqp_icn' ),'open' );
            $popiconclose = the_pack_render_icon( self::elementor_get_setting( 'tpqp_clos' ),'close' );
            $popcontent = self::elementor_get_setting( 'tpqp_tmpl' );
            $popposition = self::elementor_get_setting( 'tpqpst' );
            $backtoposition = self::elementor_get_setting( 'tpbktpos' );
            $backtopicon = the_pack_render_icon( self::elementor_get_setting( 'tpbtpikn' ) );
            //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
            echo thepack_build_html(thepack_social_post_share( $items ));

            //$kit = \Elementor\Plugin::$instance->documents->get( \Elementor\Plugin::$instance->kits_manager->get_active_id(), true );

            //var_dump($kit);

            if ( $show_cursor ){
                echo '
                <div class="tp-progress-wrap '.esc_attr($backtoposition).' tbtr">
                    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
                    </svg>';?>
                    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    <?php echo $backtopicon;?>
                </div>                
            <?php }

            if ($show_progress){
                echo '<div class="tp-reading-progress"><div class="progress"></div></div>';
            }
            
            if ($popcontent){
                echo '
                <div class="tp-quick-pop '.esc_attr($popposition).'">
                    <div class="quick-content">
                        <div class="inner">
                            '.do_shortcode('[THEPACK_INSERT_TPL id="' . $popcontent . '"]').'
                        </div>
                    </div>
                    <div class="launcher">';?>
                        <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        <?php echo thepack_build_html($popicon.$popiconclose);?>
                    </div>
                </div>
            <?php }
 
        }

        public static function elementor_get_setting( $setting_id ) {

            $return = '';
    
            if ( ! isset( $the_pack_settings['kit_settings'] ) ) {
                if ( Plugin::instance()->preview->is_preview_mode() ) {
                    // get auto save data
                    $kit = \Elementor\Plugin::$instance->documents->get_doc_for_frontend( \Elementor\Plugin::$instance->kits_manager->get_active_id() );
                } else {
                    $kit = \Elementor\Plugin::$instance->documents->get( \Elementor\Plugin::$instance->kits_manager->get_active_id(), true );
                }
                $the_pack_settings['kit_settings'] = $kit->get_settings();
            }
    
            if ( isset( $the_pack_settings['kit_settings'][ $setting_id ] ) ) {
                $return = $the_pack_settings['kit_settings'][ $setting_id ];
            }
    
            return $return;
        }

    }
    The_Pack_Settings_Init::init();
?>