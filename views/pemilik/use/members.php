<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header bg-info">
				<h5 class="card-title">Data Members</h5>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table id="example" class="table display table-bordered text-center" style="width: 100%; font-size: 12px;">
						<thead class="table-info">
							<tr>
								<th>ID Anggota</th>
								<th>Nama Lengkap</th>
								<th>Tempat Lahir</th>
								<th>Tgl Lahir</th>
								<th>Alamat</th>
								<th>No Telpn</th>
								<th>Tgl Join</th>
								<th>Tgl Entry</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$sql = mysqli_query($koneksi, "SELECT * FROM tb_user X INNER JOIN tb_anggota Y ON y.id_user = x.id_user GROUP BY x.id_user ASC");
							while ($data = mysqli_fetch_array($sql)) { ?>
								<tr>
									<td><?= $data['id_anggota']; ?></td>
									<td><?= $data['nama_lengkap']; ?></td>
									<td><?= $data['tempat_lahir']; ?></td>
									<td><?= $data['tgl_lahir']; ?></td>
									<td><?= $data['alamat_sekarang']; ?></td>
									<td><?= $data['no_telpn']; ?></td>
									<td><?= $data['tgl_join']; ?></td>
									<td><?= $data['tgl_entry']; ?></td>
								</tr>
							<?php }
							?>
						</tbody>
						<tfoot class="table-info">
							<tr>
								<th>ID Anggota</th>
								<th>Nama Lengkap</th>
								<th>Tempat Lahir</th>
								<th>Tgl Lahir</th>
								<th>Alamat</th>
								<th>No Telpn</th>
								<th>Tgl Join</th>
								<th>Tgl Entry</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>