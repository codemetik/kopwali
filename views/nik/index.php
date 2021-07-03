<?php 
session_start();
require_once('../../assets/koneksi.php');

if($_SESSION['status'] != "login"){
  header("location:../../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.82.0">
    <title>Kopwali</title>
    <link rel="icon" href="../../assets/img/data.png">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">

    <link rel="stylesheet" href="../../plugins/datatables/jquery.dataTables.min.css">

    <!-- Bootstrap core CSS -->
<link href="../../plugins/bootstrap-5/dist/css/bootstrap.css" rel="stylesheet">
<link href="../../plugins/bootstrap-5/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <link href="../../plugins/dashboard/dashboards.css" rel="stylesheet">
  </head>
  <body class="bg-dark">
<header class="navbar navbar-dark sticky-top bg-info flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="index.php"><img src="../../assets/img/data.png" alt="" width="40" height="34"/> Kopwali</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
  <ul class="navbar-nav px-3 w-100">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="user"><span data-feather="users"></span> | <?= $_SESSION['user']; ?></a>
    </li>
  </ul>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-info sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php">
              <span data-feather="home" class="text-dark"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="simpananku">
              <span data-feather="bar-chart-2"></span>
              SimpananQu
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pinjamanku">
              <span data-feather="file"></span>
              PinjamanQu
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
            <a class="nav-link" href="../../logout.php">
              <span data-feather="log-out"></span>
              Log-out
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 text-light">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard Informasi</h1> | <h5 class="h2"><?= $_SESSION['user']; ?></h5>
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
            case 'user':
              require_once('user.php');
              break;
            case 'simpananku':
              require_once('simpananku.php');
              break;
            case 'pinjamanku':
              require_once('pinjamanku.php');
              break;
            
            default:
              get_error();
              break;
          }
      }else{
        require_once('home.php');
      }

      function get_default(){
        echo '<div class="alert alert-success"><h3>Halaman Default</h3></div>';
      }
      function get_error(){
        echo '<div class="alert alert-danger"><h3>Maaf. Halaman yang anda cari tidak ada!</h3></div>';
      }
      ?>
    </main>
  </div>
</div>

    <script src="../../plugins/datatables/jquery-3.5.1.js"></script>
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
          $('#example').DataTable();
      } 
      );

      $(document).ready(function() {
          $('.js-example-basic-single').select2();
      });

    </script>

    <script src="../../plugins/bootstrap-5/dist/js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
      <script src="../../plugins/dashboard/dashboard.js"></script>
  </body>
</html>