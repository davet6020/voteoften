<?php
	session_start();
	$_SESSION['utils']="common/utilities.php";	//Program with common functions.
	$_SESSION['dbopen']="db_voteoften.php";
	
	require_once($_SESSION['utils']);
	$util = new Utilities();
	$util->keep_alive();

	if(isset($_GET['process']) && !empty($_GET['process']))	{
		$process = $_GET['process'];
	}	else	{
		$process = "";
	}
	
	if(isset($_GET['demo']) && !empty($_GET['demo']))	{
		$demo = $_GET['demo'];
	}	else	{
		$demo = "";
	}
	
	if(isset($_GET['crud']) && !empty($_GET['crud']))	{
		$crud = $_GET['crud'];
	}	else	{
		$crud = "";
	}
	
	if(isset($_GET['msgheader']) && !empty($_GET['msgheader']))	{
		$msgheader = $_GET['msgheader'];
	}	else	{
		$msgheader = "";
	}
	if(isset($_GET['msgbody']) && !empty($_GET['msgbody']))	{
		$msgbody = $_GET['msgbody'];
	}	else	{
		$msgbody = "";
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
	<?php include_once("analyticstracking.php") ?>
	<br>
	<br>
	<div class="menu">
		<ul>
			<li><a href="index.php" >Home</a></li>
			
			<?php
				if(!isset($_SESSION['login']))	{
					if(empty($_SESSION['login']))	{
						echo '
							<li style="float:right; padding-right:15px;"><a href="#" id="current">Login</a>
								<ul>
									<li><a href="menutemplate.php?process=login.php">Login</a></li>
									<li><a href="menutemplate.php?process=createuserid.php">Create Account</a></li>
								</ul>
							<li>
						';
					}
				}
			?>
			
			<?php
				//If the user is logged in they get more menu choices.
				if(isset($_SESSION['login']))	{
					if($_SESSION['login'])	{
						
						
						//If logged in this is the Welcome/Login menu choice.
						echo '
							<li style="float:right;"><a href="">Welcome ' . $_SESSION['login']. '</a>'
							. '<ul><li><a href="logout.php">Logout</a></li>
								<li><a href="menutemplate.php?process=changepassword.php">Change Password</a></li>
								<li><a href="menutemplate.php?process=userprofile1.php">Update Profile</a></li>
								<li><a href="menutemplate.php?process=profileshow.php">View Profile</a></li>
								</ul>
							</li>
						';
						echo '
							<li><a href="">Voting</a>
								<ul>
									<li><a href="menutemplate.php?process=el_you.php&crud=read">Your Ballots</a></li>
									<li><a href="menutemplate.php?process=el_all.php&crud=read">Other VO Users Ballots</a></li>
									<li><a href="menutemplate.php?process=globallist_keyword.php">World Viewable Ballots</a></li>
									<li><a href="menutemplate.php?process=el_you_votedon.php&crud=read">Ballots You Have Voted On</a></li>
								</ul>
							</li>
						';
						echo '
							<li><a href="index.php">Reporting</a>
								<ul>
									<li><a href="menutemplate.php?process=vh_you.php">Your Ballot Vote History</a></li>
									<li><a href="menutemplate.php?process=vh_other.php">Other VO Users Vote History</a></li>
									<li><a href="menutemplate.php?process=vh_www.php">World Viewable Vote History</a></li>
									<li><a href="menutemplate.php?process=vh_you_votedon.php">Ballots You Have Voted On</a></li>
									<li><a href="menutemplate.php?process=vh_all.php">All Ballots by Demographic</a></li>
									<li><a href=""><hr/></a></li>
									<li><a href="menutemplate.php?process=majority">Majority Rule</a></li>
									<li><a href="menutemplate.php?process=plurality">Plurality</a></li>
								</ul>
							</li>
						';
					echo '
						<li><a href="">Ballot Mgmt</a>
						<ul>';
						//If logged in AND level >0 which for now is everyone with a login. but later will be
						//maybe level 777 which could be equal to a paying customer.
						if(isset($_SESSION['level']))	{
							if($_SESSION['level']>=1)	{
								echo '
								<ul>
								<li><a href="menutemplate.php?process=create_ballot.php">Create A Ballot</a></li>
								<li><a href="menutemplate.php?process=electionlist.php&crud=update">Update a Ballot</a></li>
								<li><a href="menutemplate.php?process=electionlist.php&crud=delete">Delete a Ballot</a></li>
								</ul>
								';
							}
						}
						//This closes out the echo for the if logged in.
						echo '
						</ul>
						</li>
						';
						
						echo '
						<li><a href="">Demographics</a>
						<ul>';
						//If logged in AND level >0 which for now is everyone with a login. but later will be
						//maybe level 777 which could be equal to a paying customer.
						if(isset($_SESSION['level']))	{
							if($_SESSION['level']>=1)	{
								echo '
								<ul>
									<li><a href="menutemplate.php?process=piechart.php&demo=religion">Users by Religion</a></li>
									<li><a href="menutemplate.php?process=piechart.php&demo=gender">Users by Gender</a></li>
									<li><a href="menutemplate.php?process=piechart.php&demo=race">Users by Race</a></li>
									<li><a href="menutemplate.php?process=piechart.php&demo=politicalparty">Users by Political Affiliation</a></li>
								</ul>
								';
							}
						}
						//This closes out the echo for the if logged in.
						echo '
						</ul>
						</li>
						';
						
					}
				}	else	{
					echo '
					<li><a href="">Voting</a>
						<ul>
							<li><a href="menutemplate.php?process=globallist_keyword.php">World Viewable Ballots</a></li>
						</ul>
					</li>
					';
					echo '
					<li><a href="index.php">Reporting</a>
						<ul>
							<li><a href="menutemplate.php?process=wv_ballots_report.php">World Viewable Ballots</a></li>
							<li><a href="menutemplate.php?process=piechart.php&demo=religion">VO Users by Religion</a></li>
							<li><a href="menutemplate.php?process=piechart.php&demo=gender">VO Users by Gender</a></li>
							<li><a href="menutemplate.php?process=piechart.php&demo=race">VO Users by Race</a></li>
							<li><a href="menutemplate.php?process=piechart.php&demo=politicalparty">VO Users by Political Affiliation</a></li>
						</ul>
					</li>
					';
				}
			?>
			
			<li><a href="#" id="current">Media</a>
				<ul>
					<li><a href="menutemplate.php?process=videos.php&candidate=Obama">President Obama</a></li>
					<li><a href="menutemplate.php?process=videos.php&candidate=Romney">Mitt Romney</a></li>
					<li><a href="menutemplate.php?process=twitter.php">Political Twitter</a></li>
				 </ul>
			</li>
			
			<li><a href="index.php">About</a>
				<ul>
					<li><a href="menutemplate.php?process=sendcomment.php">Send us a comment</a></li>
					<li><a href="menutemplate.php?process=about.php">About Vote Often</a></li>
					<li><a href="menutemplate.php?process=about_spanish.php">Sobre Vote Often</a></li>
				</ul>
			</li>
			
			<?php
				if(isset($_SESSION['level']))	{
					if($_SESSION['level']>=888)	{
						echo '
							<li><a href="">Admin Menu</a>
								<ul>
									<li><a href="menutemplate.php?process=change_history_add.php">Add Change History</a></li>
									<li><a href="menutemplate.php?process=change_history_update.php">Update change History</a></li>
									<li><a href="menutemplate.php?process=test_page.php">Test Page</a></li>
								</ul>
							</li>
						';
					}
				}
			?>
			
		</ul>
	</div>

	 <?php
		switch($process)	{
			case "about.php":
				include('about.php');
				break;
			case "about_spanish.php":
				include('about_spanish.php');
				break;
			case "linechart.php":
				include('linechart.php');
				break;
			case "cast_vote.php":
				include('cast_vote.php');
				break;
			case "change_history_add.php":
				include('change_history_add.php');
				break;
			case "change_history.php":
				include('change_history.php');
				break;
			case "change_history_update.php":
				include('change_history_update.php');
				break;
			case "change_history_update_edit.php":
				include('change_history_update_edit.php');
				break;
			case "changepassword.php":
				include('changepassword.php');
				break;
			case "chart_htav.php":
				include('chart_htav.php');
				break;
			case "chart_htav_save.php":
				include('chart_htav_save.php');
				break;
			case "create_ballot.php":
				include('create_ballot.php');
				break;
			case "create_ballot_choice.php":
				include('create_ballot_choice.php');
				break;
			case "create_ballot_mc1.php":
				include('create_ballot_mc1.php');
				break;
			case "create_ballot_mc2.php":
				include('create_ballot_mc2.php');
				break;
			case "create_ballot_yn1.php":
				include('create_ballot_yn1.php');
				break;
			case "createuserid.php":
				include('createuserid.php');
				break;
			case "delete_ballot.php":
				$_SESSION['crud'] = $crud;
				include('delete_ballot.php');
				break;
			case "electionlist.php":
				$_SESSION['crud'] = $crud;
				include('electionlist.php');
				break;
			case "electionlist_choice.php":
				$_SESSION['crud'] = $crud;
				include('electionlist_choice.php');
				break;
			case "el_you.php":
				$_SESSION['crud'] = $crud;
				include('el_you.php');
				break;
			case "el_you_votedon.php":
				$_SESSION['crud'] = $crud;
				include('el_you_votedon.php');
				break;
			case "el_all.php":
				$_SESSION['crud'] = $crud;
				include('el_all.php');
				break;
			case "el_choice.php":
				$_SESSION['crud'] = $crud;
				include('el_choice.php');
				break;
			case "forgotpassword.php":
				include('forgotpassword.php');
				break;
			case "forgotpassword_save.php":
				include('forgotpassword_save.php');
				break;
			case "globallist_keyword.php":
				include('globallist_keyword.php');
				break;
			case "globallist_keyword_save.php":
				include('globallist_keyword_save.php');
				break;
			case "global_cast_vote.php":
				include('global_cast_vote.php');
				break;
			case "login.php":
				include('login.php');
				break;
			case "message.php":
				$_SESSION['msgheader'] = $msgheader;
				$_SESSION['msgbody'] = $msgbody;
				include('message.php');
				//include("message.php?msgheader=$msgheader&msgbody=$msgbody");
				break;
			case "piechart.php":
				$_SESSION['demo'] = $demo;
				include('piechart.php');
				break;
			case "profileshow.php":
				include('profileshow.php');
				break;
			case "sendcomment.php":
				include('sendcomment.php');
				break;
			case "sendcomment_save.php":
				include('sendcomment_save.php');
				break;
			case "sendemail.php":
				include('sendemail.php');
				break;
			case "test_page.php":
				include('test_page.php');
				break;
			case "twitter.php":
				include('twitter.php');
				break;
			case "update_ballot.php":
				include('update_ballot.php');
				break;
			case "update_ballot_save.php":
				include('update_ballot_save.php');
				break;
			case "userprofile1.php":
				include('userprofile1.php');
				break;
			case "userprofile2.php":
				include('userprofile2.php');
				break;
			case "videos.php":
				include('videos.php');
				break;
			case "vh_you.php":
				include('vh_you.php');
				break;
			case "vh_you_votedon.php":
				include('vh_you_votedon.php');
				break;
			case "vh_other.php":
				include('vh_other.php');
				break;
			case "vh_all.php":
				include('vh_all.php');
				break;
			case "vh_www.php":
				include('vh_www.php');
				break;
			case "vh_choice.php":
				include('vh_choice.php');
				break;
			case "majority":
				$_SESSION['votingsystem'] = 'vs_majority.php';
				include('vs_you_votedon.php');
				break;
			case "vs_majority.php":
				include('vs_majority.php');
				break;
			case "plurality":
				$_SESSION['votingsystem'] = 'vs_plurality.php';
				include('vs_you_votedon.php');
				break;
			case "vs_plurality.php":
				include('vs_plurality.php');
				break;
			case "singlerunoff":
				$_SESSION['votingsystem'] = 'vs_singlerunoff.php';
				include('vs_you_votedon.php');
				break;
			case "vs_singlerunoff.php":
				include('vs_singlerunoff.php');
				break;
			case "vs_sequentialrunoff.php":
				include('vs_sequentialrunoff.php');
				break;
			case "vs_preferenceschedule.php":
				include('vs_preferenceschedule.php');
				break;
			case "vs_bordacount.php":
				include('vs_bordacount.php');
				break;
			case "vs_condorcet.php":
				include('vs_condorcet.php');
				break;
			case "vs_choice.php":
				include('vs_choice.php');
				break;
			case "":
				echo '<img src="images/VoteSam.png" alt="" class="image-center" />';
				break;
			default:
				echo '<img src="images/VoteSam.png" alt="" class="image-center" />';
				break;
		}
	?>

</body>
</html>