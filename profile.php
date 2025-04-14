<?php

	require "functions.php";
	check_login();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="icon" type="image/png" sizes="512x512" href="images/favicon6.png">
    <link rel="icon" href="images/favicon6.ico" type="image/x-icon">
    <link rel="shortcut icon" href="images/favicon6.ico" type="image/x-icon">
</head>
<body>

<?php include('header.php');?>
	<div class="regbody">
	<div class="containter2">
		<h1>Profile</h1>
		

		
		<?php if(check_login()):?>
			<p>Welcome, <?=$_SESSION['USER']->firstname?> <?=$_SESSION['USER']->lastname?>!</p>
			<p>Email: <?=$_SESSION['USER']->email?></p>
			<p>User Role: <?=$_SESSION['USER']->user_role?></p>
			<div class="form-btn">
				<input type= "button" class="btn btn-primary" value="Logout" onclick="location.href='logout.php'">
			</div>
			
	
 <!--
	<?php /*if(check_login(false)):?>
		Hi, <?=$_SESSION['USER']->username?>;

		<br><br>
		<?php if(!check_verified()):?>
			<a href="verify.php">
				<button>Verify Profile</button>
			</a>
		<?php endif;*/?> -->
	<?php endif; ?>
		
 

</body>
</html>