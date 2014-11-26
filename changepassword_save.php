<?php
	session_start();
	$_SESSION['utils']="common/utilities.php";
   $_SESSION['dbopen']="../db_voteoften.php";
   $update = FALSE;

   if(!isset($_POST['login']))   {
      $update = FALSE;
   }   else    {
      $login = htmlspecialchars($_POST['login']);
      $update = TRUE;
   }
   
   if(!isset($_POST['currentpassword']))   {
      $update = FALSE;
   }   else    {
      if(!empty($_POST['currentpassword'])) {
         $currentpassword = htmlspecialchars($_POST['currentpassword']);
         $update = TRUE;
      }  else  {
         $update = FALSE;
      }
   }
   
   if(!isset($_POST['newpassword']))   {
   	$update = FALSE;
   }   else    {
   	if(!empty($_POST['newpassword'])) {
   		$newpassword = htmlspecialchars($_POST['newpassword']);
   		$update = TRUE;
   	}  else  {
   		$update = FALSE;
   	}
   }
   
    /*
      If any of the fields on the createuserid.php page were empty they need
      to go back and re-enter all the info so I reload createuserid.php.
   */
   if(!$update) {
      $_SESSION['showerror'] = TRUE;
      header('Location: changepassword.php');
   }  else  {
      $_SESSION['showerror'] = FALSE;  //It's all good so insert the record.

      if(updatepassword($login, $currentpassword, $newpassword))   {
      	$msgheader = "Your password has been changed.";
			$msgbody = "I'm not telling you to write it down but it would helpful if you had a way of remembering it.";
			header("Location: menutemplate.php?process=message.php&msgheader=$msgheader&msgbody=$msgbody");
      }  else  {
         echo "Failed to change your password.<br/>";
         return;
      }
   }

   function updatepassword($login, $currentpassword, $newpassword)  {
   	require_once($_SESSION['utils']);
   	$util = new Utilities();
   	
      $inserted = FALSE;
      require_once($_SESSION['utils']);
      $util = new Utilities();
      require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
			if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
         }

		//Hash the passwords the user typed in.
		$newpassword = $util::hash_password($newpassword);
		$currentpassword = $util::hash_password($currentpassword);
         
		$query = "update userlogin set password = '$newpassword' where loginname = '$login' and password = '$currentpassword'";
      $stmt = $db->prepare($query);
      $stmt->execute();
      $num_results=$stmt->num_rows;

      $stmt->close();
      $db->close();
      return TRUE;
   }
?>
