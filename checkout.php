<?php
session_start();
include("config/db.php");

if(!isset($_SESSION['user'])){
header("Location: login.php");
exit;
}

$user_id = $_SESSION['user']['id'];

if(empty($_SESSION['cart'])){
echo "Cart Empty";
exit;
}

$total = 0;

foreach($_SESSION['cart'] as $id=>$qty){
$res = mysqli_query($conn,"SELECT * FROM foods WHERE id='$id'");
$row = mysqli_fetch_assoc($res);
$total += $row['price'] * $qty;
}

mysqli_query($conn,"INSERT INTO orders(user_id,total_amount) VALUES('$user_id','$total')");
$order_id = mysqli_insert_id($conn);

foreach($_SESSION['cart'] as $id=>$qty){
$res = mysqli_query($conn,"SELECT * FROM foods WHERE id='$id'");
$row = mysqli_fetch_assoc($res);

mysqli_query($conn,"INSERT INTO order_items(order_id,food_id,quantity,price)
VALUES('$order_id','$id','$qty','".$row['price']."')");
}

unset($_SESSION['cart']);

header("Location: order_success.php");
exit;
?>