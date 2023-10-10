<?php

include('../elements/header.php');
if (!(isset($_SESSION["role"]) && $_SESSION["role"] == 'Teacher' || $_SESSION["role"] == 'Admin' || $_SESSION["role"] == 'Student')) {
    header('location:../error/403.php');
}
include('../elements/sidebar.php');

// require('../../database/connect.php');
include('../../database/exam.class.php');

$exam = new Exam();
$item = $exam->getExamById($_POST['id']);
?>
<div class="content-wrapper">
    <div class="card-header">
        <h3 class="card-title">Sınav Görüntüleme Sayfası</h3>
    </div>
    <section class="content">
        <div class="table-responsive pt-3">
            <table class="table table-bordered">
                <tr>
                    <th style="width:30px">Öğrenci İsim Soyisim</th>
                    <td><?php echo $item->name . ' ' . $item->surname ?></td>
                </tr>
                <tr>
                    <th style="width:30px">Ders</th>
                    <td><?php echo $item->lesson_name ?></td>
                </tr>
                <tr>
                    <th style="width:30px">Öğrencinin Sınıfı</th>
                    <td><?php echo $item->class_name ?></td>
                </tr>
                <tr>
                    <th style="width:30px">Notu</th>
                    <td><?php echo $item->exam_score ?></td>
                </tr>
                <tr>
                    <th style="width: 30px">Tarih</th>
                    <td><?php echo $item->exam_date ?></td>
                </tr>
            </table>
        </div>
</div>
</div>
</div>

<?php include('../elements/footer.php'); ?>