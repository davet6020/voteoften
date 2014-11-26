<?php
   include "libchart/classes/libchart.php";

   if(!isset($_SESSION['login']))	{
   	if(empty($_SESSION['login']))	{
   		$allvoters = 2;
   	}
   	$allvoters = 2;
   }
   
   $electionid = htmlspecialchars($_POST['electionid']);
   $electionname = get_electionname($electionid);
   $gender = htmlspecialchars($_POST['gender']);
   $religion = htmlspecialchars($_POST['religion']);
   $race = htmlspecialchars($_POST['race']);
   $politicalparty = htmlspecialchars($_POST['politicalparty']);
   $income = htmlspecialchars($_POST['income']);
   $totalcompetitors = get_numcompetitors($electionid);
   
   if(!isset($_POST['Conservative'])) {
			$conservative = 0;
	}	else	{
			$conservative = $_POST['Conservative'];	
	}
	if(!isset($_POST['Liberal'])) {
			$liberal = 0;
	}	else	{
			$liberal = $_POST['Liberal'];	
	}
	if(!isset($_POST['Religious'])) {
			$religious = 0;
	}	else	{
			$religious = $_POST['Religious'];	
	}
	if(!isset($_POST['Right_Wing'])) {
			$rightwing = 0;
	}	else	{
			$rightwing = $_POST['Right_Wing'];	
	}
	if(!isset($_POST['Left_Wing'])) {
			$leftwing = 0;
	}	else	{
			$leftwing = $_POST['Left_Wing'];	
	}
	if(!isset($_POST['In_The_middle'])) {
			$inthemiddle = 0;
	}	else	{
			$inthemiddle = $_POST['In_The_middle'];	
	}
	if(!isset($_POST['Fiscally_Conservative'])) {
			$fiscallyconservative = 0;
	}	else	{
			$fiscallyconservative = $_POST['Fiscally_Conservative'];	
	}
	if(!isset($_POST['Anti_Big_Government'])) {
			$antibiggovernment = 0;
	}	else	{
			$antibiggovernment = $_POST['Anti_Big_Government'];	
	}
	if(!isset($_POST['Wealthy'])) {
			$wealthy = 0;
	}	else	{
			$wealthy = $_POST['Wealthy'];	
	}
	if(!isset($_POST['Middle_Class'])) {
			$middleclass = 0;
	}	else	{
			$middleclass = $_POST['Middle_Class'];	
	}
	if(!isset($_POST['Poor'])) {
			$poor = 0;
	}	else	{
			$poor = $_POST['Poor'];	
	}
	if(!isset($_POST['Pro_Free_Speech'])) {
			$profreespeech = 0;
	}	else	{
			$profreespeech = $_POST['Pro_Free_Speech'];	
	}
	if(!isset($_POST['Pro_Owning_Firearms'])) {
			$proowningfirearms = 0;
	}	else	{
			$proowningfirearms = $_POST['Pro_Owning_Firearms'];	
	}
	if(!isset($_POST['Pro_Choice'])) {
			$prochoice = 0;
	}	else	{
			$prochoice = $_POST['Pro_Choice'];	
	}
	if(!isset($_POST['Pro_Life'])) {
			$prolife = 0;
	}	else	{
			$prolife = $_POST['Pro_Life'];	
	}
	if(!isset($_POST['Anti_Free_Speech'])) {
			$antifreespeech = 0;
	}	else	{
			$antifreespeech = $_POST['Anti_Free_Speech'];	
	}
	if(!isset($_POST['Against_Owning_Firearms'])) {
			$againstowningfirearms = 0;
	}	else	{
			$againstowningfirearms = $_POST['Against_Owning_Firearms'];	
	}
	if(!isset($_POST['City_Dweller'])) {
			$citydweller = 0;
	}	else	{
			$citydweller = $_POST['City_Dweller'];	
	}
	if(!isset($_POST['Rural_Dweller'])) {
			$ruraldweller = 0;
	}	else	{
			$ruraldweller = $_POST['Rural_Dweller'];	
	}
   

   get_htav($electionid, $electionname, $gender, $religion, $race, $politicalparty, $income, $totalcompetitors,
            $conservative, $liberal, $religious, $rightwing, $leftwing, $inthemiddle, $fiscallyconservative,
            $antibiggovernment, $wealthy, $middleclass, $poor, $profreespeech, $proowningfirearms, $prochoice, 
            $prolife, $antifreespeech, $againstowningfirearms, $citydweller, $ruraldweller, $allvoters);


   function get_htav($electionid, $electionname, $gender, $religion, $race, $politicalparty, $income, $totalcompetitors,
                     $conservative, $liberal, $religious, $rightwing, $leftwing, $inthemiddle, $fiscallyconservative,
                     $antibiggovernment, $wealthy, $middleclass, $poor, $profreespeech, $proowningfirearms, $prochoice, 
                     $prolife, $antifreespeech, $againstowningfirearms, $citydweller, $ruraldweller, $allvoters)  {
      //$chart = new HorizontalBarChart(500, 170);
   	$chart = new HorizontalBarChart(500, 400);
      $dataSet = new XYDataSet();
      require_once($_SESSION['utils']);
      $util = new Utilities();
      /* Connect to database. */
      require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
         }

      //For Demographics
      $gparm = ($gender > 1)? "=".$gender: ">1";
      $rparm1 = ($religion > 1)? "=".$religion: ">1";
      $rparm2 = ($race > 1)? "=".$race: ">1";
      $pparm = ($politicalparty > 1)? "=".$politicalparty: ">1";
      $iparm = ($income > 1)? "=".$income: ">1";
      
      //For Personal Identifiers
      $conservativeparm = ($conservative == 1)? "=1": "=0";
      $liberalparm = ($liberal == 1)? "=1": "=0";
      $religiousparm = ($religious == 1)? "=1": "=0";
      $rightwingparm = ($rightwing == 1)? "=1": "=0";
      $leftwingparm = ($leftwing == 1)? "=1": "=0";
      $inthemiddleparm = ($inthemiddle == 1)? "=1": "=0";
      $fiscallyconservativeparm = ($fiscallyconservative == 1)? "=1": "=0";
      $antibiggovernmentparm = ($antibiggovernment ==1)? "=1": "=0";
      $wealthyparm = ($wealthy == 1)? "=1": "=0";
      $middleclassparm = ($middleclass == 1)? "=1": "=0";
      $poorparm = ($poor == 1)? "=1": "=0";
      $profreespeechparm = ($profreespeech == 1)? "=1": "=0";
      $proowningfirearmsparm = ($proowningfirearms == 1)? "=1": "=0";
      $prochoiceparm = ($prochoice == 1)? "=1": "=0";
      $prolifeparm = ($prolife == 1)? "=1": "=0";
      $antifreespeechparm = ($antifreespeech == 1)? "=1": "=0";
      $againstowningfirearmsparm = ($againstowningfirearms  == 1)? "=1": "=0";
      $citydwellerparm = ($citydweller == 1)? "=1": "=0";
      $ruraldwellerparm = ($ruraldweller == 1)? "=1": "=0";
   
      //if($_SESSION['allvoters'] == 2)	{
      if($allvoters == 2)	{
      	/*
      	 * world viewable ballot so more than just you show up on the list.
      	* gotta figure out how to get you plus guest id's only.
      	* No I don't because it's world viewable so anyone including voteoften users can vote for it.
      	*/
	      	$query = "select competitor, count(competitor) as count
	      	from votescast as v
	      	where v.electionid = $electionid
	      	group by competitor";
      }	else	{
	      	$query = "select competitor, count(competitor) as count
	      	from votescast as v, userprofile1 as u
	      	where v.electionid = $electionid and v.userid = u.userid
	      	and u.gender $gparm and u.religion $rparm1 and u.race $rparm2
	      	and u.politicalparty $pparm and u.income $iparm
	      	group by competitor";
      }
         
         /*
         and u.conservative $conservativeparm
         and u.liberal $liberalparm
         and u.religious $religiousparm
         and u.rightwing $rightwingparm
         and u.leftwing $leftwingparm
         and u.inthemiddle $inthemiddleparm
         and u.fiscallyconservative $fiscallyconservativeparm
         and u.antibiggovernment $antibiggovernmentparm
         and u.wealthy $wealthyparm
         and u.middleclass $middleclassparm
         and u.poor $poorparm
         and u.profreespeech $profreespeechparm
         and u.proowningfirearms $proowningfirearmsparm
         and u.prochoice $prochoiceparm
         and u.prolife $prolifeparm
         and u.antifreespeech $antifreespeechparm
         and u.againstowningfirearms $againstowningfirearmsparm
         and u.citydweller $citydwellerparm
         and u.ruraldweller $ruraldwellerparm
         */

      
      //echo $query;
      
      $stmt = $db->query($query);
      $num_results=$stmt->num_rows;
      $votedcompetitors = array();

      if($num_results > 0) {
         for($i=0; $i<$num_results; $i++)	{
            $row=$stmt->fetch_assoc();
               $dataSet->addPoint(new Point($row['competitor'] . " (" . $row['count'] . ")", $row['count']));
               array_push($votedcompetitors, $row['competitor']);
         }
            $thediff = array();
            $thediff = array_diff($totalcompetitors, $votedcompetitors);
               foreach($thediff as $key => $name){
                  $dataSet->addPoint(new Point($name . " (" . 0 . ")", 0));
               }
      }
      
      $chart->setDataSet($dataSet);
      $chart->setTitle("Votes you have cast for election: " . $electionname);
      $filename = "generated/" . $electionid . mt_rand() . ".png";
      $chart->render($filename);
      
      echo '<img src="' . $filename . '" class="centeredImage" />';
   }

   function get_electionname($electionid)   {
      require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
         }
      $query = "select electionname from electionlist_main where electionid = $electionid";
      $stmt = $db->query($query);
      $num_results=$stmt->num_rows;
   
      if($num_results > 0) {
         for($i=0; $i<$num_results; $i++)	{
            $row=$stmt->fetch_assoc();
               $electionname = $row['electionname'];
         }
      }
      return $electionname;
   }
   
   function get_numcompetitors($electionid) {
      require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
         }
      $query = "select count(competitor) as count from electionlist_sub where electionid = $electionid";
      $stmt = $db->query($query);
      $num_results=$stmt->num_rows;
   
      if($num_results > 0) {
         for($i=0; $i<$num_results; $i++)	{
            $row=$stmt->fetch_assoc();
               $totalnumcompetitors = $row['count'];
         }
      }
      
      if($num_results < $totalnumcompetitors)	{
         //Missing a competitor because nobody voted for it.
         $query = "select competitor from electionlist_sub where electionid = $electionid";
         $stmt = $db->query($query);
         $num_results=$stmt->num_rows;
         $totalcompetitors = array();
         
         if($num_results > 0) {
            for($i=0; $i<$num_results; $i++)	{
               $row=$stmt->fetch_assoc();
                  array_push($totalcompetitors, $row['competitor']);
            }
         }
      }
      return $totalcompetitors;
   }
   
   function get_htav_9($electionid, $electionname, $gender, $religion, $race, $politicalparty, $income, $totalcompetitors)  {
      $chart = new HorizontalBarChart(500, 170);
      $dataSet = new XYDataSet();
      require_once($_SESSION['utils']);
      $util = new Utilities();
      /* Connect to database. */
      require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
         }

      $gparm = ($gender > 1)? "=".$gender: ">1";
      $rparm1 = ($religion > 1)? "=".$religion: ">1";
      $rparm2 = ($race > 1)? "=".$race: ">1";
      $pparm = ($politicalparty > 1)? "=".$politicalparty: ">1";
      $iparm = ($income > 1)? "=".$income: ">1";
      
      $query = "select competitor, count(competitor) as count, gender, religion
         from votescast as v, userprofile1 as u
         where v.electionid = $electionid and v.userid = u.userid
         and u.gender $gparm and u.religion $rparm1 and u.race $rparm2
         and u.politicalparty $pparm and u.income $iparm
         group by competitor";
      
      $stmt = $db->query($query);
      $num_results=$stmt->num_rows;
      $votedcompetitors = array();

      if($num_results > 0) {
         for($i=0; $i<$num_results; $i++)	{
            $row=$stmt->fetch_assoc();
               $dataSet->addPoint(new Point($row['competitor'] . " (" . $row['count'] . ")", $row['count']));
               array_push($votedcompetitors, $row['competitor']);
         }
            $thediff = array();
            $thediff = array_diff($totalcompetitors, $votedcompetitors);
               foreach($thediff as $key => $name){
                  $dataSet->addPoint(new Point($name . " (" . 0 . ")", 0));
               }
      }
      
      $chart->setDataSet($dataSet);
      $chart->setTitle("Votes you have cast for election: " . $electionname);
      $filename = "generated/" . $electionid . mt_rand() . ".png";
      $chart->render($filename);
      
      //I added the view.css stylesheet to HorizontalBarChart.php at the bottom.
      echo '<img src="' . $filename . '" class="centeredImage" />';
      
      /*
      echo '
      <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<link rel="stylesheet" type="text/css" href="css/view.css" media="all">
		</head>
		<body>
			<img src="$filename" class="centeredImage" />
			<br/>
			<img id="bottom" src="images/bottom.png" alt="">
		</body>
		</html>
      ';
      */
      
   }
   
   
?>

