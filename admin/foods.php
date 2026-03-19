<?php
session_start();
include 'db.php';

if(!isset($_SESSION['admin'])){
  header("Location: login.php");
  exit();
}

/* add foods using admin */
if(isset($_POST['add'])){
  $restaurant_id = $_POST['restaurant_id'];
  $name = mysqli_real_escape_string($conn,$_POST['name']);
  $desc = mysqli_real_escape_string($conn,$_POST['description']);
  $price = $_POST['price'];

  $image = $_FILES['image']['name'];
  $tmp = $_FILES['image']['tmp_name'];

  if($image){
    $image = time().'_'.$image;
    move_uploaded_file($tmp, "uploads/".$image);
  }

  mysqli_query($conn,"INSERT INTO foods(restaurant_id,name,description,price,image)
  VALUES('$restaurant_id','$name','$desc','$price','$image')");

  header("Location: foods.php");
  exit();
}

/* delete foods */
if(isset($_GET['delete'])){
  $id = (int)$_GET['delete'];
  mysqli_query($conn,"DELETE FROM foods WHERE id=$id");
  header("Location: foods.php");
  exit();
}

/* edit foods */
$editData = null;
if(isset($_GET['edit'])){
  $id = (int)$_GET['edit'];
  $resEdit = mysqli_query($conn,"SELECT * FROM foods WHERE id=$id");
  $editData = mysqli_fetch_assoc($resEdit);
}

/* update the foods */
if(isset($_POST['update'])){
  $id = (int)$_POST['id'];
  $restaurant_id = $_POST['restaurant_id'];
  $name = mysqli_real_escape_string($conn,$_POST['name']);
  $desc = mysqli_real_escape_string($conn,$_POST['description']);
  $price = $_POST['price'];

  if($_FILES['image']['name']){
    $image = time().'_'.$_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    move_uploaded_file($tmp, "uploads/".$image);

    mysqli_query($conn,"UPDATE foods SET 
    restaurant_id='$restaurant_id',
    name='$name',
    description='$desc',
    price='$price',
    image='$image'
    WHERE id=$id");
  } else {
    mysqli_query($conn,"UPDATE foods SET 
    restaurant_id='$restaurant_id',
    name='$name',
    description='$desc',
    price='$price'
    WHERE id=$id");
  }

  header("Location: foods.php");
  exit();
}

/* fetch */
$res = mysqli_query($conn,"SELECT * FROM foods ORDER BY id DESC");

/* fetch restaurants*/
$restaurants = mysqli_query($conn,"SELECT * FROM restaurants");
?>

<link rel="stylesheet" href="style.css">
<?php include 'sidebar.php'; ?>

<div class="main">

<div class="top-bar">
  <h1>🍔 Foods</h1>
</div>

<!-- form-->
<form method="post" enctype="multipart/form-data" class="form-box">

<select name="restaurant_id" required>
<option value="">Select Restaurant</option>
<?php while($r=mysqli_fetch_assoc($restaurants)){ ?>
<option value="<?php echo $r['id']; ?>"
<?php if(($editData['restaurant_id'] ?? '') == $r['id']) echo 'selected'; ?>>
<?php echo $r['name']; ?>
</option>
<?php } ?>
</select>

<input type="text" name="name" placeholder="Food Name"
value="<?php echo $editData['name'] ?? ''; ?>" required>

<input type="text" name="description" placeholder="Description"
value="<?php echo $editData['description'] ?? ''; ?>">

<input type="text" name="price" placeholder="Price"
value="<?php echo $editData['price'] ?? ''; ?>">

<input type="file" name="image">

<?php if($editData){ ?>
  <input type="hidden" name="id" value="<?php echo $editData['id']; ?>">

  <button type="submit" name="update" class="btn update">Update</button>
  <a href="foods.php" class="btn cancel">Cancel</a>

<?php } else { ?>

  <button type="submit" name="add" class="btn add">Add Food</button>

<?php } ?>

</form>

<!-- table -->
<table>

<tr>
<th>ID</th>
<th>Restaurant</th>
<th>Name</th>
<th>Image</th>
<th>Price</th>
<th>Action</th>
</tr>

<?php while($row=mysqli_fetch_assoc($res)){ ?>
<tr>

<td><?php echo $row['id']; ?></td>

<td>
<?php
$rname = mysqli_fetch_assoc(mysqli_query($conn,"SELECT name FROM restaurants WHERE id=".$row['restaurant_id']));
echo $rname['name'] ?? '';
?>
</td>

<td><?php echo $row['name']; ?></td>

<td>
<?php if($row['image']){ ?>
<img src="uploads/<?php echo $row['image']; ?>">
<?php } ?>
</td>

<td>₹ <?php echo $row['price']; ?></td>

<td>
<a href="foods.php?edit=<?php echo $row['id']; ?>" class="btn update">Edit</a>

<a href="foods.php?delete=<?php echo $row['id']; ?>" 
class="btn cancel"
onclick="return confirm('Delete this food?')">Delete</a>
</td>

</tr>
<?php } ?>

</table>

</div>