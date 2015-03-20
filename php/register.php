<?php 
  session_start();
  include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
  include_once(DOC_ROOT.'/php/functions.php');
 
  function __autoload($class_name) {
    include ($_SERVER['DOCUMENT_ROOT'].'/includes/class.' . strtolower($class_name) . '.php');
  }


  $DB = Database::Instance();
  
  if(isset($_POST['submit'])) {
    $args = array(
      'fName'     => $_POST['fName'],
      'lName'     => $_POST['lName'],
      'email'     => $_POST['email'],
      'password'  => $_POST['password'],
      'isAdmin'   => 0  // user is not an admin
    );
    // strips the array of arguments for html tags and sql injections
    // function is written in php/functions.php
    $output = strip_arr($args, $DB);
    $data = $output['arr'];
    $errors = $output['errors'];
    $email = $data['email'];

    if(User::isDuplicate($email, $DB)) {
      $errors = 'Account already exists for this email.';
    }

    if($errors == '') {
      User::addUser($data, $DB);
      header("Location: ../index.php");
      exit();
    }
  }

?>
<!DOCTYPE HTML>
<html lang="en">
<head>
  <!-- Basic Metas -->
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="author" content="Rebecca Howarth, Teresa Li, Tomasz Stefaniak">
  <meta name="description" content="Absinth is a group peer assessment website that allows students to submit reports and receive feedback from their peers. With a simple and easy-to-use interface, Absinth is a perfect tool for teachers to use in order to engage students.">

  <title>Absinth | Peer Assessment</title>

  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

  <!-- CSS Files -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
  <link href="../css/style.css" rel="stylesheet" type="text/css">

  <!-- JS -->
  <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script> <!-- jQuery --> 
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script> <!-- Bootstrap -->
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"> <!-- Font awesome -->
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js"></script> <!-- angularJS -->

  <!-- Google Web Fonts -->


  <!--Favicon -->

</head>

<body>
  <div class="jumbotron">
    <div id="register-box" class="white-box container-fluid text-center">
      <img src="../img/logo-in.png" alt="Absinth">
      <div class="errors"> <?php if($errors) { echo $errors; } ?> </div>
      <form class="form-horizontal form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
          <label for="fName" class="col-sm-3 control-label">First Name</label>
          <div class="col-sm-9">
            <input id="fName" class="form-control" type="text" name="fName" required>
          </div>
        </div>
          
        <div class="form-group">
          <label for="lName" class="col-sm-3 control-label">Last Name</label>
          <div class="col-sm-9">
            <input id="lName" class="form-control" type="text" name="lName" required>
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-sm-3 control-label">Email</label>
          <div class="col-sm-9">
            <input id="email" class="form-control" type="email" name="email" required>
          </div>
        </div>
        <div class="form-group">
          <label for="password" class="col-sm-3 control-label">Password</label>
          <div class="col-sm-9">
            <input id="password" class="form-control" type="password" name="password" required>
            <div class="font-8 pull-left">
              6 or more characters
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-9 col-sm-offset-3 font-10">
            By clicking Sign Up, you agree to our <a href="#">Terms</a>, <a href="#">Privacy Policy</a> and <a href="#">Data Policy</a>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-9 col-sm-offset-3">
            <button type="submit" class="btn btn-primary btn-block" name="submit">Sign Up</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>  