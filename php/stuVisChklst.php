<?php
  require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/configStudentVisit.php");
  require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/basicLib.php");
 session_start();

 if (isset($_SESSION['stuVisUsername'], $_SESSION['umid'])){
  //show stuVisChklist button here
    $showChkList = true;
  } else {
      $showChkList = false;
      redirect_to("../index.php");
  }

  ?>

<!doctype html>
<html lang="en">
  <?php include '../header.php' ?>

  <body>
  <?php include_once("../analyticstracking.php") ?>
    <div class="modal fade" id="bioExample" tabindex="-1" role="dialog" aria-labelledby="bioExample" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Biography examples</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
              <p class="small">Jane is a senior at Rice University, where she will earn her BA in Sociology and the Study of Women, Gender, and Sexualities. Her research interests lie in social demography, health disparities, and the life course. In graduate school, she wants to explore the health trajectories of immigrants and the impact of residential spaces on immigrant health. Jane grew up in Minnesota, but is still not used to the cold. She enjoys a good Barre or Bikram workout, hole-in-the-wall restaurants, and foreign languages.</p>
              <hr>
              <p class="small">Joseph will be graduating from Emory University this upcoming May with a degree in <?php echo $deptLngName; ?>.  As an undergraduate, his independent research explored the experiences of underrepresented minority students at institutions of higher education.  He is excited to continue studying the nexus among race, class and education, looking particularly at how the mass expansion of postsecondary education has impacted social inequality and social mobility in the U.S., as well as how race and class differences affect educational outcomes and future occupational attainment.  He is originally from Milwaukee, WI (although he does not consider himself a cheesehead), and describes himself as an avid reader, aggressive runner, and adventurous traveler.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <nav class="navbar navbar-expand-sm navbar-dark sticky-top" style="background-color: #00274c;">
      <a class="navbar-brand" href="../index.php"><?php echo $siteTitle ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <?php  echo(($showChkList === true) ? "<li class='nav-item active myVisitChkLst'><a class='nav-link' href='stuVisChklst.php' >MiVisit Checklist</a></li>" : '') ?>
            <li class="nav-item">
              <a class="nav-link" href="../studentVisitEvents.php">Schedule of Events</a>
            </li>
          </ul>
          <?php  if($showChkList): ?>
            <form class="form-inline navbar-right" role="logout" action="../index.php" method="post">
              <button type="logout" name="logout" class="btn btn-outline-warning btn-sm">LogOut</button>
            </form>
          <?php endif; ?>
        </div><!--/.nav-collapse -->
    </nav>
<?php if ($use_faculty_appt_system){ ?>
    <div class="container-fluid"><!-- Faculty appointment-->
      <h4>Faculty Appointments for <?php echo  $_SESSION['stuFname'] . " " . $_SESSION['stuLname'] ?></h4>
      <div class = "row justify-content-sm-center">
        <div class= "col-auto">
          <div class="card border-success" >
            <div class="card-header">Your currently scheduled appointments</div>
            <div class="card-body">
              <div id="listAppts" class="card-text">
                <span id='setAppts'></span>
              </div>
            </div>
            <div class="card-footer text-muted">
              <small>NOTE: To delete an appointment click the <button class="btn btn-sm btn-outline-danger disabled"><i style="color:Tomato;" class="fas fa-trash fa-sm"></i></button> next to the appointment
            </div>
          </div>
        </div>
      </div>
    <?php
    // If the $appt_open is true or 1 and the current date is one day less than the first day of the event
    //    show the faculty appointment scheduler. $dayClose is set in the config file.
      if ( $appt_open && (new DateTime() < $dayClose) ) {
    ?>
      <div class="row">
        <div class="col">
          <hr class="my-4">
          <h6>Make an appointment</h6>
          <ol>
            <li>From the <strong>Faculty List</strong> below select the name of the faculty member that you want to meet with during your visit.</li>
            <li>Click on the appointment that you want to set. <em><strong>Note: Appointments are for 1/2 hour each</strong></em>.</li>
          </ol>
        </div>
      </div>
      <div class="row justify-content-sm-center">
        <div class="col col-sm-2">
          <label>
            <select name="facApptName" id="facApptName" class="form-control">
              <option value="blank" selected="selected">Faculty List</option>
              <?php include "facListing.php"; ?>
            </select>
          </label>
        </div>
        <div class="col-sm-6">
          <div class="card border-primary" style="max-width: 30rem;">
            <div class="card-header">Available appointments</div>
            <div class="card-body">
              <table id='apptTimes' class='table table-condensed'>
              </table>
            </div>
            <div class="card-footer text-muted"><small>Note: If you do not see any times listed above then all the appointments have been reserved for the selected faculty member</small></div>
          </div>
        </div>
      </div>
    <?php } ?>
    </div> <!-- container Faculty appointment -->
<?php } ?>
    <div class="container-fluid">
      <div class= "row" >
        <div class="col">
          <hr class="my-4">
          <h3><?php echo  $_SESSION['stuFname'] . " " . $_SESSION['stuLname'] ?>'s Visit Checklist</h3>
          <p>Please complete the information below.
            Click <button type="submit" class="btn btn-info btn-sm disabled">Update</button> after you make any changes.</p>
          <h6><span id="stuChkLstMessage" style="color:blue"></span></h6>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8 offset-md-1">
          <form id="chklst" name="chklst" role="form">
            <div class="form-group row">
              <div class="col-sm-10">
                <button type="submit" id="btnCheckListSubmit" name="chkLstSubmit" class="btn btn-info btn-sm">Update</button>
              </div>
            </div>
            <div class="form-check">
              <input type="checkbox" class="chkLstChkBox form-check-input form-check-input" name="notAttend" id="notAttend" value="1">
              <label class="form-check-label">I <u>DO NOT</u> plan on attending the live welcome event on <?php echo $day1->format('l, F jS'); ?>.</label>
            </div>

            <div class="form-check">
              <input type="checkbox" class="chkLstChkBox form-check-input" name="attend" id="attend" value="1">
              <label class="form-check-label">I plan on attending the live welcome event on  <?php echo $day1->format('l, F jS'); ?>.</label>
            </div>

            <?php if (isset($google_form_url)){ ?>
            <div class="form-check">
              <input type="checkbox" class="chkLstChkBox form-check-input" name="google_form" id="google_form" value="1">
              <label class="form-check-label">I filled out the visit <a href="<?php echo $google_form_url; ?>" target="_blank">information form</a>.</label>
            </div>
            <?php } ?>
            <br>
            <div class="form-check">
              <input type="checkbox" class="chkLstChkBox form-check-input" name="airlineTkt" id="airlineTkt" value="1">
              <label class="form-check-label">I would like my email address to be viewable by other students in this admit class.</label>
              <span>Some students find it helpful to communicate with others in the admit class throughought the recruitment process. </span>
            </div>
            <br>
            <div class="form-check">
              <input type="checkbox" class="chkLstChkBox form-check-input" name="facAppt" id="facAppt" value="1">
              <label class="form-check-label">I have signed up for a 1-on-1 virtual meeting with a faculty member.</label>
            </div> 
            <hr>
            <div class="form-group">
              <label for="studentBio">
              Student Bio -  Please enter a short bio to tell us about yourself.  This bio will be shared with our faculty, staff, current students, and the other students in this admit class.<button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#bioExample">View an example</button>
              </label>
              <textarea class="form-control chkLstTxtBox" name="studentBio" id="studentBio" rows="4" placeholder="Enter your biographical information here."></textarea>
            </div>

            <div class="form-group">
              <label for="dietrestriction">Please print your name (first and last) as you would like it to be displayed on your bio. If you would like pronouns listed next to your name in your bio, please also include them here.</label>
              <textarea class="form-control chkLstTxtBox" name="dietrestriction" id="dietrestriction" rows="1"></textarea>
            </div>
            <div class="form-group">
              <label for="accessibility">Do you have any accommodation or access needs that we can help facilitate?</label>
              <textarea class="form-control chkLstTxtBox" name="accessibility" id="accessibility" rows="1"></textarea>
            </div>
            <div class="form-group">
              <label for="shirt">Unisex T-tshirt size (S-XXXL), Phone Number and Current Mailing Address</label>
              <textarea class="form-control chkLstTxtBox" name="shirt" id="shirt" rows="2"></textarea>
            </div>
          </form>
        </div>
      </div>
    </div><!-- /.container -->

    <?php include '../footer.php' ?>
      <!-- Optional JavaScript -->
      <script src='../js/studentVisitChkList.js'></script>
  </body>
</html>