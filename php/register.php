<?php
  session_start();
  include('../html/header.html');
?>

  <div class="jumbotron">
    <div id="register-box" class="white-box container-fluid text-center">
      <img src="/absinth/img/logo-in.png" alt="Absinth">
      <form class="form-horizontal form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
          <label for="fName" class="col-sm-3 control-label">First Name</label>
          <div class="col-sm-9">
            <input id="fName" class="form-control" type="text" name="fName">
          </div>
        </div>
          
        <div class="form-group">
          <label for="lName" class="col-sm-3 control-label">Last Name</label>
          <div class="col-sm-9">
            <input id="lName" class="form-control" type="text" name="lName">
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-sm-3 control-label">Email</label>
          <div class="col-sm-9">
            <input id="email" class="form-control" type="email" name="email">
          </div>
        </div>
        <div class="form-group">
          <label for="password" class="col-sm-3 control-label">Password</label>
          <div class="col-sm-9">
            <input id="password" class="form-control" type="password" name="password">
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

  if(isset($_POST['submit'])) {

  }

  ?>