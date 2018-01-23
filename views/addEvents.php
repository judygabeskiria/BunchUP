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
echo $events;

?>
 <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Add Events</div>
      <div class="card-body">
<form action="/index.php/users/saveNewEvents" method="post">
  <div class="form-group">
  <label for="exampleInputEmail1">Event Name</label>  <input class="form-control"  type="text" name="EventName" /> 
 </div>
 
   <div class="form-group">
 <label for="exampleInputEmail1">Event Date </label> <input class="form-control"  type="date" name="EventDate" />  
 </div>
   <div class="form-group">
 	<label for="exampleInputEmail1">Event Time</label>  <input class="form-control"  type="text" name="EventTime" placeholder="15:00" /> 
    </div>
      <div class="form-group"> 
 <label for="exampleInputEmail1"> Event Location</label>  <input class="form-control"   type="text" name="EventLocation" /> 
  </div>
    <div class="form-group">
<label for="exampleInputEmail1">  Event Description</label> <input class="form-control"   type="text" name="EventDescription" /> 
  </div>
    <div class="form-group"> 
 <label for="exampleInputEmail1"> Event Category</label> <?php echo $categories; ?> 
  </div> 
 <input style="background-color:#d46262; border-color:#d46262;" class="btn btn-primary btn-block" type="submit" value="SAVE" />  
 
</form>
 



</body>
</html>
