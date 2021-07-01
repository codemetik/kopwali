<div class="row">
	<div class="col-sm-12">
		<div class="card">
		<div class="card-header bg-info">
			<h5 class="card-title">Data Tabungan Member</h5>
		</div>
		<div class="card-body">
		<div class="table-responsive">
		<h5><a target="_blank" href="../admin/simpan/download/download_tabungan.php"><button class="btn-md btn-primary"><span data-feather="download"></span> Export ke Excel</button></a></h5>
		<table id="example" class="display table table-bordered" style="width:100%; font-size: 12px;">
			<thead class="text-center table-info">
				<tr>
					<th>No</th>
					<th>ID Anggota</th>
					<th>ID User</th>
					<th>Nama</th>
					<th>Simpanan Pokok</th>
					<th>Simpanan Wajib</th>
					<th>Simpanan Sukarela</th>
					<th>Total Tabungan</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$no=1;
				$sqli = mysqli_query($koneksi, "SELECT x.id_user, x.id_anggota, nama_lengkap, simpanan_pokok, @wjb:=IF(x.id_user = y.id_user, concat('Rp. ', format(SUM(jumlah_wajib),0)), '(NULL)') AS sum_wajib, @skr:=IF(x.id_user = y.id_user, concat('Rp. ',format(SUM(jumlah_sukarela),0)), '(NULL)') AS sum_sukarela, concat('Rp. ', format(IF(x.id_user = y.id_user, simpanan_pokok +SUM(jumlah_wajib)+SUM(jumlah_sukarela), simpanan_pokok),0)) AS total FROM tb_anggota X LEFT JOIN tb_simpanan Y ON y.id_user = x.id_user GROUP BY x.id_user");
				while ($dts = mysqli_fetch_array($sqli)) { ?>
				<tr>
					<td><?= $no++; ?></td>
					<td><?= $dts['id_anggota'] ?></td>
					<td><?= $dts['id_user']; ?></td>
					<td><?= $dts['nama_lengkap']; ?></td>
					<td><?= rupiah($dts['simpanan_pokok']); ?></td>
					<td><?= $dts['sum_wajib']; ?></td>
					<td><?= $dts['sum_sukarela']; ?></td>
					<td><?= $dts['total'] ?></td>
					<td><a href="?sim=detail_tabungan&id=<?= $dts['id_anggota']; ?>"><span data-feather='edit'></span></a> | <a href='' onclick="return confirm('Yakin mau di hapus?')"><span data-feather='delete'></span></a></td>
				</tr>
				<?php }
				?>
			</tbody>
			<tfoot class="text-center table-info">
				<tr>
					<th>No</th>
					<th>ID Anggota</th>
					<th>ID User</th>
					<th>Nama</th>
					<th>Simpanan Pokok</th>
					<th>Simpanan Wajib</th>
					<th>Simpanan Sukarela</th>
					<th>Total Tabungan</th>
					<th>Action</th>
				</tr>
			</tfoot>
		</table>
	</div>			
		</div>
	</div>
	</div>
</div>