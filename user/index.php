<?php
session_start();

// mengecek apakah session sudah dibuat
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST["logout"])) {
    $_SESSION = [];
    session_unset();
    session_destroy();

    setcookie("id", "", time() - 3600);
    setcookie("key", "", time() - 3600);

    header("Location: login.php");
    exit;
}

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

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        .container {
            padding: 2rem;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            margin: 3rem auto;
        }

        .product-table img {
            object-fit: cover;
        }
    </style>
</head>

<body>
<div class="container">
        <h1 class="text-center mb-4">Katalog Produk</h1>

        <div class="d-flex justify-content-between mb-3">
            <!-- <a class="btn btn-primary" href="add_product.php">Tambah Produk</a> -->
            <form action="" method="post" class="form-inline">
                <input type="text" name="keyword" class="form-control mr-2" autocomplete="off"
                    placeholder="Masukkan kata kunci..." required id="keyword-search">
                <button type="submit" name="search" class="btn btn-outline-secondary">Search</button>
            </form>
            <form action="" method="post" class="form-inline">
                <button class="btn btn-danger ml-2" name="logout"
                    onclick="return confirm('Apakah anda ingin keluar')">Keluar</button>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="container-table">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Gambar</th>
                        <th>Deskripsi</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Detail</th>
                        <!-- <th>Hapus</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($result as $row): ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $row["name"]; ?></td>
                            <td><img src="../assets/images/<?= $row["img"]; ?>" width="100px" height="100px"></td>
                            <td><?= $row["description"]; ?></td>
                            <td><?= $row["category"]; ?></td>
                            <td><?= $row["price"]; ?></td>
                            <td>
                                <a href="detail_product.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Detail</a>
                            </td>
                            <!-- <td>
                                <a href="delete_product.php?id=<?= $row['id'] ?>"
                                    onclick="return confirm('Apakah anda ingin mengahapus data <?= $row['name']; ?>')"
                                    class="btn btn-danger btn-sm">Hapus</a>
                            </td> -->
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>


    <!-- My script -->
    <script src="script.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>