<?php

  require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/configStudentVisit.php");
  //require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/basicLib.php");

//if element has changed then build a sql string with new values.

	$Pevent_date = DateTime::createFromFormat('m/d/Y', $db->escape_string($_POST["event_date"]));
	$event_date = $Pevent_date->format('Y-m-d');

//	$Pevent_dttm_start = DateTime::createFromFormat('g:i', $db->escape_string($_POST["event_dttm_start"]));
	$Pevent_dttm_start = DateTime::createFromFormat('G:i', $db->escape_string($_POST["event_dttm_start"]));
	$event_dttm_start = $Pevent_dttm_start->format('H:i');

	$Pevent_dttm_end = DateTime::createFromFormat('G:i', $db->escape_string($_POST["event_dttm_end"]));
	$event_dttm_end = $Pevent_dttm_end->format('H:i');

	$locationID = (isset($_POST["locationID"]) ? $db->escape_string($_POST["locationID"]) : '');
	$event_name = (isset($_POST["event_name"]) ? $db->escape_string($_POST["event_name"]) : '');
	$event_description = (isset($_POST["event_description"]) ? $db->escape_string($_POST["event_description"]) : '');
	$event_notes = (isset($_POST["event_notes"]) ? $db->escape_string($_POST["event_notes"]) : '');
	
	$sqlInsert =  <<<SQL
		INSERT INTO tbl_events
		(event_date, event_dttm_start, event_dttm_end, locationID, event_name, event_description, event_notes)
		VALUES( '$event_date','$event_dttm_start','$event_dttm_end','$locationID','$event_name','$event_description','$event_notes')
SQL;
echo $sqlInsert;
	if (!$resInsEvent = $db->query($sqlInsert)){
		die('There was an error running the query [' . $db->error . ']');
	}  

//echo "Data was inserted";
$db->close();