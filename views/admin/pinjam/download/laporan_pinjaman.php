<?php 
require_once("../../../../assets/koneksi.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Download</title>
</head>
<body>
<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data Pinjaman.xls");
	?>
<?php 

if (isset($_GET['tampil'])) {
	$id_pinjaman = $_GET['tampil'];
	
	$pin = mysqli_query($koneksi, "select * from tb_pinjaman where id_pinjaman = '$id_pinjaman'");
	$dpin = mysqli_fetch_array($pin);

	//mengambil data dari t_bunga
	$sqlbunga = mysqli_query($koneksi, "select * from tb_bunga where id_bunga = '".$dpin['id_bunga']."'");
	$bunga = mysqli_fetch_array($sqlbunga);
	//mengambil data dari tb_jenis_pinjaman
	$sqljenis = mysqli_query($koneksi, "select * from tb_jenis_pinjaman where id_jenis_pinjaman = '".$dpin['id_jenis_pinjaman']."'");
	$jenis = mysqli_fetch_array($sqljenis);

	$s = mysqli_query($koneksi, "select max(tenor_ke) as tenor_ke from tb_pengembalian where id_pinjaman = '$id_pinjaman'");
	$d = mysqli_fetch_array($s);

	$siang = mysqli_query($koneksi, "SELECT SUM(jumlah_bayar) AS jml FROM tb_pengembalian WHERE id_pinjaman = '$id_pinjaman'");
	$dsing = mysqli_fetch_array($siang);
	$sqlk = mysqli_query($koneksi, "select * from tb_pengembalian where id_pinjaman = '$id_pinjaman'");
	$dk = mysqli_fetch_array($sqlk);
	$dnum = mysqli_num_rows($sqlk);

	$name = mysqli_query($koneksi, "select * from tb_anggota where id_anggota = '".$dpin['id_anggota']."'");
	$nm = mysqli_fetch_array($name);

}
?>
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Presentasi Angsuran Pinjaman Milik : <?= $nm['nama_lengkap'].'/'.$nm['id_anggota'];  ?></h5>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="table-responsive">
							<table class="display table" style="width: 100%;">
								<thead>
									<tr>
										<th>No</th>
										<th>Cicilan Pokok</th>
										<th>Cicilan Bunga</th>
										<th>Total Cicilan /Bulan</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									//membuat perulangan angsuran sesuai tenor yang ditentukan
									$no=1;
									for ($i=0; $i<$dpin['tenor'] ; $i++) { 
										$nomer = $no++;
										if ($bunga['id_bunga'] == '1') {
											$cp = $dpin['jumlah_pinjaman']/$dpin['tenor']; //cicilan pokok perbulan
											$cb = $dpin['jumlah_pinjaman']*$bunga['jumlah_bunga']/100/$dpin['tenor']; //cicilan bunga perbulan
											$tc = $cp+$cb;

											$tjp = ($dpin['jumlah_pinjaman']/$dpin['tenor'])*$dpin['tenor']; //total cicilan pokok
											$tjb = $cb*$dpin['tenor']; //total cicilan bunga
											$tjc = $tjp+$tjb; ?>
											<tr>
												<td>Bulan Ke <?= $nomer; ?></td>
												<td><?= round($cp); ?></td>
												<td><?= round($cb); ?></td>
												<td><?= round($tc); ?></td>
											</tr>
										<?php }else if($bunga['id_bunga'] == '2'){
											$cp = $dpin['jumlah_pinjaman']/$dpin['tenor']; //cicilan pokok perbulan
											$cb = ($dpin['jumlah_pinjaman']-($nomer - 1)*$cp)*$bunga['jumlah_bunga']/100/$dpin['tenor']; //cicilan bunga perbulan
											$tc = $cp+$cb;

											$tjp = ($dpin['jumlah_pinjaman']/$dpin['tenor'])*$dpin['tenor']; //total cicilan pokok
											$array[] = ($dpin['jumlah_pinjaman']-($nomer - 1)*$cp)*$bunga['jumlah_bunga']/100/$dpin['tenor']; //mencari array ciicilan bunganya
											$tjb = array_sum($array); //menjumlahkan cicilan bunga yang telah di array
											$tjc = $tjp+$tjb; //total jumlah pokok tambah jumlah bunga
											?>
											<tr>
												<td>Bulan Ke <?= $nomer; ?></td>
												<td><?= round($cp); ?></td>
												<td><?= round($cb); ?></td>
												<td><?= round($tc); ?></td>
											</tr>
									<?php }
									}
									?>
								</tbody>
								<tfoot>
									<tr>
										<th>Jumlah</th>
										<th><?= round($tjp); ?></th>
										<th><?= round($tjb); ?></th>
										<th>: <?= round($tjc); ?></th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="table-responsive">
							<?php 
							if ($dnum > 0) { ?>
								<table class="display table" style="width: 100%">
									<thead>
										<tr>
											<th>| Sisa Cicilan</th>
											<th>| Telah dibayar</th>
											<th>| Sisa Hutang</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><?= $dpin['tenor'] - $d['tenor_ke']; ?> bulan</td>
											<td><?= round($dsing['jml']); ?></td>
											<td><?= round($tjc - $dsing['jml']); ?></td>
										</tr>
									</tbody>
								</table>
							<?php }else{
								echo "tidak ada";
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>