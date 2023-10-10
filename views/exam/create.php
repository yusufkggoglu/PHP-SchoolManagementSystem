<?php

include('../elements/header.php');
if (!(isset($_SESSION["role"]) && $_SESSION["role"] == 'Teacher' || $_SESSION["role"] == 'Admin')) {
    header('location:../error/403.php');
}
include('../elements/sidebar.php');

// require('../../database/connect.php');
include('../../database/lesson.class.php');
include('../../database/student.class.php');
include('../../database/exam.class.php');

$lesson = new Lesson();
if ($_SESSION["role"] == 'Admin') {
    $lessons = $lesson->getLesson();
}
if ($_SESSION["role"] == 'Teacher') {
    $lessons = $lesson->getLessonForTeacher($_SESSION["id"]);
}

$exam = new Exam();
$students = $exam->getHaveClass();

if (isset($_POST['addExam'])) {
    if (!(empty($_POST['lesson_id']) || empty($_POST['student_id']) || empty($_POST['exam_score']))) {
        $exam_score = $_POST['exam_score'];
        if ($exam_score >= 0 && $exam_score <= 100) {
            $exam->createExam($_POST['student_id'], $_POST['lesson_id'], $_POST['exam_score']);
            $errors = "Sınav Eklendi ! ";
        } else {
            $errors = "Sınav Puanı 0-100 aralığında olmalıdır ! ";
        }
    } else {
        $errors = "Tüm boşlukları doldurunuz ! Tekrar deneyiniz ...";
    }
}
?>
<div class="content-wrapper">
    <div class="card-header">
        <h3 class="card-title">Sınav Ekleme Sayfası</h3>
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
                    <label>Ders</label>
                    <select class="form-control select2 select2-hidden-accessible" name="lesson_id">
                        <?php foreach ($lessons as $rs) { ?>
                            <option value="<?php echo $rs->id ?>"><?php echo $rs->lesson_name ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Öğrenci</label>
                    <select class="form-control select2 select2-hidden-accessible" name="student_id">
                        <?php foreach ($students as $rs) { ?>
                            <option value="<?php echo $rs->id ?>"><?php echo $rs->name . ' ' . $rs->surname ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Sınav Notu</label>
                    <input type="number" step="0.01" class="form-control" name="exam_score" placeholder="...">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" name="addExam" class="btn btn-primary">Kaydet</button>
            </div>
        </form>
</div>
</div>
</div>

<?php include('../elements/footer.php'); ?>