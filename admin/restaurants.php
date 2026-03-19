<?php
session_start();
include 'db.php';

if(!isset($_SESSION['admin'])){
  header("Location: login.php");
  exit();
}

/* add restaurants */
if(isset($_POST['add'])){
  $name = mysqli_real_escape_string($conn,$_POST['name']);
  $desc = mysqli_real_escape_string($conn,$_POST['description']);
  $time = $_POST['time'];
  $rating = $_POST['rating'];

  $image = $_FILES['image']['name'];
  $tmp = $_FILES['image']['tmp_name'];

  if($image){
    $image = time().'_'.$image;
    move_uploaded_file($tmp, "uploads/".$image);
  }

  mysqli_query($conn,"INSERT INTO restaurants(name,description,image,time,rating)
  VALUES('$name','$desc','$image','$time','$rating')");

  header("Location: restaurants.php");
  exit();
}

/* delete restaurants*/
if(isset($_GET['delete'])){
  $id = (int)$_GET['delete'];
  mysqli_query($conn,"DELETE FROM restaurants WHERE id=$id");
  header("Location: restaurants.php");
  exit();
}

/* edit to fetch the data*/
$editData = null;
if(isset($_GET['edit'])){
  $id = (int)$_GET['edit'];
  $resEdit = mysqli_query($conn,"SELECT * FROM restaurants WHERE id=$id");
  $editData = mysqli_fetch_assoc($resEdit);
}

/* update */
if(isset($_POST['update'])){
  $id = (int)$_POST['id'];
  $name = mysqli_real_escape_string($conn,$_POST['name']);
  $desc = mysqli_real_escape_string($conn,$_POST['description']);
  $time = $_POST['time'];
  $rating = $_POST['rating'];

  if($_FILES['image']['name']){
    $image = time().'_'.$_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    move_uploaded_file($tmp, "uploads/".$image);

    mysqli_query($conn,"UPDATE restaurants 
    SET name='$name', description='$desc', image='$image', time='$time', rating='$rating'
    WHERE id=$id");
  } else {
    mysqli_query($conn,"UPDATE restaurants 
    SET name='$name', description='$desc', time='$time', rating='$rating'
    WHERE id=$id");
  }

  header("Location: restaurants.php");
  exit();
}

/* fetch the data*/
$res = mysqli_query($conn,"SELECT * FROM restaurants ORDER BY id DESC");
?>

<link rel="stylesheet" href="style.css">
<?php include 'sidebar.php'; ?>

<div class="main">

<div class="top-bar">
  <h1>🍽 Restaurants</h1>
</div>

<!-- form -->
<form method="post" enctype="multipart/form-data" class="form-box">

<input type="text" name="name" placeholder="Name"
value="<?php echo $editData['name'] ?? ''; ?>" required>

<input type="text" name="description" placeholder="Description"
value="<?php echo $editData['description'] ?? ''; ?>">

<input type="text" name="time" placeholder="Delivery Time"
value="<?php echo $editData['time'] ?? ''; ?>">

<input type="text" name="rating" placeholder="Rating"
value="<?php echo $editData['rating'] ?? ''; ?>">

<input type="file" name="image">

<?php if($editData){ ?>
  <input type="hidden" name="id" value="<?php echo $editData['id']; ?>">

  <button type="submit" name="update" class="btn update">Update</button>
  <a href="restaurants.php" class="btn cancel">Cancel</a>

<?php } else { ?>

  <button type="submit" name="add" class="btn add">Add Restaurant</button>

<?php } ?>

</form>

<!-- table -->
<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Image</th>
<th>Time</th>
<th>Rating</th>
<th>Action</th>
</tr>

<?php while($row=mysqli_fetch_assoc($res)){ ?>
<tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>

<td>
<?php if($row['image']){ ?>
<img src="uploads/<?php echo $row['image']; ?>">
<?php } ?>
</td>

<td><?php echo $row['time']; ?></td>
<td><?php echo $row['rating']; ?></td>

<td>
<a href="restaurants.php?edit=<?php echo $row['id']; ?>" class="btn update">Edit</a>

<a href="restaurants.php?delete=<?php echo $row['id']; ?>" 
class="btn cancel"
onclick="return confirm('Delete this restaurant?')">Delete</a>
</td>

</tr>
<?php } ?>

</table>

</div>