<?php require_once("code_num.php"); ?>
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Pinjaman</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php 
    if (!isset($_GET['pin'])) {
    	echo "Pinjaman";
    }else{
    	echo $_GET['pin'];
    }?></li>
  </ol>
</nav>
<div class="row">
	<div class="card col-lg-2 p-2">
		<ul class="list-group">
		  <li class="list-group-item bg-light d-flex justify-content-between align-items-center"><a href="?pin=Pinjaman" class="nav-link text-dark">Pinjaman</a> <span class="badge bg-primary rounded-pill"><?php pinjaman($koneksi); ?></span></li>
		  <li class="list-group-item bg-light d-flex justify-content-between align-items-center"><a href="?pin=dis_approv" class="nav-link text-dark">Dis Approved</a> <span class="badge bg-primary rounded-pill"><?php dis_approv($koneksi); ?></li>
		  <li class="list-group-item bg-light d-flex justify-content-between align-items-center"><a href="?pin=load_approv" class="nav-link text-dark">Load Approved</a> <span class="badge bg-primary rounded-pill"><?php load_approv($koneksi); ?></span></li>
		</ul>
		<hr>
		<ul class="list-group">
			<li class="list-group-item bg-light d-flex justify-content-between align-items-center"><a href="?pin=pengembalian" class="nav-link text-dark">Pengembalian</a> <span class="badge bg-primary rounded-pill"><?= pengembalian($koneksi); ?></span></li>
		</ul>
		<hr>
	</div>
	<div class="col-lg-10">
	<?php 
		if (isset($_GET['pin'])) {
		$sim = $_GET['pin'];

		switch ($sim) {
			case 'Pinjaman':
				require_once('pinjam/pinjam.php');
				break;
			case 'presentasi_pinjaman':
				require_once('pinjam/presentasi_pinjaman.php');
				break;
			case 'detail_pinjaman':
				require_once('pinjam/detail_pinjaman.php');
				break;
			case 'dis_approv':
				require_once('pinjam/delete_persetujuan.php');
				break;
			case 'load_approv':
				require_once('pinjam/load_approv.php');
				break;
			case 'pengembalian':
				require_once('pinjam/pengembalian.php');
				break;
			default:
				echo "Maaf, Halaman yang anda cari tidak ada";
				break;
		}
	}else{
		require_once('pinjam/pinjam.php');
	}
	 ?>	
	</div>
</div>