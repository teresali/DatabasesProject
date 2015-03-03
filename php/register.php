<?php
  session_start();
  echo DOC_ROOT;
  include_once(DOC_ROOT.'/html/header.html');
  // include_once('functions.php');
 
  // function __autoload($class_name) {
  //   include ('includes/class.' . strtolower($class_name) . '.php');
  // }
?>

  <div class="jumbotron">
    <div id="register-box" class="white-box container-fluid text-center">
      <img src="/absinth/img/logo-in.png" alt="Absinth">
      <!-- <form class="form-horizontal form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> -->
      <form class="form-horizontal form" method="post" action="form-handler.php">
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
            <button id="submit" type="submit" class="btn btn-primary btn-block" name="submit">Sign Up</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  
  <?php

  // $db = Database::Instance();

  // if(isset($_POST['submit'])) {
  //   echo('hit submit');
  //   $args = array(
  //     array('type'=>''        , 'val'=>$_POST['fName']),
  //     array('type'=>''        , 'val'=>$_POST['lName']),
  //     array('type'=>'email'   , 'val'=>$_POST['email']),
  //     array('type'=>'password', 'val'=>$_POST['password'])
  //   );
  //   $output = strip_arr($args);
  //   $arr = $output['arr'];
  //   $errors = $output['errors'];

  //   if (User::isDuplicate($email, $db)) {
  //     array_push($errors, "Account already exists for this email. ");
  //   }

  //   if (sizeof($errors) != 0) {
  //     $hashed_pass = hash('sha256', $pass);

  //     $q = "INSERT INTO Users ('fName', 'lName', 'email', 'password') VALUES ({$arr['fName']}, {$arr['lName']}, {$$arr['email']}, {$arr['hashed_pass']})";
  //     echo 'INSERTED';

  //     $_SESSION['user'] = new User();
  //     // navigate to dashboard
  //     header('Location: ../index.php');
  //   } else {

  //   }
  // }

  ?>