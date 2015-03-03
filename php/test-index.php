<?php 
  include('../config.php');
  function __autoload($class_name) {
    include '../includes/class.' . strtolower($class_name) . '.php';
  }

?>

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
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/style.css" rel="stylesheet" type="text/css">

  <!-- JS -->
  <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script> <!-- jQuery --> 
  <script type="text/javascript" src="js/bootstrap.min.js"></script> <!-- bootstrap -->
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js"></script> <!-- angularJS -->

  <!-- Google Web Fonts -->


  <!-- Favicon -->

</head>


<body>
  <div id="wrapper">

  Hello World!
<?php
  $db = Database::Instance();
  // $db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


  // $q = $db->query("INSERT INTO GroupsToAssess VALUES (1, 2, 3)");

  // $r = $db->query("SELECT * FROM GroupsToAssess"); 
  // $data = $r->fetch_assoc();
  // echo $data['groupId'];

  // $a = new Assessment;


    // $db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if($db->error) {
      echo("Connection Error");
    }
    echo("Connected to Database");

    $q = "CREATE TABLE test (id INT(3))";
    
    $db->query($q);

    $sql = "INSERT INTO test (id) VALUES (456)";

    if ($db->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $db->error;
    }

    $dataQ = "SELECT * FROM test";

    $result = $db->query($dataQ);

    $data = $result->fetch_assoc();

    echo $data["id"];

    echo("DONE")

?>


  </div> <!-- wrapper end -->
</body>

<script>
  // testing jQuery
  $(document).ready(function() {
    if (typeof jQuery == 'undefined') {
      console.log("jQuery not loaded");
    } else {
      console.log("WOOHOO!");
    }
  });



</script>





