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
	
	if(isset($_GET['allvoters']) && !empty($_GET['allvoters']))	{
		$allvoters = $_GET['allvoters'];
		$_SESSION['allvoters'] = $allvoters;
	}	else	{
		$allvoters = "";
	}
	
	//$crud = $_SESSION['crud'];
	
	if(isset($_GET['crud']) && !empty($_GET['crud']))	{
		$crud = $_GET['crud'];
		$_SESSION['crud'] = $crud;
	}	else	{
		$crud = "";
	}
		
	//Making these global
	$electionname = "";
	$electionfinaldate = "";
	$district = "";
	$description = "";


	function getelectionheader($electionid)  {
		require_once($_SESSION['utils']);
		$util = new Utilities();
		
		require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
         }
		
         /*
		if($util->loggedin())	{
				$query = 'select m.electionname, m.electionfinaldate, m.district, m.description, m.allvoters
					from electionlist_main as m where m.electionid=' . $electionid;
		}	else	{
				$query = "select m.electionname, m.electionfinaldate, m.district, m.description, m.allvoters
					from electionlist_main as m where m.electionid=$electionid and allvoters=2";
		}
		*/
		

		$query = 'select m.electionname, m.electionfinaldate, m.district, m.description, m.allvoters
		from electionlist_main as m where m.electionid=' . $electionid;
      $stmt = $db->query($query);
      $num_results=$stmt->num_rows;

      if($num_results > 0) {
         for($i=0; $i<2; $i++)	{
            $row=$stmt->fetch_assoc();
				$electionname = htmlspecialchars(stripslashes($row['electionname']));
				$electionfinaldate = htmlspecialchars(stripslashes($row['electionfinaldate']));
				$district = htmlspecialchars(stripslashes($row['district']));
				$description = htmlspecialchars(stripslashes($row['description']));
				$allvoters = htmlspecialchars(stripslashes($row['allvoters']));
				echo "<h2>$electionname</h2>";
				echo "<p>$description</p>";
         }
		}
   }
	
   function getelection($electionid)  {
		/*	<form>
				<input type="radio" name="sex" value="male" /> Male<br />
				<input type="radio" name="sex" value="female" /> Female
			</form>
		*/
		
      $ul1A = '<ul><li id="li_99" ><label class="description">';
      $ul1Z = '</label><div></div></li>';
		$frmA = '<form>';
      $frmZ = '</form>';
		//$radA = '<input type="radio" name="' .$electionid. '" value="' .$competitor. '" />' . "$competitor<br/>";

		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
      //require_once($_SESSION['dbopen']);
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
         }

		$query = 'select m.electionname, m.electionfinaldate, m.district, m.description, m.infolink
					from electionlist_main as m where m.electionid=' . $electionid;
      $stmt = $db->query($query);
      $num_results=$stmt->num_rows;

      if($num_results > 0) {
         for($i=0; $i<$num_results; $i++)	{
            $row=$stmt->fetch_assoc();
               $electionname = htmlspecialchars(stripslashes($row['electionname']));
               $electionfinaldate = htmlspecialchars(stripslashes($row['electionfinaldate']));
					$district = htmlspecialchars(stripslashes($row['district']));
               $description = htmlspecialchars(stripslashes($row['description']));
					$infolink = $row['infolink'];
         }
		}

//select electionname, electionfinaldate, district, description from electionlist_main where electionid=1
//select competitor from electionlist_sub where electionid = 1;
//select m.electionname, m.electionfinaldate, m.district, m.description, s.competitor from electionlist_main as m, electionlist_sub as s where m.electionid = s.electionid and m.electionid=1

		$query = 'select m.electionname, m.electionfinaldate, m.district, m.description, m.ballottype, s.competitor
					from electionlist_main as m, electionlist_sub as s where m.electionid = s.electionid
					and m.electionid=' . $electionid;
      $stmt = $db->query($query);
      $num_results=$stmt->num_rows;

      if($num_results > 0) {
         for($i=0; $i<$num_results; $i++)	{
            $row=$stmt->fetch_assoc();
               $electionname = stripslashes($row['electionname']);
               $electionfinaldate = stripslashes($row['electionfinaldate']);
					$district = stripslashes($row['district']);
               $description = stripslashes($row['description']);
					$competitor = stripslashes($row['competitor']);
					$ballottype = stripslashes($row['ballottype']);
					$_SESSION['ballottype'] = $ballottype;
					$_SESSION['radA'] = "";
			
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
		<form id="electionlist" class="appnitro"  method="post" action="cast_vote.php">
			<div class="form_description">
				<?php
					switch($crud)	{
						case "read":
							$_SESSION['crud'] = "read";
							getelectionheader($electionid);
								echo '</div>';
							getelection($electionid);
							break;
						case "update":
							$_SESSION['crud'] = "update";
							header('Location: menutemplate.php?process=update_ballot.php');
							break;
						case "delete":
							$_SESSION['crud'] = "delete";
							header('Location: menutemplate.php?process=delete_ballot.php');
							break;
						default:
							$_SESSION['crud'] = "read";
							getelectionheader($electionid);
								echo '</div>';
							getelection($electionid);
							break;
					}
				
					//echo "electionlist_choice 233, crud: $crud<br/>";
					//return;
					
				?>
			
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