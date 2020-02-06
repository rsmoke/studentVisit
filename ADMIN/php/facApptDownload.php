<?php
  require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/configStudentVisit.php");
  //require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/basicLib.php");

// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=FacApptDetail.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array('Fac_Lastname', 'Fac_FirstName', 'Fac Uniqname', 'Location', 'Date', 'Start Time', 'Student FirstName', 'Student LastName', 'Student eMail'));

// fetch the data
$apptQuery = <<<SQL
  SELECT f2.lname, f2.fname, f1.uniqname, f1.roomLoc, f1.appDate, f1.startTime, u1.Fname, u1.Lname, u1.email 
  FROM tbl_facAppts AS f1
  LEFT OUTER JOIN tbl_user AS u1 ON f1.studentname = u1.email
  LEFT OUTER JOIN tbl_faculty AS f2 ON f1.uniqname = f2.uniqname 
  ORDER BY f2.lname,  f1.appDate, f1.startTime
SQL;

if (!$rows = $db->query($apptQuery)){
	die("Database query failed");
}

// loop over the rows, outputting them
while ($row = $rows->fetch_assoc()) fputcsv($output, $row);



