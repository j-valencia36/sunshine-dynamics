<?php  

require "functions.php";

$errors = array();

if($_SERVER['REQUEST_METHOD'] == "POST")
{

	$errors = signup($_POST);

	if(count($errors) == 0)
	{
		echo "<div class='alert alert-success'>You have successfully signed up.</div>";	
	}
}

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
	<?php include('header.php')?>
	<div class="regbody">
	<div class="containter2">
	<h1>Signup</h1>

	

	
		<div>
			<?php if(count($errors) > 0):?>
				<?php foreach ($errors as $error):?>
					<?= $error?> <br>	
				<?php endforeach;?>
			<?php endif;?>

		</div>
		<form method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="firstname" placeholder="First Name:" autofocus>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="lastname" placeholder="Last Name:">
            </div>
            <div class="form-group">
                <select id="user_role" class="form-control" name="user_role">
                    <option value="" disabled selected>Select role</option>
                    <option value="employee">Employee</option>
                    <option value="manager">Manager</option>
                </select>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password:" oninput="checkPasswordStrength()">
                <div id="password-strength" class="strength-meter"></div>
                <small id="password-feedback" class="form-text"></small>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password2" placeholder="Confirm Password:">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Signup" name="Signup">
            </div>
        </form>
        <div>
            <div><p>Already Registered? <a href="login.php">Login Here</a></p></div>
        </div>
    </div>
    </div>

    <script>
        function checkPasswordStrength() {
            const password = document.getElementById("password").value;
            const strengthMeter = document.getElementById("password-strength");
            const feedback = document.getElementById("password-feedback");

            let strength = 0;
            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++; // Special characters

            switch (strength) {
                case 0:
                    strengthMeter.style.width = "0%";
                    feedback.textContent = "";
                    break;
                case 1:
                    strengthMeter.style.width = "20%";
                    strengthMeter.className = "strength-meter weak";
                    feedback.textContent = "Weak password.";
                    break;
                case 2:
                    strengthMeter.style.width = "50%";
                    strengthMeter.className = "strength-meter medium";
                    feedback.textContent = "Medium password.";
                    break;
                case 3:
                    strengthMeter.style.width = "75%";
                    strengthMeter.className = "strength-meter medium";
                    feedback.textContent = "Strong password.";
                    break;
                case 4:
                case 5:
                    strengthMeter.style.width = "100%";
                    strengthMeter.className = "strength-meter strong";
                    feedback.textContent = "Very strong password!";
                    break;
                default:
                    strengthMeter.style.width = "0%";
                    feedback.textContent = "";
                    break;
            }
        }
    </script>
	
</body>
</html>