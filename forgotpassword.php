<?php
	$_SESSION['utils']="common/utilities.php";	//Program with common functions.
	$_SESSION['dbopen']="../db_voteoften.php";
	
	require_once($_SESSION['utils']);
      $util = new Utilities();
		$util->keep_alive();
?>

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
		<h1><a>So you forgot your password...</a></h1>
		<form id="form_346996" class="appnitro"  method="post" action="menutemplate.php?process=forgotpassword_save.php">
					<div class="form_description">
			<h2>So you forgot your password...</h2>
			<p>If you type in your login name I will reset your password.</p>
		</div>
		<ul>

		<li id="li_99">
			<label class="description">
				Login Name:<input type="text" name="loginname" size=50 maxlength=50 /><br />
			</label>
			<p class="guidelines" id="guide_2"><small>Type your login name here.</small></p>
		</li>
		
		</li>
				<li class="buttons">
			   <input type="hidden" name="form_id" value="346996" />
				<input id="saveForm" class="button_text" type="submit" name="submit" value="Reset Password" />
		</li>
			</ul>
		</form>	
		<div id="footer">
		</div>
	</div>
	<img id="bottom" src="images/bottom.png" alt="">
	</body>
   
</body>
</html>

