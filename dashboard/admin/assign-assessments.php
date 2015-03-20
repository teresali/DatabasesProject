<?php 
  session_start();
  // redirects to 404 page if user is not an admin
  if(!$_SESSION['isAdmin']) {
    echo "<div style='margin-left:560px; margin-top:200px'><img src='sadface.png' height='200px' width='200px'><p><div style='font-size:50pt; margin-left:50px'>404</div></p><p><div style='font-size:20pt;margin-left:-70px'>Not an Admin Unable to View Page</div></p>";
    header("HTTP/1.0 404 Not Found");
    exit();
  } else {

  include('admin-header.php'); 

?>

    <div id="page-wrapper">
        <div id="page-inner">

          

        </div>
        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER -->

<?php 

include('admin-footer.php'); 

}?>

<script type="text/javascript">
  
</script>