<?php
	$_SESSION['utils']="common/utilities.php";
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
		<h1><a>Change Password</a></h1>
		<form id="form_346996" class="appnitro"  method="post" action="changepassword_save.php">
					<div class="form_description">
			<h2>Change Password</h2>
			<p>To change your password you must know your login name and your current password.</p>
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
		<li id="login" >
		<label class="description" for="login">Login Name </label>
		<div>
			<input id="login" name="login" class="element text medium" type="text" maxlength="255" value=""/> 
		</div><p class="guidelines" id="guide_3"><small>This is the account name you use to log into voteoften.org</small></p> 
		</li>
		
		<li id="currentpassword" >
		<label class="description" for="currentpassword">Current Password</label>
		<div>
			<input id="currentpassword" name="currentpassword" class="element text medium" type="text" maxlength="255" value=""/> 
		</div><p class="guidelines" id="guide_3"><small>Type in your current password.</small></p>
		</li>
		
		<li id="newpassword" >
		<label class="description" for="newpassword">New Password </label>
		<div>
			<input id="newpassword" name="newpassword" class="element text medium" type="text" maxlength="255" value=""/> 
		</div><p class="guidelines" id="guide_3"><small>Type in what you want your new password to be.</small></p>
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