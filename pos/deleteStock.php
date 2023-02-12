<?php
	ob_start();
	require 'myConnection.php';

	if(isset($_GET['x'])){
		$id=$_GET['x'];
		$sql="UPDATE stocks SET is_deleted='1' WHERE stock_id='$id'";
		$result=mysqli_query($con,$sql);
		if (!$result) {
		    die('Invalid query: ' . mysqli_error($con));
		}
		
		header('Location: stocks.php');
	}

?>