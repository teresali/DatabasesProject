<?php


function strip($input, $type) {
  $stripped = htmlentities(trim($input));
  $errors = []

  switch($type) {  
    case 'email':
      if (!filter_var($stripped, FILTER_VALIDATE_EMAIL)) {
        return "";
      }

    case 'password':
      if (strlen($stripped) < 6) {
        return "";
      }

    default:
      return $stripped;


  }
  return $stripped;
}

?>