<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Block;

Container::make( 'post_meta', 'side_shortcode', esc_html__( 'Shortcode', 'blog-layout-design' ) )
	->where( 'post_type', '=', 'blogshowcase-design' )
	->set_context( 'side' )
	->set_priority( 'default' )
	->add_fields( array(

	Field::make( 'html', 'blog_layout_style', esc_html__( 'Section Description', 'blog-layout-design' ) )
		->set_html( sprintf( '<div class="shortcode-wrap-ta"><code id="shortcode_blog_layout_to_copy"></code></div>', __( 'Here, you can add some useful description for the fields below / above this text.' ) ) ),
));

Container::make( 'post_meta', 'blog_layout_showcase_features', esc_html('Blog Layout Showcase', 'blog-layout-design') )
->where( 'post_type', '=', 'blogshowcase-design' )
->set_priority( 'default' )
->add_tab(  esc_html__( 'Layout', 'blog-layout-design' ), array( // Layout Tab

    Field::make( 'radio_image', 'blog_layout_design_showcase_style_main', esc_html__( 'Select Layout', 'blog-layout-design' ) )
    ->set_classes( 'select-image-layout' )
    ->set_width( 50 )
    ->add_options( array(
        'grid' => plugin_dir_url('README.txt') . BLOG_LAYOUT_DESIGN_NAME . '/assets/grid.png',
        'masonry' => plugin_dir_url('README.txt') . BLOG_LAYOUT_DESIGN_NAME . '/assets/masonry.png',
        'carousel' => plugin_dir_url('README.txt') . BLOG_LAYOUT_DESIGN_NAME . '/assets/carousel.png',
        'slider' => plugin_dir_url('README.txt') . BLOG_LAYOUT_DESIGN_NAME . '/assets/slide.png',
        'justified' => plugin_dir_url('README.txt') . BLOG_LAYOUT_DESIGN_NAME . '/assets/justified.png',
    )),

    Field::make( 'select', 'blog_layout_design_showcase_style', esc_html__( 'Select Style', 'blog-layout-design' ) )
    ->set_width( 50 )
    ->add_options( 
        blog_layout_design_select_grid()
    )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
    )),

    Field::make( 'select', 'blog_layout_design_showcase_style2', esc_html__( 'Select Style', 'blog-layout-design' ) )
    ->set_width( 50 )
    ->add_options( 
        blog_layout_design_select_masonry(),
    )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'masonry',
            'compare' => '=',
        ),
    )),

    Field::make( 'select', 'blog_layout_design_showcase_style3', esc_html__( 'Select Style', 'blog-layout-design' ) )
    ->set_width( 50 )
    ->add_options( 
        blog_layout_design_select_carousel(),
    )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
    )),

    Field::make( 'select', 'blog_layout_design_showcase_style4', esc_html__( 'Select Style', 'blog-layout-design' ) )
    ->set_width( 50 )
    ->add_options( 
        blog_layout_design_select_justified(),
    )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'justified',
            'compare' => '=',
        ),
    )),

    Field::make( 'select', 'blog_layout_design_showcase_style5', esc_html__( 'Select Style', 'blog-layout-design' ) )
    ->set_width( 50 )
    ->add_options( 
        blog_layout_design_select_slider(),
    )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'slider',
            'compare' => '=',
        ),
    )),

    Field::make( 'separator', 'blog_layout_separator_col_title1', 'Column' )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'masonry',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
    )),

    Field::make( 'select', 'blog_layout_showcase_choose_column', esc_html__( 'Choose Column', 'blog-layout-design' ) )
    ->set_width( 33 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'masonry',
            'compare' => '=',
        ),
    ))
    ->add_options( array(
       '1' => '1',
       '2' => '2',
       '3' => '3',
       '4' => '4',
       '5' => '5',
       '6' => '6',
       '7' => '7',
       '8' => '8',
    )),

    Field::make( 'select', 'blog_layout_showcase_choose_column_carousel', esc_html__( 'Choose Column', 'blog-layout-design' ) )
    ->set_width( 16 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style3',
            'value' => 'carousel-full-image-1',
            'compare' => '=',
        ),
    ))
    ->add_options( array(
       '2' => '2',
       '3' => '3',
       '4' => '4',
       '5' => '5',
       '6' => '6',
       '7' => '7',
       'auto' => 'Auto',
    )),

    Field::make( 'select', 'blog_layout_showcase_choose_row_carousel', esc_html__( 'Choose Row', 'blog-layout-design' ) )
    ->set_width( 16 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style3',
            'value' => 'carousel-full-image-1',
            'compare' => '=',
        ),
    ))
    ->add_options( array(
       '1' => '1',
       '2' => '2',
       '3' => '3',
       '4' => '4',
    )),

    Field::make( 'select', 'blog_layout_showcase_choose_column_tablet', esc_html__( 'Choose Column Tablet', 'blog-layout-design' ) )
    ->set_width( 33 )
    ->set_conditional_logic( 
        array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'masonry',
            'compare' => '=',
        ),
    ))
    ->add_options( array(
       '1' => '1',
       '2' => '2',
       '3' => '3',
       '4' => '4',
    )),

    Field::make( 'select', 'blog_layout_showcase_choose_column_tablet_carousel', esc_html__( 'Choose Column Tablet', 'blog-layout-design' ) )
    ->set_width( 16 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style3',
            'value' => 'carousel-full-image-1',
            'compare' => '=',
        ),
    ))
    ->add_options( array(
       '1' => '1',
       '2' => '2',
       '3' => '3',
       '4' => '4',
       'auto' => 'Auto',
    )),

    Field::make( 'select', 'blog_layout_showcase_choose_row_tablet_carousel', esc_html__( 'Choose Row Tablet', 'blog-layout-design' ) )
    ->set_width( 16 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style3',
            'value' => 'carousel-full-image-1',
            'compare' => '=',
        ),
    ))
    ->add_options( array(
       '1' => '1',
       '2' => '2',
       '3' => '3',
       '4' => '4',
    )),

    Field::make( 'select', 'blog_layout_showcase_choose_column_mobile', esc_html__( 'Choose Column Mobile', 'blog-layout-design' ) )
    ->set_width( 33 )
    ->set_conditional_logic( 
        array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'masonry',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style2',
            'value' => 'masonry-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style',
            'value' => 'grid-full-image-1',
            'compare' => '=',
        ),
    ))
    ->add_options( array(
       '1' => '1',
       '2' => '2',
       '3' => '3',
       '4' => '4',
    )),

    Field::make( 'select', 'blog_layout_showcase_choose_column_mobile_carousel', esc_html__( 'Choose Column Mobile', 'blog-layout-design' ) )
    ->set_width( 16 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style3',
            'value' => 'carousel-full-image-1',
            'compare' => '=',
        ),
    ))
    ->add_options( array(
       '1' => '1',
       '2' => '2',
       '3' => '3',
       '4' => '4',
       'auto' => 'Auto',
    )),

    Field::make( 'select', 'blog_layout_showcase_choose_row_mobile_carousel', esc_html__( 'Choose Row Mobile', 'blog-layout-design' ) )
    ->set_width( 16 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style3',
            'value' => 'carousel-full-image-1',
            'compare' => '=',
        ),
    ))
    ->add_options( array(
       '1' => '1',
       '2' => '2',
       '3' => '3',
       '4' => '4',
    )),

    Field::make( 'separator', 'blog_layout_separator_col_title2', 'Space & Size' )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'masonry',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'justified',
            'compare' => '=',
        ),
    )),

    Field::make( 'number', 'blog_layout_showcase_padding', esc_html__( 'Padding', 'blog-layout-design' ) )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'masonry',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'justified',
            'compare' => '=',
        ),
    ))
    ->set_width( 33 ),

    Field::make( 'number', 'blog_layout_showcase_padding_tablet', esc_html__( 'Padding Tablet', 'blog-layout-design' ) )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'masonry',
            'compare' => '=',
        ),
    ))
    ->set_width( 33 ),

    Field::make( 'number', 'blog_layout_showcase_padding_mobile', esc_html__( 'Padding Mobile', 'blog-layout-design' ) )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'masonry',
            'compare' => '=',
        ),
    ))
    ->set_width( 33 ),

    Field::make( 'number', 'blog_layout_width_image', esc_html__( 'Width', 'blog-layout-design' ) )
    ->set_conditional_logic( 
        array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'masonry',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style',
            'value' => 'grid-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style3',
            'value' => 'carousel-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style2',
            'value' => 'masonry-full-image-1',
            'compare' => '=',
        ),
    ) )
    ->set_width( 33 ),

    Field::make( 'number', 'blog_layout_height_image', esc_html__( 'Height', 'blog-layout-design' ) )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'justified',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style',
            'value' => 'grid-full-image-1',
            'compare' => '=',
        ),
    ) )
    ->set_width( 33 ),

    Field::make( 'separator', 'blog_layout_separator_col_title3', 'Animation & Filter' )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'masonry',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'justified',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style',
            'value' => 'grid-full-image-1',
            'compare' => '=',
        ),
    )),

    Field::make( 'separator', 'blog_layout_separator_col_title_animation', 'Animation' )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style',
            'value' => 'carousel-full-image-1',
            'compare' => '=',
        ),
    )),

    Field::make( 'select', 'blog_layout_showcase_hover', esc_html__( 'Hover Style', 'blog-layout-design' ) )
    ->set_width( 25 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'masonry',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'justified',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style',
            'value' => 'grid-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style',
            'value' => 'carousel-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style',
            'value' => 'masonry-full-image-1',
            'compare' => '=',
        ),
    ))
    ->add_options(
        blog_layout_design_effect_choice()
    ),

    Field::make( 'select', 'blog_layout_showcase_loading_grid', __( 'Loading Style' ) )
    ->set_width( 25)
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'masonry',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'justified',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style',
            'value' => 'grid-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style2',
            'value' => 'masonry-full-image-1',
            'compare' => '=',
        ),
    ))
    ->add_options(
        blog_layout_design_loading_choice()
    ),

    Field::make( 'select', 'blog_layout_design_use_filter', esc_html__( 'Use Filter', 'blog-layout-design' ) )
    ->set_width( 25 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'masonry',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'justified',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style',
            'value' => 'grid-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style2',
            'value' => 'masonry-full-image-1',
            'compare' => '=',
        ),
    ))
    ->add_options( 
       blog_layout_design_select_use_filter_by_js()
    ),

    /*Field::make( 'select', 'blog_layout_design_use_filter', esc_html__( 'Use Filter', 'blog-layout-design' ) )
    ->set_width( 25 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'masonry',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style',
            'value' => 'grid-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style2',
            'value' => 'masonry-full-image-1',
            'compare' => '=',
        ),
    ) )
    ->add_options( 
       blog_layout_design_select_use_filter_by_js()
    ),*/

    Field::make( 'select', 'blog_layout_pagination_type', esc_html__( 'Pagination', 'blog-layout-design' ) )
    ->set_width( 25 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'masonry',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'justified',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style',
            'value' => 'grid-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style2',
            'value' => 'masonry-full-image-1',
            'compare' => '=',
        ),
    ) )
    ->add_options( 
        blog_layout_design_pagination_option_data()
    ),

    Field::make( 'separator', 'blog_layout_separator_col_title4', 'Carousel Options' )
    ->set_width( 100 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
    )),

    Field::make( 'separator', 'blog_layout_separator_col_title_slider', 'Slider Options' )
    ->set_width( 100 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'slider',
            'compare' => '=',
        ),
    )),

    Field::make( 'select', 'blog_layout_height_option', esc_html__( 'Slider Layout Height', 'blog-layout-design' ) )
    ->set_width( 50 )
    ->set_conditional_logic( array(
        'relation' => 'AND',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'slider',
            'compare' => '=',
        ),
    ) )
    ->add_options( 
        array(
            '' => esc_html__('Choose', 'blog-layout-design'),
            'default' => esc_html__('Default', 'blog-layout-design'),
            'fullscreen' => esc_html__('Full Screen', 'blog-layout-design')
        )
    ),

    Field::make( 'number', 'blog_layout_header_height_custom', esc_html__( 'Header Height', 'blog-layout-design' ) )
    ->set_width( 50 )
    ->set_conditional_logic( 
    array(
        'relation' => 'AND',
        array(
            'field' => 'blog_layout_height_option',
            'value' => 'fullscreen',
            'compare' => '=',
        ),
    )),

    Field::make( 'number', 'blog_layout_content_height_custom', esc_html__( 'Content Height', 'blog-layout-design' ) )
    ->set_width( 50 )
    ->set_conditional_logic( 
    array(
        'relation' => 'AND',
        array(
            'field' => 'blog_layout_height_option',
            'value' => 'default',
            'compare' => '=',
        ),
    )),

    Field::make( 'checkbox', 'blog_layout_use_arrow', esc_html__( 'Use Arrow Navigation', 'blog-layout-design' ) )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'slider',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style3',
            'value' => 'carousel-full-image-1',
            'compare' => '=',
        ),
    ) )
    ->set_width( 15 )
    ->set_option_value( 'yes' ),

    Field::make( 'checkbox', 'blog_layout_use_pagination', esc_html__( 'Use Pagination', 'blog-layout-design' ) )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'slider',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style3',
            'value' => 'carousel-full-image-1',
            'compare' => '=',
        ),
    ) )
    ->set_width( 15 )
    ->set_option_value( 'yes' ),

    Field::make( 'checkbox', 'blog_layout_use_autoplay', esc_html__( 'Use Autoplay', 'blog-layout-design' ) )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'slider',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style3',
            'value' => 'carousel-full-image-1',
            'compare' => '=',
        ),
    ) )
    ->set_width( 15 )
    ->set_option_value( 'yes' ),

    Field::make( 'checkbox', 'blog_layout_centered_slides', esc_html__( 'Centered Slides', 'blog-layout-design' ) )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style3',
            'value' => 'carousel-full-image-1',
            'compare' => '=',
        ),
    ) )
    ->set_width( 15 )
    ->set_option_value( 'yes' ),

    Field::make( 'checkbox', 'blog_layout_use_loop', esc_html__( 'Loop Mode', 'blog-layout-design' ) )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style3',
            'value' => 'carousel-full-image-1',
            'compare' => '=',
        ),
    ) )
    ->set_width( 15 )
    ->set_option_value( 'yes' ),

    Field::make( 'checkbox', 'blog_layout_scroll_mouse', esc_html__( 'Scroll Slide', 'blog-layout-design' ) )
    ->set_width( 15 )
    ->set_option_value( 'yes' )
    ->set_conditional_logic( array(
        'relation' => 'AND',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'select', 'blog_layout_select_arrow', esc_html__( 'Select Arrow Style', 'blog-layout-design' ) )
    ->set_width( 20 )
    ->set_conditional_logic( array(
        'relation' => 'AND',
        array(
            'field' => 'blog_layout_use_arrow',
            'value' => true,
            'compare' => '=',
        ),
    ) )
    ->add_options( 
        blog_layout_design_select_arrow_style()
    ),

    Field::make( 'select', 'blog_layout_select_dot', esc_html__( 'Select Dot Style', 'blog-layout-design' ) )
    ->set_width( 20 )
    ->set_conditional_logic( array(
        'relation' => 'AND',
        array(
            'field' => 'blog_layout_use_pagination',
            'value' => true,
            'compare' => '=',
        ),
    ) )
    ->add_options( 
        blog_layout_design_select_pagination_style()
    ),

    Field::make( 'text', 'blog_layout_autoplay_speed', esc_html__( 'Autoplay Speed (in Millisecond)', 'blog-layout-design' ) )
    ->set_attribute( 'placeholder', '2500' )
    ->set_width( 20 )
    ->set_conditional_logic( array(
        'relation' => 'AND',
        array(
            'field' => 'blog_layout_use_autoplay',
            'value' => true,
            'compare' => '=',
        ),
    ) ),

    Field::make( 'text', 'blog_layout_offside_arrow', esc_html__( 'Arrow Offside', 'blog-layout-design' ) )
    ->set_attribute( 'placeholder', '0' )
    ->set_width( 20 )
    ->set_conditional_logic( array(
        'relation' => 'AND',
        array(
            'field' => 'blog_layout_use_arrow',
            'value' => true,
            'compare' => '=',
        ),
    ) ),

    Field::make( 'text', 'blog_layout_offside_arrow_tablet', esc_html__( 'Arrow Offside Tablet', 'blog-layout-design' ) )
    ->set_attribute( 'placeholder', '0' )
    ->set_width( 20 )
    ->set_conditional_logic( array(
        'relation' => 'AND',
        array(
            'field' => 'blog_layout_use_arrow',
            'value' => true,
            'compare' => '=',
        ),
    ) ),

    Field::make( 'text', 'blog_layout_offside_arrow_mobile', esc_html__( 'Arrow Offside Mobile', 'blog-layout-design' ) )
    ->set_attribute( 'placeholder', '0' )
    ->set_width( 20 )
    ->set_conditional_logic( array(
        'relation' => 'AND',
        array(
            'field' => 'blog_layout_use_arrow',
            'value' => true,
            'compare' => '=',
        ),
    ) ),

    Field::make( 'text', 'blog_layout_offside_pagination', esc_html__( 'Pagination Offside', 'blog-layout-design' ) )
    ->set_attribute( 'placeholder', '0' )
    ->set_width( 20 )
    ->set_conditional_logic( array(
        'relation' => 'AND',
        array(
            'field' => 'blog_layout_use_pagination',
            'value' => true,
            'compare' => '=',
        ),
    ) ),

    Field::make( 'text', 'blog_layout_offside_pagination_tablet', esc_html__( 'Pagination Offside Tablet', 'blog-layout-design' ) )
    ->set_attribute( 'placeholder', '0' )
    ->set_width( 20 )
    ->set_conditional_logic( array(
        'relation' => 'AND',
        array(
            'field' => 'blog_layout_use_pagination',
            'value' => true,
            'compare' => '=',
        ),
    ) ),

    Field::make( 'text', 'blog_layout_offside_pagination_mobile', esc_html__( 'Pagination Offside Mobile', 'blog-layout-design' ) )
    ->set_attribute( 'placeholder', '0' )
    ->set_width( 20 )
    ->set_conditional_logic( array(
        'relation' => 'AND',
        array(
            'field' => 'blog_layout_use_pagination',
            'value' => true,
            'compare' => '=',
        ),
    ) ),

    Field::make( 'select', 'blog_layout_hover_image_effect', esc_html__( 'Hover Image Effect', 'blog-layout-design' ) )
    ->set_width( 50 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style',
            'value' => 'unique-limabelas',
            'compare' => '=',
        ),
    ) )
    ->add_options( array(
       '1' => 'Effect 1',
       '2' => 'Effect 2',
       '3' => 'Effect 3',
       '4' => 'Effect 4',
       '5' => 'Effect 5',
       '6' => 'Effect 6',
       '7' => 'Effect 7',
       '8' => 'Effect 8',
       '9' => 'Effect 9',
       '10' => 'Effect 10',
       '11' => 'Effect 11',
       '12' => 'Effect 12',
       '13' => 'Effect 13',
       '14' => 'Effect 14',
       '15' => 'Effect 15',
       '16' => 'Effect 16'
    )),

))
->add_tab(  esc_html__( 'Content', 'blog-layout-design' ), array( // Content Tab

    Field::make( 'select', 'blog_layout_select_display_post', esc_html__( 'Select Display Post', 'blog-layout-design' ) )
    ->set_width( 25 )
    ->add_options(
        blog_layout_design_select_display_post()
    )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'masonry',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'justified',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'slider',
            'compare' => '=',
        ),
    )),

    Field::make( 'text', 'blog_layout_showcase_items', esc_html__( 'Posts Per Page', 'blog-layout-design' ) )
    ->set_attribute( 'placeholder', esc_html__('10', 'blog-layout-design' ) )
    ->set_width( 25 )
    ->set_help_text( 'How many posts you want to show in showcase. If empty will show all posts.' ),

    Field::make( 'select', 'blog_layout_showcase_order', esc_html__( 'Order', 'blog-layout-design' ) )
    ->set_width( 25 )
    ->add_options(
        select_blog_layout_design_order()
    )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_select_display_post',
            'value' => 'category',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_select_display_post',
            'value' => '',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'select', 'blog_layout_showcase_order_by', esc_html__( 'Order By', 'blog-layout-design' ) )
    ->set_width( 25 )
    ->add_options(
        select_blog_layout_design_order_by()
    )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_select_display_post',
            'value' => 'category',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_select_display_post',
            'value' => '',
            'compare' => '=',
        ),
    ) ),

	Field::make( 'multiselect', 'blog_layout_showcase_cats', esc_html__( 'Select Blog Category', 'blog-layout-design' ) )
    ->add_options(
    	blog_layout_design_select_category()
    )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_select_display_post',
            'value' => 'category',
            'compare' => '=',
        ),
    ) ),

	Field::make( 'association', 'blog_layout_showcase_posts', esc_html__( 'Select Blog Posts', 'blog-layout-design' ) )
    ->set_types( array(
        array(
            'type'      => 'post',
            'post_type' => 'post',
        )
    ) )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_select_display_post',
            'value' => 'specific_post',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'multiselect', 'blog_layout_showcase_category_filter', esc_html__( 'Category Filter', 'blog-layout-design' ) )
    ->add_options(
        blog_layout_design_select_category()
    )
    ->set_conditional_logic( array(
        'relation' => 'AND',
        array(
            'field' => 'blog_layout_select_display_post',
            'value' => 'specific_post',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_use_filter',
            'value' => 'yes',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'select', 'blog_layout_select_link_post', esc_html__( 'Link Goes To', 'blog-layout-design' ) )
    ->set_width( 25 )
    ->add_options(
        blog_layout_design_select_link_post()
    )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'masonry',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'justified',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'slider',
            'compare' => '=',
        ),
    )),

    Field::make( 'text', 'blog_layout_button_content', esc_html__( 'Button Text', 'blog-layout-design' ) )
    ->set_width( 25 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style5',
            'value' => 'slider-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style5',
            'value' => 'slider-genep',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style5',
            'value' => 'slider-tujuh',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style5',
            'value' => 'slider-dalapan',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style5',
            'value' => 'slider-salapan',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style5',
            'value' => 'slider-sapuluh',
            'compare' => '=',
        )
    )),

    Field::make( 'text', 'blog_layout_text_load_more', esc_html__( 'Text Load More', 'blog-layout-design' ) )
    ->set_attribute( 'placeholder', esc_html__('Load More', 'blog-layout-design' ) )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_pagination_type',
            'value' => 'pagination_load_more',
            'compare' => '=',
        ),
    ) ),
))
->add_tab(  esc_html__( 'Customize', 'blog-layout-design' ), array( // Customize Tab

    Field::make( 'separator', 'blog_layout_separator_layout_style', 'Layout Style' ),

    Field::make( 'color', 'blog_layout_title_color', esc_html__( 'Title Color', 'blog-layout-design' ) )
     ->set_width( 14 ),

    Field::make( 'color', 'blog_layout_title_color_hover', esc_html__( 'Title Hover Color', 'blog-layout-design' ) )
     ->set_width( 14 ),

    Field::make( 'color', 'blog_layout_category_color', esc_html__( 'Category Color', 'blog-layout-design' ) )
     ->set_width( 14 ),

    Field::make( 'color', 'blog_layout_category_color_hover', esc_html__( 'Category Hover Color', 'blog-layout-design' ) )
     ->set_width( 14 ),

    Field::make( 'color', 'blog_layout_category_bg_color', esc_html__( 'Category Background Color', 'blog-layout-design' ) )
     ->set_width( 14 ),

    Field::make( 'color', 'blog_layout_category_bg_color_hover', esc_html__( 'Category Background Hover Color', 'blog-layout-design' ) )
     ->set_width( 14 ),

    Field::make( 'color', 'blog_layout_content_color', esc_html__( 'Content Color', 'blog-layout-design' ) )
     ->set_width( 14 ),

    Field::make( 'color', 'blog_layout_date_color', esc_html__( 'Date Color', 'blog-layout-design' ) )
     ->set_width( 14 ),

    Field::make( 'color', 'blog_layout_number_color', esc_html__( 'Item Number Color', 'blog-layout-design' ) )
     ->set_width( 14 ),

    Field::make( 'color', 'blog_layout_bg_color', esc_html__( 'Background Color', 'blog-layout-design' ) )
    ->set_alpha_enabled( true )
    ->set_width( 14 ),

    Field::make( 'color', 'blog_layout_bg_hover_color', esc_html__( 'Background Hover Color', 'blog-layout-design' ) )
    ->set_alpha_enabled( true )
    ->set_width( 14 ),

    Field::make( 'color', 'blog_layout_button_text_color', esc_html__( 'Button Text Color', 'blog-layout-design' ) )
    ->set_alpha_enabled( true )
    ->set_width( 14 ),

    Field::make( 'color', 'blog_layout_button_text_hover_color', esc_html__( 'Button Text Hover Color', 'blog-layout-design' ) )
    ->set_alpha_enabled( true )
    ->set_width( 14 ),

    Field::make( 'color', 'blog_layout_button_bg_color', esc_html__( 'Button Background Color', 'blog-layout-design' ) )
    ->set_alpha_enabled( true )
    ->set_width( 14 ),

    Field::make( 'color', 'blog_layout_button_bg_hover_color', esc_html__( 'Button Background Hover Color', 'blog-layout-design' ) )
    ->set_alpha_enabled( true )
    ->set_width( 14 ),

    Field::make( 'color', 'blog_layout_button_border_color', esc_html__( 'Button Border Color', 'blog-layout-design' ) )
    ->set_alpha_enabled( true )
    ->set_width( 14 ),

    Field::make( 'color', 'blog_layout_button_border_hover_color', esc_html__( 'Button Border Hover Color', 'blog-layout-design' ) )
    ->set_alpha_enabled( true )
    ->set_width( 14 ),

    Field::make( 'color', 'blog_layout_loading_bg', esc_html__( 'Loading Background Item', 'blog-layout-design' ) )
    ->set_alpha_enabled( true )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style_main',
            'value' => 'masonry',
            'compare' => '=',
        ),
    ) )
    ->set_width( 14 ),

    Field::make( 'color', 'blog_layout_overlay_color', esc_html__( 'Slider Overlay Color', 'blog-layout-design' ) )
    ->set_alpha_enabled( true )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style5',
            'value' => 'slider-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style5',
            'value' => 'slider-hiji',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style5',
            'value' => 'slider-dua',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style5',
            'value' => 'slider-tilu',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style5',
            'value' => 'slider-opat',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style5',
            'value' => 'slider-lima',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style5',
            'value' => 'slider-genep',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style5',
            'value' => 'slider-tujuh',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style5',
            'value' => 'slider-dalapan',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style5',
            'value' => 'slider-salapan',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style5',
            'value' => 'slider-sapuluh',
            'compare' => '=',
        )
    ) ),

    Field::make( 'color', 'blog_layout_frame_color', esc_html__( 'Frame Color', 'portfolio-awesome' ) )
    ->set_alpha_enabled( true )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_showcase_style5',
            'value' => 'slider-genep',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style5',
            'value' => 'slider-tujuh',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style5',
            'value' => 'slider-dalapan',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style5',
            'value' => 'slider-salapan',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_design_showcase_style5',
            'value' => 'slider-sapuluh',
            'compare' => '=',
        )
    ) ),

    Field::make( 'separator', 'blog_layout_separator_filter', esc_html__( 'Filter Style', 'blog-layout-design' ) )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_use_filter',
            'value' => 'yes',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'select', 'blog_layout_filter_align', esc_html__( 'Filter Align', 'blog-layout-design' ) )
    ->set_width( 50 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_use_filter',
            'value' => 'yes',
            'compare' => '=',
        ),
    ) )
    ->add_options( array(
       'left' => 'Left',
       'center' => 'Center',
       'right' => 'Right',
    )),

    Field::make( 'number', 'blog_layout_filter_margin_bottom', esc_html__( 'Filter Margin Bottom', 'blog-layout-design' ) )
    ->set_width( 50 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_use_filter',
            'value' => 'yes',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'blog_layout_filter_color', esc_html__( 'Filter Color', 'blog-layout-design' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_use_filter',
            'value' => 'yes',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'blog_layout_filter_hover_color', esc_html__( 'Filter Hover Color', 'blog-layout-design' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_use_filter',
            'value' => 'yes',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'blog_layout_filter_border_color', esc_html__( 'Filter Border Color', 'blog-layout-design' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_use_filter',
            'value' => 'yes',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'blog_layout_filter_mobile_color', esc_html__( 'Filter Mobile Color', 'blog-layout-design' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_use_filter',
            'value' => 'yes',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'blog_layout_filter_mobile_bg_color', esc_html__( 'Filter Mobile Background Color', 'blog-layout-design' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_design_use_filter',
            'value' => 'yes',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'separator', 'blog_layout_separator_pagination', esc_html__( 'Pagination Style', 'blog-layout-design' ) )
     ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_pagination_type',
            'value' => 'pagination_default',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_pagination_type',
            'value' => 'pagination_number',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_pagination_type',
            'value' => 'pagination_load_more',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_pagination_type',
            'value' => 'pagination_infinite',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'select', 'blog_layout_pagination_align', esc_html__( 'Pagination Align', 'blog-layout-design' ) )
    ->set_width( 100 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_pagination_type',
            'value' => 'pagination_default',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_pagination_type',
            'value' => 'pagination_number',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_pagination_type',
            'value' => 'pagination_load_more',
            'compare' => '=',
        ),
        array(
            'field' => 'blog_layout_pagination_type',
            'value' => 'pagination_infinite',
            'compare' => '=',
        ),
    ) )
    ->add_options( array(
       'left' => 'Left',
       'center' => 'Center',
       'right' => 'Right',
    )),

    Field::make( 'color', 'blog_layout_pag_num_color', esc_html__( 'Pagination Number Color', 'blog-layout-design' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_pagination_type',
            'value' => 'pagination_number',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'blog_layout_pag_num_bg_color', esc_html__( 'Pagination Number Background Color', 'blog-layout-design' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_pagination_type',
            'value' => 'pagination_number',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'blog_layout_pag_num_border_color', esc_html__( 'Pagination Number Border Color', 'blog-layout-design' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_pagination_type',
            'value' => 'pagination_number',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'blog_layout_pag_num_current_color', esc_html__( 'Pagination Current Number Color', 'blog-layout-design' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_pagination_type',
            'value' => 'pagination_number',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'blog_layout_pag_num_bg_current_color', esc_html__( 'Pagination Current Number Background Color', 'blog-layout-design' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_pagination_type',
            'value' => 'pagination_number',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'blog_layout_pag_num_border_current_color', esc_html__( 'Pagination Current Number Border Color', 'blog-layout-design' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_pagination_type',
            'value' => 'pagination_number',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'blog_layout_pag_def_color', esc_html__( 'Pagination Default Color', 'blog-layout-design' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_pagination_type',
            'value' => 'pagination_default',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'blog_layout_pag_def_bg_color', esc_html__( 'Pagination Default Background Color', 'blog-layout-design' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_pagination_type',
            'value' => 'pagination_default',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'blog_layout_pag_def_hover_color', esc_html__( 'Pagination Default Hover Color', 'blog-layout-design' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_pagination_type',
            'value' => 'pagination_default',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'blog_layout_pag_def_bg_hover_color', esc_html__( 'Pagination Default Background Hover Color', 'blog-layout-design' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_pagination_type',
            'value' => 'pagination_default',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'blog_layout_pag_load_color', esc_html__( 'Pagination Load More Text Color', 'blog-layout-design' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_pagination_type',
            'value' => 'pagination_load_more',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'blog_layout_pag_load_bg_color', esc_html__( 'Pagination Load More Background Color', 'blog-layout-design' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_pagination_type',
            'value' => 'pagination_load_more',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'blog_layout_pag_load_hover_color', esc_html__( 'Pagination Load More Text Hover Color', 'blog-layout-design' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_pagination_type',
            'value' => 'pagination_load_more',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'blog_layout_pag_load_bg_hover_color', esc_html__( 'Pagination Load More Background Hover Color', 'blog-layout-design' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_pagination_type',
            'value' => 'pagination_load_more',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'separator', 'blog_layout_separator_arrow', esc_html__( 'Arrow Style', 'blog-layout-design' ) )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_use_arrow',
            'value' => true,
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'blog_layout_arrow_color', esc_html__( 'Pagination Arrow Color', 'blog-layout-design' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_use_arrow',
            'value' => true,
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'blog_layout_arrow_hover_color', esc_html__( 'Pagination Arrow Hover Color', 'blog-layout-design' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_use_arrow',
            'value' => true,
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'blog_layout_arrow_bg_color', esc_html__( 'Pagination Background Arrow Color', 'blog-layout-design' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_use_arrow',
            'value' => true,
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'blog_layout_arrow_bg_hover_color', esc_html__( 'Pagination Background Arrow Hover Color', 'blog-layout-design' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_use_arrow',
            'value' => true,
            'compare' => '=',
        ),
    ) ),

    Field::make( 'separator', 'blog_layout_separator_dot', esc_html__('Dot Style', 'blog-layout-design' ) )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_use_pagination',
            'value' => true,
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'blog_layout_dot_border_color', esc_html__( 'Pagination Dot Border Color', 'blog-layout-design' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_use_pagination',
            'value' => true,
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'blog_layout_dot_bg_color', esc_html__( 'Pagination Dot Background Color', 'blog-layout-design' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'blog_layout_use_pagination',
            'value' => true,
            'compare' => '=',
        ),
    ) ),

));