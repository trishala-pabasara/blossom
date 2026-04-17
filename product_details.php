<?php
$conn = mysqli_connect("localhost", "root", "", "blossom");

if(isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $query = "SELECT * FROM products WHERE id = '$product_id' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Product Details</title>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
</head>
<body>

<h1>Product Details 📝</h1>

<nav>
    <a href="index.html">Home</a>
    <a href="about.html">About</a>
    <a href="products.php">Products</a>
    <a href="gallery.php">Gallery</a>
    <a href="contact.php">Contact</a>
    <a href="login.php">Login</a>
</nav>

<div class="checkout-summary">
    <h2><?php echo $product['name']; ?></h2>
    <img src="uploaded_img/<?php echo $product['image']; ?>" width="250">
    <p><?php echo $product['details']; ?></p>
</div>

</body>
</html>