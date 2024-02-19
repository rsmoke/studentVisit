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
              <p class="small">Lex is a proud graduate of Lincoln University in Pennsylvania. 
                They have spent the past 7 years in the nonprofit world working for the Neighborhood 
                Technical Assistance Clinic, Prep for Prep, and most recently, the American Civil 
                Liberties Union. Their work recruiting for the Prep for Prep program and relationships
                 with colleagues and friends inspired their interest in the Sociology of Education. 
                 More specifically, they are interested in Race, Stratification and the Black-White 
                 achievement gap on the K-12 level.  Lex has a deep-seated love for qualitative methods 
                 but is interested in becoming a mixed-methods scholar.  They hail from the planet of 
                 Brooklyn and, while they admit to being NY-centric at times, they welcome a change of scenery.</p>
              <hr>
              <p class="small">Jeong will be graduating from Emory University this upcoming May with a degree in Sociology.
               As an undergraduate, her independent research explored the experiences of underrepresented 
               minority students at institutions of higher education. She is excited to continue studying the 
               nexus among race, class, and education, looking particularly at how the mass expansion of
                postsecondary education has impacted social inequality and social mobility in the U.S., 
                as well as how race and class differences affect educational outcomes and future 
                occupational attainment.  Jeong is originally from Milwaukee, WI (although she does 
                not consider herself a cheesehead), and describes herself as an avid reader, foodie, 
                and proud dog mom.
              </p>
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
              <a class="nav-link" href="../studentVisitMap.php">Map</a>
            </li>
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
            <li>From the <strong>Faculty List</strong> below select the name of the individual that you want to meet with during your visit.</li>
            <li>Click on the appointment that you want to set.</li>
            <li>Please make an additional appointment with the Academic Program Manager - Jill Hoppenjans to discuss funding if needed.</li>
            <li><em><strong>Note: Appointments are for 1/2 hour each</strong></em>.</li>
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
      <div class="row justify-content-sm-center">
        <hr class='col-sm-6'>
        <div class="col-sm-6">
          <div class="card border-primary" style="max-width: 30rem;">
            <h4 class="card-header bg-secondary text-warning">Faculty Walk-In Office Hours</h4>
            <div class="card-body">
              <?php include "walkinAppts.php"; ?>
            </div>
            <div class="card-footer text-muted"><small>Note: These appointments do not require a reservation</small></div>
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
          <p>To be sure your visit will be successful, go through this checklist and mark-off the items as you complete them.
            Click <button type="submit" class="btn btn-info btn-sm disabled">Update</button> after you make any changes.</p>
          <h6><span id="stuChkLstMessage" style="color:blue"></span></h6>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8 offset-md-1">
          <form id="chklst" name="chklst" role="form">
           <!-- <input type="text" name="usrName" id="usrName" value="<?php //echo $_SESSION['stuVisUsername'] ?>"> -->
            <div class="form-group row">
              <div class="col-sm-10">
                <button type="submit" id="btnCheckListSubmit" name="chkLstSubmit" class="btn btn-info btn-sm">Update</button>
              </div>
            </div>
            <div class="form-check">
              <input type="checkbox" class="chkLstChkBox form-check-input form-check-input" name="notAttend" id="notAttend" value="1">
              <label class="form-check-label">I <u>DO NOT</u> plan on attending.</label>
            </div>

            <div class="form-check">
              <input type="checkbox" class="chkLstChkBox form-check-input" name="attend" id="attend" value="1">
              <label class="form-check-label">I plan on attending.</label>
            </div>

            <?php if (isset($google_form_url)){ ?>
            <div class="form-check">
              <input type="checkbox" class="chkLstChkBox form-check-input" name="google_form" id="google_form" value="1">
              <label class="form-check-label">Airline travel booked through <a href="<?php echo $google_form_url; ?>" target="_blank">Travel Booking Form</a>.</label>
            </div>
            <?php } ?>

            <!-- <div class="form-check">
              <input type="checkbox" class="chkLstChkBox form-check-input" name="shuttleArrive" id="shuttleArrive" value="1">
              <label class="form-check-label">I filled out the <a href="https://docs.google.com/forms/d/e/1FAIpQLSfccGsi0pUB5f_Pu93mVrVKtZU9jByXlz9udiXr2KxEbOMcmA/viewform?usp=sf_link" target="_blank">Recruitment Travel Booking Form</a></label>
            </div> -->

            <!-- <div class="form-check">
              <input type="checkbox" class="chkLstChkBox form-check-input" name="airlineTkt" id="airlineTkt" value="1">
              <label class="form-check-label">Travel arrangements made.</label>
            </div> -->

            <div class="form-check">
              <input type="checkbox" class="chkLstChkBox form-check-input" name="hotel" id="hotel" value="1">
              <label class="form-check-label">I will need hotel accommodations on Sunday and Monday evening.</label>
            </div>

            <div class="form-check">
              <input type="checkbox" class="chkLstChkBox form-check-input" name="shuttleDepart" id="shuttleDepart" value="1">
              <label class="form-check-label">Scheduled transportation both ways between Airport and Campus. <a href="http://www.theride.org/Services/Airport-Service" target="_blank">Airline Shuttle Service</a></label>
            </div>

            <div class="form-check">
              <input type="checkbox" class="chkLstChkBox form-check-input" name="facAppt" id="facAppt" value="1">
              <label class="form-check-label">Faculty appointments made.</label>
            </div>

            <div class="form-check">
              <input type="checkbox" class="chkLstChkBox form-check-input" name="welcomeDinner" id="welcomeDinner" value="1">
              <label class="form-check-label">I plan on attending the <strong>Welcome Dinner</strong> on <?php echo $day1->format("l, F jS");  ?>.</label>
            </div>

            <div class="form-check">
              <input type="checkbox" class="chkLstChkBox form-check-input" name="recLunch" id="recLunch" value="1">
              <label class="form-check-label">I plan on attending the <strong>Faculty Lunch</strong> on <?php echo $day2->format("l, F jS");  ?>.</label>
            </div>

            <div class="form-check">
              <input type="checkbox" class="chkLstChkBox form-check-input" name="deptLunch" id="deptLunch" value="1">
              <label class="form-check-label">I plan on attending the <strong>Recruitment Dinner</strong> on <?php echo $day2->format("l, F jS");  ?>.</label>
            </div>

            <div class="form-check">
              <input type="checkbox" class="chkLstChkBox form-check-input" name="socEvent" id="socEvent" value="1">
              <label class="form-check-label">I plan on attending the <strong>Sociologists of Color Social</strong> on <?php echo $day3->format("l, F jS");  ?>.</label>
            </div>

            <div class="form-group">
              <label for="studentBio">
                Enter a short biography to tell us about yourself. <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#bioExample">View an example</button>
              </label>
              <textarea class="form-control chkLstTxtBox" name="studentBio" id="studentBio" rows="4" placeholder="Enter your biographical information here."></textarea>
            </div>

            <div class="form-group">
              <label for="dietrestriction">Do you have any dietary restrictions?</label>
              <textarea class="form-control chkLstTxtBox" name="dietrestriction" id="dietrestriction" rows="1"></textarea>
            </div>
            <div class="form-group">
              <label for="accessibility">Do you have any accessibility needs?</label>
              <textarea class="form-control chkLstTxtBox" name="accessibility" id="accessibility" rows="1"></textarea>
            </div>
            <div class="form-group">
              <label for="shirt">T-Shirt Size</label>
              <textarea class="form-control chkLstTxtBox" name="shirt" id="shirt" rows="1"></textarea>
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
