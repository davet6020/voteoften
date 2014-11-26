<?php
	$_SESSION['utils']="common/utilities.php";	//Program with common functions.
	require_once($_SESSION['utils']);
      $util = new Utilities();
		$util->keep_alive();

		$title_main = "";
		$title_1 = "";
		$body_1 = "";
		$title_2 = "";
		$body_2 = "";
		$title_3 = "";
		$body_3 = "";
	
		require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		
		$query = "select webpage, category, english from statictext where webpage = 'about.php'";
		$stmt = $db->query($query);
		$num_results=$stmt->num_rows;
		
		if($num_results > 0) {
			for($i=0; $i<$num_results; $i++)	{
				$row=$stmt->fetch_assoc();
					switch($row['category'])	{
						case "title_main":
							$title_main = $row['english'];
							break;
						case "title_1":
							$title_1 = $row['english'];
							break;
						case "body_1":
							$body_1 = $row['english'];
							break;
						case "title_2":
							$title_2 = $row['english'];
							break;
						case "body_2":
							$body_2 = $row['english'];
							break;
						case "title_3":
							$title_3 = $row['english'];
							break;
						case "body_3":
							$body_3 = $row['english'];
							break;
					}
		}
		
			$stmt->close();
			$db->close();
		}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo $title_main; ?></title>
<link rel="stylesheet" type="text/css" href="css/view.css" media="all">
</head>
<body id="main_body" >
<?php include_once("analyticstracking.php") ?>
	<img id="top" src="images/top.png" alt="">
	<div id="about_form_container">
		<h1 class="about"><a><?php echo $title_main; ?></a></h1>
		<form id="form_346996" class="about"  method="post" action="">
			<div class="form_description">
				<p class="about_banner">
					<h2><?php echo $title_main; ?></h2>
			</div>
			
			<div>
				<p class="about"><b><?php echo $title_1; ?></b></p>
				<p><?php echo $body_1; ?></p>
			</div>
		
			<div>
				<p class="about"><b><?php echo $title_2; ?></b></p>
				<p><?php echo $body_2; ?></p>
			</div>
			
			<div>
				<p class="about"><b><?php echo $title_3; ?></b></p>
				<p><?php echo $body_3; ?></p>
			</div>
			
		</form>	
		<div id="footer">
		</div>
	</div>
	<img id="bottom" src="images/bottom.png" alt="">
	</body>
</html>