<?php 

session_start();

function signup($data)
{
	$errors = array();
 
	//validate 
	if(empty($data['firstname'])){
		$errors[] = "Please enter your first name";
	}

	if(empty($data['lastname'])){
		$errors[] = "Please enter your last name";
	}

	if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL)){
		$errors[] = "Please enter a valid email";
	}

	if(strlen(trim($data['password'])) < 8){
		$errors[] = "Password must be atleast 8 chars long";
	}

	if($data['password'] != $data['password2']){
		$errors[] = "Passwords must match";
	}

	$check = database_run("select * from users where email = :email limit 1",['email'=>$data['email']]);
	if(is_array($check)){
		$errors[] = "That email already exists";
	}

	//save
	if(count($errors) == 0){

		$arr['firstname'] = $data['firstname'];
		$arr['lastname'] = $data['lastname'];
		$arr['user_role'] = $data['user_role'];
		$arr['email'] = $data['email'];
		$arr['password'] = hash('sha256',$data['password']);
		$arr['date'] = date("Y-m-d H:i:s");

		$query = "insert into users (firstname,lastname,user_role,email,password,date) values 
		(:firstname,:lastname,:user_role,:email,:password,:date)";
		

		database_run($query,$arr);
	}
	return $errors;
}

function login($data)
{
	$errors = array();
 
	//validate 
	if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL)){
		$errors[] = "Please enter a valid email";
	}

	
 
	//check
	if(count($errors) == 0){

		$arr['email'] = $data['email'];
		$password = hash('sha256', $data['password']);

		$query = "select * from users where email = :email limit 1";

		$row = database_run($query,$arr);

		if(is_array($row)){
			$row = $row[0];

			if($password === $row->password){
				
				$_SESSION['USER'] = $row;
				$_SESSION['LOGGED_IN'] = true;
			}else{
				$errors[] = "wrong email or password";
			}

		}else{
			$errors[] = "wrong email or password";
		}
	}
	return $errors;
}

function database_run($query,$vars = array())
{
	$string = "mysql:host=localhost;dbname=sunshine_db";
	$con = new PDO($string,'root','');

	if(!$con){
		return false;
	}

	$stm = $con->prepare($query);
	$check = $stm->execute($vars);

	if($check){
		
		$data = $stm->fetchAll(PDO::FETCH_OBJ);
		
		if(count($data) > 0){
			return $data;
		}
	}

	return false;
}

function check_login($redirect = true){

	if(isset($_SESSION['USER']) && isset($_SESSION['LOGGED_IN'])){

		return true;
	}

	if($redirect){
		header("Location: login.php");
		die;
	}else{
		return false;
	}
	
}
/*
function check_verified(){

	$id = $_SESSION['USER']->id;
	$query = "select * from users where id = '$id' limit 1";
	$row = database_run($query);

	if(is_array($row)){
		$row = $row[0];

		if($row->email == $row->email_verified){

			return true;
		}
	}
 
	return false;
 	
}*/

function generate_otp($email) {
    $otp = rand(100000, 999999); // Generate a 6-digit OTP
    $expires = time() + (60 * 10); // OTP expires in 10 minutes

    $query = "insert into otp (email, code, expires) values (:email, :code, :expires)";
    $vars = [
        'email' => $email,
        'code' => $otp,
        'expires' => $expires
    ];

    database_run($query, $vars);

    return $otp;
}

function verify_otp($email, $code) {
    $query = "select * from otp where email = :email and code = :code limit 1";
    $vars = [
        'email' => $email,
        'code' => $code
    ];

    $row = database_run($query, $vars);

    if (is_array($row)) {
        $row = $row[0];
        if (time() < $row->expires) {
            return true; // OTP is valid
        }
    }

    return false; // OTP is invalid or expired
}

