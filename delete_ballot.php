<?php
	$_SESSION['utils']="common/utilities.php";	//Program with common functions.
	$_SESSION['dbopen']="../db_voteoften.php";
	$userid = $_SESSION['userid'];
	$submit = "";
	
	require_once($_SESSION['utils']);
      $util = new Utilities();
		$util->keep_alive();

	if(isset($_SESSION['electionid']) && !empty($_SESSION['electionid']))	{
		$electionid = $_SESSION['electionid'];
	}	else	{
		$electionid = "";
	}
	
	if(isset($_POST['submit']) && !empty($_POST['submit']))	{
		$submit = $_POST['submit'];
	}	else	{
		$submit = "";
	}
	
	if($submit == "Yes")	{
			delete_election($electionid, $userid);
	}	else if($submit == "No")	{
			header('Location: index.php');
	}
	
	function getelection_main($electionid)  {
		require_once($_SESSION['utils']);
		$util = new Utilities();
		
		require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
         }
		
		$query = 'select m.electionname, m.description from electionlist_main as m where m.electionid=' . $electionid;
	   $stmt = $db->query($query);
      $num_results=$stmt->num_rows;

      if($num_results > 0) {
         for($i=0; $i<1; $i++)	{
            $row=$stmt->fetch_assoc();
				$electionname = htmlspecialchars(stripslashes($row['electionname']));
				$description = htmlspecialchars(stripslashes($row['description']));
         }
         echo "<h2>You have elected to delete the following ballot:</h2>";
         echo "<p>$electionname</p>";
         echo "<p>$description</p>";
         echo "<h3>Are you sure you want to do this?</h3>";
      }
	}
	
	function delete_election($electionid, $userid)  {
		//Delete all records from electionlist_main for this election.
		require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname) or die(mysqli_error());
		$query = "delete from electionlist_main where electionid=$electionid";
		$result = $db->query($query) or die(mysqli_error($mysqli));
		
		//Delete all records from electionlist_sub for this election.
		require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname) or die(mysqli_error());
		$query = "delete from electionlist_sub where electionid=$electionid";
		$result = $db->query($query) or die(mysqli_error($mysqli));
		
		//Delete all records from votescast for this election.
		//The problem is I specify userid and anonymous userids are different from the person who created the ballot.
		//Just have to verify that the creator is deleting it.
		require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname) or die(mysqli_error());
		//$query = "delete from votescast where electionid=$electionid and userid=$userid";
		$query = "delete from votescast where electionid=$electionid";
		$result = $db->query($query) or die(mysqli_error($mysqli));
		
		$msgheader = "The ballot was deleted.";
		$msgbody = "";
		header("Location: menutemplate.php?process=message.php&msgheader=$msgheader&msgbody=$msgbody");
   }
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Update Ballot</title>
<link rel="stylesheet" type="text/css" href="css/view.css" media="all">
<script type="text/javascript" src="js/view.js"></script>
<script type="text/javascript" src="js/calendar.js"></script>
<script type="text/javascript">

</script>
</head>
<body id="main_body" >
	<img id="top" src="images/top.png" alt="">
	<div id="form_container_mc1">
		<h1><a>Your Elections</a></h1>
		<form id="electionlist" class="appnitro"  method="post" action="">
			<div class="form_description">
			
				<?php
					getelection_main($electionid);
					echo '</div>';
				?>
			
		<input id="saveForm" class="button_text" type="submit" name="submit" value="Yes" />
		<input id="saveForm" class="button_text" type="submit" name="submit" value="No" />
      </ul>
		</form>	
		<div id="footer"></div>
	</div>
	<img id="bottom" src="images/bottom.png" alt="">
	</body>
</html>
