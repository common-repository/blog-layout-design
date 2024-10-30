<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://themesawesome.com/
 * @since             1.0.0
 * @package           Blog_Layout_Awesome
 *
 * @wordpress-plugin
 * Plugin Name:       Blog Layout Design
 * Plugin URI:        https://bloglayout.themesawesome.com/
 * Description:       Create stunning blog layout without headache
 * Version:           1.0.7
 * Author:            Themes Awesome
 * Author URI:        https://themesawesome.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       blog-layout-design
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'BLOG_LAYOUT_DESIGN_VERSION', '1.0.7' );

define( 'BLOG_LAYOUT_DESIGN', __FILE__ );

define( 'BLOG_LAYOUT_DESIGN_BASENAME', plugin_basename( BLOG_LAYOUT_DESIGN ) );

define( 'BLOG_LAYOUT_DESIGN_DIR', untrailingslashit( dirname( BLOG_LAYOUT_DESIGN ) ) );

define( 'BLOG_LAYOUT_DESIGN_NAME', plugin_basename( dirname(__FILE__) ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-blog-layout-design-activator.php
 */
function activate_blog_layout_design() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-blog-layout-design-activator.php';
	Blog_Layout_Awesome_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-blog-layout-design-deactivator.php
 */
function deactivate_blog_layout_design() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-blog-layout-design-deactivator.php';
	Blog_Layout_Awesome_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_blog_layout_design' );
register_deactivation_hook( __FILE__, 'deactivate_blog_layout_design' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-blog-layout-design.php';

require plugin_dir_path( __FILE__ ) . 'blog-layout-design-post-type.php';

require_once plugin_dir_path( __FILE__ ).'includes/element-helper.php';
require_once plugin_dir_path( __FILE__ ).'public/partials/get-views-part.php';
require_once plugin_dir_path( __FILE__ ).'includes/aq_resizer.php';
require_once plugin_dir_path( __FILE__ ).'includes/custom-function.php';

require_once plugin_dir_path( __FILE__ ).'blog-layout-design-templater.php';

function blog_layout_design_new_elements(){
  require_once plugin_dir_path( __FILE__ ).'elementor-widgets/blog-layouts/blog-layout-control.php';
}

add_action('elementor/widgets/widgets_registered','blog_layout_design_new_elements');

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_blog_layout_design() {

	$plugin = new Blog_Layout_Awesome();
	$plugin->run();

}
run_blog_layout_design();

add_filter('manage_blogshowcase-design_posts_columns', function($columns) {
	return array_merge($columns, ['shortcode' => esc_html__('Shortcode', 'blog-layout-design')]);
});

add_action('manage_blogshowcase-design_posts_custom_column', function($column_key, $post_id) {
	echo wp_specialchars_decode( '<pre"><code>[blog_layout_design id="'. esc_attr( $post_id ) .'"]</code></pre>' );
}, 10, 2);

add_filter( 'single_template', 'blog_layout_design_post_custom_template', 50, 1 );
function blog_layout_design_post_custom_template( $template ) {

	if ( is_singular( 'blogshowcase-design' ) ) {
		$template = BLOG_LAYOUT_DESIGN_DIR . '/single-showcase-blog.php';
	}

	return $template;
}

add_action( 'after_setup_theme', 'blog_layout_design_crb_load' );
function blog_layout_design_crb_load() {
	require_once( 'vendor/autoload.php' );
	\Carbon_Fields\Carbon_Fields::boot();
	require_once plugin_dir_path( __FILE__ ) . 'gutenberg-blog.php';
}


add_action( 'elementor/preview/enqueue_styles', function() {

	wp_enqueue_style( 'ta-blog-layout-design-fontawesome', plugin_dir_url(__FILE__ ) . 'public/css/fontawesome.min.css', array(), '', 'all' );
	wp_enqueue_style( 'ta-blog-layout-design-thaw-flexgrid', plugin_dir_url(__FILE__ ) . 'public/css/thaw-flexgrid.css', array(), '', 'all' );
	wp_enqueue_style( 'ta-blog-layout-design-swiper', plugin_dir_url(__FILE__ ) . 'public/css/swiper.css', array(), '', 'all' );

	wp_enqueue_script( 'ta-blog-layout-design-swiper', plugin_dir_url( __FILE__ ) . 'public/js/swiper.min.js', array('jquery'), '', false );

	wp_enqueue_script( 'ta-blog-layout-design-justifiedgallery', plugin_dir_url(__FILE__ ) . 'public/js/justifiedGallery.min.js', array('jquery', 'imagesloaded'), '', false );

	if(in_array('advanced-grid-blog-layout-design/advanced-grid-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		wp_enqueue_style( 'agbld-advanced-grid-blog-layout-design-styles', plugin_dir_url( __DIR__ ) . '/advanced-grid-blog-layout-design/assets/css/styles.css', array(), '', 'all' );
	}

	if(in_array('advanced-masonry-blog-layout-design/advanced-masonry-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		wp_enqueue_style( 'ambld-advanced-masonry-blog-layout-design-styles', plugin_dir_url( __DIR__ ) . '/advanced-masonry-blog-layout-design/assets/css/styles.css', array(), '', 'all' );
	}

	if(in_array('advanced-carousel-blog-layout-design/advanced-carousel-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		wp_enqueue_style( 'acbld-advanced-carousel-blog-layout-design-styles', plugin_dir_url( __DIR__ ) . '/advanced-carousel-blog-layout-design/assets/css/styles.css', array(), '', 'all' );

		wp_enqueue_script( 'acbld-blog-layout-design-swiper', plugin_dir_url( __DIR__ ) . 'advanced-carousel-blog-layout-design/assets/js/special1.js', array('jquery'), '', false );

		wp_enqueue_script( 'acbld-blog-layout-design-swiper', plugin_dir_url( __DIR__ ) . 'advanced-carousel-blog-layout-design/assets/js/special2.js', array('jquery'), '', false );

		wp_enqueue_script( 'acbld-blog-layout-design-swiper', plugin_dir_url( __DIR__ ) . 'advanced-carousel-blog-layout-design/assets/js/special3.js', array('jquery'), '', false );

		wp_enqueue_script( 'acbld-blog-layout-design-Charming-js', plugin_dir_url( __DIR__ ) . 'advanced-carousel-blog-layout-design/assets/js/charming.min.js', array('imagesloaded'), '', false );
		wp_enqueue_script( 'acbld-blog-layout-design-TweenMax', plugin_dir_url( __DIR__ ) . 'advanced-carousel-blog-layout-design/assets/js/TweenMax.min.js', array('imagesloaded'), '', true );
	}

	if(in_array('advanced-slider-blog-layout-design/advanced-slider-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		wp_enqueue_style( 'acbld-advanced-slider-blog-layout-design-styles', plugin_dir_url( __DIR__ ) . '/advanced-slider-blog-layout-design/assets/css/styles.css', array(), '', 'all' );

		wp_enqueue_script( 'acbld-advanced-slider-blog-layout-design-TweenMax', plugin_dir_url( __DIR__ ) . 'advanced-slider-blog-layout-design/assets/js/TweenMax.min.js', array('imagesloaded'), '', true );

		wp_enqueue_script( 'acbld-advanced-slider-blog-layout-design-anime', plugin_dir_url( __DIR__ ) . 'advanced-slider-blog-layout-design/assets/js/anime.min.js', array('imagesloaded'), '', true );

		wp_enqueue_script( 'acbld-advanced-slider-blog-layout-design-slider-1', plugin_dir_url( __DIR__ ) .'advanced-slider-blog-layout-design/assets/js/slider1.js', array('jquery','imagesloaded'), '', false );

		wp_enqueue_script( 'acbld-advanced-slider-blog-layout-design-slider-6', plugin_dir_url( __DIR__ ) .'advanced-slider-blog-layout-design/assets/js/slider6.js', array('jquery','imagesloaded'), '', false );
	}

	if(in_array('advanced-justified-blog-layout-design/advanced-justified-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		wp_enqueue_style( 'ajbld-advanced-justified-blog-layout-design-styles', plugin_dir_url( __DIR__ ) . '/advanced-justified-blog-layout-design/assets/css/styles.css', array(), '', 'all' );
	}

} );


function blog_layout_design( $atts ) {

	// Get Attributes
	extract( shortcode_atts(
			array(
				'id' => ''   // DEFAULT SLUG SET TO EMPTY
			), $atts )
	);

	// WP_Query arguments
	$args = array (
		'page_id'           =>  $id,     // GET POST BY SLUG  // IGNORE IF YOU ARE GETTING ERROR ON THIS LINE IN YOUR EDITOR
		'post_type'         => 'blogshowcase-design', // YOUR POST TYPE

	);

	// The Query
	$query = new WP_Query( $args );

	// The Loop
	if ( $query->have_posts() && $id != '' ) {

		wp_enqueue_style( 'ta-blog-layout-design-fontawesome', plugin_dir_url(__FILE__ ) . 'public/css/fontawesome.min.css', array(), '', 'all' );
		wp_enqueue_style( 'ta-blog-layout-design-thaw-flexgrid', plugin_dir_url(__FILE__ ) . 'public/css/thaw-flexgrid.css', array(), '', 'all' );
		wp_enqueue_style( 'ta-blog-layout-design', plugin_dir_url(__FILE__ ) . 'public/css/blog-layout-design-public.css', array(), '', 'all' );

		wp_enqueue_style( 'ta-blog-layout-design-swiper', plugin_dir_url(__FILE__ ) . 'public/css/swiper.css', array(), '', 'all' );

		wp_enqueue_style( 'ta-blog-layout-design-hover', plugin_dir_url(__FILE__ ) . 'public/css/hovers.css', array(), '', 'all' );

		if(in_array('advanced-grid-blog-layout-design/advanced-grid-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))){
		    wp_enqueue_style( 'agbld-advanced-grid-blog-layout-design-styles', plugin_dir_url( __DIR__ ) . '/advanced-grid-blog-layout-design/assets/css/styles.css', array(), '', 'all' );
		}

		if(in_array('advanced-masonry-blog-layout-design/advanced-masonry-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))){
		    wp_enqueue_style( 'ambld-advanced-masonry-blog-layout-design-styles', plugin_dir_url( __DIR__ ) . '/advanced-masonry-blog-layout-design/assets/css/styles.css', array(), '', 'all' );
		}

		if(in_array('advanced-carousel-blog-layout-design/advanced-carousel-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))){
		    wp_enqueue_style( 'acbld-advanced-carousel-blog-layout-design-styles', plugin_dir_url( __DIR__ ) . '/advanced-carousel-blog-layout-design/assets/css/styles.css', array(), '', 'all' );
		}

		if(in_array('advanced-slider-blog-layout-design/advanced-slider-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))){
		    wp_enqueue_style( 'acbld-advanced-slider-blog-layout-design-styles', plugin_dir_url( __DIR__ ) . '/advanced-slider-blog-layout-design/assets/css/styles.css', array(), '', 'all' );
		}

		if(in_array('advanced-justified-blog-layout-design/advanced-justified-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))){
		    wp_enqueue_style( 'ajbld-advanced-justified-blog-layout-design-styles', plugin_dir_url( __DIR__ ) . '/advanced-justified-blog-layout-design/assets/css/styles.css', array(), '', 'all' );
		}

		while ( $query->have_posts() ) {

			$query->the_post();

			$ta_ids = array();
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
			if ( $ta_blog_loop->have_posts() ) {

				if($blog_style == 'grid-full-image-1') {
					$blog_style_part = dirname( __FILE__ ) .'/public/blog-layout-styles/grid-full-image-1.php';
				}
				elseif($blog_style == 'grid-card-1') {
					$blog_style_part = dirname( __FILE__ ) .'/public/blog-layout-styles/grid-card-1.php';
				}
			    elseif($blog_style == 'grid-hiji') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-grid-blog-layout-design/templates/grid-hiji.php';
			    }
			    elseif($blog_style == 'grid-dua') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-grid-blog-layout-design/templates/grid-dua.php';
			    }
			    elseif($blog_style == 'grid-tilu') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-grid-blog-layout-design/templates/grid-tilu.php';
			    }
			    elseif($blog_style == 'grid-opat') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-grid-blog-layout-design/templates/grid-opat.php';
			    }
			    elseif($blog_style == 'grid-lima') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-grid-blog-layout-design/templates/grid-lima.php';
			    }
			    elseif($blog_style == 'grid-genep') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-grid-blog-layout-design/templates/grid-genep.php';
			    }
			    elseif($blog_style == 'grid-tujuh') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-grid-blog-layout-design/templates/grid-tujuh.php';
			    }
				elseif($blog_style == 'masonry-full-image-1') {
					$blog_style_part = dirname( __FILE__ ) .'/public/blog-layout-styles/masonry-full-image-1.php';
				}
				elseif($blog_style == 'masonry-card-1') {
					$blog_style_part = dirname( __FILE__ ) .'/public/blog-layout-styles/masonry-card-1.php';
				}
			    elseif($blog_style == 'masonry-hiji') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-masonry-blog-layout-design/templates/masonry-hiji.php';
			    }
			    elseif($blog_style == 'masonry-dua') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-masonry-blog-layout-design/templates/masonry-dua.php';
			    }
			    elseif($blog_style == 'masonry-tilu') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-masonry-blog-layout-design/templates/masonry-tilu.php';
			    }
			    elseif($blog_style == 'masonry-opat') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-masonry-blog-layout-design/templates/masonry-opat.php';
			    }
			    elseif($blog_style == 'masonry-lima') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-masonry-blog-layout-design/templates/masonry-lima.php';
			    }
			    elseif($blog_style == 'masonry-genep') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-masonry-blog-layout-design/templates/masonry-genep.php';
			    }
			    elseif($blog_style == 'masonry-tujuh') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-masonry-blog-layout-design/templates/masonry-tujuh.php';
			    }
				elseif($blog_style == 'carousel-full-image-1') {
					$blog_style_part = dirname( __FILE__ ) .'/public/blog-layout-styles/carousel-full-image-1.php';
				}
				elseif($blog_style == 'carousel-3d-full-image-1') {
					$blog_style_part = dirname( __FILE__ ) .'/public/blog-layout-styles/carousel-full-image-1.php';
				}
			    elseif($blog_style == 'carousel-hiji') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-carousel-blog-layout-design/templates/carousel-hiji.php';
			    }
			    elseif($blog_style == 'carousel-dua') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-carousel-blog-layout-design/templates/carousel-dua.php';
			    }
			    elseif($blog_style == 'carousel-tilu') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-carousel-blog-layout-design/templates/carousel-tilu.php';
			    }
			    elseif($blog_style == 'carousel-opat') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-carousel-blog-layout-design/templates/carousel-opat.php';
			    }
			    elseif($blog_style == 'carousel-lima') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-carousel-blog-layout-design/templates/carousel-lima.php';
			    }
			    elseif($blog_style == 'carousel-genep') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-carousel-blog-layout-design/templates/carousel-genep.php';
			    }
			    elseif($blog_style == 'carousel-tujuh') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-carousel-blog-layout-design/templates/carousel-tujuh.php';
			    }
			    elseif($blog_style == 'special-hiji-carousel') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-carousel-blog-layout-design/templates/special-hiji-carousel.php';
			    }
			    elseif($blog_style == 'special-dua-carousel') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-carousel-blog-layout-design/templates/special-dua-carousel.php';
			    }
			    elseif($blog_style == 'special-tilu-carousel') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-carousel-blog-layout-design/templates/special-tilu-carousel.php';
			    }
				elseif($blog_style == 'slider-full-image-1') {
					$blog_style_part = dirname( __FILE__ ) .'/public/blog-layout-styles/slider-full-image-1.php';
				}
			    elseif($blog_style == 'slider-hiji') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-slider-blog-layout-design/templates/slider-hiji.php';
			    }
			    elseif($blog_style == 'slider-dua') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-slider-blog-layout-design/templates/slider-dua.php';
			    }
			    elseif($blog_style == 'slider-tilu') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-slider-blog-layout-design/templates/slider-tilu.php';
			    }
			    elseif($blog_style == 'slider-opat') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-slider-blog-layout-design/templates/slider-opat.php';
			    }
			    elseif($blog_style == 'slider-lima') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-slider-blog-layout-design/templates/slider-lima.php';
			    }
			    elseif($blog_style == 'slider-genep') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-slider-blog-layout-design/templates/slider-genep.php';
			    }
			    elseif($blog_style == 'slider-tujuh') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-slider-blog-layout-design/templates/slider-tujuh.php';
			    }
			    elseif($blog_style == 'slider-dalapan') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-slider-blog-layout-design/templates/slider-dalapan.php';
			    }
			    elseif($blog_style == 'slider-salapan') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-slider-blog-layout-design/templates/slider-salapan.php';
			    }
			    elseif($blog_style == 'slider-sapuluh') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-slider-blog-layout-design/templates/slider-sapuluh.php';
			    }
				elseif($blog_style == 'justified-full-image-1') {
					$blog_style_part = dirname( __FILE__ ) .'/public/blog-layout-styles/justified-full-image-1.php';
				}
			    elseif($blog_style == 'justified-hiji') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-justified-blog-layout-design/templates/justified-hiji.php';
			    }
			    elseif($blog_style == 'justified-dua') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-justified-blog-layout-design/templates/justified-dua.php';
			    }
			    elseif($blog_style == 'justified-tilu') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-justified-blog-layout-design/templates/justified-tilu.php';
			    }
			    elseif($blog_style == 'justified-opat') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-justified-blog-layout-design/templates/justified-opat.php';
			    }
			    elseif($blog_style == 'justified-lima') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-justified-blog-layout-design/templates/justified-lima.php';
			    }
			    elseif($blog_style == 'justified-genep') {
			        $blog_style_part = WP_PLUGIN_DIR.'/advanced-justified-blog-layout-design/templates/justified-genep.php';
			    }
			
				ob_start();
				include_once dirname( __FILE__ ) .'/public/partials/wrap-start.php';
				include_once $blog_style_part;
				include_once dirname( __FILE__ ) .'/public/partials/wrap-end.php';

				$content = ob_get_clean();
				return $content;

			} else {
				// no posts found
				return esc_html__( 'Sorry You have set no html for this slug...', 'blog-layout-design' );

			}
		} 
	} 
	else {
		// no posts found
		return esc_html__( 'Sorry You have set no html for this slug...', 'blog-layout-design' );

	}

// Restore original Post Data
	wp_reset_postdata();
	//return ob_get_clean();
}
add_shortcode( 'blog_layout_design', 'blog_layout_design' );

function blog_layout_design_select_showcase_post() {
	$showcases_array = array();

	$args = array(
		'posts_per_page' => -1,
		'post_type' => 'blogshowcase-design',
	);

	$showcases = get_posts($args);

	foreach( $showcases as $post ) { setup_postdata( $post );
		$showcases_array[$post->ID] = $post->post_title;
	}

	return $showcases_array;

	wp_reset_postdata();
}

add_action('wp_head', 'blog_layout_design_color_custom_styles', 100);
function blog_layout_design_color_custom_styles()
{
	$blog_layout_design_custom_args = array(
	'post_type'         => 'blogshowcase-design',
	'posts_per_page'    => -1,
	);
	$blog_layout_design_custom = new WP_Query($blog_layout_design_custom_args);
	if ($blog_layout_design_custom->have_posts()) : ?>

   <style>
		<?php while($blog_layout_design_custom->have_posts()) : $blog_layout_design_custom->the_post();

		$blog_layout_title_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_title_color' );
		$blog_layout_category_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_category_color' );
		$blog_layout_content_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_content_color' );
		$blog_layout_bg_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_bg_color' );
		$blog_layout_bg_hover_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_bg_hover_color' );
		$blog_layout_loading_bg = carbon_get_post_meta( get_the_ID(), 'blog_layout_loading_bg' );
		$blog_layout_title_color_hover = carbon_get_post_meta( get_the_ID(), 'blog_layout_title_color_hover' );
		$blog_layout_category_bg_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_category_bg_color' );
		$blog_layout_category_color_hover = carbon_get_post_meta( get_the_ID(), 'blog_layout_category_color_hover' );
		$blog_layout_category_bg_color_hover = carbon_get_post_meta( get_the_ID(), 'blog_layout_category_bg_color_hover' );
		$blog_layout_date_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_date_color' );
		$blog_layout_frame_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_frame_color' );

		// Filter

		$blog_layout_filter_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_filter_color' );
		$blog_layout_filter_hover_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_filter_hover_color' );
		$blog_layout_filter_border_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_filter_border_color' );
		$blog_layout_filter_mobile_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_filter_mobile_color' );
		$blog_layout_filter_mobile_bg_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_filter_mobile_bg_color' );
		$blog_layout_filter_align = carbon_get_post_meta( get_the_ID(), 'blog_layout_filter_align' );
		$blog_layout_filter_margin_bottom = carbon_get_post_meta( get_the_ID(), 'blog_layout_filter_margin_bottom' );

		if($blog_layout_filter_margin_bottom != "" || $blog_layout_filter_margin_bottom === 0) {
			$blog_layout_filter_margin_bottom = $blog_layout_filter_margin_bottom;
		} else {
			$blog_layout_filter_margin_bottom = 0;
		}

		// Pagination Load More

		$blog_layout_pag_load_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_pag_load_color' );
		$blog_layout_pag_load_bg_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_pag_load_bg_color' );
		$blog_layout_pag_load_hover_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_pag_load_hover_color' );
		$blog_layout_pag_load_bg_hover_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_pag_load_bg_hover_color' );

		// Pagination Default

        $blog_layout_pag_def_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_pag_def_color' );
        $blog_layout_pag_def_bg_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_pag_def_bg_color' );
        $blog_layout_pag_def_hover_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_pag_def_hover_color' );
        $blog_layout_pag_def_bg_hover_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_pag_def_bg_hover_color' );
        $blog_layout_pagination_align = carbon_get_post_meta( get_the_ID(), 'blog_layout_pagination_align' );

        // Pagination Number

        $blog_layout_pag_num_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_pag_num_color' );
        $blog_layout_pag_num_bg_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_pag_num_bg_color' );
        $blog_layout_pag_num_current_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_pag_num_current_color' );
        $blog_layout_pag_num_bg_current_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_pag_num_bg_current_color' );
        $blog_layout_pag_num_border_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_pag_num_border_color' );
        $blog_layout_pag_num_border_current_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_pag_num_border_current_color' );

		$blog_layout_showcase_padding = carbon_get_post_meta( get_the_ID(), 'blog_layout_showcase_padding' );
		$blog_layout_showcase_padding_tablet = carbon_get_post_meta( get_the_ID(), 'blog_layout_showcase_padding_tablet' );
		$blog_layout_showcase_padding_mobile = carbon_get_post_meta( get_the_ID(), 'blog_layout_showcase_padding_mobile' );

		if($blog_layout_showcase_padding != "" || $blog_layout_showcase_padding === 0) {
			$blog_layout_showcase_padding = $blog_layout_showcase_padding;
		} else {
			$blog_layout_showcase_padding = 30;
		}

		if($blog_layout_showcase_padding_tablet != "" || $blog_layout_showcase_padding_tablet === 0) {
			$blog_layout_showcase_padding_tablet = $blog_layout_showcase_padding_tablet;
		} else {
			$blog_layout_showcase_padding_tablet = 30;
		}

		if($blog_layout_showcase_padding_mobile != "" || $blog_layout_showcase_padding_mobile === 0) {
			$blog_layout_showcase_padding_mobile = $blog_layout_showcase_padding_mobile;
		} else {
			$blog_layout_showcase_padding_mobile = 30;
		}

		// Blog Layout

        $blog_layout_button_text_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_button_text_color' );
        $blog_layout_button_bg_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_button_bg_color' );
        $blog_layout_button_text_hover_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_button_text_hover_color' );
        $blog_layout_button_bg_hover_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_button_bg_hover_color' );
        $blog_layout_button_border_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_button_border_color' );
        $blog_layout_button_border_hover_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_button_border_hover_color' );

		// Pagination Default

		$blog_layout_pag_def_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_pag_def_color' );
		$blog_layout_pag_def_bg_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_pag_def_bg_color' );
		$blog_layout_pag_def_hover_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_pag_def_hover_color' );
		$blog_layout_pag_def_bg_hover_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_pag_def_bg_hover_color' );
		$blog_layout_pagination_align = carbon_get_post_meta( get_the_ID(), 'blog_layout_pagination_align' );

		// Pagination Number

		$blog_layout_pag_num_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_pag_num_color' );
		$blog_layout_pag_num_bg_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_pag_num_bg_color' );
		$blog_layout_pag_num_current_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_pag_num_current_color' );
		$blog_layout_pag_num_bg_current_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_pag_num_bg_current_color' );

		// Pagination Load More

		$blog_layout_pag_load_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_pag_load_color' );
		$blog_layout_pag_load_bg_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_pag_load_bg_color' );
		$blog_layout_pag_load_hover_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_pag_load_hover_color' );
		$blog_layout_pag_load_bg_hover_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_pag_load_bg_hover_color' );

		// ARROW STYLE

		$blog_layout_arrow_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_arrow_color' );
		$blog_layout_arrow_hover_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_arrow_hover_color' );
		$blog_layout_arrow_bg_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_arrow_bg_color' );
		$blog_layout_arrow_bg_hover_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_arrow_bg_hover_color' );
		$blog_layout_offside_arrow = carbon_get_post_meta( get_the_ID(), 'blog_layout_offside_arrow' );
		$blog_layout_offside_arrow_tablet = carbon_get_post_meta( get_the_ID(), 'blog_layout_offside_arrow_tablet' );
		$blog_layout_offside_arrow_mobile = carbon_get_post_meta( get_the_ID(), 'blog_layout_offside_arrow_mobile' );

		// DOT STYLE

		$blog_layout_dot_border_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_dot_border_color' );
		$blog_layout_dot_bg_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_dot_bg_color' );

		$blog_layout_loading_bg = carbon_get_post_meta( get_the_ID(), 'blog_layout_loading_bg' );
		$blog_layout_offside_pagination = carbon_get_post_meta( get_the_ID(), 'blog_layout_offside_pagination' );
		$blog_layout_offside_pagination_tablet = carbon_get_post_meta( get_the_ID(), 'blog_layout_offside_pagination_tablet' );
		$blog_layout_offside_pagination_mobile = carbon_get_post_meta( get_the_ID(), 'blog_layout_offside_pagination_mobile' );


		// HEIGHT ADJUST

		$blog_layout_height_option = carbon_get_post_meta( get_the_ID(), 'blog_layout_height_option' );
		$blog_layout_header_height_custom = carbon_get_post_meta( get_the_ID(), 'blog_layout_header_height_custom' );
		$blog_layout_content_height_custom = carbon_get_post_meta( get_the_ID(), 'blog_layout_content_height_custom' );
		$blog_layout_overlay_color = carbon_get_post_meta( get_the_ID(), 'blog_layout_overlay_color' );

		 ?>

		.blog-post-<?php echo esc_attr(get_the_ID()); ?> .grid-template .blog-post-item .item-wrap,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?> .grid-template .blog-post-item.item-wrap {
			padding-right: calc( <?php echo esc_html($blog_layout_showcase_padding); ?>px/2 );
			padding-left: calc( <?php echo esc_html($blog_layout_showcase_padding); ?>px/2 );
			margin-bottom: <?php echo esc_html($blog_layout_showcase_padding); ?>px;
		}

		@media only screen and (max-width: 1024px) {
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .grid-template .blog-post-item .item-wrap,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .grid-template .blog-post-item.item-wrap {
				padding-right: calc( <?php echo esc_html($blog_layout_showcase_padding_tablet); ?>px/2 );
				padding-left: calc( <?php echo esc_html($blog_layout_showcase_padding_tablet); ?>px/2 );
				margin-bottom: <?php echo esc_html($blog_layout_showcase_padding_tablet); ?>px;
			}
		}

		@media only screen and (max-width: 767px) {
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .grid-template .blog-post-item .item-wrap,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .grid-template .blog-post-item.item-wrap {
				padding-right: calc( <?php echo esc_html($blog_layout_showcase_padding_mobile); ?>px/2 );
				padding-left: calc( <?php echo esc_html($blog_layout_showcase_padding_mobile); ?>px/2 );
				margin-bottom: <?php echo esc_html($blog_layout_showcase_padding_mobile); ?>px;
			}
		}

		<?php if(!empty($blog_layout_title_color)) { ?>
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> .blog__content h3 {
                color: <?php echo esc_html($blog_layout_title_color); ?>;
            }

            .blog-post-<?php echo esc_attr(get_the_ID()); ?> figcaption .inner-content h3,
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> .blog-post-item figcaption h3 {
                color: <?php echo esc_html($blog_layout_title_color); ?>;
	        }

			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .special-dua .slide__title {
				color: <?php echo esc_html($blog_layout_title_color); ?>;
			}

			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .special-hiji .grid__item--title {
				color: <?php echo esc_html($blog_layout_title_color); ?>;
			}

			body .blog-post-<?php echo esc_attr(get_the_ID()); ?> .slider__text-inner {
				color: <?php echo esc_html($blog_layout_title_color); ?>;
			}

			body .blog-post-<?php echo esc_attr(get_the_ID()); ?> .slider__text-inner--stroke {
				-webkit-text-stroke: 2px <?php echo esc_html($blog_layout_title_color); ?>;
			    text-stroke: 2px <?php echo esc_html($blog_layout_title_color); ?>;
			    -webkit-text-fill-color: transparent;
			    text-fill-color: transparent;
			    color: transparent;
			}

			@media screen and (min-width: 53em) {
				body .blog-post-<?php echo esc_attr(get_the_ID()); ?> .demo5 .slider__text-inner--stroke {
					-webkit-text-stroke: 3px <?php echo esc_html($blog_layout_title_color); ?>;
    				text-stroke: 3px <?php echo esc_html($blog_layout_title_color); ?>;
				}
			}

			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slideshow-slider .slide__title {
				color: <?php echo esc_html($blog_layout_title_color); ?>;
			}

			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slider-sabelas .grid__item--name {
				color: <?php echo esc_html($blog_layout_title_color); ?>;
			}

			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slider-blog .inner-slider h1 {
				color: <?php echo esc_html($blog_layout_title_color); ?>;
			}
        <?php } ?>

        <?php if(!empty($blog_layout_category_color)) { ?>
        	.blog-post-<?php echo esc_attr(get_the_ID()); ?> ul.fact-list li,
        	.blog-post-<?php echo esc_attr(get_the_ID()); ?> .item-wrap .categories a {
	        	color: <?php echo esc_html($blog_layout_category_color); ?>;
	        }

			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .special-dua .slide__side {
				color: <?php echo esc_html($blog_layout_category_color); ?>;
			}
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .special-hiji .caption {
				color: <?php echo esc_html($blog_layout_category_color); ?>;
			}
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slider-sabelas .grid__item--title {
				color: <?php echo esc_html($blog_layout_category_color); ?>;
			}

			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slider-blog .inner-slider .categories a {
				color: <?php echo esc_html($blog_layout_category_color); ?>;
			}

			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slideshow-slider .categories.hastags a {
				color: <?php echo esc_html($blog_layout_category_color); ?>;
			}
        <?php } ?>

		<?php if(!empty($blog_layout_content_color)) { ?>
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .special-hiji .caption {
				color: <?php echo esc_html($blog_layout_content_color); ?>;
			}
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slideshow-slider .slide__desc {
				color: <?php echo esc_html($blog_layout_content_color); ?>;
			}

			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .grid__item--text {
				color: <?php echo esc_html($blog_layout_content_color); ?>;
			}

			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slider-blog .inner-slider h1 ~ p {
				color: <?php echo esc_html($blog_layout_content_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($blog_layout_bg_color)) { ?>
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .holder-box {
				background-color: <?php echo esc_html($blog_layout_bg_color); ?> !important;
			}
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .special-dua .slideshow__deco {
				background-color: <?php echo esc_html($blog_layout_bg_color); ?>;
			}

			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slider-hiji .slider__slide {
				background-color: <?php echo esc_html($blog_layout_bg_color); ?>;
			}
		<?php } ?>

        <?php if(!empty($blog_layout_bg_hover_color)) { ?>
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-reveal-']:before, 
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> [class*=' imghvr-reveal-']:before,
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-'] figcaption, 
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> [class*=' imghvr-'] figcaption,
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-blocks']:before, 
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-blocks']:after,
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-blocks'] figcaption:before, 
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-blocks'] figcaption:after,
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-strip-shutter']:before, 
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-strip-shutter']:after, 
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-strip-shutter'] figcaption:before, 
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-strip-shutter'] figcaption:after,
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-strip-horiz']:before, 
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-strip-horiz']:after, 
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-strip-horiz'] figcaption:before, 
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-strip-horiz'] figcaption:after,
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-strip-vert']:before, 
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-strip-vert']:after, 
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-strip-vert'] figcaption:before, 
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-strip-vert'] figcaption:after,
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-pixel']:before, 
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-pixel']:after, 
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-pixel'] figcaption:before, 
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-pixel'] figcaption:after,
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-blinds']:before, 
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-blinds']:after, 
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-blinds'] figcaption:before, 
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-blinds'] figcaption:after,
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-border-reveal'], 
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> [class*=' imghvr-border-reveal'],
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-book-open-']:hover figcaption:before, 
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-book-open-']:hover figcaption:after,
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-stack-'], 
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> [class*=' imghvr-stack-'] {
                background-color: <?php echo esc_html($blog_layout_bg_hover_color); ?>;
            }
        <?php } ?>

		.blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-blocks'] figcaption, 
		.blog-post-<?php echo esc_attr(get_the_ID()); ?> [class*=' imghvr-blocks'] figcaption,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-strip-shutter'] figcaption, 
		.blog-post-<?php echo esc_attr(get_the_ID()); ?> [class*=' imghvr-strip-shutter'] figcaption,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-strip-horiz'] figcaption, 
		.blog-post-<?php echo esc_attr(get_the_ID()); ?> [class*=' imghvr-strip-horiz'] figcaption,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-strip-vert'] figcaption, 
		.blog-post-<?php echo esc_attr(get_the_ID()); ?> [class*=' imghvr-strip-vert'] figcaption,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-pixel'] figcaption, 
		.blog-post-<?php echo esc_attr(get_the_ID()); ?> [class*=' imghvr-pixel'] figcaption,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-blinds'] figcaption, 
		.blog-post-<?php echo esc_attr(get_the_ID()); ?> [class*=' imghvr-blinds'] figcaption,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-border-reveal'] figcaption, 
		.blog-post-<?php echo esc_attr(get_the_ID()); ?> [class*=' imghvr-border-reveal'] figcaption {
			background-color: transparent;
		}

        <?php if(!empty($blog_layout_bg_hover_color)) { ?>
		.blog-post-<?php echo esc_attr(get_the_ID()); ?> .blog-grid-unique .blog-post-item figcaption,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?> .blog-carousel-unique .blog-post-item figcaption,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?> .blog-justified-unique .justify-item figcaption {
			background: <?php echo esc_html($blog_layout_bg_hover_color); ?>;
		}
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-tujuh figcaption:after,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-justified-tujuh figcaption:after,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-tujuh .item-wrap2:hover figcaption:after, 
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-tujuh .item-wrap2.cs-hover figcaption:after {
			box-shadow: 0 0 0 10px <?php echo esc_html($blog_layout_bg_hover_color); ?>;
		}

		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-lima .blog-grid-unique .blog-post-item figcaption,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-justified-lima .blog-justified-unique .justify-item figcaption {
			background: rgba(0,0,0,0.6);
		}

		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-lima .item-wrap-inner,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-justified-lima .item-wrap-inner {
			background-color: <?php echo esc_html($blog_layout_bg_hover_color); ?>;
		}
		<?php } ?>

        <?php if(!empty($blog_layout_loading_bg)) { ?>
	        .blog-post-<?php echo esc_attr(get_the_ID()); ?> .grid--loading::before {
		        background-color: <?php echo esc_html($blog_layout_loading_bg); ?>;
		    }
	   <?php } ?>

	   <?php 

        //==============PAGINATION================ 

        if(!empty($blog_layout_pagination_align)) { ?>
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> .navigation-paging {
                text-align: <?php echo esc_html($blog_layout_pagination_align); ?>;
            }
        <?php } 


        //=========PAGINATION DEFAULT============

        if(!empty($blog_layout_pag_def_color)) { ?>
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> .navigation-paging.pagination .post-navigation a {
                color: <?php echo esc_html($blog_layout_pag_def_color); ?>;
            }
        <?php } ?>

        <?php if(!empty($blog_layout_pag_def_bg_color)) { ?>
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> .navigation-paging.pagination .post-navigation a {
                background-color: <?php echo esc_html($blog_layout_pag_def_bg_color); ?>;
            }
        <?php } ?>

        <?php if(!empty($blog_layout_pag_def_hover_color)) { ?>
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> .navigation-paging.pagination .post-navigation a:hover {
                color: <?php echo esc_html($blog_layout_pag_def_hover_color); ?>;
            }
        <?php } ?>

        <?php if(!empty($blog_layout_pag_def_bg_hover_color)) { ?>
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> .navigation-paging.pagination .post-navigation a:hover {
                background-color: <?php echo esc_html($blog_layout_pag_def_bg_hover_color); ?>;
            }
        <?php }


        //=========PAGINATION NUMBER============

        if(!empty($blog_layout_pag_num_color)) { ?>
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> .navigation-paging.pagination-num .btn {
                color: <?php echo esc_html($blog_layout_pag_num_color); ?>;
            }
        <?php } ?>

        <?php if(!empty($blog_layout_pag_num_bg_color)) { ?>
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> .navigation-paging.pagination-num .btn {
                background-color: <?php echo esc_html($blog_layout_pag_num_bg_color); ?>;
                border-color: <?php echo esc_html($blog_layout_pag_num_bg_color); ?>;
            }
        <?php } ?>

        <?php if(!empty($blog_layout_pag_num_current_color)) { ?>
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> .navigation-paging.pagination-num .btn.current,
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> .navigation-paging.pagination-num .btn:hover {
                color: <?php echo esc_html($blog_layout_pag_num_current_color); ?>;
            }
        <?php } ?>

        <?php if(!empty($blog_layout_pag_num_bg_current_color)) { ?>
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> .navigation-paging.pagination-num .btn.current,
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> .navigation-paging.pagination-num .btn:hover {
                background-color: <?php echo esc_html($blog_layout_pag_num_bg_current_color); ?>;
                border-color: <?php echo esc_html($blog_layout_pag_num_bg_current_color); ?>;
            }
        <?php } ?>

        <?php if(!empty($blog_layout_pag_num_border_color)) { ?>
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> .navigation-paging.pagination-num .btn,
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> .navigation-paging.pagination-num .btn {
                border-color: <?php echo esc_html($blog_layout_pag_num_border_color); ?>;
            }
        <?php } ?>

        <?php if(!empty($blog_layout_pag_num_border_current_color)) { ?>
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> .navigation-paging.pagination-num .btn.current,
            .blog-post-<?php echo esc_attr(get_the_ID()); ?> .navigation-paging.pagination-num .btn:hover {
                border-color: <?php echo esc_html($blog_layout_pag_num_border_current_color); ?>;
            }
        <?php }

        //<!-- FILTER -->

		if(!empty($blog_layout_filter_align)) { ?>
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> #portfolio-filter {
				text-align: <?php echo esc_html($blog_layout_filter_align); ?>;
			}
		<?php } ?>


		<?php if(!empty($blog_layout_filter_color)) { ?>
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> ul.filters li .filter-btn {
				color: <?php echo esc_html($blog_layout_filter_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($blog_layout_filter_hover_color)) { ?>
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> ul.filters li.activeFilter .filter-btn, 
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> ul.filters li:hover .filter-btn {
				color: <?php echo esc_html($blog_layout_filter_hover_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($blog_layout_filter_border_color)) { ?>
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> ul.filters li.activeFilter .filter-btn, 
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> ul.filters li:hover .filter-btn {
				border-color: <?php echo esc_html($blog_layout_filter_border_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($blog_layout_filter_mobile_color)) { ?>
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> #filter-icon .bar {
				background: <?php echo esc_html($blog_layout_filter_mobile_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($blog_layout_filter_mobile_bg_color)) { ?>
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> #filter-icon {
				background: <?php echo esc_html($blog_layout_filter_mobile_bg_color); ?>;
			}
		<?php }

		//=========PAGINATION LOAD MORE============

		if(!empty($blog_layout_pag_load_color)) { ?>
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .navigation-paging.infinite-wrap button {
				color: <?php echo esc_html($blog_layout_pag_load_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($blog_layout_pag_load_bg_color)) { ?>
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .navigation-paging.infinite-wrap button {
				background-color: <?php echo esc_html($blog_layout_pag_load_bg_color); ?>;
				border-color: <?php echo esc_html($blog_layout_pag_load_bg_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($blog_layout_pag_load_hover_color)) { ?>
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .navigation-paging.infinite-wrap button:hover {
				color: <?php echo esc_html($blog_layout_pag_load_hover_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($blog_layout_pag_load_bg_hover_color)) { ?>
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .navigation-paging.infinite-wrap button:hover {
				background-color: <?php echo esc_html($blog_layout_pag_load_bg_hover_color); ?>;
				border-color: <?php echo esc_html($blog_layout_pag_load_bg_hover_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($blog_layout_button_text_color)) { ?>
		.blog-post-<?php echo esc_attr(get_the_ID()); ?> .justify-item figcaption a {
			color: <?php echo esc_html($blog_layout_button_text_color); ?>;
		}

		.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slideshow-slider .slide__link {
			color: <?php echo esc_html($blog_layout_button_text_color); ?>;
		}

		.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slider-blog .blog-post-item .inner-slider .button-view,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-tilu figcaption .inner-content .date ~ a,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-tujuh figcaption .inner-content .date ~ a,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-lima figcaption .date ~ a,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-genep figcaption .date ~ a,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-opat figcaption .date ~ a,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-dua figcaption .date ~ a,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-tilu figcaption .inner-content .date ~ a,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-tujuh figcaption .inner-content .date ~ a,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-lima figcaption .date ~ a,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-genep figcaption .date ~ a,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-opat figcaption .date ~ a,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-dua figcaption .date ~ a,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-justified-tilu figcaption .inner-content .date ~ a,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-justified-tujuh figcaption .inner-content .date ~ a,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-justified-lima figcaption .date ~ a,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-justified-genep figcaption .date ~ a,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-justified-opat figcaption .date ~ a,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-justified-dua figcaption .date ~ a {
			color: <?php echo esc_html($blog_layout_button_text_color); ?>;
		}

		.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slider-blog .blog-post-item .inner-slider .button-view {
			color: <?php echo esc_html($blog_layout_button_text_color); ?>;
		}
		<?php } ?>

		<?php if(!empty($blog_layout_button_bg_color)) { ?>
		.blog-post-<?php echo esc_attr(get_the_ID()); ?> .justify-item figcaption a {
			background-color: <?php echo esc_html($blog_layout_button_bg_color); ?>;
		}

		.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slideshow-slider .slide__link {
			background-color: <?php echo esc_html($blog_layout_button_bg_color); ?>;
		}

		.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slider-blog .blog-post-item .inner-slider .button-view {
			background-color: <?php echo esc_html($blog_layout_button_bg_color); ?>;
			border-color: <?php echo esc_html($blog_layout_button_bg_color); ?>;
		}


		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-tilu figcaption .inner-content .date ~ a,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-tujuh figcaption .inner-content .date ~ a,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-lima figcaption .date ~ a,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-genep figcaption .date ~ a,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-opat figcaption .date ~ a,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-dua figcaption .date ~ a,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-tilu figcaption .inner-content .date ~ a,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-tujuh figcaption .inner-content .date ~ a,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-lima figcaption .date ~ a,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-genep figcaption .date ~ a,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-opat figcaption .date ~ a,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-dua figcaption .date ~ a {
			background-color: <?php echo esc_html($blog_layout_button_bg_color); ?>;
		}
		<?php } ?>

		<?php if(!empty($blog_layout_button_text_hover_color)) { ?>
		.blog-post-<?php echo esc_attr(get_the_ID()); ?> .justify-item figcaption a:hover {
			color: <?php echo esc_html($blog_layout_button_text_hover_color); ?>;
		}

		.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slideshow-slider .slide__link:hover {
			color: <?php echo esc_html($blog_layout_button_text_hover_color); ?>;
		}

		.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slider-blog .blog-post-item .inner-slider .button-view:hover,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-tilu figcaption .inner-content .date ~ a:hover,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-tujuh figcaption .inner-content .date ~ a:hover,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-lima figcaption .date ~ a:hover,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-genep figcaption .date ~ a:hover,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-opat figcaption .date ~ a:hover,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-dua figcaption .date ~ a:hover,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-tilu figcaption .inner-content .date ~ a:hover,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-tujuh figcaption .inner-content .date ~ a:hover,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-lima figcaption .date ~ a:hover,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-genep figcaption .date ~ a:hover,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-opat figcaption .date ~ a:hover,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-dua figcaption .date ~ a:hover,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-justified-tilu figcaption .inner-content .date ~ a:hover,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-justified-tujuh figcaption .inner-content .date ~ a:hover,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-justified-lima figcaption .date ~ a:hover,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-justified-genep figcaption .date ~ a:hover,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-justified-opat figcaption .date ~ a:hover,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-justified-dua figcaption .date ~ a:hover {
			color: <?php echo esc_html($blog_layout_button_text_hover_color); ?>;
		}
		<?php } ?>

		<?php if(!empty($blog_layout_button_bg_hover_color)) { ?>
		.blog-post-<?php echo esc_attr(get_the_ID()); ?> .justify-item figcaption a:hover,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-tilu figcaption .inner-content .date ~ a:hover,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-tujuh figcaption .inner-content .date ~ a:hover,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-lima figcaption .date ~ a:hover,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-genep figcaption .date ~ a:hover,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-opat figcaption .date ~ a:hover,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-dua figcaption .date ~ a:hover,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-tilu figcaption .inner-content .date ~ a:hover,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-tujuh figcaption .inner-content .date ~ a:hover,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-lima figcaption .date ~ a:hover,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-genep figcaption .date ~ a:hover,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-opat figcaption .date ~ a:hover,
		.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-dua figcaption .date ~ a:hover {
			background-color: <?php echo esc_html($blog_layout_button_bg_hover_color); ?>;
		}

		.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slideshow-slider .slide__link:hover {
			background-color: <?php echo esc_html($blog_layout_button_bg_hover_color); ?>;
		}

		.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slider-blog .blog-post-item .inner-slider .button-view:hover {
			background-color: <?php echo esc_html($blog_layout_button_bg_hover_color); ?>;
			border-color: <?php echo esc_html($blog_layout_button_bg_hover_color); ?>;
		}
		<?php } ?>

		<?php if(!empty($blog_layout_title_color_hover)) { ?>
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .blog-post-item figcaption a.title-blog-text:hover h3,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .blog-post-item figcaption a.title-blog-text:hover h3 {
				color: <?php echo esc_html($blog_layout_title_color_hover); ?>;
			}
		<?php } ?>

		<?php if(!empty($blog_layout_category_color_hover)) { ?>
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .item-wrap .categories a:hover {
				color: <?php echo esc_html($blog_layout_category_color_hover); ?>;
			}
		<?php } ?>

		<?php if(!empty($blog_layout_category_bg_color)) { ?>
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .item-wrap .categories a {
				background-color: <?php echo esc_html($blog_layout_category_bg_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($blog_layout_category_bg_color_hover)) { ?>
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .item-wrap .categories a:hover {
				background-color: <?php echo esc_html($blog_layout_category_bg_color_hover); ?>;
			}
		<?php } ?>

		<?php if(!empty($blog_layout_date_color)) { ?>
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .caption-inside span.date,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .blog-grid-unique figcaption span.date,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .blog-carousel-unique figcaption span.date,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .blog-masonry-unique figcaption span.date,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .blog-justified-unique figcaption span.date  {
				color: <?php echo esc_html($blog_layout_date_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($blog_layout_frame_color)) { ?>
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slideshow-slider path {
				fill: <?php echo esc_html($blog_layout_frame_color); ?>;
			}
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .salapan.slideshow-slider pattern {
				fill: <?php echo esc_html($blog_layout_frame_color); ?>;
			}
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .salapan.slideshow-slider path {
				fill: url(#pattern);
			}
		<?php } ?>

		<?php if(!empty($blog_layout_button_border_color)) { ?>
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-tilu figcaption .inner-content .date ~ a,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-tujuh figcaption .inner-content .date ~ a,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-lima figcaption .date ~ a,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-genep figcaption .date ~ a,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-opat figcaption .date ~ a,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-dua figcaption .date ~ a,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-tilu figcaption .inner-content .date ~ a,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-tujuh figcaption .inner-content .date ~ a,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-lima figcaption .date ~ a,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-genep figcaption .date ~ a,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-opat figcaption .date ~ a,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-dua figcaption .date ~ a,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-justified-tilu figcaption .inner-content .date ~ a,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-justified-tujuh figcaption .inner-content .date ~ a,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-justified-lima figcaption .date ~ a,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-justified-genep figcaption .date ~ a,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-justified-opat figcaption .date ~ a,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-justified-dua figcaption .date ~ a  {
				border-color: <?php echo esc_html($blog_layout_button_border_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($blog_layout_button_border_hover_color)) { ?>
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-tilu figcaption .inner-content .date ~ a:hover,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-tujuh figcaption .inner-content .date ~ a:hover,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-lima figcaption .date ~ a:hover,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-genep figcaption .date ~ a:hover,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-opat figcaption .date ~ a:hover,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-grid-dua figcaption .date ~ a:hover,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-tilu figcaption .inner-content .date ~ a:hover,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-tujuh figcaption .inner-content .date ~ a:hover,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-lima figcaption .date ~ a:hover,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-genep figcaption .date ~ a:hover,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-opat figcaption .date ~ a:hover,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-carousel-dua figcaption .date ~ a:hover,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-justified-tilu figcaption .inner-content .date ~ a:hover,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-justified-tujuh figcaption .inner-content .date ~ a:hover,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-justified-lima figcaption .date ~ a:hover,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-justified-genep figcaption .date ~ a:hover,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-justified-opat figcaption .date ~ a:hover,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?>.blog-justified-dua figcaption .date ~ a:hover {
				border-color: <?php echo esc_html($blog_layout_button_border_hover_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($blog_layout_arrow_color)) { ?>
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav.nav-circlepop .icon-wrap::before, 
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav.nav-circlepop .icon-wrap::after {
				background: <?php echo esc_html($blog_layout_arrow_color); ?>;
				fill: <?php echo esc_html($blog_layout_arrow_color); ?>;
				stroke: <?php echo esc_html($blog_layout_arrow_color); ?>;
			}

			body .blog-post-<?php echo esc_attr(get_the_ID()); ?> .grid-wrap-item .icon {
				fill: <?php echo esc_html($blog_layout_arrow_color); ?>;
			}
		<?php } ?>
		
		<?php if(!empty($blog_layout_arrow_color_special)) { ?>
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .special-dua .nav > i {
				color: <?php echo esc_html($blog_layout_arrow_color_special); ?>;
			}
		<?php } ?>

		<?php if(!empty($blog_layout_arrow_color)) { ?>
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav.nav-diamond svg.icon,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav.nav-fillslide svg.icon,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav.nav-fillslide svg.icon path {
				fill: <?php echo esc_html($blog_layout_arrow_color); ?>;
				stroke: <?php echo esc_html($blog_layout_arrow_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($blog_layout_offside_arrow)) { ?>
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav a.prev {
				left: <?php echo esc_html($blog_layout_offside_arrow); ?>px;
			}

			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav a.next {
				right: <?php echo esc_html($blog_layout_offside_arrow); ?>px;
			}
		<?php } ?>
		<?php if(!empty($blog_layout_offside_arrow_tablet)) { ?>
			@media (max-width : 768px) {
				.blog-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav a.prev {
					left: <?php echo esc_html($blog_layout_offside_arrow_tablet); ?>px;
				}

				.blog-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav a.next {
					right: <?php echo esc_html($blog_layout_offside_arrow_tablet); ?>px;
				}
			}
		<?php } ?>
		<?php if(!empty($blog_layout_offside_arrow_mobile)) { ?>
			@media (max-width : 575px) {
				.blog-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav a.prev {
					left: <?php echo esc_html($blog_layout_offside_arrow_mobile); ?>px;
				}

				.blog-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav a.next {
					right: <?php echo esc_html($blog_layout_offside_arrow_mobile); ?>px;
				}
			}
		<?php } ?>

		<?php if($blog_layout_offside_pagination != "" || $blog_layout_offside_pagination === 0) { ?>
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slider-blog ~ ul.swiper-pag,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slider.has-pag ul.swiper-pag,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slideshow-slider .swiper-pag {
    			bottom: <?php echo esc_html($blog_layout_offside_pagination); ?>px
			}
		<?php } ?>
		
		<?php if($blog_layout_offside_pagination_tablet != "" || $blog_layout_offside_pagination_tablet === 0) { ?>
			@media (max-width : 768px) {
				.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slider-blog ~ ul.swiper-pag,
				.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slider.has-pag ul.swiper-pag,
				.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slideshow-slider .swiper-pag {
	    			bottom: <?php echo esc_html($blog_layout_offside_pagination_tablet); ?>px
				}
			}
		<?php } ?>
		
		<?php if($blog_layout_offside_pagination_mobile != "" || $blog_layout_offside_pagination_mobile === 0) { ?>
			@media (max-width : 575px) {
				.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slider-blog ~ ul.swiper-pag,
				.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slider.has-pag ul.swiper-pag,
				.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slideshow-slider .swiper-pag {
	    			bottom: <?php echo esc_html($blog_layout_offside_pagination_mobile); ?>px
				}
			}
		<?php } ?>

		<?php if(!empty($blog_layout_arrow_hover_color)) { ?>
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav.nav-circlepop a:hover .icon-wrap::before, .blog-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav.nav-circlepop a:hover .icon-wrap::after {
				background: <?php echo esc_html($blog_layout_arrow_hover_color); ?>;
			}

			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav.nav-diamond a:hover svg.icon,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav.nav-fillslide a:hover svg.icon,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav.nav-fillslide a:hover svg.icon path {
				fill: <?php echo esc_html($blog_layout_arrow_hover_color); ?>;
				stroke: <?php echo esc_html($blog_layout_arrow_hover_color); ?>;
			}

			body .blog-post-<?php echo esc_attr(get_the_ID()); ?> .grid__item--nav:hover .icon {
				fill: <?php echo esc_html($blog_layout_arrow_hover_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($blog_layout_arrow_bg_color)) { ?>
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav.nav-circlepop a::before,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav.nav-diamond div,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav.nav-fillslide .icon-wrap {
				background: <?php echo esc_html($blog_layout_arrow_bg_color); ?>;
			}

			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .grid__item--nav {
				background: <?php echo esc_html($blog_layout_arrow_bg_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($blog_layout_arrow_bg_hover_color)) { ?>
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav.nav-circlepop a::before,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav.nav-fillslide .icon-wrap::before,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav.nav-diamond a:hover div {
				background: <?php echo esc_html($blog_layout_arrow_bg_hover_color); ?>;
			}

			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .grid__item--nav:hover {
				background: <?php echo esc_html($blog_layout_arrow_bg_hover_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($blog_layout_dot_border_color)) { ?>
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .dotstyle-fillup.swiper-pag li a,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .dotstyle-circlegrow.swiper-pag li a {
				box-shadow: inset 0 0 0 2px <?php echo esc_html($blog_layout_dot_border_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($blog_layout_dot_bg_color)) { ?>
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .dotstyle-fillup.swiper-pag li a::after,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .dotstyle-circlegrow.swiper-pag li a::after,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .dotstyle-flip.swiper-pag li a::before, 
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .dotstyle-flip.swiper-pag li a::after {
				background: <?php echo esc_html($blog_layout_dot_bg_color); ?>;
			}

			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .dotstyle-flip.swiper-pag li a::before {
				opacity: 0.4;
			}
		<?php } ?>

		<?php if($blog_layout_height_option == 'fullscreen') {
			if(!empty($blog_layout_header_height_custom)) { ?>
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slider-hiji .slider,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slider-dua .slider,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slider-tilu .slider,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slider-opat .slider,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slider-lima .slider,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slideshow-slider,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slider-blog .blog-post-item {
				height: calc(100vh - <?php echo esc_html($blog_layout_header_height_custom); ?>px);
			}
			<?php }
		} elseif ($blog_layout_height_option == 'default') {
			if(!empty($blog_layout_content_height_custom)) { ?>
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slider-hiji .slider,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slider-dua .slider,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slider-tilu .slider,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slider-opat .slider,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slider-lima .slider,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slider-hiji .slider__img,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slider-dua .slider__img,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slideshow-slider,
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slider-blog .blog-post-item {
				height: <?php echo esc_html($blog_layout_content_height_custom); ?>px;
			}
			<?php }
		} ?>

		<?php if(!empty($blog_layout_overlay_color)) { ?>
			.blog-post-<?php echo esc_attr(get_the_ID()); ?> .slider__img-inner:after {
				background-color: <?php echo esc_html($blog_layout_overlay_color); ?>;
			}
		<?php } ?>
		
		<?php endwhile; wp_reset_postdata(); ?>
	</style>

	<?php endif;
}
