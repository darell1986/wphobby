<?php

if (!function_exists('suevafree_customize_panel_function')) {

	function suevafree_customize_panel_function() {
		
		$theme_panel = array ( 

			array(
				
				"label" => esc_html__( "Full Image Background","suevafree"),
				"description" => esc_html__( "Do you want to set a full background image? (After the upload, check 'Fixed', from the Background Attachment section)","suevafree"),
				"id" => "suevafree_full_image_background",
				"type" => "select",
				"section" => "background_image",
				"options" => array (
				   "off" => esc_html__( "No","suevafree"),
				   "on" => esc_html__( "Yes","suevafree"),
				),
				
				"std" => "off",
			
			),

			/* START SUPPORT SECTION */ 

			array(
			
				"title" => esc_html__( "Get support","suevafree"),
				"id" => "suevafree-customize-info",
				"type" => "suevafree-customize-info",
				"section" => "suevafree-customize-info",
				"priority" => "08",

			),

			/* START GENERAL SECTION */ 

			array( 
				
				"title" => esc_html__( "General","suevafree"),
				"description" => esc_html__( "General","suevafree"),
				"type" => "panel",
				"id" => "general_panel",
				"priority" => "10",
				
			),

			/* SKINS */ 

			array( 

				"title" => esc_html__( "Color Scheme","suevafree"),
				"type" => "section",
				"panel" => "general_panel",
				"priority" => "10",
				"id" => "colorscheme_section",

			),

			array(
				
				"label" => esc_html__( "Predefined Color Schemes","suevafree"),
				"description" => esc_html__( "Choose your Color Scheme","suevafree"),
				"id" => "suevafree_skin",
				"type" => "select",
				"section" => "colorscheme_section",
				"options" => array (
				   "cyan" => esc_html__( "Cyan","suevafree"),
				   "orange" => esc_html__( "Orange","suevafree"),
				   "blue" => esc_html__( "Blue","suevafree"),
				   "red" => esc_html__( "Red","suevafree"),
				   "pink" => esc_html__( "Pink","suevafree"),
				   "purple" => esc_html__( "Purple","suevafree"),
				   "yellow" => esc_html__( "Yellow","suevafree"),
				   "green" => esc_html__( "Green","suevafree"),
				   "black" => esc_html__( "Black","suevafree"),
				),
				
				"std" => "orange",
			
			),

			/* PAGE WIDTH */ 

			array( 

				"title" => esc_html__( "Page width",'suevafree'),
				"type" => "section",
				"id" => "pagewidth_section",
				"panel" => "general_panel",
				"priority" => "11",

			),

			array( 

				"label" => esc_html__( "Screen greater than 768px",'suevafree'),
				"description" => esc_html__( "Set a width, for a screen greater than 768 pixel (for example 750 and not 750px ) ",'suevafree'),
				"id" => "suevafree_screen1",
				"type" => "text",
				"section" => "pagewidth_section",
				"std" => "750",

			),

			array( 

				"label" => esc_html__( "Screen greater than 992px",'suevafree'),
				"description" => esc_html__( "Set a width, for a screen greater than 992 pixel (for example 940 and not 940px ) ",'suevafree'),
				"id" => "suevafree_screen2",
				"type" => "text",
				"section" => "pagewidth_section",
				"std" => "940",

			),

			array( 

				"label" => esc_html__( "Screen greater than 1200px",'suevafree'),
				"description" => esc_html__( "Set a width, in px, for a screen greater than 1200 pixel (for example 1170 and not 1170px ) ",'suevafree'),
				"id" => "suevafree_screen3",
				"type" => "text",
				"section" => "pagewidth_section",
				"std" => "940",

			),

			array( 

				"label" => esc_html__( "Screen greater than 1400px",'suevafree'),
				"description" => esc_html__( "Set a width, in px, for a screen greater than 1400px pixel (for example 1370 and not 1370px ) ",'suevafree'),
				"id" => "suevafree_screen4",
				"type" => "text",
				"section" => "pagewidth_section",
				"std" => "940",

			),

			/* SETTINGS SECTION */ 

			array( 

				"title" => esc_html__( "Settings","suevafree"),
				"type" => "section",
				"id" => "settings_section",
				"panel" => "general_panel",
				"priority" => "12",

			),

			array(
				
				"label" => esc_html__( "Nicescroll plugin","suevafree"),
				"description" => esc_html__( "Do you want to use this plugin to manage the page scroll?","suevafree"),
				"id" => "suevafree_nicescroll",
				"type" => "select",
				"section" => "settings_section",
				"options" => array (
				   "off" => esc_html__( "No","suevafree"),
				   "on" => esc_html__( "Yes","suevafree"),
				),
				
				"std" => "off",
			
			),

			array(
				
				"label" => esc_html__( "Category title","suevafree"),
				"description" => esc_html__( "Do you want to view the category title, under the black container?","suevafree"),
				"id" => "suevafree_view_category_title",
				"type" => "select",
				"section" => "settings_section",
				"options" => array (
				   "off" => esc_html__( "No","suevafree"),
				   "on" => esc_html__( "Yes","suevafree"),
				),
				
				"std" => "on",
			
			),

			array(
				
				"label" => esc_html__( "Box Shadow","suevafree"),
				"description" => esc_html__( "Do you want to disable the shadow of boxes?","suevafree"),
				"id" => "suevafree_disable_box_shadow",
				"type" => "select",
				"section" => "settings_section",
				"options" => array (
				   "off" => esc_html__( "No","suevafree"),
				   "on" => esc_html__( "Yes","suevafree"),
				),
				
				"std" => "off",
			
			),

			array(
				
				"label" => esc_html__( "Searched item","suevafree"),
				"description" => esc_html__( "Do you want to view the searched item, under the black container?","suevafree"),
				"id" => "suevafree_view_searched_item",
				"type" => "select",
				"section" => "settings_section",
				"options" => array (
				   "off" => esc_html__( "No","suevafree"),
				   "on" => esc_html__( "Yes","suevafree"),
				),
				
				"std" => "on",
			
			),

			array(
				
				"label" => esc_html__( "Featured image triangle","suevafree"),
				"description" => esc_html__( "Do you want to disable the effect of featured image, at hover?","suevafree"),
				"id" => "suevafree_thumb_triangle",
				"type" => "select",
				"section" => "settings_section",
				"options" => array (
				   "off" => esc_html__( "No","suevafree"),
				   "on" => esc_html__( "Yes","suevafree"),
				),
				
				"std" => "off",
			
			),

			array(
				
				"label" => esc_html__( "Featured image rotate, at hover","suevafree"),
				"description" => esc_html__( "Do you want to disable the effect of featured image, at hover?","suevafree"),
				"id" => "suevafree_thumb_hover",
				"type" => "select",
				"section" => "settings_section",
				"options" => array (
				   "off" => esc_html__( "No","suevafree"),
				   "on" => esc_html__( "Yes","suevafree"),
				),
				
				"std" => "off",
			
			),

			array(
				
				"label" => esc_html__( "Comments","suevafree"),
				"description" => esc_html__( "Do you want to view the comments after articles?","suevafree"),
				"id" => "suevafree_view_comments",
				"type" => "select",
				"section" => "settings_section",
				"options" => array (
				   "off" => esc_html__( "No","suevafree"),
				   "on" => esc_html__( "Yes","suevafree"),
				),
				
				"std" => "on",
			
			),

			array(
				
				"label" => esc_html__( "Footer","suevafree"),
				"description" => esc_html__( "Do you want to display the footer, including the widgets under the bottom sidebar area?","suevafree"),
				"id" => "suevafree_view_footer",
				"type" => "select",
				"section" => "settings_section",
				"options" => array (
				   "off" => esc_html__( "No","suevafree"),
				   "on" => esc_html__( "Yes","suevafree"),
				),
				
				"std" => "on",
			
			),

			array(
				
				"label" => esc_html__("Post Format","suevafree"),
				"description" => esc_html__("Do you want to use a different layout for the Aside, Link and Quote posts?.","suevafree"),
				"id" => "suevafree_post_format_layout",
				"type" => "select",
				"section" => "settings_section",
				"options" => array (
				   "off" => esc_html__( "No","suevafree"),
				   "on" => esc_html__( "Yes","suevafree"),
				),
				
				"std" => "off",
			
			),
			array(
				
				"label" => esc_html__( "Read more","suevafree"),
				"description" => esc_html__( "Do you want to display the read more button?","suevafree"),
				"id" => "suevafree_view_readmore",
				"type" => "select",
				"section" => "settings_section",
				"options" => array (
				   "off" => esc_html__( "No","suevafree"),
				   "on" => esc_html__( "Yes","suevafree"),
				),
				
				"std" => "on",
			
			),

			array(
				
				"label" => esc_html__( "Author","suevafree"),
				"description" => esc_html__( "Do you want to view the author?","suevafree"),
				"id" => "suevafree_view_author",
				"type" => "select",
				"section" => "settings_section",
				"options" => array (
				   "off" => esc_html__( "No","suevafree"),
				   "on" => esc_html__( "Yes","suevafree"),
				),
				
				"std" => "off",
			
			),
			
			array(
				
				"label" => esc_html__( "Back to top button.","suevafree"),
				"description" => esc_html__( "Do you want to display a button to back on the top of the site?","suevafree"),
				"id" => "suevafree_view_back_to_top",
				"type" => "select",
				"section" => "settings_section",
				"options" => array (
				   "off" => esc_html__( "No","suevafree"),
				   "on" => esc_html__( "Yes","suevafree"),
				),
				
				"std" => "on",
			
			),

			/* CUSTOM CSS */ 

			array( 

				"title" => esc_html__( "Styles","suevafree"),
				"type" => "section",
				"id" => "styles_section",
				"panel" => "general_panel",
				"priority" => "13",

			),

			array( 

				"label" => esc_html__( "Custom css","suevafree"),
				"description" => esc_html__( "Insert your custom css code.","suevafree"),
				"id" => "suevafree_custom_css_code",
				"type" => "textarea",
				"section" => "styles_section",
				"std" => "",

			),

			/* LAYOUTS SECTION */ 

			array( 

				"title" => esc_html__( "Layouts","suevafree"),
				"type" => "section",
				"id" => "layouts_section",
				"panel" => "general_panel",
				"priority" => "14",

			),

			array(
				
				"label" => esc_html__("Main Layout","suevafree"),
				"description" => esc_html__("Choose a layout for your site.","suevafree"),
				"id" => "suevafree_body_layout",
				"type" => "select",
				"section" => "layouts_section",
				"options" => array (
				   "default" => esc_html__( "Default","suevafree"),
				   "minimal" => esc_html__( "Minimal Layout","suevafree"),
				),
				
				"std" => "default",
			
			),
	
			array(
				
				"label" => esc_html__("Home Blog Layout","suevafree"),
				"description" => esc_html__("If you've set the latest articles, for the homepage, choose a layout.","suevafree"),
				"id" => "suevafree_home",
				"type" => "select",
				"section" => "layouts_section",
				"options" => array (
				   "full" => esc_html__( "Full Width","suevafree"),
				   "left-sidebar" => esc_html__( "Left Sidebar","suevafree"),
				   "right-sidebar" => esc_html__( "Right Sidebar","suevafree"),
				   "masonry" => esc_html__( "Masonry","suevafree"),
				),
				
				"std" => "masonry",
			
			),
	

			array(
				
				"label" => esc_html__("Category Layout","suevafree"),
				"description" => esc_html__("Select a layout for category pages.","suevafree"),
				"id" => "suevafree_category_layout",
				"type" => "select",
				"section" => "layouts_section",
				"options" => array (
				   "full" => esc_html__( "Full Width","suevafree"),
				   "left-sidebar" => esc_html__( "Left Sidebar","suevafree"),
				   "right-sidebar" => esc_html__( "Right Sidebar","suevafree"),
				   "masonry" => esc_html__( "Masonry","suevafree"),
				),
				
				"std" => "masonry",
			
			),

			array(
				
				"label" => esc_html__("Search Layout","suevafree"),
				"description" => esc_html__("Select a layout for the search section.","suevafree"),
				"id" => "suevafree_search_layout",
				"type" => "select",
				"section" => "layouts_section",
				"options" => array (
				   "full" => esc_html__( "Full Width","suevafree"),
				   "left-sidebar" => esc_html__( "Left Sidebar","suevafree"),
				   "right-sidebar" => esc_html__( "Right Sidebar","suevafree"),
				   "masonry" => esc_html__( "Masonry","suevafree"),
				),
				
				"std" => "masonry",
			
			),

			array(
				
				"label" => esc_html__("WooCommerce Category Layout","suevafree"),
				"description" => esc_html__("Select a layout for the woocommerce categories.","suevafree"),
				"id" => "suevafree_woocommerce_category_layout",
				"type" => "select",
				"section" => "layouts_section",
				"options" => array (
				   "full" => esc_html__( "Full Width","suevafree"),
				   "left-sidebar" => esc_html__( "Left Sidebar","suevafree"),
				   "right-sidebar" => esc_html__( "Right Sidebar","suevafree"),
				),
				
				"std" => "right-sidebar",
			
			),

			array(
				
				"label" => esc_html__("Header Layout","suevafree"),
				"description" => esc_html__("Choose a layout for the header.","suevafree"),
				"id" => "suevafree_header_layout",
				"type" => "select",
				"section" => "layouts_section",
				"options" => array (
					'header_layout_1' => esc_html__( 'Layout 1', 'suevafree'),
					'header_layout_2' => esc_html__( 'Layout 2', 'suevafree'),
					'header_layout_3' => esc_html__( 'Layout 3', 'suevafree'),
					'header_layout_4' => esc_html__( 'Layout 4', 'suevafree'),
					'header_layout_5' => esc_html__( 'Layout 5', 'suevafree'),
				),
				
				"std" => "header_layout_1",
			
			),

			array(
				
				"label" => esc_html__("Footer Layout","suevafree"),
				"description" => esc_html__("Choose a layout for the footer.","suevafree"),
				"id" => "suevafree_footer_layout",
				"type" => "select",
				"section" => "layouts_section",
				"options" => array (
					'' => esc_html__( 'Layout 1', 'suevafree'),
					'footer_layout_2' => esc_html__( 'Layout 2', 'suevafree'),
				),
				
				"std" => "",
			
			),

			array(
				
				"label" => esc_html__("Menu Layout","suevafree"),
				"description" => esc_html__("Choose a menu layout for only the header 1, header 2 and the header 3.","suevafree"),
				"id" => "suevafree_menu_layout",
				"type" => "select",
				"section" => "layouts_section",
				"options" => array (
					'' => esc_html__( 'Menu 1', 'suevafree'),
					'menubar' => esc_html__( 'Menu 2', 'suevafree'),
				),
				
				"std" => "",
			
			),

			array(
				
				"label" => esc_html__("Sidebar Layout","suevafree"),
				"description" => esc_html__("Select a layout for the side sidebars.","suevafree"),
				"id" => "suevafree_sidebar_layout",
				"type" => "select",
				"section" => "layouts_section",
				"options" => array (
					'default' => esc_html__( 'Default sidebar.', 'suevafree'),
					'sneak' => esc_html__( 'Sneak sidebar.', 'suevafree'),
				),
				
				"std" => "default",
			
			),

			array(
				
				"label" => esc_html__("Post Layout","suevafree"),
				"description" => esc_html__("Select a layout for the details of each post.","suevafree"),
				"id" => "suevafree_post_details_layout",
				"type" => "select",
				"section" => "layouts_section",
				"options" => array (
					'suevafree_before_content_3' => esc_html__( 'None.', 'suevafree'),
					'suevafree_before_content_1' => esc_html__( 'Layout 1.', 'suevafree'),
					'suevafree_before_content_2' => esc_html__( 'Layout 2.', 'suevafree'),
				),
				
				"std" => "suevafree_before_content_1",
			
			),

			array(
				
				"label" => esc_html__("Read More Layout","suevafree"),
				"description" => esc_html__("Select a layout for the read more button.","suevafree"),
				"id" => "suevafree_readmore_layout",
				"type" => "select",
				"section" => "layouts_section",
				"options" => array (
					'default' => esc_html__( 'Default Button','suevafree'),
					'nobutton' => esc_html__( 'Replace with => [...]','suevafree'),
				),
				
				"std" => "default",
			
			),

			array(
				
				"label" => esc_html__("Page Layout","suevafree"),
				"description" => esc_html__("Select a layout for the details of each page.","suevafree"),
				"id" => "suevafree_page_details_layout",
				"type" => "select",
				"section" => "layouts_section",
				"options" => array (
					'suevafree_before_content_3' => esc_html__( 'None', 'suevafree'),
					'suevafree_before_content_4' => esc_html__( 'Default.', 'suevafree'),
				),
				
				"std" => "suevafree_before_content_4",
			
			),

			/* THUMBNAILS SECTION */ 

			array( 

				"title" => esc_html__( "Thumbnails","suevafree"),
				"type" => "section",
				"id" => "thumbnails_section",
				"panel" => "general_panel",
				"priority" => "15",

			),

			array( 

				"label" => esc_html__( "Blog Thumbnail","suevafree"),
				"description" => esc_html__( "Insert the height for blog thumbnail (Use a plugin like Regenerate Thumbnails, to regenerate each thumbnail)","suevafree"),
				"id" => "suevafree_blog_thumbinal",
				"type" => "text",
				"section" => "thumbnails_section",
				"std" => "429",

			),


			/* HEADER AREA SECTION */ 

			array( 

				"title" => esc_html__( "Header","suevafree"),
				"type" => "section",
				"id" => "header_section",
				"panel" => "general_panel",
				"priority" => "16",

			),

			array( 

				"label" => esc_html__( "Custom Logo","suevafree"),
				"description" => esc_html__( "Insert the url of your custom logo","suevafree"),
				"id" => "suevafree_custom_logo",
				"type" => "upload",
				"section" => "header_section",
				"std" => "",

			),

			/* FOOTER AREA SECTION */ 

			array( 

				"title" => esc_html__( "Footer","suevafree"),
				"type" => "section",
				"id" => "footer_section",
				"panel" => "general_panel",
				"priority" => "17",

			),

			array( 

				"label" => esc_html__( "Copyright Text","suevafree"),
				"description" => esc_html__( "Insert your copyright text.","suevafree"),
				"id" => "suevafree_copyright_text",
				"type" => "textarea",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => esc_html__( "Facebook Url","suevafree"),
				"description" => esc_html__( "Insert Facebook Url (leave empty if you want to hide the button)","suevafree"),
				"id" => "suevafree_footer_facebook_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => esc_html__( "Twitter Url","suevafree"),
				"description" => esc_html__( "Insert Twitter Url (leave empty if you want to hide the button)","suevafree"),
				"id" => "suevafree_footer_twitter_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => esc_html__( "Flickr Url","suevafree"),
				"description" => esc_html__( "Insert Flickr Url (leave empty if you want to hide the button)","suevafree"),
				"id" => "suevafree_footer_flickr_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => esc_html__( "Google Url","suevafree"),
				"description" => esc_html__( "Insert Google Url (leave empty if you want to hide the button)","suevafree"),
				"id" => "suevafree_footer_google_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => esc_html__( "Linkedin Url","suevafree"),
				"description" => esc_html__( "Insert Linkedin Url (leave empty if you want to hide the button)","suevafree"),
				"id" => "suevafree_footer_linkedin_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => esc_html__( "Slack Url","suevafree"),
				"description" => esc_html__( "Insert Slack Url (leave empty if you want to hide the button)","suevafree"),
				"id" => "suevafree_footer_slack_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => esc_html__( "Myspace Url","suevafree"),
				"description" => esc_html__( "Insert Myspace Url (leave empty if you want to hide the button)","suevafree"),
				"id" => "suevafree_footer_myspace_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => esc_html__( "Pinterest Url","suevafree"),
				"description" => esc_html__( "Insert Pinterest Url (leave empty if you want to hide the button)","suevafree"),
				"id" => "suevafree_footer_pinterest_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => esc_html__( "Tumblr Url","suevafree"),
				"description" => esc_html__( "Insert Tumblr Url (leave empty if you want to hide the button)","suevafree"),
				"id" => "suevafree_footer_tumblr_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => esc_html__( "Soundcloud Url","suevafree"),
				"description" => esc_html__( "Insert Soundcloud Url (leave empty if you want to hide the button)","suevafree"),
				"id" => "suevafree_footer_soundcloud_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => esc_html__( "Spotify Url","suevafree"),
				"description" => esc_html__( "Insert Spotify Url (leave empty if you want to hide the button)","suevafree"),
				"id" => "suevafree_footer_spotify_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => esc_html__( "Youtube Url","suevafree"),
				"description" => esc_html__( "Insert Youtube Url (leave empty if you want to hide the button)","suevafree"),
				"id" => "suevafree_footer_youtube_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => esc_html__( "Vimeo Url","suevafree"),
				"description" => esc_html__( "Insert Vimeo Url (leave empty if you want to hide the button)","suevafree"),
				"id" => "suevafree_footer_vimeo_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => esc_html__( "VK Url","suevafree"),
				"description" => esc_html__( "Insert VK Url (leave empty if you want to hide the button)","suevafree"),
				"id" => "suevafree_footer_vk_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => esc_html__( "Instagram Url","suevafree"),
				"description" => esc_html__( "Insert Instagram Url (leave empty if you want to hide the button)","suevafree"),
				"id" => "suevafree_footer_instagram_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => esc_html__( "Deviantart Url","suevafree"),
				"description" => esc_html__( "Insert Deviantart Url (leave empty if you want to hide the button)","suevafree"),
				"id" => "suevafree_footer_deviantart_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => esc_html__( "Github Url","suevafree"),
				"description" => esc_html__( "Insert Github Url (leave empty if you want to hide the button)","suevafree"),
				"id" => "suevafree_footer_github_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => esc_html__( "Xing Url","suevafree"),
				"description" => esc_html__( "Insert Xing Url (leave empty if you want to hide the button)","suevafree"),
				"id" => "suevafree_footer_xing_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),
			
			array( 

				"label" => esc_html__( "Dribbble Url","suevafree"),
				"description" => esc_html__( "Insert Dribbble Url (leave empty if you want to hide the button)","suevafree"),
				"id" => "suevafree_footer_dribbble_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),
			
			array( 

				"label" => esc_html__( "Dropbox Url","suevafree"),
				"description" => esc_html__( "Insert Dropbox Url (leave empty if you want to hide the button)","suevafree"),
				"id" => "suevafree_footer_dropbox_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),
			
			array( 

				"label" => esc_html__( "Whatsapp Number","suevafree"),
				"description" => esc_html__( "Insert Whatsapp number (leave empty if you want to hide the button)","suevafree"),
				"id" => "suevafree_footer_whatsapp_button",
				"type" => "button",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => esc_html__( "Skype Url","suevafree"),
				"description" => esc_html__( "Insert Skype ID (leave empty if you want to hide the button)","suevafree"),
				"id" => "suevafree_footer_skype_button",
				"type" => "button",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => esc_html__( "Email Address","suevafree"),
				"description" => esc_html__( "Insert Email Address (leave empty if you want to hide the button)","suevafree"),
				"id" => "suevafree_footer_email_button",
				"type" => "button",
				"section" => "footer_section",
				"std" => "",

			),

			array(
				
				"label" => esc_html__( "Feed Rss Button","suevafree"),
				"description" => esc_html__( "Do you want to display the Feed Rss button?","suevafree"),
				"id" => "suevafree_footer_rss_button",
				"type" => "select",
				"section" => "footer_section",
				"options" => array (
				   "off" => esc_html__( "No","suevafree"),
				   "on" => esc_html__( "Yes","suevafree"),
				),
				
				"std" => "off",
			
			),

			/* TYPOGRAPHY SECTION */ 

			array( 
				
				"title" => esc_html__( "Typography","suevafree"),
				"description" => esc_html__( "Typography","suevafree"),
				"type" => "panel",
				"id" => "typography_panel",
				"priority" => "11",
				
			),

			/* LOGO */ 

			array( 

				"title" => esc_html__( "Logo","suevafree"),
				"type" => "section",
				"id" => "logo_section",
				"panel" => "typography_panel",
				"priority" => "10",

			),

			array( 

				"label" => esc_html__( "Font size","suevafree"),
				"description" => esc_html__( "Insert a size, for logo font (For example, 60px) ","suevafree"),
				"id" => "suevafree_logo_font_size",
				"type" => "text",
				"section" => "logo_section",
				"std" => "70px",

			),
			
			array( 

				"label" => esc_html__( "Description font size","suevafree"),
				"description" => esc_html__( "Insert a size, for logo description (For example, 14px) ","suevafree"),
				"id" => "suevafree_logo_description_font_size",
				"type" => "text",
				"section" => "logo_section",
				"std" => "14px",

			),

			array( 

				"label" => esc_html__( "Description top margin","suevafree"),
				"description" => esc_html__( "Add a space between the logo and the description (For example, 15px) ","suevafree"),
				"id" => "suevafree_logo_description_top_margin",
				"type" => "text",
				"section" => "logo_section",
				"std" => "15px",

			),

			/* MENU */ 

			array( 

				"title" => esc_html__( "Menu","suevafree"),
				"type" => "section",
				"id" => "menu_section",
				"panel" => "typography_panel",
				"priority" => "11",

			),

			array( 

				"label" => esc_html__( "Font size","suevafree"),
				"description" => esc_html__( "Insert a size, for menu font (For example, 14px) ","suevafree"),
				"id" => "suevafree_menu_font_size",
				"type" => "text",
				"section" => "menu_section",
				"std" => "14px",

			),

			array(
				
				"label" => esc_html__("Menu weight","suevafree"),
				"description" => esc_html__("Choose a font weight for the menu.","suevafree"),
				"id" => "suevafree_menu_font_weight",
				"type" => "select",
				"section" => "menu_section",
				"options" => array(
					"400" => esc_html__( "400","suevafree"),
					"500" => esc_html__( "500","suevafree"),
					"600" => esc_html__( "600","suevafree"),
					"700" => esc_html__( "700","suevafree"),
					"800" => esc_html__( "800","suevafree"),
				),

				"std" => "500",
			
			),
			
			array(
				
				"label" => esc_html__("Text transform","suevafree"),
				"description" => esc_html__("Do you want to display an uppercase menu?.","suevafree"),
				"id" => "suevafree_menu_text_transform",
				"type" => "select",
				"section" => "menu_section",
				"options" => array(
					"none" => esc_html__( "None","suevafree"),
					"uppercase" => esc_html__( "Uppercase","suevafree"),
				),

				"std" => "uppercase",
			
			),
			
			/* CONTENT */ 

			array( 

				"title" => esc_html__( "Content","suevafree"),
				"type" => "section",
				"id" => "content_section",
				"panel" => "typography_panel",
				"priority" => "12",

			),

			array( 

				"label" => esc_html__( "Font size","suevafree"),
				"description" => esc_html__( "Insert a size, for content font (For example, 14px) ","suevafree"),
				"id" => "suevafree_content_font_size",
				"type" => "text",
				"section" => "content_section",
				"std" => "14px",

			),


			/* HEADLINES */ 

			array( 

				"title" => esc_html__( "Headlines","suevafree"),
				"type" => "section",
				"id" => "headlines_section",
				"panel" => "typography_panel",
				"priority" => "13",

			),

			array( 

				"label" => esc_html__( "H1 headline","suevafree"),
				"description" => esc_html__( "Insert a size, for for H1 elements (For example, 24px) ","suevafree"),
				"id" => "suevafree_h1_font_size",
				"type" => "text",
				"section" => "headlines_section",
				"std" => "24px",

			),

			array( 

				"label" => esc_html__( "H2 headline","suevafree"),
				"description" => esc_html__( "Insert a size, for for H2 elements (For example, 22px) ","suevafree"),
				"id" => "suevafree_h2_font_size",
				"type" => "text",
				"section" => "headlines_section",
				"std" => "22px",

			),

			array( 

				"label" => esc_html__( "H3 headline","suevafree"),
				"description" => esc_html__( "Insert a size, for for H3 elements (For example, 20px) ","suevafree"),
				"id" => "suevafree_h3_font_size",
				"type" => "text",
				"section" => "headlines_section",
				"std" => "20px",

			),

			array( 

				"label" => esc_html__( "H4 headline","suevafree"),
				"description" => esc_html__( "Insert a size, for for H4 elements (For example, 18px) ","suevafree"),
				"id" => "suevafree_h4_font_size",
				"type" => "text",
				"section" => "headlines_section",
				"std" => "18px",

			),

			array( 

				"label" => esc_html__( "H5 headline","suevafree"),
				"description" => esc_html__( "Insert a size, for for H5 elements (For example, 16px) ","suevafree"),
				"id" => "suevafree_h5_font_size",
				"type" => "text",
				"section" => "headlines_section",
				"std" => "16px",

			),

			array( 

				"label" => esc_html__( "H6 headline","suevafree"),
				"description" => esc_html__( "Insert a size, for for H6 elements (For example, 14px) ","suevafree"),
				"id" => "suevafree_h6_font_size",
				"type" => "text",
				"section" => "headlines_section",
				"std" => "14px",

			),
			
			array(
				
				"label" => esc_html__("Titles weight","suevafree"),
				"description" => esc_html__("Choose a font weight for the titles.","suevafree"),
				"id" => "suevafree_titles_font_weight",
				"type" => "select",
				"section" => "headlines_section",
				"options" => array(
					"400" => esc_html__( "400","suevafree"),
					"500" => esc_html__( "500","suevafree"),
					"600" => esc_html__( "600","suevafree"),
					"700" => esc_html__( "700","suevafree"),
					"800" => esc_html__( "800","suevafree"),
				),

				"std" => "400",
			
			),
			
			array(
				
				"label" => esc_html__("Text transform","suevafree"),
				"description" => esc_html__("Do you want to display an uppercase title?.","suevafree"),
				"id" => "suevafree_titles_text_transform",
				"type" => "select",
				"section" => "headlines_section",
				"options" => array(
					"none" => esc_html__( "None","suevafree"),
					"uppercase" => esc_html__( "Uppercase","suevafree"),
				),

				"std" => "none",
			
			),

		);
		
		new suevafree_customize($theme_panel);
		
	} 
	
	add_action( 'suevafree_customize_panel', 'suevafree_customize_panel_function', 10, 2 );

}

do_action('suevafree_customize_panel');

?>