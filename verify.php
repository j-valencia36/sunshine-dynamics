<?php

	require "mail.php";
	require "functions.php";
	check_login();

	$errors = array();
/*
	if($_SERVER['REQUEST_METHOD'] == "GET" && !check_verified()){

		//send email
		$vars['code'] =  rand(10000,99999);

		//save to database
		$vars['expires'] = (time() + (60 * 10));
		$vars['email'] = $_SESSION['USER']->email;

		$query = "insert into verify (code,expires,email) values (:code,:expires,:email)";
		database_run($query,$vars);

		$message = "Your code is " . $vars['code'];
		$subject = "One Time Code";
		$recipient = $vars['email'];
		send_mail($recipient,$subject,$message);
	}

	if($_SERVER['REQUEST_METHOD'] == "POST"){

		if(!check_verified()){

			$query = "select * from verify where code = :code && email = :email";
			$vars = array();
			$vars['email'] = $_SESSION['USER']->email;
			$vars['code'] = $_POST['code'];

			$row = database_run($query,$vars);

			if(is_array($row)){
				$row = $row[0];
				$time = time();

				if($row->expires > $time){

					$id = $_SESSION['USER']->id;
					$query = "update users set email_verified = email where id = '$id' limit 1";
					
					database_run($query);

					header("Location: profile.php");
					die;
				}else{
					echo "Code expired";
				}

			}else{
				echo "wrong code";
			}
		}else{
			echo "You're already verified";
		}
	}*/

if ($_SERVER['REQUEST_METHOD'] == "GET" /*&& !check_verified()*/) {
    $email = $_SESSION['USER']->email;

    // Generate OTP
    $otp = generate_otp($email);

    // Send OTP via email
    $message = "Your one-time code is: " . $otp;
    $subject = "Two-Step Authentication Code";
    send_mail($email, $subject, $message);

    //echo "A one-time code has been sent to your email.";
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_SESSION['USER']->email;
    $code = $_POST['code'];

    if (verify_otp($email, $code)) {
        // Mark the user as verified
        //$id = $_SESSION['USER']->id;
        //$query = "update users set email_verified = email where id = :id limit 1";
        //database_run($query, ['id' => $id]);

        header("Location: profile.php");
        die;
    } else {
        echo "Invalid or expired code.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Verify</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
	<h1>Verify</h1>

	
  
	<br><br>
 	<div>
			<br>An email was sent to your address. paste the code from the email here<br>
		<div>
			<?php if(count($errors) > 0):?>
				<?php foreach ($errors as $error):?>
					<?= $error?> <br>	
				<?php endforeach;?>
			<?php endif;?>

		</div><br>
		<form method="post">
			<input type="text" name="code" placeholder="Enter your Code"><br>
 			<br>	
			<input type="submit" value="Sumbit">
		</form>
	</div>
</div>
</div>

</body>
</html>