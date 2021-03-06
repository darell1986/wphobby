<?php

/**
 * Wp in Progress
 * 
 * @package Wordpress
 * @author WPinProgress
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * It is also available at this URL: http://www.gnu.org/licenses/gpl-3.0.txt
 */

$sueva_cptype = new suevafree_cpt(

	'team',
	
	array(

		"add_new" => esc_html__("Add new","suevafree-essential-kit"),
		"add_new_item" => esc_html__("Add new team item","suevafree-essential-kit"),
		"edit_item" => esc_html__("Edit team item","suevafree-essential-kit"),
		"menu_name" => esc_html__("Team","suevafree-essential-kit"),
		"name_admin_bar" => esc_html__("Team item","suevafree-essential-kit"),
		"new_item" => esc_html__("New team item","suevafree-essential-kit"),
		"view_item" => esc_html__("View team","suevafree-essential-kit"),
		"search_items" => esc_html__("Search team item","suevafree-essential-kit"),
		"not_found" => esc_html__("Item not found","suevafree-essential-kit"),
		"not_found_in_trash" => esc_html__("Item not found in trash","suevafree-essential-kit"),
	
	),
	
	array(
		'editor',
		'title',
		'thumbnail'
	)

);

?>