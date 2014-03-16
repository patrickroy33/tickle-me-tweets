<?php
/*
	Plugin Name: Tickle Me Tweets
	Plugin URI: https://github.com/patrickroy33/tickle-me-tweets
	Description: This Wordpress plugin allows the administrator to display recent tweets from any valid twitter handle through a shortcode and a widget
	Author: Patrick Roy
	Version: 1.0
	Author URI: http://www.patrickroy33.ca
*/
require_once (__DIR__ . '/widget.php');
require_once (__DIR__ . '/admin-page.php');

//widgets initialize
add_action( 'widgets_init', 'register_twitter_widget' );

//shortcode creation
add_shortcode( 'show_tweets', 'show_tweets' );

// create custom plugin settings menu
add_action ('admin_menu', 'twitter_create_menu');

function register_twitter_widget() {
    register_widget( 'Twitter_Widget' );
}

function show_tweets ($atts) {
	if (!class_exists ('TwitterOAuth')) {
		require_once (__DIR__ . '/twitter/twitteroauth.php');
	}
	$consumer_key = get_option ('twitter_consumer_key');
	$consumer_secret = get_option ('twitter_consumer_secret');
	$access_token = get_option ('twitter_access_token');
	$access_token_secret = get_option ('twitter_access_token_secret');

	if (!$consumer_key || !$consumer_secret || !$access_token || !$access_token_secret) {
		echo "You need to set up the Twitter Settings.";
		return;
	}
	
	extract(shortcode_atts(array(
      	'screen_name' => 'patrick08940',
      	'count' => 5
   	), $atts));
	
	$connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);

	$response = $connection->get('https://api.twitter.com/1.1/statuses/user_timeline.json', array('screen_name' => $screen_name, 'count' => $count));
	echo '<ul class="tweets">';
	foreach ($response as $item) {
		echo "<li><p>";
		echo makeClickableLinks ($item->text);
		echo "</p>";
		echo "<span class='time'>about ";
		echo time_ago ($item->created_at);
		echo "</span></li>";
	}
	echo "</ul>";
}

function time_ago ($time1) {
	$tm1 = strtotime ($time1);
	$tm2 = strtotime (date ('Y-m-d H:i:s'));
	$diff = $tm2 - $tm1;
	$years = round ($diff / 3600 / 24 / 365);
	$days = round ($diff / 3600 / 24);
	$hours = round ($diff / 3600);
	$mins = round ($diff / 60);
	$secs = round ($diff);

	if ($years > 0)
		return time_format ($years, "years ago", "year ago", "years ago");
	else if ($days > 0)
		return time_format ($days, "days ago", "day ago", "days ago");
	else if ($hours > 0)
		return time_format ($hours, "hours ago", "hour ago", "hours ago");
	else if ($mins > 0)
		return time_format ($mins, "minutes ago", "minute ago", "minutes ago");
	else
		return time_format ($secs, "seconds ago", "second ago", "seconds ago");
}

function time_format ($num, $zero, $single, $multiple) {
	if ($num == 0) {
		return $num . " " . $zero;
	} else if ($num == 1) {
		return $num . " " . $single;
	} else {
		return $num . " " . $multiple;	
	}
}

function makeClickableLinks($s) {
  $s = preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $s);
  $s = preg_replace('@#(\w\w+)@', '<a href="https://twitter.com/search?q=%23$1" target="_blank">#$1</a>', $s);
  return $s;
}