<?php
session_start();
include 'db.php';

$error = "";

if(isset($_POST['login'])){
  $email = $_POST['email'];
  $pass = $_POST['password'];

  $res = mysqli_query($conn,"SELECT * FROM admins WHERE email='$email' AND password='$pass'");

  if(mysqli_num_rows($res) > 0){
    $_SESSION['admin'] = $email;
    header("Location: dashboard.php");
    exit();
  } else {
    $error = "Invalid Email or Password!";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>
<link rel="stylesheet" href="style.css">
</head>

<body class="login-page">

<div class="login-box">

<h2>Admin Login</h2>
<p>Welcome back 👋</p>

<form method="post">

<input type="email" name="email" placeholder="Enter Email" required>

<input type="password" name="password" placeholder="Enter Password" required>

<button type="submit" name="login">Login</button>

</form>

<?php if($error){ ?>
<div class="login-error"><?php echo $error; ?></div>
<?php } ?>

</div>

</body>
</html>