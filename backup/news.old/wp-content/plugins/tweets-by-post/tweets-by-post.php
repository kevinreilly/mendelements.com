<?php
/*
Plugin Name: Tweets By Post
Plugin URI: http://techbrij.com/category/portfolio/tweets-by-post
Description: Adds post wise tweets at the end of your post. It handles twitter feeds, including @username, #hashtag, and link parsing post by post.  It supports displaying profiles images, and even lets you control number of tweets.
Author: Brij Mohan Dammani
Version: 0.5
Author URI: http://techbrij.com

Copyright (C) 2011, TechBrij
All rights reserved.

Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

*/
?>
<?php

define('TB_WORDPRESS_FOLDER',$_SERVER['DOCUMENT_ROOT']);
define('TB_PLUGIN_FOLDER',str_replace("\\",'/',dirname(__FILE__)));
define('TB_PLUGIN_PATH','/' . substr(TB_PLUGIN_FOLDER,stripos(TB_PLUGIN_FOLDER,'wp-content')));
//Admin Settings Section 
add_action('admin_init','techbrij_meta_init');

function techbrij_admin() {  
     include('techbrij_admin.php');  
}  
function techbrij_admin_actions() {
			add_options_page("Tweets By Post", "Tweets By Post", 1, "TweetsByPost", "techbrij_admin");
}

add_action('admin_menu', 'techbrij_admin_actions');
 
function techbrij_meta_init()
{
	// review the function reference for parameter details
	// http://codex.wordpress.org/Function_Reference/wp_enqueue_script
	// http://codex.wordpress.org/Function_Reference/wp_enqueue_style
 
	//wp_enqueue_script('techbrij_meta_js', techbrij_PLUGIN_PATH . '/custom/meta.js', array('jquery'));
	wp_enqueue_style('techbrij_meta_css', TB_PLUGIN_PATH . '/meta.css');
 
	// review the function reference for parameter details
	// http://codex.wordpress.org/Function_Reference/add_meta_box
 
	// add a meta box for each of the wordpress page types: posts and pages
	foreach (array('post','page') as $type) 
	{
		add_meta_box('techbrij_all_meta', 'Related Tweets Options', 'techbrij_meta_setup', $type, 'normal', 'high');
	}
 
	// add a callback function to save any data a user enters in
	add_action('save_post','techbrij_meta_save');
}
 
function techbrij_meta_setup()
{
	global $post;
 
	// using an underscore, prevents the meta variable
	// from showing up in the custom fields section
	$meta = get_post_meta($post->ID,'_techbrij_meta',TRUE);
 
if (!$meta){
$devSavedOptions = get_option('TechBrijPluginAdminOptions');
$meta['mode'] = $devSavedOptions["mode"];
$meta['name'] = $devSavedOptions["criteria"];
}

	// instead of writing HTML here, lets do an include
	include(TB_PLUGIN_FOLDER . '/meta.php');
 
	// create a custom nonce for submit verification later
	echo '<input type="hidden" name="techbrij_meta_noncename" value="' . wp_create_nonce(__FILE__) . '" />';
}
 
function techbrij_meta_save($post_id) 
{
	// authentication checks
 
	// make sure data came from our meta box
	if (!wp_verify_nonce($_POST['techbrij_meta_noncename'],__FILE__)) return $post_id;
 
	// check user permissions
	if ($_POST['post_type'] == 'page') 
	{
		if (!current_user_can('edit_page', $post_id)) return $post_id;
	}
	else 
	{
		if (!current_user_can('edit_post', $post_id)) return $post_id;
	}
 
	// authentication passed, save data
 
	// var types
	// single: _techbrij_meta[var]
	// array: _techbrij_meta[var][]
	// grouped array: _techbrij_meta[var_group][0][var_1], _techbrij_meta[var_group][0][var_2]
 
	$current_data = get_post_meta($post_id, '_techbrij_meta', TRUE);	
 
	$new_data = $_POST['_techbrij_meta'];
 
	techbrij_meta_clean($new_data);
 
	if ($current_data) 
	{
		if (is_null($new_data)) delete_post_meta($post_id,'_techbrij_meta');
		else update_post_meta($post_id,'_techbrij_meta',$new_data);
	}
	elseif (!is_null($new_data))
	{
		add_post_meta($post_id,'_techbrij_meta',$new_data,TRUE);
	}
 
	return $post_id;
}
 
function techbrij_meta_clean(&$arr)
{
	if (is_array($arr))
	{
		foreach ($arr as $i => $v)
		{
			if (is_array($arr[$i])) 
			{
				techbrij_meta_clean($arr[$i]);
 
				if (!count($arr[$i])) 
				{
					unset($arr[$i]);
				}
			}
			else 
			{
				if (trim($arr[$i]) == '') 
				{
					unset($arr[$i]);
				}
			}
		}
 
		if (!count($arr)) 
		{
			$arr = NULL;
		}
	}
}
 function get_tweets($content) {
 global $post;
$techbrij_meta = get_post_meta($post->ID,'_techbrij_meta',TRUE);
if ($techbrij_meta['mode'] == "none")
return $content;
//print_r($techbrij_meta);

return $content.get_tweets_string($techbrij_meta);
}
function get_tweets_string($techbrij_meta) {
	//Get Default Option
	$devSavedOptions = get_option('TechBrijPluginAdminOptions');
	//Post wise Option
	if (isset($techbrij_meta['mode']) && trim($techbrij_meta['mode'])!==''){
	$devSavedOptions["mode"] = $techbrij_meta['mode'];
	}
	if (isset($techbrij_meta['name']) && trim($techbrij_meta['name'])!==''){
	$devSavedOptions["criteria"] = $techbrij_meta['name'];
	}
	//print_r($devSavedOptions);
    extract(shortcode_atts($devSavedOptions, null));
	//MODES
	if (!isset($mode) || trim($mode)==='' || $mode == "none" ) { 	return ""; 	}
	if ($mode == "favorite") { $twitter_rss = "http://twitter.com/favorites/".$criteria."&rpp=".$num.".atom"; }
	if ($mode == "feed") { $twitter_rss = "http://search.twitter.com/search.rss?q=from%3A".$criteria."&rpp=".$num; }
	if ($mode == "mentions") { $twitter_rss = "http://search.twitter.com/search.rss?q=%40".$criteria."&rpp=".$num; }
	if ($mode == "retweets") { $twitter_rss = "http://search.twitter.com/search.rss?q=RT%20%40".$criteria."&rpp=".$num; }
	if ($mode == "public") { $twitter_rss = "http://search.twitter.com/search.rss?q=".$criteria."&rpp=".$num; }
	if ($mode == "hashtag") { $twitter_rss = "http://search.twitter.com/search.rss?q=%23".$criteria."&rpp=".$num; }
	if ($mode == "search") { $twitter_rss = "http://search.twitter.com/search.rss?q=".$criteria."&rpp=".$num; }

	//echo $twitter_rss;
	//SETUP FEED
	include_once(ABSPATH . WPINC . '/feed.php');
	$rss = fetch_feed($twitter_rss);
	if ( is_wp_error($rss) ) return "Error fetching tweets ".$rss->get_error_message();
	$maxitems = $rss->get_item_quantity($num);
	$rss_items = $rss->get_items(0, $maxitems);
	ob_start();
	$now = time();
	$page = get_bloginfo('url');

	//START OUTPUT
	if ($divid != "") {
		$divstart = "<div id=\"".$divid."\">\n";
		$divend = "</div>";
	}
	if ($ulclass != "") {
		$ulstart = "<ul class=\"".$ulclass."\">";
	} else {
		$ulstart = "<ul>";
	}

	//POPULATE TWEET
	foreach ( $rss_items as $item ) {
		if ($mode == "favorite") {
			$tweet = $item->get_description();
		} else {
			$tweet = $item->get_title();
		}
		if ($encoding == "fix") {$tweet = htmlentities($tweet);}
		if ($page != "") {if (!strpos($tweet, $page) === false) {continue;}}
		$when = ($now - strtotime($item->get_date()));
		$posted = "";
		if ($timeline != "no") {
			$when = ($now - strtotime($item->get_date()));
			$posted = "";
			if ($conditional == "yes") {
				if ($when < 60) {
					$posted = $when . " seconds ago";
				}
				if (($posted == "") & ($when < 3600)) {
					$posted = "about " . (floor($when / 60)) . " minutes ago";
				}
				if (($posted == "") & ($when < 7200)) {
					$posted = "about 1 hour ago";
				}
				if (($posted == "") & ($when < 86400)) {
					$posted = "about " . (floor($when / 3600)) . " hours ago";
				}
				if (($posted == "") & ($when < 172800)) {
					$posted = "about 1 day ago";
				}
				if ($posted == "") {
					$posted = (floor($when / 86400)) . " days ago";
				}
			} else {
				$date = date($phptime, strtotime($item->get_date()));
				$posted = $date;
			}
		$entry = $entry."\n<br />".$pubtext.$posted;
		}
			if ($anchor == "") {
				$tweet = preg_replace("/(http:\/\/)(.*?)\/([\w\.\/\&\=\?\-\,\:\;\#\_\~\%\+]*)/", "<a href=\"\\0\" rel=\"external nofollow\">\\0</a>", $tweet);
			} else {
				$tweet = preg_replace("/(http:\/\/)(.*?)\/([\w\.\/\&\=\?\-\,\:\;\#\_\~\%\+]*)/", "<a href=\"\\0\" rel=\"external nofollow\">".$anchor."</a>", $tweet);
			}
		 if ($mode != "favorite") {
			//SETUP SPECIAL ATTRIBUTES
			$author_tag = $item->get_item_tags('','author');
			$author = $author_tag[0]['data'];
			$author = substr($author, 0, stripos($author, "@") );
			$tweet = "@".$author.": ".$tweet;
			if ($img == "yes"){
				$avatar_tag = $item->get_item_tags('http://base.google.com/ns/1.0','image_link');
				$avatar = $avatar_tag[0]['data'];
				if ($imgclass == "") {
					$preimgclass = "style=\"";
					$imgclass = "float: left;";
				} else {
					$preimgclass = "class=\"";
				}
				$avatar = "<img src=\"".$avatar."\" height=\"48\" width=\"48\" alt=\"".$author."\" title=\"".$author."\" ".$preimgclass.$imgclass."\">";
				if ( $userlinks == "yes" ) {
					$avatar = "<div style=\"float: left; margin: 0px 10px 10px 0px;\"><a href=\"http://twitter.com/".$author."\" rel=\"external nofollow\">".$avatar."</a></div>";
				}
			}
		} else {
			$tweet = "@".$tweet;
		}
		if ($auth == "no") {
			$tweet = preg_replace("(@([a-zA-Z0-9\_]+))", "", $tweet, 1);
			$tweet = substr($tweet, 2);
 		}
		if ( $userlinks == "yes" ) {
			$tweet = preg_replace("(@([a-zA-Z0-9\_]+))", "<a href=\"http://twitter.com/\\1\" rel=\"external nofollow\">\\0</a>", $tweet);
		}
		if ( $hashlinks == "yes" ) {
			$tweet = preg_replace("(#([a-zA-Z0-9\_]+))", "<a href=\"http://twitter.com/search?q=%23\\1\" rel=\"external nofollow\">\\0</a>", $tweet);
		}
		if ($timeline == "yes") {
		if ($linktotweet == "yes") {
				if ($smalltime == "yes") {
					if ($smalltimeclass == "") {
						$presmalltimeclass = "style=\"";
						$smalltimeclass = "font-size: 85%;";
					} else {
						$presmalltimeclass = "class=\"";
					}
				$posted = "<font ".$presmalltimeclass.$smalltimeclass."\">".$posted."</font>";
				$smalltimeclass='';
				}
				$tweet = $tweet." <a href=\"".$item->get_permalink()."\" rel=\"external nofollow\">".$posted."</a>";
			} else {
				$tweet = $tweet." (".$posted.")";
			}
		}
		if ($liclass != ""){
			$entry = "\n<li class=\"".$liclass."\">".$avatar.$tweet."</li>";
		} else {
			$entry = "\n<li style=\"display: inline-block; list-style: none; border-bottom: 1px #ccc dotted; margin-bottom: 5px; padding-bottom: 5px;\">".$avatar.$tweet."</li>";
		}
		$wholetweet = $wholetweet."".$entry;
		$imgclass='';
	}


	ob_end_flush();
	if ($followlink == "yes"){
		if ($mode == "feed" || $mode == "mentions" || $mode == "retweets" || $mode == "public") {
			$linktofeed = ("<a href=\"http://twitter.com/".$criteria."\" rel=\"external nofollow\">follow ".$criteria." on twitter</a><br />\n");
		}
		if ($mode == "favorite") {
			$linktofeed = ("<a href=\"http://twitter.com/".$criteria."/favorites\" rel=\"external nofollow\">view all favourites for ".$criteria."</a><br />\n");
		}
		if ($mode == "search") {
			$linktofeed = ("<a href=\"http://twitter.com/search?q=".$criteria."\" rel=\"external nofollow\">view search results for \"".$criteria."\" on twitter</a><br />\n");
		}
		if ($mode == "hashtag") {
			$linktofeed = ("<a href=\"http://twitter.com/search?q=%23".$criteria."\" rel=\"external nofollow\">view search results for \"#".$criteria."\" on twitter</a><br />\n");
		}
	}
	if ($linklove != "no"){ $pleer = "\nPowered by <a href=\"http://techbrij.com\">TweetByPost</a><br />\n"; }
	$whole = "\n<!-- WordPress TweetByPost: http://techbrij.com -->\n".$divstart."<h3>".$headertext."</h3>".$ulstart.$wholetweet."\n</ul>\n".$linktofeed.$pleer.$divend."\n";
	return $whole;
	}
add_filter('the_content', 'get_tweets');
?>