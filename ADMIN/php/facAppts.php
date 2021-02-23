<?php
// include and create object
  require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/configStudentVisit.php");
  //require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/basicLib.php");

if ($isAdmin){

?>

<!doctype html>
<html lang="en">
<?php include '../header.php' ?>

  <body>
    <div id="apptModal" class="modal fade apptModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Record</h4>
            <button type="button" class="close modal-close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <span id="apptID"></span>
            <label for="uniqname">Faculty</label><span id="facName"></span><br>
            <label for="apptDate">Date</label><span id="apptDate"></span><br>
            <label for="start">Start Time</label><span id="start"></span><br>
            <label for="location">Location</label><span id="location"></span><br>
            <label for="name">Student Name</label><span id="stuName"></span>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger btn-delAppt">Delete Appointment</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <nav class="navbar navbar-expand-sm navbar-dark sticky-top" style="background-color: #00274c;">
      <a class="navbar-brand" href="../../index.php"><?php echo $siteTitle ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="../index.php">Admin-Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="eventView.php">Manage Events</a>
          </li>
            <li class="nav-item">
              <a class="nav-link" href="studentView.php">Student Info</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="facAppts.php">Faculty Appointments</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../../index.php">StudentVisit Home <span class="sr-only">(current)</span></a>
            </li>
          </ul>
          <p class="navbar-text navbar-right">Logged in as <?php echo $login_name;?></p>
        </div><!--/.nav-collapse -->
    </nav>


    <div class='container'>
      <div id="instructions">
        <h1>Student Visit - Faculty Appointments</h1>
      </div><!-- #instructions -->
    </div>

    <div class='container'>
      <div class="card card-success">
        <!-- Default card contents -->
        <div class="card-heading">
          <h5 class="card-title">These are the currently listed faculty appointments  <a href="facApptDownload.php"><button id='facApptDownload' class='btn btn-sm btn-info' data-toggle="tooltip" data-placement="right" title="Download the list"><i class="fas fa-download fa-sm"></i></button></a></h5>
        </div>
        <div class="card-body">
          <i>scroll table to see more appointments</i>
        </div>
         <div id='facAppts' style="max-height: 200px;overflow-y: scroll;">
         <table id="records_table" class="table table-striped table-sm">

        </table>
        </div>
      </div>
      </div>


      <div class="container"><!-- Faculty appointment-->
        <hr class="my-4">
        <h5>Manage Individual Faculty Appointments -or- Create a New Appointment<br>
          <small>From the <strong>Faculty List</strong> below select the name of the faculty member who's appointments you want work with.</small></h5>
        <div class="row clearfix">
          <div class="col">
            <label>
              <select name="facApptName" id="facApptName" class="form-control">
                <option value="blank" selected="selected">Faculty List</option>

                <?php
                  $facLstSQL = <<<SQL
                        SELECT *
                        FROM tbl_faculty
                        ORDER BY lname
SQL;

                  if ( !$facList = $db->query($facLstSQL)){
                      db_fatal_error("facListing query issue",  $db->error);
                    }
                  while($items = $facList->fetch_assoc())
                    {
                      echo "<option class='facSelect' value='" . $items['uniqname'] . "'>" . $items['fname'] . " " . $items['lname'] . "</option>";
                    }
                 ?>

              </select>
            </label>
          </div>
        </div>
        <div class="row clearfix">
          <div class="col">
           <h6>1. Click on the existing appointment that you want to edit. <em>Note: Appointments are for a half hour each</em>.</h6>
          </div>
        </div>

        <div class="row clearfix">
          <div class='col'>
            <table id='apptTimes' class='table table-condensed borderless'>
            </table>
          </div>
        </div>

        <div class="row clearfix">
          <div class='col'>
        <h4 >-OR-</h4>
          </div>
        </div>

        <div class="row clearfix">
          <div class="col">
            <h6>2. To add an appointment for the above selected faculty -
            <ol>
            <li>Select a date</li>
            <li>Enter a location</li>
            <li>Pick a time(s)</li> and click <button class='btn btn-primary btn-sm disabled'>Add</button> below.</h6>
          </div>
        </div>
        <div class='col'>
          <form id='facNewApptForm' role='form'>
          <input type="hidden" id="facNameSelected" name="facNameSelected" value="blank">
            <div class="form-group col-2">
             <label for="facNewApptDate">Select a date</label>
              <div id="dateSelect" class="bfh-datepicker" data-date="<?php echo $day1->format('m/d/Y'); ?>" data-name="facNewApptDate" data-min="<?php echo $day1->format('m/d/Y'); ?>" data-max="<?php echo $day3->format('m/d/Y'); ?>" >
              </div>
            </div>
            <div class="form-group col-2">
              <label for="roomLoc">Enter a room</label>
                <input type='text' class="form-control" id='roomLoc' name='roomLoc' value='OnLine' placeholder='Room Location'>
              </label>
            </div>
            <table class='table table-sm'>
              <thead>
                <tr><th>Pick a time(s) that you want to meet</th></tr>
              </thead>
              <tbody>
                <tr>
                  <td><button id='allDay1' class='btn btn-warning btn-sm'>All Day</button></td>
                </tr>
                <tr>
                  <td><input class='cbDay1' type='checkbox' value='1' name='d1-09:00'> 9:00 to 9:30</td><td><input class='cbDay1' type='checkbox' value='1' name='d1-09:30'> 9:30 to 10:00</td>
                </tr>
                <tr>
                  <td><input class='cbDay1' type='checkbox' value='1' name='d1-10:00'> 10:00 to 10:30</td><td><input class='cbDay1' type='checkbox' value='1' name='d1-10:30'> 10:30 to 11:00</td>
                </tr>
                <tr>
                  <td><input class='cbDay1' type='checkbox' value='1' name='d1-11:00'> 11:00 to 11:30</td><td><input class='cbDay1' type='checkbox' value='1' name='d1-11:30'> 11:30 to Noon</td>
                </tr>
                <tr>
                  <td><input class='cbDay1' type='checkbox' value='1' name='d1-12:00'> Noon to 12:30</td><td><input class='cbDay1' type='checkbox' value='1' name='d1-12:30'> 12:30 to 1:00</td>
                </tr>
                <tr>
                  <td><input class='cbDay1' type='checkbox' value='1' name='d1-13:00'> 1:00 to 1:30</td><td><input class='cbDay1' type='checkbox' value='1' name='d1-13:30'> 1:30 to 2:00</td>
                </tr>
                <tr>
                  <td><input class='cbDay1' type='checkbox' value='1' name='d1-14:00'> 2:00 to 2:30</td><td><input class='cbDay1' type='checkbox' value='1' name='d1-14:30'> 2:30 to 3:00</td>
                </tr>
                <tr>
                  <td><input class='cbDay1' type='checkbox' value='1' name='d1-15:00'> 3:00 to 3:30</td><td><input class='cbDay1' type='checkbox' value='1' name='d1-15:30'> 3:30 to 4:00</td>
                </tr>
                <tr>
                  <td><input class='cbDay1' type='checkbox' value='1' name='d1-16:00'> 4:00 to 4:30</td><td><input class='cbDay1' type='checkbox' value='1' name='d1-16:30'> 4:30 to 5:00</td>
                </tr>
                <tr>
                  <td><input class='cbDay1' type='checkbox' value='1' name='d1-17:00'> 5:00 to 5:30</td><td><input class='cbDay1' type='checkbox' value='1' name='d1-17:30'> 5:30 to 6:00</td>
                </tr>
              </tbody>
            </table>
            <div class='form-group'>
              <div>
                <button id='apptSub' type='submit' class='btn btn-primary'>Add</button>
              </div>
            </div>
          </form>
        </div>
      </div>

<?php include '../footer.php' ?>
    <script src="../../js/bootstrap-formhelpers.min.js"></script>
    <script src="../js/FacApptStudentVisit.js"></script>
  </body>
</html>
<?php

} else {

?>
<!doctype html>
<html lang="en">
<?php include '../header.php' ?>
  <body>

    <div class="container col-md-6 col-md-offset-3">
      <div>
        <h3 class="bg-warning">You are not authorized to view this page please return to the <a href="https://hestia.soc.lsa.umich.edu/StudentVisit">Student Visit site.</h3>
      </div>
    </div><!-- /.container -->
<?php include '../footer.php' ?>
  </body>
</html>
<?php
}

$db->close();
?>
