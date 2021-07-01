<?php require_once('script_dashboard.php'); ?>
<div class="row">
  <div class="col-sm-3">
    <div class="card border-success mb-3" style="max-width: 18rem;">
      <div class="card-body text-success">
        <h5 class="card-title">Total Simpanan</h5>
        <b><p class="card-text"><?php total_simpanan($koneksi); ?></p></b>
      </div>
      <div class="card-footer bg-transparent border-success">Detail >></div>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="card border-success mb-3" style="max-width: 18rem;">
      <div class="card-body text-success">
        <h5 class="card-title">Total Pinjaman</h5>
        <b><p class="card-text">RP. 0.00</p></b>
      </div>
      <div class="card-footer bg-transparent border-success">Detail >></div>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="card border-success mb-3" style="max-width: 18rem;">
      <div class="card-body text-success">
        <h5 class="card-title">Total Modal Usaha</h5>
        <p class="card-text">Rp. 0.00</p>
      </div>
      <div class="card-footer bg-transparent border-success">Detail >></div>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="card border-success mb-3" style="max-width: 18rem;">
      <div class="card-body text-success">
        <h5 class="card-title">Total SHU Keseluruhan</h5>
        <p class="card-text">Rp. 0.00</p>
      </div>
      <div class="card-footer bg-transparent border-success">Detail >></div>
    </div>
  </div>
</div>