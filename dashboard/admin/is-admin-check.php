<?php

  session_start();

  if(!$_SESSION['isAdmin']) {
    echo "<div style='margin-left:560px; margin-top:200px'><img src='sadface.png' height='200px' width='200px'><p><div style='font-size:50pt; margin-left:50px'>404</div></p><p><div style='font-size:20pt;margin-left:-70px'>Not an Admin Unable to View Page</div></p>";
    header("HTTP/1.0 404 Not Found");
    exit();
  } else {

?>