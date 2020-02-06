<?php
//This is called by the studentVisit.js to populate the checklist for the logged in user
//	the result of the query builds an array that is JSON encoded and returned to the calling function for iteration.
// Requires variable email. Returns JSON encoded array of checklist values.
  require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/configStudentVisit.php");
  require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/basicLib.php");

  session_start();

  if (isset($_SESSION['stuVisUsername'] )){
	$login = $_SESSION['stuVisUsername'];

	$queryChklst = "SELECT * FROM tbl_user WHERE email = '$login'";

	$resChklst = $db->query($queryChklst);
	$resultChklst = array();

	if (!$resChklst){
		die("Database query failed.");
		}
	while($items = $resChklst->fetch_array(MYSQLI_ASSOC)){
		array_push($resultChklst, array('id' =>$items["id"],'notAttend' =>$items["notAttend"],'attend' =>$items["attend"],'google_form' =>$items["google_form"], 'airlineTkt' =>$items["airlineTkt"], 'hotel' =>$items["hotel"], 'shuttleArrive' =>$items["shuttleArrive"], 'shuttleDepart' =>$items["shuttleDepart"], 'facAppt' =>$items["facAppt"], 'dietrestriction' =>$items["dietrestriction"], 'welcomeDinner' =>$items["welcomeDinner"], 'recLunch' =>$items["recLunch"], 'deptLunch' =>$items["deptLunch"], 'studentBio' =>$items["studentBio"], 'accessibility' =>$items["accessibility"], 'shirt' =>$items["shirt"]) );
	}

	echo (json_encode($resultChklst));

	$db->close();
} else {
	redirect_to('index.php');
}
