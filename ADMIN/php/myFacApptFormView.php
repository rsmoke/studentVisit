<?php

  require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/configStudentVisit.php");
  require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/basicLib.php");

		$queryFacAppt = <<<SQL
			SELECT fa.id, f.fname, f.lname, fa.uniqname, fa.roomLoc, fa.startTime, fa.appDate, fa.studentName, u.Fname, u.Lname  
			FROM tbl_facAppts AS fa
			LEFT OUTER JOIN tbl_user AS u ON fa.studentName = u.email
			LEFT OUTER JOIN tbl_faculty AS f ON fa.uniqname = f.uniqname
			ORDER BY f.lname, fa.appDate, fa.startTime
SQL;
		
		$resultFacAppt = array();
		
		if (!$resFacAppt = $db->query($queryFacAppt)){
			die("Database query failed.");
			}
		while($items= mysqli_fetch_assoc($resFacAppt)){
			$facFullname = ldapGleaner($items["uniqname"]);
			$start = new DateTime($items["startTime"]);
			$day = new DateTime($items["appDate"]);
			array_push($resultFacAppt, array('id' =>$items["id"], 'facLname'=>$facFullname[1], 'facFname'=>$facFullname[0], 'uniqname' =>$items["uniqname"],'startTime' =>$start->format('g:i A'),'appDate' =>$day->format('F jS'),'roomLoc' =>$items["roomLoc"], 'stuFname' =>$items["Fname"]? $items["Fname"]: '', 'stuLname' =>$items["Lname"]? $items["Lname"]: '','studentName' =>$items["studentName"]));
		}
		echo (json_encode( $resultFacAppt));

