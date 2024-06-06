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

require '../includes/functions.php';

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
    <title>Data Produk Seriyo Store</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icon -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">

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

        .text-justify {
            text-align: justify;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center mb-4">Data Produk</h1>

        <div class="row mb-3">
            <div class="col-12 col-md-4 mb-2 mb-md-0">
                <a class="btn btn-primary w-100" href="add_product.php">Tambah Produk</a>
            </div>
            <div class="col-12 col-md-4 mb-2 mb-md-0">
                <form action="" method="post" class="d-flex">
                    <input type="text" name="keyword" class="form-control mr-2" autocomplete="off"
                        placeholder="Masukkan kata kunci..." required id="keyword-search">
                    <button type="submit" name="search" class="btn btn-secondary"><i class="bi bi-search"></i></button>
                </form>
            </div>
            <div class="col-12 col-md-4">
                <form action="" method="post" class="d-flex justify-content-md-end">
                    <button class="btn btn-danger ml-md-2 w-100 w-md-auto" name="logout"
                        onclick="return confirm('Apakah anda ingin keluar')">Keluar</button>
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center" id="container-produk">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Gambar</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>Kategori</th>
                        <th>Edit</th>
                        <th>Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($result as $row): ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $row["name"]; ?></td>
                            <td><img src="../assets/images/<?= $row["img"]; ?>" width="100px" height="100px"></td>
                            <td><?= $row["price"]; ?></td>
                            <td class="text-justify"><?= $row["description"]; ?></td>
                            <td><?= $row["category"]; ?></td>
                            <td>
                                <a href="edit_product.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm"><i
                                        class="bi bi-pencil-square"></i></a>
                            </td>
                            <td>
                                <a href="delete_product.php?id=<?= $row['id'] ?>"
                                    onclick="return confirm('Apakah anda ingin mengahapus data <?= $row['name']; ?>')"
                                    class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>


    <!-- My script -->
    <script src="../assets/js/script.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>