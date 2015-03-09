<?php 
session_start();
include_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.database.php');


class User {
  private $id;
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
  public function getFname() {
    return $this->fName;
  }
  public function getLname() {
    return $this->lName;
  }
  public function getFullName() {
    return $this->fName . " " . $this->lName;
  }
  public function getEmail() {
    return $this->email;
  }
  public function getGroupId() {
    return $this->groupId;
  }
  public function setGroupId($id) {
    $this->groupId = $id;
  }
  public function isAdmin() {
    return $this->isAdmin;
  }

  public function isDuplicate($email, $db) {
    $check_dup = $db->query("SELECT * FROM users WHERE email = '{$email}'");
    if ($check_dup->num_rows == 1) {
      return True;
    }
    return False;
  }

  public function addUser($data, $db) {
    $hashed_pass = hash('sha256', $data['password']);
    // add user info to database
    $q = "INSERT INTO users (fName, lName, email, password, isAdmin) VALUES ('{$data['fName']}', '{$data['lName']}', '{$data['email']}', '{$hashed_pass}', {$data['isAdmin']})";
    $db->query($q);
    // //set user session variable 
    $id = $db->getMysqli()->insert_id;
    $q = "SELECT * from users WHERE userId = {$id}";
    $r = $db->query($q);
    if ($r) {
      $data = $r->fetch_assoc();
      $_SESSION['user'] = new User($data);
    } else {
      echo 'error';
    }
  }


}


?>