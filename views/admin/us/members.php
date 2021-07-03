<?php
require_once('ambil_code.php');

?>
<div class="row">
<div class="col-sm-12">
<div class="card mb-3">
	<div class="card-header bg-info">
		<h5 class="card-title">Register Members</h5>
	</div>
	<div class="card-body">
		<form action="" method="post">
		<div class="row">
			<div class="col-sm-4">
				<div class="input-group input-group-sm mb-1">
				<select class="js-example-basic-single form-control" name="id_user" required>
					<option>--Pilih--</option>
				  <?php 
				  $sql = mysqli_query($koneksi, "SELECT * FROM tb_user X INNER JOIN tb_rols z ON z.id_user = x.id_user INNER JOIN tb_level_user Y ON y.id_level_user = z.id_level_user WHERE z.id_level_user != 'LV01' AND z.id_level_user != 'LV02'");
				  while ($data = mysqli_fetch_array($sql)) { 
				  	$anggota = mysqli_query($koneksi, "select * from tb_anggota where id_user = '".$data['id_user']."'");
				  	$datagt = mysqli_fetch_array($anggota);
				  	if ($data['id_user'] != $datagt['id_user']) {?>
				  		<option value="<?= $data['id_user'] ?>"><?= $data['id_user']; ?> || <?= $data['user'] ?></option>
				  	<?php }else{ ?>

				  	<?php }
				  }
				  ?>
				</select>
				</div>
				<div class="input-group input-group-sm mb-1">
				  <input type="text" class="form-control" name="id_anggota" value="<?php get_code($koneksi); ?>" readonly>
				</div>
				<div class="input-group input-group-sm mb-1">
				  <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap . ." required>
				</div>
				<div class="input-group input-group-sm mb-1">
				  <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir . ." required>
				</div>
				<div class="form-floating mb-1">
				  <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
				  <label for="tgl_lahir">Tanggal Lahir</label>
				</div>
			</div>
			<div class="col-sm-4">
				<!-- <div class="input-group input-group-sm mb-1">
				  <select class="js-example-basic-single form-control" name="status">
				  	<option value="employees">Employees</option>
				  	<option value="non employees">Non Employees</option>
				  </select>
				</div> -->
				<div class="input-group input-group-sm mb-1">
				  <textarea type="text" class="form-control" name="alamat_sekarang" placeholder="Tempat Tinggal Sekarang . ."></textarea>
				</div>
				<div class="input-group input-group-sm mb-1">
				  <input type="text" class="form-control" name="no_telpn" placeholder="No Telephone /Whatsapp . .">
				</div>
				<div class="form-floating mb-1">
				  <input type="text" class="form-control" name="simpanan_pokok" id="pokok" value="<?php simpanan("pokok", $koneksi); ?>" readonly>
				  <label for="pokok">Simpanan Pokok</label>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-floating mb-1">
					<input type="date" id="tgl_join" name="tgl_join" class="form-control" required>
					<label for="tgl_join">Tanggal Join</label>
				</div>
				<div class="form-floating mb-1">
					<input type="text" id="tgl_entry" name="tgl_entry" class="form-control" value="<?= date('Y-m-d'); ?>" readonly>
					<label for="tgl_entry">Tanggal Entry</label>
				</div>	
			</div>
			<div class="col-sm-4">
				<div class="input-group input-group-sm">
					<button type="submit" name="simpan" class="btn-md btn-primary"><span data-feather="plus"></span> Add Member</button>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>
</div>
<div class="col-sm-12">
	<div class="card">
		<div class="card-header bg-info">
			<h5 class="card-title">Table User Member</h5>
		</div>
		<div class="card-body">
		<div class="col-sm-12 table-responsive">
			<table id="example" class="display table table-bordered" style="width:100%; font-size: 12px;">
		        <thead class="text-center table-info">
		            <tr>
		            	<th>No</th>
		                <th>ID Anggota</th>
		                <th>ID User</th>
		                <th>Nama Lengkap</th>
		                <th>Simpanan Pokok</th>
		                <th>Tanggal Entry</th>
		                <th>Tgl Join</th>
		                <th>Lama Join</th>
		                <th>Option</th>
		            </tr>
		        </thead>
		        <tbody>
		        	<?php 
		        	$no=1;
		        	$sql = mysqli_query($koneksi, "select id_anggota, id_user, nama_lengkap, simpanan_pokok, tgl_entry, tgl_join, timestampdiff(month,tgl_join,NOW()) as lama_join from tb_anggota");
		        	while ($data = mysqli_fetch_array($sql)) {
		        		echo "<tr>
		        				<td>".$no++."</td>
				                <td>".$data['id_anggota']."</td>
				                <td>".$data['id_user']."</td>
				                <td>".$data['nama_lengkap']."</td>
				                <td>".rupiah($data['simpanan_pokok'])."</td>
				                <td>".$data['tgl_entry']."</td>
				                <td>".$data['tgl_join']."</td>
				                <td>".$data['lama_join']." bulan</td>"; ?>
				                <td><a href="?us=update_members&edit=<?= $data['id_user']; ?>"><span data-feather='edit'></span></a> | <a href='?us=members&delete=<?= $data['id_anggota'] ?>' onclick="return confirm('Yakin mau di hapus?')"><span data-feather='delete'></span></a></td>
				            <?php "</tr>";
		        	}
		        	?>
		        </tbody>
		        <tfoot class="text-center table-info">
		            <tr>
		            	<th>No</th>
		                <th>ID Anggota</th>
		                <th>ID User</th>
		                <th>Nama Lengkap</th>
		                <th>Simpanan Pokok</th>
		                <th>Tanggal Entry</th>
		                <th>Tgl Join</th>
		                <th>Lama Join</th>
		                <th>Option</th>
		            </tr>
		        </tfoot>
		    </table>
		</div>		
		</div>
	</div>
</div>
</div>


<?php 
if (isset($_POST['simpan'])) {
	$id_anggota = $_POST['id_anggota'];
	$id_user = $_POST['id_user'];
	$tgl_join = $_POST['tgl_join'];
	$nm = $_POST['nama_lengkap'];
	$tmp_lahir = $_POST['tempat_lahir'];
	$tgl_lahir = $_POST['tgl_lahir'];
	$almt = $_POST['alamat_sekarang'];
	$no_telpn = $_POST['no_telpn'];
	$pokok = $_POST['simpanan_pokok'];
	$tgl_entry = $_POST['tgl_entry'];

	$sql = mysqli_query($koneksi, "select * from tb_anggota where nama_lengkap = '".$nm."'");
	$data = mysqli_fetch_array($sql);
	$cek = mysqli_num_rows($sql);
	if ($data['nama_lengkap'] != $nm) {

		$insert = mysqli_query($koneksi, "insert into tb_anggota(id_anggota, id_user, tgl_join, nama_lengkap, tempat_lahir, tgl_lahir, alamat_sekarang, no_telpn, simpanan_pokok, tgl_entry) values('".$id_anggota."','".$id_user."','".$tgl_join."','".$nm."', '".$tmp_lahir."', '".$tgl_lahir."' ,'".$almt."','".$no_telpn."','".$pokok."','".$tgl_entry."')");
		if ($insert) {
			echo "<script>
			alert('Kartu Member berhasil dibuat.');
			document.location.href = '?us=members';
			</script>";
		}else{
			echo "<script>
			alert('Kartu Member gagal dibuat.');
			document.location.href = '?us=members';
			</script>";
		}

	}else if($data['nama_lengkap'] == $nm){
		echo "<script>
			alert('Nama lengkap sudah ada didalam database. Harap input ulang!');
			document.location.href = '?us=members';
			</script>";
	}

}else if(isset($_GET['delete'])){
	$delete = $_GET['delete'];
	$sql = mysqli_query($koneksi, "delete from tb_anggota where id_anggota = '".$delete."'");
	if ($sql) {
		echo "<script>
		alert('Data berhasil di hapus');
		document.location.href = 'data_user?us=members';
		</script>";
	}else{
		echo "<script>
		alert('Data gagal dihapus');
		document.location.href = 'data_user?us=members';
		</script>";
	}
}
?>