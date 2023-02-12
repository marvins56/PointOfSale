<?php
	require 'myConnection.php';
	if(isset($_GET['x'])){
		$id=$_GET['x'];
		$sql="SELECT amount FROM returns WHERE return_id='$id'";
		$result=mysqli_query($con,$sql);
		if (!$result) {
		    die('Invalid query: ' . mysqli_error($con));
		}
		if(mysqli_num_rows($result)){
			$row=mysqli_fetch_array($result);
			$amount=$row['amount'];
			echo $amount;
		}
	}

?>