<?php

function callTwitter($api_url){
	$curl_handle = curl_init();
	curl_setopt($curl_handle, CURLOPT_URL, $api_url);
	curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
	$twitterResponseData = curl_exec($curl_handle);
	$errCode=curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);
	
	if(!stristr($errCode,'200')) {
		echo 'err '.$errCode; return;
	}
		curl_close($curl_handle);
   return $twitterResponseData;
}

?>

