<?php
session_start();
include("config/db.php");
include("navbar.php");

/* check login */
if(!isset($_SESSION['user'])){
  header("Location: login.php");
  exit;
}

$user_id = $_SESSION['user']['id'];
?>

<link rel="stylesheet" href="css/style.css">

<h1 class="orders-title">📦 My Orders</h1>

<div class="orders-container">

<?php
$res = mysqli_query($conn,"SELECT * FROM orders WHERE user_id='$user_id' ORDER BY id DESC");

if(mysqli_num_rows($res)==0){
  echo "<h3 class='empty-cart'>No Orders Yet 😢</h3>";
  exit;
}

while($order=mysqli_fetch_assoc($res)){
?>

<div class="order-card">

<!--fix the status -->
<span class="order-status <?php echo strtolower($order['order_status']); ?>">
  <?php echo $order['order_status']; ?>
</span>

<div class="order-header">
  <h3>🧾 Order #<?php echo $order['id']; ?></h3>
  <span class="order-total">₹<?php echo $order['total_amount']; ?></span>
</div>

<div class="order-items">

<?php
$order_id = $order['id'];

$items = mysqli_query($conn,"
SELECT foods.name, foods.image, order_items.quantity, order_items.price
FROM order_items
JOIN foods ON foods.id = order_items.food_id
WHERE order_items.order_id='$order_id'
");

while($item=mysqli_fetch_assoc($items)){
?>

<div class="order-item">

<img src="images/<?php echo $item['image']; ?>">

<div class="item-details">
  <p class="food-name"><?php echo $item['name']; ?></p>
  <p class="food-meta">
    Qty: <?php echo $item['quantity']; ?> × ₹<?php echo $item['price']; ?>
  </p>
</div>

</div>

<?php } ?>

</div>

</div>

<?php } ?>

</div>