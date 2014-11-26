<?php
	
	$tname = $_SESSION['tname'];
	
	//$twitterName = 'http://api.twitter.com/1/statuses/user_timeline/BREAKINGNEWS.xml';
	//$twitterName = 'http://twitter.com/statuses/user_timeline/RedrockSocial.xml';
	$turl = 'http://twitter.com/statuses/user_timeline/';
	//$tname = 'RedrockSocial.xml';
	$twitterName = $turl . $tname;
	$twitterRequest = callTwitter($twitterName);
	$twitterRequest = parseTwitterReply($twitterRequest);
	echo renderTweets($twitterRequest);

?>