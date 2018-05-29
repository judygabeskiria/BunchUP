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
<title>Chat</title>
</head>

<body  style="background-color: #712a2a" >

  <?php
  	if(!empty($events))
  {
  	echo  $events ;
  	}
    if(!empty($Messages))
  {
    echo  $Messages ;
    }
    if(empty($Messages))
    {
      echo "there's no messages";
    }

  ?>

<?php
//include("config.php");
//if(isset($_SESSION['user'])){
  //$usermessages1= $_GET['usermessages'];
?>
 <!-- <h2>Chat</h2>
 <div class='msgs'>
 </div>
 <form id="msg_form" action="/index.php/users/" method="GET">
  <input name="msg" size="30" type="text"/>
  <button>Send</button>
 </form> -->
<?php
//}

?>
