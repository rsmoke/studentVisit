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
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <?php  echo(($showChkList === true) ? "<li class='nav-item myVisitChkLst'><a class='nav-link' href='php/stuVisChklst.php' >MiVisit Checklist</a></li>" : '') ?>
          <li class="nav-item">
            <a class="nav-link" href="studentVisitMap.php">Map</a>
          </li>
          <li class="nav-item active">
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

    <div class="container-fluid">

      <div class="innerPage">
        <h2>Student Visit Events</h2>
      </div>
      <div class="btn-group">
        <button id="btnFirst" class ="btn btn-primary btn-sm" role="button">First Day</button>
        <button id="btnSecond" class ="btn btn-success btn-sm" role="button">Second Day</button>
        <button id="btnLast"  class ="btn btn-info btn-sm" role="button">Last Day</button>
        <button id="btnOther"  class ="btn btn-secondary btn-sm" role="button">Virtual Events</button>
        <button id="btnAll"  class ="btn btn-outline-primary btn-sm" role="button">All Events</button>
        <!-- <a href="scheduleSAB.pdf"><button id='btnDwnld' class='btn btn-sm btn-link'><i class="fas fa-download"></i></button></a> -->
      </div>
      <div class="table-responsive">
        <table id="eventsFirst" class="table table-sm table-striped">
          <thead class="thead-dark">
            <tr class="m-0">
              <th style="width: 10%;" scope="col">Start</th>
              <th style="width: 10%;" scope="col">End</th>
              <th class="w-25" scope="col">Name</th>
              <th style="width: 30%;" scope="col">Description</th>
              <th class="w-25" scope="col">Location</th>
            </tr>
          </thead>
          <tbody>
            <?php include "php/eventsFirst.php"; ?>
          </tbody>
        </table>
      </div>
      <div class="table-responsive">
        <table id="eventsSecond" class="table table-sm table-striped">
          <thead class="thead-dark">
            <tr class="m-0">
              <th style="width: 10%;" scope="col">Start</th>
              <th style="width: 10%;" scope="col">End</th>
              <th class="w-25" scope="col">Name</th>
              <th style="width: 30%;" scope="col">Description</th>
              <th class="w-25" scope="col">Location</th>
            </tr>
          </thead>
          <tbody>
            <?php include "php/eventsSecond.php"; ?>
          </tbody>
        </table>
      </div>
      <div class="table-responsive">
         <table id="eventsThird" class="table table-sm table-striped">
          <thead class="thead-dark">
            <tr class="m-0">
              <th style="width: 10%;" scope="col">Start</th>
              <th style="width: 10%;" scope="col">End</th>
              <th class="w-25" scope="col">Name</th>
              <th style="width: 30%;" scope="col">Description</th>
              <th class="w-25" scope="col">Location</th>
            </tr>
          </thead>
          <tbody>
            <?php include "php/eventsThird.php"; ?>
          </tbody>
        </table>
      </div>

      <div id="eventsOther" class="table-responsive">
        <div class="h3">Virtual Events Happening Around Recruitment</div>
         <table class="table table-sm table-striped">
          <thead class="thead-dark">
            <tr class="m-0">
              <th style="width: 20%;" scope="col">Start</th>
              <th class="w-20" scope="col">Name</th>
              <th style="width: 35%;" scope="col">Description</th>
              <th class="w-15" scope="col">Notes</th>
              <th class="w-10" scope="col">Location</th>
            </tr>
          </thead>
          <tbody>
            <?php include "php/eventsOther.php"; ?>
          </tbody>
        </table>
      </div>

    </div><!-- /.container -->

    <?php include 'footer.php' ?>
    <!-- Optional JavaScript -->
    <script src="js/studentVisitEvent.js"></script>
  </body>
</html>
