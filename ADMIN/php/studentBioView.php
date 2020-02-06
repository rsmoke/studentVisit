<?php
  require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/configStudentVisit.php");
  //require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/basicLib.php");
	$recID = $db->real_escape_string($_POST['recID']);

		$queryStuInfo = "SELECT studentBio FROM tbl_user WHERE id = $recID ";
		
		$result = $db->query($queryStuInfo);
		$row= $result->fetch_assoc();
		$stuBio = $row['studentBio'];

		echo ( $stuBio);

		$result->close();
		$db->close();