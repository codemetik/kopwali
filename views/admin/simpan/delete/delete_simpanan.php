<?php
include "../../../../assets/koneksi.php";

if (isset($_GET['id'])) {
	$id = $_GET['id'];

	$sql = mysqli_query($koneksi, "delete from tb_simpanan where id_simpanan = '$id'");
	if ($sql) {
		echo "<script>
		alert('Data simpanan berhasil dihapus');
		document.location.href = '../../../admin/simpanaan?sim=simpan';
		</script>";
	}else{
		echo "<script>
		alert('Data simpanan gagal dihapus');
		document.location.href = '../../../admin/simpanaan?sim=simpan';
		</script>";
	}
}
?>