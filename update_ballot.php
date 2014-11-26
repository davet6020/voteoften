<?php
	$_SESSION['utils']="common/utilities.php";	//Program with common functions.
	$_SESSION['dbopen']="../db_voteoften.php";
	
	require_once($_SESSION['utils']);
      $util = new Utilities();
		$util->keep_alive();

	if(isset($_SESSION['electionid']) && !empty($_SESSION['electionid']))	{
		$electionid = $_SESSION['electionid'];
	}	else	{
		$electionid = "";
	}
	
	//Making these global
	$electionname = "";
	$electionfinaldate = "";
	$district = "";
	$description = "";
	$ballottype = "";
	
	function getelection_main($electionid)  {
		$tb1 = '<li id="li_99"><label class="description">';
		$tb2 = '" size=50 maxlength=50 /><br /></label>';
		
		require_once($_SESSION['utils']);
		$util = new Utilities();
		
		require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
         }
		
		$query = 'select m.electionname, m.electionfinaldate, m.district, m.description, m.ballottype, m.allvoters, m.infolink, m.keyword
		from electionlist_main as m where m.electionid=' . $electionid;
	   $stmt = $db->query($query);
      $num_results=$stmt->num_rows;

      if($num_results > 0) {
         for($i=0; $i<1; $i++)	{
            $row=$stmt->fetch_assoc();
				$electionname = htmlspecialchars(stripslashes($row['electionname']));
				$electionfinaldate = htmlspecialchars(stripslashes($row['electionfinaldate']));
				$district = htmlspecialchars(stripslashes($row['district']));
				$description = htmlspecialchars(stripslashes($row['description']));
				$ballottype = htmlspecialchars(stripslashes($row['ballottype']));
				$allvoters = htmlspecialchars(stripslashes($row['allvoters']));
				$infolink = htmlspecialchars(stripslashes($row['infolink']));
				$keyword = htmlspecialchars(stripslashes($row['keyword']));
				$_SESSION['description'] = $description;
				$_SESSION['ballottype'] = $ballottype;
				$_SESSION['infolink'] = $infolink;
				$_SESSION['keyword'] = $keyword;
?>

				<!--  *** Election Name *** -->
					<li id="li_99"><label class="description">
					Ballot Name: <input type="text" name="electionname" value="<?php echo $electionname; ?>" size=50 maxlength=50 /><br /></label>
					<p class="guidelines" id="guide_2"><small>This is for a brief description of the ballot.  It will appear as the title of the ballot.</small></p>
				
				<!--  *** Election Name *** -->
					<li id="li_99"><label class="description">&nbsp;&nbsp;
					Final Date: <input type="text" name="electionfinaldate" size=8 maxlength=8 value="<?php echo $electionfinaldate; ?>" size=8 maxlength=8 /><br /></label>
					<p class="guidelines" id="guide_2"><small>This is the last date the election should be available until. No / or - are required.  Enter the date like this: 20121106 for November 6, 2012.</small></p></li>

				<!--  *** Who can see your ballot *** -->
					<li id="li_99"><label class="description">
					Who can see your ballot: <select class="element select medium" id="allvoters" name="allvoters">
               
					
<?php 
					if($allvoters == 0)	{
							echo '<option value="0" selected="yes" >Just me</option>';
					}	else	{
							echo '<option value="0" >Just me</option>';
					}
					if($allvoters == 1)	{
						echo '<option value="1" selected="yes" >All VoteOften users</option>';
					}	else	{
						echo '<option value="1" >All VoteOften users</option>';
					}
					if($allvoters == 2)	{
						echo '<option value="2" selected="yes" >The Whole World</option>';
					}	else	{
						echo '<option value="2" >The Whole World</option>';
					}
?>
                  
               </select>
					</label>
					<p class="guidelines" id="guide_2"><small>It's fun to create ballots for others to see but you can make them private if you want.  Don't worry, other users will not know you created the ballot.</small></p>
				</li>
				
<?php				
						//	document.getElementById("description").value
         }
		}
   }
	
   function getelection_sub($electionid)  {
   	$cnt = 0;
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
         }

		$query = 'select s.competitor
					from electionlist_main as m, electionlist_sub as s where m.electionid = s.electionid
					and m.electionid=' . $electionid;
      $stmt = $db->query($query);
      $num_results=$stmt->num_rows;

      if($num_results > 0) {
         for($i=0; $i<$num_results; $i++)	{
         	$cnt++;
            $row=$stmt->fetch_assoc();
					$competitor = stripslashes($row['competitor']);
?>
					
					<li id="li_99">
					<label class="description">&nbsp;&nbsp;&nbsp;
					Choice 0<?php echo $i+1; ?>: <input type="text" name="choice0<?php echo $i+1; ?>" id="choice0<?php echo $i+1; ?>" size=50 maxlength=255 value="<?php echo $competitor; ?>" /><br />
					</label>
					<p class="guidelines" id="guide_2"><small>Choice Three of a list of competitors. ex. Choice One = Blue, Choice Two = Red and Choice Three = Green.</small></p>
					</li>
<?php
					
         }
      }
		
      $stmt->close();
      $db->close();


					if($num_results < 6)	{
						$j = 6 - $num_results;
						$cnt++;	//stupid but increment $cnt once more.
						for($h=0; $h<$j; $h++)	{
?>
							<li id="li_99">
							<label class="description">&nbsp;&nbsp;&nbsp;
							Choice 0<?php echo $h+$cnt; ?>: <input type="text" name="choice0<?php echo $h+$cnt; ?>" id="choice0<?php echo $h+$cnt; ?>" size=50 maxlength=255 value="" /><br />
							</label>
							<p class="guidelines" id="guide_2"><small>Choice Three of a list of competitors. ex. Choice One = Blue, Choice Two = Red and Choice Three = Green.</small></p>
							</li>
<?php 
						}
					}

?>

					<li id="li_99">
					<label class="description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Infolink: <input type="text" name="infolink" size=50 maxlength=4096 value="<?php echo $_SESSION['infolink']; ?>" /><br />
					</label>
					<p class="guidelines" id="guide_2"><small>You can paste in a URL that contains information that is pertinent to the ballot you have just created.</small></p>
					</li>
					
					<li id="li_99">
					<label class="description">&nbsp;&nbsp;&nbsp;&nbsp;
					Keyword: <input type="text" name="keyword" id="keyword" size=50 maxlength=255 value="<?php echo $_SESSION['keyword']; ?>" /><br />
					</label>
					<p class="guidelines" id="guide_2"><small>If you make your ballot world viewable, you must put in a keyword that allows your friends to log in and vote.</small></p>
					</li>

					<li id="li_99">
					<label class="description">
					Detailed Description:
					<textarea value="left" name="description" id="description" cols="70" rows="8" ><?php echo $_SESSION['description']; ?></textarea>
					</label>
					<p class="guidelines" id="guide_2"><small>This is where you put a more detailed description of the ballot.</small></p>
					</li>
      
<?php
   }
   
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Update Ballot</title>
<link rel="stylesheet" type="text/css" href="css/view.css" media="all">
<script type="text/javascript" src="js/view.js"></script>
<script type="text/javascript" src="js/calendar.js"></script>
<script type="text/javascript">
function SelectAll(id)
{
    document.getElementById(id).focus();
    document.getElementById(id).select();
}
</script>
</head>
<body id="main_body" >
	<img id="top" src="images/top.png" alt="">
	<div id="form_container_mc1">
		<h1><a>Your Elections</a></h1>
		<form id="electionlist" class="appnitro"  method="post" action="menutemplate.php?process=update_ballot_save.php">
			<div class="form_description">
			
				<?php
					getelection_main($electionid);
					getelection_sub($electionid);
					echo '</div>';
				?>
			
		<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
      </ul>
		</form>	
		<div id="footer"></div>
	</div>
	<img id="bottom" src="images/bottom.png" alt="">
	</body>
</html>
