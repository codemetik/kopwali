<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header bg-info">
				<h5 class="card-title">Detail Pinjaman</h5>
			</div>
			<div class="card-body">
				<div class="row">
				<?php 
				if (isset($_GET['idpin'])) {
					$id_pinjaman = $_GET['idpin'];

					$sql = mysqli_query($koneksi, "select * from tb_pinjaman x inner join tb_bunga y on y.id_bunga = x.id_bunga inner join tb_jenis_pinjaman z on z.id_jenis_pinjaman = x.id_jenis_pinjaman where x.id_pinjaman = '$id_pinjaman'");
					$data = mysqli_fetch_array($sql); 
					$sqlk = mysqli_query($koneksi, "select * from tb_pengembalian where id_pinjaman = '$id_pinjaman'");
					$dk = mysqli_fetch_array($sqlk);
					$dnum = mysqli_num_rows($sqlk);

					$s = mysqli_query($koneksi, "select max(tenor_ke) as tenor_ke from tb_pengembalian where id_pinjaman = '$id_pinjaman'");
					$d = mysqli_fetch_array($s);

					$siang = mysqli_query($koneksi, "SELECT SUM(jumlah_bayar) AS jml FROM tb_pengembalian WHERE id_pinjaman = '$id_pinjaman'");
					$dsing = mysqli_fetch_array($siang);
					?>

				<div class="col-sm-6">
					<div class="table-responsive">
						<table class="display table table-sm" style="width: 100%; font-size: 12px;">
							<thead>
								<tr><th>ID Pinjaman</th><td>:</td><td>
									<div class="input-group input-group-sm mb-1">
									  <input type="text" class="form-control" style="font-size: 12px;" name="id_pinjaman" value="<?= $data['id_pinjaman']; ?>" readonly>
									</div>
								</td></tr>
								<tr><th>ID Anggota</th><td>:</td><td>
									<div class="input-group input-group-sm mb-1">
									  <input type="text" class="form-control" style="font-size: 12px;" name="id_anggota" value="<?= $data['id_anggota']; ?>" readonly>
									</div>
								</td></tr>
								<tr><th>Tgl Pinjam</th><td>:</td><td>
									<div class="input-group input-group-sm mb-1">
									  <input type="text" class="form-control" style="font-size: 12px;" name="tgl_pinjam" value="<?= $data['tgl_pinjam']; ?>" readonly>
									</div>
								</td></tr>
								<tr><th>Tgl Entry</th><td>:</td><td>
									<div class="input-group input-group-sm mb-1">
									  <input type="text" class="form-control" style="font-size: 12px;" name="tgl_entry" value="<?= $data['tgl_entry']; ?>" readonly>
									</div>
								</td></tr>
							</thead>
						</table>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="table-responsive">
						<table class="display table table-sm" style="width: 100%; font-size: 12px;">
							<thead>
								<tr><th>Bunga</th><td>:</td><td>
									<div class="input-group input-group-sm mb-1">
									  <input type="text" class="form-control" style="font-size: 12px;" name="id_bunga" value="<?= $data['jumlah_bunga'].'%'; ?>" readonly>
									</div>
								</td></tr>
								<tr><th>Jenis Pinjaman</th><td>:</td><td>
									<div class="input-group input-group-sm mb-1">
									  <input type="text" class="form-control" style="font-size: 12px;" name="id_jenis_pinjaman" value="<?= $data['id_jenis_pinjaman']; ?>" readonly>
									</div>
								</td></tr>
								<tr><th>Jumlah Pinjaman</th><td>:</td><td>
									<div class="input-group input-group-sm mb-1">
									  <input type="text" class="form-control" style="font-size: 12px;" name="jml_pinjaman" value="<?= rupiah($data['jumlah_pinjaman']); ?>" readonly>
									</div>
								</td></tr>
								<tr><th>Tenor</th><td>:</td><td>
									<div class="input-group input-group-sm mb-1">
									  <input type="text" class="form-control" style="font-size: 12px;" name="tenor" value="<?= $data['tenor'].' Bulan'; ?>" readonly>
									</div>
								</td></tr>
							</thead>
						</table>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="table-responsive">
						<table class="table display table-bordered" style="width: 100%; font-size: 12px;">
							<thead class="table-info">
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
								for ($i=0; $i<$data['tenor'] ; $i++) { 
									$nomer = $no++;
									if ($data['id_bunga'] == '1') {
										$cp = $data['jumlah_pinjaman']/$data['tenor']; //cicilan pokok perbulan
										$cb = $data['jumlah_pinjaman']*$data['jumlah_bunga']/100/$data['tenor']; //cicilan bunga perbulan
										$tc = round($cp+$cb);

										$tjp = ($data['jumlah_pinjaman']/$data['tenor'])*$data['tenor']; //total cicilan pokok
										$tjb = $cb*$data['tenor']; //total cicilan bunga
										$tjc = $tjp+$tjb; ?>
										<tr>
											<td>Bulan Ke <?= $nomer; ?></td>
											<td class="text-end"><?= rupiah($cp); ?></td>
											<td class="text-end"><?= rupiah($cb); ?></td>
											<?php 
											if ($dnum > 0) {
												if ($nomer == $d['tenor_ke']+1) {
													echo "<form action='' method='post'>";
													echo "<td class='text-end'>
													<input type='text' name='idp' value='".$data['id_pinjaman']."' hidden>
													<input type='text' name='ida' value='".$data['id_anggota']."' hidden>
													<input type='text' name='tenor' value='".$data['tenor']."' hidden>
													<input type='text' name='tenor_ke' value='".$nomer."' hidden>
													<input type='text' name='jumlah' value='".$tc."' hidden>
													<input type='text' class='form-control-sm bg-success text-light' value='".rupiah($tc)."' readonly><button type='submit' class='btn-md' name='bayar' id='bayar'><span data-feather='edit'></span> Bayar</button>
													</td>";
													echo "</form>";
												}else{
													echo "<td class='text-end'>".rupiah($tc)."</td>";
												}
											}else{
												if ($nomer == '1') {
													echo "<form action='' method='post'>";
													echo "<td class='text-end'>
													<input type='text' name='idp' value='".$data['id_pinjaman']."' hidden>
													<input type='text' name='ida' value='".$data['id_anggota']."' hidden>
													<input type='text' name='tenor' value='".$data['tenor']."' hidden>
													<input type='text' name='tenor_ke' value='".$nomer."' hidden>
													<input type='text' name='jumlah' value='".$tc."' hidden>
													<input type='text' class='form-control-sm bg-success text-light' value='".rupiah($tc)."' readonly><button type='submit' class='btn-md' name='bayar' id='bayar'><span data-feather='edit'></span> Bayar</button>
													</td>";
													echo "</form>";
												}else{
													echo "<td class='text-end'>".rupiah($tc)."</td>";
												}
											}
											?>
											<!-- <td class="text-end"><?= rupiah($tc); ?></td> -->
										</tr>
									<?php }else if($data['id_bunga'] == '2'){
										$cp = $data['jumlah_pinjaman']/$data['tenor']; //cicilan pokok perbulan
										$cb = ($data['jumlah_pinjaman']-($nomer - 1)*$cp)*$data['jumlah_bunga']/100/$data['tenor']; //cicilan bunga perbulan
										$tc = $cp+$cb;

										$tjp = ($data['jumlah_pinjaman']/$data['tenor'])*$data['tenor']; //total cicilan pokok
										$array[] = ($data['jumlah_pinjaman']-($nomer - 1)*$cp)*$data['jumlah_bunga']/100/$data['tenor']; //mencari array ciicilan bunganya
										$tjb = array_sum($array); //menjumlahkan cicilan bunga yang telah di array
										$tjc = $tjp+$tjb; //total jumlah pokok tambah jumlah bunga
										?>
										<tr>
											<td>Bulan Ke <?= $nomer; ?></td>
											<td class="text-end"><?= rupiah($cp); ?></td>
											<td class="text-end"><?= rupiah($cb); ?></td>
											<?php 
											if ($dnum > 0) {
												if ($nomer == $d['tenor_ke']+1) {
													echo "<form action='' method='post'>";
													echo "<td class='text-end'>
													<input type='text' name='idp' value='".$data['id_pinjaman']."' hidden>
													<input type='text' name='ida' value='".$data['id_anggota']."' hidden>
													<input type='text' name='tenor' value='".$data['tenor']."' hidden>
													<input type='text' name='tenor_ke' value='".$nomer."' hidden>
													<input type='text' name='jumlah' value='".$tc."' hidden>
													<input type='text' class='form-control-sm bg-success text-light' value='".rupiah($tc)."' readonly>
													<a href='#' id='bayar'>
													<button type='submit' class='btn-md' name='bayar' id='bayar'><span data-feather='edit'></span> Bayar</button>
													</a>
													</td>";
													echo "</form>";
												}else{
													echo "<td class='text-end'>".rupiah($tc)."</td>";
												}
											}else{
												if ($nomer == '1') {
													echo "<form action='' method='post'>";
													echo "<td class='text-end'>
													<input type='text' name='idp' value='".$data['id_pinjaman']."' hidden>
													<input type='text' name='ida' value='".$data['id_anggota']."' hidden>
													<input type='text' name='tenor' value='".$data['tenor']."' hidden>
													<input type='text' name='tenor_ke' value='".$nomer."' hidden>
													<input type='text' name='jumlah' value='".$tc."' hidden>
													<input type='text' class='form-control-sm bg-success text-light' value='".rupiah($tc)."' readonly><button type='submit' class='btn-md' name='bayar' id='bayar'><span data-feather='edit'></span> Bayar</button>
													</td>";
													echo "</form>";
												}else{
													echo "<td class='text-end'>".rupiah($tc)."</td>";
												}
											}
											?>
										</tr>
								<?php }
								}
								?>
							</tbody>
							<tfoot class="table-info">
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
				<div class="col-sm-6">
					<?php 
					if ($dnum > 0) { ?>
						<table class="display table" style="width: 100%">
							<thead class="table-info">
								<tr>
									<th>| Sisa Cicilan</th>
									<th>| Telah dibayar</th>
									<th>| Sisa Hutang</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?= $data['tenor'] - $d['tenor_ke']; ?> bulan</td>
									<td><?= rupiah($dsing['jml']); ?></td>
									<td><?= rupiah($tjc - $dsing['jml']); ?></td>
								</tr>
							</tbody>
						</table>
					<?php }else{
						echo "<h5>Data Belom ada / Data menunggu pembayaran</h5>";
					}
					?>
				</div>
				<div class="col-sm-4">
					<h5><a target="_blank" href="../admin/pinjam/download/laporan_pinjaman.php?tampil=<?= $id_pinjaman; ?>"><button class="btn-md btn-primary"><span data-feather="download"></span> Export ke Excel Laporan Pinjaman</button></a></h5>
				</div>
				<?php }
				?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php 
if (isset($_POST['bayar'])) {
	$jumlah = $_POST['jumlah'];
	$idp = $_POST['idp'];
	$ida = $_POST['ida'];
	$tenor = $_POST['tenor'];
	$tenor_ke = $_POST['tenor_ke'];
	$tgl_bayar = date('Y-m-d');

	if ($tenor == $tenor_ke) {
		$ins= mysqli_query($koneksi, "insert into tb_pengembalian(id_pinjaman,id_anggota, tenor, tenor_ke, jumlah_bayar, tgl_bayar) values('$idp','$ida','$tenor','$tenor_ke','$jumlah','$tgl_bayar')");
		$insert = mysqli_query($koneksi, "delete from tb_pinjaman where id_pinjaman = '$idp'");
	}else{
		$insert = mysqli_query($koneksi, "insert into tb_pengembalian(id_pinjaman,id_anggota, tenor, tenor_ke, jumlah_bayar, tgl_bayar) values('$idp','$ida','$tenor','$tenor_ke','$jumlah','$tgl_bayar')");
	}

	if ($insert || $ins) {
		echo "<script>
		alert('Data berhasil disimpan!');
		document.location.href = '?pin=Pinjaman';
		</script>";
	}else{
		echo "<script>
		alert('Data gagal disimpan!');
		document.location.href = '?pin=Pinjaman';
		</script>";
	}	
}
?>