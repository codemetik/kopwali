<?php 
include "../assets/koneksi.php";
$sql = mysqli_query($koneksi, "select * from tb_anggota");
// $array[] = '';
while ($isi= mysqli_fetch_array($sql)) {
	$array[] = array(
		'id_anggota' => $isi['id_anggota'],
		'simpan_pokok' => $isi['simpanan_pokok']
	);
	$simpan[] = $isi['simpanan_pokok'];
}
echo "Jumlah Simpanan Pokok: ".rupiah(array_sum($simpan))."<br>";

foreach ($array as $key => $value) {
	echo $value['id_anggota']." - ".$value['simpan_pokok']."</br>";
}
echo "<hr>";
//membuat perulanggan daru angka terakhir
$x = 12500;
while ($x >= 4000) {
	// echo "Urutan ke-".$x."<br>";
	$x -=500;
	$y[] = $x+1;
}
//menjumlahkan isi array yg menghitung mundur.
echo array_sum($y).'<br><hr>';

//membuat array
$ray = array('10000','20000','30000');
foreach ($ray as $keye) {
	echo $keye.", ";
}
//menjumlahkan isi array $ray
echo "= ".array_sum($ray);
echo "<br><hr>";

$sql1 = mysqli_query($koneksi, "SELECT x.id_user, x.id_anggota, nama_lengkap, jumlah_pinjaman, jumlah_bunga, tenor FROM tb_anggota X
LEFT JOIN tb_pinjaman Y ON y.id_anggota = x.id_anggota
LEFT JOIN tb_bunga z ON z.id_bunga = y.id_bunga");
while ($data = mysqli_fetch_array($sql1)) {
	$arraye[] = array(
		'id_anggota' => $data['id_anggota'], 'jumlah_pinjaman' => $data['jumlah_pinjaman'], 'jumlah_bunga' => $data['jumlah_bunga'], 'tenor' => $data['tenor']
	);
}

// echo $array[1]['id_anggota'];

// for ($j=0; $j < $arraye ; $j++) { 
// 	echo $arraye[$j]['id_anggota'];
// }
?>