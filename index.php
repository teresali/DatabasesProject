<?php 
include("config.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Basic Metas -->
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="author" content="Teresa Li">
  <meta name="description" content="Databases Project">

  <title>Databases</title>

  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

  <!-- CSS Files -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet" type="text/css">

  <!-- Google Web Fonts -->


  <!-- Favicon -->

</head>


<body>
  <div id="wrapper">

  Hello World!
  <?php
    $db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if($db->error) {
      echo("Connection Error");
    }
    echo("Conected to Database");

    $q = "CREATE TABLE test (id INT(3))";
    $db->query($q);
    echo("DONE")

  ?>


  </div> <!-- wrapper end -->
</body>


<!-- JS -->
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script> <!-- jQuery --> 
<script type="text/javascript" src="js/bootstrap.min.js"></script> <!-- bootstrap -->
