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
	$majority = array();

   if($num_results > 0) {
		for($i=0; $i<$num_results; $i++)	{
			$row=$stmt->fetch_assoc();
				//populates the array $majority with the two competitors.
				$dataSet->addPoint(new Point($row['competitor'] . " (" . $row['count'] . ")", $row['count']));
				array_push($votedcompetitors, $row['competitor']);
				//Step - for competitors with 1 or more votes
				array_push($majority, $row['competitor'], $row['count']);
		}
			$thediff = array();
			$thediff = array_diff($totalcompetitors, $votedcompetitors);
				foreach($thediff as $key => $name){
					$dataSet->addPoint(new Point($name . " (" . 0 . ")", 0));
					//Step 0 for competitors with 0 votes
					array_push($majority, $name, 0);
				}
	}
	//0.) Get all competitors, even the ones who have 0 votes.
	//1.) Find out who has the most votes = $mostvotes
	//2.) Find out the totalnum of votes = $totnumvotes
	//3.) Divide $mostvotes by $totnumvotes = $ismajority
	//4.) If the result of step 3 is >50 then we have a plurality.
	
	//Step 1
	if($majority[1] > $majority[3])	{
			$mostvotes = $majority[1];
			$mostname = '"' . $majority[0] . '" is the majority winner';
	}	else if($majority[3] > $majority[1])	{
			$mostvotes = $majority[3];
			$mostname = '"' . $majority[2] . '" is the majority winner';
	}	else	{
			$mostvotes = $majority[1];
			$mostname = "There is no majority winner.";
	}
	
	//Step 2
	$totnumvotes = $majority[1] + $majority[3];
		//echo "totnumvotes: $totnumvotes <br/>";
	//Step 3
	$ismajority = $mostvotes / $totnumvotes;
		//echo "ismajority: $ismajority <br/>";
	
	//Step 4
	//Takes place in the body of HTML
	
	$chart->setDataSet($dataSet);
	//$chart->setTitle("Votes you have cast for election: " . $electionname);
	$chart->setTitle("Majority Rule outcome for: " . $electionname);
	$filename = "generated/" . $electionid . mt_rand() . ".png";
	$chart->render($filename);
   
   echo '<img src="' . $filename . '" class="centeredImage" />';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="css/view.css" media="all">
		<link rel="stylesheet" type="text/css" href="css/menu_style.css" media="all">
	</head>
	<body>
		<br/>
		<img id="bottom" src="images/bottom.png" alt="">
		<?php
			if($ismajority > .50)	{
				echo '
				<table border="0">
					<tr>
						<td>';
				
				echo '<p class="vswinner">&nbsp;&nbsp;' . $mostname . '&nbsp;&nbsp;</p>';
						
				echo '
						</td>
					</tr>
				</table>
				';
			}	else	{
				echo '<table border="0"><tr><td>';
				echo '<p class="vswinner">&nbsp;&nbsp;' . $mostname . '&nbsp;&nbsp;</p>';
				echo '</td></tr></table>';
			}
		?>
		
		<p>
			<strong>Majority Rule</strong> means that the choice receiving more than 50% of the vote is the winner.
		</p>
		<p>
			This is the simplest type of voting system and applies to elections with only two choices.
		</p>
	</body>
</html>
