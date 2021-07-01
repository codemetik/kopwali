<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header bg-info">
				<h5 class="card-title">Data Pinjaman</h5>		
			</div>
			<div class="card-body bg-info">
				<div class="table-responsive">
					<table id="example" class="table display">
						<thead class="table-info">
							<tr>
								<th>TGL Pinjam</th>
								<th>Tgl Entry</th>
								<th>Jenis Bunga</th>
								<th>Besaran Bunga</th>
								<th>Jumlah Pijaman</th>
								<th>Tenor</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$sql = mysqli_query($koneksi, "SELECT *, x.tgl_entry as entry FROM tb_anggota z inner join tb_pinjaman X on x.id_anggota = z.id_anggota INNER JOIN tb_bunga Y ON y.id_bunga = x.id_bunga where id_user = '".$_SESSION['id_user']."'");
							while ($data = mysqli_fetch_array($sql)) { ?>
								<tr>
									<th><?= $data['tgl_pinjam']; ?></th>
									<th><?= $data['entry']; ?></th>
									<th><?= $data['jenis_bunga']; ?></th>
									<th><?= $data['jumlah_bunga']." %"; ?></th>
									<th><?= rupiah($data['jumlah_pinjaman']); ?></th>
									<th><?= $data['tenor']." bulan"; ?></th>
								</tr>
							<?php }
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>