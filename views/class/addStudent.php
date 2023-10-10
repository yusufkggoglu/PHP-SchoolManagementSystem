<?php

include('../elements/header.php');
if (!(isset($_SESSION["role"]) && $_SESSION["role"] == 'Admin')) {
    header('location:../error/403.php');
}
include('../elements/sidebar.php');

// require('../../database/connect.php');
include('../../database/class.class.php');

$class = new Classes();
$students = $class->getHaveNoClass();
if (isset($_POST['addStudent']) && isset($_POST['class_id']) && isset($_POST['student_id'])) {
    $class->addStudent($_POST['class_id'], $_POST['student_id']);
    $students = $class->getHaveNoClass();
    $errors = "Öğrenci sınıfa eklendi ! ";
}
?>
<div class="content-wrapper">
    <div class="card-header">
        <h3 class="card-title">Sınıfa Öğrenci Ekleme Sayfası</h3>
    </div>
    <?php if (isset($errors)) { ?>
                <div class="alert-warning alert-block">
                    <strong><?php echo $errors ?></strong>
                </div>
            <?php } ?>
    <section class="content">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
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
                    <?php foreach ($students as $rs) { ?>
                        <tr>
                            <td>
                                <?php echo $rs->name ?>
                            </td>
                            <td>
                                <?php echo $rs->surname  ?>
                            </td>
                            <td class="project-actions text-right">
                                <form action="" method="post" class="form">
                                    <input type="hidden" name="class_id" value="<?php echo $_POST['class_id'] ?>">
                                    <input type="hidden" name="student_id" value="<?php echo $rs->id ?>">
                                    <button type="submit" name="addStudent" class="btn btn-primary btn-sm mb-1">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Ekle
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
</div>
</div>
</div>

<?php include('../elements/footer.php'); ?>