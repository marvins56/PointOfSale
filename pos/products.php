<?php
	ob_start();
	require 'mask.php';	
	require 'loginCheck.php';
 
	$sql="SELECT * FROM products JOIN stocks ON products.product_id=stocks.product_id WHERE stocks.is_deleted=0";
	$result=mysqli_query($con,$sql);
	if (!$result) {
	    die('Invalid query: ' . mysqli_error($con));
	}
	if(mysqli_num_rows($result)){
		echo "
		<div id='tableTitleDiv'>
		Products List
		</div>
		";
		echo"
		<div class='container-fluid pt-4 px-4'>
		<div class='bg-light text-center rounded p-4'>
		   
			<div class='table-responsive'>
				<table class='table text-start align-middle table-bordered table-hover mb-0'>
					<thead>
						<tr class='text-dark'>
					
					<td>Product No.</td>
					<td>Product Name</td>
					<td>Type</td>
					<td>Category</td>
					<td>Size</td>
					<td>Price</td>
					<td>Available Quantity</td>
					<td>Action</td>
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

			if(empty($productSize)){
				$productSize="N/A";
			}

			$sql2="SELECT current_quantity FROM stocks WHERE product_id='$productId'";
			$result2=mysqli_query($con,$sql2);
			if (!$result2) {
				die('Invalid query: ' . mysqli_error($con));
			}
			
			$row2=mysqli_fetch_array($result2);
			$currentQuantity=$row2['current_quantity'];

			$sql3="SELECT type_name FROM types WHERE type_id='$productType'";
			$result3=mysqli_query($con,$sql3);
			if (!$result3) {
				die('Invalid query: ' . mysqli_error($con));
			}
			$row3=mysqli_fetch_array($result3);
			if(!empty($row3))
				$productTypeName=$row3['type_name'];
					if(empty($productTypeName)){
						$productTypeName="N/A";
					}
			

			$sql4="SELECT category_name FROM categories WHERE category_id='$productCategory'";
			$result4=mysqli_query($con,$sql4);
			if (!$result4) {
				die('Invalid query: ' . mysqli_error($con));
			}
			$row4=mysqli_fetch_array($result4);
			if(!empty($row4))
				$productCategoryName = $row4['category_name'];
					if(empty($productCategoryName)){
						$productCategoryName="N/A";
					}
			
			echo "
				<tr>
					<td>$productId</td>
					<td>$productName</td>
					 <td></td>
					<td>$productCategoryName</td>
					<td>$productSize</td>
					<td>$productPrice</td>
					<td>$currentQuantity</td>
					<td><input type='button' value='DELETE' onclick='deleteProduct(\"$productId\");' class='btn btn-danger btn-xs'></td>
				</tr>
			";
		}
		echo"
			</tbody>
		</table>
		<div id='customerTotalText'>Please go to <a href='stocks.php'>stocks</a> page to import new product stock.</div>
		</div>
		";
	}else{
		echo "No products available currently.";
	}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Products</title>  
</head>

<body>
	<div id="tableButtons">
		<a href="javascript:history.back()" class="btn btn-warning btn-sm">Back</a>
	</div>	
</body>

</html>