<?php
$pageTitle = 'Gallery';
include 'includes/header.php';
?>

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

<h1>Gallery 📸</h1>

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

<?php include 'includes/footer.php'; ?>