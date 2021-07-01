<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header bg-info">
				<h5 class="card-title">Data User</h5>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table id="example" class="table display table-bordered" style="width: 100%; font-size: 12px;">
						<thead class="table-info">
							<tr>
								<th>No</th>
								<th>ID User</th>
								<th>User</th>
								<th>Password</th>
								<th>Confirm Password</th>
								<th>Level User</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$no=1;
							$sql = mysqli_query($koneksi, "SELECT * FROM tb_user z INNER JOIN tb_rols X ON x.id_user = z.id_user INNER JOIN tb_level_user Y ON y.id_level_user = x.id_level_user GROUP BY z.id_user");
							while ($data = mysqli_fetch_array($sql)) { ?>
								<tr>
									<td><?= $no++; ?></td>
									<td><?= $data['id_user']; ?></td>
									<td><?= $data['user']; ?></td>
									<td><input type="password" class="form-control-md" value="<?= $data['pass']; ?>" readonly></td>
									<td><input type="password" class="form-control-md" value="<?= $data['confirm_pass']; ?>" readonly></td>
									<td><?= $data['name_level']; ?></td>
								</tr>
							<?php }
							?>
						</tbody>
						<tfoot class="table-info">
							<tr>
								<th>No</th>
								<th>ID User</th>
								<th>User</th>
								<th>Password</th>
								<th>Confirm Password</th>
								<th>Level User</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>