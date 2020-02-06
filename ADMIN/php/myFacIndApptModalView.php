<?php

  require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/configStudentVisit.php");
  //require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/basicLib.php");
	$idToUpdate = $db->escape_string($_GET["recordToUpdate"]);

	$query = <<<SQL
	  SELECT * 
	  FROM vw_appt
	  WHERE apptid = $idToUpdate
SQL;
		
		if (!$res = $db->query($query)){
		      die('There was an error running the query [' . $db->error . ']');
  		}
		$result = array();

		while($item = $res->fetch_assoc()){
			$date = new DateTime($item["appDate"]);
			$start = new DateTime($item["startTime"]);
			array_push($result, array('id' =>$item["apptid"],'date' =>$date->format('m/d/Y'),'startTime' =>$start->format('g:ia'),'location' =>$item["roomLoc"],'stuName' =>$item["studentName"],'facUniq' =>$item["uniqname"],'facFname' =>$item["fname"],'facLname' =>$item["lname"]));
		}
		echo (json_encode( $result));

		$db->close();
