<?php

  require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/configStudentVisit.php");
  //require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/basicLib.php");

		$queryEvents = <<<SQL
		SELECT * 
		FROM tbl_events 
		ORDER BY event_date, event_dttm_start ASC
SQL;

		if(!$resEvents = $db->query($queryEvents)){
      		die('There was an error running the query [' . $db->error . ']');
 		 }
		$resultEvents = array();
		while($events = $resEvents->fetch_assoc()){
			$evntDate = new DateTime($events["event_date"]);
			$evntStart = new DateTime($events["event_dttm_start"]);
			$evntEnd = new DateTime($events["event_dttm_end"]);

			array_push($resultEvents, array('id' =>$events["id_event"],'date' => $evntDate->format('m/d/Y'),'startTime' =>$evntStart->format('g:ia'),'endTime' =>$evntEnd->format('g:ia'),'location' =>$events["locationID"],'name' =>$events["event_name"],'description' =>$events["event_description"],'notes' =>$events["event_notes"]));
		}
		echo (json_encode( $resultEvents));

		$db->close();
