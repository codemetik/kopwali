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
	header("Content-Disposition: attachment; filename=Data Member dan Data Tabungan Pokok.xls");
	?>
<div class="col-sm-12 table-responsive">
		<table id="example" class="display table" style="width:100%">
			<thead class="text-center table-dark">
				<tr>
					<th>No</th>
					<th>ID Anggota</th>
					<th>ID User</th>
					<th>Nama</th>
					<th>Tempat Lahit</th>
					<th>Tgl Lahir</th>
					<th>Alamat</th>
					<th>Telpn</th>
					<th>Simpanan Pokok</th>
					<th>Tgl Join</th>
					<th>Tgl Entry</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$no=1;
				$sqli = mysqli_query($koneksi, "select * from tb_anggota");
				while ($dts = mysqli_fetch_array($sqli)) { ?>
				<tr>
					<td><?= $no++; ?></td>
					<td><?= $dts['id_anggota'] ?></td>
					<td><?= $dts['id_user']; ?></td>
					<td><?= $dts['nama_lengkap']; ?></td>
					<td><?= $dts['tempat_lahir']; ?></td>
					<td><?= $dts['tgl_lahir']; ?></td>
					<td><?= $dts['alamat_sekarang']; ?></td>
					<td><?= $dts['no_telpn']; ?></td>
					<td class="bg-dark text-white"><?= $dts['simpanan_pokok']; ?></td>
					<td><?= $dts['tgl_join']; ?></td>
					<td><?= $dts['tgl_entry']; ?></td>
				</tr>
				<?php }
				?>
			</tbody>
		</table>
	</div>
</body>
</html>