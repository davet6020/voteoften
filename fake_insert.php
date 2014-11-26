<?php
   $_SESSION['utils']="common/utilities.php";	//Program with common functions.
	
   session_start();
	require_once($_SESSION['utils']);
      $util = new Utilities();
		$util->keep_alive();

   /*
      mysql> desc sometable;
      +--------------+---------------+------+-----+---------+----------------+
      | Field        | Type          | Null | Key | Default | Extra          |
      +--------------+---------------+------+-----+---------+----------------+
      | pkey         | int(7)        | NO   | PRI | NULL    | auto_increment |
      | ballottype   | int(3)        | NO   |     | NULL    |                |
      | firstname    | varchar(50)   | YES  |     | NULL    |                |
      | lastname     | varchar(50)   | YES  |     | NULL    |                |
      | address1     | varchar(200)  | YES  |     | NULL    |                |
      | address2     | varchar(200)  | YES  |     | NULL    |                |
      | city         | varchar(100)  | YES  |     | NULL    |                |
      | state        | varchar(2)    | YES  |     | NULL    |                |
      | zip          | varchar(9)    | YES  |     | NULL    |                |
      | primaryphone | varchar(15)   | YES  |     | NULL    |                |
      | balance      | decimal(10,2) | YES  |     | NULL    |                |
      | comments     | text          | YES  |     | NULL    |                |
      | joindate     | bigint(255)   | YES  |     | NULL    |                |
      +--------------+---------------+------+-----+---------+----------------+
      13 rows in set (0.01 sec)
   */
   
   //These will be the defaults for now.
   $ballottype = 1;
   $firstname = "firstname" . rand();
   $lastname = "lastname" . rand();
   $address1 = "address1" . rand();
   $address2 = "address2" . rand();
   $city = "Denver";
   $state = "CO";
   $zip = "80218";
   $comments = "$ballottype, $firstname, $lastname, $address1, $address2, $city, $state, $zip";
   $joindate = mktime(0, 0, 0, date('m'), date('d'), date('Y'));


   insert_data($ballottype, $firstname, $lastname, $address1, $address2, $city, $state, $zip);
   

   function insert_data($ballottype, $firstname, $lastname, $address1, $address2, $city, $state, $zip)  {
      require_once($_SESSION['utils']);
      $util = new Utilities();
      /* Connect to database. */
      $db = new mysqli("localhost", "root", "", "test");
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
         }
    
      /* Insert the record here  */
      $query = "insert into sometable
               (ballottype, firstname, lastname, address1, address2, city, state, zip)
               values(?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = $db->prepare($query);
      $stmt->bind_param("isssssss", $ballottype, $firstname, $lastname, $address1, $address2, $city, $state, $zip);
      $stmt->execute();
      
      if($stmt->affected_rows > 0) {
            $new_ballot_id = mysqli_insert_id($db);
            echo "Inserted: $new_ballot_id<br/>";
      }   else	{
            echo 'Failed on insert_ballot_main(2).';
      }
      
      $stmt->close();
      $db->close();
   }
?>