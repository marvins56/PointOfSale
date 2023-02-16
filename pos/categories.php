<?php
	ob_start();
	require 'mask.php';	
	require 'loginCheck.php';
	require 'supervisorCheck.php';
	
	if(isset($_POST['categorySubmit'])){
		$name=$_POST['categoryName'];
		$sql="SELECT category_id FROM categories WHERE category_name='$name'";
		$result=mysqli_query($con,$sql);
		if (!$result) {
		    die('Invalid query: ' . mysqli_error($con));
		}
		if(mysqli_num_rows($result)){
			echo "
				<script>
				alert('Category already exists.');
				</script>
			";
		}else {
			$sql="INSERT INTO categories (category_name) values ('$name')";
			$result=mysqli_query($con,$sql);
			if (!$result) {
			    die('Invalid query: ' . mysqli_error($con));
			}
		}
	}else if(isset($_POST['categoryChangeSubmit'])){
		$name=$_POST['categoryChangeName'];
		$id=$_POST['categoryChangeId'];

		$sql="SELECT category_id FROM categories WHERE category_name='$name'";
		$result=mysqli_query($con,$sql);
		if (!$result) {
		    die('Invalid query: ' . mysqli_error($con));
		}
		if(mysqli_num_rows($result)){
			echo "
				<script>
				alert('Category already exists.');
				</script>
			";
		}else {
			$sql="UPDATE categories SET `category_name`='$name' WHERE category_id='$id'";
			$result=mysqli_query($con,$sql);
			if (!$result) {
			    die('Invalid query: ' . mysqli_error($con));
			}
		}
	}

	$sql="SELECT * FROM categories";
	$result=mysqli_query($con,$sql);
	if (!$result) {
	    die('Invalid query: ' . mysqli_error($con));
	}
	if(mysqli_num_rows($result)){
		echo "
		<div id='tableTitleDiv'>
		Product Categories
		</div>
		";
		echo"		
		<div class='container-fluid pt-4 px-4'>
		<div class='bg-light text-center rounded p-4'>
		   
			<div class='table-responsive sortable'>
				<table class='table text-start align-middle table-bordered table-hover mb-0'>
					<thead>
					
					<tr class='text-dark'>
					<td>Category Name</td>
					<td>Action</td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody>
		";
		while($row=mysqli_fetch_array($result)){
			$name=$row['category_name'];
			$id=$row['category_id'];
			echo "
				<tr>
					<td>$name</td>					
					<td><a class='btn btn-xs btn-info' href='#categoryChangeForm' role='button' data-toggle='modal' onClick='setCategoryId($id);'>MODIFY</a></td>
					<td><input type='button' value='DELETE' onclick='deleteCategory($id);' class='btn btn-danger btn-xs'></td>
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
  <title>Categories</title>  
  <link href="Template/dashmin-1.0.0/css/style.css" rel="stylesheet">  
</head>

<body>
	<div id="tableButtons">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<a class="btn btn-info" href="#categoryForm" role="button" data-toggle="modal" id="createNewCategoryButton">Create New Category</a>
			<a href="javascript:history.back()" class="btn btn-warning btn-sm">Back</a>
		</form>

	</div>	

	<div class="modal fade" id="categoryForm">
	  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	  <div class="modal-dialog" id="signinDialog">
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
	          <h4 class="modal-title">Add New Category</h4>
	        </div>
	        <div class="modal-body">
	          <input class="form-control" id="categoryName" name="categoryName" placeholder="Enter new category name." required type="text">
	        </div>
	        <div class="modal-footer">
	          <a href="#" data-dismiss="modal" class="btn btn-default">Close</a>      
	          <input type="submit" class="btn btn-primary" id="categorySubmit" name ="categorySubmit" value="Create">     
	        </div>
	      </div>
	    </div>
	  </form> 
	</div>

	<div class="modal fade" id="categoryChangeForm">
	  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	  <div class="modal-dialog" id="signinDialog">
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
	          <h4 class="modal-title">Enter new name for the category.</h4>
	        </div>
	        <div class="modal-body">
	          <input class="form-control" id="categoryChangeName" name="categoryChangeName" placeholder="Enter new category name." required type="text">
	          <input id="categoryChangeId" name="categoryChangeId" required type="text" style="display:none">
	        </div>
	        <div class="modal-footer">
	          <a href="#" data-dismiss="modal" class="btn btn-default">Close</a>      
	          <input type="submit" class="btn btn-primary" id="categoryChangeSubmit" name ="categoryChangeSubmit" value="Change">     
	        </div>
	      </div>
	    </div>
	  </form> 
	</div>
</body>

</html>