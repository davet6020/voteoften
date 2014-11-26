<?php
   $_SESSION['utils']="common/utilities.php";	//Program with common functions.
	$_SESSION['dbopen']="../db_voteoften.php";
	
   session_start();
	require_once($_SESSION['utils']);
      $util = new Utilities();
		$util->keep_alive();
      
   /*
      This is for a Many-choice 1 ballot.  Which is a ballot that can have
      many choices but only one can be voted for.
      electionlist_main.tbl:  electionname, electionfinaldate, district, description, allvoters
      electionlist_sub.tbl:   competitor, politicalparty
   */
   
   if(isset($_POST['electionname']))   {
      if(!empty($_POST['electionname']))  {
         $electionname = $_POST['electionname'];
      }  else  {
            $_SESSION['errmsg'] = "You must enter a name for your ballot.";
            header('Location: menutemplate.php?process=create_ballot_mc2.php');
      }
   }   else    {
         $_SESSION['errmsg'] = "You must enter a name for your ballot.";
         header('Location: menutemplate.php?process=create_ballot_mc2.php');
   }
   
   if(isset($_POST['electionfinaldate']))   {
      if(!empty($_POST['electionfinaldate']))  {
         $electionfinaldate = $_POST['electionfinaldate'];
      }  else  {
            $_SESSION['errmsg'] = "You must enter a final election date for your ballot.";
            header('Location: menutemplate.php?process=create_ballot_mc2.php');
      }
   }   else    {
         $_SESSION['errmsg'] = "You must enter a final election date for your ballot.";
         header('Location: menutemplate.php?process=create_ballot_mc2.php');
   }
   
   if(isset($_POST['allvoters']))   {
      if(!empty($_POST['allvoters']))  {
         $allvoters = $_POST['allvoters'];
      }  else  {
         $allvoters = "0";   //0 means only the creator of the ballot can see it.
      }
   }  else  {
         $allvoters = "0";   //0 means only the creator of the ballot can see it.
   }
   
   if(isset($_POST['description']))   {
      if(!empty($_POST['description']))  {
         $description = $_POST['description'];
      }  else  {
         $description = "";
      }
   }  else  {
         $description = "";
   }
   
   if(isset($_POST['choice01']))   {
      if(!empty($_POST['choice01']))  {
         $choice01 = $_POST['choice01'];
      }  else  {
            $_SESSION['errmsg'] = "You must enter at least two choices on your ballot.";
            header('Location: menutemplate.php?process=create_ballot_mc2.php');
      }
   }   else    {
         $_SESSION['errmsg'] = "You must enter at least two choices on your ballot.";
         header('Location: menutemplate.php?process=create_ballot_mc2.php');
   }
   
   if(isset($_POST['choice02']))   {
      if(!empty($_POST['choice02']))  {
         $choice02 = $_POST['choice02'];
      }  else  {
         $choice02 = "";
      }
   }  else  {
         $choice02 = "";
   }
   
   if(isset($_POST['choice03']))   {
      if(!empty($_POST['choice03']))  {
         $choice03 = $_POST['choice03'];
      }  else  {
         $choice03 = "";
      }
   }  else  {
         $choice03 = "";
   }
   
   if(isset($_POST['choice04']))   {
      if(!empty($_POST['choice04']))  {
         $choice04 = $_POST['choice04'];
      }  else  {
         $choice04 = "";
      }
   }  else  {
         $choice04 = "";
   }
   
   if(isset($_POST['choice05']))   {
      if(!empty($_POST['choice05']))  {
         $choice05 = $_POST['choice05'];
      }  else  {
         $choice05 = "";
      }
   }  else  {
         $choice05 = "";
   }
   
   if(isset($_POST['choice06']))   {
      if(!empty($_POST['choice06']))  {
         $choice06 = $_POST['choice06'];
      }  else  {
         $choice06 = "";
      }
   }  else  {
         $choice06 = "";
   }
   if(isset($_POST['infolink']))   {
      if(!empty($_POST['infolink']))  {
         $infolink = $_POST['infolink'];
      }  else  {
         $infolink = "";
      }
   }  else  {
         $infolink = "";
   }
   if(isset($_POST['keyword']))   {
   	if(!empty($_POST['keyword']))  {
   		$keyword = $_POST['keyword'];
   	}  else  {
   		$keyword = microtime(true);
   	}
   }  else  {
   	$keyword = microtime(true);
   }
   
   //These will be the defaults for now.
   $userid = $_SESSION['userid'];
   $district = 0;
   $politicalparty = 1;
   $ballottype = $_SESSION['ballottype'];

      //This is not quite a boolean. If the main record is inserted insert_ballot_main returns the auto_increment
      //value of the new electionid added.
      if(insert_ballot_main($userid, $electionname, $electionfinaldate, $district, $description, $ballottype, $allvoters, $infolink, $keyword) > 0)   {
         $new_ballot_id = $_SESSION['new_ballot_id'];
         for($i=1; $i<7; $i++)   {  //7(-1) is the number of possible choices the user filled in.
            //${'var' . $i} = 'eeee'; // sets $var5
            //${$var . $i} = 'eeee'; // sets $sss5
            $ch = ${'choice0' . $i};
            if(!empty($ch)) {
               insert_ballot_sub($new_ballot_id, $ch, $politicalparty);      
            }
         }
         //Must be a success so go to the page of the new ballot to see it.
         //header('Location: menutemplate.php?process=electionlist_choice.php&electionid=29');
         header("Location: menutemplate.php?process=electionlist_choice.php&electionid=$new_ballot_id");
      }  else  {
         echo "Failed on insert_ballot_main(1).<br/>";
         return;
      }

      //electionlist_main.tbl:  userid, electionname, electionfinaldate, district, description, allvoters
      //electionlist_sub.tbl:   electionid, competitor, politicalparty
   function insert_ballot_main($userid, $electionname, $electionfinaldate, $district, $description, $ballottype, $allvoters, $infolink, $keyword)  {
      require_once($_SESSION['utils']);
      $util = new Utilities();
      /* Connect to database. */
      require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
         }
    
      /* Insert the record here  */
      $query = "insert into electionlist_main
               (userid, electionname, electionfinaldate, district, description, ballottype, allvoters, infolink, keyword)
               values(?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = $db->prepare($query);
      $stmt->bind_param("isiisiiss", $userid, $electionname, $electionfinaldate, $district, $description, $ballottype, $allvoters, $infolink, $keyword);
      $stmt->execute();
      
      if($stmt->affected_rows > 0) {
         $new_ballot_id = mysqli_insert_id($db);
         $_SESSION['new_ballot_id'] = $new_ballot_id;
      }   else	{
         echo 'Failed on insert_ballot_main(2).';
      }
      
      $stmt->close();
      $db->close();
      return $new_ballot_id;
   }
   
   function insert_ballot_sub($new_ballot_id, $competitor, $politicalparty)  {
      require_once($_SESSION['utils']);
      $util = new Utilities();
      /* Connect to database. */
      require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
         }
    
      $query = "insert into electionlist_sub
               (electionid, competitor, politicalparty)
               values(?, ?, ?)";
      $stmt = $db->prepare($query);
      $stmt->bind_param("isi", $new_ballot_id, $competitor, $politicalparty);
      $stmt->execute();
      
      if($stmt->affected_rows > 0) {
         echo "inserted: $competitor <br/>";
      }   else	{
         echo 'Error processing the insert.';
      }
      
      $stmt->close();
      $db->close();
      return;
   }
   
      function test_for_profile1($userid, $gender, $religion, $race, $politicalparty, $dateofbirth, $income)  {

      require_once($_SESSION['utils']);
      $util = new Utilities();
      /* Connect to database. */
      require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
         }

      $query = 'select userid from userprofile1 where userid = ' . $userid;
      $stmt = $db->query($query);
      $num_results=$stmt->num_rows;

      if($num_results == 1) {
            update_newuserprofile1($db, $userid, $gender, $religion, $race, $politicalparty, $dateofbirth, $income);
      }  else  {
            insert_newuserprofile1($db, $userid, $gender, $religion, $race, $politicalparty, $dateofbirth, $income);
      }
   }
   
   function update_newuserprofile1($db, $userid, $gender, $religion, $race, $politicalparty, $dateofbirth, $income)  {
      require_once($_SESSION['utils']);
      $util = new Utilities();
      require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
      /* Connect to database. */
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
         }

      /* Update the record here  */
      $query = 'update userprofile1 set
                  gender = "' . $gender . '",
                  religion = "' . $religion . '",
                  race = "' . $race . '",
                  politicalparty = "' . $politicalparty . '",
                  income = "' . $income . '",
                  dateofbirth = "' . $dateofbirth . '"
                  where userid = ' . $userid;
      //echo $query . "<br/>";
      $stmt = $db->prepare($query);
      $stmt->execute();
      $num_results=$stmt->num_rows;
      
      /*
      if($stmt->affected_rows > 0) {
         echo "updated a record";
      }   else	{
         echo 'Error processing the update.';
      }
      */
      
      /* close statement */
      $stmt->close();
    
      /* close connection */
      $db->close();
      return;
   }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Create a Multiple-choice, One Answer Type Ballot</title>
<link rel="stylesheet" type="text/css" href="css/view.css" media="all">
<script type="text/javascript" src="js/view.js"></script>
<script type="text/javascript" src="js/calendar.js"></script>
</head>
<body id="main_body" >
	<img id="top" src="images/top.png" alt="">
	<div id="form_container_mc1">
		<h1><a>Create a Multiple-choice, One Answer Type Ballot</a></h1>
		<form id="electionlist" class="appnitro"  method="post" action="create_ballot_mc1_save.php">
		<div class="form_description">
			<h2>Create a Multiple-choice, One Answer Type Ballot</h2>
			<p>Type in some stuff</p>
		<ul>
		<div>
			<li id="li_99">
				<label class="description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Name: <input type="text" name="electionname" size=50 maxlength=50 /><br />
				</label>
				<p class="guidelines" id="guide_2"><small>This is for a brief description of the ballot.  It will appear as the title of the ballot.</small></p>
			</li>
			
			<li id="li_99">
				<label class="description">
					Final Date: <input type="text" name="electionfinaldate" size=8 maxlength=8 /><br />
				</label>
				<p class="guidelines" id="guide_2"><small>This is the last date the election should be available until.</small></p>
			</li>

         <li id="li_99">
				<label class="description">
					Choice 01: <input type="text" name="choice01" size=50 maxlength=50 /><br />
				</label>
				<p class="guidelines" id="guide_2"><small>Choice One of a list of competitors. ex. Choice One = Blue, Choice Two = Red and Choice Three = Green</small></p>
			</li>
         <li id="li_99">
				<label class="description">
					Choice 02: <input type="text" name="choice02" size=50 maxlength=50 /><br />
				</label>
				<p class="guidelines" id="guide_2"><small>Choice Two of a list of competitors. ex. Choice One = Blue, Choice Two = Red and Choice Three = Green</small></p>
			</li>
         <li id="li_99">
				<label class="description">
					Choice 03: <input type="text" name="choice03" size=50 maxlength=50 /><br />
				</label>
				<p class="guidelines" id="guide_2"><small>Choice Three of a list of competitors. ex. Choice One = Blue, Choice Two = Red and Choice Three = Green</small></p>
			</li>
         <li id="li_99">
				<label class="description">
					Choice 04: <input type="text" name="choice04" size=50 maxlength=50 /><br />
				</label>
				<p class="guidelines" id="guide_2"><small>Choice Four of a list of competitors. ex. Choice One = Blue, Choice Two = Red and Choice Three = Green</small></p>
			</li>
         <li id="li_99">
				<label class="description">
					Choice 05: <input type="text" name="choice05" size=50 maxlength=50 /><br />
				</label>
				<p class="guidelines" id="guide_2"><small>Choice Five of a list of competitors. ex. Choice One = Blue, Choice Two = Red and Choice Three = Green</small></p>
			</li>
         <li id="li_99">
				<label class="description">
					Choice 06: <input type="text" name="choice06" size=50 maxlength=50 /><br />
				</label>
				<p class="guidelines" id="guide_2"><small>Choice Six of a list of competitors. ex. Choice One = Blue, Choice Two = Red and Choice Three = Green</small></p>
			</li>
         <li id="li_99">
				<label class="description">
					Choice 07: <input type="text" name="choice07" size=50 maxlength=50 /><br />
				</label>
				<p class="guidelines" id="guide_2"><small>Choice Seven of a list of competitors. ex. Choice One = Blue, Choice Two = Red and Choice Three = Green</small></p>
			</li>
         <li id="li_99">
				<label class="description">
					Choice 08: <input type="text" name="choice08" size=50 maxlength=50 /><br />
				</label>
				<p class="guidelines" id="guide_2"><small>Choice Eight of a list of competitors. ex. Choice One = Blue, Choice Two = Red and Choice Three = Green</small></p>
			</li>
         <li id="li_99">
				<label class="description">
					Choice 09: <input type="text" name="choice09" size=50 maxlength=50 /><br />
				</label>
				<p class="guidelines" id="guide_2"><small>Choice Nine of a list of competitors. ex. Choice One = Blue, Choice Two = Red and Choice Three = Green</small></p>
			</li>
         <li id="li_99">
				<label class="description">
					Choice 10: <input type="text" name="choice10" size=50 maxlength=50 /><br />
				</label>
				<p class="guidelines" id="guide_2"><small>Choice Ten of a list of competitors. ex. Choice One = Blue, Choice Two = Red and Choice Three = Green</small></p>
			</li>
         
         <li id="li_99">
				<label class="description">
            Detailed Description:
               <textarea value="left" name="description" id="description" cols="70" rows="8"></textarea>
				</label>
				<p class="guidelines" id="guide_2"><small>This is where you put a more detailed description of the ballot.</small></p>
			</li>
         
      </li>
				<li class="buttons">
			   <input type="hidden" name="form_id" value="346996" />
				<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
		</li>
         
         <br/>
		</div>
		<br/>
		</ul>
		</div>
      <?php //getelectionlist_all(); ?>
		</form>	
		<div id="footer"></div>
	</div>
	<img id="bottom" src="images/bottom.png" alt="">
	</body>
</html>
