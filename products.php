<?php
include 'db.php';
$pageTitle = 'Products';
include 'includes/header.php';
?>

<h1>Our Products 🌷</h1>

<div class="product-container" style="display: flex; flex-wrap: wrap; gap: 30px; padding: 20px; justify-content: center;">
    
    <?php
    $select_products = mysqli_query($conn, "SELECT * FROM products");

    if(mysqli_num_rows($select_products) > 0){
        while($row = mysqli_fetch_assoc($select_products)){
    ?>
            <div class="product-card" style="border: 1px solid #ccc; padding: 15px; border-radius: 8px; text-align: center; width: 200px;">
                <img src="uploaded_img/<?php echo $row['image']; ?>" alt="Product Image" style="width: 100%; height: 150px; object-fit: cover; border-radius: 5px;">
                <h3><?php echo $row['name']; ?></h3>
                <p>Price: Rs.<?php echo $row['price']; ?></p>
                
                <a href="checkout.php?id=<?php echo $row['id']; ?>" class="btn-buy" style="display: inline-block; padding: 10px; background: pink; color: black; text-decoration: none; border-radius: 5px;">Buy Now</a>
                <a href="product_details.php?id=<?php echo $row['id']; ?>" class="btn-details" style="display: inline-block; padding: 10px; background: lightblue; color: black; text-decoration: none; border-radius: 5px; margin-top: 10px;"> Details</a>
            </div>
    <?php 
        }
    } else {
        echo "<p>No products found. Add some from the Admin Dashboard!</p>";
    }
    ?>

</div>

<?php include 'includes/footer.php'; ?>
