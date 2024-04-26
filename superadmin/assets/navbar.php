<nav class="navbar navbar-expand-sm navbar-dark bg-dark"
    style="background-image: url(../assets/images/navbar1.png); background-size: cover;">
    <div class="container-fluid">
        <div class="navbar-brand">
            <img src="assets/images/logo1.png" alt="Avatar Logo" style="width:40px; pointer-events: none;">
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="datapemesanan.php">
                        <i class="bi bi-calendar-check"></i> Data Pemesanan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="lapangan.php">
                        <i class="bi bi-view-list"></i> Data Lapangan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="penilaian.php">
                        <i class="bi bi-star"></i> Penilaian Pengguna
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="authadmin/loginadmin.php"
                        onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>