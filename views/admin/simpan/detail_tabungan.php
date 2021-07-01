<div class="card alert-info mb-2">
	<h7 class="m-2"><i>Detail>> Tabungan</i></h7>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="row">
			<div class="col-sm-12">
				<div class="card alert-secondary p-1">
					<form action="" method="post">
					<div class="row">
						<div class="col-sm-4">
							<input type="text" name="id_anggota" value="<?= $_GET['id']; ?>" hidden>
							<div class="input-group input-group-sm mb-1 form-floating">
							  <select class="js-example-basic-single form-control" name="tahun" id="floatingSelect1" required aria-label="Floating label select example">
							  	<?php 
							  	$sql = mysqli_query($koneksi, "select year(tgl_simpan) as tahun from tb_simpanan where id_anggota = '".$_GET['id']."' group by year(tgl_simpan)");
							  	$cek = mysqli_num_rows($sql);
							  	if ($cek > 0) {
							  		while ($d = mysqli_fetch_array($sql)) {
								  		echo "<option value='".$d['tahun']."'>".$d['tahun']."</option>";
								  	}	
							  	}else{
							  		echo "<option value='0'>Data Kosong</option>";
							  	}
							  	?>
							  </select>
							</div>
						</div>
						<div class="col-sm-3">
							<button class="btn btn-primary" type="submit" name="search"><span data-feather="search"></span></button>
						</div>		
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php 
if (isset($_POST['search'])) {
	$tahun = $_POST['tahun'];
	$id_agt = $_POST['id_anggota'];
	$show = mysqli_query($koneksi, "select * from tb_anggota x inner join tb_simpanan y on y.id_anggota = x.id_anggota where x.id_anggota = '$id_agt' and year(tgl_simpan) = '".$tahun."'");
	$s = mysqli_fetch_array($show);
	$check = mysqli_num_rows($show);
	if ($check > 0) {
	
	?>
	<div class="row pt-2" style="font-size: 12px;">
		<div class="col-sm-6">
			<div class="table-responsive">
				<table class="display table table-bordered">
					<thead>
						<tr><th>ID Anggota</th><td><?= $s['id_anggota']; ?></td></tr>
						<tr><th>Nama</th><td><?= $s['nama_lengkap']; ?></td></tr>
						<tr><th>Tgl Lahir</th><td><?= $s['tgl_lahir']; ?></td></tr>
						<tr><th>Tempat Lahir</th><td><?= $s['tempat_lahir']; ?></td></tr>
					</thead>
				</table>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="table-responsive">
				<table class="display table table-bordered">
					<thead>
						<tr><th>Alamat</th><td><?= $s['alamat_sekarang']; ?></td></tr>
						<tr><th>No Telpn</th><td><?= $s['no_telpn']; ?></td></tr>
						<tr><th>Pokok</th><td><?= rupiah($s['simpanan_pokok']); ?></td></tr>
						<tr><th>Tahun</th><td><?= $tahun; ?></td></tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
	<div class="row" style="font-size: 12px;">
		<div class="col-sm-5">
			<div class="card table-responsive p-1 bg-light">
				<h5 class="card-title">Jumlah Total Simpanan Tahun : <b><?= $tahun ?></b></h5>
				<table class="display table table-bordered table-ligh">
					<tbody>
						<?php 
						$totjumlah = mysqli_query($koneksi, "SELECT SUM(jumlah_wajib) AS wajib, SUM(jumlah_sukarela) AS sukarela, id_user, id_anggota FROM tb_simpanan WHERE id_anggota = '$id_agt' and year(tgl_simpan) = '$tahun'");
						while ($tjum = mysqli_fetch_array($totjumlah)) { ?>
							<tr><th>Simpanan Wajib</th><td>:</td><td class="text-end"><?= rupiah($tjum['wajib']); ?></td></tr>
							<tr><th>Simpanan Sukarela</th><td>:</td><td class="text-end"><?= rupiah($tjum['sukarela']); ?></td></tr>
							<tr><td class="text-end">Jumlah</td><td>:</td><th class="text-end"><?= rupiah($tjum['wajib'] + $tjum['sukarela']); ?></th></tr>
							<tr><th>Simpanan Pokok</th><td>:</td><td class="text-end"><?= rupiah($s['simpanan_pokok']); ?></td></tr>
							<tr><td class="text-end">Jumlah total</td><td>:</td><th class="text-end"><?= rupiah($tjum['wajib'] + $tjum['sukarela'] + $s['simpanan_pokok']); ?></th></tr>
						<?php }
						?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-sm-7">
		<div class="table-responsive">
			<table class="display table table-bordered table-light" style="width: 100%;">
				<thead class="text-center table-info">
					<tr>
						<th rowspan="2">Month</th>
						<th colspan="2">Simpanan</th>
					</tr>
					<tr>
						<th>Wajib</th>
						<th>Sukarela</th>
					</tr>		
				</thead>
				<tbody>
					<?php 
					$bln = array('1' => 'Januari','2' => 'Februari','3' => 'Maret','4' => 'April','5' => 'Mei','6' => 'Juni','7' => 'Juli','8' => 'Agustus','9' => 'September','10' => 'Oktober','11' => 'November','12' => 'Desember');
					foreach ($bln as $k => $v) {
						$smp = mysqli_query($koneksi, "select month(tgl_simpan) AS bln, sum(jumlah_wajib) as wajib, sum(jumlah_sukarela) as sukarela, id_user, id_anggota from tb_simpanan where id_anggota = '$id_agt' and month(tgl_simpan) = '$k' and year(tgl_simpan) = '$tahun' group by month(tgl_simpan)");
						$c = mysqli_fetch_array($smp);
						echo "<tr>";
						echo "<td class='text-center table-primary'>".$k." - ".$v."</td>";
						if (isset($c['bln']) == 1 ) {
							echo "<td class='text-end'>".rupiah($c['wajib'])."</td>";
							echo "<td class='text-end'>".rupiah($c['sukarela'])."</td>";
						}else if(isset($c['bln']) == 0){
							echo "<td></td>";
							echo "<td></td>";
						}
						echo "</tr>";
					}
					?>
				</tbody>
				<tfoot>
					<tr class="table-info">
						<?php 
						$jml = mysqli_query($koneksi, "SELECT SUM(jumlah_wajib) AS wajib, SUM(jumlah_sukarela) AS sukarela, id_user, id_anggota FROM tb_simpanan WHERE id_anggota = '$id_agt' and year(tgl_simpan) = '$tahun'");
						while ($j = mysqli_fetch_array($jml)) { ?>
							<th class="text-end">Total Simpanan</th>
							<th class='text-end'><?= rupiah($j['wajib']); ?></th>
							<th class='text-end'><?= rupiah($j['sukarela']); ?></th>		
						<?php }
						?>
					</tr>
				</tfoot>
			</table>
		</div>			
		</div>
	</div>
	
<?php 
	}else{
		echo "<h5>Data Tidak Ditemukan.</h5>";
	}

}
?>