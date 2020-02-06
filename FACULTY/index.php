<?php 
// include and create object
require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/configStudentVisit.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/../Support/basicLib.php");

?>

<!doctype html>
<html lang='en'>
  <head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='description' content=''>
    <meta name='author' content=''>
    <link rel="shortcut icon" href="../ico/favicon.ico">

    <title>Faculty Appointments LSA Sociology - Student Visit</title>

    <!-- Bootstrap core CSS -->
    <link href='../css/bootstrap.min.css' rel='stylesheet'>

    <!-- Custom styles for this template -->
    <link href='../css/jumbotron.css' rel='stylesheet'>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js'></script>
      <script src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js'></script>
    <![endif]-->
  </head>

  <body>

    <div class='navbar navbar-inverse navbar-fixed-top' role='navigation'>
      <div class='container'>
        <div class='navbar-header'>
          <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'>
            <span class='sr-only'>Toggle navigation</span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
          </button>
          <a class='navbar-brand' href='../index.html'>LSA Sociology Student Visit</a>
        </div>
        <div class='collapse navbar-collapse'>
          <ul class='nav navbar-nav'>
            <li><a href='..index.php'>Home</a></li>
            <li><a href='..studentVisitMap.php'>Map</a></li>
            <li><a href='..studentVisitEvents.php'>Events</a></li>
          </ul>
          <p class='navbar-text navbar-right'>You are logged in as <?php echo $login_name;?></p>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class='container'>
      <div id='instructions' class='col-md-8'>
        <h1>Student Visit Faculty Appointments</h1>
        <p> In order for the visiting students to make 1/2 hour appointments to discuss how their interests fit with 
          your research, we ask that you set times that you are available for appointments.<p>
          <p><u>Instructions:</u><br />
          <ul>
          <li>Enter the room location (<em>Room Number and Building i.e <strong>4123 LSA</strong></em>) that you will meet in.</li> 
          <li>Place a check next to each appointment slot that you are available for. Click <button id='dummy' class='btn btn-warning btn-sm' disabled='disabled'>All Day</button> to choose all the appointment slots for that day.</li>
          <li>Click the <button id='dummy' class='btn btn-primary btn-sm' disabled='disabled'>Add</button> button at the bottom of the page.</li>
          <li><em>If you need to cancel a slot that you have set as an appointment time please contact the <a href="mailto:lsa-soc-gradprogram@umich.edu?subject=SocStudentVisit Appointment Deletion request">Soc-Grad office</a>
        </ul><p>
      </div><!-- #instructions -->
    </div>

    <div class='container'>
      <h5 class='col-md-8'>These are the start-times for the 1/2 hour appointments you have made available to meet with students. When an appointment has been set by a visiting student you will see their email listed next to the appointment</h5> 
      <div class='row'>
        <div id='apptBox' class='well col-md-6 col-md-offset-1'>
          <span id='currAppts'></span>
        </div><!-- apptList-->
      </div>
      <div class='col-sm-offset-1 col-sm-8'>
        <form id='facApptForm' role='form' action=''>
          <input type='text' id='roomLoc' name='roomLoc' value='' placeholder='Room Location'>
          <table class='table table-condensed'>
            <thead>
              <tr><th><?php echo $day2->format('l, F jS') ?></th></tr>
            </thead>
            <tbody>
              <tr>
                <td><button id='allDay1' class='btn btn-warning btn-sm'>All Day</button></td>
              </tr>              
              <tr>
                <td><input disabled class='cbDay1' type='checkbox' value='1' name='d1-09:00'> 9:00 to 9:30</td><td><input disabled class='cbDay1' type='checkbox' value='1' name='d1-09:30'> 9:30 to 10:00</td>
              </tr>
              <tr>
                <td><input disabled class='cbDay1' type='checkbox' value='1' name='d1-10:00'> 10:00 to 10:30</td><td><input class='cbDay1' type='checkbox' value='1' name='d1-10:30'> 10:30 to 11:00</td>
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
                <td><input class='cbDay1' type='checkbox' value='1' name='d1-16:00'> 4:00 to 4:30</td><td><input disabled class='cbDay1' type='checkbox' value='1' name='d1-16:30'> 4:30 to 5:00</td>
              </tr>
              <tr>
                <td><input disabled class='cbDay1' type='checkbox' value='1' name='d1-17:00'> 5:00 to 5:30</td><td><input disabled class='cbDay1' type='checkbox' value='1' name='d1-17:30'> 5:30 to 6:00</td>
              </tr>
            <tbody>                                                                                    
          </table>
          <hr>
          <table class='table table-condensed'>
            <thead>
              <tr><th><?php echo $day3->format('l, F jS') ?></th></tr>
            </thead>
            <tbody>
              <tr>
                <td><button id='allDay2' class='btn btn-warning btn-sm'>All Day</button></td>
              </tr>                  
              <tr>
                <td><input class='cbDay2' type='checkbox' value='1' name='d2-09:00'> 9:00 to 9:30</td><td><input class='cbDay2' type='checkbox' value='1' name='d2-09:30'> 9:30 to 10:00</td>
              </tr>
              <tr>
                <td><input class='cbDay2' type='checkbox' value='1' name='d2-10:00'> 10:00 to 10:30</td><td><input class='cbDay2' type='checkbox' value='1' name='d2-10:30'> 10:30 to 11:00</td>
              </tr>
              <tr>
                <td><input class='cbDay2' type='checkbox' value='1' name='d2-11:00'> 11:00 to 11:30</td><td><input class='cbDay2' type='checkbox' value='1' name='d2-11:30'> 11:30 to Noon</td>
              </tr>
              <tr>
                <td><input class='cbDay2' type='checkbox' value='1' name='d2-12:00'> Noon to 12:30</td><td><input class='cbDay2' type='checkbox' value='1' name='d2-12:30'> 12:30 to 1:00</td>
              </tr>
              <tr>
                <td><input class='cbDay2' type='checkbox' value='1' name='d2-13:00'> 1:00 to 1:30</td><td><input class='cbDay2' type='checkbox' value='1' name='d2-13:30'> 1:30 to 2:00</td>
              </tr>
              <tr>
                <td><input class='cbDay2' type='checkbox' value='1' name='d2-14:00'> 2:00 to 2:30</td><td><input class='cbDay2' type='checkbox' value='1' name='d2-14:30'> 2:30 to 3:00</td>
              </tr>
              <tr>
                <td><input class='cbDay2' type='checkbox' value='1' name='d2-15:00'> 3:00 to 3:30</td><td><input class='cbDay2' type='checkbox' value='1' name='d2-15:30'> 3:30 to 4:00</td>
              </tr>
              <tr>
                <td><input class='cbDay2' type='checkbox' value='1' name='d2-16:00'> 4:00 to 4:30</td><td><input class='cbDay2' type='checkbox' value='1' name='d2-16:30'> 4:30 to 5:00</td>
              </tr>
              <tr>
                <td><input class='cbDay2' type='checkbox' value='1' name='d2-17:00'> 5:00 to 5:30</td><td><input class='cbDay2' type='checkbox' value='1' name='d2-17:30'> 5:30 to 6:00</td>
              </tr>
            <tbody>                                                                                    
          </table>
          <div class='form-group'>
            <div>
              <button id='apptSub' type='submit' class='btn btn-primary'>Add</button>
            </div>
          </div> 

         </form>
        </div> 
    </div>

    <hr>

    <div class='container'>

      <footer>
        <p>Copyright &copy; 2014 by The Regents of the University of Michigan<br />
        All Rights Reserved.</p>
      </footer>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src='../js/jquery-1.11.0.min.js'></script>
    <script src='js/apptStuVisit.js'></script>
    <script src='../js/bootstrap.min.js'></script>
  </body>
</html>