<?php
$conn = mysqli_connect("localhost", "root", "", "blossom");

if(isset($_POST['send'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $msg = mysqli_real_escape_string($conn, $_POST['message']);

    $insert = "INSERT INTO messages(name, email, message) VALUES('$name', '$email', '$msg')";
    if(mysqli_query($conn, $insert)){
        echo "<script>alert('Message Sent!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="text-align: center;">

<h1>Contact Us ✉️</h1>

<nav>
    <a href="index.html">Home</a>
    <a href="about.html">About</a>
    <a href="products.php">Products</a>
    <a href="gallery.html">Gallery</a>
    <a href="contact.php">Contact</a>
    <a href="login.php">Login</a>
</nav>

<br><br>

<form action="contact.php" method="POST">
    Name:<br>
    <input type="text" name="name" required><br><br>

    Email:<br>
    <input type="email" name="email" required><br><br>

    Message:<br>
    <textarea name="message" required></textarea><br><br>

    <button type="submit" name="send">Send</button>
</form>

</body>
</html>
