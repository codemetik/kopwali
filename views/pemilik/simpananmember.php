<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Data Simpanan Anggota</h5>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table id="example" class="display table" style="width:100%">
						<thead class="text-center table-dark">
							<tr>
								<th>No</th>
								<th>ID Anggota</th>
								<th>ID User</th>
								<th>Nama</th>
								<th>Tempat Lahit</th>
								<th>Tgl Lahir</th>
								<th>Alamat</th>
								<th>Telpn</th>
								<th>Simpanan Pokok</th>
								<th>Tgl Join</th>
								<th>Tgl Entry</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$no=1;
							$sqli = mysqli_query($koneksi, "select * from tb_anggota");
							while ($dts = mysqli_fetch_array($sqli)) { ?>
							<tr>
								<td><?= $no++; ?></td>
								<td><?= $dts['id_anggota'] ?></td>
								<td><?= $dts['id_user']; ?></td>
								<td><?= $dts['nama_lengkap']; ?></td>
								<td><?= $dts['tempat_lahir']; ?></td>
								<td><?= $dts['tgl_lahir']; ?></td>
								<td><?= $dts['alamat_sekarang']; ?></td>
								<td><?= $dts['no_telpn']; ?></td>
								<td class="bg-dark text-white"><?= rupiah($dts['simpanan_pokok']); ?></td>
								<td><?= $dts['tgl_join']; ?></td>
								<td><?= $dts['tgl_entry']; ?></td>
								<td><a href="?page=detail_simpanan&id=<?= $dts['id_anggota']; ?>"><span data-feather='edit'></span></a></td>
							</tr>
							<?php }
							?>
						</tbody>
						<tfoot class="text-center table-dark">
							<tr>
								<th>No</th>
								<th>ID Anggota</th>
								<th>ID User</th>
								<th>Nama</th>
								<th>Tempat Lahit</th>
								<th>Tgl Lahir</th>
								<th>Alamat</th>
								<th>Telpn</th>
								<th>Simpanan Pokok</th>
								<th>Tgl Join</th>
								<th>Tgl Entry</th>
								<th>Action</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>