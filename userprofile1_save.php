<?php
	session_start();
   $check = FALSE;
   
   $userid = $_SESSION['userid'];
   $gender = htmlspecialchars($_POST['gender']);
   $religion = htmlspecialchars($_POST['religion']);
   $race = htmlspecialchars($_POST['race']);
   $politicalparty = htmlspecialchars($_POST['politicalparty']);
   $month = htmlspecialchars($_POST['month']);
   $day = htmlspecialchars($_POST['day']);
   $year = htmlspecialchars($_POST['year']);
   $bdate = $year . "-" . $month . "-" . $day;
   $dateofbirth = mktime(0, 0, 0, $month, $day, $year);
	//Year, Month, Day, Hours, Minutes, Seconds, timezone which for me is UTC
	//echo date('Y-m-d h:i:s e', $chgdate) . "<br/><br/>";
   $income = htmlspecialchars($_POST['income']);

   test_for_profile1($userid, $gender, $religion, $race, $politicalparty, $dateofbirth, $income);
   //header('Location: userprofile2.php');
   header('Location: menutemplate.php?process=userprofile2.php');
   
   function test_for_profile1($userid, $gender, $religion, $race, $politicalparty, $dateofbirth, $income)  {
   /* Find out if they already have a user profile */
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

      $stmt = $db->prepare($query);
      $stmt->execute();
      $num_results=$stmt->num_rows;
      
      $stmt->close();
      $db->close();
      return;
   }
   
   function insert_newuserprofile1($db, $userid, $gender, $religion, $race, $politicalparty, $dateofbirth, $income)  {
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
      //echo $userid . $gender . $religion . $race . $politicalparty . $dateofbirth . $income;
      $query = "insert into userprofile1
               (userid, gender, religion, race, politicalparty, dateofbirth, income)
               values(?, ?, ?, ?, ?, ?, ?)";
      $stmt = $db->prepare($query);
      $stmt->bind_param("issssds", $userid, $gender, $religion, $race, $politicalparty, $dateofbirth, $income);
      $stmt->execute();
      
      $stmt->close();
    
      /* close connection */
      $db->close();
      return;
   }
   
?>
