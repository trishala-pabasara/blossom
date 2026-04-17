<!DOCTYPE html>
<html>
<head>
    <title>Gallery</title>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">

    <style>
        .gallery-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .gallery-container img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #ccc;
            transition: 0.3s;
        }

        .gallery-container img:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<h1>Gallery 📸</h1>

<nav>
    <a href="index.html">Home</a>
    <a href="about.html">About</a>
    <a href="products.php">Products</a>
    <a href="gallery.php">Gallery</a>
    <a href="contact.php">Contact</a>
    <a href="login.php">Login</a>
</nav>

<p>Our beautiful flower arrangements ✨</p>

<div class="gallery-container">

<?php
$dir = "uploads/";

if (is_dir($dir)) {

    $files = array_diff(scandir($dir), array('.', '..'));

    if (empty($files)) {
        echo "<p>No images yet.</p>";
    } else {
        foreach ($files as $file) {
            echo '<img src="uploads/'.$file.'">';
        }
    }

} else {
    echo "<p>Uploads folder not found.</p>";
}
?>
</div>

</body>
</html>