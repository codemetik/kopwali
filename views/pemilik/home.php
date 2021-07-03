<?php require_once('script_dashboard.php'); ?>
<div class="row">
  <div class="col-sm-3">
    <div class="card border-info mb-3" style="max-width: 18rem;">
      <div class="card-body text-dark bg-info">
        <h5 class="card-title">Total Simpanan</h5>
        <b><p class="card-text"><?php total_simpanan($koneksi); ?></p></b>
      </div>
      <div class="card-footer bg-transparent border-success">Detail >></div>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="card border-info mb-3" style="max-width: 18rem;">
      <div class="card-body text-dark bg-info">
        <h5 class="card-title">Total Pinjaman + Jasa</h5>
        <b><p class="card-text"><?php total_pinjaman($koneksi); ?></p></b>
      </div>
      <div class="card-footer bg-transparent border-success">Detail >></div>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="card border-info mb-3" style="max-width: 18rem;">
      <div class="card-body text-dark bg-info">
        <h5 class="card-title">Total JMSA</h5>
        <b><p class="card-text"><?php jmua($koneksi); ?></p></b>
      </div>
      <div class="card-footer bg-transparent border-success">Detail >></div>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="card border-info mb-3" style="max-width: 18rem;">
      <div class="card-body text-dark bg-info">
        <h5 class="card-title">Total JUSA</h5>
        <b><p class="card-text"><?php jusa($koneksi); ?></p></b>
      </div>
      <div class="card-footer bg-transparent border-success">Detail >></div>
    </div>
  </div>
</div>