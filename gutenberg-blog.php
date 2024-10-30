<?php

use Carbon_Fields\Block;
use Carbon_Fields\Field;

Block::make( esc_html__( 'Blog Layout Design', 'blog-layout-design' ) )
->add_fields( array(
	Field::make( 'association', 'blog_layout_gutenberg_block', esc_html__( 'Blog Post', 'blog-layout-design' ) )
	->set_min( 1 )
	->set_max( 1 )
	->set_types( array(
		array(
			'type'      => 'post',
			'post_type' => 'blogshowcase-design',
		)
	) ),
) )
->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
	require dirname( __FILE__ ) . '/gutenberg-blocks/blog-layout-block.php';
} );
