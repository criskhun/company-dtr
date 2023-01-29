<?php 
include 'conn.php'; 
$qbank = "select distinct bankname from bank";
$dbank = mysqli_query($conn,$qbank);

$qempid = "select distinct employee_id from employees";
$dempid= mysqli_query($conn,$qempid);

$qtype = "select distinct plantype from bank";
$dtype = mysqli_query($conn,$qtype);
?>

<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Sales</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="sales_add.php">

				 <div class="form-group">
                  	<label for="bankname" class="col-sm-3 control-label">Agent ID</label>
 
                  	<div class="col-sm-9">
						<select class="form-control" id="empid" name="empid" required>
						<?php while($row1 = mysqli_fetch_array($dempid)):;?>
						<option value="<?php echo $row1[0]?>" selected><?php echo $row1[0]?></option>
						<?php endwhile; ?>
						<option value="" selected>- Select Agent ID -</option>
                      </select>
                  	</div>
                </div>


                <div class="form-group">
                  	<label for="client" class="col-sm-3 control-label">Client Name</label>
                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="client" name="client" required>
                  	</div>
                </div>
              
				<div class="form-group">
                  	<label for="bankname" class="col-sm-3 control-label">Bank Name</label>
 
                  	<div class="col-sm-9">
						<select class="form-control" id="bankname" name="bankname" required>
						<?php while($row1 = mysqli_fetch_array($dbank)):;?>
						<option value="<?php echo $row1[0]?>" selected><?php echo $row1[0]?></option>
						<?php endwhile; ?>
						<option value="" selected>- Select Bank -</option>
                      </select>
                  	</div>
                </div>

				<div class="form-group">
                  	<label for="bankname" class="col-sm-3 control-label">Bank Type</label>
 
                  	<div class="col-sm-9">
						<select class="form-control" id="plantype" name="plantype" required>
						<?php while($row1 = mysqli_fetch_array($dtype)):;?>
						<option value="<?php echo $row1[0]?>" selected><?php echo $row1[0]?></option>
						<?php endwhile; ?>
						<option value="" selected>- Select Card Type -</option>
                      </select>
                  	</div>
                </div>

				<div class="form-group">
                  	<label for="client" class="col-sm-3 control-label">Bank Rate</label>
                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="rate" name="rate" required>
                  	</div>
                </div>
                
				<div class="form-group">
                    <label for="bankname" class="col-sm-3 control-label">Approval Status</label>

                    <div class="col-sm-9">
					<select class="form-control" id="approval" name="approval" required>
                        <option value="" selected>- Select Approval -</option>
						<option value="Denied">Denied</option>
                        <option value="Pending">Pending</option>
						<option value="Reprocess">Reprocess</option>
						<option value="Approved">Approved</option>
                      </select>
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

<?php 
include 'conn.php'; 
$qbank = "select distinct bankname from bank";
$dbank = mysqli_query($conn,$qbank);

$qempid = "select distinct employee_id from employees";
$dempid= mysqli_query($conn,$qempid);

$qtype = "select distinct plantype from bank";
$dtype = mysqli_query($conn,$qtype);
?>
<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Update Sales Details</b></h4>
          	</div>
			  <div class="modal-body">
            	<form class="form-horizontal" method="POST" action="sales_edit.php">
				<input type="hidden" id="slsid" name="id">
				 <div class="form-group">
                  	<label for="bankname" class="col-sm-3 control-label">Agent ID</label>
 
                  	<div class="col-sm-9">
						<select class="form-control" id="empid" name="empid" required>
						<?php while($row1 = mysqli_fetch_array($dempid)):;?>
						<option value="<?php echo $row1[0]?>" selected><?php echo $row1[0]?></option>
						<?php endwhile; ?>
						<option value="" selected>- Select Agent ID -</option>
                      </select>
                  	</div>
                </div>


                <div class="form-group">
                  	<label for="client" class="col-sm-3 control-label">Client Name</label>
                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="client" name="client" required>
                  	</div>
                </div>
              
				<div class="form-group">
                  	<label for="bankname" class="col-sm-3 control-label">Bank Name</label>
 
                  	<div class="col-sm-9">
						<select class="form-control" id="bankname" name="bankname" required>
						<?php while($row1 = mysqli_fetch_array($dbank)):;?>
						<option value="<?php echo $row1[0]?>" selected><?php echo $row1[0]?></option>
						<?php endwhile; ?>
						<option value="" selected>- Select Bank -</option>
                      </select>
                  	</div>
                </div>

				<div class="form-group">
                  	<label for="bankname" class="col-sm-3 control-label">Bank Type</label>
 
                  	<div class="col-sm-9">
						<select class="form-control" id="plantype" name="plantype" required>
						<?php while($row1 = mysqli_fetch_array($dtype)):;?>
						<option value="<?php echo $row1[0]?>" selected><?php echo $row1[0]?></option>
						<?php endwhile; ?>
						<option value="" selected>- Select Card Type -</option>
                      </select>
                  	</div>
                </div>

				<div class="form-group">
                  	<label for="client" class="col-sm-3 control-label">Bank Rate</label>
                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="rate" name="rate" required>
                  	</div>
                </div>
                
				<div class="form-group">
                    <label for="bankname" class="col-sm-3 control-label">Approval Status</label>

                    <div class="col-sm-9">
					<select class="form-control" id="approval" name="approval" required>
                        <option value="" selected>- Select Approval -</option>
						<option value="Denied">Denied</option>
                        <option value="Pending">Pending</option>
						<option value="Reprocess">Reprocess</option>
						<option value="Approved">Approved</option>
                      </select>
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
            	<form class="form-horizontal" method="POST" action="sales_delete.php">
            		<input type="hidden" class="slsid" name="id">
            		<div class="text-center">
	                	<p>DELETE SALES INFO?</p>
	                	<h2 id="del_sls" class="bold"></h2>
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


     