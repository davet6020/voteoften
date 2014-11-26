<?php
	session_start();
	$_SESSION['utils']="common/utilities.php";	//Program with common functions.
	$_SESSION['dbopen']="db_voteoften.php";
	
	require_once($_SESSION['utils']);
	$util = new Utilities();
	$util->keep_alive();
		
	if(!isset($_SESSION['level']) || empty($_SESSION['level']))	{
		$_SESSION['level'] = FALSE;
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
				"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title></title>
	<link rel="stylesheet" href="css/menu_style.css" type="text/css" />
	<link rel="stylesheet" href="css/social_media.css" type="text/css" />
</head>
<body>
	<span class="twitter">
		<a href="https://twitter.com/#!/voteoften" target="_blank" >
			<img src="images/twitter.png" alt="twitter" height="20" width="20" />
		</a>
	</span>
	<span class="rss">
		<a href="#" target="_blank" >
			<img src="images/rssfeed.png" alt="rss" height="20" width="20" target="_blank" />
		</a>
	</span>
	<span class="facebook" target="_blank" >
		<a href="#">
			<img src="images/facebook.png" alt="rss" height="20" width="20" target="_blank" />
		</a>
	</span>
	<span class="email">
		<a href="menutemplate.php?process=sendcomment.php">
			<img src="images/email.png" alt="rss" height="20" width="20" target="_blank" />
		</a>
	</span>
	
	<?php include_once("analyticstracking.php") ?>
	<br><br>
	<div class="menu">
		<ul>
			<li><a href="index.php">Home</a></li>
			
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

	 <img src="images/VoteSam.png" alt="" class="image-center" />
	 
</body>
</html>

