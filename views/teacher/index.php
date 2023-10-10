<?php

include('../elements/header.php');
if (!(isset($_SESSION["role"]) && $_SESSION["role"] == 'Admin')) {
    header('location:../error/403.php');
}
include('../elements/sidebar.php');

// require('../../database/connect.php');
include('../../database/teacher.class.php');
include('../../database/lesson.class.php');
include('../../database/class.class.php');

$class = new Classes();
$classes = $class->getClass();

$lesson = new Lesson();
$lessons = $lesson->getLesson();

$teacher = new Teacher();
$teachers = $teacher->getTeacherForList();

if (isset($_POST['deleteTeacher']) && isset($_POST['did'])) {
    $teacher->deleteTeacher($_POST['did']);
    $teachers = $teacher->getTeacherForList();
}
if (isset($_POST['searchByLesson']) && isset($_POST['lesson_id'])) {
    $teachers = $teacher->searchByLesson($_POST['lesson_id']);
}
if (isset($_POST['searchByClass']) && isset($_POST['class_id'])) {
    $teachers = $teacher->searchByClass($_POST['class_id']);
}
?>
<div class="content-wrapper">
    <div class="card-header">
        <h3 class="card-title">Sorumlular Sayfası</h3>
    </div>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <a class="btn btn-block btn-default" href="/yetkinlik_merkezi/views/teacher/create.php">Ekle</a>
                <div class="card-body">
                    <form class="form" action="" method="post">
                        <label>Sınıfa göre</label>
                        <div class="form-group" style="display:flex;">
                            <select class="form-control select2 select2-hidden-accessible" name="class_id">
                                <?php foreach ($classes as $rs) { ?>
                                    <option value="<?php echo $rs->id ?>"><?php echo $rs->class_name ?></option>
                                <?php } ?>
                            </select>
                            <button type="submit" name="searchByClass" class="btn btn-primary " style="float:right;">Ara</button>
                        </div>
                    </form>
                    <form class="form" action="" method="post">
                        <label>Derse göre</label>
                        <div class="form-group" style="display:flex">
                            <select class="form-control select2 select2-hidden-accessible" name="lesson_id">
                                <?php foreach ($lessons as $rs) { ?>
                                    <option value="<?php echo $rs->id ?>"><?php echo $rs->lesson_name ?></option>
                                <?php } ?>
                            </select>
                            <button type="submit" name="searchByLesson" class="btn btn-primary " style="float:right;">Ara</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>
                                İsim
                            </th>
                            <th>
                                Soyisim
                            </th>
                            <th>
                                Sorumlu Sınıf
                            </th>
                            <th>
                                Sorumlu Ders Adı
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($teachers as $rs) { ?>
                            <tr>
                                <td>
                                    <?php echo $rs->name ?>
                                </td>
                                <td>
                                    <?php echo $rs->surname ?>
                                </td>
                                <td>
                                    <?php
                                    $temp = $teacher->findClassName($rs->id);
                                    if ($temp) {
                                        echo $temp['class_name'];
                                    } else {
                                        echo "-";
                                    } ?>
                                </td>
                                <td>
                                    <?php
                                    $temp = $teacher->findLessonName($rs->id);
                                    if ($temp) {
                                        echo $temp['lesson_name'];
                                    } else {
                                        echo "-";
                                    } ?>
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
                                    <form action="edit.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $rs->id ?>">
                                        <button type="submit" class="btn btn-primary btn-sm mb-1">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Güncelle
                                        </button>
                                    </form>
                                    <form action="" method="post">
                                        <input type="hidden" name="did" value="<?php echo $rs->id ?>">
                                        <button type="submit" name="deleteTeacher" class="btn btn-danger btn-sm mb-1">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Sil
                                        </button>
                                    </form>
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