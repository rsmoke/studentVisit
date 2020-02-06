<?php

  require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/configStudentVisit.php");
  //require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/basicLib.php");

if(is_numeric($_POST["recordToDelete"]))
{	//do we have a delete request? $_POST["recordToDelete"]

	//sanitize post value, PHP filter FILTER_SANITIZE_NUMBER_INT removes all characters except digits, plus and minus sign.
	$idToDelete = filter_var($_POST["recordToDelete"],FILTER_SANITIZE_NUMBER_INT); 

	//try deleting record using the record ID we received from POST
	if(!mysqli_query($db,"DELETE FROM tbl_events WHERE id_event=" . $idToDelete))
	{    
		//If mysql delete query was unsuccessful, output error 
		header('HTTP/1.1 500 Could not delete record!');
		exit();
	}
	mysqli_close($db); //close db connection
}
else
{
	//Output error
	header('HTTP/1.1 500 Error occurred, Could not process request!');
    exit();
}
