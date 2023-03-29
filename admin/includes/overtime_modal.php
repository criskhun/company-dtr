<?php 
include 'conn.php'; 

$qempid = "select distinct employee_id, firstname, lastname from employees";
$dempid= mysqli_query($conn,$qempid);
?>

<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Overtime</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="attendance_add.php">
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
                    <label for="datepicker_add" class="col-sm-3 control-label">Date</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_add" name="date" required>
                      </div>
                    </div>
                </div>
                <div class="form-group">
                  	<label for="hours" class="col-sm-3 control-label">No. of Hours</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="hours" name="hours">
                  	</div>
                </div>
                <!-- <div class="form-group">
                  	<label for="mins" class="col-sm-3 control-label">No. of Mins</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="mins" name="mins">
                  	</div>
                </div> -->
                 <div class="form-group">
                    <label for="rate" class="col-sm-3 control-label">Rate</label>

                    <div class="col-sm-9">
                      <!-- <input type="text" class="form-control" id="rate" name="rate" required> -->
					  <input type="text" class="form-control" id="rate" name="rate" readonly>
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
            	<h4 class="modal-title"><b><span class="employee_name"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="overtime_edit.php">
            		<input type="hidden" class="otid" name="id">
                <div class="form-group">
                    <label for="datepicker_edit" class="col-sm-3 control-label">Date</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_edit" name="date" required>
                      </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="hours_edit" class="col-sm-3 control-label">No. of Hours</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="hours_edit" name="hours">
                    </div>
                </div>
                <!-- <div class="form-group">
                    <label for="mins_edit" class="col-sm-3 control-label">No. of Mins</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="mins_edit" name="mins">
                    </div>
                </div> -->
                 <div class="form-group">
                    <label for="rate_edit" class="col-sm-3 control-label">Rate</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="rate_edit" name="rate">
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
            	<h4 class="modal-title"><b><span id="overtime_date"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="overtime_delete.php">
            		<input type="hidden" class="otid" name="id">
            		<div class="text-center">
	                	<p>DELETE OVERTIME</p>
	                	<h2 class="employee_name bold"></h2>
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
  $('#empid').change(function(){
    var empid = $(this).val();
    $.get('includes/get_rate.php?empid='+empid, function(data){
      $('#rate').val(data);
    });
  });
});
</script>
