<?php 
  session_start();

  function __autoload($class_name) {
    include('includes/class.' . strtolower($class_name) . '.php');
  }
 
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
    header('Location: php/login.php');
  } else if ($_SESSION['isAdmin']) {
    header('Location: dashboard/admin-index.php');
  } else {
    header('Location: dashboard/index.php');
  }
?>  

<script>
  $(document).ready(function () {
    console.log("ready");
  });
</script>

<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>