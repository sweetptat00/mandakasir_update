<?php include "sidebar.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../asset/favicon-16x16.png" type="image/x-icon">
</head>
<body>

<div class="d-flex">
	<!-- Main Content -->
	<div class="main-content flex-grow-1 p-4">
		<div class="card">
			<div class="card-body">
				<h4 class="mb-4">Dashboard</h4>
				<div class="row">
					<div class="col-md-4 mb-3">
						<div class="card shadow-sm border-0">
							<div class="card-body text-center">
								<strong>Data Barang</strong>
								<?php
								include '../koneksi.php';
								$data_produk = mysqli_query($koneksi,"SELECT * FROM produk");
								$jumlah_produk = mysqli_num_rows($data_produk);
								?>
								<h3><?= $jumlah_produk ?></h3>
								<a href="data_barang.php" class="btn btn-outline-primary btn-sm">Detail</a>
							</div>
						</div>
					</div>

					<div class="col-md-4 mb-3">
						<div class="card shadow-sm border-0">
							<div class="card-body text-center">
								<strong>Data Pembelian</strong>
								<?php
								$data_penjualan = mysqli_query($koneksi,"SELECT * FROM penjualan");
								$jumlah_penjualan = mysqli_num_rows($data_penjualan);
								?>
								<h3><?= $jumlah_penjualan ?></h3>
								<a href="pembelian.php" class="btn btn-outline-primary btn-sm">Detail</a>
							</div>
						</div>
					</div>

					<div class="col-md-4 mb-3">
						<div class="card shadow-sm border-0">
							<div class="card-body text-center">
								<strong>Data Pengguna</strong>
								<?php
								$data_petugas = mysqli_query($koneksi,"SELECT * FROM petugas");
								$jumlah_petugas = mysqli_num_rows($data_petugas);
								?>
								<h3><?= $jumlah_petugas ?></h3>
								<a href="data_pengguna.php" class="btn btn-outline-primary btn-sm">Detail</a>
							</div>
						</div>
					</div>
				</div>
				
				<!-- Tambahan info lainnya bisa ditaruh di bawah sini -->
			</div>
		</div>
	</div>
</div>

<?php include "footer.php"; ?>
</body>
</html>
