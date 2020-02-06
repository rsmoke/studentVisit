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
            <li class="nav-item active">
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
        <h1>Student Visit - Student Information</h1>
      </div><!-- #instructions -->
    </div>

    <div class='container-fluid'>
      <div>
        <p>These are the current Students - <a href="stuDetailDownload.php"><button id='stuDetailDownload' class='btn btn-sm btn-info'><i class="fas fa-download"></i></button></a></p>
        <p><em>Note: <font style='color:#CC0099'>Highlighted</font> students signified they are not attending</em></p>
        <div id='stuInfo'>
         <table id="records_table" class="table table table-bordered table-sm">
           <thead>
          <tr>
              <th><small>ID</small></th>
              <th>UMID</th>
              <th>Last Name</th>
              <th>First Name</th>
              <th>eMail</th>
              <th>Plane Ticket</th>
              <th>Hotel</th>
              <th>Shuttle from airport</th>
              <th>Shuttle to airport</th>
              <th>Faculty Appt</th>
              <th>Welcome Dinner</th>
              <th>Rec Lunch</th>
              <th>Dept Lunch</th>
              <th>Diet Restriction</th>
              <th>Accessibility</th>
              <th>T-Shirt size</th>
              <th>Biography</th>
          </tr>
          <thead>
            <tbody>
        </table>
        </div>

      </div>

    </div>

    <?php include '../footer.php' ?>
    <!-- Optional JavaScript -->
    <script src="../js/StuStudentVisit.js"></script>
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


mysqli_close($db);
?>
