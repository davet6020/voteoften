<?php
	$_SESSION['utils']="common/utilities.php";	//Program with common functions.
	$_SESSION['dbopen']="../db_voteoften.php";
	$userid = $_SESSION['userid'];
	
	require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
	require_once($_SESSION['utils']);
      $util = new Utilities();
		$util->keep_alive();

	$totalnumcompetitors = 0;

	if(isset($_GET['electionid']) && !empty($_GET['electionid']))	{
		$electionid = $_GET['electionid'];
		$_SESSION['electionid'] = $electionid;
	}
	
	if(isset($_SESSION['electionid']) && !empty($_SESSION['electionid']))	{
			$electionid = $_SESSION['electionid'];
	}	else	{
			$electionid = "";
			header('Location: index.php');
	}
	
	include "libchart/classes/libchart.php";
	//$chart = new VerticalBarChart(500, 250);
	$chart = new VerticalBarChart(600, 420);
	$dataSet = new XYDataSet();
	
   if (mysqli_connect_errno()) {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
   }

	//============================Get Election Name
	$query = "select electionname, allvoters from electionlist_main where electionid = $electionid";
	$stmt = $db->query($query);
   $num_results=$stmt->num_rows;

   if($num_results > 0) {
		for($i=0; $i<$num_results; $i++)	{
			$row=$stmt->fetch_assoc();
				$electionname = $row['electionname'];
				$allvoters = $row['allvoters'];
				$_SESSION['allvoters'] = $allvoters;
		}
	}

	//============================Get Actual Number of Competitors
	//Get actual number of competitors in case one of them has received 0 votes.
	//select count(competitor) as count from electionlist_sub where electionid = 1
	$query = "select count(competitor) as count from electionlist_sub where electionid = $electionid";
	$stmt = $db->query($query);
   $num_results=$stmt->num_rows;

   if($num_results > 0) {
		for($i=0; $i<$num_results; $i++)	{
			$row=$stmt->fetch_assoc();
				$totalnumcompetitors = $row['count'];
		}
	}
	
	if($num_results < $totalnumcompetitors)	{
		//Missing a competitor because nobody voted for it.
		$query = "select competitor from electionlist_sub where electionid = $electionid";
		$stmt = $db->query($query);
		$num_results=$stmt->num_rows;
		$totalcompetitors = array();
		
		if($num_results > 0) {
			for($i=0; $i<$num_results; $i++)	{
				$row=$stmt->fetch_assoc();
					array_push($totalcompetitors, $row['competitor']);
			}
		}
	}

	//============================Get Linechart Data
	$allvoters = $_SESSION['allvoters'];
	
	switch($allvoters)	{
		case "0":
			$query = "select competitor, count(competitor) as count from votescast 
						where electionid = $electionid and userid = $userid group by competitor";
			break;
		case "1":
			if(isset($_SESSION['myvotes']))	{
				if($_SESSION['myvotes'] == "myvotes")	{
					$_SESSION['myvotes'] = "";
						$query = "select competitor, count(competitor) as count from votescast 
									where electionid = $electionid and userid = $userid group by competitor";
				}	else	{
						$query = "select competitor, count(competitor) as count from votescast where electionid = $electionid group by competitor";
				}
			}	else	{
					$query = "select competitor, count(competitor) as count from votescast where electionid = $electionid group by competitor";
			}
			break;
		case "2":
			if(isset($_SESSION['myvotes']))	{
				if($_SESSION['myvotes'] == "myvotes")	{
					$_SESSION['myvotes'] = "";
						$query = "select competitor, count(competitor) as count from votescast 
									where electionid = $electionid and userid = $userid group by competitor";
				}	else	{
						$query = "select competitor, count(competitor) as count from votescast where electionid = $electionid group by competitor";
				}
			}	else	{
					$query = "select competitor, count(competitor) as count from votescast where electionid = $electionid group by competitor";
			}
			break;
	}
	
   $stmt = $db->query($query);
   $num_results=$stmt->num_rows;
	$votedcompetitors = array();

   if($num_results > 0) {
		for($i=0; $i<$num_results; $i++)	{
			$row=$stmt->fetch_assoc();
				$dataSet->addPoint(new Point($row['competitor'] . " (" . $row['count'] . ")", $row['count']));
				array_push($votedcompetitors, $row['competitor']);
		}
			$thediff = array();
			$thediff = array_diff($totalcompetitors, $votedcompetitors);
				foreach($thediff as $key => $name){
					$dataSet->addPoint(new Point($name . " (" . 0 . ")", 0));
				}
	}

	$chart->setDataSet($dataSet);
	$chart->setTitle("Votes you have cast for election: " . $electionname);
	$filename = "generated/" . $electionid . mt_rand() . ".png";
	$chart->render($filename);
   
   echo '<img src="' . $filename . '" class="centeredImage" />';

	function get_reason($userid, $electionid)	{
		require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
		$tb_struc='<table class="info" text-align="left" border="3">
					<tr style="background-color: rgb(79, 24, 51); color: white">
						<th>Date</th>
						<th>Reason</th>
					</tr>';

		$allvoters = $_SESSION['allvoters'];
		switch($allvoters)	{
			case "0":
				$query = "select datecast, reason from votescast where userid='$userid' and electionid = $electionid order by datecast";
				break;
			case "1":
				$query = "select datecast, reason from votescast where electionid = $electionid order by datecast";
				break;
			case "2":
				$query = "select datecast, reason from votescast where electionid = $electionid order by datecast";
				break;
		}
				
		$stmt = $db->query($query);
		$num_results=$stmt->num_rows;
		$votedcompetitors = array();

		echo "<br/>" . $tb_struc;
		
		if($num_results > 0) {
         for($i=0; $i<$num_results; $i++)	{
            $row=$stmt->fetch_assoc();
               $datecast = htmlspecialchars(stripslashes($row['datecast']));
               $reason = htmlspecialchars(stripslashes($row['reason']));
				if(!empty($reason))	{
					$class = ($i%2 == 0)? 'row0': 'row1';
					$chgdate = date('Y-m-d h:i:s e', $datecast);
					echo "<tr class='$class' align='left'>";
					echo '<td>' .$chgdate. '</td><td>&nbsp;' . $reason . '&nbsp;</td></tr>';
				}
         }
		}
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="css/view.css" media="all">
		<link rel="stylesheet" type="text/css" href="css/menu_style.css" media="all">
	</head>
	<body>
		<?php
			get_reason($userid, $electionid);
		?>
		<br/>
		<img id="bottom" src="images/bottom.png" alt="">
	</body>
</html>
