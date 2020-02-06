<?php
//This is called by the studentVisit.js to update the tbl_facAppts table to reflect the removal or deletion of the students name from 
// the selected appointment time for the logged in user. The appointment slot is not deleted just made available again.
//	the result of the query is an updated to the tbl_facAppts. The return of a confirmation message will display is the query is successful.
// Requires two variables student and recNum (record ID). Returns Data was inserted confirmation message.
  require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/configStudentVisit.php");
  session_start();

$student = $_SESSION['stuVisUsername'];
$recNum = htmlspecialchars($_POST['recNum']);

$sqlUpdate = "UPDATE tbl_facAppts SET studentName = '' WHERE id = '$recNum' AND studentName ='$student'";

$resUpdate = $db->query($sqlUpdate);
if (!$resUpdate){
	die("Database query failed.");
	}

echo "Data was inserted";


$db->close();
