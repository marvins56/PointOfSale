<?php
  ob_start();
	require 'myConnection.php';

$sql="
DELETE FROM `categories` WHERE 1;
  ";
$result=mysqli_query($con,$sql);
if (!$result) {
    die('Invalid query: ' . mysqli_error($con));
}

$sql="
DELETE FROM `customers` WHERE 1;
  ";
$result=mysqli_query($con,$sql);
if (!$result) {
    die('Invalid query: ' . mysqli_error($con));
}

$sql="
DELETE FROM `invoices` WHERE 1;
  ";
$result=mysqli_query($con,$sql);
if (!$result) {
    die('Invalid query: ' . mysqli_error($con));
}

$sql="
DELETE FROM `products` WHERE 1;
  ";
$result=mysqli_query($con,$sql);
if (!$result) {
    die('Invalid query: ' . mysqli_error($con));
}

$sql="
DELETE FROM `returns` WHERE 1;
  ";
$result=mysqli_query($con,$sql);
if (!$result) {
    die('Invalid query: ' . mysqli_error($con));
}

$sql="
DELETE FROM `sales` WHERE 1;
  ";
$result=mysqli_query($con,$sql);
if (!$result) {
    die('Invalid query: ' . mysqli_error($con));
}

$sql="
DELETE FROM `stocks` WHERE 1;
  ";
$result=mysqli_query($con,$sql);
if (!$result) {
    die('Invalid query: ' . mysqli_error($con));
}

$sql="
DELETE FROM `types` WHERE 1;
  ";
$result=mysqli_query($con,$sql);
if (!$result) {
    die('Invalid query: ' . mysqli_error($con));
}else{
	header('Location: index.php');	
}



?>