<?php
session_start();
include("config/db.php");

$error="";

if(isset($_POST['login'])){

$email = mysqli_real_escape_string($conn,$_POST['email']);
$password = mysqli_real_escape_string($conn,$_POST['password']);

$res = mysqli_query($conn,"SELECT * FROM users WHERE email='$email' AND password='$password'");

if(mysqli_num_rows($res) > 0){

$user = mysqli_fetch_assoc($res);

/* save user session */
$_SESSION['user'] = $user;

/* reset cart on login */
if(!isset($_SESSION['cart'])){
$_SESSION['cart'] = [];
}

header("Location:index.php");
exit;

}else{
$error=" Invalid Email or Password";
}
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="css/login.css">
</head>

<body>

<div class="login-container">

<div class="form-box">

<h2>🔐 Welcome Back</h2>
<p class="subtitle">Login to continue 🍔</p>

<form method="post" onsubmit="return validateLogin()">

<input type="email" id="email" name="email" placeholder="Enter Email">

<div class="error" id="emailError"></div>

<div class="password-box">
<input type="password" id="password" name="password" placeholder="Enter Password">
<span onclick="togglePassword()">👁️</span>
</div>

<div class="error" id="passError"></div>

<button class="btn" name="login">Login</button>

</form>

<div class="error server-error"><?php echo $error; ?></div>

<div class="register-link">
Don't have account? <a href="register.php">Register</a>
</div>

</div>

</div>

<script>

function togglePassword(){
let pass=document.getElementById("password");
pass.type = pass.type === "password" ? "text" : "password";
}

function validateLogin(){

let email=document.getElementById("email").value.trim();
let password=document.getElementById("password").value.trim();

let valid=true;

document.getElementById("emailError").innerHTML="";
document.getElementById("passError").innerHTML="";

if(!email.includes("@")){
document.getElementById("emailError").innerHTML="Enter valid email";
valid=false;
}

if(password.length < 6){
document.getElementById("passError").innerHTML="Password must be 6+ characters";
valid=false;
}

return valid;
}

</script>

</body>
</html>