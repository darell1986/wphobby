<?php
if (!function_exists('essb_rs_js_build_generate_more_button_inline')) {

	add_filter('essb_js_buffer_footer', 'essb_rs_js_build_generate_more_button_inline');
	
	function essb_rs_js_build_generate_more_button_inline($buffer) {
		
		
		$output = "";
		
		$output .= 'var is_morebutton_clicked = false;';
		$output .= 'jQuery(document).ready(function($){
		jQuery.fn.essb_toggle_more = function(){
		return this.each(function(){
		$single = $(this);
		
		$single.removeClass(\'essb_after_more\');
		$single.addClass(\'essb_before_less\');
		});
		};
		jQuery.fn.essb_toggle_less = function(){
		return this.each(function(){
		$single = $(this);
		
		$single.addClass(\'essb_after_more\');
		$single.removeClass(\'essb_before_less\');
		});
		};
		});
		function essb_toggle_more(unique_id) {
		if (is_morebutton_clicked) { essb_toggle_less(unique_id); return; }
		jQuery(\'.essb_\'+unique_id+\' .essb_after_more\').essb_toggle_more();
		$more_button = jQuery(\'.essb_\'+unique_id).find(\'.essb_link_more\');
		if (typeof($more_button) != "undefined") {
		$more_button.hide();
		$more_button.addClass(\'essb_hide_more_sidebar\');
		}
		$more_button = jQuery(\'.essb_\'+unique_id).find(\'.essb_link_more_dots\');
		if (typeof($more_button) != "undefined") {
		$more_button.hide();
		$more_button.addClass(\'essb_hide_more_sidebar\');
		is_morebutton_clicked = true;
		}
		
		
		};
		
		function essb_toggle_less(unique_id) {
		is_morebutton_clicked = false;
		jQuery(\'.essb_\'+unique_id+\' .essb_before_less\').essb_toggle_less();
		$more_button = jQuery(\'.essb_\'+unique_id).find(\'.essb_link_more\');
		if (typeof($more_button) != "undefined") {
		$more_button.show();
		$more_button.removeClass(\'essb_hide_more_sidebar\');
		};
		$more_button = jQuery(\'.essb_\'+unique_id).find(\'.essb_link_more_dots\');
		if (typeof($more_button) != "undefined") {
		$more_button.show();
		$more_button.removeClass(\'essb_hide_more_sidebar\');
		};
		};';
		
		$output = trim(preg_replace('/\s+/', ' ', $output));
		return $buffer.$output;
	}
}