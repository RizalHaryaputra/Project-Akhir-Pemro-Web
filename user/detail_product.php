<?php
session_start();

// mengecek apakah session sudah dibuat
if (!isset($_SESSION["login"])) {
    // kalau tidak ada session
    header("Location: login.php");
    exit;
}

// menghubungkan dengan file lain
require 'functions.php';

$id = $_GET["id"];

$rows = query("SELECT * FROM products WHERE id = $id");

// Mengecek apakah tombol submit sudah dipencet belum
// if (isset($_POST["submit"])) {
//     if (update($_POST) > 0) {
//         echo "<script>
//                 alert('Data berhasil diedit');
//                 document.location.href = 'index.php';
//             </script>";
//     } else {
//         echo "<script>
//                 alert('Data gagal diedit');
//                 document.location.href = 'index.php';
//             </script>";
//     }
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4"><?= $rows[0]["name"] ?></h1>
        <div class="row">
            <div class="col-md-6">
                <img src="../assets/images/<?= $rows[0]["img"] ?>" class="img-fluid" alt="<?= $rows[0]["name"] ?>">
            </div>
            <div class="col-md-6">
                <h2>Price: <?= $rows[0]["price"] ?></h2>
                <p><?= $rows[0]["description"] ?></p>
                <p>Category: <?= $rows[0]["category"] ?></p>
            </div>
        </div>
        <a href="index.php" class="btn btn-secondary mt-4">Back to Products</a>
    </div>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">Website Pengelolaan Data Produk &copy; 2024 Created by Rizal Haryaputra</span>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>