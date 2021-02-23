<?php
// include and create object
  require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/configStudentVisit.php");
  //require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/basicLib.php");

$sql = <<<SQL
  SELECT *
  FROM tbl_admin
  WHERE AdminUniqname = '$login_name'
SQL;

if(!$check = $db->query($sql)){
      die('There was an error running the query [' . $db->error . ']');
  }

if ($check->num_rows > 0 ){

?>

<!doctype html>
<html lang="en">
<?php include '../header.php' ?>

  <body>
    <div id="myModal" class="modal fade updateRecModal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Record</h4>
            <button type="button" class="close modal-close" data-dismiss="modal" aria-hidden="true">&times;</button>

          </div>
          <div class="modal-body">
            <form id="updForm">
               <input type="hidden" id="recID" name="id_event" class="form-control">
                <label for="date">Date</label>
                  <div class="bfh-datepicker" data-date="<?php echo $day1->format('m/d/Y'); ?>" data-name="event_date" id="datePick1" data-min="<?php echo $day1->format('m/d/Y'); ?>" data-max="<?php echo date_add($day1, date_interval_create_from_date_string('60 days'))->format('m/d/Y'); ?>" ></div>
                <label for="start">Start Time</label>
                  <div id="start" data-name="event_dttm_start" class="bfh-timepicker" ></div>
                <label for="end">End Time</label>
                  <div id="end" data-name="event_dttm_end" class="bfh-timepicker" ></div>
                <label for="location">Location</label><input type="text" id="location" name="locationID" class="form-control" placeholder="Text input">
                <label for="name">Name</label><textarea rows="3" id="name" name="event_name" class="form-control" placeholder="Text input"></textarea>
                <label for="desc">Description</label><textarea rows="3" id="desc" name="event_description" class="form-control" placeholder="Text input"></textarea>
                <label for="notes">Notes</label><input type="text" id="notes" name="event_notes" class="form-control" placeholder="Text input">
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary btn-updRec">Save changes</button>
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
          <li class="nav-item active">
            <a class="nav-link" href="eventView.php">Manage Events</a>
          </li>
            <li class="nav-item">
              <a class="nav-link" href="studentView.php">Student Info</a>
            </li>
            <?php if ($use_faculty_appt_system){ ?>
            <li class="nav-item">
              <a class="nav-link" href="facAppts.php">Faculty Appointments</a>
            </li>
            <?php } ?>
            <li class="nav-item">
              <a class="nav-link" href="../../index.php">StudentVisit Home <span class="sr-only">(current)</span></a>
            </li>
          </ul>
          <p class="navbar-text navbar-right">Logged in as <?php echo $login_name;?></p>
        </div><!--/.nav-collapse -->
    </nav>


    <div class='container-fluid'>
      <div id="instructions">
        <h1>Student Visit - Event Manager</h1>
      </div><!-- #instructions -->
    </div>

    <div class='container-fluid'>
      <div class="row clearfix">
        <div class="col ">
            <button id="newEvent" class="btn btn-sm btn-info center-block newEvent" data-toggle="modal" data-target=".updateRecModal">Add Event</button>
        </div>
      </div>
      <div class="row clearfix">
        <div class="col">
          <p>These are the current listed events</p>
          <div id='currEvents'>
           <table id="records_table" class="table table-bordered table-sm">
             <thead>
              <tr>
                  <th >ID</th>
                  <th >Date</th>
                  <th >Start</th>
                  <th >End</th>
                  <th >Location</th>
                  <th >Name</th>
                  <th >Description</th>
                  <th >Notes</th>
                  <th >Editing Actions</th>
              </tr>
            </thead>
              <tbody id="records_table_body">
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row clearfix">
        <div class="col">
            <button id="newEvent2" class="btn btn-sm btn-info center-block newEvent" data-toggle="modal" data-target=".updateRecModal">Add Event</button>
        </div>
      </div>

    </div>

<?php include '../footer.php' ?>
    <script src="../../js/bootstrap-formhelpers.min.js"></script>
    <script src="../js/EventStudentVisit.js"></script>
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
        <h3 class="bg-warning">You are not authorized to view this page please return to the <a href="index.php">Student Visit site.</h3>
      </div>
    </div><!-- /.container -->
    <?php include '../footer.php' ?>

  </body>
</html>
<?php
}

$db->close();
?>
