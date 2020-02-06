<?php
  require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/configStudentVisit.php");
  //require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/basicLib.php");

	//sanitize post value, PHP filter FILTER_SANITIZE_NUMBER_INT removes all characters except digits, plus and minus sign.
	$idToDelete = $db->escape_string($_POST["apptToDelete"]);

	$query = <<<SQL
	DELETE FROM tbl_facAppts
	WHERE id = $idToDelete
SQL;

	//try deleting record using the record ID we received from POST
	if (!$result = $db->query($query)){
		die("There was an error running the query [" . $db->error . "]");
	}
	echo "Record was blipped!";
$db->close();