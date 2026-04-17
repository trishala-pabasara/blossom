<?php
include 'db.php';
$pageTitle = 'Contact Us';

if(isset($_POST['send'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $msg = mysqli_real_escape_string($conn, $_POST['message']);

    $insert = "INSERT INTO messages(name, email, message) VALUES('$name', '$email', '$msg')";
    if(mysqli_query($conn, $insert)){
        echo "<script>alert('Message Sent!');</script>";
    }
}
include 'includes/header.php';
?>

<div style="text-align: center;">

<h1>Contact Us ✉️</h1>

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
</div>

<?php include 'includes/footer.php'; ?>
