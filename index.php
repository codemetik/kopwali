<?php 
session_start();
require_once("assets/koneksi.php");
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
    <link rel="icon" href="assets/img/data.png">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

    

    <!-- Bootstrap core CSS -->
<link href="plugins/bootstrap-5/dist/css/bootstrap.min.css" rel="stylesheet">

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
    <link href="plugins/dashboard/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form class="mb-5 pb-5" action="" method="post">
    <img class="mb-4" src="assets/img/data.png" alt="" width="225" height="200">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

    <div class="form-floating">
      <input type="text" name="user" class="form-control" id="floatingInput" placeholder="User" autofocus>
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" name="pass" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <div class="checkbox mb-3">
      
    </div>
    <button class="w-100 btn btn-lg btn-primary mb-5" type="submit" name="sign">Sign in</button>
    
  </form>
</main>


<script src="plugins/bootstrap-5/dist/js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>

  </body>
</html>

<?php

if (isset($_POST['sign'])) {
  $user = $_POST['user'];
  $pass = $_POST['pass'];

  $user = mysqli_real_escape_string($koneksi, $user);
  $pass = mysqli_real_escape_string($koneksi, $pass);

  $query = mysqli_query($koneksi, "select * from tb_user where user = '$user' and pass = '$pass'");
  $sql = mysqli_num_rows($query);
  $dsql = mysqli_fetch_array($query);

if ($sql > 0) {
  $cek = mysqli_query($koneksi, "select * from tb_rols where id_user = '".$dsql['id_user']."'");
  $datacek = mysqli_fetch_array($cek);

  if ($datacek['id_level_user'] == 'LV01') {
    $_SESSION['status'] = "login";
    $_SESSION['user'] = $dsql['user'];
    echo "<script>
    alert('Anda berhasil login');
    document.location.href = 'views/pemilik';
    </script>";
    //header("location:views/pemilik.php");
  }else if ($datacek['id_level_user'] == 'LV02') {
    $_SESSION['status'] = "login";
    $_SESSION['user'] = $dsql['user'];
    echo "<script>
    alert('Anda berhasil login');
    document.location.href = 'views/admin';
    </script>";
    //header("location:views/admin.php");
  }else if ($datacek['id_level_user'] == 'LV03') {
    $_SESSION['status'] = "login";
    $_SESSION['user'] = $dsql['user'];
    echo "<script>
    alert('Anda berhasil login');
    document.location.href = 'views/nik';
    </script>";
    //header("location:views/nik.php");
  }
}else{
  echo "<script>
  alert('Login Gagal');
  document.location.href = 'index.php';
  </script>";
}
}
?>