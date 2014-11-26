<?php
	session_start();
	$_SESSION['utils']="common/utilities.php";	//Program with common functions.
	$_SESSION['dbopen']="../db_voteoften.php";
	
	require_once($_SESSION['utils']);
      $util = new Utilities();
		$util->keep_alive();
		
	if(isset($_POST['description']))   {
		$description = trim($_POST['description']);
		$description = htmlspecialchars(stripslashes($description));
   }
	
	if(isset($_POST['fixed']))   {
		$fixed = $_POST['fixed'];
   }
	
	if(isset($_SESSION['chgdate']))	{
		$chgdate = $_SESSION['chgdate'];
	}
	
	if(isset($_SESSION['chgid']))	{
		$id = $_SESSION['chgid'];
	}
	
	update_recno($id, $description, $fixed, $chgdate);
	
	function update_recno($id, $description, $fixed, $chgdate)  {
		require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
   
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
         }

		//$query = "update change_history set description='$description', date=$chgdate, fixed=$fixed where id=$id";
		$query = 'update change_history set description="'
		.$description. '", date=' .$chgdate. ', fixed=' .$fixed. ' where id=' .$id;
		
      $stmt = $db->prepare($query);
      $stmt->execute();
      $num_results=$stmt->num_rows;

      $stmt->close();
      $db->close();
	}
	header('Location: menutemplate.php?process=change_history.php');

?>
