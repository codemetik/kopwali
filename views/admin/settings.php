<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Setting</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php 
    if (!isset($_GET['set'])) {
    	echo "Setting";
    }else{
    	echo $_GET['set'];
    }?></li>
  </ol>
</nav>
<div class="row">
	<div class="col-sm-6 mb-2">
		<div class="card">
			<div class="card-header bg-info">
				<h5 class="card-title">JENIS SIMPANAN ANGGOTA</h5>
			</div>
			<div class="card-body">
				<form action="" method="post">
					<div class="row">
						<div class="col-sm-12">
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
								<button type="submit" name="update_simpanan" class="btn-md btn-primary"><span data-feather="plus"></span>Update Simpanan</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-sm-6 mb-2">
		<div class="card">
			<div class="card-header bg-info">
				<h5 class="card-title">JENIS BUNGA PINJAMAN</h5>
			</div>
			<div class="card-body">
				<form action="" method="post">
					<div class="row">
						<div class="col-sm-12">
							<div class="form-floating mb-1">
								<input type="text" name="flat" id="flat" class="form-control" value="<?php bunga("flat", $koneksi); ?>">
								<label for="flat">Bunga Flat %</label>
							</div>
							<div class="form-floating mb-1">
								<input type="text" name="efektif" id="efektif" class="form-control" value="<?php bunga("efektif", $koneksi); ?>">
								<label for="efektif">Bunga Efektif %</label>
							</div>
							<div class="form-group">
								<button type="submit" name="update_bunga" class="btn-md btn-primary"><span data-feather="plus"></span>Update</button>
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

function bunga($bunga, $koneksi){
	$sql = mysqli_query($koneksi, "select * from tb_bunga where jenis_bunga = '$bunga'");
	$data = mysqli_fetch_array($sql);
	echo $data['jumlah_bunga'];
}

if (isset($_POST['update_simpanan'])) {
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
}else if(isset($_POST['update_bunga'])){
	$flat = $_POST['flat'];
	$efektif = $_POST['efektif'];

	$sql = mysqli_query($koneksi, "update tb_bunga set jumlah_bunga = '$flat' where jenis_bunga = 'flat'");
	$sqli = mysqli_query($koneksi, "update tb_bunga set jumlah_bunga = '$efektif' where jenis_bunga = 'efektif'");

	if ($sql && $sqli) {
		echo "<script>
			alert('Perubahan bunga berhasil');
				document.location.href = '?page=settings';
			</script>";
	}else{
		echo "<script>
			alert('Perubahan bunga gagal');
				document.location.href = '?page=settings';
			</script>";
	}
}
?>