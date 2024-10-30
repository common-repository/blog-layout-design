<div class="blog-post-<?php echo esc_attr($showcase_id); ?> port-main-wrapper<?php if ($blog_post_link_post == 'lightbox') { ?> lightbox-parent<?php } ?>">
	<div class="blog-post-<?php echo esc_attr($showcase_id); ?> swiper-container<?php if($blog_layout_use_pagination == true) { ?> has-pagination<?php } ?><?php if($blog_layout_column_carousel == 'auto') { ?> blog-width-auto<?php } ?>">
		<div class="blog-block-wrap swiper-wrapper blog-full-image-style">

			<?php

			while ( $ta_blog_loop->have_posts() ) : $ta_blog_loop->the_post();

			$post_id = get_the_ID();

			if(!empty($blog_img_width)) {
	            $blog_img_width = $blog_img_width;
	        } else {
	            $blog_img_width = 400;
	        }

	        if(!empty($blog_img_height)) {
	            $blog_img_height = $blog_img_height;
	        } else {
	            $blog_img_height = 400;
	        }

	        if(!empty($blog_use_crop)) {
	            $blog_use_crop = $blog_use_crop;
	        } else {
	            $blog_use_crop = false;
	        }

			if (has_post_thumbnail()) {
				$img_url_porto = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
				if($blog_layout_column_carousel == 'auto') {
					$image_portores =  aq_resize($img_url_porto[0],  9999 , $blog_img_height, false, true, true);
				} else {
					$image_portores =  aq_resize($img_url_porto[0],  $blog_img_width , $blog_img_height, true, true, true);
				}
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
			<div class="blog-post-item swiper-slide">
				<div class="item-wrap">
					<figure class="<?php if(!empty($blog_layout_post_hover)) { echo esc_attr($blog_layout_post_hover); } else { ?>imghvr-reveal-down<?php } ?>">
						<?php if(has_post_thumbnail()) { ?>
							<img class="blog-img" src="<?php echo esc_url($image_portores) ?>" alt="">
						<?php }
						else {
							echo wp_specialchars_decode('<div class="holder-box" style="width:100%; background-color: #f5f5f5;"></div>');
						} ?>
						<figcaption>
							<div class="caption-inside">
								<div class="blog__content ih-fade ih-delay-sm">
									<div class="categories"><?php the_category(' '); ?></div>
									<a <?php if ($blog_post_link_post == 'lightbox') { ?>href="" class="lightbox-image title-blog-text" title="<?php the_title(); ?>" data-src="<?php echo esc_attr($link_post); ?>"<?php } else { ?> href="<?php echo esc_url($link_post); ?>" class="title-blog-text"<?php } ?>>
										<h3 class="title-blog">
											<?php the_title(); ?>
										</h3>
									</a>
									<span class="date"><?php the_time( get_option( 'date_format' ) ); ?></span>
								</div>
							</div>
						</figcaption>
					</figure>
				</div>
			</div>

			<?php endwhile; wp_reset_postdata(); ?>

		</div>

	</div>

	<?php 
	if(in_array('advanced-carousel-blog-layout-design/advanced-carousel-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		acbld_ta_pagination_carousel_temp($blog_layout_use_pagination, $blog_layout_select_dot);
		acbld_ta_arrow_carousel_temp($blog_layout_use_arrow, $blog_layout_select_arrow);
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
	wp_enqueue_script( 'ta-blog-awesome-swiper', plugin_dir_url(__DIR__ ) . 'js/swiper.min.js', array('jquery', 'imagesloaded'), '', false );

	blog_style_script($showcase_id, $blog_style);

	if(in_array('advanced-carousel-blog-layout-design/advanced-carousel-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		if ($blog_post_link_post == 'lightbox') {
			wp_enqueue_style( 'acbld-advanced-carousel-blog-layout-design-light-gallery', ADVANCED_CAROUSEL_BLOG_LAYOUT_DESIGN_URL . 'assets/css/lightgallery.css', array(), '', 'all' );
			wp_enqueue_script( 'acbld-advanced-carousel-blog-layout-design-light-gallery',  ADVANCED_CAROUSEL_BLOG_LAYOUT_DESIGN_URL . 'assets/js/lightgallery.js', array('jquery'), '', false );
		}
	}
?>

<?php 
if(in_array('advanced-carousel-blog-layout-design/advanced-carousel-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
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