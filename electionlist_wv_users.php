<?php

// This will not be used.
exit;


	/*
	 * This needs to query ballots where allvoters = 2
	 */

	$_SESSION['utils']="common/utilities.php";	//Program with common functions.
	$_SESSION['dbopen']="../db_voteoften.php";
	
	require_once($_SESSION['utils']);
      $util = new Utilities();
		$util->keep_alive();

	if(isset($_GET['process']) && !empty($_GET['process']))	{
		$process = $_GET['process'];
	}	else	{
		$process = "";
	}
	
	if(isset($_SESSION['crud']) && !empty($_SESSION['crud']))	{
		$crud = $_SESSION['crud'];
	}	else	{
		$crud = "";
	}
	
	$userid = $_SESSION['userid'];
	
   function getelectionlist_all($crud)  {
   	//$crud is going to equal either 'read', 'update' or 'delete'.
   	
      $ul1A = '<ul><li id="li_99" ><label class="description">';
      $ul1B = '</label><div></div></li>';
      //$butA = '<a href="menutemplate.php?process=electionlist_choice.php&electionid=';
      $butA = '<a href="menutemplate.php?process=electionlist_choice.php&electionid=';
      $butAA = '&allvoters=';
      $butAB = '&crud=';
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
    
      //$query = "select electionid, electionname, electionfinaldate, description, allvoters from electionlist_main
		//where allvoters = TRUE or userid = " . $_SESSION['userid'];
		/*
		 * 0 = Just me
		 * 1 = All VoteOften users
       * 2 = The Whole World
		 */
      $query = "select electionid, electionname, electionfinaldate, description, allvoters from electionlist_main
      where allvoters = 2";
      $stmt = $db->query($query);
      $num_results=$stmt->num_rows;

      if($num_results > 0) {
         for($i=0; $i<$num_results; $i++)	{
            $row=$stmt->fetch_assoc();
               $electionid = htmlspecialchars(stripslashes($row['electionid']));
               $electionname = htmlspecialchars(stripslashes($row['electionname']));
               $electionfinaldate = htmlspecialchars(stripslashes($row['electionfinaldate']));
               $description = htmlspecialchars(stripslashes($row['description']));
               $allvoters = htmlspecialchars(stripslashes($row['allvoters']));
            echo $ul1A;
            //Make Ballot# a button.
            //echo $butA . $electionid . $butB ." ". $electionname . "<br/>";
            //echo $butA . $electionid . $butAA . $allvoters . $butB ." ". $electionname . "<br/>";
            echo $butA . $electionid . $butAA . $allvoters . $butAB . $crud . $butB ." ". $electionname . "<br/>";
            echo $ul1B;
         }
      
      $stmt->close();
      $db->close();
      }
   }
   
   
   function getelectionlist_delete($crud, $userid)  {
   	$ul1A = '<ul><li id="li_99" ><label class="description">';
   	$ul1B = '</label><div></div></li>';
   	$butA = '<a href="menutemplate.php?process=electionlist_choice.php&electionid=';
   	$butAA = '&allvoters=';
   	$butAB = '&crud=';
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
   
   	//$query = "select electionid, electionname, electionfinaldate, description, allvoters from electionlist_main
   	//where allvoters = TRUE or userid = " . $_SESSION['userid'];
   	/*
   	 * 0 = Just me
   	* 1 = All VoteOften users
   	* 2 = The Whole World
   	*/
   	//$query = "select electionid, electionname, electionfinaldate, description, allvoters from electionlist_main where allvoters > 0 or userid = " . $_SESSION['userid'];
   	$query = "select electionid, electionname, electionfinaldate, description, allvoters from electionlist_main where userid = $userid";
   	$stmt = $db->query($query);
   	$num_results=$stmt->num_rows;
   
   	if($num_results > 0) {
   		for($i=0; $i<$num_results; $i++)	{
   			$row=$stmt->fetch_assoc();
   			$electionid = htmlspecialchars(stripslashes($row['electionid']));
   			$electionname = htmlspecialchars(stripslashes($row['electionname']));
   			$electionfinaldate = htmlspecialchars(stripslashes($row['electionfinaldate']));
   			$description = htmlspecialchars(stripslashes($row['description']));
   			$allvoters = htmlspecialchars(stripslashes($row['allvoters']));
   			echo $ul1A;
   			//Make Ballot# a button.
   			//echo $butA . $electionid . $butB ." ". $electionname . "<br/>";
   			//echo $butA . $electionid . $butAA . $allvoters . $butB ." ". $electionname . "<br/>";
   			echo $butA . $electionid . $butAA . $allvoters . $butAB . $crud . $butB ." ". $electionname . "<br/>";
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
<title>Your Elections</title>
<link rel="stylesheet" type="text/css" href="css/view.css" media="all">
<script type="text/javascript" src="js/view.js"></script>
<script type="text/javascript" src="js/calendar.js"></script>
</head>
<body id="main_body" >
	<img id="top" src="images/top.png" alt="">
	<div id="form_container">
		<h1><a>Your Elections</a></h1>
		<form id="electionlist" class="appnitro"  method="post" action="globallist_keyword.php">
			<div class="form_description">
			<h2>Your Elections</h2>
			<p>These are election ballots that were created by another VoteOften user.  If you know the keyword for a ballot you can vote on it.</p>
	</div>
      <?php
      	switch($crud)	{
      		case "read":
      			$_SESSION['crud'] = "read";
      			getelectionlist_all($crud);
      			break;
      		case "update":
      			$_SESSION['crud'] = "update";
      			getelectionlist_all($crud);
      			break;
      		case "delete":
      			$_SESSION['crud'] = "delete";
      			getelectionlist_delete($crud, $userid);
      			break;
      	}
      	//echo "electionlist 103, crud: $crud<br/>";
      	//return;
      ?>
		</form>	
		<div id="footer"></div>
	</div>
	<img id="bottom" src="images/bottom.png" alt="">
	</body>
</html>
