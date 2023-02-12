<?php
	ob_start();
	session_start();
	require 'myConnection.php';
	if(isset($_GET['x'])){
		$invoiceId=$_GET['x'];
		$productId=$_GET['y'];
		$quantity=$_GET['z'];

		$sql="SELECT (product_price*quantity-(('$quantity'*product_price)*discount/100)) AS amount,return_quantity FROM sales JOIN products ON sales.product_id=products.product_id JOIN invoices ON invoices.invoice_id=sales.invoice_id WHERE sales.invoice_id='$invoiceId' AND sales.product_id='$productId'";
		$result=mysqli_query($con,$sql);
		if (!$result) {
		    die('Invalid query: ' . mysqli_error($con));
		}
		$row=mysqli_fetch_array($result);
		$amount=floor($row['amount']);
		$returnQuantity=$row['return_quantity'];
		$returnQuantity+=$quantity;

		$sql="INSERT INTO returns (return_date,invoice_id,product_id,quantity,amount) VALUES (now(),'$invoiceId','$productId','$quantity','$amount')";
		$result=mysqli_query($con,$sql);
		if (!$result) {
		    die('Invalid query: ' . mysqli_error($con));
		}
		
		$sql="UPDATE sales SET return_quantity='$returnQuantity' WHERE invoice_id='$invoiceId' AND product_id='$productId'";
		$result=mysqli_query($con,$sql);
		if (!$result) {
		    die('Invalid query: ' . mysqli_error($con));
		}


		$sql="SELECT current_quantity FROM stocks WHERE product_id='$productId'";
		$result=mysqli_query($con,$sql);
		if (!$result) {
		    die('Invalid query: ' . mysqli_error($con));
		}
		$row=mysqli_fetch_array($result);
		$currentQuantity=$row['current_quantity'];
		$currentQuantity+=$returnQuantity;


		$sql="UPDATE stocks SET current_quantity='$currentQuantity' WHERE product_id='$productId'";
		$result=mysqli_query($con,$sql);
		if (!$result) {
		    die('Invalid query: ' . mysqli_error($con));
		}

		
		$sql="SELECT return_id FROM returns ORDER BY return_id DESC LIMIT 1";
		$result=mysqli_query($con,$sql);
		if (!$result) {
		    die('Invalid query: ' . mysqli_error($con));
		}
		$row=mysqli_fetch_array($result);
		$returnId=$row['return_id'];

		echo "
		<script>			
			alert('Return Successfull. Return ID: $returnId');
			document.location.href='returnProduct.php';
		</script>
		";

	}else{
		//header('Location: panel.php');
	}

?>