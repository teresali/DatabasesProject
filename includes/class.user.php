<?php 
session_start();

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
    $this->isAdmin = $data['isAdmin'];
  }

  /* Getters for private fields */
  public function getUserId() {
    return $this->userId;
  }
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

  // checks  if the user is already in the database
  public function isDuplicate($email, $db) {
    $check_dup = $db->query("SELECT * FROM users WHERE email = '{$email}'");
    if ($check_dup->num_rows == 1) {
      return True;
    }
    return False;
  }

  // adds a user to the database
  public function addUser($data, $db) {
    $hashed_pass = hash('sha256', $data['password']);
    // add user info to database
    $q = "INSERT INTO users (fName, lName, email, password, isAdmin) VALUES ('{$data['fName']}', '{$data['lName']}', '{$data['email']}', '{$hashed_pass}', {$data['isAdmin']})";
    $db->query($q);
    // //set user session variable 
    $id = $db->getMysqli()->insert_id;
    $data['userId'] = $id;
    $user = new User($data);
    // to be removed!
    $user->setGroupId(1);
    $_SESSION['user'] = $user;
  }

  // retrieves the group members for a given project
  public function getGroupMembers($db, $groupId, $projectId) {
    $q = "SELECT fName, lName from (
            SELECT userId from groups where groupId={$groupId} and projectId={$projectId}) x 
            INNER JOIN users on x.userId = users.userId";
    $r = $db->query($q);

    while($user =& $r->fetch_assoc()) {
      $members .= $user['fName']." ".$user['lName'].", ";
    }
    return substr($members, 0, -2);
  }

  // retrieves all the assessments for a group's report
  public function getAssessments($db, $groupId, $projectId) {
    $q = "SELECT * from assessments where groupAssessed={$groupId} and projectId={$projectId}";
    $r = $db->query($q);

    $result = array();
    while($assessment =& $r->fetch_assoc()) {
      array_push($result, $assessment);
    }
    return $result;
  }

}


?>