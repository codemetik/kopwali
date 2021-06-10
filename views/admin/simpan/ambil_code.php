<?php 
function get_code($koneksi){
	// mencari kode barang dengan nilai paling besar
$query = "SELECT max(id_simpanan) as maxKode FROM tb_simpanan";
$hasil = mysqli_query($koneksi,$query);
$data = mysqli_fetch_array($hasil);
$kodeUser = $data['maxKode'];

// mengambil angka atau bilangan dalam kode anggota terbesar,
// dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
// misal 'BRG001', akan diambil '001'
// setelah substring bilangan diambil lantas dicasting menjadi integer
$noUrut = (int) substr($kodeUser, 3, 3);

// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$noUrut++;

// membentuk kode anggota baru
// perintah sprintf("%03s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
// misal sprintf("%03s", 12); maka akan dihasilkan '012'
// atau misal sprintf("%03s", 1); maka akan dihasilkan string '001'
$char = "SIM";
$kodeUser = $char . sprintf("%03s", $noUrut);
// echo $kodeBarang;
echo $kodeUser;
}

function get_jenis_simpanan($name, $koneksi){
	$jns_simpan = mysqli_query($koneksi, "select * from tb_jenis_simpanan");
	$djs = mysqli_fetch_array($jns_simpan);
	echo $djs[$name];
}
?>