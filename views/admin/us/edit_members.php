<?php 
if (isset($_GET['edit'])) {

$sql = mysqli_query($koneksi, "select * from tb_user where id_user = '".$_GET['edit']."'");
$d = mysqli_fetch_array($sql);
$cek = mysqli_num_rows($sql);
if ($cek > 0) {
$anggota = mysqli_query($koneksi, "select * from tb_anggota where id_user = '".$d['id_user']."'");
$agt = mysqli_fetch_array($anggota);
?>
<div class="card">
	<div class="card-header alert-primary">
		<h5 class="card-titile">Edit User Members</h5>
	</div>
	<div class="card-body">
		<form action="" method="post">
			<div class="row">
				<div class="col-sm-6">
					<div class="input-group input-group-sm mb-3">
					  <span class="input-group-text">ID Agt</span>
					  <input type="text" class="form-control" name="id_anggota" readonly value="<?= $agt['id_anggota']; ?>">
					</div>
					<div class="input-group input-group-sm mb-3">
					  <span class="input-group-text">ID Usr</span>
					  <input type="text" class="form-control" name="id_user" readonly value="<?= $d['id_user']; ?>">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="input-group input-group-sm form-floating mb-3">
					  <input type="date" class="form-control" id="tgl_join" name="tgl_join" value="<?= $agt['tgl_join']; ?>" required>
					  <label for="tgl_join">Tanggal Join</label>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-floating mb-3">
								<input type="text" id="nama" name="nama_lengkap" class="form-control" value="<?= $agt['nama_lengkap']; ?>">
								<label for="nama">Nama Lengkap</label>
							</div>
							<div class="form-floating mb-3">
								<input type="text" id="tmp_lahir" name="tempat_lahir" class="form-control" value="<?= $agt['tempat_lahir']; ?>">
								<label for="tmp_lahir">Tempat Lahir</label>
							</div>
							<div class="form-floating mb-3">
								<input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control" value="<?= $agt['tgl_lahir']; ?>">
								<label for="tgl_lahir">Tanggal Lahir</label>
							</div>
							<div class="form-floating mb-3">
								<input type="text" id="alamat" name="alamat_sekarang" class="form-control" value="<?= $agt['alamat_sekarang']; ?>">
								<label for="alamat">Alamat</label>
							</div>
							<div class="form-floating mb-3">
								<input type="text" id="no_telpn" name="no_telpn" class="form-control" value="<?= $agt['no_telpn']; ?>">
								<label for="no_telpn">No Telephone</label>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-floating mb-3">
								<input type="text" id="pokok" name="simpanan_pokok" class="form-control" value="<?= $agt['simpanan_pokok']; ?>" readonly>
								<label for="pokok">Simpanan Pokok</label>
							</div>
							<div class="input-group input-group-sm form-floating mb-3">
							  <input type="date" class="form-control" id="tgl_entry" name="tgl_entry" value="<?= $agt['tgl_entry']; ?>" readonly>
							  <label for="tgl_entry">Tanggal Entry</label>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="input-group input-group-sm mb-3">
					  <button class="btn btn-primary" type="submit" name="update">Update</button>
					  <a href="?us=members" class="btn btn-primary" title="Kembli ke Table User">Cencel</a>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<!-- <script>
function sum() {
      var pokok = document.getElementById('pokok').value;
      var wajib = document.getElementById('wajib').value;
      var sukarela = document.getElementById('sukarela').value;
      var result = parseInt(pokok) + parseInt(wajib) + parseInt(sukarela);
         document.getElementById('saldo').value = result;
}
</script> -->

<?php
}else{
	echo "Sorry";
}

}else{
	echo "Sorry";
}

if (isset($_POST['update'])) {
	$id_anggota = $_POST['id_anggota'];
	$id_user = $_POST['id_user'];
	$tgl_join = $_POST['tgl_join'];
	$nm = $_POST['nama_lengkap'];
	$tmp_lahir = $_POST['tempat_lahir'];
	$tgl_lahir = $_POST['tgl_lahir'];
	$almt = $_POST['alamat_sekarang'];
	$no_telpn = $_POST['no_telpn'];

	$sqledit = mysqli_query($koneksi, "update tb_anggota set tgl_join = '$tgl_join', nama_lengkap = '$nm', tempat_lahir = '$tmp_lahir', tgl_lahir = '$tgl_lahir', alamat_sekarang = '$almt', no_telpn = '$no_telpn' where id_user = '$id_user' and id_anggota = '$id_anggota'");
	if ($sqledit) {
		echo "<script>
			alert('Kartu Member berhasil diupdate.');
			document.location.href = '?us=members';
			</script>";
	}else{
		echo "<script>
			alert('Kartu Member gagal diupdate.');
			document.location.href = '?us=members';
			</script>";
	}
}
?>