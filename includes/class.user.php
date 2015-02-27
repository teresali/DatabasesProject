<?php 
include ('functions.php');

class User {
  private $userId;
  private $fName;
  private $lName;
  private $email;
  private $groupId;
  private $isAdmin;

  /* Constructor for User class */
  public function __construct($data) {
    $this->userId = $data['userId'];
    $this->fName = $data['fName'];
    $this->lName = $data['lName'];
    $this->email = $data['email'];
    $this->groupId = $data['groupId'];
    $this->isAdmin = $data['isAdmin'];
  }

  /* Getters for private fields */
  public function getFullName() {
    return $this->fName . " " . $this->lName;
  }

  public function getEmail() {
    return $this->email;
  }

  public function getGroupId() {
    return $this->groupId;
  }

  public function isAdmin() {
    return $this->isAdmin;
  }

  public function checkDup($email, $db) {
    $check_dup = db('select * from users where email = "'.$email.'"');
      if($check_dup->num_rows == 1){
        return True;
    }
    return False;
  }

  public function addToDatabase() {

  }
}


?>