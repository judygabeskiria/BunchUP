<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="<?=base_url()?>public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="<?=base_url()?>public/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="<?=base_url()?>public/css/sb-admin.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="<?=base_url()?>public/vendor/jquery/jquery.min.js"></script>
  <script src="<?=base_url()?>public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="<?=base_url()?>public/vendor/jquery-easing/jquery.easing.min.js"></script>
<title>Add Events</title>
</head>

<body  style="background-color: #712a2a" >
<?php
if(!empty($message))
{
	echo '<p align="center" style="font-size:30px; font-weight:bold;"> '.$message.' </p>';
	
	}


?>

 <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Sign Up</div>
      <div class="card-body">
 
<form action="/index.php/main/registration" method="post">
 <div class="form-group">
 <label for="exampleInputEmail1">Fname:</label>  <input class="form-control" type="text" name="fname" />  
 </div>
 <div class="form-group">
 <label for="exampleInputEmail1">Lname:</label>  <input class="form-control" type="text" name="lname" /> 
 </div>
 <div class="form-group">
<label for="exampleInputEmail1"> User Name:</label>  <input class="form-control" type="text" name="username" />  
 </div>
<div class="form-group">
<label for="exampleInputEmail1"> Password:</label>  <input class="form-control" type="password" name="pass" />  
</div>
 <div class="form-group">
 <label for="exampleInputEmail1">Confirm Password:</label>  <input class="form-control" type="password" name="confpass" />  
 </div>
 <input type="submit" style="background-color:#d46262; border-color:#d46262;" class="btn btn-primary btn-block" value="Sign Up" />  

 


</form>
</div>
</div>
</div>
 




</body>
</html>