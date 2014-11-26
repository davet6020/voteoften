<?php
	session_start();
	$userid = $_SESSION['userid'];
   $check = FALSE;

	if(!isset($_POST['Conservative'])) {
			$conservative = 0;
	}	else	{
			$conservative = $_POST['Conservative'];	
	}
	if(!isset($_POST['Liberal'])) {
			$liberal = 0;
	}	else	{
			$liberal = $_POST['Liberal'];	
	}
	if(!isset($_POST['Religious'])) {
			$religious = 0;
	}	else	{
			$religious = $_POST['Religious'];	
	}
	if(!isset($_POST['Right_Wing'])) {
			$rightwing = 0;
	}	else	{
			$rightwing = $_POST['Right_Wing'];	
	}
	if(!isset($_POST['Left_Wing'])) {
			$leftwing = 0;
	}	else	{
			$leftwing = $_POST['Left_Wing'];	
	}
	if(!isset($_POST['In_The_middle'])) {
			$inthemiddle = 0;
	}	else	{
			$inthemiddle = $_POST['In_The_middle'];	
	}
	if(!isset($_POST['Fiscally_Conservative'])) {
			$fiscallyconservative = 0;
	}	else	{
			$fiscallyconservative = $_POST['Fiscally_Conservative'];	
	}
	if(!isset($_POST['Anti_Big_Government'])) {
			$antibiggovernment = 0;
	}	else	{
			$antibiggovernment = $_POST['Anti_Big_Government'];	
	}
	if(!isset($_POST['Wealthy'])) {
			$wealthy = 0;
	}	else	{
			$wealthy = $_POST['Wealthy'];	
	}
	if(!isset($_POST['Middle_Class'])) {
			$middleclass = 0;
	}	else	{
			$middleclass = $_POST['Middle_Class'];	
	}
	if(!isset($_POST['Poor'])) {
			$poor = 0;
	}	else	{
			$poor = $_POST['Poor'];	
	}
	if(!isset($_POST['Pro_Free_Speech'])) {
			$profreespeech = 0;
	}	else	{
			$profreespeech = $_POST['Pro_Free_Speech'];	
	}
	if(!isset($_POST['Pro_Owning_Firearms'])) {
			$proowningfirearms = 0;
	}	else	{
			$proowningfirearms = $_POST['Pro_Owning_Firearms'];	
	}
	if(!isset($_POST['Pro_Choice'])) {
			$prochoice = 0;
	}	else	{
			$prochoice = $_POST['Pro_Choice'];	
	}
	if(!isset($_POST['Pro_Life'])) {
			$prolife = 0;
	}	else	{
			$prolife = $_POST['Pro_Life'];	
	}
	if(!isset($_POST['Anti_Free_Speech'])) {
			$antifreespeech = 0;
	}	else	{
			$antifreespeech = $_POST['Anti_Free_Speech'];	
	}
	if(!isset($_POST['Against_Owning_Firearms'])) {
			$againstowningfirearms = 0;
	}	else	{
			$againstowningfirearms = $_POST['Against_Owning_Firearms'];	
	}
	if(!isset($_POST['City_Dweller'])) {
			$citydweller = 0;
	}	else	{
			$citydweller = $_POST['City_Dweller'];	
	}
	if(!isset($_POST['Rural_Dweller'])) {
			$ruraldweller = 0;
	}	else	{
			$ruraldweller = $_POST['Rural_Dweller'];	
	}

   test_for_profile2($userid, $conservative, $liberal, $religious, $rightwing, $leftwing, $inthemiddle, $fiscallyconservative, $antibiggovernment, $wealthy, $middleclass, $poor, $profreespeech, $proowningfirearms, $prochoice, $prolife, $antifreespeech, $againstowningfirearms, $citydweller, $ruraldweller);
   
   if($_SESSION['newuser'] == TRUE)	{
   		$msgheader = "You are now ready to use the system.";
   		$msgbody = '<p>A good way to get started is, by taking a look at ballots that are available to you by clicking on menu choice Voting | Your Ballots.</p>
   						<p>Next you may want to create your own ballots.  To do this, click on menu choice Ballots | Create A Ballot.</p>
   						<p>As always, your feedback is welcome.  Menu choice About | Send us a comment is the place to go for that.  </p> 		
   						';
   		$_SESSION['newuser'] = FALSE;
   		header("Location: menutemplate.php?process=message.php&msgheader=$msgheader&msgbody=$msgbody");
   }	else	{
   		//If they are not a new user then they must have just wanted to change their profile information.
   		header('Location: menutemplate.php?process=profileshow.php');
   }
   
   
   function test_for_profile2($userid, $conservative, $liberal, $religious, $rightwing, $leftwing, $inthemiddle, $fiscallyconservative, $antibiggovernment, $wealthy, $middleclass, $poor, $profreespeech, $proowningfirearms, $prochoice, $prolife, $antifreespeech, $againstowningfirearms, $citydweller, $ruraldweller)  {
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
            update_newuserprofile2($db, $userid, $conservative, $liberal, $religious, $rightwing, $leftwing, $inthemiddle, $fiscallyconservative, $antibiggovernment, $wealthy, $middleclass, $poor, $profreespeech, $proowningfirearms, $prochoice, $prolife, $antifreespeech, $againstowningfirearms, $citydweller, $ruraldweller);
      }  else  {
            insert_newuserprofile2($db, $userid, $conservative, $liberal, $religious, $rightwing, $leftwing, $inthemiddle, $fiscallyconservative, $antibiggovernment, $wealthy, $middleclass, $poor, $profreespeech, $proowningfirearms, $prochoice, $prolife, $antifreespeech, $againstowningfirearms, $citydweller, $ruraldweller);
      }
   }
   
   function update_newuserprofile2($db, $userid, $conservative, $liberal, $religious, $rightwing, $leftwing, $inthemiddle, $fiscallyconservative, $antibiggovernment, $wealthy, $middleclass, $poor, $profreespeech, $proowningfirearms, $prochoice, $prolife, $antifreespeech, $againstowningfirearms, $citydweller, $ruraldweller)  {
      require_once($_SESSION['utils']);
      $util = new Utilities();
      /* Connect to database. */
		require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
         }

      /* Update the record here  */
      $query = 'update userprofile1 set
                  conservative = "' . $conservative . '",
						liberal = "' . $liberal . '",
						religious = "' . $religious . '",
						rightwing = "' . $rightwing . '",
						leftwing = "' . $leftwing . '",
						inthemiddle = "' . $inthemiddle . '",
						fiscallyconservative = "' . $fiscallyconservative . '",
						antibiggovernment = "' . $antibiggovernment . '",
						wealthy = "' . $wealthy . '",
						middleclass = "' . $middleclass . '",
						poor = "' . $poor . '",
						profreespeech = "' . $profreespeech . '",
						proowningfirearms = "' . $proowningfirearms . '",
						prochoice = "' . $prochoice . '",
						prolife = "' . $prolife . '",
						antifreespeech = "' . $antifreespeech . '",
						againstowningfirearms = "' . $againstowningfirearms . '",
						citydweller = "' . $citydweller . '",
						ruraldweller = "' . $ruraldweller . '"
                  where userid = ' . $userid;
      $stmt = $db->prepare($query);
      $stmt->execute();
      $num_results=$stmt->num_rows;
      
      $stmt->close();
      $db->close();
      return;
   }
   
   function insert_newuserprofile2($db, $userid, $conservative, $liberal, $religious, $rightwing, $leftwing, $inthemiddle, $fiscallyconservative, $antibiggovernment, $wealthy, $middleclass, $poor, $profreespeech, $proowningfirearms, $prochoice, $prolife, $antifreespeech, $againstowningfirearms, $citydweller, $ruraldweller)  {
      require_once($_SESSION['utils']);
      $util = new Utilities();
      /* Connect to database. */
      require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
         }
    
      $query = "insert into userprofile1
					(userid, conservative, liberal, religious, rightwing, leftwing, inthemiddle, fiscallyconservative,
					antibiggovernment, wealthy, middleclass, poor, profreespeech, proowningfirearms, prochoice, prolife,
					antifreespeech, againstowningfirearms, citydweller, ruraldweller)
               values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = $db->prepare($query);
      $stmt->bind_param("iiiiiiiiiiiiiiiiiiii", $userid, $conservative, $liberal, $religious, $rightwing, $leftwing, $inthemiddle, $fiscallyconservative, $antibiggovernment, $wealthy, $middleclass, $poor, $profreespeech, $proowningfirearms, $prochoice, $prolife, $antifreespeech, $againstowningfirearms, $citydweller, $ruraldweller);
      $stmt->execute();
      
      $stmt->close();
      $db->close();
      return;
   }
?>
