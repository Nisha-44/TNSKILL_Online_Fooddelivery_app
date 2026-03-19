<?php
include("config/db.php");
?>

<!DOCTYPE html>
<html>
<head>

<title>Food Menu</title>
<link rel="stylesheet" href="css/style.css">

</head>

<body class="menu-page">

<?php include("navbar.php"); ?>

<div class="grid">

<?php

$id = $_GET['id'];

$res = mysqli_query($conn,"SELECT * FROM foods WHERE restaurant_id='$id'");

while($row = mysqli_fetch_assoc($res)){

?>

<div class="card">

<img src="images/<?php echo $row['image']; ?>">

<div class="card-content">

<h3><?php echo $row['name']; ?></h3>

<p><?php echo $row['description']; ?></p>

<p><b>₹<?php echo $row['price']; ?></b></p>

<!-- add button -->

<button class="add-btn" id="add-<?php echo $row['id']; ?>"
onclick="addItem(<?php echo $row['id']; ?>)">
ADD
</button>

<!-- Quantity box -->

<div id="qtybox-<?php echo $row['id']; ?>" class="qty-box" style="display:none;">

<button class="qty-btn" onclick="decrease(<?php echo $row['id']; ?>)">−</button>

<span id="qty-<?php echo $row['id']; ?>" class="qty-number">1</span>

<button class="qty-btn" onclick="increase(<?php echo $row['id']; ?>)">+</button>

</div>

</div>

</div>

<?php } ?>

</div>

<script src="js/cart.js"></script>

</body>
</html>