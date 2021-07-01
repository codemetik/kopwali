<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header bg-info">
				<h5 class="card-title">Data SHU</h5>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table id="example" class="table display table-bordered border-secondary text-center" style="width: 100%; font-size: 10px;">
						<thead class="table-info">
							<tr>
								<th rowspan="2">ID Anggota</th>
								<th rowspan="2">Nama</th>
								<th colspan="4">Simpanan</th>
								<th colspan="4">Pinjaman</th>
								<th rowspan="2">SHU Simpanan</th>
								<th rowspan="2">SHU Pinjaman</th>
								<th rowspan="2">SHU Anggota</th>
							</tr>
							<tr>
								<th>Simpanan Pokok</th>
								<th>Sum Wajib</th>
								<th>Sum Sukarela</th>
								<th>Jumlah Simpanan</th>
								<th>Jumlah Pinjaman</th>
								<th>Jumlah Bunga</th>
								<th>Tenor</th>
								<th>Jasa Pinjaman</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$sql = mysqli_query($koneksi, " SELECT x.id_user, x.id_anggota, nama_lengkap, simpanan_pokok, @wjb:=IF(x.id_user = w.id_user, SUM(jumlah_wajib), '0') AS sum_wajib, @skr:=IF(x.id_user = w.id_user, SUM(jumlah_sukarela), '0') AS sum_sukarela, IF(x.id_user = w.id_user, simpanan_pokok +SUM(jumlah_wajib)+SUM(jumlah_sukarela), simpanan_pokok) AS total_simpanan, jumlah_pinjaman, y.id_bunga,jumlah_bunga, tenor, jumlah_pinjaman/tenor AS cicilan_pokok, jumlah_pinjaman*(jumlah_bunga/100/tenor)*tenor AS jasa_pinjaman FROM tb_anggota X LEFT JOIN tb_simpanan w ON w.id_anggota = x.id_anggota LEFT JOIN tb_pinjaman Y ON y.id_anggota = x.id_anggota LEFT JOIN tb_bunga z ON z.id_bunga = y.id_bunga GROUP BY x.id_anggota");
							while ($data = mysqli_fetch_array($sql)) { ?>
							<tr>
								<td><?= $data['id_anggota']; ?></td>
								<td><?= $data['nama_lengkap']; ?></td>
								<td><?= $data['simpanan_pokok']; ?></td>
								<td><?= $data['sum_wajib']; ?></td>
								<td><?= $data['sum_sukarela']; ?></td>
								<td><?= $data['total_simpanan']; ?></td>
								<td><?= $data['jumlah_pinjaman']; ?></td>
								<td><?= $data['jumlah_bunga']; ?></td>
								<td><?= $data['tenor']; ?></td>
								<td><?= $data['jasa_pinjaman']; ?></td>
								<td><?= $shu_sim = round($data['total_simpanan']*0.07); ?></td>
								<td><?= $shu_pin = round($data['jasa_pinjaman']*0.105); ?></td>
								<td><?= $shu_sim + $shu_pin; ?></td>
							</tr>
							<?php }
							?>
						</tbody>
						<tfoot class="table-info">
							<tr>
								<th>ID Anggota</th>
								<th>Nama</th>
								<th>Simpanan Pokok</th>
								<th>Sum Wajib</th>
								<th>Sum Sukarela</th>
								<th>Jumlah Simpanan</th>
								<th>Jumlah Pinjaman</th>
								<th>Jumlah Bunga</th>
								<th>Tenor</th>
								<th>Jasa Pinjaman</th>
								<th>SHU Simpanan</th>
								<th>SHU Pinjaman</th>
								<th>SHU Anggota</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>