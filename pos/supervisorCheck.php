<?php
	ob_start();
	//session_start();
	if(isset($_SESSION['id'])){
        require 'myConnection.php';
        $id=$_SESSION['id'];
        $sql="SELECT is_admin FROM accounts WHERE account_id='$id'";
        $result=mysqli_query($con,$sql);
        if (!$result) {
            die('Invalid query: ' . mysqli_error($con));
        }
        $row=mysqli_fetch_array($result);

        if($row['is_admin']!=='3' && $row['is_admin']!=='2' && $row['is_admin']!=='1'){
        	session_destroy();
        	header("Location: login.php");
        }
    }
?>