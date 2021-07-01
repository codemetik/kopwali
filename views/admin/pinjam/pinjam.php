<?php require_once('code_id.php'); ?>
<div class="row">
	<div class="col-sm-12">
	<div class="card mb-3">
		<div class="card-header bg-info">
			<h5 class="card-title">Entry Data Pinjaman Anggota</h5>
		</div>
		<div class="card-body">
			<form action="?pin=presentasi_pinjaman" method="post">
				<div class="row">
					<div class="col-sm-4">
						<div class="input-group input-group-sm mb-1">
						  <input type="text" class="form-control" name="id_pinjaman" value="<?= get_code($koneksi); ?>" readonly>
						</div>
						<div class="input-group input-group-sm mb-1">
						<select class="js-example-basic-single form-control" name="id_anggota" id="floa" aria-label="Floating label select example" required>
							<option value="">--Pilih Anggota--</option>
						  <?php 
						  $sql = mysqli_query($koneksi, "select * from tb_user");
						  while ($data = mysqli_fetch_array($sql)) { 
						  	$anggota = mysqli_query($koneksi, "select *, TIMESTAMPDIFF(MONTH,tgl_join,NOW()) AS lama_join from tb_anggota where id_user = '".$data['id_user']."'");
						  	$datagt = mysqli_fetch_array($anggota);
						  	$a= mysqli_query($koneksi, "select * from tb_pinjaman where id_anggota = '".$datagt['id_anggota']."'");
						  	$d = mysqli_fetch_array($a);
						  	if ($data['id_user'] == $datagt['id_user']) {
						  		if ($datagt['id_anggota'] == $d['id_anggota']) {
						  			
						  		}else{ ?>
						  			<option value="<?= $datagt['id_anggota'] ?>"><?= $datagt['id_anggota']; ?> || <?= $datagt['nama_lengkap'].' || '.$datagt['lama_join'].' bulan'; ?> </option>
						  		<?php }
						  		}else{
						  			//null
						  		}
						  }
						  ?>
						</select>
						</div>
						<div class="input-group input-group-sm">
							<input type="text" class="form-control" name="jumlh" id="jumlh" readonly>
							<p id="status"></p>
						</div>
						<div class="form-floating mb-1">
						  <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam" required>
						  <label for="tgl_simpan">Tanggal Pinjam</label>
						</div>
						<div class="form-floating mb-1">
						  <input type="text" class="form-control" id="tgl_entry" name="tgl_entry" readonly value="<?= date('Y-m-d') ?>">
						  <label for="tgl_entry">Tanggal Entry</label>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="card mb-1">
							<div class="card-header">
								Pilih Jenis Simpanan
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-sm-12">
									<select class="js-example-basic-single form-control" name="id_bunga" id="floatingSelect2" aria-label="Floating label select example" required>
										<option value="">--Pilih Bunga--</option>
									  <?php 
									  $sqla = mysqli_query($koneksi, "select * from tb_bunga");
									  while ($dataa = mysqli_fetch_array($sqla)) {?>
									  		<option value="<?= $dataa['id_bunga'] ?>"><?= $dataa['jenis_bunga']; ?> || <p class="text-end"><?= $dataa['jumlah_bunga']; ?>%</p> </option>
									  <?php }
									  ?>
									</select>
									</div>
									</div>
								</div>
							</div>
							<div class="form-floating mb-1">
							  <input type="text" class="form-control" id="jml_pinjaman" name="jml_pinjaman" placeholder="Jumlah Pinjaman" required>
							  <label for="jml_pinjaman">Jumlah Pinjaman</label>
							</div>
						</div>	
						<div class="col-sm-4">
							<div class="card mb-1">
								<div class="card-header">
									Pilih Jenis Pinjaman
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-sm-12">
										<select class="js-example-basic-single form-control" name="id_jenis_pinjaman" id="floatingSelect3" aria-label="Floating label select example" required>
											<option value="">--Pilih Jenis--</option>
										  <?php 
										  $sqli = mysqli_query($koneksi, "select * from tb_jenis_pinjaman");
										  while ($datai = mysqli_fetch_array($sqli)) {?>
										  		<option value="<?= $datai['id_jenis_pinjaman'] ?>"><?= $datai['jenis_pinjaman']; ?></option>
										  <?php }
										  ?>
										</select>
										</div>
										</div>
									</div>
								</div>
								<div class="card mb-1">
								<div class="card-header">
									Lama Tenor Pinjaman
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-sm-12">
										<select class="js-example-basic-single form-control" name="tenor" id="tenor" required>
											<option value="">--Pilih Tenor--</option>

										</select>
										</div>
										</div>
									</div>
								</div>
						</div>
					</div>
					<div class="col-sm-4">
						<button type="submit" name="tampil_presen" class="btn-md btn-primary"><span data-feather="save"></span> Simpan</button>
					</div>
				</div>
			</form>
		</div>
	</div>	
	</div>
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header bg-info">
				<h5 class="card-title">Table Pinjaman</h5>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table id="example" class="display table table-bordered" style="width: 100%; font-size: 12px;">
						<thead class="table-info">
							<tr>
								<th>ID Pinjaman</th>
								<th>ID Anggota</th>
								<th>Nama</th>
								<th>Tgl Pinjam</th>
								<th>Tgl Entry</th>
								<th>Jumlah Pinjam</th>
								<th>Bunga</th>
								<th>Jenis Pinjaman</th>
								<th>Status</th>
								<th>Detail</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$sqlu = mysqli_query($koneksi, "select * from tb_pinjaman x inner join tb_bunga y on y.id_bunga = x.id_bunga inner join tb_jenis_pinjaman z on z.id_jenis_pinjaman = x.id_jenis_pinjaman inner join tb_anggota w on w.id_anggota = x.id_anggota");
							while ($datau = mysqli_fetch_array($sqlu)) { 
								$ce = mysqli_query($koneksi, "select * from tb_approv_pinjaman where id_pinjaman = '".$datau['id_pinjaman']."' and status = 'approved'");
								$dc = mysqli_num_rows($ce);
								$dapp = mysqli_fetch_array($ce);
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
									<td><?= $dapp['status']; ?></td>
									<td><a href="?pin=detail_pinjaman&idpin=<?= $datau['id_pinjaman']; ?>"><button class="btn-md btn-primary"><span data-feather='edit'></span></button></a></td>
								</tr>
							<?php }
							}
							?>
						</tbody>
						<tfoot class="table-info">
							<tr>
								<th>ID Pinjaman</th>
								<th>ID Anggota</th>
								<th>Nama</th>
								<th>Tgl Pinjam</th>
								<th>Tgl Entry</th>
								<th>Jumlah Pinjam</th>
								<th>Bunga</th>
								<th>Jenis Pinjaman</th>
								<th>Status</th>
								<th>Detail</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>