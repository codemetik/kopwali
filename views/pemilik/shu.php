<!-- shu simpanan dan pinjaman berserta bunga flat dan efektif -->
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header bg-info">
				<h5 class="card-title">Table SHU</h5>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table id="example" class="table display table-bordered border-secondary text-center" style="width: 100%; font-size: 10px;">
						<thead class="table-info">
							<tr>
								<th rowspan="2">ID Anggota</th>
								<th rowspan="2">Nama</th>
								<th colspan="4">Simpanan</th>
								<th colspan="6">Pinjaman</th>
								<th rowspan="2">SHU Simpanan</th>
								<th rowspan="2">SHU Pinjaman</th>
								<th rowspan="2">SHU Anggota</th>
							</tr>
							<tr>
								<th class="table-secondary">Simpanan Pokok</th>
								<th class="table-secondary">Sum Wajib</th>
								<th class="table-secondary">Sum Sukarela</th>
								<th class="table-secondary">Jumlah Simpanan</th>
								<th class="table-light">Jumlah Pinjaman</th>
								<th class="table-light">Jenis Bunga</th>
								<th class="table-light">Tenor</th>
								<th class="table-light">Cicilan /bln</th>
								<th class="table-light">Bunga /bln</th>
								<th class="table-light">Jasa Pinjaman</th>
							</tr>
						</thead>
						<tbody class="table-primary">
							<?php 
							$sql = mysqli_query($koneksi, "SELECT x.id_user, x.id_anggota, nama_lengkap, simpanan_pokok, @wjb:=IF(x.id_user = w.id_user, SUM(jumlah_wajib), '0') AS sum_wajib, @skr:=IF(x.id_user = w.id_user, SUM(jumlah_sukarela), '0') AS sum_sukarela, IF(x.id_user = w.id_user, simpanan_pokok +SUM(jumlah_wajib)+SUM(jumlah_sukarela), simpanan_pokok) AS total_simpanan, jumlah_pinjaman, y.id_bunga,jumlah_bunga, tenor, jumlah_pinjaman/tenor AS cicilan_pokok, jumlah_pinjaman*(jumlah_bunga/100/tenor)*tenor AS jasa_pinjaman, jenis_bunga FROM tb_anggota X LEFT JOIN tb_simpanan w ON w.id_anggota = x.id_anggota LEFT JOIN tb_pinjaman Y ON y.id_anggota = x.id_anggota LEFT JOIN tb_bunga z ON z.id_bunga = y.id_bunga GROUP BY x.id_anggota");
							foreach($sql as $key => $data){?>
							<tr>
								<td><?= $data['id_anggota']; ?></td>
								<td><?= $data['nama_lengkap']; ?></td>
								<td><?= $data['simpanan_pokok']; ?></td>
								<td><?= $data['sum_wajib']; ?></td>
								<td><?= $data['sum_sukarela']; ?></td>
								<td><?= $data['total_simpanan']; ?></td>
								<td><?= $data['jumlah_pinjaman']; ?></td>
								<td><?= $data['jenis_bunga']." (".$data['jumlah_bunga']."%)"; ?></td>
								<td><?= $data['tenor']; ?></td>
								<td><?php
								if ($data['jumlah_pinjaman'] == true) {
									echo round($data['jumlah_pinjaman']/$data['tenor']).' x'.$data['tenor'];
								}else if($data['jumlah_pinjaman'] == false){
									echo '0';
								}
								?></td>
								<td>
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
								</td>
								<td>
									<?php
									if ($data['jenis_bunga'] == 'flat') {
										$no=1;
										for ($i=0; $i < $data['tenor']; $i++) { 
											// echo "<option> bulan ke-".$no++." ".rupiah($valu['jumlah_pinjaman']*$valu['jumlah_bunga']/100/$valu['tenor'])."</option>";
											$ang1[] = $data['jumlah_pinjaman']/$data['tenor'];
											$b1[] = $data['jumlah_pinjaman']*$data['jumlah_bunga']/100/$data['tenor'];
										}	
									echo array_sum($b1);
									}else if($data['jenis_bunga'] == 'efektif'){
										$no=1;
										for ($i=0; $i < $data['tenor']; $i++) { 
											// echo "<option> bulan ke-".$no." ".rupiah(($valu['jumlah_pinjaman']-($no++-1)*($valu['jumlah_pinjaman']/$valu['tenor']))*$valu['jumlah_bunga']/100/$valu['tenor'])."</option>";
											$ang2[] = $data['jumlah_pinjaman']/$data['tenor'];
											$b2[] = ($data['jumlah_pinjaman']-($no++-1)*($data['jumlah_pinjaman']/$data['tenor']))*$data['jumlah_bunga']/100/$data['tenor'];
										}
										echo array_sum($b2);
									}else{
										echo '0';
									}
									?>
								</td>
								<td><?= $shu_sim = round($data['total_simpanan']*0.07); ?></td>
								<td>
								<?php 
								if ($data['jenis_bunga'] == 'flat') {
									$no=1;
									for ($i=0; $i < $data['tenor']; $i++) { 
										
										$ba[] = $data['jumlah_pinjaman']*$data['jumlah_bunga']/100/$data['tenor'];
									}	
									$shu_pin = round(array_sum($ba));
								}else if($data['jenis_bunga'] == 'efektif'){
									$no=1;
									for ($i=0; $i < $data['tenor']; $i++) { 
										
										$bb[] = ($data['jumlah_pinjaman']-($no++-1)*($data['jumlah_pinjaman']/$data['tenor']))*$data['jumlah_bunga']/100/$data['tenor'];
									}
									$shu_pin = round(array_sum($bb));
								}else{
									$shu_pin = 0;
								}
								echo rupiah($shu_pin*0.105);
								?>
								</td>
								<td><?php $jum = $shu_sim + $shu_pin; echo rupiah($jum); ?></td>
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
								<th>Jenis Bunga</th>
								<th>Tenor</th>
								<th>Cicilan /bln</th>
								<th>Bunga /bln</th>
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