<?php
	session_start();
	$_SESSION['utils']="common/utilities.php";	//Program with common functions.
	$_SESSION['dbopen']="../db_voteoften.php";
	
	require_once($_SESSION['utils']);
      $util = new Utilities();
		$util->keep_alive();
		
	if(isset($_POST['description']))   {
		$description = trim($_POST['description']);
   }
	
	if(isset($_POST['fixed']))   {
		$fixed = $_POST['fixed'];
   }
	
	if(isset($_SESSION['chgdate']))	{
		$chgdate = $_SESSION['chgdate'];
	}
	
	add_recno($description, $chgdate, $fixed);
	header('Location: menutemplate.php?process=change_history.php');

	function add_recno($description, $chgdate, $fixed)  {
		require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
		if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
         }

		$query = "insert into change_history(description, date, fixed) values(?, ?, ?)";
      $stmt = $db->prepare($query);
      $stmt->bind_param("sii", $description, $chgdate, $fixed);
      $stmt->execute();

      if($stmt->affected_rows > 0) {
         $inserted = TRUE;
      }   else	{
         $inserted = FALSE;
      }
	
      $stmt->close();
      $db->close();
   }

?>
