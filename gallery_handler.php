<?php

$uploadDir = "uploads/";

if (!is_dir($uploadDir)) {
    mkdir($uploadDir);
}

if (!empty($_POST['delete_images'])) {
    foreach ($_POST['delete_images'] as $file) {
        $filePath = $uploadDir . $file;

        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
}

if (!empty($_POST['new_images'])) {
    $images = json_decode($_POST['new_images'], true);

    foreach ($images as $index => $img) {
        $img = preg_replace('#^data:image/\w+;base64,#i', '', $img);
        $data = base64_decode($img);

        $fileName = "img_" . time() . "_" . $index . ".png";
        file_put_contents($uploadDir . $fileName, $data);
    }
}

header("Location: admin.php");
exit();

?>