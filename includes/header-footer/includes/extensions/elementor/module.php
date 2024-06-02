<?php
/**
 * LaStudioKit Elementor Extension Module.
 *
 * Version: 1.0.0
 */

namespace ThePackKitExtensions\Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

use ThePackKitExtensions\Module_Base;

class Module extends Module_Base {

    public $active_extensions;

    public function __construct()
    {

        add_action( 'elementor/controls/controls_registered',  array( $this, 'register_controls' ) );
        add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'enqueue_editor_scripts' ) );
        add_action( 'elementor/ajax/register_actions', [ $this, 'register_ajax_actions' ] );

        // Register private actions
        $priv_actions = array(
            'lakit_theme_search_posts' => array( $this, 'search_posts' ),
            'lakit_theme_search_pages' => array( $this, 'search_pages' ),
            'lakit_theme_search_cats'  => array( $this, 'search_cats' ),
            'lakit_theme_search_tags'  => array( $this, 'search_tags' ),
            'lakit_theme_search_terms' => array( $this, 'search_terms' ),
        );

        foreach ( $priv_actions as $tag => $callback ) {
            add_action( 'wp_ajax_' . $tag, $callback );
        }

    }

    public static function is_active(){
        return true;
    }

    /**
     * Register new controls.
     *
     * @param  object $controls_manager Controls manager instance.
     * @return void
     */
    public function register_controls( $controls_manager ) {

        $controls_manager->add_group_control( Controls\Group_Control_Query::get_type(),      new Controls\Group_Control_Query() );
        $controls_manager->add_group_control( Controls\Group_Control_Related::get_type(),    new Controls\Group_Control_Related() );
        $controls_manager->register( new Controls\Control_Query() );
        $controls_manager->register( new Controls\Control_Search() );

    }

    /**
     * @param \Elementor\Core\Common\Modules\Ajax\Module $ajax_manager
     */
    public function register_ajax_actions( $ajax_manager ){

        if( isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'elementor_ajax' ){
            $need_update = false;
            $action_require = ['app_site_editor_template_types'];
            $request = json_decode( stripslashes( $_REQUEST['actions'] ), true );
            foreach ($request as $k => &$value){
                if( in_array($k, $action_require) && !isset($value['data'])){
                    $value['data'] = [];
                    $need_update = true;
                }
            }
            if($need_update){
                $_REQUEST['actions'] = json_encode($request);
            }
        }

        $class_query = Classes\Query_Control::get_instance();
        $ajax_manager->register_ajax_action( 'lastudiokit_query_control_value_titles', [ $class_query, 'ajax_posts_control_value_titles' ] );
        $ajax_manager->register_ajax_action( 'lastudiokit_query_control_filter_autocomplete', [ $class_query, 'ajax_posts_filter_autocomplete' ] );

    }

    /**
     * Enqueue editor scripts.
     */
    public function enqueue_editor_scripts() {
        wp_enqueue_script(
            'thepack-kit-ext-editor',
            thepack_kit()->plugin_url('includes/extensions/elementor/assets/js/editor.js'),
            array( 'jquery' ),
            thepack_kit()->get_version(true),
            true
        );
    }

    /**
     * Serch page
     *
     * @return [type] [description]
     */
    public function search_pages() {

        if ( ! current_user_can( 'edit_posts' ) ) {
            wp_send_json( array() );
        }

        $query = isset( $_GET['q'] ) ? esc_attr( $_GET['q'] ) : '';
        $ids   = isset( $_GET['ids'] ) ? esc_attr( $_GET['ids'] ) : array();

        wp_send_json( array(
            'results' => lastudio_kit_helper()->search_posts_by_type( 'page', $query, $ids ),
        ) );
    }

    /**
     * Serch post
     *
     * @return [type] [description]
     */
    public function search_posts() {

        if ( ! current_user_can( 'edit_posts' ) ) {
            wp_send_json( array() );
        }

        $query     = isset( $_GET['q'] ) ? esc_attr( $_GET['q'] ) : '';
        $post_type = isset( $_GET['preview_post_type'] ) ? esc_attr( $_GET['preview_post_type'] ) : 'post';
        $ids       = isset( $_GET['ids'] ) ? esc_attr( $_GET['ids'] ) : array();

        wp_send_json( array(
            'results' => lastudio_kit_helper()->search_posts_by_type( $post_type, $query, $ids )
        ) );

    }

    /**
     * Serch category
     *
     * @return [type] [description]
     */
    public function search_cats() {

        if ( ! current_user_can( 'edit_posts' ) ) {
            wp_send_json( array() );
        }

        $query = isset( $_GET['q'] ) ? esc_attr( $_GET['q'] ) : '';
        $ids   = isset( $_GET['ids'] ) ? esc_attr( $_GET['ids'] ) : array();

        wp_send_json( array(
            'results' => lastudio_kit_helper()->search_terms_by_tax( 'category', $query, $ids ),
        ) );

    }

    /**
     * Serch tag
     *
     * @return [type] [description]
     */
    public function search_tags() {

        if ( ! current_user_can( 'edit_posts' ) ) {
            wp_send_json( array() );
        }

        $query = isset( $_GET['q'] ) ? esc_attr( $_GET['q'] ) : '';
        $ids   = isset( $_GET['ids'] ) ? esc_attr( $_GET['ids'] ) : array();

        wp_send_json( array(
            'results' => lastudio_kit_helper()->search_terms_by_tax( 'post_tag', $query, $ids ),
        ) );

    }

    /**
     * Serach terms from passed taxonomies
     * @return [type] [description]
     */
    public function search_terms() {

        if ( ! current_user_can( 'edit_posts' ) ) {
            wp_send_json( array() );
        }

        $query = isset( $_GET['q'] ) ? esc_attr( $_GET['q'] ) : '';

        $tax = '';

        if ( isset( $_GET['conditions_archive-tax_tax'] ) ) {
            $tax = $_GET['conditions_archive-tax_tax'];
        }

        if ( isset( $_GET['conditions_singular-post-from-tax_tax'] ) ) {
            $tax = $_GET['conditions_singular-post-from-tax_tax'];
        }

        $tax = explode( ',', $tax );

        $ids = isset( $_GET['ids'] ) ? esc_attr( $_GET['ids'] ) : array();

        wp_send_json( array(
            'results' => lastudio_kit_helper()->search_terms_by_tax( $tax, $query, $ids ),
        ) );

    }
}
