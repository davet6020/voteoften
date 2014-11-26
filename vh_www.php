<?php
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
   
   function getelectionlist_all()  {
   	$tblA = '<table border="0">';		//Start of the table
   	$tblB = '<tr><th></th><th>My Votes&nbsp&nbsp&nbsp</th><th> All Votes</th></tr>';
   	$trA = '<tr>';							//Starts a new row
   	$trZ = '</tr>';						//Ends a row
   	$tdA = '<td valign="bottom">';							//Starts a column
   	$tdZ = '</td>';						//Ends a column
   	$tblZ = '</table>';					//End of the table
   	$rbA = '<input type="radio" name="group';		//add the num_results to group to make it unique.
   	$rbB = '" value="mine" checked />';
   	$rbC = '<input type="radio" name="group';		//add the num_results to group to make it unique.
   	$rbD = '" value="all" />';
   	
      $ul1A = '<ul><li id="li_99" ><label class="description">';
      $ul1B = '</label><div></div></li>';
      $butA = '<a href="menutemplate.php?process=vh_choice.php&electionid=';
		//In between these two for the echo you have to put the value of $electionid.
		$butAA = '&rb="';
      $butB = '" "id="" name=""><img title="Ballot Box" id="selectorimg" src="images/BallotBox.png" width="30" height="32" alt="" border="0" /></a>';

      $butX = '<input type="hidden" name="form_id" value="346996" />
               <input id="saveForm" class="button_text" type="submit" name="submit" value="';
      $butY = '" />';

      require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
         }
    
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

            echo $ul1A;
            //Make Ballot# a button.

            echo $butA . $electionid . $butB ." ". $electionname . "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
            echo $ul1B;
         }
         
      $stmt->close();
      $db->close();
      }
   }
   
   function footer()	{
   	echo '<img id="bottom" src="images/bottom.png" alt="">';
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
		<h1><a>Other VoteOften Users Ballots</a></h1>
		<form id="electionlist" class="appnitro"  method="post" action="vh_choice.php">
			<div class="form_description">
			<h2>Other VoteOften Users Ballots</h2>
			<p>These are elections that you have either selected to vote in or by default are associated to your zip code.</p>
	</div>
      <?php getelectionlist_all(); ?>
      </ul>
		</form>	
		<div id="footer"></div>
	</div>
	
	</body>
	
</html>

