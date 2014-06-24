<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
 
require_once($_SERVER['DOCUMENT_ROOT'] . '/php/autoloader.php');

function getFeed($feedURL) {      
    $feed = new SimplePie();
    $feed->set_feed_url($feedURL);
    $feed->enable_cache(false);
    // $feed->set_cache_location($_SERVER['DOCUMENT_ROOT'] . '/cache');
    $feed->init();
    $feed->handle_content_type();
    return $feed;
}
function getFeedLink($feed) {
	return $feed->get_permalink();
}
function getLastItem($feed) {
	$feed_items = $feed->get_items();
	return $feed_items[0];
}
?>