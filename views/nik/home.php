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
      $num = mysqli_num_rows($sql);
      if ($num > 0) {
        echo rupiah($data[$kolm]);   
      }else{
        echo rupiah('0');  
      }
    
  }

function total_pinjaman($id_user,$koneksi){
  $sql = mysqli_query($koneksi, "SELECT x.id_user, x.id_anggota, nama_lengkap, simpanan_pokok, 
@wjb:=IF(x.id_user = w.id_user, SUM(jumlah_wajib), '0') AS sum_wajib, 
@skr:=IF(x.id_user = w.id_user, SUM(jumlah_sukarela), '0') AS sum_sukarela, 
IF(x.id_user = w.id_user, simpanan_pokok +SUM(jumlah_wajib)+SUM(jumlah_sukarela), simpanan_pokok) AS total_simpanan, 
jumlah_pinjaman, y.id_bunga,jumlah_bunga, tenor, jumlah_pinjaman/tenor AS cicilan_pokok, 
jumlah_pinjaman*(jumlah_bunga/100/tenor)*tenor AS jasa_pinjaman, jenis_bunga 
FROM tb_anggota X 
LEFT JOIN tb_simpanan w ON w.id_anggota = x.id_anggota 
LEFT JOIN tb_pinjaman Y ON y.id_anggota = x.id_anggota 
LEFT JOIN tb_bunga z ON z.id_bunga = y.id_bunga where x.id_user = '".$id_user."'
GROUP BY x.id_anggota");
  foreach ($sql as $key => $value) {
    if ($value['jumlah_pinjaman'] == true) {
      $pokok[] = round($value['jumlah_pinjaman']/$value['tenor'])*$value['tenor'];
    }else if($value['jumlah_pinjaman'] == false){
      $pokok[] = 0;
    }

    if ($value['jenis_bunga'] == 'flat') {
      for ($i=0; $i < $value['tenor']; $i++) { 
        $bunga[] = $value['jumlah_pinjaman']*$value['jumlah_bunga']/100/$value['tenor'];
      }
    }else if($value['jenis_bunga'] == 'efektif'){
      $no=1;
      for ($i=0; $i < $value['tenor']; $i++) { 
        $bunga[] = ($value['jumlah_pinjaman']-($no++-1)*($value['jumlah_pinjaman']/$value['tenor']))*$value['jumlah_bunga']/100/$value['tenor'];
      }
    }else{
      $bunga[] = 0;
    }
  }
  $hasil = array_sum($pokok) + array_sum($bunga);
  echo rupiah($hasil);
}

function jmua($id_user, $koneksi){
  $sql = mysqli_query($koneksi, "SELECT x.id_user, x.id_anggota, nama_lengkap, simpanan_pokok, 
@wjb:=IF(x.id_user = w.id_user, SUM(jumlah_wajib), '0') AS sum_wajib, 
@skr:=IF(x.id_user = w.id_user, SUM(jumlah_sukarela), '0') AS sum_sukarela, 
IF(x.id_user = w.id_user, simpanan_pokok +SUM(jumlah_wajib)+SUM(jumlah_sukarela), simpanan_pokok) AS total_simpanan, 
jumlah_pinjaman, y.id_bunga,jumlah_bunga, tenor, jumlah_pinjaman/tenor AS cicilan_pokok, 
jumlah_pinjaman*(jumlah_bunga/100/tenor)*tenor AS jasa_pinjaman, jenis_bunga 
FROM tb_anggota X 
LEFT JOIN tb_simpanan w ON w.id_anggota = x.id_anggota 
LEFT JOIN tb_pinjaman Y ON y.id_anggota = x.id_anggota 
LEFT JOIN tb_bunga z ON z.id_bunga = y.id_bunga where x.id_user = '".$id_user."'
GROUP BY x.id_anggota");
  foreach ($sql as $key => $value) {
    $jmua[] = $value['total_simpanan']*0.07;
  }
  echo rupiah(array_sum($jmua));
}

function jusa($id_user, $koneksi){
  $sql = mysqli_query($koneksi, "SELECT x.id_user, x.id_anggota, nama_lengkap, simpanan_pokok, 
@wjb:=IF(x.id_user = w.id_user, SUM(jumlah_wajib), '0') AS sum_wajib, 
@skr:=IF(x.id_user = w.id_user, SUM(jumlah_sukarela), '0') AS sum_sukarela, 
IF(x.id_user = w.id_user, simpanan_pokok +SUM(jumlah_wajib)+SUM(jumlah_sukarela), simpanan_pokok) AS total_simpanan, 
jumlah_pinjaman, y.id_bunga,jumlah_bunga, tenor, jumlah_pinjaman/tenor AS cicilan_pokok, 
jumlah_pinjaman*(jumlah_bunga/100/tenor)*tenor AS jasa_pinjaman, jenis_bunga 
FROM tb_anggota X 
LEFT JOIN tb_simpanan w ON w.id_anggota = x.id_anggota 
LEFT JOIN tb_pinjaman Y ON y.id_anggota = x.id_anggota 
LEFT JOIN tb_bunga z ON z.id_bunga = y.id_bunga where x.id_user = '".$id_user."'
GROUP BY x.id_anggota");
  foreach ($sql as $key => $value) {
    if ($value['jenis_bunga'] == 'flat') {
      $no=1;
      for ($i=0; $i < $value['tenor']; $i++) { 
        // echo "<option> bulan ke-".$no++." ".rupiah($valu['jumlah_pinjaman']*$valu['jumlah_bunga']/100/$valu['tenor'])."</option>";
        $ang1[] = $value['jumlah_pinjaman']/$value['tenor'];
        $b1[] = $value['jumlah_pinjaman']*$value['jumlah_bunga']/100/$value['tenor'];
      } 
      $shu_pin = round(array_sum($b1));
    }else if($value['jenis_bunga'] == 'efektif'){
      $no=1;
      for ($i=0; $i < $value['tenor']; $i++) { 
        // echo "<option> bulan ke-".$no." ".rupiah(($valu['jumlah_pinjaman']-($no++-1)*($valu['jumlah_pinjaman']/$valu['tenor']))*$valu['jumlah_bunga']/100/$valu['tenor'])."</option>";
        $ang2[] = $value['jumlah_pinjaman']/$value['tenor'];
        $b2[] = ($value['jumlah_pinjaman']-($no++-1)*($value['jumlah_pinjaman']/$value['tenor']))*$value['jumlah_bunga']/100/$value['tenor'];
      }
      $shu_pin = round(array_sum($b2));
    }else{
      $shu_pin = 0;
    }
  $shu_pinjaman[] = $shu_pin*0.105;
  }
  echo rupiah(array_sum($shu_pinjaman));
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
              <a href="simpananku"><div class="card-footer bg-transparent border-success">Detail >></div></a>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="card border-dark mb-3" style="max-width: 18rem;">
              <div class="card-body text-info bg-dark">
                <h5 class="card-title">Total Pinjaman</h5>
                <b><h3 class="card-text"><?= total_pinjaman($_SESSION['id_user'], $koneksi); ?></h3></b>
              </div>
              <a href="pinjamanku"><div class="card-footer bg-transparent border-success">Detail >></div></a>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="card border-dark mb-3" style="max-width: 18rem;">
              <div class="card-body text-info bg-dark">
                <h5 class="card-title">Total Jasa Modal <?= $_SESSION['user']; ?></h5>
                <b><h3 class="card-text"><?php jmua($_SESSION['id_user'], $koneksi); ?></h3></b>
              </div>
              <div class="card-footer bg-transparent border-success">Detail >></div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="card border-dark mb-3" style="max-width: 18rem;">
              <div class="card-body text-info bg-dark">
                <h5 class="card-title">Total Jasa usaha <?= $_SESSION['user']; ?></h5>
                <b><h3 class="card-text"><?php jusa($_SESSION['id_user'], $koneksi); ?></h3></b>
              </div>
              <div class="card-footer bg-transparent border-success">Detail >></div>
            </div>
          </div>
        </div>  
      </div>
    </div>
  </div>
</div>
