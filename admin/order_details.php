<?php
session_start();
include 'db.php';

if(!isset($_SESSION['admin'])){
  header("Location: login.php");
  exit();
}

$id=$_GET['id'];

$query = "SELECT f.name, oi.quantity, oi.price 
FROM order_items oi
JOIN foods f ON oi.food_id = f.id
WHERE oi.order_id = $id";
$res=mysqli_query($conn,$query);
?>

<link rel="stylesheet" href="style.css">
<?php include 'sidebar.php'; ?>

<div class="main">
<h2>Order Details</h2>

<table>
<tr>
<th>Food</th>
<th>Qty</th>
<th>Price</th>
</tr>

<?php while($row=mysqli_fetch_assoc($res)){ ?>
<tr>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['quantity']; ?></td>
<td><?php echo $row['price']; ?></td>
</tr>
<?php } ?>
</table>

</div>