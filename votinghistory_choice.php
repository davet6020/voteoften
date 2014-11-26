<?php
	$_SESSION['utils']="common/utilities.php";	//Program with common functions.
	$_SESSION['dbopen']="../db_voteoften.php";
	
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
<title>User Profile I</title>
<link rel="stylesheet" type="text/css" href="css/view.css" media="all">
<script type="text/javascript" src="js/view.js"></script>
<script type="text/javascript" src="js/calendar.js"></script>
</head>
<body id="main_body" >
	<img id="top" src="images/top.png" alt="">
	<div id="form_container">
		<h1><a>Your Elections</a></h1>
		<form id="electionlist" class="appnitro"  method="post" action="cast_vote.php">
			<div class="form_description">
	</div>
      <?php header('Location: menutemplate.php?process=linechart.php'); ?>
		<input id="saveForm" class="button_text" type="submit" name="submit" value="Vote" />
      </ul>
		</form>	
		<div id="footer"></div>
	</div>
	<img id="bottom" src="images/bottom.png" alt="">
	</body>
</html>

<?php
/*
 //Get my congressional district based on zip code.
   "select district1 from congressionaldistricts where zipcode = '80218'"
 //All elections that are for every user. 
   "select electionid, electionname, electionfinaldate, description from electionlist_main where allvoters = TRUE";
 //All elections for a users voting district.
   'select electionid, electionname, electionfinaldate, description from electionlist_main where district = "' . $district . '"'
 //Join electionlist_main and electionlist_sub together to create a list of each individual election to vote on.
      select M.electionid, M.electionname, M.electionfinaldate, M.district, M.description, M.allvoters, S.electionid,
             S.competitor, S.party from electionlist_main as M, electionlist_sub as S
             where M.electionid = S.electionid and M.electionid = 1


   mysql> desc electionlist_main;
   +-------------------+-------------+------+-----+---------+----------------+
   | Field             | Type        | Null | Key | Default | Extra          |
   +-------------------+-------------+------+-----+---------+----------------+
   | electionid        | int(8)      | NO   | PRI | NULL    | auto_increment |
   | electionname      | varchar(50) | NO   |     | NULL    |                |
   | electionfinaldate | date        | NO   |     | NULL    |                |
   | district          | varchar(9)  | NO   |     | NULL    |                |
   | description       | tinytext    | NO   |     | NULL    |                |
   | allvoters         | tinyint(1)  | NO   |     | NULL    |                |
   +-------------------+-------------+------+-----+---------+----------------+
   
   mysql> desc electionlist_sub;
   +------------+-------------+------+-----+---------+-------+
   | Field      | Type        | Null | Key | Default | Extra |
   +------------+-------------+------+-----+---------+-------+
   | electionid | int(8)      | NO   |     | NULL    |       |
   | competitor | varchar(50) | NO   |     | NULL    |       |
   | party      | varchar(50) | NO   |     | NULL    |       |
   +------------+-------------+------+-----+---------+-------+
*/
?>