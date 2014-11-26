<?php
	if(!$_SESSION['login'])	{
		$_SESSION['showerror'] = TRUE;
      header('Location: login.php');
	}
	
	$_SESSION['utils']="common/utilities.php";	//Program with common functions.
	require_once($_SESSION['utils']);
      $util = new Utilities();
		$util->keep_alive();

	$_SESSION['dbopen']="../db_voteoften.php";
	if(!isset($_SESSION['showerror']))	{
		$_SESSION['showerror'] = FALSE;
	}
	
	$showerror = $_SESSION['showerror'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>User Profile II</title>
<link rel="stylesheet" type="text/css" href="css/view.css" media="all">
<script type="text/javascript" src="js/view.js"></script>

</head>
<body id="main_body" >
	<img id="top" src="images/top.png" alt="">
	<div id="form_container">
		<h1><a>User Profile II</a></h1>
		<form id="form_346996" class="appnitro"  method="post" action="userprofile2_save.php">
					<div class="form_description">
			<h2>User Profile II</h2>
			<p>These items are optional and you do not have to answer them in order to use vote often.
This is to help us better understand your likes and dislikes in order to present you with the most applicable results.</p>
		</div>						
			<ul >
			<li id="li_1" >
		<label class="description" for="element_1">I consider myself to be </label>
		<span>
			<?php	echo $util::zidentifycb();	?>
		</span><p class="guidelines" id="guide_1">
		<small>Check all that apply.</small></p> 
		</li>
				<li class="buttons">
			   <input type="hidden" name="form_id" value="346996" />
				<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
		</li>
			</ul>
		</form>	
		<div id="footer">

		</div>
	</div>
	<img id="bottom" src="images/bottom.png" alt="">
	</body>
</html>