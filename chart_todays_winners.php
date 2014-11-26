<?php
	$_SESSION['utils']="common/utilities.php";	//Program with common functions.
	$_SESSION['dbopen']="../db_voteoften.php";
	require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
	require_once($_SESSION['utils']);
      $util = new Utilities();
		$util->keep_alive();
		
	include "libchart/classes/libchart.php";
   $chart = new HorizontalBarChart(500, 170);

	function get_todays_winners()	{
		$userid = $_SESSION['userid'];
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}

		$query = "select competitor, count(competitor) as count, electionid from votescast where userid=$userid group by competitor order by electionid";
		$query = 'select ' .$zname. ', count(' .$zname. ') as count from ' .$zdb. ', userprofile1 where ' .$zid. ' = ' .$demo. ' group by ' . $zname;
		$stmt = $db->query($query);
		$num_results=$stmt->num_rows;

		if($num_results > 0) {
			for($i=0; $i<$num_results; $i++)	{
				$row=$stmt->fetch_assoc();
					$dataSet->addPoint(new Point($row[$zname] . " (" . $row['count'] . ")", $row['count']));
			}
		}

	$chart->setDataSet($dataSet);

	$chart->setTitle("VoteOften.org User count by " . $demo);
	$filename = "generated/" . $demo . mt_rand() . ".png";
	$chart->render($filename);
   
		echo '<img src="' . $filename . '" class="image-center" />';
	}

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
			<p>Below is a chart that shows all of the elections you are allowed to vote in sorted by winner to loser.</p>
		</div>
		
		<ul>
			<li id="li_2" >
				<label class="description" for="religion">Religion</label>
					<div>
						<?php	echo $util::zreligion();	?>
					</div>
				<p class="guidelines" id="guide_2"><small>some chart info.</small></p>
			</li>
			<img id="bottom" src="images/bottom.png" alt="">
		</ul>
		</form>	
		<div id="footer"></div>
	</div>
	</body>
</html>