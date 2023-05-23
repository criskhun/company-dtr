<?php 
include 'conn.php'; 

$qempid = "select distinct employee_id, firstname, lastname from employees";
$dempid= mysqli_query($conn,$qempid);
?>

<!-- Add -->
<div class="modal fade" id="addnewhol">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Rendered Holiday</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="holiday_add.php">
          		  <div class="form-group">
                  	<label for="employee" class="col-sm-3 control-label">Employee Name</label>
					  <div class="col-sm-9">
					  <select class="form-control" id="employee" name="employee" required>
        <option value="" selected disabled>- Select Employee Name-</option>
        <?php while($row1 = mysqli_fetch_array($dempid)):;?>
            <option value="<?php echo $row1['employee_id'];?>" ><?php echo $row1['firstname'].' '.$row1['lastname'];?></option>
        <?php endwhile; ?>
    </select>
</div>
                </div>

				<div class="form-group">
    <label for="holiday-type" class="col-sm-3 control-label">Holiday Type</label>
    <div class="col-sm-9">
        <select class="form-control" id="holiday-type" name="holiday-type" required>
            <option value="" selected disabled>- Select Holiday Type -</option>
            <option value="regular">Regular Holiday</option>
            <option value="special">Special Holiday</option>
        </select>
    </div>
</div>

             
                <div class="form-group">
                  	<label for="hours" class="col-sm-3 control-label">No. of Hours</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="hours" name="hours">
                  	</div>
                </div>

				<div class="form-group">
                  	<label for="hours" class="col-sm-3 control-label">Amount Paid</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="amount" name="amount">
                  	</div>
                </div>
				
                 <div class="form-group">
                    <label for="rate" class="col-sm-3 control-label">Per Hour Rate</label>

                    <div class="col-sm-9">
					  <input type="text" class="form-control" id="rate" name="rate" readonly>
                    </div>
                </div>

				<div class="form-group">
                    <label for="datepicker_add" class="col-sm-3 control-label">Date</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_add" name="date" required>
                      </div>
                    </div>
                </div>
				
          	</div>
			  
			 

          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Update Holiday</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="holiday_edit.php">
                
              <input type="hidden" class="holid" name="id">

<div class="form-group">
    <label for="holiday-type" class="col-sm-3 control-label">Holiday Type</label>
    <div class="col-sm-9">
        <select class="form-control" id="edit_holiday-type" name="holiday-type" required>
            <option value="" selected disabled>- Select Holiday Type -</option>
            <option value="regular">Regular Holiday</option>
            <option value="special">Special Holiday</option>
        </select>
    </div>
</div>

             
                <div class="form-group">
                  	<label for="hours" class="col-sm-3 control-label">No. of Hours</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="edit_holiday-typehours" name="hours">
                  	</div>
                </div>

				<div class="form-group">
                  	<label for="hours" class="col-sm-3 control-label">Amount Paid</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="edit_holiday-typeamount" name="amount">
                  	</div>
                </div>

				<div class="form-group">
                    <label for="datepicker_edit" class="col-sm-3 control-label">Date</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_edit" name="date" required>
                      </div>
                    </div>
                </div>
				

          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Deleting...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="holiday_delete.php">
            		<input type="hidden" class="decid" name="id">
            		<div class="text-center">
	                	<p>DELETE DEDUCTION</p>
	                	<h2 id="del_deduction" class="bold"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
            	</form>
          	</div>
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
  $('#employee').change(function(){
    var empid = $(this).val();
    $.get('includes/get_rate.php?empid='+empid, function(data){
      $('#rate').val(data);
    });
  });

  $('#hours').keyup(function(){
    calculateAmount();
  });
});

function calculateAmount() {
  var ratePerHour = parseFloat($('#rate').val());
  var hours = parseFloat($('#hours').val());
  var holidayType = $('#holiday-type').val();
  var amountPaid = ratePerHour * hours * (holidayType === 'regular' ? 1 : 0.3);

  $('#amount').val(amountPaid.toFixed(2));
}
</script>
