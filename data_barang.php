<?php include "sidebar.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Data Barang</title>
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../assets/favicon-16x16.png" type="image/x-icon">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="main-content">
	<div class="card mt-3">
		<div class="card-body">
			<h4 class="mb-3">Data Barang</h4>

			<button type="button" class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#tambah-data">
				Tambah Data
			</button>

			<?php 
			if(isset($_GET['pesan'])){
				if($_GET['pesan']=="simpan"){ ?>
					<div class="alert alert-success">Data Berhasil Disimpan</div>
				<?php } elseif($_GET['pesan']=="update"){ ?>
					<div class="alert alert-success">Data Berhasil Diupdate</div>
				<?php } elseif($_GET['pesan']=="hapus"){ ?>
					<div class="alert alert-success">Data Berhasil Dihapus</div>
				<?php }
			}
			?>

			<table class="table table-bordered table-striped">
				<thead class="table-light">
					<tr>
						<th>No</th>
						<th>Nama Produk</th>
						<th>Harga</th>
						<th>Stok</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					include '../koneksi.php';
					$no = 1;
					$data = mysqli_query($koneksi,"SELECT * FROM produk");
					while($d = mysqli_fetch_array($data)){ ?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= $d['NamaProduk'] ?></td>
							<td>Rp. <?= number_format($d['Harga']) ?></td>
							<td><?= $d['Stok'] ?></td>
							<td>
								<button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-data<?= $d['ProdukID'] ?>">Edit</button>
								<button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus-data<?= $d['ProdukID'] ?>">Hapus</button>
							</td>
						</tr>

						<!-- Modal Edit -->
						<div class="modal fade" id="edit-data<?= $d['ProdukID'] ?>" tabindex="-1">
							<div class="modal-dialog">
								<div class="modal-content">
									<form action="proses_update_barang.php" method="post">
										<div class="modal-header">
											<h5 class="modal-title">Edit Produk</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
										</div>
										<div class="modal-body">
											<input type="hidden" name="ProdukID" value="<?= $d['ProdukID'] ?>">
											<div class="mb-2">
												<label>Nama Produk</label>
												<input type="text" name="NamaProduk" value="<?= $d['NamaProduk'] ?>" class="form-control">
											</div>
											<div class="mb-2">
												<label>Harga</label>
												<input type="number" name="Harga" value="<?= $d['Harga'] ?>" class="form-control">
											</div>
											<div class="mb-2">
												<label>Stok</label>
												<input type="number" name="Stok" value="<?= $d['Stok'] ?>" class="form-control">
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
											<button type="submit" class="btn btn-primary">Update</button>
										</div>
									</form>
								</div>
							</div>
						</div>

						<!-- Modal Hapus -->
						<div class="modal fade" id="hapus-data<?= $d['ProdukID'] ?>" tabindex="-1">
							<div class="modal-dialog">
								<div class="modal-content">
									<form action="proses_hapus_barang.php" method="post">
										<div class="modal-header">
											<h5 class="modal-title">Hapus Produk</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
										</div>
										<div class="modal-body">
											<input type="hidden" name="ProdukID" value="<?= $d['ProdukID'] ?>">
											Apakah Anda yakin ingin menghapus produk <b><?= $d['NamaProduk'] ?></b>?
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
											<button type="submit" class="btn btn-danger">Hapus</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="tambah-data" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="proses_simpan_barang.php" method="post">
				<div class="modal-header">
					<h5 class="modal-title">Tambah Produk</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<div class="mb-2">
						<label>Nama Produk</label>
						<input type="text" name="NamaProduk" class="form-control">
					</div>
					<div class="mb-2">
						<label>Harga</label>
						<input type="number" name="Harga" class="form-control">
					</div>
					<div class="mb-2">
						<label>Stok</label>
						<input type="number" name="Stok" class="form-control">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
					<button type="submit" class="btn btn-success">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
