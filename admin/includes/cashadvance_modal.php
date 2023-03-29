
<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Cash Advance</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="cashadvance_add.php">
          		  <div class="form-group">
                  	<label for="employee" class="col-sm-3 control-label">Agent ID</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="employee" name="employee" required>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="amount" class="col-sm-3 control-label">Cash Advance</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="amount" name="amount" required>
                    </div>
                </div>
				<div class="form-group">
                    <label for="sss" class="col-sm-3 control-label">SSS</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="sss" name="sss" required>
                    </div>
                </div>
				<div class="form-group">
                    <label for="pagibig" class="col-sm-3 control-label">Pagibig</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="pagibig" name="pagibig" required>
                    </div>
                </div>
				<div class="form-group">
                    <label for="philhealth" class="col-sm-3 control-label">Philhealth</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="philhealth" name="philhealth" required>
                    </div>
                </div>
				<div class="form-group">
                    <label for="tax" class="col-sm-3 control-label">Tax</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="tax" name="tax" required>
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
            	<h4 class="modal-title"><b><span class="date"></span> - <span class="employee_name"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="cashadvance_edit.php">
            		<input type="hidden" class="caid" name="id">
                <div class="form-group">
                    <label for="edit_amount" class="col-sm-3 control-label">Cash Advance</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_amount" name="amount" required>
                    </div>
                </div>

				<div class="form-group">
                    <label for="edit_sss" class="col-sm-3 control-label">SSS</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_sss" name="sss" required>
                    </div>
                </div>
				<div class="form-group">
                    <label for="edit_pagibig" class="col-sm-3 control-label">Pagibig</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_pagibig" name="pagibig" required>
                    </div>
                </div>
				<div class="form-group">
                    <label for="edit_philhealth" class="col-sm-3 control-label">Philhealth</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_philhealth" name="philhealth" required>
                    </div>
                </div>
				<div class="form-group">
                    <label for="edit_tax" class="col-sm-3 control-label">Tax</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_tax" name="tax" required>
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
            	<h4 class="modal-title"><b><span class="date"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="cashadvance_delete.php">
            		<input type="hidden" class="caid" name="id">
            		<div class="text-center">
	                	<p>DELETE CASH ADVANCE</p>
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


     