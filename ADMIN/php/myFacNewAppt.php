<?php
// Update fac appointments. requires variables room loc logon_name, $location, $start, $appDate (from form list) Returns
//	Appts inserted successfully message.
  require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/configStudentVisit.php");
  require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/basicLib.php");
  session_start();

$location = $db->escape_string($_POST["roomLoc"]);
$dayJS = $db->escape_string($_POST["facNewApptDate"]);
$dayRaw = new DateTime($dayJS);
$day = $dayRaw->format("Y-m-d");

$facName = $db->escape_string($_POST["facNameSelected"]);

foreach($_POST as $key => $value)
{
	if ($key <> "roomLoc" && $key <> "facNewApptDate" && $key <> "facNameSelected") {
		$keyArr = explode('-', $key);
		$start = $keyArr[1];

	$sqlInsert= <<<SQL
	INSERT INTO tbl_facAppts (uniqname, roomLoc, startTime, appDate)
	VALUES ('$facName','$location','$start','$day')
SQL;

	if (!$resApp = $db->query($sqlInsert)){
		die("Database query failed.");
	}

}
}

echo "Appts inserted successfully" . $sqlInsert;

$db->close();
