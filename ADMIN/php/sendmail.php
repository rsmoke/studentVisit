<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/configStudentVisit.php");
$recipient = $_POST('recipient'); //somebody@example.com
$faculty = $_POST('faculty');

$to = $recipient. "\r\n" .
"CC: socwebmanager@umich.edu";
$subject = "NOTICE: Your appointment with $faculty was cancelled";
$txt = "Hello world!";
$headers = "From: lsa-soc-gradprogram@umich.edu";

mail($to,$subject,$txt,$headers);

echo "eMail was sent to $recipient from $faculty" ;
