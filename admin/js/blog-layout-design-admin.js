(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	
	$(document).ready(function() {
		var getPostID = $('#post_ID').val();

		$('#shortcode_blog_layout_to_copy').html('[blog_layout_design id="'+getPostID+'"]');

		$('li a[href*="post-new.php?post_type=blog-layout-design"]').css('display', 'none');
	});

	if ($('.select-image-layout').length) {
		$('input:radio[name="carbon_fields_compact_input[_blog_layout_design_showcase_style_main]"]').change(
	    function(){
	        if ($(this).is(':checked')) {
	            alert($(this).val());
	        }
	    });
	}

})( jQuery );
