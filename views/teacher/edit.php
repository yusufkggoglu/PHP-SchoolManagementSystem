<?php

include('../elements/header.php');
if (!(isset($_SESSION["role"]) && $_SESSION["role"] == 'Admin')) {
    header('location:../error/403.php');
}
include('../elements/sidebar.php');

// require('../../database/connect.php');
include('../../database/teacher.class.php');

$teacher = new Teacher();
$person = $teacher->getTeacherById($_POST['id']);
echo $_POST['id'];
if (isset($_POST['editTeacher'])) {
    if (!(empty($_POST['id']) || empty($_POST['name']) || empty($_POST['surname']) || empty($_POST['username']) || empty($_POST['password']))) {
        if (!($database->getByUsernameForEdit($_POST['username'], $_POST['id']))) {
            $teacher->editTeacher($_POST['id'], $_POST['name'], $_POST['surname'], $_POST['username'], $_POST['password']);
            $person = $teacher->getTeacherById($_POST['id']);
            $errors = "Bilgiler Güncellendi ! ";
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
        <h3 class="card-title">Sorumlu Güncelleme Sayfası</h3>
    </div>
    <section class="content">
        <form class="form" action="" method="post">
            <?php if (isset($errors)) { ?>
                <div class="alert-warning alert-block">
                    <strong><?php echo $errors ?></strong>
                </div>
            <?php } ?>
            <div class="card-body">
                <input type="hidden" class="form-control" name="id" value="<?php echo $person->id ?>">
                <div class="form-group">
                    <label>İsim</label>
                    <input type="text" class="form-control" name="name" value="<?php echo $person->name ?>">
                </div>
                <div class="form-group">
                    <label>Soyisim</label>
                    <input type="text" class="form-control" name="surname" value="<?php echo $person->surname ?>">
                </div>
                <div class="form-group">
                    <label>Kullanıcı Adı</label>
                    <input type="text" class="form-control" name="username" value="<?php echo $person->username ?>">
                </div>
                <div class="form-group">
                    <label>Şifre</label>
                    <input type="password" class="form-control" name="password">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" name="editTeacher" class="btn btn-primary">Güncelle</button>
            </div>
        </form>
</div>
</div>
</div>

<?php include('../elements/footer.php'); ?>