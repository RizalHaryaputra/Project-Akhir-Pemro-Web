<?php
// menghubungkan ke 
require '../includes/functions.php';

$keyword = $_GET['keyword'];

$query = "SELECT * FROM products
        WHERE 
        name LIKE '%$keyword%'";


if (count(query($query)) > 0) {
    $result = query($query);
} else {
    echo "data tidak ditemukan";
    die;
}
?>


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