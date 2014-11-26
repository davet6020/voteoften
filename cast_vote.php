<?php
//alter table electionlist_main auto_increment=4
	session_start();
	$_SESSION['dbopen']="../db_voteoften.php";
	
	$_SESSION['utils']="common/utilities.php";
		require_once($_SESSION['utils']);
			$util = new Utilities();
			$util->keep_alive();

	if($_SESSION['ballottype'] == 1)	{	//only one choice to worry about.
		if(!isset($_POST['choice']))   {
			$insert = FALSE;
		}   else    {
				$userid = $_SESSION['userid'];
				$electionid = $_SESSION['electionid'];
				$competitor = htmlspecialchars($_POST['choice']);
				$reason = htmlspecialchars($_POST['reason']);
				//This makes $datecast = to today at 00:00:01AM.
				$datecast = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
				if($reason == 'Insert any applicable comments here.')	{
					$reason = "";
				}
			$insert = TRUE;
		}
		if(votedtoday($userid, $electionid, $datecast)) {
				echo "you already voted today.";
		}  else  {
         echo "this is your first try.<br/>";
         insertnewvote1($userid, $electionid, $competitor, $datecast, $reason);
		}
		header('Location: menutemplate.php?process=linechart.php');
	}
	
	if($_SESSION['ballottype'] == 2)	{
		$ccnt=6;
		if(isset($_POST['choice0']))   {
			if(!empty($_POST['choice0']))	{
				$choice0 = $_POST['choice0'];
			}
		}
		if(isset($_POST['choice1']))   {
			if(!empty($_POST['choice1']))	{
				$choice1 = $_POST['choice1'];
			}
		}
		if(isset($_POST['choice2']))   {
			if(!empty($_POST['choice2']))	{
				$choice2 = $_POST['choice2'];
			}
		}
		if(isset($_POST['choice3']))   {
			if(!empty($_POST['choice3']))	{
				$choice3 = $_POST['choice3'];
			}
		}
			
		if(isset($_POST['choice4']))   {
			if(!empty($_POST['choice4']))	{
				$choice4 = $_POST['choice4'];
			}
		}
		if(isset($_POST['choice5']))   {
			if(!empty($_POST['choice5']))	{
				$choice5 = $_POST['choice5'];
			}
		}
			$userid = $_SESSION['userid'];
			$electionid = $_SESSION['electionid'];
			$reason = htmlspecialchars($_POST['reason']);
			//This makes $datecast = to today at 00:00:01AM.
			$datecast = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
			if($reason == 'Insert any applicable comments here.')	{
				$reason = "";
			}
		if(votedtoday($userid, $electionid, $datecast)) {
				echo "you already voted today.";
		}	else	{
				$ccnt = $ccnt;
				for($i=0; $i<$ccnt; $i++)	{
					if(isset(${'choice' . $i}))	{
						$ch = ${'choice' . $i};
						$competitor = $ch;
						insertnewvote1($userid, $electionid, $competitor, $datecast, $reason);
					}
				}
		}
		header('Location: menutemplate.php?process=linechart.php');
	}

	if($_SESSION['ballottype'] == 3 || $_SESSION['ballottype'] == 4)	{	//3=Yes/No, 4=True/False.
		if(!isset($_POST['choice']))   {
			$insert = FALSE;
		}   else    {
				$userid = $_SESSION['userid'];
				$electionid = $_SESSION['electionid'];
				$competitor = htmlspecialchars($_POST['choice']);
				$reason = htmlspecialchars($_POST['reason']);
				//This makes $datecast = to today at 00:00:01AM.
				$datecast = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
				if($reason == 'Insert any applicable comments here.')	{
					$reason = "";
				}
			$insert = TRUE;
		}
		if(votedtoday($userid, $electionid, $datecast)) {
         echo "you already voted today.";
		}  else  {
         echo "this is your first try.<br/>";
         insertnewvote1($userid, $electionid, $competitor, $datecast, $reason);
		}
		header('Location: menutemplate.php?process=linechart.php');
	}
		
	function insertnewvote1($userid, $electionid, $competitor, $datecast, $reason)  {
		require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);

         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
         }

      $query = "insert into votescast(userid, electionid, competitor, datecast, reason) values(?, ?, ?, ?, ?)";
      $stmt = $db->prepare($query);
      $stmt->bind_param("iisis", $userid, $electionid, $competitor, $datecast, $reason);
      $stmt->execute();

      if($stmt->affected_rows > 0) {
         $inserted = TRUE;
      }   else	{
         $inserted = FALSE;
      }
   }

	function votedtoday($userid, $electionid, $datecast)  {
      require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
         }

      $query = "select datecast from votescast where userid=$userid and electionid=$electionid and datecast=$datecast";
      $stmt = $db->query($query);
      $count = $stmt->num_rows;
      if($count > 0) {
            $alreadyvoted = TRUE;
      }  else  {
            $alreadyvoted = FALSE;
      }
      return $alreadyvoted;
   }
?>