<?php

include('../elements/header.php');
if (!(isset($_SESSION["role"]) && $_SESSION["role"] == 'Teacher' || $_SESSION["role"] == 'Admin' || $_SESSION["role"] == 'Student')) {
    header('location:../error/403.php');
}
include('../elements/sidebar.php');

// require('../../database/connect.php');
include('../../database/class.class.php');

$class = new Classes();
if ($_SESSION["role"] == 'Admin') {
    $classes = $class->getClassForList();
}
if ($_SESSION["role"] == 'Teacher') {
    $classes = $class->getClassForTeacher($_SESSION["id"]);
}
if ($_SESSION["role"] == 'Student') {
    $classes = $class->getClassForStudent($_SESSION["id"]);
}
if (isset($_POST['deleteClass']) && isset($_POST['did'])) {
    $class->deleteClass($_POST['did']);
    $classes = $class->getClassForList();
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="card-header">
        <h3 class="card-title">Sınıflar Sayfası</h3>
    </div>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <?php if ((isset($_SESSION["role"]) &&  $_SESSION["role"] == 'Admin')) { ?>
                    <a class="btn btn-block btn-default" href="/yetkinlik_merkezi/views/class/create.php">Ekle</a>
                <?php } ?>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>
                                Sınıf Adı
                            </th>
                            <th>
                                Sınıf Sorumlusu
                            </th>
                            <th>
                                Sınıf Başarı Ortalaması
                            </th>
                            <th>
                                Öğrenci Sayısı
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($classes as $rs) { ?>
                            <tr>
                                <td>
                                    <?php echo $rs->class_name ?>
                                </td>
                                <td>
                                    <?php echo $rs->name . ' ' . $rs->surname  ?>
                                </td>
                                <td>
                                    <?php echo $class->averageOfClass($rs->id) ?>
                                </td>
                                <td>
                                    <?php echo $class->countStudentOfClass($rs->id) ?>
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
                                        <form action="" method="post">
                                            <input type="hidden" name="did" value="<?php echo $rs->id ?>">
                                            <button type="submit" name="deleteClass" class="btn btn-danger btn-sm mb-1">
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