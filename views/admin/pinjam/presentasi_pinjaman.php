<?php 

if (isset($_POST['tampil_presen'])) {
	$id_pinjaman = $_POST['id_pinjaman'];
	$id_anggota = $_POST['id_anggota'];
	$tgl_pinjam = $_POST['tgl_pinjam'];
	$tgl_entry = $_POST['tgl_entry'];
	$id_bunga = $_POST['id_bunga'];
	$id_jenis_pinjaman = $_POST['id_jenis_pinjaman'];
	$jml_pinjaman = $_POST['jml_pinjaman'];
	$tenor = $_POST['tenor'];

	//mengambil data dari t_bunga
	$sqlbunga = mysqli_query($koneksi, "select * from tb_bunga where id_bunga = '$id_bunga'");
	$bunga = mysqli_fetch_array($sqlbunga);
	//mengambil data dari tb_jenis_pinjaman
	$sqljenis = mysqli_query($koneksi, "select * from tb_jenis_pinjaman where id_jenis_pinjaman = '$id_jenis_pinjaman'");
	$jenis = mysqli_fetch_array($sqljenis);

}
?>
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Presentasi Angsuran Pinjaman</h5>
			</div>
			<div class="card-body">
				<form action="../admin/pinjam/proses_pinjaman.php" method="post">
					<div class="row">
						<div class="col-sm-6">
							<div class="table-responsive">
								<table class="display table table-sm" style="width: 100%;">
									<thead>
										<tr><th>ID Pinjaman</th><td>:</td><td>
											<div class="input-group input-group-sm mb-1">
											  <input type="text" class="form-control" name="id_pinjaman" value="<?= $id_pinjaman; ?>" readonly>
											</div>
										</td></tr>
										<tr><th>ID Anggota</th><td>:</td><td>
											<div class="input-group input-group-sm mb-1">
											  <input type="text" class="form-control" name="id_anggota" value="<?= $id_anggota; ?>" readonly>
											</div>
										</td></tr>
										<tr><th>Tgl Pinjam</th><td>:</td><td>
											<div class="input-group input-group-sm mb-1">
											  <input type="text" class="form-control" name="tgl_pinjam" value="<?= $tgl_pinjam; ?>" readonly>
											</div>
										</td></tr>
										<tr><th>Tgl Entry</th><td>:</td><td>
											<div class="input-group input-group-sm mb-1">
											  <input type="text" class="form-control" name="tgl_entry" value="<?= $tgl_entry; ?>" readonly>
											</div>
										</td></tr>
									</thead>
								</table>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="table-responsive">
								<table class="display table table-sm" style="width: 100%;">
									<thead>
										<tr><th>Bunga</th><td>:</td><td>
											<div class="input-group input-group-sm mb-1">
											  <input type="text" class="form-control" name="id_bunga" value="<?= $bunga['id_bunga']; ?>" readonly>
											</div>
										</td></tr>
										<tr><th>Jenis Pinjaman</th><td>:</td><td>
											<div class="input-group input-group-sm mb-1">
											  <input type="text" class="form-control" name="id_jenis_pinjaman" value="<?= $jenis['id_jenis_pinjaman']; ?>" readonly>
											</div>
										</td></tr>
										<tr><th>Jumlah Pinjaman</th><td>:</td><td>
											<div class="input-group input-group-sm mb-1">
											  <input type="text" class="form-control" name="jml_pinjaman" value="<?= $jml_pinjaman; ?>" readonly>
											</div>
										</td></tr>
										<tr><th>Tenor</th><td>:</td><td>
											<div class="input-group input-group-sm mb-1">
											  <input type="text" class="form-control" name="tenor" value="<?= $tenor; ?>" readonly>
											</div>
										</td></tr>
									</thead>
								</table>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="table-responsive">
								<?php 
								// if (isset($bunga['id_bunga']) == '1') {
								// 	$cp = round($jml_pinjaman/$tenor);
								// 	$cb = $jml_pinjaman*$bunga['jumlah_bunga']/100/$tenor;
								// 	$tc = $cp+$cb;

								// 	$tjp = ($jml_pinjaman/$tenor)*$tenor;
								// 	$tjb = $cb*$tenor;
								// 	$tjc = $tjp+$tjb;
								// }else if(isset($bunga['id_bunga']) == '2'){
								// 	$bln = 1;
								// 	for ($t=0; $t < $tenor; $t++) { 
								// 		$n = $bln++;
								// 	}
								// 	// (B$23-(A25-1)*C25)*D$23/100/12
								// 	$cp = round($jml_pinjaman/$tenor);
								// 	$cb = $cb = ($jml_pinjaman-($n-1)*$cp)*$bunga['jumlah_bunga']/100/$tenor;
								// 	$tc = $cp+$cb;

								// 	$tjp = ($jml_pinjaman/$tenor)*$tenor;
								// 	$tjb = $cb*$tenor;
								// 	$tjc = $tjp+$tjb;
								// }
								?>
								<table class="display table" style="width: 100%;">
									<thead>
										<tr>
											<th>No</th>
											<th class="text-end">Cicilan Pokok</th>
											<th class="text-end">Cicilan Bunga</th>
											<th class="text-end">Total Cicilan /Bulan</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										//membuat perulangan angsuran sesuai tenor yang ditentukan
										$no=1;
										for ($i=0; $i<$tenor ; $i++) { 
											$nomer = $no++;
											if ($bunga['id_bunga'] == '1') {
												$cp = $jml_pinjaman/$tenor; //cicilan pokok perbulan
												$cb = $jml_pinjaman*$bunga['jumlah_bunga']/100/$tenor; //cicilan bunga perbulan
												$tc = $cp+$cb;

												$tjp = ($jml_pinjaman/$tenor)*$tenor; //total cicilan pokok
												$tjb = $cb*$tenor; //total cicilan bunga
												$tjc = $tjp+$tjb; ?>
												<tr>
													<td>Bulan Ke <?= $nomer; ?></td>
													<td class="text-end"><?= rupiah($cp); ?></td>
													<td class="text-end"><?= rupiah($cb); ?></td>
													<td class="text-end"><?= rupiah($tc); ?></td>
												</tr>
											<?php }else if($bunga['id_bunga'] == '2'){
												$cp = $jml_pinjaman/$tenor; //cicilan pokok perbulan
												$cb = ($jml_pinjaman-($nomer - 1)*$cp)*$bunga['jumlah_bunga']/100/$tenor; //cicilan bunga perbulan
												$tc = $cp+$cb;

												$tjp = ($jml_pinjaman/$tenor)*$tenor; //total cicilan pokok
												$array[] = ($jml_pinjaman-($nomer - 1)*$cp)*$bunga['jumlah_bunga']/100/$tenor; //mencari array ciicilan bunganya
												$tjb = array_sum($array); //menjumlahkan cicilan bunga yang telah di array
												$tjc = $tjp+$tjb; //total jumlah pokok tambah jumlah bunga
												?>
												<tr>
													<td>Bulan Ke <?= $nomer; ?></td>
													<td class="text-end"><?= rupiah($cp); ?></td>
													<td class="text-end"><?= rupiah($cb); ?></td>
													<td class="text-end"><?= rupiah($tc); ?></td>
													<?php 
													//mencari tgl_sekarang 
													//if ($nomer == '2') {
													// 	$bg = 'bg-primary';
													// 	echo "<td class='text-end ".$bg."'>".rupiah($tc)."</td>";
													// }else{
													// 	echo "<td class='text-end'>".rupiah($tc)."</td>";
													// }
													?>
												</tr>
										<?php }
										}
										?>
									</tbody>
									<tfoot>
										<tr>
											<th>Jumlah</th>
											<th class="text-end"><?= rupiah($tjp); ?> <input type="text" name="cicilan_pokok" value="<?= $tjp; ?>" hidden></th>
											<th class="text-end"><?= rupiah($tjb); ?></th>
											<th class="text-end">: <?= rupiah($tjc); ?></th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
						<div class="col-sm-12">
							<button type="submit" name="simpan_data" class="btn btn-sm btn-primary">Simpan Data</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>