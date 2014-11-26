<?php
	session_regenerate_id(true);
	session_start();
   $br = "<br/>";
   $check = FALSE;
   
   if(!isset($_POST['login']))   {
      $check = FALSE;
   }   else    {
      $login = htmlspecialchars($_POST['login']);
      $check = TRUE;
   }
   
   if(!isset($_POST['password']))   {
      $check = FALSE;
   }   else    {
      if(!empty($_POST['password'])) {
         $password = htmlspecialchars($_POST['password']);
         $check = TRUE;
      }  else  {
         $check = FALSE;
      }
   }

   /*
      At this point I am assuming that the user is not logged in/does not
      have a userid yet.
   */
   if(isset($_SESSION['login'])) {
      echo "You are already logged in. <br/>";
      return;
   }
   
   /*
      If any of the fields on the createuserid.php page were empty they need
      to go back and re-enter all the info so I reload createuserid.php.
   */
   if(!$check) {
      $_SESSION['showerror'] = TRUE;
      header('Location: login.php');
   }  else  {
      $_SESSION['showerror'] = FALSE;  //It's all good so try to login.
      authenticate_it($login, $password);
   }

   function authenticate_it($login, $password)  {
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
      $query = 'select userid, firstname, lastname, email, loginname, password, zipcode, district, level from userlogin
               where loginname = "' . $login . '" and password = "' .
               $util::hash_password($password) . '"';
      $stmt = $db->query($query);
      $num_results=$stmt->num_rows;

      /*
         In order to link table userlogin with table userprofile1 I need to capture
         the userid that I just wrote because it is auto-incremented.  So, I am
         adding to the $_SESSION: userid, first, last and login.
      */
      if($num_results == 1) {
         for($i=0; $i<$num_results; $i++)	{
            $row=$stmt->fetch_assoc();
            if($password = htmlspecialchars(stripslashes($row['password']))) {
               $_SESSION['userid'] = htmlspecialchars(stripslashes($row['userid']));
               $_SESSION['first'] = htmlspecialchars(stripslashes($row['firstname']));
               $_SESSION['last'] = htmlspecialchars(stripslashes($row['lastname']));
               $_SESSION['login'] = htmlspecialchars(stripslashes($row['loginname']));
					$_SESSION['zipcode'] = htmlspecialchars(stripslashes($row['zipcode']));
					$_SESSION['district'] = htmlspecialchars(stripslashes($row['district']));
					$_SESSION['level'] = htmlspecialchars(stripslashes($row['level']));
               /* Good login.  Setup userprofile now. */
					//If this is their first login maybe go here
               //header('Location: userprofile1.php');
					header('Location: index.php');
            }
         }
      }  else  {
            $msgheader = "Login failed";
            $msgbody = "Your loginname and password combination was incorrect.";
            header("Location: menutemplate.php?process=message.php&msgheader=$msgheader&msgbody=$msgbody");
      }
      
      /* close statement */
      $stmt->close();
    
      /* close connection */
      $db->close();
      
   }

?>
