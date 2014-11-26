<?php
	//The name of this file is chart_htav.php.
	//The htav stands for How They Are Voting.
	$_SESSION['utils']="common/utilities.php";	//Program with common functions.
	$_SESSION['dbopen']="../db_voteoften.php";
	require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
	require_once($_SESSION['utils']);
      $util = new Utilities();
		$util->keep_alive();
		
	if(!isset($_POST['includepi'])) {
			$includepi = FALSE;
	}	else	{
			$includepi = $_POST['includepi'];	
	}
	if(!isset($_SESSION['userid'])) {
			$_SESSION['userid'] = 0;
	}


	
function getelectionlist_allowed()  {
		$sel1 = '<select class="element select medium" id="electionid" name="electionid">';
		$opt1 = '<option value="';	//Now add electionid
		$opt2 = '" >';					//Now add electionname
		$opt3 = '</option>';
		$sel2 = '</select>';
		$result = $sel1;
	
      require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);	
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
         }
    
      $query = "select electionid, electionname, electionfinaldate, description from electionlist_main
		where allvoters >= 2 or userid = " . $_SESSION['userid'];
      $stmt = $db->query($query);
      $num_results=$stmt->num_rows;

      if($num_results > 0) {
         for($i=0; $i<$num_results; $i++)	{
            $row=$stmt->fetch_assoc();
               $electionid = htmlspecialchars(stripslashes($row['electionid']));
               $electionname = htmlspecialchars(stripslashes($row['electionname']));
               $electionfinaldate = htmlspecialchars(stripslashes($row['electionfinaldate']));
               $description = htmlspecialchars(stripslashes($row['description']));
				$result .= $opt1 . $electionid . $opt2 . $electionname . $opt3;
		}
      $result .= $sel2;		//Now close the select statement
		return $result;
		}
   }
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>How They Are Voting</title>
	<link rel="stylesheet" type="text/css" href="css/view.css" media="all">
</head>
<body id="main_body" >
	<img id="top" src="images/top.png" alt="">
	<div id="form_container">
		<h1><a>How They Are Voting</a></h1>
		<form id="form_htav" class="appnitro" method="post" action="menutemplate.php?process=chart_htav_save.php">
		<div class="form_description">
			<h2>How They Are Voting</h2>
			<p>Below is a chart that shows all of the elections you are allowed to vote in sorted by winner to loser.</p>
			<p>Please note that world viewable ballots are voted on by users that do not have voteoften accounts.  Because
				of this, demographic reporting will not modify the results of the report.</p>
		</div>
		
		<ul>
			<!--
				<li id="li_2" >
					<label class="description medium" for="identify">Personal Identifiers</label>
						<div>
							<?php	//echo $util::zidentify(0);	?>
						</div>
					<p class="guidelines" id="guide_2"><small>some chart info.</small></p>
				</li>
			-->
			<li id="li_2" >
				<label class="description medium" for="electionlist">Election List</label>
					<div>
						<?php	echo getelectionlist_allowed();	?>
					</div>
				<p class="guidelines" id="guide_2"><small>some chart info.</small></p>
			</li>
			<li id="li_2" >
				<label class="description" for="gender">Gender</label>
					<div>
						<?php	echo $util::zgender(0);	?>
					</div>
				<p class="guidelines" id="guide_2"><small>some chart info.</small></p>
			</li>
			<li id="li_2" >
				<label class="description" for="religion">Religion</label>
					<div>
						<?php	echo $util::zreligion(0);	?>
					</div>
				<p class="guidelines" id="guide_2"><small>some chart info.</small></p>
			</li>
			<li id="li_2" >
				<label class="description" for="race">Race</label>
					<div>
						<?php	echo $util::zrace(0);	?>
					</div>
				<p class="guidelines" id="guide_2"><small>some chart info.</small></p>
			</li>
			<li id="li_2" >
				<label class="description" for="politicalparty">Political Party Affiliation</label>
					<div>
						<?php	echo $util::zpoliticalparty(0);	?>
					</div>
				<p class="guidelines" id="guide_2"><small>some chart info.</small></p>
			</li>
			<li id="li_2" >
				<label class="description" for="income">Income</label>
					<div>
						<?php	echo $util::zincome(0);	?>
					</div>
				<p class="guidelines" id="guide_2"><small>some chart info.</small></p>
			</li>
			
			<!-- 
			<li id="li_2" >
				<label class="description" for="identify">Personal Identifiers</label>
					<div>
						<?php	//echo $util::zidentifycb();	?>
					</div>
				<p class="guidelines" id="guide_2"><small>some chart info.</small></p>
			</li>
			 -->
			
			<li>
				<li class="buttons">
			   <input type="hidden" name="form_id" value="htav" />
				<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
			</li>

		</ul>
		</form>	
		<div id="footer"></div>
	</div>
	</body>
</html>