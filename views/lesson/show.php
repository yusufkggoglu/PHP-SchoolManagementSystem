<?php

include('../elements/header.php');
if (!(isset($_SESSION["role"]) && $_SESSION["role"] == 'Teacher' || $_SESSION["role"] == 'Admin')) {
    header('location:../error/403.php');
}
include('../elements/sidebar.php');

// require('../../database/connect.php');
include('../../database/teacher.class.php');
include('../../database/lesson.class.php');

$lesson = new Lesson();
$item = $lesson->getLessonById($_POST['id']);

$teacher = new Teacher();
$person = $teacher->getTeacherById($item->teacher_user_id);
?>
<div class="content-wrapper">
    <div class="card-header">
        <h3 class="card-title">Ders Görüntüleme Sayfası</h3>
    </div>
    <section class="content">
        <div class="table-responsive pt-3">
            <table class="table table-bordered">
                <tr>
                    <th style="width:30px">Ders Adı</th>
                    <td><?php echo $item->lesson_name ?></td>
                </tr>
                <tr>
                    <th style="width: 30px">Sorumlu</th>
                    <td><?php echo $person->name . ' ' . $person->surname ?></td>
                </tr>
            </table>
        </div>
</div>
</div>
</div>

<?php include('../elements/footer.php'); ?>