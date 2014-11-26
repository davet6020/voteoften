<?php
	$_SESSION['utils']="common/utilities.php";	//Program with common functions.
	$_SESSION['dbopen']="../db_voteoften.php";
	
	require_once($_SESSION['utils']);
      $util = new Utilities();
		$util->keep_alive();

		switch($_POST['submit'])	{
			case "Reset Password":
				password_reset();
				break;
			case "Submit Answer":
				submit_answer();
				break;
		}

		function password_reset()	{
			if(isset($_POST['loginname'])) {
				if(empty($_POST['loginname']))	{
						$msgheader = "Invalid Login Name";
						$msgbody = "Password cannot be changed.";
						header("Location: menutemplate.php?process=message.php&msgheader=$msgheader&msgbody=$msgbody");
				}	else	{
						$loginname = $_POST['loginname'];
						if(getuserinfo($loginname))	{
								dohtml();
						}	else	{
								$msgheader = "Invalid Login Name";
								$msgbody = "Password cannot be changed.";
								header("Location: menutemplate.php?process=message.php&msgheader=$msgheader&msgbody=$msgbody");
								return;
						}
				}
			}
		}
		
		function submit_answer()	{
			if(isset($_POST['whatis']))	{
				if(empty($_POST['whatis']))	{
						$msgheader = "Incorrect Answer";
						$msgbody = "Password cannot be changed.";
						header("Location: menutemplate.php?process=message.php&msgheader=$msgheader&msgbody=$msgbody");
				}	else	{
						$whatis = trim($_POST['whatis']);
						$whatis = strtolower($whatis);
						if($whatis == $_SESSION['cname'])	{
							sendemail();
							return;	//probably won't need this if sendemail() leads to another program.
						}	else	{
							dontsendemail();
						}
				}
			}
		}
		
	
	function getuserinfo($loginname)	{
		require_once($_SESSION['utils']);
		$util = new Utilities();
		
		require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		
		$query = "select loginname, email from userlogin where loginname = '$loginname'";
		$stmt = $db->query($query);
		$num_results=$stmt->num_rows;
		
		if($num_results > 0) {
			for($i=0; $i<1; $i++)	{
				$row=$stmt->fetch_assoc();
				$_SESSION['yourname'] = htmlspecialchars(stripslashes($row['loginname']));
				$_SESSION['youremail'] = htmlspecialchars(stripslashes($row['email']));
				$_SESSION['subject'] = "password reset for $loginname";
				$_SESSION['message'] = "Your new password is: ";
				$yourname = $_SESSION['yourname'];
				$youremail = $_SESSION['youremail'];
				$subject = $_SESSION['subject'];
				$message = $_SESSION['message'];
			}
		}	return TRUE;
	}
	
	function dontsendemail()	{
		dohtml();
		echo "Sorry, you spelled that incorrectly.  Try again.<br/>";
		$_SESSION['cname'] = "";
		return;
	}
	
	function sendemail()	{
		$_SESSION['cname'] = "";
		echo "SUCCESS!<br/>";
		$yourname = $_SESSION['yourname'];
		$youremail = $_SESSION['youremail'];
		$subject = $_SESSION['subject'];
		$message = $_SESSION['message'] . genpasswd($yourname, $youremail);

		$msgheader = "Your password has been reset.";
		$msgbody = "Check the email account that you used to sign up with us.
						Once you have logged in with the newly assigned password, go to the change password option under the Welcome menu choice.
						";
		$sendstring = "sendemail.php?yourname=$yourname&youremail=$youremail&subject=$subject&message=$message&msgheader=$msgheader&msgbody=$msgbody";
		header('Location: ' . "$sendstring");
		return;
	}
	
	function genpasswd($yourname, $youremail)	{
		require_once($_SESSION['utils']);
		$util = new Utilities();
	
		require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
	
		//Get the number of records in zwordlist
		$query = "select count(*) as count from zwordlist";
		$stmt = $db->query($query);
		$num_results=$stmt->num_rows;
	
		if($num_results > 0) {
			for($i=0; $i<1; $i++)	{
				$row=$stmt->fetch_assoc();
				$wordcount = htmlspecialchars(stripslashes($row['count']));
			}
		}
	
		//Generate two random numbers and use them to get two random words.
		$rand1 = rand(1, $wordcount);
		$rand2 = rand(1, $wordcount);
		$word1 = get_word1($rand1);
		$word2 = get_word2($rand2);
		//Make clearpasswd = those two words joined and encpasswd = the hashed version of clearpasswd
		$clearpasswd = "$word1$word2";
		$encpasswd = $util::hash_password($clearpasswd);
			//echo "$clearpasswd<br/>";
			//echo "$encpasswd<br/>";
		//Now write the encpasswd into userlogin.password and email $clearpasswd to the user.
		$query = "update userlogin set password = '$encpasswd' where loginname = '$yourname' and email = '$youremail'";
		$stmt = $db->prepare($query);
		$stmt->execute();
		$num_results=$stmt->num_rows;
		return $clearpasswd;
	}
	
	function get_word1($rand1)	{
	require_once($_SESSION['dbopen']);
	@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
	if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
		}
		$query = "select word as word1 from zwordlist where wnum = $rand1";
		$stmt = $db->query($query);
		$num_results=$stmt->num_rows;
	
		if($num_results > 0) {
		for($i=0; $i<1; $i++)	{
		$row=$stmt->fetch_assoc();
		$word1 = htmlspecialchars(stripslashes($row['word1']));
		}
		}
		return trim($word1);
	}
	
	function get_word2($rand2)	{
	require_once($_SESSION['dbopen']);
	@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
	if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
		}
		$query = "select word as word2 from zwordlist where wnum = $rand2";
		$stmt = $db->query($query);
		$num_results=$stmt->num_rows;
	
		if($num_results > 0) {
		for($i=0; $i<1; $i++)	{
		$row=$stmt->fetch_assoc();
		$word2 = htmlspecialchars(stripslashes($row['word2']));
		}
	}
	return trim($word2);
	}

	
	function gencap()	{
		$rand = rand(1,6);
		switch($rand)	{
			case 1:
				$cpic = "images/cap_apple.png";
				$cname = "apple";
				break;
			case 2:
				$cpic = "images/cap_banana.png";
				$cname = "banana";
				break;
			case 3:
				$cpic = "images/cap_carrot.png";
				$cname = "carrot";
				break;
			case 4:
				$cpic = "images/cap_onion.png";
				$cname = "onion";
				break;
			case 5:
				$cpic = "images/cap_potato.png";
				$cname = "potato";
				break;
			case 6:
				$cpic = "images/cap_tomato.png";
				$cname = "tomato";
				break;
		}
		$_SESSION['cname'] = $cname;
		return $cpic;
		//cap_apple.png, cap_banana.png, cap_carrot.png, cap_onion.png, cap_potato.png, cap_tomato.png
	}


function dohtml()	{
echo '
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

	<body id="main_body" >
	<img id="top" src="images/top.png" alt="">
	<div id="form_container">
		<h1><a>Send Us A Comment</a></h1>
		<form id="form_346996" class="appnitro"  method="post" action="menutemplate.php?process=forgotpassword_save.php">
					<div class="form_description">
			<h2>Send Us A Comment</h2>
			<p>In order for you to reset your password you must identify the produce in the picture below.</p>
		</div>
		<ul>

		<li id="li_99">
			<label class="description">
				<img src="';
				
echo gencap();

echo '"><br />
			</label>
			<p class="guidelines" id="guide_2"><small>Type in the description of the object in order to be able to send the email.</small></p>
		</li>

		<li id="li_99">
			<label class="description">What is this a picture of?
				<input type="text" name="whatis" size=20 maxlength=50 /><br />
			</label>
			<p class="guidelines" id="guide_2"><small>Type in the description of the object in order to be able to send the email.</small></p>
		</li>
		
		</li>
				<li class="buttons">
			   <input type="hidden" name="form_id" value="346996" />
				<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit Answer" />
		</li>
			</ul>
		</form>	
		<div id="footer">
		</div>
	</div>
	<img id="bottom" src="images/bottom.png" alt="">
	</body>
   
</body>
</html>
';
}

?>