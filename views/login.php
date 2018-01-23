<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Eventer</title>
  <!-- Bootstrap core CSS-->
  <link href="<?=base_url()?>public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="<?=base_url()?>public/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="<?=base_url()?>public/css/sb-admin.css" rel="stylesheet">
</head>

<body  style="background-color: #712a2a">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
       <form action="/index.php/main/authorization" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">User Name:</label>
            <input class="form-control" type="text" name="user" /> 
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password:</label>
           <input class="form-control" type="password" name="pass" />
          </div>
          <input style="background-color:#d46262; border-color:#d46262;" class="btn btn-primary btn-block" type="submit" value="Sign in"   />   <a style="width: 39% !important; background-color:#d46262; border-color:#d46262;" href="/index.php/main/signUp" class="btn btn-primary btn-block">Sign Up</a> 
    
        </form>
        
      </div>
    </div>
  </div>
  
  <!-- Bootstrap core JavaScript-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="<?=base_url()?>public/vendor/jquery/jquery.min.js"></script>
  <script src="<?=base_url()?>public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="<?=base_url()?>public/vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>