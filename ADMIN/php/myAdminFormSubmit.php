<?php
  require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/configStudentVisit.php");
  //require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/basicLib.php");

	$admin = $db->escape_string($_POST['name']);

	$sql = <<<SQL
		INSERT INTO tbl_admin (addedBy, AdminUniqname) 
		VALUES('$login_name','$admin') 
SQL;

	if(!$result = $db->query($sql)){
		echo "Insertion Failed";
    	die('There was an error running the query [' . $db->error . ']');
	}
	echo "Successfully Inserted   <b>" .  $admin . "</b>";

	$result->free();
	$db->close();
		

		

