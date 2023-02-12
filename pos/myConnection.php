<?php
	$host="localhost";
	$username="root";
	$password="";
	$database="pos";
	$con=mysqli_connect($host,$username,$password,$database);
	
	mysqli_select_db($con,$database);	
?>