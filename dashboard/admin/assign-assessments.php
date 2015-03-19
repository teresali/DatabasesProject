<?php include('admin-header.php'); ?>

    <div id="page-wrapper">
        <div id="page-inner">

          <div class="container">
          <div class="row">
          <div class='col-sm-6'>
          <div class="form-group">
          <div class='input-group date' id='datetimepicker1'>
          <input type='text' class="form-control" />
          <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
          </span>
          </div>
          </div>
          </div>
          </div>
          </div>

        </div>
        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER -->
<?php include('admin-footer.php'); ?>

<script type="text/javascript">
  $(function () {
    $('#datetimepicker1').datetimepicker();
  });
</script>