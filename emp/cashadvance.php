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
        Mandatory Deductions
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Employees</li>
        <li class="active">Mandatory Deductions</li>
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
              
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th class="hidden"></th>
                  <th>Date</th>
                  <th>Agent ID</th>
                  <th>Name</th>
                  <th>Cash Advance</th>
                  <th>SSS</th>
                  <th>Pag-Ibig</th>
                  <th>Philhealth</th>
                  <th>Tax</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                    $user_id = $user['id'];
                    $sql = "SELECT ca.*, ca.id AS caid, emp.employee_id AS empid, att.total_hr, s.totalsales, pos.rate FROM cashadvance AS ca LEFT JOIN ( SELECT employee_id, SUM(num_hr) AS total_hr FROM attendance GROUP BY employee_id ) AS att ON att.employee_id = ca.employee_id LEFT JOIN ( SELECT employee_id, SUM(amount) AS totalsales FROM sales GROUP BY employee_id ) AS s ON s.employee_id = ca.employee_id LEFT JOIN employees AS emp ON emp.id = ca.employee_id LEFT JOIN ( SELECT id, rate FROM position GROUP BY id ) AS pos ON pos.id = emp.position_id WHERE rate is not null and att.employee_id = '$user_id' ORDER BY ca.date_advance DESC";
 
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $gross = $row['rate'] * $row['total_hr'] + $row['totalsales'];
                      $sss = 0.0363 * $gross;
                      $pagibig = 0.02 * $gross;
                      $philhealth = 0.03 * $gross;
                      $tax = 0.05 * ($gross - 20000);
                      // $tax = ($sss = 0 || $pagibig = 0 || $philhealth = 0) ? 0 : $tax = 0.05 * ($gross - 20000);


                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>".date('M d, Y', strtotime($row['date_advance']))."</td>
                          <td>".$row['empid']."</td>
                          <td>".$row['firstname'].' '.$row['lastname']."</td>
                          <td>".number_format($row['amount'], 2)."</td>
                          <td>".number_format($sss, 2)."</td>
                          <td>".number_format($pagibig, 2)."</td>
                          <td>".number_format($philhealth, 2)."</td>
                          <td>".number_format(abs($tax), 2)."</td>
                          <td>
                            <button class='btn btn-success btn-sm edit btn-flat' data-id='".$row['caid']."'><i class='fa fa-edit'></i> Edit</button>
                            <button class='btn btn-danger btn-sm delete btn-flat' data-id='".$row['caid']."'><i class='fa fa-trash'></i> Delete</button>
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
  <?php include 'includes/cashadvance_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  
  $( ".table" ).on( "click", ".edit", function(e) {
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
    url: 'cashadvance_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      console.log(response);
      $('.date').html(response.date_advance);
      $('.employee_name').html(response.firstname+' '+response.lastname);
      $('.caid').val(response.caid);
      $('#edit_amount').val(response.amount);
      $('#edit_sss').val(response.sss);
      $('#edit_pagibig').val(response.pagibig);
      $('#edit_philhealth').val(response.philhealth);
      $('#edit_tax').val(response.tax);
      
      
    }
  });
}
</script>
</body>
</html>
