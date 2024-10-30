<div class="blog-post-<?php echo esc_attr($showcase_id); ?> port-main-wrapper">
	<div class="blog-post-<?php echo esc_attr($showcase_id); ?> slider-blog swiper-container<?php if($blog_layout_use_pagination == true) { ?> has-pagination<?php } ?><?php if($blog_layout_column_carousel == 'auto') { ?> blog-width-auto<?php } ?><?php if ($blog_post_link_post == 'lightbox') { ?> lightbox-parent<?php } ?>">
		<div class="blog-block-wrap swiper-wrapper blog-full-image-style">

			<?php

			while ( $ta_blog_loop->have_posts() ) : $ta_blog_loop->the_post();

			if (has_post_thumbnail()) {
				$img_url_porto = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
				$image_portores =  aq_resize($img_url_porto[0],  1600 , 1600, true, true, true);
				$image_gallery = $img_url_porto[0];
			} else {
				$image_portores = '';
				$image_gallery = '';
			}

			if($blog_post_link_post == 'post_item') {
				$link_post = get_permalink();
			} elseif ($blog_post_link_post == 'lightbox') {
				$link_post = $image_gallery;
			} ?>
			<div class="blog-post-item swiper-slide"<?php if ($blog_post_link_post == 'lightbox') { ?> data-src="<?php echo esc_attr($link_post); ?>"<?php } ?> style="background-image: url(<?php echo $image_portores; ?>);">
				<div class="slider-background-overlay"></div>
				<div class="inner-slider animated fadeInRight">
					<div class="categories hastags"><?php the_category(' '); ?></div>
					<h1><?php the_title(); ?></h1>
					<p><?php echo blog_layout_design_excerpt(15); ?></p>
					<a <?php if ($blog_post_link_post == 'lightbox') { ?>href="" class="lightbox-image button-view" title="<?php the_title(); ?>" data-src="<?php echo esc_attr($link_post); ?>"<?php } else { ?> href="<?php echo esc_url($link_post); ?>" class="button-view"<?php } ?>>
						<?php 
						if(!empty($button_text)) {
							echo esc_html($button_text);
						} else {
							echo esc_html__('View', 'blog-layout-design');
						} ?>
					</a>
				</div>
				<div class="slider-overlay"></div>
			</div>

			<?php endwhile; wp_reset_postdata(); ?>

		</div>

	</div>


	<?php 
	if(in_array('advanced-slider-blog-layout-design/advanced-slider-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		asbld_ta_pagination_slider_temp($blog_layout_use_pagination, $blog_layout_select_dot);
		asbld_ta_arrow_slider_temp($blog_layout_use_arrow, $blog_layout_select_arrow);
	} else { ?>
		<?php if($blog_layout_use_pagination == true) { ?>
			<ul class="swiper-pag dotstyle-fillup"></ul>
		<?php } ?>

		<?php if($blog_layout_use_arrow == true) { ?>
			<div class="swiper-nav nav-circlepop">
				<a class="prev" href="#">
					<span class="icon-wrap"></span>
				</a>
				<a class="next" href="#">
					<span class="icon-wrap"></span>
				</a>
			</div>
		<?php } ?>
	<?php } ?>
</div>

<?php
wp_enqueue_script( 'ta-blog-layout-design-swiper', plugin_dir_url(__DIR__ ) . 'js/swiper.min.js', array('jquery', 'imagesloaded'), '', false );

blog_layout_slider_script($showcase_id, $blog_style);

if(in_array('advanced-slider-blog-layout-design/advanced-slider-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		if ($blog_post_link_post == 'lightbox') {
			wp_enqueue_style( 'acpb-advanced-slider-blog-layout-design-light-gallery', ADVANCED_SLIDER_BLOG_LAYOUT_DESIGN_URL . 'assets/css/lightgallery.css', array(), '', 'all' );
			wp_enqueue_script( 'acpb-advanced-slider-blog-layout-design-light-gallery',  ADVANCED_SLIDER_BLOG_LAYOUT_DESIGN_URL . 'assets/js/lightgallery.js', array('jquery'), '', false );
		}
	}

if(in_array('advanced-slider-blog-layout-design/advanced-slider-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
	if ($blog_post_link_post == 'lightbox') { ?>
		<script>
			(function($) {

				'use strict';
				$(document).on('ready', function () {
					if ($('.lightbox-parent').length) {
				        $('.lightbox-parent').lightGallery({
				            thumbnail: false,
				            download: false,
				            selector: '.lightbox-image'
				        });
				    }
				});

			})( jQuery );
		</script>
<?php }
}