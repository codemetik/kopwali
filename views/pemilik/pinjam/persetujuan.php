<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Persetujuan Pinjaman Anggota</h5>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table id="example" class="display table" style="width: 100%">
						<thead>
							<tr>
								<th>ID Pinjaman</th>
								<th>ID Anggota</th>
								<th>Nama</th>
								<th>Tgl Pinjam</th>
								<th>Tgl Entry</th>
								<th>Jumlah Pinjam</th>
								<th>Bunga</th>
								<th>Jenis Pinjaman</th>
								<th>Approval</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$sqlu = mysqli_query($koneksi, "select * from tb_pinjaman x inner join tb_bunga y on y.id_bunga = x.id_bunga inner join tb_jenis_pinjaman z on z.id_jenis_pinjaman = x.id_jenis_pinjaman inner join tb_anggota w on w.id_anggota = x.id_anggota");
							while ($datau = mysqli_fetch_array($sqlu)) { 
								$ce = mysqli_query($koneksi, "select * from tb_approv_pinjaman where id_pinjaman = '".$datau['id_pinjaman']."'");
								$dc = mysqli_fetch_array($ce);
								if(isset($datau['id_pinjaman']) != isset($dc['id_pinjaman'])) { ?>
									<tr>
										<td><?= $datau['id_pinjaman']; ?></td>
										<td><?= $datau['id_anggota']; ?></td>
										<td><?= $datau['nama_lengkap'];?></td>
										<td><?= $datau['tgl_pinjam']; ?></td>
										<td><?= $datau['tgl_entry']; ?></td>
										<td><?= rupiah($datau['jumlah_pinjaman']); ?></td>
										<td><?= $datau['jenis_bunga']." ".$datau['jumlah_bunga']."% "; ?></td>
										<td><?= $datau['jenis_pinjaman']; ?></td>
										<td>
											<a href="?pag=persetujuan&insert=<?= $datau['id_pinjaman']; ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Setujui Pinjaman">Yes</a> || <a href="?pag=persetujuan&delete=<?= $datau['id_pinjaman']; ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Batal Setujui">No</a>
										</td>
									</tr>
								<?php }
							}
							?>
						</tbody>
						<tfoot>
							<tr>
								<th>ID Pinjaman</th>
								<th>ID Anggota</th>
								<th>Nama</th>
								<th>Tgl Pinjam</th>
								<th>Tgl Entry</th>
								<th>Jumlah Pinjam</th>
								<th>Bunga</th>
								<th>Jenis Pinjaman</th>
								<th>Approval</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<?php 
if (isset($_GET['delete'])) {
	$idpin = $_GET['delete'];

	$sql = mysqli_query($koneksi, "insert into tb_approv_pinjaman(id_pinjaman, tgl_approv, status) values('$idpin','".date('Y-m-d')."','dis approved')");
	if ($sql) {
		echo "<script>
		alert('Data berhasil dihapus!');
		document.location.href = 'pinjaman?pag=persetujuan';
		</script>";
	}else{
		echo "<script>
		alert('Data gagal dihapus!');
		document.location.href = 'pinjaman?pag=persetujuan';
		</script>";
	}
}

if (isset($_GET['insert'])) {
	$idpin = $_GET['insert'];
	$sql = mysqli_query($koneksi, "insert into tb_approv_pinjaman(id_pinjaman, tgl_approv, status) values('$idpin','".date('Y-m-d')."','approved')");
	if ($sql) {
		echo "<script>
		alert('Data berhasil disetujui!');
		document.location.href = 'pinjaman?pag=persetujuan';
		</script>";
	}else{
		echo "<script>
		alert('Data gagal disetujui!');
		document.location.href = 'pinjaman?pag=persetujuan';
		</script>";
	}
}
?>