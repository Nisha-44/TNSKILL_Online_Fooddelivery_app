<?php
session_start();

$id = $_POST['id'];
$action = $_POST['action'];

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

switch($action){

case "add":
    if(isset($_SESSION['cart'][$id])){
        $_SESSION['cart'][$id]++;
    } else {
        $_SESSION['cart'][$id] = 1;
    }
break;

case "increase":
    $_SESSION['cart'][$id]++;
break;

case "decrease":
    $_SESSION['cart'][$id]--;
    if($_SESSION['cart'][$id] <= 0){
        unset($_SESSION['cart'][$id]);
    }
break;

case "remove":
    unset($_SESSION['cart'][$id]);
break;

}
?>