<?php
//Perfrom a SQL call that to get all the events that are listed in the table. The eventTypeID of 999 is reserved
//	for special use. This was incorported due to discussion of possible subevent type that may occur in the future.
//The table is structured here (on the server side) and appended to the table object on the client page.
//The time format 12 vs 24 is handled due to users request for a 12 hour format the time zone default is set in the configSocStuVisit.php
  require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/configStudentVisit.php");

$eventList = $db->query("SELECT * FROM tbl_events WHERE eventTypeID <> 999 ORDER BY event_date, event_dttm_start ASC"); 
if (!$eventList){
		die("Database query failed.");
		}
 	echo "<tr><td>All Events</b></td><td></td><td></td></tr>";
    while($row = $eventList->fetch_array(MYSQLI_ASSOC))
      {
      echo "<tr>";
      echo "<td>" . date("g:i A", strtotime($row['event_dttm_start'])) . "</td><td>" . $row['event_name'] . "</td><td>" . $row['event_description'] . "</td><td>" . $row['locationID'] . "</td>";
      echo "</tr>";
      }
$eventList->close();
// $db->close();
