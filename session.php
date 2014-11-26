<?php

   session_id("--LOGIN--");
	session_start();
   
   echo "First session id: " . session_id() . "<br/>";
   
   if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
       // last request was more than 30 minates ago
       session_destroy();   // destroy session data in storage
       session_unset();     // unset $_SESSION variable for the runtime
   }
   $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
   echo "First LAST_ACTIVITY: " . $_SESSION['LAST_ACTIVITY'] . "<br/>";
   
   if (!isset($_SESSION['CREATED'])) {
       $_SESSION['CREATED'] = time();
   } else if (time() - $_SESSION['CREATED'] > 1800) {
       // session started more than 30 minates ago
       session_regenerate_id(true);    // change session ID for the current session an invalidate old session ID
       $_SESSION['CREATED'] = time();  // update creation time
   }
   
   session_regenerate_id(true);
   echo "Updated LAST_ACTIVITY: " . $_SESSION['LAST_ACTIVITY'] . "<br/>";
   echo "Second session id: " . session_id() . "<br/>";

?>