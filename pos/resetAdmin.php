<?php
  	ob_start();
	require 'myConnection.php';

$sql="
DELETE FROM `accounts` WHERE 1;
  ";
$result=mysqli_query($con,$sql);
if (!$result) {
    die('Invalid query: ' . mysqli_error($con));
}

$sql="
  INSERT INTO `accounts` (`account_id`, `employee_no`, `employee_name`, `employee_phone`, `employee_address`, `employee_national_id`, `password`, `is_admin`) VALUES
(1, '1', 'admin', '01234567891', NULL, NULL, '12345678', 1);
  ";

$result=mysqli_query($con,$sql);
if (!$result) {
  	die('Invalid query: ' . mysqli_error($con));
}else{
	header('Location: index.php');	
}


?>