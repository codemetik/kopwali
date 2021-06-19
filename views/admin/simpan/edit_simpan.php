<?php 
if (isset($_GET['id'])) {
	$id = $_GET['id'];

	$sqlshow = mysqli_query($koneksi, "select * from tb_simpanan x inner join tb_user y on y.id_user = x.id_user where id_simpanan = '$id'");
	$ds = mysqli_fetch_array($sqlshow);

	$dtjenis = explode(", ", $ds['jenis_simpanan']);

	$jns_simpan = mysqli_query($koneksi, "select * from tb_jenis_simpanan");
	$djs = mysqli_fetch_array($jns_simpan);

	if ($ds['jumlah_wajib'] == '0') {
		$dis = 'readonly';
	}else if ($ds['jumlah_wajib'] >= '0') {
		$dis = 'readonly';
	}

	if ($ds['jumlah_sukarela'] == '0') {
		$disk = 'readonly';
	}else if ($ds['jumlah_sukarela'] >= '0') {
		$disk = '';
	}
}
?>
<div class="card">
	<div class="card-header">
		<h5 class="card-title">Edit Simpanan</h5>
	</div>
	<div class="card-body">
		<form action="" method="post">
			<div class="row">
				<div class="col-sm-4">
					<div class="input-group input-group-sm mb-1">
					  <input type="text" class="form-control" name="id_simpanan" readonly value="<?= $id; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
					  <input type="date" class="form-control" name="tgl_simpan" value="<?= $ds['tgl_simpan'] ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
					<input type="text" name="id_user" class="form-control" value="<?= $ds['id_user']; ?>" readonly>
					</div>
					<div class="input-group input-group-sm mb-1">
					<input type="text" name="user" class="form-control" value="<?= $ds['user']; ?>" readonly>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="card">
						<div class="card-header">
							Jenis Simpanan
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-sm-6">
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="checkbox" id="wjb" name="jenis[]" onclick="run1(this)" value="wajib" <?php if (in_array("wajib", $dtjenis)) echo "checked";?> >
								  <label class="form-check-label" for="wjb">Wajib</label>
								</div>
								<div class="input-group input-group-sm mb-1">
								  <input type="text" class="form-control" name="wajib" id="wajib" required="enabled" <?= $dis; ?> value="<?= $ds['jumlah_wajib']; ?>">
								</div>
								</div>
								<div class="col-sm-6">
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="checkbox" id="skr" name="jenis[]" onclick="run2(this)" value="sukarela" <?php if (in_array("sukarela", $dtjenis)) echo "checked";?> >
								  <label class="form-check-label" for="skr">Sukarela</label>
								</div>
								<div class="input-group input-group-sm mb-1">
								  <input type="text" class="form-control" name="sukarela" id="sukarela" required="enabled" <?= $disk; ?> value="<?= $ds['jumlah_sukarela']; ?>" >
								</div>	
								</div>
							</div>
						</div>
					</div>	
				</div>
				<div class="col-sm-4">
					<button type="submit" name="simpan" class="btn-md btn-primary"><span data-feather="save"></span> Simpan Perubahan</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	function run1(wjb) {
		var wajib = document.getElementById('wajib');
		var disabled = 'disabled';
		var enabled = enabled;
		wajib.disabled = wjb.checked ? false:true;
		if (!wajib.disabled) {
			wajib.focus();
			document.getElementById('wajib').value = <?= $djs['wajib']; ?>;
		}else if(wajib.disabled){
			document.getElementById('wajib').value = '0';
		}
	}
	function run2(skr) {
		var sukarela = document.getElementById('sukarela');
		var disabled = 'disabled';
		var enabled = enabled;
		sukarela.disabled = skr.checked ? false:true;
		if (!sukarela.disabled) {
			sukarela.focus();
			document.getElementById('sukarela').value = <?= $ds['jumlah_sukarela']; ?>;
		}else if(sukarela.disabled){
			document.getElementById('sukarela').value = '0';
		}
	}
</script>

<?php 
if (isset($_POST['simpan'])) {
	$id_simpanan = $_POST['id_simpanan'];
	$tgl_simpan = $_POST['tgl_simpan'];
	$jenis = implode(", ", $_POST['jenis']);

	if (!empty($_POST['wajib'])) {
		$jumlah_wajib = $_POST['wajib'];
	}else{
		$jumlah_wajib = '0';
	}

	if (!empty($_POST['sukarela'])) {
		$jumlah_sukarela = $_POST['sukarela'];
	}else{
		$jumlah_sukarela = '0';
	}

	$id_user = $_POST['id_user'];

	$cekuser = mysqli_query($koneksi, "select * from tb_anggota where id_user = '$id_user'");
	$id_anggota = mysqli_fetch_array($cekuser);

	$update = mysqli_query($koneksi, "update tb_simpanan set id_simpanan = '$id_simpanan', tgl_simpan = '$tgl_simpan', jenis_simpanan = '$jenis', jumlah_wajib = '$jumlah_wajib', jumlah_sukarela = '$jumlah_sukarela' where id_simpanan = '$id_simpanan'");

	if ($update) {
		echo "<script>
		alert('Data berhasil disimpan!');
		document.location.href = 'simpanaan';
		</script>";
	}else{
		echo "<script>
		alert('Data gagal disimpan!');
		document.location.href = 'simpanaan';
		</script>";
	}
}
?>