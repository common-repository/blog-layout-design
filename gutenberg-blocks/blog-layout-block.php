<?php
global $post;
$ta_ids = $fields['blog_layout_gutenberg_block'][0]['id'];

// SHOWCASE ID
$showcase_id = $ta_ids;

// ID PORTFOLIO

$args = array (
	'p'              => $showcase_id,     // GET POST BY SLUG  // IGNORE IF YOU ARE GETTING ERROR ON THIS LINE IN YOUR EDITOR
	'post_type'         => 'blogshowcase-design', // YOUR POST TYPE

);

// The Query
$query = new WP_Query( $args );

// The Loop
if ( $query->have_posts() && $ta_ids != '' ) {

	wp_enqueue_style( 'ta-blog-layout-design-fontawesome', plugin_dir_url('README.txt') . BLOG_LAYOUT_DESIGN_NAME . '/public/css/fontawesome.min.css', array(), '', 'all' );

	wp_enqueue_style( 'ta-blog-layout-design-thaw-flexgrid', plugin_dir_url('README.txt') . BLOG_LAYOUT_DESIGN_NAME . '/public/css/thaw-flexgrid.css', array(), '', 'all' );

	wp_enqueue_style( 'ta-blog-layout-design-swiper', plugin_dir_url('README.txt') . BLOG_LAYOUT_DESIGN_NAME . '/public/css/swiper.css', array(), '', 'all' );

	wp_enqueue_style( 'ta-blog-layout-design-hover', plugin_dir_url('README.txt') . BLOG_LAYOUT_DESIGN_NAME . '/public/css/hovers.css', array(), '', 'all' );

    $advanced_grid_path = '';
	if(in_array('advanced-grid-blog-layout-design/advanced-grid-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
	    wp_enqueue_style( 'agbld-advanced-grid-blog-layout-design-styles', plugin_dir_url('README.txt') .'/advanced-grid-blog-layout-design/assets/css/styles.css', array(), '', 'all' );

        $advanced_grid_path = ADVANCED_GRID_BLOG_LAYOUT_DESIGN_PATH;
	}

    $advanced_masonry_path = '';
	if(in_array('advanced-masonry-blog-layout-design/advanced-masonry-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
	    wp_enqueue_style( 'ambld-advanced-masonry-blog-layout-design-styles', plugin_dir_url('README.txt') .'/advanced-masonry-blog-layout-design/assets/css/styles.css', array(), '', 'all' );
	    
        $advanced_masonry_path = ADVANCED_MASONRY_BLOG_LAYOUT_DESIGN_PATH;
	}

    $advanced_carousel_path = '';
	if(in_array('advanced-carousel-blog-layout-design/advanced-carousel-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
	    wp_enqueue_style( 'acbld-advanced-carousel-blog-layout-design-styles', plugin_dir_url('README.txt') .'/advanced-carousel-blog-layout-design/assets/css/styles.css', array(), '', 'all' );
	    
        $advanced_carousel_path = ADVANCED_CAROUSEL_BLOG_LAYOUT_DESIGN_PATH;
	}

    $advanced_slider_path = '';
	if(in_array('advanced-slider-blog-layout-design/advanced-slider-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
	    wp_enqueue_style( 'asbld-advanced-slider-blog-layout-design-styles', plugin_dir_url('README.txt') .'/advanced-slider-blog-layout-design/assets/css/styles.css', array(), '', 'all' );
	    
        $advanced_slider_path = ADVANCED_SLIDER_BLOG_LAYOUT_DESIGN_PATH;
	}

    $advanced_justified_path = '';
	if(in_array('advanced-justified-blog-layout-design/advanced-justified-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
	    wp_enqueue_style( 'ajbld-advanced-justified-blog-layout-design-styles', plugin_dir_url('README.txt') .'/advanced-justified-blog-layout-design/assets/css/styles.css', array(), '', 'all' );
	    
        $advanced_justified_path = ADVANCED_JUSTIFIED_BLOG_LAYOUT_DESIGN_PATH;
	}

	while ( $query->have_posts() ) {

		$query->the_post();

		$ta_ids = array();

		// SHOWCASE ID
		$showcase_id = get_the_ID();

		// OPTION LAYOUT
		$blog_style_main = carbon_get_post_meta( get_the_ID(), 'blog_layout_design_showcase_style_main' );
		if($blog_style_main == 'grid') {
			$blog_style = carbon_get_post_meta( get_the_ID(), 'blog_layout_design_showcase_style' );
		}
		elseif($blog_style_main == 'masonry') {
			$blog_style = carbon_get_post_meta( get_the_ID(), 'blog_layout_design_showcase_style2' );
		}
	    elseif($blog_style_main == 'carousel') {
	        $blog_style = carbon_get_post_meta( get_the_ID(), 'blog_layout_design_showcase_style3' );
	    }
	    elseif($blog_style_main == 'justified') {
	        $blog_style = carbon_get_post_meta( get_the_ID(), 'blog_layout_design_showcase_style4' );
	    }
	    elseif($blog_style_main == 'slider') {
	        $blog_style = carbon_get_post_meta( get_the_ID(), 'blog_layout_design_showcase_style5' );
	    }

		// POST SETTING
		$blog_layout_post_hover = carbon_get_post_meta( get_the_ID(), 'blog_layout_showcase_hover' );
		$blog_layout_post_loading_grid = carbon_get_post_meta( get_the_ID(), 'blog_layout_showcase_loading_grid' );
		$blog_layout_post_per_page = carbon_get_post_meta( get_the_ID(), 'blog_layout_showcase_items' );
		$blog_layout_showcase_order = carbon_get_post_meta( get_the_ID(), 'blog_layout_showcase_order' );
		$blog_layout_showcase_order_by = carbon_get_post_meta( get_the_ID(), 'blog_layout_showcase_order_by' );

		// PAGINATION
		$blog_layout_pagination_type = carbon_get_post_meta( get_the_ID(), 'blog_layout_pagination_type' );

		// CAROUSEL

		$blog_layout_use_pagination = carbon_get_post_meta( get_the_ID(), 'blog_layout_use_pagination' );
		$blog_layout_use_arrow = carbon_get_post_meta( get_the_ID(), 'blog_layout_use_arrow' );
		$blog_layout_select_dot = carbon_get_post_meta( get_the_ID(), 'blog_layout_select_dot' );
		$blog_layout_select_arrow = carbon_get_post_meta( get_the_ID(), 'blog_layout_select_arrow' );

		$blog_layout_column_carousel = carbon_get_post_meta( get_the_ID(), 'blog_layout_showcase_choose_column_carousel' );

		// COLUMN SETTING
		$blog_layout_showcase_choose_column = carbon_get_post_meta( get_the_ID(), 'blog_layout_showcase_choose_column' );
		$blog_layout_showcase_choose_column_tablet = carbon_get_post_meta( get_the_ID(), 'blog_layout_showcase_choose_column_tablet' );
		$blog_layout_showcase_choose_column_mobile = carbon_get_post_meta( get_the_ID(), 'blog_layout_showcase_choose_column_mobile' );

		// IMAGE SETTING
		$blog_img_width = carbon_get_post_meta( get_the_ID(), 'blog_layout_width_image' );
		$blog_img_height = carbon_get_post_meta( get_the_ID(), 'blog_layout_height_image' );

		// LINK GOES TO
		$blog_post_link_post = carbon_get_post_meta( get_the_ID(), 'blog_layout_select_link_post' );

    	$blog_layout_showcase_cats = carbon_get_post_meta( get_the_ID(), 'blog_layout_showcase_cats' );
    	$blog_layout_select_display_post = carbon_get_post_meta( get_the_ID(), 'blog_layout_select_display_post' );
    	$blog_layout_showcase_posts = carbon_get_post_meta( get_the_ID(), 'blog_layout_showcase_posts' );

        // ID PORTFOLIO
        if($blog_layout_select_display_post == 'specific_post') {
            foreach ($blog_layout_showcase_posts as $ta_posts) {
                $ta_ids[] = $ta_posts['id'];
            }
        }

	    // PAGINATION & FILTER
	    $blog_layout_text_load_more = carbon_get_post_meta( get_the_ID(), 'blog_layout_text_load_more' );
	    $blog_layout_pagination_type = carbon_get_post_meta( get_the_ID(), 'blog_layout_pagination_type' );
		$use_filter = carbon_get_post_meta( get_the_ID(), 'blog_layout_design_use_filter' );
	    $blog_layout_showcase_category_filter = carbon_get_post_meta( get_the_ID(), 'blog_layout_showcase_category_filter' );
	    $button_text = carbon_get_post_meta( get_the_ID(), 'blog_layout_button_content' );

		if ( get_query_var( 'paged' ) ) { $paged = get_query_var( 'paged' ); }
		elseif ( get_query_var( 'page' ) ) { $paged = get_query_var( 'page' ); }
		else { $paged = 1; }

		// WP_Query arguments
		if ($blog_layout_select_display_post == 'specific_post') {
			$port_args = array (
                'post__in' => $ta_ids,     // GET POST BY SLUG  // IGNORE IF YOU ARE GETTING ERROR ON THIS LINE IN YOUR EDITOR
                'orderby'  => 'post__in',
				'post_type'       => 'post', // YOUR POST TYPE
				'paged'             => $paged, // PAGED
				'ignore_sticky_posts' => true,
				'posts_per_page'       => $blog_layout_post_per_page, // POSTS PER PAGE
			);
		} elseif ($blog_layout_select_display_post == 'category') {
			$port_args = array (
				'post_status'     => 'publish',
				'post_type'       => 'post', // YOUR POST TYPE
				'paged'             => $paged, // PAGED
				'ignore_sticky_posts' => true,
				'posts_per_page'       => $blog_layout_post_per_page, // POSTS PER PAGE
				'orderby'   => $blog_layout_showcase_order,
				'order'   => $blog_layout_showcase_order_by,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'slug',
                        'terms'    => $blog_layout_showcase_cats,
                    ),
                ),
			);
		} else {
			$port_args = array (
				'post_status'     => 'publish',
				'post_type'       => 'post', // YOUR POST TYPE
				'paged'             => $paged, // PAGED
				'ignore_sticky_posts' => true,
				'posts_per_page'       => $blog_layout_post_per_page, // POSTS PER PAGE
				'orderby'   => $blog_layout_showcase_order,
				'order'   => $blog_layout_showcase_order_by,
			);
		}

		// The Query
		$ta_blog_loop = new WP_Query( $port_args );

		// The Loop
		if ( $ta_blog_loop->have_posts() ) :

			if($blog_style == 'grid-full-image-1') {
				$blog_style_part = BLOG_LAYOUT_DESIGN_DIR .'/public/blog-layout-styles/grid-full-image-1.php';
			}
			elseif($blog_style == 'grid-card-1') {
				$blog_style_part = BLOG_LAYOUT_DESIGN_DIR .'/public/blog-layout-styles/grid-card-1.php';
			}
		    elseif($blog_style == 'grid-hiji') {
		        $blog_style_part = $advanced_grid_path . 'templates/grid-hiji.php';
		    }
		    elseif($blog_style == 'grid-dua') {
		        $blog_style_part = $advanced_grid_path . 'templates/grid-dua.php';
		    }
		    elseif($blog_style == 'grid-tilu') {
		        $blog_style_part = $advanced_grid_path . 'templates/grid-tilu.php';
		    }
		    elseif($blog_style == 'grid-opat') {
		        $blog_style_part = $advanced_grid_path . 'templates/grid-opat.php';
		    }
		    elseif($blog_style == 'grid-lima') {
		        $blog_style_part = $advanced_grid_path . 'templates/grid-lima.php';
		    }
		    elseif($blog_style == 'grid-genep') {
		        $blog_style_part = $advanced_grid_path . 'templates/grid-genep.php';
		    }
		    elseif($blog_style == 'grid-tujuh') {
		        $blog_style_part = $advanced_grid_path . 'templates/grid-tujuh.php';
		    }
			elseif($blog_style == 'masonry-full-image-1') {
				$blog_style_part = BLOG_LAYOUT_DESIGN_DIR .'/public/blog-layout-styles/masonry-full-image-1.php';
			}
			elseif($blog_style == 'masonry-card-1') {
				$blog_style_part = BLOG_LAYOUT_DESIGN_DIR .'/public/blog-layout-styles/masonry-card-1.php';
			}
		    elseif($blog_style == 'masonry-hiji') {
		        $blog_style_part = $advanced_masonry_path . 'templates/masonry-hiji.php';
		    }
		    elseif($blog_style == 'masonry-dua') {
		        $blog_style_part = $advanced_masonry_path . 'templates/masonry-dua.php';
		    }
		    elseif($blog_style == 'masonry-tilu') {
		        $blog_style_part = $advanced_masonry_path . 'templates/masonry-tilu.php';
		    }
		    elseif($blog_style == 'masonry-opat') {
		        $blog_style_part = $advanced_masonry_path . 'templates/masonry-opat.php';
		    }
		    elseif($blog_style == 'masonry-lima') {
		        $blog_style_part = $advanced_masonry_path . 'templates/masonry-lima.php';
		    }
		    elseif($blog_style == 'masonry-genep') {
		        $blog_style_part = $advanced_masonry_path . 'templates/masonry-genep.php';
		    }
		    elseif($blog_style == 'masonry-tujuh') {
		        $blog_style_part = $advanced_masonry_path . 'templates/masonry-tujuh.php';
		    }
			elseif($blog_style == 'carousel-full-image-1') {
				$blog_style_part = BLOG_LAYOUT_DESIGN_DIR .'/public/blog-layout-styles/carousel-full-image-1.php';
			}
			elseif($blog_style == 'carousel-3d-full-image-1') {
				$blog_style_part = BLOG_LAYOUT_DESIGN_DIR .'/public/blog-layout-styles/carousel-full-image-1.php';
			}
		    elseif($blog_style == 'carousel-hiji') {
		        $blog_style_part = $advanced_carousel_path . 'templates/carousel-hiji.php';
		    }
		    elseif($blog_style == 'carousel-dua') {
		        $blog_style_part = $advanced_carousel_path . 'templates/carousel-dua.php';
		    }
		    elseif($blog_style == 'carousel-tilu') {
		        $blog_style_part = $advanced_carousel_path . 'templates/carousel-tilu.php';
		    }
		    elseif($blog_style == 'carousel-opat') {
		        $blog_style_part = $advanced_carousel_path . 'templates/carousel-opat.php';
		    }
		    elseif($blog_style == 'carousel-lima') {
		        $blog_style_part = $advanced_carousel_path . 'templates/carousel-lima.php';
		    }
		    elseif($blog_style == 'carousel-genep') {
		        $blog_style_part = $advanced_carousel_path . 'templates/carousel-genep.php';
		    }
		    elseif($blog_style == 'carousel-tujuh') {
		        $blog_style_part = $advanced_carousel_path . 'templates/carousel-tujuh.php';
		    }
		    elseif($blog_style == 'special-hiji-carousel') {
		        $blog_style_part = $advanced_carousel_path . 'templates/special-hiji-carousel.php';
		    }
		    elseif($blog_style == 'special-dua-carousel') {
		        $blog_style_part = $advanced_carousel_path . 'templates/special-dua-carousel.php';
		    }
		    elseif($blog_style == 'special-tilu-carousel') {
		        $blog_style_part = $advanced_carousel_path . 'templates/special-tilu-carousel.php';
		    }
			elseif($blog_style == 'slider-full-image-1') {
				$blog_style_part = BLOG_LAYOUT_DESIGN_DIR .'/public/blog-layout-styles/slider-full-image-1.php';
			}
		    elseif($blog_style == 'slider-hiji') {
		        $blog_style_part = $advanced_slider_path . 'templates/slider-hiji.php';
		    }
		    elseif($blog_style == 'slider-dua') {
		        $blog_style_part = $advanced_slider_path . 'templates/slider-dua.php';
		    }
		    elseif($blog_style == 'slider-tilu') {
		        $blog_style_part = $advanced_slider_path . 'templates/slider-tilu.php';
		    }
		    elseif($blog_style == 'slider-opat') {
		        $blog_style_part = $advanced_slider_path . 'templates/slider-opat.php';
		    }
		    elseif($blog_style == 'slider-lima') {
		        $blog_style_part = $advanced_slider_path . 'templates/slider-lima.php';
		    }
		    elseif($blog_style == 'slider-genep') {
		        $blog_style_part = $advanced_slider_path . 'templates/slider-genep.php';
		    }
		    elseif($blog_style == 'slider-tujuh') {
		        $blog_style_part = $advanced_slider_path . 'templates/slider-tujuh.php';
		    }
		    elseif($blog_style == 'slider-dalapan') {
		        $blog_style_part = $advanced_slider_path . 'templates/slider-dalapan.php';
		    }
		    elseif($blog_style == 'slider-salapan') {
		        $blog_style_part = $advanced_slider_path . 'templates/slider-salapan.php';
		    }
		    elseif($blog_style == 'slider-sapuluh') {
		        $blog_style_part = $advanced_slider_path . 'templates/slider-sapuluh.php';
		    }
			elseif($blog_style == 'justified-full-image-1') {
				$blog_style_part = BLOG_LAYOUT_DESIGN_DIR .'/public/blog-layout-styles/justified-full-image-1.php';
			}
		    elseif($blog_style == 'justified-hiji') {
		        $blog_style_part = $advanced_justified_path . 'templates/justified-hiji.php';
		    }
		    elseif($blog_style == 'justified-dua') {
		        $blog_style_part = $advanced_justified_path . 'templates/justified-dua.php';
		    }
		    elseif($blog_style == 'justified-tilu') {
		        $blog_style_part = $advanced_justified_path . 'templates/justified-tilu.php';
		    }
		    elseif($blog_style == 'justified-opat') {
		        $blog_style_part = $advanced_justified_path . 'templates/justified-opat.php';
		    }
		    elseif($blog_style == 'justified-lima') {
		        $blog_style_part = $advanced_justified_path . 'templates/justified-lima.php';
		    }
		    elseif($blog_style == 'justified-genep') {
		        $blog_style_part = $advanced_justified_path . 'templates/justified-genep.php';
		    }
			include $blog_style_part;

		endif;

	} wp_reset_postdata();
} else {
	// no posts found
	return esc_html__( 'Sorry You have set no html for this slug...', 'blog-layout-design' );

}