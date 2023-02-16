<?php
	ob_start();
	require 'mask.php';	
	require 'loginCheck.php';

	if(isset($_GET['x'])){
		$sql="SELECT invoice_id FROM invoices ORDER BY selling_date DESC LIMIT 1";
		$result=mysqli_query($con,$sql);
		if (!$result) {
		    die('Invalid query: ' . mysqli_error($con));
		}
		$row=mysqli_fetch_array($result);
		$invoiceId=$row['invoice_id'];
		echo "<script>OpenInNewTab($invoiceId);</script>";
	}

	$sql="SELECT * FROM invoices ORDER BY selling_date DESC";
	$result=mysqli_query($con,$sql);
	if (!$result) {
	    die('Invalid query: ' . mysqli_error($con));
	}
	if(mysqli_num_rows($result)){
		echo "
		<div id='tableTitleDiv'>
		Bills List
		</div>
		";
		echo "
		<div class='container-fluid pt-4 px-4'>
		<div class='bg-light text-center rounded p-4'>
		   
			<div class='table-responsive sortable'>
				<table class='table text-start align-middle table-bordered table-hover mb-0'>
					<thead>
					<tr class='text-dark'>
					<td scope='col'>Bill No.</td>
					<td scope='col'>Date of Issue</td>
					<td scope='col'>Amount</td>
					<td scope='col'>Action</td>
				</tr>
			</thead>
			<tbody>
		";
		while($row=mysqli_fetch_array($result)){
			$invoiceId=$row['invoice_id'];
			$sellingDate=$row['selling_date'];
			$amount=$row['cash_given']-$row['cash_back'];

			$sql2="SELECT SUM(product_price*quantity) AS total FROM `sales` JOIN products ON `sales`.`product_id`=`products`.`product_id` WHERE `sales`.`invoice_id`='$invoiceId'";
			$result2=mysqli_query($con,$sql2);
			if (!$result2) {
				die('Invalid query: ' . mysqli_error($con));
			}
			$row2=mysqli_fetch_array($result2);
			$total=$row2['total'];

			echo"
				<tr>
					<td>$invoiceId</td>
					<td>$sellingDate</td>
					<td>$amount</td>
					<td><input type='button' onClick='OpenInNewTab($invoiceId);' class='btn btn-primary' value='SHOW BILL'></td>					
				<tr>
			";
		}
		echo "
			</tbody>
		</table>
		</div>
		</div>
		</div>
		";
	}else{
		echo "No bills issued yet.";
	}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Bills</title>  
  <link href="Template/dashmin-1.0.0/css/style.css" rel="stylesheet"> 
</head>

<body>	
	<div id="tableButtons">
		<a href="javascript:history.back()" class="btn btn-warning ">Back</a>
	</div>
</body>

</html>