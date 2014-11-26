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
      $ul1A = '<ul><li id="li_99" ><label class="description">';
      $ul1B = '</label><div></div></li>';
      $butA = '<a href="menutemplate.php?process=electionlist_choice.php&electionid=';
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
    
      $query = 'select electionid, electionname, electionfinaldate, description from electionlist_main where allvoters = TRUE';
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
<title>Create A Ballot</title>
<link rel="stylesheet" type="text/css" href="css/view.css" media="all">
</head>
<body id="main_body" >
	<img id="top" src="images/top.png" alt="">
	<div id="form_container">
		<h1><a>Create A Ballot</a></h1>
		<form id="electionlist" class="appnitro" method="post" action="">
		<div class="form_description">
			<h2>Create A Ballot</h2>
			<p>On this page you can create your own ballot.  There are three types of ballots that you can create.</p>
		</div>
		
			<li>
				<label class="description">
					<a href="menutemplate.php?process=create_ballot_choice.php&ballot1=mc1" id="ZZ" name="ZZ" style="text-decoration: none;" onmouseover="this.style.textDecoration = 'underline'" onmouseout="this.style.textDecoration = 'none'">
						<img title="Ballot Box" id="selectorimg" src="images/BallotBox.png" width="32" height="32" alt="" border="0" />
					</a>Multiple-choice One
				</label>
				<p class="guidelines" id="guide_2"><small>Many Choices (but only one answer can be selected)</small></p>
			</li>
			
			<li id="li_99">
				<label class="description">
					<a href="menutemplate.php?process=create_ballot_choice.php&ballot1=mc2" id="" name="" style="text-decoration: none;" onmouseover="this.style.textDecoration = 'underline'" onmouseout="this.style.textDecoration = 'none'">
						<img title="Ballot Box" id="selectorimg" src="images/BallotBox.png" width="32" height="32" alt="" border="0">
					</a>Multiple-choice Two
				</label>
				<p class="guidelines" id="guide_2"><small>Many Choices (but more than one answer can be selected)</small></p>
			</li>
			
			<li id="li_99">
				<label class="description">
					<a href="menutemplate.php?process=create_ballot_choice.php&ballot1=yn1" id="" name="" style="text-decoration: none;" onmouseover="this.style.textDecoration = 'underline'" onmouseout="this.style.textDecoration = 'none'">
						<img title="Ballot Box" id="selectorimg" src="images/BallotBox.png" width="32" height="32" alt="" border="0" />
					</a>Yes/No or True/False
				</label>
				<p class="guidelines" id="guide_2"><small>You will put in a question and the answer will be either Yes/No or True/False</small></p>
			</li>
			<br/>
		</div>
		<br/>
		</ul>
		</div>
		</form>	
		<div id="footer"></div>
	</div>
	<img id="bottom" src="images/bottom.png" alt="">
	</body>
</html>

<?php
/*
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