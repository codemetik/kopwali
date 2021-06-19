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
	header("Content-Disposition: attachment; filename=Data Simpanan.xls");
	?>
<div class="col-sm-12 table-responsive">
		<table id="example" class="display table" style="width:100%">
			<thead>
				<tr>
					<th>ID Simpanan</th>
					<th>ID User</th>
					<th>Nama</th>
					<th>Jenis Simpanan</th>
					<th>Simpanan wajib</th>
					<th>Simpanan Sukarela</th>
					<th>Tgl Simpan</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$sqli = mysqli_query($koneksi, "select * from tb_simpanan x inner join tb_anggota y on y.id_user = x.id_user");
				while ($dts = mysqli_fetch_array($sqli)) { ?>
				<tr>
					<td><?= $dts['id_simpanan']; ?></td>
					<td><?= $dts['id_user']; ?></td>
					<td><?= $dts['nama_lengkap']; ?></td>
					<td><?= $dts['jenis_simpanan']; ?></td>
					<td class="bg-primary"><?= $dts['jumlah_wajib']; ?></td>
					<td><?= $dts['jumlah_sukarela']; ?></td>
					<td><?= $dts['tgl_simpan']; ?></td>
					<td></td>
				</tr>
				<?php }
				?>
			</tbody>
		</table>
	</div>
</body>
</html>