<?php include 'includes/session.php'; ?>
<?php
  include '../timezone.php';
  $range_to = date('m/d/Y');
  $range_from = date('m/d/Y', strtotime('-30 day', strtotime($range_to)));
?>
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
        Payroll
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Payroll</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
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
              <!-- <div class="pull-left"> -->

              <!-- <button type="button" class="btn btn-success btn-sm btn-flat" href="#addnewpay" data-toggle="modal"> -->

              <!-- <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a> -->

                <!-- <span  class="glyphicon glyphicon-pencil"></span> Create Payroll</button> -->
                
                
              <!-- </div> -->
              <div class="pull-right">
                <form method="POST" class="form-inline" id="payForm">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right col-sm-8" id="reservation" name="date_range" value="<?php echo (isset($_GET['range'])) ? $_GET['range'] : $range_from.' - '.$range_to; ?>">
                  </div>
                  <button type="button" class="btn btn-success btn-sm btn-flat" id="payroll"><span class="glyphicon glyphicon-print"></span> Admin Payroll</button>
                  <button type="button" class="btn btn-primary btn-sm btn-flat" id="payslip"><span class="glyphicon glyphicon-print"></span> Payslip</button>
                </form>
              </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Employee Name</th>
                  <th>Employee ID</th>
                  <th>Gross</th>
                  <th>Other Deductions</th>
                  <th>Total Mandatory Deductions</th>
                  <th>Net Pay</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT *, SUM(amount) as total_amount FROM deductions";
                    $query = $conn->query($sql);
                    $drow = $query->fetch_assoc();
                    $deduction = $drow['total_amount'];
   
                    
                    $to = date('Y-m-d');
                    $from = date('Y-m-d', strtotime('-30 day', strtotime($to)));

                    if(isset($_GET['range'])){
                      $range = $_GET['range'];
                      $ex = explode(' - ', $range);
                      $from = date('Y-m-d', strtotime($ex[0]));
                      $to = date('Y-m-d', strtotime($ex[1]));
                    }

                    $sql = "SELECT *, SUM(num_hr) AS total_hr,  SUM(sales.amount) AS totalsales, attendance.employee_id AS empi, employees.employee_id as employee_id FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id LEFT JOIN position ON position.id=employees.position_id LEFT JOIN sales ON sales.employee_id=employees.employee_id WHERE date BETWEEN '$from' AND '$to' AND position.description IN ('ADMIN STAFF', 'UNIT MANAGER') GROUP BY attendance.employee_id ORDER BY employees.lastname ASC, employees.firstname ASC";

                    $query = $conn->query($sql);
                    $total = 0;
                    while($row = $query->fetch_assoc()){
                      $empid = $row['empid'];
                      
                      $casql = "SELECT *, SUM(amount)+ SUM(sss)+ SUM(pagibig)+ SUM(philhealth)+ SUM(tax) AS cashamount FROM cashadvance WHERE employee_id='$empid' AND date_advance BETWEEN '$from' AND '$to' group by amount,sss,pagibig,philhealth,tax";
                      
                      $salesdeduct = "SELECT sa.*, SUM(sa.approvededuction) AS aprdeduc FROM sales sa LEFT JOIN employees es ON es.employee_id = sa.employee_id WHERE es.id='$empid' and status = 'Approved' AND sa.salesdate BETWEEN '$from' AND '$to' group by approvededuction";

                      $allowance = "SELECT SUM(amount) from allowance";

                      $caquery = $conn->query($casql);
                      $carow = $caquery->fetch_assoc();
                      $cashadvance = $carow['cashamount'];

                      $saquery = $conn->query($salesdeduct); 
                      $sarow = $saquery->fetch_assoc();
                      $salesaprdeduc = $sarow['aprdeduc'];

                      $gross = $row['rate'] * $row['total_hr'] + $row['totalsales'] + $allowance;
                      $sss = 0.0363 * $gross;
                      $pagibig = 0.02 * $gross;
                      $philhealth = 100;
                      $tax = 0.05 * ($gross - 20000);
                      $total_deduction = $deduction + $cashadvance + $salesaprdeduc + $sss + $pagibig + $tax;
                      $net = $gross - $total_deduction;

                      echo "
                        <tr>
                          <td>".$row['lastname'].", ".$row['firstname']."</td>
                          <td>".$row['employee_id']."</td>
                          <td>".number_format($gross, 2)."</td>
                          <td>".number_format($deduction, 2)."</td>
                          <td>".number_format(abs($total_deduction), 2)."</td>
                          <td>".number_format(abs($net), 2)."</td>
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
  <?php include 'includes/payroll_modal.php'; ?>
h</div>
<?php include 'includes/scripts.php'; ?> 
<script>
$(function(){
  $('.edit').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.delete').click(function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $("#reservation").on('change', function(){
    var range = encodeURI($(this).val());
    window.location = 'payroll.php?range='+range;
  });
 
  $('#wpayroll').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'payroll_generate_weekly.php');
    $('#payForm').attr('target', '_blank'); // add target attribute
    $('#payForm').submit();
  });

  $('#apayroll').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'payroll_generate_all.php');
    $('#payForm').attr('target', '_blank'); // add target attribute
    $('#payForm').submit();
  });

  $('#payroll').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'payroll_generate.php');
    $('#payForm').attr('target', '_blank'); // add target attribute
    $('#payForm').submit();
  });

  $('#payslip').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'payslip_generate.php');
    $('#payForm').attr('target', '_blank'); // add target attribute
    $('#payForm').submit();
  });

  $('#createpayroll').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'sales_modal.php');
    $('#payForm').attr('target', '_blank'); // add target attribute
    $('#payForm').submit();
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'position_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#posid').val(response.id);
      $('#edit_title').val(response.description);
      $('#edit_rate').val(response.rate);
      $('#del_posid').val(response.id);
      $('#del_position').html(response.description);
    }
  });
}


// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("payroll");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}




</script>
</body>
</html>

