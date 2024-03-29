<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Holiday
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Employees</li>
        <li class="active">Holiday</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
  <?php
    if (isset($_SESSION['error'])) {
      echo "
        <div class='alert alert-danger alert-dismissible'>
          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
          <h4><i class='icon fa fa-warning'></i> Error!</h4>
          ".$_SESSION['error']."
        </div>
      ";
      unset($_SESSION['error']);
    }
    if (isset($_SESSION['success'])) {
      echo "
        <div class='alert alert-success alert-dismissible'>
          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
          <h4><i class='icon fa fa-check'></i> Success!</h4>
          ".$_SESSION['success']."
        </div>
      ";
      unset($_SESSION['success']);
    }
  ?>

  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header with-border">
          <a href="#addnewhol" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
        </div>
        <div class="box-body">
          <table id="example1" class="table table-bordered">
            <thead>
              <tr>
                <th>Employee Code</th>
                <th>Employee Name</th>
                <th>Holiday Type</th>
                <th>No_Hours</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Tools</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $sql = "SELECT h.*,h.id as id, e.firstname as firstname, e.lastname as lastname FROM employees AS e JOIN holiday AS h ON e.employee_id = h.employee_id";
                $query = $conn->query($sql);
                while ($row = $query->fetch_assoc()) {
                  echo "
                    <tr>
                      <td>".$row['employee_id']."</td>
                      <td>".$row['firstname'].' '.$row['lastname']."</td>
                      <td>".$row['hol_type']."</td>
                      <td>".number_format($row['hours'], 2)."</td>
                      <td>".number_format($row['amount'], 2)."</td>
                      <td>".date('M d, Y', strtotime($row['date']))."</td>
                      <td>
                      <button class='btn btn-success btn-sm edit btn-flat' data-id='".$row['id']."'><i class='fa fa-edit'></i> Edit</button>
                      <button class='btn btn-danger btn-sm delete btn-flat' data-id='".$row['id']."'><i class='fa fa-trash'></i> Delete</button>
                      </td>
                    </tr>
                  ";
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/holiday_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $('.edit').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

$( ".table" ).on( "click", ".delete", function(e) {
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
});

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'holiday_row.php',
    data: {id: id},
    dataType: 'json',
    success: function(response){
      console.log(response);
      $('.decid').val(response.id);
      $('#edit_holiday-type').val(response.hol_type);
      $('#edit_holiday-typehours').val(response.hours);
      $('#edit_holiday-typeamount').val(response.amount);
      $('#datepicker_edit').val(response.date);
      $('#del_deduction').html(response.description);
    }
  });
}

</script>

</body>
</html>