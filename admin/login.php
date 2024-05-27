<?php
// untuk menjalankan session
session_start();

// menghubungkan dengan file lain
require 'functions.php';

// mengecek apakah masih ada cookie
if (isset($_COOKIE["id"]) && isset($_COOKIE["key"])) {
    // mengecek apakah cookie sesuai
    $id = $_COOKIE["id"];
    $key = $_COOKIE["key"];

    $result = mysqli_query($conn, "SELECT * FROM admin WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    if ($key === hash("sha256", $row["email"])) {
        $_SESSION["login"] = true;
        error_log("Redirecting to /Projek%20Akhir%20Online%20Shop/admin/index.php");
        header("Location: /Projek%20Akhir%20Online%20Shop/admin/index.php");
        exit;
    }
}

// mengecek apakah session sudah dibuat
if (isset($_SESSION["login"])) {
    // kalau ada session
    header("Location: index.php");
    exit;
}

// Mengecek apakah tombol submit sudah dipencet belum
if (isset($_POST["masuk"])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    // cek email
    $result = mysqli_query($conn, "SELECT * FROM admin WHERE email = '$email'");
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row["password"])) {
            // cek apakah mencentang remember me
            if (isset($_POST["remember"])) {
                // membuat cookie
                setcookie("id", $row["id"], time() + (60 * 5));
                setcookie("key", hash("sha256", $row["email"]), time() + (60 * 5));
            }

            $_SESSION["login"] = true;
            header("Location: index.php");
            exit;
        }
    }

    echo "<script>
            alert('Email dan password tidak sesuai');
            document.location.href = 'login.php';
        </script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">

</head>

<body>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card" style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); border-radius: 5px;">
                    <div class="card-header text-center">
                        <h1>Masuk</h1>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
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
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember"
                                    autocomplete="off">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>
                            <button type="submit" name="masuk" class="btn btn-primary btn-block">Masuk</button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <p class="move mb-1">Belum punya akun?</p>
                        <a href="register.php" class="btn btn-link">Daftar</a>
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