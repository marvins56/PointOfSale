<?php
	ob_start();
	require 'mask.php';	
	require 'loginCheck.php';
	include 'myConnection.php';

	if(isset($_POST['accountEditSubmit'])){
		$id=$_SESSION['id'];
		$name=$_POST['username'];
		$phone=$_POST['phone'];
		$address=$_POST['address'];
		$nationalId=$_POST['nationalId'];

		$sql="UPDATE accounts SET employee_name='$name',employee_phone='$phone',employee_address='$address',employee_national_id='$nationalId' WHERE account_id='$id'";
		$result=mysqli_query($con,$sql);
		if (!$result) {
		    die('Invalid query: ' . mysqli_error($con));
		}
	}else if(isset($_POST['passwordChangeSubmit'])){
		$id=$_SESSION['id'];
		$pass=$_POST['newPassword'];
		$currentPassword=$_POST['currentPassword'];
		
		$sql="SELECT account_id FROM accounts WHERE account_id='$id' AND password='$currentPassword'";
		$result=mysqli_query($con,$sql);
		if (!$result) {
		    die('Invalid query: ' . mysqli_error($con));
		}
		if(mysqli_num_rows($result)){
			$sql="UPDATE accounts SET password='$pass' WHERE account_id='$id'";
			$result=mysqli_query($con,$sql);
			if (!$result) {
			    die('Invalid query: ' . mysqli_error($con));
			}	
			echo "
				<script>
				swal({
					title: 'Great Job',
					text:'Password changed Sucessful',
					icon: 'success',
				  });
				</script>
				";
		}else{			
			echo "
				<script>
				swal({
					title: 'Authentication Error',
					text:'password incorrect',
					icon: 'error',
				  });
				</script>
				";
		}		
	}
	function showUserName(){
		include 'myConnection.php';
		$id=$_SESSION['id'];
		$sql="SELECT employee_name FROM accounts WHERE account_id='$id'";
		$result=mysqli_query($con,$sql);
		if (!$result) {
		    die('Invalid query: ' . mysqli_error($con));
		}
		$row=mysqli_fetch_array($result);
		$var=$row['employee_name'];
		echo $var;
	}

	function showUserPhone(){
		include 'myConnection.php';
		$id=$_SESSION['id'];
		$sql="SELECT employee_phone FROM accounts WHERE account_id='$id'";
		$result=mysqli_query($con,$sql);
		if (!$result) {
		    die('Invalid query: ' . mysqli_error($con));
		}
		$row=mysqli_fetch_array($result);
		$var=$row['employee_phone'];
		echo $var;
	}

	function showUserAddress(){
		include 'myConnection.php';
		$id=$_SESSION['id'];
		$sql="SELECT employee_address FROM accounts WHERE account_id='$id'";
		$result=mysqli_query($con,$sql);
		if (!$result) {
		    die('Invalid query: ' . mysqli_error($con));
		}
		$row=mysqli_fetch_array($result);
		$var=$row['employee_address'];
		echo $var;
	}

	function showUserNationalId(){
		include 'myConnection.php';
		$id=$_SESSION['id'];
		$sql="SELECT employee_national_id FROM accounts WHERE account_id='$id'";
		$result=mysqli_query($con,$sql);
		if (!$result) {
		    die('Invalid query: ' . mysqli_error($con));
		}
		$row=mysqli_fetch_array($result);
		$var=$row['employee_national_id'];
		echo $var;
	}
?>


<!DOCTYPE html>
<html>

<head>
  <title>Account Settings</title>
  <link href="Template/dashmin-1.0.0/css/style.css" rel="stylesheet">  
</head>

<body>	

<div class="jumbotron jumbotron-fluid">
  <div class="container">

  <div class="card">
  <div class="card-header">
  <h2><p align="center">Account Information</p></h2>
  </div>
  <div class="card-body">
  <div id="">

	
<div>			
	
</div>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" required name="myForm">
	<table class="table table-responsive">
	<tbody>
		<tr>
			<td><b>Username: </b></td>
			<td><input type="text" class="form-control" value="<?php showUserName(); ?>" id="username" required name="username"></td>
		</tr>
		<tr>
			<td><b>Phone: </b></td>
			<td><input type="text" class="form-control" value="<?php showUserPhone(); ?>" id="phone" required name="phone"></td>
		</tr>
		<tr>
			<td><b>Address: </b></td>
			<td><input type="text" class="form-control" value="<?php showUserAddress(); ?>" id="address" required name="address"></td>
		</tr>
		<tr>
			<td><b>National ID: </b></td>
			<td><input type="text" class="form-control" value="<?php showUserNationalId(); ?>" id="nationalId" required name="nationalId"></td>
		</tr>
	</tbody>
	</table>
	<div id="rightDiv">
		<input class="btn btn-sm btn-info" type="submit" name="accountEditSubmit" id="accountEditSubmit" value="Change Informations">
		<a class="btn  btn-primary" href="#passwordChangeForm" role="button" data-toggle="modal">Change Password</a>
		<input class="btn  btn-danger" type="button" value="Reset" onclick="location.reload();">
		<a href="javascript:history.back()" class="btn btn-warning btn-sm">Back</a>
	</div>
</form>			

</div>
  </div>
</div>



  </div>
</div>
	
	<div class="modal fade" id="passwordChangeForm">
	  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	  <div class="modal-dialog" id="signinDialog">
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
	          <h4 class="modal-title">Enter new name for the category.</h4>
	        </div>
	        <div class="modal-body">
	          <input class="form-control" required id="currentPassword" name="currentPassword" placeholder="Enter current password." required type="password"></br>
	          <input class="form-control" required id="newPassword" name="newPassword" placeholder="Enter new password." required type="password"></br>
	          <input class="form-control" required id="newRePassword" name="newRePassword" placeholder="Enter new password." required type="password"></br>
	        </div>
	        <div class="modal-footer">
	          <a href="#" data-dismiss="modal" class="btn btn-default">Close</a>  
	          <input type="button" class="btn btn-primary" value="Change" onclick="passwordEditCheck();">
	          <input type="submit" id="passwordChangeSubmit" name ="passwordChangeSubmit" style="display:none">     
	        </div>
	      </div>
	    </div>
	  </form> 
	</div>


</body>

</html>