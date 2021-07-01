<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Data User</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php 
    if (!isset($_GET['us'])) {
    	echo "users";
    }else{
    	echo $_GET['us'];
    }
     ?></li>
  </ol>
</nav>
<div class="row">
	<div class="card col-lg-2 p-2">
		<ul class="list-group">
		  <li class="list-group-item bg-light d-flex justify-content-between align-items-center"><a href="?us=users" class="nav-link text-dark">Users</a> <span class="badge bg-primary rounded-pill"><?php get_id("LV01","LV02", $koneksi); ?></span></li>
		  <li class="list-group-item bg-light d-flex justify-content-between align-items-center"><a href="?us=members" class="nav-link text-dark">Members</a> <span class="badge bg-primary rounded-pill"><?php get_idlevel("LV03", $koneksi); ?></span></li>
		</ul>
		<hr>
	</div>
	<div class="col-lg-10">
		<?php 
		if (isset($_GET['us'])) {
			$us = $_GET['us'];

			switch ($us) {
				case 'users':
					require_once('us/users.php');
					break;
				case 'update_user':
					require_once('us/edit_adm.php');
					break;
				case 'update_members':
					require_once('us/edit_members.php');
					break;
				case 'edit_card':
					get_edit();
					break;
				case 'members':
					include "us/members.php";
					break;
				
				default:
					echo '
					<div class="alert alert-danger"><h5>Maaf. Halaman yang anda cari tidak ada!</h5></div>
					';
					break;
			}
		}else{
			include "us/users.php";
		}

		function get_edit(){ ?>
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Edit Card</h5>
				</div>
				<div class="card-body">
					
				</div>
			</div>
		<?php }

		function get_id($id1, $id2, $koneksi){

			$sql = mysqli_query($koneksi, "SELECT COUNT(y.id_user) AS id FROM tb_user Y INNER JOIN tb_rols X ON x.id_user = y.id_user where id_level_user = '".$id1."' | '".$id2."'");
			$data = mysqli_fetch_array($sql);
			echo $data['id'];
		}
		function get_idlevel($id, $koneksi){

			$sql = mysqli_query($koneksi, "SELECT COUNT(y.id_user) AS id FROM tb_user Y INNER JOIN tb_rols X ON x.id_user = y.id_user where id_level_user = '".$id."'");
			$data = mysqli_fetch_array($sql);
			echo $data['id'];
		}
		?>
	</div>
</div>