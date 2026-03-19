<?php
session_start();
include 'db.php';

if(!isset($_SESSION['admin'])){
  header("Location: login.php");
  exit();
}

/* counts*/
$r = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM restaurants"))[0];
$o = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM orders"))[0];
$u = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM users"))[0];
$f = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM foods"))[0];
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<!-- sidebar -->
<div class="sidebar">
  <h2>🍔 Admin</h2>
  <a href="dashboard.php">Dashboard</a>
  <a href="orders.php">Orders</a>
  <a href="restaurants.php">Restaurants</a>
  <a href="foods.php">Foods</a>
  <a href="logout.php">Logout</a>
  <a href="users.php">Users</a>
</div>

<!--main -->
<div class="main">

  <div class="top-bar">
    <h1>📊 Dashboard</h1>
  </div>

  <div class="cards">

    <div class="card">
      <h2>🍽 Restaurants</h2>
      <p><?php echo $r; ?></p>
    </div>

    <div class="card">
      <h2>🍔 Foods</h2>
      <p><?php echo $f; ?></p>
    </div>

    <div class="card">
      <h2>📦 Orders</h2>
      <p><?php echo $o; ?></p>
    </div>

    <div class="card">
      <h2>👥 Users</h2>
      <p><?php echo $u; ?></p>
    </div>

  </div>

</div>

</body>
</html>
