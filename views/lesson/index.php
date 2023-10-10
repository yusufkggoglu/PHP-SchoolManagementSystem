<?php

include('../elements/header.php');
if (!(isset($_SESSION["role"]) && $_SESSION["role"] == 'Teacher' || $_SESSION["role"] == 'Admin')) {
    header('location:../error/403.php');
}
include('../elements/sidebar.php');

// require('../../database/connect.php');
include('../../database/lesson.class.php');
include('../../database/teacher.class.php');

$teacher = new Teacher();
$teachers = $teacher->getAll();

$lesson = new Lesson();
if ($_SESSION["role"] == 'Admin') {
    $lessons = $lesson->getLesson();
}
if ($_SESSION["role"] == 'Teacher') {
    $lessons = $lesson->getLessonForTeacher($_SESSION["id"]);
}
if (isset($_POST['deleteLesson']) && isset($_POST['did'])) {
    $lesson->deleteLesson($_POST['did']);
    $lessons = $lesson->getLesson();
}

if (isset($_POST['searchByTeacher']) && isset($_POST['user_id'])) {
    $lessons = $lesson->searchByTeacher($_POST['user_id']);
}
?>
<div class="content-wrapper">
    <div class="card-header">
        <h3 class="card-title">Dersler Sayfası</h3>
    </div>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <?php if ((isset($_SESSION["role"]) &&  $_SESSION["role"] == 'Admin')) { ?>
                    <a class="btn btn-block btn-default" href="/yetkinlik_merkezi/views/lesson/create.php">Ekle</a>
                    <form class="form" action="" method="post">
                        <div class="card-body">
                            <label>Sorumluya göre</label>
                            <div class="form-group" style="display:flex">
                                <select class="form-control select2 select2-hidden-accessible" name="user_id">
                                    <?php foreach ($teachers as $rs) { ?>
                                        <option value="<?php echo $rs->id ?>"><?php echo $rs->name . ' ' . $rs->surname ?></option>
                                    <?php } ?>
                                </select>
                                <button type="submit" name="searchByTeacher" class="btn btn-primary " style="float:right;">Ara</button>
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
                                Ders Adı
                            </th>
                            <th>
                                Sorumlu Adı
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lessons as $rs) { ?>
                            <tr>
                                <td>
                                    <?php echo $rs->lesson_name ?>
                                </td>
                                <td>
                                    <?php echo $rs->name . ' ' . $rs->surname  ?>
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
                                    <?php if ((isset($_SESSION["role"]) &&  $_SESSION["role"] == 'Admin')) { ?>
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
                                            <button type="submit" name="deleteLesson" class="btn btn-danger btn-sm mb-1">
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