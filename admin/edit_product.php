<?php
session_start();

// mengecek apakah session sudah dibuat
if (!isset($_SESSION["login"])) {
    // kalau tidak ada session
    header("Location: login.php");
    exit;
}

// menghubungkan dengan file lain
require '../includes/functions.php';

$id = $_GET["id"];

$rows = query("SELECT * FROM products WHERE id = $id");

// Mengecek apakah tombol submit sudah dipencet belum
if (isset($_POST["submit"])) {
    if (update($_POST) > 0) {
        echo "<script>
                alert('Data berhasil diedit');
                document.location.href = 'index.php';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal diedit');
                document.location.href = 'index.php';
            </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">

    <style>
        .box {
            padding: 2rem;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            margin: 3rem auto;
            max-width: 1000px;
        }
    </style>
</head>

<body>
    <div class="box">

        <div class="container mt-5">
            <h1 class="text-center mb-4">Edit Produk</h1>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $rows[0]["id"] ?>">
                <input type="hidden" name="gambarLama" value="<?= $rows[0]["img"] ?>">

                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" name="name" id="name" class="form-control" required
                        value="<?= $rows[0]["name"] ?>">
                </div>

                <div class="form-group">
                    <label for="price">Harga</label>
                    <input type="text" name="price" id="price" class="form-control" required
                        value="<?= $rows[0]["price"] ?>">
                </div>

                <div class="form-group">
                    <label for="description">Detail</label>
                    <textarea name="description" id="description" class="form-control" rows="5"
                        required><?= $rows[0]["description"] ?></textarea>
                </div>

                <div class="form-group">
                    <label for="category">Kategori</label>
                    <input type="text" name="category" id="category" class="form-control" required
                        value="<?= $rows[0]["category"] ?>">
                </div>

                <div class="form-group">
                    <label for="img">Gambar</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <img src="../assets/images/<?= $rows[0]["img"]; ?>" width="50px" height="50px"
                                style="object-fit: cover;">
                                <input type="file" name="img" id="img" class="form-control-file" style="padding-left: 10px;">
                        </div>
                    </div>
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                <a href='index.php' class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>

    <!-- <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">Website Pengelolaan Data Produk &copy; 2024 Created by Rizal Haryaputra</span>
        </div>
    </footer> -->

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>