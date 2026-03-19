
<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
<title>FoodExpress</title>
<link rel="stylesheet" href="/foodexpress/css/style.css">
</head>

<body>

<?php include("navbar.php"); ?>

<div class="hero">
<h1>Delicious Food Delivered Fast 🍕</h1>
<p>Order from your favorite restaurants</p>

<a href="restaurants.php">
<button class="btn">Explore Restaurants</button>
</a>
</div>

<div class="grid">

<!-- home page fast delivery-->
<div class="card">
<img src="images/fastdelivery.jpg">
<div class="card-content">
<h3>Fast Delivery</h3>
<p>Hot & fresh food delivered quickly to your door</p>
</div>
</div>

<!-- fresh food -->
<div class="card">
<img src="images/freshfood.jpg">
<div class="card-content">
<h3>Fresh Food</h3>
<p>Healthy and fresh ingredients from trusted restaurants</p>
</div>
</div>

<!-- offers -->
<div class="card">
<img src="images/offers.jpg">
<div class="card-content">
<h3>Best Offers</h3>
<p>Enjoy exciting discounts and deals every day</p>
</div>
</div>

</div>
</body>
</html>
