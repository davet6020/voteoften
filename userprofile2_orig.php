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
			<input id="Conservative" name="Conservative" class="element checkbox" type="checkbox" value="1" />
			<label class="choice" for="Conservative">Conservative</label>
			<input id="Liberal" name="Liberal" class="element checkbox" type="checkbox" value="1" />
			<label class="choice" for="Liberal">Liberal</label>
			<input id="Religious" name="Religious" class="element checkbox" type="checkbox" value="1" />
			<label class="choice" for="Religious">Religious</label>
			<input id="RightWing" name="RightWing" class="element checkbox" type="checkbox" value="1" />
			<label class="choice" for="RightWing">Right Wing</label>
			<input id="LeftWing" name="LeftWing" class="element checkbox" type="checkbox" value="1" />
			<label class="choice" for="LeftWing">Left Wing</label>
			<input id="Inthemiddle" name="Inthemiddle" class="element checkbox" type="checkbox" value="1" />
			<label class="choice" for="Inthemiddle">In the middle</label>
			<input id="FiscallyConservative" name="FiscallyConservative" class="element checkbox" type="checkbox" value="1" />
			<label class="choice" for="FiscallyConservative">Fiscally Conservative</label>
			<input id="AntiBigGovernment" name="AntiBigGovernment" class="element checkbox" type="checkbox" value="1" />
			<label class="choice" for="AntiBigGovernment">Anti Big Government</label>
			<input id="Wealthy" name="Wealthy" class="element checkbox" type="checkbox" value="1" />
			<label class="choice" for="Wealthy">Wealthy</label>
			<input id="MiddleClass" name="MiddleClass" class="element checkbox" type="checkbox" value="1" />
			<label class="choice" for="MiddleClass">Middle Class</label>
			<input id="Poor" name="Poor" class="element checkbox" type="checkbox" value="1" />
			<label class="choice" for="Poor">Poor</label>
			<input id="ProFreeSpeech" name="ProFreeSpeech" class="element checkbox" type="checkbox" value="1" />
			<label class="choice" for="ProFreeSpeech">Pro Free Speech</label>
			<input id="ProOwningFirearms" name="ProOwningFirearms" class="element checkbox" type="checkbox" value="1" />
			<label class="choice" for="ProOwningFirearms">Pro Owning Firearms</label>
			<input id="ProChoice" name="ProChoice" class="element checkbox" type="checkbox" value="1" />
			<label class="choice" for="ProChoice">Pro Choice</label>
			<input id="ProLife" name="ProLife" class="element checkbox" type="checkbox" value="1" />
			<label class="choice" for="ProLife">Pro Life</label>
			<input id="AntiFreeSpeech" name="AntiFreeSpeech" class="element checkbox" type="checkbox" value="1" />
			<label class="choice" for="AntiFreeSpeech">Anti Free Speech</label>
			<input id="AgainstOwningFirearms" name="AgainstOwningFirearms" class="element checkbox" type="checkbox" value="1" />
			<label class="choice" for="AgainstOwningFirearms">Against Owning Firearms</label>
			<input id="CityDweller" name="CityDweller" class="element checkbox" type="checkbox" value="1" />
			<label class="choice" for="CityDweller">City Dweller</label>
			<input id="RuralDweller" name="RuralDweller" class="element checkbox" type="checkbox" value="1" />
			<label class="choice" for="RuralDweller">Rural Dweller</label>

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