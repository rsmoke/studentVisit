<?php
  require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/configStudentVisit.php");
  //require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/basicLib.php");

// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=StudentDetail.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array('FirstName', 'LastName', 'Email', 'UMid', 'NotAttending', 'Attending', 'AirlineTkt','HotelRes','ShuttleArrive','ShuttleDepart','FacApptMade','WelcomeDinner','RecLunch','DeptLunch','StudentBio', 'Diet Restriction', 'Accessibility', 'T-Shirt'));

// fetch the data
$sqlQuery = <<<SQL
	SELECT Fname, Lname, email, password, notAttend, attend, airlineTkt, hotel, shuttleArrive, ShuttleDepart, facAppt, welcomeDinner, recLunch, deptLunch, studentBio, dietrestriction, accessibility, shirt
	FROM tbl_user
	ORDER by Lname ASC

SQL;

if(!$rows = $db->query($sqlQuery)){
	die("Database query failed");
}

// loop over the rows, outputting them
while ($row = $rows->fetch_assoc()) fputcsv($output, $row);

$db->close();
