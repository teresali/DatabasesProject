<?php 
  session_start();
  include('config.php');
  include('html/header.html');

  function __autoload($class_name) {
    include ('includes/class.' . strtolower($class_name) . '.php');
  }

?>
 
<body>

  <?php 
  if (!isset($_SESSION['user'])) {
    include('php/login.php');
  } else if ($_SESSION['isAdmin']) {
    include('php/admin-dashboard.php');
  }else {
    include('php/dashboard.php');
  }
  ?>  
  
</body>
</html>

<script>
  $(document).ready(function () {
    console.log("ready");
  });
</script>

