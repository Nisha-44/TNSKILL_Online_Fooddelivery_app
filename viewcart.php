<?php
session_start();
include("config/db.php");

echo "<h1>Your Cart</h1>";

if(empty($_SESSION['cart'])){
echo "Cart Empty";
exit;
}

$total=0;

foreach($_SESSION['cart'] as $id=>$qty){

$sql="SELECT * FROM foods WHERE id='$id'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);

$subtotal=$row['price']*$qty;

echo "<h3>".$row['name']."</h3>";
echo "Qty: ".$qty."<br>";
echo "Price: ₹".$row['price']."<br>";
echo "Subtotal: ₹".$subtotal."<hr>";

$total += $subtotal;

}

echo "<h2>Total: ₹".$total."</h2>";
?>
