<?php 
/*
Template Name: Single Post Blog Layout Design Blank
Template Post Type: post
*/

get_header();

global $wp;
if ( have_posts() ):
while ( have_posts() ) : the_post();
?>
	<div class="single-post-blog-layout-design-wrap single-post-blog-layout-design-blank">
		<?php the_content(); ?>
	</div>
<?php
endwhile; 
endif;
wp_reset_postdata(); ?>
<?php get_footer(); ?>