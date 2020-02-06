<?php
//Perform a SQL call that to get a list of all faculty who have walkin appointments in tbl_walkinAppts.

require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/configStudentVisit.php");

$walkinLstSQL = <<<SQL
	SELECT fname, lname, roomLoc, startTime, apptDate
	FROM tbl_walkinAppts wa
	JOIN tbl_faculty fa ON wa.uniqname = fa.uniqname
	ORDER BY wa.apptDate, wa.startTime,  fa.lname
SQL;

$walkinList = $db->query($walkinLstSQL);

if ( !$walkinList ) {
		db_fatal_error("walkinListing query issue",  $db->error);
	}

$html = "<table class='table table-sm table-hover'>";
$html .= "  <thead>";
$html .= "    <tr class='bg-info'>";
$html .= "      <th scope='col'>Name</th>";
$html .= "      <th scope='col'>Location</th>";
$html .= "      <th scope='col'>Start Time</th>";
$html .= "   </tr>";
$html .= "  </thead>";
$html .= "  <tbody>";
while($items = $walkinList->fetch_assoc())
  {
		$appointment = new DateTime($items["apptDate"] . " " . $items["startTime"]);
		$html .= "   <tr>";	
  	$html .= "<td><strong>" . $items['fname'] . " " . $items['lname'] . "</strong></td><td>" . $items['roomLoc'] . "</td><td>" . $appointment->format('g:ia \o\n F jS') . "</td>";
		$html .= "   </tr>";
	}
	$html .=   "</tbody>";
	$html .= "</table>";
echo $html;

// $db->close(); 

