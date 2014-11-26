<?php
	$_SESSION['utils']="common/utilities.php";	//Program with common functions.
	$_SESSION['dbopen']="../db_voteoften.php";
	$votingsystem = $_SESSION['votingsystem'];
	
	require_once($_SESSION['utils']);
      $util = new Utilities();
		$util->keep_alive();

	if(isset($_GET['electionid']) && !empty($_GET['electionid']))	{
		$electionid = $_GET['electionid'];
		$_SESSION['electionid'] = $electionid;
	}	else	{
		$electionid = "";
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Elections You Voted In</title>
<link rel="stylesheet" type="text/css" href="css/view.css" media="all">
<script type="text/javascript" src="js/view.js"></script>
<script type="text/javascript" src="js/calendar.js"></script>
</head>
<body id="main_body" >
	<img id="top" src="images/top.png" alt="">
	<div id="form_container">
		<h1><a>Elections You Voted In</a></h1>
		<form id="electionlist" class="appnitro"  method="post" action="">
			<div class="form_description">
	</div>
      <?php header("Location: menutemplate.php?process=$votingsystem"); ?>
		<input id="saveForm" class="button_text" type="submit" name="submit" value="Vote" />
      </ul>
		</form>	
		<div id="footer"></div>
	</div>
	<img id="bottom" src="images/bottom.png" alt="">
	</body>
</html>
