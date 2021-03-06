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
	<script type="text/javascript" src="js/view.js"></script>
	<script type="text/javascript" src="js/calendar.js"></script>
</head>
<body>

	<body id="main_body" >
	<img id="top" src="images/top.png" alt="">
	<div id="form_container">
		<h1><a>Add Change History</a></h1>
		<form id="form_346996" class="appnitro"  method="post" action="change_history_add_save.php">
					<div class="form_description">
			<h2>Add Change History</h2>
		</div>
		<ul>

		<li id="li_6" >
		<label class="description" for="description">Description</label>
		<div>
			<textarea value="left" name="description" id="description" cols="70" rows="8">
			</textarea><br/>
		</div>
		</li>
		
		<li id="li_2" >
		<label class="description" for="date">Date</label>
		<?php
			$chgdate = mktime();
			$_SESSION['chgdate'] = $chgdate;
			//Year, Month, Day, Hours, Minutes, Seconds, timezone which for me is UTC
			echo date('Y-m-d h:i:s e', $chgdate) . "<br/><br/>";
		?>
		
		</li>
		
		</li>
		<li id="li_5" >
		<label class="description" for="fixed">Fixed</label>
		<div>
			<select class="element select medium" id="fixed" name="fixed">
				<?php
					if($_SESSION['fixed'])	{
							echo '
								<option value="0" >False</option>
								<option value="1" selected="selected">True</option>
							';
					}	else	{
							echo '
								<option value="0" selected="selected" >False</option>
								<option value="1" >True</option>
							';
					}
				?>
			</select>
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
   
</body>
</html>

