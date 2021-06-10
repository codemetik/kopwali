<?php require_once("header.php"); ?>
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Company name</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
  <ul class="navbar-nav px-3 w-100">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="#"><span data-feather="users"></span> | <?= $_SESSION['user']; ?></a>
    </li>
  </ul>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="tabungan">
              <span data-feather="bar-chart-2"></span>
              Tabungan
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=pinjaman">
              <span data-feather="file"></span>
              Pinjaman
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=pengembalian">
              <span data-feather="cast"></span>
              Pengembalian
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=data_user">
              <span data-feather="users"></span>
              Data User
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Saved reports</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="../logout.php">
              <span data-feather="log-out"></span>
              Log-out
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1> | <h5 class="h2"><?= $_SESSION['user']; ?></h5>
        <!-- <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div> -->
      </div>

      <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->

      <?php 
      if (isset($_GET['page'])) {
          $page = $_GET['page'];

          switch ($page) {
            case 'tabungan':
              require_once('admin/tabungan.php');
              break;
            case 'pinjaman':
              require_once('admin/pinjaman.php');
              break;
            case 'pengembalian':
              require_once('admin/pengembalian.php');
              break;
            case 'data_user':
              require_once('admin/data_user.php');
              break;
            
            default:
              require_once('index.php');
              break;
          }
      }
      ?>
    </main>
  </div>
</div>

<?php require_once("footer.php"); ?>