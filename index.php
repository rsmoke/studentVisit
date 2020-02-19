<?php
  require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/configStudentVisit.php");
  require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/basicLib.php");
  session_start();

  $showChkList = false;

 if (isset($_SESSION['stuVisUsername'], $_SESSION['umid'])){
  //show stuVisChklist button
    $showChkList = true;
    if (isset($_POST['logout'])){
      $_SESSION['stuVisUsername'] = NULL;
      $_SESSION['umid'] = NULL;
      $_SESSION['stuFname'] = NULL;
      $_SESSION['stuLname'] = NULL;
      $_SESSION['stuID'] = NULL;
      unset($_POST['logout']);
      $showChkList = false;
      redirect_to("index.php");
    }
  }
  elseif (isset($_POST['logon'])) {
    // form was submitted
    $stuVisUsername = htmlentities($_POST['stuVisUsername']);
    $umid = htmlentities($_POST['umid']);

    $userSQL = "SELECT Fname, Lname, id ";
    $userSQL .= "FROM tbl_user ";
    $userSQL .= "WHERE password = '$umid' AND email = '$stuVisUsername' ";
    $userSQL .= "LIMIT 1";

    if ( !$resStuDetails = $db->query($userSQL) ){
      db_fatal_error("login issue",  $db->error, $userSQL, $stuVisUsername . " umid: " . $umid);
      } else {

      if ( $resStuDetails->num_rows == 1 ){
      // successful login
          $_SESSION['stuVisUsername'] = $stuVisUsername;
          $_SESSION['umid'] = $umid;
        while($items = $resStuDetails->fetch_assoc()){
          $_SESSION['stuFname'] = $items['Fname'];
          $_SESSION['stuLname'] = $items['Lname'];
          $_SESSION['stuID'] = $items['id'];
        }

        $resStuDetails->close();
        $db->close();
        unset($_POST['logon']);
        $message = NULL;
        redirect_to("php/stuVisChklst.php");
      } else {
        //failed logon
        $message = "Whoops, the eMail/UMID you entered does not match.";
        unset($_POST['logon']);
      }
    }
  }
  else {
    $stuVisUsername = "";
    $umid = "";
    $message = NULL;
  }

 ?>

<!doctype html>
<html lang="en">
  <?php include 'header.php' ?>
  <body>
  <?php include_once("analyticstracking.php") ?>
    <nav class="navbar navbar-expand-sm navbar-dark sticky-top" style="background-color: #00274c;">
      <a class="navbar-brand" href="index.php"><?php echo $siteTitle ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <?php  echo(($showChkList === true) ? "<li class='nav-item myVisitChkLst'><a class='nav-link' href='php/stuVisChklst.php' >MiVisit Checklist</a></li>" : '') ?>
            <li class="nav-item">
              <a class="nav-link" href="studentVisitMap.php">Map</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="studentVisitEvents.php">Schedule of Events</a>
            </li>
          </ul>
          <?php  if($showChkList): ?>
            <form class="form-inline navbar-right" role="logout" action="index.php" method="post">
              <button type="logout" name="logout" class="btn btn-outline-warning btn-sm">LogOut</button>
            </form>
          <?php endif; ?>
        </div><!--/.nav-collapse -->
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="container-fluid">
    <div class="jumbotron">
        <a href="<?php echo $deptURL;?>"><img src="images/<?php echo $logo;?>" class="img-fluid rounded mx-auto d-block alt="Department Logo" /></a>
        <p class="lead">Congratulations on your admission to the Department of <?php echo $deptLngName ?> at the University of Michigan!</p>
        <hr class="my-4">
        <p>We look forward to hosting you for our visitation events which are scheduled to begin on <?php echo $day1->format("l, F jS");  ?> and conclude on <?php echo $day3->format("l, F jS"); ?>.</p>

        <?php  if(!$showChkList): ?>
         Please sign in and let us know if you will be able to attend our recruitment events.<br>

          <form class="form-inline" action="index.php" method="post">

              <label class= "sr-only" for="stuVisUsername">Email address</label>
              <input type="email" class="form-control mb-2 mr-sm-2" tabindex="100" id="stuVisUsername" name="stuVisUsername" placeholder="me@example.com" required pattern= "[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*" >


              <label class= "sr-only" for="umid">UMID</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text">UMID</div>
                </div>
                <input type="text" class="form-control bfh-phone" tabindex="110" id="umid" name="umid" data-format="dddddddd" placeholder="12345678" required  pattern="^\d{8}$" title="Please enter your 8 digit UMID">
              </div>

            <input type="submit" name="logon" value="LogIn" tabindex="120" class="btn btn-success mb-2" />
          </form>

          <?php echo(isset($message) ? "<h6 class='logMessage'>{$message}</h6>" : '' );
          endif; ?>

        <p><small class="text-muted">This page will be updated periodically, please check back before your visit.</small></p>
    </div>
  </div>
    <div class="container-fluid">
      <div class="row justify-content-md-center">
        <div class="col-lg-4">
          <p class="h6">Why Choose Michigan <?php echo $deptLngName ?>?</p>
          <p class="font-weight-light"><?php echo $description_blurb ?></p>
        </div>
        <div class="col-auto">
          <p class="h6">Useful Links</p>
           <ul>
             <li class="font-weight-light"><small><a href="<?php echo strtolower($deptURL) ?>" target="_blank">Department of <?php echo $deptLngName ?></a></small></li>
             <li class="font-weight-light"><small><a href="http://www.lsa.umich.edu/<?php echo strtolower($deptShtName) ?>/people/faculty" target="_blank">UM <?php echo $deptLngName ?> Faculty Information</a></small></li>
             <?php  echo(isset($otherDeptURL1) ? "<li class='font-weight-light'><small><a href='{$otherDeptURL1}' target='_blank'>{$otherDeptLngName1}</a></small></li>" : '') ?>
             <li class="font-weight-light"><small><a href="http://www.rackham.umich.edu/" target="_blank">Rackham Graduate School</a></small></li>
             <li class="font-weight-light"><small><a href="http://www.housing.umich.edu/northwood" target="_blank">University Graduate Student Housing</a></small></li>
             <li class="font-weight-light"><small><a href="http://www.itcs.umich.edu/" target="_blank">Information and Technology Services</a></small></li>
          </ul>
          <hr>
          <ul>
            <li class="font-weight-light"><small><a href="https://www.graduatehotels.com/ann-arbor/" target="_blank">The Graduate (Hotel) Information</a></small></li>
            <li class="font-weight-light"><small><a href="Airport%20Transportation.pdf" target="_blank">Shuttle Service to and from Metro Airport</a></small></li>
            <li class="font-weight-light"><small><a href="https://campusinfo.umich.edu/campusmap" target="_blank">All UofM Maps</a></small></li>
            <li class="font-weight-light"><small><a href="https://ltp.umich.edu/parking/visitors.php" target="_blank">UofM Parking</a></small></li>
            <li class="font-weight-light"><small><a href="http://umich.edu/about/" target="_blank">About U-M</a></small></li>
          </ul>
        </div>
        <div class="col-auto">
          <p class="h6">Contact Us</p>
            <ul class="list-group">
             <?php echo(isset($director_name) ? "<li class='list-group-item'><small>$director_title<br><a href='$director_profile_url' target='_blank'>$director_name</a></small></li>"  : '') ?>
             <?php echo(isset($assocdirector_name) ? "<li class='list-group-item'><small>$assocdirector_title<br><a href='$assocdirector_profile_url' target='_blank'>$assocdirector_name</a></small></li>"  : NULL) ?>
             <?php echo(isset($coordinator1_name) ? "<li class='list-group-item'><small>$coordinator1_title<br><a href='$coordinator1_profile_url' target='_blank'>$coordinator1_name</a></small></li>"  : '') ?>
             <?php echo(isset($coordinator2_name) ? "<li class='list-group-item'><small>$coordinator2_title<br><a href='$coordinator2_profile_url' target='_blank'>$coordinator2_name</a></small></li>"  : '') ?>
            </ul>
            <img src="images/photo.jpg" alt="World" class="img-circle img-fluid">
        </div>
      </div>
    </div> <!-- /container -->

<?php include 'footer.php' ?>
<!-- Optional JavaScript -->
<script src="js/bfh_phone.min.js"></script>

  </body>
</html>
