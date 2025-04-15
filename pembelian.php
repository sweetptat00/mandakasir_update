<?php include "sidebar.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Pembelian</title>
	<link rel="stylesheet" href="../css/style.css">
	<!-- Bootstrap (pastikan link ini ada atau diinclude di sidebar.php) -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="main-content">
	<div class="card mt-3">
		<div class="card-body">
			<h4 class="mb-3">Pembelian</h4>
			<button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#tambah-data">
				+ Tambah Data
			</button>

			<?php if (isset($_GET['pesan'])): ?>
				<?php if ($_GET['pesan'] == "simpan"): ?>
					<div class="alert alert-success">Data Berhasil Disimpan</div>
				<?php elseif ($_GET['pesan'] == "update"): ?>
					<div class="alert alert-success">Data Berhasil Diupdate</div>
				<?php elseif ($_GET['pesan'] == "hapus"): ?>
					<div class="alert alert-success">Data Berhasil Dihapus</div>
				<?php endif; ?>
			<?php endif; ?>

			<table class="table table-bordered table-striped">
				<thead class="table-light">
					<tr>
						<th>No</th>
						<th>ID Pelanggan</th>
						<th>Nama Pelanggan</th>
						<th>No. Telepon</th>
						<th>Alamat</th>
						<th>Total Pembayaran</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php 
				include '../koneksi.php';
				$no = 1;
				$data = mysqli_query($koneksi,"SELECT * FROM pelanggan INNER JOIN penjualan ON pelanggan.PelangganID=penjualan.PelangganID");
				while($d = mysqli_fetch_array($data)){ ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $d['PelangganID'] ?></td>
						<td><?= $d['NamaPelanggan'] ?></td>
						<td><?= $d['NomorTelepon'] ?></td>
						<td><?= $d['Alamat'] ?></td>
						<td>Rp. <?= number_format($d['TotalHarga']) ?></td>
						<td>
							<a href="detail_pembelian.php?PelangganID=<?= $d['PelangganID'] ?>" class="btn btn-info btn-sm">Detail</a>
							<button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-data<?= $d['PelangganID'] ?>">Edit</button>
							<button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus-data<?= $d['PelangganID'] ?>">Hapus</button>
						</td>
					</tr>
					
					<!-- Modal Edit -->
					<div class="modal fade" id="edit-data<?= $d['PelangganID'] ?>" tabindex="-1">
						<div class="modal-dialog">
							<div class="modal-content">
								<form action="proses_update_pembelian.php" method="post">
									<div class="modal-header">
										<h5 class="modal-title">Edit Pelanggan</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
									</div>
									<div class="modal-body">
										<input type="hidden" name="PelangganID" value="<?= $d['PelangganID'] ?>">
										<div class="mb-2">
											<label>Nama Pelanggan</label>
											<input type="text" name="NamaPelanggan" value="<?= $d['NamaPelanggan'] ?>" class="form-control">
										</div>
										<div class="mb-2">
											<label>No. Telepon</label>
											<input type="text" name="NomorTelepon" value="<?= $d['NomorTelepon'] ?>" class="form-control">
										</div>
										<div class="mb-2">
											<label>Alamat</label>
											<input type="text" name="Alamat" value="<?= $d['Alamat'] ?>" class="form-control">
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
										<button type="submit" class="btn btn-primary">Simpan</button>
									</div>
								</form>
							</div>
						</div>
					</div>

					<!-- Modal Hapus -->
					<div class="modal fade" id="hapus-data<?= $d['PelangganID'] ?>" tabindex="-1">
						<div class="modal-dialog">
							<div class="modal-content">
								<form method="post" action="proses_hapus_pembelian.php">
									<div class="modal-header">
										<h5 class="modal-title">Hapus Data</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
									</div>
									<div class="modal-body">
										<input type="hidden" name="PelangganID" value="<?= $d['PelangganID'] ?>">
										Apakah yakin ingin menghapus data <b><?= $d['NamaPelanggan'] ?></b>?
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
			<form action="proses_pembelian.php" method="post">
				<div class="modal-header">
					<h5 class="modal-title">Tambah Pelanggan</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<div class="mb-2">
						<label>ID Pelanggan</label>
						<input type="text" name="PelangganID" value="<?= date('dmHis') ?>" class="form-control" readonly>
					</div>
					<div class="mb-2">
						<label>Nama Pelanggan</label>
						<input type="text" name="NamaPelanggan" class="form-control">
					</div>
					<div class="mb-2">
						<label>No. Telepon</label>
						<input type="text" name="NomorTelepon" class="form-control">
					</div>
					<div class="mb-2">
						<label>Alamat</label>
						<input type="text" name="Alamat" class="form-control">
						<input type="hidden" name="TanggalPenjualan" value="<?= date('Y-m-d') ?>">
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

<!-- Bootstrap JS (pastikan ini juga ada di sidebar.php atau layout utama) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
