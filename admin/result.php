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


<table class="table table-bordered table-striped" id="container-table">
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
                <td><?= $row["description"]; ?></td>
                <td><?= $row["category"]; ?></td>
                <td>
                    <a href="edit_product.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                </td>
                <td>
                    <a href="delete_product.php?id=<?= $row['id'] ?>"
                        onclick="return confirm('Apakah anda ingin mengahapus data <?= $row['name']; ?>')"
                        class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    </tbody>
</table>