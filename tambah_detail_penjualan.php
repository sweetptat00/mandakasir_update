<?php
include '../koneksi.php';

$PenjualanID = $_POST['PenjualanID'];
$PelangganID = $_POST['PelangganID'];
$ProdukID = $_POST['ProdukID'];
$JumlahProduk = $_POST['JumlahProduk'];

// Ambil harga produk
$queryProduk = mysqli_query($koneksi, "SELECT Harga FROM produk WHERE ProdukID='$ProdukID'");
$dataProduk = mysqli_fetch_assoc($queryProduk);
$Harga = $dataProduk['Harga'];

$Subtotal = $JumlahProduk * $Harga;

// Simpan ke detailpenjualan
mysqli_query($koneksi, "INSERT INTO detailpenjualan (PenjualanID, ProdukID, JumlahProduk, Subtotal) 
VALUES ('$PenjualanID', '$ProdukID', '$JumlahProduk', '$Subtotal')");

// Redirect kembali ke detail pembelian
header("Location: detail_pembelian.php?PelangganID=$PelangganID");
?>
