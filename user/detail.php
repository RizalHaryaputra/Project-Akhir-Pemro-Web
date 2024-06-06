<?php
require '../includes/functions.php';

$id = $_GET['id'];
$product = query("SELECT * FROM products WHERE id = $id")[0];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - <?= $product['name']; ?></title>

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
            background: linear-gradient(to right, #ece9e6, #ffffff);
            color: #333;
        }

        .navbar {
            margin-bottom: 2rem;
        }

        .product-detail {
            margin-top: 2rem;
        }

        .product-detail img {
            width: 250px;
            height: 250px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: block;
            margin: 0 auto 1rem auto;
        }

        .product-detail .card {
            padding: 1rem;
            border: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .product-detail .card h2 {
            font-weight: bold;
            margin-bottom: 1rem;
            text-align: center;
        }

        .product-detail .card p {
            margin-bottom: 1rem;
        }

        .product-detail .price {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            text-align: center;
        }

        .product-detail .description {
            font-size: 16px;
            color: #666;
        }

        .product-detail .category {
            font-size: 14px;
            color: #999;
            text-align: center;
        }

        .product-detail .btn {
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 10px;
            transition: background-color 0.3s, transform 0.3s;
            display: block;
            margin: 1rem auto 0 auto;
        }

        .product-detail .btn:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .text-justify {
            text-align: justify;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Detail Produk - <?= $product['name'] ?></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <div class="container product-detail mb-3">
        <div class="row">
            <div class="col-md-12">
                <img src="../assets/images/<?= $product["img"]; ?>" alt="<?= $product["name"]; ?>">
            </div>
            <div class="col-md-12">
                <div class="card text-center">
                    <h2><?= $product["name"]; ?></h2>
                    <p class="price">Rp<?= number_format($product["price"], 0, ',', '.'); ?></p>
                    <p class="description text-justify"><?= $product["description"]; ?></p>
                    <p class="category">Kategori: <?= $product["category"]; ?></p>
                    <a href="index.php" class="btn btn-primary">Kembali ke Katalog</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>