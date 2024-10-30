<?php
namespace Elementor;

function blog_layout_design_general_elementor_init(){
	Plugin::instance()->elements_manager->add_category(
		'blog_layout_design-general-category',
		[
			'title'  => 'Blog Layout Design',
			'icon' => 'font'
		],
		1
	);
}
add_action('elementor/init','Elementor\blog_layout_design_general_elementor_init');
