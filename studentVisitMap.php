<?php
// include and create object
  require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/configStudentVisit.php");

  session_start();
  $showChkList = false;

 if (isset($_SESSION['stuVisUsername'], $_SESSION['umid'])){
  //show stuVisChklist button
    $showChkList = true;
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
          <!-- <li class="nav-item active">
            <a class="nav-link" href="studentVisitMap.php">Map</a>
          </li> -->
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

    <div class="container-fluid">

      <div class="innerPage">
        <h2>Student Visit Map</h2>
        <h4>For details click on marked event locations</h4>
      		<div id="map">
            <?php echo "<iframe src='" . $visitMapURL . "' width='640' height='480'></iframe>"; ?>
          </div>
      </div>
    </div><!-- /.container -->

<?php include 'footer.php' ?>
  </body>
</html>
