<?php
include "koneksi.php";

// Proses tambah data
if (isset($_POST['action']) && $_POST['action'] == 'tambah') {
    $tanggal_penjualan = $_POST['tanggal_penjualan'];
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $jumlah_terjual = $_POST['jumlah_terjual'];
    $total_penjualan = $harga * $jumlah_terjual;

    $query = "INSERT INTO barang (tanggal_penjualan, nama_produk, harga, jumlah_terjual, total_penjualan) VALUES ('$tanggal_penjualan', '$nama_produk', '$harga', '$jumlah_terjual', '$total_penjualan')";
    $mysqli->query($query);
}

// Proses edit data
if (isset($_POST['action']) && $_POST['action'] == 'edit') {
    $id = $_POST['id'];
    $tanggal_penjualan = $_POST['tanggal_penjualan'];
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $jumlah_terjual = $_POST['jumlah_terjual'];
    $total_penjualan = $harga * $jumlah_terjual;

    $query = "UPDATE barang SET tanggal_penjualan='$tanggal_penjualan', nama_produk='$nama_produk', harga='$harga', jumlah_terjual='$jumlah_terjual', total_penjualan='$total_penjualan' WHERE id='$id'";
    $mysqli->query($query);
}

// Proses hapus data
if (isset($_GET['action']) && $_GET['action'] == 'hapus') {
    $id = $_GET['id'];
    $query = "DELETE FROM barang WHERE id='$id'";
    $mysqli->query($query);
}

// Ambil data untuk ditampilkan
$query = "SELECT * FROM barang";
$result = $mysqli->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Data Penjualan</title>
</head>
<body>
    <h2>Data Penjualan</h2>
    <form action="data.php" method="POST">
        <input type="hidden" name="id" value="<?= isset($row['id']) ? $row['id'] : ''; ?>">
        <label for="tanggal_penjualan">Tanggal Penjualan:</label>
        <input type="date" name="tanggal_penjualan" required><br>

        <label for="nama_produk">Nama Produk:</label>
        <input type="text" name="nama_produk" required><br>

        <label for="harga">Harga:</label>
        <input type="number" name="harga" required><br>

        <label for="jumlah_terjual">Jumlah Terjual:</label>
        <input type="number" name="jumlah_terjual" required><br>

        <input type="submit" name="action" value="<?= isset($row['id']) ? 'edit' : 'tambah'; ?>">
    </form>

    <table border="1">
        <tr>
            <th>id</th>
            <th>tanggal penjualan</th>
            <th>nama</th>
            <th>harga</th>
            <th>jumlah terjual</th>
            <th>total penjualan</th>
            <th>aksi</th>
        </tr>

        <?php
        while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['tanggal_penjualan']; ?></td>
                <td><?= $row['nama_produk']; ?></td>
                <td><?= number_format($row['harga'], 2, ',', '.'); ?></td>
                <td><?= intval($row['jumlah_terjual']); ?></td>
                <td><?= number_format($row['total_penjualan'], 2, ',', '.'); ?></td>
                <td>
                    <a href="data.php?id=<?= $row['id']; ?>&action=edit">Edit</a> |
                    <a href="data.php?id=<?= $row['id']; ?>&action=hapus">Hapus</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
</body>
</html>
