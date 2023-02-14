<?php
//Perform a SQL call that to get a list of all faculty who have walkin appointments in tbl_walkinAppts.

require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/configStudentVisit.php");

$walkinLstSQL = <<<SQL
	SELECT fname, lname, roomLoc, startTime, endTime, apptDate
	FROM tbl_walkinAppts wa
	JOIN tbl_faculty fa ON wa.uniqname = fa.uniqname
	ORDER BY wa.apptDate, wa.startTime,  fa.lname
SQL;

$walkinList = $db->query($walkinLstSQL);

if ( !$walkinList ) {
		db_fatal_error("walkinListing query issue",  $db->error);
	}

	$html = "	<div class='row justify-content-sm-center'>";
	$html .= "	<hr class='col-sm-6'>";
	$html .= "	<div class='col-sm-6'>";
	$html .= "		<div class='card border-primary' style='max-width: 30rem;'>";
	$html .= "			<h4 class='card-header bg-secondary text-warning'>Faculty Walk-In Office Hours</h4>";
	$html .= "			<div class='card-body'>";

$html .= "<table class='table table-sm table-hover'>";
$html .= "  <thead>";
$html .= "    <tr class='bg-info'>";
$html .= "      <th scope='col'>Name</th>";
$html .= "      <th scope='col'>Location</th>";
$html .= "      <th scope='col'>Time</th>";
$html .= "   </tr>";
$html .= "  </thead>";
$html .= "  <tbody>";
while($items = $walkinList->fetch_assoc())
  {
		$html .= "   <tr>";	
		$html .= "<td><strong>" . $items['fname'] . " " . $items['lname'] . "</strong></td><td>" . $items['roomLoc'] . "</td><td>" . date('g:i A', strtotime($items['startTime'])) . " - " . date('g:i A', strtotime($items['endTime'])) . " on " . date('F jS', strtotime($items['apptDate'])) . "</td>";
		$html .= "   </tr>";
	}
	$html .=   "</tbody>";
	$html .= "</table>";

	$html .= "	</div>";
	$html .= "	<div class='card-footer text-muted'><small>Note: These appointments do not require a reservation</small></div>";
	$html .= "</div>";
	$html .= "</div>";
	$html .= "</div>";
echo $html;

// $db->close(); 

