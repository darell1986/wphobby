<?php 

	get_header();
	
	do_action('suevafree_top_sidebar', 'home-top-sidebar-area');
	do_action('suevafree_header_sidebar', 'home-header-sidebar-area');

		
    get_template_part('layouts/home', 'default');
			


	do_action('suevafree_full_sidebar', 'full-sidebar-area');

	get_footer(); 
	
?>