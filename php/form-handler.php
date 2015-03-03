<?php
  // echo get_cwd();
  include_once($_SERVER["DOCUMENT_ROOT"].'/php/functions.php');

  function __autoload($class_name) {
    include ('includes/class.' . strtolower($class_name) . '.php');
  }
  echo 'hello';
  
  // $db = Database::Instance();
  echo 'whatup';

  if(isset($_POST['submit'])) {
    echo('hit submit');
    $args = array(
      array('type'=>''        , 'val'=>$_POST['fName']),
      array('type'=>''        , 'val'=>$_POST['lName']),
      array('type'=>'email'   , 'val'=>$_POST['email']),
      array('type'=>'password', 'val'=>$_POST['password'])
    );
    echo $args;
    $output = strip_arr($args);
    $arr = $output['arr'];
    echo $arr['email'];
    $errors = $output['errors'];

    if (User::isDuplicate($email, $db)) {
      array_push($errors, "Account already exists for this email. ");
    }
    echo $errors;
    if (sizeof($errors) != 0) {
      $hashed_pass = hash('sha256', $pass);

      $q = "INSERT INTO Users ('fName', 'lName', 'email', 'password') VALUES ({$arr['fName']}, {$arr['lName']}, {$$arr['email']}, {$arr['hashed_pass']})";
      echo 'INSERTED';

      $_SESSION['user'] = new User();
      // navigate to dashboard
      header('Location: ../index.php');
    } else {

    }
  }

  ?>