<?php
	ob_start();
	require 'mask.php';	
	require 'loginCheck.php';
	require 'supervisorCheck.php';

	if(isset($_POST['typeSubmit'])){
		$typeName=$_POST['typeName'];
		$categoryName=$_POST['categoryName'];

		$sql="SELECT type_id FROM types WHERE type_name='$typeName'";
		$result=mysqli_query($con,$sql);
		if (!$result) {
		    die('Invalid query: ' . mysqli_error($con));
		}
		if(mysqli_num_rows($result)){
			echo "
				<script>
				alert('Type already exists.');
				</script>
			";
		}else {
			$sql="SELECT category_id FROM categories WHERE category_name='$categoryName'";
			$result=mysqli_query($con,$sql);
			if (!$result) {
			    die('Invalid query: ' . mysqli_error($con));
			}
			$row=mysqli_fetch_array($result);
			$categoryId=$row['category_id'];

			$sql="INSERT INTO types (type_name,category_id) values ('$typeName','$categoryId')";
			$result=mysqli_query($con,$sql);
			if (!$result) {
			    die('Invalid query: ' . mysqli_error($con));
			}
		}
	}else if(isset($_POST['typeChangeSubmit'])){
		$typeName=$_POST['typeChangeName'];
		$categoryName=$_POST['categoryChangeName'];
		$id=$_POST['typeChangeId'];

		$sql="SELECT type_id FROM types WHERE type_name='$typeName'";
		$result=mysqli_query($con,$sql);
		if (!$result) {
		    die('Invalid query: ' . mysqli_error($con));
		}
		if(mysqli_num_rows($result)){
			echo "
				<script>
				alert('Type already exists.');
				</script>
			";
		}else {			
			$sql="SELECT category_id FROM categories WHERE category_name='$categoryName'";
			$result=mysqli_query($con,$sql);
			if (!$result) {
			    die('Invalid query: ' . mysqli_error($con));
			}
			$row=mysqli_fetch_array($result);
			$categoryId=$row['category_id'];
//echo $id;

			$sql="UPDATE types SET `type_name`='$typeName', `category_id`='$categoryId' WHERE type_id='$id'";
			$result=mysqli_query($con,$sql);
			if (!$result) {
			    die('Invalid query: ' . mysqli_error($con));
			}
		}
	}

	$sql="SELECT * FROM types";
	$result=mysqli_query($con,$sql);
	if (!$result) {
	    die('Invalid query: ' . mysqli_error($con));
	}
	if(mysqli_num_rows($result)){
		echo "
		<div id='tableTitleDiv'>
		Product Types
		</div>
		";
		echo"
		<div class='container-fluid pt-4 px-4'>
		<div class='bg-light text-center rounded p-4'>
		   
			<div class='table-responsive sortable'>
				<table class='table text-start align-middle table-bordered table-hover mb-0'>
					<thead>
					<tr>
					<td>Type</td>
					<td>Category Name</td>
					<td>Edit</td>
					<td>Delete</td>
				</tr>
			</thead>
			<tbody>
		";
		while($row=mysqli_fetch_array($result)){
			$typeName=$row['type_name'];
			$categoryId=$row['category_id'];
			$id=$row['type_id'];
			$sql2="SELECT category_name FROM categories WHERE category_id='$categoryId'";
			$result2=mysqli_query($con,$sql2);
			if (!$result2) {
			    die('Invalid query: ' . mysqli_error($con));
			}
			$row2=mysqli_fetch_array($result2);
			$categoryName=$row2['category_name'];
			echo "
				<tr>
					<td>$typeName</td>
					<td>$categoryName</td>
					<td><a class='btn btn-info' href='#typeChangeForm' role='button' data-toggle='modal' onClick='setTypeId($id);'>MODIFY</a></td>
					<td><input type='button' value='DELETE' onclick='deleteType($id);' class='btn btn-danger '></td>
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
	}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Types</title>  
</head>

<body>
	<div id="tableButtons">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<a class="btn  btn-info" href="#typeForm" role="button" data-toggle="modal" id="createNewTypeButton">Add New Product Type</a>
			<a href="javascript:history.back()" class="btn btn-warning btn-sm">Back</a>
		</form>
	</div>



	<div class="modal fade" id="typeForm">
	  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	  <div class="modal-dialog" id="signinDialog">
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
	          <h4 class="modal-title">Add New Product Type</h4>
	        </div>
	        <div class="modal-body">
	          <input class="form-control" id="typeName" name="typeName" placeholder="Enter new type name." required type="text">
	           	<?php
	          		$sql="SELECT category_name FROM categories";
	          		$result=mysqli_query($con,$sql);
					if (!$result) {
					    die('Invalid query: ' . mysqli_error($con));					}
					echo "<select name='categoryName' class='form-control'>";
					while($row=mysqli_fetch_array($result)){
						$name=$row['category_name'];
						echo "<option>$name</option>";
					}
					echo "</select>";
	          	?>
	    
	        </div>
	        <div class="modal-footer">
	          <a href="#" data-dismiss="modal" class="btn btn-default">Close</a>      
	          <input type="submit" class="btn btn-primary" id="typeSubmit" name ="typeSubmit" value="Create">     
	        </div>
	      </div>
	    </div>
	  </form> 
	</div>

	<div class="modal fade" id="typeChangeForm">
	  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	  <div class="modal-dialog" id="signinDialog">
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
	          <h4 class="modal-title">Enter title for this product type.</h4>
	        </div>
	        <div class="modal-body">
	          <input class="form-control" id="typeChangeName" name="typeChangeName" placeholder="Enter new type name." required type="text">
	           	<?php
	          		$sql="SELECT category_name FROM categories";
	          		$result=mysqli_query($con,$sql);
					if (!$result) {
					    die('Invalid query: ' . mysqli_error($con));					}
					echo "<select name='categoryChangeName' class='form-control'>";
					while($row=mysqli_fetch_array($result)){
						$name=$row['category_name'];
						echo "<option>$name</option>";
					}
					echo "</select>";
	          	?></br>
	          <input id="typeChangeId" name="typeChangeId" required type="text" style="display:none">
			  </br>
	        </div>
	        <div class="modal-footer">
	          <a href="#" data-dismiss="modal" class="btn btn-default">Close</a>      
	          <input type="submit" class="btn btn-primary" id="typeChangeSubmit" name ="typeChangeSubmit" value="Change">
	        </div>
	      </div>
	    </div>
	  </form> 
	</div>



</body>

</html>