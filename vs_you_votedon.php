<?php
	$_SESSION['utils']="common/utilities.php";	//Program with common functions.
	$_SESSION['dbopen']="../db_voteoften.php";
	$votingsystem = $_SESSION['votingsystem'];
	
	require_once($_SESSION['utils']);
      $util = new Utilities();
		$util->keep_alive();

	if(isset($_GET['process']) && !empty($_GET['process']))	{
		$process = $_GET['process'];
	}	else	{
		$process = "";
	}
	
	function getmajoritylist()	{
		$_SESSION['myvotes'] = "myvotes";
		$ul1A = '<ul><li id="li_99" ><label class="description">';
		$ul1B = '</label><div></div></li>';
		$butA = '<a href="menutemplate.php?process=vs_choice.php&electionid=';
		//In between these two for the echo you have to put the value of $electionid.
		$butB = ' "id="" name=""><img title="Ballot Box" id="selectorimg" src="images/BallotBox.png" width="30" height="32" alt="" border="0" /></a>';
		
		$butX = '<input type="hidden" name="form_id" value="346996" />
		<input id="saveForm" class="button_text" type="submit" name="submit" value="';
		$butY = '" />';
		
		require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		
		$query = "select distinct e.electionid, e.electionname, e.electionfinaldate, e.description, e.allvoters, v.electionid
					from electionlist_main as e, votescast as v 
					where e.electionid = v.electionid and v.userid=" . $_SESSION['userid'] .
					" and e.ballottype > 2";
					
		$stmt = $db->query($query);
		$num_results=$stmt->num_rows;
		
		if($num_results > 0) {
			for($i=0; $i<$num_results; $i++)	{
				$row=$stmt->fetch_assoc();
				$electionid = htmlspecialchars(stripslashes($row['electionid']));
				$electionname = htmlspecialchars(stripslashes($row['electionname']));
				$electionfinaldate = htmlspecialchars(stripslashes($row['electionfinaldate']));
				$description = htmlspecialchars(stripslashes($row['description']));
				echo $ul1A;
				//Make Ballot# a button.
				echo $butA . $electionid . $butB ." ". $electionname . "<br/>";
				echo $ul1B;
			}
		
			$stmt->close();
			$db->close();
		}
	}
		
   
	function getpluralitylist()	{
	$_SESSION['myvotes'] = "myvotes";
		$ul1A = '<ul><li id="li_99" ><label class="description">';
		$ul1B = '</label><div></div></li>';
		$butA = '<a href="menutemplate.php?process=vs_choice.php&electionid=';
		//In between these two for the echo you have to put the value of $electionid.
		$butB = ' "id="" name=""><img title="Ballot Box" id="selectorimg" src="images/BallotBox.png" width="30" height="32" alt="" border="0" /></a>';
		
		$butX = '<input type="hidden" name="form_id" value="346996" />
		<input id="saveForm" class="button_text" type="submit" name="submit" value="';
		$butY = '" />';
		
		require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		
		$query = "select distinct e.electionid, e.electionname, e.electionfinaldate, e.description, e.allvoters, v.electionid
					from electionlist_main as e, votescast as v 
					where e.electionid = v.electionid and v.userid=" . $_SESSION['userid'] .
					" and e.ballottype > 0";
					
		$stmt = $db->query($query);
		$num_results=$stmt->num_rows;
		
		if($num_results > 0) {
			for($i=0; $i<$num_results; $i++)	{
				$row=$stmt->fetch_assoc();
				$electionid = htmlspecialchars(stripslashes($row['electionid']));
				$electionname = htmlspecialchars(stripslashes($row['electionname']));
				$electionfinaldate = htmlspecialchars(stripslashes($row['electionfinaldate']));
				$description = htmlspecialchars(stripslashes($row['description']));
				echo $ul1A;
				//Make Ballot# a button.
				echo $butA . $electionid . $butB ." ". $electionname . "<br/>";
				echo $ul1B;
			}
		
			$stmt->close();
			$db->close();
		}
	}	
	
   function getelectionlist_all()  {
   	$_SESSION['myvotes'] = "myvotes";
      $ul1A = '<ul><li id="li_99" ><label class="description">';
      $ul1B = '</label><div></div></li>';
      $butA = '<a href="menutemplate.php?process=vs_choice.php&electionid=';
		//In between these two for the echo you have to put the value of $electionid.
      $butB = ' "id="" name=""><img title="Ballot Box" id="selectorimg" src="images/BallotBox.png" width="30" height="32" alt="" border="0" /></a>';

      $butX = '<input type="hidden" name="form_id" value="346996" />
               <input id="saveForm" class="button_text" type="submit" name="submit" value="';
      $butY = '" />';

      require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
         }
    
		$query = "select distinct e.electionid, e.electionname, e.electionfinaldate, e.description, e.allvoters, v.electionid
         		from electionlist_main as e, votescast as v where e.electionid = v.electionid and v.userid=" . $_SESSION['userid'];
      $stmt = $db->query($query);
      $num_results=$stmt->num_rows;

      if($num_results > 0) {
         for($i=0; $i<$num_results; $i++)	{
            $row=$stmt->fetch_assoc();
               $electionid = htmlspecialchars(stripslashes($row['electionid']));
               $electionname = htmlspecialchars(stripslashes($row['electionname']));
               $electionfinaldate = htmlspecialchars(stripslashes($row['electionfinaldate']));
               $description = htmlspecialchars(stripslashes($row['description']));
            echo $ul1A;
            //Make Ballot# a button.
            echo $butA . $electionid . $butB ." ". $electionname . "<br/>";
            echo $ul1B;
         }
      
      $stmt->close();
      $db->close();
      }
   }
   
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Elections You Voted In</title>
<link rel="stylesheet" type="text/css" href="css/view.css" media="all">
<script type="text/javascript" src="js/view.js"></script>
<script type="text/javascript" src="js/calendar.js"></script>
</head>
<body id="main_body" >
	<img id="top" src="images/top.png" alt="">
	<div id="form_container">
		<h1><a>Elections You Voted In</a></h1>
		<form id="electionlist" class="appnitro"  method="post" action="vs_choice.php">
			<div class="form_description">
			<h2>Elections You Voted In</h2>
			<p>These are election ballots that you have voted on.</p>
	</div>
      <?php 
      	switch($votingsystem)	{
				case "vs_majority.php":
					getmajoritylist();
					break;
				case "vs_plurality.php":
					getpluralitylist();
					break;
      	}
				
      //getelectionlist_all(); 
      
      ?>
      </ul>
		</form>	
		<div id="footer"></div>
	</div>
	<img id="bottom" src="images/bottom.png" alt="">
	</body>
</html>
