<?php
	ob_start();
	//session_start();
	require 'myConnection.php';
	
	if(isset($_SESSION['id'])){
		$id=$_SESSION['id'];
		$sql="SELECT * FROM accounts WHERE account_id='$id'";
		$result=mysqli_query($con,$sql);
		if (!$result) {
		    die('Invalid query: ' . mysqli_error($con));
		}
		if(!mysqli_num_rows($result)){
			session_destroy();
			echo"
			<script>
			alert('Sorry, you are not logged in. Please login to continue.');			
			window.location.href='login.php';
			</script>";	
		}
	}else{
		session_destroy();
		header('Location: login.php');
	}
?>