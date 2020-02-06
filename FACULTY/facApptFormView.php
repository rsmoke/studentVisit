<?php
// Queries tbl_facAppts table for set appts. Requires $login_name Returns encoded JSON array of all appointments for login_name.

// include and create object
require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/configStudentVisit.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/basicLib.php");

		$queryAppt = "SELECT * FROM tbl_facAppts WHERE uniqname = '$login_name'  ORDER BY appDate, startTime ASC";
		
		$resAppt = mysqli_query($db,$queryAppt);
		$resultAppt = array();
		
		if (!$resAppt){
			die("Database query failed.");
			}
		while($appts = mysqli_fetch_assoc($resAppt)){
			$apptTime = new DateTime($appts["startTime"]);
			array_push($resultAppt, array('id' =>$appts["id"],'appDate' =>$appts["appDate"], 'startTime' =>$apptTime->format('g:i A'),'roomLoc' =>$appts["roomLoc"],'student' =>$appts["studentName"]));
		}
		echo (json_encode(array("result" => $resultAppt)));

		mysqli_free_result($resAppt);
		mysqli_close($db);
?>