<?php
	$_SESSION['utils']="common/utilities.php";	//Program with common functions.
	$_SESSION['dbopen']="../db_voteoften.php";
	require_once($_SESSION['dbopen']);
		@$db = new mysqli(dbhost, dbuser, dbpwd, dbname);
	require_once($_SESSION['utils']);
      $util = new Utilities();
		$util->keep_alive();

	include "libchart/classes/libchart.php";
   $chart = new HorizontalBarChart(500, 170);

	$dataSet = new XYDataSet();
	$dataSet->addPoint(new Point("/wiki/Instant_messenger", 50));
	$dataSet->addPoint(new Point("/wiki/Web_Browser", 83));
	$dataSet->addPoint(new Point("/wiki/World_Wide_Web", 142));
	$chart->setDataSet($dataSet);

	$chart->setTitle("Most visited pages for www.example.com");
	$chart->render("generated/demo2.png");
   
	
   if (mysqli_connect_errno()) {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
   }

	$zdb = 'z' . $demo;
	$zid = $demo . 'id';
	$zname = $demo . 'name';
	//select religionname, count(religionname) as count from zreligion, userprofile1 where religionid = religion group by religionname
	$query = 'select ' .$zname. ', count(' .$zname. ') as count from ' .$zdb. ', userprofile1 where ' .$zid. ' = ' .$demo. ' group by ' . $zname;
   $stmt = $db->query($query);
   $num_results=$stmt->num_rows;

   if($num_results > 0) {
		for($i=0; $i<$num_results; $i++)	{
			$row=$stmt->fetch_assoc();
				$dataSet->addPoint(new Point($row[$zname] . " (" . $row['count'] . ")", $row['count']));
		}
	}

	$chart->setDataSet($dataSet);

	$chart->setTitle("VoteOften.org User count by " . $demo);
	$filename = "generated/" . $demo . mt_rand() . ".png";
	$chart->render($filename);
   
   echo '<img src="' . $filename . '" class="image-center" />';

?>