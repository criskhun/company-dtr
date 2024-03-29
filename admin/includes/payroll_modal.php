<?php 
include 'conn.php'; 

$qempid = "select distinct employee_id, firstname, lastname from employees";
$dempid= mysqli_query($conn,$qempid);
?>

<!-- Add -->
<div class="modal fade" id="addnewpay">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Create Payroll</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="payroll_add.php">
          		  <div class="form-group">
                  	<label for="employee" class="col-sm-3 control-label">Employee Name</label>
					  <div class="col-sm-9">
    <select class="form-control" id="empid" name="empid" required>
        <option value="" selected disabled>- Select Employee Name NEW -</option>
        <?php while($row1 = mysqli_fetch_array($dempid)):;?>
            <option value="<?php echo $row1['employee_id'];?>" ><?php echo $row1['firstname'].' '.$row1['lastname'];?></option>
        <?php endwhile; ?>
    </select>
</div>
                </div>

             
                <div class="form-group">
                  	<label for="hours" class="col-sm-3 control-label">Leave</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="hours" name="hours">
                  	</div>
                </div>
				<div class="form-group">
                  	<label for="hours" class="col-sm-3 control-label">Undertime</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="hours" name="hours">
                  	</div>
                </div>

				
                 <div class="form-group">
                    <label for="rate" class="col-sm-3 control-label">Per Hour Rate</label>

                    <div class="col-sm-9">
					  <input type="text" class="form-control" id="rate" name="rate" readonly>
                    </div>
                </div>
          	</div>

			  <div class="form-group">
                    <label for="rate" class="col-sm-3 control-label">Allowance</label>

                    <div class="col-sm-9">
					  <input type="text" class="form-control" id="allowance" name="allowance" readonly>
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
            	<h4 class="modal-title"><b>Update Schedule</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="schedule_edit.php">
            		<input type="hidden" id="timeid" name="id">
                <div class="form-group">
                    <label for="edit_time_in" class="col-sm-3 control-label">Time In</label>

                    <div class="col-sm-9">
                      <div class="bootstrap-timepicker">
                        <input type="text" class="form-control timepicker" id="edit_time_in" name="time_in">
                      </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_time_out" class="col-sm-3 control-label">Time out</label>

                    <div class="col-sm-9">
                      <div class="bootstrap-timepicker">
                        <input type="text" class="form-control timepicker" id="edit_time_out" name="time_out">
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
            	<form class="form-horizontal" method="POST" action="schedule_delete.php">
            		<input type="hidden" id="del_timeid" name="id">
            		<div class="text-center">
	                	<p>DELETE SCHEDULE</p>
	                	<h2 id="del_schedule" class="bold"></h2>
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


     