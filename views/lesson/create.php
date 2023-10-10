<?php

include('../elements/header.php');
if (!(isset($_SESSION["role"]) && $_SESSION["role"] == 'Admin')) {
    header('location:../error/403.php');
}
include('../elements/sidebar.php');

// require('../../database/connect.php');
include('../../database/lesson.class.php');
include('../../database/teacher.class.php');

$teacher = new Teacher();
$teachers = $teacher->getAll();
$lesson = new Lesson();
if (isset($_POST['addLesson'])) {
    if (!(empty($_POST['lesson_name']) || empty($_POST['teacher_user_id']))) {
        $lesson->createLesson($_POST['teacher_user_id'], $_POST['lesson_name']);
        $errors = "Ders Eklendi ! ";
    } else {
        $errors = "Tüm boşlukları doldurunuz ! Tekrar deneyiniz ...";
    }
}
?>
<div class="content-wrapper">
    <div class="card-header">
        <h3 class="card-title">Ders Ekleme Sayfası</h3>
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
                    <label>Ders Adı</label>
                    <input type="text" class="form-control" name="lesson_name" placeholder="...">
                </div>
                <div class="form-group">
                    <label>Sorumlu</label>
                    <select class="form-control select2 select2-hidden-accessible" name="teacher_user_id">
                        <?php foreach ($teachers as $rs) { ?>
                            <option value="<?php echo $rs->id ?>"><?php echo $rs->name . ' ' . $rs->surname ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" name="addLesson" class="btn btn-primary">Kaydet</button>
            </div>
        </form>
</div>
</div>
</div>

<?php include('../elements/footer.php'); ?>