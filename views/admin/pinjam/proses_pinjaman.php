<?php 
require_once("../../../assets/koneksi.php");

if (isset($_POST['simpan_data'])) {
	$id_pinjaman = $_POST['id_pinjaman'];
	$id_anggota = $_POST['id_anggota'];
	$tgl_pinjam = $_POST['tgl_pinjam'];
	$tgl_entry = $_POST['tgl_entry'];
	$id_bunga = $_POST['id_bunga'];
	$id_jenis_pinjaman = $_POST['id_jenis_pinjaman'];
	$jml_pinjaman = $_POST['jml_pinjaman'];
	$tenor = $_POST['tenor'];
	$cicilan_pokok = $_POST['cicilan_pokok'];

	$sqlbunga = mysqli_query($koneksi, "select * from tb_bunga where id_bunga = '$id_bunga'");
	$bunga = mysqli_fetch_array($sqlbunga);
	$sqljenis = mysqli_query($koneksi, "select * from tb_jenis_pinjaman where id_jenis_pinjaman = '$id_jenis_pinjaman'");
	$jenis = mysqli_fetch_array($sqljenis);



	$query = mysqli_query($koneksi, "insert into tb_pinjaman(id_pinjaman, id_anggota, tgl_pinjam, tgl_entry, id_bunga, id_jenis_pinjaman, jumlah_pinjaman, tenor) values('$id_pinjaman','$id_anggota','$tgl_pinjam','$tgl_entry','$id_bunga','$id_jenis_pinjaman','$jml_pinjaman','$tenor')");
	if ($query) {
		echo "<script>
		alert('Data berhasil disimpan!');
		document.location.href = '../../admin/pinjaman?pin=Pinjaman';
		</script>";
	}else{
		echo "<script>
		alert('Data gagal disimpan!');
		document.location.href = '../../admin/pinjaman?pin=Pinjaman';
		</script>";
	}	

}
?>