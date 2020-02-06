<?php
//This is called by the studentVisit.js to update the tbl_user table to reflect the selected checklist items of the logged in user
//	The action is to clear all checklist values in the table for the user and then update the current selected values
//	to the tbl_user. The return of a confirmation message will display is the query is successful.
// Requires a variable usrName and Returns Data was inserted confirmation message.

  require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/configStudentVisit.php");

  session_start();

$userName = $_SESSION['stuVisUsername'];

$notAttend = isset($_POST['notAttend']) ? 1 : 0;
$attend = isset($_POST["attend"]) ? 1 : 0;
$google_form = isset($_POST["google_form"]) ? 1 : 0;
$airlineTkt = isset($_POST["airlineTkt"]) ? 1 : 0;
$hotel = isset($_POST["hotel"]) ? 1 : 0;
$shuttleArrive = isset($_POST["shuttleArrive"]) ? 1 : 0;
$shuttleDepart = isset($_POST["shuttleDepart"]) ? 1 : 0;
$facAppt = isset($_POST["facAppt"]) ? 1 : 0;
$welcomeDinner = isset($_POST["welcomeDinner"]) ? 1 : 0;
$recLunch = isset($_POST["recLunch"]) ? 1 : 0;
$deptLunch = isset($_POST["deptLunch"]) ? 1 : 0;
$studentBio = $db->real_escape_string($_POST["studentBio"]);
$dietrestriction = $db->real_escape_string($_POST["dietrestriction"]);
$accessibility = $db->real_escape_string($_POST["accessibility"]);
$shirt = $db->real_escape_string($_POST["shirt"]);

//$_POST items and use ternary evaluation to set the value for each
// update values in database

$sqlUpdate = "UPDATE tbl_user ";
$sqlUpdate .= "SET ";
$sqlUpdate .= "notAttend = $notAttend, ";
$sqlUpdate .= "attend = $attend, ";
$sqlUpdate .= "google_form = $google_form, ";
$sqlUpdate .= "airlineTkt = $airlineTkt, ";
$sqlUpdate .= "hotel = $hotel, ";
$sqlUpdate .= "shuttleArrive = $shuttleArrive, ";
$sqlUpdate .= "shuttleDepart = $shuttleDepart, ";
$sqlUpdate .= "facAppt = $facAppt, ";
$sqlUpdate .= "welcomeDinner = $welcomeDinner, ";
$sqlUpdate .= "recLunch = $recLunch, ";
$sqlUpdate .= "deptLunch = $deptLunch, ";
$sqlUpdate .= "studentBio = '$studentBio', ";
$sqlUpdate .= "dietrestriction = '$dietrestriction', ";
$sqlUpdate .= "accessibility = '$accessibility', ";
$sqlUpdate .= "shirt = '$shirt' ";
$sqlUpdate .= "WHERE email = '$userName'";

//echo $sqlUpdate;

$resUpdate = $db->query($sqlUpdate);
if (!$resUpdate){
	die("Database query failed.");
	}

//echo $sqlUpdate;

$db->close();
