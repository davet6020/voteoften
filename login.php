<?php
   /* The next two lines are for FireBug functionality. */
      require_once('FirePHPCore/fb.php');
      ob_start();
	$_SESSION['utils']="common/utilities.php";	//Program with common functions.
	$_SESSION['dbopen']="../db_voteoften.php";
   $_SESSION['showerror'] = FALSE;
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
		<h1><a>Login</a></h1>
		<form id="form_346996" class="appnitro"  method="post" action="login_save.php">
					<div class="form_description">
			<h2>Login</h2>

			<?php
				if($showerror)	{
					$_SESSION['showerror'] = FALSE;
					$showerror = $_SESSION['showerror'];
					echo '<p class="red_banner">* All of these fields are required.</p>';
				}	else	{
               echo '* All of these fields are required.</p>';
				}
			?>
			
		</div>
			<ul >
		<li id="login" >
		<label class="description" for="login">Login Name </label>
		<div>
			<input id="login" name="login" class="element text medium" type="text" maxlength="255" value=""/> 
		</div><p class="guidelines" id="guide_3"><small>This is the login name you created when you signed up.</small></p> 
		</li>
		<li id="password" >
		<label class="description" for="password">Password </label>
		<div>
			<input id="password" name="password" class="element text medium" type="password" maxlength="255" value=""/> 
		</div>
		</li>
		<li id="password" >
		<label class="description" for="forgotpassword"></label>
		<div>
			<a href="menutemplate.php?process=forgotpassword.php">I forgot my password!</a>
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