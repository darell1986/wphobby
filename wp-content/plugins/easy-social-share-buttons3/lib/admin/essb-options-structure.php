<?php
if (!class_exists('ESSBSocialFollowersCounterHelper')) {
	include_once (ESSB3_PLUGIN_ROOT . 'lib/modules/social-followers-counter/essb-social-followers-counter-helper.php');
}

if (!class_exists('ESSBSocialProfilesHelper')) {
	include_once (ESSB3_PLUGIN_ROOT . 'lib/modules/social-profiles/essb-social-profiles-helper.php');
}

include_once(ESSB3_PLUGIN_ROOT . 'lib/admin/admin-options/essb-admin-options-helper.php');


$essb_navigation_tabs = array();
$essb_sidebar_sections = array();
$essb_sidebar_sections = array();

$essb_options = essb_options();

ESSBOptionsStructureHelper::init();
ESSBOptionsStructureHelper::tab('social', __('Social Sharing', 'essb'), __('Social Sharing', 'essb'), 'ti-sharethis');
ESSBOptionsStructureHelper::tab('display', __('Like, Follow & Subscribe', 'essb'), __('Like, Follow & Subscribe', 'essb'), 'ti-heart');
ESSBOptionsStructureHelper::tab('advanced', __('Advanced Settings', 'essb'), __('Advanced Settings', 'essb'), 'ti-settings');
ESSBOptionsStructureHelper::tab('style', __('Style Settings', 'essb'), __('Style Settings', 'essb'), 'ti-palette');
ESSBOptionsStructureHelper::tab('shortcode', __('Shortcode Generator', 'essb'), __('Shortcode Generator', 'essb'), 'ti-shortcode', '', true);
ESSBOptionsStructureHelper::tab('analytics', __('Analytics', 'essb'), __('Analytics', 'essb'), 'ti-stats-up', '', true);
ESSBOptionsStructureHelper::tab('import', __('Import/Export', 'essb'), __('Import/Export Plugin Configuration', 'essb'), 'ti-reload', 'right', true);
ESSBOptionsStructureHelper::tab('update', __('Activate', 'essb'), __('Activate', 'essb'), 'ti-lock', 'right', false, false, false, true);

ESSBOptionsStructureHelper::tab('quick', __('Quick Setup', 'essb'), __('Quick Setup Wizard', 'essb'), 'fa fa-cog', '', false, true, true);
ESSBOptionsStructureHelper::tab('readymade', __('Ready Made Styles', 'essb'), __('Apply Ready Made Styles', 'essb'), 'fa fa-cog', '', true, true, true, true);

ESSBOptionsStructureHelper::tab('status', __('System Status', 'essb'), __('System Status', 'essb'), 'fa fa-cog', '', true, true, true, true);

//-- menu
$user_active_tab = isset($_REQUEST['tab']) ? $_REQUEST['tab'] : '';

$active_settings_page = isset ( $_REQUEST ['page'] ) ? $_REQUEST ['page'] : '';
if (strpos ( $active_settings_page, 'essb_redirect_' ) !== false) {
	$options_page = str_replace ( 'essb_redirect_', '', $active_settings_page );
	// print $options_page;
	// print admin_url ( 'admin.php?page=essb_options&tab=' . $options_page );
	if ($options_page != '') {
		$user_active_tab = $options_page;
	}
}

if ($user_active_tab == "quick") {
	include_once (ESSB3_PLUGIN_ROOT . 'lib/admin/essb-options-structure-quick.php');	
}
if ($user_active_tab == "readymade") {
	include_once (ESSB3_PLUGIN_ROOT . 'lib/admin/admin-options/essb-options-structure-readymade.php');
}


include_once(ESSB3_PLUGIN_ROOT . 'lib/admin/admin-options/essb-admin-options-social.php');
include_once(ESSB3_PLUGIN_ROOT . 'lib/admin/admin-options/essb-admin-options-follow.php');
include_once(ESSB3_PLUGIN_ROOT . 'lib/admin/admin-options/essb-admin-options-legacy.php');

