<?php require_once('ambil_code.php'); ?>
<div class="row">
	<div class="col-sm-12">
	<div class="card mb-3">
		<div class="card-header bg-info">
			<h5 class="card-title">Entry Data Simpanan Anggota</h5>
		</div>
		<div class="card-body">
			<form action="" method="post">
				<div class="row">
					<div class="col-sm-4">
						<div class="input-group input-group-sm mb-1">
						  <input type="text" class="form-control" name="id_simpanan" readonly value="<?php get_code($koneksi); ?>">
						</div>
						<div class="form-floating mb-1">
						  <input type="date" class="form-control" id="tgl_simpan" name="tgl_simpan" required>
						  <label for="tgl_simpan">Tanggal Simpan</label>
						</div>
						<div class="input-group input-group-sm mb-1">
						<select class="js-example-basic-single form-control" name="id_user" id="floatingSelect" required aria-label="Floating label select example">
						  <?php 
						  $sql = mysqli_query($koneksi, "select * from tb_user");
						  while ($data = mysqli_fetch_array($sql)) { 
						  	$anggota = mysqli_query($koneksi, "select *, TIMESTAMPDIFF(MONTH,tgl_join,NOW()) AS lama_join from tb_anggota where id_user = '".$data['id_user']."'");
						  	$datagt = mysqli_fetch_array($anggota);
						  	if ($data['id_user'] == $datagt['id_user']) {?>
						  		<option value="<?= $data['id_user'] ?>"><?= $data['id_user']; ?> || <?= $data['user'].' || '.$datagt['lama_join'].' bulan'; ?> </option>
						  	<?php }else{ ?>

						  	<?php }
						  }
						  ?>
						</select>
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
									  <input class="form-check-input" type="checkbox" id="wjb" name="jenis[]" onclick="run1(this)" value="wajib">
									  <label class="form-check-label" for="wjb">Wajib</label>
									</div>
									<div class="input-group input-group-sm mb-1">
									  <input type="text" class="form-control" name="wajib" id="wajib" placeholder="Rp. ..." disabled="disabled" required="enabled">
									</div>
									</div>
									<div class="col-sm-6">
									<div class="form-check form-check-inline">
									  <input class="form-check-input" type="checkbox" id="skr" name="jenis[]" onclick="run2(this)" value="sukarela">
									  <label class="form-check-label" for="skr">Sukarela</label>
									</div>
									<div class="input-group input-group-sm mb-1">
									  <input type="text" class="form-control" name="sukarela" id="sukarela" placeholder="Rp. ..." disabled="disabled" required="enabled">
									</div>	
									</div>
								</div>
							</div>
						</div>	
					</div>
					<div class="col-sm-4">
						<button type="submit" name="simpan" class="btn-md btn-primary"><span data-feather="save"></span> Simpan</button>
					</div>
				</div>
			</form>
		</div>
	</div>	
	</div>
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header bg-info">
				<h5 class="card-title">Table Data Simpanan</h5>
			</div>
			<div class="card-body">
				<div class="table-responsive">
		<h5><a target="_blank" href="../admin/simpan/download/download_simpanan.php" class="text-center"><button class="btn-md btn-primary"><span data-feather="download"></span> Export ke Excel</button></a></h5>
		<table id="example" class="display table table-bordered" style="width:100%; font-size: 12px;">
			<thead class="text-center table-info">
				<tr>
					<th>No</th>
					<th>ID Simpanan</th>
					<th>ID User</th>
					<th>Nama</th>
					<th>Jenis Simpanan</th>
					<th>Simpanan wajib</th>
					<th>Simpanan Sukarela</th>
					<th>Tgl Simpan</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$no=1;
				$sqli = mysqli_query($koneksi, "select * from tb_simpanan x inner join tb_anggota y on y.id_user = x.id_user group by id_simpanan desc");
				while ($dts = mysqli_fetch_array($sqli)) { ?>
				<tr>
					<td><?= $no++; ?></td>
					<td><?= $dts['id_simpanan']; ?></td>
					<td><?= $dts['id_user']; ?></td>
					<td><?= $dts['nama_lengkap']; ?></td>
					<td><?= $dts['jenis_simpanan']; ?></td>
					<td><?= $dts['jumlah_wajib']; ?></td>
					<td><?= $dts['jumlah_sukarela']; ?></td>
					<td><?= $dts['tgl_simpan']; ?></td>
					<td><a href="?sim=edit_simpan&id=<?= $dts['id_simpanan']; ?>"><span data-feather='edit'></span></a> | <a href="../admin/simpan/delete/delete_simpanan.php?id=<?= $dts['id_simpanan']; ?>" onclick="return confirm('Yakin mau di hapus?')"><span data-feather='delete'></span></a></td>
				</tr>
				<?php }
				?>
			</tbody>
			<tfoot class="text-center table-info">
				<tr>
					<th>No</th>
					<th>ID Simpanan</th>
					<th>ID User</th>
					<th>Nama</th>
					<th>Jenis Simpanan</th>
					<th>Simpanan wajib</th>
					<th>Simpanan Sukarela</th>
					<th>Tgl Simpan</th>
					<th>Action</th>
				</tr>
			</tfoot>
		</table>
	</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function run1(wjb) {
		var wajib = document.getElementById('wajib');
		wajib.disabled = wjb.checked ? false:true;
		if (!wajib.disabled) {
			wajib.focus();
			document.getElementById('wajib').value = <?php get_jenis_simpanan("wajib", $koneksi); ?> 
			$("#wajib").prop("readonly", true);
		}else if(wajib.disabled){
			document.getElementById('wajib').value = '0';
		}
	}
	function run2(skr) {
		var sukarela = document.getElementById('sukarela');
		sukarela.disabled = skr.checked ? false:true;
		if (!sukarela.disabled) {
			sukarela.focus();
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

	$insert = mysqli_query($koneksi, "insert into tb_simpanan(id_simpanan, tgl_simpan, jenis_simpanan, jumlah_wajib, jumlah_sukarela, id_user, id_anggota) values('$id_simpanan','$tgl_simpan','$jenis','$jumlah_wajib','$jumlah_sukarela','$id_user','".$id_anggota['id_anggota']."')");

	if ($insert) {
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