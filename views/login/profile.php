<?php

include('../elements/header.php');
if (!(isset($_SESSION["role"]) && $_SESSION["role"] == 'Teacher' || $_SESSION["role"] == 'Admin' || $_SESSION["role"] == 'Student')) {
    header('location:../error/403.php');
}
include('../elements/sidebar.php');
if (isset($_POST['changePassword']) && isset($_POST['password']) && isset($_POST['second_password'])) {
    if ($_POST['password'] == $_POST['second_password']) {
        $database->changePassword($_SESSION['id'], $_POST['password']);
        $errors = "Şifreniz Yenilendi !";
    } else {
        $errors = "Şifreler eşleşmiyor , Tekrar deneyiniz...";
    }
}
$person = $database->getById($_SESSION['id']);
?>
<div class="content-wrapper">
    <div class="card-header">
        <h3 class="card-title">Profil</h3>
    </div>
    <div class="table-responsive pt-3">
        <table class="table table-bordered">
            <tr>
                <th style="width:30px">İsim Soyisim</th>
                <td><?php echo $person->name . ' ' . $person->surname ?></td>
            </tr>
            <tr>
                <th style="width:30px">Kullanıcı Adı</th>
                <td><?php echo $person->username ?></td>
            </tr>
            <tr>
                <th style="width:30px">Rolü</th>
                <td><?php echo $person->role ?></td>
            </tr>
            <tr>
                <th style="width:30px">Kayıt Tarihi</th>
                <td><?php echo $person->created_at ?></td>
            </tr>
        </table>
    </div>
    <div class="card-header">
        <h3 class="card-title">Şifre Değiştirme </h3>
    </div>
    <section class="content">
        <form class="form" action="" method="post">
            <?php if (isset($errors)) { ?>
                <div class="alert-warning alert-block">
                    <strong><?php echo $errors ?></strong>
                </div>
            <?php } ?>
            <div class="card-body">
                <div class="form-group">
                    <label>Şifre</label>
                    <input type="password" class="form-control" name="password" placeholder="...">
                </div>
                <div class="form-group">
                    <label>Tekrar Şifre</label>
                    <input type="password" class="form-control" name="second_password" placeholder="...">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" name="changePassword" class="btn btn-primary">Kaydet</button>
            </div>
        </form>
    </section>
</div>
</div>

<?php include('../elements/footer.php'); ?>