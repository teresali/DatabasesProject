<?php


public function strip_arr($input_arr) {
  $errors = array();
  $strip_arr = array();
  echo 'inside funct';

  foreach ($input_arr as $input => $val) {
    $stripped = htmlentities(trim($input['val']));
    echo $stripped;

    switch($input['type']) {
      case 'email':
        if (!filter_var($stripped, FILTER_VALIDATE_EMAIL)) {
          echo 'error at email';
          return array_push($errors, 'Email is invalid. ');
        }
      case 'password':
        if (strlen($stripped) < 6) {
          echo 'error at pass';
          return array_push($errors, 'Password is less than 6 characters. ');
        }
      default:
    }
    array_push($strip_arr, {'type': $input['type'], 'val': $stripped});
    console.log('just pushed {$input['type']}');
  }
  return {'arr': $strip_arr, 'errors': $errors};
}

?> 