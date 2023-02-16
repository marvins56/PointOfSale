<?php
	ob_start();
	require 'mask.php';	
	require 'loginCheck.php';
	require 'supervisorCheck.php';
	
	$sql="SELECT * FROM customers";
	$result=mysqli_query($con,$sql);
	if (!$result) {
	    die('Invalid query: ' . mysqli_error($con));
	}
	if(mysqli_num_rows($result)){
		echo "
		<div id='tableTitleDiv'>
		Customer List
		</div>
		";
		echo"
		<div class='container-fluid pt-4 px-4'>
		<div class='bg-light text-center rounded p-4'>
		   
			<div class='table-responsive sortable'>
				<table class='table text-start align-middle table-bordered table-hover mb-0'>
					<thead>
				<tr>
					<td>Customer Name</td>
					<td>Contact Number</td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody>
		";
		while($row=mysqli_fetch_array($result)){			
			$customerId=$row['customer_id'];
			$customerName=$row['customer_name'];
			$customerContact=$row['customer_contact'];

			
			echo "
				<tr>
					<td>$customerName</td>
					<td>$customerContact</td>
					<td><a href='showCustomer.php?x=$customerId' type='button' class='btn btn-info '>HISTORY</a></td>
				</tr>
			";
		}
		echo"
			</tbody>
		</table>
		</div>
		</div>
		</div>
		";
	}else{
		echo "No customer history available.";
	}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Customers</title>  
  <link href="Template/dashmin-1.0.0/css/style.css" rel="stylesheet"> 
</head>

<body>	
	<div id="tableButtons">
		<a href="javascript:history.back()" class="btn btn-warning ">Back</a>
	</div>
</body>

</html>