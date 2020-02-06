<?php

  require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/configStudentVisit.php");
  //require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/basicLib.php");

$recID = $db->escape_string($_POST["id_event"]);

//if element has changed then build a sql string with new values.

	$Pevent_date = DateTime::createFromFormat('m/j/Y', $db->escape_string($_POST["event_date"]));
	$event_date = $Pevent_date->format('Y-m-d');

	$Pevent_dttm_start = DateTime::createFromFormat('G:i', $db->escape_string($_POST["event_dttm_start"]));
	$event_dttm_start = $Pevent_dttm_start->format('H:i');

	$Pevent_dttm_end = DateTime::createFromFormat('G:i', $db->escape_string($_POST["event_dttm_end"]));
	$event_dttm_end = $Pevent_dttm_end->format('H:i');

	$locationID = $db->escape_string($_POST["locationID"]);
	$event_name = $db->escape_string($_POST["event_name"]);
	$event_description = $db->escape_string($_POST["event_description"]);
	$event_notes = $db->escape_string($_POST["event_notes"]);
	
	$sqlUpdate =  <<<SQL
		UPDATE tbl_events
		SET event_date = '$event_date', event_dttm_start = '$event_dttm_start', event_dttm_end = '$event_dttm_end', locationID = '$locationID', event_name = '$event_name', event_description = '$event_description', event_notes = '$event_notes'
		WHERE id_event = $recID
SQL;
	if (!$resUpdEvent = $db->query($sqlUpdate)){
		die('There was an error running the query [' . $db->error . ']');
	}  

//echo "Data was inserted";
$db->close();
