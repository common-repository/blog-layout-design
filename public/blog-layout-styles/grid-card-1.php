<div class="blog-content blog-post-<?php echo esc_attr($showcase_id); ?> main-container blog-card-style<?php if ($blog_post_link_post == 'lightbox') { ?> lightbox-parent<?php } ?>">
	
	<?php 
	if (in_array('advanced-grid-blog-layout-design/advanced-grid-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		if($blog_layout_select_display_post == "category") {
			$blog_layout_showcase_cats = $blog_layout_showcase_cats;
		} elseif($blog_layout_select_display_post == "specific_post") {
			$blog_layout_showcase_cats = $blog_layout_showcase_category_filter;
		}
		ta_agbld_filter_grid_temp($use_filter, $blog_layout_showcase_cats, $blog_layout_select_display_post);
	} ?>

	<div class="blog-post-wrap grid-template clearfix">
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
			$image_portores =  aq_resize($img_url_porto[0],  $blog_img_width , $blog_img_height, true, true, true);
			$image_gallery = $img_url_porto[0];
		} else {
			$image_portores = '';
			$image_gallery = '';
		}

		$cats = array();
		foreach (get_the_category($post_id) as $c) {
			$cat = get_category($c);
			array_push($cats, $cat->slug);
		}

		if (sizeOf($cats) > 0) {
			$post_categories = implode(' ', $cats);
		} else {
			$post_categories = 'uncategorized';
		}

		$custom_link = carbon_get_post_meta( get_the_ID(), 'blog_custom_link' );

		if($blog_post_link_post == 'blog_item') {
			$link_post = get_permalink();
		} elseif ($blog_post_link_post == 'lightbox') {
			$link_post = $image_gallery;
		} elseif ($blog_post_link_post == 'lightbox_blog_item') {
			$link_post = "#";
		} else {
			if(!empty($custom_link)) {
				$link_post = $custom_link;
			} else {
				$link_post = get_permalink();
			}
		}

		$categories = get_the_category();

		?>
		<div class="blog-post-item column-<?php echo esc_attr($blog_layout_showcase_choose_column); ?> mobile-column-<?php echo esc_attr($blog_layout_showcase_choose_column_mobile); ?> tablet-column-<?php echo esc_attr($blog_layout_showcase_choose_column_tablet); ?> <?php echo sanitize_text_field($post_categories); ?>"<?php if ($blog_post_link_post == 'lightbox') { ?> data-src="<?php echo esc_attr($link_post); ?>"<?php } ?>>
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
							<div class="blog__content">
								<a <?php if ($blog_post_link_post == 'lightbox') { ?>href="" class="lightbox-image" title="<?php the_title(); ?>" data-src="<?php echo esc_attr($link_post); ?>"<?php } else { ?> href="<?php echo esc_url($link_post); ?>"<?php } ?>><i class="fas fa-arrow-right"></i></a>
							</div>
						</div>
					</figcaption>
				</figure>
				<div class="blog__content">
					<a <?php if ($blog_post_link_post == 'lightbox') { ?>href="" class="lightbox-image" title="<?php the_title(); ?>" data-src="<?php echo esc_attr($link_post); ?>"<?php } else { ?> href="<?php echo esc_url($link_post); ?>"<?php } ?>>
						<h3 class="ih-fade ih-delay-sm">
							<?php the_title(); ?>
						</h3>
					</a>
					<?php blog_layout_design_bio_categories($categories); ?>
				</div>
			</div>
		</div>

	<?php
	endwhile; wp_reset_postdata(); ?>
	</div>

	<!-- PAGINATION START -->
	<?php
	$pages = '';
	$range = 2;
	$showitems = ($range * 2)+1;
	if($pages == '')
	{
		$pages = $ta_portfo->max_num_pages;
		if(!$pages)
		{
			$pages = 1;
		}
	}
	if($blog_pagination_type == 'pagination_number') {
		if(1 != $pages)
		{

			echo "<div class='navigation-paging pagination-num clearfix'>";
				echo "<div class='container'>";
					if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='" . esc_url(get_pagenum_link(1)) . "'>" . esc_html__( 'First', 'blog-layout-design' ) . "</a>";
					if($paged > 1 && $showitems < $pages) echo "<a href='" . esc_url(get_pagenum_link($paged - 1)) . "'>&lsaquo;</a>";

					for ($i=1; $i <= $pages; $i++)
					{
						if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
						{
							echo ($paged == $i)? "<span class='btn current'>" . esc_html($i) . "</span>":"<a href='" . esc_url(get_pagenum_link($i)) ."' class='btn inactive' >" . esc_html($i) . "</a>";
						}
					}

					if ($paged < $pages && $showitems < $pages) echo "<a href='" . esc_url(get_pagenum_link($paged + 1)) . "' class='btn inactive'>&rsaquo;</a>";
					if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='" . esc_url(get_pagenum_link($pages)) . "' class='btn inactive'>" . esc_html__( 'Last', 'blog-layout-design' ) . "</a>";
				echo "</div>\n";
			echo "</div>\n";

		}
	}
	elseif($blog_pagination_type == 'pagination_default') {
		if(1 != $pages) { ?>
		<nav class="navigation-paging pagination pagination-page-template clearfix">
			<div class="container">
				<div class="post-navigation nav-previous pull-left">
					<?php echo next_posts_link( 'Next', $ta_portfo->max_num_pages ); ?>
				</div>
				<?php if ( get_previous_posts_link() ) : ?>
				<div class="post-navigation nav-next pull-right">
					<?php echo get_previous_posts_link( esc_html__( 'Prev', 'blog-layout-design' ) ); ?>
				</div>
				<?php endif; ?>
			</div>
		</nav>
	<?php }
	}
	elseif ($blog_pagination_type == 'blog_pagination_none') {} ?>

	<?php 
	if(in_array('advanced-grid-blog-layout-design/advanced-grid-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))){
		if($blog_layout_pagination_type == 'pagination_load_more') {
		if (!empty($blog_layout_text_load_more)) {
			$blog_layout_text_load_more = esc_html($blog_layout_text_load_more);
		} else {
			$blog_layout_text_load_more = esc_html__('Load More', 'blog-layout-design');
		} ?>
		<div class="container clearfix">
			<div class="navigation-paging infinite-wrap clearfix">
				<div id="load-more-loop-grid-1" class="infinite-button">
					<?php next_posts_link( '', $ta_blog_loop->max_num_pages ); ?>
				</div>
				<button id="load-infinite-loop-grid11" class="btn"><?php echo esc_html($blog_layout_text_load_more); ?></button>
			</div>
		</div>
		<?php } ?>

		<?php if($blog_layout_pagination_type == 'pagination_infinite') { ?>
		<div class="display-none">
			<div id="load-more-loop-grid-1" class="infinite-button">
				<?php next_posts_link( '', $ta_blog_loop->max_num_pages ); ?>
			</div>
			<button id="load-infinite-loop-grid11" class="btn"><?php echo esc_html__( 'Load More' ); ?></button>
		</div>
		<?php }
	} ?>

</div>

<?php

if(in_array('advanced-grid-blog-layout-design/advanced-grid-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))){
	wp_enqueue_script( 'agbld-advanced-grid-blog-layout-design-isotope', ADVANCED_GRID_BLOG_LAYOUT_DESIGN_URL . 'assets/js/isotope.min.js', array('jquery', 'imagesloaded'), '', false );
	wp_enqueue_script( 'agbld-advanced-grid-blog-layout-design-infinite-scroll',  ADVANCED_GRID_BLOG_LAYOUT_DESIGN_URL . 'assets/js/infinite-scroll.min.js', array('masonry'), '', false );

	if ($blog_post_link_post == 'lightbox') {
		wp_enqueue_style( 'agbld-advanced-grid-blog-layout-design-light-gallery', ADVANCED_GRID_BLOG_LAYOUT_DESIGN_URL . 'assets/css/lightgallery.css', array(), '', 'all' );
		wp_enqueue_script( 'agbld-advanced-grid-blog-layout-design-light-gallery',  ADVANCED_GRID_BLOG_LAYOUT_DESIGN_URL . 'assets/js/lightgallery.js', array('jquery'), '', false );
	}
}
else {
	wp_enqueue_script( array('jquery', 'masonry', 'imagesloaded'), '', false );
}

wp_enqueue_script( 'ta-blog-awesome-anime', plugin_dir_url( __DIR__ ) . '/js/anime.min.js', array('jquery'), '', false );

wp_enqueue_script( 'ta-blog-awesome-effect-grid', plugin_dir_url( __DIR__ ) . '/js/effect-grid.js', array('jquery'), '', false ); ?>

<?php 


if(class_exists('Elementor\Plugin')) {
	if (\Elementor\Plugin::$instance->editor->is_edit_mode() ) { ?>
	<script>
	(function($) {

		'use strict';

		$(document).ready(function(){
			var $grid = $('.blog-post-<?php echo esc_attr($showcase_id); ?> .grid-template').imagesLoaded().progress( function() {
				// init Masonry after all images have loaded
				$grid.masonry({
					transitionDuration: '0.65s',
					initLayout: true,
					columnWidth: '.blog-post-item',
					itemSelector: '.blog-post-item',
					stagger: 30,
					layoutMode: 'fitRows',
				});
			});

			if ($('.holder-box').length) {
				var imgWid = $('.blog-post-<?php echo esc_attr($showcase_id); ?> .blog-post-item').width();
				var imgHeight = $('.blog-post-<?php echo esc_attr($showcase_id); ?> .blog-post-item').height();
				$('.holder-box').css('width', imgWid);
				$('.holder-box').css('height', imgHeight);
			}
		});

	})( jQuery );
	</script>
	<?php }
	else { ?>
	<script>
	(function($) {

		'use strict';

		$('.blog-post-<?php echo esc_attr($showcase_id); ?> .grid-template').addClass('grid--loading');

		var body = document.querySelectorAll('.blog-post-<?php echo esc_attr($showcase_id); ?> .grid-template'),
			grids = [].slice.call(document.querySelectorAll('.blog-post-<?php echo esc_attr($showcase_id); ?> .grid-template')), masonry = [],
			currentGrid = 0,
			// The GridLoaderFx instances.
			loaders = [],
			loadingTimeout = setTimeout (500);


		function init() {
			// Preload images

			imagesLoaded('.blog-post-<?php echo esc_attr($showcase_id); ?> .grid-template', function() {
				// Initialize Masonry on each grid.

				var m = new Masonry('.blog-post-<?php echo esc_attr($showcase_id); ?> .grid-template', {
					transitionDuration: '0.65s',
					initLayout: true,
					columnWidth: '.blog-post-item',
					itemSelector: '.blog-post-item',
					stagger: 0,
					layoutMode: 'fitRows',

				});

				loaders.push(new GridLoaderFx(grids[currentGrid]));

				loaders[currentGrid]._render("<?php if(!empty($blog_layout_post_loading_grid)) { echo $blog_layout_post_loading_grid; } else { echo esc_html ('Hapi' ); } ?>");

				// Show current grid.
				grids[currentGrid].classList.remove('grid--loading');
			});
		}

		$(window).on('load', function () {
			init();
		});

	})( jQuery );
	</script>
		
	<?php if ($blog_post_link_post == 'lightbox') { ?>
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

		if (in_array('advanced-grid-blog-layout-design/advanced-grid-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
			ta_agbld_filter_grid_script($showcase_id, $use_filter, $blog_layout_pagination_type);
		}
	}
}
else { ?>
	<script>
	(function($) {

		'use strict';

		$('.blog-post-<?php echo esc_attr($showcase_id); ?> .grid-template').addClass('grid--loading');

		var body = document.querySelectorAll('.blog-post-<?php echo esc_attr($showcase_id); ?> .grid-template'),
			grids = [].slice.call(document.querySelectorAll('.blog-post-<?php echo esc_attr($showcase_id); ?> .grid-template')), masonry = [],
			currentGrid = 0,
			// The GridLoaderFx instances.
			loaders = [],
			loadingTimeout = setTimeout (500);


		function init() {
			// Preload images

			imagesLoaded('.blog-post-<?php echo esc_attr($showcase_id); ?> .grid-template', function() {
				// Initialize Masonry on each grid.

				var m = new Masonry('.blog-post-<?php echo esc_attr($showcase_id); ?> .grid-template', {
					transitionDuration: '0.65s',
					initLayout: true,
					columnWidth: '.blog-post-item',
					itemSelector: '.blog-post-item',
					stagger: 0,
					layoutMode: 'fitRows',

				});

				loaders.push(new GridLoaderFx(grids[currentGrid]));

				loaders[currentGrid]._render("<?php if(!empty($blog_layout_post_loading_grid)) { echo $blog_layout_post_loading_grid; } else { echo esc_html ('Hapi' ); } ?>");

				// Show current grid.
				grids[currentGrid].classList.remove('grid--loading');
			});
		}

		$(window).on('load', function () {
			init();
		});

	})( jQuery );
	</script>
		
	<?php if ($blog_post_link_post == 'lightbox') { ?>
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

	if (in_array('advanced-grid-blog-layout-design/advanced-grid-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		ta_agbld_filter_grid_script($showcase_id, $use_filter, $blog_layout_pagination_type);
	}
}
if(!has_post_thumbnail()) { ?>
	<script>
	(function($) {

		'use strict';
		$(document).on('ready', function () {
			if ($('.holder-box').length) {
				var imgHeight = $('.blog-post-<?php echo esc_attr($showcase_id); ?> .blog-post-item .blog-img').height();
				if ($('.blog-img').length) {
					$('.holder-box').css('height', imgHeight);
				}
				else {
					$('.holder-box').css('height', 400);
				}
			}
		});

	})( jQuery );
	</script>
<?php }
