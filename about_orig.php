<?php
//This about page is ugly. more stuff
	$_SESSION['utils']="common/utilities.php";	//Program with common functions.
	require_once($_SESSION['utils']);
      $util = new Utilities();
		$util->keep_alive();

	$_SESSION['dbopen']="../db_voteoften.php";
	if(!isset($_SESSION['showerror']))	{
		$_SESSION['showerror'] = FALSE;
	}

	$showerror = $_SESSION['showerror'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>About VoteOften.org</title>
<link rel="stylesheet" type="text/css" href="css/view.css" media="all">
</head>
<body id="main_body" >
	<img id="top" src="images/top.png" alt="">
	<div id="about_form_container">
		<h1 class="about"><a>About VoteOften.org</a></h1>
		<form id="form_346996" class="about"  method="post" action="userprofile1_save.php">
			<div class="form_description">
				<h2>About VoteOften.org</h2>
				<p class="about_banner">
					<p class="about"><b>
						I call this web site VoteOften.org.  The idea behind it was based on personal experiences with the voting process and can best be explained by an example.
					</b></p>
					<p>
						Supposed I consider myself to be a Democrat.  This is to say I am registered with the Democratic Party and I pretty much always vote for democrats.  That being said, if I am honest with myself there are those days where the candidate from another party says or does something that makes me want to cast my vote in his/her favor.  Or perhaps the candidate I intended to vote for does or says something that I am not in agreement with and that makes me want to vote for the other candidate.  If you had recorded each of these events throughout the course of the election cycle and looked at how you cast your vote daily, would the candidate you originally intended to vote for have the majority of votes?  There is only one way to find out, vote often.
						Consider VoteOften.org to be your personal voting diary.  For any election that is available to you, you can vote in once per day.  At any time you can look at a graph that shows the history of your votes and why you voted the way you did.  In addition to your voting history, you can see how other demographics are voting in your elections. 
						Another fun feature of VoteOften.org is the ability to create your own ballots.  These ballots can be for only you to vote on or something that all other VoteOften.org members can vote on.  The choice is yours.
					</p>
				</div>
			<div class="form_description">
				<h1 class="about">
				<h2>How it works</h2>
				<p>
					To get started, sign up for an account.  You will be prompted with some questions.  Your answers are anonymous.  Your experience will be better the more information you are willing to put in the profile.  However, you are not required to answer any of the profile questions.
				</p>
			</div>
			<div class="form_description">
				<h1 class="about">
				<h2>Questions or Comments</h2>
				<p>
					If you have any questions or comments about VoteOften.org, feel free to contact us via the <a href="menutemplate.php?process=sendcomment.php" /> Send us a comment</a> link on the About menu.
				</p>
			</div>

		</form>	
		<div id="footer">
		</div>
	</div>
	<img id="bottom" src="images/bottom.png" alt="">
	</body>
</html>