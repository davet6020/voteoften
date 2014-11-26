<?php
   $_SESSION['utils']="common/utilities.php";	//Program with common functions.
	$_SESSION['dbopen']="../db_voteoften.php";
	
	require_once($_SESSION['utils']);
      $util = new Utilities();
		$util->keep_alive();
      
   /*
      This is for a Many-choice 1 ballot.  Which is a ballot that can have
      many choices but only one can be voted for.
      electionlist_main.tbl:  electionname, electionfinaldate, district, description, allvoters
      electionlist_sub.tbl:   competitor, politicalparty
   */
   
   if(!isset($_SESSION['ballot_type']))   {
      header('Location: menutemplate.php?process=create_ballot.php');
   }   else    {
      $ballot_type = htmlspecialchars($_SESSION['ballot_type']);
   }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Create a True/False, Yes/Now Type Ballot</title>
<link rel="stylesheet" type="text/css" href="css/view.css" media="all">
<script type="text/javascript" src="js/view.js"></script>
<script type="text/javascript" src="js/calendar.js"></script>
</head>
<body id="main_body" >
	<img id="top" src="images/top.png" alt="">
	<div id="form_container_mc1">
		<h1><a>Create a True/False, Yes/Now Type Ballot</a></h1>
		<form id="electionlist" class="appnitro"  method="post" action="create_ballot_yn1_save.php">
		<div class="form_description">
			<h2>Create a True/False, Yes/Now Type Ballot</h2>
			<p>Fill in the fields below.  Ballot Name, Final Date and at least one choice is required.</p>
		<ul>
		<div>
			<li id="li_99">
				<label class="description">
					Ballot Question: <input type="text" name="electionname" size=45 maxlength=50 /><br />
				</label>
				<p class="guidelines" id="guide_2"><small>This is for a brief description of the ballot.  Its maximum length is 50 characters.  It will appear as the title of the ballot.</small></p>
			</li>
			
			<li id="li_99">
				<label class="description">&nbsp;&nbsp;
					Final Date: <input type="text" name="electionfinaldate" size=8 maxlength=8 />&nbsp;&nbsp;
               <br />
				</label>
				<p class="guidelines" id="guide_2"><small>This is the last date the election should be available until. No / or - are required.  Enter the date like this: 20121106 for November 6, 2012.</small></p>
			</li>
         <li id="li_99">
				<label class="description">&nbsp;&nbsp;
               Who can see your ballot:
               <select class="element select medium" id="allvoters" name="allvoters">
                  <option value="1" >All VoteOften users</option>
                  <option value="0" >Just me</option>
                  <option value="2" >The Whole World</option>
               </select><br />
				</label>
				<p class="guidelines" id="guide_2"><small>It's fun to create ballots for others to see but you can make them private if you want.  Don't worry, other users will not know you created the ballot.</small></p>
			</li>
         
         <li id="li_99">
				<label class="description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               Possible Answers:
               <select class="element select small" id="tfyn" name="tfyn">
                  <option value="3" >Yes/No</option>
                  <option value="4" >True/False</option>
               </select><br />
				</label>
				<p class="guidelines" id="guide_2"><small>Depending on the type of ballot you are creating, you may want the possible answers to be True/False or Yes/No</small></p>
			</li>
			<li id="li_99">
				<label class="description">&nbsp;&nbsp;&nbsp;
					Keyword: <input type="text" name="keyword" id="keyword" size=50 maxlength=255 /><br />
				</label>
				<p class="guidelines" id="guide_2"><small>If you make your ballot world viewable, you must put in a keyword that allows your friends to access it via Voting menu choice called World Viewable Ballots.</small></p>
			</li>
         
<!--
         <li id="li_99">
				<label class="description">&nbsp;&nbsp;
					Choice 01: <input type="text" name="choice01" size=50 maxlength=50 /><br />
				</label>
				<p class="guidelines" id="guide_2"><small>Choice One of a list of competitors. ex. Choice One = Blue, Choice Two = Red and Choice Three = Green</small></p>
			</li>
         <li id="li_99">
				<label class="description">&nbsp;&nbsp;
					Choice 02: <input type="text" name="choice02" size=50 maxlength=50 /><br />
				</label>
				<p class="guidelines" id="guide_2"><small>Choice Two of a list of competitors. ex. Choice One = Blue, Choice Two = Red and Choice Three = Green</small></p>
			</li>

         <li id="li_99">
				<label class="description">
					Choice 07: <input type="text" name="choice07" size=50 maxlength=50 /><br />
				</label>
				<p class="guidelines" id="guide_2"><small>Choice Seven of a list of competitors. ex. Choice One = Blue, Choice Two = Red and Choice Three = Green</small></p>
			</li>
         <li id="li_99">
				<label class="description">
					Choice 08: <input type="text" name="choice08" size=50 maxlength=50 /><br />
				</label>
				<p class="guidelines" id="guide_2"><small>Choice Eight of a list of competitors. ex. Choice One = Blue, Choice Two = Red and Choice Three = Green</small></p>
			</li>
         <li id="li_99">
				<label class="description">
					Choice 09: <input type="text" name="choice09" size=50 maxlength=50 /><br />
				</label>
				<p class="guidelines" id="guide_2"><small>Choice Nine of a list of competitors. ex. Choice One = Blue, Choice Two = Red and Choice Three = Green</small></p>
			</li>
         <li id="li_99">
				<label class="description">
					Choice 10: <input type="text" name="choice10" size=50 maxlength=50 /><br />
				</label>
				<p class="guidelines" id="guide_2"><small>Choice Ten of a list of competitors. ex. Choice One = Blue, Choice Two = Red and Choice Three = Green</small></p>
			</li>
-->
         <li id="li_99">
				<label class="description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Infolink: <input type="text" name="infolink" size=50 maxlength=4096 /><br />
				</label>
				<p class="guidelines" id="guide_2"><small>You can paste in a URL that contains information that is pertinent to the ballot you have just created.</small></p>
			</li>
         <li id="li_99">
				<label class="description">
            Detailed Description:
               <textarea value="left" name="description" id="description" cols="70" rows="8"></textarea>
				</label>
				<p class="guidelines" id="guide_2"><small>This is where you put a more detailed description of the ballot.</small></p>
			</li>
         
      </li>
				<li class="buttons">
			   <input type="hidden" name="form_id" value="346996" />
				<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
		</li>
         
         <br/>
		</div>
		<br/>
		</ul>
		</div>
      <?php
         if(isset($_SESSION['errmsg']))   {
            echo $_SESSION['errmsg'] . "<br/>";
         }
      ?>
		</form>	
		<div id="footer"></div>
	</div>
	<img id="bottom" src="images/bottom.png" alt="">
	</body>
</html>
