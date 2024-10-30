<?php get_header();

global $wp;
if ( have_posts() ): ?>

	<div class="single-portfolio-wrap single-portfolio-showcase">

	<?php
		wp_enqueue_style( 'ta-blog-layout-design-fontawesome', plugin_dir_url(__FILE__ ) . 'public/css/fontawesome.min.css', array(), '', 'all' );
		wp_enqueue_style( 'ta-blog-layout-design-thaw-flexgrid', plugin_dir_url(__FILE__ ) . 'public/css/thaw-flexgrid.css', array(), '', 'all' );
		wp_enqueue_style( 'ta-blog-layout-design-swiper', plugin_dir_url(__FILE__ ) . 'public/css/swiper.css', array(), '', 'all' );
		wp_enqueue_style( 'ta-blog-layout-design-hover', plugin_dir_url(__FILE__ ) . 'public/css/hovers.css', array(), '', 'all' );
		wp_enqueue_style( 'ta-blog-layout-design', plugin_dir_url(__FILE__ ) . 'public/css/blog-layout-design-public.css', array(), '', 'all' );


		if(in_array('advanced-grid-blog-layout-design/advanced-grid-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))){
		    wp_enqueue_style( 'agpb-advanced-grid-blog-layout-design-styles', plugin_dir_url( __DIR__ ) . '/advanced-grid-blog-layout-design/assets/css/styles.css', array(), '', 'all' );
		}

		if(in_array('advanced-masonry-blog-layout-design/advanced-masonry-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))){
		    wp_enqueue_style( 'agpb-advanced-masonry-blog-layout-design-styles', plugin_dir_url( __DIR__ ) . '/advanced-masonry-blog-layout-design/assets/css/styles.css', array(), '', 'all' );
		}

		if(in_array('advanced-carousel-blog-layout-design/advanced-carousel-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))){
		    wp_enqueue_style( 'agpb-advanced-carousel-blog-layout-design-styles', plugin_dir_url( __DIR__ ) . '/advanced-carousel-blog-layout-design/assets/css/styles.css', array(), '', 'all' );
		}

		if(in_array('advanced-slider-blog-layout-design/advanced-slider-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))){
		    wp_enqueue_style( 'agpb-advanced-slider-blog-layout-design-styles', plugin_dir_url( __DIR__ ) . '/advanced-slider-blog-layout-design/assets/css/styles.css', array(), '', 'all' );
		}

		wp_enqueue_script( 'jquery');
		wp_enqueue_script( 'masonry');

		$showcase_id = get_the_ID();

		$ta_ids = array();

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

		// COLUMN SETTING
		$blog_layout_showcase_choose_column = carbon_get_post_meta( get_the_ID(), 'blog_layout_showcase_choose_column' );
		$blog_layout_showcase_choose_column_tablet = carbon_get_post_meta( get_the_ID(), 'blog_layout_showcase_choose_column_tablet' );
		$blog_layout_showcase_choose_column_mobile = carbon_get_post_meta( get_the_ID(), 'blog_layout_showcase_choose_column_mobile' );

		// CAROUSEL

		$blog_layout_use_pagination = carbon_get_post_meta( get_the_ID(), 'blog_layout_use_pagination' );
		$blog_layout_use_arrow = carbon_get_post_meta( get_the_ID(), 'blog_layout_use_arrow' );
		$blog_layout_select_dot = carbon_get_post_meta( get_the_ID(), 'blog_layout_select_dot' );
		$blog_layout_select_arrow = carbon_get_post_meta( get_the_ID(), 'blog_layout_select_arrow' );

		$blog_layout_column_carousel = carbon_get_post_meta( get_the_ID(), 'blog_layout_showcase_choose_column_carousel' );

		// IMAGE SETTING
		$blog_img_width = carbon_get_post_meta( get_the_ID(), 'blog_layout_width_image' );
		$blog_img_height = carbon_get_post_meta( get_the_ID(), 'blog_layout_height_image' );

		// LINK GOES TO
		$blog_post_link_post = carbon_get_post_meta( get_the_ID(), 'blog_layout_select_link_post' );

		if(!empty($blog_layout_post_per_page)) {
			$blog_layout_post_per_page = $blog_layout_post_per_page;
		} else {
			$blog_layout_post_per_page = -1;
		}

    	$blog_layout_showcase_cats = carbon_get_post_meta( get_the_ID(), 'blog_layout_showcase_cats' );
    	$blog_layout_select_display_post = carbon_get_post_meta( get_the_ID(), 'blog_layout_select_display_post' );
    	$blog_layout_showcase_posts = carbon_get_post_meta( get_the_ID(), 'blog_layout_showcase_posts' );


	    // PAGINATION & FILTER
	    $blog_layout_text_load_more = carbon_get_post_meta( get_the_ID(), 'blog_layout_text_load_more' );
	    $blog_layout_pagination_type = carbon_get_post_meta( get_the_ID(), 'blog_layout_pagination_type' );
		$use_filter = carbon_get_post_meta( get_the_ID(), 'blog_layout_design_use_filter' );
	    $blog_layout_showcase_category_filter = carbon_get_post_meta( get_the_ID(), 'blog_layout_showcase_category_filter' );
	    $button_text = carbon_get_post_meta( get_the_ID(), 'blog_layout_button_content' );

        // ID PORTFOLIO
        if($blog_layout_select_display_post == 'specific_post') {
            foreach ($blog_layout_showcase_posts as $ta_posts) {
                $ta_ids[] = $ta_posts['id'];
            }
        }


		while ( have_posts() ) : the_post();

				if ( get_query_var( 'paged' ) ) { $paged = get_query_var( 'paged' ); }
				elseif ( get_query_var( 'page' ) ) { $paged = get_query_var( 'page' ); }
				else { $paged = 1; }

				// if by specific post
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
					include dirname( __FILE__ ) .'/public/blog-layout-styles/grid-full-image-1.php';
				}
				elseif($blog_style == 'grid-card-1') {
					include dirname( __FILE__ ) .'/public/blog-layout-styles/grid-card-1.php';
				}
		        elseif($blog_style == 'grid-hiji') {
		            include plugin_dir_path( __DIR__ ) .'advanced-grid-blog-layout-design/templates/grid-hiji.php';
		        }
		        elseif($blog_style == 'grid-dua') {
		            include plugin_dir_path( __DIR__ ) .'advanced-grid-blog-layout-design/templates/grid-dua.php';
		        }
		        elseif($blog_style == 'grid-tilu') {
		            include plugin_dir_path( __DIR__ ) .'advanced-grid-blog-layout-design/templates/grid-tilu.php';
		        }
		        elseif($blog_style == 'grid-opat') {
		            include plugin_dir_path( __DIR__ ) .'advanced-grid-blog-layout-design/templates/grid-opat.php';
		        }
		        elseif($blog_style == 'grid-lima') {
		            include plugin_dir_path( __DIR__ ) .'advanced-grid-blog-layout-design/templates/grid-lima.php';
		        }
		        elseif($blog_style == 'grid-genep') {
		            include plugin_dir_path( __DIR__ ) .'advanced-grid-blog-layout-design/templates/grid-genep.php';
		        }
		        elseif($blog_style == 'grid-tujuh') {
		            include plugin_dir_path( __DIR__ ) .'advanced-grid-blog-layout-design/templates/grid-tujuh.php';
		        }
				elseif($blog_style == 'masonry-full-image-1') {
					include dirname( __FILE__ ) .'/public/blog-layout-styles/masonry-full-image-1.php';
				}
				elseif($blog_style == 'masonry-card-1') {
					include dirname( __FILE__ ) .'/public/blog-layout-styles/masonry-card-1.php';
				}
		        elseif($blog_style == 'masonry-hiji') {
		            include plugin_dir_path( __DIR__ ) .'advanced-masonry-blog-layout-design/templates/masonry-hiji.php';
		        }
		        elseif($blog_style == 'masonry-dua') {
		            include plugin_dir_path( __DIR__ ) .'advanced-masonry-blog-layout-design/templates/masonry-dua.php';
		        }
		        elseif($blog_style == 'masonry-tilu') {
		            include plugin_dir_path( __DIR__ ) .'advanced-masonry-blog-layout-design/templates/masonry-tilu.php';
		        }
		        elseif($blog_style == 'masonry-opat') {
		            include plugin_dir_path( __DIR__ ) .'advanced-masonry-blog-layout-design/templates/masonry-opat.php';
		        }
		        elseif($blog_style == 'masonry-lima') {
		            include plugin_dir_path( __DIR__ ) .'advanced-masonry-blog-layout-design/templates/masonry-lima.php';
		        }
		        elseif($blog_style == 'masonry-genep') {
		            include plugin_dir_path( __DIR__ ) .'advanced-masonry-blog-layout-design/templates/masonry-genep.php';
		        }
		        elseif($blog_style == 'masonry-tujuh') {
		            include plugin_dir_path( __DIR__ ) .'advanced-masonry-blog-layout-design/templates/masonry-tujuh.php';
		        }
				elseif($blog_style == 'carousel-full-image-1') {
					include dirname( __FILE__ ) .'/public/blog-layout-styles/carousel-full-image-1.php';
				}
		        elseif($blog_style == 'carousel-card-1') {
		            include dirname( __FILE__ ) .'/public/blog-layout-styles/carousel-card-1.php';
		        }
		        elseif($blog_style == 'carousel-hiji') {
		            include plugin_dir_path( __DIR__ ) .'advanced-carousel-blog-layout-design/templates/carousel-hiji.php';
		        }
		        elseif($blog_style == 'carousel-dua') {
		            include plugin_dir_path( __DIR__ ) .'advanced-carousel-blog-layout-design/templates/carousel-dua.php';
		        }
		        elseif($blog_style == 'carousel-tilu') {
		            include plugin_dir_path( __DIR__ ) .'advanced-carousel-blog-layout-design/templates/carousel-tilu.php';
		        }
		        elseif($blog_style == 'carousel-opat') {
		            include plugin_dir_path( __DIR__ ) .'advanced-carousel-blog-layout-design/templates/carousel-opat.php';
		        }
		        elseif($blog_style == 'carousel-lima') {
		            include plugin_dir_path( __DIR__ ) .'advanced-carousel-blog-layout-design/templates/carousel-lima.php';
		        }
		        elseif($blog_style == 'carousel-genep') {
		            include plugin_dir_path( __DIR__ ) .'advanced-carousel-blog-layout-design/templates/carousel-genep.php';
		        }
		        elseif($blog_style == 'special-hiji-carousel') {
		            include plugin_dir_path( __DIR__ ) .'advanced-carousel-blog-layout-design/templates/special-hiji.php';
		        }
		        elseif($blog_style == 'special-dua-carousel') {
		            include plugin_dir_path( __DIR__ ) .'advanced-carousel-blog-layout-design/templates/special-dua.php';
		        }
		        elseif($blog_style == 'special-tilu-carousel') {
		            include plugin_dir_path( __DIR__ ) .'advanced-carousel-blog-layout-design/templates/special-tilu.php';
		        }
		        elseif($blog_style == 'special-opat-carousel') {
		            include plugin_dir_path( __DIR__ ) .'advanced-carousel-blog-layout-design/templates/special-opat.php';
		        }
		        elseif($blog_style == 'carousel-3d-full-image-1') {
		            include dirname( __FILE__ ) .'/public/blog-layout-styles/carousel-full-image-1.php';
		        }
		        elseif($blog_style == 'carousel-3d-card-1') {
		            include dirname( __FILE__ ) .'/public/blog-layout-styles/carousel-card-1.php';
		        }
		        elseif($blog_style == 'slider-full-image-1') {
		            include dirname( __FILE__ ) .'/public/blog-layout-styles/slider-full-image-1.php';
		        }
		        elseif($blog_style == 'slider-hiji') {
		            include plugin_dir_path( __DIR__ ) .'advanced-slider-blog-layout-design/templates/slider-hiji.php';
		        }
		        elseif($blog_style == 'slider-dua') {
		            include plugin_dir_path( __DIR__ ) .'advanced-slider-blog-layout-design/templates/slider-dua.php';
		        }
		        elseif($blog_style == 'slider-tilu') {
		            include plugin_dir_path( __DIR__ ) .'advanced-slider-blog-layout-design/templates/slider-tilu.php';
		        }
		        elseif($blog_style == 'slider-opat') {
		            include plugin_dir_path( __DIR__ ) .'advanced-slider-blog-layout-design/templates/slider-opat.php';
		        }
		        elseif($blog_style == 'slider-lima') {
		            include plugin_dir_path( __DIR__ ) .'advanced-slider-blog-layout-design/templates/slider-lima.php';
		        }
		        elseif($blog_style == 'slider-genep') {
		            include plugin_dir_path( __DIR__ ) .'advanced-slider-blog-layout-design/templates/slider-genep.php';
		        }
		        elseif($blog_style == 'slider-tujuh') {
		            include plugin_dir_path( __DIR__ ) .'advanced-slider-blog-layout-design/templates/slider-tujuh.php';
		        }
		        elseif($blog_style == 'slider-dalapan') {
		            include plugin_dir_path( __DIR__ ) .'advanced-slider-blog-layout-design/templates/slider-dalapan.php';
		        }
		        elseif($blog_style == 'slider-salapan') {
		            include plugin_dir_path( __DIR__ ) .'advanced-slider-blog-layout-design/templates/slider-salapan.php';
		        }
		        elseif($blog_style == 'slider-sapuluh') {
		            include plugin_dir_path( __DIR__ ) .'advanced-slider-blog-layout-design/templates/slider-sapuluh.php';
		        }
		        elseif($blog_style == 'justified-full-image-1') {
		            include dirname( __FILE__ ) .'/public/blog-layout-styles/justified-full-image-1.php';
		        }
		        elseif($blog_style == 'justified-hiji') {
		            include plugin_dir_path( __DIR__ ) .'advanced-justified-blog-layout-design/templates/justified-hiji.php';
		        }
		        elseif($blog_style == 'justified-dua') {
		            include plugin_dir_path( __DIR__ ) .'advanced-justified-blog-layout-design/templates/justified-dua.php';
		        }
		        elseif($blog_style == 'justified-tilu') {
		            include plugin_dir_path( __DIR__ ) .'advanced-justified-blog-layout-design/templates/justified-tilu.php';
		        }
		        elseif($blog_style == 'justified-opat') {
		            include plugin_dir_path( __DIR__ ) .'advanced-justified-blog-layout-design/templates/justified-opat.php';
		        }
		        elseif($blog_style == 'justified-lima') {
		            include plugin_dir_path( __DIR__ ) .'advanced-justified-blog-layout-design/templates/justified-lima.php';
		        }
		        elseif($blog_style == 'justified-genep') {
		            include plugin_dir_path( __DIR__ ) .'advanced-justified-blog-layout-design/templates/justified-genep.php';
		        }

			endif;

		endwhile; ?>
	</div>
<?php
endif;
wp_reset_postdata();
get_footer(); ?>