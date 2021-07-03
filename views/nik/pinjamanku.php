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
								<th>Angsuran Pokok</th>
								<th>Bunga /bln</th>
								<th>/bln Harus dibayar</th>
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
									<th>
									<?php 
									if ($data['jumlah_pinjaman'] == true) {
										echo rupiah(round($data['jumlah_pinjaman']/$data['tenor'])).' x'.$data['tenor'];
									}else if($data['jumlah_pinjaman'] == false){
										echo rupiah('0');
									}
									?>
									</th>
									<th>
									<?php
									if ($data['jenis_bunga'] == 'flat') {
										echo "<select class='js-example-basic-single form-control' style='width:100%;'>";
										$no=1;
										for ($i=0; $i < $data['tenor']; $i++) { 
											$sqle = mysqli_query($koneksi, "SELECT id_pinjaman, id_anggota, MAX(tenor_ke) AS max_tenor FROM tb_pengembalian where id_pinjaman = '".$data['id_pinjaman']."' GROUP BY id_pinjaman");
											$d = mysqli_fetch_array($sqle);
											if ($d['max_tenor'] == $no) {
												$select = "selected";
											}else{
												$select = "";
											}
											echo "<option ".$select." style='font-size:9px;'> bulan ke-".$no++." ".rupiah($data['jumlah_pinjaman']*$data['jumlah_bunga']/100/$data['tenor'])."</option>";
											// $bunga[] = $valu['jumlah_pinjaman']*$valu['jumlah_bunga']/100/$valu['tenor'];
										}
										echo "</select>";
									}else if($data['jenis_bunga'] == 'efektif'){
										echo "<select class='js-example-basic-single form-control' style='width:100%;'>";
										$no=1;
										for ($i=0; $i < $data['tenor']; $i++) { 
											$sqle = mysqli_query($koneksi, "SELECT id_pinjaman, id_anggota, MAX(tenor_ke) AS max_tenor FROM tb_pengembalian where id_pinjaman = '".$data['id_pinjaman']."' GROUP BY id_pinjaman");
											$d = mysqli_fetch_array($sqle);
											if ($d['max_tenor'] == $no) {
												$select = "selected";
											}else{
												$select = "";
											}
											echo "<option ".$select." style='font-size:9px;'> bulan ke-".$no." ".rupiah(($data['jumlah_pinjaman']-($no++-1)*($data['jumlah_pinjaman']/$data['tenor']))*$data['jumlah_bunga']/100/$data['tenor'])."</option>";
											// $bunga[] = ($valu['jumlah_pinjaman']-($no++-1)*($valu['jumlah_pinjaman']/$valu['tenor']))*$valu['jumlah_bunga']/100/$valu['tenor'];
										}
										echo "</select>";
									}else{
										echo "0";
									}
									?>
									</th>
									<th>
									<?php 
									if ($data['jumlah_pinjaman'] == true) {
										$pokok[] = round($data['jumlah_pinjaman']/$data['tenor'])*$data['tenor'];
									}else if($data['jumlah_pinjaman'] == false){
										$pokok[] = 0;
									}

									if ($data['jenis_bunga'] == 'flat') {
										for ($i=0; $i < $data['tenor']; $i++) { 
											$bunga[] = $data['jumlah_pinjaman']*$data['jumlah_bunga']/100/$data['tenor'];
										}
									}else if($data['jenis_bunga'] == 'efektif'){
										$no=1;
										for ($i=0; $i < $data['tenor']; $i++) { 
											$bunga[] = ($data['jumlah_pinjaman']-($no++-1)*($data['jumlah_pinjaman']/$data['tenor']))*$data['jumlah_bunga']/100/$data['tenor'];
										}
									}else{
										$bunga[] = 0;
									}
									$hasil = array_sum($pokok) + array_sum($bunga);
									echo rupiah($hasil);
									?>
									</th>
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