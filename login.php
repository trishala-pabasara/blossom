<?php
session_start();
include 'db.php';

if(isset($_POST['login'])){
    $u = $_POST['username'];
    $p = $_POST['password'];

    $result = $conn->query("SELECT * FROM admin WHERE username='$u' AND password='$p'");

    if($result->num_rows > 0){
        $_SESSION['admin'] = $u;
        header("Location: admin.php");
    } else {
        echo "Login Failed";
    }
}
$pageTitle = 'Admin Login';
include 'includes/header.php';
?>

<h1>Admin Login 🔐</h1>

<form method="POST" action="login.php">
    Username:<br>
    <input type="text" name="username"><br><br>

    Password:<br>
    <input type="password" name="password"><br><br>

    <button type="submit" name="login">Login</button>
</form>

<?php include 'includes/footer.php'; ?>

