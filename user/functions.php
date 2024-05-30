<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "db_online_shop");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_array($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function add($data)
{
    global $conn;

    $name = htmlspecialchars($data['name']);
    $price = htmlspecialchars($data['price']);
    $category = htmlspecialchars($data['category']);
    $description = htmlspecialchars($data['description']);

    // upload gambar
    $img = uploadGambar();
    if (!$img) {
        return false;
    }

    $query = "INSERT INTO products (name, img, price, description, category)
                    VALUES
                    ('$name', '$img', '$price', '$description', '$category')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function delete($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM products WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function update($data)
{
    global $conn;

    $id = htmlspecialchars($data['id']);
    $name = htmlspecialchars($data['name']);
    $price = htmlspecialchars($data['price']);
    $category = htmlspecialchars($data['category']);
    $description = htmlspecialchars($data['description']);
    $gambarLama = htmlspecialchars($data['gambarLama']);

    if ($_FILES['img']['error'] == 4) {
        $img = $gambarLama;
    } else {
        $img = uploadGambar();
    }

    $query = "UPDATE products SET
                name = '$name',
                img = '$img',
                price = '$price',
                description = '$description',
                category = '$category'
                WHERE id = $id
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function search($keyword)
{
    $query = "SELECT * FROM products 
                WHERE 
                name LIKE '%$keyword%' OR
                price LIKE '%$keyword%' OR
                category LIKE '%$keyword%'
            ";
    return query($query);


}

function uploadGambar()
{
    //mengambil data dari file
    $namaGambar = $_FILES['img']['name'];
    $ukuranGambar = $_FILES['img']['size'];
    $erorGambar = $_FILES['img']['error'];
    $tempatGambar = $_FILES['img']['tmp_name'];

    //mengecek adakah gambar yang diupload
    if ($erorGambar == 4) {
        echo '
        <script>
            alert("Gambar belum dimasukan");
        </script>';

        return false;
    }

    // mengecek ekstensi gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'svg'];
    $namaFile = explode('.', $namaGambar);
    $ekstensiGambar = strtolower(end($namaFile));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo '
        <script>
            alert("Ekstensi tidak valid");
        </script>';

        return false;
    }

    // mengecek ukuran (dalam byte)
    if ($ukuranGambar > 1000000) {
        echo '
        <script>
            alert("Ukuran gambar terlalu besar");
        </script>';

        return false;
    }

    // lolos pengecekan
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.' . $ekstensiGambar;

    move_uploaded_file($tempatGambar, '../assets/images/' . $namaFileBaru);

    return $namaFileBaru;
}

function register($data)
{
    global $conn;

    $username = strtolower(stripslashes($data['username']));
    $email = strtolower(stripslashes($data['email']));
    $password = mysqli_real_escape_string($conn, $data['password']);
    $konfirmasiPassword = mysqli_real_escape_string($conn, $data['konfirmasiPassword']);

    // mengecek apakah ada username yang sama
    $result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
    if (mysqli_num_rows($result) == 1) {
        echo "<script>
            alert('Email telah tersedia');
        </script>";

        return false;
    }

    // mengecek apakah konfirmasi password sudah benar
    if ($konfirmasiPassword !== $password) {
        echo "<script>
            alert('Konfirmasi salah');
        </script>";

        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // mysqli_query($conn, "INSERT INTO admin ( ) VALUE ('', '$username', '$email' , '$password')");
    mysqli_query($conn, "INSERT INTO user (id, username, email, password) VALUES (NULL, '$username', '$email', '$password')");


    return mysqli_affected_rows($conn);
}



?>