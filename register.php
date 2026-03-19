<?php
include("config/db.php");

if(isset($_POST['register'])){

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$address = $_POST['address'];

/* chekcing empty*/
if($name=="" || $email=="" || $password=="" || $phone=="" || $address==""){

echo "<script>alert('Please fill all fields');</script>";

}

/* email check*/
elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){

echo "<script>alert('Enter valid email');</script>";

}

/* passeord check */
elseif(strlen($password) < 6){

echo "<script>alert('Password must be at least 6 characters');</script>";

}

/*phone check*/
elseif(strlen($phone) != 10){

echo "<script>alert('Phone must be 10 digits');</script>";

}

else{

/* email already exists */
$check = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");

if(mysqli_num_rows($check) > 0){

echo "<script>alert('Email already registered');</script>";

}
else{

mysqli_query($conn,"INSERT INTO users(name,email,password,phone,address)
VALUES('$name','$email','$password','$phone','$address')");

echo "<script>alert('Registered Successfully');window.location='login.php';</script>";

}

}

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Register</title>
<link rel="stylesheet" href="css/register.css">

</head>

<body>

<div class="form-box">

<h2>Create Account</h2>

<form method="post">

<input type="text" name="name" placeholder="Full Name">

<input type="email" name="email" placeholder="Email">

<input type="password" name="password" placeholder="Password">

<input type="text" name="phone" placeholder="Phone">

<input type="text" name="address" placeholder="Address">

<button class="btn" name="register">Register</button>

</form>

<div class="login-link">
Already have account? <a href="login.php">Login</a>
</div>

</div>

</body>
</html>
