<?php
	$_SESSION['utils']="common/utilities.php";	//Program with common functions.
	$_SESSION['dbopen']="../db_voteoften.php";
	
	require_once($_SESSION['utils']);
      $util = new Utilities();
		$util->keep_alive();
		
	if(isset($_SESSION['description']))   {
		$_SESSION['description'] = "";
		$description = $_SESSION['description'];
   }
	if(isset($_SESSION['fixed']))   {
		$_SESSION['fixed'] = "";
		$fixed = $_SESSION['fixed'];
   }
	if(isset($_SESSION['chgdate']))   {
		$_SESSION['chgdate'] = "";
		$chgdate = $_SESSION['chgdate'];
   }
	if(isset($_SESSION['chgid']))	{
		$_SESSION['chgid'] = "";
		$id = $_SESSION['chgid'];
		$chgid = $_SESSION['chgid'];
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title></title>
	<link rel="stylesheet" href="css/menu_style.css" type="text/css" />
	<link rel="stylesheet" type="text/css" href="css/view.css" media="all">
		<script type="text/javascript">
			function SelectAll(id)
			{
				 document.getElementById(id).focus();
				 document.getElementById(id).select();
			}
		</script>
</head>
<body>

	<body id="main_body" >
	<img id="top" src="images/top.png" alt="">
	<div id="form_container">
		<h1><a>Send Us A Comment</a></h1>
		<form id="form_346996" class="appnitro"  method="post" action="menutemplate.php?process=sendcomment_save.php">
					<div class="form_description">
			<h2>Send Us A Comment</h2>
			<p>If you type in a valid email address your comments will be sent to the executive vice president of something-or-other for perusal.  He might even get back to you!</p>
		</div>
		<ul>

		<li id="li_99">
			<label class="description">
				Your Name:<input type="text" name="yourname" size=50 maxlength=50 /><br />
			</label>
			<p class="guidelines" id="guide_2"><small>Type your name here.</small></p>
		</li>
		<li id="li_99">
			<label class="description">
				Your E-Mail Address:<input type="text" name="youremail" size=50 maxlength=50 /><br />
			</label>
			<p class="guidelines" id="guide_2"><small>Type your email address here.</small></p>
		</li>
		<li id="li_99">
			<label class="description">
				Subject:<input type="text" name="subject" size=50 maxlength=50 /><br />
			</label>
			<p class="guidelines" id="guide_2"><small>Type the subject of the email here.</small></p>
		</li>
		<li id="li_6" >
			<label class="description" for="description">Message:</label>
				<div>
					<textarea value="left" name="message" id="message" onclick="SelectAll('message');" cols="70" rows="8">
					</textarea><br/>
				</div>
		</li>
		</li>
				<li class="buttons">
			   <input type="hidden" name="form_id" value="346996" />
				<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit Message" />
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

