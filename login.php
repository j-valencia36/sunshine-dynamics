<?php  

require "functions.php";

$errors = array();

if($_SERVER['REQUEST_METHOD'] == "POST")
{

	$errors = login($_POST);

	if(count($errors) == 0)
	{
		header("Location: verify.php");
		die;
	}
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="icon" type="image/png" sizes="512x512" href="images/favicon6.png">
    <link rel="icon" href="images/favicon6.ico" type="image/x-icon">
    <link rel="shortcut icon" href="images/favicon6.ico" type="image/x-icon">
</head>
<body>
	<?php include('header.php')?>
		<div class="regbody">
		<div class="containter2">
		<h1>Login</h1>

		

	<div>
		<div>
			<?php if(count($errors) > 0):?>
				<?php foreach ($errors as $error):?>
					<?= $error?> <br>	
				<?php endforeach;?>
			<?php endif;?>

		</div>

		<form method="post"> <!-- Form action points to itself -->
            <div class="form-group">
                <input type="email" placeholder="Enter Email" name="email" class="form-control" autofocus required>                
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter Password" name="password" class="form-control" required>                
            </div>
            <div class="form-group text-center"> <!-- Center the reCAPTCHA -->
                <div class="g-recaptcha" data-sitekey="6LfdOW4qAAAAAJLi1UukNFLMrfIoEZ5bBbezMg6x"></div> <!-- Add your site key here -->
            </div>
            <div class="text-center"> <!-- Center the button -->
                <input type="submit" value="Login" name="login" class="btn btn-primary mt-3">
            </div>
        </form>
		
		<div class="text-center"> <!-- Center the registration link -->
            <p>Need to create an account? <a href="signup.php">Register Here</a></p>
        </div>
        <div class="text-center"> 
            <p>Forgot password? <a href="reset.php">Reset Here</a></p>
        </div>
	</div>
	</div>
	</div>
</body>
</html>