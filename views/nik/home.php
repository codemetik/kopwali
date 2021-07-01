<?php 
  $sql = mysqli_query($koneksi, "SELECT x.id_anggota, x.id_user, nama_lengkap, simpanan_pokok, 
@wjb:=SUM(jumlah_wajib) AS wajib,
@skr:=SUM(jumlah_sukarela) AS sukarela,
ROUND(simpanan_pokok + SUM(jumlah_wajib) + SUM(jumlah_sukarela)) AS jumlah
FROM tb_anggota X
INNER JOIN tb_simpanan Y ON y.id_anggota = x.id_anggota
WHERE x.id_user = '".$_SESSION['id_user']."'");
  $data = mysqli_fetch_array($sql);

  function pinjaman($id_user,$kolm, $koneksi){
    $sql = mysqli_query($koneksi, "SELECT * FROM tb_anggota X INNER JOIN tb_pinjaman Y ON y.id_anggota = x.id_anggota where x.id_user = '".$id_user."'");
    $data = mysqli_fetch_array($sql);
    echo rupiah($data[$kolm]);
  }
?>
<div class="row">
  <div class="col-sm-12">
    <div class="card shadow bg-info">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-3">
            <div class="card border-dark mb-3 float-center" style="max-width: 18rem;">
              <div class="card-body text-info bg-dark">
                <h5 class="card-title">Total Simpanan</h5>
                <b><h3 class="card-text"><?= rupiah($data['jumlah']) ?></h3></b>
              </div>
              <div class="card-footer bg-transparent border-success">Detail >></div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="card border-dark mb-3" style="max-width: 18rem;">
              <div class="card-body text-info bg-dark">
                <h5 class="card-title">Total Pinjaman</h5>
                <b><h3 class="card-text"><?= pinjaman($_SESSION['id_user'],'jumlah_pinjaman', $koneksi); ?></h3></b>
              </div>
              <div class="card-footer bg-transparent border-success">Detail >></div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="card border-dark mb-3" style="max-width: 18rem;">
              <div class="card-body text-info bg-dark">
                <h5 class="card-title">Total Modal Usaha</h5>
                <b><h3 class="card-text">Rp. 0.00</h3></b>
              </div>
              <div class="card-footer bg-transparent border-success">Detail >></div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="card border-dark mb-3" style="max-width: 18rem;">
              <div class="card-body text-info bg-dark">
                <h5 class="card-title">Total SHU Keseluruhan</h5>
                <b><p class="card-text">Rp. 0.00</p></b>
              </div>
              <div class="card-footer bg-transparent border-success">Detail >></div>
            </div>
          </div>
        </div>  
      </div>
    </div>
  </div>
</div>