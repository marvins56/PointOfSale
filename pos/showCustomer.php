

<!DOCTYPE html>
<html>

<head>
  <title>Customer History</title>  
  <link href="Template/dashmin-1.0.0/css/style.css" rel="stylesheet"> 
</head>

<body>	
<div class="card">
  <div class="card-header">
    CUSTOMER TRANSACTIONS
  </div>
  <div class="card-body">
  <?php
	ob_start();
	require 'mask.php';	
	require 'loginCheck.php';
	require 'supervisorCheck.php';
	require 'myConnection.php';


	if(isset($_GET['x'])){
		
		$customerId=$_GET['x'];
		$sql="SELECT customer_name,customer_contact FROM customers WHERE customer_id='$customerId'";
		$result=mysqli_query($con,$sql);
		if (!$result) {
		    die('Invalid query: ' . mysqli_error($con));
		}
		$row=mysqli_fetch_array($result);
		$customerName=$row['customer_name'];
		$customerContact=$row['customer_contact'];

		$sql="SELECT * FROM invoices WHERE customer_id='$customerId' ORDER BY selling_date DESC";
		$result=mysqli_query($con,$sql);
		if (!$result) {
		    die('Invalid query: ' . mysqli_error($con));
		}
		if(mysqli_num_rows($result)){
			echo "
			<div id='tableTitleDiv'>
			Customer Shopping History
			</div>
			";
			echo "
			<div id='customerInfoDiv'>
			Customer name: $customerName<br>
			Contact No: $customerContact<br>
			</div>
			";
			echo "
			<div class='container-fluid pt-4 px-4'>
		<div class='bg-light text-center rounded p-4'>
		   
			<div class='table-responsive sortable'>
				<table class='table text-start align-middle table-bordered table-hover mb-0'>
					<thead>
				<tr>
						<td>Bill No.</td>
						<td>Date of Issue</td>
						<td>Amount</td>
						<td>Action</td>
					</tr>
				</thead>
				<tbody>
			";
			$sum=0;
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
				//$sum+=$total;
				$sum+=$amount;
				echo"
					<tr>
						<td>$invoiceId</td>
						<td>$sellingDate</td>
						<td>$amount</td>
						<td><input type='button' onClick='OpenInNewTab($invoiceId);' class='btn btn-info ' value='SHOW BILL'></td>	
					<tr>
				";
			}
			echo "
				</tbody>
			</table>
			<div id='customerTotalText'>
			Total expenditure: $sum
			</div>
			</div>
			</div>
			</div>
			";
		}else{
			echo "No bills issued yet.";
		}

	}

?>
</div>
<div id="tableButtons">
		<a href="javascript:history.back()" class="btn btn-warning ">Back</a>
	</div>
  </div>
</body>

</html>
