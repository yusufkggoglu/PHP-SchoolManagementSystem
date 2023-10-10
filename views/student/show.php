<?php

include('../elements/header.php');
if (!(isset($_SESSION["role"]) && $_SESSION["role"] == 'Teacher' || $_SESSION["role"] == 'Admin')) {
    header('location:../error/403.php');
}
include('../elements/sidebar.php');

// require('../../database/connect.php');
include('../../database/student.class.php');

$student = new Student();
$person = $student->getStudentById($_POST['id']);
$history = $student->getHistoryExam($_POST['id']);
?>
<div class="content-wrapper">
    <div class="card-header">
        <h3 class="card-title">Öğrenci Görüntüleme Sayfası</h3>
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
                    <th style="width: 30px">Sınıfı</th>
                    <td> <?php
                            $temp = $student->FindClassName($person->id);
                            if ($temp) {
                                echo $temp['class'];
                            } else {
                                echo "-";
                            } ?></td>
                </tr>
            </table>
        </div>
    </section>
    <div class="card-header">
        <h3 class="card-title">Öğrenci Sınav Geçmişi</h3>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>
                        Sınav Zamanı
                    </th>
                    <th>
                        Sınav Puanı
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
                <?php foreach ($history as $rs) { ?>
                    <tr>
                        <td>
                            <?php echo $rs->exam_date ?>
                        </td>
                        <td>
                            <?php echo $rs->exam_score ?>
                        </td>
                        <td>
                            <?php echo $rs->lesson_name ?>
                        </td>

                        <td>
                            <?php echo $student->getAvgLessonByStudentId($rs->lesson_id) ?>
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