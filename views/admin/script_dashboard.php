<?php 
require_once("../../assets/koneksi.php");
function total_simpanan($koneksi){
	$sqlp = mysqli_query($koneksi, "SELECT SUM(simpanan_pokok) as pokok FROM tb_anggota");
	$pokok = mysqli_fetch_array($sqlp);
	$sqlws = mysqli_query($koneksi, "SELECT x.id_user, x.id_anggota, nama_lengkap, @wjb:=IF(x.id_user = y.id_user, SUM(jumlah_wajib), NULL) AS sum_wajib, @skr:=IF(x.id_user = y.id_user, SUM(jumlah_sukarela), NULL) AS sum_sukarela FROM tb_anggota X LEFT JOIN tb_simpanan Y ON y.id_user = x.id_user");
	$ws = mysqli_fetch_array($sqlws);
	
	echo "Rp. ".number_format($pokok['pokok'] + $ws['sum_wajib'] + $ws['sum_sukarela'],2,',','.');

}
?>