<?php

include('../elements/header.php');
if (!(isset($_SESSION["role"]) && $_SESSION["role"] == 'Admin')) {
    header('location:../error/403.php');
}
include('../elements/sidebar.php');

// require('../../database/connect.php');
include('../../database/student.class.php');

$student = new Student();
if (isset($_POST['addStudent'])) {
    if (!(empty($_POST['name']) || empty($_POST['surname']) || empty($_POST['username']) || empty($_POST['password']))) {
        if (!($database->getByUsername($_POST['username']))) {
            $student->createStudent($_POST['name'], $_POST['surname'], $_POST['username'], $_POST['password']);
            $errors = "Öğrenci Eklendi ! ";
        } else {
            $errors = "Bu kullanıcı adı dolu ! Başka bir kullanıcı adı deneyiniz...";
        }
    } else {
        $errors = "Tüm boşlukları doldurunuz ! Tekrar deneyiniz ...";
    }
}
?>
<div class="content-wrapper">
    <div class="card-header">
        <h3 class="card-title">Öğrenci Ekleme Sayfası</h3>
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
                    <label>İsim</label>
                    <input type="text" class="form-control" name="name" placeholder="...">
                </div>
                <div class="form-group">
                    <label>Soyisim</label>
                    <input type="text" class="form-control" name="surname" placeholder="...">
                </div>
                <div class="form-group">
                    <label>Kullanıcı Adı</label>
                    <input type="text" class="form-control" name="username" placeholder="...">
                </div>
                <div class="form-group">
                    <label>Şifre</label>
                    <input type="password" class="form-control" name="password" placeholder="...">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" name="addStudent" class="btn btn-primary">Kaydet</button>
            </div>
        </form>
</div>
</div>
</div>

<?php include('../elements/footer.php'); ?>