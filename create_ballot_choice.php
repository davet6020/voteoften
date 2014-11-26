<?php
   $_SESSION['utils']="common/utilities.php";	//Program with common functions.
	$_SESSION['dbopen']="../db_voteoften.php";
	
	require_once($_SESSION['utils']);
      $util = new Utilities();
		$util->keep_alive();
      
   if(!isset($_GET['ballot1']))   {
      header('Location: menutemplate.php?process=create_ballot.php');
   }   else    {
      $ballot_type = htmlspecialchars($_GET['ballot1']);
      $_SESSION['ballot_type'] = $ballot_type;
   }

   switch($ballot_type)	{
		case "mc1":
			create_mc1();
			break;
      case "mc2":
			create_mc2();
			break;
      case "yn1":
			create_yn1();
			break;
      case "":
			header('Location: menutemplate.php?process=create_ballot.php');
			break;
		default:
			header('Location: menutemplate.php?process=create_ballot.php');
			break;
	}

   function create_mc1()   {
      //echo "" . __FUNCTION__;
      $_SESSION['ballottype'] = 1;
      header('Location: menutemplate.php?process=create_ballot_mc1.php');
   }
   function create_mc2()   {
      //echo "" . __FUNCTION__;
      $_SESSION['ballottype'] = 2;
      header('Location: menutemplate.php?process=create_ballot_mc2.php');
   }
   function create_yn1()   {
      //echo "" . __FUNCTION__;
      $_SESSION['ballottype'] = 3;
      header('Location: menutemplate.php?process=create_ballot_yn1.php');
   }
?>
