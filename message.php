<?php

/*
 * 11:57AM.   12:05PM
 * message.php is the program used to display messages to the user within the menu framework of voteoften.
 * Messages are not always bad so somewhere down the line I want to color code this thing.
 * Here is a good example of how to call message.php
 * if(!filter_var("$youremail", FILTER_VALIDATE_EMAIL))	{
		$msgheader = "Invalid E-Mail Address";
		$msgbody = "You did not submit a valid email address.";
		header("Location: menutemplate.php?process=message.php&msgheader=$msgheader&msgbody=$msgbody");
		return;
	}
 */

	$_SESSION['utils']="common/utilities.php";	//Program with common functions.
	$_SESSION['dbopen']="../db_voteoften.php";
	
	require_once($_SESSION['utils']);
	$util = new Utilities();
	$util->keep_alive();

	if(isset($_GET['msgheader']) && !empty($_GET['msgheader']))	{
		$msgheader = $_GET['msgheader'];
	}	else	{
		$msgheader = "";
	}
	if(isset($_GET['msgbody']) && !empty($_GET['msgbody']))	{
		$msgbody = $_GET['msgbody'];
	}	else	{
		$msgbody = "";
	}

	dohtml($msgheader, $msgbody);
	//sleep(20);
	//header('Location: index.php');
	
function dohtml($msgheader, $msgbody)	{
	echo '
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title></title>
	<link rel="stylesheet" href="css/menu_style.css" type="text/css" />
	<link rel="stylesheet" type="text/css" href="css/view.css" media="all">
	</head>
	<body>

	<body id="main_body" >
	<img id="top" src="images/top.png" alt="">
	<div id="form_container">
	<h1><a>';
		echo $msgheader;
	
	echo '</a></h1>
	<form id="form_346996" class="appnitro"  method="post" action="menutemplate.php?process=sendcomment_save.php">
	<div class="form_description">';
		
	echo "<h2>$msgheader</h2><p>$msgbody</p>";
	
	echo '</div>
	<ul>
	</ul>
	</form>
	<div id="footer">
	</div>
	</div>
	<img id="bottom" src="images/bottom.png" alt="">
	</body>

	</body>
	</html>
	';

}

?>