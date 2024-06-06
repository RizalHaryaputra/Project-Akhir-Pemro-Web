<?php
require '../includes/functions.php';

$result = query("SELECT * FROM products");

if (isset($_POST["search"])) {
    if (count(search($_POST["keyword"])) > 0) {
        $result = search($_POST["keyword"]);
    } else {
        echo "<script>alert('Data tidak ditemukan');</script>";
    }
}

if (isset($_POST["filter"])) {
    $category = $_POST["category"];
    $priceRange = $_POST["price_range"];

    $query = "SELECT * FROM products WHERE 1";

    if ($category != "") {
        $query .= " AND category = '$category'";
    }

    if ($priceRange != "") {
        list($minPrice, $maxPrice) = explode("-", $priceRange);
        $query .= " AND price BETWEEN $minPrice AND $maxPrice";
    }

    $result = query($query);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk Seriyo Store</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icon -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">



    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Montserrat', sans-serif;
        }

        a {
            text-decoration: none;
            color: white;
        }

        .navbar {
            padding-top: 1rem;
            padding-bottom: 1rem;
            background-color: rgba(0, 0, 0, 0.485);
        }

        .navbar-brand,
        .nav-link {
            font-family: 'Nunito', sans-serif;
            color: white;
        }

        .navbar-brand:visited,
        .nav-link:visited {
            font-family: 'Nunito', sans-serif;
            color: white;
        }

        .product-card img {
            object-fit: cover;
            height: 200px;
        }

        .product-card {
            margin-bottom: 2rem;
        }

        .product-card .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .jumbotron {
            background-image: url('../assets/images/background.jpg');
            height: 800px;
            background-size: cover;
            background-position: center;
            margin-top: -100px;
        }

        .content {
            font-family: 'Nunito', sans-serif;
            color: white;
            margin-top: 7rem;
            margin-left: 5rem;
            margin-right: 5rem;
            margin-bottom: 7rem;
        }

        .text-content {
            margin: 7rem 3rem;
        }

        .h1-jumbotron {
            font-size: 100px;
        }

        .p-jumbotron {
            margin: 1rem auto;
            font-size: 28px;
            max-width: 700px;
            font-weight: 100 !important;
        }

        .contact-section {
            background-color: #EEEEEE;
            padding: 4rem 0;
            height: 100vh;
        }

        .contact-section h2 {
            margin-bottom: 2rem;
        }

        .box-contact {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            padding: 1rem;
        }
    </style>
</head>

<body>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-md">
        <div class="container-fluid">
            <a class="navbar-brand ms-5" href="#" style="font-style: italic; color: #0088FF; font-weight: 1000;">S</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#hero">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#products">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Kontak</a>
                    </li>
                </ul>
                <!-- </div>
            <button type="button" class="btn btn-primary me-5" onclick="return confirm('Apakah anda ingin keluar')"><a
                    href="logout.php">Keluar</a></button>
        </div> -->
    </nav>
    <!-- Navbar End -->

    <!-- Jumbotron Start -->
    <div class="jumbotron container-fluid d-flex" id="hero">
        <div class="content mx-auto text-center">
            <div class="text-content">
                <h1 class="h1-jumbotron"><span
                        style="color: #0088FF; font-weight: 800; font-style: italic;">Seriyo</span> Store</h1>
                <p class="p-jumbotron">Temukan produk terbaik dengan harga terbaik di sini!</p>
                <div class="button">
                    <button class="btn btn-primary" style="margin-right: 0.5rem;"><a href="#products"
                            style="text-decoration: none; color: white;">Lihat Produk</a></button>
                </div>
            </div>
        </div>
    </div>
    <!-- Jumbotron End -->

    <!-- Products Start -->
    <div class="container mt-5" id="products">
        <h2 class="text-center pt-5">Daftar Produk</h2>
        <div class="row mb-3">
            <div class="col-12 col-md-4 mb-2 mb-md-0">
                <form action="" method="post" class="d-flex">
                    <input type="text" name="keyword" class="form-control mr-2" autocomplete="off"
                        placeholder="Masukkan kata kunci..." required id="keyword-search">
                    <button type="submit" name="search" class="btn btn-primary"><i class="bi bi-search"></i></button>
                </form>
            </div>
            <div class="col-12 col-md-8 mb-2 mb-md-0">
                <form action="" method="post" class="d-flex">
                    <select name="category" class="form-control mr-2">
                        <option value="">Pilih Kategori</option>
                        <option value="Laptop Gaming">Laptop Gaming</option>
                        <option value="Laptop Multimedia">Laptop Multimedia</option>
                        <option value="Laptop Standar">Laptop Standar</option>
                    </select>
                    <select name="price_range" class="form-control mr-2">
                        <option value="">Pilih Rentang Harga</option>
                        <option value="0-2500000">Rp0 - Rp2,500,000</option>
                        <option value="2500001-5000000">Rp2,500,001 - Rp5,000,000</option>
                        <option value="5000001-7500000">Rp5,000,001 - Rp7,500,000</option>
                        <option value="7500001-10000000">Rp7,500,001 - Rp10,000,000</option>
                        <option value="10000001-20000000">RpRp10,000,001 - RpRp20,000,000</option>
                    </select>
                    <button type="submit" name="filter" class="btn btn-primary">Filter</button>
                </form>
            </div>
        </div>
        <div id="container-produk" class="pt-4">
            <div class="row mt-3">
                <?php foreach ($result as $row): ?>
                    <div class="col-md-4">
                        <div class="card product-card">
                            <img src="../assets/images/<?= $row["img"]; ?>" class="card-img-top" alt="<?= $row["name"]; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= $row["name"]; ?></h5>
                                <p class="card-text"><strong>Rp<?= number_format($row["price"], 0, ',', '.'); ?></strong>
                                </p>
                                <a href="detail.php?id=<?= $row['id'] ?>" class="btn btn-primary">Detail Produk</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- Products End -->

    <!-- Contact Section Start -->
    <div class="contact-section" id="contact">
        <div class="container">
            <h2 class="text-center">Kontak Kami</h2>
            <div class="box-contact">
                <div class="row">
                    <div class="col-md-6">
                        <form>
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" id="name" placeholder="Masukkan nama Anda">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Masukkan email Anda">
                            </div>
                            <div class="form-group">
                                <label for="message">Pesan</label>
                                <textarea class="form-control" id="message" rows="3"
                                    placeholder="Masukkan pesan Anda"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <h5>Alamat:</h5>
                        <p>Jl. Contoh No.123, Jakarta, Indonesia</p>
                        <h5>Email:</h5>
                        <p>info@hryastore.com</p>
                        <h5>Telepon:</h5>
                        <p>+62 123-4567-890</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Section End -->

    <!-- My script -->
    <script src="../assets/js/script.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
