<?php
	$_SESSION['utils']="common/utilities.php";	//Program with common functions.
	$_SESSION['smtpopen']="../email_voteoften.php";
		require_once($_SESSION['smtpopen']);
	
	require_once($_SESSION['utils']);
      $util = new Utilities();
		$util->keep_alive();
		
	if(isset($_GET['yourname']))	{
		if(!empty($_GET['yourname']))	{
			$yourname = $_GET['yourname'];
		}
	}
	
	if(isset($_GET['youremail']))	{
		if(!empty($_GET['youremail']))	{
			$youremail = $_GET['youremail'];
		}
	}
	
	if(isset($_GET['subject']))	{
		if(!empty($_GET['subject']))	{
			$subject = $_GET['subject'];
		}
	}
	
	if(isset($_GET['message']))	{
		if(!empty($_GET['message']))	{
				$message = trim($_GET['message']);
		}
	}
	
	if(!filter_var("$youremail", FILTER_VALIDATE_EMAIL))	{
		$msgheader = "Invalid E-Mail Address";
		$msgbody = "You did not submit a valid email address.";
		header("Location: menutemplate.php?process=message.php&msgheader=$msgheader&msgbody=$msgbody");
		return;
	}
 
	if(isset($_GET['msgheader']))	{
		if(!empty($_GET['msgheader']))	{
				$msgheader = $_GET['msgheader'];
		}	else	{
				$msgheader = "Thank you for sending us a message.";
		}
	}	else	{
			$msgheader = "Thank you for sending us a message.";
	}
	
	if(isset($_GET['msgbody']))	{
		if(!empty($_GET['msgbody']))	{
			$msgbody = $_GET['msgbody'];
		}	else	{
			$msgbody = "We appreciate you filling up our mailbox.";
		}
	}	else	{
		$msgbody = "We appreciate you filling up our mailbox.";
	}
	
	$os = substr(strtolower(php_uname('s')), 0, 3);
	$subject = "**voteoften.org** $subject";
	
	//I don't know why but I have to do this.  The define doesn't like $ before the variables and
	//the $sendstring doesn't like to work with variables that don't have a $ before them.
	$to = to;
	$smtp = smtp;
	$gmailid = gmailid;
	$gmailpw = gmailpw;
	
	switch($os) {
		case "win":
			$message = "$message\\n" . "$yourname";
			$sendstring = "-f $youremail -t $to -s $smtp -xu $gmailid -xp $gmailpw -u $subject -m $message";
			$fp = popen ("c:\\email\\sendemail.exe $sendstring","w");
			fwrite ($fp,"$sendstring");
			pclose ($fp);			
			break;
		case "lin":
			$headers = "From:" . $youremail;
			//$message = "$message -- $yourname";
			$message = "$message";
			if (mail($to, $subject, $message, $headers))	{
			}	else	{
					$msgheader = "The message was not delivered.";
					$msgbody = "I don't know what to say...the problem could be on my end but maybe not.";
				return;
			}
			break;
	}

	header("Location: menutemplate.php?process=message.php&msgheader=$msgheader&msgbody=$msgbody");
	
?>
