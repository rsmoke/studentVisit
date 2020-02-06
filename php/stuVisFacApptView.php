<?php
//Select the available appointments from the tbl_facAppts for a specific faculty member.
//Requires a variable called name to be passed to it. Returns a JSON encoded array of available appointment times.
  require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/configStudentVisit.php");
  session_start();

$facName = htmlspecialchars($_GET['name']);


	$queryApptlst = "SELECT * FROM vw_appt WHERE uniqname = '$facName' AND studentName = '' ORDER BY appDate, startTime";

	$resApptlst = $db->query($queryApptlst);
	$resultApptlst = array();
	
	if (!$resApptlst){
		die("Database query failed.");
		}
	while($items = $resApptlst->fetch_assoc()){
		$appointment = new DateTime($items["appDate"] . " " . $items["startTime"]);
		array_push($resultApptlst, array('apptid' =>$items["apptid"],'appTime' =>$appointment->format('g:ia \o\n F jS')));
	}

	echo (json_encode($resultApptlst));

	$db->close();
