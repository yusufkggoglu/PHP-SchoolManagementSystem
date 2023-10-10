<?php

include('../elements/header.php');
if (!(isset($_SESSION["role"]) && $_SESSION["role"] == 'Teacher' || $_SESSION["role"] == 'Admin' || $_SESSION["role"] == 'Student')) {
    header('location:../error/403.php');
}
include('../elements/sidebar.php');
// require('../../database/connect.php');
include('../../database/exam.class.php');
include('../../database/lesson.class.php');

$exam = new Exam();
if ($_SESSION["role"] == 'Admin') {
    $exams = $exam->getExam();
}
if ($_SESSION["role"] == 'Teacher') {
    $exams = $exam->getExamForTeacher($_SESSION["id"]);
}
if ($_SESSION["role"] == 'Student') {
    $exams = $exam->getExamForStudent($_SESSION["id"]);
}
$lesson = new Lesson();
$lessons = $lesson->getLesson();

if (isset($_POST['deleteExam']) && isset($_POST['did'])) {
    $exam->deleteExam($_POST['did']);
    $exams = $exam->getExam();
}

if (isset($_POST['searchByLesson']) && isset($_POST['lesson_id'])) {
    if ((isset($_SESSION["role"]) &&  $_SESSION["role"] == 'Admin')) {
        $exams = $exam->searchByLesson($_POST['lesson_id']);
    }
    if ((isset($_SESSION["role"]) &&  $_SESSION["role"] == 'Student')) {
        $exams = $exam->searchByLessonForStudent($_POST['lesson_id'], $_SESSION['id']);
    }
}
?>
<div class="content-wrapper">
    <div class="card-header">
        <h3 class="card-title">Sınavlar Sayfası</h3>
    </div>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <?php if ((isset($_SESSION["role"]) &&  $_SESSION["role"] == 'Admin') || $_SESSION["role"] == 'Teacher') { ?>
                    <a class="btn btn-block btn-default" href="/yetkinlik_merkezi/views/exam/create.php">Ekle</a>
                <?php } ?>
                <?php if ((isset($_SESSION["role"]) &&  $_SESSION["role"] == 'Admin') || $_SESSION["role"] == 'Student') { ?>
                    <form class="form" action="" method="post">
                        <div class="card-body">
                            <label>Derse göre</label>
                            <div class="form-group" style="display:flex">
                                <select class="form-control select2 select2-hidden-accessible" name="lesson_id">
                                    <?php foreach ($lessons as $rs) { ?>
                                        <option value="<?php echo $rs->id ?>"><?php echo $rs->lesson_name ?></option>
                                    <?php } ?>
                                </select>
                                <button type="submit" name="searchByLesson" class="btn btn-primary " style="float:right;">Ara</button>
                            </div>
                        </div>
                    </form>
                <?php } ?>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>
                                Sınav Tarihi
                            </th>
                            <th>
                                Sınıf Adı
                            </th>
                            <th>
                                Öğrenci İsim Soyisim
                            </th>
                            <th>
                                Ders Adı
                            </th>
                            <th>
                                Ders Ortalaması
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($exams as $rs) { ?>
                            <tr>
                                <td>
                                    <?php echo $rs->exam_date ?>
                                </td>
                                <td>
                                    <?php echo $rs->class_name ?>
                                </td>
                                <td>
                                    <?php echo $rs->name . ' ' . $rs->surname ?>
                                </td>
                                <td>
                                    <?php echo $rs->lesson_name ?>
                                </td>
                                <td>
                                    <?php echo $exam->lessonAverage($rs->lesson_id) ?>
                                </td>
                                <td class="project-actions text-right">
                                    <form action="show.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $rs->id ?>">
                                        <button type="submit" class="btn btn-info btn-sm mb-1">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Görüntüle
                                        </button>
                                    </form>
                                    <?php if ((isset($_SESSION["role"]) &&  $_SESSION["role"] == 'Admin') || $_SESSION["role"] == 'Teacher') { ?>
                                        <form action="edit.php" method="post">
                                            <input type="hidden" name="id" value="<?php echo $rs->id ?>">
                                            <button type="submit" class="btn btn-primary btn-sm mb-1">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Güncelle
                                            </button>
                                        </form>
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="did" value="<?php echo $rs->id ?>">
                                            <button type="submit" name="deleteExam" class="btn btn-danger btn-sm mb-1">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Sil
                                            </button>
                                        </form>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
</div>

<?php include('../elements/footer.php'); ?>