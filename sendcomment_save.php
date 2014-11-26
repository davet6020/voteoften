<?php
	$_SESSION['utils']="common/utilities.php";	//Program with common functions.
	$_SESSION['dbopen']="../db_voteoften.php";
	
	require_once($_SESSION['utils']);
      $util = new Utilities();
		$util->keep_alive();

	if(!isset($validmsg))	{
		$validmsg = FALSE;	//if yourname, youremail, subject or message is empty re-run sendcomment.php
	}
	
	if($_POST['submit'] == "Submit Answer")	{
		if(isset($_POST['whatis'])) {
			if(!empty($_POST['whatis']))	{
				$whatis = trim($_POST['whatis']);
				$whatis = strtolower($whatis);
					if($whatis == $_SESSION['cname'])	{
						sendemail();
						return;	//probably won't need this if sendemail() leads to another program.
					}	else	{
							dontsendemail();
					}
			}	else	{
					$whatis = "";
					dontsendemail();
			}
		}	else	{
				dontsendemail();
		}
	}	else	{
			dohtml();
	}


	if(isset($_POST['yourname']))	{
		if(!empty($_POST['yourname']))	{
			$yourname = $_POST['yourname'];
			$_SESSION['yourname'] = $yourname;
		}	else	{
				header('Location: menutemplate.php?process=sendcomment.php');
		}
	}	else	{
			header('Location: menutemplate.php?process=sendcomment.php');
	}
	
	if(isset($_POST['youremail']))	{
		if(!empty($_POST['youremail']))	{
			$youremail = $_POST['youremail'];
			$_SESSION['youremail'] = $youremail;
		}	else	{
				header('Location: menutemplate.php?process=sendcomment.php');
		}
	}	else	{
			header('Location: menutemplate.php?process=sendcomment.php');
	}
	
	if(isset($_POST['subject']))	{
		if(!empty($_POST['subject']))	{
			$subject = $_POST['subject'];
			$_SESSION['subject'] = $subject;
		}	else	{
				echo "need a subj<br/>";
		}
	}	else	{
			echo "need a subj<br/>";
	}
	
	if(isset($_POST['message']))	{
		if(!empty($_POST['message']))	{
				$message = trim($_POST['message']);
				$_SESSION['message'] = $message;
		}	else	{
				echo "need a message<br/>";
		}
	}	else	{
			echo "need a message<br/>";
	}
		
	
	function dontsendemail()	{
		dohtml();
		echo "Sorry, you spelled that incorrectly.  Try again.<br/>";
		$_SESSION['cname'] = "";
		return;
	}
	
	function sendemail()	{
		$_SESSION['cname'] = "";
		//echo "SUCCESS!<br/>";
		//menutemplate.php?process=create_ballot_choice.php&ballot1=mc1
		$yourname = $_SESSION['yourname'];
		$youremail = $_SESSION['youremail'];
		$subject = $_SESSION['subject'];
		$message = $_SESSION['message'];
		$sendstring = "sendemail.php?yourname=$yourname&youremail=$youremail&subject=$subject&message=$message";
		header('Location: ' . "$sendstring");
		return;
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
		<form id="form_346996" class="appnitro"  method="post" action="menutemplate.php?process=sendcomment_save.php">
					<div class="form_description">
			<h2>Send Us A Comment</h2>
			<p>In order for you to send this message you must identify the produce in the picture below.</p>
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