<?php

$current_list = array ();

if (class_exists ( 'ESSBAddonsHelper' )) {
	
	$essb_addons = ESSBAddonsHelper::get_instance ();
	$essb_addons->call_remove_addon_list_update ();
	
	$current_list = $essb_addons->get_addons ();
}
// print_r($current_list);

?>

<style type="text/css">
.essb-column-compatibility { width: 100% !important; float: none !important; text-align: left !important; font-size: 12px;  }
.essb-column-downloaded { width: 100% !important; max-width: 100% !important; text-align: right; }
.essb-addon-price { font-size: 15px; margin-bottom: 5px; }
.essb-addon-price b { font-weight: 800; }
.plugin-card-top { padding: 10px 20px 10px; }
.plugin-card-top h4 { font-size: 16px; font-weight: 700; margin-top: 5px; margin-bottom: 10px;}
.plugin-card { width: 400px; }
.essb-column-compatibility { width: 100%; }
.essb-column-compatibility .button { margin-right: 5px; }
.essb-column-compatibility .button-no-margin { margin-right: 0px !important; }
.plugin-card-top h4 { height: 35px; }
.plugin-card-top p.essb-description { min-height: 80px; }
.plugin-card:nth-child(3n+1) { clear: none !important; margin-left: 8px; }
.plugin-card:nth-child(3n) { margin-right: 8px; }
.essb-free { background-color: #27AE60; color: #fff; margin-right: 5px; border-radius: 4px; padding: 2px 6px; font-size: 11px; }
.essb-addon-tag {
	color: #fff;
	margin-right: 5px; border-radius: 4px; padding: 2px 6px; font-size: 11px;
	text-transform: uppercase; 
	font-weight: bold;
}

.essb-addon-unique {
	background-color:#D8335B;
}

.essb-addon-new {
	background-color: #2C82C9;
}

.essb-addon-popular {
	background-color: #00B5B5;
}
.essb-addon-updated {
	background-color: #FD5B03;
}
.essb-options-hint-addonhint {
	background-color: #fff !important;
}

.essb-options-hint-addonhint i {
	font-size: 28px !important;
	margin-right: 10px;
}

.essb-options-hint-addonhint a { font-weight: bold; }
</style>

<div class="wrap">

	<div class="essb-tabs" style="margin-bottom: 20px;">
		<div class="essb-tabs-title" style="padding-top: 15px; padding-bottom: 20px;">
			<div class="essb-tabs-version">
				<div class="essb-logo essb-logo32"></div>
				<div class="essb-text-afterlogo">
					<h3>Extensions for Easy Social Share Buttons for WordPress</h3>
					<p>
						Version <strong><?php echo ESSB3_VERSION;?></strong>. &nbsp;<strong><a
							href="http://socialsharingplugin.com/version-changes/" target="_blank">See
								what's new in this version</a></strong>&nbsp;&nbsp;&nbsp;<strong><a
							href="http://codecanyon.net/item/easy-social-share-buttons-for-wordpress/6394476?ref=appscreo"
							target="_blank">Easy Social Share Buttons plugin homepage</a></strong>
					</p>
					
				</div>
			</div>
		</div>
		

	</div>

	<?php 
	
	global $essb_options;
	$exist_user_purchase_code = isset($essb_options['purchase_code']) ? $essb_options['purchase_code'] : '';
	
	if ($exist_user_purchase_code == '') {
		ESSBOptionsFramework::draw_hint(__('Activate plugin to download add-ons', 'essb'), __('Thank you for choosing Easy Social Share Buttons for WordPress. To download our free add-ons please activate plugin by filling your purchase code in Activate tab. <a href="admin.php?page=essb_redirect_update">Click here to visit Activation Page</a>', 'essb'), 'fa fa-lock', 'addonhint');
	}
	
	?>
	

	<div class="wp-list-table widefat plugin-install">
		<div id="the-list">
		<?php
		
		if (! isset ( $current_list )) {
			$current_list = array ();
		}
		
		$site_url = get_bloginfo('url');
		
		
		foreach ( $current_list as $addon_key => $addon_data ) {
			$demo_url = isset ( $addon_data ['demo_url'] ) ? $addon_data ['demo_url'] : '';
			print '<div class="plugin-card">';
			print '<div class="plugin-card-top">';
			print '<h4><a href="' . $addon_data ['page'] . '" target="_blank">' . (($addon_data ['price'] == 'FREE') ? '<span class="essb-free">FREE</span>' : '' ) . $addon_data ["name"] . '</a></h4>';
			print '<a href="' . $addon_data ['page'] . '" target="_blank"><img src="' . $addon_data ["image"] . '" style="max-width: 100%;"/>';
			print '</a>';
			print '<p class="essb-description">';
			if (isset($addon_data['tags'])) {
			
				$tags = explode(',', $addon_data['tags']);
				foreach ($tags as $tag) {
					print '<span class="essb-addon-tag essb-addon-'.$tag.'">'.$tag.'</span>';
				}
			
			}
			print  $addon_data ['description'];
			
			
			
			print '</p>';
				
			//print '<div class="plugin-action-buttons"></div>';
			
			print '<div class="essb-column-compatibility column-compatibility">';
			$addon_requires = $addon_data ['requires'];
			if (version_compare ( ESSB3_VERSION, $addon_requires, '<' )) {
				print '<span class="compatibility-untested">Requires plugin version <b>' . $addon_requires . '</b> or newer</span>';
			} else {
				print '<span class="compatibility-compatible"><b>Compatible</b> with your version of plugin</span>';
					
			}
			print '</div>';
			
			print '</div>';
			
			print '<div class="plugin-card-bottom">';
			print '<div class="column-downloaded essb-column-downloaded">';
			
			print '<div class="essb-addon-price">';
			
			print 'Price: <b>' . $addon_data ['price'] . '</b>';
			print '</div>';
			
			print '</div>';
			
			print '<div class="column-compatibility essb-column-compatibility">';
			
			
					$check_exist = $addon_data ['check'];
			$is_installed = false;
			
			if (! empty ( $check_exist )) {
				if (defined ( $check_exist )) {
					$is_installed = true;
				}
			}
			
			if (! $is_installed) {
				if ($addon_data ['price'] != 'FREE') {
					print '<a class="essb-btn" target="_blank"  href="' . $addon_data ['page'] . '">Get it now ' . $addon_data ['price'] . '</a>';
				}
				else {
					if ($exist_user_purchase_code != '') {
						print '<a class="essb-btn" target="_blank"  href="' . $addon_data ['page'] .'&url='.$site_url .'&purchase_code='.$exist_user_purchase_code . '">Download Free</a>';
					}
					else {
						print '<span class="button button-primary button-disabled">Download Free</span>';
						
					}
				}
			} else {
				print '<span class="button button-primary button-disabled">Installed</span>';
			}
			
			if (! empty ( $demo_url )) {
				print '<a class="essb-btn essb-btn-orange button-no-margin" target="_blank" style="float: right;" href="' . $demo_url . '">Try live demo</a>';
			}
			
			if ($addon_data ['price'] != 'FREE') {
				print '<a class="essb-btn essb-btn-red" target="_blank"  href="' . $addon_data ['page'] . '" style="margin-left: 5px;">Learn more</a>';
			}
			
			print '</div>';
			
			print '</div>';
			print '</div>';
		}
		
		?>
		</div>
	</div>
</div>