<?php

// BLOG Title
function blog_layout_design_title_view($content) { ?>
	<div class="portfolio-name">
		<h1><?php echo esc_html($content); ?></h1>
	</div>
<?php }

// BLOG Avatar
function blog_layout_design_avatar_view($content) { ?>
	<div class="portfolio-avatar">
		<?php echo wp_get_attachment_image( $content, 'full' ); ?>
	</div>
<?php }

// BLOG Job
function blog_layout_design_subtitle_view($content) { ?>
	<div class="portfolio-job">
		<span><?php echo esc_html($content); ?></span>
	</div>
<?php }

// BLOG Bio
function blog_layout_design_bio_view($content) { ?>
	<div class="portfolio-bio">
		<p><?php echo wp_specialchars_decode($content); ?></p>
	</div>
<?php }

// BLOG Bio
function blog_layout_design_bio_categories($categories) {
	if(!empty($categories)) { ?>
	<div class="fact-list">
		<ul class="fact-list ih-fade ih-delay-sm">
			<?php foreach ($categories as $category) { ?>
			<li><?php echo esc_html($category->name); ?></li>
			<?php } ?>
		</ul>
	</div>
<?php }
}

function blog_layout_design_span_categories($categories) {
	if(!empty($categories)) { ?>
		<?php foreach ($categories as $category) { ?>
		<span><?php echo esc_html($category->name); ?></span>
		<?php } ?>
<?php }
}

// BLOG Bio
function blog_layout_design_excerpt($limit) {
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'...';
	} else {
		$excerpt = implode(" ",$excerpt);
	} 
	$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	return $excerpt; 
}
// BLOG Title
function blog_style_script($post_id, $showcase_style) {

	$blog_layout_column = carbon_get_post_meta( $post_id, 'blog_layout_showcase_choose_column_carousel' );
	$blog_layout_column_tablet = carbon_get_post_meta( $post_id, 'blog_layout_showcase_choose_column_tablet_carousel' );
	$blog_layout_column_mobile = carbon_get_post_meta( $post_id, 'blog_layout_showcase_choose_column_mobile_carousel' );

	$blog_layout_row = carbon_get_post_meta( $post_id, 'blog_layout_showcase_choose_row_carousel' );
	$blog_layout_row_tablet = carbon_get_post_meta( $post_id, 'blog_layout_showcase_choose_row_tablet_carousel' );
	$blog_layout_row_mobile = carbon_get_post_meta( $post_id, 'blog_layout_showcase_choose_row_mobile_carousel' );
	$scroll_mouse = carbon_get_post_meta( $post_id, 'blog_layout_scroll_mouse' );

	$spacebetween = carbon_get_post_meta( $post_id, 'blog_layout_showcase_padding' );
	$use_loop = carbon_get_post_meta( $post_id, 'blog_layout_use_loop' );
	$centered_slides = carbon_get_post_meta( $post_id, 'blog_layout_centered_slides' );
	//var_dump($showcase_style);
	if($spacebetween != "" || $spacebetween === 0) {
		$spacebetween = $spacebetween;
	} else {
		$spacebetween = 30;
	}

	$blog_layout_use_arrow = carbon_get_post_meta( $post_id, 'blog_layout_use_arrow' );
	$blog_layout_use_pagination = carbon_get_post_meta( $post_id, 'blog_layout_use_pagination' );
	$blog_layout_use_autoplay = carbon_get_post_meta( $post_id, 'blog_layout_use_autoplay' );
	$blog_layout_autoplay_speed = carbon_get_post_meta( $post_id, 'blog_layout_autoplay_speed' );

	if(!empty($blog_layout_autoplay_speed)) {
		$blog_layout_autoplay_speed = $blog_layout_autoplay_speed;
	} else {
		$blog_layout_autoplay_speed = 2500;
	}

	if($showcase_style == 'carousel-full-image-1' || $showcase_style == 'carousel-card-1' || $showcase_style == 'carousel-hiji' || $showcase_style == 'carousel-dua' || $showcase_style == 'carousel-tilu' || $showcase_style == 'carousel-opat' || $showcase_style == 'carousel-lima' || $showcase_style == 'carousel-genep' || $showcase_style == 'carousel-tujuh') { ?>
	<script>
	(function( $ ) {
		'use strict';
		$('.blog-post-<?php echo esc_attr($post_id); ?>.swiper-container').addClass('grid--loading');

		$(document).ready(function() {
		    var swiper = new Swiper('.blog-post-<?php echo esc_attr($post_id); ?>.swiper-container', {
		    	slidesPerView: '<?php echo esc_html($blog_layout_column_mobile); ?>',
		    	slidesPerColumn: '<?php echo esc_html($blog_layout_row_mobile); ?>',
		    	<?php if($use_loop == true) { ?>
		    	loop: true,
		    	<?php } ?>
		    	<?php if($centered_slides == true) { ?>
      			centeredSlides: true,
		    	<?php } ?>
		    	slidesPerColumnFill: 'group',
		    	spaceBetween: <?php echo intval($spacebetween); ?>,
		    	<?php if($blog_layout_use_autoplay == true) { ?>
		    	autoplay: {
			        delay: <?php echo intval($blog_layout_autoplay_speed); ?>,
			        disableOnInteraction: false,
		      	},
		      	<?php } ?>
			    breakpoints: {
			      	480: {
			        	slidesPerView: '<?php echo esc_html($blog_layout_column_mobile); ?>',
			        	spaceBetween: <?php echo intval($spacebetween); ?>,
		    			slidesPerColumn: '<?php echo esc_html($blog_layout_row_mobile); ?>',
			      	},
			      	640: {
			        	slidesPerView: '<?php echo esc_html($blog_layout_column_tablet); ?>',
		    			slidesPerColumn: '<?php echo esc_html($blog_layout_row_tablet); ?>',
			        	spaceBetween: <?php echo intval($spacebetween); ?>,
			      	},
			      	1025: {
			        	slidesPerView: '<?php echo esc_html($blog_layout_column); ?>',
			        	spaceBetween: <?php echo intval($spacebetween); ?>,
		    			slidesPerColumn: '<?php echo esc_html($blog_layout_row); ?>',
			      	}
			    },
			    <?php if($blog_layout_use_pagination == true) { ?>
		      	pagination: {
		      		clickable: true,
		        	el: '.blog-post-<?php echo esc_attr($post_id); ?> .swiper-pag',
		        	renderBullet: function (index, className) {
			          	return '<li class="' + className + '"><a></a></li>';
			        },
		      	},
		      	<?php } ?>
			    <?php if($blog_layout_use_arrow == true) { ?>
		      	navigation: {
			        nextEl: '.blog-post-<?php echo esc_attr($post_id); ?> .swiper-nav .next',
			        prevEl: '.blog-post-<?php echo esc_attr($post_id); ?> .swiper-nav .prev',
		      	},
		      	<?php } ?>
		      	<?php if($scroll_mouse == true) { ?>
				mousewheel: true,
		      	<?php } ?>
		      	on: {
		      		init: function () {
						if ($('.holder-box').length) {
							var imgHeight = $('.blog-post-<?php echo esc_attr($post_id); ?> .blog-post-item .blog-img').height();
							if ($('.blog-img').length) {
								$('.holder-box').css('height', imgHeight);
							}
							else {
								$('.holder-box').css('height', 400);
							}
						}
		      		}
		      	}
		    });

			$('.blog-post-<?php echo esc_attr($post_id); ?>.swiper-container').removeClass('grid--loading');
			$('.blog-post-<?php echo esc_attr($post_id); ?> .swiper-wrapper').addClass('animated__animated fadeIn');
		});

	})( jQuery );
	</script>
	<?php } elseif ($showcase_style == 'carousel-3d-full-image-1' || $showcase_style == 'carousel-3d-card-1') { ?>
	<script>
		(function( $ ) {
		'use strict';

		$('.blog-post-<?php echo esc_attr($post_id); ?>.swiper-container').addClass('grid--loading');

		$(document).ready( function() {
		    var swiper = new Swiper('.blog-post-<?php echo esc_attr($post_id); ?>.swiper-container', {
		    	effect: 'coverflow',
		    	slidesPerView: '<?php echo esc_html($blog_layout_column_mobile); ?>',
		    	slidesPerColumn: '<?php echo esc_html($blog_layout_row_mobile); ?>',
		      	coverflowEffect: {
			        rotate: 50,
			        stretch: 0,
			        depth: 100,
			        modifier: 1,
			        slideShadows : true,
		      	},
		    	<?php if($use_loop == true) { ?>
		    	loop: true,
		    	<?php } ?>
		    	<?php if($centered_slides == true) { ?>
      			centeredSlides: true,
		    	<?php } ?>
		    	slidesPerColumnFill: 'group',
		    	spaceBetween: <?php echo intval($spacebetween); ?>,
		    	<?php if($blog_layout_use_autoplay == true) { ?>
		    	autoplay: {
			        delay: <?php echo intval($blog_layout_autoplay_speed); ?>,
			        disableOnInteraction: false,
		      	},
		      	<?php } ?>
			    breakpoints: {
			      	480: {
			        	slidesPerView: '<?php echo esc_html($blog_layout_column_mobile); ?>',
			        	spaceBetween: <?php echo intval($spacebetween); ?>,
		    			slidesPerColumn: '<?php echo esc_html($blog_layout_row_mobile); ?>',
			      	},
			      	640: {
			        	slidesPerView: '<?php echo esc_html($blog_layout_column_tablet); ?>',
		    			slidesPerColumn: '<?php echo esc_html($blog_layout_row_tablet); ?>',
			        	spaceBetween: <?php echo intval($spacebetween); ?>,
			      	},
			      	1025: {
			        	slidesPerView: '<?php echo esc_html($blog_layout_column); ?>',
			        	spaceBetween: <?php echo intval($spacebetween); ?>,
		    			slidesPerColumn: '<?php echo esc_html($blog_layout_row); ?>',
			      	}
			    },
			    <?php if($blog_layout_use_pagination == true) { ?>
		      	pagination: {
		      		clickable: true,
		        	el: '.blog-post-<?php echo esc_attr($post_id); ?> .swiper-pag',
		        	renderBullet: function (index, className) {
			          	return '<li class="' + className + '"><a></a></li>';
			        },
		      	},
		      	<?php } ?>
			    <?php if($blog_layout_use_arrow == true) { ?>
		      	navigation: {
			        nextEl: '.blog-post-<?php echo esc_attr($post_id); ?> .swiper-nav .next',
			        prevEl: '.blog-post-<?php echo esc_attr($post_id); ?> .swiper-nav .prev',
		      	},
		      	<?php } ?>
		      	<?php if($scroll_mouse == true) { ?>
				mousewheel: true,
		      	<?php } ?>
		      	on: {
		      		init: function () {
						if ($('.holder-box').length) {
							var imgHeight = $('.blog-post-<?php echo esc_attr($post_id); ?> .blog-post-item .blog-img').height();
							if ($('.blog-img').length) {
								$('.holder-box').css('height', imgHeight);
							}
							else {
								$('.holder-box').css('height', 400);
							}
						}
		      		}
		      	}
		    });

			$('.blog-post-<?php echo esc_attr($post_id); ?>.swiper-container').removeClass('grid--loading');
			$('.blog-post-<?php echo esc_attr($post_id); ?> .swiper-wrapper').addClass('animated__animated fadeIn');
		});

	})( jQuery );
	</script>
	<?php }
}

function blog_layout_slider_script($post_id) {
	$scroll_mouse = carbon_get_post_meta( $post_id, 'blog_layout_scroll_mouse' );

	$spacebetween = carbon_get_post_meta( $post_id, 'blog_layout_showcase_padding' );
	$use_loop = carbon_get_post_meta( $post_id, 'blog_layout_use_loop' );
	$centered_slides = carbon_get_post_meta( $post_id, 'blog_layout_centered_slides' );
	if($spacebetween != "" || $spacebetween === 0) {
		$spacebetween = $spacebetween;
	} else {
		$spacebetween = 30;
	}

	$blog_layout_use_arrow = carbon_get_post_meta( $post_id, 'blog_layout_use_arrow' );
	$blog_layout_use_pagination = carbon_get_post_meta( $post_id, 'blog_layout_use_pagination' );
	$blog_layout_use_autoplay = carbon_get_post_meta( $post_id, 'blog_layout_use_autoplay' );
	$blog_layout_autoplay_speed = carbon_get_post_meta( $post_id, 'blog_layout_autoplay_speed' );

	if(!empty($blog_layout_autoplay_speed)) {
		$blog_layout_autoplay_speed = $blog_layout_autoplay_speed;
	} else {
		$blog_layout_autoplay_speed = 2500;
	} ?>
	<script>
	(function( $ ) {
		'use strict';

		$(document).ready(function() {
		    var swiper = new Swiper('.blog-post-<?php echo esc_attr($post_id); ?>.swiper-container', {
		    	slidesPerView: 1,
		    	effect: 'fade',
			    <?php if($blog_layout_use_pagination == true) { ?>
		      	pagination: {
		      		clickable: true,
		        	el: '.blog-post-<?php echo esc_attr($post_id); ?> .swiper-pag',
		        	renderBullet: function (index, className) {
			          	return '<li class="' + className + '"><a></a></li>';
			        },
		      	},
		      	<?php } ?>
		    	<?php //if($use_loop == true) { ?>
		    	loop: true,
		    	<?php //} ?>
			    <?php if($blog_layout_use_arrow == true) { ?>
		      	navigation: {
			        nextEl: '.blog-post-<?php echo esc_attr($post_id); ?> .swiper-nav .next',
			        prevEl: '.blog-post-<?php echo esc_attr($post_id); ?> .swiper-nav .prev',
		      	},
		      	<?php } ?>
		    });
		});

	})( jQuery );
	</script>
<?php }