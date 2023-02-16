<?php
	session_start();
	$invoiceId = $_GET['q'];
	require 'myConnection.php';	
	$sql="SELECT * FROM products JOIN sales ON products.product_id=sales.product_id JOIN invoices ON invoices.invoice_id=sales.invoice_id WHERE sales.invoice_id = '$invoiceId'";
	$result=mysqli_query($con,$sql);
	if (!$result) {
	    die('Invalid query: ' . mysqli_error($con));
	}
	if(mysqli_num_rows($result)){
		echo"
		<div class='container-fluid pt-4 px-4'>
		<div class='bg-light text-center rounded p-4'>
		   
			<div class='table-responsive sortable'>
				<table class='table text-start align-middle table-bordered table-hover mb-0'>
					<thead>
				<tr>
					<td scope='col'>Product No.</td>
					<td scope='col'>Product Name</td>
					<td scope='col'>Date</td>
					<td scope='col'>Type</td>
					<td scope='col'>Category</td>
					<td scope='col'>Size</td>
					<td scope='col'>Price</td>
					<td scope='col'>Return Quantity</td>
					<td scope='col'>Action</td>
				</tr>
			</thead>
			<tbody>
		";
		while($row=mysqli_fetch_array($result)){		
			$productId=$row['product_id'];
			$productName=$row['product_name'];
			$productType=$row['product_type'];
			$productCategory=$row['product_category'];
			$productSize=$row['product_size'];
			$productPrice=$row['product_price'];
			$date=$row['selling_date'];
			$quantity=$row['quantity'];
			$returnQuantity=$row['return_quantity'];
			$quantity-=$returnQuantity;
			if($productSize===""){
				$productSize="N/A";
			}
			
			$sql2="SELECT type_name FROM types WHERE type_id='$productType'";
			$result2=mysqli_query($con,$sql2);
			if (!$result2) {
				die('Invalid query: ' . mysqli_error($con));
			}
			$row2=mysqli_fetch_array($result2);
			$productTypeName=$row2['type_name'];
			if($productTypeName===null)
				$productTypeName="N/A";

			$sql2="SELECT category_name FROM categories WHERE category_id='$productCategory'";
			$result2=mysqli_query($con,$sql2);
			if (!$result2) {
				die('Invalid query: ' . mysqli_error($con));
			}
			$row2=mysqli_fetch_array($result2);
			$productCategoryName=$row2['category_name'];
			if($productCategoryName===null)
				$productCategoryName="N/A";
			$returnSelectId="returnSelect".$productId;
			echo "
				<tr>
					<td>$productId</td>
					<td>$date</td>
					<td>$productName</td>
					<td>$productTypeName</td>
					<td>$productCategoryName</td>
					<td>$productSize</td>
					<td>$productPrice</td>
					
					<td>
						<select id='$returnSelectId' class='form-control'>
						";
						for($i=0;$i<=$quantity;$i++){
							echo"<option value='$i'>$i</option>";
						}
					echo "
						</select>
					</td>
					<td><input type='button' class='btn btn-sm btn-info' name='reutrnButton' id='reutrnButton' value='RETURN' onclick='checkReturn($invoiceId,\"$productId\");'></td>
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
		echo "No products found by this Bill No.";
	}

?>