<?php
  session_start();
?>

  <div class="jumbotron">
    <div id="login-box" class="white-box container-fluid text-center">
      <img src="img/logo-in.png" alt="Absinth">
      <form class="form-horizontal form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
          <input id="email" class="form-control" type="email" placeholder="Email" name="email" required>
        </div>
        <div class="form-group">
          <input id="password" class="form-control" type="password" placeholder="Password" name="password" required>
        </div>
        <div class="form-group">
          <button id="submit" type="submit" class="btn btn-primary btn-block" name="submit">Sign in</button>
        </div>
          Not a Member? <a href="php/register.php">Register Here</a>
      </form>
    </div>
  </div>

<?php
  
  if (errorCheck())


?>
