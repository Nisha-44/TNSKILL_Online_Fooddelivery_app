<?php
session_start();
include("config/db.php");
include("navbar.php");
?>

<link rel="stylesheet" href="css/style.css">

<h1 class="cart-title">🛒 Your Cart</h1>

<?php
if(empty($_SESSION['cart'])){
echo "<h3 class='empty-cart'>Cart is Empty 😢</h3>";
exit;
}

$total=0;
?>

<div class="cart-container">

<?php
foreach($_SESSION['cart'] as $id=>$qty){

$res=mysqli_query($conn,"SELECT * FROM foods WHERE id='$id'");
$row=mysqli_fetch_assoc($res);

$subtotal=$row['price']*$qty;
$total += $subtotal;
?>

<div class="cart-item">

<img src="images/<?php echo $row['image']; ?>">

<div class="cart-details">

<h3><?php echo $row['name']; ?></h3>

<p>₹<?php echo $row['price']; ?></p>

<div class="qty-box">

<button onclick="decrease(<?php echo $id; ?>)">−</button>

<span id="qty-<?php echo $id; ?>"><?php echo $qty; ?></span>

<button onclick="increase(<?php echo $id; ?>)">+</button>

</div>

<p class="subtotal">Subtotal: ₹<?php echo $subtotal; ?></p>

</div>

</div>

<?php } ?>

</div>

<h2 class="total">Total: ₹<?php echo $total; ?></h2>

<div class="center">
<a href="checkout.php">
<button class="btn">Place Order</button>
</a>
</div>

<script src="js/cart.js"></script>