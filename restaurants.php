<?php
include("config/db.php");
?>
<!DOCTYPE html>
<html>
<head>
<title>Restaurants</title>

<link rel="stylesheet" href="/foodexpress/css/style.css">

</head>

<body class="restaurant-page">

<?php include("navbar.php"); ?>

<div class="grid">

<?php
$res=mysqli_query($conn,"SELECT * FROM restaurants");

while($row=mysqli_fetch_assoc($res)){
?>

<div class="card">

<img src="images/<?php echo $row['image']; ?>">

<div class="card-content">

<h3><?php echo $row['name']; ?></h3>
<p><?php echo $row['description']; ?></p>
<p>⭐ <?php echo $row['rating']; ?></p>

<a href="menu.php?id=<?php echo $row['id']; ?>">
<button class="btn">View Menu</button>
</a>

</div>

</div>

<?php } ?>

</div>

</body>
</html>