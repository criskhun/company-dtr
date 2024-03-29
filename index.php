<?php session_start(); ?>
<?php include 'header.php'; ?>
<body class="hold-transition login-page">

<div class="login-box" style="width: 500px;"><div class="login-logo"><p>Welcome to<br>GNET Group of Companies</p><p id="date"></p><p id="time" class="bold"></p></div>



    <div id="qr-reader" style="width: 100%; min-height: 100px; text-align: center;"></div>
    <div id="qr-reader-results"></div>



  	<div class="login-box-body">
      
    	<h4 class="login-box-msg">Attendance Stamp</h4>

    	<form id="attendance">
          <div class="form-group">
            <select class="form-control" name="status">
              <option value="in">Time In</option>
              <option value="out">Time Out</option>
            </select>
          </div>
      		<div class="form-group has-feedback">
        		<input type="text" class="form-control input-lg" id="employee" name="employee" placeholder="Enter Employee ID" required>
        		<span class="glyphicon glyphicon-calendar form-control-feedback"></span>
      		</div>
      		<div class="row">
    			<div class="col-xs-4">
          			<button type="submit" class="btn btn-primary btn-block btn-flat" name="signin"><i class="fa fa-sign-in"></i> Sign In</button>
            </div>
      		</div>

          
    	</form>
  	</div>
		<div class="alert alert-success alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span class="result"><i class="icon fa fa-check"></i> <span class="message"></span></span>
    </div>
		<div class="alert alert-danger alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span class="result"><i class="icon fa fa-warning"></i> <span class="message"></span></span>
    </div>
  		
    <!--button  onclick="window.location.href='/apsystem/admin/'" class="btn btn-primary btn-block btn-flat"><i class="fa fa-user-o"></i>&nbsp;   Admin Sign In</button-->
    <!--button  onclick="window.location.href='/apsystem/emp/'" class="btn btn-primary btn-block btn-flat"><i class="fa fa-user-o"></i>&nbsp;   Employee Sign In</button-->

</div>
      
  


<?php include 'scripts.php' ?>
<script type="text/javascript">
$(function() {
  var interval = setInterval(function() {
    var momentNow = moment();
    $('#date').html(momentNow.format('dddd').substring(0,3).toUpperCase() + ' - ' + momentNow.format('MMMM DD, YYYY'));  
    $('#time').html(momentNow.format('hh:mm:ss A'));
  }, 100);

  $('#attendance').submit(function(e){
    e.preventDefault();
    var attendance = $(this).serialize();
    $.ajax({
      type: 'POST',
      url: 'attendance.php',
      data: attendance,
      dataType: 'json',
      success: function(response){
        if(response.error){
          $('.alert').hide();
          $('.alert-danger').show();
          $('.message').html(response.message);
        }
        else{
          $('.alert').hide();
          $('.alert-success').show();
          $('.message').html(response.message);
          $('#employee').val('');
        }
      }
    });
  });
    
});

function onScanSuccess(decodedText, decodedResult) {
    console.log(`Code scanned = ${decodedText}`, decodedResult);
    document.getElementById("employee").value = decodedText;
    document.querySelector("button[type='submit']").click();
    html5QrcodeScanner.clear();
    
}
var html5QrcodeScanner = new Html5QrcodeScanner(
	"qr-reader", { fps: 10, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess);

</script>

<script>
var encrypted = "SSBhbSBkYXJrdmFkZXIsIGpvaW4gdGhlIGRhcmtzaWRl";
var decrypted = atob(encrypted);

$(document).ready(function() {
  var typed = '';
  $(document).keydown(function(e) {
    typed += e.key;
    if (typed === '122194') {
      alert(decrypted);
      typed = '';
    }
  });
});
</script>
</body>
</html>