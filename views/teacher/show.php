<?php

include('../elements/header.php');
if (!(isset($_SESSION["role"]) && $_SESSION["role"] == 'Admin')) {
    header('location:../error/403.php');
}
include('../elements/sidebar.php');

// require('../../database/connect.php');
include('../../database/teacher.class.php');

$teacher = new Teacher();
$person = $teacher->getTeacherById($_POST['id']);
?>
<div class="content-wrapper">
    <div class="card-header">
        <h3 class="card-title">Sorumlu Görüntüleme Sayfası</h3>
    </div>
    <section class="content">
        <div class="table-responsive pt-3">
            <table class="table table-bordered">
                <tr>
                    <th style="width:30px">İsim</th>
                    <td><?php echo $person->name ?></td>
                </tr>
                <tr>
                    <th style="width: 30px">Soyisim</th>
                    <td><?php echo $person->surname ?></td>
                </tr>
                <tr>
                    <th style="width: 30px">Sorumlu Sınıf</th>
                    <td><?php echo "Sınıfı" ?></td>
                </tr>
                <tr>
                    <th style="width: 30px">Sorumlu Ders Adı</th>
                    <td><?php echo "Sınıfı" ?></td>
                </tr>
            </table>
        </div>
</div>
</div>
</div>

<?php include('../elements/footer.php'); ?>