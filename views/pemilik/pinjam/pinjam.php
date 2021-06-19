<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Table Pinjaman</h5>
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
							</tr>
						</thead>
						<tbody>
							<?php 
							$sqlu = mysqli_query($koneksi, "select * from tb_pinjaman x inner join tb_bunga y on y.id_bunga = x.id_bunga inner join tb_jenis_pinjaman z on z.id_jenis_pinjaman = x.id_jenis_pinjaman inner join tb_anggota w on w.id_anggota = x.id_anggota");
							while ($datau = mysqli_fetch_array($sqlu)) { 
								$ce = mysqli_query($koneksi, "select * from tb_approv_pinjaman where id_pinjaman = '".$datau['id_pinjaman']."' and status = 'approved'");
								$dapp = mysqli_fetch_array($ce);
								$dc = mysqli_num_rows($ce);
								if ($dc > 0) {
								?>
								<tr>
									<td><?= $datau['id_pinjaman']; ?></td>
									<td><?= $datau['id_anggota']; ?></td>
									<td><?= $datau['nama_lengkap'];?></td>
									<td><?= $datau['tgl_pinjam']; ?></td>
									<td><?= $datau['tgl_entry']; ?></td>
									<td><?= rupiah($datau['jumlah_pinjaman']); ?></td>
									<td><?= $datau['jenis_bunga']." ".$datau['jumlah_bunga']."% "; ?></td>
									<td><?= $datau['jenis_pinjaman']; ?></td>
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
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>