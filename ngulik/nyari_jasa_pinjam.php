<?php 
include "../assets/koneksi.php";

$sql = mysqli_query($koneksi, "select * from tb_pinjaman X INNER JOIN tb_bunga Y ON y.id_bunga = x.id_bunga where id_anggota = 'MBR0003'");
// $ten[] = '';
foreach ($sql as $key => $value) {
	$tenor = $value['tenor'];
	$jumlh = $value['jumlah_pinjaman'];
	$jenis_bunga = $value['jenis_bunga'];
	$bunga = $value['jumlah_bunga'];
}

if ($jenis_bunga == 'flat') {
	$no=1;
	for ($i=0; $i < $tenor; $i++) { 
		echo $flat[] = $jumlh*$bunga/100/$tenor."<br>";
	}	
}else if($jenis_bunga == 'efektif'){
	$no=1;
	for ($i=0; $i < $tenor; $i++) { 
		echo $flat[] = ($jumlh-($no++-1)*($jumlh/$tenor))*$bunga/100/$tenor."<br>";
	}
}

echo "<br>".array_sum($flat);
echo "<br> Data Pinjaman"
?>
<table border="1">
	<tr>
		<th>ID Pinjaman</th>
		<th>Jumlah Pinjaman</th>
		<th>Jenis Bunga</th>
		<th>Jumlah Bunga</th>
		<th>Tenor</th>
		<th>Angsuran pokok /bulan</th>
		<th>Bunga /bulan</th>
		<th>Jasa Pinjaman</th>
		<th>SHU Pinjaman</th>
	</tr>
	<?php 
	$sqli = mysqli_query($koneksi, "select * from tb_pinjaman X INNER JOIN tb_bunga Y ON y.id_bunga = x.id_bunga");
	foreach ($sqli as $ke => $valu) { ?>
	<tr>
		<td><?= $valu['id_pinjaman'];?></td>
		<td><?= $valu['jumlah_pinjaman'];?></td>
		<td><?= $valu['jenis_bunga'];?></td>
		<td><?= $valu['jumlah_bunga'];?></td>
		<td><?= $valu['tenor']; ?></td>
		<td>
			<?= rupiah(round($valu['jumlah_pinjaman']/$valu['tenor'])); ?>
		</td>
		<td>
			<?php
			if ($valu['jenis_bunga'] == 'flat') {
				echo "<select>";
				$no=1;
				for ($i=0; $i < $valu['tenor']; $i++) { 
					$sqle = mysqli_query($koneksi, "SELECT id_pinjaman, id_anggota, MAX(tenor_ke) AS max_tenor FROM tb_pengembalian where id_pinjaman = '".$valu['id_pinjaman']."' GROUP BY id_pinjaman");
					$d = mysqli_fetch_array($sqle);
					if ($d['max_tenor'] == $no) {
						$select = "selected";
					}else{
						$select = "";
					}
					echo "<option ".$select."> bulan ke-".$no++." ".rupiah($valu['jumlah_pinjaman']*$valu['jumlah_bunga']/100/$valu['tenor'])."</option>";
					// $bunga[] = $valu['jumlah_pinjaman']*$valu['jumlah_bunga']/100/$valu['tenor'];
				}
				echo "</select>";
			}else if($valu['jenis_bunga'] == 'efektif'){
				echo "<select>";
				$no=1;
				for ($i=0; $i < $valu['tenor']; $i++) { 
					$sqle = mysqli_query($koneksi, "SELECT id_pinjaman, id_anggota, MAX(tenor_ke) AS max_tenor FROM tb_pengembalian where id_pinjaman = '".$valu['id_pinjaman']."' GROUP BY id_pinjaman");
					$d = mysqli_fetch_array($sqle);
					if ($d['max_tenor'] == $no) {
						$select = "selected";
					}else{
						$select = "";
					}
					echo "<option ".$select."> bulan ke-".$no." ".rupiah(($valu['jumlah_pinjaman']-($no++-1)*($valu['jumlah_pinjaman']/$valu['tenor']))*$valu['jumlah_bunga']/100/$valu['tenor'])."</option>";
					// $bunga[] = ($valu['jumlah_pinjaman']-($no++-1)*($valu['jumlah_pinjaman']/$valu['tenor']))*$valu['jumlah_bunga']/100/$valu['tenor'];
				}
				echo "</select>";
			}
			?>
		</td>
		<td>
			<?php 
			if ($valu['jenis_bunga'] == 'flat') {
				$no=1;
				for ($i=0; $i < $valu['tenor']; $i++) { 
					// echo "<option> bulan ke-".$no++." ".rupiah($valu['jumlah_pinjaman']*$valu['jumlah_bunga']/100/$valu['tenor'])."</option>";
					$ang1[] = $valu['jumlah_pinjaman']/$valu['tenor'];
					$b1[] = $valu['jumlah_pinjaman']*$valu['jumlah_bunga']/100/$valu['tenor'];
				}	
				echo array_sum($b1);
			}else if($valu['jenis_bunga'] == 'efektif'){
				$no=1;
				for ($i=0; $i < $valu['tenor']; $i++) { 
					// echo "<option> bulan ke-".$no." ".rupiah(($valu['jumlah_pinjaman']-($no++-1)*($valu['jumlah_pinjaman']/$valu['tenor']))*$valu['jumlah_bunga']/100/$valu['tenor'])."</option>";
					$ang2[] = $valu['jumlah_pinjaman']/$valu['tenor'];
					$b2[] = ($valu['jumlah_pinjaman']-($no++-1)*($valu['jumlah_pinjaman']/$valu['tenor']))*$valu['jumlah_bunga']/100/$valu['tenor'];
				}
				echo array_sum($b2);
			}
			?>
		</td>
		<td>
			<?php 
			if ($valu['jenis_bunga'] == 'flat') {
				$no=1;
				for ($i=0; $i < $valu['tenor']; $i++) { 
					// echo "<option> bulan ke-".$no++." ".rupiah($valu['jumlah_pinjaman']*$valu['jumlah_bunga']/100/$valu['tenor'])."</option>";
					$ang1[] = $valu['jumlah_pinjaman']/$valu['tenor'];
					$b1[] = $valu['jumlah_pinjaman']*$valu['jumlah_bunga']/100/$valu['tenor'];
				}	
				echo round(array_sum($b1)*0.105);
			}else if($valu['jenis_bunga'] == 'efektif'){
				$no=1;
				for ($i=0; $i < $valu['tenor']; $i++) { 
					// echo "<option> bulan ke-".$no." ".rupiah(($valu['jumlah_pinjaman']-($no++-1)*($valu['jumlah_pinjaman']/$valu['tenor']))*$valu['jumlah_bunga']/100/$valu['tenor'])."</option>";
					$ang2[] = $valu['jumlah_pinjaman']/$valu['tenor'];
					$b2[] = ($valu['jumlah_pinjaman']-($no++-1)*($valu['jumlah_pinjaman']/$valu['tenor']))*$valu['jumlah_bunga']/100/$valu['tenor'];
				}
				echo round(array_sum($b2)*0.105);
			}
			?>
		</td>
	</tr>
	<?php }
	?>
</table>
<br><hr>