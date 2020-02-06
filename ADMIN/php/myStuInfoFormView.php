<?php

  require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/configStudentVisit.php");
  //require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/basicLib.php");

		$queryStuInfo = "SELECT * FROM tbl_user ORDER BY Lname ASC";

		$resStuInfo = mysqli_query($db,$queryStuInfo);
		$resultStuInfo = array();

		if (!$resStuInfo){
			die("Database query failed.");
			}
		while($items= mysqli_fetch_assoc($resStuInfo)){
			if ($items["studentBio"] !== null){
				array_push ($resultStuInfo, array('userID' =>$items["id"],'umid' =>$items["password"],'email' =>$items["email"],'Fname' =>$items["Fname"],'Lname' =>$items["Lname"],'notAttend' =>$items["notAttend"],'attend' =>$items["attend"],'airlineTkt' =>$items["airlineTkt"],'hotel' =>$items["hotel"],'shuttleArrive' =>$items["shuttleArrive"],'shuttleDepart' =>$items["shuttleDepart"],'facAppt' =>$items["facAppt"], 'dietrestriction' =>$items["dietrestriction"], 'accessibility' =>$items["accessibility"], 'shirt' =>$items["shirt"], 'welcomeDinner' =>$items["welcomeDinner"],'recLunch' =>$items["recLunch"],'deptLunch' =>$items["deptLunch"],'studentBio' =>'more..'));
				} else{
				array_push ($resultStuInfo, array('userID' =>$items["id"],'umid' =>$items["password"],'email' =>$items["email"],'Fname' =>$items["Fname"],'Lname' =>$items["Lname"],'notAttend' =>$items["notAttend"],'attend' =>$items["attend"],'airlineTkt' =>$items["airlineTkt"],'hotel' =>$items["hotel"],'shuttleArrive' =>$items["shuttleArrive"],'shuttleDepart' =>$items["shuttleDepart"],'facAppt' =>$items["facAppt"], 'dietrestriction' =>$items["dietrestriction"], 'accessibility' =>$items["accessibility"], 'shirt' =>$items["shirt"], 'welcomeDinner' =>$items["welcomeDinner"],'recLunch' =>$items["recLunch"],'deptLunch' =>$items["deptLunch"],'studentBio' =>' - '));
				}
			}

		echo (json_encode( $resultStuInfo));

		mysqli_free_result($resStuInfo);
		mysqli_close($db);
