<?php

/*
This is the database connection string.  Put is somewhere outside of the web
server directory structure.
For Example:
If the web server file system is in /var/www, www is the root of the domain.
From accessing the web site via wget or with a browser, you can only look at
files in /var/www and below.
Therefore, put this file in /var.

Make the permissions readable by the username that owns the web server process.
To load this file use require_once.
Example (Linux):    require_once("/var/db_connect.php.php");
Example (Windows):  require_once("c:/wamp/db_connect.php.php");
*/

//                hostname,    username,    password, database   
//@ $db=new mysqli('localhost', 'root', '', 'voteoften');
define('dbhost', 'localhost');
define('dbuser', '');
define('dbpwd', '');
define('dbname', 'voteoften');

?>
