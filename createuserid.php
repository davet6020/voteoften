<?php
	$_SESSION['utils']="common/utilities.php";	//Program with common functions.
	$_SESSION['dbopen']="../db_voteoften.php";

	require_once($_SESSION['utils']);
      $util = new Utilities();
		$util->unset_profile_session_info();
		$util->keep_alive();
		
	if(!isset($_SESSION['showerror']))	{
		$_SESSION['showerror'] = FALSE;
	}
	
	$showerror = $_SESSION['showerror'];
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
		<h1><a>Create a VoteOften.org ID</a></h1>
		<form id="form_346996" class="appnitro"  method="post" action="createuserid_save.php">
					<div class="form_description">
			<h2>Create a VoteOften.org ID</h2>
			<p>In order to use VoteOften.org you must create a user account.</p>
			<?php
				if($showerror)	{
					$_SESSION['showerror'] = FALSE;
					$showerror = $_SESSION['showerror'];
					echo '<p class="red_banner">* All of these fields are required.</p>';
				}	else	{
					echo "<p>* All of these fields are required.</p>";
				}
			?>
			
		</div>
			<ul >
		<li id="name" >
		<label class="description" for="name">Name </label>
		<span>
			<input id="first" name= "first" class="element text" maxlength="255" size="8" value=""/>
			<label>First</label>
		</span>
		<span>
			<input id="last" name= "last" class="element text" maxlength="255" size="14" value=""/>
			<label>Last</label>
		</span>
		</li>
		
		<li id="zipcode" >
			<label class="description" for="zipcpode">Zip Code</label>
			<span>
				<input id="zipcode" name="zipcode" class="element text" size="9" maxlength="9" value="" type="text">
			</span>
			<p class="guidelines" id="guide_7"><small>Your zip code is required.  We only want it so we can try to look up any elections related to your district and present them to you.</small></p> 
		</li>
		
		<li id="email" >
		<label class="description" for="email">Email </label>
		<div>
			<input id="email" name="email" class="element text medium" type="text" maxlength="255" value=""/> 
		</div>
		</li>
		<li id="login" >
		<label class="description" for="login">Login Name </label>
		<div>
			<input id="login" name="login" class="element text medium" type="text" maxlength="255" value=""/> 
		</div><p class="guidelines" id="guide_3"><small>This is how your name will appear to other users</small></p> 
		</li>
		<li id="password" >
		<label class="description" for="password">Password </label>
		<div>
			<input id="password" name="password" class="element text medium" type="text" maxlength="255" value=""/> 
		</div>
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