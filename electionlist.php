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
      where allvoters >= 0 and userid = " . $_SESSION['userid'];
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
		<h1><a>Your Ballots</a></h1>
		<form id="electionlist" class="appnitro"  method="post" action="electionlist_choice.php">
			<div class="form_description">
			<h2>Your Ballots</h2>
			<p>These are election ballots that you have created.  Only you can modify them.</p>
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