<?php
	$_SESSION['utils']="common/utilities.php";	//Program with common functions.
	$_SESSION['dbopen']="../db_voteoften.php";
   $br = "<br/>";
   $check = FALSE;
   
   if(!isset($_POST['keyword']))   {
      $check = FALSE;
   }   else    {
      $keyword = htmlspecialchars($_POST['keyword']);
      $check = TRUE;
   }

	//If they didn't type in the keyword start over.
   if(!$check) {
      $_SESSION['showerror'] = TRUE;
      header('Location: globallist_keyword.php');
   }  else  {
      $_SESSION['showerror'] = FALSE;  //It's all good so try to get the ballot.
      //get_ballot_main($keyword);
   }

	function get_ballot_main($keyword)	{
		require_once($_SESSION['utils']);
		$util = new Utilities();
		/* Connect to database. */
		require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}	
		
		/* If the keyword has a match get the associated record.  */
		$query = "select m.electionid, m.electionname, m.electionfinaldate, m.district, m.description, m.ballottype, m.allvoters, m.infolink, m.keyword 
					from electionlist_main as m where m.keyword = '$keyword'";
		$stmt = $db->query($query);
		$num_results=$stmt->num_rows;
		
		if($num_results == 1) {
			$row=$stmt->fetch_assoc();
				$electionid = htmlspecialchars(stripslashes($row['electionid']));
				$electionname = htmlspecialchars(stripslashes($row['electionname']));
				$electionfinaldate = htmlspecialchars(stripslashes($row['electionfinaldate']));
				$district = htmlspecialchars(stripslashes($row['district']));
				$description = htmlspecialchars(stripslashes($row['description']));
				$ballottype = htmlspecialchars(stripslashes($row['ballottype']));
				$allvoters = htmlspecialchars(stripslashes($row['allvoters']));
				$infolink = htmlspecialchars(stripslashes($row['infolink']));
				$keyword = htmlspecialchars(stripslashes($row['keyword']));
					$_SESSION['electionid'] = $electionid;
					$_SESSION['ballottype'] = $ballottype;
					/*
					 * I inadvertently discovered something:
					 * $_SESSION['userid'] = round(microtime(true));
					 * When I use the round(microtime(true)) as the userid for the global elections, the result which shows
					 * linechart.php only shows your vote. Even if you vote more than once.  I don't think I'll keep this
					 * but it is kind of useful in the future.
					 */
					if(!isset($_SESSION['userid']) || empty($_SESSION['userid']) )	{
						$_SESSION['userid'] = round(microtime(true));
					}
					
					echo "<h2>$electionname</h2>";
					echo "<p>$description</p>";
				
				//Now call a new query to get the data from electionlist_sub, pass it these parms.
				get_ballot_sub($electionid, $electionname, $electionfinaldate, $district, $description, $ballottype, $allvoters, $infolink, $keyword);
		}	else	{
				echo "failed";
				$msgheader = "Invalid Keyword";
				$msgbody = "The keyword you typed does not match a world viewable ballot.";
				header("Location: menutemplate.php?process=message.php&msgheader=$msgheader&msgbody=$msgbody");
		}
	}
	
	function get_ballot_sub($electionid, $electionname, $electionfinaldate, $district, $description, $ballottype, $allvoters, $infolink, $keyword)	{
		$ul1A = '<ul><li id="li_99" ><label class="description">';
		$ul1Z = '</label><div></div></li>';
		$frmA = '<form>';
		$frmZ = '</form>';
		
		require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		
		$query = "select s.competitor from electionlist_sub as s where electionid = $electionid";
		$stmt = $db->query($query);
		$num_results=$stmt->num_rows;
		
		if($num_results > 0) {
			for($i=0; $i<$num_results; $i++)	{
				$row=$stmt->fetch_assoc();
				$competitor = htmlspecialchars(stripslashes($row['competitor']));
				//echo "competitor: $competitor<br/>";
				
				switch($ballottype)	{
					case 1:
						//$radA = '<input type="radio" name="' .$electionid. '" value="' .$competitor. '" />' . "$competitor<br/>";
						$radA = '<input type="radio" name="choice" value="' .$competitor. '" />' . "$competitor<br/>";
						break;
					case 2:
						//<input type="checkbox" name="option1" value="Milk"> Milk<br>
						$radA = '<input type="checkbox" id="choice' .$i. '" name="choice' .$i. '" value="' .$competitor. '" />' . "$competitor<br/>";
						break;
					case 3:
						if($i == 0)	{
							$radA = '<input type="radio" name="choice" value="Yes" />Yes' . "<br/>";
						}
						if($i == 1)	{
							$radA = '<input type="radio" name="choice" value="No" />No' . "<br/>";
						}
						break;
					case 4:
						if($i == 0)	{
							$radA = '<input type="radio" name="choice" value="True" />True' . "<br/>";
						}
						if($i == 1)	{
							$radA = '<input type="radio" name="choice" value="False" />False' . "<br/>";
						}
						break;
					default:
						//$radA = '<input type="radio" name="' .$electionid. '" value="' .$competitor. '" />' . "$competitor<br/>";
						$radA = '<input type="radio" name="choice" value="' .$competitor. '" />' . "$competitor<br/>";
					break;
				}
				echo $radA . "<br/>";
				}
				if(!empty($infolink))	{
					$butI = '<a href="' .$infolink. '" target="_blank" id="" name="">
					<img title="Ballot Box" id="selectorimg" src="images/infolink.png" width="30" height="30" alt="" border="0" /></a>';
					echo $butI;
				}
				
				echo '<textarea name="reason" id="reason" onclick="SelectAll(';
				echo "'reason');";
				echo '" cols="72" rows="5">Insert any applicable comments here.</textarea><br/>';
				
				$stmt->close();
				$db->close();
			
		}
		
	}
	
	/* Need these in session.
		$competitor = htmlspecialchars($_POST['choice']);
		$reason = htmlspecialchars($_POST['reason']);
	*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>User Profile I</title>
<link rel="stylesheet" type="text/css" href="css/view.css" media="all">
<script type="text/javascript" src="js/view.js"></script>
<script type="text/javascript" src="js/calendar.js"></script>
<script type="text/javascript">
function SelectAll(id)
{
    document.getElementById(id).focus();
    document.getElementById(id).select();
}
</script>
</head>
<body id="main_body" >
	<img id="top" src="images/top.png" alt="">
	<div id="form_container">
		<h1><a>Your Elections</a></h1>
		<form id="electionlist" class="appnitro"  method="post" action="menutemplate.php?process=global_cast_vote.php">
			<div class="form_description">
				<?php get_ballot_main($keyword); ?>
	</div>
		<input id="saveForm" class="button_text" type="submit" name="submit" value="Vote" />
      </ul>
		</form>	
		<div id="footer"></div>
	</div>
	<img id="bottom" src="images/bottom.png" alt="">
	</body>
</html>