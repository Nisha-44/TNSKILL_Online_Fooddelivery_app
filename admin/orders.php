<?php
session_start();
include 'db.php';

if(!isset($_SESSION['admin'])){
  header("Location: login.php");
  exit();
}

/* update status*/
if(isset($_POST['update'])){
  $id = $_POST['id'];
  $status = $_POST['status'];

  mysqli_query($conn,"UPDATE orders SET order_status='$status' WHERE id=$id");

  header("Location: orders.php");
  exit();
}

/* fetch data */
$query="SELECT orders.*, users.name 
FROM orders 
JOIN users ON orders.user_id = users.id";

$res=mysqli_query($conn,$query);
?>

<link rel="stylesheet" href="style.css">
<?php include 'sidebar.php'; ?>

<div class="main">

<div class="top-bar">
  <h1>📦 Orders</h1>
</div>

<table>

<tr>
<th>ID</th>
<th>User</th>
<th>Total</th>
<th>Status</th>
<th>Date</th>
<th>View</th>
<th>Action</th>
</tr>

<?php while($row=mysqli_fetch_assoc($res)){ ?>
<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['name']; ?></td>

<td>₹ <?php echo $row['total_amount']; ?></td>

<!-- for status colour updation-->
<td>
  <span class="status <?php echo strtolower($row['order_status']); ?>">
    <?php echo $row['order_status']; ?>
  </span>
</td>

<td><?php echo $row['order_date']; ?></td>

<td>
<a href="order_details.php?id=<?php echo $row['id']; ?>" class="btn update">View</a>
</td>

<td>
<form method="post" action="orders.php" style="display:flex; gap:5px;">

<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<select name="status">
<option <?php if($row['order_status']=="Pending") echo "selected"; ?>>Pending</option>
<option <?php if($row['order_status']=="Preparing") echo "selected"; ?>>Preparing</option>
<option <?php if($row['order_status']=="Delivered") echo "selected"; ?>>Delivered</option>
<option <?php if($row['order_status']=="Cancelled") echo "selected"; ?>>Cancelled</option>
</select>

<button name="update" class="btn add">Update</button>

</form>
</td>

</tr>
<?php } ?>

</table>

</div>