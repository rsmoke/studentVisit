<?php
// include and create object
  require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/configStudentVisit.php");
  require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/basicLib.php");

//if cosigned login name is in tbl_admin table show Admin section of application. Else show
//  access denied section of page.
if ($isAdmin){
  //Check for deletion of Admin (remove uniqname from tbl_admin table)
  if(isset($_GET['bl1pA']) && ($_GET['bl1pA'] <> 1) ) {
    $result = $db->query('DELETE FROM tbl_admin WHERE id = '.(int)$_GET['bl1pA']);
  }
?>

<!doctype html>
<html lang="en">
<?php include 'header.php' ?>

  <body>

    <nav class="navbar navbar-expand-sm navbar-dark sticky-top" style="background-color: #00274c;">
      <a class="navbar-brand" href="../index.php"><?php echo $siteTitle ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Admin-Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="php/eventView.php">Manage Events</a>
          </li>
            <li class="nav-item">
              <a class="nav-link" href="php/studentView.php">Student Info</a>
            </li>
            <?php if ($use_faculty_appt_system){ ?>
            <li class="nav-item">
              <a class="nav-link" href="php/facAppts.php">Faculty Appointments</a>
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
        <h1>Student Visit Management Interface</h1>
      </div><!-- #instructions -->
    </div>

    <div class='container-fluid'>
      <div class="row">
        <div class="col  offset-1">
          <p>These are the current individuals who are permitted to manage the Student Visit site</p>
          <div class='row'>
            <div id="adminBox">
              <span id="currAdmins"></span>
            </div><!-- adminList-->
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col  offset-1">
          <div id="AForm"><!-- add Admin -->
            <p>If you would like to register another Administrator please enter their <b>uniqname</b> here</p>
            <form id="myAdminForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <input type="text" name="name" />
                <button id="adminSub" class='btn btn-sm btn-primary'>Add</button><br /><i>--look up uniqnames using the <a href="https://mcommunity.umich.edu/" target="_blank">Mcommunity directory</a>.</i>
            </form>
          </div><!-- #AForm -->
        </div>
      </div>
    </div>

<?php include 'footer.php' ?>
<!-- Optional JavaScript -->
    <script src="js/AdminStudentVisit.js"></script>

  </body>
</html>
<?php

} else {

?>
<!doctype html>
<html lang="en">
<?php include 'header.php' ?>
  <body>

    <div class="container col-md-6 col-md-offset-3">
      <div>
        <h3 class="bg-warning">You are not authorized to view this page please return to the <a href="../index.php"><?php echo $siteTitle ?></a>.</h3>
      </div>
    </div><!-- /.container -->
    <?php include 'footer.php' ?>
    <!-- Optional JavaScript -->
  </body>
</html>
<?php
}

$db->close();
