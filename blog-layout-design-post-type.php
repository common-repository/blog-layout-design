<?php
/*-----------------------------------------------------------------------------------*/
/* Blog Layout Design Awesome Post Type
/*-----------------------------------------------------------------------------------*/

add_action('init', 'blog_layout_design_register');

function blog_layout_design_register() {

	$labels = array(
		'name'                => esc_html_x( 'Blog Showcase', 'Post Type General Name', 'blog-layout-design' ),
		'singular_name'       => esc_html_x( 'Blog Showcase', 'Post Type Singular Name', 'blog-layout-design' ),
		'menu_name'           => esc_html__( 'Blog Showcase', 'blog-layout-design' ),
		'parent_item_colon'   => esc_html__( 'Parent Blog Showcase:', 'blog-layout-design' ),
		'all_items'           => esc_html__( 'Blog Showcase', 'blog-layout-design' ),
		'view_item'           => esc_html__( 'View Blog Showcase', 'blog-layout-design' ),
		'add_new_item'        => esc_html__( 'Add New Blog Showcase', 'blog-layout-design' ),
		'add_new'             => esc_html__( 'Add New Blog Showcase', 'blog-layout-design' ),
		'edit_item'           => esc_html__( 'Edit Blog Showcase', 'blog-layout-design' ),
		'update_item'         => esc_html__( 'Update Blog Showcase', 'blog-layout-design' ),
		'search_items'        => esc_html__( 'Search Blog Showcase', 'blog-layout-design' ),
		'not_found'           => esc_html__( 'Not found', 'blog-layout-design' ),
		'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'blog-layout-design' ),
	);
	$args = array(
		'labels'             	=> $labels,
		'public'             	=> true,
		'publicly_queryable' 	=> true,
		'show_ui'            	=> true,
		'query_var'          	=> 'blogshowcase',
		'capability_type'    	=> 'post',
		'hierarchical'       	=> false,
		'menu_icon'     		=> 'dashicons-layout',
		'rewrite'            	=> array( 'slug' => 'blog-showcase' ),
		'supports'           	=> array('title'),
		'menu_position'      	=> 7,
		'has_archive'           => false,
		'exclude_from_search'   => true,
	);
	register_post_type( 'blogshowcase-design', $args );

}

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Block;

add_action( 'carbon_fields_register_fields', 'blog_layout_design_showcase_field_in_post' );
function blog_layout_design_showcase_field_in_post() {

	require dirname( __FILE__ ) .'/blog-layout-design-showcase-fields.php';

}
