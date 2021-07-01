<?php 
require_once("../../assets/koneksi.php");

if (isset($_POST['id_anggota'])) {
	$id_anggota = $_POST['id_anggota'];

	$sql = mysqli_query($koneksi, "select *, timestampdiff(month,tgl_join,now()) as lama_join from tb_anggota where id_anggota = '".$id_anggota."'");
	$data = mysqli_fetch_array($sql);
	echo $data['lama_join'];

	// if ($data['lama_join'] >= 24) {
	// 	echo "15000000";
	// }else if($data['lama_join'] >= 7 && $data['lama_join'] <= 24){
	// 	echo "4000000";
	// }else if($data['lama_join'] >= 3 && $data['lama_join'] <= 7){
	// 	echo "1500000";
	// }
}else if(isset($_POST['id'])){
	$id = $_POST['id'];

	$sql = mysqli_query($koneksi, "select *, timestampdiff(month,tgl_join,now()) as lama_join from tb_anggota where id_anggota = '".$id."'");
	$data = mysqli_fetch_array($sql);
	// echo $data['lama_join'];

	$array = array('3','6','10','12','15');
	foreach ($array as $key) {
		if ($data['lama_join'] >= 24) {
		echo "<option value=".$key.">".$key.' bulan'."</option>";	
		}else if($data['lama_join'] >= 7 && $data['lama_join'] <= 24){
			if ($key != 15) {
				echo "<option value=".$key.">".$key.' bulan'."</option>";	
			}
		}else if($data['lama_join'] >= 3 && $data['lama_join'] <=7){
			if ($key == 6) {
				echo "<option value=".$key.">".$key.' bulan'."</option>";
			}
		}else if($data['lama_join'] <= 3){
			echo "<option>Anggota tidak valid!!!</option>";
		}
	}
}
?>