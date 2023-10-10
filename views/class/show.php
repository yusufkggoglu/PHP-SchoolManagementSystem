<?php

include('../elements/header.php');
if (!(isset($_SESSION["role"]) && $_SESSION["role"] == 'Teacher' || $_SESSION["role"] == 'Admin' || $_SESSION["role"] == 'Student')) {
    header('location:../error/403.php');
}
include('../elements/sidebar.php');

// require('../../database/connect.php');
include('../../database/teacher.class.php');
include('../../database/class.class.php');

$class = new Classes();
$item = $class->getClassById($_POST['id']);
$InClass = $class->getInClass($_POST['id']);
$teacher = new Teacher();
$person = $teacher->getTeacherById($item->class_teacher_id);

if (isset($_POST['deleteStudentFromClass']) && isset($_POST['student_id']) && isset($_POST['id'])) {
    $class->deleteStudentFromClass($_POST['student_id'], $_POST['id']);
    $InClass = $class->getInClass($_POST['id']);
    $errors = "Öğrenci sınıftan çıkarıldı ! ";
}
?>
<div class="content-wrapper">
    <div class="card-header">
        <h3>Sınıf Görüntüleme Sayfası</h3>
    </div>
    <?php if (isset($errors)) { ?>
        <div class="alert-warning alert-block">
            <strong><?php echo $errors ?></strong>
        </div>
    <?php } ?>
    <section class="content">
        <div class="table-responsive pt-3">
            <table class="table table-bordered">
                <tr>
                    <th style="width:30px">Sınıf Adı</th>
                    <td><?php echo $item->class_name ?></td>
                </tr>
                <tr>
                    <th style="width: 30px">Sınıf Sorumlusu</th>
                    <td><?php echo $person->name . ' ' . $person->surname ?></td>
                </tr>
            </table>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <?php if ((isset($_SESSION["role"]) &&  $_SESSION["role"] == 'Admin')) { ?>
                    <form action="addStudent.php" method="post" class="form">
                        <input type="hidden" name="class_id" value="<?php echo $_POST['id'] ?>">
                        <button type="submit" class="btn btn-block btn-default">Ekle</button>
                    </form>
                <?php } ?>
                <thead>
                    <tr>
                        <th>
                            Öğrenci İsim
                        </th>
                        <th>
                            Öğrenci Soyisim
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($InClass as $rs) { ?>
                        <tr>
                            <td>
                                <?php echo $rs->name ?>
                            </td>
                            <td>
                                <?php echo $rs->surname  ?>
                            </td>
                            <td class="project-actions text-right">
                                <?php if ((isset($_SESSION["role"]) &&  $_SESSION["role"] == 'Admin')) { ?>
                                    <form action="" method="post">
                                        <input type="hidden" name="id" value="<?php echo $_POST['id'] ?>">
                                        <input type="hidden" name="student_id" value="<?php echo $rs->id ?>">
                                        <button type="submit" name="deleteStudentFromClass" class="btn btn-danger btn-sm mb-1">
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
    </section>
</div>
</div>
</div>

<?php include('../elements/footer.php'); ?>