<?php
include 'db.php';
$pageTitle = 'Product Details';

if(isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $query = "SELECT * FROM products WHERE id = '$product_id' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    }
}
include 'includes/header.php';
?>

<h1>Product Details 📝</h1>

<div class="checkout-summary">
    <h2><?php echo $product['name']; ?></h2>
    <img src="uploaded_img/<?php echo $product['image']; ?>" width="250">
    <p><?php echo $product['details']; ?></p>
</div>

<?php include 'includes/footer.php'; ?>