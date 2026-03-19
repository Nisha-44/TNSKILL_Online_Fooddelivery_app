<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

$count = 0;

if(isset($_SESSION['cart'])){
    $count = array_sum($_SESSION['cart']);
}
?>

<div class="navbar">

<h2>🍔 FoodExpress</h2>

<div class="nav-links">

<a href="index.php">Home</a>

<a href="restaurants.php">Restaurants</a>

<a href="cart_view.php">
🛒 Cart <span id="cart-count"></span>
</a>

<?php if(isset($_SESSION['user'])){ ?>

<a href="my_orders.php">My Orders</a>
<a href="logout.php">Logout</a>

<?php } else { ?>

<a href="register.php">Register</a>
<a href="login.php">Login</a>
<a href="/foodexpress/admin/login.php">Admin</a>

<?php } ?>

</div>
</div>