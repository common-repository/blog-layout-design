<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class blog_layout_design_post_block extends Widget_Base {

	public function get_name() {
		return 'blog_layout_design-post-block';
	}

	public function get_title() {
		return esc_html__( 'Blog Layout', 'blog-layout-design' );
	}

	public function get_icon() {
		return 'eicon-post-list';
	}

	public function get_categories() {
		return [ 'blog_layout_design-general-category' ];
	}

	protected function _register_controls() {
		/*-----------------------------------------------------------------------------------
			POST BLOCK INDEX
			1. POST SETTING
		-----------------------------------------------------------------------------------*/

		/*-----------------------------------------------------------------------------------*/
		/*  1. POST SETTING
		/*-----------------------------------------------------------------------------------*/
		$this->start_controls_section(
			'section_blog_layout_design_post_block_post_setting',
			[
				'label' => esc_html__( 'Post Setting', 'blog-layout-design' ),
			]
		);

		$this->add_control(
			'blog_layout_design_select_showcase_post',
			[
				'label' => esc_html__( 'Select Showcase', 'blog-layout-design' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'date',
				'options' => blog_layout_design_select_showcase_post(),
				'description' => esc_html__( 'Select post order by (default to latest post).', 'blog-layout-design' ),
			]
		);

		$this->end_controls_section();
		/*-----------------------------------------------------------------------------------
			end of post block post setting
		-----------------------------------------------------------------------------------*/

		$this->start_controls_section(
		'section_blog_layout_design_block_setting',
			[
				'label' => esc_html__( 'Typography', 'blog-layout-design' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typhography_title_blog_typography',
				'label' => esc_html__( 'Title Typography', 'blog-layout-design' ),
				'selector' => '{{WRAPPER}} .blog__content h3, {{WRAPPER}} h1.blog__content, {{WRAPPER}} figcaption .inner-content h3, {{WRAPPER}} .blog-post-item figcaption h3, {{WRAPPER}} .special-hiji .grid__item--title, {{WRAPPER}} .special-dua .slide__title, {{WRAPPER}} .inner-slider h1, {{WRAPPER}} .slideshow-slider .slide__title, {{WRAPPER}} .slider__text-inner, {{WRAPPER}} .slider .link-button a, {{WRAPPER}} .slider-inner-wrap .grid__item--name',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typhography_category_typography',
				'label' => esc_html__( 'Category Typography', 'blog-layout-design' ),
				'selector' => '{{WRAPPER}} .categories a, {{WRAPPER}} .special-hiji .caption, {{WRAPPER}} .slider-inner-wrap .grid__item--title',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typhography_blog_content_typography',
				'label' => esc_html__( 'Content Typography', 'blog-layout-design' ),
				'selector' => '{{WRAPPER}} .inner-slider p, {{WRAPPER}} .slideshow-slider .slide__desc, {{WRAPPER}} .slider-inner-wrap .grid__item--text',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typhography_date_typography',
				'label' => esc_html__( 'Date Typography', 'blog-layout-design' ),
				'selector' => '{{WRAPPER}} span.date, {{WRAPPER}} .inner-slider a,  {{WRAPPER}} .special-dua .slide__side, {{WRAPPER}} .justify-item figcaption span.date, {{WRAPPER}} .slideshow-slider .slide__link',
			]
		);
	}

	protected function render() {

		$instance = $this->get_settings();

		/*-----------------------------------------------------------------------------------*/
		/*  VARIABLES LIST
		/*-----------------------------------------------------------------------------------*/

		/* POST SETTING VARIBALES */
		$blog_layout_design_select_showcase_post 			= ! empty( $instance['blog_layout_design_select_showcase_post'] ) ? $instance['blog_layout_design_select_showcase_post'] : '';


		/* end of variables list */


		/*-----------------------------------------------------------------------------------*/
		/*  THE CONDITIONAL AREA
		/*-----------------------------------------------------------------------------------*/

		include ( plugin_dir_path(__FILE__).'tpl/blog-layout-block.php' );

		?>

		<?php 
		if($blog_style == 'special-hiji-carousel') { ?>
		<script>
			<?php include BLOG_LAYOUT_DESIGN_DIR .'/public/js/special1-in.js'; ?>
		</script>
		<?php } elseif ($blog_style == 'special-dua-carousel') { ?>

		<script>
			<?php include BLOG_LAYOUT_DESIGN_DIR .'/public/js/special2-in.js'; ?>
		</script>
		<?php } elseif ($blog_style == 'special-tilu-carousel') { ?>

		<script>
			<?php include BLOG_LAYOUT_DESIGN_DIR .'/public/js/special1-in.js'; ?>
		</script>
		<?php } ?>

		<?php

	}

	protected function content_template() {}

	public function render_plain_content( $instance = [] ) {}

}

Plugin::instance()->widgets_manager->register_widget_type( new blog_layout_design_post_block() );