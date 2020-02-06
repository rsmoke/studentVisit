<?php

  require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/configStudentVisit.php");
  require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/basicLib.php");

		$queryAdmin = "SELECT * FROM tbl_admin ORDER BY AdminUniqname ASC";
		
		$resAdmin = mysqli_query($db,$queryAdmin);
		$resultAdmin = array();
		
		if (!$resAdmin){
			die("Database query failed.");
			}
		while($admins = $resAdmin->fetch_assoc()){
			$fullName = ldapGleaner($admins["AdminUniqname"]);
			array_push($resultAdmin, array('admin' =>$admins["AdminUniqname"],'adminID' =>$admins["id"], 'adminFname' => $fullName[0], 'adminLname' => $fullName[1]));
		}

		echo (json_encode(array("result" => $resultAdmin)));

		$resAdmin->free();
		$db->close();
