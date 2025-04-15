<?php
include '../koneksi.php';
include 'sidebar.php';
$PelangganID = $_GET['PelangganID'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Detail Pembelian</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
	<style>
		.content {
			margin-left: 250px;
			padding: 2rem;
		}
	</style>
</head>
<body>

<div class="content">
	<div class="card">
		<div class="card-body">

			<?php 
			$query = mysqli_query($koneksi,"SELECT * FROM pelanggan 
				INNER JOIN penjualan ON pelanggan.PelangganID=penjualan.PelangganID 
				WHERE pelanggan.PelangganID='$PelangganID'");
			$d = mysqli_fetch_array($query);
			?>

			<h4 class="mb-3">Detail Pembelian Pelanggan</h4>

			<!-- Info Pelanggan -->
			<table class="table table-bordered">
				<tr><td><b>ID Pelanggan</b></td><td><?= $d['PelangganID']; ?></td></tr>
				<tr><td><b>Nama Pelanggan</b></td><td><?= $d['NamaPelanggan']; ?></td></tr>
				<tr><td><b>No. Telepon</b></td><td><?= $d['NomorTelepon']; ?></td></tr>
				<tr><td><b>Alamat</b></td><td><?= $d['Alamat']; ?></td></tr>
				<tr><td><b>Total Pembelian</b></td><td>Rp. <?= number_format($d['TotalHarga']); ?></td></tr>
			</table>

			<!-- Form Tambah Barang -->
			<form method="post" action="tambah_detail_penjualan.php" class="row g-3 mb-4">
				<input type="hidden" name="PenjualanID" value="<?= $d['PenjualanID']; ?>">
				<input type="hidden" name="PelangganID" value="<?= $d['PelangganID']; ?>">

				<div class="col-md-6">
					<label class="form-label">Pilih Produk</label>
					<select name="ProdukID" class="form-select" required>
						<option value="">-- Pilih Produk --</option>
						<?php 
						$produk = mysqli_query($koneksi, "SELECT * FROM produk");
						while($p = mysqli_fetch_array($produk)){
							echo "<option value='$p[ProdukID]'>$p[NamaProduk] - Rp. ".number_format($p['Harga'])."</option>";
						}
						?>
					</select>
				</div>

				<div class="col-md-3">
					<label class="form-label">Jumlah</label>
					<input type="number" name="JumlahProduk" class="form-control" min="1" required>
				</div>

				<div class="col-md-3 align-self-end">
					<button type="submit" class="btn btn-primary w-100">Tambah Barang</button>
				</div>
			</form>

			<!-- Daftar Produk -->
			<table class="table table-bordered table-striped">
				<thead class="table-light">
					<tr>
						<th>No</th>
						<th>Nama Produk</th>
						<th>Jumlah Beli</th>
						<th>Subtotal</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$no = 1;
					$detail = mysqli_query($koneksi, "
						SELECT dp.*, p.NamaProduk 
						FROM detailpenjualan dp 
						JOIN produk p ON dp.ProdukID = p.ProdukID 
						WHERE dp.PenjualanID = '$d[PenjualanID]'
					");
					while($item = mysqli_fetch_array($detail)){ ?>
					<tr>
						<td><?= $no++; ?></td>
						<td><?= $item['NamaProduk']; ?></td>
						<td><?= $item['JumlahProduk']; ?></td>
						<td>Rp. <?= number_format($item['Subtotal']); ?></td>
						<td>
							<form method="post" action="hapus_detail_pembelian.php" style="display:inline;">
								<input type="hidden" name="DetailID" value="<?= $item['DetailID']; ?>">
								<input type="hidden" name="PelangganID" value="<?= $d['PelangganID']; ?>">
								<button type="submit" class="btn btn-danger btn-sm">Hapus</button>
							</form>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>

			<!-- Simpan Total Harga -->
			<form method="post" action="simpan_total_harga.php" class="row g-3 mt-4">
				<?php 
				$total = mysqli_query($koneksi, "SELECT SUM(Subtotal) AS TotalHarga FROM detailpenjualan WHERE PenjualanID='$d[PenjualanID]'");
				$sum = mysqli_fetch_assoc($total)['TotalHarga'];
				?>
				<div class="col-md-10">
					<label class="form-label">Total Harga</label>
					<input type="text" class="form-control" name="TotalHarga" value="<?= $sum ?>" readonly>
					<input type="hidden" name="PenjualanID" value="<?= $d['PenjualanID']; ?>">
					<input type="hidden" name="PelangganID" value="<?= $d['PelangganID']; ?>">
				</div>
				<div class="col-md-2 align-self-end">
					<button type="submit" class="btn btn-info w-100">Simpan</button>
					<a href="cetak.php?PelangganID=<?= $d['PelangganID']; ?>" target="_blank" class="btn btn-secondary w-100 mt-2">Cetak</a>
				</div>
			</form>

		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
