<?php
use Elementor\Plugin;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;

    class The_Pack_Cursor_Scroll extends \Elementor\Core\Kits\Documents\Tabs\Tab_Base {

        public function get_id() {
            return 'the-pack-cursor-scroll';
        }

        public function get_title() {
            return 'Cursor scroll';
        }
 
        public function get_icon() {
            return 'eicon-svg';
        }

        protected function register_tab_controls() {

            $this->start_controls_section(
                'tp_cur_scrl_se',
                [
                    'label' => 'General',
                    'tab' => $this->get_id(),
                ]
            );
            $this->add_control(
                'tp_en_vscrl',
                [
                    'type' => Controls_Manager::SWITCHER,
                    'label' => esc_html__('Enable vertical scroll', 'the-pack-addon'),
                ]
            );
            $this->add_control(
                'tp_en_vsct',
                [
                    'type' => Controls_Manager::TEXT,
                    'label' => esc_html__('Scroll text', 'the-pack-addon'),
                ]
            );
            $this->add_control(
                'tp_en_hc',
                [
                    'type' => Controls_Manager::SWITCHER,
                    'label' => esc_html__('Enable hover cursor', 'the-pack-addon'),
                ]
            );            
            $this->end_controls_section();
        }
    }

        
    class The_Pack_Cursor_Scroll_Init
    {
        public static function init()
        {
            add_action( 'elementor/kit/register_tabs', [__CLASS__, 'register_controls']);
            add_action( 'wp_footer', [__CLASS__, 'render_html']);
            add_action( 'wp_enqueue_scripts', [__CLASS__, 'add_script_style']);
        } 

        public static function register_controls( \Elementor\Core\Kits\Documents\Kit $kit ){
            
            $kit->register_tab( 'the-pack-cursor-scroll', The_Pack_Cursor_Scroll::class );
        }

        public static function add_script_style(){

        
        }

        public static function render_html(){  

            $enable_scroll_indi = self::elementor_get_setting( 'tp_en_vscrl' );
            $enable_scroll_txt = self::elementor_get_setting( 'tp_en_vsct' );
            $sctext = $enable_scroll_txt ? '<span class="scroll-text">'.esc_attr($enable_scroll_txt).'</span>' : '';
            if($enable_scroll_indi){
                echo '
                    <div class="tp-scroll-bar">
                        <a href="#" class="scroll-to-top" aria-label="scroll">
                            '.$sctext.'<span class="scroll-ver-line"><span class="tp-scroll-indicate"></span></span>
                        </a>
                    </div>
                <style>.tp-scroll-bar{position:fixed;right:20px;z-index:111;top:50%;-webkit-transition:.3s linear;transition:.3s linear;opacity:0;-webkit-transform:translateY(-50%);transform:translateY(-50%);mix-blend-mode:difference}.tp-scroll-bar.visible{opacity:1}.tp-scroll-bar .scroll-to-top{display:flex;flex-direction:column;justify-content:center;align-items:center}.tp-scroll-bar .scroll-text{-webkit-transform:rotate(180deg);transform:rotate(180deg);writing-mode:vertical-lr;margin-bottom:15px;color:#fff;font-size:11px;text-transform:uppercase}.tp-scroll-bar .scroll-ver-line{width:2px;height:60px;position:relative;background-color:rgba(255,255,255,.15);color:inherit;display:block}.tp-scroll-bar .tp-scroll-indicate{display:inline-block;width:2px;position:absolute;background-color:#fff;top:0;left:0}</style>                    
                ';
            }

            $enable_hover_cursor = self::elementor_get_setting( 'tp_en_hc' );
            if ($enable_hover_cursor){
                echo '
                    <div class="tp-cursor-helper"><div class="cursor-helper-outer"></div><div class="cursor-helper-inner"></div></div>
                    <style>.tp-cursor-helper{height:0}.tp-cursor-helper .cursor-helper-outer{width:8px;height:8px;border-radius:100%;background:#002a5c;-webkit-transition:.2s ease-out;transition:.2s ease-out;position:fixed;pointer-events:none;left:25px;top:25px;-webkit-transform:translate(calc(-50% + 5px),-50%);transform:translate(calc(-50% + 5px),-50%);z-index:999999}.tp-cursor-helper .cursor-helper-inner{width:10px;height:10px;border-radius:100%;background-color:transparent;opacity:.3;position:fixed;-webkit-transform:translate(-50%,-50%);transform:translate(-50%,-50%);pointer-events:none;-webkit-transition:width .3s,height .3s,opacity .3s;transition:width .3s,height .3s,opacity .3s;z-index:999999}.tp-cursor-helper .cursor-link{width:64px;height:64px;background:#fff;border-radius:50%;transform:translate(-50%,-50%);mix-blend-mode:exclusion;transition:transform .2s;left:0;top:0}.tp-cursor-helper .cursor-light{background-color:#fff;opacity:1}.tp-cursor-helper .cursor-slider{background-color:#002a5c;border-radius:100%;padding:30px}.tp-cursor-helper .cursor-slider:after{content:"\e658";font-family:themify;font-size:24px;position:absolute;top:13px;left:19px;line-height:35px;color:#fff}.tp-cursor-helper .cursor-helper-innerhover{width:25px;height:25px;opacity:.4}@media screen and (max-width:1199px){.tp-cursor-helper{display:none}}</style>
                ';
            }
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
    The_Pack_Cursor_Scroll_Init::init();
?>