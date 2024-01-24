<?php
//Perfrom a SQL call that to get first day events that are listed in the table. The eventTypeID of 999 is reserved
//  for special use. This was incorported due to discussion of possible subevent type that may occur in the future.
//The table is structured here (on the server side) and appended to the table object on the client page.
//The time format 12 vs 24 is handled due to users request for a 12 hour format. The day and the time zone
//  default variable is set in the configSocStuVisit.php
require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/configStudentVisit.php");

echo "<tr class='table-secondary m-0'><td colspan = '5'><b>Other</b></td></tr>";

$eventListSQL = "SELECT * FROM tbl_events WHERE eventTypeID <> 999 AND ((event_date > '{$day3->format('Y-m-d')}') OR (event_date < '{$day1->format('Y-m-d')}')) ORDER BY event_date ASC";
$eventList = $db->query($eventListSQL);
if (!$eventList){
        die("Database query failed.");
        }
    while($row = $eventList->fetch_array(MYSQLI_ASSOC))
      {
      echo "<tr class='m-0'>";
      echo "<td style='width: 20%;'>" . date("Md", strtotime($row['event_date'])) . " " . date("g:i A", strtotime($row['event_dttm_start'])) . "</td><td class='w-20'>" . $row['event_name'] . "</td><td style='width: 35%;'>" . $row['event_description'] . "</td><td class='w-15'>" . $row['event_notes'] . "</td><td class='w-10'>" . $row['locationID'] . "</td>";
      echo "</tr>";
      }

$eventList->close();
$db->close();
