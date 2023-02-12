<?php
	$q = $_GET['q'];
	require 'myConnection.php';	
	$sql="SELECT type_id,type_name FROM types WHERE category_id='$q'";
	$result=mysqli_query($con,$sql);
	if (!$result) {
		die('Invalid query: ' . mysqli_error($con));
	}
	if(mysqli_num_rows($result)){
		echo "<select id='typeName' name='typeName' class='form-control'>";
		echo "<option value='0'>N/A</option>";
		while($row=mysqli_fetch_array($result)){
			$name=$row['type_name'];
			$id=$row['type_id'];
			echo "<option value='$id'>$name</option>";
		}
		echo "</select>";
	}else{
		echo "No types available for this category.";
		echo "
			<select id='typeName' name='typeName' style='display:none'>
				<option value='0'>N/A</option>
			</select>";
	}

?>