<?php
session_start();

$hostname = "localhost";
$username = "root";
$password = "";
$dbname   = "blossom";

$conn = mysqli_connect($hostname, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

if(isset($_POST['add_product'])){
   $name = mysqli_real_escape_string($conn, $_POST['p_name']);
   $price = $_POST['p_price'];
   $image = $_FILES['p_image']['name'];
   $details = mysqli_real_escape_string($conn, $_POST['p_details']);
   $directory = "uploaded_img/";
   $target = $directory . $image;

   if (!is_dir($directory)) {
       mkdir($directory, 0777, true);
   }

   $insert = "INSERT INTO products(name, price, image, details) VALUES('$name', '$price', '$image', '$details')";
   if(mysqli_query($conn, $insert)){
      if(move_uploaded_file($_FILES['p_image']['tmp_name'], $target)){
          $message = "Product added successfully!";
      } else {
          $message = "Error: Could not move the file. Check folder permissions.";
      }
   }
}

if(isset($_POST['update_product'])){
    $update_id = $_POST['update_id'];
    $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
    $update_price = $_POST['update_price'];
    $update_details = mysqli_real_escape_string($conn, $_POST['update_details']);
    
    mysqli_query($conn, "UPDATE products SET name='$update_name', price='$update_price', details='$update_details' WHERE id='$update_id'");

    if(!empty($_FILES['update_image']['name'])){
        $new_image = $_FILES['update_image']['name'];
        $new_target = "uploaded_img/".$new_image;
        mysqli_query($conn, "UPDATE products SET image='$new_image' WHERE id='$update_id'");
        move_uploaded_file($_FILES['update_image']['tmp_name'], $new_target);
    }
    $message = "Product updated!";
}

if(isset($_POST['bulk_delete']) && isset($_POST['delete_id'])){
    foreach($_POST['delete_id'] as $id){
        $id = mysqli_real_escape_string($conn, $id);
        mysqli_query($conn, "DELETE FROM products WHERE id = '$id'");
    }
    $message = "Selected products deleted!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
</head>
<body>

<h1>Admin Dashboard ⚙️</h1>

<nav>
    <a href="index.html">Home</a>
    <a href="products.php">Products</a>
</nav>

<div id="admin-dashboard">
    
    <div id="menu-container">
        <h2>Manage Products</h2>
        <button onclick="showForm()">Add Product</button>
        <button onclick="showEdit()">Edit Product</button>
        <button onclick="showDelete()">Delete Product</button>
    </div>

    <div id="form-container" style="display: none;">
        <h2>Add New Product</h2>
        <form action="admin.php" method="post" enctype="multipart/form-data">
            <input type="text" name="p_name" placeholder="Enter product name" required><br>
            <input type="number" name="p_price" placeholder="Enter product price" required><br>
            <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" required><br>
            <textarea name="p_details" placeholder="Enter product details" required></textarea><br><br>

            <button type="submit" name="add_product">Upload Product</button>
            <button type="button" onclick="hideAll()">Cancel</button>
        </form>
    </div>
    <div id="edit-container" style="display:none;">
        <h2>Edit Existing Products</h2>
        <?php
        $select_edit = mysqli_query($conn, "SELECT * FROM products");
        while($item = mysqli_fetch_assoc($select_edit)){
        ?>
        <form action="admin.php" method="post" enctype="multipart/form-data" style="display:flex; align-items:center; gap:15px; margin-bottom:20px;">
            <input type="hidden" name="update_id" value="<?php echo $item['id']; ?>">
            
            <label>
                <img src="uploaded_img/<?php echo $item['image']; ?>" width="80" style="cursor:pointer; border:1px solid #ccc;">
                <input type="file" name="update_image" style="display:none;">
            </label>

            <input type="text" name="update_name" value="<?php echo $item['name']; ?>" style="width:150px;">
            <input type="number" name="update_price" value="<?php echo $item['price']; ?>" style="width:100px;">
            <textarea name="update_details" placeholder="Enter product details" required><?php echo $item['details']; ?></textarea><br>
            
            <button type="submit" name="update_product">Save</button>
        </form>
        <?php } ?>
        <button onclick="hideAll()">Back to Menu</button>
    </div>
    <div id="delete-container" style="display:none;">
        <h2>Delete Products</h2>
        <form action="admin.php" method="post">
            <div style="margin-bottom:10px;">
                <input type="checkbox" id="select-all" onclick="toggleSelectAll(this)"> 
                <label for="select-all"><b>Select All Items</b></label>
            </div>

            <?php
            $select_del = mysqli_query($conn, "SELECT * FROM products");
            while($item = mysqli_fetch_assoc($select_del)){
            ?>
            <div style="display:flex; align-items:center; gap:10px; margin-bottom:10px;">
                <input type="checkbox" name="delete_id[]" value="<?php echo $item['id']; ?>" class="item-checkbox">
                <img src="uploaded_img/<?php echo $item['image']; ?>" width="40">
                <p><?php echo $item['details']; ?></p>
                <span><?php echo $item['name']; ?> (Rs.<?php echo $item['price']; ?>)</span>
            </div>
            <?php } ?>

            <button type="submit" name="bulk_delete" style="background-color:red; color:white;">Remove Selected</button>
            <button type="button" onclick="hideAll()">Cancel</button>
        </form>
    </div>
</div>

<script>
    function showForm() {
        hideAll();
        document.getElementById('menu-container').style.display = 'none';
        document.getElementById('form-container').style.display = 'block';
    }

    function showEdit() {
        hideAll();
        document.getElementById('menu-container').style.display = 'none';
        document.getElementById('edit-container').style.display = 'block';
    }

    function showDelete() {
        hideAll();
        document.getElementById('menu-container').style.display = 'none';
        document.getElementById('delete-container').style.display = 'block';
    }

    function hideAll() {
        document.getElementById('menu-container').style.display = 'block';
        document.getElementById('form-container').style.display = 'none';
        document.getElementById('edit-container').style.display = 'none';
        document.getElementById('delete-container').style.display = 'none';
    }
    function toggleSelectAll(source) {
        const checkboxes = document.querySelectorAll('.item-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = source.checked;
        });
    }
</script>

</body>
</html>