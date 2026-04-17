<?php
if (!isset($pageTitle)) {
    $pageTitle = 'Blossom Beauty';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav>
    <a href="index.php">Home</a>
    <a href="about.php">About</a>
    <a href="products.php">Products</a>
    <a href="gallery.php">Gallery</a>
    <a href="contact.php">Contact</a>
    <a href="login.php">Login</a>
</nav>
