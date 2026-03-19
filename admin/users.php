<?php
session_start();
include 'db.php';

if(!isset($_SESSION['admin'])){
  header("Location: login.php");
  exit();
}

$res = mysqli_query($conn,"SELECT * FROM users ORDER BY id DESC");
?>

<link rel="stylesheet" href="style.css">
<?php include 'sidebar.php'; ?>

<div class="main">

<div class="top-bar">
  <h1>👥 Users</h1>
</div>

<table>
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
</tr>

<?php while($row=mysqli_fetch_assoc($res)){ ?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['phone']; ?></td>
</tr>
<?php } ?>

</table>

</div>