<?php 
require_once("../../assets/koneksi.php");
function total_simpanan($koneksi){
	$sqlp = mysqli_query($koneksi, "SELECT SUM(simpanan_pokok) as pokok FROM tb_anggota");
	$pokok = mysqli_fetch_array($sqlp);
	$sqlws = mysqli_query($koneksi, "SELECT x.id_user, x.id_anggota, nama_lengkap, @wjb:=IF(x.id_user = y.id_user, SUM(jumlah_wajib), NULL) AS sum_wajib, @skr:=IF(x.id_user = y.id_user, SUM(jumlah_sukarela), NULL) AS sum_sukarela FROM tb_anggota X LEFT JOIN tb_simpanan Y ON y.id_user = x.id_user");
	$ws = mysqli_fetch_array($sqlws);
	
	echo "Rp. ".number_format($pokok['pokok'] + $ws['sum_wajib'] + $ws['sum_sukarela'],2,',','.');

}

function total_pinjaman($koneksi){
	$sql = mysqli_query($koneksi, "SELECT x.id_user, x.id_anggota, nama_lengkap, simpanan_pokok, 
@wjb:=IF(x.id_user = w.id_user, SUM(jumlah_wajib), '0') AS sum_wajib, 
@skr:=IF(x.id_user = w.id_user, SUM(jumlah_sukarela), '0') AS sum_sukarela, 
IF(x.id_user = w.id_user, simpanan_pokok +SUM(jumlah_wajib)+SUM(jumlah_sukarela), simpanan_pokok) AS total_simpanan, 
jumlah_pinjaman, y.id_bunga,jumlah_bunga, tenor, jumlah_pinjaman/tenor AS cicilan_pokok, 
jumlah_pinjaman*(jumlah_bunga/100/tenor)*tenor AS jasa_pinjaman, jenis_bunga 
FROM tb_anggota X 
LEFT JOIN tb_simpanan w ON w.id_anggota = x.id_anggota 
LEFT JOIN tb_pinjaman Y ON y.id_anggota = x.id_anggota 
LEFT JOIN tb_bunga z ON z.id_bunga = y.id_bunga 
GROUP BY x.id_anggota");
	foreach ($sql as $key => $value) {
		if ($value['jumlah_pinjaman'] == true) {
			$pokok[] = round($value['jumlah_pinjaman']/$value['tenor'])*$value['tenor'];
		}else if($value['jumlah_pinjaman'] == false){
			$pokok[] = 0;
		}

		if ($value['jenis_bunga'] == 'flat') {
			for ($i=0; $i < $value['tenor']; $i++) { 
				$bunga[] = $value['jumlah_pinjaman']*$value['jumlah_bunga']/100/$value['tenor'];
			}
		}else if($value['jenis_bunga'] == 'efektif'){
			$no=1;
			for ($i=0; $i < $value['tenor']; $i++) { 
				$bunga[] = ($value['jumlah_pinjaman']-($no++-1)*($value['jumlah_pinjaman']/$value['tenor']))*$value['jumlah_bunga']/100/$value['tenor'];
			}
		}else{
			$bunga[] = 0;
		}
	}
	$hasil = array_sum($pokok) + array_sum($bunga);
	echo rupiah($hasil);
}

function jmua($koneksi){
	$sql = mysqli_query($koneksi, "SELECT x.id_user, x.id_anggota, nama_lengkap, simpanan_pokok, 
@wjb:=IF(x.id_user = w.id_user, SUM(jumlah_wajib), '0') AS sum_wajib, 
@skr:=IF(x.id_user = w.id_user, SUM(jumlah_sukarela), '0') AS sum_sukarela, 
IF(x.id_user = w.id_user, simpanan_pokok +SUM(jumlah_wajib)+SUM(jumlah_sukarela), simpanan_pokok) AS total_simpanan, 
jumlah_pinjaman, y.id_bunga,jumlah_bunga, tenor, jumlah_pinjaman/tenor AS cicilan_pokok, 
jumlah_pinjaman*(jumlah_bunga/100/tenor)*tenor AS jasa_pinjaman, jenis_bunga 
FROM tb_anggota X 
LEFT JOIN tb_simpanan w ON w.id_anggota = x.id_anggota 
LEFT JOIN tb_pinjaman Y ON y.id_anggota = x.id_anggota 
LEFT JOIN tb_bunga z ON z.id_bunga = y.id_bunga 
GROUP BY x.id_anggota");
	foreach ($sql as $key => $value) {
		$jmua[] = $value['total_simpanan']*0.07;
	}
	echo rupiah(array_sum($jmua));
}

function jusa($koneksi){
	$sql = mysqli_query($koneksi, "SELECT x.id_user, x.id_anggota, nama_lengkap, simpanan_pokok, 
@wjb:=IF(x.id_user = w.id_user, SUM(jumlah_wajib), '0') AS sum_wajib, 
@skr:=IF(x.id_user = w.id_user, SUM(jumlah_sukarela), '0') AS sum_sukarela, 
IF(x.id_user = w.id_user, simpanan_pokok +SUM(jumlah_wajib)+SUM(jumlah_sukarela), simpanan_pokok) AS total_simpanan, 
jumlah_pinjaman, y.id_bunga,jumlah_bunga, tenor, jumlah_pinjaman/tenor AS cicilan_pokok, 
jumlah_pinjaman*(jumlah_bunga/100/tenor)*tenor AS jasa_pinjaman, jenis_bunga 
FROM tb_anggota X 
LEFT JOIN tb_simpanan w ON w.id_anggota = x.id_anggota 
LEFT JOIN tb_pinjaman Y ON y.id_anggota = x.id_anggota 
LEFT JOIN tb_bunga z ON z.id_bunga = y.id_bunga 
GROUP BY x.id_anggota");
	foreach ($sql as $key => $value) {
		if ($value['jenis_bunga'] == 'flat') {
			$no=1;
			for ($i=0; $i < $value['tenor']; $i++) { 
				// echo "<option> bulan ke-".$no++." ".rupiah($valu['jumlah_pinjaman']*$valu['jumlah_bunga']/100/$valu['tenor'])."</option>";
				$ang1[] = $value['jumlah_pinjaman']/$value['tenor'];
				$b1[] = $value['jumlah_pinjaman']*$value['jumlah_bunga']/100/$value['tenor'];
			}	
			$shu_pin = round(array_sum($b1));
		}else if($value['jenis_bunga'] == 'efektif'){
			$no=1;
			for ($i=0; $i < $value['tenor']; $i++) { 
				// echo "<option> bulan ke-".$no." ".rupiah(($valu['jumlah_pinjaman']-($no++-1)*($valu['jumlah_pinjaman']/$valu['tenor']))*$valu['jumlah_bunga']/100/$valu['tenor'])."</option>";
				$ang2[] = $value['jumlah_pinjaman']/$value['tenor'];
				$b2[] = ($value['jumlah_pinjaman']-($no++-1)*($value['jumlah_pinjaman']/$value['tenor']))*$value['jumlah_bunga']/100/$value['tenor'];
			}
			$shu_pin = round(array_sum($b2));
		}else{
			$shu_pin = 0;
		}
	$shu_pinjaman[] = $shu_pin*0.105;
	}
	echo rupiah(array_sum($shu_pinjaman));
}
?>