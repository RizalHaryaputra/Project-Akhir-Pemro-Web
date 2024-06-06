<?php
// untuk menjalankan session
session_start();

// mengecek apakah session sudah dibuat
if (isset($_SESSION["login"])) {
    // kalau ada session
    header("Location: index.php");
    exit;
}
// menghubungkan dengan file lain
require '../includes/functions.php';

// Mengecek apakah tombol submit sudah dipencet belum
if (isset($_POST["registrasi"])) {
    if (register($_POST) > 0) {
        echo "<script>
                alert('User berhasil ditambahkan');
                document.location.href = '/admin/login.php';
            </script>";
    } else {
        echo "<script>
                alert('User gagal ditambahkan');
                document.location.href = 'register.php';
            </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">

</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card" style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); border-radius: 5px;">
                    <div class="card-header text-center">
                        <h1>Daftar</h1>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" required
                                    autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required
                                    autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required
                                    autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="konfirmasiPassword">Konfirmasi Password</label>
                                <input type="password" name="konfirmasiPassword" id="konfirmasiPassword"
                                    class="form-control" required autocomplete="off">
                            </div>
                            <button type="submit" name="registrasi" class="btn btn-primary btn-block">Daftar</button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <p class="move mb-1">Sudah punya akun?</p>
                        <a href="login.php" class="btn btn-link">Masuk</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <footer class="footer mt-auto py-3 bg-light">
        <div class="container text-center">
            <span class="text-muted">Website Pengelolaan Data Mahasiswa &copy; 2024 Created by Rizal Haryaputra</span>
        </div>
    </footer> -->

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>