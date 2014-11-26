<?php

function parseTwitterReply($messages)	{
	
$twitterReturn = new SimpleXMLElement($messages);
   $i=0;
	
	foreach($twitterReturn->status as $status)	{
		$updateTime[$i] = $status->created_at;
		$update[$i] = $status->text;
		$profile_image_url[$i] = $status->user->profile_image_url;
		$screen_name[$i] = $status->user->screen_name;
		$i++;
	  }
  
  $parsedReturn = array();
  $parsedReturn['updateTime']=$updateTime;
  $parsedReturn['update']=$update;
  $parsedReturn['profile_image_url']=$profile_image_url;
  $parsedReturn['screen_name']=$screen_name;

  return $parsedReturn;

}

?>