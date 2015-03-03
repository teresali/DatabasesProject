<?php 
  session_start();
  include('header.php');

?>
 
<body>

  <?php 

  $DB = Database::Instance();
  // $DB->query("CREATE TABLE Users (userId int AUTO_INCREMENT, fName VARCHAR(255), lName VARCHAR(255), email VARCHAR(255), password VARCHAR(255), groupId int, isAdmin int, PRIMARY KEY('userId'))");
  // $DB = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  if($DB->error) {
      echo("Connection Error");
  }
  else {
    echo("Connected to Database");
  }
  
  // $DB->query("INSERT INTO Users (fName, lName, email, password, groupId, isAdmin) VALUES ('Teresa', 'Li', 'myemail', 'pass', 1, 2)");
  $r = $DB->query("SELECT * from Users");
  if ($r) {
    $data = $r->fetch_assoc();
  }
  else {
    echo 'shit';
  }
  // echo $data['fName'];

  if (!isset($_SESSION['user'])) {
    include('php/login.php');
  } else if ($_SESSION['isAdmin']) {
    include('dashboard/admin-dashboard.php');
  }else {
    include('dashboard/dashboard.php');
  }
  ?>  
  
</body>
</html>

<script>
  $(document).ready(function () {
    console.log("ready");
  });
</script>

