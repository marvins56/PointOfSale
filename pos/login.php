<?php
	ob_start();
	session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>POS</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="Template/dashmin-1.0.0/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="Template/dashmin-1.0.0/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="Template/dashmin-1.0.0/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="Template/dashmin-1.0.0/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Template Stylesheet -->
    <link href="Template/dashmin-1.0.0/css/style.css" rel="stylesheet">
</head>

<body>	
<div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->
	<!-- <div id="loginMainDiv" class="container"> -->


  <!-- Sign In Start -->
  <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="loginCheck.php" class="">
                                <h3 class="text-primary"><i class="fa fa-hashtag me-2"> POS<div id="loginTitleDiv"></div></i>
							
							</h3>
                            </a>
						
                            <h3>Sign In</h3>
                        </div>
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
						
						<div class="form-floating mb-3">

							<input type="text" name="username" class="form-control"  id="floatingText" placeholder="Enter your username.">
							<label for="floatingText">Username</label>
                        </div>
                      
			
                        <div class="form-floating mb-4">
						<input type="password" name="password" class="form-control"  id="floatingPassword" placeholder="Enter your password.">
                           
                            <label for="floatingPassword">Password</label>
                        </div>
                        
						<div id="rightDiv">
							<input type="submit" name="submit" value="Log In" class="btn btn-primary py-3 w-100 mb-4">

						</div>
                        
						</form>
					</div>
                </div>
            </div>
        </div>

		</div>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="Template/dashmin-1.0.0/lib/lib/chart/chart.min.js"></script>
<script src="Template/dashmin-1.0.0/lib/lib/easing/easing.min.js"></script>
<script src="Template/dashmin-1.0.0/lib/lib/waypoints/waypoints.min.js"></script>
<script src="Template/dashmin-1.0.0/lib/lib/owlcarousel/owl.carousel.min.js"></script>
<script src="Template/dashmin-1.0.0/lib/lib/tempusdominus/js/moment.min.js"></script>
<script src="Template/dashmin-1.0.0/lib/lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="Template/dashmin-1.0.0/lib/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Template Javascript -->
<script src="Template/dashmin-1.0.0/lib/js/main.js"></script>
</body>

</html>


<?php
	require 'myConnection.php';

	if(isset($_SESSION['id'])){
		$id=$_SESSION['id'];
		$sql="SELECT * FROM accounts WHERE account_id='$id'";
		$result=mysqli_query($con,$sql);
		if (!$result) {
		    die('Invalid query: ' . mysqli_error($con));
		}
		if(mysqli_num_rows($result)){
			header('Location: panel.php');
		}
	}

	$sql="SELECT company_name FROM company";
	$result=mysqli_query($con,$sql);
	if (!$result) {
	    die('Invalid query: ' . mysqli_error($con));
	}
	$row=mysqli_fetch_array($result);
	$companyName=$row['company_name'];

	echo"
	<script>
		setTitle('$companyName');
	</script>";

	if(isset($_POST['submit'])){
		$username=$_POST['username'];
		$password=$_POST['password'];

		$sql="SELECT * FROM accounts WHERE employee_name='$username' AND password='$password'";
		$result=mysqli_query($con,$sql);
		if (!$result) {
		    die('Invalid query: ' . mysqli_error($con));
		}
		if(mysqli_num_rows($result)){
			$row=mysqli_fetch_array($result);
			//echo $row['account_id'];
			$_SESSION['id']=$row['account_id'];
			header('Location: panel.php');
		}else{
			session_destroy();
			
			echo"
			<script>
			swal({
				title: 'Authentication Error',
				text:'Incorrect Username or password',
				icon: 'error',
			  });
			</script>";	
		}
	}
?>
