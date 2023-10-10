<?php

include('../elements/header.php');
if (!(isset($_SESSION["role"]) && $_SESSION["role"] == 'Admin')) {
    header('location:../error/403.php');
}
include('../elements/sidebar.php');

// require('../../database/connect.php');
include('../../database/class.class.php');
include('../../database/teacher.class.php');

$teacher = new Teacher();
$teachers = $teacher->getAll();
$class = new Classes();
if (isset($_POST['addClass'])) {
    if (!(empty($_POST['class_name']) || empty($_POST['class_teacher_id']))) {
        $class->createClass($_POST['class_name'], $_POST['class_teacher_id']);
        $errors = "Sınıf Eklendi ! ";
    } else {
        $errors = "Tüm boşlukları doldurunuz ! Tekrar deneyiniz ...";
    }
}
?>
<div class="content-wrapper">
    <div class="card-header">
        <h3 class="card-title">Sınıf Ekleme Sayfası</h3>
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
                    <label>Sınıf Adı</label>
                    <input type="text" class="form-control" name="class_name" placeholder="...">
                </div>
                <div class="form-group">
                    <label>Sınıf Sorumlusu</label>
                    <select class="form-control select2 select2-hidden-accessible" name="class_teacher_id">
                        <?php foreach ($teachers as $rs) { ?>
                            <option value="<?php echo $rs->id ?>"><?php echo $rs->name . ' ' . $rs->surname ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" name="addClass" class="btn btn-primary">Kaydet</button>
            </div>
        </form>
</div>
</div>
</div>

<?php include('../elements/footer.php'); ?>