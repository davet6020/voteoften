<?php

/*
This is the smtp connection string.  Put is somewhere outside of the web
server directory structure.
For Example:
If the web server file system is in /var/www, www is the root of the domain.
From accessing the web site via wget or with a browser, you can only look at
files in /var/www and below.
Therefore, put this file in /var.

Make the permissions readable by the username that owns the web server process.
To load this file use require_once.
Example (Linux):    require_once("/var/email_connect.php.php");
Example (Windows):  require_once("c:/wamp/email_connect.php.php");
*/

// $to is the mailbox the comments are sent to.
// $to = "davet6020@gmail.com";
   define('to', 'davet6020@gmail.com');
// $smtp is smtp server windows will use to transfer email.
// $smtp = "smtp.gmail.com:587";
   define('smtp', 'smtp.gmail.com:587');
// $gmailid is the gmail userid of the account being used to send the comments email.
// $gmailid = "davet6020@gmail.com";
      define('gmailid', 'davet6020@gmail.com');
// $gmailpw is the gmail password of the account being used to send the comments email.
// $gmailpw = "gr33nm3n";
      define('gmailpw', 'gr33nm3n');
?>
