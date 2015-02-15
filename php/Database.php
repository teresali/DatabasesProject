<?php
include('config.php');


class Database {
  private $mysqli;

  public function __construct() { 
    $this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if($this->mysqli->error) {
      console.log("DB connection error");
    } else {
      console.log("Connected to database");
    }
  }

  public function getMysqli() {
    return $this->mysqli;
  }

  public function query($q) {
    return $this->mysqli->query($q);
  }
}

?>