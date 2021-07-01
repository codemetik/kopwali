<?php 
include "../assets/koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.82.0">
    <title>Kp - Koperasi</title>
    <link rel="icon" href="../assets/img/data.png">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">

    

    <!-- Bootstrap core CSS -->
<link href="../plugins/bootstrap-5/dist/css/bootstrap.css" rel="stylesheet">
<link href="../plugins/bootstrap-5/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="../plugins/dashboard/dashboards.css" rel="stylesheet">
  </head>
  <body>

 <div class="row">
 	<div class="col-sm-12">
 		<div class="card">
 			<div class="card-header">
 				<h1 class="card-title">Ngulik</h1>
 			</div>
 			<div class="card-body">
 				<div class="col-sm-3">
 					<form>
	 					<div class="input-group input-group-sm mb-1">
						  <input type="text" id="nama" class="form-control" name="" value="">
						</div>
						<p id="tampil"></p>
						<div class="input-group input-group-sm mb-1">
							<select class="js-example-basic-single form-control" name="opsi" id="opsi" aria-label="Floating label select example">
								<option>--Pilih--</option>
								<option value="2">Opsi 2</option>
								<option value="3">Opsi 3</option>
								<option value="7">Opsi 7</option>
							</select>
						</div>
						<p id="show-opsi"></p>
						<div class="input-group input-group-sm mb-1">
						  <input type="text" id="nilai" class="form-control" name="">
						</div>
						<div class="input-group input-group-sm mb-1">
						  <input type="text" id="show" class="form-control" name="">
						</div>
						<p id="tamp"></p>
	 				</form>
 				</div>
 			</div>
 		</div>
 	</div>
 </div>

    <script src="../plugins/datatables/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
      <script src="../plugins/bootstrap-5/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
          $('.js-example-basic-single').select2();
      });

	$(document).ready(function(){
		$('#tampil').hide();
		$('#tampil').css('font-weight','bold');
		$("#nama").change(function(){
			var nama = $("#nama").val();
			if (nama <= '1500000') {
				$('#tampil').show();
				$('#tampil').css('color','green');
				$('#tampil').html('Good Value');
			}else if(nama >= '1500000'){
				$('#tampil').show();
				$('#tampil').css('color','red');
				$('#tampil').html('Coba masukan nilai yg lebih kecil');
				$('#nama').focus();
			}

		});

	});

	$(document).ready(function(){
		$('#show-opsi').hide();
		$('#opsi').change(function(){
			const opsi = $('#opsi').val();
			if (opsi >= '7' ) {
				$('#show-opsi').show();
				$('#show-opsi').css('color','green');
				$('#show-opsi').html('Anda berhak mendapatkan pinjaman max Rp.4000.000,00');
				document.getElementById('nilai').value = '4000000';
			}else if(opsi >= '3'){
				$('#show-opsi').show();
				$('#show-opsi').css('color','green');
				$('#show-opsi').html('Anda berhak mendapatkan pinjaman max Rp.1500.000,00');
				document.getElementById('nilai').value = '1500000';
			}else if(opsi <= '2'){
				$('#show-opsi').show();
				$('#show-opsi').css('color','red');
				$('#show-opsi').html('Maaf anda tidak berhak mendapatkan pinjaman!');
			}
		});
	});

	$(document).ready(function(){
		$('#show').change(function(){
				const nilai = $('#nilai').val();
				if (nilai >= '4000000') {
					$('#tamp').show();
					$('#tamp').css('color','green');
					$('#tamp').html('Good Value 4000000');
				}else if(nilai <= '1500000'){
					$('#tamp').show();
					$('#tamp').css('color','green');
					$('#tamp').html('Good Value 1500000');
				}else{
					$('#tamp').show();
					$('#tamp').css('color','red');
					$('#tamp').html('Good Value');
				}
			});
	});
</script>
      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
      <script src="../plugins/dashboard/dashboard.js"></script>
  </body>
</html>