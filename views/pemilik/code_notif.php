<?php 
// require_once('../../assets/koneksi.php');

function notif_user($koneksi){
	$sql = mysqli_query($koneksi, "select * from tb_user");
	$count = mysqli_num_rows($sql);
	echo $count;
}
?>