<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Jenis Simpanan</h5>
			</div>
			<div class="card-body">
				<form action="" method="post">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-floating mb-1">
								<input type="text" name="pokok" id="pokok" class="form-control" placeholder="Principal Saving" value="<?php simpanan("pokok", $koneksi); ?>">
								<label for="pokok">Simpanan Pokok</label>
							</div>
							<div class="form-floating mb-1">
								<input type="text" name="wajib" id="wajib" class="form-control" placeholder="Mandatory Saving" value="<?php simpanan("wajib", $koneksi); ?>">
								<label for="wajib">Simpanan Wajib</label>
							</div>
							<div class="form-floating mb-1">
								<input type="text" name="sukarela" id="sukarela" class="form-control" placeholder="Voluntary Saving" value="<?php simpanan("sukarela", $koneksi); ?>">
								<label for="sukarela">Simpanan Sukarela</label>
							</div>
							<div class="form-group">
								<button type="submit" name="update" class="btn-md btn-primary"><span data-feather="plus"></span>Update</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php 

function simpanan($jenis, $koneksi){
	$sql = mysqli_query($koneksi, "select ".$jenis." as jenis from tb_jenis_simpanan");
	$data = mysqli_fetch_array($sql);
	echo $data['jenis'];
}

if (isset($_POST['update'])) {
	$pokok = $_POST['pokok'];
	$wajin = $_POST['wajib'];
	$sukarela = $_POST['sukarela'];

	$sql = mysqli_query($koneksi, "update tb_jenis_simpanan set pokok = '$pokok', wajib = '$wajin', sukarela = '$sukarela'");
	if ($sql) {
		echo "<script>
			alert('Perubahan simpanan berhasil');
				document.location.href = '?page=settings';
			</script>";
	}else{
		echo "<script>
			alert('Perubahan simpanan gagal');
				document.location.href = '?page=settings';
			</script>";
	}
}
?>