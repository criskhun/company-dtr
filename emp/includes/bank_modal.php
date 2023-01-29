<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Bank</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="bank_add.php">
          		  <div class="form-group">
                  	<label for="bankname" class="col-sm-3 control-label">Bank Name</label>

                  	<div class="col-sm-9">
						<select class="form-control" id="bankname" name="bankname" required>
                        <option value="" selected>- Select Bank -</option>
                        <option value="RCBC">RCBC</option>
                        <option value="METROBANK">METROBANK</option>
						<option value="EASTWEST">EASTWEST</option>
						<option value="SECURITYBANK">SECURITYBANK</option>
						<option value="PNB">PNB</option>
						<option value="BPI">BPI</option>
						<option value="HSBC">HSBC</option>
						<option value="ROBINSONSBANK">ROBINSONSBANK</option>
                      </select>
                  	</div>
                </div>
                <div class="form-group">
				<label for="bankname" class="col-sm-3 control-label">Bank Card Type</label>

                    <div class="col-sm-9">
					<select class="form-control" name="plantype" id="plantype" required>
                        <option value="" selected>- Select Card Type -</option>
                        <option value="CLASSIC">CLASSIC</option>
                        <option value="GOLD">GOLD</option>
						<option value="PLATINUM">PLATINUM</option>
						<option value="M-FREE">M-FREE</option>
						<option value="FLATRATE">FLATRATE</option>
                      </select>
                    </div>
					</div>
				 <div class="form-group">
                    <label for="rate" class="col-sm-3 control-label">Rate</label>
                 		<div class="col-sm-9">
                      		<input type="text" class="form-control" id="rate" name="rate" required>
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
            	<h4 class="modal-title"><b>Update Bank Details</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="bank_edit.php">
            		<input type="hidden" class="bnkid" name="id">
                <div class="form-group">
                    <label for="bankname" class="col-sm-3 control-label">Bank Name</label>

                    <div class="col-sm-9">
					<select class="form-control" id="bankname" name="bankname" required>
                        <option value="" selected>- Select Bank -</option>
                        <option value="RCBC">RCBC</option>
                        <option value="METROBANK">METROBANK</option>
						<option value="EASTWEST">EASTWEST</option>
						<option value="SECURITYBANK">SECURITYBANK</option>
						<option value="PNB">PNB</option>
						<option value="BPI">BPI</option>
						<option value="HSBC">HSBC</option>
						<option value="ROBINSONSBANK">ROBINSONSBANK</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_amount" class="col-sm-3 control-label">Bank Card Type</label>

                    <div class="col-sm-9">
					<select class="form-control" name="plantype" id="plantype" required>
						<option value="" selected>- Select Card Type -</option>
                        <option value="CLASSIC">CLASSIC</option>
                        <option value="GOLD">GOLD</option>
						<option value="PLATINUM">PLATINUM</option>
						<option value="M-FREE">M-FREE</option>
						<option value="FLATRATE">FLATRATE</option>
                      </select>
                    </div>
                </div>

				<div class="form-group">
                    <label for="rate" class="col-sm-3 control-label">Rate</label>
                 		<div class="col-sm-9">
                      		<input type="text" class="form-control" id="rate" name="rate" required>
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
            	<form class="form-horizontal" method="POST" action="bank_delete.php">
            		<input type="hidden" class="bnkid" name="id">
            		<div class="text-center">
	                	<p>DELETE BANK?</p>
	                	<h2 id="del_bnk" class="bold"></h2>
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


     