<?php
require('database/connect.php');
include('database/user.class.php');

$user = new User();
if (isset($_POST['login'])) {
  if (!(empty($_POST['username']) || empty($_POST['password']))) {
    $check = $user->login($_POST['username'], $_POST['password']);
    if ($check) {
      $errors = "Bilgiler yanlış ...";
    }
  } else {
    $errors = "Tüm boşlukları doldurunuz ! Tekrar deneyiniz ...";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Siber Vatan | Giriş</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="views/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="views/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="views/assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a><b>Siber Vatan</b></a>
    </div>
    <div class="card">
      <?php if (isset($errors)) { ?>
        <div class="alert-warning alert-block">
          <strong><?php echo $errors ?></strong>
        </div>
      <?php } ?>
      <div class="card-body login-card-body">
      <p class="login-box-msg">Yusufcan Küçükgökgözoğlu</p>
        <p class="login-box-msg">Proje bitiş tarihi : 10.10.2023 </p>        <form action="" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="username" placeholder="username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block" name="login">Giriş</button>
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="views/assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="views/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="views/assets/dist/js/adminlte.min.js"></script>
</body>

</html>