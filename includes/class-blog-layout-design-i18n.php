<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://themesawesome.com/
 * @since      1.0.0
 *
 * @package    Blog_Layout_Awesome
 * @subpackage Blog_Layout_Awesome/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Blog_Layout_Awesome
 * @subpackage Blog_Layout_Awesome/includes
 * @author     Themes Awesome <admin@themesawesome>
 */
class Blog_Layout_Awesome_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'blog-layout-design',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
