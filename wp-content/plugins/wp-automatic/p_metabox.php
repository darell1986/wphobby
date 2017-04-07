<?php

$dir = WP_PLUGIN_URL.'/wp-automatic/';
require_once dirname(__FILE__) . '/inc/amazon.searchindex.php';

  
//getting the current  post Id
global $post;
global  $wpdb;
$prefix=$wpdb->prefix;
$post_id=$post->ID;

//Allowed tags
$allowed_tags=array();
$ad1=  array('[ad_2]','will be replaced with the Second ad code added in the settings page');
$ad2=  array('[ad_1]','will be replaced with the first ad code added in the settings page');
$source=array( '[source_link]' , 'will be replaced with the original article source link') ;
$allowed_tags['Articles']=  array(array('[keyword]','Keyword used to get current item'), array('[matched_content]' ,' will be replaced with the original fetched article content'),array('[original_title]','article title'), array('[author_name]','author name') , array('[author_link]','author link')  ,$ad1,$ad2,$source );
$allowed_tags['ArticlesBase']=  array(array('[keyword]','Keyword used to get current item'), array('[matched_content]' ,' will be replaced with the original fetched article content'),array('[original_title]','article title'), array('[author_name]','author name') , array('[author_link]','author link')  ,$ad1,$ad2,$source );
$allowed_tags['Feeds']=array( array('[matched_content]' ,' will be replaced with the original fetched article content') ,array('[original_title]','title of the post') , array('[author]','Author name if displayed at the feed or extracted using the extract original author option') ,array('[publish_date]','the date when the feed item published') ,array('[enclosure_link]','Returns the enclosure link of the item in the feed, this could be an image/audio or video link'),array('[og_img]','Only if you used the option to set a featured image from og:img this tag will return the og:image src url') ,$ad1,$ad2,$source);
$allowed_tags['Amazon']=array(array('[keyword]','Keyword used to get current item'), array('[product_img]',' will be replaced with the product image src'), array('[product_imgs_html]','Html of all the product images'), array('[product_imgs]','Comma separated list of image srcs of the product'),array('[product_link]',' will be replaced with the product amazon page link'),array('[chart_url]','get replaced by the add to chart link of the product at amazon'),array('[product_list_price]','Product list price without discount'),array('[price_with_discount]','If on sale, the original and new price are displayed.If not, the list price is displayed this tag is rendered on display to represent current price'),array('[price_with_discount_fixed]','If on sale, the original and new price are displayed.If not, the list price is displayed this tag value get generated when the product firstly added. It does not get updated with new price'),array('[product_price]',' Will be replaced with the product price like $32.10 with currency attached if possible Note  some products will not return a price'),array('[price_numeric]','price in a numeric format like 32.10 this price is suitable for woocommerce product price custom field named _price'), array('[price_currency]','The price currency i.e $ or € etc.'), array('[product_desc]',' will be replaced with the original fetched product descreption'), array('[review_link]','Review iframe link/url')  ,array('[review_iframe]','an iframe with amazon reviews of current product'), array('[product_asin]','Product ASIN') ,$ad1,$ad2,$source);
$allowed_tags['Clickbank']=array( array('[keyword]','Keyword used to get current item'), array('[product_img]',' will be replaced with the product image html') , array('[product_img_src]',' will be replaced with the product image src') , array('[product_link]',' will be replaced with the product sales page with your affiliate link') , array('[product_original_link]',' will be replaced with product sales page link without affiliation')   ,  array('[product_desc]',' will be replaced with the original fetched product descreption'),$ad1,$ad2,$source);
$allowed_tags['Youtube']=array(array('[keyword]','Keyword used to get current item'), array('[vid_player]',' will be replaced with the posted video player embed code') ,array('[vid_id]',' will be replaced with the youtube original vid id'), array('[source_link]',' will be replaced with the youtube original vid link') , array('[vid_img]',' replaced with video thumb img src') , array('[vid_views]',' will be replaced with video views count') , array('[vid_rating]',' will be replaced with stars rating out of 5 of the video') ,  array('[vid_desc]',' will be replaced with the original fetched video descreption') , array('[vid_time]','Video publish timestamp '), array('[vid_date]','Date when the video was published'), array('[vid_duration]','Video duration ') , array('[vid_author]','Video author channel id') , array('[vid_author_title]','Video author title') , array('[vid_likes]','Number of video likes'), array('[vid_dislikes]','Number of video dislikes')  , $ad1,$ad2,$source );
$allowed_tags['Vimeo']=array(array('[keyword]','Keyword used to get current item'),array('[vid_title]','title of the video'),  array('[vid_description]',' will be replaced with the original fetched video descreption'), array('[vid_embed]',' will be replaced with the posted video player embed code') ,array('[vid_id]',' will be replaced with the original vid id'), array('[vid_url]',' will be replaced with the vimeo original vid link') , array('[vid_img]',' replaced with video thumb img src') , array('[vid_views]',' will be replaced with video views count') , array('[vid_likes]',' will be replaced with stars likes number of the video')  , array('[vid_duration]','Video duration in seconds'), array('[vid_duration_readable]','Video duration in  hh:mm:ss format'), array('[vid_width]', 'width of the video player'), array('[vid_height]', 'Height of the video player')  ,  array('[vid_created_time]','Video creation time '),array('[vid_modified_time]', 'last modification date') , array('[vid_author_name]','Video author name '),array('[vid_author_id]','video author id') , array('[vid_author_link]','video author link'), array('[vid_author_picutre]','video author picture src link'),array('[vid_tags]','Tags of the video comma separated')  , $ad1,$ad2 );
$allowed_tags['Flicker']=array(array('[keyword]','Keyword used to get current item'), array('[img_title]','Image Title'),array('[img_author]','Image author ID'),array('[img_src]','Image Src link'),array('[img_src_s]','small square 75x75') , array('[img_src_q]','large square 150x150') , array('[img_src_t]','thumbnail, 100 on longest side') , array('[img_src_m]','small, 240 on longest side') , array('[img_src_n]','small, 320 on longest side') , array('[img_src_z]','medium 640, 640 on longest side') , array('[img_src_c]','medium 800, 800 on longest side†') , array('[img_src_b]','large, 1024 on longest side ') , array('[img_src_h]','large, 1600 on longest side ') , array('[img_src_k]','large, 2048 on longest side ') , array('[img_src_o]','Original Image uploaded with original size') ,array('[img_link]','Image link on flicker'),array('[img_author_name]','Image author name'),array('[img_description]','Image description'),array('[img_date_posted]','Date when the image posted'),array('[img_date_taken]','Date when the image taken'),array('[img_viewed]','Num of views of the image'),array('[img_tags]','image tags on flicker'),$ad1,$ad2,$source );
$allowed_tags['eBay']=array(array('[keyword]','Keyword used to get current item'),array('[item_id]','added item id on ebay'),array('[item_title]','item title'),array('[item_desc]','item description'),array('[item_images]','html of all item images'),array('[item_img]','item image http source'),array('[item_link]','item link on ebay'),array('[item_publish_date]','when item published'),array('[item_bids]','Number of current bids if applicable'),array('[item_price]','current item price'),array('[item_bin]','item buy it now price if applicable'),array('[item_end_date]','item when the listing ends'),array('[item_payment]','abvailable payment options') ,$ad1,$ad2,$source );
$allowed_tags['Pinterest'] = array(array('[pin_id]','Numerical id of the posted pin'),array('[pin_url]','Pin url at pinterest.com'),array('[pin_link]','original page link where the pin image exits *only for pins with link back to the source'),array('[pin_title]','Title of the pin'),array('[pin_description]','Description of the pin'),array('[pin_board_id]','Numeric ID of the board the pin belons to'),array('[pin_board_url]','URL of the matching board'),array('[pin_board_name]','Name of the board the pin belons to'),array('[pin_pinner_username]','Username of the pinner'),array('[pin_pinner_full_name]','Full name of the pinner'),array('[pin_pinner_id]','Numeric ID of the pin pinner'),array('[pin_domain]','Domain for the pin if posted from a url'),array('[pin_likes]','Number of likes of the pin'),array('[repin_count]','Number of repins'),array('[pin_img]','Image src link for the pin image'),array('[pin_img_width]','Width of the pin image'),array('[pin_img_height]','Height of the pin image'),$ad1,$ad2); 
$allowed_tags['Instagram'] = array( array('[item_title]','Instagram image title'), array('[item_embed]','The embed code of the item') , array('[item_id]','The instagram pic id'),array('[item_url]','Instagram pic url'),array('[item_description]','Instagram pic description'),array('[item_img]','Instagram image src'),array('[item_img_width]','Width of the instagram image'),array('[item_img_height]','Height of the image'),array('[item_user_id]','Instagram user id'),array('[item_user_username]','Username of the instagram image poster'),array('[item_user_name]','user name of the image poster'),array('[item_user_profile_pic]','Image src of the user pic'),array('[item_created_date]','date when the item created'),array('[item_likes_count]','Likes count of the item'),array('[item_tags]','Comma separated list of tags'),$ad1,$ad2,$source );
$allowed_tags['Facebook'] = array( array('[post_id]','Facebook post ID including page id'), array('[post_id_single]','Facebook post ID single numeric value') , array('[post_embed]','Embed code of the post') ,  array('[original_title]','Post title'), array('[matched_content]','Post content'),array('[from_name]','Username of the post author'),array('[from_id]','ID of the post author'),array('[from_url]','FB url of the post author'),array('[from_thumb]','Thumbnail url of the post author'),array('[shares_count]','Shares count'),array('[original_date]','Date of the post'),array('[external_url]','External url of the shared post. only if the item is actually a shared link on the page'),array('[image_src]','source url of an image at the post if exists'),$ad1,$ad2,$source );
$allowed_tags['Twitter'] = array(array('[item_id]','ID of the tweet'),array('[item_url]','Tweet url') , array('[item_original_link]','original url to the shared post if exists') ,array('[item_description]','Tweet textual content'),array('[item_embed]','embed code of the tweet') ,array('[item_retweet_count]','Rewteet Count'),array('[item_favorite_count]','Favorite count'),array('[item_author_id]','Numeric user id'),array('[item_author_screen_name]','Screen name of the user example: cnn'),array('[item_author_name]','User name'),array('[item_author_description]','User description'),array('[item_author_url]','user url'),array('[item_author_profile_image]','user profile image src'),array('[item_author_profile_background_image]','Background image src url used by the user'),array('[item_created_at]','Time of the tweet'),array('[item_title]','Title'));
$allowed_tags['SoundCloud']= array( array('[item_id]','Numeric ID of the sound') ,array('[item_url]','Link of the sound at soundcloud'), array('[item_embed]','Embed code of the sound') , array('[item_video_url]','URL of the video if exists'), array('[item_video_embed]','embed code of the video if exists'),array('[item_likes_count]','Likes count'),array('[item_purchase_url]','Purchase link if exists'),array('[item_thumbnail]','Thumbnail url'),array('[item_comment_count]','Comments count'),array('[item_title]','Title of the sound'),array('[item_description]','Description of the sound'),array('[item_favoritings_count]','Favourites count'),array('[item_genre]','Genre of the post'),array('[item_playback_count]','Playback count'),array('[item_reposts_count]','Repost count'),array('[item_tags]','Item tags if exists'),array('[item_created_at]','Time where the sound was created'),array('[item_duration]','Duration of the post in minutes'),array('[item_user_id]','User ID of the soundCloud user'),array('[item_user_link]','Link of the author'),array('[item_user_thumbnail]','Thumbnail source of the sound'),array('[item_user_username]','username of the author'),array('[item_download_url]','Download url of the item if the item is downloadable '),$ad1,$ad2,$source );
$allowed_tags['Craigslist'] = array(array('[item_title]','Item title'),array('[item_description]','Item description'),array('[item_link]','Item url'),array('[item_date]','Item publish date'),array('[item_img]','Item image src link'),array('[item_img_html]','Item image html code'),$ad1,$ad2,$source);
$allowed_tags['Itunesmusic'] = array( array('[item_link]','Link to the item at Itunes'),array('[item_id]','Numeric ID of the item at Itunes'),array('[item_description]','Textual description of the item at Itunes'),array('[item_title]','Title of the item'),array('[item_collectionId]','Numeric ID of the collection that the item belongs to.'),array('[item_collectionName]','Name of the collection that the item belongs to'),array('[item_collectionViewUrl]','Url of the collection that the item belongs to'),array('[item_previewUrl]','Media url of the item preview'),array('[item_img]','Main item image url'),array('[item_artistId]','Numeric ID of the item author/artist'),array('[item_artistName]','Name of the item author/artist'),array('[item_trackName]','Name of the item at Itunes'),array('[item_artistViewUrl]','Url of the item author/artist'),array('[item_price]','Price of the item'),array('[item_collectionPrice]','Price of the item Collection'),array('[item_trackCount]','Count of items at the collection that the item belongs to'),array('[item_trackCount]','Numeric order of the item at the collection'),array('[item_country]','Country of the item'),array('[item_currency]','Currency of the item'),array('[item_releaseDate]','Release date of the item'),array('[item_time]','Duration of the media in minutes') );
$allowed_tags['Itunesmovie'] = array( array('[item_link]','Link to the item at Itunes'),array('[item_id]','Numeric ID of the item at Itunes'),array('[item_description]','Textual description of the item at Itunes'),array('[item_title]','Title of the item'),array('[item_previewUrl]','Media url of the item preview'),array('[item_img]','Main item image url'),array('[item_artistName]','Name of the item author/artist'),array('[item_trackName]','Name of the item at Itunes'),array('[item_price]','Price of the item'),array('[item_country]','Country of the item'),array('[item_currency]','Currency of the item'),array('[item_releaseDate]','Release date of the item'),array('[item_time]','Duration of the media in minutes') );
$allowed_tags['Itunespodcast'] = array( array('[item_link]','Link to the item at Itunes'),array('[item_id]','Numeric ID of the item at Itunes'),array('[item_description]','Textual description of the item at Itunes'),array('[item_title]','Title of the item'),array('[item_img]','Main item image url'),array('[item_artistName]','Name of the item author/artist'),array('[item_trackName]','Name of the item at Itunes'),array('[item_price]','Price of the item'),array('[item_country]','Country of the item'),array('[item_currency]','Currency of the item'),array('[item_releaseDate]','Release date of the item') );
$allowed_tags['ItunesmusicVideo'] = array( array('[item_link]','Link to the item at Itunes'),array('[item_id]','Numeric ID of the item at Itunes'),array('[item_description]','Textual description of the item at Itunes'),array('[item_title]','Title of the item'),array('[item_previewUrl]','Media url of the item preview'),array('[item_img]','Main item image url'),array('[item_artistName]','Name of the item author/artist'),array('[item_trackName]','Name of the item at Itunes'),array('[item_price]','Price of the item'),array('[item_country]','Country of the item'),array('[item_currency]','Currency of the item'),array('[item_releaseDate]','Release date of the item'),array('[item_time]','Duration of the media in minutes'));
$allowed_tags['Itunesaudiobook'] = array( array('[item_link]','Link to the item at Itunes'),array('[item_id]','Numeric ID of the item at Itunes'),array('[item_description]','Textual description of the item at Itunes'),array('[item_title]','Title of the item'),array('[item_img]','Main item image url'),array('[item_artistName]','Name of the item author/artist'),array('[item_trackName]','Name of the item at Itunes'),array('[item_price]','Price of the item'),array('[item_country]','Country of the item'),array('[item_currency]','Currency of the item'),array('[item_releaseDate]','Release date of the item') );
$allowed_tags['ItunesshortFilm'] = array( array('[item_link]','Link to the item at Itunes'),array('[item_id]','Numeric ID of the item at Itunes'),array('[item_description]','Textual description of the item at Itunes'),array('[item_title]','Title of the item'),array('[item_previewUrl]','Media url of the item preview'),array('[item_img]','Main item image url'),array('[item_artistName]','Name of the item author/artist'),array('[item_trackName]','Name of the item at Itunes'),array('[item_price]','Price of the item'),array('[item_country]','Country of the item'),array('[item_currency]','Currency of the item'),array('[item_releaseDate]','Release date of the item'),array('[item_time]','Duration of the media in minutes') );
$allowed_tags['ItunestvShow'] = array(array('[item_link]','Link to the item at Itunes'),array('[item_id]','Numeric ID of the item at Itunes'),array('[item_description]','Textual description of the item at Itunes'),array('[item_title]','Title of the item'),array('[item_img]','Main item image url'),array('[item_artistName]','Name of the item author/artist'),array('[item_previewUrl]','Media url of the item preview'),array('[item_trackName]','Name of the item at Itunes'),array('[item_price]','Price of the item'),array('[item_country]','Country of the item'),array('[item_currency]','Currency of the item'),array('[item_releaseDate]','Release date of the item'),array('[item_time]','Duration of the media in minutes') );
$allowed_tags['Itunesebook'] = array( array('[item_link]','Link to the item at Itunes'),array('[item_id]','Numeric ID of the item at Itunes'),array('[item_description]','Textual description of the item at Itunes'),array('[item_title]','Title of the item'),array('[item_img]','Main item image url'),array('[item_artistName]','Name of the item author/artist'),array('[item_trackName]','Name of the item at Itunes'),array('[item_price]','Price of the item'),array('[item_country]','Country of the item'),array('[item_currency]','Currency of the item'),array('[item_rating]','Rating of the item'),array('[item_rating_counts]','Number of ratings of the item'),array('[item_releaseDate]','Release date of the item') );
$allowed_tags['Itunessoftware'] = array( array('[item_link]','Link to the item at Itunes'),array('[item_id]','Numeric ID of the item at Itunes'),array('[item_description]','Textual description of the item at Itunes'),array('[item_title]','Title of the item'),array('[item_img]','Main item image url'),array('[item_artistName]','Name of the item author/artist'),array('[item_artistViewUrl]','Url of the item author/artist'),array('[item_supportedDevices]','Supported Devices for the app'),array('[item_fileSize]','Size of the item in MegaBytes'),array('[item_sellerUrl]','External website of the item seller'),array('[item_trackName]','Name of the item at Itunes'),array('[item_price]','Price of the item'),array('[item_currency]','Currency of the item'),array('[item_version]','Version number of the item'),array('[item_primaryGenreName]','Genre name of the item'),array('[item_rating]','Rating of the item'),array('[item_rating_counts]','Number of ratings of the item'),array('[item_screenshotUrls]','Urls of the screenshots comma separated'),array('[item_screenshot]','html of the screenshots'),array('[item_releaseDate]','Release date of the item') );

$envatoTags = array( array('[item_id]','Numeric ID of the item'),array('[item_title]','Title of the item'),array('[item_link]','Url of the item at Envato'),array('[item_description]','Html description of the item'),array('[item_category]','Category of the item at Envato'),array('[item_category_url]','Url of the category at Envato'),array('[item_price]','Price of the item in $'),array('[item_author]','User name of the item author'),array('[item_author_url]','Url of the item author') ,array('[item_published_at]','Time when the item was published'),array('[item_updated_at]','Time when the item was updated'),array('[item_author_image]','url of the author image'),array('[item_rating]','Rating of the item out of 5'),array('[item_tags]','Tags of the item comma separated'),array('[item_sales]','Sales count of the item when posted'),array('[affiliate_id]','Affiliate ID set at the plugin settings page'));

$allowed_tags['Envatothemeforest'] = $allowed_tags['Envatocodecanyon'] = $allowed_tags['Envato3docean'] = array_merge($envatoTags,array( array('[preview_img]','Preview image url'),array('[preview_icon]','Url of the item icon'),array('[live_site]','url of the item live preview')  )); 
$allowed_tags['Envatographicriver'] = $allowed_tags['Envatophotodune'] = array_merge($envatoTags,array( array('[preview_icon]','Url of the preview icon'),array('[preview_img]','Url of the preview image') ));
$allowed_tags['Envatovideohive'] = array_merge($envatoTags,array( array('[preview_icon]','Url of the preview icon'),array('[preview_img]','Url of the preview image'),array('[preview_vid]','Url of the preview video') ));
$allowed_tags['Envatoaudiojungle'] = array_merge($envatoTags,array( array('[preview_icon]','Url of the preview icon'),array('[preview_mp3]','Url of the preview sound') ));
$allowed_tags['DailyMotion'] = array( array('[vid_player]','html embed code'),array('[item_id]','ID of the video at DM'),array('[item_title]','Title of the vide'),array('[item_image]','SRC url of the vid thumbnail'),array('[item_link]','URL of the video at DM'),array('[item_duration]','Length of the video'),array('[item_views]','Number of views'),array('[item_description]','Description of the video'),array('[item_channel]','Channel of the video'),array('[item_category_url]','URL of the video category'),array('[item_author]','Author name'),array('[item_author_id]','ID of the vid author'),array('[item_author_url]','URL of the vid author'),array('[item_author_image]','SRC url of the author image'),array('[item_published_at]','Timestamp when the video was published ex 1484080131'),array('[item_published_at_formated]','Date and time when the video was published ex 2017-01-13 22:30:26'),array('[item_likes]','Number of likes'));
$allowed_tags['Reddit'] = array(array('[item_title]','Title of the item'),array('[item_description]','Description of the item if exists'),array('[item_url]','URL of the shared content'),array('[item_link]','Reddit link for the post'),array('[item_date]','Timestamp of the post'),array('[item_img]','Image src url if exists'),array('[item_id]','ID of the item'),array('[item_domain]','Domain name of the shared post'),array('[item_score]','Score of the item at Reddit'),array('[item_author]','Author name'),array('[item_gif]','Gif image url if exists'),array('[item_mp4]','mp4 video link if exists'),array('[item_img_html]','Html markup of the item image'),array('[item_embed]','Embed code of a gif/video if exists'),array('[item_gif_embed]','Gif embed code if exists'),array('[item_mp4_embed]','mp4 video embed code if exists'),array('[item_author_link]',''),array('[item_date_formated]','Date and time when the post was published'));
$allowed_tags['Walmart'] = array(array('[item_img]','Url of the item image'),array('[item_url]','link of the item at Walmart'),array('[product_affiliate_url]','If you have a publisher ID, use this tag for the url as it will has the affiliate tracking'),array('[item_cart_url]','Add to chart url'),array('[item_cart_affiliate_url]','Add to chart url with affiiliate tracking enabled'),array('[item_rating]','Rating of the item'),array('[item_rating_img]','rating image src'),array('[item_list_price]','Item list price'),array('[item_imgs]','Comma separated list of item images'),array('[item_img_html]','Html of the item image'),array('[item_imgs_html]','Html of all item images'),array('[item_link]','Link of the item at Walmart'),$ad1,$ad2);

$query="select * from {$prefix}automatic_camps where camp_id='$post_id'";
$res=$wpdb->get_results($query);
if (count($res) > 0 ){
	$res=$res[0];
	$camp_post_every = $res->camp_post_every;
	$camp_keywords = stripslashes ( $res->camp_keywords );
	$camp_cb_category = stripslashes ( $res->camp_cb_category );
	$camp_replace_link = stripslashes ( $res->camp_replace_link );
	$camp_add_star = stripslashes ( $res->camp_add_star );
	$camp_post_title = stripslashes ( $res->camp_post_title );
	$camp_post_content = stripslashes ( $res->camp_post_content );
	$camp_amazon_category = stripslashes ( $res->camp_amazon_cat );
	$camp_amazon_region = $res->camp_amazon_region;
	$camp_post_category = stripslashes ( $res->camp_post_category );
	$camp_post_status = stripslashes ( $res->camp_post_status );
	
	$post_name = '';
	if (isset ( $res->post_name ))
		$post_name = stripslashes ( $res->post_name );
	
		$camp_options = unserialize ( $res->camp_options );
		$feeds = stripslashes ( $res->feeds );
		$camp_type = $res->camp_type;
		$camp_search_order = $res->camp_search_order;
		$camp_youtube_order = $res->camp_youtube_order;
		$camp_youtube_cat = $res->camp_youtube_cat;
		$camp_post_author = $res->camp_post_author;
		$camp_post_type = $res->camp_post_type;
		$camp_post_exact = $res->camp_post_exact;
		$camp_post_execlude = $res->camp_post_execlude;
		$camp_yt_user = $res->camp_yt_user;
		$camp_translate_from = $res->camp_translate_from;
		$camp_translate_to_2 = $res->camp_translate_to_2;
		
		$camp_translate_to= $res->camp_translate_to;
		 
		$camp_post_custom_k=unserialize($res->camp_post_custom_k);
		$camp_post_custom_v=unserialize($res->camp_post_custom_v);
		
		
		
		$temp='';
		if(is_array($camp_options)){
			
			foreach($camp_options as $option){
				$temp=$temp.'|'.$option;
			}
			$camp_options=$temp;
			
		}

		
		if( stristr($res->camp_general, 'a:') ) $res->camp_general=base64_encode($res->camp_general);
 		
		$camp_general=unserialize(base64_decode($res->camp_general));
		@$camp_general=array_map('stripslashes', $camp_general);
		
		if(! is_array($camp_general)) $camp_general=array();
		
		//cg_iu_attribute
		if(! isset($camp_general['cg_iu_attribute'])) $camp_general['cg_iu_attribute']='All';
		
		
		
	//print_r($res);

}else{
		$camp_post_every=2000;
		$camp_keywords='';
		$camp_cb_category='All';
		$camp_replace_link='';
		$camp_add_star=5;
		$camp_post_title='[original_title]';
		$camp_post_content='[ad_1]
[matched_content]
[ad_2]
<br><a href="[source_link]">Source</a> by <a href="[author_link]">[author_name]</a>';
		
		$camp_amazon_category='';
		$camp_amazon_region='';
		
		@$camp_post_category= '';
		$camp_post_status='publish';
		@$post_name='';
		$camp_type='Articles';
		$camp_search_order='';
		$camp_youtube_order='';
		$camp_youtube_cat='';
		$camp_post_author =1;
		$camp_post_type = 'post';
		$camp_post_exact='';
		$camp_post_execlude='';
		$camp_options = array('OPT_POST_STARS','OPT_POST_CONTENT','OPT_TBSS'   );
		$camp_options[] = 'OPT_YT_CACHE';
		$camp_options[] = 'OPT_DM_CACHE';
		$camp_options[] = 'OPT_VM_CACHE';
		$camp_options[] = 'OPT_FL_CACHE';
		$camp_options[] = 'OPT_EV_CACHE';
		$camp_options[] = 'OPT_CL_CACHE';
		$camp_options[] = 'OPT_EB_CACHE';
		$camp_options[] = 'OPT_PT_CACHE';
		$camp_options[] = 'OPT_RD_CACHE';
		$camp_options[] = 'OPT_PT_AUTO_TITLE';
		$camp_options[] = 'OPT_IT_CACHE';
		$camp_options[] = 'OPT_IU_CACHE';
		$camp_options[] = 'OPT_IT_AUTO_TITLE';
		$camp_options[] = 'OPT_SC_CACHE';
		$camp_options[] = 'OPT_FB_CACHE';
		$camp_options[] = 'OPT_GENERATE_FB_TITLE';
		$camp_options[] = 'OPT_FEEDS_OG_IMG';
		$camp_options[] = 'OPT_SUMARRY_FEED';
		$camp_options[] = 'OPT_CB_DESCRIPTION';
		$camp_options[] = 'OPT_TW_VID_EMBED';
		$camp_options[] = 'OPT_AM_GALLERY';
		$camp_options[] = 'OPT_THUMB';
		$camp_options[] = 'OPT_FEED_SCRIPT';
		$camp_options[] = 'OPT_WM_CACHE';
		
		$camp_yt_user='';
		$camp_translate_from='no';
		$camp_translate_to_2='no';
		$camp_translate_to='no';
		$camp_post_custom_k=array();
		$camp_post_custom_v=array();
		$camp_general=array();
		$camp_general['cg_post_format']='';
		$camp_general['cg_thmb_list']='';
		
		$camp_general['cg_eb_full_img_t']= $camp_general['cg_am_full_img_t'] = htmlentities('<img src="[img_src]" class="wp_automatic_gallery" />');
		
		$camp_general['cg_yt_dte_day'] = date('d'); 
		$camp_general['cg_yt_dte_month'] = date('m');
		$camp_general['cg_yt_dte_year'] = date('Y');
		$camp_general['cg_post_tags'] = '';
		$camp_general['cg_regex_replace'] = '';
		$camp_general['cg_minimum_width'] = 100;
		
		
		// undefined camp_general keys
		$camp_generalKeys = "cg_custom_selector,cg_feed_custom_id,cg_custom_selector2,cg_feed_custom_id2,cg_custom_selector3,cg_feed_custom_id3,cg_feed_custom_regex,cg_feed_custom_regex2,cg_part_to_field,cg_custom_strip_selector,cg_feed_custom_strip_id,cg_custom_strip_selector2,cg_feed_custom_strip_id2,cg_custom_strip_selector3,cg_feed_custom_strip_id3,cg_post_strip,cg_custom_selector_tag,cg_feed_custom_id_tag,cg_custom_selector_author,cg_feed_custom_id_author,cg_min_length,cg_feed_encoding,cg_cl_page,cg_iu_media,cg_iu_attribute,cg_iu_lang,cg_fb_source,cg_fb_page,cg_fb_page_id,cg_fb_title_count,cg_am_node,cg_am_order,cg_am_min,cg_am_max,cg_am_param_type,cg_am_param,cg_yt_dte_minutes,cg_vm_user_channel,cg_vm_user,cg_vm_order,cg_vm_order_dir,cg_vm_cc,cg_vm_width,cg_vm_height,cg_sc_user_playlist,cg_sc_user,cg_sc_from,cg_sc_to,cg_pt_user_channel,cg_pt_user,cg_pt_title_count,cg_it_user,cg_it_title_count,cg_tw_lang,cg_yt_playlist,cg_yt_license,cg_yt_type,cg_yt_duration,cg_yt_definition,cg_yt_width,cg_yt_height,cg_yt_ctr,cg_yt_lang,cg_eb_user,cg_eb_site,cg_eb_cat,cg_ebay_custom,cg_eb_listing,cg_eb_order,cg_eb_min,cg_eb_max,cg_eb_iframe_h,cg_eb_param,cg_eb_redirect_end,cg_fl_user,cg_fl_user_album,cg_fl_order,cg_cb_lang,cg_camp_tax,cg_keyword_cat,cg_tags_limit,cg_keyword_tag,cg_content_limit,cg_title_limit,cg_camp_post_regex_exact,cg_camp_post_regex_exclude,cg_wpml_lang,cg_tag_tax,cg_translate_method,cg_ev_filter,cg_ev_cat,cg_ev_tags,cg_ev_author,cg_ev_sort,cg_ev_sort_dir,cg_ev_api";
		$camp_generalKeys = explode(',', $camp_generalKeys);
		
		foreach ($camp_generalKeys as $camp_generalKey){
			$camp_general[$camp_generalKey] =  null;
		}
		
		if(is_array($camp_options)){
			
			$temp = '';
			foreach($camp_options as $option){
				@$temp=$temp.'|'.$option;
			}
			$camp_options=$temp;
			
		}	
	
}




?>
 
 

<div class="TTWForm-container" dir="ltr">
 
     
     
<div class="TTWForm">
 

<div class="panes">
	

	<!--first tab-->
	<div class="contains">
	

	<input type="hidden" value="<?php echo $post_id ?>" id="wp_automatic_post_id" />
      

		<div id="field-camp_type-container" class="field f_100" style="margin-top:10px" >
			<label for="field-camp_type">
				Campaign Type 
			</label>
			<select <?php if(count($res) != 0) echo 'disabled="disabled"' ?> name="camp_type" id="camp_type">
				
				<option  value="Articles"  <?php @wp_automatic_opt_selected('Articles',$camp_type) ?> >EzineArticles</option>
				<option  value="ArticlesBase"  <?php @wp_automatic_opt_selected('ArticlesBase',$camp_type) ?> >ArticlesBase</option>
				<option  value="Feeds"  <?php @wp_automatic_opt_selected('Feeds',$camp_type) ?> >Feeds</option>
				<option  value="Amazon"  <?php @wp_automatic_opt_selected('Amazon',$camp_type) ?> >Amazon</option>
				<option  value="Clickbank"  <?php @wp_automatic_opt_selected('Clickbank',$camp_type) ?> >Clickbank</option>
				<option  value="Youtube"  <?php @wp_automatic_opt_selected('Youtube',$camp_type) ?> >Youtube</option>
				<option  value="Vimeo"  <?php @wp_automatic_opt_selected('Vimeo',$camp_type) ?> >Vimeo</option>
				<option  value="Flicker"  <?php @wp_automatic_opt_selected('Flicker',$camp_type) ?> >Flicker</option>
				<option  value="eBay"  <?php @wp_automatic_opt_selected('eBay',$camp_type) ?> >eBay</option>
				<option  value="Spintax"  <?php @wp_automatic_opt_selected('Spintax',$camp_type) ?> >Spintax</option>
				<option  value="Facebook"  <?php @wp_automatic_opt_selected('Facebook',$camp_type) ?> >Facebook</option>
				<option  value="Pinterest"  <?php @wp_automatic_opt_selected('Pinterest',$camp_type) ?> >Pinterest</option>
				<option  value="Instagram"  <?php @wp_automatic_opt_selected('Instagram',$camp_type) ?> >Instagram</option>
				<option  value="Twitter"  <?php @wp_automatic_opt_selected('Twitter',$camp_type) ?> >Twitter</option>
				<option  value="SoundCloud"  <?php @wp_automatic_opt_selected('SoundCloud',$camp_type) ?> >SoundCloud</option>
				<option  value="Craigslist"  <?php @wp_automatic_opt_selected('Craigslist',$camp_type) ?> >Craigslist</option>
				<option  data-sub-filter="#cg_iu_media" value="Itunes"  <?php @wp_automatic_opt_selected('Itunes',$camp_type) ?> >Itunes</option>
				<option  data-sub-filter="#cg_ev_filter" value="Envato"  <?php @wp_automatic_opt_selected('Envato',$camp_type) ?> >Envato</option>
				<option  value="DailyMotion"  <?php @wp_automatic_opt_selected('DailyMotion',$camp_type) ?> >DailyMotion</option>
				<option  value="Reddit"  <?php @wp_automatic_opt_selected('Reddit',$camp_type) ?> >Reddit</option>
				<option  value="Walmart"  <?php @wp_automatic_opt_selected('Walmart',$camp_type) ?> >Walmart</option>
				
			</select>
			
			<?php if(count($res) != 0) echo 'Hint: you can not change type . campaign already published <input name="camp_type" type="hidden" value="'.$camp_type.'" />' ?> 
			
		</div>
          

          <div  id="field111-container" class="field typepart Articles ArticlesBase Amazon Clickbank Youtube Vimeo Flicker  eBay f_100 Pinterest Instagram Twitter SoundCloud Itunes Envato DailyMotion Walmart" style="display:none;" >
               <label for="field111">
                    Campaign keywords <i>(search for these keywords) (comma separated)</i>
               </label>
				<table style="width:100%">
					<tr>
						<td width="50%" style="position: absolute;">
					
					          <input autocomplete="off" id="search" type="text" onblur="if (this.value == '') {this.value = 'Search New Keyword...';}" onfocus="if (this.value == 'Search New Keyword...') {this.value = '';}" value="Search New Keyword..." style=" float: left;width: 90%;top:0"/> 
				        </td>
				        <td width="50%">
				               <textarea rows="5" cols="20" name="camp_keywords" id="field111" required="required"><?php echo $camp_keywords  ?></textarea>	
				        </td>
			        </tr>
			          
		         </table>
		         
		         <div class="typepart Twitter field f_100">
		         
		         
		         <table>
		         	<thead>
		         		<tr><td colspan="2"><strong><u>Twitter Keywords Examples..</u></strong></td></tr>
		         	</thead>
		         	<tbody>
				        <tr><td>watching now</td><td><i>	containing both “watching” and “now”. This is the default operator.</i></td></tr>
				        <tr><td>“happy hour”</td><td><i>	containing the exact phrase “happy hour”.</i></td></tr>
						<tr><td>love OR hate</td><td><i>	containing either “love” or “hate” (or both).</i></td></tr>
						<tr><td>beer -root</td><td><i>	containing “beer” but not “root”.</i></td></tr>
						<tr><td>#haiku</td><td><i>	containing the hashtag “haiku”.</i></td></tr>
						<tr><td>from:alexiskold</td><td><i>	sent from person “alexiskold”.</i></td></tr>
						<tr><td>to:techcrunch</td><td><i>	sent to person “techcrunch”.</i></td></tr>
						<tr><td>@mashable</td><td><i>	referencing person “mashable”.</i></td></tr>
						<tr><td>superhero since:2015-07-19</td><td><i>	containing “superhero” and sent since date “2015-07-19” (year-month-day).</i></td></tr>
						<tr><td>ftw until:2015-07-19</td><td><i>	containing “ftw” and sent before the date “2015-07-19”.</i></td></tr>
						<tr><td>movie -scary :)</td><td><i>	containing “movie”, but not “scary”, and with a positive attitude.</i></td></tr>
						<tr><td>flight :(</td><td><i>	containing “flight” and with a negative attitude.</i></td></tr>
						<tr><td>traffic ?</td><td><i>	containing “traffic” and asking a question.</i></td></tr>
						<tr><td>hilarious filter:links</td><td><i>	containing “hilarious” and linking to URL.</i></td></tr>
						<tr><td>news source:twitterfeed</td><td><i>	containing “news” and entered via TwitterFeed</i></td></tr>
						
				        
					</tbody>
		        </table>
		         
		         </div>
		         
		         
		                  <div id="field1zzxzz-container" class="field f_100">
					               <div class="option clearfix">
					                    <input name="camp_options[]" id="field2xzz-1" value="OPT_TAG" type="checkbox">
					                    <span class="option-title">
												Post keywords as tags
					                    </span>
					                    <br>
					               </div>
					               
					               <div class="option clearfix">
					                    <input name="camp_options[]"   value="OPT_ROTATE" type="checkbox">
					                    <span class="option-title">
												Rotate keywords ( Tick to post for different keyword each time )
					                    </span>  
					                    <br>
					               </div>
					               
							 </div>
							  
		         
            </div>


          <div id="field5-container" class="field f_100 ">
               <label for="field5">
                    Maximum number of posts to post <i>(Campaign will stop after reaching)</i>
               </label>
               <input value="<?php echo $camp_post_every   ?>" max="1000000" min="0" name="camp_post_every" id="field1" required="required" class="ttw-range range"
               type="range">
          </div>
          
              
		<!-- Feed part -->
         <div id="feed_postcont" class="field f_100 typepart Feeds" style="display:none;" >
               <div class="option clearfix">
 
               
		          <div id="feed-container" class="field f_100">
		               <label for="field11">
		                    Feeds to post from <i>(one feed link per line)</i>
		               </label>
		               <textarea rows="5" cols="20" name="feeds" id="field11"><?php if(isset($feeds))echo $feeds ?></textarea>
               			              
               			          <div class="option clearfix">
					                    <input name="camp_options[]"   value="OPT_ROTATE_FEEDS" type="checkbox">
					                    <span class="option-title">
												Rotate Feeds ( Tick to post for a different feed each time )
					                    </span>  
					                    <br>
					               </div> 
               						
			                        <div  class="field f_100">
				
				 						<div class="option clearfix">
							                    <input name="camp_options[]"   value="OPT_SUMARRY_FEED" type="radio">
							                    <span class="option-title">
														Post content from feed as-is   
							                    </span>
							                    <br>
							           </div>			            
							            
							            <div class="option clearfix">
							                    <input name="camp_options[]" id="field2xz-1" value="OPT_FULL_FEED" type="radio">
							                    <span class="option-title">
														Post Full Content from summary feeds   
							                    </span>
							                    <br>
							           </div>
							               
				               	 
				            
						               <div class="option clearfix">
						                    
						                    <input  data-controls='feed_custom_c' name="camp_options[]" id="feed_custom" value="OPT_FEED_CUSTOM" type="radio">
						                    <span class="option-title">
													Extract content from original content using id or class 
													 
						                    </span>
						                    <br>
						                    
								            <div id="feed_custom_c" class="field f_100">
								            
								               <label for="field6">
								                    Division ID or Class or XPath (ADVANCED) 
								               </label>
								                
								                <table>
								                	<tr>
								                		
								                		<td style="vertical-align: top;">Rule 1</td>
								                	
								                		<td style="min-width:118px">
								                		
								                		<select name="cg_custom_selector" >
									                		<option  value="id"  <?php @wp_automatic_opt_selected('id', $camp_general['cg_custom_selector'] ) ?> >ID</option> 
									                		<option  value="class"  <?php @wp_automatic_opt_selected('class', $camp_general['cg_custom_selector'] ) ?> >Class</option>
									                		<option  value="xpath"  <?php @wp_automatic_opt_selected('xpath', $camp_general['cg_custom_selector'] ) ?> >Xpath</option>
									                	</select>
								                		
								                		</td>
								                		
								                		<td  style="vertical-align: top;width: 100%;" ><input value="<?php echo htmlspecialchars( @$camp_general['cg_feed_custom_id'])   ?>" name="cg_feed_custom_id"    type="text"></td>
								                		
								                		<td style="min-width: 77px;" valign="top" >
								                			<span class="option-title">
																	<abbr title="Tick if you want the plugin to extract the first match only not all matches">Single?</abbr>
							                    			</span>
										                    <input  class="no-unify" name="camp_options[]"  value="OPT_SELECTOR_SINGLE" type="checkbox">
								                		</td>
								                		
								                		<td style="min-width: 77px;" valign="top" >
								                			<span class="option-title">
																	<abbr title ="Tick to extract the inner content not the outer content">Inner?</abbr>
							                    			</span>
										                    <input  class="no-unify" name="camp_options[]"  value="OPT_SELECTOR_INNER" type="checkbox">
								                		</td>
								                		
								                	</tr>
								                	
								                	<tr>
								                	
								                		<td style="vertical-align: top;">Rule 2</td>
								                		
								                		<td style="min-width:118px">
								                		
								                		<select name="cg_custom_selector2" >
									                		<option  value="id"  <?php @wp_automatic_opt_selected('id', $camp_general['cg_custom_selector2'] ) ?> >ID</option> 
									                		<option  value="class"  <?php @wp_automatic_opt_selected('class', $camp_general['cg_custom_selector2'] ) ?> >Class</option>
									                		<option  value="xpath"  <?php @wp_automatic_opt_selected('xpath', $camp_general['cg_custom_selector2'] ) ?> >Xpath</option>
									                	</select>
								                		
								                		</td>
								                		
								                		<td  style="vertical-align: top;width: 100%;" ><input value="<?php echo htmlspecialchars( @$camp_general['cg_feed_custom_id2'] )  ?>" name="cg_feed_custom_id2" placeholder="optional leave empty to skip"   type="text"></td>
								                		
								                		<td style="min-width: 77px;" valign="top" >
								                			<span class="option-title">
																	Single
							                    			</span>
										                    <input  class="no-unify" name="camp_options[]"  value="OPT_SELECTOR_SINGLE2" type="checkbox">
								                		</td>
								                		
								                		<td style="min-width: 77px;" valign="top" >
								                			<span class="option-title">
																	<abbr title ="Tick to extract the inner content not the outer content">Inner?</abbr>
							                    			</span>
										                    <input  class="no-unify" name="camp_options[]"  value="OPT_SELECTOR_INNER2" type="checkbox">
								                		</td>
								                		
								                		
								                	</tr>
								                	
								                	<tr>
								                	
								                		<td style="vertical-align: top;">Rule 3</td>
								                		
								                		<td style="min-width:118px">
								                		
								                		<select name="cg_custom_selector3" >
									                		<option  value="id"  <?php @wp_automatic_opt_selected('id', $camp_general['cg_custom_selector3'] ) ?> >ID</option> 
									                		<option  value="class"  <?php @wp_automatic_opt_selected('class', $camp_general['cg_custom_selector3'] ) ?> >Class</option>
									                		<option  value="xpath"  <?php @wp_automatic_opt_selected('xpath', $camp_general['cg_custom_selector3'] ) ?> >Xpath</option>
									                	</select>
								                		
								                		</td>
								                		
								                		<td  style="vertical-align: top;width: 100%;" ><input value="<?php echo htmlspecialchars( @$camp_general['cg_feed_custom_id3'] )  ?>" name="cg_feed_custom_id3" placeholder="optional leave empty to skip"   type="text"></td>
								                	
								                		<td style="min-width: 77px;" valign="top" >
								                			<span class="option-title">
																	Single
							                    			</span>
										                    <input  class="no-unify" name="camp_options[]"  value="OPT_SELECTOR_SINGLE3" type="checkbox">
								                		</td>
								                		
								                		<td style="min-width: 77px;" valign="top" >
								                			<span class="option-title">
																	<abbr title ="Tick to extract the inner content not the outer content">Inner?</abbr>
							                    			</span>
										                    <input  class="no-unify" name="camp_options[]"  value="OPT_SELECTOR_INNER3" type="checkbox">
								                		</td>
								                	
								                	</tr>
								                	<?php /*?>
								                	<tr>
								                		<td colspan="5">
									                		<input name="camp_options[]" value="OPT_FEED_CUSTOM_MULTI_PAGE" type="checkbox">
										                    <span class="option-title">
																	Try to fetch content from multi-pages posts. 
																	 
										                    </span>
										                    <br>
								                		</td>
								                	</tr>
								                	
								                	<?php */?>
								                	
								                	<tr><td colspan="5"><small><i><br>*You can extract up to three parts by rule 1, rule 2 and rule 3 . final content will be concating content from all. rule 2,3 are optional <br><br>*Single means the plugin will only capture the first match</i> </small></td></tr>
								                
								                </table>
								                
								                 
							                    
								            </div>
								            
						               </div>
							
										<div class="option clearfix">
						                    
						                    <input  data-controls='feed_custom_r' name="camp_options[]" id="feed_customr" value="OPT_FEED_CUSTOM_R" type="radio">
						                    <span class="option-title">
													Extract content from original content using REGEX 
													 
						                    </span>
						                    <br>
						                    
								            <div id="feed_custom_r" class="field f_100">
								            
								               <label for="field6">
								                    Regex (HIGHLY ADVANCED) 
								               </label>
								                
								                <table>
								                	<tr>
									                	 <input placeholder="regex1" value="<?php echo htmlentities(@$camp_general['cg_feed_custom_regex'],ENT_COMPAT, 'UTF-8')   ?>" name="cg_feed_custom_regex"    type="text"> 
								                	</tr>
								                	
								                	<tr>
								                	     <input placeholder="regex2"  value="<?php echo htmlentities(@$camp_general['cg_feed_custom_regex2'],ENT_COMPAT, 'UTF-8' )  ?>" name="cg_feed_custom_regex2"    type="text">
 								                	</tr>
 								                	<tr>
 								                		 <div class="option clearfix">
										                    <input name="camp_options[]" value="OPT_REGEX_TWO" type="checkbox">
										                    <span class="option-title">
																	Apply the second regex to the result from the first one (by default it apply to source content)   
										                    </span>
										                    <br>
										               </div>
 								                	</tr>
								                	
								                	<tr><td colspan="3">You can extract up to two parts by rule 1 and rule 2 . final content will be concating content from both. rule 2 is optional </td></tr>
								                	
								                	<tr><td colspan="3">example: if you want to extract content between to unique texts in the content use this  <strong>startHere(.*?)endHere</strong>  where startHere is the unique text that the plugin will extract after and endHere is the unique text that the plugin will stop once find </td></tr>
								                
								                	 
								                
								                </table>
								                
								                 
							                    
								            </div>
								            
						               </div>
						               
						               </div>
						               
						               
						               <div  class="field f_100">
						               
						               		<div class="option clearfix">
	                    
							                    <input name="camp_options[]"  data-controls="wp_auatomatic_part_to_field" id="post_strip_css_opt" value="OPT_FEED_PTF" type="checkbox">
							                    <span class="option-title">
														Specific extraction to a custom field
							                    </span>
							                    <br>
							                    
									            <div id="wp_auatomatic_part_to_field" class="field f_100">
									           		
									           		 <div class="description">
												    	
												    	 <label for="field6">
										                    Rules (one per line)
											             </label>
											               
											             <textarea name="cg_part_to_field" ><?php  echo htmlentities(@$camp_general['cg_part_to_field'],ENT_COMPAT, 'UTF-8')   ?></textarea>
												    	
												    	 <i>
												    	
												    	This feature extracts specific parts and set to specific custom fields
												    	
												    	<br>*one rule per line 
												    	
												    	<br>*rule fomat is  "extractionMethod|data|customFieldName"
												    	
												    	<br>*extractionMethod can be id,class,xpath or regex
												    	
												    	<br>Example #1 "class|tags|post_tags" will extract the part with class=tags and set it to a custom field named post_tags 
												    	<br>Example #2 "regex|liked(.*?)times|likes_count" will extract the content between "liked" and "times" and create a custom field with this value
												    	
												    	</i>
												    	 
												    	
											    	</div>
									           		 
											    </div>
											     
											</div>
						               
						               		<div class="option clearfix">
	                    
							                    <input name="camp_options[]"  data-controls="post_strip_css_c" id="post_strip_css_opt" value="OPT_STRIP_CSS" type="checkbox">
							                    <span class="option-title">
														Strip parts after extracting content using Id or Class
							                    </span>
							                    <br>
							                    
									            <div id="post_strip_css_c" class="field f_100">
									                 
									               <table>
								                	<tr>
								                		
								                		<td style="vertical-align: top;">Rule 1</td>
								                	
								                		<td style="min-width:118px">
								                		
								                		<select name="cg_custom_strip_selector" >
									                		<option  value="id"  <?php @wp_automatic_opt_selected('id', $camp_general['cg_custom_strip_selector'] ) ?> >ID</option> 
									                		<option  value="class"  <?php @wp_automatic_opt_selected('class', $camp_general['cg_custom_strip_selector'] ) ?> >Class</option>
									                	</select>
								                		
								                		</td>
								                		
								                		<td  style="vertical-align: top;width: 100%;" ><input value="<?php echo @$camp_general['cg_feed_custom_strip_id']   ?>" name="cg_feed_custom_strip_id"    type="text"></td>
								                	</tr>
								                	
								                	<tr>
								                	
								                		<td style="vertical-align: top;">Rule 2</td>
								                		
								                		<td style="min-width:118px">
								                		
								                		<select name="cg_custom_strip_selector2" >
									                		<option  value="id"  <?php @wp_automatic_opt_selected('id', $camp_general['cg_custom_strip_selector2'] ) ?> >ID</option> 
									                		<option  value="class"  <?php @wp_automatic_opt_selected('class', $camp_general['cg_custom_strip_selector2'] ) ?> >Class</option>
									                	</select>
								                		
								                		</td>
								                		
								                		<td  style="vertical-align: top;width: 100%;" ><input value="<?php echo @$camp_general['cg_feed_custom_strip_id2']   ?>" name="cg_feed_custom_strip_id2" placeholder="optional leave empty to skip"   type="text"></td>
								                	</tr>
								                	
								                	<tr>
								                	
								                		<td style="vertical-align: top;">Rule 3</td>
								                		
								                		<td style="min-width:118px">

								                		
								                		<select name="cg_custom_strip_selector3" >
									                		<option  value="id"  <?php @wp_automatic_opt_selected('id', $camp_general['cg_custom_strip_selector3'] ) ?> >ID</option> 
									                		<option  value="class"  <?php @wp_automatic_opt_selected('class', $camp_general['cg_custom_strip_selector3'] ) ?> >Class</option>
									                	</select>
								                		
								                		</td>
								                		
								                		<td  style="vertical-align: top;width: 100%;" ><input value="<?php echo @$camp_general['cg_feed_custom_strip_id3']   ?>" name="cg_feed_custom_strip_id3" placeholder="optional leave empty to skip"   type="text"></td>
								                	</tr>
								                	
								                	<tr><td colspan="3">You can strip up to three parts by rule 1, rule 2 and rule 3 . final content will be concating content from all. rule 2,3 are optional </td></tr>
								                
								                </table>
									                 
									            </div>
									            
							                </div>
						               
							                <div class="option clearfix">
	                    
							                    <input name="camp_options[]"  data-controls="post_strip_c" id="post_strip_opt" value="OPT_STRIP_R" type="checkbox">
							                    <span class="option-title">
														Strip parts after extracting content using REGEX
							                    </span>
							                    <br>
							                    
									            <div id="post_strip_c" class="field f_100">
									               <label for="field6">
									                    REGEX patterns to strip (one per line)
									               </label>
									               
									                <textarea name="cg_post_strip" ><?php  echo htmlentities(@$camp_general['cg_post_strip'],ENT_COMPAT, 'UTF-8')   ?></textarea>
									               
									            </div>
									            
							               </div>
							               
							               
											<div class="option clearfix">
	                    
							                    <input name="camp_options[]"  data-controls="post_strip_t"  value="OPT_STRIP_T" type="checkbox">
							                    <span class="option-title">
														Strip html tags
							                    </span>
							                    <br>
							                    
									            <div id="post_strip_t" class="field f_100">
									               
									                <label>
									                    Allowed html tags 
									               </label>
									               
									                <input value="<?php  echo @$camp_general['cg_allowed_tags']   ?>"  name="cg_allowed_tags" type="text">
									               <div class="description" >example:&lt;br&gt;&lt;a&gt; </div>
									            </div>
									            
							               </div>
								               
										 
					               
					               
							                 <div class="option clearfix">
							                    <input name="camp_options[]"   value="OPT_ORIGINAL_TIME" type="checkbox">
							                    <span class="option-title">
														Add posts with it's original time   
							                    </span>
							                    <br>
							               </div>
					               
					               		   <div class="option clearfix">
							                    <input name="camp_options[]"   value="OPT_ORIGINAL_CATS" type="checkbox">
							                    <span class="option-title">
														Set post categories to original post categories   
							                    </span>
							                    <br>
							               </div>
											
											<div class="option clearfix">
							                    <input data-controls="wp_automatic_tags_extract" name="camp_options[]"   value="OPT_ORIGINAL_TAGS" type="checkbox">
							                    <span class="option-title">
														Extract original tags and set it as tags (using id/class)    
							                    </span>
							                    
							                    <div id="wp_automatic_tags_extract">
							                    	<label for="field6">
								                    Division ID or Class or XPath (ADVANCED) 
								               </label>
								                
								                <table>
								                	<tr>
								                		
								                		<td style="vertical-align: top;">Rule 1</td>
								                	
								                		<td style="min-width:118px">
								                		
								                		<select name="cg_custom_selector_tag" >
									                		<option  value="id"  <?php @wp_automatic_opt_selected('id', $camp_general['cg_custom_selector_tag'] ) ?> >ID</option> 
									                		<option  value="class"  <?php @wp_automatic_opt_selected('class', $camp_general['cg_custom_selector_tag'] ) ?> >Class</option>
									                		<option  value="xpath"  <?php @wp_automatic_opt_selected('xpath', $camp_general['cg_custom_selector_tag'] ) ?> >Xpath</option>
									                	</select>
								                		
								                		</td>
								                		
								                		<td  style="vertical-align: top;width: 100%;" ><input value="<?php echo htmlspecialchars( @$camp_general['cg_feed_custom_id_tag'])   ?>" name="cg_feed_custom_id_tag"    type="text"></td>
								                		
								                		<td style="min-width: 77px;" valign="top" >
								                			<span class="option-title">
																	<abbr title="Tick if you want the plugin to extract the first match only not all matches">Single?</abbr>
							                    			</span>
										                    <input  class="no-unify" name="camp_options[]"  value="OPT_SELECTOR_SINGLE_TAG" type="checkbox">
								                		</td>
								                		
								                		<td style="min-width: 77px;" valign="top" >
								                			<span class="option-title">
																	<abbr title ="Tick to extract the inner content not the outer content">Inner?</abbr>
							                    			</span>
										                    <input  class="no-unify" name="camp_options[]"  value="OPT_SELECTOR_INNER_TAG" type="checkbox">
								                		</td>
								                		
								                	 							                		
								                	</tr>
								                </table>
							                    </div>
							                    
							                    <br>
							               </div>
							               
							               
							               <div class="option clearfix">
							                    <input data-controls="wp_automatic_author_extract" name="camp_options[]"   value="OPT_ORIGINAL_AUTHOR" type="checkbox">
							                    <span class="option-title">
														Extract original author and set it as the post author (using id/class/xpath)    
							                    </span>
							                    
							                    <div id="wp_automatic_author_extract">
							                    	<label for="field6">
								                    Division ID or Class or XPath (ADVANCED) 
								               </label>
								                
								                <table>
								                	<tr>
								                		
								                		<td style="vertical-align: top;">Rule 1</td>
								                	
								                		<td style="min-width:118px">
								                		
								                		<select name="cg_custom_selector_author" >
									                		<option  value="id"  <?php @wp_automatic_opt_selected('id', $camp_general['cg_custom_selector_author'] ) ?> >ID</option> 
									                		<option  value="class"  <?php @wp_automatic_opt_selected('class', $camp_general['cg_custom_selector_author'] ) ?> >Class</option>
									                		<option  value="xpath"  <?php @wp_automatic_opt_selected('xpath', $camp_general['cg_custom_selector_author'] ) ?> >Xpath</option>
									                	</select>
								                		
								                		</td>
								                		
								                		<td  style="vertical-align: top;width: 100%;" ><input value="<?php echo htmlspecialchars( @$camp_general['cg_feed_custom_id_author'])   ?>" name="cg_feed_custom_id_author"    type="text"></td>
								                		
								                		<td style="min-width: 77px;" valign="top" >
								                			<span class="option-title">
																	<abbr title="Tick if you want the plugin to extract the first match only not all matches">Single?</abbr>
							                    			</span>
										                    <input  class="no-unify" name="camp_options[]"  value="OPT_SELECTOR_SINGLE_AUTHOR" type="checkbox">
								                		</td>
								                		
								                		<td style="min-width: 77px;" valign="top" >
								                			<span class="option-title">
																	<abbr title ="Tick to extract the inner content not the outer content">Inner?</abbr>
							                    			</span>
										                    <input  class="no-unify" name="camp_options[]"  value="OPT_SELECTOR_INNER_AUTHOR" type="checkbox">
								                		</td>
								                		
								                	 							                		
								                	</tr>
								                </table>
							                    </div>
							                    
							                    <br>
							               </div>
	
											<div class="option clearfix">
							                    <input name="camp_options[]"   value="OPT_MUST_CONTENT" type="checkbox">
							                    <span class="option-title">
														Skip posts with no content   
							                    </span>
							                    <br>
							                </div>
							                
							                 
								               <div class="option clearfix">
								                    
								                    <input name="camp_options[]"  data-controls="limit_min_length_c"   value="OPT_MIN_LENGTH" type="checkbox">
								                    <span class="option-title">
															Skip posts if shorter than a specific length
								                    </span>
								                    <br>
								                    
										            <div id="limit_min_length_c" class="field f_100">
										               <label>
										                    Minimum number of characters ?
										               </label>
										               
										                <input value="<?php echo @$camp_general['cg_min_length']   ?>" max="20000" min="0" name="cg_min_length" required="required" class="ttw-range range" id="cg_min_length" type="range">
										               
										            </div>
										            
								               </div>
										  					                
							               
							               		               
							                 <div class="option clearfix">
							                    <input name="camp_options[]"   value="OPT_MUST_IMAGE" type="checkbox">
							                    <span class="option-title">
														Skip posts without images   
							                    </span>
							                    <br>
							               </div>
							               
							                 
							                <div class="option clearfix">
								                    <input name="camp_options[]"   value="OPT_FEED_REVERSE" type="checkbox">
								                    <span class="option-title">
															Process items from bottom to top instead    
								                    </span>
								                    <br>
								             </div>
								             
								              <div class="option clearfix">
								                    <input name="camp_options[]"   value="OPT_FEED_ENTITIES" type="checkbox">
								                    <span class="option-title">
															Decode html entities
								                    </span>
								                    <br>
								             </div>
								             
								             <div class="option clearfix">
								                    <input data-controls="convert_encoding_div" name="camp_options[]"   value="OPT_FEED_CONVERT_ENC" type="checkbox">
								                    <span class="option-title">
															Convert encoding before posting (in case content is not utf-8 encoded)
								                    </span>
								                    
								                    <div id="convert_encoding_div" class="field f_100">
								                    	 
								                    	  <label>
										                    Source encoding (example: "CP1256" or "Windows-1252" etc) 
										                  </label>
										                  
										                  <input value="<?php echo @$camp_general['cg_feed_encoding']  ?>" name="cg_feed_encoding"   type="text">
										             	
								                    </div>
								                    
								                    <br>
								             </div>
								             
								              <div class="option clearfix">
								                    <input name="camp_options[]"   value="OPT_FEED_ENCODING" type="checkbox">
								                    <span class="option-title">
															Clean cURL encoding value (becase at rare cases content get returned deformed.)
								                    </span>
								                    <br>
								             </div>
								             
								             <div class="option clearfix">
								                    <input name="camp_options[]"   value="OPT_ENCLUSURE" type="checkbox">
								                    <span class="option-title">
															Don't extract enclosure image (By default it get appended to the post top if no image exists)
								                    </span>
								                    <br>
								             </div>
								             
								              
								             
								             <div class="option clearfix">
								                    <input name="camp_options[]"   value="OPT_FEED_FORCE" type="checkbox">
								                    <span class="option-title">
															Don't try to find feed url, the added url is already a feed url (not recommended)
								                    </span>
								                    <br>
								             </div>
								             
								              <div class="option clearfix">
								                    <input name="camp_options[]"   value="OPT_FEED_SCRIPT" type="checkbox">
								                    <span class="option-title">
															Don't strip script tags
								                    </span>
								                    <br>
								             </div>
								             
								             <div class="option clearfix">
								                    <input name="camp_options[]"   value="OPT_FEED_TITLE_NO" type="checkbox">
								                    <span class="option-title">
															Don't try to get original title from the original post and use what is in the feed.
								                    </span>
								                    <br>
								             </div>
								             
								             <div class="option clearfix">
								                    <input name="camp_options[]"   value="OPT_FEED_LAZY" type="checkbox">
								                    <span class="option-title">
															Fix images lazy loading 
								                    </span>
								                    <br>
								             </div>
								             
				               
						 </div>
		          
		          
		          </div>
               
               
               </div>
               
		 </div>
		 <!-- /feed part -->
		 
		 
		 <!-- Craigslist part -->
		 
		 <div  class="field f_100 typepart Craigslist"  style="display:none">
		 
		 	   <label>
                    Craigslist items page url
               </label>
               
			   <input value="<?php echo @$camp_general['cg_cl_page']  ?>" name="cg_cl_page"   type="text">
			   
			    <div  class="field f_100">
			    
				    <div class="option clearfix">
	                    <input name="camp_options[]" value="OPT_CL_CACHE" type="checkbox">
	                    <span class="option-title">
								Cache items for faster posting  (uncheck to call Craigslist each post)
	                    </span>
	                    <br>
	          		</div>
	          		
	          		
	          		
	          		<div class="option clearfix">
	                    <input name="camp_options[]" value="OPT_CL_IMG" type="checkbox">
	                    <span class="option-title">
								Skip posts with no images
	                    </span>
	                    <br>
	          		</div>
	          		
	          		<div class="option clearfix">
	                    <input name="camp_options[]" value="OPT_CL_TIME" type="checkbox">
	                    <span class="option-title">
								Post items with it's original time
	                    </span>
	                    <br>
	          		</div>
	          		
	          	</div>	
		 
		 </div>
		 
		 <!--  /Craigslist -->
		 
		 <!-- Walmart part -->
		 <div  class="field f_100 typepart Walmart"  style="display:none">
		 
		 	<div class="option clearfix">
				<input name="camp_options[]" value="OPT_WM_CACHE" type="checkbox"> 
				<span class="option-title">Cache items for faster posting</span>
			</div>

		 
		 	<div class="option clearfix">
                    <input data-controls="wm_cat_c" name="camp_options[]" value="OPT_WM_CAT" type="checkbox">
                    <span class="option-title">
							Search a specific category
                    </span>
                    <br>
                    
                    <div id="wm_cat_c" class="field f_100">
		              	<label>
			              	Category ID
		              	</label>

		                <input   value="<?php echo  @$camp_general['cg_wm_cat']   ?>" name="cg_wm_cat" type="text">
		                
		                <div class="description">Ex add "91083_1074767_4623199" without quotes for "Auto Paint" Category. Check list of IDs <a target="blank" href="http://pastebin.com/56JC4xrB">here</a></div>  
		            	
		              </div>
                    
               </div>
               
               
               <div class="option clearfix">
                    <input data-controls="wm_sort_c" name="camp_options[]" value="OPT_WM_ORDER" type="checkbox">
                    <span class="option-title">
							Set search order
                    </span>
                    <br>
                    
                    <div id="wm_sort_c" class="field f_100">
                    
                       <label>
		                    Sort order
		               </label>
		               <select name="cg_wm_sort">
		               
		                    <option value="relevance"  <?php @wp_automatic_opt_selected('relevance',$camp_general['cg_wm_sort']) ?> >
		                         Relevance
		                    </option>
		                    
		                    <option value="price" <?php @wp_automatic_opt_selected('price',$camp_general['cg_wm_sort']) ?>>Price</option>
		                    <option value="title" <?php @wp_automatic_opt_selected('title',$camp_general['cg_wm_sort']) ?>>Title</option>
		                    <option value="bestseller" <?php @wp_automatic_opt_selected('bestseller',$camp_general['cg_wm_sort']) ?>>Best Seller</option>
		                    <option value="customerRating" <?php @wp_automatic_opt_selected('customerRating',$camp_general['cg_wm_sort']) ?>>Customer Rating</option>
		                    <option value="New" <?php @wp_automatic_opt_selected('New',$camp_general['cg_wm_sort']) ?>>New</option>

		               </select>
		               
		               <label>Sorting Direction</label>
					   <select name="cg_wm_sort_dir">
						
							<option value="asc" <?php @wp_automatic_opt_selected('asc',$camp_general['cg_wm_sort_dir']) ?>>Asc</option>
							<option value="desc" <?php @wp_automatic_opt_selected('desc',$camp_general['cg_SRC_NAME']) ?>>Desc</option>

					   </select>
					   
					   
						                    
		            </div>
                    
               </div>
               
               
               <div class="option clearfix">
                    
		        <input data-controls="WM_RANGE_c" name="camp_options[]" value="OPT_WM_RANGE" type="checkbox">
		        <span class="option-title">
						Set a price range
		        </span>
		        <br>
		        
		        <div id="WM_RANGE_c" class="field f_100">
		        	
		        	<label>From</label> <input  style="width:100px"   class="no-unify" value="<?php  echo @$camp_general['cg_wm_price_from']   ?>" name="cg_wm_price_from" type="text">
		        	<label>To</label> <input  style="width:100px"  class="no-unify" value="<?php  echo @$camp_general['cg_wm_price_to']   ?>" name="cg_wm_price_to" type="text">
		         
		       </div>
                    
			</div>
               
		 	
		 
		 </div>
		 <!-- /Reddit part -->
		 
		 
		  <!-- Reddit part -->
		 
		 <div  class="field f_100 typepart Reddit"  style="display:none">
		 
		 	   <label>
                    Reddits items page url
               </label>
               
			   <input value="<?php echo @$camp_general['cg_rd_page']  ?>" name="cg_rd_page"   type="text">
			   <div class="description">without any parametesrs ex: https://www.reddit.com/r/popular/</div>
			   
			    <div  class="field f_100">
			    
				    <div class="option clearfix">
	                    <input name="camp_options[]" value="OPT_RD_CACHE" type="checkbox">
	                    <span class="option-title">
								Cache items for faster posting  (uncheck to call Reddit each post)
	                    </span>
	                    <br>
	          		</div>
	          		
	          		<div class="option clearfix">
	                    <input name="camp_options[]" value="OPT_RD_IMG" type="checkbox">
	                    <span class="option-title">
								Skip posts with no images
	                    </span>
	                    <br>
	          		</div>
	          		
	          		<div class="option clearfix">
	                    <input name="camp_options[]" value="OPT_RD_TIME" type="checkbox">
	                    <span class="option-title">
								Post items with it's original time
	                    </span>
	                    <br>
	          		</div>
	          		
	          		<div class="option clearfix">
	                    <input name="camp_options[]" value="OPT_RD_COMMENT" type="checkbox">
	                    <span class="option-title">
								Post original comments as wordpress comments
	                    </span>
	                    <br>
	          		</div>
	          		
	          		
	          		 <div class="option clearfix">
	                    <input data-controls="wp_automatic_post_filter_rd" name="camp_options[]"   value="OPT_RD_POST_FILTER" type="checkbox">
	                    <span class="option-title">
								Post a specific type of posts   
	                    </span>
	                    
	                    <br>
	                    
	                    <div id="wp_automatic_post_filter_rd" class="field f_100">
	                		
	                		
	                		<div class="option clearfix">
					                    <input name="camp_options[]"   value="OPT_RD_POST_LINK" type="checkbox">
					                    <span class="option-title">
												link  
					                    </span>
					                    <br>
					        </div>
					        
					        <div class="option clearfix">
					                    <input name="camp_options[]"   value="OPT_RD_POST_IMAGE" type="checkbox">
					                    <span class="option-title">
												Image  
					                    </span>
					                    <br>
					         </div>
	                		
	                		<div class="option clearfix">
					                    <input name="camp_options[]"   value="OPT_RD_POST_VID" type="checkbox">
					                    <span class="option-title">
												Gifs and videos  
					                    </span>
					                    <br>
					         </div>
					         
					         <div class="option clearfix">
					                    <input name="camp_options[]"   value="OPT_RD_POST_TXT" type="checkbox">
					                    <span class="option-title">
												Text only posts  
					                    </span>
					                    <br>
					         </div> 					          
	                    	 
	                    </div>
	                    
	          </div>
	          		
	          	</div>	
		 
		 </div>
		 
		 <!--  /Craigslist -->
		 
		 <!-- Itunes part -->
		 
		 <div  class=" field f_100 typepart Itunes f_100"  style="display:none">
		 
		 	   
			    <div  class="field">

					 	<label>
					 		Media Type :
					 	</label>

					 	<select id="cg_iu_media" class="templateChanger" data-filters = "#cg_iu_attribute" name="cg_iu_media">

							<option  value="music"  <?php @wp_automatic_opt_selected('music',$camp_general['cg_iu_media']) ?> >Music</option>
							<option  value="movie"  <?php @wp_automatic_opt_selected('movie',$camp_general['cg_iu_media']) ?> >Movie</option>
							<option  value="podcast"  <?php @wp_automatic_opt_selected('podcast',$camp_general['cg_iu_media']) ?> >Podcast</option>
							<option  value="musicVideo"  <?php @wp_automatic_opt_selected('musicVideo',$camp_general['cg_iu_media']) ?> >Music Video</option>
							<option  value="audiobook"  <?php @wp_automatic_opt_selected('audiobook',$camp_general['cg_iu_media']) ?> >Audio Book</option>
							<option  value="shortFilm"  <?php @wp_automatic_opt_selected('shortFilm',$camp_general['cg_iu_media']) ?> >Short Film</option>
							<option  value="tvShow"  <?php @wp_automatic_opt_selected('tvShow',$camp_general['cg_iu_media']) ?> >Tv Show</option>
							<option  value="software"  <?php @wp_automatic_opt_selected('software',$camp_general['cg_iu_media']) ?> >Software</option>
							<option  value="ebook"  <?php @wp_automatic_opt_selected('ebook',$camp_general['cg_iu_media']) ?> >eBook</option>

					 	</select>
	          		
	          	</div>
	          	
	          	
	          	<div  class="field">

					 	<label>
					 		Search Attribute :
					 	</label>

					 	<select id="cg_iu_attribute" name="cg_iu_attribute" class="no-unify">
							 <?php 
							 	
							 	$medias = explode(',', "movie, podcast, music, musicVideo, audiobook, shortFilm, tvShow, software,ebook");

							 	$attributes['movie']   = "actorTerm, genreIndex, artistTerm, shortFilmTerm, producerTerm, ratingTerm, directorTerm, releaseYearTerm, featureFilmTerm, movieArtistTerm, movieTerm, ratingIndex, descriptionTerm";
							 	$attributes['podcast'] = "titleTerm, languageTerm, authorTerm, genreIndex, artistTerm, ratingIndex, keywordsTerm, descriptionTerm";
							 	$attributes['music']   = "mixTerm, genreIndex, artistTerm, composerTerm, albumTerm, ratingIndex, songTerm";
							 	$attributes['musicVideo']   = "genreIndex, artistTerm, albumTerm, ratingIndex, songTerm";
							 	$attributes['audiobook']   = "titleTerm, authorTerm, genreIndex, ratingIndex";
							 	$attributes['shortFilm']   = "genreIndex, artistTerm, shortFilmTerm, ratingIndex, descriptionTerm";
							 	$attributes['software']   = "softwareDeveloper";
							 	$attributes['tvShow']   = "genreIndex, tvEpisodeTerm, showTerm, tvSeasonTerm, ratingIndex, descriptionTerm";
							 	$attributes['ebook']   = "genreIndex, authorTerm";
							 	
							 	
							 	foreach($medias as $media){
							 		
							 		$media = trim($media);
							 		
							 		$mediaAttributes = 'All,'.$attributes[$media];
							 		$mediaAttributes = explode(',', $mediaAttributes);
							 		 
							 		
							 		foreach ($mediaAttributes as $mediaAttribute){

							 			$mediaAttribute = trim($mediaAttribute);

							 			wp_automatic_opt_display($mediaAttribute, $mediaAttribute, $camp_general['cg_iu_attribute'],$media);
							 		
							 		}
							 		 
							 	}
							 	
							 ?>
					 	</select>
	          		
	          	</div>
	          	
	          	
	          	<div class="field f_100">
		          		<div class="option clearfix">
		                    <input name="camp_options[]" value="OPT_IU_CACHE" type="checkbox">
		                    <span class="option-title">
									Cache items for faster posting  (uncheck to call Itunes each post)
		                    </span>
		                    <br>
		          		</div>
		          		
		          		<div class="option clearfix">
		                    <input data-controls="wp_iu_country" name="camp_options[]"  value="OPT_IU_COUNTRY" type="checkbox">
		                    <span class="option-title">
									Specify a country 
		                    </span>
		                    <br>
		                    
		                    <div id="wp_iu_country" class="field f_100">
		                    	<lable>Language code</lable>
		                    	
		                    	<input value="<?php echo @$camp_general['cg_iu_lang']  ?>"   name="cg_iu_lang"  type="text">
		                    	<div class="description"><i>Check list <a href="http://en.wikipedia.org/wiki/%20ISO_3166-1_alpha-2">here</a></i></div>
	                    	
	                 		</div>
		 	 	
		 	 			</div>
		          			
	          	</div>
		 
		 </div>
		 
		 <!--  /Itunes -->
		 
		 <div class= "field f_100 typepart Envato" style="display:none">
		 
		 		<select id="cg_ev_filter" class="templateChanger" name="cg_ev_filter" >
                    
                    <option  value="themeforest"  <?php @wp_automatic_opt_selected('themeforest',$camp_general['cg_ev_filter']) ?> >
                         themeforest
                    </option>
                    
                    <option  value="codecanyon"  <?php @wp_automatic_opt_selected('codecanyon',$camp_general['cg_ev_filter']) ?> >
                         codecanyon
                    </option>

                    <option  value="photodune"  <?php @wp_automatic_opt_selected('photodune',$camp_general['cg_ev_filter']) ?> >
                         photodune
                    </option>
                    
                    <option  value="videohive"  <?php @wp_automatic_opt_selected('videohive',$camp_general['cg_ev_filter']) ?> >
                         videohive
                    </option>
                    
                    <option  value="audiojungle"  <?php @wp_automatic_opt_selected('audiojungle',$camp_general['cg_ev_filter']) ?> >
                         audiojungle
                    </option>
                    
                    <option  value="graphicriver"  <?php @wp_automatic_opt_selected('graphicriver',$camp_general['cg_ev_filter']) ?> >
                         graphicriver
                    </option>
                    
                    <option  value="3docean"  <?php @wp_automatic_opt_selected('3docean',$camp_general['cg_ev_filter']) ?> >
                         3docean
                    </option>
                </select>
                
                
			   <div  class="field f_100">
			   
			   	   <div class="option clearfix">
	                    <input data-controls-r=''  name="camp_options[]"  value="OPT_EV_NOKEY" type="checkbox">
	                    <span class="option-title">
								Don't use keywords to filter items
	                    </span>
	               </div>
			   
	               <div class="option clearfix">
	                    <input name="camp_options[]"  value="OPT_EV_AUTO_TAGS" type="checkbox">
	                    <span class="option-title">
								Post original tags as wordpress tags
	                    </span>
	               </div>
	               
	               <div class="option clearfix">
                    <input name="camp_options[]" value="OPT_EV_CACHE" type="checkbox">
                    <span class="option-title">
							Cache Items for faster posting  (uncheck to call Envato each post)
                    </span>
                    <br>
                    
             	  </div>
             	  
             	  <div class="option clearfix">
	                    
	                    <input name="camp_options[]"  data-controls="post_ev_categories" value="OPT_EV_CAT" type="checkbox">
	                    <span class="option-title">
								Post items from a specific category
	                    </span>
	                    <br>
	                    
			            <div id="post_ev_categories" class="field f_100">
			               <label for="field6">
			                    Category code
			               </label>
			               
			                <input value="<?php  echo @$camp_general['cg_ev_cat']   ?>"  name="cg_ev_cat" type="text">
			                <div class="description">For example add "wordpress" for this <a href="https://themeforest.net/category/wordpress">category</a></div>
			            </div>
			            
	               </div>
	               
	               <div class="option clearfix">
	                    
	                    <input name="camp_options[]"  data-controls="post_ev_tags" value="OPT_EV_TAGS" type="checkbox">
	                    <span class="option-title">
								Post items containing a specific tag
	                    </span>
	                    <br>
	                    
			            <div id="post_ev_tags" class="field f_100">
			               <label for="field6">
			                    tags list comma separated
			               </label>
			               
			                <input value="<?php  echo @$camp_general['cg_ev_tags']   ?>"  name="cg_ev_tags" type="text">
			               
			            </div>
			            
	               </div>
	               
	               <div class="option clearfix">
	                    
	                    <input name="camp_options[]"  data-controls="post_ev_author" value="OPT_EV_AUTHOR" type="checkbox">
	                    <span class="option-title">
								Post items from a specific author
	                    </span>
	                    <br>
	                    
			            <div id="post_ev_author" class="field f_100">
			               <label for="field6">
			                    Author username
			               </label>
			               
			                <input value="<?php  echo @$camp_general['cg_ev_author']   ?>"  name="cg_ev_author" type="text">
			                <div class="description">For example add "themefusion" for this <a href="https://themeforest.net/user/themefusion">Author</a></div>
			            </div>
			            
	               </div>
	               
			   </div> 
			    
			  
			 
			 <div class="field f_100">
               <label for="field1zz">
                    Sort by
               </label>
               <select name="cg_ev_sort">
               		
               		<option value="" ></option>
               		
                    <option value="following"  <?php @wp_automatic_opt_selected('following',$camp_general['cg_ev_sort']) ?> >
                         Following
                    </option>
                    <option value="relevance"  <?php @wp_automatic_opt_selected('relevance',$camp_general['cg_ev_sort']) ?>  >
                         Relevance
                    </option>
                    <option value="rating"  <?php @wp_automatic_opt_selected('rating',$camp_general['cg_ev_sort']) ?>  >
                         Rating
                    </option> 
                    <option value="sales"  <?php @wp_automatic_opt_selected('sales',$camp_general['cg_ev_sort']) ?>  >
                         Sales
                    </option>
                    <option value="rating"  <?php @wp_automatic_opt_selected('rating',$camp_general['cg_ev_sort']) ?>  >
                         Rating
                    </option>
                    <option value="price"  <?php @wp_automatic_opt_selected('price',$camp_general['cg_ev_sort']) ?>  >
                         Price
                    </option>
                    <option value="date"  <?php @wp_automatic_opt_selected('date',$camp_general['cg_ev_sort']) ?>  >
                         Date
                    </option>
                    <option value="updated"  <?php @wp_automatic_opt_selected('updated',$camp_general['cg_ev_sort']) ?>  >
                         Updated
                    </option>
                    <option value="category"  <?php @wp_automatic_opt_selected('category',$camp_general['cg_ev_sort']) ?>  >
                         Category
                    </option>
                    <option value="name"  <?php @wp_automatic_opt_selected('name',$camp_general['cg_ev_sort']) ?>  >
                         Name
                    </option>
                    <option value="trending"  <?php @wp_automatic_opt_selected('trending',$camp_general['cg_ev_sort']) ?>  >
                         Trending
                    </option>
                    
                    
                    
                     
                </select>
             </div>
			 
			 <div class="field f_100">
               <label>
                    Sort Direction
               </label>
               <select name="cg_ev_sort_dir">
               
               		<option value="" ></option>
               		
                    <option value="asc"  <?php @wp_automatic_opt_selected('asc',$camp_general['cg_ev_sort_dir']) ?> >
                         asc
                    </option>
                    <option value="desc"  <?php @wp_automatic_opt_selected('desc',$camp_general['cg_ev_sort_dir']) ?>  >
                         desc
                    </option>
                      
                </select>
             </div>
			 
			 <div  class="field f_100">
	               <div class="option clearfix">
	                    
	                    <input name="camp_options[]"  data-controls="post_ev_api" value="OPT_EV_API" type="checkbox">
	                    <span class="option-title">
								append other api parameters (Advanced)
	                    </span>
	                    <br>
	                    
			            <div id="post_ev_api" class="field f_100">
			               <label>
			                    Parameters
			               </label>
			               
			                <input value="<?php  echo @$camp_general['cg_ev_api']   ?>"  name="cg_ev_api" type="text">
			                <div class="description">example  "&length_min=1:00&length_max=5:00" This part will be appended to the request to Envato check allowed parameters <a href="https://build.envato.com/api/#search_GET_search_item_json">here</a></div>
			            </div>
			            
	               </div>
			 </div>
			 
                
		 
		 </div>
		 
		 <!--  Facebook part -->
		 
		 <div  class="field f_100 typepart Facebook"  style="display:none">
		 
			   <label>
                    Page or Public Group ?
               </label>
               
               <select name="cg_fb_source" >
                    
                    <option  value="page"  <?php @wp_automatic_opt_selected('page',$camp_general['cg_fb_source']) ?> >
                         Page
                    </option>
 
                    <option  value="group"  <?php @wp_automatic_opt_selected('group',$camp_general['cg_fb_source']) ?>  >
                         Public Group
                    </option> 
                    
                </select>
		 
		 
			 <label>
			                    Facebook Page/Public Group url or Numeric ID 
			 </label>
			 
			 <input value="<?php echo @$camp_general['cg_fb_page']  ?>" name="cg_fb_page"   type="text">
			 <input value="<?php echo @$camp_general['cg_fb_page_id']  ?>" name="cg_fb_page_id"   type="hidden" >
			 <div class="description"><a href="http://valvepress.com/?p=565" target="_blank">How to get the id?</a></div>
			            
 
		 
		 
		 
		 <div  class="field f_100">
		 	 
			  <div class="option clearfix">
	                    <input name="camp_options[]"   value="OPT_ORIGINAL_FB_TIME" type="checkbox">
	                    <span class="option-title">
								Add posts with it's original time   
	                    </span>
	                    <br>
	          </div>
	          
	          <div class="option clearfix">
	                    <input data-controls="wp_automatic_post_filter_div" name="camp_options[]"   value="OPT_FB_POST_FILTER" type="checkbox">
	                    <span class="option-title">
								Post a specific type of posts   
	                    </span>
	                    
	                    <br>
	                    
	                    <div id="wp_automatic_post_filter_div" class="field f_100">
	                		
	                		
	                		<div class="option clearfix">
					                    <input name="camp_options[]"   value="OPT_FB_POST_link" type="checkbox">
					                    <span class="option-title">
												link  
					                    </span>
					                    <br>
					          </div>
	                		
	                		<div class="option clearfix">
					                    <input name="camp_options[]"   value="OPT_FB_POST_photo" type="checkbox">
					                    <span class="option-title">
												Photo  
					                    </span>
					                    <br>
					          </div>
					          
					          <div class="option clearfix">
					                    <input name="camp_options[]"   value="OPT_FB_POST_album" type="checkbox">
					                    <span class="option-title">
												Photo Album  
					                    </span>
					                    <br>
					          </div>
					                    
					          <div class="option clearfix">          
					                    <input name="camp_options[]"   value="OPT_FB_POST_video" type="checkbox">
					                    <span class="option-title">
												Video   
					                    </span>
					                    <br>
					           </div>
					           
					            <div class="option clearfix">
					                    <input name="camp_options[]"   value="OPT_FB_POST_status" type="checkbox">
					                    <span class="option-title">
												Status  
					                    </span>
					                    <br>
					          </div>         
					                 
					          <div class="option clearfix">
					                    <input name="camp_options[]"   value="OPT_FB_POST_event" type="checkbox">
					                    <span class="option-title">
												Event  
					                    </span>
					                    <br>
					          </div>
					          
					          <div class="option clearfix">
					                    <input name="camp_options[]"   value="OPT_FB_POST_offer" type="checkbox">
					                    <span class="option-title">
												Offer  
					                    </span>
					                    <br>
					          </div>      
					          
	                    	 
	                    </div>
	                    
	          </div>
	          
	          
	          <div class="option clearfix">
	                    <input data-controls="wp_fb_title_count" name="camp_options[]"   value="OPT_GENERATE_FB_TITLE" type="checkbox">
	                    <span class="option-title">
								Auto generate title from content for posts with no title    
	                    </span>
	                    <br>
	                    
	                    <div id="wp_fb_title_count" class="field f_100">
                    	
                    	<lable>Limit title to x chars (default is 80 )</lable>
                    	<input value="<?php echo @$camp_general['cg_fb_title_count']  ?>" placeholder="80" name="cg_fb_title_count"  type="text">
	                    
	                    <div class="option clearfix">
		                    <input  name="camp_options[]"   value="OPT_GENERATE_FB_RETURN" type="checkbox">
		                    <span class="option-title">
									Stop at line breaks (i.e take the title before a new line)    
		                    </span>
	                    </div>
	                    
	                    <div class="option clearfix">
		                    <input  name="camp_options[]"   value="OPT_GENERATE_FB_DOT" type="checkbox">
		                    <span class="option-title">
									Don't add "..." after generated title    
		                    </span>
	                    </div>
	                    
	                    <br>
	                    	
	                    </div>
	          </div>
	          
	         <div class="option clearfix">
	                    <input name="camp_options[]"   value="OPT_FB_COMMENT" type="checkbox">
	                    <span class="option-title">
								Post FB comments as comments    
	                    </span>
	                    <br>
	          </div> 
	          
	          <div class="option clearfix">
	                    <input name="camp_options[]"   value="OPT_FB_TITLE_SKIP" type="checkbox">
	                    <span class="option-title">
								Skip posts with no title     
	                    </span>
	                    <br>
	          </div>
	          
	          <div class="option clearfix">
	                    <input name="camp_options[]"   value="OPT_FB_TXT_SKIP" type="checkbox">
	                    <span class="option-title">
								Strip textual content     
	                    </span>
	                    <br>
	          </div>
	          
	          
	          <div class="option clearfix">
	                    <input name="camp_options[]"   value="OPT_FB_IMG_SKIP" type="checkbox">
	                    <span class="option-title">
								Skip posts with no Image     
	                    </span>
	                    <br>
	          </div>
	          
	          <div class="option clearfix">
	                    <input name="camp_options[]"   value="OPT_FB_VID_IMG_HIDE" type="checkbox">
	                    <span class="option-title">
								Hide video image from the post     
	                    </span>
	                    <br>
	          </div>
	          
	           <div class="option clearfix">
	                    <input name="camp_options[]"   value="OPT_FB_IMG_BTM" type="checkbox">
	                    <span class="option-title">
								Images at the bottom (By default on top)     
	                    </span>
	                    <br>
	          </div>
	          
	          <div class="option clearfix">
	                    <input name="camp_options[]"   value="OPT_FB_IMG_LNK_DISABLE" type="checkbox">
	                    <span class="option-title">
								Don't link images to it's src     
	                    </span>
	                    <br>
	          </div>
	          
	          <div class="option clearfix">
	                    <input name="camp_options[]"   value="OPT_FB_CACHE" type="checkbox">
	                    <span class="option-title">
								Cache items for faster posting ( Disabling this option posts from latest 100 only )   
	                    </span>
	                    <br>
	          </div>
	          
	          <div class="option clearfix">
	                    <input name="camp_options[]" value="OPT_FB_OLD" type="checkbox">
	                    <span class="option-title">
								Post old posts as well (By default it posts from latest 100)(cache option must be enabled)
	                    </span>
	                    <br>
	          </div>
	          
          </div>
		 </div>
		 <!--  /Facebook part -->
		 
		 
		 <!-- amazon part -->
		 
		 
          <div id="field1zz-container" class="field f_100 typepart Amazon"  style="display:none">
          
          
          		<?php 
		     	
		     	// supported  ext http://docs.aws.amazon.com/AWSECommerceService/latest/DG/Locales.html
		     	
		     	?>	
 		        
 		        <label for="field1zzg">
                    Amazon site extention (region) :
               </label>
               <select data-filters="#field_amazon_cat" name="camp_amazon_region" id="field1zzg">
							 <option  value="com"  <?php @wp_automatic_opt_selected('com',$camp_amazon_region) ?> >amazon.com</option> 
							 <option  value="co.uk"  <?php @wp_automatic_opt_selected('co.uk',$camp_amazon_region) ?> >amazon.co.uk</option>
							 <option  value="ca"  <?php @wp_automatic_opt_selected('ca',$camp_amazon_region) ?> >amazon.ca</option>
							 <option  value="de"  <?php @wp_automatic_opt_selected('de',$camp_amazon_region) ?> >amazon.de</option>
							 <option  value="fr"  <?php @wp_automatic_opt_selected('fr',$camp_amazon_region) ?> >amazon.fr</option>
							 <option  value="it"  <?php @wp_automatic_opt_selected('it',$camp_amazon_region) ?> >amazon.it</option>
							 <option  value="es"  <?php @wp_automatic_opt_selected('es',$camp_amazon_region) ?> >amazon.es</option>
							 <option  value="cn"  <?php @wp_automatic_opt_selected('cn',$camp_amazon_region) ?> >amazon.cn</option>
							 <option  value="co.jp"  <?php @wp_automatic_opt_selected('co.jp',$camp_amazon_region) ?> >amazon.co.jp</option>
							 <option  value="in"  <?php @wp_automatic_opt_selected('in',$camp_amazon_region) ?> >amazon.in</option>
							 <option  value="com.br"  <?php @wp_automatic_opt_selected('com.br',$camp_amazon_region) ?> >amazon.com.br</option>
							  <option  value="com.mx"  <?php @wp_automatic_opt_selected('com.mx',$camp_amazon_region) ?> >amazon.com.mx</option>
							  
 		        </select>
          
          
               <label for="field1zz">
                    Amazon category (also named Search Index) : 
               </label>
               <select  class="no-unify" name="camp_amazon_cat" id="field_amazon_cat">
              
              				<?php
              					
              					foreach ($searchIndex as $key => $mainIndex){
									$catNames = $mainIndex[0];
									$catVals  = $mainIndex[1];
									
									$i=0;
									foreach ($catNames as $catName){
										 
										if( trim($catName) == '' ){
											$catName = $catVals[$i];
										}  
										
										echo '<option data-filter-val="'.$key.'" value = "'.$catVals[$i].'" ';
										
										if($camp_amazon_region == $key){
											@wp_automatic_opt_selected( $catVals[$i] ,$camp_amazon_category);
										}
										
										echo '>'.$catName . '</option>';
										$i++;
									}
              					}
              				?>
								
								
								              
							 
 		        </select>
 		        
 		      <div  class="field f_100">
               <div class="option clearfix">
                    
                    <input name="camp_options[]" id="amazon_node" data-controls="amazon_node_c" value="OPT_AMAZON_NODE" type="checkbox">
                    <span class="option-title">
							Specify a browse node 
                    </span>
                    <br>
                    
		            <div id="amazon_node_c" class="field f_100">
		               <label>
		                    Browse Node ID (click <a href="http://www.findbrowsenodes.com/">here</a> to get browse node id's) (You must select the right category above matching this node)
		               </label>
		               <input value="<?php echo @$camp_general['cg_am_node']  ?>" name="cg_am_node"   type="text">
		            
		            	
		            	<div class="field f_100">
		            	<input  data-controls-r='' name="camp_options[]" id="amazon_full" value="OPT_AM_FULL" type="checkbox">
		                    <span class="option-title">
									Don't use keywords add items from browse node without filtering . 
		                    </span>
	                    </div>
		            
		            </div>
		            
               </div>
               
               <div class="option clearfix">
                    <input id="am_order" data-controls="am_order_c" name="camp_options[]" value="OPT_AM_ORDER" type="checkbox">
                    <span class="option-title">
							Set items search order
                    </span>
                    <br>
                    
                    <div id="am_order_c" class="field f_100">
		              	<label>
		              	Order (Click <a href="http://docs.aws.amazon.com/AWSECommerceService/latest/DG/APPNDX_SortValuesArticle.html" target="_blank" >here</a> to get allowed search orders for each amazon site. Make sure the search order is allowed in the Category (Search Index) you choose  ) example: salesrank
		              	</label>
		                <input   value="<?php echo  @$camp_general['cg_am_order']   ?>" name="cg_am_order"    type="text">  
		            	
		            	
		              </div>
                    
               </div>
               
                <div class="option clearfix">
                    <input id="am_price" data-controls="am_price_c" name="camp_options[]" value="OPT_AM_PRICE" type="checkbox">
                    <span class="option-title">
							Price range in pennies. For example, 3241 represents $32.41.
                    </span>
                    <br>
                    
                    <div id="am_price_c" class="field f_100">
		              
		                From <input style="width:100px" class="no-unify" value="<?php echo  @$camp_general['cg_am_min']   ?>" name="cg_am_min"    type="text"> To <input style="width:100px" class="no-unify" value="<?php echo  @$camp_general['cg_am_max']   ?>" name="cg_am_max"    type="text">
		            	
		              </div>
                    
               </div>
               <div class="option clearfix">
                    
                    <input name="camp_options[]" id="amazon_param" data-controls="amazon_param_c" value="OPT_AMAZON_PARAM" type="checkbox">
                    <span class="option-title">
							Set a Search Criteria  
                    </span>
                    <br>
                    
		            <div id="amazon_param_c" class="field f_100">
		                
		                <?php 
		                	$params=array('Actor','Artist','AudienceRating','Author','Brand','Composer','Conductor','Director','Manufacturer','MusicLabel','Orchestra','Power','Publisher','Title');
		                ?>
		                
		                <div style="float:left;width:40%" >
			               	<select  name="cg_am_param_type" >
			               		<?php 
				               			foreach ($params as $param){
								?>
	
											<option  value="<?php echo $param ?>"  <?php @wp_automatic_opt_selected($param,$camp_general['cg_am_param_type']) ?> ><?php echo $param ?></option>
	
								<?php 
				               				
				               			}
			               		?>
			               		
			               		 
			               		 
			               	</select>
		                 </div>
		               
		                <div style="width:40%;float:left;margin-left:5px" >
		               		<input value="<?php echo @$camp_general['cg_am_param']  ?>" name="cg_am_param"   type="text">
		                </div>
		               
		               <div style="clear:both" class="description">
			               <p>Check <a target="_blank" href="http://docs.aws.amazon.com/AWSECommerceService/latest/DG/ItemSearch.html">parameters her</a> for meaning of each also make sure the parameter is allowed in the search index  <a  target="_blank"  href="http://docs.aws.amazon.com/AWSECommerceService/latest/DG/APPNDX_SearchIndexParamForItemsearch.html">here</a></p>
		               </div>
		               <input  data-controls-r='' name="camp_options[]"  value="cg_am_param_ex" type="checkbox">
		                    <span class="option-title">
									Don't use keywords just use this criteria . 
		                    </span>
		               
		            </div>
		            
               </div>
               
                  
               <div class="option clearfix">
                    <input name="camp_options[]"   value="OPT_AMAZON_MERCHANT" type="checkbox">
                    <span class="option-title">
							Only post items sold by Amazon (no merchants) 
                    </span>
                    <br>
               </div>
               
               <div class="option clearfix">
                    <input name="camp_options[]" data-controls="am_full_img_t"  value="OPT_AM_FULL_IMG" type="checkbox">

                    <span class="option-title">
							Modify item images html code
                    </span>
                    
                    <br>
                    
		            <div id="am_full_img_t" class="field f_100">
		               <label for="field6">
		                    Image template (this is how the plugin will build images html) for the [product_imgs_html] tag. Use [img_src] to replace the image src. use class="wp_automatic_gallery" to display images as gallery
		               </label>
		               
		                <input value="<?php  echo   (@$camp_general['cg_am_full_img_t'] )  ?>"  name="cg_am_full_img_t" type="text">
		               
		            </div>
               </div>
               
               
               <div class="option clearfix">
                    <input name="camp_options[]"   value="OPT_AM_GALLERY" type="checkbox">
                    <span class="option-title">
							Add item images as a woo-commerce product gallery 
                    </span>
                    <br>
               </div>
               
               
               <div class="option clearfix">
                    <input name="camp_options[]"   value="OPT_LINK_CHART" type="checkbox">
                    <span class="option-title">
							Make purchase link driectly to the amazon cart add page 
                    </span>
                    <br>
               </div>
               
               <div class="option clearfix">
                    <input name="camp_options[]"   value="OPT_AMAZON_EXCERPT" type="checkbox">
                    <span class="option-title">
							Set the product description as excerpt  
                    </span>
                    <br>
               </div>
               
		 </div>
 		        
          </div>
		 <!-- / amazon part -->
		 
		 <!-- Min date part -->
		 
		 <div id="yt_date_div" class="typepart Youtube Feeds Instagram Facebook Twitter SoundCloud DailyMotion field f_100">
               <div class="option clearfix">
                    
                    <input data-controls="yt_date_c" name="camp_options[]" id="yt_date" value="OPT_YT_DATE" type="checkbox">
                    <span class="option-title">
							Exclude Item if it is older than a specific date  
                    </span>
                    <br>
                    
		            <div id="yt_date_c" class="field f_100">
		               
		               <div id="yt_date_c_d" class="field f_100">
		                
		                Day:
						
						<select style="width:80px" class="no-unify" name="cg_yt_dte_day" >  
							<option value='01'  <?php @wp_automatic_opt_selected('01',$camp_general['cg_yt_dte_day']) ?> >01</option>
							<option value='02'  <?php @wp_automatic_opt_selected('02',$camp_general['cg_yt_dte_day']) ?> >02</option>
							<option value='03'  <?php @wp_automatic_opt_selected('03',$camp_general['cg_yt_dte_day']) ?> >03</option>
							<option value='04'  <?php @wp_automatic_opt_selected('04',$camp_general['cg_yt_dte_day']) ?> >04</option>
							<option value='05'  <?php @wp_automatic_opt_selected('05',$camp_general['cg_yt_dte_day']) ?> >05</option>
							<option value='06'  <?php @wp_automatic_opt_selected('06',$camp_general['cg_yt_dte_day']) ?> >06</option>
							<option value='07'  <?php @wp_automatic_opt_selected('07',$camp_general['cg_yt_dte_day']) ?> >07</option>
							<option value='08'  <?php @wp_automatic_opt_selected('08',$camp_general['cg_yt_dte_day']) ?> >08</option>
							<option value='09'  <?php @wp_automatic_opt_selected('09',$camp_general['cg_yt_dte_day']) ?> >09</option>
							<option value='10'  <?php @wp_automatic_opt_selected('10',$camp_general['cg_yt_dte_day']) ?> >10</option>
							<option value='11'  <?php @wp_automatic_opt_selected('11',$camp_general['cg_yt_dte_day']) ?> >11</option>
							<option value='12'  <?php @wp_automatic_opt_selected('12',$camp_general['cg_yt_dte_day']) ?> >12</option>
							<option value='13'  <?php @wp_automatic_opt_selected('13',$camp_general['cg_yt_dte_day']) ?> >13</option>
							<option value='14'  <?php @wp_automatic_opt_selected('14',$camp_general['cg_yt_dte_day']) ?> >14</option>
							<option value='15'  <?php @wp_automatic_opt_selected('15',$camp_general['cg_yt_dte_day']) ?> >15</option>
							<option value='16'  <?php @wp_automatic_opt_selected('16',$camp_general['cg_yt_dte_day']) ?> >16</option>
							<option value='17'  <?php @wp_automatic_opt_selected('17',$camp_general['cg_yt_dte_day']) ?> >17</option>
							<option value='18'  <?php @wp_automatic_opt_selected('18',$camp_general['cg_yt_dte_day']) ?> >18</option>
							<option value='19'  <?php @wp_automatic_opt_selected('19',$camp_general['cg_yt_dte_day']) ?> >19</option>
							<option value='20'  <?php @wp_automatic_opt_selected('20',$camp_general['cg_yt_dte_day']) ?> >20</option>
							<option value='21'  <?php @wp_automatic_opt_selected('21',$camp_general['cg_yt_dte_day']) ?> >21</option>
							<option value='22'  <?php @wp_automatic_opt_selected('22',$camp_general['cg_yt_dte_day']) ?> >22</option>
							<option value='23'  <?php @wp_automatic_opt_selected('23',$camp_general['cg_yt_dte_day']) ?> >23</option>
							<option value='24'  <?php @wp_automatic_opt_selected('24',$camp_general['cg_yt_dte_day']) ?> >24</option>
							<option value='25'  <?php @wp_automatic_opt_selected('25',$camp_general['cg_yt_dte_day']) ?> >25</option>
							<option value='26'  <?php @wp_automatic_opt_selected('26',$camp_general['cg_yt_dte_day']) ?> >26</option>
							<option value='27'  <?php @wp_automatic_opt_selected('27',$camp_general['cg_yt_dte_day']) ?> >27</option>
							<option value='28'  <?php @wp_automatic_opt_selected('28',$camp_general['cg_yt_dte_day']) ?> >28</option>
							<option value='29'  <?php @wp_automatic_opt_selected('29',$camp_general['cg_yt_dte_day']) ?> >29</option>
							<option value='30'  <?php @wp_automatic_opt_selected('30',$camp_general['cg_yt_dte_day']) ?> >30</option>
							<option value='31'  <?php @wp_automatic_opt_selected('31',$camp_general['cg_yt_dte_day']) ?> >31</option>
						</select>
						Month:
						<select  style="width:80px" class="no-unify"  name="cg_yt_dte_month" >
							<option value='01'  <?php @wp_automatic_opt_selected('01',$camp_general['cg_yt_dte_month']) ?> >January</option>
							<option value='02'  <?php @wp_automatic_opt_selected('02',$camp_general['cg_yt_dte_month']) ?> >February</option>
							<option value='03'  <?php @wp_automatic_opt_selected('03',$camp_general['cg_yt_dte_month']) ?> >March</option>
							<option value='04'  <?php @wp_automatic_opt_selected('04',$camp_general['cg_yt_dte_month']) ?> >April</option>
							<option value='05'  <?php @wp_automatic_opt_selected('05',$camp_general['cg_yt_dte_month']) ?> >May</option>
							<option value='06'  <?php @wp_automatic_opt_selected('06',$camp_general['cg_yt_dte_month']) ?> >June</option>
							<option value='07'  <?php @wp_automatic_opt_selected('07',$camp_general['cg_yt_dte_month']) ?> >July</option>
							<option value='08'  <?php @wp_automatic_opt_selected('08',$camp_general['cg_yt_dte_month']) ?> >August</option>
							<option value='09'  <?php @wp_automatic_opt_selected('09',$camp_general['cg_yt_dte_month']) ?> >September</option>
							<option value='10'  <?php @wp_automatic_opt_selected('10',$camp_general['cg_yt_dte_month']) ?> >October</option>
							<option value='11'  <?php @wp_automatic_opt_selected('11',$camp_general['cg_yt_dte_month']) ?> >November</option>
							<option value='12'  <?php @wp_automatic_opt_selected('12',$camp_general['cg_yt_dte_month']) ?> >December</option>
						</select>
						 Year:<input style="width:70px" class="no-unify" value="<?php echo $camp_general['cg_yt_dte_year']   ?>" name="cg_yt_dte_year"     type="text">
 		            
 		               </div>
 		            
 		            	<div class="option clearfix">
 		            	
		                     <span class="option-title">
									Exclude Item if specific time passed from publishing it.  
		                     </span>
	 		            	 
	 		            	 <input data-controls="yt_date_c_t" name="camp_options[]"   value="OPT_YT_DATE_T" type="checkbox">
		                     <br>
		                     
		                     <div id="yt_date_c_t" class="field f_100">
		                     	 
		                     	  <label>
					                    Minutes passed to skip
					              </label>
					              
					              <input value="<?php echo $camp_general['cg_yt_dte_minutes'] ?>" name="cg_yt_dte_minutes" type="text">
					              <div class="description">for example add "60" without quotes to skip posts posted more than 60 minutes ago. Above fixed date will be ignored.</div>
		                     	 
		                     </div>
	                     
	                     </div>
 		            	
 		            
 		            </div>
		            
               </div>
		 </div>
		 <!-- /date part -->
		 
		 <!--  skip non english posts part -->
		 <div class="typepart Feeds Youtube  field f_100">
		 
		 	<div class="option clearfix">
                    <input name="camp_options[]"   value="OPT_MUST_ENGLISH" type="checkbox">
                    <span class="option-title">
							Set non English posts status as pending (Guessing)   
                    </span>
                    <br>
             </div>
		 
		 </div>
		 <!-- /non english part -->
		 
		 
		 
		 <!--  Vimeo Part -->
		 
		 <div class="typepart Vimeo" style="display:none">
		 

		 
		 <div id="vm_user_div" class="field f_100">
               <div class="option clearfix">
                    
                    <input data-controls="vm_user_c" name="camp_options[]" id="vm_user" value="OPT_VM_USER" type="checkbox">
                    <span class="option-title">
							Post from specific vimeo user/channel/album 
                    </span>
                    <br>
                    
		            <div id="vm_user_c" class="field f_100">
		               
		               	<label>
					 		User or Channel or Album ? :
					 	</label>
					 	
					 	<select id="cg_vm_user_channel" name="cg_vm_user_channel" >
					 		<option  value="users"  <?php @wp_automatic_opt_selected('users',$camp_general['cg_vm_user_channel']) ?> >User</option>
					 		<option  value="channels"  <?php @wp_automatic_opt_selected('channels',$camp_general['cg_vm_user_channel']) ?> >Channel</option>
					 		<option  value="albums"  <?php @wp_automatic_opt_selected('albums',$camp_general['cg_vm_user_channel']) ?> >Album</option>
					 		
					 	</select>
		               
		               <label for="field6">
		                    User ID or channel ID or album ID
		               </label>
		                
		                <input id="cg_vm_user" value="<?php echo @$camp_general['cg_vm_user']   ?>" name="cg_vm_user"    type="text">
		                <div class="description">for example add "karimshaaban" for this <a href="https://vimeo.com/karimshaaban">user</a>. copy the value from the link or add "3270886" for this <a href="https://vimeo.com/album/3270886">album</a></div>
		                
		            	<br>
		            	<div class="field f_100">
		            	<input  data-controls-r='' name="camp_options[]" id="vm_full" value="OPT_VM_FULL" type="checkbox">
		                    <span class="option-title">
									Don't use keywords add videos without filtering . 
		                    </span>
	                    </div>
	                    <br>
		            </div>
		            
               </div>
		 </div>
		 
		 
		 
		 
		 <div   class="field f_100" >
		 	<label>
		 		Video search order :
		 	</label>
		 	
		 	<select id="cg_vm_order" name="cg_vm_order" >
		 		<option  value="relevant"  <?php @wp_automatic_opt_selected('relevant',$camp_general['cg_vm_order']) ?> >Relevant</option>
		 		<option  value="date"  <?php @wp_automatic_opt_selected('date',$camp_general['cg_vm_order']) ?> >Date</option>
		 		<option  value="alphabetical"  <?php @wp_automatic_opt_selected('alphabetical',$camp_general['cg_vm_order']) ?> >Alphabetical</option>
		 		<option  value="plays"  <?php @wp_automatic_opt_selected('plays',$camp_general['cg_vm_order']) ?> >Plays</option>
		 		<option  value="likes"  <?php @wp_automatic_opt_selected('likes',$camp_general['cg_vm_order']) ?> >Likes</option>
		 		<option  value="comments"  <?php @wp_automatic_opt_selected('comments',$camp_general['cg_vm_order']) ?> >Comments</option>
		 		<option  value="duration"  <?php @wp_automatic_opt_selected('duration',$camp_general['cg_vm_order']) ?> >Duration</option>
		 	</select>
		 </div>


		 <div   class="field f_100" >
		 	<label>
		 		Sorting direction :
		 	</label>
		 	
		 	<select id="cg_vm_order_dir" name="cg_vm_order_dir" >

		 		<option  value="desc"  <?php @wp_automatic_opt_selected('desc',$camp_general['cg_vm_order_dir']) ?> >DESC</option>
		 		<option  value="asc"  <?php @wp_automatic_opt_selected('asc',$camp_general['cg_vm_order_dir']) ?> >ASC</option>
		 		 
		 	</select>
		 </div>
		 
		  <div   class="field f_100" >
		 	<label>
		 		CC Filter
		 	</label>
		 	
		 	<select id="cg_vm_cc" name="cg_vm_cc" >

		 		<option  value="none"  <?php @wp_automatic_opt_selected('none',$camp_general['cg_vm_cc']) ?> >None</option>
		 		<option  value="CC"  <?php @wp_automatic_opt_selected('CC',$camp_general['cg_vm_cc']) ?> >CC</option>
		 		<option  value="CC-BY"  <?php @wp_automatic_opt_selected('CC-BY',$camp_general['cg_vm_cc']) ?> >CC-BY</option>
		 		<option  value="CC-BY-SA"  <?php @wp_automatic_opt_selected('CC-BY-SA',$camp_general['cg_vm_cc']) ?> >CC-BY-SA</option>
		 		<option  value="CC-BY-ND"  <?php @wp_automatic_opt_selected('CC-BY-ND',$camp_general['cg_vm_cc']) ?> >CC-BY-ND</option>
		 		<option  value="CC-BY-NC"  <?php @wp_automatic_opt_selected('CC-BY-NC',$camp_general['cg_vm_cc']) ?> >CC-BY-NC</option>
		 		<option  value="CC-BY-NC-SA"  <?php @wp_automatic_opt_selected('CC-BY-NC-SA',$camp_general['cg_vm_cc']) ?> >CC-BY-NC-SA</option>
		 		<option  value="CC-BY-NC-ND"  <?php @wp_automatic_opt_selected('CC-BY-NC-ND',$camp_general['cg_vm_cc']) ?> >CC-BY-NC-ND</option>
		 		<option  value="in-progress"  <?php @wp_automatic_opt_selected('in-progress',$camp_general['cg_vm_cc']) ?> >in-progress</option>
		 		  
		 	</select>
		 </div>
		 
	
		
		 <div class="field f_100">
		              
		                Player Width <input style="width:100px" class="no-unify" value="<?php echo  @$camp_general['cg_vm_width']   ?>" name="cg_vm_width"    type="text"> Height <input style="width:100px" class="no-unify" value="<?php echo  @$camp_general['cg_vm_height']   ?>" name="cg_vm_height"    type="text">
		            	
		 </div>
				  
         <div  class="field f_100">
                 
               <div class="option clearfix">
                    <input name="camp_options[]"   value="OPT_VM_ORIGINAL_TIME" type="checkbox">
                    <span class="option-title">
							Add posts with it's original time   
                    </span>
                    <br>
               </div>

               <div class="option clearfix">
                    <input name="camp_options[]"   value="OPT_VM_REVERSE" type="checkbox">
                    <span class="option-title">
							Process videos from bottom to top instead    
                    </span>
                    <br>
               </div>
               
               <div class="option clearfix">
                    <input name="camp_options[]" id="OPT_VM_CACHE"  value="OPT_VM_CACHE" type="checkbox">
                    <span class="option-title">
							Cache videos for faster posting  (uncheck to call vimeo each video)
                    </span>
                    <br>
               </div>
                <div class="option clearfix">
                    <input name="camp_options[]" value="OPT_VM_TAG" type="checkbox">
                    <span class="option-title">
							Post Vimeo Tags as Tags 
                    </span>
                    <br>
               </div>
                 
		 </div>
		 
          
		 </div>
		 
		 
		 <!-- / Vimeo Part -->
		 	 
		 <!--  Sound cloud part -->
		 
		 <div class="typepart SoundCloud" style="display:none">
		 
		 	<div id="sc_user_div" class="field f_100">
               
               <div class="option clearfix">
                    <input name="camp_options[]" id="OPT_SC_CACHE"  value="OPT_SC_TAG_SEARCH" type="checkbox">
                    <span class="option-title">
							Search by Tags instead of keywords (return sounds containing the tags)
                    </span>
                    <br>
               </div>
               
               <div class="option clearfix">
                    
                    <input data-controls-r=""  data-controls="sc_user_c" name="camp_options[]"  value="OPT_SC_USER" type="checkbox">
                    <span class="option-title">
							Post from specific SoundCloud user/playlist 
                    </span>
                    <br>
                    
		            <div id="sc_user_c" class="field f_100">
		               
		               	<label>
					 		User or Playlist ? :
					 	</label>
					 	
					 	<select  id="cg_sc_user_playlist" name="cg_sc_user_playlist" >
					 		<option  value="user"  <?php @wp_automatic_opt_selected('user',$camp_general['cg_sc_user_playlist']) ?> >User</option>
					 		<option  value="playlist"  <?php @wp_automatic_opt_selected('playlist',$camp_general['cg_sc_user_playlist']) ?> >Playlist</option>
					 		
					 	</select>
		               
		               <label for="field6">
		                    User id or playlist id 
		               </label>
		                
		                <input id="cg_sc_user" value="<?php echo @$camp_general['cg_sc_user']   ?>" name="cg_sc_user"    type="text">
		                <div class="description">for example add "1682" for this <a href="https://soundcloud.com/experimedia">user</a>. check <a target="_blank" href="http://valvepress.com/how-to-get-a-soundcloud-userplaylist-id/">this tutorial</a> to know how to get the id </div>
		                
		            	 
	                    <br>
		            </div>
		            
		            
		            
               </div>
               
               
          
               <div class="option clearfix">
                    
                    <input name="camp_options[]"  data-controls="sc_from"   value="OPT_SC_FROM" type="checkbox">
                    <span class="option-title">
							Set Minimum length 
                    </span>
                    <br>
                    
		            <div id="sc_from" class="field f_100">
		               <label for="field6">
		                    Minimum length in milliseconds (1 second = 1000 milliseconds)
		               </label>
		               
		                <input value="<?php  echo @$camp_general['cg_sc_from']   ?>"  name="cg_sc_from" type="text">
		               
		            </div>
		            
               </div>
		  
                <div class="option clearfix">
                    
                    <input name="camp_options[]"  data-controls="sc_to"   value="OPT_SC_TO" type="checkbox">
                    <span class="option-title">
							Set Maximum length 
                    </span>
                    <br>
                    
		            <div id="sc_to" class="field f_100">
		               <label for="field6">
		                    Max length in milliseconds (1 second = 1000 milliseconds)
		               </label>
		               
		                <input value="<?php  echo @$camp_general['cg_sc_to']   ?>"  name="cg_sc_to" type="text">
		               
		            </div>
		            
               </div>
               
                <div class="option clearfix">
                    <input name="camp_options[]" id="OPT_SC_CACHE"  value="OPT_SC_CACHE" type="checkbox">
                    <span class="option-title">
							Cache items for faster posting  (uncheck to call SoundCloud each pin)
                    </span>
                    <br>
               </div>
               
               
               
               <div class="option clearfix">
                    <input name="camp_options[]"   value="OPT_SC_REVERSE" type="checkbox">
                    <span class="option-title">
							Process items from bottom to top instead    
                    </span>
                    <br>
				</div>
				
				
				<div class="option clearfix">
	                    <input name="camp_options[]"  value="OPT_SC_DATE" type="checkbox">
	                    <span class="option-title">
								Post items with it's original date
	                    </span>
	                    <br>
	                     
	               </div>
	               
	               <div class="option clearfix">
	                    <input name="camp_options[]"  value="OPT_SC_TAG" type="checkbox">
	                    <span class="option-title">
								Post soundCloud tags as wordpress tags
	                    </span>
	                    <br>
	                     
	               </div>
	               
	               <div class="option clearfix">
	                    <input name="camp_options[]"  value="OPT_SC_COMMENT" type="checkbox">
	                    <span class="option-title">
								Post soundCloud comments as wordpress comments
	                    </span>
	                    <br>
	                     
	               </div>
	               
		 </div>
		
		 
		 </div>
		 
		 <!--   /sound cloud part -->	 
		 
		 <!-- Pinterest Part -->
		 
		 
		 <div class="typepart Pinterest" style="display:none">
		 

		 
			 <div id="pt_user_div" class="field f_100">
	               <div class="option clearfix">
	                    
	                    <input data-controls="pt_user_c" name="camp_options[]" id="pt_user" value="OPT_PT_USER"  data-controls-r=''  type="checkbox">
	                    <span class="option-title">
								Post from specific pinterest user / board
	                    </span>
	                    <br>
	                    
			            <div id="pt_user_c" class="field f_100">
			               
			               <label>
					 		User or Board ? :
						 	</label>
						 	
						 	<select id="cg_pt_user_channel" name="cg_pt_user_channel" >
						 		<option  value="users"  <?php @wp_automatic_opt_selected('users',$camp_general['cg_pt_user_channel']) ?> >User</option>
						 		<option  value="boards"  <?php @wp_automatic_opt_selected('boards',$camp_general['cg_pt_user_channel']) ?> >Board</option>
						 		
						 	</select>
			               
			               	 
			               <label for="field6">
			                    User id/board id 
			               </label>
			                
			                <input id="cg_pt_user" value="<?php echo @$camp_general['cg_pt_user']   ?>" name="cg_pt_user"    type="text">
			                <div class="description">for example add "welkerpatrick" for this <a href="https://www.pinterest.com/welkerpatrick">user</a>. <br> or add "welkerpatrick/recipes" for this <a href="https://www.pinterest.com/welkerpatrick/recipes/">board</a><br>copy the value from the link after pinterest.com/ </div>
			                
			            	 
		                    <br>
			            </div>
			            
	               </div>
			 </div>
			 
			 
			 <div  class="field f_100">
                 
        
               
               <div class="option clearfix">
                    <input name="camp_options[]" id="OPT_PT_CACHE"  value="OPT_PT_CACHE" type="checkbox">
                    <span class="option-title">
							Cache pins for faster posting  (uncheck to call pinterest each pin)
                    </span>
                    <br>
               </div>
       
       			<div class="option clearfix">
                    <input data-controls="wp_pinterest_title_count" name="camp_options[]"  value="OPT_PT_AUTO_TITLE" type="checkbox">
                    <span class="option-title">
							Auto generate title from the description for the no title pins
                    </span>
                    <br>
                    
                    <div id="wp_pinterest_title_count" class="field f_100">
                    	<lable>Limit title to x chars (default is 80 )</lable>
                    	<input value="<?php echo @$camp_general['cg_pt_title_count']  ?>" placeholder="80" name="cg_pt_title_count"  type="text">
                    	
                    </div>
                    
               </div>
       			
                 
		 </div>
			 
		 
		 </div>
		 
		 
		 <!--  / pinterest Part -->
		 
		 <!-- Instagram part -->
		 <div class="typepart Instagram" style="display:none">
		 		
		 		<div  class="field f_100">
		 			Hint: keywords will be turned to instagram hastags like "no filter" the plugin will search "#nofilter" tag at instagarm
		 		</div>
		 
		 		<div  class="field f_100">
	               <div class="option clearfix">
	                    <input data-controls-r="" data-controls="wp_it_user"  name="camp_options[]"  value="OPT_IT_USER" type="checkbox">
	                    <span class="option-title">
								Post from a specific Instagram user 
	                    </span>
	                    <br>
	                    
	                    <div id="wp_it_user" class="field f_100">
                    	<lable>Instagram user ID (appear after instagram.com at the user page link)</lable>
                    	<input value="<?php echo @$camp_general['cg_it_user']  ?>"  name="cg_it_user"  type="text">
                    	<div class="description">for example add "cnn" for for <a target="_blank" href="https://instagram.com/cnn/">this user</a></div>
                    </div>
                    
	                    
	               </div>
                
                	
	               <div class="option clearfix">
	                    <input name="camp_options[]"  value="OPT_IT_POPULAR" type="checkbox">
	                    <span class="option-title">
								Only post popular posts (No most recent items)
	                    </span>
	                    <br>
	                     
	               </div>
	               
	               
	               <div class="option clearfix">
	                    <input name="camp_options[]"  value="OPT_IT_TAGS" type="checkbox">
	                    <span class="option-title">
								Set Instagram tags as tags
	                    </span>
	                    <br>
	                     
	               </div>
	               
	               <div class="option clearfix">
	                    <input name="camp_options[]"  value="OPT_IT_COMMENT" type="checkbox">
	                    <span class="option-title">
								Post Instagram comments as comments
	                    </span>
	                    <br>
	                     
	               </div>
	               
	               <div class="option clearfix">
	                    <input name="camp_options[]"  value="OPT_IT_NO_IMG" type="checkbox">
	                    <span class="option-title">
								Don't post images items 
	                    </span>
	                    <br>
	                     
	               </div>
	               
	               <div class="option clearfix">
	                    <input name="camp_options[]"  value="OPT_IT_NO_VID" type="checkbox">
	                    <span class="option-title">
								Don't post video items 
	                    </span>
	                    <br>
	                     
	               </div>
	               
	               <div class="option clearfix">
	                    <input name="camp_options[]"  value="OPT_IT_VID_TOP" type="checkbox">
	                    <span class="option-title">
								Embed videos at the top of the post (by default at the bottom)
	                    </span>
	                    <br>
	                     
	               </div>
	               
	                <div class="option clearfix">
	                    <input name="camp_options[]"  value="OPT_IT_NO_VID_IMG_HIDE" type="checkbox">
	                    <span class="option-title">
								Don't hide video image (added hidden for featured image purpose) 
	                    </span>
	                    <br>
	                     
	               </div>
	               
	                
               </div>
        
		 		 
		 </div>
		 	
		 <!-- /Instagram Twitter part -->
		 <div class="typepart  Twitter Instagram " style="display:none">
		 
		 <div  class="field f_100">
	               
	               <div class="option clearfix">
	                    <input name="camp_options[]"  value="OPT_IT_DATE" type="checkbox">
	                    <span class="option-title">
								Post items with it's original date
	                    </span>
	                    <br>
	                     
	               </div>
	               
	               
	               <div class="option clearfix">
	                    <input name="camp_options[]"  value="OPT_IT_CACHE" type="checkbox">
	                    <span class="option-title">
								Cache items for faster posting
	                    </span>
	                    <br>
	                     
	               </div>
	               
	               
	               <div class="option clearfix">
	                    <input data-controls="wp_it_title_count" name="camp_options[]"  value="OPT_IT_AUTO_TITLE" type="checkbox">
	                    <span class="option-title">
								Auto generate title from the content 
	                    </span>
	                    <br>
	                    
	                    <div id="wp_it_title_count" class="field f_100">
                    	<lable>Limit title to x chars (default is 80 )</lable>
                    	<input value="<?php echo @$camp_general['cg_it_title_count']  ?>" placeholder="80" name="cg_it_title_count"  type="text">
                    	
                    	<div class="option clearfix typepart Twitter">
	                    	<input   name="camp_options[]"  value="OPT_IT_TITLE_CLEAN" type="checkbox">
		                    <span class="option-title">
									Clean title from RT and @user  
		                    </span>
		                    <br>
                    	</div>
                    	
                    </div>
                    
                     
	                    
	               </div>
               </div>
		 
		 </div>
		 
		 <!--  Twitter Part -->
		 <div  class="typepart Twitter"  >
		 	 
		 	 <div  class="field f_100">
		 	 	
		 	 	<div class="option clearfix">
	                    <input name="camp_options[]"  value="OPT_TW_TAG" type="checkbox">
	                    <span class="option-title">
								Post hashtags as wordpress tags
	                    </span>
	                    <br>
	                     
	            </div>
	            
	            <div class="option clearfix">
	                    <input name="camp_options[]"  value="OPT_TW_VID_EMBED" type="checkbox">
	                    <span class="option-title">
								Automatically embed videos
	                    </span>
	                    <br>
	                     
	            </div>
		 	 	
		 	 	<div class="option clearfix">
	                    <input name="camp_options[]"  value="OPT_TW_RT" type="checkbox">
	                    <span class="option-title">
								Skip Retweets
	                    </span>
	                    <br>
	                     
	               </div>
	               
               <div class="option clearfix">
                    <input name="camp_options[]"  value="OPT_TW_RE" type="checkbox">
                    <span class="option-title">
							Skip in-reply-to tweets
                    </span>
                    <br>
                     
               </div>
		 	 	
		 	 	<div class="option clearfix">
	                    <input name="camp_options[]"  value="OPT_TW_CARDS" type="checkbox">
	                    <span class="option-title">
								Embed items as twitter cards (by default plain text)
	                    </span>
	                    <br>
	                     
	               </div>
	               
	               
		 	 	
		 	 	<div class="option clearfix">
	                    <input data-controls="wp_tw_country" name="camp_options[]"  value="OPT_TW_COUNTRY" type="checkbox">
	                    <span class="option-title">
								Limit search to a specific language 
	                    </span>
	                    <br>
	                    
	                    <div id="wp_tw_country" class="field f_100">
	                    	<lable>Language code 639-1</lable>
	                    	
	                    	<input value="<?php echo @$camp_general['cg_tw_lang']  ?>"   name="cg_tw_lang"  type="text">
	                    	<div class="description"><i>Check list <a href="https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes">here</a></i></div>
                    	
                 		</div>
		 	 	
		 	 	</div>
		 	 	
		 	 	 
		 	 	
		 	 	
		 
		 	</div>
		 </div>
		 
		 <!-- DailyMotion part -->
<div class="typepart DailyMotion" style="display:none">
		 	
		 	
		 	<div class="field f_100">
		 	
		 	<div class="option clearfix"  >
		 	
		 		<input data-controls="dm_user_c" name="camp_options[]" id="dm_user" value="OPT_DM_USER" type="checkbox">
                    <span class="option-title">
							Post from a specific DailyMotion user 
                    </span>
                    <br>
                    
		            <div id="dm_user_c" class="field f_100">
		               <label>
		                    User ID  
		               </label>
		                
		                <input id="camp_dm_user" value="<?php echo $camp_general['cg_dm_user']   ?>" name="cg_dm_user" type="text">
		                <div class="description"><br>Example:add Dakar for this user  <a href="http://www.dailymotion.com/Dakar">http://www.dailymotion.com/Dakar</a> </div>
		                
		                <br>
		            	<div class="field f_100">
		            	<input  data-controls="wp_automatic_dmplaylist_c"  name="camp_options[]" value="OPT_DM_PLAYLIST" id="wp_automatic_dmplaylist_opt" type="checkbox">
		                    <span class="option-title">
									Specify a playlist?   
		                    </span>
		                    <br>
		                    
		                    <div  id="wp_automatic_dmplaylist_c" class="field f_100">
		                    	 <select  style="width:220px" class="no-unify" name="cg_dm_playlist" id="cg_dm_playlist"  >
					                   
					                   
					                   
					                   <?php 
					                   
					                   $wp_automatic_dm_playlists = get_post_meta($post_id ,'wp_automatic_dm_playlists',1); 
					                   
					               
					                   if(! is_array($wp_automatic_dm_playlists)) $wp_automatic_dm_playlists = array();
					                   
					                   foreach ($wp_automatic_dm_playlists as $playlist){


					                   	?>
											<option  value="<?php echo $playlist['id'] ?>"  <?php @wp_automatic_opt_selected($camp_general['cg_dm_playlist'],$playlist['id']) ?> >
					                         	<?php echo $playlist['title']?>
					                    	</option>				

					                   	<?php

					                   	
					                   	
					                   }
  
					               
					                   ?>
					                     
					               </select>
					               
					               
					               <a href="#" id="dm_playlist_update">update playlists</a>
					               
					               <span class="spinner is-active spinner-dmplaylist" style="display:none"></span>
					        
					        		<br><br>
					        
								   <label>
					                    Chosen playlist id  
					               </label>
						        	
			                    	<input   id="cg_dm_playlist_txt" value="<?php echo @$camp_general['cg_dm_playlist']   ?>" name="cg_dm_playlist"   type="text">
			                	    <div class="description">This field will be automatically loaded with the playlist id or simply paste a playlist id here for example add "x4shtt" for this <a href="http://www.dailymotion.com/playlist/x4shtt_Dakar_dakar-2017-touristic-postcard/">playlist</a></div> 
			                    
					               
		                    </div>
		                     
	                    </div>
	                    
	                    
		                
		            	<br>
		            	<div class="field f_100">
		            	<input  data-controls-r='' name="camp_options[]" id="dm_full" value="OPT_DM_FULL" type="checkbox">
		                    <span class="option-title">
									Don't use keywords add videos without filtering . 
		                    </span>
	                    </div>
	                    <br>
		            </div>
		            
		            
               </div>
               
               </div>
               
               <div class="field f_100">
		                Player Width <input style="width:100px" class="no-unify" value="<?php echo  @$camp_general['cg_dm_width']   ?>" name="cg_dm_width"    type="text"> Height <input style="width:100px" class="no-unify" value="<?php echo  @$camp_general['cg_dm_height']   ?>" name="cg_dm_height"    type="text">
			   </div>
			   
			   <div class="field f_100">
			       <div class="option clearfix">
	                    <input name="camp_options[]" id="OPT_DM_CACHE"  value="OPT_DM_CACHE" type="checkbox">
	                    <span class="option-title">
								Cache videos for faster posting  (uncheck to call DailyMotion each video)
	                    </span>
	                    <br>
	               </div>
	               <div class="option clearfix">
	                    <input name="camp_options[]" id="OPT_DM_ORIGINAL_TIME"  value="OPT_DM_ORIGINAL_TIME" type="checkbox">
	                    <span class="option-title">
								Add posts with it's original time 
	                    </span>
	                    <br>
	               </div>
	               
	               <div class="option clearfix">
	                    <input name="camp_options[]" id="OPT_DM_REVERSE"  value="OPT_DM_REVERSE" type="checkbox">
	                    <span class="option-title">
								Process items from bottom to top instead 
	                    </span>
	                    <br>
	               </div>
	               
	               <div class="option clearfix">
	                    <input name="camp_options[]" value="OPT_DM_TAG" type="checkbox">
	                    <span class="option-title">
								Post DailyMotion Tags as Tags 
	                    </span>
	                    <br>
               		</div>
               		
               		<div class="option clearfix">
	                    <input name="camp_options[]" value="OPT_DM_AUTO" type="checkbox">
	                    <span class="option-title">
								Auto play the video
	                    </span>
	                    <br>
               		</div>
               		
               		<div class="option clearfix">
	                    <input data-controls="wp_automatic_dm_sctry" name="camp_options[]" value="OPT_DM_LIMIT_CTRY" type="checkbox">
	                    <span class="option-title">
								Search results for a specific country  
	                    </span>
	                    <br>
	                    
	                    <div id="wp_automatic_dm_sctry" class="field f_100">
	                    	
	                       <label>
			                    Country Code
			               </label>
			               
			               <input value="<?php echo @$camp_general['cg_dm_ctr']   ?>" name="cg_dm_ctr"   type="text">
			               
			               <div class="description">Example: "US" for united states. check other countries region codes <a target="_blank" href="https://www.iso.org/obp/ui/#search/code/">here</a></div>
	                    
	                    </div>
                    
               		</div>
               		
               		<div class="option clearfix">
	                    <input data-controls="wp_automatic_dm_slang" name="camp_options[]" value="OPT_DM_LIMIT_LANG" type="checkbox">
	                    <span class="option-title">
								Search results for a specific language  
	                    </span>
	                    <br>
	                    
	                    <div id="wp_automatic_dm_slang" class="field f_100">
	                    	
	                       <label>
			                    Language Code
			               </label>
			               
			               <input value="<?php echo @$camp_general['cg_dm_lang']   ?>" name="cg_dm_lang"   type="text">
			               
			               <div class="description">Example: "en" for English. check other languages codes <a target="_blank" href="http://www.loc.gov/standards/iso639-2/php/code_list.php">here</a></div>
	                    
	                    </div>
                    
               		</div>
               		
               		<div class="option clearfix">
	                    <input data-controls="wp_automatic_dm_schannel" name="camp_options[]" value="OPT_DM_LIMIT_CHANNEL" type="checkbox">
	                    <span class="option-title">
								Search results from a specific channel 
	                    </span>
	                    <br>
	                    
	                    <div id="wp_automatic_dm_schannel" class="field f_100">
	                    	
	                       <label>
			                    Channel name
			               </label>
			               
			               <input value="<?php echo @$camp_general['cg_dm_channel']   ?>" name="cg_dm_channel"   type="text">
			               
			               <div class="description">Example: news,sport,comedy and music</div>
	                    
	                    </div>
                    
               		</div>
               		
	               
               </div>
			   
               
               
		 </div>
		 	
		  		 
		 
		 
		 <!--  Youtube Part -->
		 <div class="typepart Youtube" style="display:none">
		 

		 
		 <div id="yt_user_div" class="field f_100">
		 
		 
               <div class="option clearfix">
                    
                    <input name="camp_options[]" id="yt_user" value="OPT_YT_USER" type="checkbox">
                    <span class="option-title">
							Post from specific youtube channel 
                    </span>
                    <br>
                    
		            <div id="yt_user_c" class="field f_100">
		               <label for="field6">
		                    Channel ID  
		               </label>
		                
		                <input id="camp_yt_user" value="<?php echo $camp_yt_user   ?>" name="camp_yt_user" id="field6"   type="text">
		                <div class="description"><br>(Check <a target="_blank" href="http://valvepress.com/how-to-find-a-youtube-channel-id/">this post</a> if you don't know what is this) <br><br>Example:add UCRrW0ddrbFnJCbyZqHHv4KQ for this channel  <a href="https://www.youtube.com/channel/UCRrW0ddrbFnJCbyZqHHv4KQ">https://www.youtube.com/channel/UCRrW0ddrbFnJCbyZqHHv4KQ</a> </div>
		                
		                <br>
		            	<div class="field f_100">
		            	<input data-controls-r="" data-controls="wp_automatic_playlist_c"  name="camp_options[]" value="OPT_YT_PLAYLIST" type="checkbox" id="wp_automatic_playlist_opt">
		                    <span class="option-title">
									Specify a playlist?   
		                    </span>
		                    <br>
		                    
		                    <div  id="wp_automatic_playlist_c" class="field f_100">
		                    	 <select  style="width:220px" class="no-unify" name="cg_yt_playlist" id="cg_yt_playlist"  >
					                   
					                   
					                   
					                   <?php 
					                   
					                   $wp_automatic_yt_playlists = get_post_meta($post_id ,'wp_automatic_yt_playlists',1); 
					                   
					               
					                   if(! is_array($wp_automatic_yt_playlists)) $wp_automatic_yt_playlists = array();
					                   
					                   foreach ($wp_automatic_yt_playlists as $playlist){




					                   	?>
											<option  value="<?php echo $playlist['id'] ?>"  <?php @wp_automatic_opt_selected($camp_general['cg_yt_playlist'],$playlist['id']) ?> >
					                         	<?php echo $playlist['title']?>
					                    	</option>				

					                   	<?php

					                   	
					                   	
					                   }

					                   
					                   
					                   
					                   /*
					                   
					                   
					                    <option  value="draft"  <?php @wp_automatic_opt_selected('draft',$camp_post_status) ?> >
					                         Draft
					                    </option>
					                    <option id="field1-2" value="publish"  <?php @wp_automatic_opt_selected('publish',$camp_post_status) ?>  >
					                         Published
					                    </option>
					                    
					                    */

					               
					                   ?>
					                     
					               </select>
					               
					               
					               <a href="#" id="yt_playlist_update">update playlists</a>
					               
					               <span class="spinner is-active spinner-playlist" style="display:none"></span>
					        
					        		<br><br>
					        
								   <label for="field6">
					                    Chosen playlist id  
					               </label>
						        	
			                    	<input   id="cg_yt_playlist_txt" value="<?php echo @$camp_general['cg_yt_playlist']   ?>" name="cg_yt_playlist"   type="text">
			                	    <div class="description">This field will be automatically loaded with the playlist id or simply paste a playlist id here for example add "PLFgquLnL59amB2HQvPIExssQsuNRPvOwk" for this <a href="https://www.youtube.com/playlist?list=PLFgquLnL59amB2HQvPIExssQsuNRPvOwk">playlist</a></div> 
			                    
					               
		                    </div>
		                    
		                	
		                	
		                    
	                    </div>
	                    
	                    
		                
		            	<br>
		            	<div class="field f_100">
		            	<input  data-controls-r='' name="camp_options[]" id="yt_full" value="OPT_YT_FULL" type="checkbox">
		                    <span class="option-title">
									Don't use keywords add videos without filtering . 
		                    </span>
	                    </div>
	                    <br>
		            </div>
		            
               </div>
		 </div>
		 
		 
		 
		 
		 <div id="field-camp_youtube_order-container" class="field f_100" >
		 	<label for="field-camp_youtube_order">
		 		Youtube search order :
		 	</label>
		 	<select id="camp_youtube_order" name="camp_youtube_order" id="field1zz">
		 		<option  value="relevance"  <?php @wp_automatic_opt_selected('relevance',$camp_youtube_order) ?> >Relevance</option>
		 		<option  value="date"  <?php @wp_automatic_opt_selected('date',$camp_youtube_order) ?> >Date</option>
		 		<option  value="title"  <?php @wp_automatic_opt_selected('title',$camp_youtube_order) ?> >Title</option>
		 		<option  value="viewCount"  <?php @wp_automatic_opt_selected('viewCount',$camp_youtube_order) ?> >View Count</option>
		 		<option  value="rating"  <?php @wp_automatic_opt_selected('rating',$camp_youtube_order) ?> >Rating</option>
		 		 
		 	</select>
		 </div>

		
		<div id="field-camp_youtube_cat-container" class="field f_100" >
			<label for="field-camp_youtube_cat">
				Youtube category:
			</label>
			<select name="camp_youtube_cat" id="field1zz">
					<option  value="All"  <?php @wp_automatic_opt_selected('All',$camp_youtube_cat) ?> >All</option>
					<option value="2" <?php @wp_automatic_opt_selected( '2',$camp_youtube_cat) ?> >Autos & Vehicles</option>
					<option value="10" <?php @wp_automatic_opt_selected( '10',$camp_youtube_cat) ?> >Music</option>
					<option value="15" <?php @wp_automatic_opt_selected( '15',$camp_youtube_cat) ?> >Pets & Animals</option>
					<option value="17" <?php @wp_automatic_opt_selected( '17',$camp_youtube_cat) ?> >Sports</option>
					<option value="18" <?php @wp_automatic_opt_selected( '18',$camp_youtube_cat) ?> >Short Movies</option>
					<option value="19" <?php @wp_automatic_opt_selected( '19',$camp_youtube_cat) ?> >Travel & Events</option>
					<option value="20" <?php @wp_automatic_opt_selected( '20',$camp_youtube_cat) ?> >Gaming</option>
					<option value="21" <?php @wp_automatic_opt_selected( '21',$camp_youtube_cat) ?> >Videoblogging</option>
					<option value="22" <?php @wp_automatic_opt_selected( '22',$camp_youtube_cat) ?> >People & Blogs</option>
					<option value="23" <?php @wp_automatic_opt_selected( '23',$camp_youtube_cat) ?> >Comedy</option>
					<option value="24" <?php @wp_automatic_opt_selected( '24',$camp_youtube_cat) ?> >Entertainment</option>
					<option value="25" <?php @wp_automatic_opt_selected( '25',$camp_youtube_cat) ?> >News & Politics</option>
					<option value="26" <?php @wp_automatic_opt_selected( '26',$camp_youtube_cat) ?> >Howto & Style</option>
					<option value="27" <?php @wp_automatic_opt_selected( '27',$camp_youtube_cat) ?> >Education</option>
					<option value="28" <?php @wp_automatic_opt_selected( '28',$camp_youtube_cat) ?> >Science & Technology</option>
					<option value="29" <?php @wp_automatic_opt_selected( '29',$camp_youtube_cat) ?> >Nonprofits & Activism</option>
					<option value="30" <?php @wp_automatic_opt_selected( '30',$camp_youtube_cat) ?> >Movies</option>
					<option value="31" <?php @wp_automatic_opt_selected( '31',$camp_youtube_cat) ?> >Anime/Animation</option>
					<option value="32" <?php @wp_automatic_opt_selected( '32',$camp_youtube_cat) ?> >Action/Adventure</option>
					<option value="33" <?php @wp_automatic_opt_selected( '33',$camp_youtube_cat) ?> >Classics</option>
					 
					<option value="35" <?php @wp_automatic_opt_selected( '35',$camp_youtube_cat) ?> >Documentary</option>
					<option value="36" <?php @wp_automatic_opt_selected( '36',$camp_youtube_cat) ?> >Drama</option>
					<option value="37" <?php @wp_automatic_opt_selected( '37',$camp_youtube_cat) ?> >Family</option>
					<option value="38" <?php @wp_automatic_opt_selected( '38',$camp_youtube_cat) ?> >Foreign</option>
					<option value="39" <?php @wp_automatic_opt_selected( '39',$camp_youtube_cat) ?> >Horror</option>
					<option value="40" <?php @wp_automatic_opt_selected( '40',$camp_youtube_cat) ?> >Sci-Fi/Fantasy</option>
					<option value="41" <?php @wp_automatic_opt_selected( '41',$camp_youtube_cat) ?> >Thriller</option>
					<option value="42" <?php @wp_automatic_opt_selected( '42',$camp_youtube_cat) ?> >Shorts</option>
					<option value="43" <?php @wp_automatic_opt_selected( '43',$camp_youtube_cat) ?> >Shows</option>
					<option value="44" <?php @wp_automatic_opt_selected( '44',$camp_youtube_cat) ?> >Trailers</option>		 
 
			</select>
		</div>
		
		
		<div   class="field f_100" >
			<label>
				Video License:
			</label>
			<select name="cg_yt_license" >
							
							<option  value="any"  <?php @wp_automatic_opt_selected('any',$camp_general['cg_yt_license']) ?> >Any</option>
							<option  value="creativeCommon"  <?php @wp_automatic_opt_selected('creativeCommon',$camp_general['cg_yt_license']) ?> >Creative Common</option>
							<option  value="youtube"  <?php @wp_automatic_opt_selected('youtube',$camp_general['cg_yt_license']) ?> >Standard</option>
 
			</select>
		</div>
		
		<div   class="field f_100" >
			<label>
				Video Type:
			</label>
			<select name="cg_yt_type" >
							
							<option  value="any"  <?php @wp_automatic_opt_selected('any',$camp_general['cg_yt_type']) ?> >Any</option>
							<option  value="episode"  <?php @wp_automatic_opt_selected('episode',$camp_general['cg_yt_type']) ?> >Episode</option>
							<option  value="movie"  <?php @wp_automatic_opt_selected('movie',$camp_general['cg_yt_type']) ?> >Movie</option>
 			</select>
		</div>
		
		<div   class="field f_100" >
			<label>
				Video Duration:
			</label>
			<select name="cg_yt_duration" >
							
							<option  value="any"  <?php @wp_automatic_opt_selected('any',$camp_general['cg_yt_duration']) ?> >Any</option>
							<option  value="long"  <?php @wp_automatic_opt_selected('long',$camp_general['cg_yt_duration']) ?> >Long (longer than 20 minutes)</option>
							<option  value="medium"  <?php @wp_automatic_opt_selected('medium',$camp_general['cg_yt_duration']) ?> >Medium (between four and 20 minutes)</option>
							<option  value="short"  <?php @wp_automatic_opt_selected('short',$camp_general['cg_yt_duration']) ?> >Short (less than four minutes)</option>
  			</select>
		</div>
		
		<div   class="field f_100" >
			<label>
				Video definition:
			</label>
			<select name="cg_yt_definition" >
							
							<option  value="any"  <?php @wp_automatic_opt_selected('any',$camp_general['cg_yt_definition']) ?> >Any</option>
							<option  value="high"  <?php @wp_automatic_opt_selected('high',$camp_general['cg_yt_definition']) ?> >High</option>
							<option  value="standard"  <?php @wp_automatic_opt_selected('standard',$camp_general['cg_yt_definition']) ?> >Standard</option>
							
							high
   			</select>
		</div>
		
		
		 <div class="field f_100">
		              
		                Player Width <input style="width:100px" class="no-unify" value="<?php echo  @$camp_general['cg_yt_width']   ?>" name="cg_yt_width"    type="text"> Height <input style="width:100px" class="no-unify" value="<?php echo  @$camp_general['cg_yt_height']   ?>" name="cg_yt_height"    type="text">
		            	
		 </div>
				  
         <div  class="field f_100">
               <div class="option clearfix">
                    <input name="camp_options[]"  value="OPT_YT_FULL_CNT" type="checkbox">
                    <span class="option-title">
							Fetch Full video description from youtube
                    </span>
                    <br>
               </div>
               
             
               
               <div class="option clearfix">
                    <input name="camp_options[]"   value="OPT_YT_ORIGINAL_TIME" type="checkbox">
                    <span class="option-title">
							Add posts with it's original time   
                    </span>
                    <br>
               </div>

               <div class="option clearfix">
                    <input name="camp_options[]"   value="OPT_YT_REVERSE" type="checkbox">
                    <span class="option-title">
							Process videos from bottom to top instead    
                    </span>
                    <br>
               </div>
               
               <div class="option clearfix">
                    <input name="camp_options[]" id="OPT_YT_CACHE"  value="OPT_YT_CACHE" type="checkbox">
                    <span class="option-title">
							Cache videos for faster posting  (uncheck to call youtube each video)
                    </span>
                    <br>
               </div>
               
               <div class="option clearfix">
                    <input name="camp_options[]" value="OPT_YT_TAG" type="checkbox">
                    <span class="option-title">
							Post Youtube Tags as Tags 
                    </span>
                    <br>
               </div>
               
               <div class="option clearfix">
                    <input name="camp_options[]" value="OPT_YT_AUTO" type="checkbox">
                    <span class="option-title">
							Auto play the video
                    </span>
                    <br>
               </div>
               
               <div class="option clearfix">
                    <input name="camp_options[]" value="OPT_YT_SUGGESTED" type="checkbox">
                    <span class="option-title">
							disable suggested videos at the end of the vid 
                    </span>
                    <br>
               </div>
               
               <div class="option clearfix">
                    <input name="camp_options[]" value="OPT_YT_LOGO" type="checkbox">
                    <span class="option-title">
							disable Youtube logo 
                    </span>
                    <br>
               </div>
               
               <div class="option clearfix">
                    <input name="camp_options[]" value="OPT_YT_COMMENT" type="checkbox">
                    <span class="option-title">
							Post Youtube Comments as Comments 
                    </span>
                    <br>
               </div>
               
               <div class="option clearfix">
                    <input name="camp_options[]" value="OPT_YT_LIMIT_EMBED" type="checkbox">
                    <span class="option-title">
							Limit search to embeddable videos 
                    </span>
                    <br>
               </div>
               
               <div class="option clearfix">
                    <input data-controls="wp_automatic_yt_sctry" name="camp_options[]" value="OPT_YT_LIMIT_CTRY" type="checkbox">
                    <span class="option-title">
							Search results for a specified country  
                    </span>
                    <br>
                    
                    <div id="wp_automatic_yt_sctry" class="field f_100">
                    	
                       <label>
		                    Region Code
		               </label>
		               
		               <input value="<?php echo @$camp_general['cg_yt_ctr']   ?>" name="cg_yt_ctr"   type="text">
		               
		               <div class="description">Example: "US" for united states. check other countries region codes <a target="_blank" href="https://www.iso.org/obp/ui/#search/code/">here</a></div>
                    
                    </div>
                    
               </div>
               
               <div class="option clearfix">
                    <input data-controls="wp_automatic_yt_slang" name="camp_options[]" value="OPT_YT_LIMIT_LANG" type="checkbox">
                    <span class="option-title">
							Set relevance to a specific language  
                    </span>
                    <br>
                    
                    <div id="wp_automatic_yt_slang" class="field f_100">
                    	
                       <label>
		                    Language Code
		               </label>
		               
		               <input value="<?php echo @$camp_general['cg_yt_lang']   ?>" name="cg_yt_lang"   type="text">
		               
		               <div class="description">Example: "en" for English. check other languages codes <a target="_blank" href="http://www.loc.gov/standards/iso639-2/php/code_list.php">here</a></div>
                    
                    </div>
                    
               </div>

				<div class="option clearfix">
                    <input name="camp_options[]" value="OPT_YT_CAPTION" type="checkbox">
                    <span class="option-title">
							Enable caption
                    </span>
                    <br>
               </div>

               <div class="option clearfix">
                    <input data-controls="wp_automatic_yt_plang" name="camp_options[]" value="OPT_YT_PLAYER_LANG" type="checkbox">
                    <span class="option-title">
							Set player/subtitles language  
                    </span>
                    <br>
                    
                    <div id="wp_automatic_yt_plang" class="field f_100">
                    	
                       <label>
		                    Language Code
		               </label>
		               
		               <input value="<?php echo @$camp_general['cg_yt_plang']   ?>" name="cg_yt_plang"   type="text">
		               
		               <div class="description">Example: "en" for English. check other languages codes <a target="_blank" href="http://www.loc.gov/standards/iso639-2/php/code_list.php">here</a></div>
                    
                    </div>
                    
               </div>
               
                
               
		 </div>
		 
          
		 </div>
		 <!--  / Youtube Part -->

		 
		 <!--  eBay Part -->
		 <div class="typepart eBay" style="display:none">

		 <div id="eb_user_div" class="field f_100">
               <div class="option clearfix">
                    
                    <input data-controls="eb_user_c" name="camp_options[]" id="eb_user" value="OPT_EB_USER" type="checkbox">
                    <span class="option-title">
							Post from specific eBay user  
                    </span>
                    <br>
                    
		            <div id="eb_user_c" class="field f_100">
		               <label>
		                    User id  
		               </label>
		                
		                <input value="<?php echo  @$camp_general['cg_eb_user']   ?>" name="cg_eb_user"    type="text">
		            	<br>
		            	<div class="field f_100">
		            	<input  data-controls-r='' name="camp_options[]" id="eb_full" value="OPT_EB_FULL" type="checkbox">
		                    <span class="option-title">
									Don't use keywords add items without filtering . 
		                    </span>
	                    </div>
	                    <br>
		            </div>
		            
               </div>
		 </div>
		 
		 <div   class="field f_100" >
			<label>
				eBay Site :
			</label>
			<select name="cg_eb_site" >
							<option  value="1"  <?php @wp_automatic_opt_selected("1",$camp_general['cg_eb_site']) ?> >eBay US</option>
							<option  value="2"  <?php @wp_automatic_opt_selected("2",$camp_general['cg_eb_site']) ?> >eBay IE</option>
							<option  value="3"  <?php @wp_automatic_opt_selected("3",$camp_general['cg_eb_site']) ?> >eBay AT</option>
							<option  value="4"  <?php @wp_automatic_opt_selected("4",$camp_general['cg_eb_site']) ?> >eBay AU</option>
							<option  value="5"  <?php @wp_automatic_opt_selected("5",$camp_general['cg_eb_site']) ?> >eBay BE</option>
							<option  value="7"  <?php @wp_automatic_opt_selected("7",$camp_general['cg_eb_site']) ?> >eBay CA</option>
							<option  value="10"  <?php @wp_automatic_opt_selected("10",$camp_general['cg_eb_site']) ?> >eBay FR</option>
							<option  value="11"  <?php @wp_automatic_opt_selected("11",$camp_general['cg_eb_site']) ?> >eBay DE</option>
							<option  value="12"  <?php @wp_automatic_opt_selected("12",$camp_general['cg_eb_site']) ?> >eBay IT</option>
							<option  value="13"  <?php @wp_automatic_opt_selected("13",$camp_general['cg_eb_site']) ?> >eBay ES</option>
							<option  value="14"  <?php @wp_automatic_opt_selected("14",$camp_general['cg_eb_site']) ?> >eBay CH</option>
							<option  value="15"  <?php @wp_automatic_opt_selected("15",$camp_general['cg_eb_site']) ?> >eBay UK</option>
							<option  value="16"  <?php @wp_automatic_opt_selected("16",$camp_general['cg_eb_site']) ?> >eBay NL</option> </select>
		</div>
		 
		 <div   class="field f_100" >
			<label>
				eBay category :
			</label>
			<select name="cg_eb_cat" >
							<option  value="0"  <?php @wp_automatic_opt_selected("0",$camp_general['cg_eb_cat']) ?> >All Categories</option>

							<option  value="20081"  <?php @wp_automatic_opt_selected("20081",$camp_general['cg_eb_cat']) ?> >Antiques</option>
							
							<option  value="550"  <?php @wp_automatic_opt_selected("550",$camp_general['cg_eb_cat']) ?> >Art</option>
							
							<option  value="2984"  <?php @wp_automatic_opt_selected("2984",$camp_general['cg_eb_cat']) ?> >Baby</option>
							
							<option  value="267"  <?php @wp_automatic_opt_selected("267",$camp_general['cg_eb_cat']) ?> >Books</option>
							
							<option  value="12576"  <?php @wp_automatic_opt_selected("12576",$camp_general['cg_eb_cat']) ?> >Business & Industrial</option>
							
							<option  value="625"  <?php @wp_automatic_opt_selected("625",$camp_general['cg_eb_cat']) ?> >Cameras & Photo</option>
							
							<option  value="15032"  <?php @wp_automatic_opt_selected("15032",$camp_general['cg_eb_cat']) ?> >Cell Phones & Accessories</option>
							
							<option  value="11450"  <?php @wp_automatic_opt_selected("11450",$camp_general['cg_eb_cat']) ?> >Clothing, Shoes & Accessories</option>
							
							<option  value="11116"  <?php @wp_automatic_opt_selected("11116",$camp_general['cg_eb_cat']) ?> >Coins & Paper Money</option>
							
							<option  value="1"  <?php @wp_automatic_opt_selected("1",$camp_general['cg_eb_cat']) ?> >Collectibles</option>
							
							<option  value="58058"  <?php @wp_automatic_opt_selected("58058",$camp_general['cg_eb_cat']) ?> >Computers/Tablets & Networking</option>
							
							<option  value="293"  <?php @wp_automatic_opt_selected("293",$camp_general['cg_eb_cat']) ?> >Consumer Electronics</option>
							
							<option  value="14339"  <?php @wp_automatic_opt_selected("14339",$camp_general['cg_eb_cat']) ?> >Crafts</option>
							
							<option  value="237"  <?php @wp_automatic_opt_selected("237",$camp_general['cg_eb_cat']) ?> >Dolls & Bears</option>
							
							<option  value="11232"  <?php @wp_automatic_opt_selected("11232",$camp_general['cg_eb_cat']) ?> >DVDs & Movies</option>
							
							<option  value="6000"  <?php @wp_automatic_opt_selected("6000",$camp_general['cg_eb_cat']) ?> >eBay Motors</option>
							
							<option  value="45100"  <?php @wp_automatic_opt_selected("45100",$camp_general['cg_eb_cat']) ?> >Entertainment Memorabilia</option>
							
							<option  value="172008"  <?php @wp_automatic_opt_selected("172008",$camp_general['cg_eb_cat']) ?> >Gift Cards & Coupons</option>
							
							<option  value="26395"  <?php @wp_automatic_opt_selected("26395",$camp_general['cg_eb_cat']) ?> >Health & Beauty</option>
							
							<option  value="11700"  <?php @wp_automatic_opt_selected("11700",$camp_general['cg_eb_cat']) ?> >Home & Garden</option>
							
							<option  value="281"  <?php @wp_automatic_opt_selected("281",$camp_general['cg_eb_cat']) ?> >Jewelry & Watches</option>
							
							<option  value="11233"  <?php @wp_automatic_opt_selected("11233",$camp_general['cg_eb_cat']) ?> >Music</option>
							
							<option  value="619"  <?php @wp_automatic_opt_selected("619",$camp_general['cg_eb_cat']) ?> >Musical Instruments & Gear</option>
							
							<option  value="1281"  <?php @wp_automatic_opt_selected("1281",$camp_general['cg_eb_cat']) ?> >Pet Supplies</option>
							
							<option  value="870"  <?php @wp_automatic_opt_selected("870",$camp_general['cg_eb_cat']) ?> >Pottery & Glass</option>
							
							<option  value="10542"  <?php @wp_automatic_opt_selected("10542",$camp_general['cg_eb_cat']) ?> >Real Estate</option>
							
							<option  value="316"  <?php @wp_automatic_opt_selected("316",$camp_general['cg_eb_cat']) ?> >Specialty Services</option>
							
							<option  value="888"  <?php @wp_automatic_opt_selected("888",$camp_general['cg_eb_cat']) ?> >Sporting Goods</option>
							
							<option  value="64482"  <?php @wp_automatic_opt_selected("64482",$camp_general['cg_eb_cat']) ?> >Sports Mem, Cards & Fan Shop</option>
							
							<option  value="260"  <?php @wp_automatic_opt_selected("260",$camp_general['cg_eb_cat']) ?> >Stamps</option>
							
							<option  value="1305"  <?php @wp_automatic_opt_selected("1305",$camp_general['cg_eb_cat']) ?> >Tickets & Experiences</option>
							
							<option  value="220"  <?php @wp_automatic_opt_selected("220",$camp_general['cg_eb_cat']) ?> >Toys & Hobbies</option>
							
							<option  value="3252"  <?php @wp_automatic_opt_selected("3252",$camp_general['cg_eb_cat']) ?> >Travel</option>
							
							<option  value="1249"  <?php @wp_automatic_opt_selected("1249",$camp_general['cg_eb_cat']) ?> >Video Games & Consoles</option>
							
							<option  value="99"  <?php @wp_automatic_opt_selected("99",$camp_general['cg_eb_cat']) ?> >Everything Else</option>		 
							 
			</select>
		</div>
		
		
		 <div class="field f_100">
               <div class="option clearfix">
                    
                    <input name="camp_options[]"  data-controls="ebay_custom_cat" id="ebay_custom_cat_c" value="OPT_EBAY_CUSTOM" type="checkbox">
                    <span class="option-title">
							Custom ebay category ID ?
                    </span>
                    <br>
                    
		            <div id="ebay_custom_cat" class="field f_100">
		               <label for="field6">
		                    Custom Category ID ( <a target="_blank" href="http://valvepress.com/post-ebay-subcategory-wordpress-using-wordpress-automatic/">how to get cat id</a>)
		               </label>
		               
		                <input value="<?php  echo @$camp_general['cg_ebay_custom']   ?>"  name="cg_ebay_custom" type="text">
		               
		            </div>
		            
               </div>
		 </div>
		
		<div   class="field f_100" >
			<label>
				Listing Type :
			</label>
			<select name="cg_eb_listing" >
							<option  value="All"  <?php @wp_automatic_opt_selected("All",$camp_general['cg_eb_listing']) ?> >All Listings</option>
							<option  value="Auction"  <?php @wp_automatic_opt_selected("Auction",$camp_general['cg_eb_listing']) ?> >Auction Only</option>
							<option  value="AuctionWithBIN&listingType2=FixedPrice"  <?php @wp_automatic_opt_selected("AuctionWithBIN&listingType2=FixedPrice",$camp_general['cg_eb_listing']) ?> >BIN Only</option>
							
 			</select>
		</div>
		 
		 <div   class="field f_100" >
		 	<label for="field-camp_youtube_order">
		 		eBay search order :
		 	</label>
		 	 
		 	<select name="cg_eb_order" >
		 		
		 		<option  value="BestMatch"  <?php @wp_automatic_opt_selected('BestMatch',$camp_general['cg_eb_order']) ?> >Best Match</option>
		 		<option  value="EndTimeSoonest"  <?php @wp_automatic_opt_selected('EndTimeSoonest',$camp_general['cg_eb_order']) ?> >Items Ending First</option>
		 		<option  value="StartTimeNewest"  <?php @wp_automatic_opt_selected('StartTimeNewest',$camp_general['cg_eb_order']) ?> >Newly-Listed Items First</option>
		 		<option  value="PricePlusShippingLowest"  <?php @wp_automatic_opt_selected('PricePlusShippingLowest',$camp_general['cg_eb_order']) ?> >Price + Shipping: Lowest First</option>
		 		<option  value="PricePlusShippingHighest"  <?php @wp_automatic_opt_selected('PricePlusShippingHighest',$camp_general['cg_eb_order']) ?> >Price + Shipping: Highst First</option>
		 		 
		 	</select>
		 </div>

         <div   class="field f_100">
               <div class="option clearfix">
                    <input id="eb_price" data-controls="eb_price_c" name="camp_options[]" value="OPT_EB_PRICE" type="checkbox">
                    <span class="option-title">
							Price range
                    </span>
                    <br>
                    
                    <div id="eb_price_c" class="field f_100">
		              
		                From <input style="width:100px" class="no-unify" value="<?php echo  @$camp_general['cg_eb_min']   ?>" name="cg_eb_min"    type="text"> To <input style="width:100px" class="no-unify" value="<?php echo  @$camp_general['cg_eb_max']   ?>" name="cg_eb_max"    type="text">
		            	
		              </div>
                    
               </div>
		 			 
		 
          
               <div class="option clearfix">
                    <input name="camp_options[]" value="OPT_EB_TOP" type="checkbox">
                    <span class="option-title">
							Top Rated Sellers
                    </span>
                    <br>
               </div>
		  			 
		 
          
               <div class="option clearfix">
                    <input name="camp_options[]" value="OPT_EB_DESCRIPTION" type="checkbox">
                    <span class="option-title">
							Search description
                    </span>
                    <br>
               </div>
		  		
		 
		  
               <div class="option clearfix">
                    <input name="camp_options[]" value="OPT_EB_SHIP" type="checkbox">
                    <span class="option-title">
							Free Shipping
                    </span>
                    <br>
               </div>
		  		 
		 
          
               <div class="option clearfix">
                    <input name="camp_options[]" value="OPT_EB_CACHE" type="checkbox">
                    <span class="option-title">
							Cache Items for faster posting  (uncheck to call eBay each post)
                    </span>
                    <br>
               </div>
		  
		 
		 
		 
		  
               <div class="option clearfix">
                    <input name="camp_options[]" value="OPT_EB_FULL_DESC_SPEC" type="checkbox">
                    <span class="option-title">
							Try to fetch detailed item info and item specifics 
                    </span>
                    <br>
               </div>
		  
		 
		  
               <div class="option clearfix">
                    <input data-controls="eb_iframe_height" name="camp_options[]" value="OPT_EB_FULL_DESC" type="checkbox">
                    <span class="option-title">
							Try to fetch item description iframe
                    </span>
                    
                    <br>
                    <div id="eb_iframe_height"  class="field f_100">
                    
                    	<label>
		                    Iframe height in pixels default 500
		               </label>
		               
		                <input value="<?php  echo   (@$camp_general['cg_eb_iframe_h'] )  ?>" placeholder="500"  name="cg_eb_iframe_h" type="text">
		               
                    
                    </div>
                    
                    <br>
               </div>
		  
		 
		    
               <div class="option clearfix">
                    <input name="camp_options[]" data-controls="eb_full_img_t"  value="OPT_EB_FULL_IMG" type="checkbox">
                    <span class="option-title">
							Try to fetch all images (by default single image)
                    </span>
                    <br>
                    
		            <div id="eb_full_img_t" class="field f_100">
		               <label for="field6">
		                    Image template (this is how the plugin will build images html) use [img_src] to replace the image src. use class="wp_automatic_gallery" to display images as gallery
		               </label>
		               
		                <input value="<?php  echo   (@$camp_general['cg_eb_full_img_t'] )  ?>"  name="cg_eb_full_img_t" type="text">
		               
		            </div>
               </div>
		 
		 
		  
               <div class="option clearfix">
                    <input name="camp_options[]" data-controls="eb_parm"  value="OPT_EB_PARAM" type="checkbox">
                    <span class="option-title">
							Append additional parameters to the REST request (Advanced)
                    </span>
                    <br>
                    
		            <div id="eb_parm" class="field f_100">
		               <label>
		                    url parameters 
		               </label>
		               
		                <input value="<?php  echo   (@$camp_general['cg_eb_param'] )  ?>"  name="cg_eb_param" type="text">
		                <div class="description">example:   &buyerPostalCode=b691sw </div>
		            </div>
               </div>
		  
		 
		  
               <div class="option clearfix">
                    <input name="camp_options[]"   value="OPT_EBAY_EXCERPT" type="checkbox">
                    <span class="option-title">
							Set the product description as excerpt  
                    </span>
                    <br>
               </div>
		  
		 
		  
               <div class="option clearfix">
                    <input name="camp_options[]" data-controls="eb_redirect_end"  value="OPT_EB_REDIRECT_END" type="checkbox">
                    <span class="option-title">
							Redirect to a specific page if item end date reached (& optionally trash)
                    </span>
                    <br>
                    
		            <div id="eb_redirect_end" class="field f_100">
		               <label >
		                    Page link to redirect to 
		               </label>
		               
		                <input value="<?php  echo   (@$camp_general['cg_eb_redirect_end'] )  ?>"  name="cg_eb_redirect_end" type="text">
		                
		                <div class="option clearfix">
		                    <input name="camp_options[]" value="OPT_EB_TRASH" type="checkbox">
		                    <span class="option-title">
									Trash posts also 
		                    </span>
		                    <br>
		               </div>
		                
		               
		            </div>
               </div>
		  

		 </div>
		 
		 </div>
		 <!--  / eBay Part -->
		 
		 <!--  Flicker Part -->
		 <div class="typepart Flicker" style="display:none">

		 <div   class="field f_100">
               <div class="option clearfix">
                    <input name="camp_options[]" value="OPT_FL_TAG" type="checkbox">
                    <span class="option-title">
							Add Flicker images tags as posts tags
                    </span>
                    <br>
               </div>
		 </div>		 
		 
		 <div id="fl_user_div" class="field f_100">
               <div class="option clearfix">
                    
                    <input name="camp_options[]" id="fl_user" value="OPT_FL_USER" type="checkbox">
                    <span class="option-title">
							Post from specific flicker user  
                    </span>
                    <br>
                    
		            <div id="fl_user_c" class="field f_100">
		               <label for="field6">
		                    User id (click <a target="_blank" href="http://idgettr.com/">here</a> to get the id) (example id : 59164655@N00 ) 
		               </label>
		                
		                <input value="<?php echo  @$camp_general['cg_fl_user']   ?>" name="cg_fl_user" id="field6"   type="text">
		                
		                <br><br>
		                
		                <label for="field6">
		                    <label>
		                    Album ID (Optional)
			               </label>
			                
		                </label>
		               
		                
		                <input value="<?php echo  @$camp_general['cg_fl_user_album']   ?>" name="cg_fl_user_album"   type="text">
		                if you want to post from specific album, paste the album id here (last numbers at the album url) and the user id above. for example the id for this <a href="https://www.flickr.com/photos/tonydefilippo/albums/72157660698727425">album</a> is "72157660698727425"
		                
		            	
		            	<br>
		            	<div class="field f_100">
		            	<input  data-controls-r='' name="camp_options[]" id="fl_full" value="OPT_FL_FULL" type="checkbox">
		                    <span class="option-title">
									Don't use keywords add images without filtering . 
		                    </span>
	                    </div>
	                    <br>
		            </div>
		            
               </div>
		 </div>
		 
		 <div   class="field f_100" >
		 	<label for="field-camp_youtube_order">
		 		Flicker search order :
		 	</label>
		 	 
		 	<select name="cg_fl_order" id="field1zz">
		 		<option  value="relevance"  <?php @wp_automatic_opt_selected('relevance',$camp_general['cg_fl_order']) ?> >Relevance</option>
		 		<option  value="date-posted-asc"  <?php @wp_automatic_opt_selected('date-posted-asc',$camp_general['cg_fl_order']) ?> >Date Posted ASC</option>
		 		<option  value="date-posted-desc"  <?php @wp_automatic_opt_selected('date-posted-desc',$camp_general['cg_fl_order']) ?> >Date Posted DESC</option>
		 		<option  value="date-taken-asc"  <?php @wp_automatic_opt_selected('date-taken-asc',$camp_general['cg_fl_order']) ?> >Date Taken ASC</option>
		 		<option  value="date-taken-desc"  <?php @wp_automatic_opt_selected('date-taken-desc',$camp_general['cg_fl_order']) ?> >Date Taken DESC</option>
		 		<option  value="interestingness-desc"  <?php @wp_automatic_opt_selected('interestingness-desc',$camp_general['cg_fl_order']) ?> >Interestingness DESC</option>
		 		<option  value="interestingness-asc"  <?php @wp_automatic_opt_selected('interestingness-asc',$camp_general['cg_fl_order']) ?> >Interestingness ASC</option>
		 
		 	</select>
		 </div>

		
	 	
				  
         <div   class="field f_100">
               <div class="option clearfix">
                    <input name="camp_options[]" value="OPT_FL_CACHE" type="checkbox">
                    <span class="option-title">
							Cache Images for faster posting  (uncheck to call flicker each post)
                    </span>
                    <br>
               </div>
               
               <div class="option clearfix">
                    <input data-controls="wp_automatic_fl_licenses" name="camp_options[]" value="OPT_FL_LICENSE" type="checkbox">
                    <span class="option-title">
							Search for specific license
                    </span>
                    <br>
                    
                    
                    <div id="wp_automatic_fl_licenses" class="field f_100">
                    	
                    	<div class="option clearfix">
		                    <input name="camp_options[]" value="OPT_FL_LICENSE_0" type="checkbox">
		                    <span class="option-title">
									All Rights Reserved
		                    </span>
		                    <br>
		               </div>	
		               
		               
		               <div class="option clearfix">
		                    <input name="camp_options[]" value="OPT_FL_LICENSE_1" type="checkbox">
		                    <span class="option-title">
									Attribution-NonCommercial-ShareAlike License
		                    </span>
		                    <br>
		               </div>
		               
		               <div class="option clearfix">
		                    <input name="camp_options[]" value="OPT_FL_LICENSE_2" type="checkbox">
		                    <span class="option-title">
									Attribution-NonCommercial License
		                    </span>
		                    <br>
		               </div>
		               
		               
		               
                    	<div class="option clearfix">
		                    <input name="camp_options[]" value="OPT_FL_LICENSE_3" type="checkbox">
		                    <span class="option-title">
									Attribution-NonCommercial-NoDerivs License
		                    </span>
		                    <br>
		               </div>
		               
		               <div class="option clearfix">
		                    <input name="camp_options[]" value="OPT_FL_LICENSE_4" type="checkbox">
		                    <span class="option-title">
									Attribution License
		                    </span>
		                    <br>
		               </div>
		               
		               <div class="option clearfix">
		                    <input name="camp_options[]" value="OPT_FL_LICENSE_5" type="checkbox">
		                    <span class="option-title">
									Attribution-ShareAlike License
		                    </span>
		                    <br>
		               </div>
		               
		               <div class="option clearfix">
		                    <input name="camp_options[]" value="OPT_FL_LICENSE_6" type="checkbox">
		                    <span class="option-title">
									Attribution-NoDerivs License
		                    </span>
		                    <br>
		               </div>
		               
		               <div class="option clearfix">
		                    <input name="camp_options[]" value="OPT_FL_LICENSE_7" type="checkbox">
		                    <span class="option-title">
									No known copyright restrictions
		                    </span>
		                    <br>
		               </div>
		               
		               <div class="option clearfix">
		                    <input name="camp_options[]" value="OPT_FL_LICENSE_8" type="checkbox">
		                    <span class="option-title">
									United States Government Work
		                    </span>
		                    <br>
		               </div>
		                           
                    
                     
                    
               </div>
               
		 </div>
		 
		 </div>
		 
		 </div>
		 <!--  / flicker Part -->
		 
		 <!-- Click bank part -->
		 <div class="typepart Clickbank" style="display:none">
		   <div id="field1zz-container" class="field f_100 ">
               <label for="field1zz">
                    Add Products from this category :
               </label>
               <select name="camp_cb_category" id="field1zz">
                    <option id="field1-1" value="All">
                         All
                    </option>
 

					<?php
	 					$query="select * from {$prefix}automatic_categories where cat_parent ='0' ";
						$res=$wpdb->get_results($query);
						//print_r($res);
						$printedCBCats= array();
						
						foreach($res as $cat){
							
							if(in_array($cat->cat_id, $printedCBCats)) continue;
							
							$printedCBCats[] = $cat->cat_id;
							
							echo '<option id="field1-1" value="mainCategoryId='.$cat->cat_id.'"';
							wp_automatic_opt_selected('mainCategoryId='.$cat->cat_id ,$camp_cb_category );
							echo '>'.$cat->cat_name.'</option>';
							  
							$query="select * from {$prefix}automatic_categories where cat_parent='$cat->cat_id'";
							$ret=$wpdb->get_results($query);
							foreach($ret as $sub){
								
								if(in_array($sub->cat_id, $printedCBCats)) continue;
									
								$printedCBCats[] = $sub->cat_id;
								
								 echo '<option id="field1-1" value="mainCategoryId='.$cat->cat_id.'&subCategoryId='.$sub->cat_id.'" ';
								 @wp_automatic_opt_selected('mainCategoryId='.$cat->cat_id.'&subCategoryId='.$sub->cat_id ,$camp_cb_category );
								 echo ' >-- '.$sub->cat_name.'</option>';
							}
						}
						
					 ?>



               </select>
          </div>
          
          <div class="field f_100">
               <div class="option clearfix">
                    <input name="camp_options[]"  value="OPT_CB_DESCRIPTION" type="checkbox">
                    <span class="option-title">
							Try to fetch product text from original site      
                    </span>
                    <br>
               </div>
		 </div>
          
          <div class="field f_100 ">
               <label>
                    Specific products language :
               </label>
               <select name="cg_cb_lang">
                    
                    <option value="EN" <?php @wp_automatic_opt_selected('EN',$camp_general['cg_cb_lang']) ?> >
                         English
                    </option>
                    
                    <option value="DE" <?php @wp_automatic_opt_selected('DE',$camp_general['cg_cb_lang']) ?> >
                         German
                    </option>
                    
                    <option value="ES" <?php @wp_automatic_opt_selected('ES',$camp_general['cg_cb_lang']) ?> >
                         Spanish
                    </option>
                    
                    <option value="FR" <?php @wp_automatic_opt_selected('FR',$camp_general['cg_cb_lang']) ?> >
                         French
                    </option>
                    
                    <option value="IT" <?php @wp_automatic_opt_selected('IT',$camp_general['cg_cb_lang']) ?> >
                         Italian
                    </option>
                    
                    <option value="PT" <?php @wp_automatic_opt_selected('PT',$camp_general['cg_cb_lang']) ?> >
                         Portuguese
                    </option>
                    
               </select>
          </div>
          
          
          <div id="field1zz-container" class="field f_100">
               <label for="field1zz">
                    Search Order By :
               </label>
               <select name="camp_search_order" id="field1zz">
               
                    <option id="field1-1" value="" <?php @wp_automatic_opt_selected('',$camp_search_order) ?> >
                        Keyword Relevance
                    </option>
                    <option id="field1-1" value="GRAVITY" <?php @wp_automatic_opt_selected('GRAVITY',$camp_search_order) ?> >
                         Gravity
                    </option>
                    <option id="field1-2" value="POPULARITY"  <?php @wp_automatic_opt_selected('POPULARITY',$camp_search_order) ?>  >
                         Popularity
                    </option>
                    <option id="field1-3" value="AVERAGE_EARNINGS_PER_SALE"  <?php @wp_automatic_opt_selected('AVERAGE_EARNINGS_PER_SALE',$camp_search_order) ?>  >
                         Average Earning / Sale
                    </option>
               </select>
          </div>
          
          </div>
          
		 <!-- /clickbank part -->
		 		
          
                     
            <div id="field6-container" class="field f_100">
               <label for="field6">
                    Post title template
               </label>
               <input value="<?php echo htmlentities($camp_post_title)  ?>" name="camp_post_title" id="field6" required="required" type="text">
            </div>

          <div id="field11-container" class="field f_100">
               <label for="field11">
                    Post text template <i>(spintax enabaled, like {awesome|amazing|Great})</i>
               </label>
               <textarea  required="required" rows="5" cols="20" name="camp_post_content" id="field11"><?php echo $camp_post_content ?></textarea>
               <div class="supportedTags"></div>
          </div>
	
	         <div id="field1zz-container" class="field f_100">

               <label for="field1zz">
                    Post type
               </label>

                 <select name="camp_post_type" id="field1zzz">
   		
   				  <?php 
   				  $post_types = get_post_types();
									
					foreach($post_types as $post_type){
 
				  	 echo  '<option value="'.$post_type.'"';
				  	
					  	wp_automatic_opt_selected($camp_post_type,$post_type);
				  	
				  	 echo '>'.$post_type ;
									  	
					echo '</option>';
				  }
				  
		 
				  
				  ?>
                </select>

          </div>
          
     
	          
        
          <div id="field1zz-container" class="field f_100">

               <label for="field1zz">
                    Post posts to this category
               </label>

               <select  style="height:140px" class="no-unify" name="camp_post_category[]" id="field1zz" multiple>
   		
   				  <?php
   				  
   				    // Select categories arguments
					$args=array('orderby' => 'name','order' => 'ASC','hide_empty' => 0);

					foreach($post_types as $post_type){
		
						// Get categories taxononomies
						$customPostTaxonomies = get_object_taxonomies($post_type);
						
						if(count($customPostTaxonomies) > 0)
						{
							foreach($customPostTaxonomies as $tax){
								
								// If category list it's items
								if(is_taxonomy_hierarchical($tax)){
								
									$args=array (
											'hide_empty'               => 0 ,
											'taxonomy'                 => $tax ,
											'type'                     => $post_type 	        
									);
		 
								 	
									$categories=  get_categories($args);
									
									$parentCats  = array();
									$childCats   = array();
									$orderedCats = array();
									
									//function to display categories 
									
									
									//Get parent cats 
									foreach ($categories as $category){
										
										if($category->parent === 0){
											
											$parentCats[] =$category;
											
										}else{
											
											$childCats[$category->parent][]=$category;
											
										}
									
									}
									

									//printing
									foreach ($parentCats as $parentCat){
										wp_automatic_category($parentCat, $childCats ,$tax,$post_type,$camp_post_category);
									}
									
									
									/*
									echo '<pre>';
									print_r($parentCats);
									print_r($childCats);
										
									omak();
									 
									
									
									  foreach ($categories as $category) {
									  	
									  		// Display category
										  	echo  '<option   data-tax="'.$tax.'" class="post_category post_'.$post_type.'" value="'.$category->cat_ID.'"';
										  	wp_automatic_opt_selected($camp_post_category,$category->cat_ID);
									  	 	echo '>'.$tax.': '.$category->cat_name . '  (id='.$category->cat_ID.') (posts:'.$category->category_count.')';
											echo '</option>';
											
									  }
									  */
							  
							  }//hiracial
									
							}//foreach taxonomy
						}
						
					}// foreach post type

	 
				  ?>
                </select>

                <input id="cg_camp_tax" type="hidden" value="<?php echo @$camp_general['cg_camp_tax'] ?>" name="cg_camp_tax" />
                
                <p>Press CTRL + category to multiselect</p>
                
          </div>
          
         <div class="field f_100">
		 <div class="option clearfix">
                    
                    <input name="camp_options[]" data-controls="keyword_to_cat" value="OPT_KEYWORD_CAT" type="checkbox">
                    <span class="option-title">
							Keyword to category 
                    </span>
                    <br>
                    
		            <div id="keyword_to_cat" class="field f_100">
		               <label for="field6">
		                    Keyword|categoryId (one per line)
		               </label>
		               <textarea name="cg_keyword_cat" ><?php echo htmlentities($camp_general['cg_keyword_cat'],ENT_COMPAT, 'UTF-8' )  ?></textarea>
		            	<div class="description">
		            		This option will search the content for the keyword and if exists, it will assign the set category to the post
		            		<br><br>*example if you added "sugar|5" without quotes ,The plugin  will check the content and if it contains the keyword "sugar" it will assign the post to the category which id=5
		            		<br><br>*Look at the categories above for the correct numeric id
		            	</div>
		            
		            </div>
		            
		            
		            
		            
               </div>
          </div>
          
          

         <div id="field1zzv-container" class="field f_100">

               <label for="field1zzv">
                    Posts author
               </label>

 				 <?php wp_dropdown_users(array('name' => 'camp_post_author','selected'=>$camp_post_author)); ?>

          </div>
          
          
          <div id="field1zz-container" class="field f_100">
               <label for="field1zz">
                    New post status
               </label>
               <select name="camp_post_status" id="field1zz">
                    <option id="field1-1" value="draft"  <?php @wp_automatic_opt_selected('draft',$camp_post_status) ?> >
                         Draft
                    </option>
                    <option id="field1-2" value="publish"  <?php @wp_automatic_opt_selected('publish',$camp_post_status) ?>  >
                         Published
                    </option> 
                    
                    <option id="field1-2" value="pending"  <?php @wp_automatic_opt_selected('pending',$camp_post_status) ?>  >
                         Pending
                    </option>
               </select>
          </div>

		<div class="field f_100">
               <div class="option clearfix">
                    <input name="camp_options[]"  value="OPT_USE_PROXY" type="checkbox">
                    <span class="option-title">
							Use proxies I have added at the settings page for the connection <br>(Usefull if your server is blocked from the source)      
                    </span>
                    <br>
               </div>
		 </div>

          
          <div class="field f_100">
               <div class="option clearfix">
                    <input name="camp_options[]"  value="OPT_DRAFT_PUBLISH" type="checkbox">
                    <span class="option-title">
							Add the post as draft then publish after setting featured image/comments/tags <br>(Recommended for other plugins that works on publish)      
                    </span>
                    <br>
               </div>
		 </div>

          <div id="limit_content" class="field f_100">
               <div class="option clearfix">
                    
                    <input name="camp_options[]"  data-controls="post_format_c" id="post_format_opt" value="OPT_FORMAT" type="checkbox">
                    <span class="option-title">
							Custom post format ?
                    </span>
                    <br>
                    
		            <div id="post_format_c" class="field f_100">
		               <label for="field6">
		                    Post format name
		               </label>
		               
		                <input value="<?php  echo @$camp_general['cg_post_format']   ?>"  name="cg_post_format" type="text">
		               
		            </div>
		            
               </div>
		 </div>
		 
		 <div  class="field f_100">
               <div class="option clearfix">
                    
                    <input name="camp_options[]" data-controls = "tags_c"  value="OPT_ADD_TAGS" type="checkbox">
                    <span class="option-title">
							Tag the posts with specific tags
                    </span>
                    <br>
                    
		            <div id="tags_c" class="field f_100">
		               <label for="field6">
		                    Tags(one per line)
		               </label>
		               
		            	<textarea name="cg_post_tags" ><?php echo @$camp_general['cg_post_tags'] ?></textarea>
		            	
		            	<input name="camp_options[]" data-controls="random_tags_count"   value="OPT_RANDOM_TAGS" type="checkbox">
		            	
		            	<span class="option-title">
							Randomly pick tags from the box
                    	</span>
                    	
                    	
                    	<div id="random_tags_count" class="field f_100">
				               <label for="field6">
				                    Number of Tags ?
				               </label>
				               
				                <input value="<?php echo @$camp_general['cg_tags_limit']   ?>" max="1000" min="1" name="cg_tags_limit" required="required" id="random_tags_count_field" class="ttw-range range"
		               type="range">
				               
		            </div>
                    	
		            	
		            </div>
		            
               </div>
		 </div>
		 
		 <div id="field1zz-container" class="field f_100">
               <div class="option clearfix">
                    <input data-controls="wp_automtic_no_numbers"  name="camp_options[]" id="field2-1" value="OPT_TITLE_TAG" type="checkbox">
                    <span class="option-title">
							Set title words as tags 
                    </span>
                    <br>
                    
                    <div id="wp_automtic_no_numbers">
                    
                    	 <input   name="camp_options[]"  value="OPT_TITLE_NUM" type="checkbox">
		                    <span class="option-title">
									Skip numbers 
		                    </span>
		                 <br>
                    
                    </div>
                    
               </div>
		 </div>
		 
		 
		 <div class="field f_100">
		 <div class="option clearfix">
                    
                    <input name="camp_options[]" data-controls="keyword_to_tag" value="OPT_KEYWORD_TAG" type="checkbox">
                    <span class="option-title">
							Keyword to tag 
                    </span>
                    <br>
		            <div id="keyword_to_tag" class="field f_100">
		               <label for="field6">
		                    Keyword|tag (one per line)
		               </label>
		               <textarea name="cg_keyword_tag" ><?php echo htmlentities($camp_general['cg_keyword_tag'] ,ENT_COMPAT, 'UTF-8' )  ?></textarea>
		            	<div class="description">
		            		This option will search the content for the keyword and if exists, it will tag the post with the set tag
		            		<br><br>*example if you added "Messi|Sport" without quotes ,The plugin  will check the content and if it contains the keyword "Messi" it tag the post with "Sport"
		            	</div>
		            
		            </div>
		            
               </div>
          </div>      
           
         <div id="field1zz-container" class="field f_100">
               <div class="option clearfix">
                    <input data-controls="wp_automatic_spin_title" name="camp_options[]" id="field2-1" value="OPT_TBS" type="checkbox">
                    <span class="option-title">
							Spin Posted Content using "the best spinner" <i>(require the best spinner account)</i> 
                    </span>
                    <br>
               </div>
               
               <div id="wp_automatic_spin_title"  class="field f_100">
               
	               	<div class="option clearfix">
	                    <input name="camp_options[]" id="field2-1" value="OPT_TBS_TTL" type="checkbox">
	                    <span class="option-title">
								Don't spin the title 
	                    </span>
	                    <br>
	               </div>
               
               </div>
               
		 </div>
		 
		 
		 <div id="field1zz-container" class="field f_100">
		 <div class="option clearfix">
                    
                    <input name="camp_options[]" data-controls="replace_regex"   value="OPT_RGX_REPLACE" type="checkbox">
                    <span class="option-title">
							Search and replace (REGEX enabled) ( pattern1|pattern2) 
                    </span>
                    <br>
                    
		            <div id="replace_regex" class="field f_100">
		               <label for="field6">
		                    Search|Replace one per line
		               </label>
		               <textarea name="cg_regex_replace" ><?php echo htmlentities($camp_general['cg_regex_replace'],ENT_COMPAT, 'UTF-8' )  ?></textarea>
		            
		            	
		            	<br>
		            	<div class="field f_100">
			            	<input name="camp_options[]"    value="OPT_RGX_REPLACE_PROTECT" type="checkbox">
		                    <span class="option-title">
								Protect html tags  before replacing? 
		                    </span>
		                </div>
		                
		                 <div class="field f_100">    
		                    <input name="camp_options[]"    value="OPT_RGX_REPLACE_WORD" type="checkbox">
		                    <span class="option-title">
								Words replace? (in case above box contining words or sentences) 
		                    </span>
		                    
		                    
	                    </div>
	                    <br>
		                
		                <div class="field f_100">    
		                    <input name="camp_options[]"    value="OPT_RGX_REPLACE_TTL" type="checkbox">
		                    <span class="option-title">
								Apply to titles also? 
		                    </span>
		                    <div class="description"><i>add "|titleonly" without quotes at the end of the rule if you want to apply to only titles</i></div>
		                    
	                    </div>
	                    <br>
	                    
	                    
		            
		            </div>
		            
		            
		            
		            
               </div>
          </div>
		           
         <div id="replace_links" class="field f_100">
               <div class="option clearfix">
                    
                    <input name="camp_options[]" id="replace_link" value="OPT_REPLACE" type="checkbox">
                    <span class="option-title">
							Replace specified keywords in the fetched article with a link
                    </span>
                    <br>
                    
		            <div id="replace_link_c" class="field f_100">
		               <label for="field6">
		                    Link to replace keywords with
		               </label>
		               <input value="<?php echo $camp_replace_link   ?>" name="camp_replace_link" id="field6"   type="text">
		             
		            </div>
		            
               </div>
		 </div>

		 

          <div id="limit_content" class="field f_100">
               <div class="option clearfix">
                    
                    <input name="camp_options[]"  data-controls="limit_content_c" id="limit_content_opt" value="OPT_LIMIT" type="checkbox">
                    <span class="option-title">
							Limit content size to xx chars
                    </span>
                    <br>
                    
		            <div id="limit_content_c" class="field f_100">
		               <label for="field6">
		                    Number of characters ?
		               </label>
		               
		                <input value="<?php echo @$camp_general['cg_content_limit']   ?>" max="20000" min="0" name="cg_content_limit" id="fieldlimit" required="required" class="ttw-range range"
               type="range">
		               
		            </div>
		            
               </div>
		 </div>      


		<div id="limit_title" class="field f_100">
               <div class="option clearfix">
                    
                    <input name="camp_options[]"  data-controls="limit_title_c" id="limit_title_opt" value="OPT_LIMIT_TITLE" type="checkbox">
                    <span class="option-title">
							Limit title size to xx chars
                    </span>
                    <br>
                    
		            <div id="limit_title_c" class="field f_100">
		               <label>
		                    Number of characters ?
		               </label>
		               
		                <input value="<?php echo @$camp_general['cg_title_limit']   ?>" max="20000" min="0" name="cg_title_limit" id="fieldlimit2" required="required" class="ttw-range range"
               type="range">
		               
		            </div>
		            
               </div>
		 </div>      
		 
          
         <div id="field1zz-container" class="field f_100">
               <div class="option clearfix">
                    <input  name="camp_options[]" id="field2-1" value="OPT_STRIP" type="checkbox">
                    <span class="option-title">
							Strip original links from the post (hyperlinks) 
                    </span>
                    <br>
                    
                     
                    
               </div>
		 </div>
		 
		  
         <div id="field1zzx-container" class="field f_100">
               <div class="option clearfix">
                    <input   data-controls="wp_automatic_featured_list_opt" name="camp_options[]" id="field2x-1" value="OPT_THUMB" type="checkbox">
                    <span class="option-title">
							Set First image/Vid image as featured image  
                    </span>
                    <br>
                    
                    	
                    
                    	<div  id="wp_automatic_featured_list_opt" class="field f_100">
			                
			                
			                <div class="option clearfix ">
			                    <input data-controls="wp_automatic_strip_div" name="camp_options[]"  value="OPT_THUMB_STRIP" type="checkbox">
			                    <span class="option-title">
										Strip first image from the content after setting it as featured image  
			                    </span>
			                    <br>
			                    
			                    <div class="field f_100" id="wp_automatic_strip_div">
				                    <div  class="option clearfix">
				                    	
				                    	 <input  name="camp_options[]"  value="OPT_THUMB_STRIP_FULL" type="checkbox">
						                    <span class="option-title">
													Actually strip the image from the content (by default the plugin filter the content on display to strip it) 
						                    </span>
						                    <br>
				                    	
				                    </div>
			                    </div>
			                    
			               </div>
			               
			               <div  class="option clearfix">
			                    <input name="camp_options[]" id="field2xz-1" value="OPT_THUMB_CLEAN" type="checkbox">
			                    <span class="option-title">
										Try to generate a name for the image from the post title  
			                    </span>
                    		</div>
                    		
                    		<div  class="option clearfix">
			                    <input name="camp_options[]"  value="OPT_THUMB_ALT" type="checkbox">
			                    <span class="option-title">
										Set title of the image at media library from the post title.  
			                    </span>
                    		</div>
		                    
		                <div class="option clearfix">
		                    <input data-controls="minimum_image_width"  name="camp_options[]"  value="OPT_THUMB_WIDTH_CHECK" type="checkbox">
		                    <span class="option-title">
									Check image width and skip images with width below a specifc width in pixels   
		                    </span>

		                    <div id="minimum_image_width">
		                    
		                     <input value="<?php echo @$camp_general['cg_minimum_width']   ?>" max="1000" min="0" name="cg_minimum_width" id="cg_minimum_width_f"  required="required" class="ttw-range range" type="range">
		                    
		                    </div>
		                    
	                    </div>
	                    
	                    
	                    <input data-controls="wp_automatic_featured_list" name="camp_options[]" id="field2x-1" value="OPT_THUMB_LIST" type="checkbox">
	                    <span class="option-title">
								Set random featured image if no image exists in the content   
	                    </span>
	                    
	                    <br>
	                    
			            <div id="wp_automatic_featured_list" class="field f_100">
			               <label for="field6">
			                    Image list one image url per line 
			               </label>
			               
			            	<textarea name="cg_thmb_list" ><?php echo @$camp_general['cg_thmb_list']?></textarea>
			            	
			            	 <input  name="camp_options[]"  value="OPT_THUMB_LIST_FORCE" type="checkbox">
			                 <span class="option-title">
										Force using these images and ignore source found images   
			                 </span>
			            	
			            </div>
			            
			            <div class="option clearfix">
		                    <input  name="camp_options[]"  value="OPT_THUM_NELO" type="checkbox">
		                    <span class="option-title">
									Don't save the image to my server, I will use <a href="https://wordpress.org/plugins/external-featured-image/screenshots/" target="_blank">this free plugin</a> to display the featured image from it's source   
		                    </span>
	                    </div>
	                    
						<div class="typepart Feeds option clearfix">
		                    <input data-controls="og_image_reverse_order" name="camp_options[]"  value="OPT_FEEDS_OG_IMG" type="checkbox">
		                    <span class="option-title">
									Extract the image from the og:image tag (used for facebook thumb)   
		                    </span>
		                    
		                    <div id="og_image_reverse_order">
		                    	<input  name="camp_options[]"  value="OPT_FEEDS_OG_IMG_REVERSE" type="checkbox">
			                    <span class="option-title">
										Skip the og:image if the content already contains an image.   
			                    </span>
			                    	
		                    </div>
		                    
		                    
	                    </div>
	
	                    
                    </div>
                    
               </div>
		 </div>

		 		 
		  
         <div id="field1zzxz-container" class="field f_100">
               <div class="option clearfix">
                    <input data-controls="wp_automatic_clean_imgs" name="camp_options[]" id="field2xz-1" value="OPT_CACHE" type="checkbox">
                    <span class="option-title">
							Download images to my server  
                    </span>
                    <br>
                    
                    <div class="field f_100 ">
	                    <div id="wp_automatic_clean_imgs" class="option clearfix">
		                    <input name="camp_options[]" id="field2xz-1" value="OPT_CACHE_CLEAN" type="checkbox">
		                    <span class="option-title">
									Try to generate names for images from the post title  
		                    </span>
                    	</div>
               		</div>
                    
               </div>
		 </div>
		 
		 <div   class="field f_100">
               <div class="option clearfix">
                    <input name="camp_options[]"   value="OPT_CACHE_REFER_NULL" type="checkbox">
                    <span class="option-title">
							When loading images, set the refer value to null (no refer)   
                    </span>
                    <br>
               </div>
		 </div>
		 
		 <div class="field f_100">
               <div class="option clearfix">
                    <input name="camp_options[]"  value="OPT_LINK_SOURSE" type="checkbox">
                    <span class="option-title">
							Make permalinks link directly to the source (Posts will not load at your site)  
                    </span>
                    <br>
               </div>
		 </div>
		 
		 <div class="field f_100">
               <div class="option clearfix">
                    <input name="camp_options[]"  value="OPT_LINK_CANONICAL" type="checkbox">
                    <span class="option-title">
							Add <a href="http://moz.com/learn/seo/canonicalization">Canonical Tag</a> with the original post link to the post for SEO      
                    </span>
                    <br>
               </div>
		 </div>
		 
		   <div id="exact_match" class="field f_100">
               <div class="option clearfix">
                    
                    <input name="camp_options[]" id="exact_option" value="OPT_EXACT" type="checkbox">
                    <span class="option-title">
							Only post the article if it contains one or more of specific words
                    </span>
                    <br>
                    
		            <div id="exact_match_c" class="field f_100">
		               <label for="field6">
		                    Exact match words (one word per line )
		               </label>
		               
		            	<textarea name="camp_post_exact" ><?php echo $camp_post_exact?></textarea>
		            	
		            	<div class="option clearfix">
			            	<input name="camp_options[]" id="exact_option" value="OPT_EXACT_AFTER" type="checkbox">
		                    <span class="option-title">
									Apply to final content after filling the template (by default applies to content just fetched from the source)
		                    </span>
	                    </div>
	                    
	                    <div class="option clearfix">
		                    <input name="camp_options[]"  value="OPT_EXACT_TITLE_ONLY" type="checkbox">
		                    <span class="option-title">
									Only check at the title (by default the title and content get checked)
		                    </span>
	                    </div>
	                    
	                    <div class="option clearfix">
		                    <input name="camp_options[]"  value="OPT_EXACT_STR" type="checkbox">
		                    <span class="option-title">
									Exact string match (by default REGEX word match is used)
		                    </span>
	                    </div>
		            	
		            </div>
		            
               </div>
		 </div>
		 
		 
		 		
		 <div id="exact_execlude" class="field f_100">
               <div class="option clearfix">
                    
                    <input name="camp_options[]" id="execlude_option" value="OPT_EXECLUDE" type="checkbox">
                    <span class="option-title">
							Skip post if it contains one or more of these words
                    </span>
                    <br>
                    
		            <div id="exact_execlude_c" class="field f_100">
		               <label for="field6">
		                    banned words (one word per line )
		               </label>
		               
		            	<textarea name="camp_post_execlude" ><?php echo $camp_post_execlude ?></textarea>
		            	
		            	<input name="camp_options[]" id="exact_option" value="OPT_EXECLUDE_AFTER" type="checkbox">
	                    <span class="option-title">
								Apply to final content after filling the template (by default applies to content just fetched from the source)
	                    </span>
		            	
		            </div>
		            
               </div>
		 </div>
		 
		 <div class="field f_100">
               <div class="option clearfix">
                    
                    <input name="camp_options[]" data-controls="exact_match_regex_c" value="OPT_EXACT_REGEX" type="checkbox">
                    <span class="option-title">
							Only post the item if it matches one of these specific REGEX (Regular expressions)
                    </span>
                    <br>
                    
		            <div id="exact_match_regex_c" class="field f_100">
		               <label for="field6">
		                   Escapped regular expression without delimiter 
		               </label>
		               
		            	<textarea name="cg_camp_post_regex_exact" ><?php echo @$camp_general['cg_camp_post_regex_exact']?></textarea>
		            	<div class="description">*default delimiter is {} <br>*one REGEX per line</div>
 		            </div>
		            
               </div>
		 </div>
		 
		 <div class="field f_100">
               <div class="option clearfix">
                    
                    <input name="camp_options[]" data-controls="exclude_match_regex_c" value="OPT_EXCLUDE_REGEX" type="checkbox">
                    <span class="option-title">
							Skip the post if the item matches one of these specific REGEX (Regular expressions)
                    </span>
                    <br>
                    
		            <div id="exclude_match_regex_c" class="field f_100">
		               <label for="field6">
		                   Escapped regular expression without delimiter 
		               </label>
		               
		            	<textarea name="cg_camp_post_regex_exclude" ><?php echo @$camp_general['cg_camp_post_regex_exclude']?></textarea>
		            	<div class="description">*default delimiter is {} <br>*one REGEX per line</div>
 		            </div>
		            
               </div>
		 </div>
		 
		 <div class="field f_100">
		    <div class="option clearfix">
                    <input name="camp_options[]"   value="OPT_FEED_TITLE_SKIP" type="checkbox">
                    <span class="option-title">
							Skip the post if there is there is already a published one with same title in the database
                    </span>
                    <br>
             </div>
         </div>
		 
		 <div class="field f_100">
               <div class="option clearfix">
                    <input name="camp_options[]"  value="OPT_LINK_ONCE" type="checkbox">
                    <span class="option-title">
							Never post the same link again <br>( by default if it was completely deleted it may get posted again)      
                    </span>
                    <br>
               </div>
		 </div>
		 
		 <div class="field f_100">
               <div class="option clearfix">
                    <input name="camp_options[]"  value="OPT_NO_DEACTIVATE" type="checkbox">
                    <span class="option-title">
							Never deactivate keywords for one hour(Not Recommended)<br>(By default if the source has no more new items, posting idles for one hour)      
                    </span>
                    <br>
               </div>
		 </div>
		 
		 <div class="field f_100">
               <div class="option clearfix">
                    <input name="camp_options[]"  value="OPT_NO_COMMENT_LINK" type="checkbox">
                    <span class="option-title">
							Don't add links for author at comments <br>(only applicable if the campaign supports comments and posting comments is active)      
                    </span>
                    <br>
               </div>
		 </div>
		 
		 
		 
		 
		 <div  class="field f_100">
               <div class="option clearfix">
                    
                    <input data-controls="wpml_lang_letters" name="camp_options[]" id="replace_link" value="OPT_WPML" type="checkbox">
                    <span class="option-title">
							Set a WPML language for posted posts
                    </span>
                    <br>
                    
		            <div id="wpml_lang_letters" class="field f_100">
		               
		               <label>
		                    Two letters language code. for example add "de" for german. 
		               </label>
		               <input value="<?php echo @$camp_general['cg_wpml_lang']   ?> " name="cg_wpml_lang"    type="text">
		               
		               <div class="option clearfix">
			               <input name="camp_options[]"  value="OPT_LINK_PREFIX" type="checkbox">
		                   <span class="option-title">
								Post item even if there is already a posted one from another campaign (By default same url get posted once)(Beta)      
		                   </span>
		                   <br><div class="description"><small><i>(This will suffix the orignal url to make a new url by adding a parameter named "rand" )</i></small></div>
		               </div>    
		             
		            </div>
		             
               </div>
		 </div>
		 
		 <div class="field f_100">
               <div class="option clearfix">
                    
                    <input name="camp_options[]" data-controls="taxonmy_c"   value="OPT_TAXONOMY_TAG" type="checkbox">
                    <span class="option-title">
							Set custom taxonomy for tags (If you are using a custom post type)
                    </span>
                    <br>
                    
		            <div id="taxonmy_c" class="field f_100">
		               <label for="field6">
		                    Taxonomy name 
		               </label>
		               <input value="<?php echo $camp_general['cg_tag_tax']   ?>" name="cg_tag_tax"  type="text">
		             	<div class="description">Visit the tags page and read the taxonomy value and paste here. for example woo-commerce products tags page link contains "taxonomy=product_tag&post_type=product" then the taxonomy is product_tag</div>
		            </div>
		            
               </div>
		 </div>
		 
		
		 <div id="translate_post" class="field f_100">
               <div class="option clearfix">
                    
                    <?php 
                    
	                    
	                    // Microsoft langues and langauges codes 
	                    $langs = explode(',',"---,Arabic,Bosnian (Latin),Bulgarian,Catalan,Chinese Simplified,Chinese Traditional,Croatian,Czech,Danish,Dutch,English,Estonian,Finnish,French,German,Greek,Haitian Creole,Hebrew,Hindi,Hmong Daw,Hungarian,Indonesian,Italian,Japanese,Kiswahili,Klingon,Klingon (pIqaD),Korean,Latvian,Lithuanian,Malay,Maltese,Norwegian,Persian,Polish,Portuguese,QuerÃ©taro Otomi,Romanian,Russian,Serbian (Cyrillic),Serbian (Latin),Slovak,Slovenian,Spanish,Swedish,Thai,Turkish,Ukrainian,Urdu,Vietnamese,Welsh,Yucatec Maya" );
	                    $langs_c = explode(',', "no,ar,bs-Latn,bg,ca,zh-CHS,zh-CHT,hr,cs,da,nl,en,et,fi,fr,de,el,ht,he,hi,mww,hu,id,it,ja,sw,tlh,tlh-Qaak,ko,lv,lt,ms,mt,nor,fa,pl,pt,otq,ro,ru,sr-Cyrl,sr-Latn,sk,sl,es,sv,th,tr,uk,ur,vi,cy,yua");
	                    
	                    // Google languages and languages codes
	                    $g_langs=array("---","Auto-Detect","Afrikaans","Albanian","Arabic","Armenian","Belarusian","Bulgarian","Catalan","Chinese","Croatian","Czech","Danish","Dutch","English","Estonian","Filipino","Finnish","French","Galician","German","Greek","Hebrew","Hindi","Hungarian","Icelandic","Indonesian","Irish","Italian","Japanese","Korean","Latvian","Lithuanian","Macedonian","Malay","Maltese","Persian","Polish","Portuguese","Romanian","Russian","Serbian","Slovak","Slovenian","Spanish","Swahili","Swedish","Thai","Turkish","Ukrainian","Vietnamese","Welsh","Yiddish","Norwegian");
	                    $g_langs_c=array("no","auto","af","sq","ar","hy","be","bg","ca","zh-CN","hr","cs","da","nl","en","et","tl","fi","fr","gl","de","el","iw","hi","hu","is","id","ga","it","ja","ko","lv","lt","mk","ms","mt","fa","pl","pt","ro","ru","sr","sk","sl","es","sw","sv","th","tr","uk","vi","cy","yi","nor");
                    	
	                    
                    ?>
                    
                    <input name="camp_options[]" id="translate_option" value="OPT_TRANSLATE" type="checkbox">
                    <span class="option-title">
							Translate the post before posting (using Microsoft Translator/Google Translate)
        			</span>
                    <br>
                    
                    
		            <div id="translate_c" class="field f_100">
		            
		            
		            <div id="field1zz-container" class="field f_100">
			               <label>
			                    Translator:
			               </label>
			               <select name="cg_translate_method"  data-filters=".wp_automatic_lang_select" >
			                    <option value="microsoftTranslator"  <?php @wp_automatic_opt_selected('microsoftTranslator',$camp_general['cg_translate_method']) ?> >
			                         Microsoft Translator
			                    </option>
			                    <option  value="googleTranslator"  <?php @wp_automatic_opt_selected( 'googleTranslator' , $camp_general['cg_translate_method'] ) ?>  >
			                         Google Translator
			                    </option> 
			                    
			                    
			               </select>
			          </div>
		            
		               From  
		                
		               	<select name="camp_translate_from" class="wp_automatic_lang_select translate_t" style="width:25%;padding:0;">
		               		 
		               		 <?php
							 
		               		 // Microsoft Languages output.
		               		 $i=0; 
		               		 
		               		 foreach($langs as $lang){
		               		 	?>
		               		 	  
		               		 	  <option data-filter-val="microsoftTranslator"   value="<?php echo $langs_c[$i] ?>"  
		               		 	  <?php 
		               		 	  
		               		 	  if( $camp_general['cg_translate_method'] == 'microsoftTranslator')
		               		 	  { 
		               		 	  	@wp_automatic_opt_selected($langs_c[$i],$camp_translate_from); 
		               		 	  } 
		               		 	  
		               		 	  ?> ><?php echo $langs[$i]?></option>
		               		 		 
		               		 	<?php
		               		 	
								$i++;
		               		 }
		               		 
		               		 // Google Languages output.
		               		 $i=0;
		               		 foreach($g_langs as $lang){
		               		 	?>
		               		 		               		 	  
               		 		        <option data-filter-val="googleTranslator"   value="<?php echo $g_langs_c[$i] ?>"  
               		 		        <?php 
               		 		        
               		 		        if( $camp_general['cg_translate_method'] == 'googleTranslator') {
               		 		        	@wp_automatic_opt_selected($g_langs_c[$i],$camp_translate_from);
               		 		        } ?> ><?php echo $g_langs[$i]?></option>
               		 		               		 		 
               		 		       <?php
               		 		               		 	
               		 			   $i++;
               		 		  }
		               		 
		               		 ?>
		               	</select>
		               		 
		               		 To	<select name="camp_translate_to"  class="wp_automatic_lang_select translate_t" style="width:25%;padding:0;">
		               		 
			               		 
			               		 <?php
			               		  
								$i=0;
			               		 foreach($langs as $lang){
			               		 	?>
			               		 	
			               		 		<option  data-filter-val="microsoftTranslator"  value="<?php echo $langs_c[$i] ?>"  <?php if( $camp_general['cg_translate_method'] == 'microsoftTranslator') @wp_automatic_opt_selected($langs_c[$i],$camp_translate_to) ?> ><?php echo $langs[$i]?></option>
			               		 	
			               		 	<?php 
									$i++;
			               		 }
			               		 
			               		 // Google Languages output.
			               		 $i=0;
			               		 foreach($g_langs as $lang){
			               		 	?>
			               		 		               		 		               		 	  
               		                <option data-filter-val="googleTranslator"   value="<?php echo $g_langs_c[$i] ?>"  <?php  if( $camp_general['cg_translate_method'] == 'googleTranslator') @wp_automatic_opt_selected($g_langs_c[$i],$camp_translate_to) ?> ><?php echo $g_langs[$i]?></option>
               		                		 		               		 		 
               		                <?php
               		                		 		               		 	
               		                  $i++;
               		               }
			               		 
			               		 ?>
			               		 
		               	
		               		</select>
		               		
		               		To	<select name="camp_translate_to_2"  class="wp_automatic_lang_select translate_t" style="width:25%;padding:0;">
		               		 
			               		 
			               		 <?php
			               		  
			               		 	// Microsoft Languages output.
									$i=0;
				               		foreach($langs as $lang){
				               		 	?>
				               		 	
				               		 		<option   data-filter-val="microsoftTranslator"  value="<?php echo $langs_c[$i] ?>"  <?php if( $camp_general['cg_translate_method'] == 'microsoftTranslator') @wp_automatic_opt_selected($langs_c[$i],$camp_translate_to_2) ?> ><?php echo $langs[$i]?></option>
				               		 	
				               		 	<?php 
										$i++;
				               		}
									
									// Google Languages output.
									$i=0;
									foreach($g_langs as $lang){
									
									?>
												               		 		               		 		               		 	  
               		                <option data-filter-val="googleTranslator"   value="<?php echo $g_langs_c[$i] ?>"  <?php  if( $camp_general['cg_translate_method'] == 'googleTranslator') @wp_automatic_opt_selected($g_langs_c[$i],$camp_translate_to_2) ?> ><?php echo $g_langs[$i]?></option>
               		                		 		               		 		 
               		                <?php
               		                		 		               		 	
               		                  $i++;
               		                }
																		
			               		 
			               		 
			               		 ?>
			               		 
		               	
		               		</select>
		                	
		                	
		                	         <div id="field1zzxzx-container" class="field f_100">
							               <div class="option clearfix">
							                    <input name="camp_options[]" id="field2xzx-1" value="OPT_TRANSLATE_TITLE" type="checkbox">
							                    <span class="option-title">
														Translate title also   
							                    </span>
							                    <br>
							               </div>
							               
							               <div class="option clearfix">
							                    <input name="camp_options[]"  value="OPT_TRANSLATE_FTP" type="checkbox">
							                    <span class="option-title">
														If translation got failed set the post status to Pending   
							                    </span>
							                    <br>
							               </div>
							               
									 </div>
		                	
		            </div>
		            
               </div>
		 </div><!-- translation -->
		 
		 <div id="custom_fields" class="field f_100">
               <div class="option clearfix">
                    
                    <input name="camp_options[]" id="cusom_fields_option" value="OPT_CUSTOM" type="checkbox">
                    <span class="option-title">
							Add custom fields to the posts 
                    </span>
                    
                    <br>
                    
		            <div id="custom_fields_c" class="field f_100">
		             <div style="margin-bottom:5px" class="supportedTags"></div>
		                 <button style="float:right" id="custom_new">+</button>
		               
		               <?php 
		               	if(is_array($camp_post_custom_k) & count($camp_post_custom_k) >0 ){
		             		 
$in=0;
$added=0;
foreach($camp_post_custom_k as $k){
	if(trim($k) != ''){
	$added=1;

	?>
		                <div  class="custom_field_wrap">Field Name <input style="width:100px" value="<?php echo $k ?>" name="camp_post_custom_k[]" class="no-unify"> 
		                 value <input style="width:200px" value="<?php echo htmlentities($camp_post_custom_v[$in],ENT_COMPAT, 'UTF-8') ;?>" name="camp_post_custom_v[]" class="no-unify"><br>   </div>
	
	<?php 
	}
	$in++;
}

if($added == 0){
?>
		                <div  class="custom_field_wrap">Field Name <input style="width:100px" value="" name="camp_post_custom_k[]" class="no-unify"> 
		                 value <input style="width:200px" value="" name="camp_post_custom_v[]" class="no-unify"><br>   </div>

<?php 	

}

		               	}else{
?>
		                <div  class="custom_field_wrap">Field Name <input style="width:100px" value="" name="camp_post_custom_k[]" class="no-unify"> 
		                 value <input style="width:200px" value="" name="camp_post_custom_v[]" class="no-unify"><br>   </div>


<?php 		               		

		               	}
		               
		               ?>
		               
		                
		            </div>
		            
               </div>
		 </div>			 
		 
		<!-- post templates -->
		<div id="postTemplates" style="display:none">
		
<div class="tempArticles">[ad_1]
[matched_content]
[ad_2]
<br><a href="[source_link]">Source</a> by <a href="[author_link]">[author_name]</a></div>		

<div class="tempArticlesBase">[ad_1]
[matched_content]
[ad_2]
<br><a href="[source_link]">Source</a> by <a href="[author_link]">[author_name]</a></div>		

<div class="tempWalmart">[item_imgs_html]
Price: <span style="color:#b12704">[price_with_discount]</span>
<br><a href="[item_link]"><img src="http://i.imgur.com/SUv4PIl.png"></a> 
[ad_1]
[item_description]
<br>[ad_2]</div>		

<!-- FB template -->
<div class="tempFacebook">[ad_1]
[matched_content]
[ad_2]
<br><a href="[source_link]">Source</a>  </div>		



<div class="tempFeeds"> [ad_1]
<br>[matched_content]
<br>[ad_2]
<br><a href="[source_link]">Source link </a></div>

			<!-- amazon template -->	
			<div class="tempAmazon">[product_imgs_html]
Price: <span style="color:#b12704">[price_with_discount]</span>
<br><a href="[product_link]"><img src="http://i.imgur.com/IaeL3id.png" /></a> 
[ad_1]
[product_desc]
<br>[review_iframe]
<br>[ad_2]</div> 

		<!-- Clickbank template -->
		<div class="tempClickbank"><p style="text-align:center">[product_img]</p>

<p>
<strong>Product Name:</strong> [original_title]
</p>
[ad_1]
<p style="text-align: center; font-size: 150%;"><strong><a href="[product_link]">Click here to get [original_title] at discounted price while it's still available...</a></strong></p>

<p style="text-align: center; ">
<a href="[product_link]"><img style="display:inline" src="https://i.imgur.com/RBVKrWl.jpg"></a></p>

<p style="text-align: center; ">
<em>All orders are protected by SSL encryption – the highest industry standard for online security from trusted vendors.<br>
<img src="http://i.imgur.com/YgpMeUW.png"><br>
[original_title] is backed with a 60 Day No Questions Asked Money Back Guarantee. If within the first 60 days of receipt you are not satisfied with Wake Up Lean™, you can request a refund by sending an email to the address given inside the product and we will immediately refund your entire purchase price, with no questions asked.</em></p>

<!--more-->

<p>
<strong>Description:</strong> [product_desc]
</p>

[ad_2] 
 
<p style="text-align: center; font-size: 150%;"><strong><a href="[product_link]">Click here to get [original_title] at discounted price while it's still available...</a></strong></p>

<p style="text-align: center; ">
<a href="[product_link]"><img style="display:inline" src="https://i.imgur.com/RBVKrWl.jpg"></a></p>

<p style="text-align: center; ">
<em>All orders are protected by SSL encryption – the highest industry standard for online security from trusted vendors.<br>
<img src="http://i.imgur.com/YgpMeUW.png"><br>
[original_title] is backed with a 60 Day No Questions Asked Money Back Guarantee. If within the first 60 days of receipt you are not satisfied with Wake Up Lean™, you can request a refund by sending an email to the address given inside the product and we will immediately refund your entire purchase price, with no questions asked.</em></p>
</div>			
			
			<!-- Pinterest template -->
			<div class="tempPinterest">[ad_1]
<a href="[pin_url]"><img src="[pin_img]" title="[pin_title]" /></a>
<p>[pin_description]</p>
[ad_2]
<br><a href="[pin_url]">Source</a> by <a href="https://pinterest.com/[pin_pinner_username]">[pin_pinner_username]</a>
			
			</div>
			
		<!-- Spintax template -->
		<div class="tempSpintax"></div>	
		
		<?php 

		$player= "[vid_player]
<br>";
		
		$vmplayer= "[vid_embed]
<br>";
		$dmplayer="[vid_player]
<br>";
		
		 if(  1   ){
			
			if( (defined('PARENT_THEME') &&  (PARENT_THEME =='truemag' || PARENT_THEME =='newstube'))  || class_exists('Cactus_video') ){
				$player ='';
				$vmplayer = '';	
				$dmplayer = '' ;
			}

		 	
		 } 
		 
		 //newspaper integration
		 if(function_exists('td_bbp_change_avatar_size')){
		 	$player ='';
		 	$vmplayer = '';
		 }
		
		?>
		
		<!-- youtube part -->
		<div class="tempYoutube"><?php echo $player ?>[vid_desc]
<br><a href="[source_link]">source</a></div>

<!-- Reddit part -->
<div class="tempReddit">[ad_1]
[item_img_html]
<p>[item_description]</p>
[item_embed]
[ad_2]
<br><a href="[item_link]">View Reddit</a> by [item_author_link] -  <a href="[item_url]">View Source</a></div>

		<!-- Instagram part -->
		<div class="tempInstagram">[ad_1]
<a href="[item_url]"><img src="[item_img]"/></a>
<p>[item_description]</p>
[ad_2]
<br><a href="[item_url]">Source</a></div>
	
	<!-- craigslist part -->
		<div class="tempCraigslist">[ad_1]
<p>[item_img_html]</p>
<p>[item_description]</p>
<a href="[item_link]">Check more...</a>
[ad_2]</div>
	
	<!-- SoundCloud part -->
	<div class="tempSoundCloud" >[ad_1]
[item_embed]
<br>[item_description]
[ad_2]
<br><a href="[source_link]">Source</a> by <a href="[item_user_link]">[item_user_username]</a></div>

		<!-- vimeo part -->
		<div class="tempVimeo"><?php echo $vmplayer ?>[vid_description]
<br>Likes: [vid_likes]
<br>Viewed: [vid_views]
<br><a href="[source_link]">source</a></div>


<!-- Twitter template -->
<div class="tempTwitter">[ad_1]
[item_description]
[ad_2]
<br><a href="[source_link]">Source</a> by <a href="[item_author_url]">[item_author_name]</a></div>


		<div class="tempFlicker"><img src="[img_src]" alt="[img_title]" />    
<p>[img_description] </p>
<p><a href="[img_link]">Posted</a> by <a href="http://flicker.com/[img_author] " >[img_author_name] </a> on [img_date_posted] </p>
  <p>  Tagged: [img_tags] </p></div>

  
  <div class="tempeBay">[item_images] 
<br> [item_desc]
<br> Price : [item_price]
<br> Ends on : [readable_time][item_end_date][/readable_time]
<br> <a href="[item_link]">View on eBay </a></div>


<!-- Itunes template -->
		<div class="tempItunesmusic"><img src="[item_img]">

<p>[embed][item_previewUrl][/embed]</p>
<br>
<p>By <a href="[item_artistViewUrl]">[item_artistName]</a></p>
<br><a href="[item_link]&at=[affiliate_id]">Download now from Itunes</a></div>


<div class="tempItunesmovie"><img src="[item_img]">
<p>[video src="[item_previewUrl]"]</p>
<br>
<p>[item_description]</p>
<p>By [item_artistName]</p>
<br><a href="[item_link]">Download movie from Itunes</a></div>

<div class="tempItunesshortFilm"><img src="[item_img]">
<p>[video src="[item_previewUrl]"]</p>
<br>
<p>[item_description]</p>

<p>By [item_artistName]</p>
<br><a href="[item_link]">Download movie from Itunes</a></div>

<div class="tempItunestvShow"><img src="[item_img]">
<p>[video src="[item_previewUrl]"]</p>
<br>
<p>[item_description]</p>

<p>By [item_artistName]</p>
<br><a href="[item_link]">Download from Itunes</a></div>


<div class="tempItunespodcast"><img src="[item_img]">

<p>[item_description]</p>

<p>By [item_artistName]</p>

<br><a href="[item_link]">Download from Itunes</a></div>


<div class="tempItunesmusicVideo"><img src="[item_img]">

<p>[video src="[item_previewUrl]"]</p>
<br>
<p>[item_description]</p>

<p>By [item_artistName]</p>

<br><a href="[item_link]">Download from Itunes</a></div>


<div class="tempItunesaudiobook"><img src="[item_img]">

<p>[item_description]</p>

<p>By [item_artistName]</p>

<br><a href="[item_link]">Download from Itunes</a></div>

<div class="tempItunesebook">
<img src="[item_img]">

<p>[item_description]</p>

<p>By [item_artistName]</p>
<br><a href="[item_link]">Download from Itunes</a></div>


<div class="tempItunessoftware">
<img src="[item_img]">

<p>[item_description]</p>

[item_screenshot]

<p>By <a href="[item_artistViewUrl]">[item_artistName]</a></p>
<br><a href="[item_link]">Download from Itunes</a></div>

<!-- Envato template -->

<div class="tempEnvatophotodune tempEnvatocodecanyon tempEnvatothemeforest tempEnvato3docean tempEnvatophotodune tempEnvatographicriver">[ad_1]
<img src="[preview_img]"/>
[item_description]
[ad_2]
<a href="[item_link]?ref=[affiliate_id]" >Source</a></div>
<div class="tempEnvatoaudiojungle">[ad_1]
[embed][preview_mp3][/embed]
<p><img  class="alignleft" src="[preview_icon]">[item_description]</p>
[ad_2]
<a href="[item_link]?ref=[affiliate_id]">Source</a></div>
<div class="tempEnvatovideohive">[ad_1]
<img src="[preview_img]">
[embed][preview_vid][/embed]
[item_description]
[ad_2]
<a href="[item_link]?ref=[affiliate_id]">Source</a></div>

<!-- DailyMotion template -->

<div class="tempDailyMotion"><?php echo $dmplayer ?>[item_description]
<br><a href="[source_link]">View at DailyMotion</a></div>


</div><!-- hidden part -->
 		<!-- Check Boxes -->
              <script type="text/javascript">

              		
					var supportedTags= <?php echo json_encode($allowed_tags) ;?> ;
              		var $vals = '<?php echo  $camp_options ?>';
              			
                    $val_arr=$vals.split('|');
                    jQuery('input:checkbox').removeAttr('checked');

                    jQuery.each($val_arr, function(index, value) { 
                        
						if(value != '') {
							jQuery('input:checkbox[value="'+value+'"]').attr('checked','checked');
							jQuery('input:radio[value="'+value+'"]').attr('checked','checked');
						}
					});
					


               </script>
               
               <div class="clear"></div>
               </div>             
             

          <!-- third tab -->
	 
          <input name="posted" type="hidden" value="<?php if( isset($posted)) echo @$posted ?>">
          
          <script type="text/javascript">
          	
          jQuery(document).ready(function(){
        	  jQuery(document).ready(function(){
        		  jQuery("#search").gcomplete({
				style: "default",
				effect: false,
				pan: '#field111'
				});
			});


		});
	</script>
	
 
          
          <div class="clear"></div>
          
           

     </div>
</div>
</div><!-- panes -->