<?php

include('../elements/header.php');
if (!(isset($_SESSION["role"]) && $_SESSION["role"] == 'Teacher' || $_SESSION["role"] == 'Admin')) {
    header('location:../error/403.php');
}
include('../elements/sidebar.php');

// require('../../database/connect.php');
include('../../database/student.class.php');
include('../../database/class.class.php');

$class = new Classes();
$classes = $class->getClass();

$student = new Student();
$students = $student->getStudent();

if (isset($_POST['deleteStudent']) && isset($_POST['did'])) {
    $student->deleteStudent($_POST['did']);
    $students = $student->getStudent();
}

if (isset($_POST['searchByClass']) && isset($_POST['class_id'])) {
    $students = $student->searchStudent($_POST['class_id']);
}
?>
<div class="content-wrapper">
    <div class="card-header">
        <h3 class="card-title">Öğrenciler Sayfası </h3>
    </div>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <?php if ((isset($_SESSION["role"]) &&  $_SESSION["role"] == 'Admin')) { ?>
                    <a class="btn btn-block btn-default" href="/yetkinlik_merkezi/views/student/create.php">Ekle</a>
                <?php } ?>
                <form class="form" action="" method="post">
                    <div class="card-body">
                        <label>Sınıfa göre</label>
                        <div class="form-group" style="display:flex">
                            <select class="form-control select2 select2-hidden-accessible" name="class_id">
                                <?php foreach ($classes as $rs) { ?>
                                    <option value="<?php echo $rs->id ?>"><?php echo $rs->class_name ?></option>
                                <?php } ?>
                            </select>
                            <button type="submit" name="searchByClass" class="btn btn-primary " style="float:right;">Ara</button>
                        </div>
                    </div>
                </form>
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
                                Sınıf
                            </th>
                            <th>
                                Genel Başarı Ort.
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $rs) { ?>
                            <tr>
                                <td>
                                    <?php echo $rs->name ?>
                                </td>
                                <td>
                                    <?php echo $rs->surname ?>

                                </td>
                                <td>
                                    <?php
                                    $temp = $student->FindClassName($rs->id);
                                    if ($temp) {
                                        echo $temp['class'];
                                    } else {
                                        echo "-";
                                    } ?>
                                </td>
                                <td>
                                    <?php echo $student->getAvgScoreByStudentId($rs->id) ?>

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
                                            <button type="submit" name="deleteStudent" class="btn btn-danger btn-sm mb-1">
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