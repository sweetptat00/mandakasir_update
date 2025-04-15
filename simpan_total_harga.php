<?php
// Pastikan tidak ada output sebelum header
ob_start();

// Koneksi ke database
include '../koneksi.php';

// Ambil data dari form
$TotalHarga   = $_POST['TotalHarga'];
$PenjualanID  = $_POST['PenjualanID'];

// Update TotalHarga di database
$update = mysqli_query($koneksi, "UPDATE penjualan SET TotalHarga = '$TotalHarga' WHERE PenjualanID = '$PenjualanID'");

// Cek berhasil atau tidak
if ($update) {
    // Redirect langsung ke halaman pembelian.php
    header("Location: pembelian.php");
    exit();
} else {
    echo "Gagal menyimpan total harga. <a href='pembelian.php'>Kembali</a>";
}
?>
