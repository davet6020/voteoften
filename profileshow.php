<?php
	//session_id("--LOGIN--");
	//session_start();
	$_SESSION['utils']="common/utilities.php";	//Program with common functions.
	$_SESSION['dbopen']="../db_voteoften.php";
	
	require_once($_SESSION['utils']);
      $util = new Utilities();
		$util->keep_alive();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Create a VoteOften.org ID</title>
<link rel="stylesheet" type="text/css" href="css/view.css" media="all">
<script type="text/javascript" src="js/view.js"></script>

</head>
<body id="main_body" >
	<img id="top" src="images/top.png" alt="">
	<div id="form_container">
		<h1>Profile Information</h1>
		<form id="form_346996" class="appnitro"  method="post" action="index.php">
					<div class="form_description">
		<h2>Profile Information</h2>

			<?php
				//$util->clear_profile_session_info();
				$util->load_profile_session_info($_SESSION['userid']);
				$util->view_profile_session_info();
			?>
			
		</div>
			<ul >
	<!--
		<li class="buttons">
			<input type="hidden" name="form_id" value="346996" />
			<input id="saveForm" class="button_text" type="submit" name="submit" value="     Ok     " />
		</li>
	-->
			</ul>
		</form>	
		<div id="footer">
		</div>
	</div>
	<img id="bottom" src="images/bottom.png" alt="">
	</body>
</html>