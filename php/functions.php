<?php


function strip_arr($input_arr, $db) {
  $errors = '';
  $strip_arr = array();

  foreach($input_arr as $type => $val) {
    $stripped = $db->escape_string(htmlentities(trim($val)));

    switch($type) {
      case 'email':
        if (!filter_var($stripped, FILTER_VALIDATE_EMAIL)) {
          $errors .= 'Email is invalid. ';
        }
      case 'password':
        if (strlen($stripped) < 6) {
          $errors .= 'Password is less than 6 characters. ';
        }
      default:
    }
    $strip_arr[$type] = $stripped;
  }
  return array('arr' => $strip_arr, 'errors' => $errors);
}

?> 