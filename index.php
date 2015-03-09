<?php 
  session_start();
  // include_once('header.php');

  function __autoload($class_name) {
    include('includes/class.' . strtolower($class_name) . '.php');
  }
?>

  <?php 

    // $DB = Database::Instance();
    // // $DB = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    // $r = $DB->query("SELECT * from Users");
    // if ($r) {
    //   $data = $r->fetch_assoc();
    //   echo "{$data['fName']} works";
    // }
    // else {
    //   echo 'Somethings wrong..';
    // }

    if (!isset($_SESSION['user'])) {
      include('php/login.php');
    } else if ($_SESSION['isAdmin']) {
      include('dashboard/admin-dashboard.php');
    }else {
      include('dashboard/index.php');
    }
  ?>  

<script>
  $(document).ready(function () {
    console.log("ready");
  });
</script>

