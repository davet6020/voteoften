<?php
	//session_id("--LOGIN--");
	$_SESSION['utils']="common/utilities.php";	//Program with common functions.
	$_SESSION['dbopen']="../db_voteoften.php";
	
	require_once($_SESSION['utils']);
      $util = new Utilities();
		$util->keep_alive();

	function getchange_history()  {
	$tb_struc='<table class="info" border="3">
					<tr style="background-color: rgb(79, 24, 51); color: white">
						<th>Edit</th>
						<th>Id</th>
						<th>Description</th>
						<th>Date</th>
						<th>Fixed</th>
					</tr>';

		require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
      
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
         }

		$query = 'select id, description, date, fixed
					from change_history
					order by date';
      $stmt = $db->query($query);
      $num_results=$stmt->num_rows;

		echo "<br/>" . $tb_struc;

      for($i=0; $i<$num_results; $i++)	{
         for($i=0; $i<$num_results; $i++)	{
            $row=$stmt->fetch_assoc();
               $id = htmlspecialchars(stripslashes($row['id']));
               $description = htmlspecialchars(stripslashes($row['description']));
					$date = htmlspecialchars(stripslashes($row['date']));
					$f = htmlspecialchars(stripslashes($row['fixed']));
					$fixed = ($f == 0)? 'False': 'True';
					
					$class = ($i%2 == 0)? 'row0': 'row1';
					$icon = ($i%2 == 0)? 'edit_smW.png': 'edit_smG.png';
					
					echo "<tr class='$class'>";
					$butt1 = '<a href="menutemplate.php?process=change_history_update_edit.php&recno=' . $id . '">';
					$butt2 = '<img src="images/' .$icon. '" alt="" height="24" width="24" /></a>';
					echo '<td>' .$butt1.$butt2. '</td> <td>' .$id. '</td><td>&nbsp;' . $description .
					'&nbsp;</td><td>&nbsp;' . $date . '&nbsp;</td><td>&nbsp;' . $fixed . '&nbsp;</td></tr>';
         }
		
      $stmt->close();
      $db->close();
      }
   }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title></title>
	<link rel="stylesheet" href="css/menu_style.css" type="text/css" />
</head>
<body>
	<?php	getchange_history(); ?>
</body>
</html>

