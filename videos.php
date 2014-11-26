<?php
	$_SESSION['utils']="common/utilities.php";	//Program with common functions.
	$_SESSION['dbopen']="../db_voteoften.php";

	require_once($_SESSION['utils']);
      $util = new Utilities();
		$util->keep_alive();

   if(isset($_GET['candidate']) && !empty($_GET['candidate']))	{
		$candidate = $_GET['candidate'];
	}	else	{
		$candidate = "";
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title></title>
	<link rel="stylesheet" href="css/menu_style.css" type="text/css" />
   <link rel="stylesheet" type="text/css" href="css/view.css" media="all">
</head>
<body>
   <div class="video_container">
   
   <h1></h1><br/><br/><br/>
   <img id="top" src="images/top.png" alt="">
   
   <?php
		switch($candidate)	{
			case "Obama":
				$video1 = "<h3>The President Obama at White House Correspondents Dinner </h3>";
            $video1 = "";
            //$video2 = '<object style="height: 390px; width: 640px"><param name="movie" value="http://www.youtube.com/v/NXtJhLUOFXE?version=3&feature=player_detailpage"><param name="allowFullScreen" value="true"><param name="allowScriptAccess" value="always"><embed src="http://www.youtube.com/v/NXtJhLUOFXE?version=3&feature=player_detailpage" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="640" height="360"></object>';
            $video2 = '<iframe width="640" height="450" src="http://www.youtube.com/embed/GfG8Btb0l3g" frameborder="0" allowfullscreen></iframe>';
   			break;
			case "Romney":
				$video1 = "<h3>Mitt Romney 2012</h3>";
            $video1 = "";
            $video2 = '<object style="height: 390px; width: 640px"><param name="movie" value="http://www.youtube.com/v/g1kotsFYizs?version=3&feature=player_embedded"><param name="allowFullScreen" value="true"><param name="allowScriptAccess" value="always"><embed src="http://www.youtube.com/v/g1kotsFYizs?version=3&feature=player_embedded" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="640" height="360"></object>';
				break;
			case "Santorum":
				$video1 = "<h3>Rick Santorum's Message for America</h3>";
            $video1 = "";
            $video2 = '<iframe width="640" height="390" src="http://www.youtube.com/embed/lg6grCd98HM" frameborder="0" allowfullscreen></iframe>';
				break;
			case "":
				$video1 = "";
            $video2 = "";
            echo '<img src="images/VoteSam.png" alt="" class="image-center" />';
				break;
			default:
            $video1 = "";
            $video2 = "";
				echo '<img src="images/VoteSam.png" alt="" class="image-center" />';
				break;
		}
      
      echo $video1;
      echo $video2;
	?>
   
   </div>
</body>
</html>

