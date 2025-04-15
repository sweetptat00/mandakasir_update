<div class="col-md-3 col-lg-2 bg-dark sidebar text-white">
    <div class="text-center py-4">
        <img src="../assets/logo-loufu.png" alt="Logo" class="rounded-circle mb-2">
        <h5 class="mb-0">LOUFU MART</h5>
    </div>
    <ul class="nav flex-column px-3">
        <li class="nav-item"><a class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>" href="index.php">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) == 'data_barang.php' ? 'active' : '' ?>" href="data_barang.php">Data Barang</a></li>
        <li class="nav-item"><a class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) == 'pelanggan.php' ? 'active' : '' ?>" href="pelanggan.php">Pelanggan</a></li>
        <li class="nav-item"><a class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) == 'pembelian.php' ? 'active' : '' ?>" href="pembelian.php">Pembelian</a></li>
        <li class="nav-item"><a class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) == 'data_pengguna.php' ? 'active' : '' ?>" href="data_pengguna.php">Data Pengguna</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="../logout.php">Logout</a></li>
    </ul>
</div>
