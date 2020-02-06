<?php
//Perform a SQL call that to get a list of all faculty who have set appointments in tbl_facAppts.
//The select <option value="uniqname">Full Name</option> is structured here (on the server side) 
// and appended to the <select> statement object on the calling client page.

require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/configStudentVisit.php");

$facLstSQL = <<<SQL
		SELECT *
		FROM vw_facwithappts
		ORDER BY lname
SQL;

$facList = $db->query($facLstSQL);

if ( !$facList ) {
		db_fatal_error("facListing query issue",  $db->error);
	}

while($items = $facList->fetch_assoc())
  {
  	echo "<option class='facSelect' value='" . $items['uniqname'] . "'>" . $items['fname'] . " " . $items['lname'] . "</option>";
  }

// $db->close();

