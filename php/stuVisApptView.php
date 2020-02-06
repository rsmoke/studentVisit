<?php
//This is called by the studentVisit.js to populate the div containing the student appontments for the logged in user
//	the result of the query builds an array that is JSON encoded and returned to the calling function for iteration.
// Requires a variable email. returns JSON encoded array of appointments.
  require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/configStudentVisit.php");
  require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/basicLib.php");

  session_start();

  if (isset($_SESSION['stuVisUsername'] )){
	$userName = $_SESSION['stuVisUsername'];

	$queryApptlst = "SELECT * FROM vw_appt WHERE studentName = '$userName' ORDER BY appDate, startTime";

	$resApptlst = $db->query($queryApptlst);
	$resultApptlst = array();

	if (!$resApptlst){
		die("Database query failed.");
		}
	while($items = $resApptlst->fetch_array(MYSQLI_ASSOC)){
		$appointment = new DateTime($items["appDate"] . " " . $items["startTime"]);
		array_push($resultApptlst, array('apptid' =>$items["apptid"],'facFname' =>$items["fname"],'facLname' =>$items["lname"],'facUniq' =>$items["uniqname"],'appTime' =>$appointment->format('g:ia \o\n F jS'), 'roomLoc' =>$items["roomLoc"]));
	}

	echo (json_encode($resultApptlst));

	$db->close();
	} else {
		redirect_to('../index.php');
	}
