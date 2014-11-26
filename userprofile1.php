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
<title>User Profile I</title>
<link rel="stylesheet" type="text/css" href="css/view.css" media="all">
<script type="text/javascript" src="js/view.js"></script>
<script type="text/javascript" src="js/calendar.js"></script>
</head>
<body id="main_body" >
	<img id="top" src="images/top.png" alt="">
	<div id="form_container">
		<h1><a>User Profile I</a></h1>
		<form id="form_346996" class="appnitro"  method="post" action="userprofile1_save.php">
					<div class="form_description">
			<h2>User Profile I</h2>
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
		</div><p class="guidelines" id="guide_4"><small>This is not a comprehensive list of all registered political parties in the United States.  If you feel left out please let us know in the comments area.</small></p> 
		</li>
		<li id="li_1" >
		<label class="description" for="dob">Date of Birth </label>
		<span>
			<input id="month" name="month" class="element text" size="2" maxlength="2" value="" type="text"> /
			<label for="month">MM</label>
		</span>
		<span>
			<input id="day" name="day" class="element text" size="2" maxlength="2" value="" type="text"> /
			<label for="day">DD</label>
		</span>
		<span>
	 		<input id="year" name="year" class="element text" size="4" maxlength="4" value="" type="text">
			<label for="year">YYYY</label>
		</span>
		<span id="calendar_1">
			<img id="cal_img_1" class="datepicker" src="images/calendar.gif" alt="Pick a date.">	
		</span>
		<script type="text/javascript">
			Calendar.setup({
			inputField	 : "year",
			baseField    : "month",
			displayArea  : "calendar_1",
			button		 : "cal_img_1",
			ifFormat	 : "%B %e, %Y",
			onSelect	 : selectDate
			});
		</script>
		<p class="guidelines" id="guide_1"><small>Leave blank if you do not want to answer.</small></p> 
		</li>
		<li id="li_5" >
		<label class="description" for="income">Annual Income </label>
		<div>
			<?php	echo $util::zincome();	?>
		</div><p class="guidelines" id="guide_5"><small>These numbers came from the 2011 U.S. Federal income tax rate table.</small></p> 
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