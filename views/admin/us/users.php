<?php require_once('ambil_code.php'); ?>
	<div class="row">
		<div class="col-sm-12">
			<div class="card mb-3 bg-light">
			<div class="card-header bg-light">
				<h5 class="card-title">Register User</h5>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-sm-12">
					<form action="" method="post">
						<div class="row">
							<div class="col-sm-6">
								<div class="input-group input-group-sm mb-1">
								  <span class="input-group-text">ID</span>
								  <input type="text" class="form-control" name="id_user" readonly value="<?= $kodeUser; ?>">
								</div>
								<div class="input-group input-group-sm mb-1">
								  <span class="input-group-text"><span data-feather="user"></span></span>
								  <input type="text" class="form-control" name="user" required placeholder="Username" autofocus>
								</div>
								<div class="input-group input-group-sm mb-1 form-floating">
								  <select class="js-example-basic-single form-control" name="rols" id="floatingSelect" required aria-label="Floating label select example">
								  	<option value="LV03">Members</option>
								    <option value="LV02">Administrators</option>
								    <option value="LV01">Owner</option>
								  </select>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="input-group input-group-sm mb-1">
								  <span class="input-group-text" id="inputGroup-sizing-sm"><span data-feather="lock"></span></span>
								  <input type="password" class="form-control" name="pass" required placeholder="Password">
								</div>
								<div class="input-group input-group-sm mb-1">
								  <span class="input-group-text" id="inputGroup-sizing-sm"><span data-feather="lock"></span></span>
								  <input type="password" class="form-control" name="confirm_pass" required placeholder="Confirm Password">
								</div>
							</div>
						</div>
						<button type="submit" name="add" class="btn-md btn-primary"><span data-feather="plus"></span> Add User</button>
					</div>
					</form>
				</div>
			</div>
		</div>
		</div>
		<div class="col-sm-12 table-responsive">
			<table id="example" class="display table" style="width:100%">
		        <thead class="text-center table-dark">
		            <tr>
		            	<th>No</th>
		                <th>ID</th>
		                <th>Username</th>
		                <th>User Access</th>
		                <th>Action</th>
		            </tr>
		        </thead>
		        <tbody>
		        	<?php 
		        	$no=1;
		        	$sql = mysqli_query($koneksi, "select * from tb_user x inner join tb_rols y on y.id_user = x.id_user inner join tb_level_user z on z.id_level_user = y.id_level_user");
		        	while ($data = mysqli_fetch_array($sql)) {
		        		echo "<tr>
		        				<td>".$no++."</td>
				                <td>".$data['id_user']."</td>
				                <td>".$data['user']."</td>
				                <td>".$data['name_level']."</td>"; ?>
				                <td><a href="?us=update_user&edit=<?= $data['id_user']; ?>"><span data-feather='edit'></span></a> | <a href='?us=users&delete=<?= $data['id_user'] ?>' onclick="return confirm('Yakin mau di hapus?')"><span data-feather='delete'></span></a></td>
				            <?php "</tr>";
		        	}
		        	?>
		        </tbody>
		        <tfoot class="text-center table-dark">
		            <tr>
		            	<th>No</th>
		                <th>ID</th>
		                <th>Username</th>
		                <th>User Access</th>
		                <th>Action</th>
		            </tr>
		        </tfoot>
		    </table>
		</div>
	</div>

<?php 

if (isset($_POST['add'])) {
	$id_user = $_POST['id_user'];
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$confirm_pass = $_POST['confirm_pass'];
	$rols = $_POST['rols'];

	if ($pass == $confirm_pass) {
		
	$sql = mysqli_query($koneksi, "insert into tb_user(id_user, user, pass, confirm_pass) values('$id_user','$user','$pass','$confirm_pass')");
	$sqlrol = mysqli_query($koneksi, "insert into tb_rols(id_rolsuser, id_level_user, id_user) values('$koderol','$rols','$id_user')");

	if ($sql & $sqlrol) {
		echo "<script>
		alert('Data berhasil di buat');
		document.location.href = 'data_user?us=users';
		</script>";
	}else{
		echo "<script>
		alert('Data gagal di buat');
		document.location.href = 'data_user?us=users';
		</script>";
	}

	}else{
		echo "<script>
		alert('Maaf, Password dengan konfirmasi password harus sama!!!');
		document.location.href = 'data_user?us=users';
		</script>";
	}

}else if (isset($_GET['delete'])) {
	$delete = $_GET['delete'];

	$sql = mysqli_query($koneksi, "delete from tb_user where id_user = '".$delete."'");
	if ($sql) {
		echo "<script>
		alert('Data berhasil di hapus');
		document.location.href = 'data_user?us=users';
		</script>";
	}else{
		echo "<script>
		alert('Data gagal dihapus');
		document.location.href = 'data_user?us=users';
		</script>";
	}
}
?>

