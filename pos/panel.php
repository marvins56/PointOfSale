<?php
	ob_start();
	require 'mask.php';	
	require 'loginCheck.php';
include 'myConnection.php';

  $sql = "SELECT employee_address,employee_name from accounts where is_admin = 1";
  $sql2 = "SELECT * from stock where current_quantity = 100";
  $result=mysqli_query($con,$sql);
  $result2=mysqli_query($con,$sql2);
  if($result &&  $result2){
   $res =  mysqli_num_rows($result);
   $res2 =  mysqli_num_rows($result2);
   if($res &&  $res2){
    $rows=mysqli_fetch_array($result);
    foreach($rows as $row ){
$email = $row;
while($rows2=mysqli_fetch_array($result2)){
  $stockID=$row2['stock_id'];
  $productId=$row2['product_id'];
  $totalQuantity=$row2['import_quantity'];
  $currentQuantity=$row2['current_quantity'];
  $importDate=$row2['import_date'];
  $soldQuantity=$totalQuantity-$currentQuantity;

  $body = "
  <tr>
<td>$stockID</td>
<td> $productId</td>
<td>$totalQuantity</td>
<td>$currentQuantity</td>
<td> $importDate</td>
<td>$ $soldQuantity</td>
  <tr>
  
  ";

$body2 = "
<div class='container-fluid pt-4 px-4>
<div class='bg-light text-center rounded p-4'>
		   
<div class='table-responsive'>
  <table class='table text-start align-middle table-bordered table-hover mb-0'>
    <thead>
      <tr class='text-dark'>
      <tr>
    <td scope='col'>Stock No.</td>
    <td scope='col'>Product No.</td>
    <td scope='col' >In Stock Quantity</td>
    <td scope='col'>Sold Quantity</td>
    <td scope='col'>Total Quantity</td>
    
    <td scope='col'>Import Date</td>	
          
  </tr>
    </thead>
<tbody>

<?php echo $body; ?>
</tbody>
</table>
</div>
</div>
</div>
";

}
    }
   }else{
    echo "error";
   }
  }




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

    <script src="https://smtpjs.com/v3/smtp.js">
</script>
    <!-- Libraries Stylesheet -->
    <link href="Template/dashmin-1.0.0/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="Template/dashmin-1.0.0/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="Template/dashmin-1.0.0/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Template Stylesheet -->
    <link href="Template/dashmin-1.0.0/css/style.css" rel="stylesheet">
</head >

<body onload="sendEmail()">	
<div class="container-xxl position-relative bg-white  p-0">
<div style="margin-top:20;">
<div class="jumbotron mt-10">
  <h1 class="display-4">Home </h1>
  <hr class="my-4">
  <p class="lead">To start ,kindly click or select any of the top tabs</p>


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

<script type='text/javascript'>

  var toemail = <?php $email ?>;
  var body = <?php $body2 ?>;
    function sendEmail(){
    Email.send({
    Host : 'smtp.elasticemail.com',
    Username : 'testmarvinug@gmail.com',
	  Password: '590FB6DB982CD11C3D1A0F822014531FBE18',
		To: toemail,
		From: 'okmarvins@gmail.com',
		Subject: 'POS STOCK ALERT',
		Body: body,

}).then(
  message => alert(message)
);

    }
		
</script>


