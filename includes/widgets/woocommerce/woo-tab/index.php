<?php
namespace ThePackAddon\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Plugin;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography; 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
 
class Woo_Product_Tabs extends Widget_Base {

    public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );
		$this->the_hooks();
	}

	public function get_name() {
		return 'tp-woo-tabs';
	}

	public function get_title() {
		return esc_html__( 'Product Tabs', 'the-pack-addon' );
	}

	public function get_icon() {
		return 'eicon-product-tabs';
	}
    public function get_categories()
    {
        return ['thepack-woo'];
    }

	protected function register_controls() {

		$this->start_controls_section(
			'section_product_options',
			[
				'label' => esc_html__( 'Options', 'the-pack-addon' ),
			]
		);

        $this->add_control(
            'preview',
            [
                'label' => esc_html__('Preview product', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => thepack_drop_posts('product',10),
                'multiple' => false,
            ]
        );

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
            'lbl',
            [
                'label' => esc_html__('Label', 'the-pack-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

		$repeater->add_control(
            'icn',
            [
                'label' => esc_html__('Icon', 'the-pack-addon'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
            ]
        );

		$repeater->add_control(
            'callback',
            [
                'label' => esc_html__('Callback', 'the-pack-addon'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
				'options' => [
					'woocommerce_product_description_tab' => esc_html__( 'Description', 'the-pack-addon'  ),
					'tp_woo_comments_template' => esc_html__( 'Reviews', 'the-pack-addon'  ),
                    'woocommerce_product_additional_information_tab' => esc_html__( 'Additional information', 'the-pack-addon'  ),
					'template' => esc_html__( 'Elementor template', 'the-pack-addon'  ),
				],				
            ]
        );
        
		$repeater->add_control(
            'template',
            [
                'type' => Controls_Manager::SELECT2,
                'options' => thepack_footer_select(),
                'multiple' => false,
                'label' => esc_html__('Template', 'the-pack-addon'),
                'label_block' => true,
                'condition' => [
                    'callback' => 'template',
                ],
            ]
        );

		$this->add_control(
            'items',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'prevent_empty' => false,
                'title_field' => '{{{ lbl }}}',
            ]
        );

        $this->add_control(
            'hide_heading',
            [
                'label' => esc_html__('Hide heading', 'the-pack-addon'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

		$this->end_controls_section();

        $this->start_controls_section(
            'section_tab_title',
            [
                'label' => esc_html__('Tab Title', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tbstyle',
            [
                'label' => esc_html__('Style', 'the-pack-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'sone' => [
                        'title' => esc_html__('One', 'the-pack-addon'),
                        'icon' => 'eicon-folder',
                    ],
                    'stwo' => [
                        'title' => esc_html__('Two', 'the-pack-addon'),
                        'icon' => 'eicon-folder-o',
                    ]
                ],
            ]
        );

        $this->add_responsive_control(
            'thsp',
            [
                'label' => esc_html__('Spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tab-area' => 'gap: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'thtypo',
                'selector' => '{{WRAPPER}} .tab-area li',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'th_col',
            [
                'label' => esc_html__('Normal color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-area li' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'th_cola',
            [
                'label' => esc_html__('Active color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .tab-area li.active' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'th_bg',
            [
                'label' => esc_html__('Normal background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-area li' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'th_bga',
            [
                'label' => esc_html__('Active background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-area li.active' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'thbr_col',
            [
                'label' => esc_html__('Border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'default' => '#eee',
                'selectors' => [
                    '{{WRAPPER}} .sone .tab-area' => 'border-bottom:1px solid {{VALUE}};',
                    '{{WRAPPER}} .stwo .tab-area li' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'thbr_cola',
            [
                'label' => esc_html__('Active border color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'tbstyle' => 'stwo',
                ],
                'selectors' => [
                    '{{WRAPPER}} .stwo .tab-area li.active' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'th_colabr',
            [
                'label' => esc_html__('Bar color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'condition' => [
                    'tbstyle' => 'sone',
                ],                 
                'selectors' => [
                    '{{WRAPPER}} .sone .tab-area li:after' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'thbr_tsp',
            [
                'label' => esc_html__('Border top spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 12,
                ],      
                'condition' => [
                    'tbstyle' => 'sone',
                ],                          
                'selectors' => [
                    '{{WRAPPER}} .sone .tab-area' => 'padding-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .sone> .tab-area li:after' => 'bottom: -{{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'thpd',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'condition' => [
                    'tbstyle' => 'stwo',
                ], 
                'selectors' => [
                    '{{WRAPPER}} .stwo .tab-area li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'thbr_tbrd',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'condition' => [
                    'tbstyle' => 'stwo',
                ],                          
                'selectors' => [
                    '{{WRAPPER}} .stwo .tab-area li' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,              
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ttctypo',
                'selector' => '{{WRAPPER}} .tab-content> h2,{{WRAPPER}} .woocommerce-Reviews-title',
                'label' => esc_html__('Heading typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'ttc_col',
            [
                'label' => esc_html__('Heading color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-content> h2' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .woocommerce-Reviews-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ttc_mr',
            [
                'label' => esc_html__('Heading margin', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .tab-content> h2,{{WRAPPER}} .woocommerce-Reviews-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tctypo',
                'selector' => '{{WRAPPER}} .tab-content',
                'label' => esc_html__('Typography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'tc_col',
            [
                'label' => esc_html__('Color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tc_bg',
            [
                'label' => esc_html__('Background', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'tbstyle' => 'stwo',
                ],                  
                'selectors' => [
                    '{{WRAPPER}} .stwo .tab-content' => 'background:{{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tc_bdcr',
            [
                'label' => esc_html__('Border', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'tbstyle' => 'stwo',
                ],                  
                'selectors' => [
                    '{{WRAPPER}} .stwo .tab-content' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tcpd',
            [
                'label' => esc_html__('Padding', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'condition' => [
                    'tbstyle' => 'stwo',
                ],                  
                'selectors' => [
                    '{{WRAPPER}} .stwo .tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tc_tsp',
            [
                'label' => esc_html__('Top spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,      
                'default' => [
                    'size' => 12,
                ],   
                'condition' => [
                    'tbstyle' => 'stwo',
                ],                                                     
                'selectors' => [
                    '{{WRAPPER}} .stwo .tab-content' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'tc_tbrd',
            [
                'label' => esc_html__('Border radius', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,
                'condition' => [
                    'tbstyle' => 'stwo',
                ],                                           
                'selectors' => [
                    '{{WRAPPER}} .stwo .tab-content' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_info',
            [
                'label' => esc_html__('Additional information', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,              
            ]
        );

        $this->add_responsive_control(
            'ai_wd',
            [
                'label' => esc_html__('Label width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER, 
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],
                ],                                                                          
                'selectors' => [
                    '{{WRAPPER}} .shop_attributes th' => 'width: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'ai_pad',
            [
                'label' => esc_html__('Item padding', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER,                                          
                'selectors' => [
                    '{{WRAPPER}} .shop_attributes th' => 'padding: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .shop_attributes' => 'margin-left: -{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .shop_attributes td p' => 'padding: {{SIZE}}{{UNIT}} 0px;',
                ],

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_review',
            [
                'label' => esc_html__('Reviews', 'the-pack-addon'),
                'tab' => Controls_Manager::TAB_STYLE,              
            ]
        );

        $this->start_controls_tabs('gt');

        $this->start_controls_tab(
            't1',
            [
                'label' => esc_html__('Avatar', 'the-pack-addon'),
            ]
        );

        $this->add_responsive_control(
            'thm_wid',
            [
                'label' => esc_html__('Thumbnail width', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER, 
                'default' => [
                    'size' => 70,
                ],                                                                           
                'selectors' => [
                    '{{WRAPPER}} .tp-woocomment-comment .avatar-wrap' => 'flex:0 0 {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            't2',
            [
                'label' => esc_html__('Comment', 'the-pack-addon'),
            ]
        );

        $this->add_responsive_control(
            'cmt_wrp',
            [
                'label' => esc_html__('Comment list wrapper spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER, 
                                                                           
               'selectors' => [
                    '{{WRAPPER}} .tp-woocomment-comment' => 'padding:{{SIZE}}{{UNIT}} 0px;',
                ],

            ]
        );

        $this->add_responsive_control(
            'cmt_lyst',
            [
                'label' => esc_html__('Comment list spacing', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER, 
                                                                           
               'selectors' => [
                    '{{WRAPPER}} .tp-woocomment-comment li+li' => 'margin-top:{{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'rt_hd',
            [
                'label' => esc_html__('Star rating', 'the-pack-addon'),
                'type' =>Controls_Manager::HEADING,
                'separator' => 'after',                                                            
            ]
        );

        $this->add_responsive_control(
            'rt_fs',
            [
                'label' => esc_html__('Font size', 'the-pack-addon'),
                'type' => Controls_Manager::SLIDER, 
                                                                           
               'selectors' => [
                    '{{WRAPPER}} .tp-woocomment-comment  .tscore' => 'font-size:{{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'rt_clr',
            [
                'label' => esc_html__('Main color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,            
                'selectors' => [
                    '{{WRAPPER}} .tp-woocomment-comment  .tscore' => 'color:{{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'rt_aclr',
            [
                'label' => esc_html__('Active color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,            
                'selectors' => [
                    '{{WRAPPER}} .tp-woocomment-comment  .tscore span' => 'color:{{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'nm_hd',
            [
                'label' => esc_html__('Author meta', 'the-pack-addon'),
                'type' =>Controls_Manager::HEADING,
                'separator' => 'after',                                                            
            ]
        );

        $this->add_responsive_control(
            'mtmrg',
            [
                'label' => esc_html__('Margin', 'the-pack-addon'),
                'type' => Controls_Manager::DIMENSIONS,                  
                'selectors' => [
                    '{{WRAPPER}} .tp-woocomment-comment .author-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'nmypo',
                'selector' => '{{WRAPPER}} .tp-woocomment-comment  .author-meta .author',
                'label' => esc_html__('Name ypography', 'the-pack-addon'),
            ]
        );

        $this->add_control(
            'nm_clr',
            [
                'label' => esc_html__('Name color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,            
                'selectors' => [
                    '{{WRAPPER}} .tp-woocomment-comment  .author-meta .author' => 'color:{{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dt_clr',
            [
                'label' => esc_html__('Date color', 'the-pack-addon'),
                'type' => Controls_Manager::COLOR,            
                'selectors' => [
                    '{{WRAPPER}} .tp-woocomment-comment  .author-meta time' => 'color:{{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'dtypo',
                'selector' => '{{WRAPPER}} .tp-woocomment-comment  .author-meta time',
                'label' => esc_html__('Time ypography', 'the-pack-addon'),
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            't4',
            [
                'label' => esc_html__('Form', 'the-pack-addon'),
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

	}

	public function product_page_script() {
		?>
		<script type="text/javascript">
			jQuery(function($) {
				jQuery('.woocommerce-Reviews').find('#rating')
					.hide()
					.before(
						'<p class="stars">\
								<span>\
									<a class="star-1" href="#">1</a>\
									<a class="star-2" href="#">2</a>\
									<a class="star-3" href="#">3</a>\
									<a class="star-4" href="#">4</a>\
									<a class="star-5" href="#">5</a>\
								</span>\
							</p>'
					);
			});
		</script>
		<?php
	}

    public function the_hooks( $control = null ) {
		if ( ! $control ) {
			return;
		}  
        add_filter( 'body_class', [ $this, 'footer' ],1,1);

	}

    public function footer(){
        $classes[] = 'foog';
        return $classes;
    }
 
	protected function render() {
        $settings = $this->get_settings();
        global $product;
        $this->the_hooks($settings);
        $preview  = isset( $_GET['preview'] ) ? sanitize_text_field(wp_unslash($_GET['preview'])) : '';//phpcs:disable WordPress.Security.NonceVerification.Recommended 
        if (Plugin::instance()->editor->is_edit_mode() | $preview == 'true' ) {
            $this->product_page_script();
            $product = wc_get_product($settings['preview']);
        }
        require dirname(__FILE__) . '/view.php';
	} 

}

$widgets_manager->register(new \ThePackAddon\Widgets\Woo_Product_Tabs());
