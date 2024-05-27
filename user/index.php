<?php
require 'functions.php';

$result = query("SELECT * FROM products");

if (isset($_POST["search"])) {
    if (count(search($_POST["keyword"])) > 0) {
        $result = search($_POST["keyword"]);
    } else {
        echo "<script>alert('Data tidak ditemukan');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama</title>
</head>
<body>
    
</body>
</html>