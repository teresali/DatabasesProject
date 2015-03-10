<?php 
  session_start();

  function __autoload($class_name) {
    include('includes/class.' . strtolower($class_name) . '.php');
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
  <link href="css/style.css" rel="stylesheet" type="text/css">

  <!-- JS -->
  <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script> <!-- jQuery --> 
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script> <!-- Bootstrap -->
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"> <!-- Font awesome -->
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js"></script> <!-- angularJS -->

  <!-- Google Web Fonts -->


  <!--Favicon -->

</head>

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
      // include('php/login.php');
      header("Location: php/login.php");
    } else if ($_SESSION['isAdmin']) {
      include('dashboard/admin-dashboard.php');
    } else {
      include('dashboard/index.php');
    }
  ?>  

<script>
  $(document).ready(function () {
    console.log("ready");
  });
</script>

