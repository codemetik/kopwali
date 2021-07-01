<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Simpanan</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php 
    if (!isset($_GET['sim'])) {
    	echo "simpan";
    }else{
    	echo $_GET['sim'];
    }?></li>
  </ol>
</nav>
<div class="row">
	<div class="card col-lg-2 p-2">
		<ul class="list-group">
		  <li class="list-group-item bg-light d-flex justify-content-between align-items-center"><a href="?sim=simpan" class="nav-link text-dark">Simpanan</a> <span class="badge bg-primary rounded-pill">10</span></li>
		  <li class="list-group-item bg-light d-flex justify-content-between align-items-center"><a href="?sim=tabungan" class="nav-link text-dark">Tabungan</a></li>
		</ul>
		<hr>
		<ul class="list-group">
			<li class="list-group-item bg-light d-flex justify-content-between align-items-center"><a href="?sim=tarik_simpanan" class="nav-link text-dark">Penarikan Simpanan</a> <span class="badge bg-primary rounded-pill">10</span></li>
		  	<li class="list-group-item bg-light d-flex justify-content-between align-items-center"><a href="?sim=table_simpanan" class="nav-link text-dark">Table Penarikan</a> <span class="badge bg-primary rounded-pill">10</span></li>
		</ul>
		<hr>
	</div>
	<div class="col-lg-10">
	<?php 
		if (isset($_GET['sim'])) {
		$sim = $_GET['sim'];

		switch ($sim) {
			case 'simpan':
				require_once('simpan/simpan.php');
				break;
			case 'edit_simpan':
				require_once('simpan/edit_simpan.php');
				break;
			case 'tarik_simpanan':
				require_once('simpan/tarik_simpanan.php');
				break;
			case 'table_simpanan':
				require_once('simpan/table_simpanan.php');
				break;
			case 'tabungan':
				require_once('simpan/tabungan.php');
				break;
			case 'detail_tabungan':
				require_once('simpan/detail_tabungan.php');
				break;
			default:
				echo "Maaf, Halaman yang anda cari tidak ada";
				break;
		}
	}else{
		require_once('simpan/simpan.php');
	}
	 ?>	
	</div>
</div>

