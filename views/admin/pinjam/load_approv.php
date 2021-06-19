<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Proses Approv</h5>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table id="example" class="display table" style="width: 100%">
						<thead>
							<tr>
								<th>Nama Pengaju</th>
								<th>JML Pinjam</th>
								<th>JML Bunga</th>
								<th>Jenis Pin</th>
								<th>Status Persetujuan</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$sqlue = mysqli_query($koneksi, "select * from tb_pinjaman x inner join tb_bunga y on y.id_bunga = x.id_bunga inner join tb_jenis_pinjaman z on z.id_jenis_pinjaman = x.id_jenis_pinjaman inner join tb_anggota w on w.id_anggota = x.id_anggota");
							while ($dataue = mysqli_fetch_array($sqlue)) { 
								$cee = mysqli_query($koneksi, "select * from tb_approv_pinjaman where id_pinjaman = '".$dataue['id_pinjaman']."'");
								// $dce = mysqli_num_rows($cee);
								$dappe = mysqli_fetch_array($cee);
								if (isset($dataue['id_pinjaman']) != isset($dappe['id_pinjaman'])) {
								?>
								<tr>
									<td><?= $dataue['nama_lengkap'];?></td>
									<td><?= rupiah($dataue['jumlah_pinjaman']); ?></td>
									<td><?= $dataue['jenis_bunga']." ".$dataue['jumlah_bunga']."% "; ?></td>
									<td><?= $dataue['jenis_pinjaman']; ?></td>
									<td class="text-warning"><?= 'Menunggu'; ?></td>
								</tr>
							<?php }else{

							}
							}
							?>
						</tbody>
						<tfoot>
							<tr>
								<th>Nama Pengaju</th>
								<th>JML Pinjam</th>
								<th>JML Bunga</th>
								<th>Jenis Pin</th>
								<th>Status Persetujuan</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>