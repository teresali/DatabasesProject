<?php
  // FILE USED FOR TESTING PURPOSES ONLY


  session_start();
  include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
  // // echo DOC_ROOT.'/php/functions.php';
  include_once(DOC_ROOT.'/php/functions.php');
  
  function __autoload($class_name) {
    include($_SERVER['DOCUMENT_ROOT'] . '/includes/class.' . strtolower($class_name) . '.php');
  }

  // session_start();
  
  $DB = Database::Instance();

  if(isset($_POST['submit'])) {

    // $args = array(
    //   'fName'     => $_POST['fName'],
    //   'lName'     => $_POST['lName'],
    //   'email'     => $_POST['email'],
    //   'password'  => $_POST['password'],
    //   'isAdmin'   => 0  // user is not an admin
    // );
    // $output = strip_arr($args);
    // $data = $output['arr'];
    // $errors = $output['errors'];
    // $email = $data['email'];

    // if(User::isDuplicate($email, $DB)) {
    //   $errors = 'Account already exists for this email.';
    // }

    // echo $errors;
    // if ($errors == '') {
    //   User::addUser($data, $DB);
    //   header("Location: ../index.php");
    // } else {

    // }
  }

  ?>