<?php
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
<title>Type Keyword To Enter</title>
<link rel="stylesheet" type="text/css" href="css/view.css" media="all">
<script type="text/javascript" src="js/view.js"></script>

</head>
<body id="main_body" >
	<img id="top" src="images/top.png" alt="">
	<div id="form_container">
		<h1><a>Welcome To VoteOften.org</a></h1>
		<form id="form_346996" class="appnitro"  method="post" action="menutemplate.php?process=globallist_keyword_save.php">
					<div class="form_description">
			<h2>Welcome To VoteOften.org</h2>

			<?php
				if($showerror)	{
					$_SESSION['showerror'] = FALSE;
					$showerror = $_SESSION['showerror'];
					echo '<p class="red_banner">* All of these fields are required.</p>';
				}	else	{
               echo 'If you were given a keyword for a ballot, type it in below.</p>';
				}
			?>
			
		</div>
			<ul >
		<li id="login" >
		<label class="description" for="keyword">Keyword </label>
		<div>
			<input id="login" name="keyword" class="element text medium" type="text" maxlength="255" value=""/> 
		</div><p class="guidelines" id="guide_3"><small>Type in the keyword you were provided to gain access to this ballot.</small></p> 
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