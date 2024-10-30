<?php
function blog_layout_design_hover_effect() {
	$data_hover_effect = array(
		'' => 'Choice',
		'imghvr-zoom-in' => 'Zoom In',
		'imghvr-fade' => 'Fade',
		'imghvr-fade-in-up' => 'Fade In Up',
		'imghvr-fade-in-down' => 'Fade In Down',
		'imghvr-fade-in-left' => 'Fade In Left',
		'imghvr-fade-in-right' => 'Fade In Right',
		'imghvr-slide-up' => 'Slide Up',
		'imghvr-slide-down' => 'Slide Down',
		'imghvr-slide-left' => 'Slide Left',
		'imghvr-slide-right' => 'Slider Right',
		'imghvr-slide-top-left' => 'Slide Top Left',
		'imghvr-slide-top-right' => 'Slide Top Right',
		'imghvr-slide-bottom-left' => 'Slide Bottom Left',
		'imghvr-slide-bottom-right' => 'Slide Bottom Right',
		'imghvr-reveal-up' => 'Reveal Up',
		'imghvr-reveal-down' => 'Reveal Down',
		'imghvr-reveal-left' => 'Reveal Left',
		'imghvr-reveal-right' => 'Reveal Right',
		'imghvr-reveal-top-left' => 'Reveal Top-Left',
		'imghvr-reveal-top-right' => 'Reveal Top-Right',
		'imghvr-reveal-bottom-left' => 'Reveal Bottom-Left',
		'imghvr-reveal-bottom-right' => 'Reveal Bottom-Right',
	);
	return $data_hover_effect;
}

if( in_array('advanced-grid-blog-layout-design/advanced-grid-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-masonry-blog-layout-design/advanced-masonry-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-carousel-blog-layout-design/advanced-carousel-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))  || in_array('advanced-justified-blog-layout-design/advanced-justified-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins'))) ){
	if( in_array('advanced-grid-blog-layout-design/advanced-grid-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins'))) ) {
		if(function_exists('blog_layout_design_grid_hover_effect')) {
			function blog_layout_design_effect_choice() {
				$data_hover_effect = blog_layout_design_grid_hover_effect();
				return $data_hover_effect;
			}
		} else {
			function blog_layout_design_effect_choice() {
				$data_hover_effect = blog_layout_design_hover_effect();
				return $data_hover_effect;
			}
		}
	} elseif ( in_array('advanced-masonry-blog-layout-design/advanced-masonry-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins'))) ) {
		if(function_exists('blog_layout_design_hover_effect_option_masonry')) {
			function blog_layout_design_effect_choice() {
				$data_hover_effect = blog_layout_design_hover_effect_option_masonry();
				return $data_hover_effect;
			}
		} else {
			function blog_layout_design_effect_choice() {
				$data_hover_effect = blog_layout_design_hover_effect();
				return $data_hover_effect;
			}
		}
	} elseif ( in_array('advanced-carousel-blog-layout-design/advanced-carousel-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins'))) ) {
		if(function_exists('blog_layout_design_hover_effect_option_carousel')) {
			function blog_layout_design_effect_choice() {
				$data_hover_effect = blog_layout_design_hover_effect_option_carousel();
				return $data_hover_effect;
			}
		} else {
			function blog_layout_design_effect_choice() {
				$data_hover_effect = blog_layout_design_hover_effect();
				return $data_hover_effect;
			}
		}
	} elseif ( in_array('advanced-justified-blog-layout-design/advanced-justified-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins'))) ) {
		if(function_exists('blog_layout_design_hover_effect_option_justified')) {
			function blog_layout_design_effect_choice() {
				$data_hover_effect = blog_layout_design_hover_effect_option_justified();
				return $data_hover_effect;
			}
		} else {
			function blog_layout_design_effect_choice() {
				$data_hover_effect = blog_layout_design_hover_effect();
				return $data_hover_effect;
			}
		}
	} else {
		function blog_layout_design_effect_choice() {
			$data_hover_effect = blog_layout_design_hover_effect();
			return $data_hover_effect;
		}
	}
} else {
	function blog_layout_design_effect_choice() {
		$data_hover_effect = blog_layout_design_hover_effect();
		return $data_hover_effect;
	}
}

function blog_layout_design_loading() {
	$data_loading_grid = array(
		'' => 'Style 1',
	);
	return $data_loading_grid;
}

if( in_array('advanced-grid-blog-layout-design/advanced-grid-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-masonry-blog-layout-design/advanced-masonry-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-justified-blog-layout-design/advanced-justified-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))){
	if(in_array('advanced-grid-blog-layout-design/advanced-grid-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		if(function_exists('blog_layout_design_grid_loading')) {
			function blog_layout_design_loading_choice() {
				$data_loading = blog_layout_design_grid_loading();
				return $data_loading;
			}
		} else {
			function blog_layout_design_loading_choice() {
				$data_loading = blog_layout_design_loading();
				return $data_loading;
			}
		}
	} elseif(in_array('advanced-masonry-blog-layout-design/advanced-masonry-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		if(function_exists('blog_layout_design_loading_masonry_option_masonry')) {
			function blog_layout_design_loading_choice() {
				$data_loading = blog_layout_design_loading_masonry_option_masonry();
				return $data_loading;
			}
		} else {
			function blog_layout_design_loading_choice() {
				$data_loading = blog_layout_design_loading();
				return $data_loading;
			}
		}
	} elseif(in_array('advanced-justified-blog-layout-design/advanced-justified-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		if(function_exists('blog_layout_design_loading_justified_option_justified')) {
			function blog_layout_design_loading_choice() {
				$data_loading = blog_layout_design_loading_justified_option_justified();
				return $data_loading;
			}
		} else {
			function blog_layout_design_loading_choice() {
				$data_loading = blog_layout_design_loading();
				return $data_loading;
			}
		}
	} else {
		function blog_layout_design_loading_choice() {
			$data_loading = blog_layout_design_loading();
			return $data_loading;
		}
	}
} else {
	function blog_layout_design_loading_choice() {
		$data_loading = blog_layout_design_loading();
		return $data_loading;
	}
}

if(in_array('advanced-grid-blog-layout-design/advanced-grid-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-masonry-blog-layout-design/advanced-masonry-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-justified-blog-layout-design/advanced-justified-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))){
		if(in_array('advanced-grid-blog-layout-design/advanced-grid-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
			if(function_exists('blog_layout_design_filter_option')) {
				function blog_layout_design_select_use_filter_by_js() {
					$data_filter = blog_layout_design_filter_option();
					return $data_filter;
				}
			}
		} elseif(in_array('advanced-masonry-blog-layout-design/advanced-masonry-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
			if(function_exists('blog_layout_design_filter_option_masonry')) {
				function blog_layout_design_select_use_filter_by_js() {
					$data_filter = blog_layout_design_filter_option_masonry();
					return $data_filter;
				}
			}
		} elseif(in_array('advanced-justified-blog-layout-design/advanced-justified-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
			if(function_exists('blog_layout_design_filter_option_justified')) {
				function blog_layout_design_select_use_filter_by_js() {
					$data_filter = blog_layout_design_filter_option_justified();
					return $data_filter;
				}
			}
		}
} else {
	function blog_layout_design_select_use_filter_by_js() {
		$data_filter = array('' => '');
		return $data_filter;
	}
	function blog_layout_design_select_use_filter_by_js_script() {
		global $post; ?>
		<script type="text/javascript">
			jQuery(document).ready( function () { 
				function ta_pba_change_font_to_upper(str = '') {
					return str.replace(/(?:^|\s)\w/g, function(match) {
						return match.toUpperCase();
					});
				}

				var selectOptDef = jQuery('[name="carbon_fields_compact_input[_blog_layout_design_showcase_style_main]"]:checked').val();
				var theOptDef = jQuery('<option></option>').attr("value", "").text('Need Advanced ' + ta_pba_change_font_to_upper(selectOptDef) + ' Add-On');
				jQuery('[name="carbon_fields_compact_input[_blog_layout_design_use_filter]"]').empty().html(theOptDef);

				jQuery('[name="carbon_fields_compact_input[_blog_layout_design_showcase_style_main]"]').on('change', function() {
					var selectOptCustom = jQuery(this).val();
						var theOptCustom = jQuery('<option></option>').attr("value", "").text('Need Advanced ' + ta_pba_change_font_to_upper(selectOptCustom) + ' Add-On');
						jQuery('[name="carbon_fields_compact_input[_blog_layout_design_use_filter]').ready(function() {
						jQuery('[name="carbon_fields_compact_input[_blog_layout_design_use_filter]"]').empty().html(theOptCustom);
					})
				})

			});
		</script>
	<?php }
	add_action('admin_head', 'blog_layout_design_select_use_filter_by_js_script');
}


if( in_array('advanced-grid-blog-layout-design/advanced-grid-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-masonry-blog-layout-design/advanced-masonry-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-justified-blog-layout-design/advanced-justified-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))){
		if(in_array('advanced-grid-blog-layout-design/advanced-grid-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
			if(function_exists('blog_layout_design_pagination_option')) {
				function blog_layout_design_pagination_option_data() {
					$data_pagination = blog_layout_design_pagination_option();
					return $data_pagination;
				}
			} else {
				function blog_layout_design_pagination_option_data() {
					$data_pagination = array(
						'' => 'No Pagination',
						'pagination_default' => 'Default',
						'pagination_number' => 'Number',
					);
					return $data_pagination;
				}
			}
		} elseif ( in_array('advanced-masonry-blog-layout-design/advanced-masonry-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins'))) ) {
			if(function_exists('blog_layout_design_pagination_option_masonry')) {
				function blog_layout_design_pagination_option_data() {
					$data_pagination = blog_layout_design_pagination_option_masonry();
					return $data_pagination;
				}
			} else {
				function blog_layout_design_pagination_option_data() {
					$data_pagination = array(
						'' => 'No Pagination',
						'pagination_default' => 'Default',
						'pagination_number' => 'Number',
					);
					return $data_pagination;
				}
			}
		} elseif ( in_array('advanced-justified-blog-layout-design/advanced-justified-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins'))) ) {
			if(function_exists('blog_layout_design_pagination_option_justified')) {
				function blog_layout_design_pagination_option_data() {
					$data_pagination = blog_layout_design_pagination_option_justified();
					return $data_pagination;
				}
			} else {
				function blog_layout_design_pagination_option_data() {
					$data_pagination = array(
						'' => 'No Pagination',
						'pagination_default' => 'Default',
						'pagination_number' => 'Number',
					);
					return $data_pagination;
				}
			}
		} else {
			function blog_layout_design_pagination_option_data() {
				$data_pagination = array(
					'' => 'No Pagination',
					'pagination_default' => 'Default',
					'pagination_number' => 'Number',
				);
				return $data_pagination;
			}
		}
} else {
	function blog_layout_design_pagination_option_data() {
		$data_pagination = array(
			'' => 'No Pagination',
			'pagination_default' => 'Default',
			'pagination_number' => 'Number',
		);
		return $data_pagination;
	}
}

if(in_array('advanced-grid-blog-layout-design/advanced-grid-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))){
	function blog_layout_design_select_display_post() {
		$data_post_data = array(
			'' => esc_html__('All'),
			'category' => 'Category',
			'specific_post' => 'Specific Post',
		);
		return $data_post_data;
	}
} elseif (in_array('advanced-masonry-blog-layout-design/advanced-masonry-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
	function blog_layout_design_select_display_post() {
		$data_post_data = array(
			'' => esc_html__('All'),
			'category' => 'Category',
			'specific_post' => 'Specific Post',
		);
		return $data_post_data;
	}
} elseif (in_array('advanced-carousel-blog-layout-design/advanced-carousel-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
	function blog_layout_design_select_display_post() {
		$data_post_data = array(
			'' => esc_html__('All'),
			'category' => 'Category',
			'specific_post' => 'Specific Post',
		);
		return $data_post_data;
	}
} elseif (in_array('advanced-slider-blog-layout-design/advanced-slider-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
	function blog_layout_design_select_display_post() {
		$data_post_data = array(
			'' => esc_html__('All'),
			'category' => 'Category',
			'specific_post' => 'Specific Post',
		);
		return $data_post_data;
	}
} elseif (in_array('advanced-justified-blog-layout-design/advanced-justified-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
	function blog_layout_design_select_display_post() {
		$data_post_data = array(
			'' => esc_html__('All'),
			'category' => 'Category',
			'specific_post' => 'Specific Post',
		);
		return $data_post_data;
	}
} else {
	function blog_layout_design_select_display_post() {
		$data_post_data = array('' => 'All');
		return $data_post_data;
	}
}

function select_blog_layout_design_order() {
	$blog_layout_design_order = array(
		'ID'                    => 'ID',
		'title'                 => 'Title',
		'date'                  => 'Date',
		'rand'                  => 'Random'
	);

	return $blog_layout_design_order;
}

function select_blog_layout_design_order_by() {
	$blog_layout_design_orderby = array(
		'asc'   => esc_html__('Ascending', 'blog-layout-design'),
		'desc'     => esc_html__('Descending', 'blog-layout-design'),
	);

	return $blog_layout_design_orderby;
}

function blog_layout_design_select_category() {
	$output_categories2 = array();
	$category_terms = get_terms(array('category','hide_empty' => true));

	foreach($category_terms as $category) {
		$output_categories2[$category->slug] = $category->name;
	}

	return $output_categories2;
}

if(in_array('advanced-grid-blog-layout-design/advanced-grid-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-masonry-blog-layout-design/advanced-masonry-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-carousel-blog-layout-design/advanced-carousel-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-slider-blog-layout-design/advanced-slider-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-justified-blog-layout-design/advanced-justified-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))){
	if(in_array('advanced-grid-blog-layout-design/advanced-grid-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))){
		if(function_exists('blog_layout_design_link_option')) {
			function blog_layout_design_select_link_post() {
				$data_post_data = blog_layout_design_link_option();
				return $data_post_data;
			}
		} else {
			function blog_layout_design_select_link_post() {
				$data_post_data = array(
				    'post_item' => esc_html__('Post Item', 'blog-layout-design'),
				    'custom_link' => esc_html__('Custom Link', 'blog-layout-design'),
				);
				return $data_post_data;
			}
		}
	} elseif (in_array('advanced-masonry-blog-layout-design/advanced-masonry-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		if(function_exists('blog_layout_design_link_option_masonry')) {
			function blog_layout_design_select_link_post() {
				$data_post_data = blog_layout_design_link_option_masonry();
				return $data_post_data;
			}
		} else {
			function blog_layout_design_select_link_post() {
				$data_post_data = array(
				    'post_item' => esc_html__('Post Item', 'blog-layout-design'),
				    'custom_link' => esc_html__('Custom Link', 'blog-layout-design'),
				);
				return $data_post_data;
			}
		}
	} elseif (in_array('advanced-carousel-blog-layout-design/advanced-carousel-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		if(function_exists('blog_layout_design_link_option_carousel')) {
			function blog_layout_design_select_link_post() {
				$data_post_data = blog_layout_design_link_option_carousel();
				return $data_post_data;
			}
		} else {
			function blog_layout_design_select_link_post() {
				$data_post_data = array(
				    'post_item' => esc_html__('Post Item', 'blog-layout-design'),
				);
				return $data_post_data;
			}
		}
	} elseif (in_array('advanced-slider-blog-layout-design/advanced-slider-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		if(function_exists('blog_layout_design_link_option_slider')) {
			function blog_layout_design_select_link_post() {
				$data_post_data = blog_layout_design_link_option_slider();
				return $data_post_data;
			}
		} else {
			function blog_layout_design_select_link_post() {
				$data_post_data = array(
				    'post_item' => esc_html__('Post Item', 'blog-layout-design'),
				);
				return $data_post_data;
			}
		}
	} elseif (in_array('advanced-justified-blog-layout-design/advanced-justified-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		if(function_exists('blog_layout_design_link_option_justified')) {
			function blog_layout_design_select_link_post() {
				$data_post_data = blog_layout_design_link_option_justified();
				return $data_post_data;
			}
		} else {
			function blog_layout_design_select_link_post() {
				$data_post_data = array(
				    'post_item' => esc_html__('Post Item', 'blog-layout-design'),
				);
				return $data_post_data;
			}
		}
	} else {
		function blog_layout_design_select_link_post() {
			$data_post_data = array(
			    'post_item' => esc_html__('Post Item', 'blog-layout-design'),
			);
			return $data_post_data;
		}
	}
} else {
	function blog_layout_design_select_link_post() {
		$data_post_data = array(
		    'post_item' => esc_html__('Post Item', 'blog-layout-design'),
		    'custom_link' => esc_html__('Custom Link', 'blog-layout-design'),
		);
		return $data_post_data;
	}
}

if(in_array('advanced-grid-blog-layout-design/advanced-grid-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))){
	if(function_exists('blog_layout_design_grid_style')) {
	    function blog_layout_design_select_grid() {
	        $data_post_data = blog_layout_design_grid_style();
	        return $data_post_data;
	    }
	} else {
	    function blog_layout_design_select_grid() {
	        $data_post_data = array(
	            'grid-full-image-1' => esc_html__('Grid Full Image', 'blog-layout-design'),
	            'grid-card-1' => esc_html__('Grid Card', 'blog-layout-design'),
	        );
	        return $data_post_data;
	    }
	}
} else {
    function blog_layout_design_select_grid() {
        $data_post_data = array(
            'grid-full-image-1' => esc_html__('Grid Full Image', 'blog-layout-design'),
            'grid-card-1' => esc_html__('Grid Card', 'blog-layout-design'),
        );
        return $data_post_data;
    }
}

if(in_array('advanced-masonry-blog-layout-design/advanced-masonry-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))){
	if(function_exists('blog_layout_design_style_masonry')) {
	    function blog_layout_design_select_masonry() {
	        $data_post_data = blog_layout_design_style_masonry();
	        return $data_post_data;
	    }
	} else {
	    function blog_layout_design_select_masonry() {
	        $data_post_data = array(
				'masonry-full-image-1' => 'Masonry Full Image',
				'masonry-card-1' => 'Masonry Card',
	        );
	        return $data_post_data;
	    }
	}
} else {
    function blog_layout_design_select_masonry() {
        $data_post_data = array(
			'masonry-full-image-1' => 'Masonry Full Image',
			'masonry-card-1' => 'Masonry Card',
        );
        return $data_post_data;
    }
}

if(in_array('advanced-carousel-blog-layout-design/advanced-carousel-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))){
	if(function_exists('blog_layout_design_style_carousel')) {
	    function blog_layout_design_select_carousel() {
	        $data_post_data = blog_layout_design_style_carousel();
	        return $data_post_data;
	    }
	} else {
	    function blog_layout_design_select_carousel() {
	        $data_post_data = array(
				'carousel-full-image-1' => 'Carousel Full Image',
	        );
	        return $data_post_data;
	    }
	}
} else {
    function blog_layout_design_select_carousel() {
        $data_post_data = array(
			'carousel-full-image-1' => 'Carousel Full Image',
        );
        return $data_post_data;
    }
}

if(in_array('advanced-justified-blog-layout-design/advanced-justified-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))){
	if(function_exists('blog_layout_design_style_justified')) {
	    function blog_layout_design_select_justified() {
	        $data_post_data = blog_layout_design_style_justified();
	        return $data_post_data;
	    }
	} else {
	    function blog_layout_design_select_justified() {
	        $data_post_data = array(
				'justified-full-image-1' => 'Justified Full Image',
	        );
	        return $data_post_data;
	    }
	}
} else {
    function blog_layout_design_select_justified() {
        $data_post_data = array(
			'justified-full-image-1' => 'Justified Full Image',
        );
        return $data_post_data;
    }
}

if(in_array('advanced-slider-blog-layout-design/advanced-slider-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))){
	if(function_exists('blog_layout_design_style_slider')) {
	    function blog_layout_design_select_slider() {
	        $data_post_data = blog_layout_design_style_slider();
	        return $data_post_data;
	    }
	} else {
	    function blog_layout_design_select_slider() {
	        $data_post_data = array(
				'slider-full-image-1' => 'Slider Full Image',
	        );
	        return $data_post_data;
	    }
	}
} else {
    function blog_layout_design_select_slider() {
        $data_post_data = array(
			'slider-full-image-1' => 'Slider Full Image',
        );
        return $data_post_data;
    }
}

if(in_array('advanced-grid-blog-layout-design/advanced-grid-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-masonry-blog-layout-design/advanced-masonry-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-carousel-blog-layout-design/advanced-carousel-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-slider-blog-layout-design/advanced-slider-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-justified-blog-layout-design/advanced-justified-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
	if(in_array('advanced-grid-blog-layout-design/advanced-grid-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		if(function_exists('blog_layout_design_single_option_grid')) {
			function blog_layout_design_single_option() {
			    $data_post_data = blog_layout_design_single_option_grid();
			    return $data_post_data;
			}
		}
	} elseif(in_array('advanced-masonry-blog-layout-design/advanced-masonry-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		if(function_exists('blog_layout_design_single_option_masonry')) {
			function blog_layout_design_single_option() {
			    $data_post_data = blog_layout_design_single_option_masonry();
			    return $data_post_data;
			}
		}
	} elseif(in_array('advanced-carousel-blog-layout-design/advanced-carousel-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		if(function_exists('blog_layout_design_single_option_carousel')) {
			function blog_layout_design_single_option() {
			    $data_post_data = blog_layout_design_single_option_carousel();
			    return $data_post_data;
			}
		}
	} elseif(in_array('advanced-slider-blog-layout-design/advanced-slider-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		if(function_exists('blog_layout_design_single_option_slider')) {
			function blog_layout_design_single_option() {
			    $data_post_data = blog_layout_design_single_option_slider();
			    return $data_post_data;
			}
		}
	} elseif(in_array('advanced-justified-blog-layout-design/advanced-justified-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		if(function_exists('blog_layout_design_single_option_justified')) {
			function blog_layout_design_single_option() {
			    $data_post_data = blog_layout_design_single_option_justified();
			    return $data_post_data;
			}
		}
	}
} else {
	function blog_layout_design_single_option() {
	    $data_post_data = array(
	       'single-post-blog-layout-design-blank.php' => esc_html__('Blank Template', 'blog-layout-design'),
	    );
	    return $data_post_data;
	}
}

if(in_array('advanced-carousel-blog-layout-design/advanced-carousel-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-slider-blog-layout-design/advanced-slider-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))){
	if(function_exists('blog_layout_design_pagination_option_carousel')) {
		function blog_layout_design_select_pagination_style() {
		    $data_post_data = blog_layout_design_pagination_option_carousel();
		    return $data_post_data;
		}
	} elseif(function_exists('blog_layout_design_pagination_option_slider')) {
		function blog_layout_design_select_pagination_style() {
		    $data_post_data = blog_layout_design_pagination_option_slider();
		    return $data_post_data;
		}
	} else {
		function blog_layout_design_select_pagination_style() {
		    $data_post_data = array(
		       'style-1' => 'Style 1',
		    );
		    return $data_post_data;
		}
	}
} else {
	function blog_layout_design_select_pagination_style() {
	    $data_post_data = array(
	       'style-1' => 'Style 1',
	    );
	    return $data_post_data;
	}
}

if(in_array('advanced-carousel-blog-layout-design/advanced-carousel-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-slider-blog-layout-design/advanced-slider-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))){
	if(function_exists('blog_layout_design_arrow_option_carousel')) {
		function blog_layout_design_select_arrow_style() {
		    $data_post_data = blog_layout_design_arrow_option_carousel();
		    return $data_post_data;
		}
	} elseif(function_exists('blog_layout_design_arrow_option_slider')) {
		function blog_layout_design_select_arrow_style() {
		    $data_post_data = blog_layout_design_arrow_option_slider();
		    return $data_post_data;
		}
	} else {
		function blog_layout_design_select_arrow_style() {
		    $data_post_data = array(
		       'style-1' => 'Style 1',
		    );
		    return $data_post_data;
		}
	}
} else {
	function blog_layout_design_select_arrow_style() {
	    $data_post_data = array(
	       'style-1' => 'Style 1',
	    );
	    return $data_post_data;
	}
}

add_action('init', 'blog_layout_design_single_css', 97);
function blog_layout_design_single_css() {
	$actual_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$post_id = url_to_postid($actual_url);
	$post_type = get_post_type( $post_id );
	$template = get_page_template_slug($post_id, '_wp_page_template', true);
	if ($post_type == 'post' && $template == 'single-blog-layout-design-hiji.php') {
		if(in_array('advanced-grid-blog-layout-design/advanced-grid-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
     		wp_enqueue_style( 'agbld-advanced-grid-blog-layout-design-styles', plugin_dir_url('README.txt') .'/advanced-grid-blog-layout-design/assets/css/styles.css', array(), '', 'all' );
     	} elseif (in_array('advanced-masonry-blog-layout-design/advanced-masonry-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
     		wp_enqueue_style( 'ambld-advanced-masonry-blog-layout-design-styles', plugin_dir_url('README.txt') .'/advanced-masonry-blog-layout-design/assets/css/styles.css', array(), '', 'all' );
     	} elseif (in_array('advanced-carousel-blog-layout-design/advanced-carousel-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
     		wp_enqueue_style( 'acbld-advanced-carousel-blog-layout-design-styles', plugin_dir_url('README.txt') .'/advanced-carousel-blog-layout-design/assets/css/styles.css', array(), '', 'all' );
     	} elseif (in_array('advanced-slider-blog-layout-design/advanced-slider-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
     		wp_enqueue_style( 'asbld-advanced-slider-blog-layout-design-styles', plugin_dir_url('README.txt') .'/advanced-slider-blog-layout-design/assets/css/styles.css', array(), '', 'all' );
     	} elseif (in_array('advanced-justified-blog-layout-design/advanced-justified-blog-layout-design.php', apply_filters('active_plugins', get_option('active_plugins')))) {
     		wp_enqueue_style( 'ajbld-advanced-justified-blog-layout-design-styles', plugin_dir_url('README.txt') .'/advanced-justified-blog-layout-design/assets/css/styles.css', array(), '', 'all' );
     	}
    }
}