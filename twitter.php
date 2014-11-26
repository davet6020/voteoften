<?php 
	$_SESSION['utils']="common/utilities.php";	//Program with common functions.
	$_SESSION['dbopen']="../db_voteoften.php";
	
	require_once($_SESSION['utils']);
	$util = new Utilities();
	$util->keep_alive();

	
?>
<meta charset=utf-8>
<html>
	<head>
   <title>VoteOften.org Twitter Reader</title>
   <link href=css/twitter.css rel=stylesheet />
   <link rel="stylesheet" href="css/social_media.css" type="text/css" />
	<script type="text/javascript">
			function doit()	{
				frmtwitter.submit();
			}
		</script>
  </head>

<?php
	
	if(isset($_POST['list']))	{
			$choice = $_POST['list'];
	}	else	{
			$choice = "MarcAmbinder.xml";
	}

   include 'includes/twitterAPI.php';
   include 'includes/parseTwitter.php';
   include 'includes/render.php';
?>
	<body>
	<span class="twitter">
		<a href="https://twitter.com/#!/voteoften" >
			<img src="images/twitter.png" alt="twitter" height="20" width="20" target="_blank" />
		</a>
	</span>
   <div class=header>
   </div>
   <div class=container>
		<p class='selector'>
			<h3>VoteOften.org Twitter Reader</h3>
			<form name=frmtwitter action="menutemplate.php?process=twitter.php" method=post>
				<select name = "list" id="list" onChange="doit();">
				<option selected="selected">Select a twitter feed from the list&nbsp;&nbsp;</option>
					<?php 
						require_once($_SESSION['dbopen']);
						@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
						if (mysqli_connect_errno()) {
							printf("Connect failed: %s\n", mysqli_connect_error());
							exit();
						}
						
						$query = "select feedname, feedurl from twitterfeeds";
						$stmt = $db->query($query);
						$num_results=$stmt->num_rows;
						
						if($num_results > 0) {
							for($i=0; $i<$num_results; $i++)	{
								$row=$stmt->fetch_assoc();
								$fname = htmlspecialchars(stripslashes($row['feedname']));
								$furl = htmlspecialchars(stripslashes($row['feedurl']));
									echo '<option value="' . $furl . '">' . $fname .'</option>';
							}
						}
					?>
				
				</select>
			</form><br/>

<?php
	if($choice != "Select a twitter feed from the list")	{
		$_SESSION['tname'] = $choice;
		include 'main.php';
	}
	
?>

   </div>
	</body>
</html>
