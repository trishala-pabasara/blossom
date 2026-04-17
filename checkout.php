<?php
include 'db.php';
$pageTitle = 'Checkout';

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

<h1>Checkout 💳</h1>

<p>Proceed to checkout your products. ✅</p>

<div class="checkout-summary">
    <h2>Checkout for <?php echo $product['name']; ?></h2>
    <img src="uploaded_img/<?php echo $product['image']; ?>" width="100">
    <p>Price: Rs.<?php echo $product['price']; ?></p>
</div>

<?php include 'includes/footer.php'; ?>