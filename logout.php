<?php
	session_id("--LOGIN--");
	session_start();
	$_SESSION['utils']="common/utilities.php";	//Program with common functions.

	require_once($_SESSION['utils']);
      $util = new Utilities();
		$util->unset_profile_session_info();
	session_destroy();
	header('Location: index.php');
?>
