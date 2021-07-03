<?php 
function pinjaman($koneksi){
	$sql = mysqli_query($koneksi, "SELECT * FROM tb_pinjaman x inner join tb_approv_pinjaman y on y.id_pinjaman = x.id_pinjaman");
	$c = mysqli_num_rows($sql);
	echo $c;

	// echo count($ray);

}

function dis_approv($koneksi){
	$sql = mysqli_query($koneksi, "SELECT * FROM tb_pinjaman x inner join tb_approv_pinjaman y on y.id_pinjaman = x.id_pinjaman where status = 'dis approved'");
	echo mysqli_num_rows($sql);
}

function load_approv($koneksi){
	$sql = mysqli_query($koneksi, "SELECT * FROM tb_pinjaman X LEFT JOIN tb_approv_pinjaman Y ON y.id_pinjaman = x.id_pinjaman where status = 'waithing'");
	echo mysqli_num_rows($sql);
}

function pengembalian($koneksi){
	$sql = mysqli_query($koneksi,"SELECT * FROM tb_pengembalian GROUP BY id_pinjaman");
	echo mysqli_num_rows($sql);
}

function simpanan($koneksi){
	$sql = mysqli_query($koneksi, "SELECT * FROM tb_simpanan WHERE year(tgl_simpan) = year(now())");
	echo mysqli_num_rows($sql);
}
?>