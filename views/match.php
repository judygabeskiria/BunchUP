<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Match</title>
</head>

<body style="background-color:#712a2a;">
<?php
echo $events;
echo '<br></br>';

if(!empty($matches))
{
	echo  $matches;
	}
	else{
		echo '<div class="alert alert-light" role="alert">
  	There is no match unfortunately
		</div>' ;

	}

?>


</body>
</html>
