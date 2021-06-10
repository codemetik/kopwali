<?php
// mencari kode barang dengan nilai paling besar
$query = "SELECT max(id_user) as maxKode FROM tb_user";
$hasil = mysqli_query($koneksi,$query);
$data = mysqli_fetch_array($hasil);
$kodeUser = $data['maxKode'];

// mengambil angka atau bilangan dalam kode anggota terbesar,
// dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
// misal 'BRG001', akan diambil '001'
// setelah substring bilangan diambil lantas dicasting menjadi integer
$noUrut = (int) substr($kodeUser, 2, 3);

// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$noUrut++;

// membentuk kode anggota baru
// perintah sprintf("%03s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
// misal sprintf("%03s", 12); maka akan dihasilkan '012'
// atau misal sprintf("%03s", 1); maka akan dihasilkan string '001'
$char = "US";
$kodeUser = $char . sprintf("%03s", $noUrut);
// echo $kodeBarang;


//ambil code untuk tb_rols
$quer = "SELECT max(id_rolsuser) as maxrols FROM tb_rols";
$hs = mysqli_query($koneksi,$quer);
$datahs = mysqli_fetch_array($hs);
$koderol = $datahs['maxrols'];
$norol = (int) substr($koderol, 1, 4);
$norol++;
$charrol = "R";
$koderol = $charrol . sprintf("%04s", $norol);

function get_code($koneksi){
	$query = "SELECT max(id_anggota) as maxKode FROM tb_anggota";
	$hasil = mysqli_query($koneksi,$query);
	$data = mysqli_fetch_array($hasil);
	$kodeUser = $data['maxKode'];
	$noUrut = (int) substr($kodeUser, 3, 4);
	$noUrut++;
	$char = "MBR";
	$kodeUser = $char . sprintf("%04s", $noUrut);
	echo $kodeUser;
}

function simpanan($jenis, $koneksi){
	$sql = mysqli_query($koneksi, "select ".$jenis." as jenis from tb_jenis_simpanan");
	$data = mysqli_fetch_array($sql);
	echo $data['jenis'];
}

function balance($koneksi){
	$sql = mysqli_query($koneksi, "select * from tb_jenis_simpanan");
	$data = mysqli_fetch_array($sql);
	$hasil = $data['pokok'] + $data['wajib'];
	echo $hasil;
}
?>