<?php

function renderTweets($parsedReturn){
	$num = count ($parsedReturn['update']);
   $output="";

	for($i=0; $i<$num; $i++){
		$updateTime = $parsedReturn['updateTime'][$i];
		$update = $parsedReturn['update'][$i];
		$profile_image_url = $parsedReturn['profile_image_url'][$i];
		$screen_name = $parsedReturn['screen_name'][$i];
		$textBody = $update.' '.$updateTime;
		$screen_name_abv="<a href='http://www.twitter.com/$screen_name' target='_blank'>".strtolower(substr($screen_name,0,8))."</a>";
		
		$output.= "
			<tr><td>
				<div id='$screen_name' class='mess-pic' >
					<img src='$profile_image_url' width='48px' height='48px'>
					<br>$screen_name_abv
				</div>
				<div class='mess-container'>
					<div class='mess-row-text'>$textBody
					</div>
				</div>
				<div style='clear: both; padding-top: 10px'></div>
			</td></tr>";
	}
	return $output;
}
?>


