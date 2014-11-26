<?php
	session_start();
   $_SESSION['dbopen']="../db_voteoften.php";
   $br = "<br/>";
   $insert = FALSE;
   
   if(!isset($_POST['first']))   {
      $insert = FALSE;
   }   else    {
      $first = htmlspecialchars($_POST['first']);
      $insert = TRUE;
   }
   
   if(!isset($_POST['last']))   {
      $insert = FALSE;
   }   else    {
      $last = htmlspecialchars($_POST['last']);
      $insert = TRUE;
   }
   
   if(!isset($_POST['zipcode']))   {
      $insert = FALSE;
   }   else    {
      $zipcode = htmlspecialchars($_POST['zipcode']);
      $insert = TRUE;
      //Now get district.
      require_once($_SESSION['utils']);
      $util = new Utilities();
      $util->getdistrict($zipcode);
      $district = $_SESSION['district'];
   }
   
   if(!isset($_POST['email']))   {
      $insert = FALSE;
   }   else    {
      $email = htmlspecialchars($_POST['email']);
      $insert = TRUE;
   }
   
   if(!isset($_POST['login']))   {
      $insert = FALSE;
   }   else    {
      $login = htmlspecialchars($_POST['login']);
      $insert = TRUE;
   }
   
   if(!isset($_POST['password']))   {
      $insert = FALSE;
   }   else    {
      if(!empty($_POST['password'])) {
         $password = htmlspecialchars($_POST['password']);
         $insert = TRUE;
      }  else  {
         $insert = FALSE;
      }
   }
   
   /*
      Level Chart:
        0 = Guest
        1 = Basic
      888 = Admin
      999 = Super Admin
      For now default level = 1 which allows you to create ballots.
   */
   $level = 1;
   
   /*
      At this point I am assuming that the user is not logged in/does not
      have a userid yet.
   */
   
   if(isset($_SESSION['login'])) {
      if(!empty($_SESSION['login']))   {
         echo "You already have a userid.<br/>";
         $_SESSION['newuser'] = FALSE;
      }
   }

   /*
      If any of the fields on the createuserid.php page were empty they need
      to go back and re-enter all the info so I reload createuserid.php.
   */
   if(!$insert) {
      $_SESSION['showerror'] = TRUE;
      header('Location: createuserid.php');
   }  else  {
      $_SESSION['showerror'] = FALSE;  //It's all good so insert the record.
      $_SESSION['newuser'] = TRUE;

      if(insert_newuser($first, $last, $zipcode, $email, $login, $password, $district, $level))   {
         header('Location: menutemplate.php?process=userprofile1.php');
      }  else  {
         echo "Failed to insert new user account.<br/>";
         return;
      }
   }

   function insert_newuser($first, $last, $zipcode, $email, $login, $password, $district, $level)  {
      $inserted = FALSE;
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
      $query = "insert into userlogin(lastname, firstname, zipcode, email, loginname, password, district, level) values(?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = $db->prepare($query);
      $stmt->bind_param("sssssssi", $first, $last, $zipcode, $email, $login, $util::hash_password($password), $district, $level);
      $stmt->execute();

      /*
         In order to link table userlogin with table userprofile1 I need to capture
         the userid that I just wrote because it is auto-incremented.  So, I am
         adding to the $_SESSION: userid, first, last and login.
      */
      if($stmt->affected_rows > 0) {
         $_SESSION['userid']=mysqli_insert_id($db);
         $_SESSION['login']=$login;
         $_SESSION['level']=$level;
         $_SESSION['first']=$first;
         $_SESSION['last']=$last;
         $_SESSION['zipcode']=$zipcode;
         $_SESSION['district']=$district;
         $inserted = TRUE;
      }   else	{
         $inserted = FALSE;
      }
      
      $stmt->close();
      $db->close();
      return $inserted;
   }

?>
