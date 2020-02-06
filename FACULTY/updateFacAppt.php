<?php
// Update fac appointments. requires variables room loc logon_name, $location, $start, $appDate (from form list) Returns
//	Appts inserted successfully message.
// include and create object
require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/configStudentVisit.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/basicLib.php");

$location = mysqli_real_escape_string($db,$_POST[roomLoc]);

foreach($_POST as $key => $value)
{
	if ($key <> 'roomLoc') {
		$keyArr = explode('-', $key);
		if ($keyArr[0] == 'd1') {
			$appDate = $day2->format('Y-m-d');
		}else{
			$appDate = $day3->format('Y-m-d');
		}
		$start = $keyArr[1];

	$sqlInsert="INSERT INTO tbl_facAppts (uniqname, roomLoc, startTime, appDate)VALUES ('$login_name','$location','$start','$appDate')";	
	$resApp = mysqli_query($db,$sqlInsert);
	if (!$resApp){
		die("Database query failed.");
	}
	}
}
echo "Appts inserted successfully";

mysqli_free_result($resApp);
mysqli_close($db);
?> 