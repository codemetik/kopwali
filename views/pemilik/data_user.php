<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Data User</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php 
    if (!isset($_GET['use'])) {
    	echo "Use";
    }else{
    	echo $_GET['use'];
    }?></li>
  </ol>
</nav>
<div class="row">
<div class="card col-lg-2 p-2">
	<ul class="list-group">
	  <li class="list-group-item bg-light d-flex justify-content-between align-items-center"><a href="?use=user" class="nav-link text-dark">Data User</a> <span class="badge bg-primary rounded-pill"><?= notif_user($koneksi); ?></span></li>
	  <li class="list-group-item bg-light d-flex justify-content-between align-items-center"><a href="?use=members" class="nav-link text-dark">Data Members</a></li>
	  <hr>
	</ul>
</div>
<div class="col-lg-10">
<?php 
if (isset($_GET['use'])) {
	$page = $_GET['use'];
	switch ($page) {
		case 'user':
			require_once('use/user.php');
			break;
		case 'members':
			require_once('use/members.php');
			break;
		
		default:
			echo "Maaf, Halaman yang anda cari tidak ada";
			break;
	}
}else{
	require_once('use/user.php');
}
?>
</div>	
</div>