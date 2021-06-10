<?php
if (isset($_GET['edit'])) {

$sql = mysqli_query($koneksi, "select * from tb_user where id_user = '".$_GET['edit']."'");
$d = mysqli_fetch_array($sql);
$cek = mysqli_num_rows($sql);
$rol = mysqli_query($koneksi, "select * from tb_rols where id_user = '".$d['id_user']."'");
$rols = mysqli_fetch_array($rol);

if ($cek > 0) { ?>
<div class="card">
<div class="card-header alert-primary">
	<h5 class="card-titile">Edit User ADM</h5>
</div>
<div class="card-body">
	<form action="" method="post">
		<div class="row">
			<div class="col-sm-6">
				<div class="input-group input-group-sm mb-3">
				  <span class="input-group-text">ID</span>
				  <input type="text" class="form-control" name="id_user" readonly value="<?= $d['id_user']; ?>">
				</div>
				<div class="input-group input-group-sm mb-3">
				  <span class="input-group-text"><span data-feather="user"></span></span>
				  <input type="text" class="form-control" name="user" value="<?= $d['user']; ?>" required>
				</div>
				<div class="input-group input-group-sm mb-1">
				  <select class="js-example-basic-single form-control" name="id_level_user" id="floatingSelect" required aria-label="Floating label select example">
				  	<?php 
				  	$lv_user = mysqli_query($koneksi, "select * from tb_level_user");
				  	while ($vuser = mysqli_fetch_array($lv_user)) {
				  		if ($vuser['id_level_user'] == $rols['id_level_user']) {
				  			$select = 'selected';
				  		}else{
				  			$select = '';
				  		} ?>
				  		<option value="<?= $vuser['id_level_user']; ?>" <?= $select; ?>><?= $vuser['name_level']; ?></option>	
				  	<?php }
				  	?>
				  </select>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="input-group input-group-sm mb-3">
				  <span class="input-group-text"><span data-feather="lock"></span></span>
				  <input type="text" class="form-control" name="pass" value="<?= $d['pass']; ?>" required>
				</div>
				<div class="input-group input-group-sm mb-3">
				  <span class="input-group-text"><span data-feather="lock"></span></span>
				  <input type="text" class="form-control" name="confirm_pass" value="<?= $d['confirm_pass']; ?>" required>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="input-group input-group-sm mb-3">
				  <button class="btn btn-primary" type="submit" name="update">Update</button>
				  <a href="?us=users" class="btn btn-primary" title="Kembli ke Table User">Cencel</a>
				</div>
			</div>
		</div>
	</form>
</div>
</div>
<?php }else{
	echo "Sorry";
}

}else{
	echo "Sorry";
}

if (isset($_POST['update'])) {
	$id_user = $_POST['id_user'];
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$confirm_pass = $_POST['confirm_pass'];
	$id_level_user = $_POST['id_level_user'];

	if ($pass == $confirm_pass) {
		$edit = mysqli_query($koneksi, "update tb_user set user = '$user', pass = '$pass', confirm_pass = '$confirm_pass' where id_user = '$id_user'");	
		$editrol = mysqli_query($koneksi, "update tb_rols set id_level_user = '$id_level_user' where id_user = '$id_user'");
		if ($edit && $editrol) {
		echo "<script>
		alert('Data User berhasil diupdate');
		document.location.href = '?us=users';
		</script>";	
		}else{
		echo "<script>
		alert('Data user gagal diupdate!!!');
		document.location.href = '?us=update_user&edit=$user';
		</script>";	
		}
	}else{
		echo "<script>
		alert('Password dan confirmasi password harus sama!!!');
		document.location.href = '?us=update_user&edit=$user';
		</script>";
	}
	
}

?>
<br>
<hr>
<?php 
$md5 = "indonesia";
$text = md5($md5);

echo $text;
echo "<hr>";
echo md5($text);
?>
