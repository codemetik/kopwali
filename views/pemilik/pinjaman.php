<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Pinjaman</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php 
    if (!isset($_GET['pag'])) {
    	echo "Pinjaman";
    }else{
    	echo $_GET['pag'];
    }?></li>
  </ol>
</nav>
<div class="row">
<div class="card col-lg-2 p-2">
	<ul class="list-group">
	  <li class="list-group-item bg-light d-flex justify-content-between align-items-center"><a href="?pag=persetujuan" class="nav-link text-dark">Persetujuan</a></li>
	  <li class="list-group-item bg-light d-flex justify-content-between align-items-center"><a href="?pag=pinjaman" class="nav-link text-dark">Data Pinjaman</a></li>
	  <hr>
	  <!-- <li class="list-group-item bg-light d-flex justify-content-between align-items-center"><a href="?pag=pengembalian" class="nav-link text-dark">
	  Data Pengembalian</a></li> -->
	</ul>
</div>
<div class="col-lg-10">
<?php 
if (isset($_GET['pag'])) {
	$page = $_GET['pag'];
	switch ($page) {
		case 'pinjaman':
			require_once('pinjam/pinjam.php');
			break;
		case 'persetujuan':
			require_once('pinjam/persetujuan.php');
			break;
		
		default:
			echo "Maaf, Halaman yang anda cari tidak ada";
			break;
	}
}else{
	require_once('pinjam/persetujuan.php');
}
?>
</div>	
</div>