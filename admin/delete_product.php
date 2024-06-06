<?php
session_start();

// mengecek apakah session sudah dibuat
if (!isset($_SESSION["login"])) {
    // kalau tidak ada session
    header("Location: login.php");
    exit;
}

require '../includes/functions.php';

$id = $_GET['id'];

if (delete($id) > 0) {
    echo "<script>
    document.location.href = 'index.php';
</script>";

} else {
    echo "<script>
    document.location.href = 'index.php';
    alert('Data gagal dihapus');
</script>";
}

?>