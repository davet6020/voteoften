<?php
	$_SESSION['utils']="common/utilities.php";	//Program with common functions.
	$_SESSION['dbopen']="../db_voteoften.php";
	require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
	require_once($_SESSION['utils']);
      $util = new Utilities();
		$util->keep_alive();


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Today's Winners</title>
<link rel="stylesheet" type="text/css" href="css/view.css" media="all">
<script type="text/javascript" src="js/view.js"></script>
<script type="text/javascript" src="js/calendar.js"></script>
</head>
<body id="main_body" >
	<img id="top" src="images/top.png" alt="">
	<div id="form_container">
		<h1><a>Today's Winners</a></h1>
		<form id="form_346996" class="appnitro"  method="post" action="userprofile1_save.php">
					<div class="form_description">
			<h2>Today's Winners</h2>
			<p>These items are optional and you do not have to answer them in order to use vote often.  However, we believe that by answering these questions you will enhance your experience by being able to generate default charts and graphs when you log in.
For example, if you say select a political or religious affiliation then when you log in you will automatically receive statistics that display how other people who are in the same political or religious group as you have been voting.
</p>
		</div>
		<ul>
		<li id="li_6" >
		<label class="description" for="gender">Gender </label>
		<div>
			<?php	echo $util::zgender();	?>
		</div>
		</li>
		<li id="li_2" >
		<label class="description" for="religion">Religion</label>
		<div>
			<?php	echo $util::zreligion();	?>
		</div><p class="guidelines" id="guide_2"><small>This is not a comprehensive list of the religions of the world.  If you feel left out please let us know in the comments area.</small></p> 
		</li>
		<li id="li_3" >
		<label class="description" for="race">Race </label>
		<div>
			<?php	echo $util::zrace();	?>
		</div><p class="guidelines" id="guide_3"><small>This is not a comprehensive list of the races of the world.  If you feel left out please let us know in the comments area.</small></p> 
		</li>
		<li id="li_4" >
		<label class="description" for="politicalparty">Political Party Affiliation </label>
		<div>
			<?php	echo $util::zpoliticalparty();	?>
		</div>
		<p class="guidelines" id="guide_4"><small>This is not a comprehensive list of all registered political parties in the United States.  If you feel left out please let us know in the comments area.</small></p> 
		</li>
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