<?php
/*  Thought of the Day: Sept 20, 2011
    The next life is determined by how generous we are in this one,
    how much compassion we show, not by the extent to which we're
    bent by market forces.
*/

//alter table userlogin auto_increment = 1
//alter table userprofile1 auto_increment = 1

class Utilities {
   // property declaration
   public $var = '';

public function keep_alive() {
	session_regenerate_id(true);
	
	if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
       // last request was more than 30 minutes ago
       session_destroy();   // destroy session data in storage
       session_unset();     // unset $_SESSION variable for the runtime
		 header('Location: logout.php');
   }
   $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
	
	if (!isset($_SESSION['CREATED'])) {
       $_SESSION['CREATED'] = time();
   } else if (time() - $_SESSION['CREATED'] > 1800) {
       // session started more than 30 minutes ago
       session_regenerate_id(true);    // change session ID for the current session an invalidate old session ID
       $_SESSION['CREATED'] = time();  // update creation time
   }
}

public function loggedin()	{
	$logged = FALSE;
	if(!isset($_SESSION['login']))	{	//Not logged in.
		if(!empty($_SESSION['login']))	{
			$logged = FALSE;
		}	else	{
			$logged = FALSE;
		}
			$logged = FALSE;
	}	else	{
			$logged = TRUE;
	}
	return $logged;
}

public function zgender($option = NULL)  {
	$sel1 = '<select class="element select medium" id="gender" name="gender">';
	$opt1 = '<option value="';	//Now add genderid
	$opt2 = '" >';					//Now add gendername
	$opt3 = '</option>';
	$sel2 = '</select>';
	$result = $sel1;

      require_once($_SESSION['utils']);
      $util = new Utilities();
      require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
         }

		$query = "select genderid, gendername from zgender";
      $stmt = $db->query($query);
      $num_results=$stmt->num_rows;

      if($num_results > 0) {
			for($i=0; $i<$num_results; $i++)	{
				$row=$stmt->fetch_assoc();
					$genderid = htmlspecialchars(stripslashes($row['genderid']));
					$gendername = htmlspecialchars(stripslashes($row['gendername']));
					if($option == "0")	{
						if($genderid==1)	{
							$gendername = "All";
						}
					}
					$result .= $opt1 . $genderid . $opt2 . $gendername . $opt3;
			}
		}
		$result .= $sel2;		//Now close the select statement
		return $result;
	}

public function zidentify($option = NULL)  {
	$sel1 = '<select class="element select medium" id="identify" name="identify">';
	$opt1 = '<option value="';	//Now add incomeid
	$opt2 = '" >';					//Now add incomename
	$opt3 = '</option>';
	$sel2 = '</select>';
	$result = $sel1;

      require_once($_SESSION['utils']);
      $util = new Utilities();
      require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
         }

		$query = "select identifyid, identifyname from zidentify";
      $stmt = $db->query($query);
      $num_results=$stmt->num_rows;

      if($num_results > 0) {
			for($i=0; $i<$num_results; $i++)	{
				$row=$stmt->fetch_assoc();
					$identifyid = htmlspecialchars(stripslashes($row['identifyid']));
					$identifyname = htmlspecialchars(stripslashes($row['identifyname']));
					if($option == "0")	{
						if($identifyid==1)	{
							$identifyname = "All";
						}
					}
					$result .= $opt1 . $identifyid . $opt2 . $identifyname . $opt3;
			}
		}
		$result .= $sel2;		//Now close the select statement
		return $result;
	}

public function zidentifycb($option = NULL)  {
	/*
		<input id="Conservative" name="Conservative" class="element checkbox" type="checkbox" value="1" />
		<label class="choice" for="Conservative">Conservative</label>
	*/
	$cb1 = '<input id="';	//put identifyid here
	$cb2 = '" name="';		//put identifyid here
	$cb3 = '" class="element checkbox" type="checkbox" value="1" />';
	$lb1 = '<label class="choice" for="';	//put identifyname here
	$lb2 = '">';			//put identifyname here
	$lb3 = '</label>';
	$result = "";
	
      require_once($_SESSION['utils']);
      $util = new Utilities();
      require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
         }

		$query = "select identifyid, identifyname from zidentify";
      $stmt = $db->query($query);
      $num_results=$stmt->num_rows;

      if($num_results > 0) {
			for($i=0; $i<$num_results; $i++)	{
				$row=$stmt->fetch_assoc();
					$identifyid = htmlspecialchars(stripslashes($row['identifyid']));
					$identifyname = htmlspecialchars(stripslashes($row['identifyname']));
					$result .= $cb1 . $identifyname . $cb2 . $identifyname . $cb3 . $lb1 . $identifyname . $lb2 . $identifyname . $lb3;
			}
		}
		return $result;
	}
	
public function zincome($option = NULL)  {
	$sel1 = '<select class="element select medium" id="income" name="income">';
	$opt1 = '<option value="';	//Now add incomeid
	$opt2 = '" >';					//Now add incomename
	$opt3 = '</option>';
	$sel2 = '</select>';
	$result = $sel1;

      require_once($_SESSION['utils']);
      $util = new Utilities();
      require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
         }

		$query = "select incomeid, incomename from zincome";
      $stmt = $db->query($query);
      $num_results=$stmt->num_rows;

      if($num_results > 0) {
			for($i=0; $i<$num_results; $i++)	{
				$row=$stmt->fetch_assoc();
					$incomeid = htmlspecialchars(stripslashes($row['incomeid']));
					$incomename = htmlspecialchars(stripslashes($row['incomename']));
					if($option == "0")	{
						if($incomeid==1)	{
							$incomename = "All";
						}
					}
					$result .= $opt1 . $incomeid . $opt2 . $incomename . $opt3;
			}
		}
		$result .= $sel2;		//Now close the select statement
		return $result;
	}

public function zpoliticalparty($option = NULL)  {
	$sel1 = '<select class="element select medium" id="politicalparty" name="politicalparty">';
	$opt1 = '<option value="';	//Now add politicalpartyid
	$opt2 = '" >';					//Now add politicalpartyname
	$opt3 = '</option>';
	$sel2 = '</select>';
	$result = $sel1;

      require_once($_SESSION['utils']);
      $util = new Utilities();
      require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
         }

		$query = "select politicalpartyid, politicalpartyname from zpoliticalparty";
      $stmt = $db->query($query);
      $num_results=$stmt->num_rows;

      if($num_results > 0) {
			for($i=0; $i<$num_results; $i++)	{
				$row=$stmt->fetch_assoc();
					$politicalpartyid = htmlspecialchars(stripslashes($row['politicalpartyid']));
					$politicalpartyname = htmlspecialchars(stripslashes($row['politicalpartyname']));
					if($option == "0")	{
						if($politicalpartyid==1)	{
							$politicalpartyname = "All";
						}
					}
					$result .= $opt1 . $politicalpartyid . $opt2 . $politicalpartyname . $opt3;
			}
		}
		$result .= $sel2;		//Now close the select statement
		return $result;
	}

public function zrace($option = NULL)  {
	$sel1 = '<select class="element select medium" id="race" name="race">';
	$opt1 = '<option value="';	//Now add raceid
	$opt2 = '" >';					//Now add racename
	$opt3 = '</option>';
	$sel2 = '</select>';
	$result = $sel1;

      require_once($_SESSION['utils']);
      $util = new Utilities();
      require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
         }

		$query = "select raceid, racename from zrace";
      $stmt = $db->query($query);
      $num_results=$stmt->num_rows;

      if($num_results > 0) {
			for($i=0; $i<$num_results; $i++)	{
				$row=$stmt->fetch_assoc();
					$raceid = htmlspecialchars(stripslashes($row['raceid']));
					$racename = htmlspecialchars(stripslashes($row['racename']));
					if($option == "0")	{
						if($raceid==1)	{
							$racename = "All";
						}
					}
					$result .= $opt1 . $raceid . $opt2 . $racename . $opt3;
			}
		}
		$result .= $sel2;		//Now close the select statement
		return $result;
	}

public function zreligion($option = NULL)  {
	$sel1 = '<select class="element select medium" id="religion" name="religion">';
	$opt1 = '<option value="';	//Now add religionid
	$opt2 = '" >';					//Now add religionname
	$opt3 = '</option>';
	$sel2 = '</select>';
	$result = $sel1;

      require_once($_SESSION['utils']);
      $util = new Utilities();
      require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
         }

		$query = "select religionid, religionname from zreligion";
      $stmt = $db->query($query);
      $num_results=$stmt->num_rows;

      if($num_results > 0) {
			for($i=0; $i<$num_results; $i++)	{
				$row=$stmt->fetch_assoc();
					$religionid = htmlspecialchars(stripslashes($row['religionid']));
					$religionname = htmlspecialchars(stripslashes($row['religionname']));
					if($option == "0")	{
						if($religionid==1)	{
							$religionname = "All";
						}
					}
					$result .= $opt1 . $religionid . $opt2 . $religionname . $opt3;
			}
		}
		$result .= $sel2;		//Now close the select statement
		return $result;
	}

	function getdistrict($zipcode)  {
      require_once($_SESSION['utils']);
      $util = new Utilities();
      /* Connect to database. */
      require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
         }

		$query = "select district1 from congressionaldistricts where zipcode = '" .$zipcode. "'";
      $stmt = $db->query($query);
      $num_results=$stmt->num_rows;

      if($num_results == 1) {
			for($i=0; $i<$num_results; $i++)	{
				$row=$stmt->fetch_assoc();
					$_SESSION['district'] = htmlspecialchars(stripslashes($row['district1']));
			}
		}	else	{
				$_SESSION['district'] = 0;
		}
	}

	function relatedemo($demographic, $userid)	{
		$did = $demographic . "id";
		$dname = $demographic . "name";
		$zdb = "z" . $demographic;
		
		@ $db=new mysqli('localhost', 'root', '', 'voteoften');
		require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
         }
			
		$query = "select $dname from $zdb where $did = (select $demographic from userprofile1 where userid=" . $userid . ")";
		$stmt = $db->query($query);
      $num_results=$stmt->num_rows;
		if($num_results > 0) {
			for($i=0; $i<$num_results; $i++)	{
				$row=$stmt->fetch_assoc();
					$_SESSION['$demographic'] = htmlspecialchars(stripslashes($row["$dname"]));
			}
		}
		return $_SESSION['$demographic'];
	}
	


	function load_profile_session_info($userid)  {
   /* Find out if they already have a user profile */
      require_once($_SESSION['utils']);
      $util = new Utilities();
      /* Connect to database. */
      require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
         }

		//Relate Gender
      $query = 'select gendername from zgender where genderid = (select gender from userprofile1 where userid=' . $userid . ')';
		$stmt = $db->query($query);
      $num_results=$stmt->num_rows;
		if($num_results == 1) {
			for($i=0; $i<$num_results; $i++)	{
				$row=$stmt->fetch_assoc();
					$_SESSION['gender'] = htmlspecialchars(stripslashes($row['gendername']));
			}
		}
		
		//Relate Religion
		$query = 'select religionname from zreligion where religionid = (select religion from userprofile1 where userid=' . $userid . ')';
		$stmt = $db->query($query);
      $num_results=$stmt->num_rows;
		if($num_results == 1) {
			for($i=0; $i<$num_results; $i++)	{
				$row=$stmt->fetch_assoc();
					$_SESSION['religion'] = htmlspecialchars(stripslashes($row['religionname']));
			}
		}
		
		//Relate Race
		$query = 'select racename from zrace where raceid = (select race from userprofile1 where userid=' . $userid . ')';
		$stmt = $db->query($query);
      $num_results=$stmt->num_rows;
		if($num_results == 1) {
			for($i=0; $i<$num_results; $i++)	{
				$row=$stmt->fetch_assoc();
					$_SESSION['race'] = htmlspecialchars(stripslashes($row['racename']));
			}
		}

		//Relate PoliticalParty
		$query = 'select politicalpartyname from zpoliticalparty where politicalpartyid = (select politicalparty from userprofile1 where userid=' . $userid . ')';
		$stmt = $db->query($query);
      $num_results=$stmt->num_rows;
		if($num_results == 1) {
			for($i=0; $i<$num_results; $i++)	{
				$row=$stmt->fetch_assoc();
					$_SESSION['politicalparty'] = htmlspecialchars(stripslashes($row['politicalpartyname']));
			}
		}
		
		//Relate Income
		$query = 'select incomename from zincome where incomeid = (select income from userprofile1 where userid=' . $userid . ')';
		$stmt = $db->query($query);
      $num_results=$stmt->num_rows;
		if($num_results == 1) {
			for($i=0; $i<$num_results; $i++)	{
				$row=$stmt->fetch_assoc();
					$_SESSION['income'] = htmlspecialchars(stripslashes($row['incomename']));
			}
		}

		$query = 'select a.userid, a.loginname, a.zipcode, b.* from userlogin as a, userprofile1 as b where a.userid = b.userid and a.userid= ' . $userid;
      $stmt = $db->query($query);
      $num_results=$stmt->num_rows;

      if($num_results == 1) {
			for($i=0; $i<$num_results; $i++)	{
				$row=$stmt->fetch_assoc();
					$_SESSION['userid'] = htmlspecialchars(stripslashes($row['userid']));
					$_SESSION['login'] = htmlspecialchars(stripslashes($row['loginname']));
					$_SESSION['zipcode'] = htmlspecialchars(stripslashes($row['zipcode']));
					//$_SESSION['gender'] = htmlspecialchars(stripslashes($row['gender']));
					//$_SESSION['religion'] = htmlspecialchars(stripslashes($row['religion']));
					//$_SESSION['race'] = htmlspecialchars(stripslashes($row['race']));
					//$_SESSION['politicalparty'] = htmlspecialchars(stripslashes($row['politicalparty']));
					$_SESSION['dateofbirth'] = htmlspecialchars(stripslashes($row['dateofbirth']));
					//$_SESSION['income'] = htmlspecialchars(stripslashes($row['income']));
					$_SESSION['conservative'] = htmlspecialchars(stripslashes($row['conservative']));
					$_SESSION['liberal'] = htmlspecialchars(stripslashes($row['liberal']));
					$_SESSION['religious'] = htmlspecialchars(stripslashes($row['religious']));
					$_SESSION['rightwing'] = htmlspecialchars(stripslashes($row['rightwing']));
					$_SESSION['leftwing'] = htmlspecialchars(stripslashes($row['leftwing']));
					$_SESSION['inthemiddle'] = htmlspecialchars(stripslashes($row['inthemiddle']));
					$_SESSION['fiscallyconservative'] = htmlspecialchars(stripslashes($row['fiscallyconservative']));
					$_SESSION['antibiggovernment'] = htmlspecialchars(stripslashes($row['antibiggovernment']));
					$_SESSION['wealthy'] = htmlspecialchars(stripslashes($row['wealthy']));
					$_SESSION['middleclass'] = htmlspecialchars(stripslashes($row['middleclass']));
					$_SESSION['poor'] = htmlspecialchars(stripslashes($row['poor']));
					$_SESSION['profreespeech'] = htmlspecialchars(stripslashes($row['profreespeech']));
					$_SESSION['proowningfirearms'] = htmlspecialchars(stripslashes($row['proowningfirearms']));
					$_SESSION['prochoice'] = htmlspecialchars(stripslashes($row['prochoice']));
					$_SESSION['antifreespeech'] = htmlspecialchars(stripslashes($row['antifreespeech']));
					$_SESSION['againstowningfirearms'] = htmlspecialchars(stripslashes($row['againstowningfirearms']));
					$_SESSION['prolife'] = htmlspecialchars(stripslashes($row['prolife']));
					$_SESSION['citydweller'] = htmlspecialchars(stripslashes($row['citydweller']));
					$_SESSION['ruraldweller'] = htmlspecialchars(stripslashes($row['ruraldweller']));
			}
		}
	}
	
	function view_profile_session_info()  {
		//echo("userid: " . $_SESSION['userid'] . "<br/>");
		echo("login: " . $_SESSION['login'] . "<br/>");
		echo("zip code: " . $_SESSION['zipcode'] . "<br/>");
		echo("gender: " . $_SESSION['gender'] . "<br/>");
		echo("religion: " . $_SESSION['religion'] . "<br/>");
		echo("race: " . $_SESSION['race'] . "<br/>");
		echo("politicalparty: " . $_SESSION['politicalparty'] . "<br/>");
		echo("dateofbirth: " . date('Y-m-d', $_SESSION['dateofbirth']) . "<br/>");
		echo("income: " . $_SESSION['income'] . "<br/>");
		echo($_SESSION['conservative'] ? "conservative: TRUE<br/>" : "conservative: FALSE<br/>");
		echo($_SESSION['liberal'] ? "liberal: TRUE<br/>" : "liberal: FALSE<br/>");
		echo($_SESSION['religious'] ? "religious: TRUE<br/>" : "religious: FALSE<br/>");
		echo($_SESSION['rightwing'] ? "rightwing: TRUE<br/>" : "rightwing: FALSE<br/>");
		echo($_SESSION['leftwing'] ? "leftwing: TRUE<br/>" : "leftwing: FALSE<br/>");
		echo($_SESSION['inthemiddle'] ? "inthemiddle: TRUE<br/>" : "inthemiddle: FALSE<br/>");
		echo($_SESSION['fiscallyconservative'] ? "fiscallyconservative: TRUE<br/>" : "fiscallyconservative: FALSE<br/>");
		echo($_SESSION['antibiggovernment'] ? "antibiggovernment: TRUE<br/>" : "antibiggovernment: FALSE<br/>");
		echo($_SESSION['wealthy'] ? "wealthy: TRUE<br/>" : "wealthy: FALSE<br/>");
		echo($_SESSION['middleclass'] ? "middleclass: TRUE<br/>" : "middleclass: FALSE<br/>");
		echo($_SESSION['poor'] ? "poor: TRUE<br/>" : "poor: FALSE<br/>");
		echo($_SESSION['profreespeech'] ? "profreespeech: TRUE<br/>" : "profreespeech: FALSE<br/>");
		echo($_SESSION['proowningfirearms'] ? "proowningfirearms: TRUE<br/>" : "proowningfirearms: FALSE<br/>");
		echo($_SESSION['prochoice'] ? "prochoice: TRUE<br/>" : "prochoice: FALSE<br/>");
		echo($_SESSION['antifreespeech'] ? "antifreespeech: TRUE<br/>" : "antifreespeech: FALSE<br/>");
		echo($_SESSION['againstowningfirearms'] ? "againstowningfirearms: TRUE<br/>" : "againstowningfirearms: FALSE<br/>");
		echo($_SESSION['prolife'] ? "prolife: TRUE<br/>" : "prolife: FALSE<br/>");
		echo($_SESSION['citydweller'] ? "citydweller: TRUE<br/>" : "citydweller: FALSE<br/>");
		echo($_SESSION['ruraldweller'] ? "ruraldweller: TRUE<br/>" : "ruraldweller: FALSE<br/>");
	}
	
	function clear_profile_session_info()  {
		$_SESSION['login'] = "";
		$_SESSION['gender'] = "";
		$_SESSION['zipcode'] = "";
		$_SESSION['religion'] = "";
		$_SESSION['race'] = "";
		$_SESSION['politicalparty'] = "";
		$_SESSION['dateofbirth'] = "";
		$_SESSION['income'] = "";
		$_SESSION['conservative'] = "";
		$_SESSION['liberal'] = "";
		$_SESSION['religious'] = "";
		$_SESSION['rightwing'] = "";
		$_SESSION['leftwing'] = "";
		$_SESSION['inthemiddle'] = "";
		$_SESSION['fiscallyconservative'] = "";
		$_SESSION['antibiggovernment'] = "";
		$_SESSION['wealthy'] = "";
		$_SESSION['middleclass'] = "";
		$_SESSION['poor'] = "";
		$_SESSION['profreespeech'] = "";
		$_SESSION['proowningfirearms'] = "";
		$_SESSION['prochoice'] = "";
		$_SESSION['antifreespeech'] = "";
		$_SESSION['againstowningfirearms'] = "";
		$_SESSION['prolife'] = "";
		$_SESSION['citydweller'] = "";
		$_SESSION['ruraldweller'] = "";
	}
	
	function unset_profile_session_info()  {
		unset($_SESSION['userid']);
		unset($_SESSION['login']);
		unset($_SESSION['zipcode']);
		unset($_SESSION['gender']);
		unset($_SESSION['religion']);
		unset($_SESSION['race']);
		unset($_SESSION['politicalparty']);
		unset($_SESSION['dateofbirth']);
		unset($_SESSION['income']);
		unset($_SESSION['conservative']);
		unset($_SESSION['liberal']);
		unset($_SESSION['religious']);
		unset($_SESSION['rightwing']);
		unset($_SESSION['leftwing']);
		unset($_SESSION['inthemiddle']);
		unset($_SESSION['fiscallyconservative']);
		unset($_SESSION['antibiggovernment']);
		unset($_SESSION['wealthy']);
		unset($_SESSION['middleclass']);
		unset($_SESSION['poor']);
		unset($_SESSION['profreespeech']);
		unset($_SESSION['proowningfirearms']);
		unset($_SESSION['prochoice']);
		unset($_SESSION['antifreespeech']);
		unset($_SESSION['againstowningfirearms']);
		unset($_SESSION['prolife']);
		unset($_SESSION['citydweller']);
		unset($_SESSION['ruraldweller']);
	}
	
	public function isInfo($testval)  {
	// This tests $testval to see if it exists and if it does, if it is empty.
		$util = new Utilities();
      $bool = FALSE;
		
		if(isset($testval))	{
			if(!empty($testval))	{
				$bool = TRUE;
			}
		}
	return $bool;
   }

	//Generates the current date time stamp as a string. Looks like: 2011-08-02 15:36:17
   public function now()   {
      return date('Y-m-d H:i:s');
   }

	public function hash_password($password)   {
      require_once($_SESSION['utils']);
      $util = new Utilities();
   		$password = sha1($password . $util::salty());
      return $password;
   }
	
	public function unhash_password($password)   {
      require_once($_SESSION['utils']);
      $util = new Utilities();
   		$password = sha1($password . $util::salty());
      return $password;
   }
	
	public function salty()   {
		/*
			You only want to set this one time unless you plan on updating every
			password in the table when you do make a change because they are all
			writtin as (typed in password) + ($salt);
		*/
		
		$salt = "S*yEprMbS_jr_swish_with_tha_threeeeee";
      return $salt;
   }

}

?>
